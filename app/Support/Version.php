<?php

namespace App\Support;

/**
 * Severus Cues application versioning.
 *
 * The canonical version lives in the repository-root `VERSION` file.
 * When deployed to containers, the file is baked into the image via the
 * Docker build context, so `current()` returns the same value everywhere.
 */
final class Version
{
    /**
     * Current application semantic version.
     */
    public static function current(): string
    {
        static $version = null;

        if ($version !== null) {
            return $version;
        }

        $file = base_path('VERSION');

        $version = (is_readable($file) && ($contents = trim((string) file_get_contents($file))))
            ? $contents
            : 'dev';

        return $version;
    }

    /**
     * Major.minor portion, e.g. "2.0" from "2.0.1".
     */
    public static function short(): string
    {
        $parts = explode('.', self::current());

        return count($parts) >= 2 ? ($parts[0].'.'.$parts[1]) : 'dev';
    }

    /**
     * Machine-safe build descriptor for caching & badges.
     */
    public static function slug(): string
    {
        return 'v'.str_replace(['.', ' '], ['-', '-'], self::current());
    }
}
