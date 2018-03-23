<?php
    $user_id=$this->session->userData("user_id");
    /*if(empty($user_id)){
        redirect(base_url());
    }*/
    echo "user_id= ".$user_id;