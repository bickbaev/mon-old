<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
    'id'=>'building2015-form',
    'enableAjaxValidation'=>false,
    'type'=>'vertical',
    'htmlOptions' => array('enctype'=>'multipart/form-data'),    
)); ?>

    <blockquote><em>Поля помеченные<span class="required"> * </span>обязательны для заполнения.</em></blockquote>
    
    <h4 style="color:red;">Внимание! Информация о здании заполняется один раз. Если данные по зданию уже указывались в отчете по другому уровню образования (дошкольному, дополнительному и т.д.), указывать их в данном отчете не нужно.<br />Отчет сохранится только тогда, когда будути введены ответы на все вопросы, а также будут ПРИКРЕПЛЕНЫ ВСЕ необходимые файлы.<br />Еслу у Вас нет ответов на все вопросы или нет всех файлов отвечающих условиям, заполнять отчет нет смысла.</h4>
    
    <p><b>Инструкция по заполнению: укажите в соответствующих строках информацию об адресе здания и его характеристиках. По всем показателям требуются подтверждающие документы (указаны по каждому показателю в столбце "Подтверждающий документ"). Скан-копии данных документов необходимо запаковать в архив в формате zip (размер каждого файла не более 5 Мб) и прикрепить к отчету в разделе "Документы" (внизу отчета). Каждому документу должен соответствовать один zip-файл (даже если в несжатом виде это несколько файлов).</b></p>
    <p><b>Пояснение про акт комиссионного осмотра здания (помещений):</b><br />Составление акта комиссионного обследования здания и прилегающей к нему территории обусловлено необходимостью объективного установления и фиксации состояния исследуемого объекта.<br />
Заинтересованные участники (представители образовательного учреждения, муниципального образования, территориального управления министерства образования и науки Самарской области, надзорных органов (по согласованию) согласовывают и составляют акт комиссионного осмотра здания и прилегающей к нему территории.<br />
Для общеобразовательных учреждений г.о. Самара возможно применить акт, составляемый при приемке школ к новому учебному году.<br />
<a href="/res/monteh.zip">Разъясняющее письмо министерство образования и науки Самарской области и форма акта комиссонного осмотра.</a></p>

    <?php echo $form->errorSummary($model); ?>
    
    <?php echo $form->hiddenField($model,'id_report') ?>
    
    <div class="row" style="margin-top: 40px;"><div class="span12"><legend>Данные</legend></div></div>    
    
    <table class="table table-bordered table-hover" style="width: 1100px;">
         <thead>
        <tr>
        <th>Показатель</th>
        <th>Подтверждающий документ</th>
        <th>Значение</th>
        </tr>
        </thead>        
        <tbody>
            <tr>
                <td style="text-align: right;">
                    <?php echo $form->labelEx($model,'ur1'); ?><?php echo $form->error($model,'ur1'); ?>
                </td>
                <td>&nbsp;</td>
                <td style="width: 200px;">
                    <?php echo $form->dropDownList($model,'ur1', array('1' => 'Дошкольного образования', '2' => 'Общего образования', '3' => 'Дополнительного образования детей'), array('empty' => 'Выберите значение', 'class'=>'span3')); ?>
                </td>                
            </tr>           
            <tr>
                <td style="text-align: right;">
                    <?php echo $form->labelEx($model,'id_mun'); ?><?php echo $form->error($model,'id_mun'); ?>
                </td>
                <td>&nbsp;</td>
                <td style="width: 200px;">
                    <?php echo $form->dropDownList($model, 'id_mun', CHtml::listData(Mun::model()->findAll(array('order' => 'id_mun ASC')), 'id_mun', 'naim_mun'), array('empty'=>'Выберите вариант', 'class'=>'span3')); ?>
                </td>                
            </tr>
            <tr>
                <td style="text-align: right;">
                    <?php echo $form->labelEx($model,'nas_punkt_type'); ?><?php echo $form->error($model,'nas_punkt_type'); ?>
                </td>
                <td>&nbsp;</td>
                <td style="width: 200px;">
                    <?php echo $form->DropDownList($model, 'nas_punkt_type', CHtml::listData(Contact_gor::model()->findAll(array('order' => 'id_contact_gor ASC')), 'id_contact_gor', 'naim_gor'), array('empty'=>'Выберите вариант', 'class'=>'span3'));?>
                </td>                
            </tr> 
            <tr>
                <td style="text-align: right;">
                    <?php echo $form->labelEx($model,'nas_punkt'); ?><?php echo $form->error($model,'nas_punkt'); ?>
                </td>
                <td>&nbsp;</td>
                <td style="width: 200px;">
                    <?php echo $form->textField($model,'nas_punkt', array('class'=>'span3'));?>
                </td>                
            </tr>
            <tr>
                <td style="text-align: right;">
                    <?php echo $form->labelEx($model,'street_type'); ?><?php echo $form->error($model,'street_type'); ?>
                </td>
                <td>&nbsp;</td>
                <td style="width: 200px;">
                    <?php echo $form->dropDownList($model, 'street_type', CHtml::listData(Contact_ul::model()->findAll(array('order' => 'id_contact_ul ASC')), 'id_contact_ul', 'naim_ul'), array('empty'=>'Выберите вариант', 'class'=>'span3'));?>
                </td>                
            </tr> 
            <tr>
                <td style="text-align: right;">
                    <?php echo $form->labelEx($model,'street'); ?><?php echo $form->error($model,'street'); ?>
                </td>
                <td>&nbsp;</td>
                <td style="width: 200px;">
                    <?php echo $form->textField($model,'street', array('class'=>'span3'));?>
                </td>                
            </tr> 
            <tr>
                <td style="text-align: right;">
                    <?php echo $form->labelEx($model,'dom'); ?><?php echo $form->error($model,'dom'); ?>
                </td>
                <td>&nbsp;</td>
                <td style="width: 200px;">
                    <?php echo $form->textField($model,'dom', array('class'=>'span1'));?>
                </td>                
            </tr>
            <tr>
                <td style="text-align: right;">
                    <?php echo $form->labelEx($model,'litera'); ?><?php echo $form->error($model,'litera'); ?>
                </td>
                <td>&nbsp;</td>
                <td style="width: 200px;">
                    <?php echo $form->textField($model,'litera', array('class'=>'span1'));?>
                </td>                
            </tr>
            <tr>
                <td>
                    <?php echo $form->labelEx($model,'pok1'); ?><?php echo $form->error($model,'pok1'); ?>
                </td>
                <td>Акт комиссионного осмотра здания (помещений)</td>
                <td style="width: 200px;">
                    <?php echo $form->dropDownList($model,'pok1', array('1' => 'Да', '2' => 'Нет'), array('empty' => 'Выберите значение', 'class'=>'span2')); ?>
                </td>                
            </tr>
            <tr>
                <td>
                    <?php echo $form->labelEx($model,'pok2'); ?><?php echo $form->error($model,'pok2'); ?>
                </td>
                <td>Акт комиссионного осмотра здания (помещений)</td>
                <td style="width: 200px;">
                    <?php echo $form->dropDownList($model,'pok2', array('1' => 'Да', '2' => 'Нет'), array('empty' => 'Выберите значение', 'class'=>'span2')); ?>
                </td>                
            </tr>
            <tr>
                <td>
                    <?php echo $form->labelEx($model,'pok3'); ?><?php echo $form->error($model,'pok3'); ?>
                </td>
                <td>Акт комиссионного осмотра здания (помещений)</td>
                <td style="width: 200px;">
                    <?php echo $form->dropDownList($model,'pok3', array('1' => 'Да', '2' => 'Нет'), array('empty' => 'Выберите значение', 'class'=>'span2')); ?>
                </td>                
            </tr>
            <tr>
                <td>
                    <?php echo $form->labelEx($model,'pok4'); ?><?php echo $form->error($model,'pok4'); ?>
                </td>
                <td>Акт комиссионного осмотра здания (помещений)</td>
                <td style="width: 200px;">
                    <?php echo $form->dropDownList($model,'pok4', array('1' => 'Да', '2' => 'Нет'), array('empty' => 'Выберите значение', 'class'=>'span2')); ?>
                </td>                
            </tr>
            <tr>
                <td>
                    <?php echo $form->labelEx($model,'pok5'); ?><?php echo $form->error($model,'pok5'); ?>
                </td>
                <td>Акт комиссионного осмотра здания (помещений)</td>
                <td style="width: 200px;">
                    <?php echo $form->dropDownList($model,'pok5', array('1' => 'Да', '2' => 'Нет'), array('empty' => 'Выберите значение', 'class'=>'span2')); ?>
                </td>                
            </tr>
            <tr>
                <td>
                    <?php echo $form->labelEx($model,'pok6'); ?><?php echo $form->error($model,'pok6'); ?>
                </td>
                <td>Акт комиссионного осмотра здания (помещений)</td>
                <td style="width: 200px;">
                    <?php echo $form->dropDownList($model,'pok6', array('1' => 'Да', '2' => 'Нет'), array('empty' => 'Выберите значение', 'class'=>'span2')); ?>
                </td>                
            </tr>
            <tr>
                <td>
                    <?php echo $form->labelEx($model,'pok7'); ?><?php echo $form->error($model,'pok7'); ?>
                </td>
                <td>Акт комиссионного осмотра здания (помещений)</td>
                <td style="width: 200px;">
                    <?php echo $form->dropDownList($model,'pok7', array('1' => 'Да', '2' => 'Нет'), array('empty' => 'Выберите значение', 'class'=>'span2')); ?>
                </td>                
            </tr>
            <tr>
                <td>
                    <?php echo $form->labelEx($model,'pok8'); ?><?php echo $form->error($model,'pok8'); ?>
                </td>
                <td>Предписание по устранению нарушений обязательных требований пожарной безопасности (прикладывается, если ответ "нет")</td>
                <td style="width: 200px;">
                    <?php echo $form->dropDownList($model,'pok8', array('1' => 'Да', '2' => 'Нет'), array('empty' => 'Выберите значение', 'class'=>'span2')); ?>
                </td>                
            </tr>
            <tr>
                <td>
                    <?php echo $form->labelEx($model,'pok9'); ?><?php echo $form->error($model,'pok9'); ?>
                </td>
                <td>Акт приемки в эксплуатацию, договор на обслуживание автоматической пожарной сигнализации</td>
                <td style="width: 200px;">
                    <?php echo $form->dropDownList($model,'pok9', array('1' => 'Да', '2' => 'Нет'), array('empty' => 'Выберите значение', 'class'=>'span2')); ?>
                </td>                
            </tr>
            <tr>
                <td>
                    <?php echo $form->labelEx($model,'pok10'); ?><?php echo $form->error($model,'pok10'); ?>
                </td>
                <td>Предписание по устранению нарушений обязательных требований пожарной безопасности (прикладывается, если ответ "нет")</td>
                <td style="width: 200px;">
                    <?php echo $form->dropDownList($model,'pok10', array('1' => 'Да', '2' => 'Нет'), array('empty' => 'Выберите значение', 'class'=>'span2')); ?>
                </td>                
            </tr>
            <tr>
                <td>
                    <?php echo $form->labelEx($model,'pok11'); ?><?php echo $form->error($model,'pok11'); ?>
                </td>
                <td>Предписание по устранению нарушений обязательных требований пожарной безопасности (прикладывается, если ответ "нет")</td>
                <td style="width: 200px;">
                    <?php echo $form->dropDownList($model,'pok11', array('1' => 'Да', '2' => 'Нет'), array('empty' => 'Выберите значение', 'class'=>'span2')); ?>
                </td>                
            </tr>
            <tr>
                <td>
                    <?php echo $form->labelEx($model,'pok12'); ?><?php echo $form->error($model,'pok12'); ?>
                </td>
                <td>Акт комиссионного осмотра здания (помещений) или отчет о техническом состоянии, подготовленный специализированной организацией</td>
                <td style="width: 200px;">
                    <?php echo $form->dropDownList($model,'pok12', array('1' => 'Да', '2' => 'Нет'), array('empty' => 'Выберите значение', 'class'=>'span2')); ?>
                </td>                
            </tr>
            <tr>
                <td>
                    <?php echo $form->labelEx($model,'pok13'); ?><?php echo $form->error($model,'pok13'); ?>
                </td>
                <td>Акт комиссионного осмотра здания (помещений) или отчет о техническом состоянии, подготовленный специализированной организацией</td>
                <td style="width: 200px;">
                    <?php echo $form->dropDownList($model,'pok13', array('1' => 'Да', '2' => 'Нет'), array('empty' => 'Выберите значение', 'class'=>'span2')); ?>
                </td>                
            </tr>
            <tr>
                <td>
                    <?php echo $form->labelEx($model,'pok14'); ?><?php echo $form->error($model,'pok14'); ?>
                </td>
                <td>Акт комиссионного осмотра здания (помещений) или отчет о техническом состоянии, подготовленный специализированной организацией</td>
                <td style="width: 200px;">
                    <?php echo $form->dropDownList($model,'pok14', array('1' => 'Да', '2' => 'Нет'), array('empty' => 'Выберите значение', 'class'=>'span2')); ?>
                </td>                
            </tr>
            <tr>
                <td>
                    <?php echo $form->labelEx($model,'pok15'); ?><?php echo $form->error($model,'pok15'); ?>
                </td>
                <td>Предписание по устранению нарушений обязательных требований пожарной безопасности (прикладывается, если ответ "нет")</td>
                <td style="width: 200px;">
                    <?php echo $form->dropDownList($model,'pok15', array('1' => 'Да', '2' => 'Нет'), array('empty' => 'Выберите значение', 'class'=>'span2')); ?>
                </td>                
            </tr>
            <tr>
                <td>
                    <?php echo $form->labelEx($model,'pok16'); ?><?php echo $form->error($model,'pok16'); ?>
                </td>
                <td>Акт комиссионного осмотра здания (помещений)</td>
                <td style="width: 200px;">
                    <?php echo $form->dropDownList($model,'pok16', array('1' => 'Да', '2' => 'Нет'), array('empty' => 'Выберите значение', 'class'=>'span2')); ?>
                </td>                
            </tr>
            <tr>
                <td>
                    <?php echo $form->labelEx($model,'pok17'); ?><?php echo $form->error($model,'pok17'); ?>
                </td>
                <td>Акт комиссионного осмотра здания (помещений)</td>
                <td style="width: 200px;">
                    <?php echo $form->dropDownList($model,'pok17', array('1' => 'Да', '2' => 'Нет'), array('empty' => 'Выберите значение', 'class'=>'span2')); ?>
                </td>                
            </tr>
            <tr>
                <td>
                    <?php echo $form->labelEx($model,'pok18'); ?><?php echo $form->error($model,'pok18'); ?>
                </td>
                <td>Акт комиссионного осмотра здания (помещений)</td>
                <td style="width: 200px;">
                    <?php echo $form->dropDownList($model,'pok18', array('1' => 'Да', '2' => 'Нет'), array('empty' => 'Выберите значение', 'class'=>'span2')); ?>
                </td>                
            </tr>
            <tr>
                <td>
                    <?php echo $form->labelEx($model,'pok19'); ?><?php echo $form->error($model,'pok19'); ?>
                </td>
                <td>Акт комиссионного осмотра здания (помещений)</td>
                <td style="width: 200px;">
                    <?php echo $form->dropDownList($model,'pok19', array('1' => 'Да', '2' => 'Нет'), array('empty' => 'Выберите значение', 'class'=>'span2')); ?>
                </td>                
            </tr>
            <tr>
                <td>
                    <?php echo $form->labelEx($model,'pok20'); ?><?php echo $form->error($model,'pok20'); ?>
                </td>
                <td>Акт комиссионного осмотра здания (помещений)</td>
                <td style="width: 200px;">
                    <?php echo $form->dropDownList($model,'pok20', array('1' => 'Да', '2' => 'Нет'), array('empty' => 'Выберите значение', 'class'=>'span2')); ?>
                </td>                
            </tr>
            <tr>
                <td>
                    <?php echo $form->labelEx($model,'pok21'); ?><?php echo $form->error($model,'pok21'); ?>
                </td>
                <td>Акт комиссионного осмотра здания (помещений) или отчет о техническом состоянии, подготовленный специализированной организацией</td>
                <td style="width: 200px;">
                    <?php echo $form->dropDownList($model,'pok21', array('1' => 'Да', '2' => 'Нет'), array('empty' => 'Выберите значение', 'class'=>'span2')); ?>
                </td>                
            </tr>           
        </tbody>
    </table>    
    
    <div class="row" style="margin-top: 40px;"><div class="span12"><legend>Документы. Прикрепите сжатые в формате zip документы (каждый документ в виде одного zip-файла размером не более 5 Мб)</legend></div></div>
    <p><b>Для удаления прикрепленных файлов поставьте "галочку" напротив нужных файлов и сохраните отчет</b></p>
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
                    <?php echo $form->labelEx($model,'doc1u'); ?><?php echo $form->error($model,'doc1u'); ?>
                </td>
                <td style="width: 200px;">
                    <?php if($model->doc1) echo '<span style="color:green;">Файл уже загружен. Для замены снова загрузите файл.</span>'; ?>
                    <?php echo $form->fileField($model,'doc1u'); ?>                      
                </td>
                <td><?php if($model->doc1) echo $form->checkBox($model,'file1d'); ?></td>
            </tr>
            <tr>
                <td>
                    <?php echo $form->labelEx($model,'doc2u'); ?><?php echo $form->error($model,'doc2u'); ?>
                </td>
                <td style="width: 200px;">
                    <?php if($model->doc2) echo '<span style="color:green;">Файл уже загружен. Для замены снова загрузите файл.</span>'; ?>
                    <?php echo $form->fileField($model,'doc2u'); ?>
                </td>  
                <td><?php if($model->doc2) echo $form->checkBox($model,'file2d'); ?></td>
            </tr> 
            <tr>
                <td>
                    <?php echo $form->labelEx($model,'doc3u'); ?><?php echo $form->error($model,'doc3u'); ?>
                </td>
                <td style="width: 200px;">
                    <?php if($model->doc3) echo '<span style="color:green;">Файл уже загружен. Для замены снова загрузите файл.</span>'; ?>
                    <?php echo $form->fileField($model,'doc3u'); ?>
                </td>
                <td><?php if($model->doc3) echo $form->checkBox($model,'file3d'); ?></td>
            </tr> 
            <tr>
                <td>
                    <?php echo $form->labelEx($model,'doc4u'); ?><?php echo $form->error($model,'doc4u'); ?>
                </td>
                <td style="width: 200px;">
                    <?php if($model->doc4) echo '<span style="color:green;">Файл уже загружен. Для замены снова загрузите файл.</span>'; ?>
                    <?php echo $form->fileField($model,'doc4u'); ?>
                </td>
                <td><?php if($model->doc4) echo $form->checkBox($model,'file4d'); ?></td>
            </tr>
            <tr>
                <td>
                    <?php echo $form->labelEx($model,'doc5u'); ?><?php echo $form->error($model,'doc5u'); ?>
                </td>
                <td style="width: 200px;">
                    <?php if($model->doc5) echo '<span style="color:green;">Файл уже загружен. Для замены снова загрузите файл.</span>'; ?>
                    <?php echo $form->fileField($model,'doc5u'); ?>
                </td>
                <td><?php if($model->doc5) echo $form->checkBox($model,'file5d'); ?></td>
            </tr>            
        </tbody>
    </table>     

    <div class="form-actions">
    <?php $this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'submit', 'type'=>'primary', 'icon'=>'ok white', 'label'=>'Сохранить')); ?>
    <?php $this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'action', 'icon'=>'remove', 'label'=>'Отмена', 'url'=>$this->createUrl('building2015/edit',array('id_rep'=>$model->id_report)))); ?>
    </div>

<?php $this->endWidget(); ?>
