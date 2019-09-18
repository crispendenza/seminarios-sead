<?php
/* @var $this SeminarioController */
/* @var $model Seminario */


$this->breadcrumbs = array(
    'Seminários' => array('index'),
    $model->id,
);

$this->menu = array(
    array('label' => 'List Seminario', 'url' => array('index')),
    array('label' => 'Create Seminario', 'url' => array('create')),
    array('label' => 'Update Seminario', 'url' => array('update', 'id' => $model->id)),
    array('label' => 'Delete Seminario', 'url' => '#', 'linkOptions' => array('submit' => array('delete', 'id' => $model->id), 'confirm' => 'Are you sure you want to delete this item?')),
    array('label' => 'Manage Seminario', 'url' => array('admin')),
);
?>

<h1>Seminário #<?php echo $model->id; ?></h1>

<?php
$this->widget('zii.widgets.CDetailView', array(
    'data' => $model,
    'attributes' => array(
        'id',
        'nome',
        'data',
        array(
            'label' => 'Periodo: ',
            'value' => CHtml::encode($this->getPeriodoString(
                            array('manha' => $model->periodo_manha, 'tarde' => $model->periodo_tarde))
            ),
        ),
        //'periodo_manha',
        //'periodo_tarde',
    ),
));
?>
