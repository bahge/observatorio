<?php
  if(isset($_SESSION['msg'])):
    echo alertJS($_SESSION['msg']);
    unset($_SESSION['msg']);
  endif;
?>

<div class="container pt-5">
    <div class="row pt-5 pb-5">
        <?php 
            $projetos = $this->dados['projetos'][0];
            foreach ($projetos as $projeto) :
                extract($projeto);
        ?>    
            <div class="col-12 col-md-4" id="projeto-<?= strtr($nome, " ", "-");?>">
                <h3 class="txt-c-03"><?= $nome; ?></h3>
                <p class="text-justify"><?= $descricao; ?></p>
                <br>
                <img src="<?= URL . 'upload/' . $foto;?>" class="img-fluid pb-3" alt="<?= $nome; ?>">
            </div>

            <div class="col-12 col-md-8">
                <div class="accordion" id="accordion-proj-id-<?= $id;?>">
                    <div class="card">
                        <div class="card-header" id="head-one-id-<?=$id;?>">
                            <h5 class="mb-0">
                                <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#objetivo-id-<?=$id;?>" aria-expanded="false" aria-controls="objetivo-id-<?=$id;?>">Objetivo</button>
                            </h5>
                        </div>

                        <div id="objetivo-id-<?=$id;?>" class="collapse" aria-labelledby="head-one-id-<?=$id;?>" data-parent="#accordion-proj-id-<?= $id;?>">
                            <div class="card-body"><?= $objetivo; ?></div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header" id="head-two-id-<?=$id;?>">
                            <h5 class="mb-0">
                                <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#justificativa-id-<?=$id;?>" aria-expanded="false" aria-controls="justificativa-id-<?=$id;?>">Justificativa</button>
                            </h5>
                        </div>
                        <div id="justificativa-id-<?=$id;?>" class="collapse" aria-labelledby="head-two-id-<?=$id;?>" data-parent="#accordion-proj-id-<?= $id;?>">
                            <div class="card-body"><?= $justificativa; ?></div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header" id="head-three-id-<?=$id;?>">
                            <h5 class="mb-0">
                                <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#atuacao-id-<?=$id;?>" aria-expanded="false" aria-controls="atuacao-id-<?=$id;?>">Atuação</button>
                            </h5>
                        </div>
                        <div id="atuacao-id-<?=$id;?>" class="collapse" aria-labelledby="head-three-id-<?=$id;?>" data-parent="#accordion-proj-id-<?= $id;?>">
                            <div class="card-body"><?= $atuacao; ?></div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header" id="head-four-id-<?=$id;?>">
                        <h5 class="mb-0">
                            <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#mais-info-id-<?=$id;?>" aria-expanded="false" aria-controls="mais-info-id-<?=$id;?>">Mais Informações</button>
                        </h5>
                        </div>
                        <div id="mais-info-id-<?=$id;?>" class="collapse" aria-labelledby="head-four-id-<?=$id;?>" data-parent="#accordion-proj-id-<?= $id;?>">
                            <div class="card-body"><?= $maisInformacao; ?></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12">
                <hr style="border: 3px solid rgba(65, 226, 156, 0.4);">
            </div>
        <?php endforeach; ?>
    </div>
</div>