<?php $this->widget('bootstrap.widgets.TbAlert'); ?>
<fieldset><legend>Данные по организации - <?php echo $naim_est; ?></legend></fieldset>
<p>
   <strong>Инструкция по заполнению:</strong> заполните информацию о ВУЗе, факультетах/институтах и специальностях ВО.<br/>
   Подготовка по специальностям СПО указывается в другом отчете.<br />
   Для заполнения информации о ВУЗе нажмите кнопку "Редактировать данные" внизу таблицы.<br/>
   Для добавления факультета нажмите кнопку "Добавить факультет".<br/>
   После добавления факультета для добавления информации о специальностях нажмите кнопку <i class="icon-pencil"></i> в строке факультета.<br/>
   Информация по специальностям указывается по направлениям, по которым будет осуществляться прием в 2021 году.<br/>
   Для удаления неверно добавленного факультета нажмите кнопку <i class="icon-trash"></i>.<br/>   
   Внесенные в отчет данные будут отображаться на сайте <a target="_blank" href="http://kuda.samara.edu.ru">Куда пойти учиться</a>.<br />
   В случае возникновения вопросов звоните по телефону (846)2001519 (добавочный 901#) Бикбаев Дмитрий Аксанович<br> Адрес электронной почты bickbaev@gmail.com.
<!--   Данная информация собирается для областного сайта о системе профобразования области. Адрес сайта <a target="_blank" href="http://kuda.samara.edu.ru">http://kuda.samara.edu.ru</a>-->
</p>

<?php $this->widget('bootstrap.widgets.TbDetailView', array(
    'data'=>$info,  
    'id'=>'info-table',
    'type'=>'condenced striped bordered',
    'attributes'=>array(
        array(
            'label'=>'Муниципалитет',
            'value'=>Mun::model()->findByPk($info->id_mun)->naim_mun,
        ),
        'address',        
        array(
            'label'=>'Ректор',
            'type'=>'raw',
            'value'=>$info->dir_sur.' '.$info->dir_name.' '.$info->dir_par,
        ),
        array(
            'label'=>'Официальный телефон',
            'value'=>'8('.$info->cod_phone.')'.$info->phone,
            //'visible'=>($info->phone != ''),
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
        'pr_mail',
        array(
            'name'=>'pr_priem',
            'type'=>'url',
        ),                
        array(
            'name'=>'podg',
            'type'=>'html',
        ),                  
    ),
));
?>
<div class="row"><p class="pull-right"><?php $this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'action', 'label'=>'Редактировать данные', 'url'=>Yii::app()->createUrl("complex/vpo/edit_info", array('id_rep'=>$info->id_report)))); ?></p></div>

<?php
if($faculty->itemCount) {
echo '<fieldset><legend>Факультеты/институты</legend></fieldset>';
    $this->widget('bootstrap.widgets.TbGridView', array(
            'id'=>'fil-grid',
            'type'=>'striped bordered condensed',
            'dataProvider'=>$faculty,
            'enableSorting'=>false,
            'summaryText'=>'',
            'columns'=>array(
                array(
                    'header' => 'Факультет/институт',
                    'value' => array($this, 'fac_info'),
                    'type'=>'html',
                ),
                array(
                    'header' => 'Число специальностей',
                    'value' => array($this, 'fac_spec'),
                    'type'=>'html',
                ),                
                array(
                    'class'=>'bootstrap.widgets.TbButtonColumn',
                    'template'=>'{update}{delete}',
                    'updateButtonUrl'=>'Yii::app()->createUrl("complex/vpo/edit_faculty", array("id_faculty"=>$data->id_faculty))',
                    'deleteButtonUrl'=>'Yii::app()->createUrl("complex/vpo/delete_faculty", array("id_faculty"=>$data->id_faculty))',
                    'deleteConfirmation'=>'Вы уверены, что хотите удалить факультет/институт?',
                    ),
            ),            
    )); 
}?> 

<div class="row"><p class="pull-right"><?php $this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'action', 'icon'=>'icon-plus', 'label'=>'Добавить факультет/институт', 'url'=>Yii::app()->createUrl("complex/vpo/create_faculty", array('id_rep'=>$id_rep)))); ?></p></div>
<div class="row"><p class="pull-right"><?php $this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'action', 'icon'=>'icon-arrow-left', 'label'=>'В личный кабинет', 'url'=>Yii::app()->createUrl("site/cabinet", array('id'=>Yii::app()->session['est'])))); ?></p></div>
