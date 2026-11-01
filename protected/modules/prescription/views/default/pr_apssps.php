<?php $this->pageTitle=Yii::app()->name;?>
<legend>Мониторинг оснащения образовательных организаций Самарской области АПС и СПС</legend>
<p>
   <strong>Инструкция по заполнению:</strong> введите информацию согласно форме.<br>
   <strong>АПС</strong> - система автоматической пожарной сигнализации<br>
   <strong>СПС</strong> - система передачи сигнала на пульт 01
</p>
<hr>
<?php
$type1 = array(1 => 'кабель', 2 => 'GSM', 3 => 'радио');
$type2 = array(1 => 'муниципальное', 2 => 'государственное');
?>
<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
    'id'=>'apssps',
    'type'=>'horizontal',    
    'enableAjaxValidation'=>false,
    'htmlOptions' => array('enctype'=>'multipart/form-data'),    
)); ?>

    <?php echo $form->errorSummary($model); ?>

    <?php echo $form->hiddenField($model,'id_report') ?>

    <?php echo $form->checkboxRow($model, 'pok1'); ?>

    <?php echo $form->checkboxRow($model, 'pok2'); ?>

    <?php echo $form->textFieldRow($model,'pok3', array('class'=>'span3')); ?>

    <?php echo $form->textFieldRow($model,'pok4', array('class'=>'span3')); ?>

    <?php echo $form->textFieldRow($model,'pok5', array('class'=>'span3')); ?>

    <?php echo $form->textFieldRow($model,'pok6', array('class'=>'span3')); ?>

    <?php echo $form->textFieldRow($model,'pok7', array('class'=>'span1')); ?>

    <?php echo $form->textFieldRow($model,'pok8', array('class'=>'span1')); ?>

    <?php echo $form->dropDownListRow($model,'pok9', $type1, array('empty'=>'Выберите значение','class'=>'span4')); ?>

    <?php echo $form->checkboxRow($model, 'pok10'); ?>

    <?php echo $form->textFieldRow($model,'pok11', array('class'=>'span1')); ?>

    <?php echo $form->textFieldRow($model,'pok12', array('class'=>'span1')); ?>

    <?php echo $form->textFieldRow($model,'pok13', array('class'=>'span3')); ?>

    <?php echo $form->textFieldRow($model,'pok14', array('class'=>'span3')); ?>

    <div class="control-group">
            <?php echo $form->labelEx($model,'pok15',array('class'=>'control-label')); ?>
            <div class="controls">    
            <?php $this->widget('zii.widgets.jui.CJuiDatePicker', array(
                        'options'=>array(
                            'showAnim'=>'fold',
                            'dateFormat'=>'dd.mm.yy',
                            'changeYear'=>true,
                            'yearRange'=>'2010:2050'
                        ),
                        'language' => 'ru',
                        'attribute'=>'pok15',
                        'model' => $model,
                        'htmlOptions'=>array(
                            'size'=>8,
                            'class'=>'input-small'
                        ),
                        ));
            ?>  
            </div>
    </div>

    <?php echo $form->textFieldRow($model,'pok16', array('class'=>'span3')); ?>

    <div class="control-group">
            <?php echo $form->labelEx($model,'pok17',array('class'=>'control-label')); ?>
            <div class="controls">    
            <?php $this->widget('zii.widgets.jui.CJuiDatePicker', array(
                        'options'=>array(
                            'showAnim'=>'fold',
                            'dateFormat'=>'dd.mm.yy',
                            'changeYear'=>true,
                            'yearRange'=>'2010:2050'
                        ),
                        'language' => 'ru',
                        'attribute'=>'pok17',
                        'model' => $model,
                        'htmlOptions'=>array(
                            'size'=>8,
                            'class'=>'input-small'
                        ),
                        ));
            ?>  
            </div>
    </div>

    <?php echo $form->textFieldRow($model,'pok18', array('class'=>'span3')); ?>

    <?php echo $form->textFieldRow($model,'pok19', array('class'=>'span3')); ?>

    <?php echo $form->textFieldRow($model,'pok20', array('class'=>'span3')); ?>

    <?php echo $form->textFieldRow($model,'pok21', array('class'=>'span3')); ?>

    <?php echo $form->textFieldRow($model,'pok22', array('class'=>'span3')); ?>

    <?php echo $form->checkboxRow($model, 'pok23'); ?>

    <?php echo $form->checkboxRow($model, 'pok24'); ?>

    <?php echo $form->textFieldRow($model,'pok25', array('class'=>'span3')); ?>

    <?php echo $form->textFieldRow($model,'pok26', array('class'=>'span3')); ?>

    <div class="control-group">
            <?php echo $form->labelEx($model,'pok27',array('class'=>'control-label')); ?>
            <div class="controls">    
            <?php $this->widget('zii.widgets.jui.CJuiDatePicker', array(
                        'options'=>array(
                            'showAnim'=>'fold',
                            'dateFormat'=>'dd.mm.yy',
                            'changeYear'=>true,
                            'yearRange'=>'2010:2050'
                        ),
                        'language' => 'ru',
                        'attribute'=>'pok27',
                        'model' => $model,
                        'htmlOptions'=>array(
                            'size'=>8,
                            'class'=>'input-small'
                        ),
                        ));
            ?>  
            </div>
    </div>

    <div class="control-group">
            <?php echo $form->labelEx($model,'pok28',array('class'=>'control-label')); ?>
            <div class="controls">    
            <?php $this->widget('zii.widgets.jui.CJuiDatePicker', array(
                        'options'=>array(
                            'showAnim'=>'fold',
                            'dateFormat'=>'dd.mm.yy',
                            'changeYear'=>true,
                            'yearRange'=>'2010:2050'
                        ),
                        'language' => 'ru',
                        'attribute'=>'pok28',
                        'model' => $model,
                        'htmlOptions'=>array(
                            'size'=>8,
                            'class'=>'input-small'
                        ),
                        ));
            ?>  
            </div>
    </div>

    <div class="control-group">
            <?php echo $form->labelEx($model,'pok29',array('class'=>'control-label')); ?>
            <div class="controls">    
            <?php $this->widget('zii.widgets.jui.CJuiDatePicker', array(
                        'options'=>array(
                            'showAnim'=>'fold',
                            'dateFormat'=>'dd.mm.yy',
                            'changeYear'=>true,
                            'yearRange'=>'2010:2050'
                        ),
                        'language' => 'ru',
                        'attribute'=>'pok29',
                        'model' => $model,
                        'htmlOptions'=>array(
                            'size'=>8,
                            'class'=>'input-small'
                        ),
                        ));
            ?>  
            </div>
    </div>

    <div class="control-group">
            <?php echo $form->labelEx($model,'pok30',array('class'=>'control-label')); ?>
            <div class="controls">    
            <?php $this->widget('zii.widgets.jui.CJuiDatePicker', array(
                        'options'=>array(
                            'showAnim'=>'fold',
                            'dateFormat'=>'dd.mm.yy',
                            'changeYear'=>true,
                            'yearRange'=>'2010:2050'
                        ),
                        'language' => 'ru',
                        'attribute'=>'pok30',
                        'model' => $model,
                        'htmlOptions'=>array(
                            'size'=>8,
                            'class'=>'input-small'
                        ),
                        ));
            ?>  
            </div>
    </div>

    <?php echo $form->textFieldRow($model,'pok31', array('class'=>'span3')); ?>

    <?php echo $form->textFieldRow($model,'pok32', array('class'=>'span3')); ?>

    <?php echo $form->dropDownListRow($model,'pok33', $type2, array('empty'=>'Выберите значение','class'=>'span4')); ?>

    <?php echo $form->dropDownListRow($model,'pok34', $type2, array('empty'=>'Выберите значение','class'=>'span4')); ?>

    <h5>Если АПС 10 лет и более</h5>

    <?php echo $form->textFieldRow($model,'pok35', array('class'=>'span3')); ?>

    <div class="control-group">
            <?php echo $form->labelEx($model,'pok36',array('class'=>'control-label')); ?>
            <div class="controls">    
            <?php $this->widget('zii.widgets.jui.CJuiDatePicker', array(
                        'options'=>array(
                            'showAnim'=>'fold',
                            'dateFormat'=>'dd.mm.yy',
                            'changeYear'=>true,
                            'yearRange'=>'2010:2050'
                        ),
                        'language' => 'ru',
                        'attribute'=>'pok36',
                        'model' => $model,
                        'htmlOptions'=>array(
                            'size'=>8,
                            'class'=>'input-small'
                        ),
                        ));
            ?>  
            </div>
    </div>

<div class="form-actions">
    <?php $this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'submit', 'type'=>'primary', 'icon'=>'ok white', 'label'=>'Сохранить')); ?>
    <?php $this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'action', 'icon'=>'remove', 'label'=>'Отмена', 'url'=>$this->createUrl("object_update", array('id_build'=>$model->id_build)))); ?>
</div>

<?php $this->endWidget(); ?>  

