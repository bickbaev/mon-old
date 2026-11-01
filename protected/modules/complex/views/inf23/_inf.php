<?php
$form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
    'id'=>'master-form',
    'type'=>'horizontal',    
    'enableAjaxValidation'=>false,
    'htmlOptions' => array('enctype'=>'multipart/form-data'),    
)); ?>

    <blockquote><em>Поля помеченные<span class="required"> * </span>обязательны для заполнения.</em></blockquote>

    <?php echo $form->errorSummary($model); ?>
    
    <?php echo $form->hiddenField($model, 'id_report') ?>
    
    <?php echo $form->textFieldRow($model, 'pok1',array('class'=>'span5','maxlength'=>255)); ?>

    <?php echo $form->textFieldRow($model, 'pok2',array('class'=>'span5','maxlength'=>255)); ?>
    
    <?php echo $form->textAreaRow($model,'pok3',array('rows'=>6, 'cols'=>50, 'class'=>'span8')); ?>

    <?php echo $form->dropDownListRow($model, 'pok4', CHtml::listData(Inf23_type::model()->findAll(array('order' => 'id ASC')), 'id', 'naim'), array('empty'=>'Выберите значение', 'class'=>'span5')); ?>    
    
    <?php echo $form->textFieldRow($model, 'pok5',array('class'=>'span2','maxlength'=>10)); ?>
    <?php echo $form->textFieldRow($model, 'pok6',array('class'=>'span2','maxlength'=>10)); ?>
    <?php echo $form->textFieldRow($model, 'pok7',array('class'=>'span2','maxlength'=>10)); ?>
    <?php echo $form->textFieldRow($model, 'pok8',array('class'=>'span2','maxlength'=>10)); ?>    

<div class="form-actions">
    <?php $this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'submit', 'type'=>'primary', 'icon'=>'ok white', 'label'=>'Сохранить')); ?>
    <?php $this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'action', 'icon'=>'remove', 'label'=>'Отмена', 'url'=>$this->createUrl('inf23/edit',array('id_rep'=>$model->id_report)))); ?>
</div>

<?php $this->endWidget(); ?>       