<?php
    session_start();
    require "functions.php";
    $image=uploadImage($_FILES['image']);
    $data=[
        'id'=>$_GET['id'],
        'image'=>$image
    ];
    update('onlyphp',$data);
    set_flash_message('success','Аватар успешно обновлен');
    redirect_to("users.php");