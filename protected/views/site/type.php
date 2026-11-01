<?php
$this->pageTitle=Yii::app()->name.' - Выберите тип образовательного учреждения';
$this->breadcrumbs=array(
	$name,
);
?>
<fieldset><legend>Выберите тип образовательного учреждения:</legend></fieldset>
<p>
<?php
foreach($types as $type) {
    echo CHtml::link($type['est_name'], 'index.php?r=site/schools&id_type='.$type['id_est']).'<br />';
}
?>
</p>
<div class="row">
<?php $this->widget('bootstrap.widgets.TbButton', array(
    'label'=>'Вернуться к выбору муниципалитета',
    'type'=>'', // null, 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
    'url'=>'/',
    'icon'=>'icon-arrow-left',
    'htmlOptions'=>array('class'=>'pull-right'),
)); ?>
</div>
