<?php

/**
 * @abstract This Component Class is created to access TCPDF plugin for generating reports. * 
 * @todo you can extend tcpdf class method according to your need here. You can refer http://www.tcpdf.org/examples.php section for 
 *       More working examples.
 * @version 1.0.0
 */
Yii::import('ext.tcpdf.*');

class MYPDF extends TCPDF {
    /*
    public function Header() {
        // get the current page break margin
        $bMargin = $this->getBreakMargin();
        // get current auto-page-break mode
        $auto_page_break = $this->AutoPageBreak;
        // disable auto-page-break
        $this->SetAutoPageBreak(false, 0);
        // set bacground image
        $img_file = K_PATH_IMAGES.'frente-certificado.png';
        $this->Image($img_file, 0, 0, 297, 210, '', '', '', false, 300, '', false, false, 0);
        // restore auto-page-break status
        $this->SetAutoPageBreak($auto_page_break, $bMargin);
        // set the starting point for the page content
        $this->setPageMark();
    }
    */
}

?>