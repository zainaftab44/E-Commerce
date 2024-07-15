<?php

require_once 'config/config.php';

class Autoloader {
    private static $classMap = [];
    private static $cacheFile = __DIR__ . DIRECTORY_SEPARATOR . 'cache' . DIRECTORY_SEPARATOR . 'class_map.php';

    public static function register() {
        if (file_exists(self::$cacheFile)) {
            self::$classMap = require self::$cacheFile;
        } else {
            self::initializeClassMap();
            self::cacheClassMap();
        }

        spl_autoload_register([self::class, 'autoload'], true, true);
    }

    private static function initializeClassMap() {
        $baseDir = __DIR__ . '/src/';

        $directories = new RecursiveIteratorIterator(
            new RecursiveDirectoryIterator($baseDir, RecursiveDirectoryIterator::SKIP_DOTS)
        );

        foreach ($directories as $file) {
            if ($file->isFile() && $file->getExtension() === 'php') {
                $relativePath = str_replace($baseDir, '', $file->getPathname());
                $namespaceClass = str_replace(DIRECTORY_SEPARATOR, '\\', substr($relativePath, 0, -4));
                self::$classMap[$namespaceClass] = $file->getPathname();
            }
        }
    }

    private static function cacheClassMap() {
        file_put_contents(self::$cacheFile, '<?php return ' . var_export(self::$classMap, true) . ';');
    }

    public static function autoload($class) {
        if (isset(self::$classMap[$class])) {
            require self::$classMap[$class];
        }
    }
}

Autoloader::register();
