<?php 
require_once 'views/layout/header.php';
?>
<?php if (isset($_SESSION['identity'])): ?>
    <main>
        <div class="crear-recurso">
            <h1>Crear nueva categoría</h1>
            <div id="resultado-creado"></div>
            <form method="POST" class="style-flex">
                <label for="categoria">Nombre de Categoría</label>
                <input id="categoriaaguardar" type="text" name="categoria" required>
                <br>
                <input id="guardar-categoria" class="Guardar"  type="submit" value="Guardar">
            </form>
        </div>

        <div class="actualizar-recurso">
            <h1>Cambiar nombre Categoría</h1>
            <div id="resultado-actualizado"></div>
            <form method="POST" class="style-flex">
                <label for="categoria">Categoría a actualizar</label>
                <select id="categoria-actualizar" name="categoria">
                    <?php while($cat = $categorias->fetch_object()): ?>
                        <option value="<?=$cat->categoria;?>"><?=$cat->categoria;?></option>
                    <?php endwhile; ?>
                </select>
                <label for="nuevaCategoria">Nuevo nombre</label>
                <input id="nuevaCategoria" type="text" name="nuevaCategoria" placeholder="Nuevo nombre">
                <br>
                <input id="actualizar-categoria" class="Actualizar" type="submit" value="Actualizar">
            </form>
        </div>

        <div class="borrar-recurso">
            <h1>Borrar Categoría</h1>
            <div id="resultado-borrado"></div>
            <form method="POST" class="style-flex">
                <label for="categoria">Categoría a borrar</label>
                <select id="categoriaaborrar" name="categoria">
                <?php while($cat = $categorias2->fetch_object()): ?>
                    <option value="<?=$cat->categoria;?>"><?=$cat->categoria;?></option>
                <?php endwhile; ?>
                </select>
                <br>
                <input id="categoria-borrar" class="Borrar" type="submit" value="Borrar">
            </form>
        </div>
    </main>
    <script>
        $(document).ready(function () {
            $('#guardar-categoria').click(function (e) { 
                e.preventDefault();
                let categoriaaguardar = $('input[name="categoria"]').val();
                $.ajax({
                    type: "POST",
                    url: "<?=base_url?>filtro/save",
                    data: {
                        categoria: categoriaaguardar
                    },
                    success: function (response) {
                        $('#resultado-creado').html('<p> Categoría creada con éxito: ' + response + '</p>');
                        $('#categoria-actualizar').append('<option value="' + response + '">' + response + '</option>');
                        $('#categoriaaborrar').append('<option value="' + response + '">' + response + '</option>');

                    },
                    error: function() {
                        alert('Ocurrió un error, vuelva a intentarlo');
                    }
                });
            });
            $('#actualizar-categoria').click(function (e) { 
                e.preventDefault();
                let categoriaActualizar = $('#categoria-actualizar option:selected').val();
                let nuevaCategoria = $('#nuevaCategoria').val();
                $.ajax({
                    type: "POST",
                    url: "<?=base_url?>filtro/update",
                    data: {
                        categoria: categoriaActualizar,
                        nuevaCategoria: nuevaCategoria
                    },
                    success: function (response) {
                        $('#resultado-actualizado').html('<p>' + response + '</p>');
                        $('#categoria-actualizar option:selected').text(nuevaCategoria).val(nuevaCategoria);
                        $('#categoriaaborrar option[value="' + categoriaActualizar + '"]').remove();
                        $('#categoriaaborrar').append('<option value="' + nuevaCategoria + '">' + nuevaCategoria + '</option>');
                    },
                    error: function() {
                        alert('Ocurrió un error, vuelva a intentarlo');
                    }
                });
            });
            $('#categoria-borrar').click(function (e) { 
                e.preventDefault();
                let categoriaaborrar = $('#categoriaaborrar option:selected').val();
                if(confirm("¿Estás seguro de que deseas borrar este recurso?")){
                    $.ajax({
                        type: "POST",
                        url: "<?=base_url?>filtro/delete",
                        data: {
                            categoria: categoriaaborrar
                        },
                        success: function (response) {
                            $('#resultado-borrado').html('<p>Dato borrado con éxito: ' + categoriaaborrar + '</p>');
                            $('#categoriaaborrar option:selected').remove();
                            $('#categoria-actualizar option[value="' + response + '"]').remove();
                        }
                    });
                }
            });
        });
    </script>
<?php else: ?>
    <?= show_error();?>
<?php endif; ?>