<?php
class ZakrCommand extends CConsoleCommand {
    public function run($args) {
        $command = Yii::app()->db->createCommand('select id_rep_type from rep_name where zakr="'.date('Y-m-d', time()).'"');
        $reports = $command->queryColumn(); 
        foreach($reports as $report) {
               $command = Yii::app()->db->createCommand('update rep_name set archive = 1 where id_rep_type = '.$report);
               $command->execute();
        }
        $ress = Yii::app()->db->createCommand('SELECT id_sess, data_s FROM testprof2 where konec is null')->queryAll(); 
        foreach($ress as $res) {
            if((strtotime('now') - strtotime($res['data_s'])) > 86400) {
                Yii::app()->db->createCommand('delete from testprof2 where id_sess = "'.$res['id_sess'].'"')->execute(); 
            }
        }         
        return 0;
    }
}
?>