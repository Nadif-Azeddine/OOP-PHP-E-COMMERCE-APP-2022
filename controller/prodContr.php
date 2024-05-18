<?php

require_once('../model/product.php');
require_once('../model/category.php');
////////////////
if (isset($_POST['prodname'])) {
    $name=$_POST['prodname'];
    $price=$_POST['prodprice'];
    $desc=$_POST['proddesc'];
    $stock=($_POST['prodstock']);
    $cat=($_POST['cat_prod']);

    $ext=$_FILES['prodpic']['type'];
    $namepic=random_int(10000000000,20000000000).".".substr($ext,strpos($ext,'/')+1,strlen($ext));
    $dest="../public/photos/products/".$namepic;
    move_uploaded_file($_FILES['prodpic']['tmp_name'],$dest);

    $prod = new product($name,$price,$desc,$stock,$namepic,$cat);
    
    if ($prod->addprod()) {

header('Location:../views/admin?msg=product added succefully');
    }
    else{
        return header('Location:?msg=failed');
 
    }

}


if (isset($_POST['catname'])) {
    $name=$_POST['catname'];
    $desc=$_POST['catdesc'];
   $cat = new category($name,$desc);
   if ($cat->AddCat()) {
    header('Location:../views/admin?msg=category added succefully');

   }else{
    header('Location:../views/admin?msg=failed category');


   }


}


///////////////////////// update //////////////
if (isset($_POST['up_prodname'])) {
    $id = $_POST['up_idprod'];
    $name=$_POST['up_prodname'];
    $price=$_POST['up_prodprice'];
    $desc=$_POST['up_proddesc'];
    $stock=($_POST['up_prodstock']);

    
    if (product::UpdateProduct($id,$name,$price, $desc, $stock)) {

   header('Location:../views/admin?msg=product updated');
    }
    else{
     header('Location:../views/admin?msg=failed to update the product');
 
    }

}
if (isset($_POST['id_prod_pic'])) {

    $id = $_POST['id_prod_pic'];
    $pic = $_POST['pic_prod_pic'];
    $file = "..\public\photos\products\\".$pic;
    $ext=$_FILES['update_pic_prod']['type'];
    $namepic="Pic_".date("Y_m_d_H_i_s").".".substr($ext,strpos($ext,'/')+1,strlen($ext));
    $dest="../public/photos/products/".$namepic;
    if (product::UpdateProductPic($id,$namepic)) {
        if (file_exists($file)) {
        unlink($file);
      } 
          move_uploaded_file($_FILES['update_pic_prod']['tmp_name'],$dest);
          header('Location:../views/admin?msg=picture updated');
        }else{
            header('Location:../views/admin?failed=failed to update the picture');
     
        }

}

/////////////////delete///////////////

if (isset($_POST['prod_del'])) {
    $id = $_POST['prod_del'];
    $pic = $_POST['prod_pic_del'];
    $file = "..\public\photos\products\\".$pic;

    if (product::DeleteProduct($id)) 
    {
      if (file_exists($file)) {
        unlink($file);
      }  
    header('Location:../views/admin?msg=product deleted');
    }else{
        header('Location:../views/admin?msg=failed to delete the product');
 
    }
}


?>