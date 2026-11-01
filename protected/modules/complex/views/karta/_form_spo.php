<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
    'id'=>'karta-spo-form',
    'type'=>'horizontal',    
    'enableAjaxValidation'=>false,
)); ?>

    <blockquote><em>Поля помеченные<span class="required"> * </span>обязательны для заполнения.</em></blockquote>

    <?php echo $form->errorSummary($model); ?>
    
    <div class="control-group">
            <?php echo $form->labelEx($model,'id_spo',array('class'=>'control-label')); ?>
            <div class="controls">
            <?php echo $form->textField($model,'id_spo',array('class'=>'span2','maxlength'=>9)); ?>
            <span class="help-inline" id="spo"></span>
            </div>
    </div>    
    
    <?php echo $form->dropDownListRow($model, 'spo_prog', CHtml::listData(Karta_spo_prog::model()->findAll(array('order' => 'spo_prog ASC')), 'spo_prog', 'spo_prog_naim'), array('empty'=>'Выберите программу', 'class'=>'span6')); ?>
    
    <?php echo $form->dropDownListRow($model, 'spo_forma', CHtml::listData(Karta_spo_forma::model()->findAll(array('order' => 'spo_forma ASC')), 'spo_forma', 'spo_prog_naim'), array('empty'=>'Выберите форму обучения', 'class'=>'span5')); ?>
    
    <?php echo $form->dropDownListRow($model, 'spo_oplata', CHtml::listData(Karta_spo_oplata::model()->findAll(array('order' => 'spo_oplata ASC')), 'spo_oplata', 'spo_prog_naim'), array('empty'=>'Выберите вариант оплаты за обучения', 'class'=>'span5')); ?>

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

    <?php echo $form->textFieldRow($model,'zdorov',array('class'=>'span5','maxlength'=>255)); ?>

    <?php echo $form->checkBoxRow($model,'obsh'); ?>

    <?php echo $form->textFieldRow($model,'address',array('class'=>'span5','maxlength'=>255)); ?>

    <?php echo $form->checkBoxRow($model,'kurs'); ?>

    <?php echo $form->textFieldRow($model,'link',array('class'=>'span5','maxlength'=>255)); ?>

<div class="form-actions">
    <?php $this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'submit', 'type'=>'primary', 'icon'=>'ok white', 'label'=>'Сохранить')); ?>
    <?php $this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'action', 'icon'=>'remove', 'label'=>'Отмена', 'url'=>$this->createUrl('karta/edit',array('id_rep'=>$model->id_report)))); ?>
</div>

<?php $this->endWidget(); ?>

<script type="text/javascript"> 
$(function(){
    if($('#Karta_spo_obsh').is(':not(:checked)')) {
        $('#Karta_spo_address').attr('disabled', '');
    }   
});

$("#Karta_spo_id_spo").change(function(){
    var cat = $('#Karta_spo_id_spo').val();
    $.post('/index.php?r=/complex/karta/p_spo',{data:cat},
    function(data){
      $('#spo').html(data);
    });        
}); 

$('#Karta_spo_obsh').change(function () {
    if($(this).is(':checked')) {
        $('#Karta_spo_address').removeAttr('disabled', '');
    }
    else {
        $('#Karta_spo_address').attr('disabled', '');       
    }
});
</script>    
