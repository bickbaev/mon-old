<?php
$form = $this->beginWidget('bootstrap.widgets.TbActiveForm',array(
    'id'=>'object-form',
    //'type'=>'horizontal',    
    //'enableClientValidation' => true,
    //'clientOptions' => ['validateOnSubmit' => true],
    'htmlOptions' => array('enctype'=>'multipart/form-data'),    
)); ?>

<blockquote><em>Поля помеченные<span class="required"> * </span>обязательны для заполнения.</em></blockquote>

<?php echo $form->errorSummary($model); ?>

<h4 style="margin: 40px 0 20px 0;">Адрес(а) объекта</h4>


<div id="addresses">
        <?php
        $addresses = !empty($model->addresses) ? $model->addresses : [new Atz26_adr];
        foreach ($addresses as $i => $address): ?>
            <?php $this->renderPartial('_form_address', array('address' => $address, 'index' => $i, 'form' => $form)); ?>
        <?php endforeach; ?>
</div>
<a href="#" class="btn btn-success" id="addAddress">
    <i class="icon-plus icon-white"></i> Добавить еще адрес
</a>

<h4 style="margin: 40px 0 20px 0;">Сведения об объекте</h4>

<?php echo $form->dropDownListRow($model, 'pok1', CHtml::listData(Atz25_sob::model()->findAll(array('order' => 'id ASC')), 'id', 'naim'), array('empty'=>'Выберите значение', 'class'=>'span2')); ?>

<?php echo $form->dropDownListRow($model, 'pok2', array(1 => 'Да', 2 => 'Нет') , array('empty'=>'Выберите значение', 'class'=>'span2')); ?>

<div class="control-group">
        <?php echo $form->labelEx($model,'pok3',array('class'=>'control-label')); ?>
        <div class="controls">    
        <?php $this->widget('zii.widgets.jui.CJuiDatePicker', array(
                    'options'=>array(
                        'showAnim'=>'fold',
                        'dateFormat'=>'dd.mm.yy',
                        'changeYear'=>true,
                        'yearRange'=>'1990:2048'
                    ),
                    'language' => 'ru',
                    'attribute'=>'pok3',
                    'model' => $model,
                    'htmlOptions'=>array(
                        'size'=>8,
                        'class'=>'input-small'
                    ),
                    ));
        ?>  
        </div>
</div> 

<?php echo $form->dropDownListRow($model, 'pok4', CHtml::listData(Atz25_cat::model()->findAll(array('order' => 'id ASC')), 'id', 'naim'), array('empty'=>'Выберите значение', 'class'=>'span2')); ?>

<?php echo $form->dropDownListRow($model, 'pok5', array(1 => 'Да', 2 => 'Нет') , array('empty'=>'Выберите значение', 'class'=>'span2')); ?>

<div class="control-group">
        <?php echo $form->labelEx($model,'pok6',array('class'=>'control-label')); ?>
        <div class="controls">    
        <?php $this->widget('zii.widgets.jui.CJuiDatePicker', array(
                    'options'=>array(
                        'showAnim'=>'fold',
                        'dateFormat'=>'dd.mm.yy',
                        'changeYear'=>true,
                        'yearRange'=>'1990:2048'
                    ),
                    'language' => 'ru',
                    'attribute'=>'pok6',
                    'model' => $model,
                    'htmlOptions'=>array(
                        'size'=>8,
                        'class'=>'input-small'
                    ),
                    ));
        ?>  
        </div>
</div>

<?php echo $form->dropDownListRow($model, 'pok7', array(1 => 'Да', 2 => 'Нет') , array('empty'=>'Выберите значение', 'class'=>'span2')); ?>

<?php echo $form->dropDownListRow($model, 'pok8', array(1 => 'Да', 2 => 'Нет') , array('empty'=>'Выберите значение', 'class'=>'span2')); ?>

<?php echo $form->dropDownListRow($model, 'pok9', array(1 => 'Да', 2 => 'Нет') , array('empty'=>'Выберите значение', 'class'=>'span2')); ?>

<?php echo $form->dropDownListRow($model, 'pok10', array(1 => 'Да', 2 => 'Нет') , array('empty'=>'Выберите значение', 'class'=>'span2')); ?>

<?php echo $form->dropDownListRow($model, 'pok11', array(1 => 'Да', 2 => 'Нет') , array('empty'=>'Выберите значение', 'class'=>'span2')); ?>

<?php echo $form->dropDownListRow($model, 'pok12', array(1 => 'Да', 2 => 'Нет') , array('empty'=>'Выберите значение', 'class'=>'span2')); ?>

<?php echo $form->textFieldRow($model,'pok13',array('class'=>'span2','maxlength'=>255)); ?>

<?php echo $form->textFieldRow($model,'pok14',array('class'=>'span2','maxlength'=>255)); ?>

<?php echo $form->dropDownListRow($model, 'pok15', array(1 => 'Да', 2 => 'Нет') , array('empty'=>'Выберите значение', 'class'=>'span2')); ?>

<?php echo $form->dropDownListRow($model, 'pok16', array(1 => 'Да', 2 => 'Нет') , array('empty'=>'Выберите значение', 'class'=>'span2')); ?>

<?php echo $form->dropDownListRow($model, 'pok17', array(1 => 'Да', 2 => 'Нет') , array('empty'=>'Выберите значение', 'class'=>'span2')); ?>

<?php echo $form->dropDownListRow($model, 'pok18', array(1 => 'Да', 2 => 'Нет') , array('empty'=>'Выберите значение', 'class'=>'span2')); ?>

<?php echo $form->dropDownListRow($model, 'pok19', array(1 => 'Да', 2 => 'Нет') , array('empty'=>'Выберите значение', 'class'=>'span2')); ?>

<?php echo $form->dropDownListRow($model, 'pok20', array(1 => 'Да', 2 => 'Нет') , array('empty'=>'Выберите значение', 'class'=>'span2')); ?>

<?php echo $form->dropDownListRow($model, 'pok21', array(1 => 'Да', 2 => 'Нет') , array('empty'=>'Выберите значение', 'class'=>'span2')); ?>

<?php echo $form->dropDownListRow($model, 'pok22', array(1 => 'Да', 2 => 'Нет') , array('empty'=>'Выберите значение', 'class'=>'span2')); ?>

<?php echo $form->dropDownListRow($model, 'pok23', array(1 => 'Да', 2 => 'Нет') , array('empty'=>'Выберите значение', 'class'=>'span2')); ?>

<?php echo $form->dropDownListRow($model, 'pok24', array(1 => 'Да', 2 => 'Нет') , array('empty'=>'Выберите значение', 'class'=>'span2')); ?>

<?php echo $form->dropDownListRow($model, 'pok25', array(1 => 'Да', 2 => 'Нет') , array('empty'=>'Выберите значение', 'class'=>'span2')); ?>

<?php echo $form->dropDownListRow($model, 'pok26', array(1 => 'Да', 2 => 'Нет') , array('empty'=>'Выберите значение', 'class'=>'span2')); ?>

<?php echo $form->textFieldRow($model,'pok27',array('class'=>'span2','maxlength'=>255)); ?>

<?php echo $form->textFieldRow($model,'pok28',array('class'=>'span2','maxlength'=>255)); ?>

<?php echo $form->dropDownListRow($model, 'pok29', array(1 => 'Да', 2 => 'Нет') , array('empty'=>'Выберите значение', 'class'=>'span2')); ?>

<?php echo $form->dropDownListRow($model, 'pok30', array(1 => 'Да', 2 => 'Нет') , array('empty'=>'Выберите значение', 'class'=>'span2')); ?>

<?php echo $form->textFieldRow($model,'pok31',array('class'=>'span2','maxlength'=>255)); ?>

<?php echo $form->textFieldRow($model,'pok32',array('class'=>'span2','maxlength'=>255)); ?>

<h4 style="margin: 40px 0 20px 0;">Сведения о финансировании (в тысячах рублей, разделитель разрядов <u>точка</u>)</h4>

<?php
$poks = array('Организация и обеспечение пропускного и внутриобъектового режимов, осуществление контроля за их функционированием',
        'Оснащение объектов (территорий) системами передачи тревожных сообщений в подразделения войск национальной гвардии Российской Федерации или в систему обеспечения вызова экстренных оперативных служб по единому номеру «112» и поддержание их в исправном состоянии',
        'Обеспеченние охраной сотрудниками частных охранных организаций, подразделениями вневедомственной охраны Росгвардии, военизированными и сторожевыми подразделениями организации, подведомственной Росгвардии, или подразделениями ведомственной охраны федеральных органов исполнительной власти, имеющих право на создание ведомственной охраны',
        'Оборудование объектов (территорий) системами оповещения и управления эвакуацией либо автономными системами (средствами) экстренного оповещения работников, обучающихся и иных лиц, находящихся на объекте (территории), о потенциальной угрозе возникновения или о возникновении чрезвычайной ситуации',
        'Размещение на объектах (территориях) наглядных пособий',
        'Оснащение объектов (территорий) системой наружного освещения',
        'Оснащение объектов (территорий) системами видеонаблюдения',
        'Оснащение объектов (территорий) системами охранной сигнализации',
        'Оборудование на 1-м этаже помещения для охраны с установкой в нем систем видеонаблюдения, охранной сигнализации и средств передачи тревожных сообщений в подразделения войск национальной гвардии Российской Федерации (подразделения вневедомственной охраны войск национальной гвардии Российской Федерации)',
        'Оборудование основных входов в здания, входящие в состав объектов (территорий), контрольно-пропускными пунктами (постами охраны) ',
        'Оснащение объектов (территорий) стационарными или ручными металлоискателями',
        'Оборудование объектов (территорий) системой контроля и управления доступом',
        'Оснащение въездов на объект (территорию) воротами, обеспечивающими жесткую фиксацию их створок в закрытом положении',
        'Оборудование контрольно-пропускных пунктов при входе (въезде) на прилегающую территорию объекта (территории)',
        'Оснащение въездов на объект (территорию) средствами снижения скорости и (или) противотаранными устройствами',
        'Оборудование источниками бесперебойного электропитания',
        'Оборудование иными инженерно-техническими средствами, напрямую не указанными в Постановлении № 1006',
    );

echo '<table class="table table-bordered table-striped"><tbody>';
?>
  <tr>
    <td rowspan="2">Показатель</td>    
    <td colspan="2">Общая сумма, затраченная на обеспечение АТЗ объектов    (территорий) <br>
      в <?php echo $model->report->rep_name->dop ?> г., тыс. рублей:</td>  
    <td colspan="3">Общая потребность в финансировании на <?php echo $model->report->rep_name->dop+1; ?> год и плановый период <?php echo $model->report->rep_name->dop+2; ?> и <?php echo $model->report->rep_name->dop+3; ?> гг.,<br>
      тыс. рублей</td>
    <td colspan="3">Из общей потребности: предусмотрено на <?php echo $model->report->rep_name->dop+1; ?> год и плановый период <?php echo $model->report->rep_name->dop+2; ?> и <?php echo $model->report->rep_name->dop+3; ?> гг., тыс. рублей:</td>
    <td colspan="3">Из общей потребности: составляет дополнительную потребность на <?php echo $model->report->rep_name->dop+1; ?> год и плановый период <?php echo $model->report->rep_name->dop+2; ?> и <?php echo $model->report->rep_name->dop+3; ?> гг., тыс. рублей:</td>
  </tr>
  <tr>
    <td>Оснащение объекта, тыс. руб.</td>
    <td>Ремонт/ТО, тыс. руб.</td>  
    <td><?php echo $model->report->rep_name->dop+1; ?> г.</td>
    <td><?php echo $model->report->rep_name->dop+2; ?> г.</td>
    <td><?php echo $model->report->rep_name->dop+3; ?> г.</td>
    <td><?php echo $model->report->rep_name->dop+1; ?> г.</td>
    <td><?php echo $model->report->rep_name->dop+2; ?> г.</td>
    <td><?php echo $model->report->rep_name->dop+3; ?> г.</td>
    <td><?php echo $model->report->rep_name->dop+1; ?> г.</td>
    <td><?php echo $model->report->rep_name->dop+2; ?> г.</td>
    <td><?php echo $model->report->rep_name->dop+3; ?> г.</td>
  </tr>

<?php
$fields = array();
for ($i = 33; $i <= 219; $i++) {
    $fields[] = 'pok' . $i;
}

// Разбиваем массив полей на чанки по 11 элементов
$chunks = array_chunk($fields, 11);

$k = 0;

foreach ($chunks as $rowFields) {
    echo '<tr>';
    echo '<td>'.$poks[$k].'</td>';
    foreach ($rowFields as $fieldName) {
        echo '<td>';
        echo $form->textFieldRow($model, $fieldName, array(
            'maxlength' => 255,
            'class' => 'span1'
        ));
        echo '</td>';
    }
    
    // Если в последней строке меньше 11 полей, добавляем пустые ячейки
    if (count($rowFields) < 11) {
        $emptyCells = 11 - count($rowFields);
        for ($i = 0; $i < $emptyCells; $i++) {
            echo '<td></td>';
        }
    }
    $k = $k + 1;
    echo '</tr>';
}

echo '</tbody></table>';
?>

<div class="form-actions">
    <?php $this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'submit', 'type'=>'primary', 'icon'=>'ok white', 'label'=>'Сохранить')); ?>
    <?php $this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'action', 'icon'=>'remove', 'label'=>'Отмена', 'url'=>$this->createUrl('atz26/edit',array('id_rep'=>$model->id_report)))); ?>
</div>

<?php $this->endWidget(); ?>

<!-- Шаблон для новых адресов -->
<script type="text/template" id="address-template">
    <?php
        // создаем ПУСТУЮ модель Address для шаблона
        $newAddr = new Atz26_adr();
        echo $this->renderPartial('_form_address', array('address' => $newAddr, 'index' => '__index__', 'form' => $form));
    ?>
</script>

<script>
$(function() {
    let addressIndex = <?php echo count($addresses); ?>;
    
    // Функция для блокировки/разблокировки полей населенного пункта
    function toggleNasPunktFields($munSelect) {
        let $addressBlock = $munSelect.closest('.address-block');
        let $nasPunktType = $addressBlock.find('.nas-punkt-type');
        let $nasPunkt = $addressBlock.find('.nas-punkt');
        
        let selectedValue = parseInt($munSelect.val()) || 0;
        
        if (selectedValue < 11 && selectedValue > 0) {
            // Блокируем поля
            $nasPunktType.prop('disabled', true).val('').trigger('change');
            $nasPunkt.prop('disabled', true).val('');            
        } else {
            // Разблокируем поля
            $nasPunktType.prop('disabled', false);
            $nasPunkt.prop('disabled', false);
        }
    }

    // Обработчик изменения поля id_mun
    $(document).on('change', '.mun-select', function() {
        toggleNasPunktFields($(this));
    });

    // Инициализация состояния полей при загрузке страницы
    $('.mun-select').each(function() {
        toggleNasPunktFields($(this));
    });    

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
                url: '<?php echo Yii::app()->createUrl("/complex/atz26/addr_delete"); ?>',
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
