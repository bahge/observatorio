<?php
  if(isset($_SESSION['msg'])):
    echo alertJS($_SESSION['msg']);
    unset($_SESSION['msg']);
  endif;
?>


<div class="container pt-5">
    <div class="row pt-5 pb-5">
        <div class="col-12">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item active" aria-current="page">Galeria</li>
                </ol>
            </nav>
            <ul class="nav nav-tabs" id="myTab" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" id="lista-galery" data-toggle="tab" href="#galery" role="tab" aria-controls="galery" aria-selected="true">Imagens</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="send-img-tab" data-toggle="tab" href="#send-img" role="tab" aria-controls="profile" aria-selected="false">Enviar Imagem</a>
                </li>
            </ul>
            <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade show active" id="galery" role="tabpanel" aria-labelledby="lista-galery">
                    <div style="max-height: 512px;overflow-y: scroll;">
                        <?php foreach($this->dados['arquivos'] as $value): ?>
                            <img src="<?= URL . 'upload/' .$value;?>" class="galery-item" width="256" height="256" >
                        <?php endforeach; ?>
                    </div>
                    <hr>
                    <div class="btn-group" role="group" aria-label="Exemplo básico">
                        <input type="text" id="img-sel" name="teste" disabled style="width: 300px;">
                        <button type="button" class="btn btn-danger" id="btn-del" onclick="sendDelete();"disabled>Apagar</button>
                    </div>
                </div>
                <div class="tab-pane fade" id="send-img" role="tabpanel" aria-labelledby="send-img-tab">
                <form action="" enctype="multipart/form-data" id="file-form" method="POST">
                    <div id="upup p-5">
                        <h2 class="py-2">Envio de imagens</h2>
                        <input type="file" name="file-upload"  id="file-upload" accept=".jpg, .png, .jpeg, .gif|image/*">
                        <button class="btn btn-success" type="submit" id="upload-button">Upload</button>

                        <p id="progressdiv"><progress max="100" value="0" id="progress" style="display: none;"></progress></p>
                    </div>
                </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
  var form = document.getElementById('file-form');
  var fileSelect = document.getElementById('file-upload');
  var uploadButton = document.getElementById('upload-button');

  form.onsubmit = function(event) {
    event.preventDefault();

    var progress = document.getElementById('progress');
    var progressdiv = document.getElementById('progressdiv');

    progress.style.display = "block";
    uploadButton.innerHTML = 'Enviado a imagem...';


    var files = fileSelect.files;
    var formData = new FormData();
    var file = files[0];
    formData.append('file-upload', file, file.name);
    var xhr = new XMLHttpRequest();
    xhr.open('POST', '<?=  URL;?>upload/upload.php', true);
    xhr.upload.onprogress = function (e) {
      update_progress(e);
    }
    xhr.onload = function (e) {
      if (xhr.status === 200) {
        uploadButton.innerHTML = 'Upload';
        progressdiv.innerHTML = "<h3>Sucesso imagem enviada</h3>";
        document.location.reload(true);
      } else {
        alert('Ocorreu um erro no envio da imagem!');
      }
    };
    xhr.send(formData);
  }

  function update_progress(e){
      if (e.lengthComputable){
          var percentage = Math.round((e.loaded/e.total)*100);
          progress.value = percentage;
          uploadButton.innerHTML = 'Envio: '+percentage+'%';
          console.log("percent " + percentage + '%' );
      }
      else{
        console.log("Incapaz de calcular as informações de progresso, pois o tamanho total é desconhecido");
      }
  }
  function sendDelete(){
      var filename = $('#img-sel').val();
      document.location = '<?= URL;?>galeria/apagar/' + filename;
  }
</script>
