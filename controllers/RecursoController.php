<?php
require_once 'models/recurso.php';
require_once 'models/filtro.php';


class RecursoController{
    public function index(){
        Utils::isIdentified();
        $recurso = new Recursos;
        $recursos = $recurso->getAll();
        $datas = $recurso->getData();
        $subcategorias = $recurso->getAll();
        $subcategorias3 = $recurso->getAll();
        $subcategoria2 = new Filtro;
        $subcategorias2 = $subcategoria2->getAll();
        require_once 'views/recursos/index.php';
    }

    public function save(){
        Utils::isIdentified();
        $subcategoria = isset($_POST['subcategoria']) ? $_POST['subcategoria'] : false;
        $url = isset($_POST['url']) ? $_POST['url'] : false;
        $clase = isset($_POST['clase']) ? $_POST['clase'] : false;

        if($subcategoria && $url && $clase){
            $recurso = new Recursos;
            $recurso->setSubcategoria($subcategoria);
            $recurso->setUrl($url);
            $recurso->setClase($clase);
            $save = $recurso->save();
            if ($save) {
                $response = [
                    'success' => true, 
                    'message' => 'Recurso guardado con éxito: ',
                    'nuevaSubcategoria' => $subcategoria,
                    'nuevaUrl' => $url,
                    'nuevaClase' => $clase
                ];
            } else {
                $response = ['success' => false, 'message' => 'Dato repetido'];
            }
        }

        
        header('Content-Type: application/json');
        echo json_encode($response);
    }


    public function delete() {
        Utils::isIdentified();
        $subcategoria_data = isset($_POST['subcategoria-borrar']) ? $_POST['subcategoria-borrar'] : false;
    
        if ($subcategoria_data) {
            $subcategoria = new Recursos;
            $subcategoria->setSubcategoria($subcategoria_data);
            $delete = $subcategoria->delete();
            if($delete){
                echo $subcategoria_data;
            }
        }
    }
    
    public function update(){
        Utils::isIdentified();
        $filtro = isset($_POST['subcategoria']) ? $_POST['subcategoria'] : false;
        $nuevaSubcategoria = isset($_POST['nuevaSubcategoria']) ? $_POST['nuevaSubcategoria'] : false;
        $nuevaUrl = isset($_POST['nuevaUrl']) ? $_POST['nuevaUrl'] : false;
        $nuevaClase = isset($_POST['nuevaClase']) ? $_POST['nuevaClase'] : false;
    
        if($filtro && ($nuevaSubcategoria || $nuevaUrl || $nuevaClase)){
            $categoria = new Recursos();
            $categoria->setSubcategoria($filtro);
    
            if ($nuevaSubcategoria) {
                $_POST['nuevaSubcategoria'] = $nuevaSubcategoria;
            }
            if ($nuevaUrl) {
                $categoria->setUrl($nuevaUrl);
            }
            if ($nuevaClase) {
                $categoria->setClase($nuevaClase);
            }
            $update = $categoria->update();
    
            if ($update) {
                $response = [
                    'success' => true, 
                    'message' => 'Recurso actualizado con éxito',
                    'antiguaSubcategoria' => $filtro,
                    'nuevaSubcategoria' => $nuevaSubcategoria,
                    'nuevaUrl' => $nuevaUrl,
                    'nuevaClase' => $nuevaClase
                ];
            } else {
                $response = ['success' => false, 'message' => 'Dato repetido'];
            }
        } else {
            $response = ['success' => false, 'message' => 'Datos insuficientes'];
        }
    
        header('Content-Type: application/json');
        echo json_encode($response);
    }
    
    public function favorito() {
        Utils::isIdentified();
        $favorito = isset($_POST['data']) ? $_POST['data'] : false;
        $id = isset($_POST['id']) ? $_POST['id'] : false;


        if ($favorito && $id) {
            $marcado = new Recursos;
            $marcado->setFavorito($favorito);
            $marcado->setId($id);
            $marcadorFav = $marcado->favorito();
            if($marcadorFav){
                echo $favorito;
            } else {
                echo 'Error updating favorito';
            }
        } else {
            echo 'Invalid data or id';
        }
    
    }
    
    
    

}

?>