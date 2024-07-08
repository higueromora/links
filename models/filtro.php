<?php

class Filtro{
    private $id;
    private $user_id;
    private $categoria;
    private $data_filter;
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

    function setCategoria($categoria){
        $this->categoria = $this->db->real_escape_string($categoria);
    }

    function setDataFilter($data_filter){
        $this->data_filter = $this->db->real_escape_string($data_filter);
    }

    // Getters
    function getId(){
        return $this->id;
    }

    function getUserId(){
        return $this->user_id;
    }

    function getCategoria(){
        return $this->categoria;
    }

    function getDataFilter(){
        return $this->data_filter;
    }

    public function getAll(){
        if(isset($_SESSION['identity'])){
            $user_id = $_SESSION['identity']->id;
            $categorias = $this->db->query("SELECT * FROM filtros WHERE user_id=$user_id;");
            return $categorias;
        }else{
            return null;
        }
    }

    public function save() {
        $user_id = $_SESSION['identity']->id;
        $query = $this->db->query("SELECT categoria FROM filtros WHERE categoria = '{$this->categoria}' and user_id ='$user_id'");
        $row_cnt = $query->num_rows;
        if ($row_cnt > 0) {
            return false;
        }

        $sql = "INSERT INTO filtros (user_id, categoria, data_filter) VALUES ($user_id, '{$this->getCategoria()}', '{$this->getDataFilter()}')";
        $save = $this->db->query($sql);
        return $save ? true : false;
    }

    public function delete() {
        $user_id = $_SESSION['identity']->id;
        $sql = "DELETE FROM filtros WHERE user_id=$user_id AND categoria='{$this->getCategoria()}';
        DELETE FROM recursos WHERE clase = '{$this->getCategoria()}'";
        $delete = $this->db->multi_query($sql);
        return $delete ? true : false;
    }

    public function update() {
        
        $user_id = $_SESSION['identity']->id;
        $nuevaCategoria = $this->db->real_escape_string($_POST['nuevaCategoria']);
        
        $query = $this->db->query("SELECT categoria FROM filtros WHERE categoria = '$nuevaCategoria' and user_id = '$user_id'");
        $row_cnt = $query->num_rows;
        if ($row_cnt > 0) {
            return false;
        }

        $sql = "UPDATE filtros SET categoria = '$nuevaCategoria', data_filter = '$nuevaCategoria' WHERE user_id = '$user_id' AND categoria = '{$this->getCategoria()}';
        UPDATE recursos SET clase = '$nuevaCategoria' WHERE user_id = '$user_id' AND clase = '{$this->getCategoria()}';";

        $update = $this->db->multi_query($sql);
        return $update ? true : false;
    }
}


?>