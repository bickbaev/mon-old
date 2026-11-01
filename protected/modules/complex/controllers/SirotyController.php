<?php

class SirotyController extends Controller
{
	public function actionEdit($id_rep)
	{
            if ($this->check_prava($id_rep)) { 
                    $npo = new CActiveDataProvider('Siroty_npo', array(
                    'criteria'=>array(
                        'condition' => 'id_report ='.$id_rep,
                        'order' => 'id_npo_sir ASC'
                    ), 
                    'pagination'=>array('pageSize'=>200)
                    ));
                    $spo = new CActiveDataProvider('Siroty_spo', array(
                    'criteria'=>array(
                        'condition' => 'id_report ='.$id_rep,
                        'order' => 'id_spo_sir ASC'
                    ), 
                    'pagination'=>array('pageSize'=>200)
                    )); 
                    $id_est = Report::model()->findByPk($id_rep)->id_est;
                    $naim_est = Est::model()->findByPk($id_est)->est_name;
                    $report = $this->loadModel($id_rep);
                    $report->prov = 1;
                    $report->status = 2;
                    $report->save();                    
                    $this->render('edit', array(
                        'npo'=>$npo,
                        'spo'=>$spo,
                        'naim_est'=>$naim_est,
                        'id_rep'=>$id_rep,
                    )); 
            }
	}
        
        protected function loadModel($id_rep)
        {
            $model=Report::model()->findByPk((int)$id_rep);
            if($model===null)
                throw new CHttpException(403,'У Вас нет необходимых прав');                          
            return $model;
        }        

        
        //все для НПО

        /**
         * Creates a new model.
         * If creation is successful, the browser will be redirected to the 'view' page.
         */
        public function actionCreate_npo($id_rep)
        {
            if ($this->check_prava($id_rep)) {                  
                $model=new Siroty_npo;
                
                $model->id_report = $id_rep;

                // Uncomment the following line if AJAX validation is needed
                // $this->performAjaxValidation($model);

                if(isset($_POST['Siroty_npo']))
                {
                    $model->attributes=$_POST['Siroty_npo'];
                    if($model->save())
                        $this->redirect(array('edit','id_rep'=>$model->id_report));
                }

                $this->render('create_npo',array(
                    'model'=>$model,
                ));
            }
        }

        /**
         * Updates a particular model.
         * If update is successful, the browser will be redirected to the 'view' page.
         * @param integer $id the ID of the model to be updated
         */
        public function actionUpdate_npo($id_npo_sir)
        {
            $model=$this->loadModelNpo($id_npo_sir);

            // Uncomment the following line if AJAX validation is needed
            // $this->performAjaxValidation($model);
            
            if ($this->check_prava($model->id_report)) {            

                if(isset($_POST['Siroty_npo']))
                {
                    $model->attributes=$_POST['Siroty_npo'];
                    if($model->save())
                        $this->redirect(array('edit','id_rep'=>$model->id_report));
                }

                $this->render('update_npo',array(
                    'model'=>$model,
                ));
            
            }
        }

        /**
         * Deletes a particular model.
         * If deletion is successful, the browser will be redirected to the 'admin' page.
         * @param integer $id the ID of the model to be deleted
         */
        public function actionDelete_npo($id_npo_sir)
        {
            if(Yii::app()->request->isPostRequest)
            {
                if ($this->check_prava($this->loadModelNpo($id_npo_sir)->id_report)) {                
                    // we only allow deletion via POST request
                    $this->loadModelNpo($id_npo_sir)->delete();

                    // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
                    if(!isset($_GET['ajax']))
                        $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
                }   
            }
            else
                throw new CHttpException(400,'Invalid request. Please do not repeat this request again.');
        }

        /**
         * Returns the data model based on the primary key given in the GET variable.
         * If the data model is not found, an HTTP exception will be raised.
         * @param integer the ID of the model to be loaded
         */
        protected function loadModelNpo($id_npo_sir)
        {
            $model=Siroty_npo::model()->findByPk((int)$id_npo_sir);
            if($model===null)
                throw new CHttpException(404,'The requested page does not exist.');
            return $model;
        }
        
        public function actionP_npo() {
            if(Yii::app()->request->isAjaxRequest && isset($_POST['data'])) {
                if($_POST['data'] == '') {
                    echo '';
                    die();
                }
                $id_npo = $_POST['data'];
                echo Npo::model()->findByPk($id_npo)->naim_npo;
            }            
        } 
        
        
        //все для CПО

        /**
         * Creates a new model.
         * If creation is successful, the browser will be redirected to the 'view' page.
         */
        public function actionCreate_spo($id_rep)
        {
            if ($this->check_prava($id_rep)) {                  
                $model=new Siroty_spo;
                
                $model->id_report = $id_rep;

                // Uncomment the following line if AJAX validation is needed
                // $this->performAjaxValidation($model);

                if(isset($_POST['Siroty_spo']))
                {
                    $model->attributes=$_POST['Siroty_spo'];
                    if($model->save())
                        $this->redirect(array('edit','id_rep'=>$model->id_report));
                }

                $this->render('create_spo',array(
                    'model'=>$model,
                ));
            }
        }

        /**
         * Updates a particular model.
         * If update is successful, the browser will be redirected to the 'view' page.
         * @param integer $id the ID of the model to be updated
         */
        public function actionUpdate_spo($id_spo_sir)
        {
            $model=$this->loadModelSpo($id_spo_sir);

            // Uncomment the following line if AJAX validation is needed
            // $this->performAjaxValidation($model);
            
            if ($this->check_prava($model->id_report)) {            

                if(isset($_POST['Siroty_spo']))
                {
                    $model->attributes=$_POST['Siroty_spo'];
                    if($model->save())
                        $this->redirect(array('edit','id_rep'=>$model->id_report));
                }

                $this->render('update_spo',array(
                    'model'=>$model,
                ));
            
            }
        }

        /**
         * Deletes a particular model.
         * If deletion is successful, the browser will be redirected to the 'admin' page.
         * @param integer $id the ID of the model to be deleted
         */
        public function actionDelete_spo($id_spo_sir)
        {
            if(Yii::app()->request->isPostRequest)
            {
                if ($this->check_prava($this->loadModelSpo($id_spo_sir)->id_report)) {                
                    // we only allow deletion via POST request
                    $this->loadModelSpo($id_spo_sir)->delete();

                    // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
                    if(!isset($_GET['ajax']))
                        $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
                }   
            }
            else
                throw new CHttpException(400,'Invalid request. Please do not repeat this request again.');
        }

        /**
         * Returns the data model based on the primary key given in the GET variable.
         * If the data model is not found, an HTTP exception will be raised.
         * @param integer the ID of the model to be loaded
         */
        protected function loadModelSpo($id_spo_sir)
        {
            $model=Siroty_spo::model()->findByPk((int)$id_spo_sir);
            if($model===null)
                throw new CHttpException(404,'The requested page does not exist.');
            return $model;
        }
        
        public function actionP_spo() {
            if(Yii::app()->request->isAjaxRequest && isset($_POST['data'])) {
                if($_POST['data'] == '') {
                    echo '';
                    die();
                }
                $id_spo = $_POST['data'];
                echo Spo::model()->findByPk($id_spo)->naim_spo;
            }            
        }         
       


        protected function check_prava($id_rep)
        {
            $id_rep = (int)$id_rep;
            $command = Yii::app()->db->createCommand('select report.id_est, report.status, rep_name.rep_name, rep_name.rep_type from report, rep_name where rep_name.archive is null and report.id_rep_type = rep_name.id_rep_type and report.id_report='.$id_rep);
            $reader = $command->queryRow();
            if(is_array($reader) && in_array($reader['id_est'], Yii::app()->session['pid'])) { 
                if(Yii::app()->session['type_adm'] == 0 && $reader['status'] > 3) throw new CHttpException(403,'У Вас нет необходимых прав');
                if(Yii::app()->session['type_adm'] == 3 && $reader['status'] > 4) throw new CHttpException(403,'У Вас нет необходимых прав');
                return true;
            }
            else throw new CHttpException(403,'У Вас нет необходимых прав');                 
        }        
                 
}
