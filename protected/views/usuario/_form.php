<?php
/* @var $this UsuarioController */
/* @var $model Usuario */
/* @var $form CActiveForm */
?>



<div class="form">

    <?php
    $form = $this->beginWidget('CActiveForm', array(
        'id' => 'usuario-form',
        'htmlOptions' => array(
            'class' => 'user-form-c',
        ),
        // Please note: When you enable ajax validation, make sure the corresponding
        // controller action is handling ajax validation correctly.
        // There is a call to performAjaxValidation() commented in generated controller code.
        // See class documentation of CActiveForm for details on this.
        'enableAjaxValidation' => false,
    ));
    ?>



    <?php echo $form->errorSummary($model); ?>

    <div class="row">
        <?php echo $form->labelEx($model, 'cpf'); ?>
        <?php
        $this->widget("ext.maskedInput.MaskedInput", array(
            "model" => $model,
            "attribute" => "cpf",
            "mask" => '999.999.999-99',
            "clientOptions" => array("autoUnmask" => true), /* autoUnmask defaults to false */
            "defaults" => array("removeMaskOnSubmit" => true),
                /* once defaults are set will be applied to all the masked fields  removeMaskOnSubmit defaults to true */
        ));
        ?>
        <?php /*  echo $form->textField($model, 'cpf', array('size' => 11, 'maxlength' => 11)); */ ?>
        <?php echo $form->error($model, 'cpf'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'email'); ?>
        <?php
        $this->widget("ext.maskedInput.MaskedInput", array(
            "model" => $model,
            "attribute" => "email",
            "clientOptions" => array("alias" => "email"),
            "defaults" => array("removeMaskOnSubmit" => false),
        ));
        ?>
        <?php echo $form->error($model, 'email'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'primeiro_nome'); ?>
        <?php echo $form->textField($model, 'primeiro_nome'); ?>
        <?php echo $form->error($model, 'primeiro_nome'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'sobrenome'); ?>
        <?php echo $form->textField($model, 'sobrenome'); ?>
        <?php echo $form->error($model, 'sobrenome'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'senha'); ?>
        <?php echo $form->passwordField($model, 'senha', array('size' => 34, 'maxlength' => 34)); ?>
        <?php echo $form->error($model, 'senha'); ?>
    </div>
        
    <?php echo $form->hiddenField($model, 'token', array('value' => 'a73hr74hs6hr')); ?>

    <?php if (Yii::app()->user->isInRole('ADMIN')): ?>
    <div class="row">
        <?php $accesslvl_rbl = array('1' => 'Comum', '2' => 'Admin'); ?>
        <p><?php echo $form->labelEx($model, 'access_level'); ?></p>
        <div style="padding:10px 0px"><?php echo $form->radioButtonList($model, 'access_level', $accesslvl_rbl); ?> </div>
        <?php echo $form->error($model, 'access_level'); ?>
    </div>
    <?php endif; ?>
    
    <p class="note">Campos com <span class="required">*</span> são obrigatórios.</p><br><br>

    <div class="row buttons">
        <?php echo CHtml::submitButton($model->isNewRecord ? 'Cadastrar' : 'Salvar'); ?>
    </div>


    <?php $this->endWidget(); ?>

</div><!-- form -->