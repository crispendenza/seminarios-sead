<?php
/* @var $this PalestranteController */
/* @var $model Palestrante */
/* @var $form CActiveForm */
?>

<div class="form">

    <?php
    $form = $this->beginWidget('CActiveForm', array(
        'id' => 'palestrante-form',
        // Please note: When you enable ajax validation, make sure the corresponding
        // controller action is handling ajax validation correctly.
        // There is a call to performAjaxValidation() commented in generated controller code.
        // See class documentation of CActiveForm for details on this.
        'enableAjaxValidation' => false,
    ));
    ?>



    <?php echo $form->errorSummary($model); ?>

    <div class="row">
        <?php echo $form->labelEx($model, 'nome'); ?>
        <?php echo $form->textField($model, 'nome'); ?>
        <?php echo $form->error($model, 'nome'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'mesa_redonda_id'); ?>
        <?php echo $form->dropDownList($model, 'mesa_redonda_id', CHtml::listData(MesaRedonda::model()->findAll(), 'id', 'nome'), array('prompt' => 'Selecione...')); ?>

        <?php echo $form->error($model, 'mesa_redonda_id'); ?>
    </div>
    <p class="note">Campos <span class="required">*</span> são obrigatórios.</p><br>

    <div class="row buttons">
        <?php echo CHtml::submitButton($model->isNewRecord ? 'Criar' : 'Salvar'); ?>
    </div>

    <?php $this->endWidget(); ?>

</div><!-- form -->