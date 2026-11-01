<?php $this->widget('bootstrap.widgets.TbAlert'); ?>
<fieldset><legend>Данные по учреждению - <?php echo $naim_est; ?></legend></fieldset>
<p>
   <strong>Инструкция по заполнению:</strong> заполните информацию о приеме по специальностям СПО.<br />
   Для добавления специальности нажмите кнопку "Добавить специальность".<br/>
   Для редактирования информации о специальности нажмите кнопку <i class="icon-pencil"></i> в строке специальности.<br/>
   Информация по специальностям указывается по направлениям, по которым будет осуществляться прием в 2021 году.<br/>
   Для удаления неверно добавленной специальности нажмите кнопку <i class="icon-trash"></i>.<br/> 
   Для возврата на основную страницу отчета нажмите кнопку "В личный кабинет".<br/>
   Внесенные в отчет данные будут отображаться на сайте <a target="_blank" href="http://kuda.samara.edu.ru">Куда пойти учиться</a>.<br />
   В случае возникновения вопросов звоните по телефону (846)2001519 (доб.901# ) Бикбаев Дмитрий Аксанович.<br /> Адрес электронной почты 901@cposo.ru<br>
   <strong>Программы професcиональной подготовки в этом отчет не указываются.</strong><br />
<!--   Данная информация собирается для областного сайта о системе профобразования области. Адрес сайта <a target="_blank" href="http://kuda.samara.edu.ru">http://kuda.samara.edu.ru</a>-->
</p>

<fieldset><legend>Информация о приеме по специальностям СПО</legend></fieldset>
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
                    'updateButtonUrl'=>'Yii::app()->createUrl("complex/vpo_spo/update_po", array("id_po_new"=>$data->id_po_new))',
                    'deleteButtonUrl'=>'Yii::app()->createUrl("complex/vpo_spo/delete_po", array("id_po_new"=>$data->id_po_new))',
                    'deleteConfirmation'=>'Вы уверены, что хотите удалить специальность?',
                    ),
            ),            
    )); 
}?>
<div class="row"><p class="pull-right"><?php $this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'action', 'icon'=>'icon-plus', 'label'=>'Добавить специальность', 'url'=>Yii::app()->createUrl("complex/vpo_spo/create_po", array('id_rep'=>$id_rep)))); ?></p></div>
<div class="row"><p class="pull-right"><?php $this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'action', 'icon'=>'icon-arrow-left', 'label'=>'В личный кабинет', 'url'=>Yii::app()->createUrl("site/cabinet", array('id'=>Yii::app()->session['est'])))); ?></p></div>
