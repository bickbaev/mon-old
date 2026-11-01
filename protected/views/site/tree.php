<?php $this->pageTitle=Yii::app()->name . ' - Кабинет'; ?>
<legend>Укажите объект для заполнения показателей</legend>
<div id="est_tree">
<?php
$baseUrl = Yii::app()->baseUrl;
$cs = Yii::app()->getClientScript();
$cs->registerScriptFile($baseUrl.'/js/edit_tree.js');
$this->widget(
    'CTreeView',
    array('url' => array('ajaxFillTree'))
);
$this->beginWidget('zii.widgets.jui.CJuiDialog', array(
                    'id' => 'mydialog',
                    'options' => array(
                        'title' => 'Изменение названия',
                        'autoOpen' => false,
                        'modal' => true,
                        'resizable'=> true,
                        'width' => 650,
                        'buttons' => array
                        (
                             'Ok'=>'js:function(){check();}',
                             'Отмена'=>'js:function(){$("#mydialog").dialog("close");}',
                        ),
                    ),
                ));
?>
<form>
    <input type="hidden" name="id_est" id="id_est" />
    <div id="est_error"></div>
    <label for="name">Название</label>
    <input name="name" type="text" id="name" class="span6" value="" />
</form>
<?php $this->endWidget('zii.widgets.jui.CJuiDialog');?>
</div>