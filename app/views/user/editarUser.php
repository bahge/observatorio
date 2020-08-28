<?php
if(isset($_SESSION['msg'])):
  echo alertJS($_SESSION['msg']);
  unset($_SESSION['msg']);
endif;
if (isset($this->dados[0])):
  $valorForm = $this->dados[0];
endif;
?>
<div class="container">
  <div class="row">
    <div class="col">
        <ul class="breadcrumb">
            <li><a href="<?php echo URL . 'homeController/adm';?>">System Manager</a></li>
            <li><a href="<?php echo URL . 'userController/index';?>">Gestão de Usuarios</a></li>
            <li>Editar usuário</li>
        </ul>
    </div>
    <div class="col">
      <form name="formEditUser" action="" method="post" id="formEditUser">
        <label for="nome" class="col-sm-2 col-form-label text-right">Nome</label>
        <input type="hidden" name="id" value="<?php echo ( isset($valorForm['id']) ? $valorForm['id']  : "");?>">
        <input type="text" class="form-control" id="nome" name="nome" value="<?php echo ( isset($valorForm['nome']) ? $valorForm['nome']  : "");?>">
        <label for="email" class="col-sm-2 col-form-label text-right">E-mail</label>
        <input type="email" class="form-control" id="email" name="email" value="<?php echo ( isset($valorForm['email']) ? $valorForm['email']  : "");?>">
        <label for="pass" class="col-sm-2 col-form-label text-right">Senha</label>
        <input type="password" class="form-control" id="pass" name="pass" placeholder="Só substitua a senha se deseja alterá-la">
        <label for="nivel" class="col-sm-2 col-form-label text-right">Nível</label>
        <select class="form-control" id="nivel" name="nivel">
          <option value=3 <?php echo ( isset($valorForm['nivel'])) && ( $valorForm['nivel'] == 3 )?'selected="selected"':''?>>Usuário</option>
          <option value=2 <?php echo ( isset($valorForm['nivel'])) && ( $valorForm['nivel'] == 2 )?'selected="selected"':''?>>Supervisor</option>
          <option value=1 <?php echo ( isset($valorForm['nivel'])) && ( $valorForm['nivel'] == 1 )?'selected="selected"':''?>>Coordenador</option>
          <option value=0 <?php echo ( isset($valorForm['nivel'])) && ( $valorForm['nivel'] == 0 )?'selected="selected"':''?>>Administrador</option>
        </select>
        <label for="status" class="col-sm-2 col-form-label text-right">Status</label>
        <select class="form-control" id="status" name="status">
          <option value=1 <?php echo ( isset($valorForm['status'])) && ( $valorForm['status'] == 1)?'selected="selected"':""?>>Ativo</option>
          <option value=0 <?php echo ( isset($valorForm['status'])) && ( $valorForm['status'] == 0)?'selected="selected"':""?>>Inativo</option>
        </select>
        <button class="btn btn-primary col-md-2 offset-md-8" type="submit" form="formEditUser" name="SendEditUser" value="SendEditUser"><i class="fgs fgs-save"></i></button>
      </form>
      </div>
  </div>
</div>