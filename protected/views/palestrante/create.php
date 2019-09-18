<?php
/* @var $this PalestranteController */
/* @var $model Palestrante */

$this->breadcrumbs=array(
	'Palestrantes'=>array('index'),
	'Novo',
);

$this->menu=array(
	array('label'=>'List Palestrante', 'url'=>array('index')),
	array('label'=>'Manage Palestrante', 'url'=>array('admin')),
);
?>

<h1>Criar Palestrante</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>