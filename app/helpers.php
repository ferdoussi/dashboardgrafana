<?php

use Stichoza\GoogleTranslate\GoogleTranslate;
use Illuminate\Support\Facades\Cache;

if (!function_exists('translate')) {
    function translate($text) {
        $locale = app()->getLocale();

        // إلا كانت اللغة إنجليزية، ما نحتاجوش نترجمو
        if ($locale === 'en') {
            return $text;
        }

        // كنستعملو الـ Cache باش نترجمو الكلمة مرة وحدة ونعقلو عليها (باش الموقع يبقا سريع)
        return Cache::rememberForever("trans_{$locale}_{$text}", function () use ($text, $locale) {
            try {
                $tr = new GoogleTranslate($locale);
                return $tr->translate($text);
            } catch (\Exception $e) {
                // إلا وقع مشكل في الأنترنت، رجع النص الأصلي
                return $text;
            }
        });
    }
}