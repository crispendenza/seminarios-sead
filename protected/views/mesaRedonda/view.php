<?php
/* @var $this MesaRedondaController */
/* @var $model MesaRedonda */

$this->breadcrumbs = array(
    'Mesa Redonda' => array('index'),
    $model->id,
);

$this->menu = array(
    array('label' => 'List MesaRedonda', 'url' => array('index')),
    array('label' => 'Create MesaRedonda', 'url' => array('create')),
    array('label' => 'Update MesaRedonda', 'url' => array('update', 'id' => $model->id)),
    array('label' => 'Delete MesaRedonda', 'url' => '#', 'linkOptions' => array('submit' => array('delete', 'id' => $model->id), 'confirm' => 'Are you sure you want to delete this item?')),
    array('label' => 'Manage MesaRedonda', 'url' => array('admin')),
);
?>

<h1>Mesa Redonda #<?php echo $model->id; ?></h1>

<?php
$this->widget('zii.widgets.CDetailView', array(
    'data' => $model,
    'attributes' => array(
        'id',
        'nome',
        'mediador',
        'seminario_id',
        //'periodo',
        array(
            'label' => 'Período: ',
            'value' => $model->getPeriodoString()           
        ),
    ),
)); 

?>


