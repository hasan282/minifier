<?php

namespace Hasan282\Minifier\Helper;

class Minify
{
    public static function html(string $content): string
    {
        $rules = [
            ['/<!--.*?-->/', ''],
            ['/>\s+</', '><'],
            ['/\s+/', ' '],
        ];
        foreach ($rules as [$pattern, $replacement]) {
            $content = preg_replace(
                $pattern,
                $replacement,
                $content
            );
        }
        return trim($content);
    }

    public static function script(string $content): string
    {
        $content = preg_replace_callback('/<script\b([^>]*)>(.*?)<\/script>/is', function ($matches) {
            $scriptContent = $matches[2];

            // Remove comments and extra whitespace
            $scriptContent = preg_replace('/\/\/[^\n\r]*|\/\*[\s\S]*?\*\//', '', $scriptContent);

            // Replace multiple whitespace characters with a single space
            $scriptContent = preg_replace('/\s+/', ' ', $scriptContent);

            $symbols = [';', '\(', '\)', '{', '}', ',', '=', ':', '&', '>', '!', '\?', '\|'];

            foreach ($symbols as $symbol) {
                $scriptContent = preg_replace('/' . $symbol . '\s+/', str_replace('\\', '', $symbol), $scriptContent);
                $scriptContent = preg_replace('/\s+' . $symbol . '/', str_replace('\\', '', $symbol), $scriptContent);
            }
            $scriptContent = trim($scriptContent);

            return '<script' . $matches[1] . '>' . $scriptContent . '</script>';
        }, $content);

        return $content;
    }

    public static function style(string $content): string
    {
        $content = preg_replace_callback('/<style\b([^>]*)>(.*?)<\/style>/is', function ($matches) {
            $styleContent = $matches[2];

            // Remove comments and extra whitespace
            $styleContent = preg_replace('/\/\*[\s\S]*?\*\//', '', $styleContent);

            // Replace multiple whitespace characters with a single space
            $styleContent = preg_replace('/\s+/', ' ', $styleContent);

            $symbols = [';', '\{', '\}', ':', ',', '=', '>', '!', '\?', '\|'];

            foreach ($symbols as $symbol) {
                $styleContent = preg_replace('/' . $symbol . '\s+/', str_replace('\\', '', $symbol), $styleContent);
                $styleContent = preg_replace('/\s+' . $symbol . '/', str_replace('\\', '', $symbol), $styleContent);
            }
            $styleContent = trim($styleContent);

            return '<style' . $matches[1] . '>' . $styleContent . '</style>';
        }, $content);

        return $content;
    }

    public static function alpinexdata(string $content): string
    {
        $content = preg_replace_callback('/x-data="([^"]*)"/is', function ($matches) {
            $dataContent = $matches[1];

            // Remove comments and extra whitespace
            $dataContent = preg_replace('/\/\/[^\n\r]*|\/\*[\s\S]*?\*\//', '', $dataContent);

            // Replace multiple whitespace characters with a single space
            $dataContent = preg_replace('/\s+/', ' ', $dataContent);

            return 'x-data="' . trim($dataContent) . '"';
        }, $content);

        return $content;
    }
}
