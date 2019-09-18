<?php
/* @var $this MesaRedondaController */
/* @var $model MesaRedonda */

$this->breadcrumbs = array(
    'Mesa Redonda' => array('index'),
    'Gerenciar',
);

$this->menu = array(
    array('label' => 'List MesaRedonda', 'url' => array('index')),
    array('label' => 'Create MesaRedonda', 'url' => array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#mesa-redonda-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Gerenciar Mesa Redonda</h1>

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
    'id' => 'mesa-redonda-grid',
    'dataProvider' => $model->search(),
    'filter' => $model,
    'columns' => array(
        'id',
        'nome',
        'mediador',
        'seminario_id',
        //'periodo',
        array(            // display 'author.username' using an expression
            'name'=>'periodo',
            'value'=> 'MesaRedonda::model()->getPeriodoStringById($data->periodo)' ,
        ),
        array(
            'class' => 'CButtonColumn',
        ),
    ),
));
?>
 