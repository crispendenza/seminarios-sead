<?php
if (Yii::app()->user->isInRole('ADMIN')) {
    $this->breadcrumbs = array(
        'Inscrições' => array('index'),
        'Gerar Certificados',
    );

    $this->menu = array(
        array('label' => 'List Inscricaos', 'url' => array('index')),
        array('label' => 'Create Inscricao', 'url' => array('create')),
    );
}
?>

<h1>Gerar Certificado</h1>


<?php
$this->widget('zii.widgets.grid.CGridView', array(
    'id' => 'certificadogrid',
    'dataProvider' => $dataProvider,
    //'filter' => $model,
    'columns' => array(
//        array(
//            'header' => 'Nome',
//            'value' => function($data) {
//                echo Yii::app()->user->getFullNameById($data->usuario_id);
//            },
//        ),
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
            // se foi inscrito no periodo da manha e tem presenca neste periodo = sim 
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
            'header' => 'Certificado',
            'class' => 'CButtonColumn',
            'template' => '{gerar}',
            'buttons' => array(
                'gerar' => array(
                    'label' => 'Gerar',
                    'options' => array('class' => 'grid-btns'),
                    'url' => 'Yii::app()->createUrl("inscricao/gerarCertificado/", 
                                            array("seminario_id"=>$data->seminario_id))',
                    'imageUrl' => Yii::app()->baseUrl . '/images/btn-gerar.png',
                    'visible' => '($data->presenca_manha || $data->presenca_tarde)? true:false',
                    
                    
                ),
            ),
        ),
    ),
));
?>
