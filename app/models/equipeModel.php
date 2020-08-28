<?php

namespace app\models;

use app\models\helpers\modelsInsert;
use app\models\helpers\modelsRead;
use app\models\helpers\modelsUpdate;
use app\models\helpers\modelsDelete;
use app\models\helpers\modelsPagination;


class equipeModel
{
    private $resultado;
    private $equipeId;
    private $dados;
    private $msg;
    private $rowCount;
    private $resultadoPaginacao;

    const Entity = 'team';

    public function equipe() 
    {
        $equipe = new modelsRead();
        $equipe->listar(self::Entity);
        if ($equipe->getResultado()):
            $this->resultado = $equipe->getResultado();
            return array($this->resultado);
        else:
            return array("Sem equipe cadastrada.");
        endif;
    }

    public function cadastrar(array $dados) 
    {
        $this->dados = $dados;
        $this->ValidarDados();
        if ($this->resultado):
            $this->inserir();
            if ($this->resultado > 0):
                $_SESSION['msg'] = 'Colaborador cadastrado com sucesso.';
              return true;
            else:
                $_SESSION['msg'] = 'Erro ao cadastrar colaborador.';
              return false;
            endif;
        endif;
    }

    private function validarDados()
    {
        $this->dados = array_map('strip_tags', $this->dados);
        $this->dados = array_map('trim', $this->dados);
        if (in_array('', $this->dados)):
            $this->resultado = false;
        else:
            $this->resultado = true;
        endif;
    }

    private function inserir() 
    {
        $insert = new modelsInsert;
        $insert->Inserir(self::Entity, $this->dados);
        if ($insert->getResultado()):
            $this->resultado = $insert->getResultado();
        endif;
    }

    public function visualizar($equipeId) 
    {
        $this->equipeId = (int) $equipeId;
        $visualizar = new modelsRead();
        $visualizar->listar(self::Entity, 'WHERE id =:id LIMIT :limit', "id={$this->equipeId}&limit=1");
        $this->resultado = $visualizar->getResultado();
        $this->rowCount = $visualizar->getRowCount();
        return $this->resultado;
    }

    public function editar($equipeId, array $dados) 
    {
        $this->equipeId = (int) $equipeId;
        $this->dados = $dados;
        $this->equipeId = $this->dados['id'];

        $this->validarDados();
        if ($this->resultado):
            $this->alterar();
        endif;
    }

    private function alterar() 
    {
        $update = new modelsUpdate();
        $update->atualizar(self::Entity, $this->dados, "WHERE id = :id", "id={$this->equipeId }");
        if ($update->getResultado()):
            $this->resultado = true;
        else:
            $this->resultado = false;
        endif;
        if ($this->resultado):
            $_SESSION['msg'] = 'Colaborador editado com sucesso!';
        else:
            $_SESSION['msg'] = 'Erro ao editar colaborador!';
        endif;
    }

    public function apagar($equipeId) 
    {
        $this->dados = $this->visualizar($equipeId);
        if ($this->getRowCount() > 0):
            $apagar = new modelsDelete();
            $apagar->apagar(self::Entity, 'WHERE id = :id', "id=$equipeId");
            $this->resultado = $apagar->getResultado();
        else:
            $_SESSION['msg'] = 'Erro ao apagar colaborador!';
        endif;
    }

    public function getResultado() { return $this->resultado; }
    public function getRowCount() { return $this->rowCount; }    
}