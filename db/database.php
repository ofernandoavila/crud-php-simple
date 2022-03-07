<?php

/**
 * Credenciais para acessar o banco de dados
 */
$host = '';
$user = '';
$pass = '';
$db = '';

/**
 * Conexão com o banco de dados estabelecida 
 * e armazenada na variável 'conexão'
 */
$conexao = mysqli_connect($host, $user, $pass, $db);
