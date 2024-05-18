<?php

require('../model/user.php');
if (isset($_POST['name'])) {
    $name=$_POST['name'];
    $email=$_POST['email'];
    $pwd=($_POST['password']);
    $tel=$_POST['tel'];
    $ad=$_POST['address'];
    $user = new user($name,$tel,$email,$ad,$pwd);
    if($user->add()) {
        $userinfo = user::getUserByEmail($email);
        foreach ($userinfo as $key) {
            $idus= $key->id_user;
            $ad= $key->address;
        }
session_start();
$_SESSION['id'] = $idus; 
$_SESSION['email'] = $email;
$_SESSION['mobile'] = $tel;
$_SESSION['role'] = 0;
$_SESSION['address'] = $ad;
header('Location:../views/products');
    }
    else{
        return header('Location:/projet_web/views/auth/register.php?msg=failed');
 
    }

}



?>