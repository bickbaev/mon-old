<h4>Инструкция</h4>
<p>Внесите информацию об учащихся, прибывших в Вашу образовательную организацию из Курской, Белгородской областей или иных приграничных территорий с 1 августа 2024 года.<br>Отчет имеет <u>статус ДСП</u> (запрещено распространение информации о содержании отчета).</p>
<?php
$form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
    'id'=>'bez24-form',
    'type'=>'horizontal',    
    'enableAjaxValidation'=>false,
    'htmlOptions' => array('enctype'=>'multipart/form-data'),    
)); ?>

    <blockquote><em>Поля помеченные<span class="required"> * </span>обязательны для заполнения.</em></blockquote>
    
    
    <p><strong>Информация об учащемся</strong></p>

    <?php echo $form->errorSummary($model); ?>
    
    <?php echo $form->hiddenField($model, 'id_report') ?>
    
    <?php echo $form->textFieldRow($model, 'pok1', array('class'=>'span2','maxlength'=>255)); ?>
    
    <?php echo $form->textFieldRow($model, 'pok2', array('class'=>'span2','maxlength'=>255)); ?>
    
    <?php echo $form->textFieldRow($model, 'pok3', array('class'=>'span2','maxlength'=>255)); ?>    
    
    <div class="control-group">
            <?php echo $form->labelEx($model, 'pok4', array('class'=>'control-label')); ?>
            <div class="controls">    
            <?php $this->widget('zii.widgets.jui.CJuiDatePicker', array(
                        'options'=>array(
                            'showAnim'=>'fold',
                            'dateFormat'=>'dd.mm.yy',
                            'changeYear'=>true,
                            'yearRange'=>'1998:2019'
                        ),
                        'language' => 'ru',
                        'attribute'=>'pok4',
                        'model' => $model,
                        'htmlOptions'=>array(
                            'size'=>8,
                            'class'=>'input-small'
                        ),
                        ));
            ?>  
            </div>
    </div> 
    
    <?php echo $form->DropDownListRow($model, 'pok5', [0=>0, 1=>1, 2=>2, 3=>3, 4=>4, 5=>5, 6=>6, 7=>7, 8=>8, 9=>9, 10=>10, 11=>11, 12=>12], array('empty'=>'Выберите вариант', 'class'=>'span2')); ?>
    
    <p><strong>Откуда прибыл учащийся</strong></p>
    
    <?php echo $form->textFieldRow($model, 'pok6',array('class'=>'span5','maxlength'=>255)); ?>

    <?php echo $form->textFieldRow($model, 'pok7',array('class'=>'span5','maxlength'=>255)); ?>
    
    <?php echo $form->textFieldRow($model, 'pok8',array('class'=>'span5','maxlength'=>255)); ?>
    
    <?php echo $form->textFieldRow($model, 'pok9',array('class'=>'span5','maxlength'=>255)); ?> 
    
    <p><strong>Место прибывания учащегося в Самарской области</strong></p>
    
    <?php echo $form->DropDownListRow($model, 'pok10', CHtml::listData(Mun::model()->findAll(array('order' => 'id_mun ASC')), 'id_mun', 'naim_mun'), array('empty'=>'Выберите вариант', 'class'=>'span4')); ?>
    
    <?php echo $form->textFieldRow($model, 'pok11',array('class'=>'span5','maxlength'=>255)); ?>
    
    <p><strong>Условия прибывания учащегося в Самарской области<span class="required">*</span></strong></p>
    
    <?php echo $form->checkBoxRow($model,'pok12');?>
    
    <?php echo $form->checkBoxRow($model,'pok13');?>
    
    <?php echo $form->checkBoxRow($model,'pok14');?>
    
    <?php echo $form->textFieldRow($model, 'pok15',array('class'=>'span5','maxlength'=>255)); ?>
    
    <p><strong>Кто на данный момент является законным представителем учащегося<span class="required">*</span></strong></p>
    
    <?php echo $form->checkBoxRow($model,'pok16');?>
    
    <?php echo $form->checkBoxRow($model,'pok17');?>
    
    <?php echo $form->checkBoxRow($model,'pok18');?>
    
    <?php echo $form->textFieldRow($model, 'pok19',array('class'=>'span5','maxlength'=>255)); ?>    
    
    <p><strong>Проблематика</strong></p>
    
    <?php echo $form->checkBoxRow($model,'pok20');?>
    
    <?php echo $form->checkBoxRow($model,'pok21');?>
    
    <?php echo $form->checkBoxRow($model,'pok22');?>
    
    <?php echo $form->checkBoxRow($model,'pok23');?>
    
    <?php echo $form->textFieldRow($model, 'pok24',array('class'=>'span5','maxlength'=>255)); ?>

    <?php if(!$model->isNewRecord) echo $form->checkBoxRow($model,'pok25');?>
    
<div class="form-actions">
    <?php $this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'submit', 'type'=>'primary', 'icon'=>'ok white', 'label'=>'Сохранить')); ?>
    <?php $this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'action', 'icon'=>'remove', 'label'=>'Отмена', 'url'=>$this->createUrl('bez24/edit',array('id_rep'=>$model->id_report)))); ?>
</div>

<?php $this->endWidget(); ?>       