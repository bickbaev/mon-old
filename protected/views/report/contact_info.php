<fieldset><legend>Контактные данные учреждения</legend></fieldset>
<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
    'id'=>'contact_info',
    'type'=>'horizontal',    
    'enableAjaxValidation'=>false,
)); ?>

    <p class="note">Поля помеченные <span class="required">*</span> обязательны для заполнения.</p>

    <?php echo $form->errorSummary($model); ?>
    
    <?php echo $form->hiddenField($model,'id_report') ?>
    
    <?php echo $form->DropDownListRow($model, 'uch_type', CHtml::listData(Contact_type::model()->findAll(array('order' => 'id_contact_info ASC')), 'id_contact_info', 'naim_type'), array('empty'=>'Выберите тип учреждения', 'class'=>'span9')); ?>

    <?php echo $form->DropDownListRow($model, 'uch_status', CHtml::listData(Contact_ur::model()->findAll(array('order' => 'id_contact_ur ASC')), 'id_contact_ur', 'naim_ur'), array('empty'=>'Выберите вариант', 'class'=>'span4')); ?>

    <?php echo $form->DropDownListRow($model, 'nas_punkt_type', CHtml::listData(Contact_gor::model()->findAll(array('order' => 'id_contact_gor ASC')), 'id_contact_gor', 'naim_gor'), array('empty'=>'Выберите вариант', 'class'=>'span4')); ?>

    <?php echo $form->textFieldRow($model,'nas_punkt', array('class'=>'span5')); ?>

    <?php echo $form->DropDownListRow($model, 'street_type', CHtml::listData(Contact_ul::model()->findAll(array('order' => 'id_contact_ul ASC')), 'id_contact_ul', 'naim_ul'), array('empty'=>'Выберите вариант', 'class'=>'span4')); ?>

    <?php echo $form->textFieldRow($model,'street', array('class'=>'span5')); ?>

    <?php echo $form->textFieldRow($model,'dom'); ?>

    <?php echo $form->textFieldRow($model,'korpus'); ?>

    <?php echo $form->textFieldRow($model,'dir_sur'); ?>

    <?php echo $form->textFieldRow($model,'dir_name'); ?>

    <?php echo $form->textFieldRow($model,'dir_par'); ?>
    
    <div class="control-group">
            <?php echo $form->labelEx($model,'phone',array('class'=>'control-label')); ?>
            <div class="controls">
            8(<?php echo $form->textField($model,'cod_phone', array('class'=>'span1')); ?>)
            <?php echo $form->textField($model,'phone', array('size'=>6)); ?>
            </div>
    </div>    
    
    <div class="control-group">
            <?php echo $form->labelEx($model,'fax',array('class'=>'control-label')); ?>
            <div class="controls">
            8(<?php echo $form->textField($model,'cod_fax', array('class'=>'span1')); ?>)
            <?php echo $form->textField($model,'fax', array('size'=>6)); ?>
            </div>
    </div>     

    <?php echo $form->textFieldRow($model,'mail', array('class'=>'span5')); ?>

    <?php echo $form->textFieldRow($model,'site', array('class'=>'span5')); ?>

    <?php //echo $form->textFieldRow($model,'publ', array('class'=>'span7')); ?>
    
    <?php //echo $form->textFieldRow($model,'samo', array('class'=>'span7')); ?>

    <?php //echo $form->textFieldRow($model,'akkr', array('class'=>'span7')); ?>

    <?php //echo $form->textFieldRow($model,'lic', array('class'=>'span7')); ?>

    <?php //echo $form->textFieldRow($model,'ustav', array('class'=>'span7')); ?>

    <?php //echo $form->textFieldRow($model,'gos', array('class'=>'span7')); ?>

    <?php //echo $form->textFieldRow($model,'opl', array('class'=>'span7')); ?>

    <?php //echo $form->textFieldRow($model,'ped5', array('class'=>'span1')); ?>

    <?php //echo $form->textFieldRow($model,'ped', array('class'=>'span1')); ?>    


<div class="form-actions">
    <?php $this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'submit', 'type'=>'primary', 'icon'=>'ok white', 'label'=>'Сохранить')); ?>
    <?php $this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'action', 'icon'=>'remove', 'label'=>'Отмена', 'url'=>$this->createUrl('site/cabinet',array('id'=>Yii::app()->session['est'])))); ?>
</div>

<?php $this->endWidget(); ?> 