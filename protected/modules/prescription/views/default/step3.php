<?php $this->pageTitle=Yii::app()->name;?>
<legend>Данные предписания</legend>
<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
    'id'=>'pr_info',
    'type'=>'horizontal',    
    'enableAjaxValidation'=>false,
)); ?>

    <?php echo $form->errorSummary($model); ?>

    <?php echo $form->textFieldRow($model,'organ', array('class'=>'span5')); ?>

    <?php echo $form->DropDownListRow($model, 'doc_type', CHtml::listData(Pr_doc::model()->findAll(array('order' => 'id_pr ASC')), 'id_pr', 'naim'), array('empty'=>'Выберите вариант', 'class'=>'span4')); ?>

    <div class="control-group">
            <?php echo $form->labelEx($model,'doc_date',array('class'=>'control-label')); ?>
            <div class="controls">    
            <?php $this->widget('zii.widgets.jui.CJuiDatePicker', array(
                        'options'=>array(
                            'showAnim'=>'fold',
                            'dateFormat'=>'dd.mm.yy',
                            'changeYear'=>true,
                            'yearRange'=>'2010:2050'
                        ),
                        'language' => 'ru',
                        'attribute'=>'doc_date',
                        'model' => $model,
                        'htmlOptions'=>array(
                            'size'=>8,
                            'class'=>'input-small'
                        ),
                        ));
            ?>  
            </div>
    </div>

    <?php echo $form->textFieldRow($model,'doc_num', array('class'=>'span5')); ?>

    <?php echo $form->textFieldRow($model,'npa', array('class'=>'span5')); ?>

    <?php echo $form->textFieldRow($model,'npa_punkt', array('class'=>'span5')); ?>

<div class="form-actions">
    <?php $this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'submit', 'type'=>'primary', 'icon'=>'ok white', 'label'=>'Сохранить')); ?>
    <?php $this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'action', 'icon'=>'remove', 'label'=>'Отмена', 'url'=>$this->createUrl("object_update", array('id_build'=>$id_build)))); ?>
</div>

<?php $this->endWidget(); ?>  

