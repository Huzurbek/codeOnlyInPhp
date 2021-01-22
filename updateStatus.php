<?php
    session_start();
    require "functions.php";
    $status=set_status($_POST['status']);
    $data=[
        'id'=>$_GET['id'],
        'status'=>$status
    ];
     update('onlyphp',$data);
     set_flash_message('success','Статус профиля успешно обновлен');
     redirect_to("users.php");
