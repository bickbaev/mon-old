<?php $this->widget('bootstrap.widgets.TbAlert'); ?>
<fieldset><legend>Данные по учреждению - <?php echo $naim_est; ?></legend></fieldset>
<h4>Инструкция</h4>
<p>Введите информацию о предполагаемом выпуске по профессиям и специальностям в Вашем учреждении.<br />
    Разберем ввод данных на примере профессии НПО. Например, по профессии "Электромонтажник авиационной техники" со сроком обучения 3 года 10 месяцев на 1 курсе в Вашем учреждении обучается 10 человек, на втором 12, на третьем 15, на четвертом 18. В этом случае Вы указываете, что предполагаемый выпуск в <?php echo $year1;?> году - 18 человек (это учащиеся 4 курса), в <?php echo $year1+1;?> - 15 человек (это учащиеся 3 курса), в <?php echo $year1+2;?> - 12 человек (это учащиеся 2 курса), в <?php echo $year1+3;?> - 10 человек (это учащиеся 1 курса).<br />
    В отчете учитываются только уже зачисленные студенты. Считается, что все студенты окончат обучение. Информация по определенной профессии или специальности вводится один раз.<br />Если по какой-то профессии или специальности срок обучения, например, 2 года, то вводятся данные только по <?php echo $year1;?> и <?php echo $year1+1;?> году.<br />
    Программы профессионального обучения (профподготовки) указывать не надо.<br />
    Данные собираются для раздела "Для работодателей" сайта <a target="_blank" href="http://kuda.samara.edu.ru">"Куда пойти учиться"</a>
</p>
<fieldset><legend>Информация о выпуске по профессиям НПО (старые коды)</legend></fieldset>
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
                    'header' => $year1.'г. (чел.)',
                    'name'=>'year1',
                ),
                array(
                    'header' => ($year1 +1).'г. (чел.)',
                    'name'=>'year2',
                ), 
                array(
                    'header' => ($year1 +2).'г. (чел.)',
                    'name'=>'year3',
                ), 
                array(
                    'header' => ($year1 +3).'г. (чел.)',
                    'name'=>'year4',
                ),                                                
                array(
                    'class'=>'bootstrap.widgets.TbButtonColumn',
                    'template'=>'{update}{delete}',
                    'updateButtonUrl'=>'Yii::app()->createUrl("complex/karta_out/update_npo", array("id_npo_out"=>$data->id_npo_out))',
                    'deleteButtonUrl'=>'Yii::app()->createUrl("complex/karta_out/delete_npo", array("id_npo_out"=>$data->id_npo_out))',
                    'deleteConfirmation'=>'Вы уверены, что хотите удалить профессию?',
                    ),
            ),            
    )); 
}?>
<div class="row"><p class="pull-right"><?php $this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'action', 'icon'=>'icon-plus', 'label'=>'Добавить профессию НПО', 'url'=>Yii::app()->createUrl("complex/karta_out/create_npo", array('id_rep'=>$id_rep)))); ?></p></div>
<fieldset><legend>Информация о выпуске по специальностям СПО (старые коды)</legend></fieldset>
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
                    'header' => '№',
                    'value' => '$row+1',
                    'htmlOptions' => array('style' => 'width:25px;'),
                ),
                array(
                    'header' => 'Специальность',
                    'value' => array($this, 'prof_spo'),
                    'type'=>'html',
                ),
                array(
                    'header' => $year1.'г. (чел.)',
                    'name'=>'year1',
                ),
                array(
                    'header' => ($year1 +1).'г. (чел.)',
                    'name'=>'year2',
                ), 
                array(
                    'header' => ($year1 +2).'г. (чел.)',
                    'name'=>'year3',
                ), 
                array(
                    'header' => ($year1 +3).'г. (чел.)',
                    'name'=>'year4',
                ),                                             
                array(
                    'class'=>'bootstrap.widgets.TbButtonColumn',
                    'template'=>'{update}{delete}',
                    'updateButtonUrl'=>'Yii::app()->createUrl("complex/karta_out/update_spo", array("id_spo_out"=>$data->id_spo_out))',
                    'deleteButtonUrl'=>'Yii::app()->createUrl("complex/karta_out/delete_spo", array("id_spo_out"=>$data->id_spo_out))',
                    'deleteConfirmation'=>'Вы уверены, что хотите удалить специальность?',
                    ),
            ),            
    )); 
}?>
<div class="row"><p class="pull-right"><?php $this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'action', 'icon'=>'icon-plus', 'label'=>'Добавить специальность СПО', 'url'=>Yii::app()->createUrl("complex/karta_out/create_spo", array('id_rep'=>$id_rep)))); ?></p></div>
<fieldset><legend>Информация о выпуске по профессиям/специальностям (новые коды)</legend></fieldset>
<?php
if($po->itemCount) {
    $this->widget('bootstrap.widgets.TbGridView', array(
            'id'=>'spo-grid',
            'type'=>'striped bordered condensed',
            'dataProvider'=>$po,
            'enableSorting'=>false,
            'summaryText'=>'',
            'columns'=>array(
                array(
                    'header' => '№',
                    'value' => '$row+1',
                    'htmlOptions' => array('style' => 'width:25px;'),
                ),
                array(
                    'header' => 'Специальность',
                    'value' => array($this, 'prof_po'),
                    'type'=>'html',
                ),
                array(
                    'header' => $year1.'г. (чел.)',
                    'name'=>'year1',
                ),
                array(
                    'header' => ($year1 +1).'г. (чел.)',
                    'name'=>'year2',
                ), 
                array(
                    'header' => ($year1 +2).'г. (чел.)',
                    'name'=>'year3',
                ), 
                array(
                    'header' => ($year1 +3).'г. (чел.)',
                    'name'=>'year4',
                ),                                             
                array(
                    'class'=>'bootstrap.widgets.TbButtonColumn',
                    'template'=>'{update}{delete}',
                    'updateButtonUrl'=>'Yii::app()->createUrl("complex/karta_out/update_po", array("id_po_out"=>$data->id_po_out))',
                    'deleteButtonUrl'=>'Yii::app()->createUrl("complex/karta_out/delete_po", array("id_po_out"=>$data->id_po_out))',
                    'deleteConfirmation'=>'Вы уверены, что хотите удалить профессию/специальность?',
                    ),
            ),            
    )); 
}?>
<div class="row"><p class="pull-right"><?php $this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'action', 'icon'=>'icon-plus', 'label'=>'Добавить професиию/специальность (новые коды)', 'url'=>Yii::app()->createUrl("complex/karta_out/create_po", array('id_rep'=>$id_rep)))); ?></p></div>
<div class="row"><button style="margin:10px 10px;" class="btn btn-primary pull-right" onclick="javascript:history.back()">Назад</button></div>