<?php
$form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
    'id'=>'zpmp-form',
    'type'=>'horizontal',    
    'enableAjaxValidation'=>false,
    'htmlOptions' => array('enctype'=>'multipart/form-data'),    
)); ?>

    <blockquote><em>Поля помеченные<span class="required"> * </span>обязательны для заполнения.</em></blockquote>
    
    <p><strong>Информация о родителе (законном представителе), проходящем военную службу</strong></p>

    <?php echo $form->errorSummary($model); ?>
    
    <?php echo $form->hiddenField($model, 'id_report') ?>
    
    <?php echo $form->textFieldRow($model, 'pok1',array('class'=>'span2','maxlength'=>255)); ?>
    
    <?php echo $form->textFieldRow($model, 'pok2',array('class'=>'span2','maxlength'=>255)); ?>
    
    <?php echo $form->textFieldRow($model, 'pok3',array('class'=>'span2','maxlength'=>255)); ?>
    
    <div class="control-group">
            <?php echo $form->labelEx($model,'pok4',array('class'=>'control-label')); ?>
            <div class="controls">    
            <?php $this->widget('zii.widgets.jui.CJuiDatePicker', array(
                        'options'=>array(
                            'showAnim'=>'fold',
                            'dateFormat'=>'dd.mm.yy',
                            'changeYear'=>true,
                            'yearRange'=>'1950:2007'
                        ),
                        'language' => 'ru',
                        'attribute'=>'pok4',
                        'model' => $model,
                        'htmlOptions'=>array(
                            'size'=>8,
                            'class'=>'input-small'
                        ),
                        ));
            ?>  
            </div>
    </div>
    
    <?php echo $form->DropDownListRow($model,'pok14', CHtml::listData(Zpmp_type::model()->findAll(array('order' => 'id_type ASC')), 'id_type', 'naim_type'), array('empty'=>'Выберите вариант', 'class'=>'span2')); ?>
    
    <p><strong>Сведения об адресе регистрации родителя (законного представителя), проходящего военную службу.<br>Если родитель (законный представитель) зарегистрирован не в Самарской области, поставьте галочку "Муниципалитет другого региона РФ", выберите регион и заполните название муниципалитета.</strong></p>

    <?php echo $form->DropDownListRow($model, 'pok5', CHtml::listData(Mun::model()->findAll(array('order' => 'id_mun ASC')), 'id_mun', 'naim_mun'), array('empty'=>'Выберите вариант', 'class'=>'span4', 'disabled'=>$blk)); ?>
    
    <?php echo $form->checkBoxRow($model,'pok17');?>

    <?php echo $form->DropDownListRow($model, 'pok18', CHtml::listData(Region::model()->findAll(array('order' => 'id_region ASC')), 'id_region', 'naim_region'), array('empty'=>'Выберите вариант', 'class'=>'span4')); ?>
    
    <?php echo $form->textFieldRow($model,'pok19', array('class'=>'span5')); ?>    
    
    <?php echo $form->DropDownListRow($model, 'pok6', CHtml::listData(Contact_gor::model()->findAll(array('order' => 'id_contact_gor ASC')), 'id_contact_gor', 'naim_gor'), array('empty'=>'Выберите вариант', 'class'=>'span4', 'disabled'=>$blk)); ?>

    <?php echo $form->textFieldRow($model,'pok7', array('class'=>'span5', 'disabled'=>$blk)); ?>

    <?php echo $form->DropDownListRow($model, 'pok8', CHtml::listData(Contact_ul::model()->findAll(array('order' => 'id_contact_ul ASC')), 'id_contact_ul', 'naim_ul'), array('empty'=>'Выберите вариант', 'class'=>'span4')); ?>

    <?php echo $form->textFieldRow($model,'pok9', array('class'=>'span5')); ?>

    <?php echo $form->textFieldRow($model,'pok10', array('class'=>'span1')); ?>
    
    <?php echo $form->textFieldRow($model,'pok11', array('class'=>'span1')); ?>
        

<div class="form-actions">
    <?php $this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'submit', 'type'=>'primary', 'icon'=>'ok white', 'label'=>'Сохранить')); ?>
    <?php $this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'action', 'icon'=>'remove', 'label'=>'Отмена', 'url'=>$this->createUrl('zpmp_school_2022/edit',array('id_rep'=>$model->id_report)))); ?>
</div>

<?php $this->endWidget(); ?>      
<script>
$(document).ready(function(){
    if($('#Zpmp_school_2022_pok5').val() < 11 && $('#Zpmp_school_2022_pok5').val() > 0) {     
        $('#Zpmp_school_2022_pok6').attr('disabled', '');
        $('#Zpmp_school_2022_pok7').attr('disabled', '');
    }
    else {     
        $('#Zpmp_school_2022_pok6').removeClass('disabled');
        $('#Zpmp_school_2022_pok6').removeAttr('disabled');
        $('#Zpmp_school_2022_pok7').removeClass('disabled');
        $('#Zpmp_school_2022_pok7').removeAttr('disabled');         
    }
    if($('#Zpmp_school_2022_pok17').prop("checked")) {
        $('#Zpmp_school_2022_pok5').val("");
        $('#Zpmp_school_2022_pok5').attr('class', 'disabled');
        $('#Zpmp_school_2022_pok5').attr('class', 'span4');
        $('#Zpmp_school_2022_pok5').attr('disabled', '');
        $('#Zpmp_school_2022_pok18').removeClass('disabled');
        $('#Zpmp_school_2022_pok18').removeAttr('disabled'); 
        $('#Zpmp_school_2022_pok19').removeClass('disabled');
        $('#Zpmp_school_2022_pok19').removeAttr('disabled');          
    }
    else {         
        $('#Zpmp_school_2022_pok5').removeClass('disabled');
        $('#Zpmp_school_2022_pok5').removeAttr('disabled');
        $('#Zpmp_school_2022_pok18').val("");
        $('#Zpmp_school_2022_pok18').attr('class', 'disabled');
        $('#Zpmp_school_2022_pok18').attr('class', 'span4');
        $('#Zpmp_school_2022_pok18').attr('disabled', '');
        $('#Zpmp_school_2022_pok19').val("");
        $('#Zpmp_school_2022_pok19').attr('class', 'disabled');
        $('#Zpmp_school_2022_pok19').attr('class', 'span5');
        $('#Zpmp_school_2022_pok19').attr('disabled', '');         
    }    
});    
$('#Zpmp_school_2022_pok5').change(function () {
    if($(this).val() < 11) {
        $('#Zpmp_school_2022_pok6').val("");
        $('#Zpmp_school_2022_pok6').attr('class', 'disabled');
        $('#Zpmp_school_2022_pok6').attr('class', 'span4');
        $('#Zpmp_school_2022_pok6').attr('disabled', '');
        $('#Zpmp_school_2022_pok7').val("");
        $('#Zpmp_school_2022_pok7').attr('class', 'disabled');
        $('#Zpmp_school_2022_pok7').attr('class', 'span5');
        $('#Zpmp_school_2022_pok7').attr('disabled', '');        
    }
    else {
        $('#Zpmp_school_2022_pok6').removeClass('disabled');
        $('#Zpmp_school_2022_pok6').removeAttr('disabled'); 
        $('#Zpmp_school_2022_pok7').removeClass('disabled');
        $('#Zpmp_school_2022_pok7').removeAttr('disabled');         
    }
});
$('#Zpmp_school_2022_pok17').change(function () {
    if($(this).prop("checked")) {
        $('#Zpmp_school_2022_pok5').val("");
        $('#Zpmp_school_2022_pok5').attr('class', 'disabled');
        $('#Zpmp_school_2022_pok5').attr('class', 'span4');
        $('#Zpmp_school_2022_pok5').attr('disabled', '');
        $('#Zpmp_school_2022_pok18').removeClass('disabled');
        $('#Zpmp_school_2022_pok18').removeAttr('disabled'); 
        $('#Zpmp_school_2022_pok19').removeClass('disabled');
        $('#Zpmp_school_2022_pok19').removeAttr('disabled');
        $('#Zpmp_school_2022_pok6').removeClass('disabled');
        $('#Zpmp_school_2022_pok6').removeAttr('disabled'); 
        $('#Zpmp_school_2022_pok7').removeClass('disabled');
        $('#Zpmp_school_2022_pok7').removeAttr('disabled');        
    }
    else {         
        $('#Zpmp_school_2022_pok5').removeClass('disabled');
        $('#Zpmp_school_2022_pok5').removeAttr('disabled');
        $('#Zpmp_school_2022_pok18').val("");
        $('#Zpmp_school_2022_pok18').attr('class', 'disabled');
        $('#Zpmp_school_2022_pok18').attr('class', 'span4');
        $('#Zpmp_school_2022_pok18').attr('disabled', '');
        $('#Zpmp_school_2022_pok19').val("");
        $('#Zpmp_school_2022_pok19').attr('class', 'disabled');
        $('#Zpmp_school_2022_pok19').attr('class', 'span5');
        $('#Zpmp_school_2022_pok19').attr('disabled', '');         
    }
});
</script> 
