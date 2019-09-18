<!--Generated using Gimme CRUD freeware from www.HandsOnCoding.net -->
<?php
if (Yii::app()->user->isInRole('ADMIN')) {
    $this->breadcrumbs = array(
        'Inscrições' => array('index'),
        'Detalhe',
    );

    $this->menu = array(
        array('label' => 'List Inscricao', 'url' => array('index')),
        array('label' => 'Create Inscricao', 'url' => array('create')),
        array('label' => 'Update Inscricao', 'url' => array('update', 'usuario_id' => $model->usuario_id, 'seminario_id' => $model->seminario_id)),
        array('label' => 'Delete Inscricao', 'url' => 'delete',
            'linkOptions' => array('submit' => array('delete',
                    'usuario_id' => $model->usuario_id, 'seminario_id' => $model->seminario_id),
                'confirm' => 'Are you sure you want to delete this item?')),
        array('label' => 'Manage Inscricao', 'url' => array('admin')),
    );
}
?>

<h1>Detalhe Inscrição</h1>

<?php
$this->widget('zii.widgets.CDetailView', array(
    'data' => $model,
    'attributes' => array(
        //'usuario_id',       
        array(
            'label' => 'Usuário',
            'type' => 'raw',
            'value' => CHtml::encode(Yii::app()->user->getFullNameById($model->usuario_id)),
        ),
        //'seminario_id',
        array(
            'label' => 'Seminário',
            'type' => 'raw',
            'value' => CHtml::encode(Seminario::model()->findByPk($model->seminario_id)->nome),
        ),
        'divulgacao',
        'perfil',
        'tipo_participacao',
        'nome_social',
        'nome_completo',
        array(
            'label' => 'Periodo',
            'value' => CHtml::encode(Seminario::model()->getPeriodoString(
                            array($model->periodo_manha, $model->periodo_tarde))
            ),
        ),
        'presenca_manha',
        'presenca_tarde',
        'tel',
        'tel_residencial',
        'instituicao_depto',
    ),
));
?>
