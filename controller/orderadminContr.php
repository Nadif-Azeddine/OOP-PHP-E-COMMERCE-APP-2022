<?php
require_once('../model/order.php');

if (isset($_POST['id_accept_order'])) {
    $id = $_POST['id_accept_order'];
    if (order::updateorderadmin($id,1)) {
        header('Location:../views/admin/orders.php?msg=order accepted');

    }else{
        header('Location:../views/admin/orders.php?msg=failed');

    }
    
}

if (isset($_POST['id_denied_order'])) {
    $id = $_POST['id_denied_order'];
    if (order::updateorderadmin($id,-1)) {
        header('Location:../views/admin/orders.php?msg=order denied');

    }else{
        header('Location:../views/admin/orders.php?msg=failed');

    }
    
}

///