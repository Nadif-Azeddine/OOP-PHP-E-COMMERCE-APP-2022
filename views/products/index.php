<?php
include('../layouts/header.php');
require_once('../../include/session.php');
require_once('../../controller/getAllprod.php');
$idprod = 0;

?>

<!-- --------------APPRECIATE THE CLIENT  ------------------- -->
<?php if (isset($_GET['ShopyThanksYou'])) :  ?>

    <div class="modal fade show" id="modelId" style="display: block;margin-top:5% ;" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-modal="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content" style="box-shadow: 0px 0px 20px #44444458;">

                <div style="display: flex;justify-content: center;align-items: center;padding: 2rem 0px;flex-direction: column;background: var(--bglin);" class="modal-body">
                    <h1 style="font-weight: 700; color: var(--color4);">THANK YOU</h1>
                    <p style="width: 40ch;text-align: center;font-size: .8em;margin-top: -10px;color: var(--color4);">Lorem ipsum dolor sit amet consectetur adipisicing elit. Perferendis, error!</p>
                    <a href="?" class="btn-eee" style="background:none ;border:1px solid var(--color4);width: 90%;">ok</a>
                </div>

            </div>
        </div>
    </div>

<?php endif ?>







<!-- --------------APPRECIATE THE CLIENT  ------------------- -->








<div class="all-product">

    <div class="search">
        <form action="" method="GET" style="width: 50%;" method="post">
            <input style="width: 100%;" class="form-control" type="text" name="findpr" required placeholder="search">
            <button class="btn-eee" style="width: fit-content;border-radius:0px 5px 5px 0px;"><i class="fa fa-search" aria-hidden="true"></i></button>
        </form>
    </div>
    <?php if (isset($_GET['msg'])) :  ?>
        <div class="alert" role="alert">
            <?= $_GET['msg'] ?>
        </div>
    <?php endif ?>


    <?php if ($orders_valide_nb > 0 && !isset($_GET['findpr'])  && !isset($_GET['msg']) ) :  ?>
        <div class="order-valide-notify">
            <button onclick="closeAlert()" class="close-alert">&times;</button>
            <p>you have <?= $orders_valide_nb ?> valide orders, click on the green button bellow to get the facture.</p>
            <img src="../../public/photos/sys/Credit Card Payment-cuate.svg" width="130%" height="130%" alt="illustration">
        </div>


    <?php endif ?>


    <?php if (isset($_GET['findpr']) && $_GET['findpr'] != "") :  ?>

        <h4 class="text-center" style="color: var(--color2);font-weight: 600;">your results </h4>
        <p style="font-size: .8em;margin-top:-5px;" class="text-center">these are the all result of your search about <span style="color: var(--color2);font-weight: 600;font-size: 1em;"><?= $_GET['findpr'] ?></span> </p>
        <a href="?" style="z-index: 100;
position: relative;width:100;display: inherit;color:var(--color3);margin: 0px auto;background: var(--color4);padding:2px;border:1px solid var(--color2);font-weight: 600;" class="btn-eee">OK</a>

        <?php if (empty($search)) :  ?>
            <div class="img-search-none">
                <img src="../../public/photos/sys/Search-cuate-1.svg" width="100%" height="100%" alt="">
            </div>

        <?php endif ?>

        <div style="margin-top: .5rem;" class="all-news">
            <?php foreach ($search as $prod) : ?>
                <div class="all-card">
                    <div class="price">
                        <p style=" "><?= $prod->price ?> <span style="color: var(--color4);">DH</span> </p>
                    </div>

                    <div style="background: url(../../public/photos/products/<?= $prod->pic_dir ?>)" class="img-card">
                    </div>
                    <div class="txt-card">
                        <h4 style=""><?= $prod->name ?></h4>
                        <p><?= $prod->description ?></p>
                    </div>
                    <div class="action-card">

                        <button class="btn-action" data-bs-toggle="modal" data-bs-target="#modalorder<?= $idprod ?>"><i class="fa fa-shopping-bag" aria-hidden="true"></i></button>

                    </div>

                </div>
                <div class="modal fade" id="modalorder<?= $idprod ?>" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
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
                                    <form style="width: 100%;background: none;" action="../../controller/allprodContr.php" method="POST" enctype="multipart/form-data" class="form-eee">

                                        <div class="labinp">
                                            <label for="nb">Number : </label><input name="num_order" placeholder=" number of item" id="inputNb<?= $idprod ?>" required type="number" onkeyup="checkStock(<?= $prod->current_stock ?>,<?= $idprod ?>)" min="1" max="<?= $prod->current_stock ?>" class="form-control">
                                        </div>

                                        <div class="labinp">
                                            <label for="address">address : </label>
                                            <textarea placeholder="enter an address" name="address_order" required id="address" rows="1" class="form-control"><?= $_SESSION['address'] ?></textarea>

                                        </div>
                                        <input type="hidden" name="id_client_order" value="<?= $_SESSION['id'] ?>">
                                        <input type="hidden" name="id_prod_order" value="<?= $prod->id_prod ?>">
                                        <input type="hidden" name="id_prod_order_pr" value="<?= $prod->price ?>">


                                        <div style="margin-top: 10px;" class="labinp">
                                            <button style="width: 100%;background: var(--bglin);color: white;" class="btn-eee"><i class="fa fa-shopping-bag" aria-hidden="true"></i></button>
                                        </div>

                                        <p style="font-size: .8em;text-align: center;">Lorem ipsum dolor sit amet consectetur.
                                        </p>
                                    </form>


                                </div>



                            </div>

                        </div>
                    </div>
                </div>


            <?php $idprod++;
            endforeach; ?>

        </div>



    <?php endif ?>
    <div style="padding: 1rem; display:flex ;justify-content: space-between;align-items: center;">
        <div>
            <h1 style="font-weight: 700;"><span style="color: var(--color2);">Discover</span> and <span style="color: var(--color2);">Buy</span> !</h1>
            <p style="font-size: .9em;margin-top: -.6rem;">Lorem ipsum dolor sit amet consectetur adipisicing elit. Sunt,
                deserunt!</p>
        </div>
        <div style=" display:flex ;justify-content: center;align-items: center">

            <?php if ($orders_valide_nb == 0 && $nb_orders ==0) :  ?>
                <img src="../../public/photos/sys/Shopping-cuate.svg" id="img-prods-right" width="160px" height="160px" alt="img" draggable="false" >

            <?php endif ?>    


            <!-- modal order valide-->
            <?php if ($orders_valide_nb > 0) :  ?>
                <button type="button" id="btn-valide" data-bs-toggle="modal" data-bs-target="#modelordermadevalide">
                    <i class="fa fa-check-circle" aria-hidden="true"></i>
                        <div class="notify"> <span style="font-size: 1.3em;"><?= $orders_valide_nb ?></span></i></div>
                </button>
                <div class="modal fade" id="modelordermadevalide" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Your Valide orders</h5>
                                <button style="background:none" data-bs-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div style="   max-height: 500px; overflow-y: auto;" class="modal-body">

                                <div class="allorders">
                                    <?php foreach ($orders_valide as $order) : ?>
                                        <div class="the-order">
                                            <div style="background: url('../../public/photos/products/<?= $order->pic_dir ?>');" class="img-order"></div>
                                            <div class="txt" style="margin-bottom: 30px;">
                                                <h5><?= $order->name ?></h5>
                                                <h6 style="margin-top: -.5rem;"><?= $order->price ?> DH</h5>
                                                    <p style="margin-top: -.5rem ;"><?= $order->items ?> items</p>
                                            </div>
                                            <div class="get-fac">
                                                <form style="width: 90%;" action="../../controller/facContr.php" method="POST">
                                                    <input type="hidden" name="facorder" value="<?= $order->id_order ?>">
                                                    <input type="hidden" name="facprod" value="<?= $order->name ?>">
                                                    <input type="hidden" name="facquant" value="<?= $order->items ?>">
                                                    <input type="hidden" name="facprice" value="<?= $order->full_price ?>">
                                                    <input type="hidden" name="facdate" value="<?= $order->date_order ?>">
                                                    <button style="width: 100%;background: none;border:1px solid var(--color4);padding: 2px;" class="btn-eee">facture</button>
                                                </form>

                                            </div>
                                        </div>
                                    <?php endforeach ?>



                                </div>


                            </div>

                        </div>
                    </div>
                </div>


            <?php endif ?>
            <!-- modal order valide-->

            <!-- Modal orders made-->
            <?php if ($nb_orders > 0) : ?>
                <button type="button" id="btn-save" data-bs-toggle="modal" data-bs-target="#modelordermade">
                    <i class="fa fa-shopping-basket" aria-hidden="true"></i>
                        <div class="notify"> <span style="font-size: 1.3em;"><?= $nb_orders ?></span></i></div>
                   
                </button>
                <div class="modal fade" id="modelordermade" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Your Orders</h5>
                                <button style="background:none" data-bs-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div style="   max-height: 500px; overflow-y: auto;" class="modal-body">

                                <div class="allorders">
                                    <?php foreach ($orders as $order) : ?>
                                        <div class="the-order">
                                            <div style="background: url('../../public/photos/products/<?= $order->pic_dir ?>');" class="img-order"></div>
                                            <div class="txt">
                                                <h5><?= $order->name ?></h5>
                                                <h6 style="margin-top: -.5rem;"><?= $order->full_price ?> DH</h5>
                                                    <p style="margin-top: -.5rem ;"><?= $order->items ?> item</p>
                                            </div>
                                            <div class="cancel-order">
                                                <form action="../../controller/allprodContr.php" method="POST">
                                                    <input type="hidden" name="id_order_cancel" value="<?= $order->id_order ?>">
                                                    <input type="hidden" name="nb_order_cancel" value="<?= $order->items ?>">
                                                    <input type="hidden" name="id_order_prod_cancel" value="<?= $order->id_prod ?>">
                                                    <button class="btn-eee">&times;</button>


                                                </form>
                                            </div>
                                        </div>
                                    <?php endforeach ?>



                                </div>


                            </div>

                        </div>
                    </div>
                </div>
            <?php endif ?>
            <!-- Modal orders made-->



        </div>

    </div>


    <?php foreach ($cats as $cat) : ?>
        <div style="padding: 0px 2rem;">
            <h4 style="color: var(--color3);font-weight: 600;"> <?= $cat->cat_name ?></h4>
            <p style="font-size: .9em;margin-top: -1rem;"><?= $cat->cat_desc ?></p>

        </div>
        <div class="all-news">


            <?php foreach ($prods as $prod) : ?>
                <?php if ($prod->cat == $cat->id_cat && $prod->current_stock != 0) : ?>

                    <div class="all-card">
                        <div class="price">
                            <p style=" "><?= $prod->price ?> <span style="color: var(--color4);">DH</span> </p>
                        </div>

                        <div style="background: url(../../public/photos/products/<?= $prod->pic_dir ?>)" class="img-card">
                        </div>
                        <div class="txt-card">
                            <h4 style=""><?= $prod->name ?></h4>

                            <p><?= $prod->description ?></p>
                            <h6 style="font-weight: 700 !important;color: var(--color2);margin-top: -5px;"><?= $prod->current_stock ?>
                                available</h6>
                        </div>
                        <div class="action-card">

                            <button class="btn-action" data-bs-toggle="modal" data-bs-target="#modalorder<?= $idprod ?>"><i class="fa fa-shopping-bag" aria-hidden="true"></i></button>

                        </div>

                    </div>
                    <div class="modal fade" id="modalorder<?= $idprod ?>" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
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
                                        <form style="width: 100%;background: none;" action="../../controller/allprodContr.php" method="POST" enctype="multipart/form-data" class="form-eee">

                                            <div class="labinp">
                                                <label for="nb">nb items : </label><input name="num_order" placeholder=" number of item" required type="number" id="inputNb<?= $idprod ?>" min="1" onkeyup="checkStock(<?= $prod->current_stock ?>,<?= $idprod ?>)" max="<?= $prod->current_stock ?>" class="form-control">
                                            </div>

                                            <div class="labinp">
                                                <label for="address">address : </label>
                                                <textarea placeholder="enter an address" name="address_order" required id="address" rows="1" class="form-control"><?= $_SESSION['address'] ?></textarea>

                                            </div>
                                            <input type="hidden" name="id_client_order" value="<?= $_SESSION['id'] ?>">
                                            <input type="hidden" name="id_prod_order" value="<?= $prod->id_prod ?>">
                                            <input type="hidden" name="id_prod_order_pr" value="<?= $prod->price ?>">


                                            <div style="margin-top: 10px;" class="labinp">
                                                <button style="width: 100%;background: var(--bglin);color: white;" class="btn-eee"><i class="fa fa-shopping-bag" aria-hidden="true"></i></button>
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


            <?php $idprod++;
            endforeach; ?>





        </div>
    <?php endforeach; ?>
</div>



</body>