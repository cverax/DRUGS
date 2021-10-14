<?php

class Regis extends Validator{
    private $id = null;
    private $compu = null;
    private $OS = null;
    private $Time = null;
    private $usu = null;

    public function setId($value)
    {
        if ($this->validateNaturalNumber($value)) {
            $this->id = $value;
            return true;
        } else {
            return false;
        }
    }
    public function setCompu($value)
    {
        if ($this->validateAlphanumeric($value,1, 40)) {
            $this->compu = $value;
            return true;
        } else {
            return false;
        }
    }
    public function setOs($value)
    {
        if ($this->validateAlphanumeric($value, 1, 40)) {
            $this->OS = $value;
            return true;
        } else {
            return false;
        }
    }
    public function setTime($value)
    {
        if ($this->validateString($value, 1 , 40)) {
            $this->Time = $value;
            return true;
        } else {
            return false;
        }
    }
    public function setusu($value)
    {
        if ($this->validateNaturalNumber($value)) {
            $this->usu = $value;
            return true;
        } else {
            return false;
        }
    }

    public function createRowsis()
   {
       $sql = 'INSERT INTO registrosesion (navegador, Dispositivo, usu, fecha)
       VALUES(?,?,?, current_date)';
       $params = array( $this->compu,  $this->OS,  $_SESSION['idusuario']);
       return Database::executeRow($sql, $params);
   }
   public function readSis()
   {
       $sql = 'SELECT navegador, Dispositivo, fecha
       FROM registrosesion 
        WHERE usu = ?
        ORDER BY fecha
       ';
       $params = array($_SESSION['idusuario']);
       return Database::getRows($sql, $params);
   }
  
}