<?php

define('URL', '');
define('NOME', '');
define('INTERNO', '');
define('APP_TITLE', 'Nome do Projeto');
define('ABS_USE', 'app\controllers');
define('CONTROLLER', 'homeController');
define('METHOD', 'index');

define('DB_HOST', '');
define('DB_USER', '');
define('DB_PASS', '');
define('DB_NAME', '');

function dd($var) {
    var_dump($var);
    die;
}

function statusCod($valor){
    if ( is_numeric($valor) ):
        switch ($valor) {
            case 0:  return 'Inativo'; break;
            default: return 'Ativo'; break;
        }
    else:
        switch ($valor) {
            case 'Inativo': return 0; break;
            default: return 1; break;
        }
    endif;
}

function nivelCod($valor){
    if ( is_numeric($valor) ):
        switch ($valor) {
            case 0:  return 'Administrador'; break;
            case 1:  return 'Supervisor'; break;
            case 2:  return 'Coordenador'; break;
            default: return 'Usuário'; break;
        }
    else:
        switch ($valor) {
            case 'Administrador':  return 0; break;
            case 'Supervisor':  return 1; break;
            case 'Coordenador':  return 2; break;
            default: return 3; break;
        }
    endif;
}

function logado(){
    if (isset($_SESSION['usuario']['id'])) {
        return true;
    } else {
        return false;
    }
}