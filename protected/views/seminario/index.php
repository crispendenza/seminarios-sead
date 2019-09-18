<?php
/* @var $this SeminarioController */
/* @var $dataProvider CActiveDataProvider */

if (Yii::app()->user->isInRole('ADMIN')){
$this->breadcrumbs=array(
	'Seminários',
);
}

$this->menu=array(
	array('label'=>'Create Seminario', 'url'=>array('create')),
	array('label'=>'Manage Seminario', 'url'=>array('admin')),
);
?>

<?php if (Yii::app()->user->isInRole('ADMIN')) {?>
<h1>Seminários</h1>
<?php }else{ ?>
<h1>Seminários disponíveis</h1> 
<?php } ?>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
