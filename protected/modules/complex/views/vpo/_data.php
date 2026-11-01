<?php
$vpo = array(
    'model'=>$model, // модель
    'attribute'=>'code_vpo', // атрибут модели
    'source' =>Yii::app()->createUrl('/complex/vpo/po_complete'),
    'options'=>array(
        'minLength'=>'2',
        'showAnim'=>'fold',
        'select' =>'js: function(event, ui) {
            this.value = ui.item.value;
            return false;
        }',
    ),
    'htmlOptions' => array(
        'class'=>'span3',
        'placeholder'=>'Код специальности'
    ),
);

$form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
    'id'=>'vpo-data-form',
    'type'=>'horizontal',    
    'enableAjaxValidation'=>false,
)); ?>

    <blockquote><em>Поля помеченные<span class="required"> * </span>обязательны для заполнения.</em></blockquote>
    
    <?php echo $form->errorSummary($model); ?>
    
    <div class="control-group ">
        <label class="control-label">Код специальности<span class="required">*</span></label>
        <div class="controls">
            <?php $this->widget('zii.widgets.jui.CJuiAutoComplete', $vpo); ?>
        </div>
    </div> 
    
    <?php echo $form->textFieldRow($model,'profil',array('class'=>'span7','maxlength'=>255)); ?>
    
    <?php echo $form->dropDownListRow($model, 'id_forma', CHtml::listData(Vpo_forma::model()->findAll(array('order' => 'vpo_forma ASC')), 'vpo_forma', 'vpo_prog_naim'), array('empty'=>'Выберите форму обучения')); ?>
    
    <?php echo $form->textFieldRow($model,'srok',array('class'=>'span2','maxlength'=>4)); ?> 
    
    <?php echo $form->textFieldRow($model,'bud',array('class'=>'span2','maxlength'=>4)); ?>
    
    <?php echo $form->textFieldRow($model,'vbud',array('class'=>'span2','maxlength'=>4)); ?>    
    
    <?php echo $form->textFieldRow($model,'stoim',array('class'=>'span2','maxlength'=>9)); ?>    
    
    <?php //echo $form->checkBoxRow($model,'budget'); ?>
    
    <?php echo $form->checkBoxRow($model,'war'); ?>
    
    <?php //echo $form->textFieldRow($model,'zdorov',array('class'=>'span7','maxlength'=>255)); ?>
    
    <h5 style="margin-left: 30px;">Необходимые предметы ЕГЭ или собеседование<span class="required">*</span></h5>
    
    <?php echo $form->checkBoxRow($model,'pr1'); ?>
    
    <?php echo $form->checkBoxRow($model,'pr2'); ?>
    
    <?php echo $form->checkBoxRow($model,'pr3'); ?>
    
    <?php echo $form->checkBoxRow($model,'pr4'); ?>
    
    <?php echo $form->checkBoxRow($model,'pr5'); ?>
    
    <?php echo $form->checkBoxRow($model,'pr6'); ?>
    
    <?php echo $form->checkBoxRow($model,'pr7'); ?>
    
    <?php echo $form->checkBoxRow($model,'pr8'); ?>
    
    <?php echo $form->checkBoxRow($model,'pr9'); ?>
    
    <?php echo $form->checkBoxRow($model,'pr10'); ?>
    
    <?php echo $form->checkBoxRow($model,'pr11'); ?>
    
    <?php echo $form->checkBoxRow($model,'pr12'); ?> 
    
    <?php echo $form->checkBoxRow($model,'pr13'); ?>
    
    <?php echo $form->checkBoxRow($model,'pr14'); ?>
    
    <?php echo $form->textFieldRow($model,'link',array('class'=>'span7','maxlength'=>255)); ?>    
    
<div class="form-actions">
    <?php $this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'submit', 'type'=>'primary', 'icon'=>'ok white', 'label'=>'Сохранить')); ?>
    <?php $this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'action', 'icon'=>'remove', 'label'=>'Отмена', 'url'=>$this->createUrl('vpo/edit_faculty',array('id_faculty'=>$model->id_faculty)))); ?>
</div>

<?php $this->endWidget(); ?>    

