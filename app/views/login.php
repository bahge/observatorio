<?php
  if(isset($_SESSION['msg'])):
    echo alertJS($_SESSION['msg']);
    unset($_SESSION['msg']);
  endif;
?>

<div class="container pt-5">
    <div class="row pt-5 justify-content-center">
        <div class="col-4 p-5">
        <img src="<?= URL;?>assets/img/icon.svg" alt="Logo Observatório" class="img-fluid"><br>
        <h3 class="text-center p-2">Área restrita</h3>
        <form method="post" class="border border-info p-2 rounded">
            <div class="form-group">
                <label for="login">Endereço de email</label>
                <input type="email" class="form-control" name="login" id="login" aria-describedby="emailHelp" placeholder="Seu email">
                <small id="emailHelp" class="form-text text-muted">E-mail cadastrado de login.</small>
            </div>
            <div class="form-group">
                <label for="pass">Senha</label>
                <input type="password" class="form-control" name="pass" id="pass" placeholder="Senha">
            </div>
            <button type="submit" class="btn btn-primary">Entrar</button>
        </form>
        </div>
    </div>
</div>
