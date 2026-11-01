<?php
/* @var $this SiteController */

$this->pageTitle=Yii::app()->name;
?>
<div class="row" style="margin-top: 40px;"><div class="span12"><legend>Выберите кампанию</legend></div></div>
<?php
foreach ($comps as $comp) {
    echo '<ul>';
    echo '<li>'.CHtml::link(date('Y', strtotime($comp->rv)).' год', array('ws25obsh/index', 'id_comp'=>$comp->id)).'</li>';
    echo '</ul>';      
}
?>