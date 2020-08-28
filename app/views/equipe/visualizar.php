<?php
  if(isset($_SESSION['msg'])):
    echo alertJS($_SESSION['msg']);
    unset($_SESSION['msg']);
  endif;
?>

<div class="container pt-5">
    <div class="row pt-5 pb-5">
        <?php 
            $colaborador = $this->dados['equipe'][0];
            extract($colaborador);
        ?>    
            <div class="col-12 col-md-6">
                <h3 class="txt-c-03"><?= $nome; ?></h3>
                <p class="text-justify"><?= $link; ?></p>
                <br><br><br><br>
                <a href="<?= URL;?>equipe/listar" class="btn btn-primary">Voltar</a> 
            </div>
            <div class="col-12 col-md-6">
                <img src="<?= ($foto != '---') ? URL . 'upload/' . $foto : URL . 'assets/img/logoquadrado.png';?>" class="img-fluid pb-3" alt="<?= $nome; ?>">
            </div>
            <div class="col-12">
                <hr style="border: 3px solid rgba(65, 226, 156, 0.4);">
            </div>
    </div>
</div>