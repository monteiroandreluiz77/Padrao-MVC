<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: Content-Type");
header("content-type: application/json");

if ($_SERVER['REQUEST_METHOD'] == "POST") {

    $dados = json_decode(file_get_contents('php://input'), true);

    if ($dados != null) {
        $razao = $dados['razao'];
        $nome = $dados['nome'];
        $cnpj = $dados['cnpj'];
        $dataAbertura = $dados['dataAbertura'];

        if ($razao == "") {
            $mensagem = "Digite a Razão Social";
        } else if ($nome == "") {
            $mensagem = "Digite o Nome Fantasia";
        } else if ($cnpj == "") {
            $mensagem = "Digite um CNPJ";
        } else if ($dataAbertura == "") {
            $mensagem = "Digite uma Data de Abertura";
        } else {


            include "../ConexaoG.php";

            $sql = "INSERT INTO empresa1 (razao,nome,cnpj, dataAbertura) values ( '$razao','$nome', '$cnpj','$dataAbertura')";
            $resultado = mysqli_query($conexaoG, $sql) or die(mysqli_error($conexaoG));
            if ($resultado) {
                $mensagem = "Nova Empresa Cadastrada!";
            }
        }
    }
} else {
    $mensagem["Mensagem"] = "Use o Metódo POST";
}
$retorno["Mensagem"] = $mensagem;
echo json_encode($retorno);

