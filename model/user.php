<?php
require('dao.php');

class user extends DAO
{
    private $name;
    private $mobile;
    private $email;
    private $address;
    private $password;
////////////////////
    public function __construct($name, $mobile, $email, $address,$password)
    {
        $this->name = $name;
        $this->mobile = $mobile;
        $this->email = $email;
        $this->address = $address;
        $this->password = $password;
    }
    ////////////////////////////
    public function add()
    {
        if (!$this->adduser($this->name,$this->mobile,$this->email,$this->address,$this->password)) {
            return false;
        }
        else {
           return true;     
        }
    }


    //////////////////////////////
    static function isauth($email,$pass){
        if (DAO::isauthen($email,$pass)) {
        return true;
        }
        return false;

    }
    ////////////
    static function getUserByEmail($email){
        $data=DAO::selectuser($email);
        return $data;
    }
    //////////////
    static function addNewAdmin($email,$tel){
        $dao = new DAO();
        if($dao->AddAdmin($email,$tel)){
            return true;
        }
        return false;
    }
    static function Isadmin($id){
        $dao = new DAO();
        if($dao->IsanAdmin($id)){
            return true;
        }
        return false;
    }

}
