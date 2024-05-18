<?php   

require('../model/user.php');
if (isset($_POST['email'])) {
    $email = $_POST['email'];
    $pwd = md5($_POST['password']);
     $rl=0;
   
        if (user::isauth($email,$pwd)) {
          $data = user::getUserByEmail($email);
            foreach ($data as $val) {
                $idus = $val->id_user;
                $tell = $val->mobile;
                $name = $val->name;
                $ad = $val->address;
            }
            if(user::Isadmin($idus)){
                $rl=1;
            }
            session_start();
            $_SESSION['id'] = $idus;
            $_SESSION['name'] = $name;
            $_SESSION['email'] = $email;
            $_SESSION['mobile'] = $tell;
            $_SESSION['role'] = $rl;
            $_SESSION['address'] = $ad;
            header('Location:../views/products');
        }
     else {
        header('Location:/projet_web/views/auth/login.php?msg=failed to login');
    }
}







?>