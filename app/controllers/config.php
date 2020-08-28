<?php

namespace app\controllers;
if (!isset($_SESSION)) { session_start(); }
use app\config\configView;
use app\models\configModel;

class config{
    private $dados;
    private $cfg;
    const urlDestino = URL . 'config/index';

    public function index(){
        if (logado()):
            if (isset($_POST['celular'])):
                $this->salvar();
            endif;
            $this->dados = $this->lerConfig();
            $carregarView = new configView('config/index', $this->dados);
            $carregarView->renderizar();
            

        else:
            $_SESSION['msg'] = 'Área restrita, apenas usuário logados podem ter acesso';
            header('Location:' . URL);
        endif;
    }

    public function cfg(){
        $this->cfg = $this->lerConfig();
        return $this->cfg;
    }

    private function lerConfig(){
        $arquivo = fopen ("./config/cfg.gsc", 'r');
            $string = file_get_contents("./config/cfg.gsc");
        fclose($arquivo);
        foreach (explode("\n", $string) as $linha) {
            $configs[
                substr($linha, 0, (int) strpos($linha, ':'))
                    ] = substr($linha, (int) strpos($linha, ':') + 1, (int) strlen($linha));
        }
        return $configs;
    }

    private function salvar(){
        if (logado()):
            $this->dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);
            $cadConfig = new configModel;
            $cadConfig->salvarArquivo($this->dados);
        else:
            $_SESSION['msg'] = 'Área restrita, apenas usuário logados podem ter acesso';
            header('Location:' . URL);
        endif;

    }
    
}