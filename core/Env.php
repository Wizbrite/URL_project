<?php

namespace Core {

    /**
     * Lightweight .env file loader.
     *
     * Parses key=value pairs from a .env file and populates
     * $_ENV, $_SERVER, and putenv() so the rest of the app
     * can read them with env('KEY') or getenv('KEY').
     */
    class Env
    {
        /**
         * Load the .env file from the given directory path.
         *
         * @param string $path Absolute path to the directory containing .env
         * @return void
         */
        public static function load(string $path): void
        {
            $file = rtrim($path, DIRECTORY_SEPARATOR) . DIRECTORY_SEPARATOR . '.env';

            if (!is_readable($file)) {
                return; // Silently skip if no .env exists (e.g. production uses real env vars)
            }

            $lines = file($file, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

            foreach ($lines as $line) {
                // Skip comments
                if (str_starts_with(trim($line), '#')) {
                    continue;
                }

                // Split on the first '=' only
                if (!str_contains($line, '=')) {
                    continue;
                }

                [$key, $value] = explode('=', $line, 2);
                $key   = trim($key);
                $value = trim($value);

                // Strip surrounding quotes (single or double)
                if (
                    (str_starts_with($value, '"') && str_ends_with($value, '"')) ||
                    (str_starts_with($value, "'") && str_ends_with($value, "'"))
                ) {
                    $value = substr($value, 1, -1);
                }

                if (!array_key_exists($key, $_ENV)) {
                    putenv("$key=$value");
                    $_ENV[$key]    = $value;
                    $_SERVER[$key] = $value;
                }
            }
        }
    }
}

namespace {
    /**
     * Helper function to read an env variable with an optional default.
     *
     * @param string $key
     * @param mixed  $default
     * @return mixed
     */
    if (!function_exists('env')) {
        function env(string $key, mixed $default = null): mixed
        {
            $value = $_ENV[$key] ?? getenv($key);
            return ($value !== false && $value !== null) ? $value : $default;
        }
    }

    if (!function_exists('base_url')) {
        /**
         * Build an absolute URL using the APP_URL env variable.
         *
         * On Laragon/Windows set APP_URL=http://localhost/URL_project/public
         * On a Unix vhost set APP_URL=https://yourdomain.com
         *
         * @param string $path Optional path to append (leading slash optional).
         * @return string
         */
        function base_url(string $path = ''): string
        {
            $base = rtrim(env('APP_URL', ''), '/');
            return $path === '' ? $base : $base . '/' . ltrim($path, '/');
        }
    }
}
