<?php

class App{

public $controller="home";
public $method="index";

public function getUrl(){
    // obtengo la url que introduce el usuario
    $URL= $_GET['url'] ?? 'home';
    $URL=explode('/',$URL);
    return $URL;
}

public function loadController(){
    // obtengo la url y llamo al controlador para dicha url
    $URL=$this->getUrl();
    $filename="../app/controllers/".ucfirst($URL[0]).".php";
    if(file_exists($filename)){
        require $filename;
        $this->controller=ucfirst($URL[0]);
        unset($URL[0]);
    }else{
        $filename='../app/controllers/_404.php';
        require $filename;
        $this->controller="_404";
    }
    // creo un objeto del controllador
    $controller=new $this->controller;
    // selecionar metodo
    if(!empty($URL[1])){
        if(method_exists($controller,$URL[1])){
            $this->method=$URL[1];
            unset($URL[1]);
        }
    }
    // $URL=array_values($URL);
    // show($URL);
    //  permite llamar a una función de usuario con un array de parámetros
    call_user_func_array([$controller,$this->method],$URL);
}
}

