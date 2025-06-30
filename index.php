<?php


if (session_start() == false)
{
    exit;
}
if (isset($_SESSION['usuario_logado']) && $_SESSION['usuario_logado'] == true)
{
    $pagina = 'menu';
    $titulo = 'Sistema de Cálculo de Custos - Marcenaria';
}
else if (isset($_SESSION['pagina']) && $_SESSION['pagina'] == 'cadastro')
{
    $pagina = 'cadastro';
    $titulo = 'Cadastro :: Sistema de Cálculo de Custos - Marcenaria';
}
else
{
    $pagina = 'login';
    $titulo = 'Login :: Sistema de Cálculo de Custos - Marcenaria';
}

include 'template.php';
