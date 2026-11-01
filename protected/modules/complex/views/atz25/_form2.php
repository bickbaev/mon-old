<?php
$form = $this->beginWidget('bootstrap.widgets.TbActiveForm',array(
    'id'=>'object-form',
    //'type'=>'horizontal',    
    'enableClientValidation' => true,
    'clientOptions' => ['validateOnSubmit' => true],
    'htmlOptions' => array('enctype'=>'multipart/form-data'),    
)); ?>

<blockquote><em>Поля помеченные<span class="required"> * </span>обязательны для заполнения.</em></blockquote>

<?php echo $form->errorSummary($model); ?>

<h4 style="margin: 40px 0 20px 0;">Адрес(а) объекта</h4>


<div id="addresses">
        <?php
        $addresses = !empty($model->addresses) ? $model->addresses : [new Atz25_adr];
        foreach ($addresses as $i => $address): ?>
            <?php echo $form->errorSummary($address); ?>
            <div class="address-block well" data-id="<?php echo $address->id; ?>"> 
                <a href="#" class="btn btn-mini btn-danger pull-right removeAddress" data-existing="<?php echo $address->id ? '1' : '0'; ?>">
                    <i class="icon-remove"></i>
                </a>
                <input type="hidden" name="Atz25_adr[<?php echo $i; ?>][id]" value="<?php echo $address->id; ?>">                
                <div class="control-group ">
                    <label class="control-label required" for="Atz25_adr_<?php echo $i; ?>_nas_punkt">Название объекта<span class="required">*</span></label>
                    <div class="controls">
                        <input class="span3" name="Atz25_adr[<?php echo $i; ?>][obj_name]" id="Atz25_adr_<?php echo $i; ?>_obj_name" type="text" value="<?php echo CHtml::encode($address->obj_name); ?>" />
                        <span class="help-inline error" id="Atz25_adr_<?php echo $i; ?>_obj_name_em_" style="display: none"></span>
                    </div>
                </div>
                <div class="control-group ">
                    <label class="control-label required" for="Atz25_adr_<?php echo $i; ?>_obj_index">Индекс<span class="required">*</span></label>
                    <div class="controls">
                        <input class="span2" name="Atz25_adr[<?php echo $i; ?>][obj_index]" id="Atz25_adr_<?php echo $i; ?>_obj_index" type="text" value="<?php echo CHtml::encode($address->obj_index); ?>" />
                        <span class="help-inline error" id="Atz25_adr_<?php echo $i; ?>_obj_index_em_" style="display: none"></span>
                    </div>
                </div>                
                 <div class="control-group">
                    <label class="control-label" for="Atz25_adr_<?php echo $i; ?>_id_mun">Муниципалитет</label>
                    <div class="controls">
                        <?php echo CHtml::dropDownList(
                            'Atz25_adr['.$i.'][id_mun]',
                            CHtml::encode($address->nas_punkt_type), // значение по умолчанию
                            CHtml::listData(Mun::model()->findAll(array('order' => 'id_mun ASC')), 'id_mun', 'naim_mun'),
                            array(
                                'class' => 'span4',
                                'empty' => 'Выберите вариант'
                            )
                        ); ?>
                        <span class="help-inline error" id="Atz25_adr_<?php echo $i; ?>_id_mun_type_em_" style="display: none"></span>
                    </div>
                </div>                        

                <div class="control-group">
                    <label class="control-label" for="Atz25_adr_<?php echo $i; ?>_nas_punkt_type">Тип населенного пункта</label>
                    <div class="controls">
                        <?php echo CHtml::dropDownList(
                            'Atz25_adr['.$i.'][nas_punkt_type]',
                            CHtml::encode($address->nas_punkt_type), // значение по умолчанию
                            CHtml::listData(Contact_gor::model()->findAll(array('order' => 'id_contact_gor ASC')), 'id_contact_gor', 'naim_gor'),
                            array(
                                'class' => 'span4',
                                'empty' => 'Выберите вариант'
                            )
                        ); ?>
                        <span class="help-inline error" id="Atz25_adr_<?php echo $i; ?>_nas_punkt_type_em_" style="display: none"></span>
                    </div>
                </div>                         

                <div class="control-group ">
                    <label class="control-label required" for="Atz25_adr_<?php echo $i; ?>_nas_punkt">Название населенного пункта<span class="required">*</span></label>
                    <div class="controls">
                        <input class="span5" name="Atz25_adr[<?php echo $i; ?>][nas_punkt]" id="Atz25_adr_<?php echo $i; ?>_nas_punkt" type="text" value="<?php echo CHtml::encode($address->nas_punkt); ?>" />
                        <span class="help-inline error" id="Atz25_adr_<?php echo $i; ?>_nas_punkt_em_" style="display: none"></span>
                    </div>
                </div>                        

                <div class="control-group">
                    <label class="control-label" for="Atz25_adr_<?php echo $i; ?>_street_type">Тип улицы</label>
                    <div class="controls">
                        <?php echo CHtml::dropDownList(
                            'Atz25_adr['.$i.'][street_type]',
                            CHtml::encode($address->street_type), // значение по умолчанию
                            CHtml::listData(Contact_ul::model()->findAll(array('order' => 'id_contact_ul ASC')), 'id_contact_ul', 'naim_ul'),
                            array(
                                'class' => 'span4',
                                'empty' => 'Выберите вариант'
                            )
                        ); ?>
                        <span class="help-inline error" id="Atz25_adr_<?php echo $i; ?>_street_type_em_" style="display: none"></span>
                    </div>
                </div>                        

                <div class="control-group ">
                    <label class="control-label required" for="Atz25_adr_<?php echo $i; ?>_street">Название улицы<span class="required">*</span></label>
                    <div class="controls">
                        <input class="span5" name="Atz25_adr[<?php echo $i; ?>][street]" id="Atz25_adr_<?php echo $i; ?>_street" type="text" value="<?php echo CHtml::encode($address->street); ?>" />
                        <span class="help-inline error" id="Atz25_adr_<?php echo $i; ?>_street_em_" style="display: none"></span>
                    </div>
                </div>                         
                <div class="control-group ">
                    <label class="control-label required" for="Atz25_adr_<?php echo $i; ?>_dom">Номер дома<span class="required">*</span></label>
                    <div class="controls">
                        <input name="Atz25_adr[<?php echo $i; ?>][dom]" id="Atz25_adr_<?php echo $i; ?>_kad_num" type="text" value="<?php echo CHtml::encode($address->dom); ?>" />
                        <span class="help-inline error" id="Atz25_adr_<?php echo $i; ?>_dom_em_" style="display: none"></span>
                    </div>
                </div>                         
                <div class="control-group ">
                    <label class="control-label required" for="Atz25_adr_<?php echo $i; ?>_kad_num">Кадастровый номер <span class="required">*</span></label>
                    <div class="controls">
                        <input name="Atz25_adr[<?php echo $i; ?>][kad_num]" id="Atz25_adr_<?php echo $i; ?>_kad_num" type="text" value="<?php echo CHtml::encode($address->kad_num); ?>" />
                        <span class="help-inline error" id="Atz25_adr_<?php echo $i; ?>_kad_num_em_" style="display: none"></span>
                    </div>
                </div>                        
            </div>
        <?php endforeach; ?>
</div>
<a href="#" class="btn btn-success" id="addAddress">
    <i class="icon-plus icon-white"></i> Добавить еще адрес
</a>

<h4 style="margin: 40px 0 20px 0;">Сведения об объекте</h4>

<?php echo $form->dropDownListRow($model, 'pok1', CHtml::listData(Atz25_sob::model()->findAll(array('order' => 'id ASC')), 'id', 'naim'), array('empty'=>'Выберите значение', 'class'=>'span2')); ?>

<?php echo $form->dropDownListRow($model, 'pok2', array(1 => 'Да', 2 => 'Нет') , array('empty'=>'Выберите значение', 'class'=>'span2')); ?>

<?php echo $form->dropDownListRow($model, 'pok3', array(1 => 'Да', 2 => 'Нет') , array('empty'=>'Выберите значение', 'class'=>'span2')); ?>

<?php echo $form->dropDownListRow($model, 'pok4', CHtml::listData(Atz25_cat::model()->findAll(array('order' => 'id ASC')), 'id', 'naim'), array('empty'=>'Выберите значение', 'class'=>'span2')); ?>

<?php echo $form->dropDownListRow($model, 'pok5', array(1 => 'Да', 2 => 'Нет') , array('empty'=>'Выберите значение', 'class'=>'span2')); ?>

<?php echo $form->dropDownListRow($model, 'pok6', array(1 => 'Да', 2 => 'Нет') , array('empty'=>'Выберите значение', 'class'=>'span2')); ?>

<?php echo $form->dropDownListRow($model, 'pok7', array(1 => 'Да', 2 => 'Нет') , array('empty'=>'Выберите значение', 'class'=>'span2')); ?>

<?php echo $form->dropDownListRow($model, 'pok8', array(1 => 'Да', 2 => 'Нет') , array('empty'=>'Выберите значение', 'class'=>'span2')); ?>

<?php echo $form->dropDownListRow($model, 'pok9', array(1 => 'Да', 2 => 'Нет') , array('empty'=>'Выберите значение', 'class'=>'span2')); ?>

<?php echo $form->dropDownListRow($model, 'pok10', array(1 => 'Да', 2 => 'Нет') , array('empty'=>'Выберите значение', 'class'=>'span2')); ?>

<?php echo $form->dropDownListRow($model, 'pok11', array(1 => 'Да', 2 => 'Нет') , array('empty'=>'Выберите значение', 'class'=>'span2')); ?>

<?php echo $form->dropDownListRow($model, 'pok12', array(1 => 'Да', 2 => 'Нет') , array('empty'=>'Выберите значение', 'class'=>'span2')); ?>

<?php echo $form->dropDownListRow($model, 'pok13', array(1 => 'Да', 2 => 'Нет') , array('empty'=>'Выберите значение', 'class'=>'span2')); ?>

<?php echo $form->dropDownListRow($model, 'pok14', array(1 => 'Да', 2 => 'Нет') , array('empty'=>'Выберите значение', 'class'=>'span2')); ?>

<?php echo $form->dropDownListRow($model, 'pok15', array(1 => 'Да', 2 => 'Нет') , array('empty'=>'Выберите значение', 'class'=>'span2')); ?>

<?php echo $form->dropDownListRow($model, 'pok16', array(1 => 'Да', 2 => 'Нет') , array('empty'=>'Выберите значение', 'class'=>'span2')); ?>

<?php echo $form->dropDownListRow($model, 'pok17', array(1 => 'Да', 2 => 'Нет') , array('empty'=>'Выберите значение', 'class'=>'span2')); ?>

<?php echo $form->dropDownListRow($model, 'pok18', array(1 => 'Да', 2 => 'Нет') , array('empty'=>'Выберите значение', 'class'=>'span2')); ?>

<?php echo $form->dropDownListRow($model, 'pok19', array(1 => 'Да', 2 => 'Нет') , array('empty'=>'Выберите значение', 'class'=>'span2')); ?>

<?php echo $form->dropDownListRow($model, 'pok20', array(1 => 'Да', 2 => 'Нет') , array('empty'=>'Выберите значение', 'class'=>'span2')); ?>

<?php echo $form->dropDownListRow($model, 'pok21', array(1 => 'Да', 2 => 'Нет') , array('empty'=>'Выберите значение', 'class'=>'span2')); ?>

<?php echo $form->textFieldRow($model,'pok22',array('class'=>'span2','maxlength'=>255)); ?>

<?php echo $form->dropDownListRow($model, 'pok23', array(1 => 'Да', 2 => 'Нет') , array('empty'=>'Выберите значение', 'class'=>'span2')); ?>

<?php echo $form->dropDownListRow($model, 'pok24', array(1 => 'Да', 2 => 'Нет') , array('empty'=>'Выберите значение', 'class'=>'span2')); ?>

<?php echo $form->textFieldRow($model,'pok25',array('class'=>'span2','maxlength'=>255)); ?>

<?php echo $form->textFieldRow($model,'pok26',array('class'=>'span2','maxlength'=>255)); ?>

<?php echo $form->textFieldRow($model,'pok27',array('class'=>'span2','maxlength'=>255)); ?>

<div class="form-actions">
    <?php $this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'submit', 'type'=>'primary', 'icon'=>'ok white', 'label'=>'Сохранить')); ?>
    <?php $this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'action', 'icon'=>'remove', 'label'=>'Отмена', 'url'=>$this->createUrl('atz25/edit',array('id_rep'=>$model->id_report)))); ?>
</div>

<?php $this->endWidget(); ?>

<!-- Шаблон для новых адресов -->
<script type="text/template" id="address-template">
<div class="address-block well">
    <a href="#" class="btn btn-mini btn-danger pull-right removeAddress">
        <i class="icon-remove"></i>
    </a>
    <div class="control-group ">
        <label class="control-label required" for="Atz25_adr___index___nas_punkt">Название объекта<span class="required">*</span></label>
        <div class="controls">
            <input class="span3" name="Atz25_adr[__index__][obj_name]" id="Atz25_adr___index___obj_name" type="text" value="" />
            <span class="help-inline error" id="Atz25_adr___index___obj_name_em_" style="display: none"></span>
        </div>
    </div>
    <div class="control-group ">
        <label class="control-label required" for="Atz25_adr___index___obj_index">Индекс<span class="required">*</span></label>
        <div class="controls">
            <input class="span2" name="Atz25_adr[__index__][obj_index]" id="Atz25_adr_<?php echo $i; ?>_obj_index" type="text" value="" />
            <span class="help-inline error" id="Atz25_adr___index___obj_index_em_" style="display: none"></span>
        </div>
    </div>     
    <div class="control-group">
        <label class="control-label" for="Atz25_adr___index___id_mun">Муниципалитет</label>
        <div class="controls">
            <?php echo CHtml::dropDownList(
                'Atz25_adr[__index__][id_mun]',
                '', // значение по умолчанию
                CHtml::listData(Mun::model()->findAll(array('order' => 'id_mun ASC')), 'id_mun', 'naim_mun'),
                array(
                    'class' => 'span4',
                    'empty' => 'Выберите вариант'
                )
            ); ?>
            <span class="help-inline error" id="Atz25_adr___index___id_mun_type_em_" style="display: none"></span>
        </div>
    </div>                        

    <div class="control-group">
        <label class="control-label" for="Atz25_adr___index___nas_punkt_type">Тип населенного пункта</label>
        <div class="controls">
            <?php echo CHtml::dropDownList(
                'Atz25_adr[__index__][nas_punkt_type]',
                '', // значение по умолчанию
                CHtml::listData(Contact_gor::model()->findAll(array('order' => 'id_contact_gor ASC')), 'id_contact_gor', 'naim_gor'),
                array(
                    'class' => 'span4',
                    'empty' => 'Выберите вариант'
                )
            ); ?>
            <span class="help-inline error" id="Atz25_adr___index___nas_punkt_type_em_" style="display: none"></span>
        </div>
    </div>                         

    <div class="control-group ">
        <label class="control-label required" for="Atz25_adr___index___nas_punkt">Название населенного пункта<span class="required">*</span></label>
        <div class="controls">
            <input class="span5" name="Atz25_adr[__index__][nas_punkt]" id="Atz25_adr___index___nas_punkt" type="text" value="" />
            <span class="help-inline error" id="Atz25_adr___index___nas_punkt_em_" style="display: none"></span>
        </div>
    </div>                        

    <div class="control-group">
        <label class="control-label" for="Atz25_adr___index___street_type">Тип улицы</label>
        <div class="controls">
            <?php echo CHtml::dropDownList(
                'Atz25_adr[__index__][street_type]',
                CHtml::encode($address->street_type), // значение по умолчанию
                CHtml::listData(Contact_ul::model()->findAll(array('order' => 'id_contact_ul ASC')), 'id_contact_ul', 'naim_ul'),
                array(
                    'class' => 'span4',
                    'empty' => 'Выберите вариант'
                )
            ); ?>
            <span class="help-inline error" id="Atz25_adr___index___street_type_em_" style="display: none"></span>
        </div>
    </div>                        

    <div class="control-group ">
        <label class="control-label required" for="Atz25_adr___index___street">Название улицы<span class="required">*</span></label>
        <div class="controls">
            <input class="span5" name="Atz25_adr[__index__][street]" id="Atz25_adr___index___street" type="text" value="" />
            <span class="help-inline error" id="Atz25_adr___index___street_em_" style="display: none"></span>
        </div>
    </div>                         
    <div class="control-group ">
        <label class="control-label required" for="Atz25_adr___index___dom">Номер дома<span class="required">*</span></label>
        <div class="controls">
            <input name="Atz25_adr[__index__][dom]" id="Atz25_adr___index___kad_num" type="text" value="" />
            <span class="help-inline error" id="Atz25_adr___index___dom_em_" style="display: none"></span>
        </div>
    </div>                         
    <div class="control-group ">
        <label class="control-label required" for="Atz25_adr___index___kad_num">Кадастровый номер <span class="required">*</span></label>
        <div class="controls">
            <input name="Atz25_adr[__index__][kad_num]" id="Atz25_adr___index__kad_num" type="text" value="" />
            <span class="help-inline error" id="Atz25_adr___index___kad_num_em_" style="display: none"></span>
        </div>
    </div>                        
</div>    
</script>

<script>
$(function() {
    let addressIndex = <?php echo count($addresses); ?>;

    // Добавление адреса
    $('#addAddress').on('click', function() {
        let template = $('#address-template').html();
        template = template.replace(/__index__/g, addressIndex++);
        $('#addresses').append(template);
    });
    
    // Удаление адреса
    $('#addresses').on('click', '.removeAddress', function() {
        let $block = $(this).closest('.address-block');
        let addressId = $block.data('id');
        let isExisting = $(this).data('existing') === 1;

        if (isExisting && addressId) {
            if (!confirm('Удалить этот адрес?')) return;
            $.ajax({
                url: '<?php echo Yii::app()->createUrl("/complex/atz25/addr_delete"); ?>',
                type: 'POST',
                data: { id: addressId },
                success: function(resp) {
                    $block.fadeOut(200, function() { $(this).remove(); });
                },
                error: function() {
                    alert('Ошибка при удалении адреса.');
                }
            });
        } else {
            $block.remove();
        }
    });    
});
</script>