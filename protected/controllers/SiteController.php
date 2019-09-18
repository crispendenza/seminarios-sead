<?php

class SiteController extends Controller {

    /**
     * Declares class-based actions.
     */
    public function actions() {
        return array(
            // captcha action renders the CAPTCHA image displayed on the contact page
            'captcha' => array(
                'class' => 'CCaptchaAction',
                'backColor' => 0xFFFFFF,
            ),
            // page action renders "static" pages stored under 'protected/views/site/pages'
            // They can be accessed via: index.php?r=site/page&view=FileName
            'page' => array(
                'class' => 'CViewAction',
            ),
        );
    }

    /**
     * This is the default 'index' action that is invoked
     * when an action is not explicitly requested by users.
     */
    public function actionIndex() {
        // renders the view file 'protected/views/site/index.php'
        // using the default layout 'protected/views/layouts/main.php'
        $this->render('index');
    }

    /* funcoes para recuperar password */

    public function getToken($token) {
        $model = Usuario::model()->findByAttributes(array('token' => $token));
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    public function actionVertoken($token) {
        $model = $this->getToken($token);
        if (isset($_POST['Ganti'])) {
            if ($model->token == $_POST['Ganti']['tokenhid']) {
                $model->senha = md5($_POST['Ganti']['password']);
                $model->token = "null";
                $model->save();
                Yii::app()->user->setFlash('ganti', '<b>Senha alterada com sucesso. Faça login :) </b>');
                $this->redirect('?r=site/login');
                $this->refresh();
            }
        }
        $this->render('verifikasi', array(
            'model' => $model,
        ));
    }

    public function actionForgot() {

        if (isset($_POST['Lupa'])) {
            $getEmail = $_POST['Lupa']['email'];
            if (!$getModel = Usuario::model()->findByAttributes(array('email' => $getEmail))) {
                Yii::app()->user->setFlash('forgot', 'Email inválido. Por favor, <a href="' . $this->createUrl("usuario/create") . '">cadastre-se</a>.');
                $this->refresh();
            }

            $getToken = rand(0, 99999);
            $getTime = date("H:i:s");
            $getModel->token = md5($getToken . $getTime);
            $remetente = "Seminários SEaD-UFSCar";
            $emailadmin = "seminarios@sead.ufscar.br";
            $assunto = "[Seminários SEaD-UFSCar] Alteração de Senha";
            $msgm = "Prezado(a),<br /><br />Você solicitou alteração de senha no sistema de inscrição dos Seminários SEaD.<br/><br/>
                    <a href='http://seminarios.sead.ufscar.br/index.php?r=site/vertoken/view&token=" . $getModel->token . "'>Clique aqui para resetar sua senha</a><br /><br />
		    Qualquer dúvida entre em contato através do e-mail: secretaria@sead.ufscar.br<br /><br />Atenciosamente,<br /><br />Secretaria Geral de Educação a Distância.";

            if ($getModel->validate()) {
                $name = '=?UTF-8?B?' . base64_encode($remetente) . '?=';
                $subject = '=?UTF-8?B?' . base64_encode($assunto) . '?=';
                $headers = "From: $name <{$emailadmin}>\r\n" .
                        "Reply-To: {$emailadmin}\r\n" .
                        "MIME-Version: 1.0\r\n" .
                        "Content-type: text/html; charset=UTF-8";
                $getModel->save();
                Yii::app()->user->setFlash('forgot', 'Foi enviado para seu e-mail uma requisição de alteração de senha :)');
                mail($getEmail, $subject, $msgm, $headers);
                $this->refresh();
            }
        }
        $this->render('forgot');
    }

    /**
     * This is the action to handle external exceptions.
     */
    public function actionError() {
        if ($error = Yii::app()->errorHandler->error) {
            if (Yii::app()->request->isAjaxRequest)
                echo $error['message'];
            else
                $this->render('error', $error);
        }
    }

    /**
     * Displays the contact page
     */
    public function actionContact() {
        $model = new ContactForm;
        if (isset($_POST['ContactForm'])) {
            $model->attributes = $_POST['ContactForm'];
            if ($model->validate()) {
                $name = '=?UTF-8?B?' . base64_encode($model->name) . '?=';
                $subject = '=?UTF-8?B?' . base64_encode($model->subject) . '?=';
                $headers = "From: $name <{$model->email}>\r\n" .
                        "Reply-To: {$model->email}\r\n" .
                        "MIME-Version: 1.0\r\n" .
                        "Content-Type: text/plain; charset=UTF-8";

                mail(Yii::app()->params['adminEmail'], $subject, $model->body, $headers);
                Yii::app()->user->setFlash('contact', 'Thank you for contacting us. We will respond to you as soon as possible.');
                $this->refresh();
            }
        }
        $this->render('contact', array('model' => $model));
    }

    /**
     * Displays the login page
     */
    public function actionLogin() {
        $model = new LoginForm;

        // if it is ajax validation request
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'login-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }

        // collect user input data
        if (isset($_POST['LoginForm'])) {
            $model->attributes = $_POST['LoginForm'];
            // validate user input and redirect to the previous page if valid
            if ($model->validate() && $model->login())
                $this->redirect(Yii::app()->user->returnUrl);
        }
        // display the login form
        $this->render('login', array('model' => $model));
    }

    /**
     * Logs out the current user and redirect to homepage.
     */
    public function actionLogout() {
        Yii::app()->user->logout();
        $this->redirect(Yii::app()->homeUrl);
    }

    /* retorna o período do curso na view index do site (home) */

    public function getPeriodoString($periodos) {

        if ($periodos['manha'] == 1) {
            if ($periodos['tarde'] == 1)
                return 'Manhã e tarde';
            return 'Manhã';
        }
        if ($periodos['tarde'] == 1)
            return 'Tarde';
        else
            return 'A definir';
    }
        
    /** 
     * return bool
     * true se passada a data do seminario, false caso contrario
     */
    public function inscricoesAbertas($id) {
        $data_seminario = strtotime(Seminario::model()->findByPk($id)->data);
        if (strtotime('today') > $data_seminario)        
            return false;
        else 
            return true;
    }

//    public function teste($id) {      
//        $data_seminario = Seminario::model()->findByPk($id)->data;
//        echo 'data modelo: ';
//        echo strtotime($data_seminario);
//        echo 'data atual: ';
//        return strtotime('today');
//        
//    }
}
