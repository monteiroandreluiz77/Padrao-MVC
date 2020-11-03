<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: DELETE");
header("content-type: application/json");
header("Access-Control-Allow-Headers: Content-Type");

if ($_SERVER['REQUEST_METHOD'] == "DELETE") {

    $conteudo = file_get_contents('php://input');

    $dados = json_decode($conteudo, true);
    if ($dados != null) {
        $id = $dados['id'];

        include '../ConexaoG.php';

        $sql = "delete from empresa1 where id = '$id'";

        $resultado = mysqli_query($conexaoG, $sql) or die(mysqli_error($sql));


        if ($resultado) {
            $mensagem = "Empresa Deletada do Registro!";
        }
    }
} else {
    $mensagem = "Use o Metódo DELETE";
}
$retorno["Mensagem"] = $mensagem;
echo json_encode($retorno);
