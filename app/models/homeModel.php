<?php

namespace app\models;

use app\models\helpers\modelsRead;

class homeModel{
    private $userId;
    private $resultado;
    private $userLogin;
    private $userSenha;
    private $rowCount;
    const Entity = 'users';

    public function validar($userLogin, $userSenha) {
        $this->userLogin = (string) $userLogin;
        $this->userSenha = (string) sha1(md5($userSenha));
        $carregar = new modelsRead();
        $carregar->listar(self::Entity, 'WHERE email="'.$this->userLogin.'" AND pass="'.$this->userSenha.'"');
        $this->resultado = $carregar->getResultado();
        return $this->resultado;
    }

}