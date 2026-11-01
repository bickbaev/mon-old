<?php
$form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
    'id'=>'form2',
    'type'=>'horizontal',    
    'enableAjaxValidation'=>false,
    'htmlOptions' => array('enctype'=>'multipart/form-data'),
)); ?>

    <blockquote><em>Поля помеченные<span class="required"> * </span>обязательны для заполнения.</em></blockquote>

    <?php echo $form->errorSummary($model); ?>
    
    <?php
    if(!$school) {
        echo $form->dropDownListRow($model,
                'id_cat',
                CHtml::listData(Ws25_cat::model()->findAll(array('order' => 'id ASC')), 'id', 'naim'),
                array('empty' => 'Выберите категорию',
                    'class' => 'span6',
                    'ajax' => array(
                        'type' => 'POST',
                        'url' => Yii::app()->createUrl('complex/ws25/loadcompet2'),
                        'success' => 'function(data) {$("#compet").empty(); $("#compet").append(data);}',
                        'data' => array('id_cat' => 'js:this.value'),
                    )
                )
        );
    }    
    ?>    
    

    <div id="compet">     
        <?php echo $form->dropDownListRow($model, 'id_compet', CHtml::listData(Ws25_compet::model()->get_compet($school), 'id', 'naim'), array('empty'=>'Выберите компетенцию', 'class'=>'span6')); ?>        
    </div>     

    <?php echo $form->dropDownListRow($model, 'id_stat', CHtml::listData(Ws25_stat::model()->get_form2(), 'id', 'naim'), array('empty'=>'Выберите статус', 'class'=>'span6')); ?>
    
    <?php echo $form->textFieldRow($model,'surname',array('class'=>'span3','maxlength'=>255)); ?>    

    <?php echo $form->textFieldRow($model,'name',array('class'=>'span3','maxlength'=>255)); ?>

    <?php echo $form->textFieldRow($model,'patr',array('class'=>'span3','maxlength'=>255)); ?>
    

    <div class="control-group">
            <?php echo $form->labelEx($model,'burthdate',array('class'=>'control-label')); ?>
            <div class="controls">    
            <?php $this->widget('zii.widgets.jui.CJuiDatePicker', array(
                        'options'=>array(
                            'showAnim'=>'fold',
                            'dateFormat'=>'dd.mm.yy',
                            'changeYear'=>true,
                            'yearRange'=>'1940:2048'
                        ),
                        'language' => 'ru',
                        'attribute'=>'burthdate',
                        'model' => $model,
                        'htmlOptions'=>array(
                            'size'=>8,
                            'class'=>'input-small'
                        ),
                        ));
            ?>  
            </div>
    </div>    
    
    <?php echo $form->textFieldRow($model,'pers_mail',array('class'=>'span3','maxlength'=>255)); ?>
    
    <div class="control-group ">
        <label class="control-label">Населенный пункт<span class="required">*</span></label>
        <div class="controls">
            <?php $this->widget('zii.widgets.jui.CJuiAutoComplete', array(
                'model'=>$model, // модель
                'attribute'=>'nas_punkt', // атрибут модели
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
            <?php echo $form->labelEx($model,'lic_tel',array('class'=>'control-label')); ?>
            <div class="controls">+7     
            <?php echo $form->textField($model,'lic_code', array('class'=>'span1')); ?>
            <?php echo $form->textField($model,'lic_tel', array('class'=>'span2')); ?>
            </div>
    </div>

    <?php echo $form->dropDownListRow($model, 'id_gr', CHtml::listData(Ws25_country::model()->findAll(array('order' => 'id ASC')), 'id', 'naim'), array('empty'=>'Выберите страну гражданства', 'class'=>'span6')); ?>    
    
    <?php echo $form->checkBoxRow($model,'ano_org'); ?>
    
    <?php echo $form->textFieldRow($model,'rabota',array('class'=>'span6','maxlength'=>255)); ?>
    
    <?php echo $form->textFieldRow($model,'org_mail',array('class'=>'span3','maxlength'=>255)); ?>

    <?php echo $form->textFieldRow($model,'dol',array('class'=>'span3','maxlength'=>255)); ?>

    <?php echo $form->dropDownListRow($model, 'id_size', CHtml::listData(Ws25_size::model()->findAll(array('order' => 'id ASC')), 'id', 'naim'), array('empty'=>'Выберите размер одежды', 'class'=>'span6')); ?>        
    
    <?php echo $form->checkBoxRow($model,'housing'); ?>    
    
    <?php if($model->sogl_r) { ?>
    <div class="control-group ">
        <label class="control-label" for="Ws25_part_rabota">Загруженное согласие на обработку персональных данных</label>
        <div class="controls">
            <?php echo CHtml::link($model->sogl_r, array('ws25/scandown2', 'id_rep'=>$model->id_report, 'id' => 1)); ?>
        </div>
    </div> 
    <?php } ?>       

<div class="form-actions">
    <?php $this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'submit', 'type'=>'primary', 'icon'=>'ok white', 'label'=>'Сохранить')); ?>
        <?php $this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'action', 'icon'=>'remove', 'label'=>'Отмена', 'url'=>$this->createUrl('ws25obsh/index',array('id_comp'=>$model->report->ws25->id)))); ?>
</div>

<?php $this->endWidget(); ?> 
    
<script type="text/javascript"> 
$(function(){
    if($('#Ws25_part_ano_org').is(':not(:checked)')) {
        $('#Ws25_part_rabota').attr('disabled', '');
    }   
});

$('#Ws25_part_ano_org').change(function () {
    if($(this).is(':checked')) {
        $('#Ws25_part_rabota').removeAttr('disabled', '');
    }
    else {
        $('#Ws25_part_rabota').attr('disabled', '');       
    }
});
</script>        
