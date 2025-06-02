<?php require_once 'backend.php' ?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema de Cálculo de Custos - Marcenaria</title>
    <link href="/projeto-php-2b-jeferson/images/Logo-PlanoDeCorteMini.jpg" rel="icon"/>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4Q6Gf2aSP4eDXB8Miphtr37CMZZQ5oXLH2yaXMJ2w8e2ZtHTl7GptT4jmndRuHDT" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="estilos.css">
</head>

<body class="d-flex vh-100 overflow-hidden"> 
    <div class="container-fluid p-0 h-100">
        <div class="row flex-nowrap h-100">
            <div class="col-auto col-md-3 col-xl-2 px-0 sidebar" id="side-nav">
                <div class="text-center py-4">
                   <img src="./images/Logo-PlanoDeCorteMini.jpg" class="galeria" alt="Logo Marcenaria" width="150">
                </div>
                <div class="text-center py-3">
                    <div class="d-flex justify-content-center align-items-center">
                        <i class="fas fa-tools text-warning fs-1 me-2"></i>
                        <span class="text-white fs-4 fw-bold">MARCENARIA<br>DO ZÉ</span>
                    </div>
                </div>
                    <div class="d-flex flex-column align-items-center align-items-sm-start px-3 pt-2 h-100">
                    <div class="w-100 py-2">
                        <a class="aba-materiais btn btn-warning w-100 mb-2">Materiais</a>
                    </div>
                    <div class="w-100 py-2">
                        <a class="aba-planos btn btn-warning w-100 mb-2">Planos</a>
                    </div>
                    <div class="w-100 py-2">
                        <a class="aba-resultados btn btn-warning w-100 mb-2">Resultados</a>
                    </div>
                </div>

            </div>
            <div class="col-sm-9 main">
                <div class="tela-materiais align-items-end row container ">
                <div class="text-center py-3">
                    <div class="d-flex justify-content-center align-items-center">
                        <i class="fas fa-tools text-warning fs-1 me-2"></i>
                        <span class="text-black fs-4 fw-bold">MATERIAIS</span>
                    </div>
                </div>
                    <div class="materiais col">
                        <div class="pl-2 campos-material row">
                            <div class="col">
                                <input type="text" placeholder="Material" id='nome-material' class='form-control'>
                            </div>
                            <div class="col">
                                <input type="number" placeholder="Preço" id='preco-material' class='form-control'>
                            </div>
                            <div class="col">
                                <input type="text" placeholder="Quantidade" id='quantidade-material' class='form-control'>
                            </div>
                        </div>
                    </div>
                    <div class="pb-3 mb-3 d-flex col-sm-1">
                        <a class="adicionar-material btn btn-link">
                            <i class="bi bi-plus-circle"></i>
                        </a>
                    </div>
                </div>
                <div style="display: none" class="tela-planos align-items-end row container">
                    <div class="text-center py-3">
                        <div class="d-flex justify-content-center align-items-center">
                            <i class="fas fa-tools text-warning fs-1 me-2"></i>
                            <span class="text-black fs-4 fw-bold">PLANOS</span>
                        </div>
                    </div>
                    <div class="campos col">
                        <div class="py-2 row">
                            <div class="col">
                                <input placeholder='Nome da peça' class="campo-nome form-control" />
                            </div>
                            <div class="col">
                                <select placeholder='Tipo de material' class="campo-tipo form-control">
                                    <option value="mdf-nogueira">Nogueira</option>
                                    <option value="mdf-carvalho">Carvalho</option>
                                    <option value="mdf-itauba">Itauba</option>
                                    <option value="mdf-cedro">Cedro</option>
                                    <option value="mdf-pinus">Pinus</option>
                                    <option value="mdf-cumaru">Cumaru</option>
                                    <option value="mdf-mogno">Mogno</option>
                                    <option value="mdf-eucalipto">Eucalipto</option>
                                    <option value="mdf-jequitiba">Jequitiba</option>
                                    <option value="mdf-ipe">ipe</option>
                                    <option value="mdf-jacaranda">Jacaranda</option>
                                    <option value="mdf-jatoba">Jatoba</option>
                                    <option value="mdf-pinho">Pinho</option>
                                    <option value="mdf-branco">MDF Branco</option>
                                    <option value="mdf-texturizado">MDF Texturizado</option>
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
                    <div class="pb-2 mb-3 d-flex col-sm-1">
                        <a class="adicionar-campo btn btn-link">
                            <i class="bi bi-plus-circle"></i>
                        </a>
                        <a class="remover-campo btn btn-link text-danger">
                            <i class="bi bi-x-circle"></i>
                        </a>
                    </div>
                </div>

                <div style="display: none" class="tela-resultados align-items-end row container">
                    <div class="text-center py-3">
                        <div class="d-flex justify-content-center align-items-center">
                            <i class="fas fa-tools text-warning fs-1 me-2"></i>
                            <span class="text-black fs-4 fw-bold">RESULTADOS</span>
                        </div>

                    </div>
                    <div class="imagem-resultado">
                        <img src="./images/Logo-PlanoDeCorte.jpg" class="galeria w-50" alt="">
                    </div>
                        <p>Testamento: </p>
                        <p>R$10000000.00</p>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js" integrity="sha384-j1CDi7MgGQ12Z7Qab0qlWQ/Qqz24Gc6BM0thvEMVjHnfYGF0rmFCozFSxQBxwHKO" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script src='codigo.js'></script>
</body>

</html>