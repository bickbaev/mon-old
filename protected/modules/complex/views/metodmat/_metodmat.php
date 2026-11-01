<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
    'id'=>'metodmat-form',
    'type'=>'horizontal',    
    'enableAjaxValidation'=>false,
)); ?>

    <blockquote><em>Поля помеченные<span class="required"> * </span>обязательны для заполнения.</em></blockquote>

    <?php echo $form->errorSummary($model); ?>
    
    <?php echo $form->dropDownListRow($model, 'id_type', CHtml::listData(Metodmat_type::model()->findAll(array('order' => 'id_type ASC')), 'id_type', 'naim_type'), array('empty'=>'Выберите тип материала', 'class'=>'span8')); ?>
    
    <?php echo $form->textFieldRow($model,'naim',array('class'=>'span8')); ?>
    
    <?php echo $form->textFieldRow($model,'author',array('class'=>'span8')); ?>
    
    <?php echo $form->textFieldRow($model,'mesto',array('class'=>'span2')); ?>
    
    <?php echo $form->textFieldRow($model,'izdat',array('class'=>'span3')); ?>
    
    <?php echo $form->textFieldRow($model,'god',array('class'=>'span1')); ?>
    
    <?php echo $form->textFieldRow($model,'isbn',array('class'=>'span3')); ?>
    
    <?php echo $form->textFieldRow($model,'discipl',array('class'=>'span8')); ?>
    
    <?php echo $form->textFieldRow($model,'id_npo',array('class'=>'span8')); ?>
    
    <?php echo $form->textFieldRow($model,'id_spo',array('class'=>'span8')); ?>

<div class="form-actions">
    <?php $this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'submit', 'type'=>'primary', 'icon'=>'ok white', 'label'=>'Сохранить')); ?>
    <?php $this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'action', 'icon'=>'remove', 'label'=>'Отмена', 'url'=>$this->createUrl('metodmat/edit',array('id_rep'=>$model->id_report)))); ?>
</div>

<?php $this->endWidget(); ?>
