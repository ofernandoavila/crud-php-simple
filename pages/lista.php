<?php 

/**
 * Inclusão do cabeçalho junto com
 * as funções essenciais e início
 * da sessão do usuário
 */
require_once '../header.php';

/**
 * Realiza uma checagem para ver se
 * tem alguém logado no sistema
 */
if(isset($_SESSION['nome'])) { ?>
    <!-- Tabela que exibe os itens a serem invocados do banco de dados -->
    <div class="">
        <table class="table">
            <thead>
                <th class="col">#</th>
                <th class="col">Nome</th>
                <th class="col">Marca</th>
                <th class="col">Preço</th>
                <!-- Caso seja o admninstrador, adiciona as opções de editar ou deletar um item -->
                <?= $_SESSION['perfil'] == 'adm' ? '<th class="col">Ações</th>' : '' ?>
            </thead>
            <tbody>
                <!-- Renderiza os itens da tabela utilizando uma função da classe cerveja 'models/Cerveja.php' -->
                <?php listarCervejas($cerveja->getCervejas()); ?>
            </tbody>
        </table>
    </div>
<?php } else {
    /**
     * Caso o usuário não esteja logado, ele será
     * redirecionado para a página de login
     */
    header('location: ' . URLROOT);
}

/**
 * Inclusão do rodapé da página
 */
require_once '../footer.php';