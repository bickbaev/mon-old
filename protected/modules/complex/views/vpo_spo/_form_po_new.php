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
    'id'=>'karta-spo-form',
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
    
    <?php echo $form->dropDownListRow($model, 'po_prog', CHtml::listData(Karta_spo_prog::model()->findAll(array('order' => 'spo_prog ASC')), 'spo_prog', 'spo_prog_naim'), array('empty'=>'Выберите программу', 'class'=>'span6')); ?>
    
    <?php echo $form->dropDownListRow($model, 'po_forma', CHtml::listData(Karta_spo_forma::model()->findAll(array('order' => 'spo_forma ASC')), 'spo_forma', 'spo_prog_naim'), array('empty'=>'Выберите форму обучения', 'class'=>'span5')); ?>
    
    <?php echo $form->dropDownListRow($model, 'po_oplata', CHtml::listData(Karta_spo_oplata::model()->findAll(array('order' => 'spo_oplata ASC')), 'spo_oplata', 'spo_prog_naim'), array('empty'=>'Выберите вариант оплаты за обучения', 'class'=>'span5')); ?>

    <?php echo $form->textFieldRow($model,'srok',array('class'=>'span1')); ?>

    <div class="control-group">
            <?php echo $form->labelEx($model,'nachalo',array('class'=>'control-label')); ?>
            <div class="controls">    
            <?php $this->widget('zii.widgets.jui.CJuiDatePicker', array(
                        'options'=>array(
                            'showAnim'=>'fold',
                            'dateFormat'=>'dd.mm.yy',
                            'changeYear'=>true,
                            'yearRange'=>'1990:2028'
                        ),
                        'language' => 'ru',
                        'attribute'=>'nachalo',
                        'model' => $model,
                        'htmlOptions'=>array(
                            'size'=>8,
                            'class'=>'input-small'
                        ),
                        ));
            ?>  
            </div>
    </div>

    <?php //echo $form->textFieldRow($model,'zdorov',array('class'=>'span5','maxlength'=>255)); ?>

    <?php echo $form->checkBoxRow($model,'obsh'); ?>

    <?php echo $form->textFieldRow($model,'address',array('class'=>'span5','maxlength'=>255)); ?>

    <?php echo $form->checkBoxRow($model,'kurs'); ?>

    <?php echo $form->textFieldRow($model,'link',array('class'=>'span5','maxlength'=>255)); ?>

<div class="form-actions">
    <?php $this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'submit', 'type'=>'primary', 'icon'=>'ok white', 'label'=>'Сохранить')); ?>
    <?php $this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'action', 'icon'=>'remove', 'label'=>'Отмена', 'url'=>$this->createUrl('vpo_spo/edit',array('id_rep'=>$model->id_report)))); ?>
</div>

<?php $this->endWidget(); ?>

<script type="text/javascript"> 
$(function(){
    if($('#Karta_po_new_obsh').is(':not(:checked)')) {
        $('#Karta_po_new_address').attr('disabled', '');
    }   
});

$('#Karta_po_new_obsh').change(function () {
    if($(this).is(':checked')) {
        $('#Karta_po_new_address').removeAttr('disabled', '');
    }
    else {
        $('#Karta_po_new_address').attr('disabled', '');       
    }
});
</script>    

