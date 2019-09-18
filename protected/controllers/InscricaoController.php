<?php

class InscricaoController extends Controller {

    public $layout = '//layouts/column1';

    public function filters() {
        return array(
            'accessControl', // perform access control for CRUD operations
            'postOnly + delete', // we only allow deletion via POST request
        );
    }

    public function accessRules() {
        return array(
            array('allow',
                'actions' => array('create', 'index', 'view', 'update', 'viewSuccess', 'admin', 'delete', 'presenca', 'atualizaPresenca', 'certificado', 'gerarCertificado'),
                'users' => array(Yii::app()->user->name),
                'expression' => "Yii::app()->user->isInRole('ADMIN')",
            ),
            array('allow',
                'actions' => array('create', 'index', 'view', 'viewSuccess', 'certificado', 'gerarCertificado'),
                'users' => array(Yii::app()->user->name),
                'expression' => "Yii::app()->user->isInRole('COMUM')",
            ),
//            array('allow', // allow admin user to perform 'admin' and 'delete' actions
//                'actions' => array('admin', 'delete'),
//                'users' => array(Yii::app()->user->name),
//                'expression' => "Yii::app()->user->isInRole('ADMIN')",
//            ),
            array('deny', // deny all users
                'users' => array('*'),
            ),
        );
    }

    public function actionIndex() {
        if (Yii::app()->user->isInRole('ADMIN'))
            $dataProvider = new CActiveDataProvider('Inscricao');
        else {
            $dataProvider = new CActiveDataProvider('Inscricao', array(
                'criteria' => array(
                    //::text força o id se tornar String por causa do Postgres
                    'condition' => 'usuario_id=' . Yii::app()->user->id . '::text'
                ),
                'pagination' => array(
                    'pageSize' => 10,
                ),
            ));
        }

        $this->render('index', array(
            'dataProvider' => $dataProvider,
        ));
    }

    public function actionCreate() {
        $model = new Inscricao;

        if (isset($_POST['ajax']) && $_POST['ajax'] === 'client-account-create-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }

        if (isset($_POST['Inscricao'])) {
            $model->attributes = $_POST['Inscricao'];

            if ($model->validate()) {

                $this->saveModel($model);
                //$this->redirect(array('view', 'usuario_id' => $model->usuario_id, 'seminario_id' => $model->seminario_id));
                $this->redirect(array('viewSuccess', 'usuario_id' => $model->usuario_id, 'seminario_id' => $model->seminario_id));
            }
        }
        $this->render('create', array('model' => $model));
    }

    public function actionDelete($usuario_id, $seminario_id) {
        if (Yii::app()->request->isPostRequest) {
            try {
                // we only allow deletion via POST request
                $this->loadModel($usuario_id, $seminario_id)->delete();
            } catch (Exception $e) {
                $this->showError($e);
            }

            // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
            if (!isset($_GET['ajax']))
                $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('index'));
        } else
            throw new CHttpException(400, 'Invalid request. Please do not repeat this request again.');
    }

    public function actionPresenca() {
        $model = new Inscricao('search');
        $model->unsetAttributes();  // clear any default values
        if (isset($_GET['Inscricao']))
            $model->attributes = $_GET['Inscricao'];
        $this->render('presenca', array(
            'model' => $model,
        ));
    }

    public function actionCertificado() {
        $dataProvider = new CActiveDataProvider('Inscricao', array(
            'criteria' => array(
                //::text força o id se tornar String por causa do Postgres
                'condition' => 'usuario_id=' . Yii::app()->user->id . '::text'
            ),
            'pagination' => false
        ));

        $this->render('certificado', array(
            'dataProvider' => $dataProvider,
        ));
    }

    public function actionGerarCertificado($seminario_id) {
        // load model
        $model = $this->loadModel(Yii::app()->user->id, $seminario_id);
        // nome do seminario
        $nome_seminario = Seminario::model()->getFullNameById($model->seminario_id);

        //array com os objetos mesas redondas via findall()
        $mesas_redondas = MesaRedonda::model()->findAll(
                array("condition" => 'seminario_id=' . $seminario_id . '::text', "order" => "id"));




        $pdf = new MYPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
        spl_autoload_register(array('YiiBase', 'autoload'));

        // create new PDF document
        $pdf = new MYPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

        // set document information
        $pdf->SetCreator(PDF_CREATOR);
        $pdf->SetAuthor('SEaD');
        $pdf->SetTitle('Certificado Seminários 2017');
        $pdf->SetSubject('Certificado');
        $pdf->SetKeywords('Seminários, SEaD, Certificado');

        // set header and footer fonts
        $pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));

        // set default monospaced font
        $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

        // set margins
        $pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
        $pdf->SetHeaderMargin(0);
        $pdf->SetFooterMargin(0);

        // remove default footer
        $pdf->setPrintFooter(false);

        // set auto page breaks
        $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

        // set image scale factor
        $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

        // set some language-dependent strings (optional)
        if (@file_exists(dirname(__FILE__) . '/lang/eng.php')) {
            require_once(dirname(__FILE__) . '/lang/eng.php');
            $pdf->setLanguageArray($l);
        }

        // ---------------------------------------------------------
        // set font
        $pdf->SetFont('roboto', '', 15);
        // set text color
        $pdf->SetTextColor(255, 255, 255);


        // --- background set on page ---
        // remove default header
        $pdf->setPrintHeader(false);

        // ---------- PAG 1 - FRENTE -------------
        $pdf->AddPage();
        // -- set new background ---
        // get the current page break margin
        $bMargin = $pdf->getBreakMargin();
        // get current auto-page-break mode
        $auto_page_break = $pdf->getAutoPageBreak();
        // disable auto-page-break
        $pdf->SetAutoPageBreak(false, 0);
        // set background image
        $img_file = K_PATH_IMAGES . 'frente-seminario-id-' . $model->seminario_id . '.png';
        //Image( $file, $x = '', $y = '', $w = 0, $h = 0, $type = '', $link = '', $align = '', $resize = false, $dpi = 300, $palign = '', $ismask = false, $imgmask = false, $border = 0, $fitbox
        if (file_exists('images/frente-seminario-id-' . $model->seminario_id . '.png')) {
            $pdf->Image($img_file, 0, 0, 297, 210, '', '', '', false, 300, '', false, false, 0);
        } else {
            $img_n_disp = K_PATH_IMAGES . 'img-n-disp.png';
            $pdf->Image($img_n_disp, 0, 0, 297, 210, '', '', '', false, 300, '', false, false, 0);
        }
        // restore auto-page-break status
        $pdf->SetAutoPageBreak($auto_page_break, $bMargin);
        // set the starting point for the page content
        $pdf->setPageMark();
        // set cell padding
        $pdf->setCellPaddings(1, 1, 1, 1);
        // set cell margins
        $pdf->setCellMargins(1, 1, 1, 1);



        // texto principal
        $txt = '<span style="line-height:35px">Certificamos que <b>' . $model->nome_completo . '</b> participou da edicão <b>' . $nome_seminario . '</b> dos Seminários SEaD no período da <b>' . $this->getPresencaString(
                        array('manha' => $model->presenca_manha, 'tarde' => $model->presenca_tarde)) . '</b> promovido pela Secretaria Geral de Educação a Distância da Universidade Federal de São Carlos, na data de ' . Seminario::model()->getDateString($model->seminario_id) . ".</span>";
        // MultiCell($w, $h, $txt, $border=0, $align='J', $fill=0, $ln=1, $x='', $y='', $reseth=true, $stretch=0, $ishtml=false, $autopadding=true, $maxh=0)
        $pdf->MultiCell(220, '', $txt, 0, 'J', 0, 0, '37', '60', true, 0, true, true, 40, 'M');

        // data e cidade        
        setlocale(LC_TIME, 'pt_BR', 'pt_BR.utf-8', 'pt_BR.utf-8', 'portuguese');
        date_default_timezone_set('America/Sao_Paulo');
        $txt = '<span style="line-height:20px;">São Carlos, ' . strftime('%d de %B de %Y', strtotime('today')) . '.</span>';
        $pdf->MultiCell('', '', $txt, 0, 'C', 0, 0, '142', '110', true, 0, true, true, 40, 'M');

        // Assinatura 
        $pdf->SetFont('roboto', '', 10);
        $txt = '<span style="line-height:20px;">Profa. Dra. Marilde Terezinha Prado Santos<br>Secretária Geral de Educação a Distância SEaD-UFSCar</span>';
        $pdf->MultiCell('', '', $txt, 0, 'C', 0, 0, '145', '145', true, 0, true, true, 40, 'M');


        // ---------- PAG 2 - VERSO -------------
        $pdf->AddPage();
        // -- set new background ---
        // get the current page break margin
        $bMargin = $pdf->getBreakMargin();
        // get current auto-page-break mode
        $auto_page_break = $pdf->getAutoPageBreak();
        // disable auto-page-break
        $pdf->SetAutoPageBreak(false, 0);
        // set background image
        $img_file = K_PATH_IMAGES . 'verso-seminario-id-' . $model->seminario_id . '.png';
        //Image( $file, $x = '', $y = '', $w = 0, $h = 0, $type = '', $link = '', $align = '', $resize = false, $dpi = 300, $palign = '', $ismask = false, $imgmask = false, $border = 0, $fitbox
        if (file_exists('images/verso-seminario-id-' . $model->seminario_id . '.png')) {
            $pdf->Image($img_file, 0, 0, 297, 210, '', '', '', false, 300, '', false, false, 0);
        } else {
            $img_n_disp = K_PATH_IMAGES . 'img-n-disp.png';
            $pdf->Image($img_n_disp, 0, 0, 297, 210, '', '', '', false, 300, '', false, false, 0);
        }
        // restore auto-page-break status
        $pdf->SetAutoPageBreak($auto_page_break, $bMargin);
        // set the starting point for the page content
        $pdf->setPageMark();

        
        /* Conta o numero de palestrantes e de mesas redondas de acordo com o id do seminario
         * Obs: Caso não passe para o array dentro de count() o parametro 'alias' (que apelida a tabela que é chamada)
         *      o yii assume que 't' é o alias da tabela, no caso Palestrante:: e MesaRedonda:: 
         *      Join faz uniao com essa tabela 't'
         */
        $nro_palestrantes = Palestrante::model()->count(array('join' => 'LEFT JOIN mesa_redonda AS mr ON mr.id = t.mesa_redonda_id LEFT JOIN seminario AS s ON mr.seminario_id = s.id', 'condition' => "s.id=" . $model->seminario_id . '::text'));
        $nro_mesas = MesaRedonda::model()->count(array('join' => 'LEFT JOIN seminario AS s ON t.seminario_id = s.id', 'condition' => "s.id=" . $model->seminario_id . '::text'));

        
        /* Ajusta o tamanho da fonte ttf de acordo com o numero de mesas redondas 
         * @TODO não está pronto, projeto para a próxima versão           
         */
        if ($nro_mesas <= 1) {
            $font_size_title = 14;
            $font_size_body = 12;
            $indent_01 = 55;  
        }
        else if ($nro_mesas <= 2) {
            $font_size_title = 14;
            $font_size_body = 12;
            $indent_01 = 55;  
        }
       
        
        /* Ajusta o line height de acordo com o numero de participantes  */
        switch (true) {
            case $nro_palestrantes <= 6:
                $pdf->setCellHeightRatio(1.6);
                break;
            case $nro_palestrantes <= 7:
                $pdf->setCellHeightRatio(1.4);
                break;
            case $nro_palestrantes <= 8:
                $pdf->setCellHeightRatio(1.2);
                break;
            case $nro_palestrantes <= 9:
                $pdf->setCellHeightRatio(1.0);
                break;
            case $nro_palestrantes <= 10:
                $pdf->setCellHeightRatio(0.9);
                break;
            case $nro_palestrantes <= 11:
                $pdf->setCellHeightRatio(0.7);
                break;
            default:
                //acima de  11 participantes (mais que isso quebra a página, é preciso modificar)
                $pdf->setCellHeightRatio(0.5);
                break;
        }
        
        // set font
        $pdf->SetFont('roboto', '', 15);
        //cabeçalho
        $txt = '<span style="line-height:27px;"><b>Universidade Federal de São Carlos<br>Secretaria Geral de Educação a Distância</b><br>Seminários SEaD: ' . $nome_seminario . '</span>';
        $pdf->MultiCell('', '', $txt, 0, 'C', 0, 1, '30', '16', true, 0, true, true, 40, 'M');
        // set font
        $pdf->SetFont('roboto', '', $font_size_title);
        // Titulo "programação"
        $txt = '<span style="line-height:27px;">Programação:</span>';
        $pdf->MultiCell('', '', $txt, 0, 'L', 0, 1, '15', '50', true, 0, true, true, 40, 'M');
        // preenche o principal do verso do certificado: participantes, mediadores e nome das mesas redondas
        foreach ($mesas_redondas as $key => $mr) {
            $pdf->SetFont('roboto', '', $font_size_title);
            $pdf->MultiCell('', '', '<b>Mesa Redonda ' . ($key + 1) . ': </b>', 0, 'L', 0, 0, '15', '', true, '', true);
            $pdf->SetFont('robotobi', '', $font_size_title);
            $pdf->MultiCell('', '', $mr->nome, 0, 'L', 0, 1, $indent_01, '', true, '', true);
            $pdf->SetFont('roboto', '', $font_size_body);
            $pdf->MultiCell('', '', 'Participantes: ', 0, 'L', 0, 1, '25', '', true, '', true);
            //array com os objetos palestrantes via findall()
            $palestrantes = Palestrante::model()->findAll(
                    array("condition" => 'mesa_redonda_id=' . $mesas_redondas[$key]->id . '::text', "order" => "nome"));
            foreach ($palestrantes as $palestrante) {
                $pdf->MultiCell('', '', '<span style="line-height: 12px;">' . $palestrante->nome . '</span>', 0, 'L', 0, 1, '35', '', true, '', true);
            }
            $pdf->MultiCell('', '', 'Mediador: ' . $mr->mediador, 0, 'L', 0, 1, '25', '', true, '', true);
        }

        // ---------------------------------------------------------
        // Close and output PDF document
        // This method has several options, check the source code documentation for more information.
        $pdf->Output('certificado-seminario.pdf', 'I');
        Yii::app()->end();
    }

    public function getPresencaString($presenca) {

        if ($presenca['manha'] == 1) {
            if ($presenca['tarde'] == 1)
                return 'manhã e tarde';
            return 'manhã';
        }
        if ($presenca['tarde'] == 1)
            return 'tarde';
        else
            return 'A definir';
    }

    public function actionAtualizaPresenca($usuario_id, $seminario_id, $periodo) {

        if ($periodo == 'manha') {
            if ($this->loadModel($usuario_id, $seminario_id)->presenca_manha == 0) {
                try {
                    Inscricao::model()->updateByPk(array('usuario_id' => $usuario_id, 'seminario_id' => $seminario_id), array(
                        'presenca_manha' => 1
                    ));
                } catch (Exception $e) {
                    $this->showError($e);
                }
            } else {
                try {
                    Inscricao::model()->updateByPk(array('usuario_id' => $usuario_id, 'seminario_id' => $seminario_id), array(
                        'presenca_manha' => 0
                    ));
                } catch (Exception $e) {
                    $this->showError($e);
                }
            }
        } else if ($periodo == 'tarde') {
            if ($this->loadModel($usuario_id, $seminario_id)->presenca_tarde == 0) {
                try {
                    Inscricao::model()->updateByPk(array('usuario_id' => $usuario_id, 'seminario_id' => $seminario_id), array(
                        'presenca_tarde' => 1
                    ));
                } catch (Exception $e) {
                    $this->showError($e);
                }
            } else {
                try {
                    Inscricao::model()->updateByPk(array('usuario_id' => $usuario_id, 'seminario_id' => $seminario_id), array(
                        'presenca_tarde' => 0
                    ));
                } catch (Exception $e) {
                    $this->showError($e);
                }
            }
        }

        if (!isset($_GET['ajax']))
            $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('presenca'));

        $this->redirect(array('presenca'));
    }

    public function actionUpdate($usuario_id, $seminario_id) {
        $model = $this->loadModel($usuario_id, $seminario_id);

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['Inscricao'])) {
            $model->attributes = $_POST['Inscricao'];
            if ($model->save())
                $this->redirect(array('index',
                    'usuario_id' => $model->usuario_id, 'seminario_id' => $model->seminario_id));
            //$this->redirect(array('index'));
        }

        $this->render('update', array(
            'model' => $model,
        ));
    }

    public function actionAdmin() {
        $model = new Inscricao('search');
        $model->unsetAttributes();  // clear any default values
        if (isset($_GET['Inscricao']))
            $model->attributes = $_GET['Inscricao'];

        $this->render('admin', array(
            'model' => $model,
        ));
    }

    public function actionView($usuario_id, $seminario_id) {
        $model = $this->loadModel($usuario_id, $seminario_id);
        $this->render('view', array('model' => $model));
    }

    public function actionViewSuccess($usuario_id, $seminario_id) {
        $model = $this->loadModel($usuario_id, $seminario_id);
        $this->render('view_success', array('model' => $model));
    }

    public function loadModel($usuario_id, $seminario_id) {
        $model = Inscricao::model()->findByPk(array('usuario_id' => $usuario_id, 'seminario_id' => $seminario_id));
        if ($model == null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    public function saveModel($model) {
        try {
            $model->save();
        } catch (Exception $e) {
            $this->showError($e);
        }
    }

    function showError(Exception $e) {
        if ($e->getCode() == 23000)
            $message = "This operation is not permitted due to an existing foreign key reference.";
        else
            $message = "Invalid operation.";
        throw new CHttpException($e->getCode(), $message);
    }

}
