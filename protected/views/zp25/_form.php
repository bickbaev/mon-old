<?php
$form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
    'id'=>'abi25zp-part-form',
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
                                var $field = $("#Abi25_zp_part_" + attribute);
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

    <h4 style="margin: 40px 0 20px 0;">Конкурсант</h4>    
    
    <?php echo $form->checkBoxRow($model,'nonq'); ?>
    
    <?php echo $form->checkBoxRow($model,'notap'); ?>    
    
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
    
    <?php echo $form->dropDownListRow($model, 'id_cat', CHtml::listData(Abi25_zp_cat::model()->findAll(array('order' => 'id ASC')), 'id', 'naim'), array('empty'=>'Выберите категорию', 'class'=>'span6')); ?>    
    
    <?php
    
        // Получаем дату расчета возраста из модели
        $refDate = $model->get_rv();

        // Формируем список на сервере, если есть дата рождения
        $competList = [];

        if (!empty($model->burthdate) && !empty($refDate)) {
            $birth_ts = strtotime($model->burthdate);
            $ref_ts   = strtotime($refDate);

            $age = floor(($ref_ts - $birth_ts) / (365.25 * 24 * 60 * 60));

            $criteria = new CDbCriteria();
            if ($age < 7) {
                $criteria->addCondition('jun = 1');
            } elseif ($age < 12) {
                $criteria->addCondition('osn1 = 1');
            } else {
                $criteria->addCondition('osn2 = 1');
            }

            $competList = CHtml::listData(Abi25_zp_compet::model()->findAll($criteria), 'id', 'naim');
        }    
    
    ?>
    
    <?php echo $form->dropDownListRow($model, 'id_compet', $competList, array('empty'=>'Выберите компетенцию', 'class'=>'span6')); ?> 
    
    <?php
        // Дата расчета возраста для JS
        $refDateJs = CJavaScript::encode($refDate);

        Yii::app()->clientScript->registerScript('updateCompetList', "
        function updateCompetList() {
            var birthdate = $('#Abi25_zp_part_burthdate').val();
            var refdate = $refDateJs;

            if(!birthdate || !refdate) return;

            $.ajax({
                url: '" . Yii::app()->createUrl('complex/abi25zp/get_compet_list') . "',
                type: 'GET',
                data: { birthdate: birthdate, refdate: refdate },
                dataType: 'json',
                success: function(data) {
                    var select = $('#Abi25_zp_part_id_compet');
                    var currentValue = select.val();
                    select.empty();
                    select.append('<option value=\"\">Выберите компетенцию</option>');
                    $.each(data, function(i, item) {
                        var selected = (item.id == currentValue) ? 'selected' : '';
                        select.append('<option value=\"' + item.id + '\" ' + selected + '>' + item.naim + '</option>');
                    });
                }
            });
        }

        // обновление списка при изменении даты рождения
        $('#Abi25_zp_part_burthdate').on('change', updateCompetList);

        // при загрузке формы — если есть дата рождения, подгружаем список
        if($('#Abi25_zp_part_burthdate').val() !== '') {
            updateCompetList();
        }
        ");
    ?>
    
    <div class="control-group">
            <?php echo $form->labelEx($model,'lic_tel',array('class'=>'control-label')); ?>
            <div class="controls">+7     
            <?php echo $form->textField($model,'lic_code', array('class'=>'span1')); ?>
            <?php echo $form->textField($model,'lic_tel', array('class'=>'span2')); ?>
            </div>
    </div>

    <?php echo $form->textFieldRow($model,'lic_mail',array('class'=>'span3','maxlength'=>255)); ?>
    
    <?php echo $form->dropDownListRow($model, 'id_noz', CHtml::listData(Abi25_noz::model()->findAll(array('order' => 'id ASC')), 'id', 'naim'), array('empty'=>'Выберите нозологию', 'class'=>'span6')); ?>

    <?php echo $form->dropDownListRow($model, 'id_gr', CHtml::listData(Abi25_gr::model()->findAll(array('order' => 'id ASC')), 'id', 'naim'), array('empty'=>'Выберите группу', 'class'=>'span6')); ?>    
    
    <?php echo $form->dropDownListRow($model, 'id_spr', CHtml::listData(Abi25_spr::model()->findAll(array('order' => 'id ASC')), 'id', 'naim'), array('empty'=>'Выберите вид справки', 'class'=>'span6')); ?>
    
    <div class="control-group">
            <?php echo $form->labelEx($model,'spr_date',array('class'=>'control-label')); ?>
            <div class="controls">    
            <?php $this->widget('zii.widgets.jui.CJuiDatePicker', array(
                        'options'=>array(
                            'showAnim'=>'fold',
                            'dateFormat'=>'dd.mm.yy',
                            'changeYear'=>true,
                            'yearRange'=>'2025:2050'
                        ),
                        'language' => 'ru',
                        'attribute'=>'spr_date',
                        'model' => $model,
                        'htmlOptions'=>array(
                            'size'=>8,
                            'class'=>'input-small'
                        ),
                        ));
            ?>  
            </div>
    </div>
    
    <?php if($model->spr_r) { ?>
    <div class="control-group ">
        <label class="control-label" for="Abi25_zp_part_file1_zag">Загруженная справка</label>
        <div class="controls">
            <?php echo CHtml::link($model->spr_r, array('zp25/scandown', 'id'=>$model->id, 'type' => 1)); ?>
        </div>
    </div> 
    <?php } ?>      
    
    <div class="control-group ">
        <label class="control-label required" for="Abi25_zp_part_file1">Справка (файл в формате .pdf размер не более 5Мб)</label>
        <div class="controls">
            <?php echo $form->fileField($model, 'file1'); ?>          
            <?php if ($model->file1 instanceof CUploadedFile): ?>
                <div class="hint">Загружен: <?php echo $model->file1->name; ?> (<?php echo round($model->file1->size / (1024*1024), 2); ?> Мб)</div>
            <?php endif; ?>              
        </div>      
    </div>
    
    <?php echo $form->checkBoxRow($model,'ovz'); ?>

    <?php if($model->spro_r) { ?>
    <div class="control-group ">
        <label class="control-label" for="Abi25_zp_part_file4_zag">Загруженная справка</label>
        <div class="controls">
            <?php echo CHtml::link($model->spro_r, array('zp25/scandown', 'id'=>$model->id, 'type' => 4)); ?>
        </div>
    </div> 
    <?php } ?>      
    
    <div class="control-group ">
        <label class="control-label required" for="Abi25_zp_part_file4">Справка об ОВЗ (файл в формате .pdf размер не более 5Мб)</label>
        <div class="controls">
            <?php echo $form->fileField($model, 'file4'); ?>          
            <?php if ($model->file4 instanceof CUploadedFile): ?>
                <div class="hint">Загружен: <?php echo $model->file4->name; ?> (<?php echo round($model->file4->size / (1024*1024), 2); ?> Мб)</div>
            <?php endif; ?>              
        </div>      
    </div>    

    <?php echo $form->dropDownListRow($model, 'id_size', CHtml::listData(Abi25_zp_size::model()->findAll(array('order' => 'id ASC')), 'id', 'naim'), array('empty'=>'Выберите размер одежды', 'class'=>'span3')); ?>        
    
    <h5 style="margin: 40px 0 10px 0;">Особые условия (что необходимо конкурсанту на площадке)</h5>
    
    <?php echo $form->checkBoxRow($model,'osob1'); ?>
    
    <?php echo $form->checkBoxRow($model,'osob2'); ?>
    
    <?php echo $form->checkBoxRow($model,'osob3'); ?>
    
    <?php echo $form->checkBoxRow($model,'osob4'); ?>
    
    <?php echo $form->checkBoxRow($model,'osob5'); ?>
    
    <?php echo $form->checkBoxRow($model,'osob6'); ?>
    
    <?php echo $form->checkBoxRow($model,'osob7'); ?>
    
    <?php echo $form->textFieldRow($model,'osob7_podr',array('class'=>'span6','maxlength'=>255)); ?>
    
    <?php if($model->sogl_r) { ?>
    <div class="control-group ">
        <label class="control-label" for="Abi25_zp_part_file2_zag">Загруженное согласие на обработку персональных данных конкурсанта</label>
        <div class="controls">
            <?php echo CHtml::link($model->sogl_r, array('zp25/scandown', 'id'=>$model->id, 'type' => 2)); ?>
        </div>
    </div> 
    <?php } ?>      
    
    <div class="control-group ">
        <label class="control-label required" for="Abi25_zp_part_file2">Согласие на обработку персональных данных конкурсанта (файл в формате .pdf размер не более 5Мб)<span class="required">*</span></label>
        <div class="controls">
            <?php echo $form->fileField($model, 'file2'); ?> 
        </div>    
    </div>

    <h4 style="margin: 40px 0 20px 0;">Сопровождающий</h4>

    <?php echo $form->textFieldRow($model,'per_surname',array('class'=>'span3','maxlength'=>255)); ?>    

    <?php echo $form->textFieldRow($model,'per_name',array('class'=>'span3','maxlength'=>255)); ?>

    <?php echo $form->textFieldRow($model,'per_patr',array('class'=>'span3','maxlength'=>255)); ?>

    <div class="control-group">
            <?php echo $form->labelEx($model,'per_tel',array('class'=>'control-label')); ?>
            <div class="controls">+7     
            <?php echo $form->textField($model,'per_code', array('class'=>'span1')); ?>
            <?php echo $form->textField($model,'per_tel', array('class'=>'span2')); ?>
            </div>
    </div>         
    
    <?php if($model->per_sogl_r) { ?>
    <div class="control-group ">
        <label class="control-label" for="Abi25_zp_part_file3_zag">Загруженное согласие на обработку персональных данных сопровождающего</label>
        <div class="controls">
            <?php echo CHtml::link($model->per_sogl_r, array('zp25/scandown', 'id'=>$model->id, 'type' => 3)); ?>
        </div>
    </div> 
    <?php } ?>      
    
    <div class="control-group">
        <label class="control-label required" for="Abi25_zp_part_file3">Согласие на обработку персональных данных сопровождающего (файл в формате .pdf размер не более 5Мб)<span class="required">*</span></label>
        <div class="controls">
            <?php echo $form->fileField($model, 'file3'); ?> 
        </div>    
    </div>    
    
    
<div class="form-actions">
    <?php $this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'submit', 'type'=>'primary', 'icon'=>'ok white', 'label'=>'Сохранить')); ?>
    <?php $this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'action', 'icon'=>'remove', 'label'=>'Отмена', 'url'=>$this->createUrl('zp25/index',array('id_comp'=>$comp->id)))); ?>
</div>

<?php $this->endWidget(); ?> 

<script type="text/javascript"> 
$(document).on('submit', '#abi25zp-part-form', function(e) {
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
$(document).on('change keyup', '#abi25zp-part-form input, #abi25zp-part-form select, #abi25zp-part-form textarea', function() {
    clearFieldErrors(this);
});

$('#Abi25_zp_part_osob7').change(function () {
    clearFieldErrors(this);
    if($(this).is(':checked')) {
        $('#Abi25_zp_part_osob7_podr').removeAttr('disabled', '');
    }
    else {
        $('#Abi25_zp_part_osob7_podr').attr('disabled', '');
        $('#Abi25_zp_part_osob7_podr').val('');
    }
});

$(document).ready(function() {
    if($('#Abi25_zp_part_osob7').is(':not(:checked)')) {
        $('#Abi25_zp_part_osob7_podr').attr('disabled', '');
    }
    
    // Инициализация tooltip для ошибок
    $('.help-inline.errorMessage').tooltip();
});
</script>