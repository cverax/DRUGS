<?php

class Usuario extends Validator{
    private $id = null;
    private $nombre = null;
    private $usuario = null;
    private $tipou = null;
    private $clave = null;
    private $idtipo=null;
    private $tipo =null;


    public function setId($value)
    {
        if ($this->validateNaturalNumber($value)) {
            $this->id = $value;
            return true;
        } else {
            return false;
        }
    }
    public function setNombre($value)
    {
        if ($this->validateAlphanumeric($value, 1, 50)) {
            $this->nombre = $value;
            return true;
        } else {
            return false;
        }
    }
    public function setUsuario($value)
    {
        if ($this->validateAlphanumeric($value, 1, 50)) {
            $this->usuario = $value;
            return true;
        } else {
            return false;
        }
    }
    public function setTipoU($value)
    {
        if ($this->validateNaturalNumber($value)) {
            $this->tipou = $value;
            return true;
        } else {
            return false;
        }
    }
    public function setClave($value)
    {
        if ($this->validateAlphanumeric($value, 1, 50)) {
            $this->clave = $value;
            return true;
        } else {
            return false;
        }
    }
    public function setIdtipo($value)
    {
        if ($this->validateNaturalNumber($value)) {
            $this->idtipo = $value;
            return true;
        } else {
            return false;
        }
    }
    public function setTipo($value)
    {
        if ($this->validateAlphanumeric($value, 1, 50)) {
            $this->tipo = $value;
            return true;
        } else {
            return false;
        }
    }
    public function getId()
    {
        return $this->id;
    }
    public function getNombre()
    {
        return $this->nombre;
    }
    public function getUsuario()
    {
        return $this->usuario;
    }
    public function getTipoU()
    {
        return $this->tipou;
    }
    public function getClave()
    {
        return $this->clave;
    }
    public function getIdtipo()
    {
        return $this->idtipo;
    }
    public function getTipo()
    {
        return $this->tipo;
    }
    public function checkUser($usuario)
    {
        $sql = 'SELECT idusuario, tipousuario FROM usuario WHERE usuario = ?';
        $params = array($usuario);
        if ($data = Database::getRow($sql, $params)) {
            $this->id = $data['idusuario'];
            $this->tipou = $data['tipousuario']; 
            $this->usuario = $usuario;
            return true;
        } else {
            return false;
        }
    }

    public function checkPassword($password)
    {
        $sql = 'SELECT contraseña FROM usuario WHERE idusuario = ?';
        $params = array($this->id);
        $data = Database::getRow($sql, $params);
        // Se verifica si la contraseña coincide con el hash almacenado en la base de datos.
        if (password_verify($password, $data['contraseña'])) {
            return true;
        } else {
            return false;
        }
    }
   // ---------------------------------------------------------------------------------------------------------------------

   public function createRow()
   {
    $hash = password_hash($this->clave, PASSWORD_DEFAULT);
       $sql = 'INSERT INTO Usuario (NombreUsuario, Usuario, TipoUsuario, Contraseña)
       VALUES (?,?,?,?)';
       $params = array($this->nombre, $this->usuario, $this->tipou,$hash);
       return Database::executeRow($sql, $params);
   }

   public function readAll()
   {
       $sql = 'SELECT usuario.idusuario, usuario.nombreusuario, usuario.usuario,usuario.contraseña,ven.TipoU
       FROM usuario 
		inner join TipoUsuario as ven
		on usuario.tipousuario = ven.idtipou
       ORDER BY usuario.idusuario ';
       $params = null;
       return Database::getRows($sql, $params);
   }

   public function readOne()
   {
       $sql = 'SELECT usuario.idusuario, usuario.nombreusuario, usuario.usuario,usuario.contraseña,ven.TipoU
       FROM usuario 
		inner join TipoUsuario as ven
		on usuario.tipousuario = ven.idtipou
        where usuario.idusuario = ?
       ';
       $params = array($this->id);
       return Database::getRow($sql, $params);
   }
   public function readOnes()
   {
       $sql = 'SELECT idusuario, nombreusuario
       FROM usuario 
        where idusuario = ?
       ';
       $params = array($this->id);
       return Database::getRow($sql, $params);
   }

   public function updateRow()
   {
       $sql = 'UPDATE usuario 
               SET nombreusuario=?, usuario=?
               WHERE idusuario = ?';
       $params = array($this->nombre, $this->usuario, $this->id);
       return Database::executeRow($sql, $params);
   }
   public function updateRowpass()
   {
    $hash = password_hash($this->clave, PASSWORD_DEFAULT);
       $sql = 'UPDATE usuario 
               SET contraseña = ?
               WHERE idusuario = ?';
       $params = array($hash, $this->id);
       return Database::executeRow($sql, $params);
   }

   public function readAlltipo()
   {
       $sql = 'SELECT idtipou,tipou FROM TipoUsuario WHERE idtipou != 1';
       $params = null;
       return Database::getRows($sql, $params);
   }

}