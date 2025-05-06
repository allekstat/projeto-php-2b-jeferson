$(document).ready(async function () {
    $('.aba-materiais').click('materiais', mudar_tela);
    $('.aba-planos').click('planos', mudar_tela);
    $('.aba-resultados').click('resultados', mudar_tela);
});
function mudar_tela({ data: tela }) {
    $('.tela-' + tela)
        .show()
        .siblings()
        .hide();
}
