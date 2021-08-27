<?php

class entradasalida extends Validator{
    private $fecha = null;
    private $codigovta = null;
    private $categoria = null;
    private $tipodocumento = null;
    private $lote = null;
    private $numero = null;
    private $productos = null;
    private $destino = null;
    private $vendedor = null;
    private $cantidad = null;

    public function setFecha($value)
    {
        if ($this->validateDate($value)) {
            $this->fecha = $value;
            return true;
        } else {
            return false;
        }
    }
    public function setCodigovta($value)
    {
        if ($this->validateNaturalNumber($value)) {
            $this->codigovta = $value;
            return true;
        } else {
            return false;
        }
    }
    public function setTipodocumento($value)
    {
        if ($this->validateNaturalNumber($value)) {
            $this->tipodocumento = $value;
            return true;
        } else {
            return false;
        }
    }
    public function setNumero($value)
    {
        if ($this->validateNaturalNumber($value)) {
            $this->numero = $value;
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
    public function setDestino($value)
    {
        if ($this->validateNaturalNumber($value)) {
            $this->destino = $value;
            return true;
        } else {
            return false;
        }
    }
    public function setVendedor($value)
    {
        if ($this->validateNaturalNumber($value)) {
            $this->vendedor = $value;
            return true;
        } else {
            return false;
        }
    }
    public function setProductos($value)
    {
        if ($this->validateNaturalNumber($value)) {
            $this->productos = $value;
            return true;
        } else {
            return false;
        }
    }
    public function setCantidad($value)
    {
        if ($this->validateNaturalNumber($value)) {
            $this->cantidad = $value;
            return true;
        } else {
            return false;
        }
    }

    public function getFecha()
    {
        return $this->fecha;
    }
    public function getCodigovta()
    {
        return $this->codigovta;
    }
    public function getTipodocumento()
    {
        return $this->tipodocumento;
    }
    public function getNumero()
    {
        return $this->numero;
    }
     public function getLote()
    {
        return $this->lote;
    }
     public function getCategoria()
    {
        return $this->categoria;
    }
    public function getProductos()
    {
        return $this->productos;
    }
    public function getDestino()
    {
        return $this->destino;
    }
     public function getVendedor()
    {
        return $this->vendedor;
    }
    public function getCantidad()
    {
        return $this->cantidad;
    }
    public function searchRows($value)
    {
        $sql = 'SELECT e.Fecha, vta.VTA, doc.Documentos, e.NumeroComprobante, codigo.NombreProducto, codigo.Lote, codigo.Categoria, od.Origen, ven.Vendedor, e.Cantidad 
        FROM EntradaSalida AS e 
        INNER JOIN OrigenDestino AS od
        ON e.Destino = od.IdOrigen
        INNER JOIN TipoVTA AS vta
        ON e.CodigoVTA = vta.IdVTA
        INNER JOIN TipoDocumento AS doc
        ON e.TipoDocumento=doc.IdDocumento
        INNER JOIN Productos AS codigo
        ON e.Productos =codigo.CodigoProducto
        INNER JOIN  Vendedores AS ven
        ON e.Vendedor = ven.IdVendedor
        WHERE codigo.nombreproducto = codigo.nombreproducto AND codigo.nombreproducto ILIKE ? OR vta.VTA ILIKE ? OR ven.Vendedor ILIKE ?'; 
        $params = array("%$value%", "%$value%" , "%$value%");
        return Database::getRows($sql, $params);
    }
    public function createRow()
    {
        $sql = 'INSERT INTO EntradaSalida (Fecha, CodigoVTA, TipoDocumento, NumeroComprobante, Productos, Destino, Vendedor, Cantidad)
        values  (? ,?, ?, ?, ? ,?, ?, ?)';
        $params = array($this->fecha, $this->codigovta, $this->tipodocumento,$this->numero ,$this->productos ,$this->destino ,$this->vendedor ,$this->cantidad);
        return Database::executeRow($sql, $params);
    }
    public function readAll()
    {
        $sql = 'SELECT e.Fecha, vta.VTA, doc.Documentos, e.NumeroComprobante, codigo.NombreProducto, codigo.Lote, codigo.Categoria, od.Origen, ven.Vendedor, e.Cantidad 
        FROM EntradaSalida AS e 
        INNER JOIN OrigenDestino AS od
        ON e.Destino = od.IdOrigen
        INNER JOIN TipoVTA AS vta
        ON e.CodigoVTA = vta.IdVTA
        INNER JOIN TipoDocumento AS doc
        ON e.TipoDocumento=doc.IdDocumento
        INNER JOIN Productos AS codigo
        ON e.Productos =codigo.CodigoProducto
        INNER JOIN  Vendedores AS ven
        ON e.Vendedor = ven.IdVendedor';
        $params = null;
        return Database::getRows($sql, $params);
    }
    public function readAllvta()
    {
        $sql = 'SELECT IdVTA, VTA
         FROM TipoVTA
        ';
        $params = null;
        return Database::getRows($sql, $params);
    }
    public function readAllDocumentos()
    {
        $sql = 'SELECT IdDocumento, Documentos FROM TipoDocumento';
        $params = null;
        return Database::getRows($sql, $params);
    }
    public function readAllproducto()
    {
        $sql = 'SELECT codigoproducto, nombreproducto FROM productos ';
        $params = null;
        return Database::getRows($sql, $params);
    }
    public function readAllorigen()
    {
        $sql = 'SELECT idorigen, origen FROM origendestino WHERE estado = true';
        $params = null;
        return Database::getRows($sql, $params);
    }
    public function readAllvendedor()
    {
        $sql = 'SELECT idvendedor, vendedor FROM vendedores WHERE estado = true';
        $params = null;
        return Database::getRows($sql, $params);
    }
    public function readAllexistencia()
    {
        $sql = 'SELECT Productos.nombreproducto, EntradaSalida.Productos, Productos.Lote, Productos.Vencimiento, SUM(CASE WHEN CodigoVTA = 1 THEN cantidad WHEN CodigoVTA = 2  THEN cantidad
        WHEN CodigoVTA = 4 THEN cantidad WHEN CodigoVTA = 8 THEN cantidad WHEN CodigoVTA = 3 then cantidad*(-1) 
        WHEN CodigoVTA = 5 THEN cantidad WHEN CodigoVTA = 6 THEN cantidad*(-1) WHEN CodigoVTA = 7 then cantidad*(-1)  WHEN CodigoVTA = 9 THEN cantidad*(-1) END)AS Cantidad FROM EntradaSalida
        INNER JOIN Productos ON Productos.CodigoProducto= EntradaSalida.Productos
        GROUP BY Productos.nombreproducto, EntradaSalida.Productos,Productos.Lote,Productos.Vencimiento
        ORDER BY Productos.nombreproducto
        ';
        $params = null;
        return Database::getRows($sql, $params);
    }

    public function searchRowsExistencias($value)
    {
        $sql = 'SELECT Productos.nombreproducto, EntradaSalida.Productos, Productos.Lote, Productos.Vencimiento, SUM(CASE WHEN CodigoVTA = 1 THEN cantidad WHEN CodigoVTA = 2  THEN cantidad
        WHEN CodigoVTA = 4 THEN cantidad WHEN CodigoVTA = 8 THEN cantidad WHEN CodigoVTA = 3 then cantidad*(-1) 
        WHEN CodigoVTA = 5 THEN cantidad WHEN CodigoVTA = 6 THEN cantidad*(-1) WHEN CodigoVTA = 7 then cantidad*(-1)  WHEN CodigoVTA = 9 THEN cantidad*(-1) END)AS Cantidad FROM EntradaSalida
        INNER JOIN Productos ON Productos.CodigoProducto= EntradaSalida.Productos
        WHERE Productos.nombreproducto ILIKE ?
        GROUP BY Productos.nombreproducto, EntradaSalida.Productos,Productos.Lote,Productos.Vencimiento'; 
        $params = array("%$value%");
        return Database::getRows($sql, $params);
    }
    
    }