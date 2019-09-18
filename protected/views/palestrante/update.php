<?php
/* @var $this PalestranteController */
/* @var $model Palestrante */

$this->breadcrumbs=array(
	'Palestrantes'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Atualizar',
);

$this->menu=array(
	array('label'=>'List Palestrante', 'url'=>array('index')),
	array('label'=>'Create Palestrante', 'url'=>array('create')),
	array('label'=>'View Palestrante', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Palestrante', 'url'=>array('admin')),
);
?>

<h1>Atualizar Palestrante <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>