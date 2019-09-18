<?php

class UserLevel extends CWebUser {

    protected $_model;

    public function isInRole($nomeRegra) {
        $usuario = $this->loadUser();
        $nivelRegra = ManageLevel::getLevel($nomeRegra);
        if ($usuario && $nivelRegra)
            return $usuario->access_level == $nivelRegra;
        return false;
    }

    protected function loadUser() {
        if ($this->_model === null) {
            $this->_model = Usuario::model()->findByPk($this->id);
        }
        return $this->_model;
    }

    public function getFullName() {
        return $this->_model->primeiro_nome . ' ' . $this->_model->sobrenome;
    }

    public function getFullNameById($id) {
        $_model = Usuario::model()->findByPk($id);
        return $_model->primeiro_nome . ' ' . $_model->sobrenome;
    }



}
