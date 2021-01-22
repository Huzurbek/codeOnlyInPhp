<?php
//Get user by email:
    function get_user_by_email($table,$email){
        $pdo=new PDO("mysql:host=localhost; dbname=test","root","root");
        $sql="SELECT * FROM $table WHERE email=:email";
        $statement=$pdo->prepare($sql);
        $statement->execute([
            'email'=>$email
        ]);
        $result=$statement->fetch(PDO::FETCH_ASSOC);
        return $result;
    }
//Get User by Id:
    function get_user_by_id($table,$id){
        $pdo=new PDO("mysql:host=localhost; dbname=test","root","root");
        $sql="SELECT * FROM $table WHERE id=:id";
        $statement=$pdo->prepare($sql);
        $statement->execute([
            'id'=>$id
        ]);
        $result=$statement->fetch(PDO::FETCH_ASSOC);
        return $result;
    }
//Add user:
    function add_user($table,$data){
        $pdo=new PDO("mysql:host=localhost; dbname=test","root","root");
        $keys = array_keys($data);
        $stringOfKeys = implode(',', $keys);
        $placeholders = ":" . implode(', :', $keys);
        $sql = "INSERT INTO $table ($stringOfKeys) VALUES ($placeholders)";
        $statement = $pdo->prepare($sql);
        $statement->execute($data);
    }
//Get all users:
    function get_all_user($table){
        $pdo=new PDO("mysql:host=localhost; dbname=test","root","root");
        $sql="SELECT * FROM $table ";
        $statement=$pdo->prepare($sql);
        $statement->execute();
        $result=$statement->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }
//Update:
    function update($table,$data){
        $pdo=new PDO("mysql:host=localhost; dbname=test","root","root");
        $fields = '';
        foreach($data as $key => $value) {
            $fields .= $key . "=:" . $key . ",";
        }
        $fields = rtrim($fields, ',');
        $sql = "UPDATE $table SET $fields WHERE id=:id";
        $statement = $pdo->prepare($sql);
        $result=$statement->execute($data);
        return $result;
    }
//Delete User:
    function deleteUser($table,$id){
        $pdo=new PDO("mysql:host=localhost; dbname=test","root","root");
        $sql="DELETE FROM $table WHERE id=:id";
        $statement=$pdo->prepare($sql);
        $statement->bindParam(':id',$id);
        $statement->execute();
    }
//Login:
    function login($email,$password){
        $user=get_user_by_email('onlyphp',$email);
        if(empty($user)){
            set_flash_message('danger','Логин неверный');
            redirect_to('page_login.php');
        }elseif (!password_verify($password,$user['password'])){
            set_flash_message('danger','Пароль неверный');
            redirect_to('page_login.php');
        }
        $_SESSION['user']=$user;
        redirect_to('users.php');
    }

//Checking Admin status:
    function is_admin($user){
        return $user['is_admin'];
    }
    //Logined User Id:
    function is_auth($logged_user_id,$edit_user_id){
        if($logged_user_id==$edit_user_id){
            return true;
        }
    }
//Upload Image:
    function uploadImage($image){
        $extension=pathinfo($image['name'],PATHINFO_EXTENSION);
        $filename=uniqid().".".$extension;
        move_uploaded_file($image['tmp_name'],"img/demo/avatars/".$filename);
        return $filename;
    }
//Set Status:
    function set_status($status){
        $result='';
        if($status=='Онлайн'){
            $result='success';
        }elseif ($status=='Отошел'){
            $result='warning';
        }elseif ($status=='Не беспокоить'){
            $result='danger';
        }
        return $result;
    }
//Set flash message:
    function set_flash_message($name,$message){
        $_SESSION[$name]=$message;
    }
//Display flash message:
    function display_flash_message($name){
        if(isset($_SESSION[$name])){
            echo "<div class=\"alert alert-{$name} text-{$name}\" role=\"alert\">{$_SESSION[$name]}</div>";
            unset($_SESSION[$name]);
        }
    }
//Redirect to:
    function redirect_to($path){
        header("Location:{$path}");
        exit;
    }