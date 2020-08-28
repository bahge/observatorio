<?php
  if(isset($_SESSION['msg'])):
    echo alertJS($_SESSION['msg']);
    unset($_SESSION['msg']);
  endif;
?>
<div class="container">
    <div class="row">
        <div class="col">
            <div class="card">
            <h4 class="card-header txt-a-center pb-1 txt-c-01"><i class="fgs fgs-detalhes fgs-2x"></i> Detalhes do usuário</h4><hr>
                <?php
                if (!empty($this->dados[0]['id'])):
                    ?>
                    <div class="row pt-1">
                        <p class="col col-sidebar txt-a-right"><strong> Código:</strong></p>
                        <p class="col col-content"><?php echo $this->dados[0]['id']; ?></p>
                        <p class="col col-sidebar txt-a-right"><strong> Nome:</strong></p>
                        <p class="col col-content"><?php echo $this->dados[0]['nome']; ?></p>
                        <p class="col col-sidebar txt-a-right"><strong> E-mail:</strong></p>
                        <p class="col col-content"><?php echo $this->dados[0]['email']; ?></p>
                        <p class="col col-sidebar txt-a-right"><strong> Status:</strong></p>
                        <p class="col col-content"><?php echo statusCod($this->dados[0]['status']); ?></p>
                        <p class="col col-sidebar txt-a-right"><strong> Nivel:</strong></p>
                        <p class="col col-content"><?php echo nivelCod($this->dados[0]['nivel']); ?></p>
                        <p class="col pt-1"><button class="btn btn-secondary" onclick="location.href = '<?php echo URL . '/userController/index';?>';" title="Voltar"><i class="fgs fgs-menosbt"></i></button></p>
                    </div>    

                    <?php
                else:
                    echo "<div>Nenhum dado encontrado.</div>";
                endif;
                ?>
            </div>
        </div>
    </div>
</div>