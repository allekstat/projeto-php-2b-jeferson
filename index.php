<?php
if (session_start() === false)
{
    exit;
}
if ($_SESSION['usuario_logado'] === true)
{
    $pagina = 'menu';
    $titulo = 'Sistema de Cálculo de Custos - Marcenaria';
}
else
{
    $pagina = 'login';
    $titulo = 'Login :: Sistema de Cálculo de Custos - Marcenaria';
}
include 'template.php';
