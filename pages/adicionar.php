<?php 
/**
 * Inclusão do cabeçalho junto com
 * as funções essenciais e início
 * da sessão do usuário
 */
require_once '../header.php';

/**
 * Quando o botão de cadastrar é pressionado
 * pelo usuário, ele é adicionado à variável
 * global $_POST e dispara o cadastro da cerveja.
 */
if(isset($_POST['cadastrar'])) {
    /**
     * Chama a função dentro da classe Cerveja (models/Cerveja.php)
     * onde recebe os dados  a serem incluídos no banco de dados. 
     * Retorna uma mensagem que será exibida na caixa de alerta 
     * da aplicação
     */
    $msg = $cerveja->adicionarCerveja(array(
        "nome" => $_POST['cerveja'],
        "marca" => $_POST['marca'],
        "preco" => $_POST['preco']
    ));

    /**
     * Adiciona uma classe de estilo para que seja
     * positiva a resposta ao usuário
     */
    $status = 'succes';

    /**
     * Redireciona o usuário com a mensagem e o estilo
     * a ser colocado na caixa de alerta
     */
    header('location: ' . URLROOT . '/?msg=' . $msg . '&status=' . $status);
}

/**
 * Realiza uma checagem para ver se
 * tem alguém logado no sistema
 */
if(isset($_SESSION['nome'])) {
    /**
     * Realiza uma checagem para ver se
     * o usuário logado é o adm
     */
    if($_SESSION['perfil'] == 'adm') {
        /**
         * Renderiza o formulário onde é possível
         * fazer a edição da cerveja
         */
        require '../template/form-cerveja.php';
    } else {
        /**
         * Caso o usuário não seja o adm, ele
         * será impedido de acessar esta função
         * do sistema
         */
        echo 'Você não tem permisão para estar aqui!';
    }
} else {
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