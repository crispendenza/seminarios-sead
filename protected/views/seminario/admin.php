<?php
/* @var $this SeminarioController */
/* @var $model Seminario */

$this->breadcrumbs = array(
    'Seminários' => array('index'),
    'Gerenciar',
);

$this->menu = array(
    array('label' => 'List Seminario', 'url' => array('index')),
    array('label' => 'Create Seminario', 'url' => array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#seminario-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Gerenciar Seminários</h1>

<p>
    You may optionally enter a comparison operator (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>
    or <b>=</b>) at the beginning of each of your search values to specify how the comparison should be done.
</p>

<?php echo CHtml::link('Advanced Search', '#', array('class' => 'search-button')); ?>
<div class="search-form" style="display:none">
    <?php
    $this->renderPartial('_search', array(
        'model' => $model,
    ));
    ?>
</div><!-- search-form -->

<?php
$this->widget('zii.widgets.grid.CGridView', array(
    'id' => 'seminario-grid',
    'dataProvider' => $model->search(),
    'filter' => $model,
    'columns' => array(
        'id',
        'nome',
        'data',
        //'periodo_manha',
        array(
            'header' => 'Período',
            'value' => 'Seminario::model()->getPeriodoString(array($data->periodo_manha, $data->periodo_tarde))'
        ),
        //'periodo_tarde',
        array(
            'class' => 'CButtonColumn',
        ),
    ),
));
?>
