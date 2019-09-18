<?php
/* @var $this SeminarioController */
/* @var $data Seminario */
?>

<div class="view">

    <?php if (Yii::app()->user->isInRole('ADMIN')): ?>
    <b><?php  echo CHtml::encode($data->getAttributeLabel('id'));  ?>:</b>
    <?php  echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?><br>
    <?php endif; ?>


    <b><?php echo CHtml::encode($data->getAttributeLabel('nome')); ?>:</b>
    <?php echo CHtml::encode($data->nome); ?>
    <br />

    <b><?php echo CHtml::encode($data->getAttributeLabel('data')); ?>:</b>
    <?php echo CHtml::encode($data->data); ?>
    <br />

    <b>Período: </b>    
    <?php
    echo CHtml::encode($this->getPeriodoString(
                    array('manha' => $data->periodo_manha, 'tarde' => $data->periodo_tarde)
    ));
    ?>
    


</div>