<?php 
require_once("../../controller/facContr.php");
require_once("../../dompdf/autoload.inc.php");
use Dompdf\Dompdf;
$dp = new Dompdf();
$dp->loadHtml(file_get_contents("facgenerate.php"));
$dp->render();
$dp->setPaper("A4","lanscape");
$dp->stream("shoopy.pdf",array("Attachement" => 0));



?>
