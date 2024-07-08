<?php 
require_once 'views/layout/header.php';
?>
<?php if (isset($_SESSION['admin'])): ?>
<h1 class="title">Gestor de Usuarios</h1>

<main>
    <div class="borrar-recurso">
        <div id="resultado-borrado"></div>
        <h1>Borrar Usuario</h1>
        <form id="borrar-usuario" method="POST" class="style-flex">
            <label for="usuario">Usuario a borrar</label>
            <select id="usuario-borrar" name="usuario">
                <?php while($user = $users->fetch_object()): ?>
                    <option data-id="<?=$user->id;?>" class="" value="<?=$user->username;?>"><?=$user->username;?></option>
                    <?php endwhile; ?>
                    <input id="btn-borrar" class="Borrar" type="submit" value="Borrar">
            </select>
        </form>
    </div>
</main>
<script>
    $(document).ready(function () {
        $('#btn-borrar').click(function (e) { 
            e.preventDefault();
            let selectedOption = $('#usuario-borrar option:selected');
            let id = selectedOption.data('id');
            let username = selectedOption.val();
            
            $.ajax({
                type: "POST",
                url: "<?=base_url?>usuario/deleteUser",
                data: {
                    id: id,
                    usuario: username
                },
                success: function (response) {
                    $('#resultado-borrado').html('Usuario borrado con éxito: ' + username);
                    selectedOption.remove(); 
                },
                error: function() {
                    alert('Ocurrió un error, vuelva a intentarlo');
                }
            });
        });
    });
</script>
<?php else: ?>
    <?=header("Location:".base_url."inicio/index");?>
<?php endif; ?>