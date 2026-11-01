<?php $this->pageTitle=Yii::app()->name.' - Информация об образовательных учреждениях'; ?>

<fieldset><legend>Информация об образовательных учреждениях</legend></fieldset>

<p>На данной странице вы найдете информацию об образовательных учреждениях области<br />
    Выберите муниципальное образование:</p>
<p>
<?php
$i = 1;
foreach($raions as $raion) {
    echo CHtml::link($raion['est_name'], 'index.php?r=site/type&id_raion='.$raion['id_est']).'<br />';
}
?>
</p>
