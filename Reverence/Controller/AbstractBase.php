<?php
namespace Reverence\Controller;
use Reverence\Registry\RequestRegistry;

abstract class AbstractBase implements \Respect\Rest\Routable {
    const METHOD_GET = 'get';
    const METHOD_POST = 'post';
    const METHOD_PUT = 'put';
    const METHOD_DELETE = 'delete';

    protected $_require_auth = array();

    function __construct() {
        // TODO: Implement __construct() method.
    }

    protected function getGetVar($idx) {
        if (array_key_exists($idx, $_GET)) {
            return $_GET[$idx];
        }
        return null;
    }

    protected function getPostVar($idx) {
        if (array_key_exists($idx, $_POST)) {
            return $_POST[$idx];
        }
        return null;
    }

    protected function handleUnauthRequest() {
        \Reverence\HTTP\Response::status(403);
        echo "Unauthenticated.";
        die();
    }

    protected function init($method) {
        if (in_array($method, $this->_require_auth)) {
            if (!RequestRegistry::getAuthenticator()->isAuthenticated()) {
                $this->handleUnauthRequest();
            }
        }
    }

    function __call($name, $arguments) {
        switch (strtolower($name)) {
            case self::METHOD_GET:
            case self::METHOD_PUT:
            case self::METHOD_POST:
            case self::METHOD_DELETE:
                $this->init($name);
                $method = sprintf('http_%s', $name);
                if (method_exists($this, $method)) {
                    \call_user_func_array(array($this, $method), $arguments);
                }
                else {
                    \Reverence\HTTP\Response::status(405);
                    die();
                }
                break;
        }
    }
}

?>
