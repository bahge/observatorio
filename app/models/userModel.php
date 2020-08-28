<?php

namespace app\models;

use app\models\helpers\modelsInsert;
use app\models\helpers\modelsRead;
use app\models\helpers\modelsUpdate;
use app\models\helpers\modelsDelete;
use app\models\helpers\modelsPagination;


class userModel{
    private $resultado;
    private $userId;
    private $dados;
    private $msg;
    private $rowCount;
    private $resultadoPaginacao;

    const Entity = 'users';

    /**
     * Function listar()
     */
    public function listar($pgId) 
    {
        $paginacao = new ModelsPagination(URL . 'userController/index/');
        $paginacao->condicao($pgId, 10);
        $this->resultadoPaginacao = $paginacao->paginacao('users');

        $Listar = new ModelsRead();
        $Listar->listar(self::Entity, 'LIMIT :limit OFFSET :offset', "limit={$paginacao->getLimiteResultado()}&offset={$paginacao->getOffset()}");
        if ($Listar->getResultado()):
            $this->Resultado['users'] = $Listar->getResultado();
            return array($this->Resultado, $this->resultadoPaginacao);
        else:
            $paginacao->paginaInvalida();
        endif;
    }

    public function cadastrar(array $dados) {
        $this->dados = $dados;
        $this->ValidarDados();
        if ($this->resultado):
            unset($this->dados['SendCadUser']);
            $this->inserir();
            if ($this->resultado > 0):
                $_SESSION['msg'] = 'Usuário cadastrado com sucesso!';
            else:
                $_SESSION['msg'] = 'Erro ao cadastrar usuário!';
            endif;
        endif;
    }

    private function validarDados(){
        $this->dados = array_map('strip_tags', $this->dados);
        $this->dados = array_map('trim', $this->dados);
        if (in_array('', $this->dados)):
            $this->resultado = false;
        else:
            if (isset($this->dados['pass'])):
                $this->dados['pass'] = sha1(md5($this->dados['pass']));
            endif;
            $this->resultado = true;
        endif;
    }

    private function inserir() {
        $insert = new modelsInsert;
        $insert->Inserir(self::Entity, $this->dados);
        if ($insert->getResultado()):
            $this->resultado = $insert->getResultado();
        endif;
    }

    public function visualizar($userId) {
        $this->userId = (int) $userId;
        $visualizar = new modelsRead();
        $visualizar->listar(self::Entity, 'WHERE id =:id LIMIT :limit', "id={$this->userId}&limit=1");
        $this->resultado = $visualizar->getResultado();
        $this->rowCount = $visualizar->getRowCount();
        return $this->resultado;
    }

    public function editar($userId, array $dados) {
        $this->userId = (int) $userId;
        $this->dados = $dados;
        $this->userId = $this->dados['id'];

        $this->validarDados();
        if ($this->resultado):
            $this->alterar();
        endif;
    }

    private function alterar() {
        $update = new modelsUpdate();
        $update->atualizar(self::Entity, $this->dados, "WHERE id = :id", "id={$this->userId }");
        if ($update->getResultado()):
            $this->resultado = true;
        else:
            $this->resultado = false;
        endif;
        if ($this->resultado):
            $_SESSION['msg'] = 'Usuário editado com sucesso!';
        else:
            $_SESSION['msg'] = 'Erro ao editar usuário!';
        endif;
    }

    public function apagar($userId) {
        $this->dados = $this->visualizar($userId);
        if ($this->getRowCount() > 0):
            $apagarUsuario = new modelsDelete();
            $apagarUsuario->apagar('users', 'WHERE id = :id', "id=$userId");
            $this->resultado = $apagarUsuario->getResultado();
            $_SESSION['msg'] = 'Usuário apagado com sucesso!';
        else:
            $_SESSION['msg'] = 'Erro ao apagar usuário!';
        endif;
    }

    public function getResultado() { return $this->resultado; }
    public function getMsg() { return $this->msg; }
    public function getRowCount() { return $this->rowCount; }

}