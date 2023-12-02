<?php
/**
 * Logout Class
 */
class Logout{
    
    use Controller;

    public function index(){
        
        $user=new User();
        $user->logout();
        redirect('home');
    }
}
