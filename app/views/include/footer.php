<?php
use app\models\projetosModel;
$nmprojetos = new projetosModel();
$projetos = $nmprojetos->listarNomes();
$projetos = $projetos[0];
?>

<div class="bg-img-02">
    <div class="container-fluid">
        <div class="row">
            <div class="col col-md-4 pt-6">
                <h1 class="txt-c-01 font-01 text-right">Observatório da Educação Básica</h1>
                <h3 class="text-white font-01 text-right">em Mato Grosso na Pandemia</h3>
            </div>

            <div class="col col-md-2 pt-6 text-center">
                <h4 class="txt-c-03 font-01">Sobre o observatório</h4>
                <a class="font-01 text-white" href="<?= URL;?>#o-que-e">O que é</a><br>
                <a class="font-01 text-white" href="<?= URL;?>#missao">Missão</a><br>
                <a class="font-01 text-white" href="<?= URL;?>#visao">Visão</a><br>
                <a class="font-01 text-white" href="<?= URL;?>#valores">Valores</a><br>
                <a class="font-01 text-white" href="<?= URL;?>#equipe">Equipe</a><br>
                <a class="font-01 text-white" href="<?= URL;?>home/login">Área Restrita</a>
            </div>
            <div class="col col-md-3 pt-6 text-center">
                <h4 class="txt-c-03 font-01">O que fazemos</h4>
                    <?php foreach ($projetos as $key => $value) : ?>
                        <a class="font-01 text-white" href="<?= URL;?>projetos/index#projeto-<?= strtr($value['nome'], " ", "-");?>"><?= $value['nome'];?></a><br>
                    <?php endforeach; ?>
                   
            </div>
            <div class="col col-md-2 pt-6 text-center">
                <h4 class="font-01"><a class="txt-c-03" href="<?= URL;?>">Publicações</a></h4><br>
                <h4 class="font-01"><a class="txt-c-03" href="<?= URL;?>">Cursos e Eventos</a></h4><br>
            </div>
            <div class="col col-md-1 pt-6 text-center">
                <i class="fgs fgs-facebook fgs-2x btn-fgs"></i><br><br><br>
                <i class="fgs fgs-instagram fgs-2x btn-fgs"></i><br><br><br>
            </div>
        </div>
    </div>
</div>
    <script src="<?php echo URL;?>assets/js/jquery-3.5.1.js"></script>
    <script src="<?php echo URL;?>assets/js/bootstrap.js"></script>
    <script src="<?php echo URL;?>assets/js/scripts.js"></script>
</body>
</html>