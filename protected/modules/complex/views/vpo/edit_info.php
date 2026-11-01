<fieldset><legend>Редактирование информации об организации</legend></fieldset>
<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
    'id'=>'karta-info-form',
    'type'=>'horizontal',    
    'enableAjaxValidation'=>false,
)); ?>

    <blockquote><em>Поля помеченные<span class="required"> * </span>обязательны для заполнения.</em></blockquote>

    <?php echo $form->errorSummary($model); ?>

    <?php echo $form->dropDownListRow($model, 'id_mun', CHtml::listData(Mun::model()->findAll(array('order' => 'id_mun ASC')), 'id_mun', 'naim_mun'), array('empty'=>'Выберите муниципалитет')); ?>

    <?php echo $form->textFieldRow($model,'address',array('class'=>'span7','maxlength'=>255)); ?>    

    <?php echo $form->textFieldRow($model,'dir_sur',array('class'=>'span3','maxlength'=>255)); ?>    

    <?php echo $form->textFieldRow($model,'dir_name',array('class'=>'span3','maxlength'=>255)); ?>

    <?php echo $form->textFieldRow($model,'dir_par',array('class'=>'span3','maxlength'=>255)); ?>
    
    <div class="control-group">
            <?php echo $form->labelEx($model,'phone',array('class'=>'control-label')); ?>
            <div class="controls">8-     
            <?php echo $form->textField($model,'cod_phone', array('class'=>'span1')); ?>
            <?php echo $form->textField($model,'phone', array('class'=>'span2')); ?>
            </div>
    </div>     

    <?php echo $form->textFieldRow($model,'mail',array('class'=>'span3','maxlength'=>255)); ?>

    <?php echo $form->textFieldRow($model,'site',array('class'=>'span4','maxlength'=>255)); ?>

    <?php echo $form->textFieldRow($model,'pr_address',array('class'=>'span7','maxlength'=>255)); ?>
    
    <div class="control-group">
            <?php echo $form->labelEx($model,'pr_phone',array('class'=>'control-label')); ?>
            <div class="controls">8-     
            <?php echo $form->textField($model,'pr_cod_phone', array('class'=>'span1')); ?>
            <?php echo $form->textField($model,'pr_phone', array('class'=>'span2')); ?>
            </div>
    </div> 

    <?php echo $form->textFieldRow($model,'pr_mail',array('class'=>'span3','maxlength'=>255)); ?>
    
    <div class="control-group">
            <label class="control-label">Дни работы приемной комиссии</label>
            <div class="controls">    
            <?php echo 'C '.$form->dropDownList($model, 'pr_s_day', CHtml::listData(Karta_days::model()->findAll(array('order' => 'id_day ASC')), 'id_day', 's_day'), array('empty'=>'Выберите день недели','class'=>'span3')); ?>
            <?php echo ' по '.$form->dropDownList($model, 'pr_f_day', CHtml::listData(Karta_days::model()->findAll(array('order' => 'id_day ASC')), 'id_day', 'f_day'), array('empty'=>'Выберите день недели','class'=>'span3')); ?>    
            </div>
    </div>     
    
    <div class="control-group">
            <label class="control-label">Часы работы приемной комиссии (например, с 9 до 18)</label>
            <div class="controls">    
            <?php echo 'C '.$form->textField($model,'pr_s_hour',array('class'=>'span1','maxlength'=>2)); ?>
            <?php echo ' до '.$form->textField($model,'pr_f_hour',array('class'=>'span1','maxlength'=>2)).' часов'; ?>    
            </div>
    </div>     
    
    <div class="control-group">
            <label class="control-label">Обед в приемной комиссии (например, с 13 до 14)</label>
            <div class="controls">    
            <?php echo 'C '.$form->textField($model,'pr_s_obed',array('class'=>'span1','maxlength'=>2)); ?>
            <?php echo ' до '.$form->textField($model,'pr_f_obed',array('class'=>'span1','maxlength'=>2)).' часов'; ?>    
            </div>
    </div>    

    <?php echo $form->textFieldRow($model,'pr_priem',array('class'=>'span5','maxlength'=>255)); ?>
    
<!--    <div class="control-group">
            <?php //echo $form->labelEx($model,'podg',array('class'=>'control-label')); ?>
            <div class="controls">     
            <?php /*$this->widget('ext.redactor.ERedactorWidget',array(
                //'model'=>$model,
                'attribute'=>'podg',
            ));*/ ?> 
            </div>
    </div> -->

    <?php echo $form->textAreaRow($model,'podg',array('class'=>'span7')); ?>

<div class="form-actions">
    <?php $this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'submit', 'type'=>'primary', 'icon'=>'ok white', 'label'=>'Сохранить')); ?>
    <?php $this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'action', 'icon'=>'remove', 'label'=>'Отмена', 'url'=>$this->createUrl('vpo/edit',array('id_rep'=>$model->id_report)))); ?>
</div>

<?php $this->endWidget(); ?>
