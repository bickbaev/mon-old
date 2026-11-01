<?php $this->pageTitle=Yii::app()->name.' - Информация об образовательных учреждениях'; ?>

<fieldset><legend>Информация об организациях профессионального образования Самарской области</legend></fieldset>

<p><strong>Выберите муниципальное образование:</strong></p>
<ul>
<?php
foreach($raions as $raion) {
    echo '<li>'.CHtml::link($raion['est_name'], 'index.php?r=site/upo_type&id_raion='.$raion['id_est']).'</li>';
}
?>
</ul>