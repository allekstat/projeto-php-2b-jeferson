$(document).ready(async function ()
{
    $('input:submit').click(entrar_na_conta);
});
function entrar_na_conta()
{
    const dados = 
    {
        usuario: $('#usuario').val(),
        senha: $('#senha').val()
    };
    $.post('login.php', dados, function (retorno)
    {
        console.log(retorno);
    }, 'json');
};
function criar_conta()
{
    const dados = 
    {
        usuario: $('#usuario').val(),
        senha: $('#senha').val()
    };
    $.post('signin.php', dados, function (retorno)
    {
        // conta criada
    }, 'json');
};