$(document).ready(async function ()
{
    $('a.aba-materiais').click('materiais', mudar_tela);
    $('a.aba-planos').click('planos', mudar_tela);
    $('a.aba-resultados').click('resultados', mudar_tela);
    $('a.adicionar-campo').click(adicionar_campo);
    $('a.remover-campo').click(remover_campo);
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
            <div class='row'>
                <div class='col'>${materiais[i].nome}</div>
            </div>
        `);
    }
}
function adicionar_material()
{
    //
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