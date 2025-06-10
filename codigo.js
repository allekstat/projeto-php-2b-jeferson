$(document).ready(async function ()
{
    $('a.aba-materiais').click('materiais', mudar_tela);
    $('a.aba-planos').click('planos', mudar_tela);
    $('a.aba-resultados').click('resultados', mudar_tela);
    $('a.adicionar-campo').click(adicionar_campo);
    $('a.remover-campo').click(remover_campo);
    $('a.adicionar-material').click(adicionar_material);
    $('a.remover-material').click(remover_material);
    buscar_materiais();
});
function mudar_tela({ data: tela })
{
    $('div.tela-' + tela)
        .show()
        .siblings()
        .hide();
        
    if (tela == 'planos')
    {
        chamarapi('GET', 'api.php', {tabela: 'madeiras'})
        .then(function (dados)
        {
            $('.campos .campo-tipo').empty();
            for (let i = 0; i < dados.length; i++)
            {
                $('.campos .campo-tipo').append(`
                    <option value='${dados[i].Cod_mad}'>${dados[i].Nome_mad}</option>
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
    chamarapi('GET', 'api.php', {tabela: 'materiais', campos: '*'})
    .then(j => j.forEach(v => 
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
    chamarapi('POST', 'api.php', {tabela: 'chapas', campos: ['nome_chapa', 'valor_chapa', 'quantidade_chapa', 'largura_chapa', 'altura_chapa', 'espessura_chapa'], valores: [$('#nome-material').val(),$('#preco-material').val() ,$('#quantidade-material').val(), $('#largura-material').val(),$('#comprimento-material').val(),$('#espessura-material').val()  ]})
    .then( () => buscar_materiais());
}
function remover_material()
{
    chamarapi('POST', 'api.php', {deletar: 1, campos: 'nome', condicoes: 'id = ' + $(this).parent().parent().data('material')})
    .then(() => buscar_materiais());
}
async function chamarapi(metodo, url, dados)
{
    return await $.ajax(
    {
        method: metodo || 'GET',
        url: url || 'api.php',
        data: dados || {},
        dataType: 'json',
        success: function (resposta)
        {
            return resposta;
        },
        error: function (xhr, status, erro)
        {
            return {erro: erro, status: status, xhr: xhr};
        }
    });
}

document.querySelectorAll('.btn').forEach(button => {
    button.addEventListener('click', function() {
        document.querySelectorAll('.btn').forEach(btn => {
            btn.classList.remove('active');
        });
        
        this.classList.add('active');
    });
});

function precoEstimado(){
    precoEstimado = chamarapi('GET', 'calculo.php', {resultados});
    console.log(precoEstimado);
    
    $('div-resultado.valor-resultado')
    .append(`
            <span>${precoEstimado}</span>
        
        
        `)


}