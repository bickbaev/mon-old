<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
    'id'=>'pr_info',
    'type'=>'horizontal',    
    'enableAjaxValidation'=>false,
    'htmlOptions' => array('enctype'=>'multipart/form-data'),
)); ?>

    <?php echo $form->errorSummary($model); ?>

    <?php echo $form->DropDownListRow($model, 'id_type', CHtml::listData(Pr_type::model()->findAll(array('order' => 'id_type ASC')), 'id_type', 'naim'), array('empty'=>'Выберите вариант', 'class'=>'span4')); ?>

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

    <?php echo $form->DropDownListRow($model, 'isp', $model->get_isp(), array('empty'=>'Выберите вариант', 'class'=>'span3')); ?>

    <?php echo $form->textFieldRow($model, 'isp_naim', array('class'=>'span5', 'disabled'=>true)); ?>

    <?php if($type == 1) echo $form->fileFieldRow($model, 'image1');
    
        else { ?>

            <div class="row" style="margin-top: 40px;"><div class="span12"><legend>Скан-копия предписания</legend></div></div>
            <p><b>Прикрепите скан копию предписания. Допустимый размер файла не более 10 Мбайт. Допустимые форматы файла .pdf, .zip, .jpg, .gif, .png, .jpeg, .docx, .doc. Для замены файла просто загрузите его еще раз. Для удаления файла поставьте галочку "Удаление файла" и сохраните предписание.</b></p>
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
                            <?php if($model->pred) echo CHtml::link($model->pred_r, array('preddown', 'id_pr'=>$model->id_pr)); ?><?php echo $form->error($model, 'image1'); ?>
                        </td>
                        <td style="width: 200px;">                    
                            <?php echo $form->fileField($model, 'image1'); ?>                      
                        </td>
                        <td><?php if($model->pred) echo $form->checkBox($model, 'del_pred');?></td>
                    </tr>
                </tbody>
            </table>
        <?php } ?>

<div class="form-actions">
    <?php $this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'submit', 'type'=>'primary', 'icon'=>'ok white', 'label'=>'Сохранить')); ?>
    <?php 
        if($type == 1) $url = $this->createUrl("object_update", array('id_build'=>$model->id_build));
        else $url = $this->createUrl("pred_update", array('id_pr'=>$model->id_pr)); 
        $this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'action', 'icon'=>'remove', 'label'=>'Отмена', 'url'=>$url)); 
     ?>
</div>

<?php $this->endWidget(); ?>  
            
<script type="text/javascript">   
$('#Pr_pred_isp').change(function () {
    if($(this).val() != 2) {
        $('#Pr_pred_isp_naim').val("");
        $('#Pr_pred_isp_naim').attr('class', 'disabled');
        $('#Pr_pred_isp_naim').attr('class', 'span5');
        $('#Pr_pred_isp_naim').attr('disabled', '');
    }
    else {
        $('#Pr_pred_isp_naim').removeClass('disabled');
        $('#Pr_pred_isp_naim').removeAttr('disabled');       
    }
});
$(document).ready(function(){
    if($('#Pr_pred_isp').val() != 2) {     
        $('#Pr_pred_isp_naim').attr('disabled', '');
    }
    else {     
        $('#Pr_pred_isp_naim').removeClass('disabled');
        $('#Pr_pred_isp_naim').removeAttr('disabled');  
    }  
});             
</script>           
            

