<?php
require_once('dao.php');


class product extends DAO
{
    private $name;
    private $price;
    private $desc;
    private $stock;
    private $picdir;    
    private $cat;


    public function __construct($name,$price, $desc, $stock, $picdir, $cat)
    {

        $this->name = $name;
        $this->price = $price;
        $this->desc = $desc;
        $this->stock = $stock;
        $this->picdir = $picdir;
        $this->cat = $cat;
    }

    public function addprod(){
        $db = $this->connect();
        $stm=$db->prepare("INSERT INTO `product`( `name`, `price`, `description`, `initial_stock`,`current_stock`, `pic_dir`, `cat`,`date_prod`) VALUES (?,?,?,?,?,?,?,?)");       
        $stm->execute([$this->name,$this->price,$this->desc,$this->stock,$this->stock,$this->picdir,$this->cat,date('Y-m-d H:i:s')]);
        $stmcat = $db->prepare("UPDATE category set nb_prod=nb_prod+? WHERE id_cat=?");
        $stmcat->execute([$this->stock,$this->cat]);
        return true;
    }
   
    static function AllProd(){
        $dbb = new DAO();
        return $dbb->GetAllProd();

    }
    static function AllUserOrders($id){
        $dbb = new DAO();
        return $dbb->GetAllUserOrder($id);

    }
  
    static function getfirst5($n){
        $dao = new DAO();
        return $dao->getprodnb($n);
       

    }
    /////////////////////
    static function UpdateProduct($id,$name,$price, $desc, $stock){
        $dao = new DAO;
        if ($dao->UpdateProd($id,$name,$price, $desc, $stock)) {
            return true;
        }
        return false;
        
        
        
    }
    //////////////////////,
    static function UpdateProductPic($id,$pic){
        $dao = new DAO;
        if ($dao->UpdateProdPic($id,$pic)) {
            return true;
        }
        return false;

    }
    /////////////////////
    static function DeleteProduct($id){
        $dao = new DAO;
        if ($dao->DeleteProd($id)) {
            return true;
        }
        return false;
        
        
        
    }
    static function Search($pr,$pr2,$pr3){
        $dao = new DAO();
        $res = $dao->SearchPr($pr,$pr2,$pr3);
        return $res;
    }
    static function Searchadmin($pr,$pr2,$pr3){
        $dao = new DAO();
        $res = $dao->SearchPradm($pr,$pr2,$pr3);
        return $res;
    }
    static function mostsale(){
        $dao = new DAO();
        $res = $dao->mostsalePrd();
        return $res;
        

    }
}