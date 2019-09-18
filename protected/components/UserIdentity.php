<?php

class UserIdentity extends CUserIdentity {

    private $_id, $_username;

    public function authenticate() {

        $record = Usuario::model()->findByAttributes(array('cpf' => $this->username));

        if ($record === null) {
            $this->errorCode = self::ERROR_USERNAME_INVALID;
        } elseif ($record->senha !== md5($this->password)) {
            $this->errorCode = self::ERROR_PASSWORD_INVALID;
        } else {
            $this->_id = $record->id;
            $this->username = $record->cpf;
            $this->setState('nome', $record->primeiro_nome);
            $this->errorCode = self::ERROR_NONE;
        }
        return !$this->errorCode;
    }

    public function getId() {
        return $this->_id;
    }

    
}
