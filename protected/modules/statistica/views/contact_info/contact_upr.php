<?php
$this->pageTitle=Yii::app()->name . ' - Контактные данные учреждений';
$street_type = array(1 => 'улица', 2 => 'проспект', 3 => 'переулок', 4 => 'проезд', 5 => 'шоссе', 6 => 'магистраль', 7 => 'просека', 8 => 'линия', 9 => 'бульвар', 10 => 'аллея', 11 => 'автомагистраль', 12 => 'тракт', 13 => 'тупик', 14 => 'набережная', 15 => 'разъезд', 16 => 'магистральная улица', 17 => 'квартал');
$nas_punkt_type = array(1 => 'город', 2 => 'посёлок городского типа', 3 => 'рабочий посёлок', 4 => 'посёлок', 5 => 'посёлок при станции', 6 => 'железнодорожная станция', 7 => 'село', 8 => 'деревня', 9 => 'район');
?>
<legend>Контактные данные учреждений - <?php echo $okrug.' - период '.$otchet['s_date'].'-'.$otchet['f_date']; ?></legend>

    <p><?php echo CHtml::link('Проверка ссылок контактов (e-mail, сайт)', 'index.php?r=statistica/contact_info/p_cont&id_okr='.$id_okr.'&id_rep_type='.$id_rep_type) ?></p>
    <p><?php //echo CHtml::link('Проверка ссылок документов', 'index.php?r=statistica/contact_info/p_doc&id_okr='.$id_okr.'&id_rep_type='.$id_rep_type) ?></p>
<table class="table table-striped table-bordered table-condensed">
    <thead>
        <tr>
            <th width="150">Учреждение</th>
            <th width="130">Адрес</th>
            <th width="120">Директор</th>
            <th width="130">Контакты</th>
<!--            <th width="370">Документы</th>-->
        </tr>
    </thead>
    <?php
    for($i = 0; $i < sizeof($raion); $i++) {
        echo '<tr><td colspan="11"><strong>'.$raion[$i]['est_name'].'</strong></td></tr>';
        for($k = 0; $k < sizeof($raion[$i]['reports']); $k++) {
            if($raion[$i]['reports'][$k]['znach']['site']) $raion[$i]['reports'][$k]['znach']['site'] = 'cайт: '.CHtml::link($raion[$i]['reports'][$k]['znach']['site'], $raion[$i]['reports'][$k]['znach']['site']); else $raion[$i]['reports'][$k]['znach']['site'] = '<span style="color:red">Сайта нет</span>';
            if($raion[$i]['reports'][$k]['znach']['mail']) $raion[$i]['reports'][$k]['znach']['mail'] = 'e-mail: '.CHtml::mailto($raion[$i]['reports'][$k]['znach']['mail'], $raion[$i]['reports'][$k]['znach']['mail']); else $raion[$i]['reports'][$k]['znach']['mail'] = '<span style="color:red">Электронной почты нет</span>';
            if($raion[$i]['reports'][$k]['znach']['publ']) $raion[$i]['reports'][$k]['znach']['publ'] = CHtml::link('Отчет о самообследовани', $raion[$i]['reports'][$k]['znach']['publ']); else $raion[$i]['reports'][$k]['znach']['publ'] = '<span style="color:red">Отчета о самообследовани нет</span>';
            if($raion[$i]['reports'][$k]['znach']['akkr']) $raion[$i]['reports'][$k]['znach']['akkr'] = CHtml::link('Свидетельство об аккредитации', $raion[$i]['reports'][$k]['znach']['akkr']); else $raion[$i]['reports'][$k]['znach']['akkr'] = '<span style="color:red">Свидетельства об аккредитации нет</span>';
            if($raion[$i]['reports'][$k]['znach']['lic']) $raion[$i]['reports'][$k]['znach']['lic'] = CHtml::link('Лицензия', $raion[$i]['reports'][$k]['znach']['lic']); else $raion[$i]['reports'][$k]['znach']['lic'] = '<span style="color:red">Лицензии нет</span>';
            if($raion[$i]['reports'][$k]['znach']['ustav']) $raion[$i]['reports'][$k]['znach']['ustav'] = CHtml::link('Устав', $raion[$i]['reports'][$k]['znach']['ustav']); else $raion[$i]['reports'][$k]['znach']['ustav'] = '<span style="color:red">Устава нет</span>';
            //if($raion[$i]['reports'][$k]['znach']['gos']) $raion[$i]['reports'][$k]['znach']['gos'] = CHtml::link('Положение об органе государственно-общественного управления', $raion[$i]['reports'][$k]['znach']['gos']); else $raion[$i]['reports'][$k]['znach']['gos'] = '<span style="color:red">Положения об органе государственно-общественного управления нет</span>';
            //if($raion[$i]['reports'][$k]['znach']['opl']) $raion[$i]['reports'][$k]['znach']['opl'] = CHtml::link('Положение о распределении стимулирующей части ФОТ', $raion[$i]['reports'][$k]['znach']['opl']); else $raion[$i]['reports'][$k]['znach']['opl'] = '<span style="color:red">Положения о распределении стимулирующей части ФОТ нет</span>';
            echo '<tr>';
            echo '<td>'.$raion[$i]['reports'][$k]['est_name'].'</td>';
            echo '<td>'.$nas_punkt_type[$raion[$i]['reports'][$k]['znach']['nas_punkt_type']].' '.$raion[$i]['reports'][$k]['znach']['nas_punkt'].',<br />'.$street_type[$raion[$i]['reports'][$k]['znach']['street_type']].' '.$raion[$i]['reports'][$k]['znach']['street'].',<br /> дом '.$raion[$i]['reports'][$k]['znach']['dom'].' '.$raion[$i]['reports'][$k]['znach']['korpus'].'</td>';
            echo '<td>'.$raion[$i]['reports'][$k]['znach']['dir_sur'].'<br />'.$raion[$i]['reports'][$k]['znach']['dir_name'].'<br />'.$raion[$i]['reports'][$k]['znach']['dir_par'].'</td>';
            echo '<td> тел. ('.$raion[$i]['reports'][$k]['znach']['cod_phone'].')'.$raion[$i]['reports'][$k]['znach']['phone'].'<br />факс. ('.$raion[$i]['reports'][$k]['znach']['cod_fax'].')'.$raion[$i]['reports'][$k]['znach']['fax'].'<br />'.$raion[$i]['reports'][$k]['znach']['mail'].'<br />'.$raion[$i]['reports'][$k]['znach']['site'].'</td>';
            //echo '<td>'.$raion[$i]['reports'][$k]['znach']['publ'].'<br />'.$raion[$i]['reports'][$k]['znach']['akkr'].'<br />'.$raion[$i]['reports'][$k]['znach']['lic'].'<br />'.$raion[$i]['reports'][$k]['znach']['ustav'].'<br />'.$raion[$i]['reports'][$k]['znach']['gos'].'<br />'.$raion[$i]['reports'][$k]['znach']['opl'].'</td>';
            //echo '<td>'.$raion[$i]['reports'][$k]['znach']['publ'].'<br />'.$raion[$i]['reports'][$k]['znach']['akkr'].'<br />'.$raion[$i]['reports'][$k]['znach']['lic'].'<br />'.$raion[$i]['reports'][$k]['znach']['ustav'].'<br />'.'</td>';
            echo '</tr>';
        }
    }
    ?>
</table>