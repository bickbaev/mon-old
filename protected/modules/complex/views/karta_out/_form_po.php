<?php
$po = array(
    'model'=>$model, // модель
    'attribute'=>'id_po', // атрибут модели
    'source' =>Yii::app()->createUrl('/complex/karta/po_complete'),
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
        'placeholder'=>'Код профессии/специальности'
    ),
);
$form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
    'id'=>'karta-out-po-form',
    'type'=>'horizontal',    
    'enableAjaxValidation'=>false,
)); ?>

    <blockquote><em>Поля помеченные<span class="required"> * </span>обязательны для заполнения.</em></blockquote>

    <?php echo $form->errorSummary($model); ?>
    
    <div class="control-group ">
        <label class="control-label">Код проф./специальности<span class="required">*</span></label>
        <div class="controls">
            <?php $this->widget('zii.widgets.jui.CJuiAutoComplete', $po); ?>
        </div>
    </div>   
    
    <div class="control-group">
            <label class="control-label">Выпуск в <?php echo $year1; ?> г. (чел.)</label>
            <div class="controls">    
            <?php echo $form->textField($model,'year1',array('class'=>'input-small','maxlength'=>6)); ?>   
            </div>
    </div>
    
    <div class="control-group">
            <label class="control-label">Выпуск в <?php echo $year1+1; ?> г. (чел.)</label>
            <div class="controls">    
            <?php echo $form->textField($model,'year2',array('class'=>'input-small','maxlength'=>6)); ?>   
            </div>
    </div>
    
    <div class="control-group">
            <label class="control-label">Выпуск в <?php echo $year1+2; ?> г. (чел.)</label>
            <div class="controls">    
            <?php echo $form->textField($model,'year3',array('class'=>'input-small','maxlength'=>6)); ?>   
            </div>
    </div>
    
    <div class="control-group">
            <label class="control-label">Выпуск в <?php echo $year1+3; ?> г. (чел.)</label>
            <div class="controls">    
            <?php echo $form->textField($model,'year4',array('class'=>'input-small','maxlength'=>6)); ?>   
            </div>
    </div>

<div class="form-actions">
    <?php $this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'submit', 'type'=>'primary', 'icon'=>'ok white', 'label'=>'Сохранить')); ?>
    <?php $this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'action', 'icon'=>'remove', 'label'=>'Отмена', 'url'=>$this->createUrl('karta_out/edit',array('id_rep'=>$model->id_report)))); ?>
</div>

<?php $this->endWidget(); ?> 


