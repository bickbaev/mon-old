<fieldset><legend>Выберите наименование услуги (работы)</legend></fieldset>
<ul>
<?php
foreach($types as $type) {
    echo '<li>'.CHtml::link($type['naim_type'],array('uslugi22/step2',
                                         'id_rep'=>$id_rep,
                                         'type'=>$type['id_type'],
        )).'</li>';
}
?>
</ul>
