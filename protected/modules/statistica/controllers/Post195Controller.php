<?php


class Post195Controller extends Controller
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
            if(Yii::app()->session['type_adm'] < 3)
                    $this->redirect('index.php?r=stat/index');
            else
                    $filterChain->run();
        }
        
	public function actionIndex($id_rep_type)
	{
            $otchet = Yii::app()->db->createCommand('select rep_name, DATE_FORMAT(s_date, "%d.%m.%Y") AS s_date, DATE_FORMAT(f_date, "%d.%m.%Y") AS f_date from rep_name where rep_type = 49 and id_rep_type = '.(int)$id_rep_type)->queryAll();            
            if(!sizeof($otchet)) throw new CHttpException(403,'У Вас нет необходимых прав');
            $model = new Post195();
            $labels = $model->attributeLabels();
            $znach = array(2, 8);
            $zstop = array(16, 19, 22);
            for($i = 1; $i < 25; $i++) {
                if(in_array($i, $zstop)) continue;
                if(in_array($i, $znach)) {
                    $res[$i] = Yii::app()->db->createCommand('select est.est_name, post195.pok'.$i.' from est, report, post195 where est.id_est = report.id_est and report.id_report = post195.id_report and post195.pok'.$i.' is not null and report.id_rep_type = '.(int)$id_rep_type)->queryAll();
                }
                else $res[$i] = Yii::app()->db->createCommand('select sum(post195.pok'.$i.') from report, post195 where report.id_report = post195.id_report and report.id_rep_type = '.(int)$id_rep_type)->queryScalar();
            }
            $this->render('index',array(
                'otchet'=>$otchet[0],
                'labels'=>$labels,
                'res'=>$res,
            ));
        }        
        
}   

