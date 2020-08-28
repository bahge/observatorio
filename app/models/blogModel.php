<?php

namespace app\models;

use app\models\helpers\modelsInsert;
use app\models\helpers\modelsRead;
use app\models\helpers\modelsUpdate;
use app\models\helpers\modelsDelete;
use app\models\helpers\modelsPagination;


class blogModel
{
    private $resultado;
    private $postId;
    private $dados;
    private $msg;
    private $rowCount;
    private $resultadoPaginacao;

    const Entity = 'blog';

    public function posts() 
    {
        $posts = new modelsRead();
        $posts->listar(self::Entity);
        if ($posts->getResultado()):
            $this->resultado = $posts->getResultado();
            return array($this->resultado);
        else:
            return array("Sem post's cadastrados.");
        endif;
    }

    public function cadastrar(array $dados) 
    {
        $this->dados = $dados;
        $this->ValidarDados();
        if ($this->resultado):
            $this->inserir();
            if ($this->resultado > 0):
                $_SESSION['msg'] = 'Post cadastrado com sucesso.';
              return true;
            else:
                $_SESSION['msg'] = 'Erro ao cadastrar post.';
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

    public function visualizar($postId) 
    {
        $this->projetoId = (int) $postId;
        $visualizar = new modelsRead();
        $visualizar->listar(self::Entity, 'WHERE id =:id LIMIT :limit', "id={$this->projetoId}&limit=1");
        $this->resultado = $visualizar->getResultado();
        $this->rowCount = $visualizar->getRowCount();
        return $this->resultado;
    }

    public function editar($postId, array $dados) 
    {
        $this->projetoId = (int) $postId;
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

    public function apagar($postId) 
    {
        $this->dados = $this->visualizar($postId);
        if ($this->getRowCount() > 0):
            $apagarProjeto = new modelsDelete();
            $apagarProjeto->apagar(self::Entity, 'WHERE id = :id', "id=$postId");
            $this->resultado = $apagarProjeto->getResultado();
            $_SESSION['msg'] = 'Projeto apagado com sucesso!';
        else:
            $_SESSION['msg'] = 'Erro ao apagar projeto!';
        endif;
    }

    public function getResultado() { return $this->resultado; }
    public function getRowCount() { return $this->rowCount; }
    
}