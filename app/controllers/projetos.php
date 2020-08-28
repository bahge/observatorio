<?php

namespace app\controllers;
if (!isset($_SESSION)) { session_start(); }

use app\config\configView;
use app\models\configModel;
use app\models\projetosModel;
use app\controllers\galeria;

class projetos
{
    private $dados;
    private $projetoId;
    const urlDestino = URL . 'projetos/index';

    public function index()
    {
        $config = new configModel();
        $this->dados['cfg'] = $config->configs();
        
        $projetos = new projetosModel();
        $this->dados['projetos'] = $projetos->projetos();

        $carregarView = new configView('projetos/index', $this->dados);
        $carregarView->renderizar();
    }

    public function cadastrar()
    {
        if (logado()):
            $this->dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);
            $cadProduto = new projetosModel();
            if (!empty($this->dados)):
                $cadastro = $cadProduto->cadastrar($this->dados);
                if ($cadastro):
                    header("Location: " . self::urlDestino);
                    exit;
                endif;
            endif;

            $config = new configModel();
            $this->dados['cfg'] = $config->configs();
    
            $galeria = new galeria();
            $this->dados['galeria'] = $galeria->listar();
    
            $carregarView = new configView('projetos/cadastrar', $this->dados);
            $carregarView->renderizar();
        else:
            $_SESSION['msg'] = 'Área restrita, apenas usuário logados podem ter acesso';
            header('Location:' . URL);
        endif;
       
    }

    public function listar()
    {
        $config = new configModel();
        $this->dados['cfg'] = $config->configs();
        
        $projetos = new projetosModel();
        $this->dados['projetos'] = $projetos-> projetos();

        $carregarView = new configView('projetos/listar', $this->dados);
        $carregarView->renderizar();
    }

    public function listarNomes()
    {
        $config = new configModel();
        $this->dados['cfg'] = $config->configs();
        
        $projetos = new projetosModel();
        $this->dados['projetos'] = $projetos-> listarNomes();

        return $this->dados['projetos'];
    }

    public function visualizar($projetoId = null) 
    {
        if(logado()):
            $this->projetoId = (int) $projetoId;
            if (!empty($this->projetoId)):
                $verProjeto = new projetosModel();
                $this->dados['projetos'] = $verProjeto->visualizar($projetoId);

                if ($verProjeto->getResultado()):
                    $carregarView = new configView("projetos/visualizar", $this->dados);
                    $carregarView->renderizar();
                else:
                    $_SESSION['msg'] = "Projeto não encontrado!";
                    header("Location: " . self::urlDestino);
                    exit;
                endif;

            else:
                $_SESSION['msg'] = "É necessário selecionar um projeto!";   
                header("Location: " . self::urlDestino);
                exit;
            endif;
        else:
            $_SESSION['msg'] = 'Área restrita, apenas projeto logados podem ter acesso';
            header('Location:' . URL);
            exit;
        endif;
    }

    public function editar($id = null)
    {
        if(logado()):
            $this->projetoId = (int) $id;
            if (!empty($this->projetoId)):
                $this->dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);
                $this->atualizar();

                $config = new configModel();
                $this->dados['cfg'] = $config->configs();
                
                $projetos = new projetosModel();
                $this->dados['projeto'] = $projetos-> visualizar($this->projetoId);
    
                $galeria = new galeria();
                $this->dados['galeria'] = $galeria->listar();

                $carregarView = new ConfigView("projetos/editar", $this->dados);
                $carregarView->renderizar();
            else:
                $_SESSION['msg'] = "Necessário selecionar um projeto";   
                header('Location: ' . self::urlDestino);
                exit;
            endif;
        else:
            $_SESSION['msg'] = 'Área restrita, apenas usuário logados podem ter acesso';
            header('Location:' . URL);
            exit;
        endif;

    }

    private function atualizar() 
    {
        if (!empty($this->dados)):
            $editarProjeto = new projetosModel();
            $editarProjeto->editar($this->projetoId, $this->dados);
            if (!$editarProjeto->getResultado()):
                $_SESSION['msg'] = "Para editar um projeto preencha todos os campos!";
            else:
                $_SESSION['msg'] = "Projeto editado com sucesso!";
                $urlDestino = URL . 'projeto/visualizar/' . $this->projetoId;
                header("Location: " . self::urlDestino);
                exit;
            endif;
        else:
            $verProjeto = new projetosModel();
            $this->dados = $verProjeto->visualizar($this->projetoId);
            if ($verProjeto->getRowCount() <= 0):
                $_SESSION['msg'] = "Necessário selecionar um projeto"; 
                header("Location: " . self::urlDestino);
                exit;
            endif;
        endif;
    }

    public function apagar($projetoId = null) 
    {
        if(logado()):
            $this->projetoId = (int) $projetoId;
            if (!empty($this->projetoId)):
                echo "Projeto a ser apagado: {$this->projetoId}<br>";
                $apagarProjeto = new projetosModel();
                $apagarProjeto->apagar($this->projetoId);
            else:
                $_SESSION['msg'] = "Necessário selecionar um projeto";
            endif;
            header("Location: " . self::urlDestino);
        else:
            $_SESSION['msg'] = 'Área restrita, apenas usuário logados podem ter acesso';
            header('Location:' . URL);
        endif;
    }

}