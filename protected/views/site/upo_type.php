<?php
$this->pageTitle=Yii::app()->name.' - Выберите образовательное учреждение';
$this->breadcrumbs=array(
	//$name,
);
?>
<fieldset><legend><?php echo $name; ?>. Информация об организациях профессионального образования.</legend></fieldset>
<?php  
if(sizeof($spo)) { ?>
<ul>
<?php
foreach($spo as $sp) {
    echo '<li>'.CHtml::link($sp['est_name'], 'index.php?r=site/upo_report&id_school='.$sp['id_est']).'</li>';
}
?>
</ul>
<?php } ?>
<?php $this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'action', 'icon'=>'arrow-left', 'label'=>'Назад', 'htmlOptions'=>array('style'=>'margin-top:20px;'), 'url'=>$this->createUrl('site/upo_index'))); ?>
