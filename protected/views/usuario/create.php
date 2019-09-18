<?php
/* @var $this UsuarioController */
/* @var $model Usuario */

if (Yii::app()->user->isInRole('ADMIN')) {
    $this->breadcrumbs = array(
        'Usuários' => array('index'),
        'Novo',
    );
}

$this->menu = array(
    array('label' => 'List Usuario', 'url' => array('index'), 'visible' => Yii::app()->user->isInRole('ADMIN')),
    array('label' => 'Manage Usuario', 'url' => array('admin'), 'visible' => Yii::app()->user->isInRole('ADMIN')),
);
?>

<?php if (Yii::app()->user->isInRole('ADMIN')) { ?>
    <h1>Criar Usuário</h1>
<?php } else { ?>
    <h1>Cadastrar-se</h1> 
<?php } ?>

<?php $this->renderPartial('_form', array('model' => $model)); ?>