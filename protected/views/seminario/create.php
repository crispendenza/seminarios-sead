<?php
/* @var $this SeminarioController */
/* @var $model Seminario */

$this->breadcrumbs=array(
	'Seminários'=>array('index'),
	'Novo',
);

$this->menu=array(
	array('label'=>'List Seminario', 'url'=>array('index')),
	array('label'=>'Manage Seminario', 'url'=>array('admin')),
);
?>

<h1>Novo Seminário</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>