<?php  
 $bj = "/projet_web/public/frameworks/bootstrap/js/bootstrap.min.js";
$bc= "/projet_web/public/frameworks/bootstrap/css/bootstrap.min.css";
$ppr= "/projet_web/public/frameworks/popper.js";
$jq= "/projet_web/public/frameworks/Jquery/jquery.js";
$js= "/projet_web/public/app/app.js";
$css= "/projet_web/public/app/app.css";
$icon="/projet_web/public/fontawesome/css/all.css";
$title="::SHOPY::";
session_start();

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title?></title>
    <script type="text/javascript" src="<?= $ppr?>"></script>
    <script type="text/javascript" src="<?= $jq?>"></script>
    <link rel="stylesheet" type="text/css" href="<?= $bc?>">
    <script src="<?= $bj?>"></script>
    <link rel="shortcut icon" href="" type="image/x-icon">
    <link rel="stylesheet" href="<?= $css?>">
    <link rel="stylesheet" href="<?= $icon?>">
    <script type="text/javascript"  src="<?= $js?>"></script>

<body>

    <nav class="navv">
        <div class="brand">
           shoopy
        </div>
        <ul>
            <?php if (!empty($_SESSION)) : ?>
                <li class="item"><a class="linknav" href="/projet_web/"><i class="fa fa-home" aria-hidden="true"></i></a>  </li>
                <li class="item"><a class="linknav" href="/projet_web/views/products/"><i class="fa fa-shopping-bag" aria-hidden="true"></i></a> </li>
          
            <?php endif ?> 
            <?php if (empty($_SESSION)) : ?>
                <li class="item"><a  class="linknav"  href="/projet_web/views/auth/login.php"><i class="fa-solid fa-arrow-right-from-bracket" aria-hidden="true"></i></a> </li>
                <li class="item"><a class="linknav" href="/projet_web/views/auth/register.php"><i class="fa fa-user-plus" aria-hidden="true"></i></a> </li>
                <?php endif ?> 
                <?php if (!empty($_SESSION) && $_SESSION['role']==1) : ?>
                    <li class="item"><a  class="linknav" href="/projet_web/views/admin"><i class="fas fa-shield"></i></a> </li>
                    <?php endif ?> 
                    <?php if (!empty($_SESSION)) : ?>
                        <li class="item">
                            <a class="linknav" href="/projet_web/views/about.php"><i class="fa fa-info-circle"></i></a>
                        </li>
            
        <li class="item">
        <a id="navbarDropdown"  role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                   <span><i class="fa fa-user"></i></span>
                                </a>
        <div id="dropdown" class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    <p class="dropdown-item" href="/user-profile"><i class="fa fa-user"></i> <span style="margin-right: 5px;"> </span> <?= $_SESSION['name'] ?></p>
                                    <a style="color: var(--color3);" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#modellogout">
                    <i class="fa fa-arrow-right-from-bracket" aria-hidden="true"></i> <span style="margin-right: 5px;"> </span> logout
            </a>
                                    
                                   
                                </div>  
        </li>
        <?php endif ?> 
            
            <!-- Modal logout -->
            

        </ul>
    </nav>
<div class="modal fade" id="modellogout" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Logout</h5>

                        </div>
                        <div class="modal-body">
                            are you sure ? you want to log out!
                        </div>
                        <div class="modal-footer">
                            <button type="button"  class="btn-eee" style="width: 70px;color: var(--color3);background: none;border:1px solid var(--color1)" data-bs-dismiss="modal">Close</button>
                            <a  href="/projet_web/controller/logout.php"   style="width: 70px;color: var(--color4);" class="btn-eee">Logout</a>
                        </div>
                    </div>
                </div>
            </div>