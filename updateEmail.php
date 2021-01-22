<?php
    session_start();
    require "functions.php";
    $data=[
        'id'=>$_GET['id'],
        'email'=>$_POST['email'], //user enters new email
        'password'=>password_hash($_POST['password'],PASSWORD_DEFAULT)
    ];

    $current_user_by_id=get_user_by_id('onlyphp',$_GET['id']); //fetch current user info by id from db
    $user=get_user_by_email('onlyphp',$_POST['email']); //fetch user info by his email

    if($user['email']==$current_user_by_id['email']){
        update('onlyphp',$data);
        set_flash_message('success','логин и пароль профиля успешно обновлены');
        redirect_to('users.php');
    }else{
        if(!empty($user)){
              set_flash_message('danger','Этот эл. адрес уже занят другим пользователем.');
              redirect_to("security.php?id=".$_GET['id']);
        }else{
            update('onlyphp',$data);
            set_flash_message('success','логин и пароль профиля успешно обновлены');
            redirect_to('users.php');
        }
    }



