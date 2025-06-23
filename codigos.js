function api({rota = '', metodo = 'GET', dados = {}})
{
    if (rota[0] != '/') rota = '/' + rota;
    return new Promise((resolve, reject) => {
        $.ajax({
            url: `api${rota}`,
            method: metodo,
            data: dados,
            success: resolve,
            error: reject
        });
    });
}

let atualiza = 0;

function mudar_tela({ data: tela })
{
    $('div.tela-' + tela)
        .show()
        .siblings()
        .hide();
        
    if (tela == 'planos')
    {
        atualiza = atualiza + 1;
        if(atualiza < 2){
            $('div.tela-planos .campos').empty();
            console.log(atualiza);
            adicionar_campo()
        };

        
    }

}
async function listar_materiais()
{
    api({rota: 'materiais'})
    .then(retorno =>
    {
        $('.materiais.col').empty();
        for (let i = 0; i < retorno.quantidade; i++)
        {
            const material = retorno.dados[i];
            $('.materiais.col').append(`
                <div class='py-2 row'>
                    <div class='col'>${material.nome}</div>
                </div>
            `);
        }
    });
    
}
function adicionar_campo() {
    const campoHtml = `
        <div class='py-2 row'>
            <div class='col'>
                <select placeholder='Tipo de material' class='campo-tipo form-control'>
                <option value="Indefinido">Selecione a Chapa</option>
                </select>
            </div>
            <div class='col'>
                <input placeholder='Nome da peça' class='campo-nome form-control' />
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
    `;

    const $novoCampo = $(campoHtml).appendTo('div.tela-planos .campos');
    
    const $novoSelect = $novoCampo.find('.campo-tipo');
    
    opcoes_materiais($novoSelect);
}

function opcoes_materiais($select) {
    api({rota: 'chapa'})
        .then(retorno => {
            retorno.dados.forEach(v => {
                $select.append(`<option value='mdf-${v.Nome_Tipo}'>${v.Nome_Tipo}, ${v.Altura_MM}X${v.Largura_MM}mm, ${v.Espessura}(${v.Quantidade})</option>`);
            });
        });
}

function remover_campo()
{
    $('div.tela-planos .campos')
        .children()
        .last()
        .remove();
}


function buscar_materiais()
{
    $('.campos-material').prevAll().remove();
    api({rota: 'chapa'})
    .then(retorno => retorno.dados.forEach(v => 
        {
            $('.campos-material').before(`
                <div data-material='${v.Cod_Chapa}' class='py-2 align-items-center row'>
                    <div class='col'>
                        <span class='material-nome'>${v.Nome_Tipo}</span>
                    </div>
                    <div class='col'>
                    <span class='material-preco'>${v.Valor_Chapa}</span>
                    </div>
                    <div class='col'>
                        <span class='material-quantidade'>${v.Quantidade}</span>
                    </div>
                    <div class='col'>
                        <span class='material-largura'>${v.Largura_MM}</span>
                        <span>X</span>
                        <span class='material-comprimento'>${v.Altura_MM}</span>
                    </div>
                    <div class='col'>
                        <span class='material-espessura'>${v.Espessura}</span>
                    </div>
                    <div class="col-sm-1">
                        <a class="apagar-material btn btn-link text-danger">
                            <i class="bi bi-x-circle"></i>
                        </a>
                    </div>
                </div>
            `);
            $('.apagar-material').click(remover_material);
        }
    ));
}


function adicionar_material()
{
    if (!($('#nome-material').val().trim() &&
        $('#preco-material').val().trim() &&
        $('#quantidade-material').val().trim() &&
        $('#largura-material').val().trim() &&
        $('#comprimento-material').val().trim() &&
        $('#espessura-material').val().trim())) return alert('Preencha todo o campo');
    $('.campos-material').before(`
        <div class='py-2 row'>
            <div class='col'>
                <span class='material-nome'>${$('#nome-material').val()}</span>
            </div>
            <div class='col'>
               <span class='material-preco'>${$('#preco-material').val()}</span>
            </div>
            <div class='col'>
                <span class='material-quantidade'>${$('#quantidade-material').val()}</span>
            </div>
            <div class='col'>
                <span class='material-largura'>${$('#largura-material').val()}</span>
            </div>
            <div class='col'>
                <span class='material-comprimento'>${$('#comprimento-material').val()}</span>
            </div>
            <div class='col'>
                <span class='espessura-largura'>${$('#espessura-material').val()}</span>
            </div>
        </div>
    `);
    api({rota: 'peca', metodo: 'POST',dados: {campos: ['Nome_Peca', 'Valor_Unitario', 'Quantidade', 'Largura_MM', 'Altura_MM', 'Espessura_MM'], valores: [$('#nome-material').val(),$('#preco-material').val() ,$('#quantidade-material').val(), $('#largura-material').val(),$('#comprimento-material').val(),$('#espessura-material').val()]}})
    .then( () => buscar_materiais());        

}
function remover_material()
{
    console.log($(this));
    api({metodo: 'DELETE', rota: 'pecas/' + $(this).parent().parent().data('material')})
    .then(() => buscar_materiais());
}
document.querySelectorAll('.button').forEach(button => {
    button.addEventListener('click', function() {
        document.querySelectorAll('.button').forEach(btn => {
            btn.classList.remove('active');
        });
        
        this.classList.add('active');
    });
});
function precoEstimado(){
    precoEstimado = api({rota: 'calculo', dados: {resultados}});
    console.log(precoEstimado);
    
    $('div-resultado.valor-resultado')
    .append(`
            <span>${precoEstimado}</span>
        
        
        `)


}$(document).ready(function ()
{
    $('a.aba-materiais').click('materiais', mudar_tela);
    $('a.aba-planos').click('planos', mudar_tela);
    $('a.aba-resultados').click('resultados', mudar_tela);
    $('a.adicionar-campo').click(adicionar_campo);
    $('a.remover-campo').click(remover_campo);
    $('a.adicionar-material').click(adicionar_material);
    $('a.remover-material').click(remover_material);
    $('a.enviar-peca').click(enviar_peca);
    $('a.enviar-chapa').click(enviar_chapa);
    buscar_materiais();

    
function enviar_peca() {
            api({
                metodo: 'POST',
                rota: 'peca',
                dados: {
                    campos: ['Nome_Peca', 'Largura_MM','Altura_MM', 'Espessura'],
                    valores: [
                        $('.campo-nome').val(),
                        $('.campo-largura').val(),
                        $('.campo-comprimento').val(),
                        $('.campo-espessura').val()
                    ]
                }
            })
}

function enviar_chapa(){
            api({
                metodo: 'POST',
                rota: "chapa",
                dados: {
                    campos: ['Nome_Tipo', 'Largura_MM', 'Altura_MM', 'Espessura', 'Quantidade', 'Valor_Chapa'],
                    valores: [
                        $('#nome-material').val(),
                        $('#largura-material').val(),
                        $('#comprimento-material').val(),
                        $('#espessura-material').val(),
                        $('#quantidade-material').val(),
                        $('#preco-material').val()
                    ]
                }
            });

}



    $('#botao-logar').click(function ()
    {
        api({metodo: 'POST', rota: 'login', dados: {usuario: $('#usuario-login').val(), senha: $('#senha-login').val()}})
        .then(retorno => window.location.reload())
        .catch(erro => alert(erro.responseJSON.mensagem));
    });
    $('#botao-cadastrar').click(function ()
    {
        api({rota: 'redirecionar/cadastro'})
        .then(retorno => window.location.reload())
        .catch(erro => alert(erro.responseJSON.mensagem));
    });
    $('#botao-registrar').click(function ()
    {
        api({metodo: 'POST', rota: 'cadastro', dados: {usuario: $('#usuario-cadastro').val(), senha: $('#senha-cadastro').val()}})
        .then(retorno => window.location.reload())
        .catch(erro => alert(erro.responseJSON.mensagem));
    });
    $('#botao-entrar').click(function ()
    {
        api({rota: 'redirecionar/login'})
        .then(retorno => window.location.reload())
        .catch(erro => alert(erro.responseJSON.mensagem));
    });
    $('#botao-desconectar').click(function ()
    {
        api({rota: 'logoff'})
        .then(retorno => window.location.reload())
        .catch(erro => alert(erro.responseJSON.mensagem));
    });
    api({rota: 'dados'})
    .then( retorno => $('#nome-usuario').text(retorno.dados.nome));
});
