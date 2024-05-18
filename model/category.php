<?php
require_once('dao.php');


class category extends DAO
{
    private $name;
    private $desc;



    public function  __construct($name, $desc)
    {

        $this->name = $name;
        $this->desc = $desc;

      }

    public function AddCat(){
        $dao = new DAO;
        if ($dao->AddCategory($this->name,$this->desc)) {
            return true;
        }else{
            return false;
        }
      


    }
    static function AllCat(){
        $dbb = new DAO();
        return $dbb->GetAllCat();

    }
    static function AllCatHasProd(){
        $dbb = new DAO();
        return $dbb->GetAllCatHasProd();

    }

    static function Deletecat($id){
        $dbb = new DAO();
    return $dbb->Deletecategory($id);

    }
    static function Updatecat($id,$name,$desc){
        $dbb = new DAO();
    if($dbb->Updatecategory($id,$name,$desc)){
      return true  ;
    }return false ;
     

    }
    
    




}
