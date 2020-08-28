<?php
if(isset($_SESSION['msg'])):
  echo alertJS($_SESSION['msg']);
  unset($_SESSION['msg']);
endif;
?>

<div class="container pt-5">
    <div class="row">
        <div class="col">
            <ul class="breadcrumb">
                <li><a href="<?php echo URL . 'home/adm';?>">System Manager</a></li>
                <li>Configurações</li>
            </ul>
        </div>
        <div class="col">
          <form action="" method="post" id="formEditCFG">
            <label for="nome">Nome</label>
            <input type="text" name="nome" id="nome" placeholder="Nome da Aplicação" value="<?= $this->dados['nome'];?>">

            <label for="celular">Celular</label>
            <input type="text" name="celular" id="celular" placeholder="Celular do responsável" value="<?= $this->dados['celular'];?>">

            <label for="endereco">Logradouro</label>
            <input type="text" name="endereco" id="endereco" placeholder="Nome da avenida ou rua" value="<?= $this->dados['endereco'];?>">

            <label for="cidade">Cidade</label>
            <input type="text" name="cidade" id="cidade" placeholder="Digite o nome da cidade" value="<?= $this->dados['cidade'];?>">

            <label for="estado">Estado</label>
            <input type="text" name="estado" id="estado" placeholder="Digite o nome ou a sigla do estado" value="<?= $this->dados['estado'];?>">

            <label for="CEP">CEP</label>
            <input type="text" name="CEP" id="CEP" placeholder="XX.XXX-XXX" value="<?= $this->dados['CEP'];?>">

            <label for="email">E-mail</label>
            <input type="text" name="email" id="email" placeholder="Digite o e-mail de contato do site" value="<?= $this->dados['email'];?>">

            <button class="btn btn-primary"type="submit" id='sendForm' form="formEditCFG" title="Salvar"><i class="fgs fgs-save"></i> Salvar</button>
          </form>
        </div>
    </div>
</div>