<?php 
require_once 'views/layout/header.php';
?>
<?php if (isset($_SESSION['identity'])): ?>
    
    <main>
        <div class="crear-recurso">
            <div id="resultado-creado"></div>
            <h1>Crear nuevo recurso</h1>
            <form id="formulario-creado" method="POST" class="style-flex">
                <label for="subcategoria">Título de tu recurso</label>
                <input type="text" name="subcategoria" required maxlength="51">
        
                <label for="url">Url de tu recurso</label>
                <input type="text" name="url" required>
        
                <label for="clase">Categoría a asociar</label>
                <select name="clase">
                    <?php while($data = $datas->fetch_object()): ?>
                        <option value="<?=$data->data_filter;?>"><?=$data->data_filter;?></option>
                    <?php endwhile; ?>
                </select>
                <br>
                <input class="Guardar" type="submit" value="Guardar">
            </form>
        </div>

        <div class="actualizar-recurso">
            <div id="resultado-actualizado"></div>
            <h1>Cambiar nombre Recurso</h1>
            <form id="formulario-actualizado" method="POST" class="style-flex">
                <label for="searchSubcategoria">Limita tu búsqueda de recurso a actualizar</label>
                <input type="text" id="searchSubcategoria" placeholder="Buscar recurso">
                <br>
                <label for="subcategoria">Recurso a actualizar</label>
                <select name="subcategoria" id="subcategoria">
                    <?php while($subcat = $subcategorias->fetch_object()): ?>
                        <option value="<?=$subcat->subcategoria;?>" data-url="<?=$subcat->url;?>" data-clase="<?=$subcat->clase;?>"><?=$subcat->subcategoria;?></option>
                    <?php endwhile; ?>
                </select>
                <label for="nuevaSubcategoria">Nuevo nombre</label>
                <input type="text" name="nuevaSubcategoria" id="nuevaSubcategoria" placeholder="Nuevo nombre" maxlength="51">
                <br>
                <label for="url">Url a actualizar</label>
                <input type="text" name="url" id="url" placeholder="Url a actualizar" readonly>
                <label for="nuevaUrl">Nueva url</label>
                <input type="text" name="nuevaUrl" id="nuevaUrl" placeholder="Nueva url">
                <br>
                <label for="clase">Filtro a actualizar</label>
                <input type="text" name="clase" id="clase" placeholder="Clase a actualizar" readonly>
                <label for="nuevaClase">Nuevo filtro</label>
                <select name="nuevaClase" id="nuevaClase">
                    <?php
                    $clasesMostradas = array();
                    while($subcat = $subcategorias2->fetch_object()): 
                        if (!in_array($subcat->categoria, $clasesMostradas)): 
                            $clasesMostradas[] = $subcat->categoria;
                    ?>
                        <option value="<?=$subcat->categoria;?>"><?=$subcat->categoria?></option>
                    <?php 
                        endif;
                    endwhile; 
                    ?>
                </select>
                <br>
                <input class="Actualizar" type="submit" value="Actualizar">
            </form>
        </div>
        <script src="<?=base_url?>assets/js/updateRecurso.js"></script>
        
        <div class="borrar-recurso">
            <div id="resultado-borrado"></div>
            <h1>Borrar Recurso</h1>
            <form id="formulario-borrado" method="POST" class="style-flex">
                <label for="searchSubcategoriadelete">Limita tu búsqueda de recurso a actualizar</label>
                <input type="text" id="searchSubcategoriadelete" placeholder="Buscar recurso a borrar">
                <br>
                <label for="subcategoria-borrar">Recurso a borrar</label>
                <select id="subcategoria-borrar" name="subcategoria-borrar">
                    <?php while($subcat = $subcategorias3->fetch_object()): ?>
                        <option value="<?=$subcat->subcategoria;?>"><?=$subcat->subcategoria;?></option>
                    <?php endwhile; ?>
                </select>
                <br>
                <input id="btn-borrar" class="Borrar" type="submit" value="Borrar">
            </form>
        </div>
    </main>
    <script>
        $(document).ready(function () {
            $('#formulario-creado').submit(function (e) { 
                e.preventDefault();
                $.ajax({
                    type: "POST",
                    url: "<?=base_url?>recurso/save",
                    data: $(this).serialize(),
                    dataType: "json",
                    success: function (response) {
                        if(response.success){
                            $('#resultado-creado').html(response.message + response.nuevaSubcategoria);

                            let newOption = $('<option></option>')
                                .text(response.nuevaSubcategoria)
                                .val(response.nuevaSubcategoria)
                                .attr('data-url', response.nuevaUrl) 
                                .attr('data-clase', response.nuevaClase)
                                .addClass(response.nuevaClase);
                            $('#subcategoria').append(newOption);

                            $('#nuevaSubcategoria').val('');

                            let newOption2 = $('<option></option>')
                                .val(response.nuevaSubcategoria)
                                .text(response.nuevaSubcategoria);

                            $('#subcategoria-borrar').append(newOption2);

                        }else {
                            alert('Fallo en la actualización: ' + response.message);
                        }
                    },
                    error: function() {
                        alert('Ocurrió un error, vuelva a intentarlo');
                    }
                });
            });

            $('#formulario-actualizado').on('submit', function (e) {
                e.preventDefault();
                if (confirm("¿Estás seguro de que deseas actualizar este recurso?")) {
                    $.ajax({
                        type: "POST",
                        url: "<?=base_url?>recurso/update",
                        data: $(this).serialize(),
                        dataType: "json",
                        success: function (response) {
                            if (response.success) {
                                if($('#nuevaSubcategoria').val() !== ''){
                                    let selectedOption = $('#subcategoria').find('option:selected');
                                    selectedOption.text(response.nuevaSubcategoria);
                                    selectedOption.val(response.nuevaSubcategoria);
                                    $('#nuevaSubcategoria').val('');
                                    $('#resultado-actualizado').html('<b>'+ response.message+'</b>');
                                    $('#subcategoria-borrar option[value="' + response.antiguaSubcategoria + '"]').remove();
                                    $('#subcategoria-borrar').append('<option value="' + response.nuevaSubcategoria + '">' + response.nuevaSubcategoria + '</option>');
                                }
                                if($('#nuevaUrl').val() !== ''){
                                    let nuevaUrl = $('#nuevaUrl').val();
                                    $('#url').val(nuevaUrl);
                                    $('#nuevaUrl').val('');
                                    $('#resultado-actualizado').html('<b>'+ response.message+'</b>');
                                }
                                
                                if($('#clase').val() !== $('#nuevaClase').find('option:selected').val()){
                                    $('#resultado-actualizado').html('<b>'+ response.message+'</b>');
                                }
                                let Claseselect = $('#clase');
                                Claseselect.text(response.nuevaClase);
                                Claseselect.val(response.nuevaClase);
                                
                            } else {
                                alert('Fallo en la actualización: ' + response.message);
                            }
                        },
                        error: function() {
                            alert('Ocurrió un error, vuelva a intentarlo');
                        }
                    });
                }
            });

            $('#formulario-borrado').on('submit', function (e) {
                e.preventDefault();
                if (confirm("¿Estás seguro de que deseas borrar este recurso?")) {
                    $.ajax({
                        type: "POST",
                        url: "<?=base_url?>recurso/delete",
                        data: $(this).serialize(),
                        success: function (resultado) {
                            $('#resultado-borrado').html('<b>' + 'Recurso borrado: ' +resultado + '</b>');
                            $('#subcategoria-borrar option[value="' + resultado + '"]').remove();
                            $('#subcategoria option[value="' + resultado + '"]').remove();
                        },
                        error: function (xhr, status, error) {
                            $('#resultado-borrado').html('<b>Error en la solicitud</b>');
                        }
                    });
                }
            });
        });
    </script>
<?php else: ?>
    <?=header("Location:".base_url."inicio/index");?>
<?php endif; ?>
