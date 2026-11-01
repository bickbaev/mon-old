<p>
   <strong>Инструкция по заполнению:</strong> 
   Для редактирования информации о факультете нажмите кнопку "Редактировать данные" внизу таблицы.<br/>
   Для добавления специальности нажмите кнопку "Добавить специальность".<br/>
   Для редактирования информации о специальности нажмите кнопку <i class="icon-pencil"></i> в строке специальности.<br/>
   Информация по специальностям указывается по направлениям, по которым будет осуществляться прием в 2021 году.<br/>
   Для удаления неверно добавленной специальности нажмите кнопку <i class="icon-trash"></i>.<br/> 
   Для возврата на основную страницу отчета нажмите кнопку "Вернуться".<br/>
   Внесенные в отчет данные будут отображаться на сайте <a target="_blank" href="http://kuda.samara.edu.ru">Куда пойти учиться</a>.<br />
   В случае возникновения вопросов звоните по телефону (846)2001519 (добавочный 901#) Бикбаев Дмитрий Аксанович<br> Адрес электронной почты bickbaev@gmail.com.
<!--   Данная информация собирается для областного сайта о системе профобразования области. Адрес сайта <a target="_blank" href="http://kuda.samara.edu.ru">http://kuda.samara.edu.ru</a>-->
</p>
<fieldset><legend>Информация о факультете/институте</legend></fieldset>
<?php $this->widget('bootstrap.widgets.TbDetailView', array(
    'data'=>$model,  
    'id'=>'faculty-table',
    'type'=>'condenced striped bordered',
    'attributes'=>array(
        'naim_faculty',
        'link',
    ),
));
?>
<div class="row"><p class="pull-right"><?php $this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'action', 'label'=>'Редактировать данные', 'url'=>Yii::app()->createUrl("complex/vpo/update_faculty", array('id_faculty'=>$model->id_faculty)))); ?></p></div>
<fieldset><legend>Информация о специальностях</legend></fieldset>
<?php
if($spec->itemCount) {
    $this->widget('bootstrap.widgets.TbGridView', array(
            'id'=>'spec-grid',
            'type'=>'striped bordered condensed',
            'dataProvider'=>$spec,
            'enableSorting'=>false,
            'summaryText'=>'',
            'columns'=>array(
                'code_vpo',
                'profil',
                array(
                    'name'=>'Форма обучения',
                    'value'=>'Vpo_forma::model()->findByPk($data->id_forma)->vpo_prog_naim',
                    ),
                'srok',
                //'isp',
                array(
                    'class'=>'bootstrap.widgets.TbButtonColumn',
                    'template'=>'{update}{delete}',
                    'updateButtonUrl'=>'Yii::app()->createUrl("complex/vpo/update_vpo_data", array("id_vpo"=>$data->id_vpo))',
                    'deleteButtonUrl'=>'Yii::app()->createUrl("complex/vpo/delete_vpo_data", array("id_vpo"=>$data->id_vpo))',
                    'deleteConfirmation'=>'Вы уверены, что хотите удалить специальность?',
                    ),
            ),            
    )); 
}?> 
<div class="row"><p class="pull-right"><?php $this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'action', 'icon'=>'icon-plus', 'label'=>'Добавить специальность', 'url'=>Yii::app()->createUrl("complex/vpo/create_vpo_data", array('id_rep'=>$model->id_report, 'id_faculty'=>$model->id_faculty)))); ?></p></div>
<div class="row"><p class="pull-right"><?php $this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'action', 'icon'=>'icon-arrow-left', 'label'=>'Вернуться', 'url'=>Yii::app()->createUrl("complex/vpo/edit", array('id_rep'=>$model->id_report)))); ?></p></div>
