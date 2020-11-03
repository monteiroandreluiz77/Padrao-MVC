<?php
header("Access-Control-Allow-Headers: Content-Type");
header("Access-Control-Allow-Origin: *");
header("Content-type: application/json");

if ($_SERVER['REQUEST_METHOD'] == "GET") {

    include '../ConexaoG.php';

    $sql = "SELECT id, razao, nome, cnpj,  DATE_FORMAT(dataAbertura, '%d/%m/%Y') dataAbertura from empresa1";

    $resultado = mysqli_query($conexaoG, $sql);


    While ($dado = mysqli_fetch_assoc($resultado)) {
        $dados[] = $dado;

    }

    echo json_encode($dados);

} else {
    $retorno["Mensagem"] = "Utilize o metodo GET";
    echo json_encode($retorno);
}
