<?php
    require_once 'models/usuario.php';

    class UsuarioController{
        public function index(){
            Utils::isADmin();
            $user = new Usuario;
            $users = $user->getRoleUser();
            require_once 'views/usuario/index.php';
        }

        public function registro(){
            require_once 'views/usuario/registro.php';
        }

        public function login(){
            require_once 'views/usuario/login.php';
        }

        public function save(){
            if(isset($_POST)){

                $nombre = isset($_POST['nombre']) ? trim($_POST['nombre']) : false;
                $email = isset($_POST['email']) ? trim($_POST['email']) : false;
                $password = isset($_POST['password']) ? trim($_POST['password']) : false;

                if($email){
                    $email = filter_var($email, FILTER_SANITIZE_EMAIL);
                    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                        $_SESSION['register'] = "Failed";
                        echo "Esta dirección de correo ($email) no es válida.";
                        header("Location:".base_url.'usuario/registro');
                        exit();
                    }
                }

                if(!$password || strlen($password) < 6){
                    $_SESSION['register'] = "Failed";
                    echo "La contraseña debe tener al menos 6 caracteres";
                    header("Location:".base_url.'usuario/registro');
                    exit();
                }

                if($nombre && $email && $password){
                    $usuario = new Usuario();
                    $usuario->setUsername($nombre);
                    $usuario->setPassword($password);
                    $usuario->setEmail($email);
                    
                    $save = $usuario->save();
                    $_SESSION['register'] = $save ? "Complete" : "Failed";
                }
            }else{
                $_SESSION['register'] = "Failed";
            }
            header("Location:".base_url.'usuario/registro');
        }

        public function iniciarSesion(){
            if(isset($_POST)){

                $email = isset($_POST['email']) ? trim($_POST['email']) : false;

                if($email){
                    $email = filter_var($email, FILTER_SANITIZE_EMAIL);
                    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                        $_SESSION['register'] = "Failed";
                        echo "Esta dirección de correo ($email) no es válida.";
                        header("Location:".base_url.'usuario/login');
                        exit();
                    }
                }

                $usuario = new Usuario();
                $usuario->setEmail($email);
                $usuario->setPassword($_POST['password']);

                $identity = $usuario->login();

                if($identity && is_object($identity)){
                    $_SESSION['identity'] = $identity;

                    if($identity->role == 'admin'){
                        $_SESSION['admin'] = true;
                    }
                }else{
                    $_SESSION['error_login'] = 'Identificación fallida !!';
                }

            }
            header("Location:".base_url."inicio/contenido");
        }

        public function logout(){
            if(isset($_SESSION['identity'])){
                unset($_SESSION['identity']);
            }

            if(isset($_SESSION['admin'])){
                unset($_SESSION['admin']);
            }
            header("Location:".base_url."inicio/index");
        }

        // Todo gestion de usuarios
        public function deleteUser(){
            Utils::isADmin();
            $user = isset($_POST['usuario']) ? trim($_POST['usuario']) : false;
            $id = isset($_POST['id']) ? trim($_POST['id']) : false;

            if($user && $id){
                $usuario = new Usuario();
                $usuario->setUsername($user);
                $usuario->setId($id);
                
                $delete = $usuario->delete();
                if ($delete) {
                    echo "Borrado con éxito";
                }
            }else{
                echo $error = 'Faltan datos';
            }

        }

    }




?>