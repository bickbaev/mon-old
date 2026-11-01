<?php

class Inf23Controller extends Controller
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
                $infs = new CActiveDataProvider('Inf23', array(
                    'criteria'=>array(
                        'condition' => 'id_report ='.$id_rep,
                        'order' => 'id_inf ASC'
                    ), 
                    'pagination'=>array('pageSize'=>200)
                ));
                $report = $this->loadModel($id_rep);
                $report->status = 2;
                $report->save();                
                $this->render('edit', array(
                    'id_rep'=> $id_rep,
                    'naim_est'=>$naim_est,
                    'infs'=>$infs,
                    'id_est'=>$id_est,                 
                ));
            }
        }       

        public function actionCreate($id_rep)
        {
            if($this->check_prava($id_rep)) {
                
                $model = new Inf23;                
                $model->id_report = $id_rep;                              

                // Uncomment the following line if AJAX validation is needed
                // $this->performAjaxValidation($model);

                if(isset($_POST['Inf23']))
                {
                    $model->attributes=$_POST['Inf23'];
                    if($model->save()) $this->redirect(array('edit','id_rep'=>$model->id_report));;
                }

                $this->render('create',array(
                    'model'=>$model,                  
                ));
            }
        }

        public function actionUpdate($id_inf)
        {
            $model=$this->loadInf($id_inf);           

            // Uncomment the following line if AJAX validation is needed
            // $this->performAjaxValidation($model);                      
                
            if(isset($_POST['Inf23']))
            {
                $model->attributes=$_POST['Inf23'];
                if($model->save()) $this->redirect(array('edit','id_rep'=>$model->id_report));;
            }

            $this->render('update',array(
                'model'=>$model,                    
            ));

        }       

        public function actionDelete($id_inf)
        {
            if(Yii::app()->request->isPostRequest)
            {                
                // we only allow deletion via POST request
                $this->loadInf($id_inf)->delete();

                // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
                if(!isset($_GET['ajax']))
                    $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));  
            }
            else
                throw new CHttpException(400,'Invalid request. Please do not repeat this request again.');
        }        
        
        protected function loadInf($id_master)
        {
            $model= Inf23::model()->findByPk((int)$id_master);
            if($model===null) throw new CHttpException(404,'The requested page does not exist.');
            $this->check_prava($model->id_report);
            return $model;
        }

        protected function loadModel($id_rep)
        {
            $model=Report::model()->findByPk((int)$id_rep);
            if($model===null)
                throw new CHttpException(403,'У Вас нет необходимых прав');                          
            return $model;
        }        
        
        protected function check_prava($id_rep)
        {
            $id_rep = (int)$id_rep;
            $reader = Yii::app()->db->createCommand('select report.id_est, report.status from report, rep_name where rep_name.archive is null and report.id_rep_type = rep_name.id_rep_type and report.id_report='.$id_rep)->queryRow();            
            if(is_array($reader) && in_array($reader['id_est'], Yii::app()->session['pid'])) { 
                if(Yii::app()->session['type_adm'] == 3 && $reader['status'] > 3) throw new CHttpException(403,'У Вас нет необходимых прав');
                if(Yii::app()->session['type_adm'] == 1 && $reader['status'] > 4) throw new CHttpException(403,'У Вас нет необходимых прав');
                return true;
            }
            else throw new CHttpException(403,'У Вас нет необходимых прав');                 
        }         

}        
