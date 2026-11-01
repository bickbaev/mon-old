<?php

class Ws25Controller extends Controller
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
            $rep_name = $this->loadRep_name($id_rep_type);
            if(Yii::app()->session['type_adm'] == 0) {
                $rep = Report::model()->find('id_est = :id_est and id_rep_type = :id_rep_type', array(':id_est' => Yii::app()->session['est'], ':id_rep_type' => $id_rep_type));
                $part1 = new CActiveDataProvider('Ws25_part', array(
                    'criteria'=>array(
                        'condition' => 'id_stat = 1 and id_report ='.$rep->id_report,
                        'order' => 'id ASC'
                    ), 
                    'pagination'=>array('pageSize'=>200)
                ));                
                $part2 = new CActiveDataProvider('Ws25_part', array(
                    'criteria'=>array(
                        'condition' => 'id_stat > 3 and id_report ='.$rep->id_report,
                        'order' => 'id ASC'
                    ), 
                    'pagination'=>array('pageSize'=>200)
                ));
                $this->render('index', array(
                    'rep'=> $rep,
                    'est'=> $rep->est,
                    'obsh'=> $this->loadObsh($rep->id_report),
                    'part1'=> $part1,
                    'part2'=> $part2,
                    'rep_name' => $rep_name,
                ));
            }            
            elseif(Yii::app()->session['type_adm'] == 3) {
                //$comp = $this->loadComp($id_comp);
                $comp = Ws25_comp::model()->find('id_rep_type = :id_rep_type', array(':id_rep_type' => $rep_name->id_rep_type));
                if($comp === null) throw new CHttpException(404,'The requested page does not exist.');
                $est = $this->loadEst(Yii::app()->session['est']);
                $typeNames = array(
                    1 => 'ДОУ',
                    2 => 'ООО',
                    3 => 'УДОД',
                    //4 => 'Учреждения начального профессионального образования',
                    5 => 'СПО',
                    6 => 'СКОУ',
                    7 => 'ВПО',
                    //8 => 'Учреждения для детей, нуждающихся в психолого-педагогической и медико-социальной помощи',
                    9 => 'Иные',
                );
                foreach ($typeNames as $type => $item_name) {
                    //$data['id_type'] = $type;
                    $data[$type]['name'] = $item_name;
                    $sql = "SELECT 
                                e.id_est as id_est,
                                e.est_name as est_name,
                                COUNT(w.id) as cnt
                            FROM est e
                            INNER JOIN report r 
                                ON r.id_est = e.id_est 
                               AND r.id_rep_type =  ".$comp->id_rep_type."
                            LEFT JOIN ws25_part w 
                                ON w.id_report = r.id_report
                                AND w.id_stat = 1
                            WHERE e.id_okr = ".$est->id_est."
                              AND e.id_type = ".$type."
                              AND e.type_adm = 0
                            GROUP BY e.id_est, e.est_name
                            ORDER BY e.est_name;";
                    $res = Yii::app()->db->createCommand($sql)->queryAll();
                    $data[$type]['provider'] = new CArrayDataProvider($res, array(
                        'keyField' => 'id_est',
                        'pagination' => array(
                            'pageSize' => 200,
                        ),
                    ));                
                }
                //print_r($data);
                $this->render('index_okr', array(
                    'data' => $data,
                    'comp'=>$comp,
                    'est'=>$est,
                )); 
            }
            else throw new CHttpException(403,'У Вас нет необходимых прав'); 
        }
        
        public function actionView($id)
        {
            $models['contest'] = $this->loadPart($id);
            $models['mentor'] = $models['contest']->load_zav($id, 2);
            $models['accomp'] = $models['contest']->load_zav($id, 3);

            $this->render('view', array(
                'models'=>$models,
            ));
        }
        
        public function actionView2($id)
        {
            $model=$this->loadPart($id);

            $this->render('view2', array(
                'model'=>$model,
            ));
            
        }        
        
        public function actionScandown($id, $type) {
            if(!in_array((int)$type, [1, 2])) throw new CHttpException(404,'The requested file does not exist2.');
            $model = $this->loadPart($id);
            if($type == 1) {
                $file = $model::FILE_PATH.'/'.Report::model()->findByPk($model->id_report)->id_rep_type.'/'.$model->id_report.'/'.$model->sogl;             
                $naim = $model->sogl_r;
            }
            else {
                $file = $model::FILE_PATH.'/'.Report::model()->findByPk($model->id_report)->id_rep_type.'/'.$model->id_report.'/'.$model->exp;
                $naim = $model->exp_r;
            }
            if(file_exists($file)) {
                Yii::app()->request->sendFile($naim, file_get_contents($file));
            }
            else throw new CHttpException(404,'The requested file does not exist.');            
        }
        
        
        public function actionScandown2($id_rep, $id) {
            if(!in_array((int)$id, [6, 7, 8])) throw new CHttpException(404,'The requested file does not exist2.');
            $pok = 'pok'.$id;
            $pokr = 'pok'.$id.'_r';             
            $model = $this->loadObsh($id_rep);
            $file = $model::FILE_PATH.'/'.Report::model()->findByPk($id_rep)->id_rep_type.'/'.$id_rep.'/'.$model->$pok;             
            if(file_exists($file)) {
                Yii::app()->request->sendFile($model->$pokr, file_get_contents($file));
            }
            else throw new CHttpException(404,'The requested file does not exist.');            
        }        
        
        protected function loadEst($id_est)
        {
            $model = Est::model()->findByPk((int)$id_est);
            if($model === null) throw new CHttpException(404,'The requested page does not exist.');
            return $model;
        }            


        protected function loadPart($id)
        {
            $model= Ws25_part::model()->findByPk((int)$id);
            if($model===null) throw new CHttpException(404,'The requested page does not exist.');
            $this->check_prava($model->report->id_report);
            return $model;
        }         
        
        protected function loadRep_name($id_rep_type)
        {
            $model = RepName::model()->findByPk((int)$id_rep_type);
            if($model===null)
                throw new CHttpException(403,'У Вас нет необходимых прав');                          
            return $model;
        }


        protected function loadObsh($id_rep)
        {
            $model= Ws25_obsh::model()->findByPk((int)$id_rep);
            if($model===null) throw new CHttpException(404,'The requested page does not exist.');
            $this->check_prava($model->id_report);
            return $model;
        }
        
        protected function check_prava($id_rep)
        {            
            $reader = Yii::app()->db->createCommand('select report.id_est, report.status, rep_name.rep_name, rep_name.rep_type from report, rep_name where rep_name.archive is null and report.id_rep_type = rep_name.id_rep_type and report.id_report='.$id_rep)->queryRow();            
            if(is_array($reader) && in_array($reader['id_est'], Yii::app()->session['pid'])) { 
                return true;
            }
            else throw new CHttpException(403,'У Вас нет необходимых прав');                 
        }        
        
}        