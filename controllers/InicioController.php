<?php
require_once 'models/filtro.php';
require_once 'models/recurso.php';

class InicioController{
    public function index(){
        require_once 'views/home/inicio.php';
    }

    public function contenido(){
        Utils::isIdentified();
        $categoria = new Filtro;
        $categorias = $categoria->getAll();
        $recurso = new Recursos;
        $recursos = $recurso->getAll();
        require_once 'views/home/contenido.php';
    }

}

?>