<?php

namespace app\models;
use Exception;

class configModel{
    private $dados;
    private $cfg;

    const arqpath = './config/';

    public function salvarArquivo(array $dados){

        $string = '';
        foreach ($dados as $config => $value) {
            $string .= $config . ':' . $value . "\n";
        }

        try {
            $arquivo = self::arqpath . 'cfg.gsc';

            if ( !file_exists($arquivo) ) { throw new Exception('Arquivo não encontrado.'); }

            $arq = fopen($arquivo, "w+");

            if ( !$arq ) { throw new Exception('Falha na abertura do arquivo.'); }  
        
            if (!fwrite($arq, $string)) { throw new Exception('Falha ao gravar o conteúdo no arquivo'); }
        
            fclose($arq);

            $_SESSION['msg'] = 'Arquivo de configurações salvo.';

        } catch ( Exception $e ) {
            $_SESSION['msg'] = 'Erro ao salvar o arquivo de configurações./n' . $e->getMessage();
        }
    }

    public function configs(){
      $arquivo = fopen ("./config/cfg.gsc", 'r');
          $string = file_get_contents("./config/cfg.gsc");
      fclose($arquivo);
      foreach (explode("\n", $string) as $linha) {
          $configs[
              substr($linha, 0, (int) strpos($linha, ':'))
                  ] = substr($linha, (int) strpos($linha, ':') + 1, (int) strlen($linha));
      }
      return $configs;
  }

    
}