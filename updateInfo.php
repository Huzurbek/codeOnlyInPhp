<?php
    session_start();
    require "functions.php";
    $data=[
        'id'=>$_GET['id'],
        'username'=>$_POST['username'],
        'job_place'=>$_POST['job_place'],
        'phone_number'=>$_POST['phone_number'],
        'address'=>$_POST['address'],
    ];

    update('onlyphp',$data);
    set_flash_message('success','Профиль успешно обновлен.');
    redirect_to("users.php");
