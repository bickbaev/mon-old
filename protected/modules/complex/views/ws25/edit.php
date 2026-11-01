<?php $this->widget('bootstrap.widgets.TbAlert'); ?>
<fieldset><legend><?php echo $rep->rep_name->rep_name.'. '.$est->est_name; ?></legend></fieldset>
<p><strong>Инструкция по заполнению</strong></p>
<p>Для формирования заявки необходимо выполнить следующие шаги последовательно:</p>
<ol>
  <li>
    <strong>Введите данные ответственного лица.</strong>
    <ul>
      <li>
        <p>Нажмите кнопку «Редактировать данные» и заполните открывшуюся форму.</p>
      </li>
    </ul>
  </li>
  <li>
    <strong>Заполните информацию о конкурсантах.</strong>
    <ul>
      <li>
        <p>Кнопка «Добавить конкурсанта» станет активной после сохранения данных об ответственном лице.</p>
      </li>
    </ul>
  </li>
  <li>
    <strong>Добавьте данные об экспертах, главных экспертах, технических администраторах площадок и волонтерах.</strong>
    <ul>
      <li>
        <p>Нажмите кнопку «Добавить» и внесите необходимые сведения.</p>
      </li>
    </ul>    
  </li>
</ol>
<p style="margin-bottom: 30px;"><strong>Важно:</strong> Отчет автоматически приобретет статус «Заполнен», как только в нем будет указан хотя бы один конкурсант.</p>
<?php $this->widget('bootstrap.widgets.TbDetailView', array(
    'data'=>$obsh,  
    'id'=>'obsh-table',
    'type'=>'condenced striped bordered',
    'attributes'=>array(
        array(
            'label'=>'Ответственный',
            'type'=>'raw',
            'value'=>$obsh->pok1.' '.$obsh->pok2.' '.$obsh->pok3,
        ),
        array(
            'name'=>'pok9',
            'type'=>'html',
            'visible'=>!$obsh->pok9?false:true,
        ),        
        array(
            'label'=>'Телефон',
            'value'=>'+7('.$obsh->pok4.')'.$obsh->pok5,
            'visible'=>!$obsh->pok5?false:true,
        ),
        array(
            'name'=>'pok6',
            'value'=>CHtml::link('Скачать', array('ws25/scandown2', 'id_rep'=>$obsh->id_report, 'id' => 6)).'<br><i>загружено '.$obsh->pok6_vr.'</i>',
            'type'=>'html',
            'visible'=>!$obsh->pok6?false:true,
        ), 
        array(
            'name'=>'pok7',
            'value'=>CHtml::link('Скачать', array('ws25/scandown2', 'id_rep'=>$obsh->id_report, 'id' => 7)).'<br><i>загружено '.$obsh->pok7_vr.'</i>',
            'type'=>'html',
            'visible'=>!$obsh->pok7?false:true,
        ),
        array(
            'name'=>'pok8',
            'value'=>CHtml::link('Скачать', array('ws25/scandown2', 'id_rep'=>$obsh->id_report, 'id' => 8)).'<br><i>загружено '.$obsh->pok8_vr.'</i>',
            'type'=>'html',
            'visible'=>!$obsh->pok8?false:true,
        ),        
    ),
));
?> 
<div class="row"><p class="pull-right"><?php $this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'action', 'label'=>'Редактировать данные', 'url'=>Yii::app()->createUrl("complex/ws25/update_obsh", array('id_rep'=>$obsh->id_report)))); ?></p></div>
<fieldset><legend>Конкурсанты</legend></fieldset>
<?php
if($part1->itemCount) {
    $this->widget('bootstrap.widgets.TbGridView', array(
            'id'=>'part-grid',
            'type'=>'striped bordered condensed',
            'dataProvider'=>$part1,
            'enableSorting'=>false,
            'summaryText'=>'',
            'columns'=>array(
                array(
                    'header' => '№',
                    'value' => '$row+1',
                    'htmlOptions' => array('style' => 'width:25px;'),
                ),
                array(
                    'header'=>'Участник',
                    'type'=>'html',
                    'value'=>'"<b>".$data->surname." ".$data->name." ".$data->patr."</b>"."<br>".$data->burthdate."<br>".CHtml::mailto($data->pers_mail, $data->pers_mail)."<br>".$data->nas_punkt',
                ),
                array(
                    'header'=>'Статус',
                    'type'=>'html',
                    'value'=>'Ws25_cat::model()->findByPk($data->id_cat)->naim."<br>".Ws25_compet::model()->findByPk($data->id_compet)->naim',
                ), 
                array(
                    'header'=>'Учеба',
                    'type'=>'html',
                    'value'=>'Est::model()->findByPk($data->id_est)->est_name."<br>Класс/курс ".$data->klass."<br>Год. окон. ".$data->end_god."<br>".$data->id_po." ".Po_new::model()->findByPk($data->id_po)->naim_po',
                ),
                array(
                    'header'=>'Сопр/эксп.-наст.',
                    'type'=>'html',
                    'value'=>'"Сопр. ".$data->get_fio_accomp()."<br>Эксп.-наст. ".$data->get_fio_mentor()',
                ),                
                array(
                    'header'=>'Условия',
                    'type'=>'html',
                    'value'=>'($data->housing?"Требуется проживание":"Не требуется проживание")."<br>Разм. одеж. ".Ws25_size::model()->findByPk($data->id_size)->naim."<br>".CHtml::link(Согласие, array("ws25/scandown", "id"=>$data->id, "type" => 1))',
                ),                
                array(
                    'class'=>'bootstrap.widgets.TbButtonColumn',
                    'template'=>'{view}{update}{delete}',
                    'updateButtonUrl'=>'Yii::app()->createUrl("complex/ws25/update", array("id"=>$data->id))',
                    'deleteButtonUrl'=>'Yii::app()->createUrl("complex/ws25/delete", array("id"=>$data->id))',
                    'deleteConfirmation'=>'Вы уверены, что хотите удалить участника?',
                    'buttons'=>array(
                        'update'=>array(
                            'visible'=>'$data->can_red()',
                        ),
                        'delete'=>array(
                            'visible'=>'$data->can_red()',
                        ),
                    ),                    
                    ),
            ),            
    )); 
}?>
<div class="row"><p class="pull-right"><?php if($obsh->pok1) $this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'action', 'icon'=>'icon-plus', 'label'=>'Добавить конкурсанта', 'url'=>Yii::app()->createUrl("complex/ws25/create", array('id_rep'=>$obsh->id_report)))); ?></p></div>
<fieldset><legend>Индустриальные эксперты, главные эксперты, технические администраторы площадок и волонтеры</legend></fieldset>
<?php
if($part2->itemCount) {
    $this->widget('bootstrap.widgets.TbGridView', array(
            'id'=>'exp-grid',
            'type'=>'striped bordered condensed',
            'dataProvider'=>$part2,
            'enableSorting'=>false,
            'summaryText'=>'',
            'columns'=>array(
                array(
                    'header' => '№',
                    'value' => '$row+1',
                    'htmlOptions' => array('style' => 'width:25px;'),
                ),
                array(
                    'header'=>'Участник',
                    'type'=>'html',
                    'value'=>'"<b>".$data->surname." ".$data->name." ".$data->patr."</b>"."<br>".$data->burthdate."<br>".CHtml::mailto($data->pers_mail, $data->pers_mail)."<br>".$data->nas_punkt',
                ),
                array(
                    'header'=>'Статус',
                    'type'=>'html',
                    'value'=>'Ws25_stat::model()->findByPk($data->id_stat)->naim."<br>".Ws25_cat::model()->findByPk($data->id_cat)->naim."<br>".Ws25_compet::model()->findByPk($data->id_compet)->naim',
                ), 
                array(
                    'header'=>'Работа',
                    'type'=>'html',
                    'value'=>'$data->rabota."<br>".$data->dol."<br>".CHtml::mailto($data->org_mail, $data->org_mail)',
                ),
                array(
                    'header'=>'Условия',
                    'type'=>'html',
                    'value'=>'($data->housing?"Требуется проживание":"Не требуется проживание")."<br>Разм. одеж. ".Ws25_size::model()->findByPk($data->id_size)->naim."<br>".CHtml::link(Согласие, array("ws25/scandown", "id"=>$data->id, "type" => 1))',
                ),                
                array(
                    'class'=>'bootstrap.widgets.TbButtonColumn',
                    'template'=>'{view}{update}{delete}',
                    'updateButtonUrl'=>'Yii::app()->createUrl("complex/ws25/update2", array("id"=>$data->id))',
                    'deleteButtonUrl'=>'Yii::app()->createUrl("complex/ws25/delete2", array("id"=>$data->id))',
                    'viewButtonUrl'=>'Yii::app()->createUrl("complex/ws25/view2", array("id"=>$data->id))',
                    'deleteConfirmation'=>'Вы уверены, что хотите удалить участника?',
                    ),
            ),            
    )); 
}?>
<div class="row"><p class="pull-right"><?php if($obsh->pok1) $this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'action', 'icon'=>'icon-plus', 'label'=>'Добавить', 'url'=>Yii::app()->createUrl("complex/ws25/create2", array('id_rep'=>$obsh->id_report)))); ?></p></div>
<div class="row"><button style="margin:10px 10px;" class="btn btn-primary pull-right" onclick="javascript:history.back()">Назад</button></div>
