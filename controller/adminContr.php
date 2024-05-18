<?php 
require_once('../../model/product.php');
require_once('../../model/category.php');
require_once('../../model/order.php');
require_once('../../model/furnisher.php');
$prods = product::allprod();
$cats = category::AllCat();
$furnishers = furnisher::All();
$nb_order = order::getnb();

if (isset($_GET['findpr'])) {
    $pr = '%'.$_GET['findpr'].'%';
    $pr2 = $_GET['findpr'].'%';
    $pr3 = '%'.$_GET['findpr'];
   $search = product::Searchadmin($pr,$pr2,$pr3);
} 
if (isset($_GET['ShoopyAdmin']) && $_GET['ShoopyAdmin']=="clients") {
    $clients = DAO::getAllClients();

} 
if (isset($_GET['ShoopyAdmin']) && $_GET['ShoopyAdmin']=="furnishers") {

    $furnishersAdmin = furnisher::All();
 } 

///orders
if (isset($_GET['status'])) {
    $st = $_GET['status'];
}else{
    $st=0;
}
$orders = order::AllOrderAdmin($st);

?>