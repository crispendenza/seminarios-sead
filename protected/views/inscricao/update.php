<!--Generated using Gimme CRUD freeware from www.HandsOnCoding.net -->
<?php
$this->breadcrumbs=array(
	'Inscrições'=>array('index'),

	'Atualizar',
);

$this->menu=array(
	array('label'=>'List Inscricao', 'url'=>array('index')),
	array('label'=>'Create Inscricao', 'url'=>array('create')),
	array('label'=>'View Inscricao', 'url'=>array('view', 'usuario_id'=>$model->usuario_id, 'seminario_id'=>$model->seminario_id)),
	array('label'=>'Manage Inscricao', 'url'=>array('admin')),
); 
?>

<h1>Atualizar Inscrição</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
