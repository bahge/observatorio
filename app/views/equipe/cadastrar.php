<?php
  if(isset($_SESSION['msg'])):
    echo alertJS($_SESSION['msg']);
    unset($_SESSION['msg']);
  endif;
?>
<style>
body{
  background-color:  rgba(65, 226, 156, 0.4);
}
</style>
<div class="container pt-5 bg-white">
  <div class="row pt-5 pb-5">
    <div class="col-12">
      <form method="Post" id="formCad">
        <div class="form-group">
          <label for="nome">Nome</label>
          <input type="text" class="form-control" name="nome" id="nome" maxlength="150">
        </div>
        <div class="form-group">
          <label for="link">Link</label>
          <input type="text" class="form-control" name="link" id="link" maxlength="150">
        </div>
        <div class="form-group">
          <label for="foto">Foto</label>
          <div class="input-group">
            <div class="input-group-append">
              <a class="input-group-text btn btn-info" data-toggle="modal" data-target=".bd-example-modal-xl" id="btnGroupAddon">Selecionar</a>
            </div>
            <input type="text" class="form-control" name="foto" id="foto" maxlength="50" value="---">
          </div>
        </div>
        <button class="btn btn-success" type="submit">Salvar</button>
      </form>
    </div>
  </div>
</div>

<div class="modal fade bd-example-modal-xl" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Galeria de Imagens</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div style="max-height: 512px;overflow-y: scroll;">
          <?php foreach($this->dados['galeria'] as $value): ?>
              <img src="<?= URL . 'upload/' .$value;?>" class="galery-item" width="256" height="256" >
          <?php endforeach; ?>
        </div>
      </div>
      <div class="modal-footer">
        <input type="text" style="width: 50%" name="img-sel" id="img-sel" disabled>
        <button type="button" class="btn btn-success" data-dismiss="modal" id="sendImageGallery">Salvar</button>
      </div>
    </div>
  </div>
</div>

