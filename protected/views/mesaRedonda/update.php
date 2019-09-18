<?php
/* @var $this MesaRedondaController */
/* @var $model MesaRedonda */

$this->breadcrumbs=array(
	'Mesa Redonda'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Atualizar',
);

$this->menu=array(
	array('label'=>'List MesaRedonda', 'url'=>array('index')),
	array('label'=>'Create MesaRedonda', 'url'=>array('create')),
	array('label'=>'View MesaRedonda', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage MesaRedonda', 'url'=>array('admin')),
);
?>

<h1>Atualizar Mesa Redonda <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>