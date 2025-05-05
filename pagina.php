<?php require_once 'backend.php' ?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema de Cálculo de Custos - Marcenaria</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4Q6Gf2aSP4eDXB8Miphtr37CMZZQ5oXLH2yaXMJ2w8e2ZtHTl7GptT4jmndRuHDT" crossorigin="anonymous">
    <link rel="stylesheet" href="estilos.css">
</head>

<body>
    <div class="container-fluid">
        <div class="row">
            <div class="barra-lateral col-sm-3">
                <div class="row">
                    <div class="col">Materiais</div>
                </div>
                <div class="row">
                    <div class="col">Plano</div>
                </div>
                <div class="row">
                    <div class="col">Resultados</div>
                </div>
            </div>
            <div class="col-sm-9">
                <div class="janela-materiais row">
                    <div class="col">aqui vão os materiais e os cadastros de mais materiais</div>
                </div>
                <div class="janela-planos row">
                    <div class="col">aqui vai a parte de colocar quanto de cada material, as dimensoes do objeto e tudo mais</div>
                </div>
                <div class="janela-resultados row">
                    <div class="col">aqui vai aparecer o resultado dos calculos, seja só um valor, ou até uma imagem</div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js" integrity="sha384-j1CDi7MgGQ12Z7Qab0qlWQ/Qqz24Gc6BM0thvEMVjHnfYGF0rmFCozFSxQBxwHKO" crossorigin="anonymous"></script>
    <script src="frontend.js"></script>
</body>

</html>