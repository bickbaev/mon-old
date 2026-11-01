<?php $this->widget('bootstrap.widgets.TbAlert'); ?>
<fieldset><legend>Данные по учреждению - <?php echo $naim_est; ?></legend></fieldset>
<h4>Инструкция по заполнению отчета "Мониторинг ГИР"</h4>
<p>В целях выявления и организации психолого-педагогической поддержки обучающихся 10 и 11 классов имеющих потенциал для включения в государственный (региональный) информационный ресурс о лицах, проявивших выдающиеся способности, необходимо ввести информацию об обучающихся с высокими образовательными результатами. Информация вводится по каждому обучающемуся. Для добавления обучающегося нажмите кнопку "Добавить". Для добавления другого обучающегося нажмите кнопку "Добавить" еще раз. Информацию об обучающемся можно отредактировать нажав на соответствующие кнопки (в виде карандаша и корзины) в строке обучающегося.</p>
<p>Под обучающимися с высокими образовательными результатами понимаются обучающиеся, соответствующие хотя бы одному критерию:</p>
<ul>
  <li>средний балл 4,5 по всем изучаемым предметам по результатам промежуточной аттестации за последний учебный год,</li>
  <li>имеющие по основному государственному экзамену суммарно 53 и более баллов по двум профильным предметам (русский язык и математика) для учащихся 10 классов (для учащихся 11 классов данный критерий не применим, так как в 2020 году ОГЭ не проводился),</li>
  <li>победители/участники олимпиад и конкурсов, указанных в <a href="https://xn--80aayamnhpkade1j.xn--p1ai/documents/2021.08.31_pr_616_perechen2021-2022.pdf">приказе Министерства просвещения Российской Федерации от 31 августа 2021 г. № 616 «Об утверждении Перечня мероприятий на 2021/22 учебный год»</a> (окружной уровень и выше).</li>
</ul>

<h4 style="margin-top: 40px; margin-bottom: 20px;">Информация об ответственном от образовательной организации за работу с обучающимися с высокими образовательными результатами, а также за взаимодействие с образовательными организациями высшего образования</h4>
<div class="row"><p style="margin-left: 40px;"><?php echo $otv; ?><span style="margin-left: 20px;"><?php $this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'action', 'label'=>'Редактировать информацию об ответственном', 'url'=>Yii::app()->createUrl("complex/gir22/update_otv", array('id_rep'=>$id_rep)))); ?></span></p></div>
<?php echo '<h4 style="margin-top: 40px;">Обучающиеся с высокими образовательными результатами</h4>';
if($girs->itemCount) {  
    $this->widget('bootstrap.widgets.TbGridView', array(
            'id'=>'gir-grid',
            'type'=>'striped bordered condensed',
            'dataProvider'=>$girs,
            'enableSorting'=>false,
            'summaryText'=>'',
            'columns'=>array(
                array(
                    'header' => '№',
                    'value' => '$row+1',
                    'htmlOptions' => array('style' => 'width:25px;'),
                ),
                array(
                    'header' => 'Учащийся',
                    'value' => array($this, 'uch'),
                    'type'=>'html',
                ), 
                array(
                    'header' => 'Предметы ЕГЭ (средний балл)',
                    'value' => '$data->get_ege()',
                    'type'=>'html',
                ),
                array(
                    'header' => 'ВУЗы',
                    'value' => array($this, 'vuz'),
                    'type'=>'html',
                ),                                             
                array(
                    'class'=>'bootstrap.widgets.TbButtonColumn',
                    'template'=>'{update}{delete}',
                    'updateButtonUrl'=>'Yii::app()->createUrl("complex/gir22/update_gir", array("id_gir"=>$data->id_gir))',
                    'deleteButtonUrl'=>'Yii::app()->createUrl("complex/gir22/delete_gir", array("id_gir"=>$data->id_gir))',
                    'deleteConfirmation'=>'Вы уверены, что хотите удалить обучающегося?',
                    ),
            ),            
    )); 
}?>
<div class="row"><p class="pull-right"><?php $this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'action', 'icon'=>'icon-plus', 'label'=>'Добавить', 'url'=>Yii::app()->createUrl("complex/gir22/create_gir", array('id_rep'=>$id_rep)))); ?></p></div>
<div class="row"><p class="pull-right"><?php $this->widget('bootstrap.widgets.TbButton', array('type'=>'primary','label'=>'Назад', 'url'=>Yii::app()->createUrl("site/cabinet", array('id'=>$id_est)))); ?></p></div>

