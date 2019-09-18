<?php
/* @var $this MesaRedondaController */
/* @var $model MesaRedonda */

$this->breadcrumbs=array(
	'Mesa Redonda'=>array('index'),
	'Nova',
);

$this->menu=array(
	array('label'=>'List MesaRedonda', 'url'=>array('index')),
	array('label'=>'Manage MesaRedonda', 'url'=>array('admin')),
);
?>

<h1>Nova Mesa Redonda</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>