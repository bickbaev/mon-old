<fieldset><legend>Редактирование информации об ответственном за программы профессионального обучения</legend></fieldset>
<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
    'id'=>'ov-info-form',
    'type'=>'horizontal',    
    'enableAjaxValidation'=>false,
)); ?>

    <blockquote><em>Поля помеченные<span class="required"> * </span>обязательны для заполнения.</em></blockquote>

    <?php echo $form->errorSummary($model); ?>
    
    <?php echo $form->hiddenField($model, 'id_report') ?>

    <?php echo $form->textFieldRow($model,'fio_otv',array('class'=>'span3','maxlength'=>255)); ?>

    <div class="control-group ">
            <?php echo $form->labelEx($model,'tel', array('class'=>'control-label')); ?>
            <div class="controls">
            8(<?php echo $form->textField($model,'cod_tel', array('class'=>'span1')); ?>)
            <?php echo $form->textField($model,'tel', array('class'=>'span2')); ?>
            </div>
    </div>
    <?php echo $form->textFieldRow($model,'mail',array('class'=>'span3','maxlength'=>255)); ?> 

<div class="form-actions">
    <?php $this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'submit', 'type'=>'primary', 'icon'=>'ok white', 'label'=>'Сохранить')); ?>
    <?php $this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'action', 'label'=>'Отмена', 'url'=>Yii::app()->createUrl("complex/ov/edit", array("id_rep"=>$model->id_report)))); ?>
</div>

<?php $this->endWidget(); ?>