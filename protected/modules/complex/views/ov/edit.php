<fieldset><legend>Данные по учреждению - <?php echo $naim_est; ?></legend></fieldset>
<p>
   <strong>Инструкция по заполнению:</strong> В данном отчете вводится информация о программах профессионального обучения, реализуемых в Вашей организации.<br />
   В первую очередь необходимо указать информацию об ответственном за профессиональное обучение. Этот сотрудник будет указан как контактное лицо по профессиональному обучению.
   Для ввода информации о данном сотруднике нажмите кнопку <b>"Редактировать данные"</b>.<br />
   Далее введите информацию о программах профессионального обучения реализуемых в Вашем учреждении в 2025 календарном году.<br />
   Для ввода программы, нажмите на кнопку <b>"Добавить программу"</b><br />
   Для редактирования уже введенной программы, нажмите значок в виде ручки напротив названия программы<br />
   Для удаления введенной программы нажмите на значок "урна" напротив названия программы<br /> 
   В случае возникновения вопросов звоните по телефону (846)2001519 (доб.901# ) Бикбаев Дмитрий Аксанович.<br /> Адрес электронной почты 901@cposo.ru<br>
   Данная информация собирается для областного сайта <a target="_blank" href="http://kuda.cposo.ru">"Куда пойти учиться"</a>
</p>
<?php $this->widget('bootstrap.widgets.TbAlert'); ?>
<fieldset><legend>Информация об ответственном за профессиональное обучение в учреждении</legend></fieldset>
<?php $this->widget('bootstrap.widgets.TbDetailView', array(
    'data'=>$info,  
    'id'=>'est-table',
    'type'=>'condenced striped bordered',
    'attributes'=>array(
        'fio_otv',
        array(
            'label'=>'Телефон',
            'value'=>'8('.$info->cod_tel.')'.$info->tel,
        ),        
        'mail',
    ),
));
?>
<div class="row"><p class="pull-right"><?php $this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'action', 'label'=>'Редактировать данные', 'url'=>Yii::app()->createUrl("complex/ov/edit_info", array('id_rep'=>$id_rep)))); ?></p></div>
<fieldset><legend>Программы профессионального обучения</legend></fieldset>
<?php
$this->widget('bootstrap.widgets.TbGridView', array(
'id'=>'mer',
'type'=>'striped',
'dataProvider'=>$kurs,
//'hideHeader'=>true,
'summaryText'=> '',
'emptyText' => 'Нет программ',    
'columns'=> array(
    array(
        'header'=>'Наименование по ОКПДТР',
        'name'=>'id_okpdtr',
        'value'=>array($this, 'edit_report_index'),
    ),
    'id_okpdtr',
    'naim_kurs',
    'hours_kurs',
    array(
        'class' => 'bootstrap.widgets.TbButtonColumn',
        'template'=>'{update}{delete}',
        'updateButtonUrl'=>'Yii::app()->createUrl("complex/ov/update_kurs", array("id_mer"=>$data->id_mer))',
        'deleteButtonUrl'=>'Yii::app()->createUrl("complex/ov/delete_kurs", array("id_mer"=>$data->id_mer))',
        'deleteConfirmation'=>'Вы уверены, что хотите удалить мероприятие?',
    ),    
),    
)); 
?>
<div class="row"><p class="pull-right"><?php $this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'action', 'icon'=>'icon-plus', 'label'=>'Добавить программу', 'url'=>Yii::app()->createUrl("complex/ov/create_kurs", array('id_rep'=>$id_rep)))); ?></p></div>
<div class="row"><button style="margin:10px 10px;" class="btn btn-primary pull-right" onclick="javascript:history.back()">Назад</button></div>
