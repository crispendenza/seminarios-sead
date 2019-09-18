<?php
/* @var $this PalestranteController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Palestrantes',
);

$this->menu=array(
	array('label'=>'Create Palestrante', 'url'=>array('create')),
	array('label'=>'Manage Palestrante', 'url'=>array('admin')),
);
?>

<h1>Palestrantes</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
