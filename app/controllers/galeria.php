<?php

namespace app\controllers;
if (!isset($_SESSION)) { session_start(); }
use app\config\configView;
use app\models\galeriaModel;

class galeria
{
    private $name;
    private $folder;
    private $dados;
    private $resultado;
    private $fileName;
    private $files;
    const urlDestino = URL . 'galeria/index';

    public function index()
    {
        if (logado()):
            $this->dados['arquivos'] = $this->listar();
            $carregarView = new configView('galeria/index', $this->dados);
            $carregarView->renderizar();
        else:
            $_SESSION['msg'] = 'Área restrita, apenas usuário logados podem ter acesso';
            header('Location:' . URL);
        endif;
    }

    public function listar()
    {

        $path = "upload/";
        $diretorio = dir($path);
        $files = [];

       while($arquivo = $diretorio -> read()){
            $removeArquivo = preg_match('/(.php)/', $arquivo, $matches, PREG_OFFSET_CAPTURE);
            if ($removeArquivo != 1):
                if ( ($arquivo != ".") AND ($arquivo != "..") ):
                    array_push($files, $arquivo);
                endif;
            endif;
        }
        $diretorio -> close();
        return $files;
    }

    public function apagar($file_name)
    {
        if (logado()):

            $this->files = $this->listar();
            $this->fileName = (String) $file_name;
            $this->dados['arquivo'] = strtr($this->fileName, '-', '.');

            if (fileExists('./upload/', $this->dados['arquivo']) ):
                $this->dados['existe'] = true;
            else:
                $this->dados['existe'] = false;
            endif;    

            $this->dados['POST'] = filter_input_array(INPUT_POST, FILTER_DEFAULT);
            if ( !is_null($this->dados['POST']) ) :
                $this->dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);
                $this->delete_file();
                $file = 'upload/' . $this->dados['arquivo'];
                if ( !file_exists( $file ) ):
                    $_SESSION['msg'] = 'Arquivo apagado com sucesso';
                    header('Location:' . urlDestino);
                    exit;
                endif;
            endif;

            $carregarView = new configView('galeria/apagar', $this->dados);
            $carregarView->renderizar();
        else:
            $_SESSION['msg'] = 'Área restrita, apenas usuário logados podem ter acesso';
            header('Location:' . URL);
        endif;
    }

    private function delete_file(){
        $file = 'upload/' . $this->dados['arquivo'];
        if ( file_exists( $file ) ):
            unlink( $file );
        endif;
    }

    public function getName(){ return $this->name; }
    public function setName($name){ $this->name = $name; }
    public function getFolder(){ return $this->folder; }
    public function setFolder($folder){ $this->folder = $folder; }
    public function getDados(){ return $this->dados; }
    public function setDados($dados){ $this->dados = $dados; }
    public function getResultado(){ return $this->resultado; }
    public function setResultado($resultado){ $this->resultado = $resultado; }
}