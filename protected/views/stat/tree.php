<?php $this->pageTitle=Yii::app()->name . ' - Статистика заполнения отчетов'; ?>
<fieldset><legend>Сводные данные по отчетам</legend></fieldset>
<h5>Выберите отчет</h5>
<?php
$this->widget(
    'CTreeView',
    array('url' => array('ajaxFillTree'))
);
?>