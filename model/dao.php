<?php
class DAO
{
    public function __construct()
    {
    }

    /////////////////////////////////
    public function connect()
    {
        try {
            return new PDO('mysql:dbname=project', 'root', '');
        } catch (PDOException $th) {
            echo ("cannot connect to database");
        }
    }
    ///////////////////////////////
    public function checkifExist($email, $con)
    {
        $sql = $con->prepare("SELECT count(*) FROM users where email=?");
        $sql->execute([$email]);
        $stm = $sql->fetchColumn();
        return $stm == 1;
    }
    /////////////////////////////////
    public function adduser($name, $mobile, $email, $address, $pass)
    {
        $db = $this->connect();

        if (!$this->checkifExist($email, $db)) {
            $stmm = $db->prepare("INSERT INTO `users`(`name`, `email`,`password`, `mobile`, `address`,`created_at`) VALUES (:nom,:email,:pwd,:tel,:add,:datee)");
            $stmm->execute([
                ':nom' => $name,
                ':email' => $email,
                ':pwd' => md5($pass),
                ':tel' => $mobile,
                ':add' => $address,
                'datee' => date('Y-m-d H:i:s'),
            ]);

            return true;
        } else {
            return false;
        }
    }
    /////////////////////////////////
    static function isauthen($email, $pass)
    {
        $dao = new DAO;
        $con = $dao->connect();
        $sql = $con->prepare("SELECT count(*) FROM users where email=? AND password=?");
        $sql->execute([$email, $pass]);
        $stm = $sql->fetchColumn();
        return $stm == 1;
    }
    ///////////////////////
    static function selectuser($email)
    {
        $dao = new DAO;
        $db = $dao->connect();
        $data = $db->prepare("SELECT * from users where email=?");
        $data->execute([$email]);
        $dataa = $data->fetchAll(PDO::FETCH_OBJ);
        return $dataa;
    }
    public function AddAdmin($email, $tel)
    {
        $con = $this->connect();
        $sql = $con->prepare("SELECT count(*) FROM users WHERE email=? AND mobile=?");
        $sql->execute([$email, $tel]);
        $stm = $sql->fetchColumn();
        if ($stm == 1) {
            $sqlid = $con->prepare("SELECT id_user FROM users where email=? AND mobile=? ");
            $sqlid->execute([$email, $tel]);
            $stmid = $sqlid->fetchAll(PDO::FETCH_OBJ);
            foreach ($stmid as $key) {
                $idus = $key->id_user;
            }

            $sqll = $con->prepare("Select count(*) from admins  WHERE id_user=? ");
            $sqll->execute([$idus]);
            $chkad = $sqll->fetchColumn();
            if ($chkad == 0) {
                $sqlll = $con->prepare("INSERT INTO `admins`(`id_user`,`role`,`date_add`) VALUES(?,1,?) ");
                $sqlll->execute([$idus,date('Y-m-d H:i:s')]);
                return true;
            }
        }
        return false;
    }
    public function IsanAdmin($id)
    {
        $con = $this->connect();
        $sql = $con->prepare("SELECT count(*) FROM admins WHERE id_user=?");
        $sql->execute([$id]);
        $stm = $sql->fetchColumn();
        return $stm == 1;
    }

    ///////////////////PRODUCT ////////////////////
    /////////////
    public function GetAllProd()
    {
        $db = $this->connect();
        $stm = $db->prepare("SELECT * FROM `product` order by current_stock");
        $stm->execute();
        $data = $stm->fetchAll(PDO::FETCH_OBJ);
        return  $data;
    }
    ////////////////////
    public function getprodnb($n)
    {
        $db = $this->connect();
        $stm = $db->prepare("SELECT * FROM `product` WHERE current_stock!=0 order BY id_prod DESC limit 4");
        $stm->execute();
        $data = $stm->fetchAll(PDO::FETCH_OBJ);
        return $data;
    }


    ///////////////////////:
    public function UpdateProd($id, $name, $price, $desc, $current_stock)
    {
        $db = $this->connect();

        $stmstck = $db->prepare("SELECT current_stock,cat FROM `product` WHERE id_prod=?");
        $stmstck->execute([$id]);
        $datastck = $stmstck->fetchAll(PDO::FETCH_OBJ);
        foreach ($datastck as $val) {
            $old_current_stock = $val->current_stock;
            $id_cat = $val->cat;
        }
        $stm = $db->prepare("UPDATE `category` set nb_prod = nb_prod+? where id_cat=?");
        $stm->execute([$current_stock - $old_current_stock, $id_cat]);


        $data = $db->prepare("UPDATE product set name=? ,price=? ,description=? ,current_stock=? where id_prod=?");
        $data->execute([$name, $price, $desc, $current_stock, $id]);



        return true;
    }

    ///////////////////////
    public function UpdateProdPic($id, $pic)
    {
        $db = $this->connect();
        $data = $db->prepare("UPDATE product set pic_dir=? where id_prod=?");
        $data->execute([$pic, $id]);

        return true;
    }

    //////////////////////////
    public function DeleteProd($id)
    {
        $db = $this->connect();
        $data = $db->prepare("DELETE FROM `product` where id_prod=?");
        $data->execute([$id]);

        return true;
    }
    public function SearchPr($pr, $pr2, $pr3)
    {
        $db = $this->connect();
        $stm = $db->prepare("SELECT * FROM `product` WHERE current_stock!=0 AND name LIKE ? or current_stock!=0 AND name like ? or current_stock!=0 AND name like ? ");
        $stm->execute([$pr, $pr2, $pr3]);
        $data = $stm->fetchAll(PDO::FETCH_OBJ);
        return $data;
    }
    public function SearchPradm($pr, $pr2, $pr3)
    {
        $db = $this->connect();
        $stm = $db->prepare("SELECT * FROM `product` WHERE  name LIKE ? or  name like ? or  name like ? ");
        $stm->execute([$pr, $pr2, $pr3]);
        $data = $stm->fetchAll(PDO::FETCH_OBJ);
        return $data;
    }

    public function mostsalePrd()
    {
        $db = $this->connect();
        $stm = $db->prepare("SELECT * FROM `product`   ");
        $stm->execute();
        $data = $stm->fetchAll(PDO::FETCH_OBJ);
        return $data;
    }


    ////////////////////CATEGORY /////////////////////////
    public function AddCategory($name, $desc)
    {
        $db = $this->connect();
        $stm = $db->prepare("INSERT INTO `category`( `cat_name`, `cat_desc`,`date_cat`) VALUES (?,?,?)");
        $stm->execute([$name, $desc, date('Y-m-d  H:i:s')]);
        return true;
    }

    public function GetAllCat()
    {
        $db = $this->connect();
        $stmcat = $db->prepare("SELECT * FROM `category` ORDER BY cat_name");
        $stmcat->execute();
        $datacat = $stmcat->fetchAll(PDO::FETCH_OBJ);
        return $datacat;
    }
    public function GetAllCatHasProd()
    {
        $db = $this->connect();
        $stmcat = $db->prepare("SELECT * FROM `category` WHERE nb_prod!=0 ORDER BY cat_name");
        $stmcat->execute();
        $datacat = $stmcat->fetchAll(PDO::FETCH_OBJ);
        return $datacat;
    }
    public function DeleteCategory($id)
    {

        $db = $this->connect();
        $chk = $db->prepare("SELECT nb_prod FROM category WHERE id_cat = ?");
        $chk->execute([$id]);
        $datacat = $chk->fetchAll(PDO::FETCH_OBJ);
        foreach ($datacat as $cat) {
            $nb = $cat->nb_prod;
        }
        if ($nb == 0) {
            $stm = $db->prepare("DELETE FROM category WHERE id_cat = ?");
            $stm->execute([$id]);
            return true;
        } else {
            return false;
        }
    }
    public function Updatecategory($id, $name, $desc)
    {
        $db = $this->connect();
        $stm = $db->prepare("UPDATE category SET cat_name=?,cat_desc=? WHERE  id_cat = ?");
        $stm->execute([$name, $desc, $id]);
        return true;
    }

    ////////////////////



    ///////////////////////////////////ORDERS/////////////////////////
    public function AddOrder($id_user, $id_prod, $address, $fp, $items)
    {
        $db = $this->connect();
        $stm = $db->prepare("INSERT INTO `orders`( `id_user`, `id_prod`, `address`,  `items` ,`full_price`,`date_order`) VALUES (?,?,?,?,?,?)");
        $stm->execute([$id_user, $id_prod, $address, $items, $fp, date('Y-m-d  H:i:s')]);
        //current_stock =  current_stock - nb orders
        $stmmince = $db->prepare("UPDATE `product` set current_stock = current_stock-? where id_prod=?");
        $stmmince->execute([$items, $id_prod]);

        $stmcat = $db->prepare("SELECT cat FROM `product` WHERE id_prod=?");
        $stmcat->execute([$id_prod]);
        $datacat = $stmcat->fetchAll(PDO::FETCH_OBJ);
        foreach ($datacat as $val) {
            $id_cat = $val->cat;
        }
        //
        $stmmincecat = $db->prepare("UPDATE `category` set nb_prod = nb_prod-? where id_cat=?");
        $stmmincecat->execute([$items, $id_cat]);
        // if a user made an order he  becomes a client
        $stmchck = $db->prepare("select count(*) from clients where id_user=?");
        $stmchck->execute([$id_user]);
        $sc = $stmchck->fetchColumn();
        if ($sc == 0) {
            $cli = $db->prepare("INSERT INTO `clients`(`id_user`, `total_buy`,`total_montant`,`date`) VALUES (?,?,?,?) ");
            $cli->execute([$id_user, 1, $fp, date('Y-m-d  H:i:s')]);
        } else {
            $cli = $db->prepare("UPDATE clients SET total_buy=total_buy+1, total_montant=total_montant+?");
            $cli->execute([$fp]);
        }
        //update the address of the client
        $stmupadd = $db->prepare("UPDATE users SET address=? WHERE id_user=?");
        $stmupadd->execute([$address, $id_user]);

        return true;
    }
    public function GetAllOrder()
    {
        $db = $this->connect();
        $stm = $db->prepare("SELECT * FROM `orders`");
        $stm->execute();
        $data = $stm->fetchAll(PDO::FETCH_OBJ);
        return  $data;
    }
    public function NborderClient($id)
    {
        $db = $this->connect();
        $stm = $db->prepare("SELECT count(*) FROM `orders` WHERE id_user=? and status=0");
        $stm->execute([$id]);
        $data = $stm->fetchColumn();
        return  $data;
    }
    public function GetAllUserOrder($id)
    {
        $db = $this->connect();
        $stm = $db->prepare("SELECT * FROM `orders` Join product on orders.id_prod = product.id_prod and orders.status=0 and orders.id_user=?");
        $stm->execute([$id]);
        $data = $stm->fetchAll(PDO::FETCH_OBJ);
        return  $data;
    }
    public function GetAllOrderAdmin($st)
    {

        $db = $this->connect();
        if ($st == 1) {
            $stm = $db->prepare("SELECT * FROM `orders` Join product on orders.id_prod = product.id_prod and orders.status=? or orders.status=10 JOIN users on users.id_user=orders.id_user");
        } else {
            $stm = $db->prepare("SELECT * FROM `orders` Join product on orders.id_prod = product.id_prod and orders.status=?  JOIN users on users.id_user=orders.id_user");
        }
        $stm->execute([$st]);
        $data = $stm->fetchAll(PDO::FETCH_OBJ);
        return  $data;
    }

    public function UpdateOrder($id, $st)
    {
        $db = $this->connect();
        $stm = $db->prepare("UPDATE orders SET status=? WHERE id_order=?");
        $stm->execute([$st, $id]);
        if ($st == 1) {
            $chk =  $db->prepare("SELECT * FROM orders where id_order=?");
            $chk->execute([$id]);
            $idpr = $chk->fetchAll(PDO::FETCH_OBJ);
            foreach ($idpr as $key) {
                $idprod = $key->id_prod;
                $items = $key->items;
                $price = $key->full_price;
            }
            $chkpr =  $db->prepare("SELECT count(*) FROM sales where id_prod_sl=?");
            $chkpr->execute([$idprod]);
            $check = $chkpr->fetchColumn();

            if ($check == 1) {
                $stmm = $db->prepare("UPDATE `sales` SET `total_sales`=total_sales+?,`montant`=montant+?,`date_sale`=?  WHERE id_prod_sl=?");
                $stmm->execute([$items, $price, date('Y-m-d  H:i:s'), $idprod]);
            }
            if ($check == 0) {
                $stmm = $db->prepare("INSERT INTO `sales`( `id_prod_sl`, `total_sales`, `montant`,`date_sale`) VALUES (?,?,?,?)");
                $stmm->execute([$idprod, $items, $price, date('Y-m-d  H:i:s')]);
            }
        }
        return true;
    }
    public function CancelOrder($id, $nb, $prod)
    {
        $db = $this->connect();
        $stm = $db->prepare("DELETE FROM orders WHERE id_order=?");
        $stm->execute([$id]);
        $stmprd = $db->prepare("UPDATE product set current_stock=current_stock+? WHERE id_prod=?");
        $stmprd->execute([$nb, $prod]);
        $stmcat = $db->prepare("SELECT cat FROM `product` WHERE id_prod=?");
        $stmcat->execute([$prod]);
        $datacat = $stmcat->fetchAll(PDO::FETCH_OBJ);
        foreach ($datacat as $val) {
            $id_cat = $val->cat;
        }
        //
        $stmmincecat = $db->prepare("UPDATE `category` set nb_prod = nb_prod+? where id_cat=?");
        $stmmincecat->execute([$nb, $id_cat]);

        return true;
    }

    public function AllOrderValideUser($id)
    {
        $db = $this->connect();
        $stm = $db->prepare("SELECT * FROM `orders`  Join product on orders.id_prod = product.id_prod and orders.id_user=? and status=1");
        $stm->execute([$id]);
        $data = $stm->fetchAll(PDO::FETCH_OBJ);
        return  $data;
    }

    public function AllOrderValideNB($id)
    {
        $db = $this->connect();
        $stm = $db->prepare("SELECT count(*) FROM `orders` WHERE id_user=? AND status=1");
        $stm->execute([$id]);
        $data = $stm->fetchColumn();
        return  $data;
    }


    public function OrderMadeWOFac($id)
    {
        $db = $this->connect();
        $stm = $db->prepare("update orders SET status=10 WHERE id_order=?");
        $stm->execute([$id]);
        return true;
    }
    public function GetNbOrderAdmin()
    {
        $db = $this->connect();
        $stm = $db->prepare("SELECT count(*) FROM `orders` WHERE status=0");
        $stm->execute();
        $data = $stm->fetchColumn();
        return  $data;
    }


    // /////////////furnisher //////////
    public function AddFurnisher($name, $email, $tel, $address, $tot_p, $tot_m)
    {
        $db = $this->connect();
        $stm = $db->prepare("INSERT INTO `furnishers`( `name_fur`, `email`, `mobile`, `address`, `total_prod_buy`, `total_montant`, `date_add_fur`) VALUES (?,?,?,?,?,?,?)");
        $stm->execute([$name, $email, $tel, $address, $tot_p, $tot_m, date('Y-m-d  H:i:s')]);
        return true;
    }

    static function isIn($email)
    {
        $dao = new DAO;
        $db = $dao->connect();
        $data = $db->prepare("SELECT count(*) from furnishers where email=?");
        $data->execute([$email]);
        $dataa = $data->fetchColumn();
        return $dataa == 1;
    }
    static function GetidFur($email)
    {
        $dao = new DAO;
        $db = $dao->connect();
        $data = $db->prepare("SELECT `id_fur` FROM `furnishers` where email=?");
        $data->execute([$email]);
        $dataa = $data->fetchAll(PDO::FETCH_OBJ);
        return $dataa;
    }
    public function UpdateFurnisher($tot_prod, $tot_mont, $id_fur)
    {
        $db = $this->connect();
        $stm = $db->prepare("UPDATE `furnishers` SET `total_prod_buy`=total_prod_buy+?,`total_montant`=total_montant+? WHERE id_fur=?");
        $stm->execute([$tot_prod, $tot_mont, $id_fur]);
        return true;
    }
    public function AddAppro($id_fur, $prod, $prod_p,$prod_q)
    {
        $db = $this->connect();
        $stm = $db->prepare("INSERT INTO `approvisionnement`( `id_fur`, `product`, `price`,`initial_stk`, `date_stk`) VALUES (?,?,?,?,?)");
        $stm->execute([$id_fur, $prod, $prod_p,$prod_q, date('Y-m-d  H:i:s')]);
        return true;
    }
    public function allfurnishers()
    {
        $db = $this->connect();
        $data = $db->prepare("SELECT * FROM `furnishers` ORDER BY name_fur ");
        $data->execute();
        $dataa = $data->fetchAll(PDO::FETCH_OBJ);
        return $dataa;
    }
    static function getAllClients()
    {
        $dao = new DAO;
        $db = $dao->connect();
        $data = $db->prepare("SELECT name,email,mobile,address,total_buy,total_montant,date FROM `clients` join users on clients.id_user = users.id_user  ");
        $data->execute();
        $dataa = $data->fetchAll(PDO::FETCH_OBJ);
        return $dataa;
    }
}
