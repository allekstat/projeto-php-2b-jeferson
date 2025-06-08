<?php require_once 'backend.php';
if ($_SERVER['REQUEST_METHOD'] === 'POST')
{
    if (!isset($_POST['usuario']) || $_POST['usuario'] === '' || !isset($_POST['senha']) || $_POST['senha'] === '') http_response_code(406); // requisicao nao aceita
    else
    {
        $sql = 'INSERT INTO usuarios (login_usuario, senha_usuario)
                VALUES (:usuario, SHA2(:senha, 512))';
        $conexao = conexao();
        $busca = $conexao -> prepare($sql);
        $busca -> bindParam('usuario', $_POST['usuario'], PDO::PARAM_STR);
        $busca -> bindParam('senha', $_POST['senha'], PDO::PARAM_STR);
        $ok = $busca -> execute();
        if ($ok) 
        {
            $dados = $busca -> fetch(PDO::FETCH_ASSOC);
            $resposta = ['status' => true, 'msg' => 'ok', 'id' => $busca -> lastInsertId()];
        }
        else $resposta = ['status' => false, 'msg' => 'erro'];
        $conexao = null;
        retorno($resposta); // json retornado
    }
}
else
{
    http_response_code(405); // metodo nao permitido
}