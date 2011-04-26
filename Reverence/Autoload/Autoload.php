<?php
namespace Reverence\Autoload;
/**
 * Class autoloader, follows SPL specification
 */
class Autoload {
    private static $registries = array();

    /**
     * @static
     * @param  $namespace
     * @param  $path
     * @return void
     */
    public static function register($namespace, $path) {
        self::$registries[$namespace] = $path;
    }

    /**
     * @static
     * @param string $classname the class to load
     * @return
     */
    public static function loader($classname) {
        foreach (self::$registries as $namespace => $path) {
            if (strpos($classname, $namespace) === 0) {
                if (($namespace === $classname) && is_file($path)) {
                    include($path);
                    return;
                }
                else {
                    $classname = substr($classname, strlen($namespace));
                    $file = sprintf('%s/%s.php', $path, str_replace('\\', DIRECTORY_SEPARATOR, $classname));
                    if (is_file($file)) {
                        include($file);
                        return;
                    }
                }
            }
        }
        return;
    }
}

?>