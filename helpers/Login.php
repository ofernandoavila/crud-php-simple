<?php

/**
 * Classe onde possui todos as funções de 
 * autenticação da aplicação
 */
class Login {
    /**
     * Recebe como parâmetro a conexão do banco de dados
     * quando a classe é instânciada
     */
    public function __construct($db) {
        /**
         * Atribui a conexão à variável local
         * dbConnection
         * 
         * @param dbConnection variável que faz a ponte entre a aplicação e o banco de dados 
         */
        $this->dbConnection = $db;
    }

    /**
     * Função que verifica as credenciais do usuário a ser logado
     */
    public function logIn() {
        /**
         * Quando o botão de login é pressionado, o valor 'login'
         * é inserido dentro da variável global $_POST
         */
        if(isset($_POST['login'])) {
            $login = $_POST['usuario'];
            $senha = md5($_POST['senha']);

            /**
             * Query SQL que faz a verificação dos dados a partir do
             * usuário e senha inseridos pelo usuário
             */
            $result = mysqli_query($this->dbConnection, "select * from usuario where login = '".$login."' and senha = '".$senha."'");
            
            /**
             * Caso exista apenas um resultado na verificação,
             * os dados do usuário são importados do banco
             */
            if(mysqli_num_rows($result) == 1) {
                $row = mysqli_fetch_array($result);
                
                /**
                 * Os dados do usuários são armazenados dentro da sessão
                 */
                $_SESSION['nome'] = $row['nome'];
                $_SESSION['perfil'] = $row['perfil'];
                $_SESSION['tempo'] = time();

                /**
                 * O usuário é redirecionado para a página principal do sistema
                 */
                header('location: ' . URLROOT . '/index.php');
            } else {
                /**
                 * Erro genérico após a tentativa de validação de usuário
                 */
                $erro = 'usuário ou senha incorreto';
                /**
                 * O usuário é redirecionado para a página de login,
                 * com a mensagem de erro e seu nome de usuário já 
                 * inserido no campo de 'usuário' do formulário
                 */
                header('location: ' . URLROOT . '/index.php?status='. $erro . '&usuario=' . $login);
            }
        }
    }

    private function validacaoEmail($email) {
        if($email == '') return false;
        $result = mysqli_query($this->dbConnection, "select * from usuario where email = '".$email."'");
        return mysqli_num_rows($result) == 0 ? true : false;
    }

    private function validacaoSenha($senha, $confirmar) {
        if($senha == '' || $confirmar == '') {
            return false;
        } else {
            if( $senha != $confirmar ) return false;
            else return true;
        }
    }

    private function validacaoUsuario($user) {
        if($user == '') return false;
        $result = mysqli_query($this->dbConnection, "select * from usuario where login = '".$user."'");
        return mysqli_num_rows($result) == 0 ? true : false;
    }

    /**
     * Função que realiza o logoff do usuário no sistema
     */
    public function logOff() {
        /**
         * Quando o botão de logoff é pressionado, o valor 'logoff'
         * é inserido dentro da variável global $_POST
         */
        if(isset($_POST['logoff'])) {
            /**
             * A sessão é destruída, removendo todos os dados
             * armazenados do usuário na sessão
             */
            session_destroy();
            /**
             * O usuário é redirecionado para a página de login novamente
             */
            header('location: ' . URLROOT);
        }
    }

    public function signUp() {
        if(isset($_POST['cadastrar'])) {
            $data = array(
                'nome' => $_POST['nome'],
                'usuario' => $_POST['usuario'],
                'email' => $_POST['email'],
                'senha' => $_POST['senha'],
                'confirmar' => $_POST['confirmar-senha']
            );

            $redirect = "location: " . URLROOT . '/index.php';
            $error = '&status=';
            $dataQuery = '&usuario=' . $data['usuario'] . '&nome=' . $data['nome'] . '&email=' . $data['email'];

            if($this->validacaoSenha($data['senha'], $data['confirmar'])) {
                if($this->validacaoEmail($data['email'])) {
                    if($this->validacaoUsuario($data['usuario'])) {
                        if(mysqli_query( $this->dbConnection, "insert into usuario (idUsuario, nome, email, login, senha, perfil) values (NULL, '" . $data['nome'] . "', '" . $data['email'] . "', '" . $data['usuario'] . "', '" . md5($data['senha']) . "', 'user')")) {
                            $redirect .= '?&status=Conta criada com sucesso!'. $dataQuery;
                            header($redirect);
                        } else {
                            $error .= 'Ocorreu um erro ao criar a conta';
                            $redirect .= '?cadastro=true'. $error . $dataQuery;
                            header($redirect);
                        }
                    } else {
                        if($data['email'] == '') $error .= 'Insira um nome de usuário válido';
                        else $error .= 'Este nome de usuário já existe';
                        $redirect .= '?cadastro=true'. $error . $dataQuery;
                        header($redirect);
                    }
                } else {
                    if($data['email'] == '') $error .= 'Insira um email válido';
                    else $error .= 'Este email já consta em nossa base de dados';
                    $redirect .= '?cadastro=true'. $error . $dataQuery;
                    header($redirect);
                }
            } else {
                $error .= 'As senhas devem ser iguais';
                $redirect .= '?cadastro=true'. $error . $dataQuery;
                header($redirect);
            }
        }
    }
}

