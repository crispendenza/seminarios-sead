<?php
/* @var $this SeminarioController */
/* @var $model Seminario */

$this->breadcrumbs=array(
	'Seminários'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Atualizar',
);

$this->menu=array(
	array('label'=>'List Seminario', 'url'=>array('index')),
	array('label'=>'Create Seminario', 'url'=>array('create')),
	array('label'=>'View Seminario', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Seminario', 'url'=>array('admin')),
);
?>

<h1>Atualizar Seminário <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>