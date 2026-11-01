<fieldset><legend>Информация об ответственном за заполнение заявки от организации</legend></fieldset>
<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
    'id'=>'obsh-form',
    'type'=>'horizontal',    
    'enableAjaxValidation'=>false,
    'htmlOptions' => array('enctype'=>'multipart/form-data'),
)); ?>

    <blockquote><em>Поля помеченные<span class="required"> * </span>обязательны для заполнения.</em></blockquote>

    <?php echo $form->errorSummary($model); ?>
    
    <?php if(Yii::app()->session['type_adm'] == 4) echo $form->textAreaRow($model, 'comment', array('class'=>'span8', 'rows'=>5)); ?>
    
    <?php echo $form->textFieldRow($model,'surname',array('class'=>'span3','maxlength'=>255)); ?>    

    <?php echo $form->textFieldRow($model,'name',array('class'=>'span3','maxlength'=>255)); ?>

    <?php echo $form->textFieldRow($model,'patr',array('class'=>'span3','maxlength'=>255)); ?>
    
    <?php echo $form->textFieldRow($model,'dol',array('class'=>'span3','maxlength'=>255)); ?>
    
    <?php echo $form->textFieldRow($model,'mail',array('class'=>'span3','maxlength'=>255)); ?>

    <div class="control-group">
            <?php echo $form->labelEx($model,'tel',array('class'=>'control-label')); ?>
            <div class="controls">+7     
            <?php echo $form->textField($model,'code', array('class'=>'span1')); ?>
            <?php echo $form->textField($model,'tel', array('class'=>'span2')); ?>
            </div>
    </div> 
    <div class="row" style="margin-top: 30px;"><div class="span8"><legend>Документы</legend></div></div>
    
    <p>
        <strong>
            Прикрепите скан-копию заявки.<br>Для замены файла, просто прикрепите другой файл и нажмите сохранить.
        </strong>
    </p>    
    
    <table class="table table-bordered table-hover table-striped">
      <thead>
        <tr>
          <th>Наименование</th>  
          <th>Файл</th>
          <th>Прикрепить</th>   
        </tr>
      </thead>
      <tbody>

        <tr>
          <td>Заявка<span class="required">*</span><br><em> (файл размером не более 5Мб в формате pdf или zip)</em></td> 
          <td><?php echo CHtml::link($model->obsh_r, array('abi25/scandown2', 'id'=>$model->id_report, 'type' => 1)); ?></td>
          <td><?php echo $form->fileField($model, 'file1'); ?></td>
        </tr>   

      </tbody>
    </table>          

<div class="form-actions">
    <?php $this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'submit', 'type'=>'primary', 'icon'=>'ok white', 'label'=>'Сохранить')); ?>
    <?php $this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'action', 'icon'=>'remove', 'label'=>'Отмена', 'url'=>$this->createUrl('abi25/edit',array('id_rep'=>$model->id_report)))); ?>
</div>

<?php $this->endWidget(); ?>    


