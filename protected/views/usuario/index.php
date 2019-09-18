<?php
/* @var $this UsuarioController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Usuários',
);

$this->menu=array(
	array('label'=>'Create Usuario', 'url'=>array('create')),
	array('label'=>'Manage Usuario', 'url'=>array('admin')),
);
?>

<h1>Usuários</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
