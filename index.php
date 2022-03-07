<?php 

/**
 * Inclui o cabeçalho na página
 */
require_once 'header.php';

/**
 * Verifica se existe alguma sessão já iniciada,
 * caso não encontre, inclui o formulário para que
 * o usuário faça login no sistema
 */
if(!isset($_SESSION['nome'])) {
    require_once 'template/form-login.php';
}
/**
 * Inclui o rodapé na página
 */
require_once 'footer.php';