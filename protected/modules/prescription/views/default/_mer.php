<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
    'id'=>'mer_info',
    'type'=>'horizontal',    
    'enableAjaxValidation'=>false,
    'htmlOptions' => array('enctype'=>'multipart/form-data'),    
)); ?>

    <?php echo $form->errorSummary($model); ?>

    <?php echo $form->hiddenField($model,'id_pr') ?>

    <?php if(!$model->step2 || ($model->step2 == 2 && $model->id_naim == 24)|| ($model->step2 == 1 && $model->id_naim == 23)) echo $form->textAreaRow($model, 'naim', array('class'=>'span8', 'rows'=>5)); ?>

    <?php echo $form->textFieldRow($model,'norm', array('class'=>'span8')); ?>

    <?php echo $form->textFieldRow($model,'stat', array('class'=>'span3')); ?>

    <div class="control-group">
            <?php echo $form->labelEx($model,'srok',array('class'=>'control-label')); ?>
            <div class="controls">    
            <?php $this->widget('zii.widgets.jui.CJuiDatePicker', array(
                        'options'=>array(
                            'showAnim'=>'fold',
                            'dateFormat'=>'dd.mm.yy',
                            'changeYear'=>true,
                            'yearRange'=>'2010:2050'
                        ),
                        'language' => 'ru',
                        'attribute'=>'srok',
                        'model' => $model,
                        'htmlOptions'=>array(
                            'size'=>8,
                            'class'=>'input-small'
                        ),
                        ));
            ?>  
            </div>
    </div>

    <?php echo $form->textFieldRow($model,'summa', array('class'=>'span3')); ?>

    <h5>Сведения о финансировании устранения нарушения</h5>

    <?php echo $form->DropDownListRow($model, 'id_ist', CHtml::listData(Pr_ist::model()->findAll(array('order' => 'id_ist ASC')), 'id_ist', 'naim'), array('empty'=>'Выберите вариант', 'class'=>'span4')); ?>

    <?php echo $form->textFieldRow($model,'vsumma', array('class'=>'span3')); ?>

    <?php echo $form->checkboxRow($model, 'ppf'); ?>

    <div class="control-group">
            <?php echo $form->labelEx($model,'psrok',array('class'=>'control-label')); ?>
            <div class="controls">    
            <?php $this->widget('zii.widgets.jui.CJuiDatePicker', array(
                        'options'=>array(
                            'showAnim'=>'fold',
                            'dateFormat'=>'dd.mm.yy',
                            'changeYear'=>true,
                            'yearRange'=>'2010:2050'
                        ),
                        'language' => 'ru',
                        'attribute'=>'psrok',
                        'model' => $model,
                        'htmlOptions'=>array(
                            'size'=>8,
                            'class'=>'input-small'
                        ),
                        ));
            ?>  
            </div>
    </div>
    
    <div class="row" style="margin-top: 40px;"><div class="span12"><legend>Сведения об устранении нарушения.</legend></div></div> 
    <h5>Сведения о дате устранения нарушения</h5>
    <div class="control-group">
            <?php echo $form->labelEx($model,'fsrok',array('class'=>'control-label')); ?>
            <div class="controls">    
            <?php $this->widget('zii.widgets.jui.CJuiDatePicker', array(
                        'options'=>array(
                            'showAnim'=>'fold',
                            'dateFormat'=>'dd.mm.yy',
                            'changeYear'=>true,
                            'yearRange'=>'2010:2050'
                        ),
                        'language' => 'ru',
                        'attribute'=>'fsrok',
                        'model' => $model,
                        'htmlOptions'=>array(
                            'size'=>8,
                            'class'=>'input-small'
                        ),
                        ));
            ?>  
            </div>
    </div>
    <?php    if($type == 1) echo $form->fileFieldRow($model, 'image1');  
        else { ?>            
            <p><b>Прикрепите скан-копию подтверждения выполнения мероприятия (Акт выполненных работ, справка директора, иные документы). Допустимый размер файла не более 5 Мбайт. Допустимые форматы файла .pdf, .zip, .jpg, .gif, .png, .jpeg, .docx, .doc Для замены файла просто загрузите его еще раз. Для удаления файла поставьте галочку "Удаление файла" и сохраните мероприятие.</b></p>
            <table class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th>Наименование файла</th>
                        <th>Загрузка файла</th>
                        <th>Удаление файла</th>
                    </tr>
                </thead>
                <tbody>    
                    <tr>
                        <td>
                            <?php if($model->pod) echo CHtml::link($model->pod_r, array('poddown', 'id_mer'=>$model->id_mer)); ?><?php echo $form->error($model, 'image1'); ?>
                        </td>
                        <td style="width: 200px;">                    
                            <?php echo $form->fileField($model, 'image1'); ?>                      
                        </td>
                        <td><?php if($model->pod) echo $form->checkBox($model, 'del_pod');?></td>
                    </tr>
                </tbody>
            </table>
        <?php } ?>    

<div class="form-actions">
    <?php $this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'submit', 'type'=>'primary', 'icon'=>'ok white', 'label'=>'Сохранить')); ?>
    <?php $this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'action', 'icon'=>'remove', 'label'=>'Отмена', 'url'=>$this->createUrl("pred_update", array('id_pr'=>$model->id_pr)))); ?>
</div>

<?php $this->endWidget(); ?>  
    
<script type="text/javascript">
$(document).ready(function(){
    if($('#Pr_mer_ppf').attr("checked") == 'checked') {     
        $('#Pr_mer_psrok').attr('disabled', '');
    }
    else {     
        $('#Pr_mer_psrok').removeAttr('disabled'); 
    } 
});    
$('#Pr_mer_ppf').change(function () {
    if($(this).prop("checked")) {
        $('#Pr_mer_psrok').val("");
        $('#Pr_mer_psrok').attr('class', 'disabled');
        $('#Pr_mer_psrok').attr('class', 'input-small');
        $('#Pr_mer_psrok').attr('disabled', '');
    }
    else {
        $('#Pr_mer_psrok').removeClass('disabled');
        $('#Pr_mer_psrok').removeAttr('disabled');       
    }
});
</script> 

