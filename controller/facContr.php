<?php
require_once('../model/order.php');
require_once("../FPDF/fpdf.php");
session_start();

if (isset($_POST['facprod'])) {
    $id = $_POST['facorder'];
    $name = $_POST['facprod'];
    $quantity = $_POST['facquant'];
    $price = $_POST['facprice'];
    $date = $_POST['facdate'];

 $pdf = new FPDF();

    if (order::OrdMadeWOFac($id)) {


       
        $pdf->AddPage();
        $pdf->SetFont('courier', 'B', 25);
        $pdf->SetTextColor(33, 115, 186);
        $pdf->Cell(1, 0, "SHOOPY");

        $pdf->SetFont('courier', 'B', 9);
        $pdf->SetTextColor(41, 41, 41);
        $pdf->Cell(70, 10, date("Y/m/d H:i"));

        $pdf->SetFont('courier', 'B', 30);
        $pdf->Cell(-70, 35, "FACTURE");

        $pdf->SetFont('courier', 'B', 12);
        $pdf->Cell(.1, 80, "Client : $_SESSION[name]");
        $pdf->SetFont('courier', 'B', 10);
        $pdf->Cell(.1, 90, "Lorem ipsum dolor sit, amet consectetur adipisicing elit,");
        $pdf->Cell(20, 98, "Architecto totam qui voluptatum natus! Veniam dolor recusandae.");

        $pdf->SetFont('courier', 'B', 15);
        $pdf->Cell(.1, 160, "Produit       :      $name");
        $pdf->Cell(.1, 190, "quantite      :      $quantity");
        $pdf->Cell(.1, 220, "total prix    :      $price DH");
        $pdf->Cell(.1, 250, "date_commande :      $date");

        $pdf->Output("D","ShoopyFac.pdf");

        //  header('Location:../views/products?ShopyThanksYou');
    } else {
        header('Location:../views/products?msg=failed');
    }
}
