<?php
$form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
    'id'=>'abi25-exp-form',
    'type'=>'horizontal',    
    'enableAjaxValidation'=>true,
    'enableClientValidation'=>true,
    'clientOptions'=>array(
        'validateOnSubmit'=>true,
        'validateOnChange'=>false,
        'afterValidate'=>'js:function(form, data, hasError) {
            if (!hasError) {
                // Показываем индикатор загрузки
                form.addClass("form-submitting");
                $(".form-actions button[type=submit]").prop("disabled", true);
                
                // Создаем FormData для отправки файлов
                var formData = new FormData(form[0]);
                
                $.ajax({
                    type: "POST",
                    url: form.attr("action"),
                    data: formData,
                    processData: false,
                    contentType: false,
                    dataType: "json",
                    success: function(response) {
                        if (response.status == "success") {
                            window.location.href = response.redirect;
                        } else if (response.status == "error") {
                            // Очищаем предыдущие ошибки
                            $(".errorMessage").hide();
                            $(".has-error").removeClass("has-error");
                            
                            // Отображаем новые ошибки
                            $.each(response.errors, function(attribute, messages) {
                                var $field = $("#Abi25_exp_" + attribute);
                                var $errorContainer = $field.closest(".control-group").find(".help-inline.errorMessage");
                                
                                if ($errorContainer.length === 0) {
                                    $errorContainer = $("<span>").addClass("help-inline errorMessage");
                                    $field.closest(".controls").append($errorContainer);
                                }
                                
                                $errorContainer.html(messages.join("<br>")).show();
                                $field.closest(".control-group").addClass("error has-error");
                            });
                            
                            // Прокрутка к первой ошибке
                            var firstError = $(".has-error:first");
                            if (firstError.length) {
                                $("html, body").animate({
                                    scrollTop: firstError.offset().top - 100
                                }, 500);
                            }
                        }
                    },
                    error: function(xhr, status, error) {
                        alert("Произошла ошибка при отправке данных: " + error);
                    },
                    complete: function() {
                        form.removeClass("form-submitting");
                        $(".form-actions button[type=submit]").prop("disabled", false);
                    }
                });
            }
            return false;
        }'
    ),
    'htmlOptions' => array(
        'enctype'=>'multipart/form-data',
        'onsubmit' => 'return false;' // Предотвращаем стандартную отправку
    ),
)); ?>


    <blockquote><em>Поля помеченные<span class="required"> * </span>обязательны для заполнения.</em></blockquote>

    <?php echo $form->errorSummary($model); ?>
    
    <?php echo $form->textFieldRow($model,'surname',array('class'=>'span3','maxlength'=>255)); ?>    

    <?php echo $form->textFieldRow($model,'name',array('class'=>'span3','maxlength'=>255)); ?>

    <?php echo $form->textFieldRow($model,'patr',array('class'=>'span3','maxlength'=>255)); ?>
    

    <div class="control-group">
            <?php echo $form->labelEx($model,'burthdate',array('class'=>'control-label')); ?>
            <div class="controls">    
            <?php $this->widget('zii.widgets.jui.CJuiDatePicker', array(
                        'options'=>array(
                            'showAnim'=>'fold',
                            'dateFormat'=>'dd.mm.yy',
                            'changeYear'=>true,
                            'yearRange'=>'1940:2048'
                        ),
                        'language' => 'ru',
                        'attribute'=>'burthdate',
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
            <?php echo $form->labelEx($model,'lic_tel',array('class'=>'control-label')); ?>
            <div class="controls">+7     
            <?php echo $form->textField($model,'lic_code', array('class'=>'span1')); ?>
            <?php echo $form->textField($model,'lic_tel', array('class'=>'span2')); ?>
            </div>
    </div>

    <?php echo $form->textFieldRow($model,'lic_mail',array('class'=>'span3','maxlength'=>255)); ?>    
    
    <?php echo $form->dropDownListRow($model, 'id_compet', CHtml::listData(Abi25_compet::model()->findAll('id_comp=:id_comp', array(':id_comp'=>$id_comp)), 'id', 'naim'), array('empty'=>'Выберите компетенцию', 'class'=>'span6')); ?>            
    
    <?php echo $form->checkBoxRow($model,'gl_exp'); ?>
    
    <?php echo $form->checkBoxRow($model,'exp'); ?>
    
    <?php echo $form->checkBoxRow($model,'podg_exp'); ?>
    
    <?php echo $form->checkBoxRow($model,'podg_nac_exp'); ?>

    <?php echo $form->textFieldRow($model,'rabota',array('class'=>'span3','maxlength'=>255)); ?>

    <?php echo $form->textFieldRow($model,'dol',array('class'=>'span3','maxlength'=>255)); ?>
    
    <?php echo $form->dropDownListRow($model, 'id_obr', CHtml::listData(Abi25_exp_obr::model()->findAll(array('order' => 'id ASC')), 'id', 'naim'), array('empty'=>'Выберите образование', 'class'=>'span3')); ?>
    
    <?php echo $form->checkBoxRow($model,'uch_st'); ?>
    
    <?php echo $form->textFieldRow($model,'spec',array('class'=>'span3','maxlength'=>255)); ?>
    
    <?php if($model->doc_obr_r) { ?>
    <div class="control-group ">
        <label class="control-label" for="Abi25_exp_file3_zag">Загруженная cкан-копия документа об образовании</label>
        <div class="controls">
            <?php echo CHtml::link($model->doc_obr_r, array('abi25/scandown_exp', 'id'=>$model->id, 'type' => 3)); ?>
        </div>
    </div> 
    <?php } ?>      
    
    <div class="control-group ">
        <label class="control-label required" for="Abi25_exp_file3">Cкан-копия документа об образовании (файл в формате .pdf, .jpg, .gif, .png, .jpeg размер не более 5Мб)<span class="required">*</span></label>
        <div class="controls">
            <?php echo $form->fileField($model, 'file3'); ?>          
            <?php if ($model->file3 instanceof CUploadedFile): ?>
                <div class="hint">Загружен: <?php echo $model->file3->name; ?> (<?php echo round($model->file3->size / (1024*1024), 2); ?> Мб)</div>
            <?php endif; ?>              
        </div>      
    </div>     
    
    <?php echo $form->textAreaRow($model, 'dop', array('class'=>'span8', 'rows'=>5)); ?>
    
    <?php echo $form->textFieldRow($model,'staz',array('class'=>'span1','maxlength'=>255)); ?>
    
    <?php if($model->doc_staz_r) { ?>
    <div class="control-group ">
        <label class="control-label" for="Abi25_exp_file4_zag">Загруженная cкан-копия документа подтверждающего стаж работы</label>
        <div class="controls">
            <?php echo CHtml::link($model->doc_staz_r, array('abi25/scandown_exp', 'id'=>$model->id, 'type' => 4)); ?>
        </div>
    </div> 
    <?php } ?>      
    
    <div class="control-group ">
        <label class="control-label required" for="Abi25_exp_file4">Cкан-копия документа подтверждающего стаж работы (файл в формате .pdf, .jpg, .gif, .png, .jpeg размер не более 5Мб)<span class="required">*</span></label>
        <div class="controls">
            <?php echo $form->fileField($model, 'file4'); ?>          
            <?php if ($model->file4 instanceof CUploadedFile): ?>
                <div class="hint">Загружен: <?php echo $model->file4->name; ?> (<?php echo round($model->file4->size / (1024*1024), 2); ?> Мб)</div>
            <?php endif; ?>              
        </div>      
    </div>     
    
    <?php echo $form->textFieldRow($model,'opit',array('class'=>'span1','maxlength'=>255)); ?>
    
    <div class="control-group">
            <?php echo $form->labelEx($model,'data_att',array('class'=>'control-label')); ?>
            <div class="controls">    
            <?php $this->widget('zii.widgets.jui.CJuiDatePicker', array(
                        'options'=>array(
                            'showAnim'=>'fold',
                            'dateFormat'=>'dd.mm.yy',
                            'changeYear'=>true,
                            'yearRange'=>'2000:2048'
                        ),
                        'language' => 'ru',
                        'attribute'=>'data_att',
                        'model' => $model,
                        'htmlOptions'=>array(
                            'size'=>8,
                            'class'=>'input-small'
                        ),
                        ));
            ?>  
            </div>
    </div>
    
    <?php if($model->scan_r) { ?>
    <div class="control-group ">
        <label class="control-label" for="Abi25_exp_file1_zag">Загруженная cкан-копия документа о прохождении подготовки в качестве эксперта</label>
        <div class="controls">
            <?php echo CHtml::link($model->scan_r, array('abi25/scandown_exp', 'id'=>$model->id, 'type' => 1)); ?>
        </div>
    </div> 
    <?php } ?>      
    
    <div class="control-group ">
        <label class="control-label required" for="Abi25_exp_file1">Cкан-копия документа о прохождении подготовки в качестве эксперта (файл в формате .pdf размер не более 5Мб)</label>
        <div class="controls">
            <?php echo $form->fileField($model, 'file1'); ?>          
            <?php if ($model->file1 instanceof CUploadedFile): ?>
                <div class="hint">Загружен: <?php echo $model->file1->name; ?> (<?php echo round($model->file1->size / (1024*1024), 2); ?> Мб)</div>
            <?php endif; ?>              
        </div>      
    </div>

    <?php if($model->doc_snils_r) { ?>
    <div class="control-group ">
        <label class="control-label" for="Abi25_exp_file5_zag">Загруженная cкан-копия СНИЛС</label>
        <div class="controls">
            <?php echo CHtml::link($model->doc_snils_r, array('abi25/scandown_exp', 'id'=>$model->id, 'type' => 5)); ?>
        </div>
    </div> 
    <?php } ?>      
    
    <div class="control-group ">
        <label class="control-label required" for="Abi25_exp_file2">Скан-копия СНИЛС (файл в формате .pdf, .jpg, .gif, .png, .jpeg размер не более 5Мб)<span class="required">*</span></label>
        <div class="controls">
            <?php echo $form->fileField($model, 'file5'); ?> 
        </div>    
    </div>
    
    <?php if($model->doc_pass_r) { ?>
    <div class="control-group ">
        <label class="control-label" for="Abi25_exp_file6_zag">Загруженная cкан-копия паспорта (основной разворот и прописка)</label>
        <div class="controls">
            <?php echo CHtml::link($model->doc_pass_r, array('abi25/scandown_exp', 'id'=>$model->id, 'type' => 6)); ?>
        </div>
    </div> 
    <?php } ?>      
    
    <div class="control-group ">
        <label class="control-label required" for="Abi25_exp_file6">Скан-копия паспорта (основной разворот и прописка) (файл в формате .pdf, .jpg, .gif, .png, .jpeg размер не более 5Мб)<span class="required">*</span></label>
        <div class="controls">
            <?php echo $form->fileField($model, 'file6'); ?> 
        </div>    
    </div>     

    <?php if($model->sogl_r) { ?>
    <div class="control-group ">
        <label class="control-label" for="Abi25_exp_file2_zag">Загруженное согласие на обработку персональных данных</label>
        <div class="controls">
            <?php echo CHtml::link($model->sogl_r, array('abi25/scandown_exp', 'id'=>$model->id, 'type' => 2)); ?>
        </div>
    </div> 
    <?php } ?>      
    
    <div class="control-group ">
        <label class="control-label required" for="Abi25_exp_file2">Согласие на обработку персональных данных (файл в формате .pdf размер не более 5Мб)<span class="required">*</span></label>
        <div class="controls">
            <?php echo $form->fileField($model, 'file2'); ?> 
        </div>    
    </div>    

<div class="form-actions">
    <?php $this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'submit', 'type'=>'primary', 'icon'=>'ok white', 'label'=>'Сохранить')); ?>
    <?php $this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'action', 'icon'=>'remove', 'label'=>'Отмена', 'url'=>$this->createUrl('abi25/edit',array('id_rep'=>$model->id_report)))); ?>
</div>

<?php $this->endWidget(); ?> 

<script type="text/javascript"> 
$(document).on('submit', '#abi25-exp-form', function(e) {
    if ($(this).data('submitting')) {
        return false;
    }
    
    var form = $(this);
    if (form.yiiActiveForm('validate')) {
        form.data('submitting', true);
        $('.form-actions button[type=submit]').prop('disabled', true);
    }
});

function clearFieldErrors(field) {
    var $field = $(field);
    $field.closest(".control-group").removeClass("error has-error");
    $field.closest(".controls").find(".help-inline.errorMessage").hide();
}

// Очищаем ошибки при изменении полей
$(document).on('change keyup', '#abi25-exp-form input, #abi25-exp-form select, #abi25-exp-form textarea', function() {
    clearFieldErrors(this);
});

$(document).ready(function() {
    // Инициализация tooltip для ошибок
    $('.help-inline.errorMessage').tooltip();
});
</script>    