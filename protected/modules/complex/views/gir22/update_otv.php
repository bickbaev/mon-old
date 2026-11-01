<legend>Информация об ответственном от образовательной организации за работу с обучающимися с высокими образовательными результатами, а также за взаимодействие с образовательными организациями высшего образования</legend>
<?php
$form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
    'id'=>'gir-otv-form',
    'type'=>'horizontal',    
    'enableAjaxValidation'=>false,
    'htmlOptions' => array('enctype'=>'multipart/form-data'),    
)); ?>

    <blockquote><em>Поля помеченные<span class="required"> * </span>обязательны для заполнения.</em></blockquote>

    <?php echo $form->errorSummary($model); ?>
    
    <?php echo $form->hiddenField($model, 'id_report') ?>

    <?php echo $form->textFieldRow($model, 'sur',array('class'=>'span5','maxlength'=>255)); ?>

    <?php echo $form->textFieldRow($model, 'name',array('class'=>'span5','maxlength'=>255)); ?>
    
    <?php echo $form->textFieldRow($model, 'par',array('class'=>'span5','maxlength'=>255)); ?>
    
    <?php echo $form->textFieldRow($model, 'dol',array('class'=>'span5','maxlength'=>255)); ?>
    
    <?php echo $form->textFieldRow($model, 'mail',array('class'=>'span5','maxlength'=>255)); ?>
    
    <div class="control-group">
            <?php echo $form->labelEx($model,'phone',array('class'=>'control-label')); ?>
            <div class="controls">
            8(<?php echo $form->textField($model,'cod_phone', array('class'=>'span1')); ?>)
            <?php echo $form->textField($model,'phone', array('size'=>6, 'class'=>'span2')); ?>
            </div>
    </div>     

    <div class="form-actions">
    <?php $this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'submit', 'type'=>'primary', 'icon'=>'ok white', 'label'=>'Сохранить')); ?>
    <?php $this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'action', 'icon'=>'remove', 'label'=>'Отмена', 'url'=>$this->createUrl('gir22/edit',array('id_rep'=>$model->id_report)))); ?>
</div>

<?php $this->endWidget(); ?>  