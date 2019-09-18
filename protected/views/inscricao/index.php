<!--Generated using Gimme CRUD freeware from www.HandsOnCoding.net -->
<?php

if (Yii::app()->user->isInRole('ADMIN')){
    $this->breadcrumbs=array(
            'Inscrições',
    );

    $this->menu=array(
            array('label'=>'Create Inscricao', 'url'=>array('create')),
            array('label'=>'Manage Inscricao', 'url'=>array('admin')),
    );
}
else{
    $this->menu=array(
            array('label'=>'Criar Inscricao', 'url'=>array('create')),         
    );
}
?>

<?php if (Yii::app()->user->isInRole('ADMIN')) {?>
<h1>Inscrições</h1>
<?php }else{ ?>
<h1>Minhas Inscrições</h1> 
<?php } ?>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
    
    
)); 



?>

