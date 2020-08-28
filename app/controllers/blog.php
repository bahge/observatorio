<?php

namespace app\controllers;
if (!isset($_SESSION)) { session_start(); }

use app\config\configView;
use app\models\configModel;
use app\models\blogModel;
use app\controllers\galeria;

class blog
{
    private $dados;
    private $blogId;
    const urlDestino = URL . 'blog/index';

    public function index()
    {
        $config = new configModel();
        $this->dados['cfg'] = $config->configs();
        
        $posts = new blogModel();
        $this->dados['posts'] = $posts->posts();

        $carregarView = new configView('blog/index', $this->dados);
        $carregarView->renderizar();
    }

    public function cadastrar()
    {
        if (logado()):
            $this->dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);
            $cadBlog = new blogModel();
            if (!empty($this->dados)):
                $cadastro = $cadBlog->cadastrar($this->dados);
                if ($cadastro):
                    header("Location: " . self::urlDestino);
                    exit;
                endif;
            endif;

            $config = new configModel();
            $this->dados['cfg'] = $config->configs();
    
            $galeria = new galeria();
            $this->dados['galeria'] = $galeria->listar();
    
            $carregarView = new configView('blog/cadastrar', $this->dados);
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
        
        $blog = new blogModel();
        $this->dados['blog'] = $blog-> blog();

        $carregarView = new configView('blog/listar', $this->dados);
        $carregarView->renderizar();
    }

    public function listarNomes()
    {
        $config = new configModel();
        $this->dados['cfg'] = $config->configs();
        
        $blog = new blogModel();
        $this->dados['blog'] = $blog-> listarNomes();

        return $this->dados['blog'];
    }

    public function visualizar($blogId = null) 
    {
        if(logado()):
            $this->blogId = (int) $blogId;
            if (!empty($this->blogId)):
                $verblog = new blogModel();
                $this->dados['blog'] = $verblog->visualizar($blogId);

                if ($verblog->getResultado()):
                    $carregarView = new configView("blog/visualizar", $this->dados);
                    $carregarView->renderizar();
                else:
                    $_SESSION['msg'] = "blog não encontrado!";
                    header("Location: " . self::urlDestino);
                    exit;
                endif;

            else:
                $_SESSION['msg'] = "É necessário selecionar um blog!";   
                header("Location: " . self::urlDestino);
                exit;
            endif;
        else:
            $_SESSION['msg'] = 'Área restrita, apenas blog logados podem ter acesso';
            header('Location:' . URL);
            exit;
        endif;
    }

    public function editar($id = null)
    {
        if(logado()):
            $this->blogId = (int) $id;
            if (!empty($this->blogId)):
                $this->dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);
                $this->atualizar();

                $config = new configModel();
                $this->dados['cfg'] = $config->configs();
                
                $blog = new blogModel();
                $this->dados['blog'] = $blog-> visualizar($this->blogId);
    
                $galeria = new galeria();
                $this->dados['galeria'] = $galeria->listar();

                $carregarView = new ConfigView("blog/editar", $this->dados);
                $carregarView->renderizar();
            else:
                $_SESSION['msg'] = "Necessário selecionar um blog";   
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
            $editarblog = new blogModel();
            $editarblog->editar($this->blogId, $this->dados);
            if (!$editarblog->getResultado()):
                $_SESSION['msg'] = "Para editar um blog preencha todos os campos!";
            else:
                $_SESSION['msg'] = "blog editado com sucesso!";
                $urlDestino = URL . 'blog/visualizar/' . $this->blogId;
                header("Location: " . self::urlDestino);
                exit;
            endif;
        else:
            $verblog = new blogModel();
            $this->dados = $verblog->visualizar($this->blogId);
            if ($verblog->getRowCount() <= 0):
                $_SESSION['msg'] = "Necessário selecionar um blog"; 
                header("Location: " . self::urlDestino);
                exit;
            endif;
        endif;
    }

    public function apagar($blogId = null) 
    {
        if(logado()):
            $this->blogId = (int) $blogId;
            if (!empty($this->blogId)):
                echo "blog a ser apagado: {$this->blogId}<br>";
                $apagarblog = new blogModel();
                $apagarblog->apagar($this->blogId);
            else:
                $_SESSION['msg'] = "Necessário selecionar um blog";
            endif;
            header("Location: " . self::urlDestino);
        else:
            $_SESSION['msg'] = 'Área restrita, apenas usuário logados podem ter acesso';
            header('Location:' . URL);
        endif;
    }

}