<?php
$form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
    'id'=>'mer-form',
    'type'=>'horizontal',    
    'enableAjaxValidation'=>false,
    'htmlOptions' => array('enctype'=>'multipart/form-data'),    
)); ?>

    <blockquote><em>Поля помеченные<span class="required"> * </span>обязательны для заполнения.</em></blockquote>

    <?php echo $form->errorSummary($model); ?>
    
    <?php echo $form->hiddenField($model, 'id_report') ?>

    <?php echo $form->textFieldRow($model, 'nazv',array('class'=>'span8','maxlength'=>255)); ?>
    
    <?php echo $form->textFieldRow($model, 'plan',array('class'=>'span1','maxlength'=>255)); ?>
    
    <?php echo $form->textFieldRow($model, 'fact',array('class'=>'span1','maxlength'=>255)); ?>
    
    <div class="control-group">
            <?php echo $form->labelEx($model,'praz',array('class'=>'control-label')); ?>
            <div class="controls">    
            <?php $this->widget(
                    'ext.jui.EJuiDateTimePicker',
                    array(
                        'model'     => $model,
                        'attribute' => 'praz',
                        'options'   => array(
                        ),
                    )
                ); 
            ?>  
            </div>
    </div>    
    
    <?php echo $form->textFieldRow($model, 'mesto',array('class'=>'span8','maxlength'=>255)); ?>
    
    <?php echo $form->textFieldRow($model, 'addr',array('class'=>'span8','maxlength'=>255)); ?>

<div class="form-actions">
    <?php $this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'submit', 'type'=>'primary', 'icon'=>'ok white', 'label'=>'Сохранить')); ?>
    <?php $this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'action', 'icon'=>'remove', 'label'=>'Отмена', 'url'=>$this->createUrl('mnk19/edit',array('id_rep'=>$model->id_report)))); ?>
</div>

<?php $this->endWidget(); ?>        

