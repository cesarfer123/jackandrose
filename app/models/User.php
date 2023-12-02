<?php

class User{

    use Model;
    protected $table="users";
    protected $alloweColumns=[
        'username',
        'email',
        'password'
    ];

    public function validate($data,$id=null){

        $this->errors=[];
        if(empty($data['email'])){
            $this->errors['email']='Email is required';
        }else if(!filter_var($data['email'],FILTER_VALIDATE_EMAIL)){
                $this->errors['email']="Email is not valid";
        }else if($this->first(['email'=>$data['email']],['id'=>$id])){
            $this->errors['email']='Email is already in use';
        }
        

        if(!$id && empty($data['password'])){
            $this->errors['password']="Password is required";
        }

        if(empty($data['username'])){
            $this->errors['username']="Username is required";
        }else if(!preg_match("/[a-zA-z]+$/",$data['username'])){
            $this->errors['username']="Username can monly have letters";
        }

        if(empty($this->errors)){
            return true;
        }
        return false;
    }

    public function authenticate($row){
        $_SESSION['USER']=$row;

    }

    public function logout(){
        if(!empty($_SESSION['USER'])){
            unset($_SESSION['USER']);
        }
    }

    public function logged_in(){
        if(!empty($_SESSION['USER']))
            return true;
        
        return false;
    }


    public function create_table(){
        $query="create table if not exists users(
            id int primary key auto_increment,
            username varchar(30) not null,
            password varchar(255) not null,
            email varchar(100) not null,

            key email (email)
        )";

        $this->query($query);
    }
}