<?php $this->pageTitle=Yii::app()->name.' - Администрирование пользователей уровня области'; ?>
<fieldset><legend>Администрирование пользователей уровня области</legend></fieldset>
<?php $this->widget('bootstrap.widgets.TbGridView', array(
    'id'=>'user',
    'type'=>'striped condensed',
    'dataProvider'=>$users,
    'summaryText'=> '',
    'emptyText' => 'Нет пользователей',
    'hideHeader'=>false,    
    'columns'=>array(
        'user_id',
        array(
        'name'=>'ФИО',
        'value'=>'$data->surname." ".$data->name." ".$data->patronymic',
        ),
        'mail',
        array(
        'name'=>'Телефон',
        'value'=>array($this, 'phone'),
        ),
        array(
        'name'=>'Сотовый',
        'value'=>array($this, 'mobile'),
        ),
        array(
        'header'=>'Огр.',
        'value' => array($this, 'stat_only'),    
        ),                 
        array(
            'class' => 'bootstrap.widgets.TbButtonColumn',
            'template'=>'{update}{delete}',
            'deleteConfirmation' => 'Вы уверены, что хотите удалить пользователя?',
            'buttons'=>array(
                'update' => array(
                    'url'=>'Yii::app()->createUrl("admin/user_update", array("user_id"=>$data->user_id))',
                ),
                'delete' => array(
                    'url'=>'Yii::app()->createUrl("admin/user_delete", array("user_id"=>$data->user_id))',                  
                ),                 
            ),  
        ),
        
    )
));
?>
<?php $this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'action', 'icon'=>'plus', 'label'=>'Добавить пользователя', 'url'=>Yii::app()->createUrl("admin/user_add"))); ?>