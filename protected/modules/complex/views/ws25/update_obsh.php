<fieldset><legend>Информация об ответственном от организации</legend></fieldset>
<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
    'id'=>'obsh-form',
    'type'=>'horizontal',    
    'enableAjaxValidation'=>false,
    'htmlOptions' => array('enctype'=>'multipart/form-data'),
)); ?>

    <blockquote><em>Поля помеченные<span class="required"> * </span>обязательны для заполнения.</em></blockquote>

    <?php echo $form->errorSummary($model); ?>
    
    <?php echo $form->textFieldRow($model,'pok1',array('class'=>'span3','maxlength'=>255)); ?>    

    <?php echo $form->textFieldRow($model,'pok2',array('class'=>'span3','maxlength'=>255)); ?>

    <?php echo $form->textFieldRow($model,'pok3',array('class'=>'span3','maxlength'=>255)); ?>
    
    <?php echo $form->textFieldRow($model,'pok9',array('class'=>'span3','maxlength'=>255)); ?>

    <div class="control-group">
            <?php echo $form->labelEx($model,'pok5',array('class'=>'control-label')); ?>
            <div class="controls">+7     
            <?php echo $form->textField($model,'pok4', array('class'=>'span1')); ?>
            <?php echo $form->textField($model,'pok5', array('class'=>'span2')); ?>
            </div>
    </div>
    
    <div class="row" style="margin-top: 30px;"><div class="span8"><legend>Документы</legend></div></div>
    
    <p>
        <strong>
            Прикрепите скан-копии указанных документов.<br>Для замены файла, просто прикрепите другой файл и нажмите сохранить.
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
          <td>Заявка<span class="required">*</span><br><em> (файл размером не более 5Мб в формате pdf, zip или изображение в формате jpg, gif, png, jpeg)</em></td> 
          <td><?php echo CHtml::link($model->pok6_r, array('ws25/scandown', 'id_rep'=>$model->id_report, 'id' => 6)); ?></td>
          <td><?php echo $form->fileField($model, 'file6'); ?></td>
        </tr>

        <tr>
          <td>Протоколы отборочных соревнований<span class="required">*</span><br><em> (файл размером не более 5Мб в формате pdf или zip)</em></td>   
          <td><?php echo CHtml::link($model->pok7_r, array('ws25/scandown', 'id_rep'=>$model->id_report, 'id' => 7)); ?></td>
          <td><?php echo $form->fileField($model, 'file7'); ?></td>
        </tr>

        <tr>
          <td>Письмо – подтверждение потребности/отсутствия потребности в проживании<span class="required">*</span><br><em> (файл размером не более 5Мб в формате pdf, zip или изображение в формате jpg, gif, png, jpeg)</em></td>   
          <td><?php echo CHtml::link($model->pok8_r, array('ws25/scandown', 'id_rep'=>$model->id_report, 'id' => 8)); ?></td>
          <td><?php echo $form->fileField($model, 'file8'); ?></td>
        </tr>    

      </tbody>
    </table>      

<div class="form-actions">
    <?php $this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'submit', 'type'=>'primary', 'icon'=>'ok white', 'label'=>'Сохранить')); ?>
    <?php $this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'action', 'icon'=>'remove', 'label'=>'Отмена', 'url'=>$this->createUrl('ws25/edit',array('id_rep'=>$model->id_report)))); ?>
</div>

<?php $this->endWidget(); ?>    
