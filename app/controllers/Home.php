<?php
/**
 * Home Class
 */
class Home{
    
    use Controller;

    public function index(){

        $contact=new Contact_model;
        $data['social_links']=$contact->first(['id'=>1]);

        $gallery=new Gallery_model;
        $data['gallery']=$gallery->findAll();
        // show($data['social_links']);die;

        $family=new Family_model;
        $family->order_type="asc";
        $family->order_column="list_order";
        $data['family']=$family->findAll();

        $story=new Story_model;
        // $story->order_type="asc";
        // $story->order_column="list_order";
        $data['stories']=$story->findAll();

        $about=new About_model;
        // $about->order_type="asc";
        // $about->order_column="list_order";
        $data['about']=$about->findAll();

        $setting=new Setting_model;
        $data['settings']=$setting->findAll();

        $data['SETTING']=[];

        if($data['settings']){
            foreach ($data['settings'] as $setting_row) {
                $data['SETTING'][$setting_row->setting]=$setting_row->value;
            }
        }
        // show($data['SETTING']);die;

        $this->view('home',$data);
    }
}
