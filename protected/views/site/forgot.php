<?php
$this->pageTitle = Yii::app()->name . ' - Esqueci a senha';
//$this->breadcrumbs = array(
//    'Forgot Password',
//);
?>
<?php if (Yii::app()->user->hasFlash('forgot')): ?>

    <div class="flash-success">
        <?php echo Yii::app()->user->getFlash('forgot'); ?>
    </div>

<?php else: ?>

    <div class="form">
        <h3>Entre com seu e-mail por favor:</h3>
        <?php
        $form = $this->beginWidget('CActiveForm', array(
            'id' => 'forgot-form',
            'enableClientValidation' => true,
            'clientOptions' => array(
                'validateOnSubmit' => true,
            ),
        ));
        ?>

        <div class="row">
            Email : <input name="Lupa[email]" id="ContactForm_email" type="email" required >
        </div>

        <div class="row buttons">
        <?php echo CHtml::submitButton('Enviar'); ?>
        </div>

    <?php $this->endWidget(); ?>

    </div><!-- form -->

<?php endif; ?>