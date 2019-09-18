<?php
/* @var $this PalestranteController */
/* @var $model Palestrante */

$this->breadcrumbs=array(
	'Palestrantes'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List Palestrante', 'url'=>array('index')),
	array('label'=>'Create Palestrante', 'url'=>array('create')),
	array('label'=>'Update Palestrante', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Palestrante', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Palestrante', 'url'=>array('admin')),
);
?>

<h1>Palestrante #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'nome',
		'mesa_redonda_id',
	),
)); ?>
