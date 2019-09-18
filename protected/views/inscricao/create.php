<!--Generated using Gimme CRUD freeware from www.HandsOnCoding.net -->
<?php

if (Yii::app()->user->isInRole('ADMIN')){
    $this->breadcrumbs=array(
            'Inscrições'=>array('index'),
            'Nova',
    );

    $this->menu=array(
            array('label'=>'List Inscricaos', 'url'=>array('index'), 'visible' => Yii::app()->user->isInRole('ADMIN')),
        array('label'=>'Manage Inscricao', 'url'=>array('admin'), 'visible' => Yii::app()->user->isInRole('ADMIN')),
    );
}
?>





<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
