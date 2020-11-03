<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: Content-Type");
header("content-type: application/json");
header("Access-Control-Allow-Methods: PUT");

$dados = json_decode(file_get_contents('php://input'), true);

if ($dados != null) {
    $id = $dados['id'];
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

        $sql = "UPDATE empresa1 SET razao ='$razao', nome ='$nome',cnpj ='$cnpj', dataAbertura ='$dataAbertura'where id = '$id' ";

        $resultado = mysqli_query($conexaoG, $sql) or die(mysqli_error($conexaoG));

        if ($resultado) {
            $mensagem = "Atualização de Dados da Empresa Realizada!";
        }

    }
} else {
    $mensagem = "Informe a Empresa!";
}
$retorno["Mensagem"] = $mensagem;
echo json_encode($retorno);