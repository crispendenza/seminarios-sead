<!--Generated using Gimme CRUD freeware from www.HandsOnCoding.net -->
<?php
$this->breadcrumbs = array(
    'Inscrições' => array('index'),
    'Confirmar Presença',
);

$this->menu = array(
    array('label' => 'List Inscricaos', 'url' => array('index')),
    array('label' => 'Create Inscricao', 'url' => array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('presencagrid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>


<h1>Confirmar Presença</h1>


<?php echo CHtml::link('Busca Avançada', '#', array('class' => 'search-button')); ?>
<div class="search-form" style="display:none">
    <?php
    $this->renderPartial('_search', array(
        'model' => $model,
    ));
    ?>


</div><!-- search-form -->

<?php
$this->widget('zii.widgets.grid.CGridView', array(
    'id' => 'presencagrid',
    'dataProvider' => $model->search(),
    'filter' => $model,
    'columns' => array(
        array(
            'header' => 'Nome',
            'value' => function($data) {
                echo Yii::app()->user->getFullNameById($data->usuario_id);
            },
        ),
        array(
            'header' => 'Seminário',
            'value' => function($data) {
                echo Seminario::model()->getFullNameById($data->seminario_id);
            },
        ),
        array(
            'header' => 'Período de inscrição',
            'value' => function($data) {
                echo Seminario::model()->getPeriodoString(array($data->periodo_manha, $data->periodo_tarde));
            },
        ),
        array(
            'header' => 'Presença manhã',
            'value' => function($data) {
                echo $data->periodo_manha ? $data->presenca_manha ? '<span class="span-presenca-sim">Sim</span>' : '<span class="span-presenca-nao">Não</span>' : '';
            },
        ),
        array(
            'header' => 'Presença tarde',
            'value' => function($data) {
                echo $data->periodo_tarde ? $data->presenca_tarde ? '<span class="span-presenca-sim">Sim</span>' : '<span class="span-presenca-nao">Não</span>' : '';
            },
        ),
        
                    
        array(
            'header'=>'Alterar presença',
            'headerHtmlOptions' => array('style' => 'min-width: 120px'),
            'class' => 'CButtonColumn',
            'template' => '{manha}{tarde}',
            'buttons' => array(
                'manha' => array(    
                    'label'=>'Manhã ',
                    'options' => array('class' => 'grid-btns'),                    
                    'url' =>
                    'Yii::app()->createUrl("inscricao/atualizaPresenca/", 
                                            array("usuario_id"=>$data->usuario_id, "seminario_id"=>$data->seminario_id, "periodo" => "manha"))',
                    'visible'=>'$data->periodo_manha==1',
                    'imageUrl' => Yii::app()->baseUrl . '/images/btn-manha.png',
                ),
                'tarde' => array(
                    'label'=>'Tarde',
                    'options' => array('class' => 'grid-btns'),
                    'url' =>
                    'Yii::app()->createUrl("inscricao/atualizaPresenca/", 
                                           array("usuario_id"=>$data->usuario_id, "seminario_id"=>$data->seminario_id, "periodo" => "tarde"))',
                    'visible'=>'$data->periodo_tarde==1',
                    'imageUrl' => Yii::app()->baseUrl . '/images/btn-tarde.png',
                    'headerHtmlOptions' => array('style' => 'min-width: 100px'),
                ),
                
            ),
        ),
    ),
));
?>
