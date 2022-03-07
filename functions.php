<?php

/**
 * Cria uma constante para que não haja a
 * necessidade de colocar o endereço URL em
 * todos os links e, caso mude, só será necessário
 * alterar esta constante
 * 
 * Inserir URL dentro das aspas seguindo o modelo:
 * 'http://localhost/nome_da_aplicação'
 * 
 * ATENÇÃO: NÃO UTILIZAR BARRA DE ESPAÇO NO FINAL
 */
define('URLROOT', 'INSIRA AQUI O URL DA APLICAÇÃO');

/**
 * Inclusão de arquivos essenciais da aplicação
 * tais como: Banco de dados (database.php),
 * Controle de Login (Login.php) e Regras de negócio
 * das cervejas (Cerveja.php)
 */
require 'db/database.php';
require_once 'helpers/Login.php';
require_once 'models/Cerveja.php';

/**
 * Instânciamento das classes que dão vida à aplicação
 */
$login = new Login($conexao);
$cerveja = new Cerveja($conexao);

/**
 * Renderiza os itens da tabela de cervejas
 */
function listarCervejas($cervejas) {
    foreach($cervejas as $cerveja) { ?>
        <tr>
            <th scope="row"><?= $cerveja['id'] ?></th>
            <td><?= $cerveja['nome'] ?></td>
            <td><?= $cerveja['marca'] ?></td>
            <td>R$ <?= $cerveja['FORMAT(preco,2)'] ?></td>
            <?= $_SESSION['perfil'] == 'adm' ? '
                <td>
                    <a href="' . URLROOT . '/pages/editar.php?id=' . $cerveja['id'] . '">Editar</a>
                    <a href="' . URLROOT . '/pages/deletar.php?id=' . $cerveja['id'] . '">Apagar</a>
                </td>
            ' : '' ?>
        </tr>
    <?php }
}