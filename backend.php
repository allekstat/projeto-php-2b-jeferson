<?php
ini_set('display_errors', '1');
header('Content-Type: application/json');
function conexao() : PDO | null
{
    $host = 'localhost';
    $dbname = 'jefphp';
    $username = 'root';
    $password = 'root';
    $dsn = "mysql:host=$host;dbname=$dbname";
    try
    {
        $conexao = new PDO($dsn, $username, $password);
        $conexao -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $conexao;
    }
    catch(PDOException $erro)
    {
        echo $erro -> getMessage();
        return null;
    }
}
function retorno(array $dados)
{
    echo json_encode($dados);
    exit();
}
function select(array | string $campos = '*', string $tabela) : array
{
    if (is_array($campos)) $campos = implode(', ', $campos);
    $sql = "SELECT $campos FROM $tabela";
    $conexao = conexao();
    $busca = $conexao -> query($sql);
    $dados = $busca -> fetchAll(PDO::FETCH_ASSOC);
    $conexao = null;
    return $dados;
}
function insert(string $tabela, array | null $campos, array $valores) : int | false
{
    if (is_null($campos)) $campos = [];
    $campos = implode(', ', $campos);
    for ($i = 0; $i < count($valores); $i++)
    {
        if (is_null($valores[$i])) $valores[$i] = 'null';
        else if (is_string($valores[$i])) $valores[$i] = '"' . $valores[$i] . '"';
    }
    $valores = implode(', ', $valores);
    if ($campos != '') $campos = "($campos)";
    $sql = "INSERT INTO $tabela $campos VALUES ($valores)";
    $conexao = conexao();
    $estruturamento = $conexao -> prepare($sql);
    $afetados = $estruturamento -> execute();
    $conexao = null;
    return $afetados;
}
retorno((array)insert('materiais', null, [null, 'alexsandermaterio']));
