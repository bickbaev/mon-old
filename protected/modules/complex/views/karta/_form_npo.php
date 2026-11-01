<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
    'id'=>'karta-npo-form',
    'type'=>'horizontal',    
    'enableAjaxValidation'=>false,
)); ?>

    <blockquote><em>Поля помеченные<span class="required"> * </span>обязательны для заполнения.</em></blockquote>

    <?php echo $form->errorSummary($model); ?>
    
    <?php //echo $form->textFieldRow($model,'id_npo',array('class'=>'span2','maxlength'=>9)); ?> 
    <div class="control-group">
            <?php echo $form->labelEx($model,'id_npo',array('class'=>'control-label')); ?>
            <div class="controls">
            <?php echo $form->textField($model,'id_npo',array('class'=>'span2','maxlength'=>9)); ?>
            <span class="help-inline" id="npo"></span>
            </div>
    </div>    
    
    <?php echo $form->dropDownListRow($model, 'npo_prog', CHtml::listData(Karta_npo_prog::model()->findAll(array('order' => 'npo_prog ASC')), 'npo_prog', 'npo_prog_naim'), array('empty'=>'Выберите программу', 'class'=>'span6')); ?>
    
    <?php echo $form->dropDownListRow($model, 'npo_forma', CHtml::listData(Karta_npo_forma::model()->findAll(array('order' => 'npo_forma ASC')), 'npo_forma', 'npo_prog_naim'), array('empty'=>'Выберите форму обучения', 'class'=>'span5')); ?>
    
    <?php echo $form->dropDownListRow($model, 'npo_oplata', CHtml::listData(Karta_npo_oplata::model()->findAll(array('order' => 'npo_oplata ASC')), 'npo_oplata', 'npo_prog_naim'), array('empty'=>'Выберите вариант оплаты за обучения', 'class'=>'span5')); ?>

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
    if($('#Karta_npo_obsh').is(':not(:checked)')) {
        $('#Karta_npo_address').attr('disabled', '');
    }   
});

$("#Karta_npo_id_npo").change(function(){
    var cat = $('#Karta_npo_id_npo').val();
    $.post('/index.php?r=/complex/karta/p_npo',{data:cat},
    function(data){
      $('#npo').html(data);
    });        
}); 

$('#Karta_npo_obsh').change(function () {
    if($(this).is(':checked')) {
        $('#Karta_npo_address').removeAttr('disabled', '');
    }
    else {
        $('#Karta_npo_address').attr('disabled', '');       
    }
});
</script>    
