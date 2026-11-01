<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
    'id'=>'building2015-form',
    'enableAjaxValidation'=>false,
    //'type'=>'vertical',
    'htmlOptions' => array('enctype'=>'multipart/form-data'),    
)); ?>

    <blockquote><em>Поля помеченные<span class="required"> * </span>обязательны для заполнения.</em></blockquote>
    
    <?php echo $form->errorSummary($model); ?>
    
    <?php echo $form->hiddenField($model,'id_report') ?>
    <legend>Общие данные</legend>
    <?php echo $form->dropDownListRow($model, 'id_mun', CHtml::listData(Mun::model()->findAll(array('order' => 'id_mun ASC')), 'id_mun', 'naim_mun'), array('empty'=>'Выберите вариант', 'class'=>'span3')); ?>
    <?php echo $form->DropDownListRow($model, 'nas_punkt_type', CHtml::listData(Contact_gor::model()->findAll(array('order' => 'id_contact_gor ASC')), 'id_contact_gor', 'naim_gor'), array('empty'=>'Выберите вариант', 'class'=>'span3'));?>
    <?php echo $form->textFieldRow($model, 'nas_punkt'); ?>
    <?php echo $form->dropDownListRow($model, 'street_type', CHtml::listData(Contact_ul::model()->findAll(array('order' => 'id_contact_ul ASC')), 'id_contact_ul', 'naim_ul'), array('empty'=>'Выберите вариант', 'class'=>'span3'));?>
    <?php echo $form->textFieldRow($model, 'street'); ?>
    <?php echo $form->textFieldRow($model, 'dom'); ?>
    <?php echo $form->textFieldRow($model, 'litera'); ?>
    <?php echo $form->textFieldRow($model, 'pl'); ?>
    <?php echo $form->textFieldRow($model, 'godp'); ?>
    <?php echo $form->textFieldRow($model, 'eta'); ?>
    <?php echo $form->textFieldRow($model, 'izn'); ?>
    <?php echo $form->checkBoxRow($model, 'sport'); ?>
    <?php echo $form->checkBoxRow($model, 'pish'); ?>
    <?php echo $form->checkBoxRow($model, 'vodo'); ?>
    <?php echo $form->checkBoxRow($model, 'kanal'); ?>
    <?php echo $form->textFieldRow($model, 'sanvn'); ?>
    <?php echo $form->textFieldRow($model, 'sannar'); ?>     
    <?php echo $form->checkBoxRow($model, 'otopl'); ?>
    <?php echo $form->checkBoxRow($model, 'ogr'); ?>
    <legend>Тип здания</legend>
    <?php echo $form->checkBoxRow($model, 'otd'); ?>
    <?php echo $form->checkBoxRow($model, 'fil'); ?>
    <?php echo $form->checkBoxRow($model, 'hoz'); ?>
    <?php echo $form->checkBoxRow($model, 'bass'); ?>
    <?php echo $form->checkBoxRow($model, 'sportz'); ?>
    <legend>Реализуемые в здании образовательные программы</legend>
    <?php echo $form->checkBoxRow($model, 'doo'); ?>
    <?php echo $form->checkBoxRow($model, 'noo'); ?>
    <?php echo $form->checkBoxRow($model, 'ooo'); ?>
    <?php echo $form->checkBoxRow($model, 'soo'); ?>
    <?php echo $form->checkBoxRow($model, 'dop'); ?>
    <?php echo $form->checkBoxRow($model, 'dpredo'); ?>
    <?php echo $form->checkBoxRow($model, 'spo'); ?>
    <?php echo $form->checkBoxRow($model, 'oppo'); ?>
    <?php echo $form->checkBoxRow($model, 'dpo'); ?>
    <?php echo $form->checkBoxRow($model, 'ovo'); ?>
    <legend>Пожарная охрана</legend>
    <?php echo $form->checkBoxRow($model, 'aps'); ?>
    <?php echo $form->checkBoxRow($model, 'di'); ?>
    <?php echo $form->checkBoxRow($model, 'pokr'); ?>
    <?php echo $form->checkBoxRow($model, 'v01'); ?>
    <legend>Тип охраны</legend>
    <?php echo $form->checkBoxRow($model, 'chop'); ?>
    <?php echo $form->checkBoxRow($model, 'vohr'); ?>
    <?php echo $form->checkBoxRow($model, 'vahta'); ?>
    <legend>Охранные системы</legend>
    <?php echo $form->checkBoxRow($model, 'kevp'); ?>
    <?php echo $form->checkBoxRow($model, 'video'); ?>
    <?php echo $form->checkBoxRow($model, 'skud'); ?>

    <div class="row" style="margin-top: 40px;"><div class="span12"><legend>Правоустанавливающие документы.</legend></div></div>
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
                    <?php echo $form->labelEx($model,'sszd'); ?><?php echo $form->error($model,'doc1u'); ?>
                </td>
                <td style="width: 200px;">
                    <?php if($model->sszd) echo '<span style="color:green;">Файл уже загружен. Для замены снова загрузите файл.</span>'; ?>
                    <?php echo $form->fileField($model,'doc1u'); ?>                      
                </td>
                <td><?php if($model->sszd) echo $form->checkBox($model,'file1d'); ?></td>
            </tr>
            <tr>
                <td>
                    <?php echo $form->labelEx($model,'sszem'); ?><?php echo $form->error($model,'doc2u'); ?>
                </td>
                <td style="width: 200px;">
                    <?php if($model->sszem) echo '<span style="color:green;">Файл уже загружен. Для замены снова загрузите файл.</span>'; ?>
                    <?php echo $form->fileField($model,'doc2u'); ?>
                </td>  
                <td><?php if($model->sszem) echo $form->checkBox($model,'file2d'); ?></td>
            </tr> 
            <tr>
                <td>
                    <?php echo $form->labelEx($model,'tp'); ?><?php echo $form->error($model,'doc3u'); ?>
                </td>
                <td style="width: 200px;">
                    <?php if($model->tp) echo '<span style="color:green;">Файл уже загружен. Для замены снова загрузите файл.</span>'; ?>
                    <?php echo $form->fileField($model,'doc3u'); ?>
                </td>
                <td><?php if($model->tp) echo $form->checkBox($model,'file3d'); ?></td>
            </tr>
            <th colspan="3" scope="col">Иные правоустановливающие документы. Введите названия и прикрепите до 5 документов.</th>
            <tr>
                <td>
                    <?php echo $form->textFieldRow($model, 'nazv1', array('class'=>'span5')); ?>
                </td>
                <td style="width: 200px;">
                    <?php if($model->nazv1) echo '<span style="color:green;">Файл уже загружен. Для замены снова загрузите файл.</span>'; ?>
                    <?php echo $form->fileField($model,'doc4u'); ?>
                </td>
                <td><?php if($model->nazv1) echo $form->checkBox($model,'file4d'); ?></td>
            </tr> 
            <tr>
                <td>
                    <?php echo $form->textFieldRow($model, 'nazv2', array('class'=>'span5')); ?>
                </td>
                <td style="width: 200px;">
                    <?php if($model->nazv2) echo '<span style="color:green;">Файл уже загружен. Для замены снова загрузите файл.</span>'; ?>
                    <?php echo $form->fileField($model,'doc5u'); ?>
                </td>
                <td><?php if($model->nazv2) echo $form->checkBox($model,'file5d'); ?></td>
            </tr>
            <tr>
                <td>
                    <?php echo $form->textFieldRow($model, 'nazv3', array('class'=>'span5')); ?>
                </td>
                <td style="width: 200px;">
                    <?php if($model->nazv3) echo '<span style="color:green;">Файл уже загружен. Для замены снова загрузите файл.</span>'; ?>
                    <?php echo $form->fileField($model,'doc6u'); ?>
                </td>
                <td><?php if($model->nazv3) echo $form->checkBox($model,'file6d'); ?></td>
            </tr>
            <tr>
                <td>
                    <?php echo $form->textFieldRow($model, 'nazv4', array('class'=>'span5')); ?>
                </td>
                <td style="width: 200px;">
                    <?php if($model->nazv4) echo '<span style="color:green;">Файл уже загружен. Для замены снова загрузите файл.</span>'; ?>
                    <?php echo $form->fileField($model,'doc7u'); ?>
                </td>
                <td><?php if($model->nazv4) echo $form->checkBox($model,'file7d'); ?></td>
            </tr>
            <tr>
                <td>
                    <?php echo $form->textFieldRow($model, 'nazv5', array('class'=>'span5')); ?>
                </td>
                <td style="width: 200px;">
                    <?php if($model->nazv5) echo '<span style="color:green;">Файл уже загружен. Для замены снова загрузите файл.</span>'; ?>
                    <?php echo $form->fileField($model,'doc8u'); ?>
                </td>
                <td><?php if($model->nazv5) echo $form->checkBox($model,'file8d'); ?></td>
            </tr>           
        </tbody>
    </table>       


    <div class="form-actions">
    <?php $this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'submit', 'type'=>'primary', 'icon'=>'ok white', 'label'=>'Сохранить')); ?>
    <?php $this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'action', 'icon'=>'remove', 'label'=>'Отмена', 'url'=>$this->createUrl('building2018/update',array('id_building'=>$model->id_building)))); ?>
    </div>

<?php $this->endWidget(); ?>    

