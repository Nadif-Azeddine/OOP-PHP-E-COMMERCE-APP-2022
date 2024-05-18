<?php
require_once('../../model/product.php');
require_once('../../model/category.php');
require_once('../../model/order.php');
//////////////////////////////////////////
$prods = product::AllProd();
$cats = category::AllCatHasProd();
$orders = product::AllUserOrders($_SESSION['id']);
$nb_orders = order::NbOrder($_SESSION['id']);
$orders_valide = order::AllOrderValide($_SESSION['id']);
$orders_valide_nb = order::AllOrderValideCount($_SESSION['id']);
if (isset($_GET['findpr'])) {
    $pr = '%'.$_GET['findpr'].'%';
    $pr2 = $_GET['findpr'].'%';
    $pr3 = '%'.$_GET['findpr'];
   $search = product::Search($pr,$pr2,$pr3);
} 
