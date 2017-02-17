<?php

class AutoLoad
{
    // PSR-4
    private $prefixLengthsPsr4 = array();
    private $prefixDirsPsr4 = array();
    private $fallbackDirsPsr4 = array();
    private static $loader;

    public static function getLoader()
    {
        if (null === self::$loader) {
            self::$loader = new self();
        }
        $map = require "psr4_load_config.php";
        foreach ($map as $namespace => $path) {
            self::$loader->setPsr4($namespace, $path);
        }
        self::$loader->register(true);
    }

    public function setPsr4($prefix, $paths)
    {
        if (!$prefix) {
            $this->fallbackDirsPsr4 = (array) $paths;
        } else {
            $length = strlen($prefix);
            if ('\\' !== $prefix[$length - 1]) {
                throw new \InvalidArgumentException("A non-empty PSR-4 prefix must end with a namespace separator.");
            }
            $this->prefixLengthsPsr4[$prefix[0]][$prefix] = $length;
            $this->prefixDirsPsr4[$prefix] = (array) $paths;
        }
    }


    public function register($prepend = false)
    {
        spl_autoload_register(array($this, 'loadClass'), true, $prepend);
    }

    public function loadClass($class)
    {
        if($file = $this->findFile($class)){
            include $file;
        }
    }
    public function findFile($class)
    {
        // work around for PHP 5.3.0 - 5.3.2 https://bugs.php.net/50731
        if ('\\' == $class[0]) {
            $class = substr($class, 1);
        }

        $file = $this->findFileWithExtension($class, '.php');

        return $file;
    }


    private function findFileWithExtension($class, $ext)
    {
        // PSR-4 lookup
        $logicalPathPsr4 = strtr($class, '\\', DIRECTORY_SEPARATOR) . $ext;

        $first = $class[0];
        if (isset($this->prefixLengthsPsr4[$first])) {
            foreach ($this->prefixLengthsPsr4[$first] as $prefix => $length) {
                if (0 === strpos($class, $prefix)) {
                    foreach ($this->prefixDirsPsr4[$prefix] as $dir) {
                        if (file_exists($file = $dir . DIRECTORY_SEPARATOR . substr($logicalPathPsr4, $length))) {
                            return $file;
                        }
                    }
                }
            }
        }

        // PSR-4 fallback dirs
        foreach ($this->fallbackDirsPsr4 as $dir) {
            if (file_exists($file = $dir . DIRECTORY_SEPARATOR . $logicalPathPsr4)) {
                return $file;
            }
        }

    }
}