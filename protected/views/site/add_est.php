<fieldset><legend>Добавление учреждения</legend></fieldset>
<?php
$form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
    'id'=>'est-form',
    'type'=>'horizontal',    
    'enableAjaxValidation'=>false,
    'htmlOptions' => array('enctype'=>'multipart/form-data'),    
)); ?>

    <blockquote><em>Поля помеченные<span class="required"> * </span>обязательны для заполнения.</em></blockquote>

    <?php echo $form->errorSummary($model); ?>    
    
    <?php echo $form->textFieldRow($model,'est_name',array('class'=>'span7')); ?>
 

<div class="form-actions">
    <?php $this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'submit', 'type'=>'primary', 'icon'=>'ok white', 'label'=>'Сохранить')); ?>
    <?php $this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'action', 'icon'=>'remove', 'label'=>'Отмена', 'url'=>$this->createUrl('site/tree'))); ?>
</div>

<?php $this->endWidget(); ?>      