<?php
 if ( $this->dados['colaborador']):
  
  $colaborador = $this->dados['colaborador'][0];
  extract($colaborador);
?>

<div class="container pt-5 pb-5">
  <div class="row pt-5">
      <div class="col-12 col-md-6">
        <div class="alert alert-warning" role="alert">
            Tem certeza que deseja apagar, o colaborador?
        </div>
        <form method="POST">
            <div class="form-group">
                <label for="arquivo">Nome</label>
                <p><?= $nome?></p>
                <input type="hidden" name="id" class="form-control" id="id" aria-describedby="nome" value="<?= $this->dados['id'];?>">
                <small id="nome" class="form-text text-muted">Nome do colaborador desabilitado de edição.</small>
            </div>
            <a href="<?= URL . 'equipe/listar';?>" class="btn btn-danger">Não</a> <button type="submit" class="btn btn-success">Sim</button>
        </form>
      </div>
      <div class="col-12 col-md-6">
        <img src="<?= ($foto != '---') ? URL . 'upload/' . $foto : URL . 'assets/img/logoquadrado.png';?>" class="img-fluid pb-3" alt="<?= $nome; ?>">
      </div>
  </div>
</div>

<?php
else:
    if (!isset($_POST['submit'])):
        header("Location: " . URL . "equipe/listar");
        $_SESSION['msg'] = "O arquivo não existe ou foi apagado com sucesso!";
        exit;
    endif;
endif;
?>