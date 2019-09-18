<!--Generated using Gimme CRUD freeware from www.HandsOnCoding.net -->
<div class="wide form">

	<?php $form=$this->beginWidget('CActiveForm', array(
		'action'=>Yii::app()->createUrl($this->route),
		'method'=>'get',
	)); ?>

	<div class="row">
		<?php echo $form->label($model,'usuario_id'); ?>
		<?php echo $form->textField($model,'usuario_id'); ?>
	</div>
	<div class="row">
		<?php echo $form->label($model,'seminario_id'); ?>
		<?php echo $form->textField($model,'seminario_id'); ?>
	</div>
	<div class="row">
		<?php echo $form->label($model,'divulgacao'); ?>
		<?php echo $form->textField($model,'divulgacao'); ?>
	</div>
	<div class="row">
		<?php echo $form->label($model,'perfil'); ?>
		<?php echo $form->textField($model,'perfil'); ?>
	</div>
	<div class="row">
		<?php echo $form->label($model,'tipo_participacao'); ?>
		<?php echo $form->textField($model,'tipo_participacao'); ?>
	</div>
	<div class="row">
		<?php echo $form->label($model,'nome_social'); ?>
		<?php echo $form->textField($model,'nome_social'); ?>
	</div>
	<div class="row">
		<?php echo $form->label($model,'nome_completo'); ?>
		<?php echo $form->textField($model,'nome_completo'); ?>
	</div>
	<div class="row">
		<?php echo $form->label($model,'periodo_manha'); ?>
		<?php echo $form->textField($model,'periodo_manha'); ?>
	</div>
	<div class="row">
		<?php echo $form->label($model,'periodo_tarde'); ?>
		<?php echo $form->textField($model,'periodo_tarde'); ?>
	</div>
	<div class="row">
		<?php echo $form->label($model,'presenca_manha'); ?>
		<?php echo $form->textField($model,'presenca_manha'); ?>
	</div>
	<div class="row">
		<?php echo $form->label($model,'presenca_tarde'); ?>
		<?php echo $form->textField($model,'presenca_tarde'); ?>
	</div>
	<div class="row">
		<?php echo $form->label($model,'tel'); ?>
		<?php echo $form->textField($model,'tel'); ?>
	</div>
    	<div class="row">
		<?php echo $form->label($model,'tel_residencial'); ?>
		<?php echo $form->textField($model,'tel_residencial'); ?>
	</div>
	<div class="row">
		<?php echo $form->label($model,'instituicao_depto'); ?>
		<?php echo $form->textField($model,'instituicao_depto'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->
