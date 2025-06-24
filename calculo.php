<?php require_once 'backend.php';



function calcularPrecoEstimado($codChapa, $codPeca, $quantidade) {
    $conexao = conexao(); 
    $stmt = $conexao->prepare("
        SELECT Largura_MM, Altura_MM, Espessura, Valor_Chapa
        FROM Chapa
        WHERE Cod_Chapa = ?
    ");
    $stmt->bind_param("i", $codChapa);
    $stmt->execute();
    $stmt->bind_result($larguraChapa, $alturaChapa, $espessuraChapa, $valorChapa);
    $stmt->fetch();
    $stmt->close();

    $stmt = $$conexao->prepare("
        SELECT Largura_MM, Altura_MM, Espessura
        FROM Peca
        WHERE Cod_Peca = ?
    ");
    $stmt->bind_param("i", $codPeca);
    $stmt->execute();
    $stmt->bind_result($larguraPeca, $alturaPeca, $espessuraPeca);
    $stmt->fetch();
    $stmt->close();

    $volumeChapa = $larguraChapa * $alturaChapa * $espessuraChapa;
    $volumePecas = $larguraPeca * $alturaPeca * $espessuraPeca * $quantidade;
    $precoPorMM3 = $valorChapa / $volumeChapa;
    $custoTotal = $volumePecas * $precoPorMM3;

    return round($custoTotal, 2);
    
}



function encaixarPecasNaChapa($codChapa, $conn) {
    $stmt = $conexao->prepare("
        SELECT Largura_MM, Altura_MM
        FROM Chapa
        WHERE Cod_Chapa = ?
    ");
    $stmt->bind_param("i", $codChapa);
    $stmt->execute();
    $stmt->bind_result($larguraChapa, $alturaChapa);
    $stmt->fetch();
    $stmt->close();

    $areaChapa = $larguraChapa * $alturaChapa;

    $resultados = [];
    $res = $conexao->query("
        SELECT Cod_Peca, Nome_Peca, Largura_MM, Altura_MM
        FROM Peca
    ");

    while ($row = $res->fetch_assoc()) {
        $areaPeca = $row['Largura_MM'] * $row['Altura_MM'];
        $quantidadeCabem = floor($areaChapa / $areaPeca);
        if ($quantidadeCabem > 0) {
            $resultados[] = [
                'cod_peca' => $row['Cod_Peca'],
                'nome_peca' => $row['Nome_Peca'],
                'quantidade_maxima' => $quantidadeCabem
            ];
        }
    }

    return $resultados;
}

