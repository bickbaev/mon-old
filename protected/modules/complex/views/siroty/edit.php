<?php $this->widget('bootstrap.widgets.TbAlert'); ?>
<fieldset><legend>Данные по учреждению - <?php echo $naim_est; ?></legend></fieldset>
    <?php
    $rep = Report::model()->findByPk($id_rep);
    $rep_name = RepName::model()->findByPk($rep->id_rep_type);
    $s_month = date('n', strtotime($rep_name->s_date));
    $s_year = date('Y', strtotime($rep_name->s_date));
    ?>
    <blockquote>
        <strong>Отчетный месяц - <?php echo Siroty_mes::model()->findByPk($s_month)->naim_mes.' '.$s_year.' г.'; ?><br/>
        Отчетная дата - 5 <?php echo Siroty_mes::model()->findByPk($s_month)->rod_pad.' '.$s_year.' г.'; ?>
        </strong>
    </blockquote>
<p>
   <strong>Инструкция по заполнению:</strong>
   Информация предоставляется ежемесячно, в срок до 5 числа текущего месяца. С января по 5 июня включительно - прогноз, с 5 июля по 5 декабря - фактическое трудоустройство.<br />							
   Возможные виды занятости: трудоустроен (для прогноза - будет трудоустроен), призван в армию (для прогноза - будет призван в армию), продолжил обучение (для прогноза - продолжит обучение), не трудоустроен (для прогноза - имеет риск не быть трудоустроенным).<br />Причины незанятости: декретный отпуск (все виды отпуска, имеющие отношение к рождению ребёнка и уходу за ним), выезд в другую местность (с указанием города или района), отказ от трудоустройства.<br />Выпускники, у которых причина нетрудоустройства "нет рабочих мест" и аналогичные, должны быть поставлены на учёт в ЦЗН, о чём делается отметка в графе "Причина незанятости"<br />
   <em>№ учащегося</em> - это порядковый номер учащегося в списке, составляемом учреждением.<br />
   Список формируется 1 раз в год по состоянию на 5 января текущего года и доставляется территориальным управлением в бумажном виде в управление профессионального образования и науки (Карташевой Диане Валерьевне, каб. 203).<br />
   В 2013 году списки подаются не позднее 25 июня.<br />
   Изменения в список вносятся по мере необходимости путем добавления в перечень учащихся приобретших статус (добавление делается в конец списка).<br />
   Выбывшие и утратившие статус учащиеся из списка удаляются, при этом порядковые номера следующих за ними учащихся не изменяются.<br />
   Измененные списки представляются в бумажном виде территориальными управлениями в срок не позднее отчетной даты.
</p>
<fieldset><legend>Занятость выпускников по профессиям НПО</legend></fieldset>
<?php
if($npo->itemCount) {
    $this->widget('bootstrap.widgets.TbGridView', array(
            'id'=>'npo-grid',
            'type'=>'striped bordered condensed',
            'dataProvider'=>$npo,
            'enableSorting'=>false,
            'summaryText'=>'',
            'columns'=>array(
                array(
                    'name' => 'sir_num',
                    'htmlOptions'=>array('style'=>'width:100px;'),
                ),                
                array(
                    'header' => 'Профессия',
                    'value' => 'Npo::model()->findByPk($data->id_npo)->naim_npo',
                    
                ), 
                array(
                    'header' => 'Вид занятости',
                    'value' => 'Siroty_zan::model()->findByPk($data->id_zan)->naim_zan',
                    'htmlOptions'=>array('style'=>'width:170px;'),
                ),
                array(
                    'header' => 'Место занятости',
                    'name' => 'mesto',
                    'htmlOptions'=>array('style'=>'width:170px;'),
                ), 
                array(
                    'name' => 'nez',
                    'htmlOptions'=>array('style'=>'width:170px;'),
                ),                                                           
                array(
                    'class'=>'bootstrap.widgets.TbButtonColumn',
                    'template'=>'{update}{delete}',
                    'updateButtonUrl'=>'Yii::app()->createUrl("complex/siroty/update_npo", array("id_npo_sir"=>$data->id_npo_sir))',
                    'deleteButtonUrl'=>'Yii::app()->createUrl("complex/siroty/delete_npo", array("id_npo_sir"=>$data->id_npo_sir))',
                    'deleteConfirmation'=>'Вы уверены, что хотите удалить профессию?',
                    ),
            ),            
    )); 
}?>
<div class="row"><p class="pull-right"><?php $this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'action', 'icon'=>'icon-plus', 'label'=>'Добавить профессию НПО', 'url'=>Yii::app()->createUrl("complex/siroty/create_npo", array('id_rep'=>$id_rep)))); ?></p></div>
<fieldset><legend>Занятость выпускников по специальностям СПО</legend></fieldset>
<?php
if($spo->itemCount) {
    $this->widget('bootstrap.widgets.TbGridView', array(
            'id'=>'spo-grid',
            'type'=>'striped bordered condensed',
            'dataProvider'=>$spo,
            'enableSorting'=>false,
            'summaryText'=>'',
            'columns'=>array(
                array(
                    'name' => 'sir_num',
                    'htmlOptions'=>array('style'=>'width:100px;'),
                ), 
                array(
                    'header' => 'Специальность',
                    'value' => 'Spo::model()->findByPk($data->id_spo)->naim_spo',
                ), 
                array(
                    'header' => 'Вид занятости',
                    'value' => 'Siroty_zan::model()->findByPk($data->id_zan)->naim_zan',
                    'htmlOptions'=>array('style'=>'width:170px;'),
                ),
                array(
                    'header' => 'Место занятости',
                    'name' => 'mesto',
                    'htmlOptions'=>array('style'=>'width:170px;'),
                ), 
                array(
                    'name' => 'nez',
                    'htmlOptions'=>array('style'=>'width:170px;'),
                ),                                  
                array(
                    'class'=>'bootstrap.widgets.TbButtonColumn',
                    'template'=>'{update}{delete}',
                    'updateButtonUrl'=>'Yii::app()->createUrl("complex/siroty/update_spo", array("id_spo_sir"=>$data->id_spo_sir))',
                    'deleteButtonUrl'=>'Yii::app()->createUrl("complex/siroty/delete_spo", array("id_spo_sir"=>$data->id_spo_sir))',
                    'deleteConfirmation'=>'Вы уверены, что хотите удалить специальность?',
                    ),
            ),            
    )); 
}?>
<div class="row"><p class="pull-right"><?php $this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'action', 'icon'=>'icon-plus', 'label'=>'Добавить специальность СПО', 'url'=>Yii::app()->createUrl("complex/siroty/create_spo", array('id_rep'=>$id_rep)))); ?></p></div>
<div class="row"><button style="margin:10px 10px;" class="btn btn-primary pull-right" onclick="javascript:history.back()">Назад</button></div>

