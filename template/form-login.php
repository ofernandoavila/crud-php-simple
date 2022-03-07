<div class="row">
    <!-- Formulário para fazer login na aplicação, irá chamar a função que faz login dentro de 'models/Login.php' -->
    <form action="<?php $login->logIn(); ?>" method="post" class="form-signin">
        <input type="text" name="usuario"class="form-control mb-3" placeholder="Usuario" value="<?= isset($_GET['usuario']) ? $_GET['usuario'] : ''; ?>">
        <input type="password" name="senha" class="form-control mb-3" placeholder="Senha" >
        <!-- Se houver erro na autenticação, irá mostrar o erro que ocorreu -->
        <?= isset($_GET['error']) ? '<p>' . $_GET['error'] . '</p>': ''; ?>
        <input type="submit" name="login" class="btn btn-lg btn-primary btn-block" value="Login">
    </form>
</div>