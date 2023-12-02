<?php
/**
 * Admin Class
 */
class Admin{
    
    use Controller;

    public function index(){ 
        $user=new User();
        if(!$user->logged_in()){
            redirect('login');
        }
        $data['total_users']=$user->get_row('select count(*) as total from users');
        $data['total_images']=$user->get_row('select count(*) as total from gallery');
        $data['total_rsvp']=$user->get_row('select count(*) as total from rsvp');
        // show($data['total_users']);die;
        $this->view('admin/dashboard',$data);
    }

    public function users($action=null,$id=null){

        $user=new User();
        if(!$user->logged_in()){
            redirect('login');
        }
        $data['action']=$action;
        $data['rows']=$user->findAll();

        if($action=="new"){

            if($_SERVER['REQUEST_METHOD']=="POST"){
    
                if($user->validate($_POST)){
                    
                    $_POST['password']=password_hash($_POST['password'],PASSWORD_DEFAULT);
                    $user->insert($_POST);
                    
                    redirect('admin/users');
                }
            }
        }elseif($action=="edit"){

            $data['row']=$user->first(['id'=>$id]);

            if($_SERVER['REQUEST_METHOD']=="POST"){
    
                if($user->validate($_POST,$id)){
                    if(empty($_POST['password'])){
                        unset($_POST['password']);
                    }else{
                        $_POST['password']=password_hash($_POST['password'],PASSWORD_DEFAULT);
                    }
                    $user->update($id,$_POST);
                    
                    redirect('admin/users');
                }
            }
        }elseif($action=="delete"){

            $data['row']=$user->first(['id'=>$id]);

            if($_SERVER['REQUEST_METHOD']=="POST"){
                  
                $user->delete($id);
                
                redirect('admin/users');
                
            }
        }

        $data['errors']=$user->errors;
        
        $this->view('admin/users',$data);
    }

    public function gallery($action=null,$id=null){

        $user=new User();
        $gallery=new Gallery_model;
        if(!$user->logged_in()){
            redirect('login');
        }
        $data['action']=$action;
        $data['rows']=$gallery->findAll();

        if($action=="new"){

            if($_SERVER['REQUEST_METHOD']=="POST"){
                $folder="uploads/";
                if(!file_exists($folder)){
                    mkdir($folder,0777,true);
                }
                if($gallery->validate($_FILES)){
                    $destination=$folder . time() . $_FILES['image']['name'];
                    move_uploaded_file($_FILES['image']['tmp_name'],$destination);
                    $_POST['image']=$destination;
                    $gallery->insert($_POST);

                    redirect('admin/gallery');
                }
            }
        }elseif($action=="edit"){

            $data['row']=$gallery->first(['id'=>$id]);

            if($_SERVER['REQUEST_METHOD']=="POST"){

                $folder="uploads/";
                if(!file_exists($folder)){
                    mkdir($folder,0777,true);
                }
                if($gallery->validate($_FILES,$id)){
                    
                    $destination=$folder . time() . $_FILES['image']['name'];
                    move_uploaded_file($_FILES['image']['tmp_name'],$destination);
                    $_POST['image']=$destination;

                    $gallery->update($id,$_POST);

                    if(file_exists($data['row']->image)){
                        unlink($data['row']->image);
                    }   
                    
                    redirect('admin/gallery');
                }
            }
        }elseif($action=="delete"){

            $data['row']=$gallery->first(['id'=>$id]);

            if($_SERVER['REQUEST_METHOD']=="POST"){
                  
                $gallery->delete($id);
                if(file_exists($data['row']->image)){
                    unlink($data['row']->image);
                } 
                redirect('admin/gallery');
                
            }
        }

        $data['errors']=$gallery->errors;
        
        $this->view('admin/gallery',$data);
    }

    public function family($action=null,$id=null){

        $user=new User();
        $family=new Family_model;
        if(!$user->logged_in()){
            redirect('login');
        }
        $data['action']=$action;
        $data['rows']=$family->findAll();

        if($action=="new"){

            if($_SERVER['REQUEST_METHOD']=="POST"){
                $folder="uploads/";
                if(!file_exists($folder)){
                    mkdir($folder,0777,true);
                }
                if($family->validate($_FILES,$_POST)){
                    $destination=$folder . time() . $_FILES['image']['name'];
                    move_uploaded_file($_FILES['image']['tmp_name'],$destination);


                    $image_class=new Image;
                    $image_class->resize($destination,100);

                    $_POST['image']=$destination;
                    $family->insert($_POST);

                    redirect('admin/family');
                }
            }
        }elseif($action=="edit"){

            $data['row']=$family->first(['id'=>$id]);

            if($_SERVER['REQUEST_METHOD']=="POST"){
                
                $folder="uploads/";
                if(!file_exists($folder)){
                    mkdir($folder,0777,true);
                }
                if($family->validate($_FILES,$_POST,$id)){

                    if(!empty($_FILES['image']['name'])){

                        $destination=$folder . time() . $_FILES['image']['name'];
                        move_uploaded_file($_FILES['image']['tmp_name'],$destination);
                    
                        $image_class=new Image;
                        $image_class->resize($destination,100);

                        $_POST['image']=$destination;

                        if(file_exists($data['row']->image)){
                            unlink($data['row']->image);
                        }   
                    }
                    
                    $family->update($id,$_POST);
                    
                    redirect('admin/family');
                }
            }
        }elseif($action=="delete"){

            $data['row']=$family->first(['id'=>$id]);

            if($_SERVER['REQUEST_METHOD']=="POST"){
                  
                $family->delete($id);
                if(file_exists($data['row']->image)){
                    unlink($data['row']->image);
                } 
                redirect('admin/family');
                
            }
        }

        $data['errors']=$family->errors;
        
        $this->view('admin/family',$data);
    }

    public function settings($action=null,$id=null){

        $user=new User();
        $setting=new Setting_model;
        $setting->create_table();
        if(!$user->logged_in()){
            redirect('login');
        }
        $data['action']=$action;
        $data['rows']=$setting->findAll();

        if($action=="new"){

            if($_SERVER['REQUEST_METHOD']=="POST"){
                $folder="uploads/";
                if(!file_exists($folder)){
                    mkdir($folder,0777,true);
                }
                if($setting->validate($_FILES,$_POST)){
                    // $destination=$folder . time() . $_FILES['image']['name'];
                    // move_uploaded_file($_FILES['image']['tmp_name'],$destination);


                    // $_POST['image']=$destination;
                    $setting->insert($_POST);

                    redirect('admin/settings');
                }
            }
        }elseif($action=="edit"){

            $data['row']=$setting->first(['id'=>$id]);

            if($_SERVER['REQUEST_METHOD']=="POST"){
                
                $folder="uploads/";
                if(!file_exists($folder)){
                    mkdir($folder,0777,true);
                }
                if($setting->validate($_FILES,$_POST,$id)){

                    if(!empty($_FILES['image']['name'])){

                        $destination=$folder . time() . $_FILES['image']['name'];
                        move_uploaded_file($_FILES['image']['tmp_name'],$destination);
                    
                        // $image_class=new Image;
                        // $image_class->resize($destination,100);

                        $_POST['value']=$destination;

                        if(file_exists($data['row']->value)){
                            unlink($data['row']->value);
                        }   
                    }
                    
                    $setting->update($id,$_POST);
                    
                    redirect('admin/settings');
                }
            }
        }elseif($action=="delete"){

            $data['row']=$setting->first(['id'=>$id]);

            if($_SERVER['REQUEST_METHOD']=="POST"){
                  
                $setting->delete($id);
                if(file_exists($data['row']->image)){
                    unlink($data['row']->image);
                } 
                redirect('admin/settings');
                
            }
        }

        $data['errors']=$setting->errors;
        
        $this->view('admin/settings',$data);
    }

    public function story($action=null,$id=null){

        $user=new User();
        $story=new Story_model;
        if(!$user->logged_in()){
            redirect('login');
        }
        $data['action']=$action;
        $data['rows']=$story->findAll();

        if($action=="new"){

            if($_SERVER['REQUEST_METHOD']=="POST"){
                $folder="uploads/";
                if(!file_exists($folder)){
                    mkdir($folder,0777,true);
                }
                if($story->validate($_FILES,$_POST)){
                    $destination=$folder . time() . $_FILES['image']['name'];
                    move_uploaded_file($_FILES['image']['tmp_name'],$destination);


                    // $image_class=new Image;
                    // $image_class->resize($destination,100);

                    $_POST['image']=$destination;
                    $story->insert($_POST);

                    redirect('admin/story');
                }
            }
        }elseif($action=="edit"){

            $data['row']=$story->first(['id'=>$id]);

            if($_SERVER['REQUEST_METHOD']=="POST"){
                
                $folder="uploads/";
                if(!file_exists($folder)){
                    mkdir($folder,0777,true);
                }
                if($story->validate($_FILES,$_POST,$id)){

                    if(!empty($_FILES['image']['name'])){

                        $destination=$folder . time() . $_FILES['image']['name'];
                        move_uploaded_file($_FILES['image']['tmp_name'],$destination);
                    
                        // $image_class=new Image;
                        // $image_class->resize($destination,100);
                        
                        $_POST['image']=$destination;

                        if(file_exists($data['row']->image)){
                            unlink($data['row']->image);
                        }   
                    }
                    
                    $story->update($id,$_POST);
                    
                    redirect('admin/story');
                }
            }
        }elseif($action=="delete"){

            $data['row']=$story->first(['id'=>$id]);

            if($_SERVER['REQUEST_METHOD']=="POST"){
                  
                $story->delete($id);
                if(file_exists($data['row']->image)){
                    unlink($data['row']->image);
                } 
                redirect('admin/story');
                
            }
        }

        $data['errors']=$story->errors;
        
        $this->view('admin/story',$data);
    }

    public function about($action=null,$id=null){

        $user=new User();
        $about=new About_model;
        // $about->create_table();
        if(!$user->logged_in()){
            redirect('login');
        }
        $data['action']=$action;
        $data['rows']=$about->findAll();

        if($action=="new"){

            if($_SERVER['REQUEST_METHOD']=="POST"){
                $folder="uploads/";
                if(!file_exists($folder)){
                    mkdir($folder,0777,true);
                }
                if($about->validate($_FILES,$_POST)){
                    $destination=$folder . time() . $_FILES['image']['name'];
                    move_uploaded_file($_FILES['image']['tmp_name'],$destination);


                    // $image_class=new Image;
                    // $image_class->resize($destination,100);

                    $_POST['image']=$destination;
                    $about->insert($_POST);

                    redirect('admin/about');
                }
            }
        }elseif($action=="edit"){

            $data['row']=$about->first(['id'=>$id]);

            if($_SERVER['REQUEST_METHOD']=="POST"){
                
                $folder="uploads/";
                if(!file_exists($folder)){
                    mkdir($folder,0777,true);
                }
                if($about->validate($_FILES,$_POST,$id)){

                    if(!empty($_FILES['image']['name'])){

                        $destination=$folder . time() . $_FILES['image']['name'];
                        move_uploaded_file($_FILES['image']['tmp_name'],$destination);
                    
                        // $image_class=new Image;
                        // $image_class->resize($destination,100);
                        
                        $_POST['image']=$destination;

                        if(file_exists($data['row']->image)){
                            unlink($data['row']->image);
                        }   
                    }
                    
                    $about->update($id,$_POST);
                    
                    redirect('admin/about');
                }
            }
        }elseif($action=="delete"){

            $data['row']=$about->first(['id'=>$id]);

            if($_SERVER['REQUEST_METHOD']=="POST"){
                  
                $about->delete($id);
                if(file_exists($data['row']->image)){
                    unlink($data['row']->image);
                } 
                redirect('admin/about');
                
            }
        }

        $data['errors']=$about->errors;
        
        $this->view('admin/about',$data);
    }

    public function rsvp($action=null,$id=null){

        $user=new User();
        $rsvp=new Rsvp_model;
        // $rsvp->create_table();
        if(!$user->logged_in()){
            redirect('login');
        }
        $data['action']=$action;
        $data['rows']=$rsvp->findAll();

        if($action=="delete"){

            $data['row']=$rsvp->first(['id'=>$id]);

            if($_SERVER['REQUEST_METHOD']=="POST"){
                  
                $rsvp->delete($id);
                redirect('admin/rsvp');
                
            }
        }

        $data['errors']=$rsvp->errors;
        
        $this->view('admin/rsvp',$data);
    }

    public function contact($action=null,$id=null){

        $user=new User();
        $contact=new Contact_model();

        if(!$user->logged_in()){
            redirect('login');
        }
        $data['action']=$action;
        $contact->limit=1;
        $data['rows']=$contact->findAll();

        if($action=="edit"){

            $data['row']=$contact->first(['id'=>$id]);

            if($_SERVER['REQUEST_METHOD']=="POST"){
    
                // if($contact->validate($_POST,$id)){
                    
                    $contact->update($id,$_POST);
                    
                    redirect('admin/contact');
                // }
            }
        }

        $data['errors']=$contact->errors;
        
        $this->view('admin/contact',$data);
    }
}
