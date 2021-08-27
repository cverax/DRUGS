<?php

class Vendedor extends Validator{
    private $id = null;
    private $vendedor = null;
    private $estado = null;


    public function setId($value)
    {
        if ($this->validateNaturalNumber($value)) {
            $this->id = $value;
            return true;
        } else {
            return false;
        }
    }
    public function setVendedor($value)
    {
        if ($this->validateAlphanumeric($value, 1, 50)) {
            $this->vendedor = $value;
            return true;
        } else {
            return false;
        }
    }
    public function setEstado($value)
    {
        if ($this->validateBoolean($value)) {
            $this->estado = $value;
            return true;
        } else {
            return false;
        }
    }
    public function getId()
    {
        return $this->id;
    }
    public function getVendedor()
    {
        return $this->vendedor;
    }
    public function getEstado()
    {
        return $this->estado;
    }
    
    public function createRow()
    {
        $sql = 'INSERT INTO Vendedores(vendedor, estado)
                VALUES(?, ?)';
        $params = array($this->vendedor, $this->estado);
        return Database::executeRow($sql, $params);
    }

    public function readAll()
    {
        $sql = 'SELECT idvendedor, vendedor, estado
         FROM Vendedores
          ORDER BY idvendedor';
        $params = null;
        return Database::getRows($sql, $params);
    }
    public function readOne()
    {
        $sql = 'SELECT idvendedor,vendedor, estado
        FROM Vendedores
        WHERE idvendedor = ?';
        $params = array($this->id);
        return Database::getRow($sql, $params);
    }

    public function updateRow()
    {
        $sql = 'UPDATE Vendedores
                SET estado = ?
                WHERE  idvendedor=?';
        $params = array($this->estado,  $this->id);
        return Database::executeRow($sql, $params);
    }
}