<?php
use LazyTranslations\Lib\LazyTranslation;

if (!function_exists('__')) {
    /**
     * Returns a translated string if one is found; Otherwise, the submitted message.
     *
     * @param string $singular Text to translate.
     * @param array  ...$args  Array with arguments or multiple arguments in function.
     * @return string|null The translated text, or null if invalid.
     * @link https://book.cakephp.org/3.0/en/core-libraries/global-constants-and-functions.html#__
     */
    function __($singular, ...$args)
    {
        if (!$singular) {
            return null;
        }

        return new LazyTranslation($singular, $args);
    }
}
