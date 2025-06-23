<?php require_once '../backend.php';
$rota = $_SERVER['PATH_INFO'];
ini_set('display_errors', 0);
$caminho_rota = explode('/', $rota);
array_shift($caminho_rota);
switch ($caminho_rota[0])
{
    case 'usuarios':
        api_usuarios($caminho_rota[1]);
        break;
    case 'login':
        api_login();
        break;
    case 'cadastro':
        api_cadastro();
        break;
    case 'redirecionar':
        api_redirecionar($caminho_rota[1]);
        break;
    case 'logoff':
        session_start();
        session_destroy();
        retorno(200, 'ok');
        break;
    case 'dados':
        api_dados();
        break;
    case 'peca':
        api_pecas($caminho_rota[1]);
        break;
    case 'chapa':
        api_chapa($caminho_rota[1]);
        break;
    default:
        retorno(404, 'rota nao encontrada');
        break;
}
function api_usuarios($id)
{
    if (!isset($id) || $id == '') $id = null;
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
function api_login()
{
    if ($_SERVER['REQUEST_METHOD'] != 'POST') retorno(405, 'post obrigatório');
    if (!isset($_POST['usuario']) || !isset($_POST['senha'])) retorno(400, 'usuario e senha requeridos');
    $usuario = $_POST['usuario'];
    $senha = $_POST['senha'];
    $usuarios = select('nome_usuario', 'usuarios', "login_usuario = '$usuario' AND senha_usuario = '$senha'");
    if (count($usuarios) > 0)
    {
        session_start();
        $_SESSION['usuario_logado'] = true;
        $_SESSION['dados_usuario'] = $usuario;
        $id_usuario = select('id_usuario', 'usuarios', ["login_usuario = '$usuario'", "senha_usuario = '$senha'"])[0]['id_usuario'];
        $_SESSION['id_usuario'] = $id_usuario;
        retorno(200, 'ok');
    }
    else retorno(401, 'usuario ou senha invalidos');
}
function api_cadastro()
{
    if ($_SERVER['REQUEST_METHOD'] != 'POST') retorno(405, 'post obrigatório');
    if (!isset($_POST['usuario']) || !isset($_POST['senha'])) retorno(400, 'usuario e senha requeridos');
    $usuario = $_POST['usuario'];
    $senha = $_POST['senha'];
    try { $usuarios = insert('usuarios', ['login_usuario', 'senha_usuario'], [$usuario, $senha]); }
    catch (PDOException $e)
    {
        if ($e -> getCode() == 23000) retorno(409, 'usuario ja cadastrado');
        retorno(500, 'erro ao criar usuario', [$e -> getMessage()]);
    }
    if ($usuarios > 0)
    {
        session_start();
        $_SESSION['usuario_logado'] = true;
        $_SESSION['dados_usuario'] = $usuario;
        $id_usuario = select('id_usuario', 'usuarios', ["login_usuario = '$usuario'", "senha_usuario = '$senha'"])[0]['id_usuario'];
        $_SESSION['id_usuario'] = $id_usuario;
        retorno(201, 'usuario criado');
    }
}
function api_redirecionar($pagina_alvo)
{
    if ($_SERVER['REQUEST_METHOD'] != 'GET') retorno(405, 'get obrigatório');
    if (!isset($pagina_alvo) || $pagina_alvo == '') retorno(400, 'pagina requerida');
    session_start();
    $_SESSION['pagina'] = $pagina_alvo;
    retorno(200, 'ok');
}
function api_dados()
{
    session_start();
    retorno(200, 'ok', ['nome' => isset($_SESSION['dados_usuario']) ? $_SESSION['dados_usuario'] : '']);
}
function api_pecas($id)
{
    if (!isset($id) || $id == '') $id = null;
    switch ($_SERVER['REQUEST_METHOD'])
    {
        case 'GET':
            session_start();
            $pecas = select(['*'], 'Peca', [is_null($id) ? "" : "Cod_Peca = $id"]);
            $codigo = count($pecas) > 0 ? 200 : 400;
            $mensagem = count($pecas) > 0 ? 'ok.' : 'nenhum resultado.';
            retorno($codigo, $mensagem, $pecas);
            break;
        case 'DELETE':
            if (is_null($id)) retorno(400, 'proibido apagar todos');
            $afetados = delete('Peca', "Cod_Peca = $id");
            $codigo = $afetados > 0 ? 200 : 400;
            $mensagem = $afetados > 0 ? 'ok.' : 'nenhum resultado.';
            retorno($codigo, $mensagem, ['removidos' => $afetados]);
            break;
        case 'POST':
            if (!is_null($id)) retorno(400, 'proibido sobrescrever');
            session_start();
            if (!isset($_POST['campos']) || !isset($_POST['valores'])) {
                retorno(400, 'Campos ou valores não enviados.');
            }
            $afetados = insert('Peca', $_POST['campos'], $_POST['valores']);
            $codigo = $afetados > 0 ? 200 : 400;
            $mensagem = $afetados > 0 ? 'peca criada.' : 'nao criado.';
            retorno($codigo, $mensagem, ['criados' => $afetados]);
            break;
    }
}

function api_chapa($id)
{
    if (!isset($id) || $id == '') $id = null;
    switch ($_SERVER['REQUEST_METHOD'])
    {
        case 'GET':
            session_start();
            $chapa = select(['*'], 'chapa');
            $codigo = count($chapa) > 0 ? 200 : 400;
            $mensagem = count($chapa) > 0 ? 'ok.' : 'nenhum resultado.';
            retorno($codigo, $mensagem, $chapa);
            break;
        case 'DELETE':
            if (is_null($id)) retorno(400, 'proibido apagar todos');
            $afetados = delete('chapa', "Cod_Chapa = $id");
            $codigo = $afetados > 0 ? 200 : 400;
            $mensagem = $afetados > 0 ? 'ok.' : 'nenhum resultado.';
            retorno($codigo, $mensagem, ['removidos' => $afetados]);
            break;
        case 'POST':
            if (!is_null($id)) retorno(400, 'proibido sobrescrever');
            session_start();
            $afetados = insert('chapa', $_POST['campos'] ,$_POST['valores']);
            $codigo = $afetados > 0 ? 200 : 400;
            $mensagem = $afetados > 0 ? 'Chapa criada.' : 'Não criada.';
            retorno($codigo, $mensagem, ['criados' => $afetados]);
            break;
        case 'UPDATE':
            if(!is_null($id)) retorno(400, 'proibido sobrescrever');
            session_start();
            $afetados = update('chapa', $_POST['campos'], $_POST['valores']);
            $codigo = $afetados > 0 ? 200 : 400;
            $mensagem = $afetados > 0 ? 'Chapas atualizadas.' : 'Sem atualização.';
            retorno($codigo, $mensagem, ['Atualizados' => $afetados]);
            break;
    }
}
