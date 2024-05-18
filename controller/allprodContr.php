<?php
require_once('../model/product.php');
require_once('../model/category.php');
require_once('../model/order.php');


///////////////////////////////
if(isset($_POST['num_order'])){
    $numorder=$_POST['num_order'];
    $prod=$_POST['id_prod_order'];
    $client=$_POST['id_client_order'];
    $address=$_POST['address_order'];
    $fp = $numorder * $_POST['id_prod_order_pr'];
    $order = new order($client,$prod,$address,$fp,$numorder);
    
    if ($order->AddOrd()) {
        header('Location:../views/products?msg=order added');
    } else {
        header('Location:../views/products?msg=order failed');

    }
    

}

if(isset($_POST['id_order_cancel'])){
    $id=$_POST['id_order_cancel'];
    $nb=$_POST['nb_order_cancel'];
    $prod = $_POST['id_order_prod_cancel'];
    
    if (order::cancelOrd($id,$nb,$prod)) {
        header('Location:../views/products?msg=order canceled successfulley');
    } else {
        header('Location:../views/products?msg=order cancel failed');

    }
       

}


?>