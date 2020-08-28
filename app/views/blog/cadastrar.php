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
          <label for="titulo">Título</label>
          <input type="text" class="form-control" name="titulo" id="titulo" maxlength="150">
        </div>
        <div class="form-group">
          <label for="link">Link do post</label>
          <div class="input-group">
            <div class="input-group-append">
              <a class="input-group-text btn btn-info" onclick="strReplace();">Transformar</a>
            </div>
            <input type="text" class="form-control" name="link" id="link" maxlength="150">
          </div>
        </div>
        <div class="form-group">
          <label for="post">Post</label><br>
          <a onclick="cpp('\'\'\'SUBSTITUA AQUI\'\'\'');" class="btn btn-info" title="Negrito">B</a>
          <a onclick="cpp('\'\'SUBSTITUA AQUI\'\'');" class="btn btn-info" title="Itálico">i</a>  
          <a onclick="cpp('# Título nível 1');" class="btn btn-info" title="Título nível 1">H1</a>  
          <a onclick="cpp('## Título nível 2');" class="btn btn-info" title="Título nível 2">H2</a> 
          <a onclick="cpp('### Título nível 3');" class="btn btn-info" title="Título nível 3">H3</a> 
          <a onclick="cpp('* Item de lista');" class="btn btn-info" title="Item de lista">●</a>
          <a onclick="constructLink();" class="btn btn-info" title="Criar link">Link</a>
          <br><br>
          <textarea class="form-control" name="post" id="post" rows="15" maxlength="2500"></textarea>
        </div>
        <div class="form-group">
          <label for="foto">Foto</label>
          <div class="input-group">
            <div class="input-group-append">
              <a class="input-group-text btn btn-info" data-toggle="modal" data-target=".bd-example-modal-xl" id="btnGroupAddon">Selecionar</a>
            </div>
            <input type="text" class="form-control" name="foto" id="foto" maxlength="50">
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


<script>
  function strReplace(){
      var strTitulo = document.getElementById("titulo").value;
      var tamStr = strTitulo.length;
      var novaString = '';
      for (var i = 0; i < tamStr; i++) {
          novaString = novaString + troca(strTitulo[i])
      }

      document.getElementById("link").value = novaString;
  }
  function troca(strC){
      var troca01 = 'ABCDEFGHIJKLMNOPQRSTUVWXYZÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖØÙÚÛÜüÝÞßàáâãäåæçèéêëìíîïðñòóôõöøùúûýýþÿRr"!@#$%&*()_-+={[}]?;:.,\\\'<>°ºª ';
      var troca02 = 'abcdefghijklmnopqrstuvwxyzaaaaaaaceeeeiiiidnoooooouuuuuybsaaaaaaaceeeeiiiidnoooooouuuyybyRr--a-----------------------------';
      var tamStr = troca01.length;
          for (var i = 0; i < tamStr; i++) {
              if (strC == troca01[i]) {
                  strC = troca02[i];
                  console.log("Troca");
              }
          }
      return strC
  }
  function cpp(elem){
    var desc = document.getElementById('post');
    desc.value = desc.value + elem;
  }

  function constructLink(){
    var desc = document.getElementById('post');
    var text = prompt("Digite o texto que será apresentado no link");
    var link = prompt("Digite o endereço");
    var final = "[" + text + "](" + link + ")";
    desc.value = desc.value + final;
  }
</script>       
