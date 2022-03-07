<?php 
    /**
     * Para não ter que iniciar a sessão
     * muitas vezes, iniciamos ela no header
     * porque todas as páginas possuem ele
     */
    session_start(); 

    /**
     * Inclui o "núcleo" da aplicação, dentro
     * dela encontramos as inclusões de arquivos
     * e instâncias de classes
     */
    require 'functions.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="<?= URLROOT ?>/styles/style.css" />
    <title>Trabalho tony</title>
</head>
<!-- Verifica se há algum usuário logado, caso não haja, adiciona classes para centralizar o formulário de login -->
<body <?= isset($_SESSION['nome']) ? 'class="container"' : 'class="d-flex flex-column vh-100 align-items-center justify-content-center login-bg"' ?> >
<?= isset($_SESSION['nome']) ? '' : '<div class="login"></div>' ?>
    <header>
        <!-- Checa qual o tipo de usuário está conectado para poder informar o título da página -->
        <h2 class="py-3"><?= isset($_SESSION['perfil']) && ($_SESSION['perfil'] == 'adm') ? 'Painel de Administração' : 'Mestres da Cerveja' ?></h2>
    </header>

    <!-- Barra de alerta para exibir notificações durante a manipulação de dados (criar, editar e deletar) -->
    <div class="alert alert-<?= isset($_GET['status']) ? $_GET['status'] : '' ?>" role="alert"><?= isset($_GET['msg']) ? $_GET['msg'] : '' ?></div>
    
    <!-- Checa se o usuário está logado para poder adicionar ou não o menu da aplicação -->
    <div class="d-flex">
        <aside style="flex: 1; display: <?=  isset($_SESSION['nome']) ? 'block;' : 'none;' ?>">
            <?php isset($_SESSION['nome']) ? require_once 'template/menu.php' : ''; ?>
        </aside>
        <main style="flex: 3;">