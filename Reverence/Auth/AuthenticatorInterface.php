<?php
namespace Reverence\Auth;
/**
 * Created by JetBrains PhpStorm.
 * User: bnelson
 * Date: 4/11/11
 * Time: 11:34 PM
 * To change this template use File | Settings | File Templates.
 */
 
interface AuthenticatorInterface {
    /**
     * Authentication Checker
     *
     * @static
     * @abstract
     * @return boolean true if the current request is authenticated.
     */
    public function isAuthenticated();
    public function getUser();
    public function getAuthTemplate();
    public function getUserInfo();
}
