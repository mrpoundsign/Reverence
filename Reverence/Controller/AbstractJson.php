<?php
namespace Reverence\Controller;
use Reverence\Config\Config;
/**
 * Description of AbstractAjaxHandler
 *
 * @author bnelson
 */
class AbstractJson extends AbstractBase {
    protected $_response = array();
    protected $_errors = array();
    protected $_ok = true;

    protected function assign($name, $value) {
        $this->_response[$name] = $value;
    }

    public function display() {
        if (!array_key_exists('as_text', $_GET)) {
            \Reverence\HTTP\Response::contentType('application/json');
        }
        else
        {
           \Reverence\HTTP\Response::contentType('text/plain');
        }
        $resp = json_encode(
            array(
                 'ok' => $this->_ok,
                 'response' => $this->_response,
                 'errors' => $this->_errors
            )
        );
        if (Config::get('debug')) {
            echo \Reverence\Utils\Json::json_format($resp);
        }
        else {
            echo $resp;
        }
    }
}

?>
