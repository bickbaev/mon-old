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
</ol>
<p style="margin-bottom: 30px;"><strong>Важно:</strong> Отчет автоматически приобретет статус «Заполнен», как только в нем будет указан хотя бы один конкурсант.</p>
<?php $this->widget('bootstrap.widgets.TbDetailView', array(
    'data'=>$obsh,  
    'id'=>'obsh-table',
    'type'=>'condenced striped bordered',
    'attributes'=>array(
        array(
            'label'=>'Ответственный за заполнение заявки ',
            'type'=>'raw',
            'value'=>$obsh->surname.' '.$obsh->name.' '.$obsh->patr,
        ),
        array(
            'name'=>'mail',
            'type'=>'html',
            'visible'=>!$obsh->mail?false:true,
        ), 
        array(
            'name'=>'dol',
            'type'=>'html',
            'visible'=>!$obsh->dol?false:true,
        ),         
        array(
            'label'=>'Телефон',
            'value'=>'+7('.$obsh->code.')'.$obsh->tel,
            'visible'=>!$obsh->tel?false:true,
        ),
        array(
            'name'=>'comment',
            'type'=>'html',
            'value'=>'<span style="color: red;">'.CHtml::encode($obsh->comment).'</span>',
            'visible'=>!$obsh->comment?false:true,
        ),         
    ),
));
?> 
<div class="row"><p class="pull-right"><?php $this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'action', 'label'=>'Редактировать данные', 'url'=>Yii::app()->createUrl("complex/abi25zp/update_obsh", array('id_rep'=>$obsh->id_report)))); ?></p></div>
<fieldset><legend>Конкурсанты</legend></fieldset>
<?php
if($part->itemCount) {
    $this->widget('bootstrap.widgets.TbGridView', array(
            'id'=>'part1-grid',
            'type'=>'striped bordered condensed',
            'dataProvider'=>$part,
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
                    'value'=>'"<b>".$data->surname." ".$data->name." ".$data->patr."</b>"."<br>".$data->burthdate."<br>".CHtml::mailto($data->lic_mail, $data->lic_mail)."<br>+7(".$data->lic_code.")".$data->lic_tel."<br>Размер одежды ".Abi25_size::model()->findByPk($data->id_size)->naim',
                ),
                array(
                    'header'=>'Кат./комп.',
                    'type'=>'html',
                    'value'=>'Abi25_zp_cat::model()->findByPk($data->id_cat)->naim."<br>".Abi25_zp_compet::model()->findByPk($data->id_compet)->naim',
                ), 
                array(
                    'header'=>'Огр. по здоровью',
                    'type'=>'html',
                    'value'=>'Abi25_noz::model()->findByPk($data->id_noz)->naim.($data->id_gr?"<br>".Abi25_gr::model()->findByPk($data->id_gr)->naim."<br>".CHtml::link("Справка", array("abi25zp/scandown", "id"=>$data->id, "type" => 1))." до ".$data->spr_date:"").($data->ovz?"<br>ОВЗ"."<br>".CHtml::link("Справка", array("abi25zp/scandown", "id"=>$data->id, "type" => 4)):"")',
                ),
                array(
                    'header'=>'Сопровожд.',
                    'type'=>'html',
                    'value'=>'$data->per_surname." ".$data->per_name." ".$data->per_patr."<br>+7(".$data->per_code.")".$data->per_tel',
                ),                
                array(
                    'header'=>'Посл. ред.',
                    'type'=>'html',
                    'value'=>'$data->r_date',
                ),                
                array(
                    'class'=>'bootstrap.widgets.TbButtonColumn',
                    'template'=>'{update}{delete}',
                    'updateButtonUrl'=>'Yii::app()->createUrl("complex/abi25zp/update", array("id"=>$data->id))',
                    'deleteButtonUrl'=>'Yii::app()->createUrl("complex/abi25zp/delete", array("id"=>$data->id))',
                    'deleteConfirmation'=>'Вы уверены, что хотите удалить конкурсанта?',
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
<div class="row"><p class="pull-right"><?php if($obsh->surname) $this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'action', 'icon'=>'icon-plus', 'label'=>'Добавить конкурсанта', 'url'=>Yii::app()->createUrl("complex/abi25zp/create", array('id_rep'=>$obsh->id_report)))); ?></p></div>
<div class="row"><p class="pull-right"><?php $this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'action', 'label'=>'Назад', 'url'=>$this->createUrl('/site/cabinet',array('id'=>$est->id_est)))); ?></div>
