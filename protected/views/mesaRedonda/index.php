<?php
/* @var $this MesaRedondaController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Mesa Redonda',
);

$this->menu=array(
	array('label'=>'Create MesaRedonda', 'url'=>array('create')),
	array('label'=>'Manage MesaRedonda', 'url'=>array('admin')),
);
?>

<h1>Mesa Redonda</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
    
)); ?>
