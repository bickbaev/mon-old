<?php
$this->pageTitle=Yii::app()->name.' - '.$rep_name->rep_name.' '.$rep->est->est_name;
?>
<legend><?php echo $rep_name->rep_name.' период '.$rep_name->s_date.'-'.$rep_name->f_date; ?></legend>
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
            'value'=>CHtml::link('Скачать', array('/statistica/ws25/scandown2', 'id_rep'=>$obsh->id_report, 'id' => 6)).'<br><i>загружено '.$obsh->pok6_vr.'</i>',
            'type'=>'html',
            'visible'=>!$obsh->pok6?false:true,
        ), 
        array(
            'name'=>'pok7',
            'value'=>CHtml::link('Скачать', array('/statistica/ws25/scandown2', 'id_rep'=>$obsh->id_report, 'id' => 7)).'<br><i>загружено '.$obsh->pok7_vr.'</i>',
            'type'=>'html',
            'visible'=>!$obsh->pok7?false:true,
        ),
        array(
            'name'=>'pok8',
            'value'=>CHtml::link('Скачать', array('/statistica/ws25/scandown2', 'id_rep'=>$obsh->id_report, 'id' => 8)).'<br><i>загружено '.$obsh->pok8_vr.'</i>',
            'type'=>'html',
            'visible'=>!$obsh->pok8?false:true,
        ),        
    ),
));
?> 
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
                    'template'=>'{view}',                    
                    ),
            ),            
    )); 
}?>
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
                    'template'=>'{view}',
                    'viewButtonUrl'=>'Yii::app()->createUrl("statistica/ws25/view2", array("id"=>$data->id))',
                    ),
            ),            
    )); 
}?>