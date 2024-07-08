<?php 
require_once 'views/layout/header.php';
?>
<?php if (!isset($_SESSION['identity'])): ?>
    <main>
        <div class="login">
            <h1 class="title">Login</h1>
            <form action="<?=base_url?>usuario/iniciarSesion" method="POST" class="style-flex">
                <label for="email">Email</label>
                <input type="email" name="email" required>
                <label for="password">Contraseña</label>
                <input type="password" name="password" required>
                <input class="btn-blue" type="submit" value="Iniciar Sesión">
            </form>
        </div>
    </main>
    <?php if (isset($_SESSION['error_login'])): ?>
        <strong><?= $_SESSION['error_login'] ?></strong>
        <?php unset($_SESSION['error_login']); ?>
    <?php endif; ?>
<?php endif; ?>
