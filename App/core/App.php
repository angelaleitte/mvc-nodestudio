<?php

namespace App\Core;

class App{
    protected $controller = 'home';
    protected $method = 'index';
    protected $params = [];

    public function __construct(){
        //echo "Funcionou!<br>";
        echo "<pre>";
        print_r ($url = $this->parseURL());
        echo "</pre>";

        if(isset($url[2])){
            //quando o site estiver no servidor remoto os indices diminuem -1
            if(file_exists('../App/controllers/'.$url[2].'.php')):
                $this->controller = $url[2];
                unset($url[2]);
            endif;
        }
  

        require_once '../App/controllers/'.$this->controller.'.php';

        $this->controller = new $this->controller;

        if(isset($url[3])):
            if(method_exists($this->controller, $url[3])):
                  $this->method = $url[3];
                  unset($url[2]);
                  unset($url[1]);
            endif;
        endif;

        $this->params = $url ? array_values($url) : [];

        call_user_func_array([$this->controller, $this->method], $this->params);
    }

    public function parseURL(){
        return explode('/', filter_var($_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI'], FILTER_SANITIZE_URL));
    }
}