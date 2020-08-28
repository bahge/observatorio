<?php

namespace app\models;

use app\models\helpers\modelsInsert;
use app\models\helpers\modelsRead;
use app\models\helpers\modelsUpdate;
use app\models\helpers\modelsDelete;
use app\models\helpers\modelsPagination;


class projetosModel
{
    private $resultado;
    private $projetoId;
    private $dados;
    private $msg;
    private $rowCount;
    private $resultadoPaginacao;

    const Entity = 'projects';

    public function projetos() 
    {
        $projetos = new modelsRead();
        $projetos->listar(self::Entity);
        if ($projetos->getResultado()):
            $this->resultado = $projetos->getResultado();
            return array($this->resultado);
        else:
            return array("Sem projetos cadastrados.");
        endif;
    }

    public function cadastrar(array $dados) 
    {
        $this->dados = $dados;
        $this->ValidarDados();
        if ($this->resultado):
            $this->inserir();
            if ($this->resultado > 0):
                $_SESSION['msg'] = 'Projeto cadastrado com sucesso.';
              return true;
            else:
                $_SESSION['msg'] = 'Erro ao cadastrar projeto.';
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

    public function listarNomes()
    {
        $projetos = new modelsRead();
        $projetos->listar(self::Entity);
        if ($projetos->getResultado()):
            $this->resultado['projetos'] = $projetos->getResultado();

            foreach ($this->resultado['projetos'] as $key => $value) {
                $this->resultado['nmprojetos'][$key] = array_filter($value, function($k) {
                    return $k == 'nome';
                }, ARRAY_FILTER_USE_KEY);
            }
            return array($this->resultado['nmprojetos']);
        else:
            return array("Sem projetos cadastrados.");
        endif;
    }

    public function visualizar($projetoId) 
    {
        $this->projetoId = (int) $projetoId;
        $visualizar = new modelsRead();
        $visualizar->listar(self::Entity, 'WHERE id =:id LIMIT :limit', "id={$this->projetoId}&limit=1");
        $this->resultado = $visualizar->getResultado();
        $this->rowCount = $visualizar->getRowCount();
        return $this->resultado;
    }

    public function editar($projetoId, array $dados) 
    {
        $this->projetoId = (int) $projetoId;
        $this->dados = $dados;
        $this->projetoId = $this->dados['id'];

        $this->validarDados();
        if ($this->resultado):
            $this->alterar();
        endif;
    }

    private function alterar() 
    {
        $update = new modelsUpdate();
        $update->atualizar(self::Entity, $this->dados, "WHERE id = :id", "id={$this->projetoId }");
        if ($update->getResultado()):
            $this->resultado = true;
        else:
            $this->resultado = false;
        endif;
        if ($this->resultado):
            $_SESSION['msg'] = 'Projeto editado com sucesso!';
        else:
            $_SESSION['msg'] = 'Erro ao editar o projeto!';
        endif;
    }

    public function apagar($projetoId) 
    {
        $this->dados = $this->visualizar($projetoId);
        if ($this->getRowCount() > 0):
            $apagarProjeto = new modelsDelete();
            $apagarProjeto->apagar(self::Entity, 'WHERE id = :id', "id=$projetoId");
            $this->resultado = $apagarProjeto->getResultado();
            $_SESSION['msg'] = 'Projeto apagado com sucesso!';
        else:
            $_SESSION['msg'] = 'Erro ao apagar projeto!';
        endif;
    }

    public function getResultado() { return $this->resultado; }
    public function getRowCount() { return $this->rowCount; }
    
}