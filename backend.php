<?php
function conexao() : PDO | null
{
    $host = 'localhost';
    $dbname = 'sistema_marcenaria';
    $username = 'root';
    $password = 'root';
    $dsn = "mysql:host=$host;dbname=$dbname";
    try
    {
        $conexao = new PDO($dsn, $username, $password, ['PDO::MYSQL_ATTR_FOUND_ROWS' => true]);
        $conexao -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $conexao;
    }
    catch(PDOException $erro)
    {
        echo $erro -> getMessage();
        return null;
    }
}
function retorno(int $codigo, string $mensagem, array $dados = [])
{
    $retorno = ['status' => $codigo, 'mensagem' => $mensagem];
    if (count($dados) > 0)
    {
        $retorno['dados'] = $dados;
        $retorno['quantidade'] = count($dados);
    }
    header('Content-Type: application/json');
    http_response_code($codigo);
    echo json_encode($retorno);
    exit;
}
function select(string | array $campos = '*', string  | array $tabelas, string | array $condicoes = '') : array
{
    if (is_array($campos)) $campos = implode(' , ', $campos);
    if (is_array($tabelas)) $tabelas = implode(' JOIN ', $tabelas);
    if (is_array($condicoes)) $condicoes = implode(' AND ', $condicoes);
    $sql = "SELECT $campos FROM $tabelas";
    if ($condicoes) $sql .= " WHERE $condicoes";
    $conexao = conexao();
    $busca = $conexao -> query($sql);
    $dados = $busca -> fetchAll(PDO::FETCH_ASSOC);
    $conexao = null;
    return $dados;
}
function insert(string $tabela, string | array | null $campos, string | array $valores) : int | false
{
    if (is_null($campos)) $campos = [];
    if (is_string($campos)) $campos = [$campos];
    if (is_string($valores)) $valores = [$valores];
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
    $estruturamento -> execute();
    $conexao = null;
    header('Content-Type: application/json');
    return $estruturamento -> rowCount();
}
function delete(string $tabela, string | array $condicoes) : int | false
{
    if (is_string($condicoes)) $condicoes = [$condicoes];
    $condicoes = implode(' AND ', $condicoes);
    $sql = "DELETE FROM $tabela WHERE $condicoes";
    $conexao = conexao();
    $estruturamento = $conexao -> prepare($sql);
    $estruturamento -> execute();
    $conexao = null;
    header('Content-Type: application/json');
    return $estruturamento -> rowCount();
}
function update(string $tabela, string | array $campos, string | array $valores, string | array $condicoes) : int | false
{
    if (is_string($campos)) $campos = [$campos];
    if (is_string($valores)) $valores = [$valores];
    if (is_string($condicoes)) $condicoes = [$condicoes];
    if (count($campos) !== count($valores)) return false;
    $sets = [];
    for ($i = 0; $i < count($campos); $i++)
    {
        if (is_null($valores[$i])) $valores[$i] = 'null';
        else if (is_string($valores[$i])) $valores[$i] = '"' . $valores[$i] . '"';
        $sets[] = $campos[$i] . ' = ' . $valores[$i];
    }
    $sets = implode(', ', $sets);
    $condicoes = implode(' AND ', $condicoes);
    $sql = "UPDATE $tabela SET $sets WHERE $condicoes";
    $conexao = conexao();
    $estruturamento = $conexao -> prepare($sql);
    $estruturamento -> execute();
    $conexao = null;
    header('Content-Type: application/json');
    return $estruturamento -> rowCount();
}
