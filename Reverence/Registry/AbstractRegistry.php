<?php
namespace Reverence\Registry;
/**
 * Created by JetBrains PhpStorm.
 * User: bnelson
 * Date: 4/8/11
 * Time: 6:40 PM
 * To change this template use File | Settings | File Templates.
 */
 
abstract class AbstractRegistry
{
    protected static $instance = null;
    protected $_values = array();
    protected $_value_keys = array();

    /**
     * Init function to be called when the registry is created for
     * objects that are always required.
     */
    protected function init() {}

    /**
     * @static
     * @return \PimpLib\Registry\AbstractRegistry
     */
    static function instance()
    {
        if (static::$instance === null) {
            static::$instance = new static();
            static::$instance->init();
        }
        return static::$instance;
    }

    protected function get($key)
    {
        if (!in_array($key, static::instance()->_value_keys)) {
            throw new \Exception('Invalid key requested.');
        }
        if (!array_key_exists($key, static::instance()->_values)) {
            throw new \Exception('Key requested before set.');
        }
        return static::instance()->_values[$key];
    }

    protected function set($key, $value)
    {
        if (!in_array($key, static::instance()->_value_keys)) {
            throw new \Exception('Invalid key requested.');
        }
        static::instance()->_values[$key] = $value;
    }
}
