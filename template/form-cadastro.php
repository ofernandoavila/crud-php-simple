<div class="row">
    <!-- Formulário para fazer login na aplicação, irá chamar a função que faz login dentro de 'models/Login.php' -->
    <form action="<?php $login->signUp(); ?>" method="post" class="form-signin">
        <input type="text" name="nome"class="form-control mb-3" placeholder="Nome" value="<?= isset($_GET['nome']) ? $_GET['nome'] : ''; ?>">
        <input type="text" name="usuario" class="form-control mb-3" placeholder="Usuario" value="<?= isset($_GET['usuario']) ? $_GET['usuario'] : ''; ?>">
        <input type="email" name="email" class="form-control mb-3" placeholder="Email" value="<?= isset($_GET['email']) ? $_GET['email'] : ''; ?>">
        <input type="password" name="senha" class="form-control mb-3" placeholder="Senha" >
        <input type="password" name="confirmar-senha" class="form-control mb-3" placeholder="Confirmar senha" >
        <!-- Se houver erro na autenticação, irá mostrar o erro que ocorreu -->
        <?= isset($_GET['status']) ? '<p style="color: white">' . $_GET['status'] . '</p>': ''; ?>
        <input type="submit" name="cadastrar" class="btn btn-lg btn-primary btn-block" value="Cadastrar">
    </form>
</div>