<?php
namespace Reverence\Registry;

/**
 * Created by JetBrains PhpStorm.
 * User: bnelson
 * Date: 4/12/11
 * Time: 12:00 AM
 * To change this template use File | Settings | File Templates.
 */
 
class RequestRegistry extends \Reverence\Registry\AbstractRegistry
{
    protected static $instance = null;
    protected $_value_keys = array('authenticator');

    public static function setAuthenticator(\Reverence\Auth\AuthenticatorInterface $authenticator)
    {
        return self::instance()->set('authenticator', $authenticator);
    }

    /**
     * Get the current authenticator
     * 
     * @static
     * @return \PimpLib\Auth\AuthenticatorInterface
     */
    public static function getAuthenticator()
    {
        return self::instance()->get('authenticator');
    }
}
