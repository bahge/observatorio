<?php
  if(isset($_SESSION['msg'])):
    echo alertJS($_SESSION['msg']);
    unset($_SESSION['msg']);
  endif;
?>

<div class="container pt-5 pb-5">
  <div class="row pt-5">
    <div class="col-12">
        <table class="table">
            <thead class="thead-light">
                <tr>
                    <th scope="col">id</th>
                    <th scope="col">Nome do Projeto</th>
                    <th scope="col">Ação</th>
                </tr>
            </thead>
            <tbody>
              <?php 
                $projetos = $this->dados['projetos'][0];
                foreach ($projetos as $projeto) :
                  extract($projeto);
              ?> 
                <tr>
                    <th scope="row"><?= $id; ?></th>
                    <td><?= $nome; ?></td>
                    <td>
                      <a href="<?= URL . 'projetos/editar/' . $id ?>" class="btn btn-warning" title="Editar projeto"><i class="fgs fgs-edit"></i></a>
                      <a href="<?= URL . 'projetos/apagar/' . $id ?>" class="btn btn-danger" title="Apagar projeto"><i class="fgs fgs-delete"></i></a>
                      <a href="<?= URL . 'projetos/visualizar/' . $id ?>" class="btn btn-info" title="Visualizar projeto"><i class="fgs fgs-lupa"></i></a>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
            </table>
    </div>
  </div>
</div>