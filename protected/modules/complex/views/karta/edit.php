<?php $this->widget('bootstrap.widgets.TbAlert'); ?>
<fieldset><legend>Данные по учреждению - <?php echo $naim_est; ?></legend></fieldset>
<p>
   <strong>Инструкция по заполнению:</strong> заполните информацию об учреждении и приеме по профессиям/специальностям профессионального образования.<br />
   Прием по профессиям/специальностям указывается за период с настоящего времени по 1 октября 2025 года.<br/>
<!--   Отчет является универсальным, поэтому, если в учреждении нет ступени НПО или СПО, то соответствующая часть отчета не заполняется.<br />-->
   Отчет будет доступен для редактирования до 1 августа 2025 года и по мере появления у Вас информации о приеме, можно будет вносить изменения. После указанной даты редактирование отчета будет заблокировано.<br />
   Внесенные в отчет данные будут отображаться на сайте <a target="_blank" href="http://kuda.cposo.ru">Куда пойти учиться</a>.<br />
   <strong>Программы професcиональной подготовки в этом отчет не указываются. Для этих программ есть дополнительный отчет</strong><br />
   В случае возникновения вопросов звоните по телефону (846)2001519 (доб.901# ) Бикбаев Дмитрий Аксанович.<br /> Адрес электронной почты 901@cposo.ru
<!--   Данная информация собирается для областного сайта о системе профобразования области. Адрес сайта <a target="_blank" href="http://kuda.cposo.ru">http://kuda.cposo.ru</a>-->
</p>
<?php $this->widget('bootstrap.widgets.TbDetailView', array(
    'data'=>$info,  
    'id'=>'est-table',
    'type'=>'condenced striped bordered',
    'attributes'=>array(
        array(
            'label'=>'Муниципалитет',
            'value'=>Mun::model()->findByPk($info->id_mun)->naim_mun,
        ),
        'address',
        array(
            'name'=>'uch_inf',
            'type'=>'html',
        ),        
        array(
            'label'=>'Директор',
            'type'=>'raw',
            'value'=>$info->dir_sur.' '.$info->dir_name.' '.$info->dir_par,
        ),
        array(
            'label'=>'Телефон',
            'value'=>'8('.$info->cod_phone.')'.$info->phone,
            //'visible'=>($info->phone != ''),
        ),
        array(
            'label'=>'Факс',
            'value'=>'8('.$info->cod_fax.')'.$info->fax,
            //'visible'=>($info->cod_fax != ''),
        ),         
        array(
            'label'=>'Адрес сайта',
            'type'=>'url',
            'value'=>$info->site,
            //'value'=>CHtml::link($model->site, $model->site, array('target'=>'_blank')),Mun::model()->findByPk($info->id_mun)->naim_mun
        ),
        array(
            'label'=>'Адрес электронной почты',
            'type'=>'email',
            'value'=>$info->mail,
        ),
        'pr_address',        
        array(
            'label'=>'Режим работы приемной комиссии',
            'type'=>'html',
            'value'=>'C '.Karta_days::model()->findByPk($info->pr_s_day)->s_day.' по '.Karta_days::model()->findByPk($info->pr_f_day)->f_day.'.<br /> Часы работы с '.$info->pr_s_hour.' по '.$info->pr_f_hour.'.<br /> Обед с '.$info->pr_s_obed.' по '.$info->pr_f_obed,
        ),        
        array(
            'label'=>'Телефон приемной комиссии',
            'value'=>'8('.$info->pr_cod_phone.')'.$info->pr_phone,
            //'visible'=>($info->phone != ''),
        ),
        array(
            'label'=>'Факс приемной комиссии',
            'value'=>'8('.$info->pr_cod_fax.')'.$info->pr_fax,
            //'visible'=>($info->cod_fax != ''),
        ),
        'pr_mail',
        array(
            'name'=>'pr_priem',
            'type'=>'url',
        ),                
        array(
            'name'=>'pr_prim',
            'type'=>'html',
        ),           
        /*array(
            'label'=>'Ресурсный центр',
            'type'=>'html',
            'value'=>'Профиль - '.$info->res_profil.'.<br /> Ссылка на раздел сайта с информацией о ресурсном центре - '.$info->res_link,
        ),*/        
       
        
       
    ),
));
?>
<div class="row"><p class="pull-right"><?php $this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'action', 'label'=>'Редактировать данные', 'url'=>Yii::app()->createUrl("complex/karta/edit_info", array('id_rep'=>$info->id_report)))); ?></p></div>
<!--<fieldset><legend>Информация о филиалах</legend></fieldset>-->
<?php
/*if($fil->itemCount) {
    $this->widget('bootstrap.widgets.TbGridView', array(
            'id'=>'fil-grid',
            'type'=>'striped bordered condensed',
            'dataProvider'=>$fil,
            'enableSorting'=>false,
            'summaryText'=>'',
            'columns'=>array(
                array(
                    'name'=>'id_mun',
                    'value'=>'Mun::model()->findByPk($data->id_mun)->naim_mun',
                    ),
                'address',
                array(
                    'class'=>'bootstrap.widgets.TbButtonColumn',
                    'template'=>'{update}{delete}',
                    'updateButtonUrl'=>'Yii::app()->createUrl("complex/karta/update_fil", array("id_fil"=>$data->id_fil))',
                    'deleteButtonUrl'=>'Yii::app()->createUrl("complex/karta/delete_fil", array("id_fil"=>$data->id_fil))',
                    'deleteConfirmation'=>'Вы уверены, что хотите удалить филиал?',
                    ),
            ),            
    )); 
}*/?> 
<!--<div class="row"><p class="pull-right"><?php //$this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'action', 'icon'=>'icon-plus', 'label'=>'Добавить филиал', 'url'=>Yii::app()->createUrl("complex/karta/create_fil", array('id_rep'=>$info->id_report)))); ?></p></div>
<fieldset><legend>Информация о приеме по профессиям НПО</legend></fieldset>-->
<?php
/*if($npo->itemCount) {
    $this->widget('bootstrap.widgets.TbGridView', array(
            'id'=>'npo-grid',
            'type'=>'striped bordered condensed',
            'dataProvider'=>$npo,
            'enableSorting'=>false,
            'summaryText'=>'',
            'columns'=>array(
                array(
                    'header' => '№',
                    'value' => '$row+1',
                    'htmlOptions' => array('style' => 'width:25px;'),
                ),
                array(
                    'header' => 'Профессия',
                    'value' => array($this, 'prof_npo'),
                    'type'=>'html',
                ), 
                array(
                    'header' => 'Срок обучения, мес.',
                    'name' => 'srok',
                ),
                'nachalo',
                array(
                    'header' => 'Ограничения по здоровью',
                    'name' => 'zdorov',
                ),
                array(
                    'header' => 'Общежитие',
                    'value' => array($this, 'prof_obsh'),
                    'type'=>'html',
                    'htmlOptions' => array('style' => 'text-align:center;'),
                ),                
                
                array(
                    'class'=>'bootstrap.widgets.TbButtonColumn',
                    'template'=>'{update}{delete}',
                    'updateButtonUrl'=>'Yii::app()->createUrl("complex/karta/update_npo", array("id_npo_prof"=>$data->id_npo_prof))',
                    'deleteButtonUrl'=>'Yii::app()->createUrl("complex/karta/delete_npo", array("id_npo_prof"=>$data->id_npo_prof))',
                    'deleteConfirmation'=>'Вы уверены, что хотите удалить профессию?',
                    ),
            ),            
    )); 
}*/?>
<!--<div class="row"><p class="pull-right"><?php //$this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'action', 'icon'=>'icon-plus', 'label'=>'Добавить профессию НПО', 'url'=>Yii::app()->createUrl("complex/karta/create_npo", array('id_rep'=>$info->id_report)))); ?></p></div>
<fieldset><legend>Информация о приеме по специальностям СПО</legend></fieldset>-->
<?php
/*if($spo->itemCount) {
    $this->widget('bootstrap.widgets.TbGridView', array(
            'id'=>'spo-grid',
            'type'=>'striped bordered condensed',
            'dataProvider'=>$spo,
            'enableSorting'=>false,
            'summaryText'=>'',
            'columns'=>array(
                array(
                    'header' => '№',
                    'value' => '$row+1',
                    'htmlOptions' => array('style' => 'width:25px;'),
                ),
                array(
                    'value' => array($this, 'prof_spo'),
                    'type'=>'html',
                ), 
                array(
                    'header' => 'Срок обучения, мес.',
                    'name' => 'srok',
                ),
                'nachalo',
                array(
                    'header' => 'Ограничения по здоровью',
                    'name' => 'zdorov',
                ),
                array(
                    'header' => 'Общежитие',
                    'value' => array($this, 'prof_obsh'),
                    'type'=>'html',
                    'htmlOptions' => array('style' => 'text-align:center;'),
                ),                
                
                array(
                    'class'=>'bootstrap.widgets.TbButtonColumn',
                    'template'=>'{update}{delete}',
                    'updateButtonUrl'=>'Yii::app()->createUrl("complex/karta/update_spo", array("id_spo_prof"=>$data->id_spo_prof))',
                    'deleteButtonUrl'=>'Yii::app()->createUrl("complex/karta/delete_spo", array("id_spo_prof"=>$data->id_spo_prof))',
                    'deleteConfirmation'=>'Вы уверены, что хотите удалить специальность?',
                    ),
            ),            
    )); 
}*/?>
<!--<div class="row"><p class="pull-right"><?php //$this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'action', 'icon'=>'icon-plus', 'label'=>'Добавить специальность СПО', 'url'=>Yii::app()->createUrl("complex/karta/create_spo", array('id_rep'=>$info->id_report)))); ?></p></div>-->
<fieldset><legend>Информация о приеме по профессиям/специальностям</legend></fieldset>
<?php
if($po_new->itemCount) {
    $this->widget('bootstrap.widgets.TbGridView', array(
            'id'=>'spo-grid',
            'type'=>'striped bordered condensed',
            'dataProvider'=>$po_new,
            'enableSorting'=>false,
            'summaryText'=>'',
            'columns'=>array(
                array(
                    'header' => '№',
                    'value' => '$row+1',
                    'htmlOptions' => array('style' => 'width:25px;'),
                ),
                array(
                    'value' => array($this, 'prof_po'),
                    'type'=>'html',
                ), 
                array(
                    'header' => 'Срок обучения, мес.',
                    'name' => 'srok',
                ),
                'nachalo',
                /*array(
                    'header' => 'Ограничения по здоровью',
                    'name' => 'zdorov',
                ),*/
                array(
                    'header' => 'Общежитие',
                    'value' => array($this, 'prof_obsh'),
                    'type'=>'html',
                    'htmlOptions' => array('style' => 'text-align:center;'),
                ),                
                
                array(
                    'class'=>'bootstrap.widgets.TbButtonColumn',
                    'template'=>'{update}{delete}',
                    'updateButtonUrl'=>'Yii::app()->createUrl("complex/karta/update_po", array("id_po_new"=>$data->id_po_new))',
                    'deleteButtonUrl'=>'Yii::app()->createUrl("complex/karta/delete_po", array("id_po_new"=>$data->id_po_new))',
                    'deleteConfirmation'=>'Вы уверены, что хотите удалить профессию/специальность?',
                    ),
            ),            
    )); 
}?>
<div class="row"><p class="pull-right"><?php $this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'action', 'icon'=>'icon-plus', 'label'=>'Добавить профессию/специальность', 'url'=>Yii::app()->createUrl("complex/karta/create_po", array('id_rep'=>$info->id_report)))); ?></p></div>
<div class="row"><button style="margin:10px 10px;" class="btn btn-primary pull-right" onclick="javascript:history.back()">Назад</button></div>
