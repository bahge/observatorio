<?php
  if(isset($_SESSION['msg'])):
    echo alertJS($_SESSION['msg']);
    unset($_SESSION['msg']);
  endif;
?>
<div class="container">
  <div class="row">
    <div class="col">
        <ul class="breadcrumb">
            <li><a href="<?php echo URL . 'homeController/adm';?>">System Manager</a></li>
            <li><a href="<?php echo URL . 'userController/index';?>">Gestão de Usuarios</a></li>
            <li>Novo usuário</li>
        </ul>
    </div>
    <div class="col">
      <form action="" method="post" id="formCadUser">
        <label for="nome" class="col-sm-2 col-form-label text-right">Nome</label>
        <input type="text" class="form-control" id="nome" name="nome" >
        
        <label for="email" class="col-sm-2 col-form-label text-right">E-mail</label>
        <input type="email" class="form-control" id="email" name="email">
        
        <label for="pass" class="col-sm-2 col-form-label text-right">Senha</label>
        <input type="password" class="form-control" id="pass" name="pass">
        
        <label for="nivel" class="col-sm-2 col-form-label text-right">Nível</label>
        <select class="form-control" id="nivel" name="nivel">
          <option value="3">Usuário</option>
          <option value="2">Supervisor</option>
          <option value="1">Coordenador</option>
          <option value="0">Administrador</option>
        </select>
        
        <label for="status" class="col-sm-2 col-form-label text-right">Status</label>
        <select class="form-control" id="status" name="status">
          <option value="1">Ativo</option>
          <option value="0">Inativo</option>
        </select>

        <button class="btn btn-primary" type="submit" form="formCadUser" value="SendCadUser" title="Cadastrar"><i class="fgs fgs-save"></i></button>
      </form>
    </div>
  </div>
</div>

