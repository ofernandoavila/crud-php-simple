<!-- Componente 'Menu' que torna possível a navegação na aplicação -->
<ul class="list-group px-3">
    <!-- Checa o tipo de usuário logado na aplicação, se for 'adm' exibe a possibilidade de criar um novo item -->
    <?= ($_SESSION['perfil'] == 'adm') ? '<a href="' . URLROOT . '/pages/adicionar.php" class="text-decoration-none"><li class="list-group-item">+ Adicionar cerveja</li></a>' : '' ?>
    <a href="<?= URLROOT; ?>/pages/lista.php" class="text-decoration-none"><li class="list-group-item">Ver cervejas</li></a>
    <li class="list-group-item">
        <!-- Botão para fazer logoff da aplicação, irá chamar a função que faz logoff dentro de 'models/Login.php' -->
        <form action="<?php $login->logOff(); ?>" method="post">
            <input name="logoff" type="submit" value="Logoff">
        </form>
    </li>
</ul>