<?php require_once 'backend.php' ?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema de Cálculo de Custos - Marcenaria</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4Q6Gf2aSP4eDXB8Miphtr37CMZZQ5oXLH2yaXMJ2w8e2ZtHTl7GptT4jmndRuHDT" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="estilos.css">
</head>

<body>
    <div class="container-fluid">
        <div class="row">
            <div class="barra-lateral col-sm-3">
                <div class="row">
                    <div class="col">
                <div>
                    </div>
                        <a class="aba-materiais btn btn-link btn-block">Materiais</a>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <a class="aba-planos btn btn-link btn-block">Planos</a>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <a class="aba-resultados btn btn-link btn-block">Resultados</a>
                    </div>
                </div>
            </div>
            <div class="col-sm-9">
                <div class="tela-materiais row container">
                    <div class="materiais">
                        <img class="galeria" src="images/nogueiraVeneto.jpg" alt="">
                        <p>Nogueira Veneto</p>
                    </div>
                    <div>
                        <img class="galeria" src="images/carvalhoAmendoa.jpg" alt="">
                        <p>Carvalho Amendoa</p>
                    </div>
                    <div>
                        <img class="galeria" src="images/itauba.png" alt="">
                        <p>Itaúba</p>
                    </div>
                   
                </div>
                <div style="display: none" class="tela-planos align-items-end row container">
                    <div class="campos col">
                        <div class="py-2 row">
                            <div class="col">
                                <input placeholder='Nome da peça' class="campo-nome form-control" />
                            </div>
                            <div class="col">
                                <select placeholder='Tipo de material' class="campo-tipo form-control">
                                    <option value="mdf-nogueira-veneto">Nogueira Veneto</option>
                                    <option value="mdf-carvalho-amendoa">Carvalho Amêndoa</option>
                                </select>
                            </div>
                            <div class="col">
                                <input placeholder='Comprimento (mm)' type='number' step='1' min='1' class="campo-comprimento form-control" />
                            </div>
                            <div class="col">
                                <input placeholder='Largura (mm)' type='number' step='1' min='1' class="campo-largura form-control" />
                            </div>
                            <div class="col">
                                <input placeholder='Espessura (mm)' type='number' step='1' min='1' class="campo-espessura form-control" />
                            </div>
                        </div>
                    </div>
                    <div class="pb-3 mb-2 d-flex col-sm-1">
                        <a class="adicionar-campo btn btn-link">
                            <i class="bi bi-plus-circle"></i>
                        </a>
                        <a class="remover-campo btn btn-link">
                            <i class="bi bi-dash-circle"></i>
                        </a>
                    </div>
                </div>

                <divs style="display: none" class="tela-resultados reverse row">
                    <div class="col">aqui vai aparecer o resultado dos calculos, seja só um valor, ou até uma imagem</div>
                </divs>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js" integrity="sha384-j1CDi7MgGQ12Z7Qab0qlWQ/Qqz24Gc6BM0thvEMVjHnfYGF0rmFCozFSxQBxwHKO" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script src='codigo.js'></script>
</body>

</html>