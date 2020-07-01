<?php

use App\Model\Config as conf;
use Illuminate\Support\Facades\Auth;

class ekHelper
{
    public static function authUser()
    {
        return Auth::user();
    }

    public static function getCmsConfig($label)
    {
        $value = "";
        $data = conf::where('label', $label)->first();
        if (!isset($data) || $data == null) {
            $value;
        } else $value = $data->value;
        return $value;
    }

    public static function generateToken($length){
        return bin2hex(openssl_random_pseudo_bytes($length));
    }

    public static function hasPermission($url, $method = 'get')
    {
        $method = strtolower($method);
        $splittedUrl = explode('/' . PREFIX, $url);
        if (count($splittedUrl) > 1) {
            $url = $splittedUrl[1];
        } else {
            $url = $splittedUrl[0];
        }
        if (self::authUser()->role->id == 1) {
            $permissionDeniedToSuperUserRoutes = Config::get('cmsConfig.permissionDeniedToSuperUserRoutes');
            $checkDeniedRoute = true;
            foreach ($permissionDeniedToSuperUserRoutes as $route) {
                if (\Str::is($route['url'], $url) && $route['method'] == $method) {
                    $checkDeniedRoute = false;
                }
            }
            return $checkDeniedRoute;
        }

        $permissionIgnoredUrls = Config::get('cmsConfig.permissionGrantedbyDefaultRoutes');

        $check = false;
        foreach ($permissionIgnoredUrls as $piurl) {
            if (\Str::is($piurl['url'], $url) && $piurl['method'] == $method) {
                $check = true;
            }
        }
        if ($check) return true;

        if (self::authUser()->role->permissions == null) {
            return false;
        }

        // $index = this.role.permissions.findIndex(permission => {
        //     let urlPattern = pathToRegexp(permission.url, [])
        //     return urlPattern.test(url) && permission.method == method
        //   })
        //   if(index != -1) return true
        //   return false
    }

    public static function hasPermissionOnModule($module)
    {
    $check = false;
    if(!$module['hasSubmodules']) {
      $check = self::hasPermission($module['route']);
    } else {
      try {
        foreach($module['submodules'] as $submodule) {
          $check = self::hasPermission($submodule['route']);
        }
      } catch (\Exception $e) {
          dd($e);
      }
    }
    return $check;
    }

    public static function showInSideBar($check)
    {
        return $check;
    }

    public static function modules(){
        $modules = Config::get('cmsConfig.modules');
        return $modules;
    }
}
