<?php 
if (empty($_SESSION)) {
    header('Location:/projet_web/views/auth/login.php?failed');
}

