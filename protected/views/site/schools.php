<?php
$this->pageTitle=Yii::app()->name.' - Выберите образовательное учреждение';
$this->breadcrumbs=array(
	$name => array('site/type', 'id_raion' => $id_raion['id_raion']),
        $id_raion['est_name'],
);
?>
<fieldset><legend>Выберите образовательное учреждение:</legend></fieldset>
<p>
<?php
foreach($schools as $school) {
    echo CHtml::link($school['est_name'], 'index.php?r=site/report&id_school='.$school['id_est']).'<br />';
}
?>
</p>    
<div class="row">
<?php $this->widget('bootstrap.widgets.TbButton', array(
    'label'=>'Вернуться к выбору типа образовательного учреждения',
    'type'=>'', // null, 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
    'url'=>'index.php?r=site/type&id_raion='.$id_raion['id_raion'],
    'icon'=>'icon-arrow-left',
    'htmlOptions'=>array('class'=>'pull-right'),
)); ?>
</div>
