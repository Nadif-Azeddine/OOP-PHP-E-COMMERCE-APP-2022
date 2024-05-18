<?php

include('../layouts/header.php');
require_once('../../include/sess.php');

?>
    
    
    <div style="margin-top:45px ;" class="all-form">
    <form id="registform" action="../../controller/registerContr.php" method="POST" class="form-eee">
        <div class="labinp">
            <label for="name">Name : </label><input  name="name"  required type="text" class="form-control">
        </div>
        <div class="labinp">
            <label for="tel">Mobile : </label><input  name="tel"  required type="tel" class="form-control">
        </div>
        <div class="labinp">
            <label for="email">Email : </label><input name="email"  required type="email" class="form-control">
        </div>
        <div class="labinp">
            <label for="address">Address : </label><textarea name="address" rows="1" required class="form-control"></textarea>
        </div>
        <div class="labinp">
            <label for="password">Password : </label><input required id="pwd" min="8"  name="password" type="password" class="form-control">
        </div>
        <div class="labinp">
            <label for="checkpwd">Confirm Password : </label><input  required name="checkpwd" id="checkpwd" onkeyup="checkpwwd()" type="password" class="form-control">
        </div>
        <div class="labinp">
            <button style="width: 100%;" class="btn-eee">register</button>

        </div>
        <p style="font-size: .8em;text-align: center;">Lorem ipsum dolor sit amet consectetur adipisicing elit. Sequi, voluptate?</p>
    </form>


</div>
    </body>