<?php
/* @var $this MesaRedondaController */
/* @var $model MesaRedonda */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'id'); ?>
		<?php echo $form->textField($model,'id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'nome'); ?>
		<?php echo $form->textField($model,'nome'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'mediador'); ?>
		<?php echo $form->textField($model,'mediador'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'seminario_id'); ?>
		<?php echo $form->textField($model,'seminario_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'periodo'); ?>
		<?php echo $form->textField($model,'periodo'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->