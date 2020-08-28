<?php $URL_ATUAL="$_SERVER[REQUEST_URI]"; ?>
<!-- Menu deslogado -->
<?php if (!isset($_SESSION['usuario']['id'])):?>
<nav class="navbar fixed-top navbar-expand-lg navbar-light bg-bd-c-01 txt-c-01 bg-white">
    <a class="navbar-brand" href="#">
        <img src="<?= URL; ?>assets/img/icon.svg" width="120" height="30" class="d-inline-block align-top" alt="">
    </a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Alterna navegação">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavDropdown">
        <ul class="navbar-nav">
        <li class="nav-item active">
            <a class="nav-link" href="<?= URL;?>">Página Inicial <span class="sr-only">(Página atual)</span></a>
        </li>
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="sobreMenu" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            Sobre o Observatório
            </a>
            <div class="dropdown-menu" aria-labelledby="sobreMenu">
            <a class="dropdown-item" href="<?= URL;?>#o-que-e">O que é</a>
            <a class="dropdown-item" href="<?= URL;?>#missao">Missão</a>
            <a class="dropdown-item" href="<?= URL;?>#visao">Visão</a>
            <a class="dropdown-item" href="<?= URL;?>#valores">Valores</a>
            <a class="dropdown-item" href="<?= URL;?>#equipe">Equipe</a>
            </div>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="<?= URL;?>projetos/index">O que fazemos</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#">Blog</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="<?= URL;?>home/publicacoes">Publicações</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="<?= URL;?>home/cursos">Cursos e eventos</a>
        </li>
        </ul>
    </div>
</nav>
<?php else:?>
<!-- Menu logado -->
<nav class="navbar fixed-top navbar-expand-lg navbar-light bg-bd-c-01 txt-c-01 bg-white">
    <a class="navbar-brand" href="#">
        <img src="<?= URL; ?>assets/img/icon.svg" width="120" height="30" class="d-inline-block align-top" alt="">
    </a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Alterna navegação">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavDropdown">
        <ul class="navbar-nav">
        <li class="nav-item active">
            <a class="nav-link" href="<?= URL;?>home/adm">Página Administrativa <span class="sr-only">(Página atual)</span></a>
        </li>
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="equipeMenu" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            Equipe
            </a>
            <div class="dropdown-menu" aria-labelledby="equipeMenu">
            <a class="dropdown-item" href="<?= URL;?>equipe/listar">Listar</a>
            <a class="dropdown-item" href="<?= URL;?>equipe/cadastrar">Cadastrar</a>
            </div>
        </li>
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="projetosMenu" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            Projetos
            </a>
            <div class="dropdown-menu" aria-labelledby="projetosMenu">
            <a class="dropdown-item" href="<?= URL;?>projetos/listar">Listar</a>
            <a class="dropdown-item" href="<?= URL;?>projetos/cadastrar">Cadastrar</a>
            <h6 class="dropdown-header">Visualizar</h6>
            <a class="dropdown-item" href="<?= URL;?>projetos/index">Página de Projetos</a>
            </div>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="<?= URL;?>galeria/index">Galeria</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="<?= URL;?>home/publicacoes">Publicações</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="<?= URL;?>home/cursos">Cursos e eventos</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="<?= URL;?>home/deslogar">Sair</a>
        </li>
        </ul>
    </div>
</nav>
<?php endif; ?>