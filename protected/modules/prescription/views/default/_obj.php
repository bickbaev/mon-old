<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
    'id'=>'contact_info',
    'type'=>'horizontal',    
    'enableAjaxValidation'=>false,
)); ?>

<p class="note"><i>Поля помеченные <span class="required">*</span> обязательны для заполнения.</i></p>

    <?php echo $form->errorSummary($model); ?>
    
    <?php echo $form->hiddenField($model,'id_build') ?>
    
    <?php echo $form->textFieldRow($model,'naim', array('class'=>'span5')); ?>

    <?php echo $form->DropDownListRow($model, 'nas_punkt_type', CHtml::listData(Contact_gor::model()->findAll(array('order' => 'id_contact_gor ASC')), 'id_contact_gor', 'naim_gor'), array('empty'=>'Выберите вариант', 'class'=>'span4', 'disabled'=>$blk)); ?>

    <?php echo $form->textFieldRow($model,'nas_punkt', array('class'=>'span5', 'disabled'=>$blk)); ?>

    <?php echo $form->DropDownListRow($model, 'street_type', CHtml::listData(Contact_ul::model()->findAll(array('order' => 'id_contact_ul ASC')), 'id_contact_ul', 'naim_ul'), array('empty'=>'Выберите вариант', 'class'=>'span4')); ?>

    <?php echo $form->textFieldRow($model,'street', array('class'=>'span5')); ?>

    <?php echo $form->textFieldRow($model,'dom'); ?>

    <?php echo $form->DropDownListRow($model, 'type_o', $model->type_o(), array('empty'=>'Выберите вариант', 'class'=>'span4')); ?>

    <h5>Реализуемые на объекте образовательные программы</h5>

    <?php echo $form->checkboxRow($model, 'ur1'); ?>

    <?php echo $form->checkboxRow($model, 'ur2'); ?>

    <?php echo $form->checkboxRow($model, 'ur3'); ?>

    <?php echo $form->checkboxRow($model, 'ur4'); ?>

    <?php echo $form->checkboxRow($model, 'ur5'); ?>

    <?php echo $form->checkboxRow($model, 'ur6'); ?>

    <?php echo $form->checkboxRow($model, 'ur7'); ?>

    <?php echo $form->checkboxRow($model, 'ur8'); ?>

<div class="form-actions">
    <?php $this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'submit', 'type'=>'primary', 'icon'=>'ok white', 'label'=>'Сохранить')); ?>
    <?php $this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'action', 'icon'=>'remove', 'label'=>'Отмена', 'url'=>$this->createUrl("cabinet", array('id_est'=>$model->id_est)))); ?>
</div>

<?php $this->endWidget(); ?>   
