<?php

namespace app\controllers;
if (!isset($_SESSION)) { session_start(); }

use app\config\configView;
use app\models\configModel;
use app\models\equipeModel;

class equipe
{
    private $dados;
    private $equipeId;
    const urlDestino = URL . 'equipe/index';

    public function index()
    {
        $config = new configModel();
        $this->dados['cfg'] = $config->configs();
        
        $equipe = new equipeModel();
        $this->dados['equipe'] = $equipe->equipe();

        $carregarView = new configView('equipe/listar', $this->dados);
        $carregarView->renderizar();
    }

    public function cadastrar()
    {
        if (logado()):
            $this->dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);
            $cadProduto = new equipeModel();
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
    
            $carregarView = new configView('equipe/cadastrar', $this->dados);
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
        
        $equipe = new equipeModel();
        $this->dados['equipe'] = $equipe-> equipe();

        $carregarView = new configView('equipe/listar', $this->dados);
        $carregarView->renderizar();
    }

    public function listarNomes()
    {
        $config = new configModel();
        $this->dados['cfg'] = $config->configs();
        
        $equipe = new equipeModel();
        $this->dados['equipe'] = $equipe-> listarNomes();

        return $this->dados['equipe'];
    }

    public function visualizar($equipeId = null) 
    {
        if(logado()):
            $this->equipeId = (int) $equipeId;
            if (!empty($this->equipeId)):
                $verProjeto = new equipeModel();
                $this->dados['equipe'] = $verProjeto->visualizar($equipeId);

                if ($verProjeto->getResultado()):
                    $carregarView = new configView("equipe/visualizar", $this->dados);
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
            $this->equipeId = (int) $id;
            if (!empty($this->equipeId)):
                $this->dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);
                $this->atualizar();

                $config = new configModel();
                $this->dados['cfg'] = $config->configs();
                
                $equipe = new equipeModel();
                $this->dados['projeto'] = $equipe-> visualizar($this->equipeId);
    
                $galeria = new galeria();
                $this->dados['galeria'] = $galeria->listar();

                $carregarView = new ConfigView("equipe/editar", $this->dados);
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
            $editarEquipe = new equipeModel();
            $editarEquipe->editar($this->equipeId, $this->dados);
            if (!$editarEquipe->getResultado()):
                $_SESSION['msg'] = "Para editar um colaborador preencha todos os campos!";
            else:
                $_SESSION['msg'] = "Colaborador editado com sucesso!";
                $urlDestino = URL . 'equipe/visualizar/' . $this->equipeId;
                header("Location: " . self::urlDestino);
                exit;
            endif;
        else:
            $verEquipe = new equipeModel();
            $this->dados = $verEquipe->visualizar($this->equipeId);
            if ($verEquipe->getRowCount() <= 0):
                $_SESSION['msg'] = "Necessário selecionar um equipe"; 
                header("Location: " . self::urlDestino);
                exit;
            endif;
        endif;
    }

    public function apagar($equipeId = null) 
    {
        if(logado()):
            $this->equipeId = (int) $equipeId;
            if (!empty($this->equipeId)):
                $this->dados['POST'] = filter_input_array(INPUT_POST, FILTER_DEFAULT);
                if ( !is_null($this->dados['POST']) ) :
                    $this->dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);

                        $apagarColaborador = new equipeModel();
                        $apagarColaborador->apagar($this->equipeId);
                        $this->resultado = $apagarColaborador->getResultado();

                        if ($this->resultado):
                            $_SESSION['msg'] = 'Colaborador apagado com sucesso';
                        else:
                            $_SESSION['msg'] = 'Erro ao apagar o colaborador';
                        endif;    
                        header('Location:' . urlDestino);
                        exit;
                endif;
                    
                    $verColaborador = new equipeModel();
                    $this->dados['colaborador'] = $verColaborador->visualizar($equipeId);

                    $carregarView = new ConfigView("equipe/apagar", $this->dados);
                    $carregarView->renderizar();

            else:
                
            endif;
            header("Location: " . self::urlDestino);
        else:
            $_SESSION['msg'] = 'Área restrita, apenas usuário logados podem ter acesso';
            header('Location:' . URL);
        endif;
    }
}