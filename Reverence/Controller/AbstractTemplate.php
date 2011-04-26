<?php
namespace Reverence\Controller;
use Reverence\Config\Config;

abstract class AbstractTemplate extends AbstractBase {
    protected $_errors = array();
    protected $_template = null;
    /** @var \Smarty */
    protected $_smarty = null;

    /**
     * Initiates the template handler
     *
     * @staticvar \Smarty $smarty
     * @return    \Smarty
     */
    protected function smarty() {
        if ($this->_smarty === null) {
            $smarty_config = Config::get('smarty');
            $this->_smarty = new \Smarty();
            $this->_smarty->template_dir = $smarty_config['templatePath'];
            $this->_smarty->compile_dir = $smarty_config['templateCompilePath'];
            if ($smarty_config['debug'] === true) {
                $this->_smarty->debugging = true;
            }
        }
        return $this->_smarty;
    }

    public function setTemplate($template) {
        $this->_template = $template;
    }

    public function getTemplate() {
        return $this->_template;
    }

    /**
     * Assigns a variable to the template
     *
     * @param string $var
     * @param mixed $value
     */
    protected function assign($var, $value) {
        $this->smarty()->assign($var, $value);
    }

    /**
     * Display the template.
     * Should be called after get, post, delete, put calls
     */
    protected function display() {
        $this->assign('baseUrl', Config::get('site', 'baseUrl'));
        $this->assign('errors', $this->_errors);
        $this->smarty()->display($this->getTemplate());
    }
}

?>
