<?php

namespace app\controllers;
if (!isset($_SESSION)) { session_start(); }

use app\config\configView;
use app\models\userModel;

class user{
    private $dados;
    private $pgId;
    private $userId;
    const urlDestino = URL . 'user/index';

    public function index($pgId = null){
        if(logado()):
            $this->pgId = ((int) $pgId ? $pgId : 1);

            $ListaUsuario = new userModel();
            $this->dados = $ListaUsuario->listar($this->pgId);

            $carregarView = new configView('user/index', $this->dados);
            $carregarView->renderizar();
        else:
            $_SESSION['msg'] = 'Área restrita, apenas usuário logados podem ter acesso';
            header('Location:' . URL);
            exit;
        endif;
    }

    public function cadastrar(){
        if(logado()):
            $this->dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);
            $CadUsuario = new userModel();
            if (!empty($this->dados)):
                $CadUsuario->cadastrar($this->dados);
                
            endif;

            $carregarView = new configView('user/cadastrar');
            $carregarView->renderizar();
        else:
            $_SESSION['msg'] = 'Área restrita, apenas usuário logados podem ter acesso';
            header('Location:' . URL);
        endif;
    }

    public function visualizar($userId = null) {
        if(logado()):
            $this->userId = (int) $userId;
            if (!empty($this->userId)):
                $verUser = new userModel();
                $this->dados = $verUser->visualizar($userId);

                if ($verUser->getResultado()):
                    $carregarView = new configView("user/visualizarUser", $this->dados);
                    $carregarView->renderizar();
                else:
                    $_SESSION['msg'] = "Usuário não encontrado!";
                    header("Location: " . self::urlDestino);
                    exit;
                endif;

            else:
                $_SESSION['msg'] = "É necessário selecionar um usuário!";   
                header("Location: " . self::urlDestino);
                exit;
            endif;
        else:
            $_SESSION['msg'] = 'Área restrita, apenas usuário logados podem ter acesso';
            header('Location:' . URL);
            exit;
        endif;
    }

    public function editar($userId = null) {
        if(logado()):
            $this->userId = (int) $userId;
            if (!empty($this->userId)):
                $this->dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);
                $this->atualizar();

                $carregarView = new ConfigView("user/editarUser", $this->dados);
                $carregarView->renderizar();
            else:
                $_SESSION['msg'] = "Necessário selecionar um usuário";   
                header('Location: ' . self::urlDestino);
                exit;
            endif;
        else:
            $_SESSION['msg'] = 'Área restrita, apenas usuário logados podem ter acesso';
            header('Location:' . URL);
            exit;
        endif;
    }

    private function atualizar() {
        if (!empty($this->dados)):
            unset($this->dados['SendEditUser']);
            if ($this->dados['pass'] == ''):
                unset($this->dados['pass']);
            endif;
            $editarUsuario = new userModel();
            $editarUsuario->editar($this->userId, $this->dados);
            if (!$editarUsuario->getResultado()):
                $_SESSION['msg'] = "Para editar o usuário preencha todos os campos!";
            else:
                $_SESSION['msg'] = "Usuário editado com sucesso!";
                $urlDestino = URL . 'userController/visualizar/' . $this->userId;
                header("Location: " . self::urlDestino);
                exit;
            endif;
        else:
            $verUser = new userModel();
            $this->dados = $verUser->visualizar($this->userId);
            if ($verUser->getRowCount() <= 0):
                $_SESSION['msg'] = "Necessário selecionar um usuário"; 
                header("Location: " . self::urlDestino);
                exit;
            endif;
        endif;
    }

    public function apagar($userId = null) {
        if(logado()):
            $this->userId = (int) $userId;
            if (!empty($this->userId)):
                echo "Usuário a ser apagado: {$this->userId}<br>";
                $ApagarUsuario = new userModel();
                $ApagarUsuario->apagar($this->userId);
            else:
                $_SESSION['msg'] = "Necessário selecionar um usuário";
            endif;
            header("Location: " . self::urlDestino);
        else:
            $_SESSION['msg'] = 'Área restrita, apenas usuário logados podem ter acesso';
            header('Location:' . URL);
        endif;
    }


}