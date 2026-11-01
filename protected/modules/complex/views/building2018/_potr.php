<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
    'id'=>'karta-filial-form',
    'type'=>'horizontal',    
    'enableAjaxValidation'=>false,
    'htmlOptions' => array('enctype'=>'multipart/form-data'),
)); ?>

    <blockquote><em>Поля помеченные<span class="required"> * </span>обязательны для заполнения.</em></blockquote>

    <?php echo $form->errorSummary($model); ?>
    
    <?php echo $form->dropDownListRow($model, 'id_inic', CHtml::listData(Building2018_inic::model()->findAll(array('order' => 'id_inic ASC')), 'id_inic', 'naim_inic'), array('empty'=>'Выберите инициатора', 'class'=>'span3')); ?>    

    <div class="control-group">
            <?php echo $form->labelEx($model,'datar',array('class'=>'control-label')); ?>
            <div class="controls">    
            <?php $this->widget('zii.widgets.jui.CJuiDatePicker', array(
                        'options'=>array(
                            'showAnim'=>'fold',
                            'dateFormat'=>'dd.mm.yy',
                            'changeYear'=>true,
                            'yearRange'=>'2012:2050'
                        ),
                        'language' => 'ru',
                        'attribute'=>'datar',
                        'model' => $model,
                        'htmlOptions'=>array(
                            'size'=>8,
                            'class'=>'input-small'
                        ),
                        ));
            ?>  
            </div>
    </div>        

    <?php echo $form->textFieldRow($model,'num',array('class'=>'span1','maxlength'=>255)); ?>
    
    <?php echo $form->textFieldRow($model,'price',array('class'=>'span2','maxlength'=>255)); ?>    
    
    <div class="row" style="margin-top: 40px;"><div class="span12"><legend>Документация</legend></div></div>
    <p><b>Прикрепите сжатые в формате zip документы (каждый документ в виде одного zip-файла размером не более 25 Мб). Для удаления прикрепленных файлов поставьте "галочку" напротив ненужных файлов и сохраните отчет</b></p>
    <table class="table table-bordered table-hover" style="width: 1100px;">
        <thead>
            <tr>
                <th>Наименование документа</th>
                <th>Загрузка файла</th>
                <th>Удаление файла</th>
            </tr>
        </thead>
        <tbody>    
            <tr>
                <td>
                    <?php echo $form->labelEx($model,'tz'); ?><?php echo $form->error($model,'doc1u'); ?>
                </td>
                <td style="width: 200px;">
                    <?php if($model->tz) echo '<span style="color:green;">Файл уже загружен. Для замены снова загрузите файл.</span>'; ?>
                    <?php echo $form->fileField($model,'doc1u'); ?>                      
                </td>
                <td><?php if($model->tz) echo $form->checkBox($model,'file1d'); ?></td>
            </tr>
            <tr>
                <td>
                    <?php echo $form->labelEx($model,'zakl'); ?><?php echo $form->error($model,'doc2u'); ?>
                </td>
                <td style="width: 200px;">
                    <?php if($model->zakl) echo '<span style="color:green;">Файл уже загружен. Для замены снова загрузите файл.</span>'; ?>
                    <?php echo $form->fileField($model,'doc2u'); ?>
                </td>  
                <td><?php if($model->zakl) echo $form->checkBox($model,'file2d'); ?></td>
            </tr> 
            <tr>
                <td>
                    <?php echo $form->labelEx($model,'psd'); ?><?php echo $form->error($model,'doc3u'); ?>
                </td>
                <td style="width: 200px;">
                    <?php if($model->psd) echo '<span style="color:green;">Файл уже загружен. Для замены снова загрузите файл.</span>'; ?>
                    <?php echo $form->fileField($model,'doc3u'); ?>
                </td>
                <td><?php if($model->psd) echo $form->checkBox($model,'file3d'); ?></td>
            </tr>
        </tbody>
    </table>    

    

    <div class="form-actions">
    <?php $this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'submit', 'type'=>'primary', 'icon'=>'ok white', 'label'=>'Сохранить')); ?>
    <?php $this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'action', 'icon'=>'remove', 'label'=>'Отмена', 'url'=>$this->createUrl('karta/edit',array('id_rep'=>$model->id_report)))); ?>
    </div>

<?php $this->endWidget(); ?>

