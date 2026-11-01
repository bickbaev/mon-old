<fieldset><legend>Редактирование компетенции</legend></fieldset>
<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
    'id'=>'compet-form',
    'type'=>'horizontal',    
    'enableAjaxValidation'=>false,
)); ?>

    <blockquote><em>Поля помеченные<span class="required"> * </span>обязательны для заполнения.</em></blockquote>

    <?php echo $form->errorSummary($model); ?>
    
    <?php echo $form->checkBoxRow($model,'nov'); ?>
    
    <?php echo $form->checkBoxRow($model,'red'); ?>

<div class="form-actions">
    <?php $this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'submit', 'type'=>'primary', 'icon'=>'ok white', 'label'=>'Сохранить')); ?>
    <?php $this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'action', 'label'=>'Отмена', 'url'=>Yii::app()->createUrl('fv25/compet', array('id_comp'=>$model->id_comp)))); ?>
</div>

<?php $this->endWidget(); ?>