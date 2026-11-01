<?php

class Karta_outController extends Controller
{
	public function actionEdit($id_rep)
	{
            if ($this->check_prava($id_rep)) {
                    $report = Report::model()->findByPk((int)$id_rep);
                    $report->prov = 1;
                    $report->status = 2;
                    $report->save();                    
                    $npo = new CActiveDataProvider('Karta_out_npo', array(
                    'criteria'=>array(
                        'condition' => 'id_report ='.$id_rep,
                        'order' => 'id_npo_out ASC'
                    ), 
                    'pagination'=>array('pageSize'=>200)
                    ));
                    $spo = new CActiveDataProvider('Karta_out_spo', array(
                    'criteria'=>array(
                        'condition' => 'id_report ='.$id_rep,
                        'order' => 'id_spo_out ASC'
                    ), 
                    'pagination'=>array('pageSize'=>200)
                    ));
                    $po = new CActiveDataProvider('Karta_out_po', array(
                    'criteria'=>array(
                        'condition' => 'id_report ='.$id_rep,
                        'order' => 'id_po_out ASC'
                    ), 
                    'pagination'=>array('pageSize'=>200)
                    ));                    
                    $id_est = Report::model()->findByPk($id_rep)->id_est;
                    $naim_est = Est::model()->findByPk($id_est)->est_name;
                    $year1 = $this->year1($id_rep);
                    //$year1 = 2015;
                    $this->render('edit', array(
                        'npo'=>$npo,
                        'spo'=>$spo,
                        'po'=>$po,
                        'naim_est'=>$naim_est,
                        'id_rep'=>$id_rep,
                        'year1'=>$year1,                        
                    )); 
            }
	} 
        
        //все для НПО

        /**
         * Creates a new model.
         * If creation is successful, the browser will be redirected to the 'view' page.
         */
        public function actionCreate_npo($id_rep)
        {
            if ($this->check_prava($id_rep)) {                  
                $model=new Karta_out_npo;
                
                $model->id_report = $id_rep;
                
                $year1 = $this->year1($id_rep);

                // Uncomment the following line if AJAX validation is needed
                // $this->performAjaxValidation($model);

                if(isset($_POST['Karta_out_npo']))
                {
                    $model->attributes=$_POST['Karta_out_npo'];
                    if($model->save())
                        $this->redirect(array('edit','id_rep'=>$model->id_report));
                }

                $this->render('create_npo',array(
                    'model'=>$model,
                    'year1'=>$year1,
                ));
            }
        }

        /**
         * Updates a particular model.
         * If update is successful, the browser will be redirected to the 'view' page.
         * @param integer $id the ID of the model to be updated
         */
        public function actionUpdate_npo($id_npo_out)
        {
            $model=$this->loadModelNpo($id_npo_out);
            
            $year1 = $this->year1($id_rep);

            // Uncomment the following line if AJAX validation is needed
            // $this->performAjaxValidation($model);
            
            if ($this->check_prava($model->id_report)) {            

                if(isset($_POST['Karta_out_npo']))
                {
                    $model->attributes=$_POST['Karta_out_npo'];
                    if($model->save())
                        $this->redirect(array('edit','id_rep'=>$model->id_report));
                }

                $this->render('update_npo',array(
                    'model'=>$model,
                    'year1'=>$year1,                    
                ));
            
            }
        }

        /**
         * Deletes a particular model.
         * If deletion is successful, the browser will be redirected to the 'admin' page.
         * @param integer $id the ID of the model to be deleted
         */
        public function actionDelete_npo($id_npo_out)
        {
            if(Yii::app()->request->isPostRequest)
            {
                if ($this->check_prava($this->loadModelNpo($id_npo_out)->id_report)) {                
                    // we only allow deletion via POST request
                    $this->loadModelNpo($id_npo_out)->delete();

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
        protected function loadModelNpo($id_npo_out)
        {
            $model=Karta_out_npo::model()->findByPk((int)$id_npo_out);
            if($model===null)
                throw new CHttpException(404,'The requested page does not exist.');
            return $model;
        } 
        
        public function actionCreate_spo($id_rep)
        {
            if ($this->check_prava($id_rep)) {                  
                $model=new Karta_out_spo;
                
                $model->id_report = $id_rep;
                
                $year1 = $this->year1($id_rep);                

                // Uncomment the following line if AJAX validation is needed
                // $this->performAjaxValidation($model);

                if(isset($_POST['Karta_out_spo']))
                {
                    $model->attributes=$_POST['Karta_out_spo'];
                    if($model->save())
                        $this->redirect(array('edit','id_rep'=>$model->id_report));
                }

                $this->render('create_spo',array(
                    'model'=>$model,
                    'year1'=>$year1,                     
                ));
            }
        }

        /**
         * Updates a particular model.
         * If update is successful, the browser will be redirected to the 'view' page.
         * @param integer $id the ID of the model to be updated
         */
        public function actionUpdate_spo($id_spo_out)
        {
            $model=$this->loadModelSpo($id_spo_out);

            // Uncomment the following line if AJAX validation is needed
            // $this->performAjaxValidation($model);
            
            if ($this->check_prava($model->id_report)) {            

                $year1 = $this->year1($model->id_report);                
                
                if(isset($_POST['Karta_out_spo']))
                {
                    $model->attributes=$_POST['Karta_out_spo'];
                    if($model->save())
                        $this->redirect(array('edit','id_rep'=>$model->id_report));
                }

                $this->render('update_spo',array(
                    'model'=>$model,
                    'year1'=>$year1,                     
                ));
            
            }
        }

        /**
         * Deletes a particular model.
         * If deletion is successful, the browser will be redirected to the 'admin' page.
         * @param integer $id the ID of the model to be deleted
         */
        public function actionDelete_spo($id_spo_out)
        {
            if(Yii::app()->request->isPostRequest)
            {
                if ($this->check_prava($this->loadModelSpo($id_spo_out)->id_report)) {                
                    // we only allow deletion via POST request
                    $this->loadModelSpo($id_spo_out)->delete();

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
        protected function loadModelSpo($id_spo_out)
        {
            $model=Karta_out_spo::model()->findByPk((int)$id_spo_out);
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
        
        protected function prof_spo($data) {
            $prof = Spo::model()->findByPk($data->id_spo)->naim_spo;
            return '<strong>'.$prof.' ('.$data->id_spo.')</strong>';
        }         
        
        protected function prof_npo($data) {
            $prof = Npo::model()->findByPk($data->id_npo)->naim_npo;
            return '<strong>'.$prof.' ('.$data->id_npo.')</strong>';
        }
        
        public function actionCreate_po($id_rep)
        {
            if ($this->check_prava($id_rep)) {                  
                $model=new Karta_out_po;
                
                $model->id_report = $id_rep;
                
                $year1 = $this->year1($id_rep);                

                // Uncomment the following line if AJAX validation is needed
                // $this->performAjaxValidation($model);

                if(isset($_POST['Karta_out_po']))
                {
                    $model->attributes=$_POST['Karta_out_po'];
                    if($model->save())
                        $this->redirect(array('edit','id_rep'=>$model->id_report));
                }

                $this->render('create_po',array(
                    'model'=>$model,
                    'year1'=>$year1,                     
                ));
            }
        }

        /**
         * Updates a particular model.
         * If update is successful, the browser will be redirected to the 'view' page.
         * @param integer $id the ID of the model to be updated
         */
        public function actionUpdate_po($id_po_out)
        {
            $model=$this->loadModelPo($id_po_out);

            // Uncomment the following line if AJAX validation is needed
            // $this->performAjaxValidation($model);
            
            if ($this->check_prava($model->id_report)) {            

                $year1 = $this->year1($model->id_report);                
                
                if(isset($_POST['Karta_out_po']))
                {
                    $model->attributes=$_POST['Karta_out_po'];
                    if($model->save())
                        $this->redirect(array('edit','id_rep'=>$model->id_report));
                }

                $this->render('update_po',array(
                    'model'=>$model,
                    'year1'=>$year1,                     
                ));
            
            }
        }

        /**
         * Deletes a particular model.
         * If deletion is successful, the browser will be redirected to the 'admin' page.
         * @param integer $id the ID of the model to be deleted
         */
        public function actionDelete_po($id_po_out)
        {
            if(Yii::app()->request->isPostRequest)
            {
                if ($this->check_prava($this->loadModelPo($id_po_out)->id_report)) {                
                    // we only allow deletion via POST request
                    $this->loadModelPo($id_po_out)->delete();

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
        protected function loadModelPo($id_po_out)
        {
            $model=Karta_out_po::model()->findByPk((int)$id_po_out);
            if($model===null)
                throw new CHttpException(404,'The requested page does not exist.');
            return $model;
        } 
        
        protected function prof_po($data) {
            $prof = Po_new::model()->findByPk($data->id_po)->naim_po;
            return '<strong>'.$prof.' ('.$data->id_po.')</strong>';
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
        
        protected function year1($id_rep) {
            /*$id_rep_type = Report::model()->findByPk($id_rep)->id_rep_type;
            $s_date = RepName::model()->findByPk($id_rep_type)->s_date;
            return date('Y', strtotime($s_date));*/ 
            return 2016;
        }
}