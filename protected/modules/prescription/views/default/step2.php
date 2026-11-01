<?php $this->pageTitle=Yii::app()->name;?>
<legend>Выбор наименования мероприятия предписания</legend>
<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
    'id'=>'mer_naim',
    'type'=>'horizontal',    
    'enableAjaxValidation'=>false,
)); ?>

<?php echo $form->radioButtonListRow($model, 'id_pr', $vid);?>

<div class="form-actions">
    <?php $this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'submit', 'type'=>'primary', 'icon'=>'arrow-right white', 'label'=>'Далее')); ?>
    <?php $this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'action', 'icon'=>'remove', 'label'=>'Отмена', 'url'=>$this->createUrl("pred_update", array('id_pr'=>$id_pr)))); ?>
</div>

<?php $this->endWidget(); ?>   

