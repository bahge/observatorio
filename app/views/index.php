<?php
  if(isset($_SESSION['msg'])):
    echo alertJS($_SESSION['msg']);
    unset($_SESSION['msg']);
  endif;
?>

<div class="bg-img-01">
    <div class="row">
        <div class="col bg-opacity-02">
            <div class="container h-100">
                <div class="row h-100 align-items-center">
                <div class="col-12 text-center">
                    <img src="<?= URL;?>assets/img/icon.svg" alt="Observatório da Educação Básica no Mato Grosso na Pandemia">
                </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="container py-3">
  <div class="row">
    <div id="o-que-e" class="col-12 text-justify pt-6">
      <h3 class="txt-c-02">O que é ?</h3>
      <p>É um macro projeto desenvolvido por professores e pesquisadores vinculados a UFMT, UNIC e redes públicas de educação básica que articula ações coordenadas de extensão e pesquisa com o objetivo de contribuir com a produção e disseminação do conhecimento sobre a educação básica na pandemia da Covid-19.</p>
    </div>
    <div class="col-12 col-md-6">
      <img src="<?= URL;?>assets/img/LogoRetrato.svg" class="img-fluid" alt="MIssão, Visão e Valores">
    </div>
    <div id="missao" class="col-12 col-md-6">
      <div class="bg-c-02-4 p-5">
        <h3 class="txt-c-02 pt-4">Missão</h3>
        <p class="text-justify">
        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam luctus nisi eros, sit amet venenatis justo tempor id. <br>
        Donec felis erat, aliquam dapibus eleifend ac, mattis a quam. Morbi interdum mi feugiat auctor aliquet. <br>
        Pellentesque porta condimentum leo. Nulla tincidunt orci id venenatis vulputate. <br>
        Morbi volutpat tincidunt sapien, vitae sodales est ultrices vel. Pellentesque lorem sapien, venenatis nec efficitur in, dignissim eget sem. <br>
        Sed pellentesque porta sapien nec fermentum. Vestibulum ultrices erat et sem imperdiet placerat. Morbi congue ligula quis erat scelerisque ultrices. <br>
        Phasellus ornare odio at nibh suscipit posuere eu vitae magna. Duis malesuada diam sed odio sagittis, eu. 
        </p>
      </div>
    </div>
    <div id="visao" class="col-12 col-md-6">
      <div class="bg-c-04-4 p-5 h-100">
        <h3 class="txt-c-03 pt-4">Visao</h3>
        <p class="text-justify">
          <ul>
          Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam luctus nisi eros, sit amet venenatis justo tempor id. <br>
          Donec felis erat, aliquam dapibus eleifend ac, mattis a quam. Morbi interdum mi feugiat auctor aliquet. <br>
          Pellentesque porta condimentum leo. Nulla tincidunt orci id venenatis vulputate. <br>
          Morbi volutpat tincidunt sapien, vitae sodales est ultrices vel. Pellentesque lorem sapien, venenatis nec efficitur in, dignissim eget sem. <br>
          Sed pellentesque porta sapien nec fermentum. Vestibulum ultrices erat et sem imperdiet placerat. Morbi congue ligula quis erat scelerisque ultrices. <br>
          Phasellus ornare odio at nibh suscipit posuere eu vitae magna. Duis malesuada diam sed odio sagittis, eu.
          </ul>
        </p>
      </div>     
    </div>
    <div id="valores" class="col-12 col-md-6">
      <div class="bg-c-03-4 p-5 h-100">
        <h3 class="txt-c-01 pt-4">Valores</h3>
        <p class="text-justify">
          <ul>
            <li>Lorem ipsum dolor sit amet, consectetur</li>
            <li>Aliquam porta sapien ut justo pulvinar, non condimentum nisi porttitor.</li>
            <li>Nullam bibendum risus eu dolor gravida</li>
            <li>Fusce dignissim mauris eu nisl ultricies, rhoncus dignissim erat sodales.</li>
            <li>Etiam eget est eget turpis scelerisque rutrum sit amet et est.</li>
            <li>Pellentesque lobortis urna sit amet metus tincidunt, quis tempus nulla mollis.</li>
            <li>In sollicitudin quam a velit imperdiet rutrum.</li>
            <li>Phasellus eget ligula in diam dictum malesuada a et urna.</li>
            <li>Aliquam porta sapien ut justo pulvinar</li>
            <li>Nullam bibendum risus eu dolor gravida</li>
          </ul>
        </p>
      </div>   
    </div>
  </div>
  <div class="row">
    <div id="equipe" class="col p-5">
      <h1 class="text-center">Equipe</h1>
      <div class="MultiCarousel" data-items="1,3,5,6" data-slide="1" id="MultiCarousel"  data-interval="1000">
            <div class="MultiCarousel-inner">
            <?php $equipe = $this->dados['equipe'][0];
                  foreach ($equipe as $colaborador) {
                    extract($colaborador);
            ?>
                <div class="item">
                  <div class="card border-0 bg-white">
                    <div class="img-equipe rounded" style="background-image: url('<?= URL; ?><?= ($foto != '---')? 'upload/' . $foto : 'assets/img/LogoRetrato.svg'; ?>');"></div>
                    <div class="card-body">
                      <h5 class="card-title text-left"><?= $nome ?></h5>
                    </div>
                    <div class="card-footer">
                      <?= ( $link != 'Sem Lattes' ) ? '<a href="'.$link.'" class="btn btn-primary">Lattes</a>' : '<p>Sem Lattes</p>'; ?>
                    </div>
                  </div>
                </div>                
                  <?php } ?>
            </div>
            <button class="btn btn-primary leftLst"><</button>
            <button class="btn btn-primary rightLst">></button>
        </div>
    </div>
  </div>
</div>
