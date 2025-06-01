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
            $scriptContent = preg_replace('/\/\/[^\n\r]*|\/\*[\s\S]*?\*\//', '', $scriptContent);
            $scriptContent = preg_replace('/\s+/', ' ', $scriptContent);
            $scriptContent = preg_replace('/;\s+/', ';', $scriptContent);
            $scriptContent = trim($scriptContent);
            return '<script' . $matches[1] . '>' . $scriptContent . '</script>';
        }, $content);

        return $content;
    }
}
