<?php
/**
 * Family_model class
 */
class Family_model{

    use Model;
    protected $table="family";
    protected $alloweColumns=[
        'name',
        'title',
        'image',
        'twitter_link',
        'facebook_link', 
        'linkedin_link',
        'instagram_link',     
        'list_order'     
    ];

    public function validate($files_data,$post_data,$id=null){

        $this->errors=[];

        $allowed_types=[
            "image/jpeg",
            "image/png",
            "image/gift",
            "image/webp",
        ];

        if(!$id){

            if(empty($files_data['image']['name'])){
                $this->errors['image']="An image is required";
            }else{
                if(!in_array($files_data['image']['type'],$allowed_types)){
                    $this->errors['image']="Only files of this types are allowed: " . implode(", ",$allowed_types);
                }
            } 
        }else{
            if(!empty($files_data['image']['name'])){
                if(!in_array($files_data['image']['type'],$allowed_types)){
                    $this->errors['image']="Only files of this types are allowed: " . implode(", ",$allowed_types);
                }
            
            } 
        }

        if(empty($post_data['name'])){
            $this->errors['name']="the name is required";
        }

        if(empty($post_data['title'])){
            $this->errors['title']="the title is required";
        }

        if(empty($this->errors)){
            return true;
        }
        return false;
    }


    public function create_table(){
        $query="create table if not exists family(
            id int primary key auto_increment,
            name varchar(50) not null,
            title varchar(50) not null,
            image varchar(1024) null,
            twitter_link varchar(1024) null,
            facebook_link varchar(1024) null,
            linkedin_link varchar(1024) null,
            instagram_link varchar(1024) null,
            list_order int default 0,
 
        )";

        $this->query($query);

    }
}