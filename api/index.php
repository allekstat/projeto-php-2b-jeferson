<?php require_once '../backend.php';
$rota = $_SERVER['PATH_INFO'];
$caminho_rota = explode('/', $rota);
array_shift($caminho_rota);
switch ($caminho_rota[0])
{
    case 'usuarios':
        api_usuarios($caminho_rota[1]);
        break;
    case 'materiais':
        break;
}
function api_usuarios($id)
{
    if ($id == '') $id = null;
    switch ($_SERVER['REQUEST_METHOD'])
    {
        case 'GET':
            $usuarios = select('nome_usuario', 'usuarios', is_null($id) ? '' : "id_usuario = $id");
            $codigo = count($usuarios) > 0 ? 200 : 400;
            $mensagem = count($usuarios) > 0 ? 'ok.' : 'nenhum resultado.';
            retorno($codigo, $mensagem, $usuarios);
            break;
        case 'DELETE':
            if (is_null($id)) retorno(400, 'proibido apagar todos');
            $afetados = delete('usuarios', "id_usuario = $id");
            $codigo = $afetados > 0 ? 200 : 400;
            $mensagem = $afetados > 0 ? 'ok.' : 'nenhum resultado.';
            retorno($codigo, $mensagem, ['removidos' => $afetados]);
            break;
    }
}
