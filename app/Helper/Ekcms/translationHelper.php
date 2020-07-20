<?php

use App\Model\Language;
use Illuminate\Support\Facades\Cache;
use Spatie\TranslationLoader\LanguageLine;

function translate($content, $group = "backend", $data=[])
{
    $key = trim(strtolower($content));
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
        }
    }
    return $content;
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
