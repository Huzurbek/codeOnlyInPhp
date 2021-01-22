<?php
session_start();
require "functions.php";


deleteUser("onlyphp",$_GET['id']);
set_flash_message('success','Профиль успешно удален');
redirect_to("users.php");
