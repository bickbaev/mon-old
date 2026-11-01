<?php
$this->pageTitle=Yii::app()->name.' - Администрирование отчетов';
$o_header = '<table width="750" border="1" cellspacing="0" cellpadding="3" style="margin: 10px 20px;">
      <tr class="head">
        <th>Статус</th>
        <th>Отчет</th>
        <th>Тип</th>
        <th colspan="2" scope="col">Период</th>
        <th>Действия</th>
      </tr>';
$o_footer = '</table>';
$date_type = array('Месячный', 'Квартальный', 'Годовой', 'Полный');
$status = array('0' => '<th style="color: green">Активный</th>', '1' => '<th style="background: grey">Архивный</th>');
$deistv = array('0' => array('Архивировать', 'index.php?r=admin/archive&id_rep_type='),
                '1' => array('Вернуть', 'index.php?r=admin/archive&id_rep_type='));
echo '<h3 style="margin: 20px 20px;">Администрирование отчетов</h3>';
echo '<div class = "otchet">Текущие отчеты</div>';
echo $o_header;
for ($i = 0; $i < sizeof($otchet); $i++ ) {
    echo '<tr>';
    echo $status[$otchet[$i]['archive']].'<th>'.$otchet[$i]['rep_name'].'</th><th>'.$date_type[$otchet[$i]['date_type']].'</th><th>'.$otchet[$i]['s_date'].'</th><th>'.$otchet[$i]['f_date'].'</th><th>'.CHtml::link($deistv[$otchet[$i]['archive']][0], $deistv[$otchet[$i]['archive']][1].$otchet[$i]['id_rep_type'].'&deistv='.$otchet[$i]['archive']);
    if (!$otchet[$i]['archive']) echo ' '.CHtml::link('Заполнение отчета', 'index.php?r=report/stat_podr&id_rep_type='.$otchet[$i]['id_rep_type'].'&id_est=1').'</th>';
    echo '</tr>';
}
echo $o_footer;
?>
<div class = "otchet">Создание отчета<br />
    <div class="form">
    <?php $form=$this->beginWidget('CActiveForm', array(
        'id'=>'add'
    )); ?>

        <?php echo $form->errorSummary($model) ; ?>

        <div class="row">
            <?php echo $form->labelEx($model,'rep_name'); ?>
            <?php //echo $form->textField($model,'rep_name') ?>
            <?php $this->widget('CAutoComplete',
                  array(
                      'model'=>$model,
                      'name'=>'RepName[rep_name]',
                      'url'=>array('admin/autocomplete'),
                      'minChars'=>2,
                      'htmlOptions' => array('size'=>50)
                  )
              );
            ?>

        </div>

        <div class="row">
            <?php echo $form->labelEx($model,'rep_mv'); ?>
             <?php echo $form->textField($model,'rep_mv') ?>
        </div>

        <div class="row">
            <?php echo $form->labelEx($model,'s_date'); ?>
            <?php $this->widget('zii.widgets.jui.CJuiDatePicker', array(
                    'id' =>'RepName_s_date',
                    'name'=>'RepName[s_date]',
                    // additional javascript options for the date picker plugin
                    'options'=>array(
                        'showAnim'=>'fold',
                        'dateFormat'=>'yy-mm-dd',
                    ),
                    'language' => 'ru',
                    'model' => $model,
                    'htmlOptions'=>array(
                        //'style'=>'margin-left:50px;'
                        'size'=>10
                    ),
                    ));
            ?>
        </div>

        <div class="row">
            <?php echo $form->labelEx($model,'f_date'); ?>
            <?php $this->widget('zii.widgets.jui.CJuiDatePicker', array(
                    'id' =>'RepName_f_date',
                    'name'=>'RepName[f_date]',
                    // additional javascript options for the date picker plugin
                    'options'=>array(
                        'showAnim'=>'fold',
                        'dateFormat'=>'yy-mm-dd',
                    ),
                    'language' => 'ru',
                    'model' => $model,
                    'htmlOptions'=>array(
                        //'style'=>'margin-left:50px;'
                        'size'=>10
                    ),
                    ));
            ?>
        </div>

        <div class="row">
            <?php echo $form->labelEx($model,'date_type'); ?>
            <select id ="RepName_date_type" NAME="RepName[date_type]">
                <option VALUE="">-</option>
                <option VALUE="0">Месячный</option>
                <option VALUE="1">Квартальный</option>
                <option VALUE="2">Годовой</option>
                <option VALUE="3">Полный</option>
            </select>
        </div>

        <div class="row">
            <?php echo $form->labelEx($model,'archive'); ?>
            <?php echo $form->checkBox($model,'archive') ?>
        </div>

        <div class="row submit">
            <input type="button" onclick="javascript:history.back()" name="Отменить" value="Отменить">
            <?php echo CHtml::submitButton('Добавить отчет'); ?>
        </div>


    <?php $this->endWidget(); ?>
    </div>
</div>
