<?php
/* @var $this SiteController */
/* @var $model LoginForm */
/* @var $form CActiveForm  */

$this->pageTitle = Yii::app()->name . ' - Entrar';
//$this->breadcrumbs = array(
//    'Login',
//);
?>
<h1>Identificação</h1>

<div class="login-container left" >
    <h2>Já tenho cadastro</h2>
    <div class="form">
        <?php
        $form = $this->beginWidget('CActiveForm', array(
            'id' => 'login-form',
            'htmlOptions' => array(
                'class' => 'login-form-c',
            ),
            'enableClientValidation' => true,
            'clientOptions' => array(
                'validateOnSubmit' => true,
            ),
        ));
        ?>            
        <p>cpf</p>
        <div class="row">

            <?php //echo $form->labelEx($model, 'username'); ?>
            <?php echo $form->textField($model, 'username'); ?>
            <?php echo $form->error($model, 'username'); ?>
        </div>

        <p>senha</p>
        <div class="row">
            <?php //echo $form->labelEx($model, 'password'); ?>
            <?php echo $form->passwordField($model, 'password'); ?>
            <?php echo $form->error($model, 'password'); ?>

        </div>

        <a style="text-align: right; width: 90%; display: block" href="<?php echo $this->createUrl("site/forgot");?>">esqueci a senha</a>
        
        <div class="row ">
            <?php echo CHtml::submitButton('Entrar'); ?>
        </div>
    </div>

</div>

<div class="login-container right">
    <h2>Não tenho cadastro</h2>
    <h4>Criar cadastro</h4>
    <ul>
        <li>caso nunca tenha acessado o sistema</li>
        <li>salve seus dados para futuras inscrições</li>
    </ul>
    <div class="create-user-btn">
         <a href="index.php?r=usuario/create">Cadastre-se</a>
    </div>

<?php $this->endWidget(); ?>
</div><!-- form -->
