
<div class="form">

    <?php
    $form = $this->beginWidget('CActiveForm', array(
        'id' => 'client-account-create-form',
        'enableAjaxValidation' => false,
    ));
    ?>

    <?php echo $form->errorSummary($model); ?>

    <?php if (Yii::app()->user->isInRole('ADMIN')): ?>
        <div class="row">        
            <p><?php echo $form->labelEx($model, 'usuario_id'); ?></p>
            <?php echo $form->dropDownList($model, 'usuario_id', CHtml::listData(Usuario::model()->findAll(), 'id', 'primeiro_nome'), array('prompt' => 'Selecione...')); ?>
            <?php echo $form->error($model, 'usuario_id'); ?><?php if (Yii::app()->user->isInRole('ADMIN')) { ?> <a href="index.php?r=usuario/create">Criar Usuário</a> <?php } ?>
        </div>
        <?php
    else:
        echo $form->hiddenField($model, 'usuario_id', array('value' => Yii::app()->user->getId()));
        echo $form->error($model, 'usuario_id');
    endif;
    ?>

    <?php if (!isset($_GET['id'])): ?>
        <div class="row">
            <p><?php echo $form->labelEx($model, 'seminario_id'); ?></p>
            <?php echo $form->dropDownList($model, 'seminario_id', CHtml::listData(Seminario::model()->findAll(), 'id', 'nome'), array('prompt' => 'Selecione...', 'id' => 'seminario-dd')); ?>       
            <?php echo $form->error($model, 'seminario_id'); ?><?php if (Yii::app()->user->isInRole('ADMIN')) { ?> <a href="index.php?r=seminario/create">Criar Seminário</a><?php } ?>  
        </div>
    <?php else: ?>
        <div class="row">
            <h2 style="margin-bottom: 5px">Seminário: <?php echo $_GET['nome'] ?></h2>
            <?php echo $form->hiddenField($model, 'seminario_id', array('value' => $_GET['id'])); ?>
            <?php echo $form->error($model, 'seminario_id'); ?>
            <h4>Período: <b><?php
                    echo Seminario::model()->getPeriodoString(
                            array(Seminario::model()->findByPk($_GET['id'])->periodo_manha, Seminario::model()->findByPk($_GET['id'])->periodo_tarde));
                    ?> </b>
            </h4> 
        </div>

    <?php endif; ?>


    <div class="row">
        <p><?php echo $form->labelEx($model, 'nome_social'); ?></p>
        <?php echo $form->textField($model, 'nome_social'); ?>
        <?php echo $form->error($model, 'nome_social'); ?>
        <p class='complementoDeLabel'>Caso possua</p>
    </div>

    <div class="row">
        <p><?php echo $form->labelEx($model, 'nome_completo'); ?></p>
        <?php echo $form->textField($model, 'nome_completo'); ?>
        <?php echo $form->error($model, 'nome_completo'); ?> <br>    
        <p class="complementoDeLabel">Este será o nome que irá sair no certificado</p>

    </div>

    <div class="row">
        <p><?php echo $form->labelEx($model, 'tel'); ?></p>
        <?php
        $this->widget("ext.maskedInput.MaskedInput", array(
            "model" => $model,
            "attribute" => "tel",
            "mask" => "(99) 99999-9999",
            "defaults" => array("removeMaskOnSubmit" => false),
        ));
        ?>
        <?php echo $form->error($model, 'tel'); ?>
        <p class='complementoDeLabel'>(99) 99999-9999</p>
    </div>

    <div class="row">
        <p><?php echo $form->labelEx($model, 'tel_residencial'); ?></p>
        <?php
        $this->widget("ext.maskedInput.MaskedInput", array(
            "model" => $model,
            "attribute" => "tel_residencial",
            "mask" => "(99) 9999-9999",
            "defaults" => array("removeMaskOnSubmit" => false),
        ));
        ?>
        <?php echo $form->error($model, 'tel_residencial'); ?>
        <p class='complementoDeLabel'>Opcional</p>
    </div>
    <div class="row">
        <p><?php echo $form->labelEx($model, 'instituicao_depto'); ?></p>
        <?php echo $form->textField($model, 'instituicao_depto'); ?>
        <?php echo $form->error($model, 'instituicao_depto'); ?>
        <p class="complementoDeLabel">Nome da Instituição e/ou nome do Departamento a qual você é vinculado.</p>
    </div>

    <div class="row">
        <?php $divulgacao_rbl = array('Email' => 'Email', 'Site SEaD' => 'Site SEaD', 'Facebook' => 'Facebook', 'Instagram' => 'Instagram', 'Twitter' => 'Twitter', 'Outro' => 'Outro'); ?>
        <p><?php echo $form->labelEx($model, 'divulgacao'); ?></p>
        <div style="padding:10px 0px"><?php echo $form->radioButtonList($model, 'divulgacao', $divulgacao_rbl); ?> </div>
        <?php echo $form->error($model, 'divulgacao'); ?>
    </div>

    <div class="row">
        <?php $perfil_rbl = array('Docente' => 'Docente', 'TA' => 'TA', 'Estudante' => 'Estudante', 'Outro' => 'Outro'); ?>
        <p><?php echo $form->labelEx($model, 'perfil'); ?></p>
        <div style="padding:10px 0px"><?php echo $form->radioButtonList($model, 'perfil', $perfil_rbl); ?></div>       
        <?php echo $form->error($model, 'perfil'); ?>
    </div>

    <div class="row">
        <?php $participacao_rbl = array('Presencial' => 'Presencial', 'Virtual' => 'Virtual'); ?>
        <p><?php echo $form->labelEx($model, 'tipo_participacao'); ?></p>
        <div style="padding:10px 0px"><?php echo $form->radioButtonList($model, 'tipo_participacao', $participacao_rbl); ?></div>   
        <?php echo $form->error($model, 'tipo_participacao'); ?>
                        
    </div>

    <?php
    if (isset($_GET['id'])) {
        $seminario_model = Seminario::model()->findByPk($_GET['id']);
        if ($seminario_model->periodo_manha && $seminario_model->periodo_tarde) {
            ?>
            <p>Período de participação </p><span class="required">*</span>
            <div class="row">        
                <div style="padding:10px 0px">
                    <!-- Periodo da manha (checkbox) -->
                    <?php echo $form->checkBox($model, 'periodo_manha'); ?>
                    <?php echo $form->labelEx($model, 'periodo_manha'); ?>
                    <?php echo $form->error($model, 'periodo_manha'); ?>
                    <br>
                    <!-- Periodo da tarde (checkbox) -->
                    <?php echo $form->checkBox($model, 'periodo_tarde'); ?>
                    <?php echo $form->labelEx($model, 'periodo_tarde'); ?>   
                    <?php echo $form->error($model, 'periodo_tarde'); ?>
                </div>
            </div>
            <?php
        } else if ($seminario_model->periodo_manha) {
            echo $form->hiddenField($model, 'periodo_manha', array('value' => $seminario_model->periodo_manha));
            echo $form->hiddenField($model, 'periodo_tarde', array('value' => 0));
        } else if ($seminario_model->periodo_tarde) {
            echo $form->hiddenField($model, 'periodo_manha', array('value' => 0));
            echo $form->hiddenField($model, 'periodo_tarde', array('value' => $seminario_model->periodo_tarde));
        }
    } else { ?>
            
        <p>Período de participação </p><span class="required">*</span>
        <div class="row">        
            <div style="padding:10px 0px">
                <!-- Periodo da manha (checkbox) -->

                <?php echo $form->checkBox($model, 'periodo_manha'); ?>
                <?php echo $form->labelEx($model, 'periodo_manha'); ?>
                <?php echo $form->error($model, 'periodo_manha'); ?>
                <br>
                <!-- Periodo da tarde (checkbox) -->
                <?php echo $form->checkBox($model, 'periodo_tarde'); ?>
                <?php echo $form->labelEx($model, 'periodo_tarde'); ?>   
                <?php echo $form->error($model, 'periodo_tarde'); ?>
            </div>
        </div>

    <?php } ?>

    <?php if (Yii::app()->user->isInRole('ADMIN')): ?>
        <div class="row">
            <?php echo $form->checkBox($model, 'presenca_manha'); ?>
            <?php echo $form->labelEx($model, 'presenca_manha'); ?>        
            <?php echo $form->error($model, 'presenca_manha'); ?>
        </div>

        <div class="row">
            <?php echo $form->checkBox($model, 'presenca_tarde'); ?>
            <?php echo $form->labelEx($model, 'presenca_tarde'); ?>
            <?php echo $form->error($model, 'presenca_tarde'); ?>
        </div>
        <?php
    else:
        echo $form->hiddenField($model, 'presenca_manha', array('value' => 0));
        echo $form->hiddenField($model, 'presenca_tarde', array('value' => 0));
    endif;
    ?>
    <br>
    <p class="note">Campos com <span class="required">*</span> são obrigatórios.</p>
    <div class="row buttons">
        <?php echo CHtml::submitButton($model->isNewRecord ? 'Inscrever' : 'Salvar'); ?>

    </div>
    <?php $this->endWidget(); ?>

</div><!-- form --> 
