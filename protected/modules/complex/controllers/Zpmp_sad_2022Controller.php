<?php

class Zpmp_sad_2022Controller extends Controller
{
    
        public function filters()
        {
            return array(
                'accessControl'
            );
        }

        function filterAccessControl($filterChain)
        {
            if (Yii::app()->user->isGuest) $this->redirect('index.php?r=site/login');
            elseif(Yii::app()->session['stat_only']) $this->redirect('index.php?r=stat/index');
            else $filterChain->run();
        }
        
	public function actionEdit($id_rep)
	{
            if ($this->check_prava($id_rep)) {                 
                $naim_est = Report::model()->findByPk($id_rep)->est->est_name;
                $id_est = Report::model()->findByPk($id_rep)->est->id_est;
                $zps = new CActiveDataProvider('Zpmp_sad_2022', array(
                    'criteria'=>array(
                        'condition' => 'id_report ='.$id_rep,
                        'order' => 'id_zpmp ASC'
                    ), 
                    'pagination'=>array('pageSize'=>200)
                ));
                $report = $this->loadModel($id_rep);
                if($report->status == 1) {
                    $report->status = 2;
                    $report->save(); 
                }
                $this->render('edit', array(
                    'id_rep'=> $id_rep,
                    'naim_est'=>$naim_est,
                    'zps'=>$zps,
                    'id_est'=>$id_est,                  
                ));
            }
        }
        
        public function actionCreate($id_rep)
        {
            if($this->check_prava($id_rep)) {                  
                $model = new Zpmp_sad_2022;
                
                $model->id_report = $id_rep;                              

                // Uncomment the following line if AJAX validation is needed
                // $this->performAjaxValidation($model);

                if(isset($_POST['Zpmp_sad_2022']))
                {
                    $model->attributes=$_POST['Zpmp_sad_2022'];
                    if($model->save()) $this->redirect(array('edit','id_rep'=>$model->id_report));;
                }

                $this->render('create',array(
                    'model'=>$model,                  
                ));
            }
        }

        public function actionUpdate($id_zpmp)
        {
            $model=$this->loadZp($id_zpmp);           

            // Uncomment the following line if AJAX validation is needed
            // $this->performAjaxValidation($model);                      
                
            if(isset($_POST['Zpmp_sad_2022']))
            {
                $model->attributes=$_POST['Zpmp_sad_2022'];
                if($model->save()) $this->redirect(array('edit','id_rep'=>$model->id_report));;
            }

            $this->render('update',array(
                'model'=>$model,                    
            ));

        }       

        public function actionDelete($id_zpmp)
        {
            if(Yii::app()->request->isPostRequest)
            {                
                // we only allow deletion via POST request
                $this->loadZp($id_zpmp)->delete();

                // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
                if(!isset($_GET['ajax']))
                    $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));  
            }
            else
                throw new CHttpException(400,'Invalid request. Please do not repeat this request again.');
        }

        public function actionPdf($id_zpmp) {
                //require_once '/var/www/cposo/data/www/mon.cposo.ru/protected/vendor/autoload.php';
                //$mPDF1 = new \Mpdf\Mpdf();
                include("/var/www/cposo/data/www/mon.cposo.ru/protected/vendors/mpdf574/mpdf.php");

                $mPDF1=new mPDF();
                
                $model = $this->loadZp_pdf($id_zpmp);                                      

                $mPDF1->WriteHTML($this->renderPartial('pdf', array(
                    'model'=>$model,                    
                ), true));                

                $mPDF1->Output();                                
        }
        

        protected function loadZp_pdf($id_zpmp)
        {
            $model= Zpmp_sad_2022::model()->findByPk((int)$id_zpmp);
            if($model === null) throw new CHttpException(404,'The requested page does not exist.');
            $this->check_prava($model->id_report);
            return $model;
        }        
        
        protected function loadZp($id_zpmp)
        {
            $model= Zpmp_sad_2022::model()->findByPk((int)$id_zpmp);
            if($model === null) throw new CHttpException(404,'The requested page does not exist.');
            $this->check_prava($model->id_report);
            if($model->pok15 > 0) throw new CHttpException(403,'У Вас нет необходимых прав');
            return $model;
        }        

        protected function loadModel($id_rep)
        {
            $model = Report::model()->findByPk((int)$id_rep);
            if($model === null)
                throw new CHttpException(403,'У Вас нет необходимых прав');                          
            return $model;
        }        
        
        protected function check_prava($id_rep)
        {
            $id_rep = (int)$id_rep;
            $reader = Yii::app()->db->createCommand('select report.id_est, report.status from report, rep_name where rep_name.archive is null and report.id_rep_type = rep_name.id_rep_type and report.id_report='.$id_rep)->queryRow();
            if(is_array($reader)) {
                if($reader['id_est'] == Yii::app()->session['est']) return true;
                elseif(Yii::app()->session['id'] == 'bickbaev') return true;
                else throw new CHttpException(403,'У Вас нет необходимых прав');
            }
            else throw new CHttpException(403,'У Вас нет необходимых прав');                
        }
        
        public function block() {
            return true;
        }
        
        public function block_data() {
            $data = '18-00 27 Октября 2022 г.';
            return $data;
        }        

}         
