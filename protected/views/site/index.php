<?php
/* @var $this SiteController */

$this->pageTitle=Yii::app()->name;
?>

<h1>Bem vindo ao Sistema de Inscrição de Seminários SEaD</h1>
<br>

<?php if (Yii::app()->user->isGuest): ?>
<ul>
    <li>Caso já possua cadastro neste site e deseja se inscrever em outro Seminário, clique <b><a href="index.php?r=site/login">AQUI</a></b> para entrar no sistema.</li>
    <li>Se é a primeira vez que acessa esse site, selecione um seminário abaixo e clique em <b>Inscreva-se</b>.</li>
    
</ul>
<br>
<?php endif; ?>
<h3>Seminários disponíveis: </h3>
<?php   

$dataProvider=new CActiveDataProvider('Seminario', array(
    'criteria'=>array(        
        'order'=>'id ASC',        
    ),   
    'pagination'=>array(
        'pageSize'=>5,
    ),
           
));
 $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
        'htmlOptions' => array(
            'class'=> 'index-CList'
        )
)); 

?>

