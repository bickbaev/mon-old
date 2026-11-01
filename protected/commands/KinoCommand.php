<?php
class KinoCommand extends CConsoleCommand {
    public function run($args) {
        $month = date('m');
        //$month = 6;
        if($month > 5 && $month < 9) {die();}
        $prev_rep = Yii::app()->db->createCommand('select max(id_rep_type) from rep_name where rep_type = 70')->queryScalar();
        //Yii::app()->db->createCommand('update rep_name set archive = 1 where id_rep_type = '.$prev_rep)->execute();
        $max_rep = Yii::app()->db->createCommand('select max(id_rep_type) from rep_name')->queryScalar();
        $new_rep = $max_rep + 1;
        Yii::app()->db->createCommand('insert into rep_name set id_rep_type = '.$new_rep.', rep_name = "Киноуроки в школе", rep_mv = "kino2022", s_date = "'.date('Y-m-d', time()).'", f_date = "'.date('Y-m-t').'", date_type = 0, rep_type = 70, zakr = "'.date('Y-m-01', strtotime('+1 month')).'"')->execute();
        $rep_num = Yii::app()->db->createCommand('select max(id_report) from report')->queryScalar();
        $reports = Yii::app()->db->createCommand('select report.id_report, report.id_est from report, est where report.id_rep_type = '.$prev_rep.' and est.id_est = report.id_est and est.status = 1')->queryAll();
        foreach ($reports as $report) {
            $rep_num = $rep_num + 1;                
            Yii::app()->db->createCommand('insert into report set id_rep_type = '.$new_rep.', status = 1, id_report = '.$rep_num.', id_est = '.$report['id_est'])->execute();
            //echo 'insert into report set id_rep_type = '.$new_rep.', status = 1, id_report = '.$rep_num.', id_est = '.$report['id_est'].'<br>';
            $usls = Yii::app()->db->createCommand('select * from kino2022 where id_report = '.$report['id_report'])->queryAll();           
            foreach($usls as $usl) {
                $sql = 'insert into kino2022 set id_report = '.$rep_num;
                for ($i = 1; $i < 7; $i++) {
                    $sql = $sql.', pok'.$i.' = "'.addslashes($usl['pok'.$i]).'"';
                }
                Yii::app()->db->createCommand($sql)->execute();
                //echo $sql.'<br/>';
            }
        }   
        return 0;
    }
}
?>

