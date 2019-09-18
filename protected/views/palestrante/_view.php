<?php
/* @var $this PalestranteController */
/* @var $data Palestrante */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('nome')); ?>:</b>
	<?php echo CHtml::encode($data->nome); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('mesa_redonda_id')); ?>:</b>
	<?php echo CHtml::encode($data->mesa_redonda_id); ?>
	<br />


</div>