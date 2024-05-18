<?php
include('../layouts/header.php');
require_once('../../include/sess.php');


?>

<div style="margin-top:45px ;" class="all-form">
    <form action="../../controller/loginContr.php" method="POST" class="form-eee">

        <div class="labinp">
            <label for="email">Email : </label><input name="email" required type="email" class="form-control">
        </div>
        <div class="labinp">
            <label for="password">Password : </label><input required name="password" type="password" class="form-control">
        </div>

        <div class="labinp">
            <button style="width: 100%;" class="btn-eee">login</button>

        </div>
        <p style="font-size: .8em;text-align: center;">Lorem ipsum dolor sit amet consectetur adipisicing elit. Sequi, voluptate?</p>
    </form>


</div>