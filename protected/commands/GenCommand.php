<?php
class GenCommand extends CConsoleCommand {
    public function run($args) {
        $reports = Yii::app()->db->createCommand('select * from gen where compl is null')->queryAll();
        $year = date('Y');
        $month = date('m');
        //$month = '09';
        foreach($reports as $report) {
            switch($report['type']) {
                case 1:     //разовый                   
                    $report['s_date'] = date('Y-m-d', strtotime($report['chislo'].'.'.$report['mes'].'.'.$report['god']));
                    break;
                case 2:     //еженедельный
                    $s_date = new DateTime(date('Y-m-d', strtotime(date('Y').'W'.date('W').'7'))); //определяем прошедшее воскресенье
                    date_add($s_date, date_interval_create_from_date_string($report['chislo'].' days'));
                    $report['s_date'] = $s_date->format('Y-m-d');
                    break;
                case 3:     //ежемесячный
                    $report['s_date'] = date('Y-m-d', strtotime($report['chislo'].'.'.$month.'.'.$year));
                    break;
                case 4:     //квартальный
                    $kv_mes = floor($month/3)*3 + $report['mes'];
                    $report['s_date'] = date('Y-m-d', strtotime($report['chislo'].'.'.$kv_mes.'.'.$year));
                    break;
                case 5:     //полугодовой
                    if($month > 5) $report['s_date'] = date('Y-m-d', strtotime($report['chislo'].'.'.($report['mes'] + 6).'.'.$year)); //второе полугодие
                    else $report['s_date'] = date('Y-m-d', strtotime($report['chislo'].'.'.$report['mes'].'.'.$year));
                    break;
                case 6:     //годовой
                    $report['s_date'] = date('Y-m-d', strtotime($report['chislo'].'.'.$report['mes'].'.'.$year));
                    break;
            }
            if(date('Y-m-d', time()) != $report['s_date']) continue;
            //if($report['id_gen'] == 1) continue;
            
            
                       
            $id_rep_type = Yii::app()->db->createCommand('select max(id_rep_type) from rep_name')->queryScalar() + 1;

            $f_date = new DateTime($report['s_date']);
            date_add($f_date, date_interval_create_from_date_string($report['prodol'].' days'));
            $report['f_date'] = $f_date->format('Y-m-d');

            $zakr = new DateTime($report['s_date']);
            date_add($zakr, date_interval_create_from_date_string($report['zakr'].' days'));
            $report['z_date'] = $zakr->format('Y-m-d');


            Yii::app()->db->createCommand('insert into rep_name set id_rep_type = '.$id_rep_type.', rep_name = "'.$report['rep_name'].'", rep_mv = "'.$report['rep_mv'].'", s_date = "'.$report['s_date'].'", f_date = "'.$report['f_date'].'", date_type = '.$report['date_type'].', rep_type = '.$report['rep_type'].', zakr = "'.$report['z_date'].'"')->execute();            
            
            $okrs = Yii::app()->db->createCommand('select id_est from est where type_adm = 3 and status = 1')->queryColumn();

            $types = explode('##', $report['id_type']);                
            foreach($types as $type)  {
                //for($m = 2; $m < 15; $m++) {
                foreach($okrs as $m) {
                    $status = $report['status'];
                    $table = $report['rep_mv'];
                    if($type == 'mun') $id_type = '';
                    else $id_type =  'and id_type = '.$type;
                    $reader_est = Yii::app()->db->createCommand('select id_est from est where id_okr = '.$m.' and type_adm = '.$report['type_adm'].' and status = 1 '.$id_type)->queryColumn();
                    $id_report = Yii::app()->db->createCommand('select max(id_report) from report')->queryScalar();
                    for ($i = 0; $i < sizeof($reader_est); $i++) {
                        $id_report = $id_report + 1;
                        Yii::app()->db->createCommand('insert into report set id_report = '.$id_report.', id_rep_type = '.$id_rep_type.', id_est = '.$reader_est[$i].', status = '.$status)->execute();
                        Yii::app()->db->createCommand('insert into '.$table.' set id_report = '.$id_report)->execute();
                    }
                }
            }
        }        
        return 0;
    }
}
?>
