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
$(document).ready(function ()
{
    api({rota: 'usuarios/123', dados: {nome: 'alexsander'}}).then(console.log);
});
