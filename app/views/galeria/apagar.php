<?php
 if ( $this->dados['existe']):
?>

<div class="container pt-5 pb-5">
  <div class="row pt-5">
      <div class="col-12 col-md-6">
        <div class="alert alert-warning" role="alert">
            Tem certeza que deseja apagar, o arquivo?
        </div>
        <form method="POST">
            <div class="form-group">
                <label for="arquivo">Nome do arquivo</label>
                <p><?= $this->dados['arquivo'];?></p>
                <input type="hidden" name="arquivo" class="form-control" id="arquivo" aria-describedby="fileName" value="<?= $this->dados['arquivo'];?>">
                <input type="hidden" name="existe" value="<?= $this->dados['existe'];?>">
                <small id="fileName" class="form-text text-muted">Nome do arquivo desabilitado de edição.</small>
            </div>
            <a href="<?= URL . 'galeria/index';?>" class="btn btn-danger">Não</a> <button type="submit" class="btn btn-success">Sim</button>
        </form>
      </div>
      <div class="col-12 col-md-6">
        <img src="<?=URL .'upload/'. $this->dados['arquivo'];?>" width="256" heigth="256">
      </div>
  </div>
</div>

<?php
else:
    if (!isset($_POST['submit'])):
        header("Location: " . URL . "galeria/index");
        $_SESSION['msg'] = "O arquivo não existe ou foi apagado com sucesso!";
        exit;
    endif;
endif;
?>