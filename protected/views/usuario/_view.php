<?php
/* @var $this UsuarioController */
/* @var $data Usuario */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('cpf')); ?>:</b>
	<?php echo CHtml::encode($data->cpf); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('primeiro_nome')); ?>:</b>
	<?php echo CHtml::encode($data->primeiro_nome); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('sobrenome')); ?>:</b>
	<?php echo CHtml::encode($data->sobrenome); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('email')); ?>:</b>
	<?php echo CHtml::encode($data->email); ?>
	<br />

	<b><?php //echo CHtml::encode($data->getAttributeLabel('senha')); ?></b>
	<?php //echo CHtml::encode($data->senha); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('access_level')); ?>:</b>
	<?php echo CHtml::encode($data->access_level); ?>
	<br />


</div>