<?php

class Usuario{
    private $id;
    private $username;
    private $password;
    private $email;
    private $role;
    private $db; 

    public function __construct(){
        $this->db = Connect::connect(); 
    }

    // Setters

    function setId($id){
        $this->id = $this->db->real_escape_string($id);
    }

    function setUsername($username) {
        $this->username = $this->db->real_escape_string($username);
    }

    function setPassword($password) {
        $this->password = password_hash($password, PASSWORD_BCRYPT, ['cost' => 4]);
    }

    function setEmail($email) {
        $this->email = $this->db->real_escape_string($email);
    }

    function setRole($role) {
        $this->role = $this->db->real_escape_string($role);
    }

    // Getters

    function getId(){
        return $this->id;
    }

   function getUsername() {
        return $this->username;
    }

    function getPassword() {
        return $this->password;
    }

   function getEmail() {
        return $this->email;
    }

   function getRole() {
        return $this->role;
    }

    public function save() {
        
        $query = $this->db->query("SELECT id FROM users WHERE email = '{$this->email}'");
        $row_cnt = $query->num_rows;
        if ($row_cnt > 0) {
            return false;
        }

        $sql = "INSERT INTO users (username, password, email) VALUES ('{$this->getUsername()}', '{$this->getPassword()}', '{$this->getEmail()}')";
        $save = $this->db->query($sql);

        return $save ? true : false;
    }

    public function login(){
        $result = false;
        $email = $this->getEmail();
        $password = $_POST['password'];

        $sql = "SELECT * FROM users WHERE email = '$email'";
        $login = $this->db->query($sql);

        if($login && $login->num_rows == 1){
            $usuario = $login->fetch_object();

            $verify = password_verify($password, $usuario->password);
            
            if($verify){
                $result = $usuario;
            }
        }
        return $result;
    }

    public function getRoleUser(){
        if(isset($_SESSION['admin'])){
            $users = $this->db->query("SELECT id,username FROM users WHERE role = 'user'");
            return $users;
        }else{
            return null;
        }
    }

    public function delete() {
        $user_id = $this->getId();
        $sql = "DELETE FROM users WHERE id=$user_id AND username='{$this->getUsername()}'";
        $delete = $this->db->query($sql);
        return $delete ? true : false;
    }

}

?>