<?php require_once 'backend.php';
if ($_SERVER['REQUEST_METHOD'] === 'GET')
{
    if ($_REQUEST['tabela'] === 'materiais')
    {
        $dados = select('*', 'materiais');
        retorno($dados);
    }
    else if ($_REQUEST['tabela'] === 'madeiras')
    {
        $dados = select('*', 'madeira');
        retorno($dados);
    }
}
else if ($_SERVER['REQUEST_METHOD'] === 'POST')
{
    if (isset($_REQUEST['deletar']))
    {
        $id = delete('materiais', $_REQUEST['condicoes']);
        retorno(['status' => 'ok', 'id' => $id]);
    }
    else if ($_REQUEST['tabela'] === 'materiais')
    {
        $id = insert('materiais', $_REQUEST['campos'], $_REQUEST['valores']);
        retorno(['status' => 'ok', 'id' => $id]);
    }
}