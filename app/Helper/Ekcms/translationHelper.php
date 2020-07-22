<?php

use App\Model\Language;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Cookie;
use Spatie\TranslationLoader\LanguageLine;

function translate($content, $data = [], $group = "backend")
{
    $key = strtolower(trim($content));
    $translations = array_keys(LanguageLine::getTranslationsForGroup(Cookie::get('lang') ?? 'en', $group));
    if (!in_array($key, $translations)) {
        $check = LanguageLine::where('key', $key)->where('group', $group)->exists();
        if ($check) {
            return trans($group . '.' . $key, $data);
        } else {
            if ($key !== "") {
                LanguageLine::create([
                    'group' => $group,
                    'key' => $key,
                    'text' => inserttext($content, $group),
                ]);
                return $content;
            }
        }
    } else {
        return trans($group . '.' . $key, $data);
    }
}

function inserttext($content, $group)
{
    $languages = Language::where('group', $group)->orderBy('group', 'ASC')->pluck('language_code');
    $text = array();
    foreach ($languages as $language) {
        $text[$language] = $content;
    }
    return $text;
}
