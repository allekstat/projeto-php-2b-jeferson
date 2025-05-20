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
        </div>
    `);
    chamarapi('POST', 'api.php', {tabela: 'materiais', campos: ['nome', 'preco', 'quantidade'], valores: [$('#nome-material').val(),$('#preco-material').val() ,$('#quantidade-material').val() ]})
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