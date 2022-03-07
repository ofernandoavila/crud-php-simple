<?php

/**
 * Classe onde possui todos as funções que 
 * manipulam os dados do banco de dados
 */
class Cerveja {
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
     * Função que realiza a edição da cerveja previamente
     * importada do banco de dados
     * 
     * @param Number id id da cerveja a ser editada
     * @param Array cerveja array que contém os novos valores da cerveja a ser editada
     */
    public function editarCerveja($id, $cerveja) {
        /**
         * Query SQL que faz a atualização dos dados a partir do número id da cerveja
         */
        if(mysqli_query($this->dbConnection, "UPDATE cervejas SET nome = '" . $cerveja['nome'] . "', marca = '" . $cerveja['marca'] . "', preco = '" . $cerveja['preco'] . "' WHERE id = '" . $id . "'")) {
            /**
             * Retorna uma mensagem a ser exibida para o usuário
             */
            return 'Cerveja alterada com sucesso';
            die;
        } else {
            return 'erro ao alterar';
        }
    }

    /**
     * Função que deleta a cerveja previamente
     * importada do banco de dados
     * 
     * @param Number id id da cerveja a ser apagada
     */
    public function deletarCerveja($id) {
        /**
         * Query SQL que faz o delete dos dados a partir do número id da cerveja
         */
        if(mysqli_query($this->dbConnection, "DELETE FROM cervejas WHERE id = '" . $id . "'")) {
            /**
             * Retorna uma mensagem a ser exibida para o usuário
             */
            return 'Cerveja deletada com sucesso';
            die;
        } else {
            return 'erro ao alterar';
        }
    }
    
    /**
     * Função que realiza a adição da cerveja 
     * no banco de dados
     * 
     * @param Array cerveja array que contém os valores da cerveja a ser inserida no banco de dados
     * @return string mensagem a ser exibida ao usuário 
     */
    public function adicionarCerveja($cerveja) {
        /**
         * Query SQL que faz a inserção dos dados no banco
         */
        if(mysqli_query($this->dbConnection, "INSERT INTO cervejas (id, nome, marca, preco) VALUES (NULL, '" . $cerveja['nome'] . "', '" . $cerveja['marca'] . "', '" . $cerveja['preco'] . "')")) {
            /**
             * Retorna uma mensagem a ser exibida para o usuário
             */
            return 'Cerveja adicionada com sucesso';
        } else {
            return 'erro ao adicionar';
        }
    }

    /**
     * Puxa todos as cervejas presentes no banco de dados
     */    
    public function getCervejas() {
        /**
         * Query SQL que invoca todos os dados dentro da tabela
         */
        if($result = mysqli_query($this->dbConnection, "SELECT *,  FORMAT(preco,2) FROM cervejas")) {
            /**
             * Retorna todos os dados da tabela na forma de array associativa
             */
            return mysqli_fetch_all($result, MYSQLI_ASSOC);
        } else {
            return 'erro ao adicionar';
        }
    }
    
    /**
     * Puxa uma cerveja específica do banco de dados 
     * a partir do número id
     */ 
    public function getCerveja($id) {
        /**
         * Query SQL que invoca cerveja de dentro da tabela
         * a partir do código id dela
         */
        if($result = mysqli_query($this->dbConnection, "SELECT *,  FORMAT(preco,2) FROM cervejas WHERE id = '" . $id . "'")) {
            /**
             * Retorna os dados da tabela na forma de array
             */
            return mysqli_fetch_array($result);
        } else {
            return 'erro ao adicionar';
        }
    }
}