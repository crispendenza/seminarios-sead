
<div class="view">


    <div class="left" style="padding: 10px 8px">
        <b><?php echo CHtml::encode($data->getAttributeLabel('nome')); ?>:</b>
        <?php echo CHtml::encode($data->nome); ?>
        <br />

        <b><?php echo CHtml::encode($data->getAttributeLabel('data')); ?>:</b>
        <?php echo CHtml::encode($data->data); ?>
        - 
        <?php
        echo CHtml::encode($this->getPeriodoString(
                        array('manha' => $data->periodo_manha, 'tarde' => $data->periodo_tarde)
        ));
        ?>
        <br />
    </div>
    <?php
//    echo var_dump($this->teste($data->id));
    if ( $this->inscricoesAbertas($data->id) ):
        if (!Yii::app()->user->isGuest):
            $model_inscricao = Inscricao::model()->findByPk(array('usuario_id' => Yii::app()->user->getId(), 'seminario_id' => $data->id));
            if ($model_inscricao['seminario_id'] == $data->id):
                ?>
                <p class="inscrito" >Já inscrito!</p>
            <?php else: ?> 
                <a class="inscreva-se" href="index.php?r=inscricao/create&id=<?php echo $data->id ?>&nome=<?php echo $data->nome ?>" >Inscreva-se!</a> 
            <?php endif;
        else:
            ?>
            <a class="inscreva-se" href="index.php?r=inscricao/create&id=<?php echo $data->id ?>&nome=<?php echo $data->nome ?>" >Inscreva-se!</a> 

    <?php 
        endif; 
        else: ?>
            <p class="encerradas" >Inscrições Encerradas!</p>
    <?php            
    endif; ?>    
</div>