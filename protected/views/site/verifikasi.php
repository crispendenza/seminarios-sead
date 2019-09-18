<?php
$this->pageTitle = Yii::app()->name . ' - Recuperar senha';
//$this->breadcrumbs = array(
//    'Ganti Password',
//);
?>
<h2>Olá <?php echo $model->primeiro_nome; ?></h2>
<div class="form">
    <h2>Recuperar senha</h2>
    <?php
    $form = $this->beginWidget('CActiveForm', array(
        'id' => 'Ganti-form',
    ));
    ?>

    <div class="row">
        Nova senha : <input name="Ganti[password]" id="ContactForm_email" type="password">
        <input name="Ganti[tokenhid]" id="ContactForm_email" type="hidden" value="<?php echo $model->token ?>">
    </div>

    <div class="row buttons">
    <?php echo CHtml::submitButton('Submit'); ?>
    </div>

<?php $this->endWidget(); ?>

</div><!-- form -->
