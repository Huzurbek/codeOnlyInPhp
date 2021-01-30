<?php
session_start();
require "functions.php";

$id=$_GET['id'];
$user=$_SESSION['user'];
//$admin=is_admin($user);

if($user['id']==$id){
    deleteUser("onlyphp",$_GET['id']);
    redirect_to("page_register.php");
}
    deleteUser("onlyphp",$_GET['id']);
    set_flash_message('success','Профиль успешно удален');
    redirect_to("users.php");

