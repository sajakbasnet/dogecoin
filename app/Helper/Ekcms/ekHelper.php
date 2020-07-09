<?php

use Illuminate\Support\Facades\Auth;

class ekHelper
{
    public static function hasPermission($url, $method = 'get')
    {
        $method = strtolower($method);
        $splittedUrl = explode('/' . PREFIX, $url);
        if (count($splittedUrl) > 1) {
            $url = $splittedUrl[1];
        } else {
            $url = $splittedUrl[0];
        }
        if (authUser()->role->id == 1) {
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

        if (authUser()->role->permissions == null) {
            return false;
        }

        $permissions = session()->get('role')->permissions;

        foreach ($permissions as $piurl) {
            if (\Str::is($piurl['url'], $url) && $piurl['method'] == $method) {
                $check = true;
            }
        }
        if ($check) return true;
        return false;

    }

    public static function hasPermissionOnModule($module)
    {
        $check = false;
        if (!$module['hasSubmodules']) {
            $check = self::hasPermission($module['route']);
        } else {
            try {
                foreach ($module['submodules'] as $submodule) {
                    $check = self::hasPermission($submodule['route']);
                    if($check == true){
                    break;
                    }
                }
            } catch (\Exception $e) {
                return false;
            }
        }
        return $check;
    }
}
