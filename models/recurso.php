<?php

class Recursos{
    private $id;
    private $user_id;
    private $subcategoria;
    private $url;
    private $clase;
    private $favorito;
    private $db; 

    public function __construct(){
        $this->db = Connect::connect(); 
    }

    // Setters
    function setId($id){
        $this->id = $this->db->real_escape_string($id);
    }

    function setUserId($user_id){
        $this->user_id = $this->db->real_escape_string($user_id);
    }

    function setSubcategoria($subcategoria){
        $this->subcategoria = $this->db->real_escape_string($subcategoria);
    }

    function setUrl($url){
        $this->url = $this->db->real_escape_string($url);
    }

    function setClase($clase){
        $this->clase = $this->db->real_escape_string($clase);
    }

    function setFavorito($favorito){
        $this->favorito = $this->db->real_escape_string($favorito);
    }

    // Getters
    function getId(){
        return $this->id;
    }

    function getUserId(){
        return $this->user_id;
    }

    function getSubcategoria(){
        return $this->subcategoria;
    }

    function getUrl(){
        return $this->url;
    }

    function getClase(){
        return $this->clase;
    }

    function getFavorito(){
        return $this->favorito;
    }

    public function getAll(){
        if(isset($_SESSION['identity'])){
            $user_id = $_SESSION['identity']->id;
            $recursos = $this->db->query("SELECT * FROM recursos WHERE user_id=$user_id;");
            return $recursos;
        }else{
            return null;
        }
    }

    public function getData(){
        if(isset($_SESSION['identity'])){
            $user_id = $_SESSION['identity']->id;
            $categorias = $this->db->query("SELECT data_filter FROM filtros WHERE user_id=$user_id;");
            return $categorias;
        }else{
            return null;
        }
    }

    public function save() {
        $user_id = $_SESSION['identity']->id;
        $query = $this->db->query("SELECT subcategoria FROM recursos WHERE subcategoria = '{$this->subcategoria}' and user_id ='$user_id'");
        $row_cnt = $query->num_rows;
        if ($row_cnt > 0) {
            return false;
        }

        $sql = "INSERT INTO recursos (user_id, subcategoria, url, clase) VALUES ($user_id, '{$this->getSubcategoria()}', '{$this->getUrl()}', '{$this->getClase()}')";
        $save = $this->db->query($sql);
        return $save ? true : false;
    }

    public function delete() {
        $user_id = $_SESSION['identity']->id;
        $sql = "DELETE FROM recursos WHERE user_id=$user_id AND subcategoria='{$this->getSubcategoria()}'";
        $delete = $this->db->query($sql);
        return $delete ? true : false;
    }

    public function update() {
        $user_id = $_SESSION['identity']->id;
        $fieldsToUpdate = [];
    
        if (!empty($_POST['nuevaSubcategoria'])) {
            $nuevaSubcategoria = $this->db->real_escape_string($_POST['nuevaSubcategoria']);
            $fieldsToUpdate[] = "subcategoria = '$nuevaSubcategoria'";
            
            $query = $this->db->query("SELECT subcategoria FROM recursos WHERE subcategoria = '$nuevaSubcategoria' and user_id ='$user_id'");
            $row_cnt = $query->num_rows;
            if ($row_cnt > 0) {
                return false;
            }
        }

        if (!empty($_POST['nuevaUrl'])) {
            $nuevaUrl = $this->db->real_escape_string($_POST['nuevaUrl']);
            $fieldsToUpdate[] = "url = '$nuevaUrl'";
        }
    
        if (!empty($_POST['nuevaClase'])) {
            $nuevaClase = $this->db->real_escape_string($_POST['nuevaClase']);
            $fieldsToUpdate[] = "clase = '$nuevaClase'";
        }
    
        if (empty($fieldsToUpdate)) {
            return false;
        }
    
        $fieldsToUpdateString = implode(", ", $fieldsToUpdate);
        $sql = "UPDATE recursos SET $fieldsToUpdateString WHERE user_id = '$user_id' AND subcategoria = '{$this->getSubcategoria()}'";
    
        $update = $this->db->query($sql);
        return $update ? true : false;
    }
    
    public function favorito(){
        $user_id = $_SESSION['identity']->id;
        $sql = "UPDATE recursos SET favorito='{$this->getFavorito()}' WHERE user_id = '$user_id' AND id = '{$this->getId()}'";
        
        $update = $this->db->query($sql);
        return $update ? true : false;
    }

}

?>