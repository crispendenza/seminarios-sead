<?php
/* @var $this SeminarioController */
/* @var $model Seminario */
/* @var $form CActiveForm */
?>

<div class="form">

    <?php
    $form = $this->beginWidget('CActiveForm', array(
        'id' => 'seminario-form',
        // Please note: When you enable ajax validation, make sure the corresponding
        // controller action is handling ajax validation correctly.
        // There is a call to performAjaxValidation() commented in generated controller code.
        // See class documentation of CActiveForm for details on this.
        'enableAjaxValidation' => false,
    ));
    ?>

    <p class="note">Fields with <span class="required">*</span> are required.</p>

    <?php echo $form->errorSummary($model); ?>

    <div class="row">
        <?php echo $form->labelEx($model, 'nome'); ?>
        <?php echo $form->textField($model, 'nome'); ?>
        <?php echo $form->error($model, 'nome'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'data'); ?>
        <?php

        $this->widget('zii.widgets.jui.CJuiDatePicker', array(
            'model' => $model,
            'attribute' => 'data',
 
            'name' => 'data',
            // additional javascript options for the date picker plugin
            'options' => array(
                'showAnim' => 'drop',
                'dateFormat' => 'dd-mm-yy',
            ),
            'htmlOptions' => array(
                'class' => ''
            ),
        ));
        ?>
        <?php echo $form->error($model, 'data'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'periodo_manha'); ?>
        <?php echo $form->checkBox($model, 'periodo_manha'); ?>
        <?php echo $form->error($model, 'periodo_manha'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'periodo_tarde'); ?>
        <?php echo $form->checkBox($model, 'periodo_tarde'); ?>
        <?php echo $form->error($model, 'periodo_tarde'); ?>
    </div>

    <div class="row buttons">
        <?php echo CHtml::submitButton($model->isNewRecord ? 'Criar' : 'Salvar'); ?>
    </div>

    <?php $this->endWidget(); ?>

</div><!-- form -->