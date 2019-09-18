<!--Generated using Gimme CRUD freeware from www.HandsOnCoding.net -->


<div class="view">





    <b><span>Nome: </span>
        <?php //echo CHtml::encode($data->getAttributeLabel('usuario_id')); ?>:</b>
    <?php
    //echo CHtml::encode($data->usuario_id);
    echo CHtml::encode(Yii::app()->user->getFullNameById($data->usuario_id));
    ?><br />

    <b><span>Seminário: </span>
        <?php //echo CHtml::encode($data->getAttributeLabel('seminario_id')); ?>:</b>
    <?php
    //echo CHtml::encode($data->seminario_id);
    echo CHtml::encode(Seminario::model()->getFullNameById($data->seminario_id));
    ?><br />

    <b><?php echo CHtml::encode($data->getAttributeLabel('divulgacao')); ?>:</b>
    <?php echo CHtml::encode($data->divulgacao); ?><br />

    <b><?php echo CHtml::encode($data->getAttributeLabel('perfil')); ?>:</b>
    <?php echo CHtml::encode($data->perfil); ?><br />

    <b><?php echo CHtml::encode($data->getAttributeLabel('tipo_participacao')); ?>:</b>
    <?php echo CHtml::encode($data->tipo_participacao); ?><br />

    <b><?php echo CHtml::encode($data->getAttributeLabel('nome_social')); ?>:</b>
    <?php echo CHtml::encode($data->nome_social); ?><br />

    <b><?php echo CHtml::encode($data->getAttributeLabel('nome_completo')); ?>:</b>
    <?php echo CHtml::encode($data->nome_completo); ?><br />

    <b><?php echo CHtml::encode($data->getAttributeLabel('periodo_manha')); ?>:</b>
    <?php echo CHtml::encode($data->periodo_manha == 1 ? 'Sim' : 'Não'); ?><br />

    <b><?php echo CHtml::encode($data->getAttributeLabel('periodo_tarde')); ?>:</b>
    <?php echo CHtml::encode($data->periodo_tarde == 1 ? 'Sim' : 'Não'); ?><br />

    <?php if (Yii::app()->user->isInRole('ADMIN')): ?>

        <b> <?php echo CHtml::encode($data->getAttributeLabel('presenca_manha')); ?>:</b>
        <?php echo $data->presenca_manha ? 'Sim' : 'Não' ;        
        //CHtml::encode($data->presenca_manha); ?><br />

        <b><?php echo CHtml::encode($data->getAttributeLabel('presenca_tarde')); ?>:</b>
        <?php echo $data->presenca_tarde ? 'Sim' : 'Não' ;
        //CHtml::encode($data->presenca_tarde); ?><br />

    <?php endif; ?>

    <b><?php echo CHtml::encode($data->getAttributeLabel('tel')); ?>:</b>
    <?php echo CHtml::encode($data->tel); ?><br />

    <b><?php echo CHtml::encode($data->getAttributeLabel('tel_residencial')); ?>:</b>
    <?php echo CHtml::encode($data->tel_residencial); ?><br />

    <b><?php echo CHtml::encode($data->getAttributeLabel('instituicao_depto')); ?>:</b>
    <?php echo CHtml::encode($data->instituicao_depto); ?><br />

    <?php if (Yii::app()->user->isInRole('ADMIN')): ?>
        <?php
        echo CHtml::link("Detalhes", array('view',
            'usuario_id' => $data->usuario_id, 'seminario_id' => $data->seminario_id));
        ?>   
    <?php endif; ?>
   


</div>


