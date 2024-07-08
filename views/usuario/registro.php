<?php 
require_once 'views/layout/header.php';
?>
<main>
        <div class="login">
        <h1 class="title">Registrarse</h1>

        <?php if(isset($_SESSION['register']) && $_SESSION['register'] === "Complete"): ?>
                <strong>Registro completado correctamente</strong>
        <?php elseif(isset($_SESSION['register']) && $_SESSION['register'] === "Failed"): ?>
                <strong>Registro fallido, introduce bien los datos</strong>
        <?php endif;?>
        <?php Utils::deleteSession('register');?>

        <form action="<?=base_url?>usuario/save" method="POST" class="style-flex">
        <label for="nombre">Nombre</label>
        <input type="text" name="nombre" required>

        <label for="email">Email</label>
        <input type="email" name="email" required>

        <label for="password">Contraseña</label>
        <input type="password" name="password" required>

        <input class="btn-blue" type="submit" value="Registrarse">
        </form>
        </div>
</main>