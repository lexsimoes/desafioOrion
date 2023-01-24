<?php


class PessoaController
{

    public static function index()
    {


        include 'app/Models/PessoaModel.php'; // inclusão do arquivo model.

        $model = new PessoaModel(); // Instância da Model
        $model->getAllRows(); // Obtendo todos os registros, abastecendo a propriedade $rows da model.

        include 'app/View/modules/Pessoa/ListaPessoa.php';
    }


    /**
     * Devolve uma View contendo um formulário para o usuário.
     */
    public static function form()
    {
        include 'app/Models/PessoaModel.php'; // inclusão do arquivo model.
        $model = new PessoaModel();

        if(isset($_GET['id'])) // Verificando se existe uma variável $_GET
            $model = $model->getById( (int) $_GET['id']);


        include 'app/View/modules/Pessoa/FormPessoa.php'; // Include da View. Note que a variável $model está disponível na View.
    }



    public static function save()
    {
       include 'app/Models/PessoaModel.php'; // inclusão do arquivo model.

       // Abaixo cada propriedade do objeto sendo abastecida com os dados informados

       $model = new PessoaModel();

       $model->id =  $_POST['id'];
       $model->nome = $_POST['nome'];
       $model->telefone = $_POST['telefone'];
       $model->cpf = $_POST['cpf'];
       $model->placa_do_carro = $_POST['placa_do_carro'];

       $model->save();

       header("Location: /pessoa");
    }


    /**
     * Método para tratar a rota delete.
     */
    public static function delete()
    {
        include 'app/Models/PessoaModel.php'; // inclusão do arquivo model.

        $model = new PessoaModel();

        $model->delete( (int) $_GET['id'] ); // Enviando a variável $_GET como inteiro para o método delete

        header("Location: /pessoa"); // redirecionando o usuário para outra rota.
    }
}
