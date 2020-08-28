<?php

namespace app\controllers;
if (!isset($_SESSION)) { session_start(); }

use app\config\configView;
use app\models\homeModel;
use app\models\configModel;
use app\models\emailModel;
use app\models\projetosModel;
use app\models\equipeModel;

class home{
    private $userLogin;
    private $userPass;
    private $dados;
    


    public function index()
    {

        $config = new configModel();
        $this->dados[2] = $config->configs();

        $equipe = new equipeModel();
        $this->dados['equipe'] = $equipe->equipe();

        $carregarView = new configView('index', $this->dados);
        $carregarView->renderizar();
    }

    public function cursos()
    {

        $config = new configModel();
        $this->dados[2] = $config->configs();

        $carregarView = new configView('cursos', $this->dados);
        $carregarView->renderizar();
    }

    public function publicacoes()
    {

        $config = new configModel();
        $this->dados[2] = $config->configs();

        $carregarView = new configView('publicacoes', $this->dados);
        $carregarView->renderizar();
    }

    public function login(){
        $this->dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);
        $login = new homeModel();
        if (!empty($this->dados)):
            $result = $login->validar($this->dados['login'], $this->dados['pass']);
            if (isset($result[0]['id'])):
                $this->logar($result);
                $this->adm();
                exit;
            else:
                $_SESSION['msg']['alert'] = 'alert-warning';
                $_SESSION['msg'] = 'Erro no login, favor verifique usuário e senha!';
            endif;
            
        endif;
        $carregarView = new configView('login');
        $carregarView->renderizar();
    }

    public function adm(){
        if (logado()){
            $carregarView = new configView('adm');
            $carregarView->renderizar();
        } else {
            $_SESSION['msg'] = 'Apenas usuários logados podem acessar.';
            $this->index();

        }
        
    }

    private function logar(array $usuario){
        if (isset($usuario)):
            $_SESSION['usuario']['id'] = $usuario[0]['id'];
            $_SESSION['usuario']['nome'] = $usuario[0]['nome'];
            $_SESSION['usuario']['email'] = $usuario[0]['email'];
            $_SESSION['usuario']['nivel'] = $usuario[0]['nivel'];
            $_SESSION['usuario']['status'] = $usuario[0]['status'];
        endif;
    }

    public function deslogar(){
        if ($_SESSION['usuario']['id']):
            unset($_SESSION['usuario']['id']);
            unset($_SESSION['usuario']['nome']);
            unset($_SESSION['usuario']['email']);
            unset($_SESSION['usuario']['nivel']);
            unset($_SESSION['usuario']['status']);
            session_destroy();
        endif;
        header('Location:' . URL);
    }

    public function email(){
        $this->dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);
        $email = new emailModel();
        $envio = $email->enviarEmail($this->dados);
        if ($envio):
            $_SESSION['alert'] = 'alert-success';
            $_SESSION['msg'] = 'Obrigado, em breve retornaremos!';
            header('Location:' . URL);
        else:
            $_SESSION['alert'] = 'alert-warning';
            $_SESSION['msg'] = 'Desculpe, mas o e-mail não pode ser enviado, sugerimos entrar em contato pelo WhattsApp!';
            header('Location:' . URL);
        endif;
    }
}