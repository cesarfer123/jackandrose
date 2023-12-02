<?php 

// cargo las clases automaticamente
spl_autoload_register(function($classname){
    require "../app/models/".ucfirst($classname).".php";
});
// llamo a los archivos necesarios para el desarrollo del sistema
require 'config.php';
require 'functions.php';
require 'Database.php';
require 'Model.php';
require 'Controller.php';
require 'App.php';



 