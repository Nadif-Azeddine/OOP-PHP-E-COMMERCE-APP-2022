<?php
include('../layouts/header.php');
require_once("../../include/session.php");
require_once("../../include/sessAdmin.php");
require_once("../../controller/adminContr.php");

$iprod = 0;
$imod = 0;
$i = 1;

?>
<div onclick="togglenav()" class="toggle-nav">
    <button class=""><i class="fas fa-bars   "></i></button>
</div>
<div class="admin-action">
    <div class="admin-self text-center">
        <div class="avatar"></div>
        <h5 style="font-weight: 600;text-transform: capitalize;margin-top: 5px;"><?= $_SESSION['name'] ?></h5>

    </div>



    <div style="width: 100%;padding: 0px;margin-top: 20px;" class="search">
        <form style="width: 100%;align-items: center;" action="" method="GET">
            <input style="width: 100%; height: 35px;border-radius: 10px 0px 0px 10px !important;z-index: 5;" class="form-control" type="text" name="findpr" required placeholder="search">
            <button class="btn-eee" style="width: fit-content;border-radius:0px 10px 10px 0px; height: 35px;"><i class="fa fa-search" aria-hidden="true"></i></button>
        </form>
    </div>
    <!-- Button modal add product -->
    <button type="button" class="btn-eee" style="background: var(--bs-green);color:var(--color4)" data-bs-toggle="modal" data-bs-target="#modeladdprod">
        add product
    </button>
    <!-- button modal add appro -->
    <button type="button" class="btn-eee" style="background: var(--bs-green);color:var(--color4)" data-bs-toggle="modal" data-bs-target="#modeladdappro">
        add approvisionnement
    </button>
    <!--  -->
    <button type="button" class="btn-eee" style="background: var(--bs-green);color:var(--color4)" data-bs-toggle="modal" data-bs-target="#modeladdcat">
        add Category
    </button>

    <!-- Button add  -->
    <button type="button" class="btn-eee" style="color:var(--color4);background: var(--bs-green);" data-bs-toggle="modal" data-bs-target="#modeladdadmin">
        add admins
    </button>
    <!--  -->
    <a style="position: relative;" class="btn-eee" style="background: var(--bglin);color:var(--color4)" href="/projet_web/views/admin/orders.php">
        orders
        <?php if ($nb_order > 0) :  ?>
            <div class="notify" style="left:90%;top:-3px"> <span style="font-size: 1.3em;"><?= $nb_order ?></span></i></div>
        <?php endif ?>
</a>
<a href="/projet_web/views/admin/stat.php" class="btn-eee" style="background: var(--bglin);color:var(--color4)">
    statistics
</a>
</div>

<div class="content-admin">
    <?php if (isset($_GET['msg'])) :  ?>
        <div class="alert" role="alert">
            <?= $_GET['msg'] ?>
        </div>
    <?php endif ?>

    <?php if (isset($_GET['findpr']) && $_GET['findpr'] != "") :  ?>

        <h4 class="text-center" style="color: var(--color2);font-weight: 600;">your results </h4>
        <p style="font-size: .8em;margin-top:-5px;" class="text-center">these are the all result of your search about <span style="color: var(--color2);font-weight: 600;font-size: 1em;"><?= $_GET['findpr'] ?></span> </p>
        <a href="?" style="z-index: 100;position: relative;width:100;display: inherit;color:var(--color3);margin: 0px auto;background: var(--color4);padding:2px;border:1px solid var(--color2);font-weight: 600;" class="btn-eee">OK</a>

        <?php if (empty($search)) :  ?>
            <div class="img-search-none">
                <img src="../../public/photos/sys/Search-cuate-1.svg" width="100%" height="100%" alt="img-no-results">
            </div>
        <?php endif ?>

        <div style="margin:.5rem 0px 2rem 0px;padding: 25px;" class="all-news">
            <?php foreach ($search as $prod) : ?>

                <div class="all-card">
                    <?php if ($prod->current_stock == 0) : ?>
                        <div class="soldout">
                            <p> SOLD OUT </p>
                        </div>

                    <?php endif ?>
                    <div class="price">
                        <p><?= $prod->price ?> <span style="color: var(--color4);">DH</span> </p>
                    </div>

                    <div style="background: url(../../public/photos/products/<?= $prod->pic_dir ?>)" class="img-card">
                        <div class="update-pic">
                            <form id="form_update_prod_pic<?= $iprod ?>" action="../../controller/prodContr.php" method="POST" enctype="multipart/form-data">
                                <input type="hidden" name="id_prod_pic" value="<?= $prod->id_prod ?>">
                                <input type="hidden" name="pic_prod_pic" value="<?= $prod->pic_dir ?>">

                                <label for="update_pic_prod<?= $iprod ?>">update pic</label>
                                <input onchange="submitform(<?= $iprod ?>)" required type="file" name="update_pic_prod" class="update_pic_prod" id="update_pic_prod<?= $iprod ?>">


                            </form>
                        </div>
                    </div>
                    <div class="txt-card">

                        <h4 style=""><?= $prod->name ?></h4>
                        <p><?= $prod->description ?></p>
                        <h6 style="font-weight: 700 !important;color: var(--color2);margin-top: -5px;"><?= $prod->current_stock ?>
                            vailable</h6>

                    </div>
                    <div class="action-card">
                        <button style="width: 45%;margin: 10px 5px;" data-bs-toggle="modal" data-bs-target="#modalupdate<?= $iprod ?>" style="" class="btn-action"><i class="fa fa-pencil" aria-hidden="true"></i></button>
                        <button style="width: 45%;margin: 10px 5px;" data-bs-toggle="modal" data-bs-target="#modeldelete<?= $iprod ?>" class="btn-action"><i class="fa fa-trash-alt" aria-hidden="true"></i></button>

                    </div>

                </div>
                <div class="modal fade" id="modeldelete<?= $iprod ?>" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div style="background:var(--bs-red) ;" class="modal-header">
                                <h5 class="modal-title">delete product</h5>

                            </div>
                            <div class="modal-body">
                                are you sure ? you want to delete <span style="color: var(--bs-red);"><?= $prod->name ?></span>!
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn-eee" style="width: 70px;color: var(--color4);background: var(--color3)" data-bs-dismiss="modal">Close</button>
                                <form id="form_delete<?= $iprod ?>" action="../../controller/prodContr.php" method="post">
                                    <input type="hidden" name="prod_del" value="<?= $prod->id_prod ?>">
                                    <input type="hidden" name="prod_pic_del" value="<?= $prod->pic_dir ?>">

                                </form>
                                <button form="form_delete<?= $iprod ?>" style="width: 70px;color: var(--color4);background: var(--bs-red);" class="btn-eee"><i class="fa fa-trash-alt" aria-hidden="true"></i></button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Modal update product -->
                <div class="modal fade" id="modalupdate<?= $iprod ?>" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Update product</h5>
                                <button data-bs-dismiss="modal">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <div style="padding: 10px;" class="all-form">
                                    <form action="../../controller/prodContr.php" method="POST" enctype="multipart/form-data" class="form-eee">
                                        <input type="hidden" name="up_idprod" value="<?= $prod->id_prod ?>">
                                        <div class="labinp">
                                            <label for="email">Product* : </label><input name="up_prodname" required value="<?= $prod->name ?>" type="text" class="form-control">
                                        </div>
                                        <div class="labinp">
                                            <label for="password">Price* : </label><input required value="<?= $prod->price ?>" name="up_prodprice" type="number" class="form-control">
                                        </div>
                                        <div class="labinp">
                                            <label for="password">Desc* : </label><textarea rows="1" required name="up_proddesc" type="text" class="form-control"><?= $prod->description ?></textarea>
                                        </div>
                                        <div class="labinp">
                                            <label for="password">Stock* : </label><input required value="<?= $prod->current_stock ?>" name="up_prodcurrent_stock" type="number" class="form-control">
                                        </div>


                                        <div style="margin-top: 10px;" class="labinp">
                                            <button style="width: 100%;background: var(--bglin);color: white;" class="btn-eee">Update</button>

                                        </div>
                                        <p style="font-size: .8em;text-align: center;">Lorem ipsum dolor sit amet consectetur.
                                        </p>
                                    </form>


                                </div>
                            </div>

                        </div>
                    </div>
                </div>


            <?php $iprod++;
            endforeach; ?>

        </div>



    <?php endif ?>


    <div class="nav-admin">
        <a href="../admin?ShoopyAdmin=prods" style="background: <?php $retVal = ((isset($_GET['ShoopyAdmin']) && $_GET['ShoopyAdmin'] == 'prods') || !isset($_GET['ShoopyAdmin'])) ? "var(--bs-white);color:var(--color2)" : "none";
                                                                echo ($retVal) ?>;" class="btn-eee">products</a>
        <a href="../admin?ShoopyAdmin=prodstable" style="background: <?php $retVal = (isset($_GET['ShoopyAdmin']) && $_GET['ShoopyAdmin'] == 'prodstable') ? "var(--bs-white);color:var(--color2)" : "none";
                                                                        echo ($retVal) ?>;" class="btn-eee">table of prods</a>
        <a href="../admin?ShoopyAdmin=category" style="background: <?php $retVal = (isset($_GET['ShoopyAdmin']) && $_GET['ShoopyAdmin'] == 'category') ? "var(--bs-white);color:var(--color2)" : "none";
                                                                    echo ($retVal) ?>;" class="btn-eee">categories</a>
        <a href="../admin?ShoopyAdmin=clients" style="background:<?php $retVal = (isset($_GET['ShoopyAdmin']) && $_GET['ShoopyAdmin'] == 'clients') ? "var(--bs-white);color:var(--color2)" : "none";
                                                                    echo ($retVal) ?> ;" class="btn-eee">clients</a>
        <a href="../admin?ShoopyAdmin=furnishers" style="background:<?php $retVal = (isset($_GET['ShoopyAdmin']) && $_GET['ShoopyAdmin'] == 'furnishers') ? "var(--bs-white);color:var(--color2)" : "none";
                                                                    echo ($retVal) ?> ;" class="btn-eee">furnishers</a>

    </div>


    <?php if (!isset($_GET['ShoopyAdmin']) || $_GET['ShoopyAdmin'] == "prods") : ?>
        <div style="margin-top: .5rem;" class="all-news">

            <?php foreach ($prods as $prod) : ?>

                <div class="all-card">
                    <?php if ($prod->current_stock == 0) : ?>
                        <div class="soldout">
                            <p> SOLD OUT </p>
                        </div>

                    <?php endif ?>
                    <div class="price">
                        <p><?= $prod->price ?> <span style="color: var(--color4);">DH</span> </p>
                    </div>

                    <div style="background: url(../../public/photos/products/<?= $prod->pic_dir ?>)" class="img-card">
                        <div class="update-pic">
                            <form id="form_update_prod_pic<?= $iprod ?>" action="../../controller/prodContr.php" method="POST" enctype="multipart/form-data">
                                <input type="hidden" name="id_prod_pic" value="<?= $prod->id_prod ?>">
                                <input type="hidden" name="pic_prod_pic" value="<?= $prod->pic_dir ?>">

                                <label for="update_pic_prod<?= $iprod ?>">update pic</label>
                                <input onchange="submitform(<?= $iprod ?>)" required type="file" name="update_pic_prod" class="update_pic_prod" id="update_pic_prod<?= $iprod ?>">


                            </form>
                        </div>
                    </div>
                    <div class="txt-card">

                        <h4 style=""><?= $prod->name ?></h4>
                        <p><?= $prod->description ?></p>
                    </div>
                    <div class="action-card">
                        <button style="width: 45%;margin: 10px 5px;" data-bs-toggle="modal" data-bs-target="#modalupdate<?= $iprod ?>" style="" class="btn-action"><i class="fa fa-pencil" aria-hidden="true"></i></button>
                        <button style="width: 45%;margin: 10px 5px;" data-bs-toggle="modal" data-bs-target="#modeldelete<?= $iprod ?>" class="btn-action"><i class="fa fa-trash-alt" aria-hidden="true"></i></button>

                    </div>

                </div>
                <div class="modal fade" id="modeldelete<?= $iprod ?>" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div style="background:var(--bs-red) ;" class="modal-header">
                                <h5 class="modal-title">delete product</h5>

                            </div>
                            <div class="modal-body">
                                are you sure ? you want to delete <span style="color: var(--bs-red);"><?= $prod->name ?></span>!
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn-eee" style="width: 70px;color: var(--color4);background: var(--color3)" data-bs-dismiss="modal">Close</button>
                                <form id="form_delete<?= $iprod ?>" action="../../controller/prodContr.php" method="post">
                                    <input type="hidden" name="prod_del" value="<?= $prod->id_prod ?>">
                                    <input type="hidden" name="prod_pic_del" value="<?= $prod->pic_dir ?>">

                                </form>
                                <button form="form_delete<?= $iprod ?>" style="width: 70px;color: var(--color4);background: var(--bs-red);" class="btn-eee"><i class="fa fa-trash-alt" aria-hidden="true"></i></button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Modal update product -->
                <div class="modal fade" id="modalupdate<?= $iprod ?>" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Update product</h5>
                                <button data-bs-dismiss="modal">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <div style="padding: 10px;" class="all-form">
                                    <form action="../../controller/prodContr.php" method="POST" enctype="multipart/form-data" class="form-eee">
                                        <input type="hidden" name="up_idprod" value="<?= $prod->id_prod ?>">
                                        <div class="labinp">
                                            <label for="email">Product* : </label><input name="up_prodname" required value="<?= $prod->name ?>" type="text" class="form-control">
                                        </div>
                                        <div class="labinp">
                                            <label for="password">Price* : </label><input required value="<?= $prod->price ?>" name="up_prodprice" type="number" class="form-control">
                                        </div>
                                        <div class="labinp">
                                            <label for="password">Desc* : </label><textarea rows="1" required name="up_proddesc" type="text" class="form-control"><?= $prod->description ?></textarea>
                                        </div>
                                        <div class="labinp">
                                            <label for="password">Stock* : </label><input required value="<?= $prod->current_stock ?>" name="up_prodstock" type="number" class="form-control">
                                        </div>


                                        <div style="margin-top: 10px;" class="labinp">
                                            <button style="width: 100%;background: var(--bglin);color: white;" class="btn-eee">Update</button>

                                        </div>
                                        <p style="font-size: .8em;text-align: center;">Lorem ipsum dolor sit amet consectetur.
                                        </p>
                                    </form>


                                </div>
                            </div>

                        </div>
                    </div>
                </div>

            <?php $iprod++;
            endforeach; ?>
        </div>
    <?php endif ?>

    <?php if (isset($_GET['ShoopyAdmin']) && $_GET['ShoopyAdmin'] == "prodstable") : ?>
        <table class="table table-inverse table-responsive shoopyt">
            <thead class="thead-inverse">
                <tr style="background: var(--bglin);color: var(--color4);border-radius:10px  ;">
                    <th>id</th>
                    <th>name</th>
                    <th>price</th>
                    <th>current stock</th>
                    <th>category</th>
                    <th>date</th>



                </tr>
            </thead>
            <tbody>
                <?php foreach ($prods as $prod) : ?>
                    <tr>
                        <td><?= $prod->id_prod ?></td>
                        <td><?= $prod->name ?></td>
                        <td><?= $prod->price ?> DH</td>
                        <td><?= $prod->current_stock ?></td>
                        <td><?= $prod->cat ?></td>
                        <td><?= $prod->date_prod ?></td>


                    </tr>
                <?php endforeach ?>

            </tbody>
        </table>

    <?php endif ?>

    <?php if (isset($_GET['ShoopyAdmin']) && $_GET['ShoopyAdmin'] == "clients") : ?>
        <table class="table table-inverse table-responsive shoopyt">
            <thead class="thead-inverse">
                <tr style="background: var(--bglin);color: var(--color4);border-radius:10px  ;">
                    <th>#</th>
                    <th>name</th>
                    <th>email</th>
                    <th>mobile</th>
                    <th>address</th>
                    <th>nb</th>
                    <th>montant</th>
                    <th>since</th>


                </tr>
            </thead>
            <tbody>
                <?php foreach ($clients as $client) : ?>
                    <tr>
                        <td><?= $i ?></td>
                        <td><?= $client->name ?></td>
                        <td><?= $client->email ?></td>
                        <td><?= $client->mobile ?></td>
                        <td><?= $client->address ?></td>
                        <td><?= $client->total_buy ?></td>
                        <td><?= $client->total_montant ?> DH</td>
                        <td><?= $client->date ?></td>


                    </tr>
                <?php $i++;
                endforeach ?>

            </tbody>
        </table>

    <?php endif ?>

    <?php if (isset($_GET['ShoopyAdmin']) && $_GET['ShoopyAdmin'] == "furnishers") : ?>
        <table class="table table-inverse table-responsive shoopyt">
            <thead class="thead-inverse">
                <tr style="background: var(--bglin);color: var(--color4);border-radius:10px  ;">
                    <th>#</th>
                    <th>name</th>
                    <th>email</th>
                    <th>mobile</th>
                    <th>address</th>
                    <th>nb_prod</th>
                    <th>montant</th>
                    <th>since</th>


                </tr>
            </thead>
            <tbody>
                <?php foreach ($furnishers as $fur) : ?>
                    <tr>
                        <td><?= $i ?></td>
                        <td><?= $fur->name_fur ?></td>
                        <td><?= $fur->email ?></td>
                        <td><?= $fur->mobile ?></td>
                        <td><?= $fur->address ?></td>
                        <td><?= $fur->total_prod_buy ?></td>
                        <td><?= $fur->total_montant ?> DH</td>
                        <td><?= $fur->date_add_fur ?></td>


                    </tr>
                <?php $i++;
                endforeach ?>

            </tbody>
        </table>

    <?php endif ?>

    <?php if (isset($_GET['ShoopyAdmin']) && $_GET['ShoopyAdmin'] == "category") : ?>
        <div class="all-catego">
            <?php foreach ($cats as $cat) : ?>
                <div class="the-catego">
                    <h4><?= $cat->cat_name ?></h4>
                    <p style="margin:-.4rem 0rem;font-weight: 600;color: var(--bs-yellow);"><?= $cat->nb_prod ?> prods</p>
                    <p><?= $cat->cat_desc ?></p>

                    <div class="action-cat">
                        <div class="dropdown open">
                            <button class="btn-eee" style="background: var(--color3)" type="button" id="triggerId" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Update
                            </button>
                            <div class="dropdown-menu" aria-labelledby="triggerId">


                                <div style="padding: 10px;" class="all-form">
                                    <form action="../../controller/adminActionContr.php" method="POST" enctype="multipart/form-data" class="form-eee">
                                        <div class="labinp">
                                            <label for="email">name : </label><input name="up_catname" required value="<?= $cat->cat_name ?>" type="text" class="form-control">
                                        </div>
                                        <input type="hidden" name="up_idcat" value="<?= $cat->id_cat ?>">

                                        <div class="labinp">
                                            <label for="password">Desc : </label><textarea rows="1" required name="up_catdesc" type="text" class="form-control"><?= $cat->cat_desc ?></textarea>
                                        </div>


                                        <div style="margin-top: 10px;" class="labinp">
                                            <button style="width: 100%;background: var(--bglin);color: white;" class="btn-eee">Update</button>

                                        </div>

                                    </form>


                                </div>


                            </div>
                        </div>
                        <form action="../../controller/adminActionContr.php" method="POST">
                            <input type="hidden" name="del_cat" value="<?= $cat->id_cat ?>">
                            <button class="btn-eee" style="background: var(--bs-orange);">Delete</button>
                        </form>
                    </div>
                </div>






        <?php endforeach;
        endif ?>
        </div>



</div>










<!-- Modal add product -->
<div class="modal fade" id="modeladdprod" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div style="background: var(--bs-green);color:white" class="modal-header">
                <h5 class="modal-title">Add Product</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    &times;
                </button>
            </div>
            <div class="modal-body">
                <div style="padding: 10px;" class="all-form">
                    <form action="../../controller/prodContr.php" method="POST" enctype="multipart/form-data" class="form-eee">

                        <div class="labinp">
                            <label for="email">Product* : </label><input name="prodname" required type="text" class="form-control">
                        </div>
                        <div class="labinp">
                            <label for="password">Price* : </label><input required name="prodprice" type="number" class="form-control">
                        </div>
                        <div class="labinp">
                            <label for="password">Desc* : </label><textarea rows="1" required name="proddesc" type="text" class="form-control"></textarea>
                        </div>
                        <div class="labinp">
                            <label for="password">Stock* : </label><input required name="prodstock" type="number" class="form-control">
                        </div>
                        <div class="labinp">
                            <label for="cat_prod">Category* : </label>
                            <select required class="form-control" name="cat_prod" id="cat_prod">
                                <?php foreach ($cats as $cat) : ?>
                                    <option value="<?= $cat->id_cat ?>"><?= $cat->cat_name ?></option>
                                <?php endforeach ?>
                            </select>
                        </div>
                        <div class="labinp">
                            <label for="password">Pic : </label><input required name="prodpic" type="file" class="form-control">
                        </div>

                        <div style="margin-top: 10px;" class="labinp">
                            <button style="width: 100%;background: var(--bs-green);color: white;" class="btn-eee">add</button>

                        </div>
                        <p style="font-size: .8em;text-align: center;">Lorem ipsum dolor sit amet consectetur.</p>
                    </form>


                </div>



            </div>

        </div>
    </div>
</div>
<!-- Modal add product -->

<!-- modal add approvisionnement -->
<div class="modal fade" id="modeladdappro" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div style="background: var(--bs-green);color:white" class="modal-header">
                <h5 class="modal-title">Add appro</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    &times;
                </button>
            </div>
            <div class="modal-body">
                <div style="padding: 10px;" class="all-form">
                    <form action="../../controller/adminActionContr.php" method="POST" enctype="multipart/form-data" class="form-eee">
                        <div class="labinp">
                            <p style="font-size: .9em;"><b>NOTE: </b> you can shoose from the old furnishers by selcting, or add a new one by enter the informations below</p>
                            <label for="selectfur">SHOOPY's furnishers</label><select id="selectfur" class="form-control">
                                <?php foreach ($furnishers as $fur) : ?>
                                    <option onclick="selectfurnisher('<?= $fur->name_fur ?>','<?= $fur->email ?>','<?= $fur->mobile ?>','<?= $fur->address ?>')"><?= $fur->name_fur ?></option>
                                <?php endforeach ?>

                            </select>
                        </div>
                        <hr>

                        <div class="labinp">
                            <label for="email">Furnisher's name : </label><input name="furname" id="furname" required type="text" class="form-control">
                        </div>
                        <div class="labinp">
                            <label for="email">Furnisher's email : </label><input name="furemail" id="furemail" required type="email" class="form-control">
                        </div>
                        <div class="labinp">
                            <label for="email">Furnisher's tel : </label><input name="furtel" id="furtel" required type="tel" class="form-control">
                        </div>
                        <div class="labinp">
                            <label for="email">Furnisher's address : </label><textarea name="furaddress" id="furaddress" rows="1" required type="text" class="form-control"></textarea>
                        </div>
                        <div class="labinp">
                            <label for="password">Product : </label><input required name="furprod" type="text" class="form-control">
                        </div>
                        <div class="labinp">
                            <label for="password">price buy : </label><input required name="furprodprice" type="number" class="form-control">
                        </div>
                        <div class="labinp">
                            <label for="password">quantity : </label><input rows="1" required name="furprodquant" type="number" class="form-control">
                        </div>


                        <div style="margin-top: 10px;" class="labinp">
                            <button style="width: 100%;background: var(--bs-green);color: white;" class="btn-eee">add</button>

                        </div>
                        <p style="font-size: .8em;text-align: center;">Lorem ipsum dolor sit amet consectetur.</p>
                    </form>


                </div>



            </div>

        </div>
    </div>
</div>
<!-- modal add approvisionnement -->



<!-- Modal add admin -->
<div class="modal fade" id="modeladdadmin" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div style="background: var(--bs-green);color:white" class="modal-header">
                <h5 class="modal-title">Add Admin</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    &times;
                </button>
            </div>
            <div class="modal-body">
                <div style="padding: 10px;" class="all-form">
                    <form action="../../controller/addAdmContr.php" method="POST" class="form-eee">

                        <div class="labinp">
                            <label for="email">email : </label><input name="new_adme" required type="email" class="form-control">
                        </div>
                        <div class="labinp">
                            <label for="mob">mobile : </label><input required name="new_admtel" type="tel" class="form-control">
                        </div>

                        <div style="margin-top: 10px;" class="labinp">
                            <button style="width: 100%;background: var(--bs-green);color: white;" class="btn-eee">add</button>

                        </div>
                        <p style="font-size: .8em;text-align: center;">Lorem ipsum dolor sit amet consectetur.</p>
                    </form>


                </div>



            </div>

        </div>
    </div>
</div>
<!-- Modal add admin -->

<!-- Modal add category -->
<div class="modal fade" id="modeladdcat" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div style="background: var(--bs-green);color:white" class="modal-header">
                <h5 class="modal-title">Add Product</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    &times;
                </button>
            </div>
            <div class="modal-body">
                <div style="padding: 10px;" class="all-form">
                    <form action="../../controller/prodContr.php" method="POST" enctype="multipart/form-data" class="form-eee">

                        <div class="labinp">
                            <label for="email">name : </label><input name="catname" required type="text" class="form-control">
                        </div>

                        <div class="labinp">
                            <label for="desc">Desc : </label><textarea required rows="1" name="catdesc" class="form-control"></textarea>
                        </div>




                        <div style="margin-top: 10px;" class="labinp">
                            <button style="width: 100%;background: var(--bs-green);color: white;" class="btn-eee">add</button>

                        </div>
                        <p style="font-size: .8em;text-align: center;">Lorem ipsum dolor sit amet consectetur.</p>
                    </form>


                </div>



            </div>

        </div>
    </div>
</div>
<!-- Modal add category -->