<?php
$po = array(
    'model'=>$model, // модель
    'attribute'=>'id_po', // атрибут модели
    'source' =>Yii::app()->createUrl('/complex/ws25/po_complete'),
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
    'id'=>'form2',
    'type'=>'horizontal',    
    'enableAjaxValidation'=>false,
    'htmlOptions' => array('enctype'=>'multipart/form-data'),
)); ?>

    <blockquote><em>Поля помеченные<span class="required"> * </span>обязательны для заполнения.</em></blockquote>
    
    <?php if(Yii::app()->user->hasFlash('error_mail')):?>
        <div class="alert alert-block alert-error">
            <?php echo Yii::app()->user->getFlash('error_mail'); ?>
        </div>
    <?php endif; ?>

    <?php if(Yii::app()->user->hasFlash('error_all')):?>
        <div class="alert alert-block alert-error">
            <?php echo Yii::app()->user->getFlash('error_all'); ?>
        </div>
    <?php endif; ?>             
    
    <h4 style="margin: 40px 0 20px 0;">Конкурсант</h4>

    <?php echo $form->errorSummary($models['contest']); ?>    
    
    <?php
    if(!$school) {
        echo $form->dropDownListRow($models['contest'],
                '[contest]id_cat',
                CHtml::listData(Ws25_cat::model()->findAll(array('order' => 'id ASC')), 'id', 'naim'),
                array('empty' => 'Выберите категорию',
                    'class' => 'span6',
                    'ajax' => array(
                        'type' => 'POST',
                        'url' => Yii::app()->createUrl('complex/ws25/loadcompet'),
                        'success' => 'function(data) {$("#compet").empty(); $("#compet").append(data);}',
                        'data' => array('id_cat' => 'js:this.value'),
                    )
                )
        );
    }    
    ?>    
    

    <div id="compet">     
        <?php echo $form->dropDownListRow($models['contest'], '[contest]id_compet', CHtml::listData(Ws25_compet::model()->get_compet($school, $id_comp, $act), 'id', 'naim'), array('empty'=>'Выберите компетенцию', 'class'=>'span6')); ?>        
    </div>         
    
    <?php echo $form->textFieldRow($models['contest'],'[contest]surname',array('class'=>'span3','maxlength'=>255)); ?>    

    <?php echo $form->textFieldRow($models['contest'],'[contest]name',array('class'=>'span3','maxlength'=>255)); ?>

    <?php echo $form->textFieldRow($models['contest'],'[contest]patr',array('class'=>'span3','maxlength'=>255)); ?>
    

    <div class="control-group">
            <?php echo $form->labelEx($models['contest'],'[contest]burthdate',array('class'=>'control-label')); ?>
            <div class="controls">    
            <?php $this->widget('zii.widgets.jui.CJuiDatePicker', array(
                        'options'=>array(
                            'showAnim'=>'fold',
                            'dateFormat'=>'dd.mm.yy',
                            'changeYear'=>true,
                            'yearRange'=>'1940:2048'
                        ),
                        'language' => 'ru',
                        'attribute'=>'[contest]burthdate',
                        'model' => $models['contest'],
                        'htmlOptions'=>array(
                            'size'=>8,
                            'class'=>'input-small'
                        ),
                        ));
            ?>  
            </div>
    </div>    
    
    <?php echo $form->textFieldRow($models['contest'],'[contest]pers_mail',array('class'=>'span3','maxlength'=>255)); ?>
    
    <div class="control-group ">
        <label class="control-label">Населенный пункт<span class="required">*</span></label>
        <div class="controls">
            <?php $this->widget('zii.widgets.jui.CJuiAutoComplete', array(
                'model'=>$models['contest'], // модель
                'attribute'=>'[contest]nas_punkt', // атрибут модели
                'source' =>Yii::app()->createUrl('/complex/ws25/so_complete'),
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
                ),
            )); ?>
        </div>
    </div>     

    <div class="control-group">
            <?php echo $form->labelEx($models['contest'],'[contest]lic_tel',array('class'=>'control-label')); ?>
            <div class="controls">+7     
            <?php echo $form->textField($models['contest'],'[contest]lic_code', array('class'=>'span1')); ?>
            <?php echo $form->textField($models['contest'],'[contest]lic_tel', array('class'=>'span2')); ?>
            </div>
    </div>

    <?php echo $form->dropDownListRow($models['contest'], '[contest]id_gr', CHtml::listData(Ws25_country::model()->findAll(array('order' => 'id ASC')), 'id', 'naim'), array('empty'=>'Выберите страну гражданства', 'class'=>'span6')); ?>    
    
    <?php echo $form->textFieldRow($models['contest'],'[contest]org_mail',array('class'=>'span3','maxlength'=>255)); ?>
    
    <?php
    if(!$school) {
    ?>    
    
    <div class="control-group ">
        <label class="control-label">Код и наименование специальности обучения<span class="required">*</span></label>
        <div class="controls">
            <?php $this->widget('zii.widgets.jui.CJuiAutoComplete', array(
                'model'=>$models['contest'], // модель
                'attribute'=>'[contest]id_po', // атрибут модели
                'source' =>Yii::app()->createUrl('/complex/ws25/po_complete'),
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
            )); ?>
        </div>
    </div> 
    
    <?php } ?>

    <?php echo $form->textFieldRow($models['contest'],'[contest]klass',array('class'=>'span3','maxlength'=>255)); ?>
    
    <?php echo $form->textFieldRow($models['contest'],'[contest]end_god',array('class'=>'span3','maxlength'=>255)); ?>
    
    <?php echo $form->textFieldRow($models['contest'],'[contest]per_surname',array('class'=>'span3','maxlength'=>255)); ?>    

    <?php echo $form->textFieldRow($models['contest'],'[contest]per_name',array('class'=>'span3','maxlength'=>255)); ?>

    <?php echo $form->textFieldRow($models['contest'],'[contest]per_patr',array('class'=>'span3','maxlength'=>255)); ?>

    <div class="control-group">
            <?php echo $form->labelEx($models['contest'],'[contest]per_tel',array('class'=>'control-label')); ?>
            <div class="controls">+7     
            <?php echo $form->textField($models['contest'],'[contest]per_code', array('class'=>'span1')); ?>
            <?php echo $form->textField($models['contest'],'[contest]per_tel', array('class'=>'span2')); ?>
            </div>
    </div>    

    <?php echo $form->dropDownListRow($models['contest'], '[contest]id_size', CHtml::listData(Ws25_size::model()->findAll(array('order' => 'id ASC')), 'id', 'naim'), array('empty'=>'Выберите размер одежды', 'class'=>'span6')); ?>        
    
    <?php echo $form->checkBoxRow($models['contest'],'[contest]housing'); ?>
    
    
    <?php if($models['contest']->sogl_r) { ?>
    <div class="control-group ">
        <label class="control-label" for="Ws25_part_contest_rabota">Загруженное согласие на обработку персональных данных</label>
        <div class="controls">
            <?php echo CHtml::link($models['contest']->sogl_r, array('ws25obsh/scandown', 'id'=>$models['contest']->id, 'type' => 1)); ?>
        </div>
    </div> 
    <?php } ?>      
    
    <h4 style="margin: 40px 0 20px 0;">Эксперт-наставник</h4>
    
    <?php echo $form->errorSummary($models['mentor']); ?>

    <?php echo $form->textFieldRow($models['mentor'],'[mentor]surname',array('class'=>'span3','maxlength'=>255)); ?>    

    <?php echo $form->textFieldRow($models['mentor'],'[mentor]name',array('class'=>'span3','maxlength'=>255)); ?>

    <?php echo $form->textFieldRow($models['mentor'],'[mentor]patr',array('class'=>'span3','maxlength'=>255)); ?>
    

    <div class="control-group">
            <?php echo $form->labelEx($models['mentor'],'burthdate',array('class'=>'control-label')); ?>
            <div class="controls">    
            <?php $this->widget('zii.widgets.jui.CJuiDatePicker', array(
                        'options'=>array(
                            'showAnim'=>'fold',
                            'dateFormat'=>'dd.mm.yy',
                            'changeYear'=>true,
                            'yearRange'=>'1940:2048'
                        ),
                        'language' => 'ru',
                        'attribute'=>'[mentor]burthdate',
                        'model' => $models['mentor'],
                        'htmlOptions'=>array(
                            'size'=>8,
                            'class'=>'input-small'
                        ),
                        ));
            ?>  
            </div>
    </div>    
    
    <?php echo $form->textFieldRow($models['mentor'],'[mentor]pers_mail',array('class'=>'span3','maxlength'=>255)); ?>   
    
    <div class="control-group ">
        <label class="control-label">Населенный пункт<span class="required">*</span></label>
        <div class="controls">
            <?php $this->widget('zii.widgets.jui.CJuiAutoComplete', array(
                'model'=>$models['mentor'], // модель
                'attribute'=>'[mentor]nas_punkt', // атрибут модели
                'source' =>Yii::app()->createUrl('/complex/ws25/so_complete'),
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
                ),
            )); ?>
        </div>
    </div>     

    <div class="control-group">
            <?php echo $form->labelEx($models['mentor'],'[mentor]lic_tel',array('class'=>'control-label')); ?>
            <div class="controls">+7     
            <?php echo $form->textField($models['mentor'],'[mentor]lic_code', array('class'=>'span1')); ?>
            <?php echo $form->textField($models['mentor'],'[mentor]lic_tel', array('class'=>'span2')); ?>
            </div>
    </div>

    <?php echo $form->dropDownListRow($models['mentor'], '[mentor]id_gr', CHtml::listData(Ws25_country::model()->findAll(array('order' => 'id ASC')), 'id', 'naim'), array('empty'=>'Выберите страну гражданства', 'class'=>'span6')); ?>    
    
    <?php echo $form->checkBoxRow($models['mentor'],'[mentor]ano_org'); ?>
    
    <?php echo $form->textFieldRow($models['mentor'],'[mentor]rabota',array('class'=>'span6','maxlength'=>255)); ?>
    
    <?php echo $form->textFieldRow($models['mentor'],'[mentor]org_mail',array('class'=>'span3','maxlength'=>255)); ?>

    <?php echo $form->textFieldRow($models['mentor'],'[mentor]dol',array('class'=>'span3','maxlength'=>255)); ?>

    <?php echo $form->dropDownListRow($models['mentor'], '[mentor]id_size', CHtml::listData(Ws25_size::model()->findAll(array('order' => 'id ASC')), 'id', 'naim'), array('empty'=>'Выберите размер одежды', 'class'=>'span6')); ?>        
    
    <?php echo $form->checkBoxRow($models['mentor'],'[mentor]housing'); ?>
    
    <p>
        <strong>
            <em>
            Прикрепите скан-копию согласия на обработку персональных данных<br>
            (файл размером не более 5Мб в формате pdf, zip или изображение в формате jpg, gif, png, jpeg).<br>
            Для замены файла, просто прикрепите другой файл и нажмите сохранить.
            </em>
        </strong>
    </p>    
    
    <?php if($models['mentor']->sogl_r) { ?>
    <div class="control-group ">
        <label class="control-label" for="Ws25_part_mentor_rabota">Загруженное согласие на обработку персональных данных</label>
        <div class="controls">
            <?php echo CHtml::link($models['mentor']->sogl_r, array('ws25obsh/scandown', 'id'=>$models['mentor']->id, 'type' => 1)); ?>
        </div>
    </div> 
    <?php } ?>         
    
    <?php if($models['mentor']->exp_r) { ?>
    <div class="control-group ">
        <label class="control-label" for="Ws25_part_rabota">Загруженные документы, подтверждающие наличие у эксперта-наставника официальной и(или) признанной квалификации</label>
        <div class="controls">
            <?php echo CHtml::link($models['mentor']->exp_r, array('ws25obsh/scandown', 'id'=>$models['mentor']->id, 'type' => 2)); ?>
        </div>
    </div> 
    <?php } ?>      
    
    <div class="control-group ">
        <label class="control-label required" for="Ws25_part_mentor_file2">Документы, подтверждающие наличие у эксперта-наставника официальной и(или) признанной квалификации<span class="required">*</span></label>
        <div class="controls">
            <?php echo $form->fileField($models['mentor'], '[mentor]file2'); ?> 
        </div>    
    </div>    
    
    <h4 style="margin: 40px 0 20px 0;">Сопровождающий</h4>
    
    <?php echo $form->errorSummary($models['accomp']); ?>

    <?php echo $form->textFieldRow($models['accomp'],'[accomp]surname',array('class'=>'span3','maxlength'=>255)); ?>    

    <?php echo $form->textFieldRow($models['accomp'],'[accomp]name',array('class'=>'span3','maxlength'=>255)); ?>

    <?php echo $form->textFieldRow($models['accomp'],'[accomp]patr',array('class'=>'span3','maxlength'=>255)); ?>
    

    <div class="control-group">
            <?php echo $form->labelEx($models['accomp'],'burthdate',array('class'=>'control-label')); ?>
            <div class="controls">    
            <?php $this->widget('zii.widgets.jui.CJuiDatePicker', array(
                        'options'=>array(
                            'showAnim'=>'fold',
                            'dateFormat'=>'dd.mm.yy',
                            'changeYear'=>true,
                            'yearRange'=>'1940:2048'
                        ),
                        'language' => 'ru',
                        'attribute'=>'[accomp]burthdate',
                        'model' => $models['accomp'],
                        'htmlOptions'=>array(
                            'size'=>8,
                            'class'=>'input-small'
                        ),
                        ));
            ?>  
            </div>
    </div>    
    
    <?php echo $form->textFieldRow($models['accomp'],'[accomp]pers_mail',array('class'=>'span3','maxlength'=>255)); ?>
    
    <div class="control-group ">
        <label class="control-label">Населенный пункт<span class="required">*</span></label>
        <div class="controls">
            <?php $this->widget('zii.widgets.jui.CJuiAutoComplete', array(
                'model'=>$models['accomp'], // модель
                'attribute'=>'[accomp]nas_punkt', // атрибут модели
                'source' =>Yii::app()->createUrl('/complex/ws25/so_complete'),
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
                ),
            )); ?>
        </div>
    </div> 

    <div class="control-group">
            <?php echo $form->labelEx($models['accomp'],'[accomp]lic_tel',array('class'=>'control-label')); ?>
            <div class="controls">+7     
            <?php echo $form->textField($models['accomp'],'[accomp]lic_code', array('class'=>'span1')); ?>
            <?php echo $form->textField($models['accomp'],'[accomp]lic_tel', array('class'=>'span2')); ?>
            </div>
    </div>

    <?php echo $form->dropDownListRow($models['accomp'], '[accomp]id_gr', CHtml::listData(Ws25_country::model()->findAll(array('order' => 'id ASC')), 'id', 'naim'), array('empty'=>'Выберите страну гражданства', 'class'=>'span6')); ?>    
    
    <?php echo $form->checkBoxRow($models['accomp'],'[accomp]ano_org'); ?>
    
    <?php echo $form->textFieldRow($models['accomp'],'[accomp]rabota',array('class'=>'span6','maxlength'=>255)); ?>
    
    <?php echo $form->textFieldRow($models['accomp'],'[accomp]org_mail',array('class'=>'span3','maxlength'=>255)); ?>

    <?php echo $form->textFieldRow($models['accomp'],'[accomp]dol',array('class'=>'span3','maxlength'=>255)); ?>

    <?php echo $form->dropDownListRow($models['accomp'], '[accomp]id_size', CHtml::listData(Ws25_size::model()->findAll(array('order' => 'id ASC')), 'id', 'naim'), array('empty'=>'Выберите размер одежды', 'class'=>'span6')); ?>        
    
    <?php echo $form->checkBoxRow($models['accomp'],'[accomp]housing'); ?>    
    
    <?php if($models['accomp']->sogl_r) { ?>
    <div class="control-group ">
        <label class="control-label" for="Ws25_part_accomp_rabota">Загруженное согласие на обработку персональных данных</label>
        <div class="controls">
            <?php echo CHtml::link($models['accomp']->sogl_r, array('ws25obsh/scandown', 'id'=>$models['accomp']->id, 'type' => 1)); ?>
        </div>
    </div> 
    <?php } ?>        
    

<div class="form-actions">
    <?php $this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'submit', 'type'=>'primary', 'icon'=>'ok white', 'label'=>'Сохранить')); ?>
    <?php $this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'action', 'icon'=>'remove', 'label'=>'Отмена', 'url'=>$this->createUrl('ws25obsh/index',array('id_comp'=>$models['contest']->report->ws25->id)))); ?>
</div>

<?php $this->endWidget(); ?>

<script type="text/javascript"> 
$(function(){
   
});

$('#Ws25_part_mentor_ano_org').change(function () {
    if($(this).is(':checked')) {
        $('#Ws25_part_mentor_rabota').removeAttr('disabled', '');
    }
    else {
        $('#Ws25_part_mentor_rabota').attr('disabled', '');       
    }
});
$('#Ws25_part_accomp_ano_org').change(function () {
    if($(this).is(':checked')) {
        $('#Ws25_part_accomp_rabota').removeAttr('disabled', '');
    }
    else {
        $('#Ws25_part_accomp_rabota').attr('disabled', '');       
    }
});

$(function(){
    var birthDate = $('#Ws25_part_contest_burthdate').val();
    if(birthDate) {
        var over18 = isOver18(birthDate);
        $('#Ws25_part_accomp_name, #Ws25_part_accomp_patr, #Ws25_part_accomp_surname, #Ws25_part_accomp_burthdate, #Ws25_part_accomp_pers_mail, #Ws25_part_accomp_nas_punkt, #Ws25_part_accomp_lic_code, #Ws25_part_accomp_lic_tel, #Ws25_part_accomp_id_gr, #Ws25_part_accomp_ano_org, #Ws25_part_accomp_rabota, #Ws25_part_accomp_org_mail, #Ws25_part_accomp_dol, #Ws25_part_accomp_id_size, #Ws25_part_accomp_housing, #Ws25_part_accomp_file1').prop('disabled', over18);
    }  
});
$('#Ws25_part_contest_burthdate').change(function() {
    var birthDate = $(this).val();
    if(birthDate) {
        var over18 = isOver18(birthDate);
        $('#Ws25_part_accomp_name, #Ws25_part_accomp_patr, #Ws25_part_accomp_surname, #Ws25_part_accomp_burthdate, #Ws25_part_accomp_pers_mail, #Ws25_part_accomp_nas_punkt, #Ws25_part_accomp_lic_code, #Ws25_part_accomp_lic_tel, #Ws25_part_accomp_id_gr, #Ws25_part_accomp_ano_org, #Ws25_part_accomp_rabota, #Ws25_part_accomp_org_mail, #Ws25_part_accomp_dol, #Ws25_part_accomp_id_size, #Ws25_part_accomp_housing, #Ws25_part_accomp_file1').prop('disabled', over18);
    }
});

$(document).ready(function() {
    if($('#Ws25_part_mentor_ano_org').is(':not(:checked)')) {
        $('#Ws25_part_mentor_rabota').attr('disabled', '');
    }
    if($('#Ws25_part_accomp_ano_org').is(':not(:checked)')) {
        $('#Ws25_part_accomp_rabota').attr('disabled', '');
    }     
});
    
function isOver18(birthDate) {
    var today = new Date();
    var birthDate = new Date(birthDate);
    var age = today.getFullYear() - birthDate.getFullYear();
    var m = today.getMonth() - birthDate.getMonth();
    if (m < 0 || (m === 0 && today.getDate() < birthDate.getDate())) {
        age--;
    }
    return age >= 18;
}
</script>     