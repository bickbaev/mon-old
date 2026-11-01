<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
    'id'=>'building2015-form',
    'enableAjaxValidation'=>false,
    //'type'=>'vertical',
    'htmlOptions' => array('enctype'=>'multipart/form-data'),    
)); ?>

    <?php echo $form->checkBoxRow($model, 'cap'); ?>
    <?php echo $form->textAreaRow($model, 'vid', array('class'=>'span8', 'rows'=>5)); ?>
    <?php echo $form->textFieldRow($model, 'price'); ?> 
    <?php echo $form->textFieldRow($model, 'god', array('class' =>'span1')); ?> 

    <div class="form-actions">
    <?php $this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'submit', 'type'=>'primary', 'icon'=>'ok white', 'label'=>'Сохранить')); ?>
    <?php $this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'action', 'icon'=>'remove', 'label'=>'Отмена', 'url'=>$this->createUrl('building2018/update',array('id_building'=>$model->id_building)))); ?>
    </div>

<?php $this->endWidget(); ?>   
