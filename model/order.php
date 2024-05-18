<?php
require_once('dao.php');


class order extends DAO
{
    private $id_user;
    private $id_prod;
    private $address;
    private $items;
    private $fullpr;



    public function  __construct($id_user, $id_prod,$address,$fullpr,$items)
    {

        $this->id_user = $id_user;
        $this->id_prod = $id_prod;
        $this->address = $address;
        $this->items = $items;
        $this->fullpr = $fullpr;

      }

    public function AddOrd(){
        $dao = new DAO;
        if ($dao->AddOrder( $this->id_user,$this->id_prod, $this->address,$this->fullpr,$this->items)) {
            return true;
        }else{
            return false;
        }
      


    }
    static function AllOrder(){
        $dbb = new DAO();
        return $dbb->GetAllOrder();

    }
    
    static function AllOrderAdmin($st){
        $dbb = new DAO();
        return $dbb->GetAllOrderAdmin($st);

    }

    static function  updateorderadmin($id,$st){
        $dao = new DAO();
        if ($dao->UpdateOrder($id,$st)) {
           return true;
        }return false;
    }

    static function cancelOrd($id,$nb,$prod){
        $dao = new DAO();
        if ($dao->CancelOrder($id,$nb,$prod)) {
           return true;
        }return false;

    }
    
    static function NbOrder($id){
        $dbb = new DAO();
        return $dbb->NborderClient($id);

    }

    static function AllOrderValide($id){
        $dbb = new DAO();
        return $dbb->AllOrderValideUser($id);

    }

    static function AllOrderValideCount($id){
        $dbb = new DAO();
        return $dbb->AllOrderValideNB($id);
    }
    
    static function OrdMadeWOFac($id){
        $dao = new DAO();
        if ($dao->OrderMadeWOFac($id)) {
           return true;
        }return false;

        
    }
    static function getnb(){
        $dao = new DAO;
        return $dao->GetNbOrderAdmin();
    }




}
