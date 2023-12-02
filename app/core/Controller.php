<?php 

Trait Controller{
    /**
     *  trait :es un mecanismo de reutilización de código que permite la composición de comportamientos en clases de manera similar a la herencia, 
     * pero sin la necesidad de heredar de una única clase base 
     *  
     * */
    public function view($name,$data=[]){
        
        extract($data);
        $filename="../app/views/". $name . ".view.php";
        if(file_exists($filename)){
            
            require $filename;
        }else{
            $filename="../app/views/404.view.php";
            require $filename;
        }
    }
}