<?php
/* @var $this SiteController */


$dataProvider=new CActiveDataProvider('Seminario', array(
    'criteria'=>array(        
        'order'=>'id ASC',        
    ),   
    'pagination'=>array(
        'pageSize'=>10,
    ),
));
 $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); 

?>

