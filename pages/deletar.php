<?php
/**
 * Inclusão do cabeçalho junto com
 * as funções essenciais e início
 * da sessão do usuário
 */
require_once '../header.php';

/**
 * Quando o botão de deletar é pressionado
 * pelo usuário, ele é adicionado à variável
 * global $_POST e dispara a delete da cerveja.
 */
if (isset($_POST['deletar'])) {
    /**
     * Chama a função dentro da classe Cerveja (models/Cerveja.php)
     * onde recebe o parâmetro id da cerveja e depois
     * apaga os dados no banco de dados. Retorna
     * uma mensagem que será exibida na caixa de alerta da aplicação
     */
    $msg = $cerveja->deletarCerveja($_GET['id']);
    /**
     * Adiciona uma classe de estilo para que seja
     * positiva a resposta ao usuário
     */
    $status = 'success';
    /**
     * Redireciona o usuário com a mensagem e o estilo
     * a ser colocado na caixa de alerta
     */
    header('location: ' . URLROOT . '/pages/lista.php?msg=' . $msg . '&status=' . $status);
}

/**
 * Realiza uma checagem para ver se
 * tem alguém logado no sistema
 */
if (isset($_SESSION['nome'])) {
    /**
     * Realiza uma checagem para ver se
     * o usuário logado é o adm
     */
    if ($_SESSION['perfil'] == 'adm') {
        /**
         * Cria uma variável que serve para
         * levar os dados da cerveja invocada
         * do banco de dados através do id
         */
        $data = $cerveja->getCerveja($_GET['id']);
        /**
         * Label serve para trocar a etiqueta
         * do botão de deletar a cerveja
         */
        $data['label'] = 'Deletar';
        /**
         * Action serve para passar como parâmetro
         * ao sistema que esta é a função de deletar
         */
        $data['action'] = 'deletar';
        /**
         * Style passa o estilo que troca a cor do botão
         * de delete da cerveja
         */
        $data['style'] = 'danger';
        /**
         * Renderiza o formulário onde é possível
         * fazer a confirmação de delete da
         * cerveja
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
    header('location: ' . URLROOT . '/');
}
/**
 * Inclusão do rodapé da página
 */
require_once '../footer.php';
