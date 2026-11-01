<?php $this->pageTitle=Yii::app()->name.' - Кабинет'; ?>
<?php $this->widget('bootstrap.widgets.TbAlert'); ?>
<fieldset><legend><?php echo $name; ?></legend></fieldset>
<?php if($pred_res == 1) $this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'action', 'type'=>'primary', 'label'=>'Работа с предписаниями', 'url'=>$this->createUrl('/prescription/default/cabinet',array('id_est'=>$id_est)), 'htmlOptions' => array('style'=>'margin:10px 0 20px 0;')));
      elseif($pred_res == 2) $this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'action', 'type'=>'primary', 'label'=>'Работа с предписаниями', 'url'=>$this->createUrl('/prescription'), 'htmlOptions' => array('style'=>'margin:10px 0 10px 0;')));
      if($id_est == 1) {
          $this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'action', 'type'=>'primary', 'label'=>'Профессионалы', 'url'=>$this->createUrl('/ws25obsh/comp'), 'htmlOptions' => array('style'=>'margin:10px 0 20px 0; display: block; width: 163px;')));
          $this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'action', 'type'=>'primary', 'label'=>'Абилимпикс', 'url'=>$this->createUrl('/abi'), 'htmlOptions' => array('style'=>'margin:10px 0 20px 0; display: block; width: 163px;')));
      }    
?>
<?php
$o_header = '<table class="table table-striped table-bordered">
      <thead>
        <th>Статус</th>
        <th>Таблица</th>
        <th colspan="2" scope="col" style="text-align:center;">Период</th>
        <th>Действия</th>
      </thead>';
$o_footer = '</table>';
$td_status = array('1'=>'<td style="background-color: red; width:130px;">Новый</td>', '2'=>'<td style="background-color: #FF6A00; width:130px;">Заполнен</td>', '3'=>'<td style="background-color: #FF006E; width:130px;">Доработать</td>', '4'=>'<td style="background-color: #4CFF00; width:130px;">Заблокирован</td>', '5'=>'<td style="background-color: #CCFFF7; width:130px;">На согласовании</td>', '6'=>'<td style="width:130px;">Принят</td>');
$rep_deistv = array(
    array('Редактировать', 'index.php?r=report/edit&id_rep=', 'images/edit.png'),
    array('Заблокировать', 'index.php?r=report/block&id_rep=', 'images/prov.png'),
    array('Доработать', 'index.php?r=report/dorab&id_rep=', 'images/dorab.png'),
    array('Разблокировать', 'index.php?r=report/razb&id_rep=', 'images/sogl.png'),
    array('Принять', 'index.php?r=report/prin&id_rep=', 'images/prin.png'),
    array('Просмотр', 'index.php?r=report/view&id_rep=', 'images/view.png'),
);
$otchet = array('Месячные отчеты', 'Квартальные отчеты', 'Годовые отчеты', 'Полные отчеты');
for($m = 0; $m < 4; $m++){

    if(sizeof($reports[$m])) {
            echo '<h5>'.$otchet[$m].'</h5>';
            echo $o_header;
            for($n = 0; $n < sizeof($reports[$m]); $n++) {
                $deistv = '';
                for ($k = 0; $k < 6; $k++) {
                    if($reports[$m][$n]['deistv'][$k]) $deistv = $deistv.' '.CHtml::image($rep_deistv[$k][2]).CHtml::link($rep_deistv[$k][0], $rep_deistv[$k][1].$reports[$m][$n]['id_report']);
                }
                echo '<tr>'.$td_status[$reports[$m][$n]['status']].'<td style="width:230px;">'.$reports[$m][$n]['rep_name'].'</td><td style="width:90px;">'.$reports[$m][$n]['s_date'].'</td><td style="width:90px;">'.$reports[$m][$n]['f_date'].'</td><td>'.$deistv.'</td></tr>';
            }
            echo $o_footer;
    }
}?>
<?php if($otchet_stat) {
    echo '<h5 style="margin-top: 20px;">Сервисы</h5><div class = "otchet_isp">'.CHtml::image('images/chart.png').CHtml::link('Контроль заполнения отчетов', 'index.php?r=report/stat&id_est='.$id_est).'</div>';
    echo '<div class = "otchet_isp" style="margin-top:7px;">'.CHtml::image('images/users.png').CHtml::link('Контактные данные операторов', 'index.php?r=report/sprav&id_est='.$id_est).'</div>';
}
?>
<?php
if($video != false) {
echo '<h5 style="margin-top: 100px;">Видеоконференции ('.CHtml::link('как подключиться',array('site/page', 'view'=>'help_bbb')).')</h5>';    
$this->widget('bootstrap.widgets.TbGridView', array(
    'type'=>'striped bordered condensed',
    'dataProvider'=>$video,
    'summaryText'=>'',
    'columns' => array(
        array(  
            'name' => 'name',  
            'header' => 'Название конференции',
        ),        
        array(  
            'header' => 'Действия',
            'type'=>'html',
            'value'=>'CHtml::link("Войти", array("site/bbb_join","meetingid"=>$data["id"]))',
        ),                             
    )          
));
}
?>
<h5 style="margin-top: 100px;">Операторы</h5>
<?php
echo $spravochnik;
$ch_pas_i = CHtml::image('images/ch_pass.png');
$usr_edit_i = CHtml::image('images/pencil.png');
$usr_del_i = CHtml::image('images/cross.png');
$ch_pas = 'index.php?r=user/pass&id=';
$usr_edit = 'index.php?r=user/edit&id=';
$usr_del = 'index.php?r=user/del&id=';
$u_header = '<table class="table table-striped table-bordered">
      <thead>
        <th style="width:200px;">Логин</th>
        <th style="width:250px;">ФИО</th>
        <th style="width:250px;">Действия</th>
      </thead>';
$u_footer = '</table>';
if (is_array($users)) {
    echo $u_header;
    foreach ($users as $user) {
        if ($user[2]!=0) $deistv = $ch_pas_i.CHtml::link('Смена пароля', $ch_pas.$user[0]);
        if ($user[2] == 0) $deistv = $usr_edit_i.CHtml::link('Редактировать', $usr_edit.$user[0].'&id_est='.$id_est).' '.$usr_del_i.CHtml::link('Удалить', $usr_del.$user[0].'&id_est='.$id_est, array('confirm'=>'Удалить пользователя "'.$user[0].'". Вы уверены?'));
        echo '<tr><td>'.$user[0].'</td><td>'.$user[1].'</td><td>'.$deistv.'</td></tr>';
    }
    echo $u_footer;
}
if ($user_add == 1) echo '<p style="margin:10px 0;">'.CHtml::image(Yii::app()->request->baseUrl.'images/user-plus.png').CHtml::link('Добавить пользователя', 'index.php?r=user/add&id_est='.$id_est).'</p>';
?>