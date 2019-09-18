<?php
/* @var $this MesaRedondaController */
/* @var $data MesaRedonda */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('nome')); ?>:</b>
	<?php echo CHtml::encode($data->nome); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('mediador')); ?>:</b>
	<?php echo CHtml::encode($data->mediador); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('seminario_id')); ?>:</b>
	<?php echo CHtml::encode($data->seminario_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('periodo')); ?>:</b>
	<?php echo CHtml::encode(MesaRedonda::model()->getPeriodoStringById($data->periodo)) ?>
	<br />


</div>