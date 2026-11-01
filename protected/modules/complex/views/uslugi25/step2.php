<fieldset><legend>Выберите условия оказания услуги (работы)</legend></fieldset>
<ul>
<?php
foreach($formas as $forma) {
    echo '<li>'.CHtml::link($forma['naim_forma'],array('uslugi25/step3',
                                         'id_rep'=>$id_rep,
                                         'forma'=>$forma['id_forma'],
                                         'type'=>$type,
        )).'</li>';
}
?>
</ul>
