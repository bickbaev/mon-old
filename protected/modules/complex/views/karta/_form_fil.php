<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
    'id'=>'karta-filial-form',
    'type'=>'horizontal',    
    'enableAjaxValidation'=>false,
)); ?>

    <blockquote><em>Поля помеченные<span class="required"> * </span>обязательны для заполнения.</em></blockquote>

    <?php echo $form->errorSummary($model); ?>

    <?php echo $form->dropDownListRow($model, 'id_mun', CHtml::listData(Mun::model()->findAll(array('order' => 'id_mun ASC')), 'id_mun', 'naim_mun'), array('empty'=>'Выберите муниципалитет')); ?>

    <?php echo $form->textFieldRow($model,'address',array('class'=>'span7','maxlength'=>255)); ?>

    <div class="form-actions">
    <?php $this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'submit', 'type'=>'primary', 'icon'=>'ok white', 'label'=>'Сохранить')); ?>
    <?php $this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'action', 'icon'=>'remove', 'label'=>'Отмена', 'url'=>$this->createUrl('karta/edit',array('id_rep'=>$model->id_report)))); ?>
    </div>

<?php $this->endWidget(); ?>