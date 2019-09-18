<!--Generated using Gimme CRUD freeware from www.HandsOnCoding.net -->
<?php
$this->breadcrumbs=array(
	'Inscrições'=>array('index'),
	'Gerenciar',
);

$this->menu=array(
	array('label'=>'List Inscricaos', 'url'=>array('index')),
	array('label'=>'Create Inscricao', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('inscricaogrid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Gerenciar Inscrições</h1>

<p>
You may optionally enter a comparison operator (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>
or <b>=</b>) at the beginning of each of your search values to specify how the comparison should be done.
</p>

<?php echo CHtml::link('Advanced Search','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
    
    
</div><!-- search-form -->

<?php 
$this->widget('zii.widgets.grid.CGridView', array(
    'id'=>'inscricaogrid',
    'dataProvider'=>$model->search(),
    'filter'=>$model,
    'columns'=>array(
        'usuario_id',
        'seminario_id',
        'divulgacao',
        'perfil',
        'tipo_participacao',
        'nome_social',
        'nome_completo',
        'periodo_manha',
        'periodo_tarde',
        'presenca_manha',
        'presenca_tarde',
        'tel',
        'tel_residencial',
        'instituicao_depto',
        array(
            'class'=>'CButtonColumn',
            'template'=>'{view}{update}{delete}',
            'buttons'=>array
            (
                'view' => array
                (
                    'url'=>
                    'Yii::app()->createUrl("inscricao/view/", 
                                            array("usuario_id"=>$data->usuario_id, "seminario_id"=>$data->seminario_id
											))',
                ),
                'update' => array
                (
                    'url'=>
                    'Yii::app()->createUrl("inscricao/update/", 
                                            array("usuario_id"=>$data->usuario_id, "seminario_id"=>$data->seminario_id
											))',
                ),
                'delete'=> array
                (
                    'url'=>
                    'Yii::app()->createUrl("inscricao/delete/", 
                                            array("usuario_id"=>$data->usuario_id, "seminario_id"=>$data->seminario_id
											))',
                ),
            ),
        ),
    ),
)); 
?>
