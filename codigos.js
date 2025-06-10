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
function mudar_tela({ data: tela })
{
    $('div.tela-' + tela)
        .show()
        .siblings()
        .hide();
        
    if (tela == 'planos')
    {
        api({rota: 'madeiras'})
        .then(retorno =>
        {
            $('.campos .campo-tipo').empty();
            for (let i = 0; i < retorno.dados.length; i++)
            {
                $('.campos .campo-tipo').append(`
                    <option value='${retorno.dados[i].Cod_mad}'>${retorno.dados[i].Nome_mad}</option>
                `);
            }
        });
    }

}
async function listar_materiais()
{
    const materiais = await $.get('materiais.php');
    $('.materiais.col').empty();
    for (let i = 0; i < materiais.length; i++)
    {
        $('.materiais.col').append(`
            <div class='py-2 row'>
                <div class='col'>${materiais[i].nome}</div>
            </div>
        `);
    }
}
function adicionar_campo()
{
    $('div.tela-planos .campos')
        .append(`
            <div class='py-2 row'>
                <div class='col'>
                    <input placeholder='Nome da peça' class='campo-nome form-control' />
                </div>
                <div class='col'>
                    <select placeholder='Tipo de material' class='campo-tipo form-control'>
                        <option value='mdf-nogueira-veneto'>Nogueira Veneto</option>
                        <option value='mdf-carvalho-amendoa'>Carvalho Amêndoa</option>
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
        `);
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
    api({rota: 'materiais'})
    .then(retorno => retorno.dados.forEach(v => 
        {
            $('.campos-material').before(`
                <div data-material='${v.id}' class='py-2 align-items-center row'>
                    <div class='col'>
                        <span class='material-nome'>${v.nome}</span>
                    </div>
                    <div class='col'>
                    <span class='material-preco'>${v.preco}</span>
                    </div>
                    <div class='col'>
                        <span class='material-quantidade'>${v.quantidade}</span>
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
                <span class='material-largura'>${$('#largura-material')}</span>
            </div>
            <div class='col'>
                <span class='material-comprimento'>${$('#comprimento-material')}</span>
            </div>
            <div class='col'>
                <span class='espessura-largura'>${$('#espessura-material')}</span>
            </div>
        </div>
    `);
    api({metodo: 'POST', rota: 'chapas', dados: {campos: ['nome_chapa', 'valor_chapa', 'quantidade_chapa', 'largura_chapa', 'altura_chapa', 'espessura_chapa'], valores: [$('#nome-material').val(),$('#preco-material').val() ,$('#quantidade-material').val(), $('#largura-material').val(),$('#comprimento-material').val(),$('#espessura-material').val()]}})
    .then( () => buscar_materiais());
}
function remover_material()
{
    api({metodo: 'DELETE', rota: 'materiais/' + $(this).parent().parent().data('material')})
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
    buscar_materiais();
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
