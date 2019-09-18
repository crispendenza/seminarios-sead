<?php
/* @var $this MesaRedondaController */
/* @var $model MesaRedonda */
/* @var $form CActiveForm */
?>

<div class="form">

    <?php
    $form = $this->beginWidget('CActiveForm', array(
        'id' => 'mesa-redonda-form',
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
        <?php echo $form->labelEx($model, 'mediador'); ?>
        <?php echo $form->textField($model, 'mediador'); ?>
        <?php echo $form->error($model, 'mediador'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'seminario_id'); ?>
        <?php echo $form->dropDownList($model, 'seminario_id', CHtml::listData(Seminario::model()->findAll(), 'id', 'nome'), array('prompt' => 'Selecione...')); ?>
        <?php echo $form->error($model, 'seminario_id'); ?>
    </div>

    <div class="row">
        <?php $periodo_rbl = array('1' => 'Manhã', '2' => 'Tarde', '3' => 'Manhã e tarde'); ?>
        <?php echo $form->labelEx($model, 'periodo'); ?>
        <div style="padding:10px 0px"><?php echo $form->radioButtonList($model, 'periodo', $periodo_rbl); ?></div>   
        <?php echo $form->error($model, 'periodo'); ?>

    </div>
    <p class="note">Campos com <span class="required">*</span> são obrigatórios.</p>
    <br>

    <div class="row buttons">
        <?php echo CHtml::submitButton($model->isNewRecord ? 'Criar' : 'Salvar'); ?>
    </div>

    <?php $this->endWidget(); ?>

</div><!-- form -->