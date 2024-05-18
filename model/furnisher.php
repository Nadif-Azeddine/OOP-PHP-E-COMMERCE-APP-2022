<?php
require_once('dao.php');


class furnisher
{
    private $name;
    private $email;
    private $tel;
    private $address;
    private $tot_prod;
    private $tot_mont;

    public function __construct($name, $email, $tel, $address, $tot_prod, $tot_mont)
    {
        $this->name = $name;
        $this->email = $email;
        $this->tel = $tel;
        $this->address = $address;
        $this->tot_prod = $tot_prod;
        $this->tot_mont = $tot_mont;
    }

    public function AddFur()
    {
        $dao = new DAO;
        if (DAO::isIn($this->email)) {
            $data = DAO::GetidFur($this->email);
            foreach ($data as $dataa) {
                $id_furr = $dataa->id_fur;
            }

            if ($dao->UpdateFurnisher($this->tot_prod, $this->tot_mont, $id_furr)) {
                return true;
            }
        } else {
            if ($dao->AddFurnisher($this->name, $this->email, $this->tel, $this->address, $this->tot_prod, $this->tot_mont)) {
                return true;
            }
        }
        return false;
    }
 
    static function All(){
        $dao = new DAO;
        $data = $dao->allfurnishers();
        return $data;
    }
}
