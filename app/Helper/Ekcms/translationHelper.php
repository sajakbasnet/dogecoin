<?php

use App\Model\Language;
use Spatie\TranslationLoader\LanguageLine;

function translate($content, $group = "backend")
{
    $key = strtolower($content);
    $check = LanguageLine::where('key', $key)->where('group', $group)->exists();
    if ($check) {
        return trans($group . '.' . $key);
    } else {
        LanguageLine::create([
                'group' => $group,
                'key' => $key,
                'text' => inserttext($content, $group),
        ]);
    }
    return $content;
}

function inserttext($content, $group){
    $languages = Language::where('group', $group)->orderBy('group', 'ASC')->pluck('language_code');
    $text = array();
    foreach($languages as $language){
        $text[$language] = $content;
    }
    return $text;
}
