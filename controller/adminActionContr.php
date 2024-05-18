<?php
require_once('../model/furnisher.php');
require_once('../model/category.php');
require_once('../model/dao.php');

if (isset($_POST['furname'])) {
    $name = $_POST['furname'];
    $email = $_POST['furemail'];
    $tel = $_POST['furtel'];
    $address = $_POST['furaddress'];
    $prod = $_POST['furprod'];
    $prod_p = $_POST['furprodprice'];
    $prod_q = $_POST['furprodquant'];
    $totm= ($_POST['furprodprice'] *$_POST['furprodquant'] );

    $furnisher = new furnisher($name, $email, $tel, $address, $prod_q, $totm);
    $data = DAO::GetidFur($email);
    foreach ($data as $dataa) {
        $id_fur = $dataa->id_fur;
    }

    if ($furnisher->AddFur()) {
        $dao = new DAO;
        $dao->AddAppro($id_fur,$prod,$prod_p,$prod_q);
        
        header('Location:../views/admin?msg=approvisonnement added');
    } else {
        header('Location:../views/admin?msg=failed ');
    }
}

if (isset($_POST['del_cat'])) {
    $id = $_POST['del_cat'];
    if (category::Deletecat($id)) {
        
        header('Location:../views/admin?msg=category deleted successfully&ShoopyAdmin=category');
    } else {
        header('Location:../views/admin?msg=failed category has products&ShoopyAdmin=category ');
    }
    
    
}
if (isset($_POST['up_catname'])) {
    $id = $_POST['up_idcat'];
    $name = $_POST['up_catname'];
    $desc = $_POST['up_catdesc'];
    if (category::Updatecat($id,$name,$desc)) {
        
        header('Location:../views/admin?msg=category updated successfully&ShoopyAdmin=category');
    } else {
        header('Location:../views/admin?msg=failed update category&ShoopyAdmin=category ');
    }
    
    
}