<?php
/* @var $this SiteController */

$this->pageTitle=Yii::app()->name;
?>
<div class="row" style="margin-top: 40px;"><div class="span12"><legend>Конкурсы</legend></div></div>
<?php
echo '<p>Абилимпикс</p>';
foreach ($abi as $item) {
    echo '<ul>';
    echo '<li>'.CHtml::link(date('Y', strtotime($item->rep_name_link->s_date)), array($item->link, 'id_comp'=>$item->id)).'</li>';
    echo '</ul>';  
}
echo '<p>Фестиваль возможностей</p>';
foreach ($fv as $item) {
    echo '<ul>';
    echo '<li>'.CHtml::link(date('Y', strtotime($item->rep_name->s_date)), array($item->link, 'id_comp'=>$item->id)).'</li>';
    echo '</ul>';  
}
echo '<p>Знакомство с профессией</p>';
foreach ($zp as $item) {
    echo '<ul>';
    echo '<li>'.CHtml::link(date('Y', strtotime($item->rep_name->s_date)), array($item->link, 'id_comp'=>$item->id)).'</li>';
    echo '</ul>';  
}

