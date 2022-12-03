<?php

namespace app\Core;

class App
{
    protected $controller = 'HomeController';
    protected $method = 'index';
    protected $page404 = false;
    protected $params = [];

    public function __construct()
    {
        $URL_ARRAY = $this->parseUrl();
        $this->getController($URL_ARRAY);
        $this->getMethod($URL_ARRAY);
        $this->getParams($URL_ARRAY);

        call_user_func_array([$this->controller, $this->method], $this->params);
    }

    /**
    * get URL domain site
    *
    * @return array
    */
    private function parseUrl()
    {
        $REQUEST_URI = explode('/', substr(filter_input(INPUT_SERVER, 'REQUEST_URI'), 1));
        return $REQUEST_URI;
    }

    /**
    * check file with name in directory
    *
    * @return array
    */
    private function getController($url)
    {
        if (!empty($url[0]) && isset($url[0])) {
            if (file_exists('../app/Controllers/' . ucfirst($url[0])  . '.php')) {
                $this->controller = ucfirst($url[0]);
            }else{
                $this->page404 = true;
            }
        }

        require '../app/Controllers/' . $this->controller . '.php';
        $this->controller = new $this->controller();
    }

    /**
    * check method in controller
    *
    * @return array
    */
    private function getMethod($url)
    {
        if (!empty($url[1]) && isset($url[1])) {
            if (method_exists($this->controller, $url[1]) && !$this->page404) {
                $this->method = $url[1];
            }else{
                $this->method = 'pageNotFound';
            }
        }
    }

    /**
    * assign variable $params to array
    *
    * @return array
    */
    private function getParams($url)
    {
        if (count($url) > 2) {
            $this->params = array_slice($url, 2);
        }
    }
}