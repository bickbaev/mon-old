<?php
$form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
    'id'=>'master-form',
    'type'=>'horizontal',    
    'enableAjaxValidation'=>false,
    'htmlOptions' => array('enctype'=>'multipart/form-data'),    
)); ?>

    <blockquote><em>Поля помеченные<span class="required"> * </span>обязательны для заполнения.</em></blockquote>

    <?php echo $form->errorSummary($model); ?>
    
    <?php echo $form->hiddenField($model, 'id_report') ?>
    
    <?php
        $type1 = array(1 => '10 класс', 2 => '11 класс');
    ?>
    
    <?php echo $form->radioButtonListInlineRow($model, 'pok1', $type1);?>
    
    <?php echo $form->textFieldRow($model, 'pok2',array('class'=>'span1','maxlength'=>1)); ?>
    
    <?php echo $form->textFieldRow($model, 'pok3',array('class'=>'span2','maxlength'=>255)); ?>
    
    <p style="margin-top: 20px;">
        <strong>Предполагаемые к сдаче предметы ЕГЭ (c указанием среднего балла за текущий учебный год по результатам промежуточной аттестации)</strong><br>Средний балл указывается с точностью до сотых, разделить разрядов точка.
    </p>

    <div class="control-group">
            <?php echo $form->labelEx($model,'pok4',array('class'=>'control-label')); ?>
            <div class="controls">
            <?php echo $form->checkBox($model, 'pok4');?>
            <?php echo '<span style="margin-left:20px;">средний балл</span> '.$form->textField($model,'pok5', array('class'=>'span1')); ?>
            </div>
    </div>

    <div class="control-group">
            <?php echo $form->labelEx($model,'pok6',array('class'=>'control-label')); ?>
            <div class="controls">
            <?php echo $form->checkBox($model, 'pok6');?>
            <?php echo '<span style="margin-left:20px;">средний балл</span> '.$form->textField($model,'pok7', array('class'=>'span1')); ?>
            </div>
    </div>

    <div class="control-group">
            <?php echo $form->labelEx($model,'pok8',array('class'=>'control-label')); ?>
            <div class="controls">
            <?php echo $form->checkBox($model, 'pok8');?>
            <?php echo '<span style="margin-left:20px;">средний балл</span> '.$form->textField($model,'pok9', array('class'=>'span1')); ?>
            </div>
    </div>
    
    <div class="control-group">
            <?php echo $form->labelEx($model,'pok10',array('class'=>'control-label')); ?>
            <div class="controls">
            <?php echo $form->checkBox($model, 'pok10');?>
            <?php echo '<span style="margin-left:20px;">средний балл</span> '.$form->textField($model,'pok11', array('class'=>'span1')); ?>
            </div>
    </div>
    
    <div class="control-group">
            <?php echo $form->labelEx($model,'pok12',array('class'=>'control-label')); ?>
            <div class="controls">
            <?php echo $form->checkBox($model, 'pok12');?>
            <?php echo '<span style="margin-left:20px;">средний балл</span> '.$form->textField($model,'pok13', array('class'=>'span1')); ?>
            </div>
    </div> 

    <div class="control-group">
            <?php echo $form->labelEx($model,'pok14',array('class'=>'control-label')); ?>
            <div class="controls">
            <?php echo $form->checkBox($model, 'pok14');?>
            <?php echo '<span style="margin-left:20px;">средний балл</span> '.$form->textField($model,'pok15', array('class'=>'span1')); ?>
            </div>
    </div> 

    <div class="control-group">
            <?php echo $form->labelEx($model,'pok16',array('class'=>'control-label')); ?>
            <div class="controls">
            <?php echo $form->checkBox($model, 'pok16');?>
            <?php echo '<span style="margin-left:20px;">средний балл</span> '.$form->textField($model,'pok17', array('class'=>'span1')); ?>
            </div>
    </div> 

    <div class="control-group">
            <?php echo $form->labelEx($model,'pok18',array('class'=>'control-label')); ?>
            <div class="controls">
            <?php echo $form->checkBox($model, 'pok18');?>
            <?php echo '<span style="margin-left:20px;">средний балл</span> '.$form->textField($model,'pok19', array('class'=>'span1')); ?>
            </div>
    </div> 

    <div class="control-group">
            <?php echo $form->labelEx($model,'pok20',array('class'=>'control-label')); ?>
            <div class="controls">
            <?php echo $form->checkBox($model, 'pok20');?>
            <?php echo '<span style="margin-left:20px;">средний балл</span> '.$form->textField($model,'pok21', array('class'=>'span1')); ?>
            </div>
    </div>
    
    <div class="control-group">
            <?php echo $form->labelEx($model,'pok22',array('class'=>'control-label')); ?>
            <div class="controls">
            <?php echo $form->checkBox($model, 'pok22');?>
            <?php echo '<span style="margin-left:20px;">средний балл</span> '.$form->textField($model,'pok23', array('class'=>'span1')); ?>
            </div>
    </div>

    <div class="control-group">
            <?php echo $form->labelEx($model,'pok24',array('class'=>'control-label')); ?>
            <div class="controls">
            <?php echo $form->checkBox($model, 'pok24');?>
            <?php echo '<span style="margin-left:20px;">средний балл</span> '.$form->textField($model,'pok25', array('class'=>'span1')); ?>
            </div>
    </div>  

    <div class="control-group">
            <?php echo $form->labelEx($model,'pok26',array('class'=>'control-label')); ?>
            <div class="controls">
            <?php echo $form->checkBox($model, 'pok26');?>
            <?php echo '<span style="margin-left:20px;">средний балл</span> '.$form->textField($model,'pok27', array('class'=>'span1')); ?>
            </div>
    </div>  

    <div class="control-group">
            <?php echo $form->labelEx($model,'pok28',array('class'=>'control-label')); ?>
            <div class="controls">
            <?php echo $form->checkBox($model, 'pok28');?>
            <?php echo '<span style="margin-left:20px;">средний балл</span> '.$form->textField($model,'pok29', array('class'=>'span1')); ?>
            </div>
    </div>  

    <div class="control-group">
            <?php echo $form->labelEx($model,'pok30',array('class'=>'control-label')); ?>
            <div class="controls">
            <?php echo $form->checkBox($model, 'pok30');?>
            <?php echo '<span style="margin-left:20px;">средний балл</span> '.$form->textField($model,'pok31', array('class'=>'span1')); ?>
            </div>
    </div>
    
    <div class="control-group">
            <?php echo $form->labelEx($model,'pok32',array('class'=>'control-label')); ?>
            <div class="controls">
            <?php echo $form->checkBox($model, 'pok32');?>
            <?php echo '<span style="margin-left:20px;">средний балл</span> '.$form->textField($model,'pok33', array('class'=>'span1')); ?>
            </div>
    </div>

    <div style="margin-top: 20px;">
        <p><strong>Результаты  участия за последние два учебных года в олимпиадах и конкурсах, указанных в приказе  Министерства просвещения Российской Федерации от 31 августа 2021 г. № 616 «Об  утверждении Перечня мероприятий на 2021/22 учебный год» в следующем формате (данные указывать через дробь):</strong></p>
        <ul>
          <li>Год участия,</li>
          <li>Название олимпиады/конкурса,</li>
          <li>Предмет,</li>
          <li>Уровень (окружной, региональный,  всероссийский, международный),</li>
          <li>Результат (призер/победитель).</li>
        </ul>        
    </div>

    <?php echo $form->textAreaRow($model,'pok34',array('rows'=>6, 'cols'=>50, 'class'=>'span8')); ?>

    <?php echo $form->textFieldRow($model, 'pok35',array('class'=>'span5','maxlength'=>255)); ?>
    <?php echo $form->textFieldRow($model, 'pok36',array('class'=>'span5','maxlength'=>255)); ?>
    <?php echo $form->textFieldRow($model, 'pok37',array('class'=>'span5','maxlength'=>255)); ?>
    <?php echo $form->textFieldRow($model, 'pok38',array('class'=>'span5','maxlength'=>255)); ?>
    <?php echo $form->textFieldRow($model, 'pok39',array('class'=>'span5','maxlength'=>255)); ?>
    <?php echo $form->textFieldRow($model, 'pok40',array('class'=>'span5','maxlength'=>255)); ?>    

<div class="form-actions">
    <?php $this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'submit', 'type'=>'primary', 'icon'=>'ok white', 'label'=>'Сохранить')); ?>
    <?php $this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'action', 'icon'=>'remove', 'label'=>'Отмена', 'url'=>$this->createUrl('gir22/edit',array('id_rep'=>$model->id_report)))); ?>
</div>

<?php $this->endWidget(); ?>      