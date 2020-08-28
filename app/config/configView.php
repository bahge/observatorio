<?php

namespace app\config;

class configView {

    private $nome;
    private $dados;
    private $configs;

    public function __construct($nome, array $dados = null) {
        $this->nome = (string) $nome;
        $this->dados = $dados;
    }

    public function renderizar() {
        include './app/views/include/header.php';
        include './app/views/include/menu.php';
        if (file_exists( './app/views/' . $this->nome . '.php')):
            include './app/views/' . $this->nome . '.php';
        else:
            echo "Erro ao carregar a VIEW: {$this->nome}";
        endif;
        include './app/views/include/footer.php';
    }
    
    public function renderizarlogin() {
        if(file_exists('./app/views/'. $this->nome . '.php')):
            include './app/views/'. $this->nome . '.php';
        endif;
    }


    public function getdados() {
        return $this->dados;
    }

}