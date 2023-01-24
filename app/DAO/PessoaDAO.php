<?php

/**
 * As classes DAO (Data Access Object) são responsáveis por executar os
 * SQL junto ao banco de dados.
 */
class PessoaDAO
{
    private $conexao;

    public function __construct()
    {

        $dsn = "mysql:host=localhost:3306;dbname=db_mvc";

        // Criando a conexão e armazenado na propriedade definida para tal.

        $this->conexao = new PDO($dsn, 'root', '@Augusto25');
    }


    /**
     * Método que recebe um model e extrai os dados do model para realizar o insert
     * na tabela correspondente ao model
     */
    public function insert(PessoaModel $model)
    {
        // Trecho de código SQL com marcadores ? para substituição posterior
        $sql = "INSERT INTO pessoa (nome, telefone, cpf, placa_do_carro) VALUES (?, ?, ?, ?) ";



        $stmt = $this->conexao->prepare($sql);



        $stmt->bindValue(1, $model->nome);
        $stmt->bindValue(2, $model->telefone);
        $stmt->bindValue(3, $model->cpf);
        $stmt->bindValue(4, $model->placa_do_carro);

         // Ao fim, onde todo SQL está montando, executamos a consulta.
        $stmt->execute();
    }



    public function update(PessoaModel $model)
    {
        $sql = "UPDATE pessoa SET nome=?, telefone=?, cpf=?, placa_do_carro=? WHERE id=? ";

        $stmt = $this->conexao->prepare($sql);
        $stmt->bindValue(1, $model->nome);
        $stmt->bindValue(2, $model->telefone);
        $stmt->bindValue(3, $model->cpf);
        $stmt->bindValue(4, $model->placa_do_carro);
        $stmt->bindValue(5, $model->id);
        $stmt->execute();
    }


    /**
     * Método que retorna todas os registros da tabela pessoa no banco de dados.
     */
    public function select()
    {
        $sql = "SELECT * FROM pessoa ";

        $stmt = $this->conexao->prepare($sql);
        $stmt->execute();

        // Retorna um array com as linhas retornadas da consulta.

        return $stmt->fetchAll(PDO::FETCH_CLASS);
    }


    /**
     * Retorna um registro específico da tabela pessoa do banco de dados.
     * Note que o método exige um parâmetro $id do tipo inteiro.
     */
    public function selectById(int $id)
    {
        include_once 'app/Models/PessoaModel.php';

        $sql = "SELECT * FROM pessoa WHERE id = ?";

        $stmt = $this->conexao->prepare($sql);
        $stmt->bindValue(1, $id);
        $stmt->execute();

        return $stmt->fetchObject("PessoaModel"); // Retornando um objeto específico PessoaModel
    }


    /**
     * Remove um registro da tabela pessoa do banco de dados.
     */
    public function delete(int $id)
    {
        $sql = "DELETE FROM pessoa WHERE id = ? ";

        $stmt = $this->conexao->prepare($sql);
        $stmt->bindValue(1, $id);
        $stmt->execute();
    }
}
