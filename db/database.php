<?php

/**
 * Credenciais para acessar o banco de dados
 */
$host = 'localhost';
$user = 'root';
$pass = '';
$db = 'trabalhoTony';

/**
 * Conexão com o banco de dados estabelecida 
 * e armazenada na variável 'conexão'
 */
$conexao = mysqli_connect($host, $user, $pass, $db);