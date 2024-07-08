<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Links</title>
    <link rel="stylesheet" href="<?=base_url?>assets/css/styles.css">
</head>
<body>
    <nav class="navbar">
        <div class="logo">
            <img src="<?=base_url?>assets/img/FlatColorIconsBrokenLink.svg" alt="Logo">
        </div>
        <div class="menu-toggle" id="menu-toggle">
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
        </div>
        <ul id="nav-menu" class="nav-menu">
            <?php if(isset($_SESSION['admin'])):?>
                <li><a href="<?=base_url?>usuario/index">Gestionar Usuarios</a></li>
            <?php endif;?>

            <?php if (!isset($_SESSION['identity'])): ?>
                <li><a href="<?=base_url?>inicio/index">Inicio</a></li>
                <li><a href="<?=base_url?>usuario/registro">Registrarse</a></li>
                <li><a href="<?=base_url?>usuario/login">Login</a></li>
            <?php else: ?>
                <li><a href="<?=base_url?>inicio/contenido">Contenido</a></li>
                <li><a href="<?=base_url?>filtro/index">Gestionar Categorias</a></li>
                <li><a href="<?=base_url?>recurso/index">Gestionar Recursos</a></li>
                <li><a href="<?=base_url?>usuario/logout">Cerrar Sesión</a></li>
            <?php endif; ?>
        </ul>
    </nav>
    <?php if(isset($_SESSION['identity'])):?>
        <h1 class="welcome">Bienvenido, <?= $_SESSION['identity']->username ?></h1>
    <?php endif;?>
    <script src="<?=base_url?>assets/js/jquery.js"></script>
    <script>
        document.getElementById('menu-toggle').addEventListener('click', function() {
            var navMenu = document.getElementById('nav-menu');
            navMenu.classList.toggle('active');
        });
    </script>
</body>
</html>

