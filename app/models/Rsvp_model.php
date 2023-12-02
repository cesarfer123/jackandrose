<?php
/**
 * Rsvp_model class
 */
class Rsvp_model{

    use Model;
    protected $table="rsvp";
    protected $alloweColumns=[
        'name',
        'email',
        'message',
        'attending', 
        'guests', 
        'date',
 
    ];

    public function validate( $post_data,$id=null){

        $this->errors=[];

        $allowed_types=[
            "image/jpeg",
            "image/png",
            "image/gift",
            "image/webp",
        ];


        if(empty($post_data['name'])){
            $this->errors['name']="the name is required";
        }

        if(empty($post_data['email'])){
            $this->errors['email']="the email is required";
        }

        if(empty($post_data['message'])){
            $this->errors['message']="the message is required";
        }

        if(empty($this->errors)){
            return true;
        }
        return false;
    }


    public function create_table(){
        $query="create table if not exists rsvp(
            id int primary key auto_increment,
            name varchar(50) not null,
            email varchar(50) not null,
            message varchar(2048) null,
            attending varchar(1024) null,
            date datetime default current_timestamp not null,
            guests int default 1 not null

        )";

        $this->query($query);

    }
}