<?php

include('views/layouts/header.php');
require_once('controller/landingContr.php');
$idprod=0;


?>
<div class="all">
    <div style="background:url(public/photos/background/landing/land.svg)" class="pic">
        <!-- <div class="img">
      <img id="img" src="photos/background/landing.png" alt="illustration" width="100%" height="100%">
    </div> -->
        <div class="txt">
            <h1 style="font-size: 5em;font-weight: 700;">MAKE ORDERS</h1>
            <p style="width: 50ch;font-size: .9em;margin-top: -.5rem;">Lorem ipsum dolor, sit amet consectetur
                adipisicing elit. Est delectus numquam sequi excepturi quia impedit provident nesciunt, necessitatibus
                itaque laudantium. Blanditiis doloribus officia eos inventore, dolor reiciendis alias. Consequatur,
                provident.
            </p>
            <a href="views/products" class="btn-eee" style="width: 320px;padding: 7px;">see all</a>
        </div>
    </div>

</div>
<div class="my-3 ">
    <div class="txtnew">
        <h1 class="special-title"> Special Product</h1>
        <p>eligendi nesciunt eveniet dolorum a, aut quo numquam impedit. Deserunt delectus nesciunt quia quidem optio
            dicta earum.</p>
    </div>
    <div class="special-prod">
        <div class="txt">
            <h2 style="font-weight: 600;">The Special Product</h2>
            <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Consequuntur, hic?</p>

        </div>
        <div style="background: url(public/photos/products/10.png);" class="img">

        </div>
    </div>
    <div class="txtnew">
        <h1 class="special-title">New Products</h1>
        <p>eligendi nesciunt eveniet dolorum a, aut quo numquam impedit. Deserunt delectus nesciunt quia quidem optio
            dicta earum.</p>
    </div>
    <div class="all-news m-5">
        <?php foreach ($prod4 as $prod) : ?>

        <div class="all-card">
            <div class="price">
                <p style=" "><?= $prod->price ?> <span style="color: var(--color4);">DH</span> </p>
            </div>

            <div style="background: url(public/photos/products/<?= $prod->pic_dir ?>)" class="img-card">
            </div>
            <div class="txt-card">
                <h4 style=""><?= $prod->name ?></h4>
                <p><?= $prod->description ?></p>
                <h6 style="font-weight: 700 !important;color: var(--color2);margin-top: -5px;"><?= $prod->current_stock ?>
                    available</h6>

            </div>

            <?php if(!empty($_SESSION)): ?>

            <div class="action-card">

                <button class="btn-action" data-bs-toggle="modal" data-bs-target="#modalorder<?= $idprod ?>"><i
                        class="fa fa-shopping-bag" aria-hidden="true"></i></button>

            </div>
            <?php endif; ?>
        </div>
        <?php if(!empty($_SESSION)): ?>

        <div class="modal fade" id="modalorder<?= $idprod ?>" tabindex="-1" role="dialog" aria-labelledby="modelTitleId"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div style="background: var(--bglin);color:white" class="modal-header">
                        <h5 class="modal-title"><?= $prod->name ?></h5>
                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                            &times;
                        </button>
                    </div>
                    <div style="padding: 10px !important;" class="modal-body">
                        <div style="padding:0px;" class="all-form">
                            <form style="width: 100%;background: none;" action="../../controller/allprodContr.php"
                                method="POST" enctype="multipart/form-data" class="form-eee">

                                <div class="labinp">
                                    <label for="nb">Number : </label><input name="num_order"
                                        placeholder=" number of item"  id="inputNb<?= $idprod ?>" onkeyup="checkStock(<?= $prod->current_stock ?>,<?= $idprod ?>)" required type="number" min="1" max="<?= $prod->current_stock ?>"
                                        class="form-control">
                                </div>

                                <div class="labinp">
                                    <label for="address">address : </label>
                                    <textarea placeholder="enter an address" name="address_order" required id="address"
                                        rows="1" class="form-control"><?= $_SESSION['address'] ?></textarea>

                                </div>
                                <input type="hidden" name="id_client_order" value="<?= $_SESSION['id'] ?>">
                                <input type="hidden" name="id_prod_order" value="<?= $prod->id_prod ?>">
                                <input type="hidden" name="id_prod_order_pr" value="<?= $prod->price ?>">


                                <div style="margin-top: 10px;" class="labinp">
                                    <button style="width: 100%;background: var(--bglin);color: white;"
                                        class="btn-eee"><i class="fa fa-shopping-bag" aria-hidden="true"></i></button>
                                </div>

                                <p style="font-size: .8em;text-align: center;">Lorem ipsum dolor sit amet consectetur.
                                </p>
                            </form>


                        </div>



                    </div>

                </div>
            </div>
        </div>
        <?php endif; ?>


        <?php 
      $idprod++; endforeach; ?>


    </div>
</div>


<footer class="landing-footer">
    <h1 class="special-title" style="color: var(--color4);">SHOOPY</h1>
    <div class="ftp">
        <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Quibusdam dolorem praesentium soluta dicta
            accusamus ea nesciunt optio. Architecto totam qui voluptatum natus! Veniam dolor recusandae
            praesentium hic eligendi, quaerat id!</p>
        <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Quibusdam dolorem praesentium soluta dicta
            accusamus ea nesciunt optio. Architecto totam qui voluptatum natus! Veniam dolor recusandae
            praesentium hic eligendi, quaerat id!</p>
        <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Quibusdam dolorem praesentium soluta dicta
            accusamus ea nesciunt optio. Architecto totam qui voluptatum natus! Veniam dolor recusandae
            praesentium hic eligendi, quaerat id!</p>
    </div>
</footer>

</body>