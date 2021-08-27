<?php

class Productos extends Validator{
    private $codigo = null;
    private $nombre = null;
    private $categoria = null;
    private $lote = null;
    private $vencimiento = null;
    private $comentario = null;
    private $usuario = null;

    public function setId($value)
    {
        if ($this->validateNaturalNumber($value)) {
            $this->codigo = $value;
            return true;
        } else {
            return false;
        }
    }
    public function setNombre($value)
    {
        if ($this->validateString($value, 1, 50)) {
            $this->nombre = $value;
            return true;
        } else {
            return false;
        }
    }
    public function setCategoria($value)
    {
        if ($this->validateAlphanumeric($value, 1, 50)) {
            $this->categoria = $value;
            return true;
        } else {
            return false;
        }
    }
    public function setLote($value)
    {
        if ($this->validateNaturalNumber($value)) {
            $this->lote = $value;
            return true;
        } else {
            return false;
        }
    }
    public function setVencimiento($value)
    {
        if ($this->validateDate($value)) {
            $this->vencimiento = $value;
            return true;
        } else {
            return false;
        }
    }

    public function setComentario($value)
    {
        if ($this->validateString($value, 1, 200)) {
            $this->comentario = $value;
            return true;
        } else {
            return false;
        }
    }
    public function setUsuario($value)
    {
        if ($this->validateNaturalNumber($value)) {
            $this->usuario = $value;
            return true;
        } else {
            return false;
        }
    }
  

    public function getId()
    {
        return $this->codigo;
    }
    public function getNombre()
    {
        return $this->nombre;
    }
    public function getCategoria()
    {
        return $this->categoria;
    }
    public function getLote()
    {
        return $this->lote;
    }
    public function getVencimiento()
    {
        return $this->vencimiento;
    }
    public function getComentario()
    {
        return $this->comentario;
    }
    public function getUsuario()
    {
        return $this->usuario;
    }
    
    public function createRow()
    {
        $hola=1;
        $sql = 'INSERT INTO Productos (CodigoProducto, NombreProducto, Categoria, Lote, Vencimiento,comentario,usuario)
        VALUES(?,?, ?,?,?,?,?)';
        $params = array($this->codigo, $this->nombre, $this->categoria,$this->lote, $this->vencimiento, $this->comentario,$hola );
        return Database::executeRow($sql, $params);
    }

    public function readAll()
    {
        $sql = 'SELECT CodigoProducto, NombreProducto, Categoria, Lote, Vencimiento,comentario FROM Productos ORDER BY CodigoProducto';
        $params = null;
        return Database::getRows($sql, $params);
    }

    
    public function readCategoria()
    {
        $sql = 'SELECT distinct Categoria
        FROM productos ';
        $params = null;
        return Database::getRows($sql, $params);
    }

    public function readOne()
    {
        $sql = 'SELECT CodigoProducto, NombreProducto, Categoria, Lote, Vencimiento,comentario FROM Productos
        WHERE CodigoProducto = ?';
        $params = array($this->codigo);
        return Database::getRow($sql, $params);
    }

    public function updateRow()
    {
        $sql = 'UPDATE Productos
                SET NombreProducto = ?, comentario=?
                WHERE  CodigoProducto=?';
        $params = array($this->nombre,$this->comentario,  $this->codigo);
        return Database::executeRow($sql, $params);
    }
    public function readProductos()
    {
        $sql =  'SELECT nombreproducto, Categoria
        FROM productos 
        WHERE Categoria = ?
		group by nombreproducto, Categoria, CodigoProducto
		order by CodigoProducto';
        $params = array($this->categoria);
        return Database::getRows($sql, $params);
    }

    public function graphProductos()
    {
        $sql ='SELECT distinct Categoria, count(codigoproducto) as cantidad
		FROM productos
		group by Categoria
		order by cantidad
		limit 5';
        $params = null;
        return Database::getRows($sql, $params);

    }
    public function readProductosCategoria()
    {
        $sql = 'SELECT CodigoProducto, NombreProducto, Categoria, Lote, Vencimiento,comentario FROM Productos ORDER BY CodigoProducto';
        $params = null;
        return Database::getRows($sql, $params);
    }
   
    public function nosepa()
    {
        $sql = 'SELECT vta.VTA, codigo.NombreProducto, e.Cantidad, doc.Documentos
        FROM EntradaSalida AS e 
        INNER JOIN TipoVTA AS vta
        ON e.CodigoVTA = vta.IdVTA
		INNER JOIN TipoDocumento AS doc
        ON e.TipoDocumento=doc.IdDocumento
        INNER JOIN Productos AS codigo
        ON e.Productos =codigo.CodigoProducto
		where codigo.codigoproducto= ?';
        $params = array($this->codigo);
        return Database::getRows($sql, $params);
    }
}