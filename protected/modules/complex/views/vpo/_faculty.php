<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
    'id'=>'faculty-form',
    'type'=>'horizontal',    
    'enableAjaxValidation'=>false,
)); ?>

    <blockquote><em>Поля помеченные<span class="required"> * </span>обязательны для заполнения.</em></blockquote>

    <?php echo $form->errorSummary($model); ?>
    
    <?php echo $form->textFieldRow($model,'naim_faculty',array('class'=>'span7','maxlength'=>255)); ?>
    
    <?php echo $form->textFieldRow($model,'link',array('class'=>'span7','maxlength'=>255)); ?>  
    
    <div class="form-actions">
        <?php $this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'submit', 'type'=>'primary', 'icon'=>'ok white', 'label'=>'Сохранить')); ?>
        <?php $this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'action', 'icon'=>'remove', 'label'=>'Отмена', 'url'=>$this->createUrl('vpo/edit_faculty',array('id_faculty'=>$model->id_faculty)))); ?>
    </div>

<?php $this->endWidget(); ?>
