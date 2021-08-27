<?php

class Origen extends Validator{
    private $id = null;
    private $origen = null;
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
    public function setOrigen($value)
    {
        if ($this->validateAlphanumeric($value, 1, 50)) {
            $this->origen = $value;
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
    public function getOrigen()
    {
        return $this->origen;
    }
    public function getEstado()
    {
        return $this->estado;
    }
    
    public function createRow()
    {
        $sql = 'INSERT INTO OrigenDestino(origen, estado)
                VALUES(?, ?)';
        $params = array($this->origen, $this->estado);
        return Database::executeRow($sql, $params);
    }

    public function readAll()
    {
        $sql = 'SELECT idorigen, origen, estado
         FROM OrigenDestino
          ORDER BY idorigen';
        $params = null;
        return Database::getRows($sql, $params);
    }
    public function readOne()
    {
        $sql = 'SELECT idorigen,origen, estado
        FROM OrigenDestino
        WHERE idorigen = ?';
        $params = array($this->id);
        return Database::getRow($sql, $params);
    }

    public function updateRow()
    {
        $sql = 'UPDATE OrigenDestino
                SET estado = ?
                WHERE  idorigen=?';
        $params = array($this->estado,  $this->id);
        return Database::executeRow($sql, $params);
    }
    public function nose()
    {
        $sql = 'SELECT od.origen, codigo.NombreProducto, codigo.Lote
        FROM EntradaSalida AS e
        INNER JOIN OrigenDestino AS od
        ON e.Destino = od.IdOrigen
        INNER JOIN Productos AS codigo
        ON e.Productos =codigo.CodigoProducto
        WHERE od.IdOrigen = ? AND od.estado = true 
        ORDER BY codigo.NombreProducto';
          $params = array($this->id); 
        return Database::getRows($sql, $params);
      
    }
}