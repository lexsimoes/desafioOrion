<?php


class PessoaModel
{
    /**
     * Declaração das propriedades conforme campos da tabela no banco de dados.
     */
    public $id, $nome, $telefone, $cpf, $placa_do_carro;



    public $rows;


    /**
     * o model preenchido.
     */
    public function save()
    {
        include 'app/DAO/PessoaDAO.php'; // Incluí o arquivo DAO


        $dao = new PessoaDAO();

        // Verificando se a propriedade id foi preenchida no model

        if(empty($this->id))
        {

            $dao->insert($this);

        } else {

            $dao->update($this); // Como existe um id, passando o model para ser atualizado.
        }
    }



    public function getAllRows()
    {
        include 'app/DAO/PessoaDAO.php'; // Incluíndo o arquivo DAO

        // Instância do objeto e conexão no banco de dados via construtor
        $dao = new PessoaDAO();


        $this->rows = $dao->select();
    }



    public function getById(int $id)
    {
        include 'app/DAO/PessoaDAO.php'; // Incluíndo o arquivo DAO

        $dao = new PessoaDAO();

        $obj = $dao->selectById($id); // Obtendo um model preenchido da camada DAO


        return ($obj) ? $obj : new PessoaModel(); // Operador Ternário

    }



    public function delete(int $id)
    {
        include 'app/DAO/PessoaDAO.php'; // Incluíndo o arquivo DAO

        $dao = new PessoaDAO();

        $dao->delete($id);
    }
}
