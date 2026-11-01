<?php

class Inf23Controller extends Controller
{
	/**
	 * Declares class-based actions.
	 */
	public function actions()
	{

	}

        public function filters()
        {
            return array(
                'accessControl'
            );
        }

        function filterAccessControl($filterChain)
        {
            if (Yii::app()->user->isGuest)
                    $this->redirect('index.php?r=site/login');
            else
                    $filterChain->run();
        }        
        
	public function actionIndex($id_rep_type)
        {
            $id_rep_type = (int) $_GET['id_rep_type'];
            $otchet = Yii::app()->db->createCommand('select rep_name, DATE_FORMAT(s_date, "%d.%m.%Y") AS s_date, DATE_FORMAT(f_date, "%d.%m.%Y") AS f_date from rep_name where id_rep_type ='.$id_rep_type)->queryRow(); 
            if(!sizeof($otchet)) $this->redirect(Yii::app()->user->returnUrl);
            $this->render('index', array('otchet'=> $otchet, 'id_rep_type'=>$id_rep_type));
        }
        
        public function actionExcel($id_rep_type) {
            if(Yii::app()->session['type_adm'] < 3) $this->redirect(Yii::app()->user->returnUrl);
            $otchet = Yii::app()->db->createCommand('select rep_name, DATE_FORMAT(s_date, "%d.%m.%Y") AS s_date, DATE_FORMAT(f_date, "%d.%m.%Y") AS f_date from rep_name where id_rep_type ='.(int)$id_rep_type)->queryRow();
            $poks = Yii::app()->db->createCommand('select est.id_raion, est.est_name, pok1, pok2, pok3, pok4, pok5, pok6, pok7, pok8 from inf23, report, est where inf23.id_report = report.id_report and report.id_est = est.id_est order by est.id_raion, est.est_name')->queryAll();
            $reader = Yii::app()->db->createCommand('select id_est, est_name from est where type_adm = 2')->queryAll();
            foreach ($reader as $value) {
                $raion[$value['id_est']] = $value['est_name'];
            }            
            /*print_r($poks);
            die();*/
            echo '<table border=1 cellspacing=0 cellpadding=5>';
            foreach($poks as $i=>$pok) {
                echo '<tr>';
                $tip = 0;
                foreach($pok as $k => $pk) {                    
                    if($k == 'pok1' || $k == 'pok2' || $k == 'pok3' || $k == 'est_name') {
                        echo '<td>'.$pk.'</td>';
                        continue;
                    }
                    if($k == 'id_raion') {
                        echo '<td>'.$raion[$pk].'</td>';
                        continue;
                    }                    
                    if($k == 'pok4') {
                        $tip = $pk;
                        continue;
                    }
                    for ($m = 1; $m <= 6; $m++) {
                        if($m == $tip) echo '<td>'.$pk.'</td>';
                        else echo '<td>&nbsp;</td>';
                    }
                }
                echo '</tr>';
            }
            echo '</table>';            
        }        

}        