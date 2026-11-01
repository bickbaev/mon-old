<?php $this->pageTitle=Yii::app()->name;?>
<legend><?php echo $nazv; ?> предписания</legend>
<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
    'id'=>'pr-update',
    'type'=>'horizontal',    
    'enableAjaxValidation'=>false,
)); ?>

<?php echo $form->radioButtonListRow($model, 'id_type', CHtml::listData(Pr_type::model()->findAll(array('order' => 'id_type ASC')), 'id_type', 'naim'));?>

<div class="form-actions">
    <?php $this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'submit', 'type'=>'primary', 'icon'=>'arrow-right white', 'label'=>'Далее')); ?>
    <?php $this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'action', 'icon'=>'remove', 'label'=>'Отмена', 'url'=>$this->createUrl("object_update", array('id_build'=>$id_build)))); ?>
</div>

<?php $this->endWidget(); ?>   
