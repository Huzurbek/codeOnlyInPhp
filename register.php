<?php
    session_start();
    require "functions.php";

    $data=[
        'email'=>$_POST['email'],
        'password'=>password_hash($_POST['password'],PASSWORD_DEFAULT),
        'username'=>'Registered by Email',
        'job_place'=>'Registered by Email',
        'phone_number'=>'Registered by Email',
        'address'=>'Registered by Email',
        'image'=>'',
        'status'=>'success',
        'vk_link'=>'Registered by Email',
        'telegram'=>'Registered by Email',
        'instagram'=>'Registered by Email',
        'is_admin'=>false

    ];

    $user=get_user_by_email('onlyphp',$_POST['email']);

    if(!empty($user)){
        set_flash_message('danger','Этот эл. адрес уже занят другим пользователем.');
        redirect_to('page_register.php');
    }
    add_user('onlyphp',$data);
    set_flash_message('success','Регистрация успешна');
    redirect_to('page_login.php');