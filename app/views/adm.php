<?php
  if(isset($_SESSION['msg'])):
    echo alertJS($_SESSION['msg']);
    unset($_SESSION['msg']);
  endif;
?>

<div class="container pt-5 pb-5">
  <div class="row pt-5">
    <div class="col-6 col-md-4">
      <div class="card">
        <div class="card-header">
          Equipe
        </div>
        <div class="card-body">
          <h5 class="card-title">Gestão da Equipe</h5>
          <p class="card-text">Nesta seção são listados os colaboradores que atuam no Observatório.<br>v1.0</p>
          <a href="<?= URL;?>equipe/listar" class="btn btn-primary">Visitar</a>
        </div>
      </div>
    </div>
    <div class="col-6 col-md-4">
      <div class="card">
        <div class="card-header">
          Projetos
        </div>
        <div class="card-body">
          <h5 class="card-title">Gestão dos projetos</h5>
          <p class="card-text">Nesta seção são listados os projetos, cadastro e edição.<br>v1.0</p>
          <a href="<?= URL;?>projetos/index" class="btn btn-primary">Visitar</a>
        </div>
      </div>
    </div>
    <div class="col-6 col-md-4">
      <div class="card">
        <div class="card-header">
          Galeria
        </div>
        <div class="card-body">
          <h5 class="card-title">Gestão da galeria</h5>
          <p class="card-text">Nesta seção são listadas as imagens, envio para o site a remoção das imagens.<br>v1.0</p>
          <a href="<?= URL;?>galeria/index" class="btn btn-primary">Visitar</a>
        </div>
      </div>
    </div>
  </div>
</div>