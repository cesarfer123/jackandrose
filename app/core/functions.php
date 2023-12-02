<?php
function show($data){
    echo "<pre>";
    print_r($data);
    echo "</pre>";
}

function esc($str){
    return htmlspecialchars($str);
}

function redirect($path){
    header('Location: ' . ROOT.$path);
    die;
}

function old_value($value,$default=""){

    if(!empty($_POST[$value])){
        
        return $_POST[$value];
    }

    return $default;
}

function old_select($key,$value,$default=''){
    if(!empty($_POST[$key]) && $_POST[$key]==$value){
        return " selected "; 
    }

    if(!empty($default) && $default==$value){
        return " selected ";
    }

    return '';
}

function user($key=''){

    if(!empty($_SESSION['USER'])){
        if(empty($key)){
            return $_SESSION['USER'];
        }
        if(!empty($_SESSION['USER']->$key)){
            return $_SESSION['USER']->$key;
        }

    }

    return '';
}

function get_image($filename=''){
    if(file_exists($filename)){
        return ROOT . $filename;
    }

    return ROOT . 'assets/img/noimage.jpg';
}

function get_date($date){
    return date("jS M, Y",strtotime($date));
}