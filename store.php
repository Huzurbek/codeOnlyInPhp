<?php
session_start();
require "functions.php";
    $filename=uploadImage($_FILES['image']);
    $status=set_status($_POST['status']);
    $data=[
        'email'=>$_POST['email'],
        'password'=>password_hash($_POST['password'],PASSWORD_DEFAULT),
        'username'=>$_POST['username'],
        'job_place'=>$_POST['job_place'],
        'phone_number'=>$_POST['phone_number'],
        'address'=>$_POST['address'],
        'image'=>$filename,
        'status'=>$status,
        'vk_link'=>$_POST['vk_link'],
        'telegram'=>$_POST['telegram'],
        'instagram'=>$_POST['instagram'],
        'is_admin'=>false

    ];

    $user=get_user_by_email('onlyphp',$_POST['email']);
    if(!empty($user)){
        set_flash_message('danger','Этот эл. адрес уже занят другим пользователем.');
        redirect_to('create_user.php');
    }
    add_user('onlyphp',$data);
        set_flash_message('success','Новый профиль успешно добавлен');
        redirect_to('users.php');

