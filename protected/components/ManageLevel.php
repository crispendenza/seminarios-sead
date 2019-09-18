<?php

class ManageLevel {

    const COMUM = 1;
    const ADMIN = 2;
    
    private $niveisUsuario;

    public static function getLevel($nivelUsuario) {
        $niveisUsuario['COMUM'] = 1;
        $niveisUsuario['ADMIN'] = 2;        
        return isset($niveisUsuario[$nivelUsuario]) ? $niveisUsuario[$nivelUsuario] : null;
    }

}
