<div class='d-flex vh-100 overflow-hidden'>
    <div class='container-fluid p-0 h-100'>
        <div class='row flex-nowrap h-100'>
            <div class='col-auto col-md-3 col-xl-2 px-0 sidebar' id='side-nav'>
                <div class='text-center py-4'>
                    <img src='./images/carvalhoAmendoa.jpg' class='galeria' alt='Logo Marcenaria' width='300  '>
                </div>
                <div class='text-center py-3'>
                    <div class='d-flex justify-content-center align-items-center'>
                        <i class='fas fa-tools text-warning fs-1 me-2'></i>
                        <span class='text-white fs-4 fw-bold'>MARCENARIA</span>
                    </div> 
                </div>
                    <div class='d-flex flex-column align-items-center align-items-sm-start px-3 pt-2 h-100'>
                    <div class='w-100 py-2'>
                        <a class='aba-materiais button btn btn-warning w-100 mb-2'>Materiais</a>
                    </div>
                    <div class='w-100 py-2'>
                        <a class='aba-planos button btn btn-warning w-100 mb-2'>Planos</a>
                    </div>
                    <div class='w-100 py-2'>
                        <a class='aba-resultados button btn btn-warning w-100 mb-2'>Resultados</a>
                    </div>
                </div>
            </div>
            <div class='col-sm-9 main'>
                <div class='tela-materiais align-items-end row container '>
                    <div class='text-center py-3'>
                        <div class='d-flex justify-content-center align-items-center'>
                            <i class='fas fa-tools text-warning fs-1 me-2'></i>
                            <span class='text-black fs-4 fw-bold'>MATERIAIS</span>
                        </div>
                    </div>
                    <div class='materiais col'>
                        <div class='pl-2 campos-material row'>
                            <div class='col'>
                                <input type='text' placeholder='Material' id='nome-material' class='form-control'>
                            </div>
                            <div class='col'>
                                <input type='number' placeholder='Preço' id='preco-material' class='form-control'>
                            </div>
                            <div class='col'>
                                <input type='text' placeholder='Quantidade' id='quantidade-material' class='form-control'>
                            </div>
                            <div class='col'>
                                <label for="">Largura da Chapa</label>
                                <input type='number' placeholder="Largura" name="largura-chapa" id="largura-material" class="form-control">
                            </div>
                            <div class='col'>
                                <label for="">Comprimento da Chapa</label>
                                <input type='number' placeholder="Comprimento" name="comprimento-chapa" id="comprimento-material" class="form-control">
                            </div>
                            <div class='col'>
                                <label for="">Espessura da Chapa</label>
                                <input type='number' placeholder="Espessura" name="espessura-chapa" id="espessura-material" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class='pb-3 mb-3 d-flex col-sm-1'>
                        <a class='adicionar-material btn btn-link'>
                            <i class='bi bi-plus-circle'></i>
                        </a>
                    </div>
                </div>
                <div style='display: none' class='tela-planos align-items-end row container'>
                    <div class='text-center py-3'>
                        <div class='d-flex justify-content-center align-items-center'>
                            <i class='fas fa-tools text-warning fs-1 me-2'></i>
                            <span class='text-black fs-4 fw-bold'>PLANOS</span>
                        </div>
                    </div>
                    <div class='campos col'>
                        <div class='py-2 row'>
                            <div class='col'>
                                <input placeholder='Nome da peça' class='campo-nome form-control' />
                            </div>
                            <div class='col'>
                                <select placeholder='Tipo de material' class='campo-tipo form-control'>
                                    <option value='mdf-nogueira'>Nogueira</option>
                                    <option value='mdf-carvalho'>Carvalho</option>
                                    <option value='mdf-itauba'>Itauba</option>
                                    <option value='mdf-cedro'>Cedro</option>
                                    <option value='mdf-pinus'>Pinus</option>
                                    <option value='mdf-cumaru'>Cumaru</option>
                                    <option value='mdf-mogno'>Mogno</option>
                                    <option value='mdf-eucalipto'>Eucalipto</option>
                                    <option value='mdf-jequitiba'>Jequitiba</option>
                                    <option value='mdf-ipe'>ipe</option>
                                    <option value='mdf-jacaranda'>Jacaranda</option>
                                    <option value='mdf-jatoba'>Jatoba</option>
                                    <option value='mdf-pinho'>Pinho</option>
                                    <option value='mdf-branco'>MDF Branco</option>
                                    <option value='mdf-texturizado'>MDF Texturizado</option>
                                </select>
                            </div>
                            <div class='col'>
                                <input placeholder='Comprimento (mm)' type='number' step='1' min='1' class='campo-comprimento form-control' />
                            </div>
                            <div class='col'>
                                <input placeholder='Largura (mm)' type='number' step='1' min='1' class='campo-largura form-control' />
                            </div>
                            <div class='col'>
                                <input placeholder='Espessura (mm)' type='number' step='1' min='1' class='campo-espessura form-control' />
                            </div>
                        </div>
                    </div>
                    <div class='pb-2 mb-3 d-flex col-sm-1'>
                        <a class = 'enviar-campo btn btn-link'>
                            <i class='bi button bi-check-circle'></i>
                        <a class='adicionar-campo btn btn-link'>
                            <i class='bi bi-plus-circle'></i>
                        </a>
                        <a class='remover-campo btn btn-link text-danger'>
                            <i class='bi bi-x-circle'></i>
                        </a>
                    </div>
                </div>
                <div style='display: none' class='tela-resultados align-items-end row container'>
                    <div class='text-center py-3'>
                        <div class='d-flex justify-content-center align-items-center'>
                            <i class='fas fa-tools text-warning fs-1 me-2'></i>
                            <span class='text-black fs-4 fw-bold'>RESULTADOS</span>
                        </div>
                    </div>
                    <div class='imagem-resultado'>
                        <img src='./images/Logo-PlanoDeCorte.jpg' class='galeria w-50' alt=''>
                    </div>
                    <div class='valor-resultado'>
                        
                    </div>
                    <p>Testamento: </p>
                    <p>R$10000000.00</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>



