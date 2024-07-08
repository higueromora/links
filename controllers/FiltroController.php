<?php
require_once 'models/filtro.php';

class FiltroController{
    public function index(){
        Utils::isIdentified();
        $categoria = new Filtro;
        $categorias = $categoria->getAll();
        $categorias2 = $categoria->getAll();
        require_once 'views/categoria/index.php';
    }

    public function save(){
        Utils::isIdentified();
        $filtro = isset($_POST['categoria']) ? $_POST['categoria'] : false;
        $data_filter = isset($_POST['categoria']) ? $_POST['categoria'] : false;
        

        if($filtro && $data_filter){
            $categoria = new Filtro;
            $categoria->setDataFilter($data_filter);
            $categoria->setCategoria($filtro);
            $save = $categoria->save();
            if ($save === false) {
                echo "Dato repetido";
            }else{
                echo  $filtro;
            }
        }else{
            echo $error = 'Faltan datos';
        }

    }

    public function delete(){
        Utils::isIdentified();
        $filtro = isset($_POST['categoria']) ? $_POST['categoria'] : false;

        if($filtro){
            $categoria = new Filtro;
            $categoria->setCategoria($filtro);
            $delete = $categoria->delete();
            if ($delete) {
                echo $filtro;
            } else {
                echo "Error al borrar el dato";
            }
        }else{
            echo $error = 'Faltan datos';
        }
    }

    public function update(){
        Utils::isIdentified();
        $filtro = isset($_POST['categoria']) ? $_POST['categoria'] : false;
        $nuevaCategoria = isset($_POST['nuevaCategoria']) ? $_POST['nuevaCategoria'] : false;

        if($filtro && $nuevaCategoria){
            $categoria = new Filtro;
            $categoria->setCategoria($filtro);
            $_POST['nuevaCategoria'] = $nuevaCategoria;
            $update = $categoria->update();
            if ($update === false) {
                echo "Dato repetido";
            }else{
                echo "Categoría actualizada con éxito: " . $nuevaCategoria;
            }
        }else{
            echo $error = 'Faltan datos';
        }
    }
}

?>