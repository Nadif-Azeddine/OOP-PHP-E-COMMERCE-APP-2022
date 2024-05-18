<?php
include('../layouts/header.php');
require_once("../../include/session.php");
require_once("../../include/sessAdmin.php");

require_once("../../controller/adminContr.php");
include('leftbar.php');
$i=0;

?>
 <div onclick="togglenav()" class="toggle-nav">
       <button class=""><i class="fa fa-bars" aria-hidden="true"></i></button> 
    </div>
<div class="allordersadmin">
<?php if (isset($_GET['msg'])) :  ?>
<div class="alert" role="alert">
<?= $_GET['msg'] ?>
</div>
      <?php endif ?>
    <div class="status-order">
        <a style="<?php $retVal = ((isset($_GET['status']) && $_GET['status']==0) || !isset($_GET['status'])) ? "background:var(--bs-white);color:var(--color2)" : "background:none;border:1px solid var(--bs-white)" ; echo($retVal) ?>" class="btn-eee" href="orders.php?status=0"><i class="fa fa-arrow-circle-down" ></i></a>
        <a href="orders.php?status=1" class="btn-eee" style="<?php $retVal = (isset($_GET['status']) && $_GET['status']==1 ) ? "background:var(--bs-white);color:var(--color2)" : "background:none;border:1px solid var(--bs-white)" ; echo($retVal) ?>"><i class="fa fa-check-circle" aria-hidden="true"></i></a>
        <a href="orders.php?status=-1" class="btn-eee" style="<?php $retVal = (isset($_GET['status']) && $_GET['status']==-1 ) ? "background:var(--bs-white);color:var(--color2)" : "background:none;border:1px solid var(--bs-white)" ; echo($retVal) ?>"><i class="fa fa-trash-alt" aria-hidden="true"></i></a>
    </div>


    <table class="table table-inverse table-responsive shoopyt">
        <thead class="thead-inverse">
            <tr style="background: var(--bglin);color: var(--color4);border-radius:10px  ;">
                <th>#</th>
                <th>id prod</th>
                <th>id user</th>
                <th>email</th>
                <th>mobile</th>
                <th>address</th>
                <th>nb_orders</th>
                <th>date</th>
                <th>actions</th>

            </tr>
            </thead>
            <tbody>
                <?php foreach ($orders as $order) :?>
                <tr> 
                    <td><?= $i ?></td>
                   <td><?= $order->id_prod ?></td>
                   <td><?= $order->id_user ?></td>
                   <td><?= $order->email ?></td>
                   <td><?= $order->mobile ?></td>
                   <td><?= $order->address ?></td>
                   <td><?= $order->items ?></td>
                   <td><?= $order->date_order?></td>
                   <td>
                    <div style="display: flex;width: 100%;justify-content: space-evenly;">
                    <form action="../../controller/orderadminContr.php" method="POST">
                        <input type="hidden" name="id_accept_order" value="<?=$order->id_order ?>">
                        <button <?php $retVal = ($order->status != 0) ? "disabled": "" ; echo $retVal ?> style="<?php $retVal = ($order->status == 1 || $order->status == 10) ? "color: var(--bs-success)": "" ; echo $retVal ?> ;" ><i class="fa fa-check-circle" aria-hidden="true"></i></button>
                    </form>
                    <form action="../../controller/orderadminContr.php" method="POST" action="">
                    <input type="hidden" name="id_denied_order" value="<?=$order->id_order ?>">

                        <button  <?php $retVal = ($order->status != 0) ? "disabled": "" ; echo $retVal ?>   style="<?php $retVal = ($order->status == -1) ? "color: var(--bs-danger)": "" ; echo $retVal ?>" ><i class="fa fa-trash-alt"></i></button>
                    </form>
                </div>
                   </td>

                </tr>
                <?php $i++; endforeach ?>
               
            </tbody>
    </table>
<div class="text-center">
    <p style="font-size: .8em;">Lorem ipsum, dolor sit amet consectetur adipisicing elit. Labore, provident?</p>
    <p style="text-align: center;font-size: .8em;margin-top: -.6rem;" ><i style="color: var(--bs-green);" class="fa fa-check-circle" aria-hidden="true"></i> accepted <i style="margin-left: 5px;" class="fa fa-check-circle" aria-hidden="true"></i> no action
      <i style="color: var(--bs-danger);margin-left: .5rem;" class="fa fa-trash-alt" aria-hidden="true"></i> denied <i style="margin-left: 5px;" class="fa fa-trash-alt" aria-hidden="true"></i> no action</p>
</div>
</div>
