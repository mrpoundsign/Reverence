<?php
/**
 * Created by JetBrains PhpStorm.
 * User: bnelson
 * Date: 4/7/11
 * Time: 3:53 PM
 * To change this template use File | Settings | File Templates.
 */
namespace Reverence\Config;
class ConfigParameterNotFoundException extends \OutOfBoundsException {
}

class ConfigFileNotFoundException extends \RuntimeException {
}

class Config {

    protected static $_config = null;

    protected static function fetch() {
        if (self::$_config === null) {
            $config_file = '../conf/config.json';
            $key = __NAMESPACE__ . $config_file;
            $mtime = filemtime($config_file);
            $fetch = apc_fetch($key, $success);
            if ($success) {
                $conf_info = unserialize($fetch);
                if ($conf_info['mtime'] === $mtime) {
                    $conf = $conf_info['conf'];
                }
                else {
                    $conf = json_decode(file_get_contents('../conf/config.json'), true);
                    apc_store($key, serialize(array('mtime' => $mtime, 'conf' => $conf)));
                }
            }
            else {
                $conf = json_decode(file_get_contents('../conf/config.json'), true);
                apc_add($key, serialize(array('mtime' => $mtime, 'conf' => $conf)));
            }
            if (!$conf) {
                throw new ConfigFileNotFoundException('Could not find config.');
            }
            self::$_config = $conf;
        }
    }

    /**
     * @static
     * @
     * @throws ConfigParameterNotFoundException
     * @return null
     */
    public static function get() {
        self::fetch();
        $argc = \func_num_args();
        $args = \func_get_args();
        $result = self::$_config;
        for ($i = 0; $i < $argc; $i++) {
            $arg = $args[$i];
            if (!array_key_exists($arg, $result)) {
                throw new ConfigParameterNotFoundException();
            }
            $result = $result[$arg];
        }
        return $result;
    }
}
