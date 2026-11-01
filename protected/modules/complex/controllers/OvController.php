<?php

class OvController extends Controller
{
	public function actionEdit($id_rep)
	{
            if ($this->check_prava($id_rep)) {
                    $report = $this->loadModel($id_rep);
                    $report->prov = 1;
                    $report->status = 2;
                    $report->save();
                    $kurs = new CActiveDataProvider('Ov_kurs', array(
                    'criteria'=>array(
                        'condition' => 'id_report ='.$id_rep,
                        'order' => 'id_mer ASC'
                    ), 
                    'pagination'=>array('pageSize'=>200)
                    ));
                    $id_est = Report::model()->findByPk($id_rep)->id_est;
                    $naim_est = Est::model()->findByPk($id_est)->est_name;
                    $info = $this->loadModelInfo($id_rep);                    
                    $this->render('edit', array(
                        'info'=>$info,
                        'kurs'=>$kurs,
                        'naim_est'=>$naim_est,
                        'id_rep'=>$id_rep,
                        'id_est'=>$id_est,
                    )); 
            }
	}
        //все для инфы об учреждении
        public function actionEdit_info($id_rep)
        {
            if ($this->check_prava($id_rep)) {  
                //$id_est = Report::model()->findByPk($id_rep)->id_est;
                $model=$this->loadModelInfo($id_rep);

                // Uncomment the following line if AJAX validation is needed
                // $this->performAjaxValidation($model);

                if(isset($_POST['Ov_otv']))
                {
                    $model->attributes=$_POST['Ov_otv'];
                    if($model->save()) {
                        $this->redirect(array('edit','id_rep'=>$model->id_report));
                    }
                }

                $this->render('edit_info',array(
                    'model'=>$model,
                ));
            }
        }
 
        protected function loadModelInfo($id_rep)
        {
            $model=Ov_otv::model()->findByPk((int)$id_rep);
            if($model===null)
                throw new CHttpException(403,'У Вас нет необходимых прав');                          
            return $model;
        } 
        
        protected function loadModel($id_rep)
        {
            $model=Report::model()->findByPk((int)$id_rep);
            if($model===null)
                throw new CHttpException(403,'У Вас нет необходимых прав');                          
            return $model;
        }        
        
        
        //все для курса

        /**
         * Creates a new model.
         * If creation is successful, the browser will be redirected to the 'view' page.
         */
        public function actionCreate_kurs($id_rep)
        {
            if ($this->check_prava($id_rep)) {                  
                $model=new Ov_kurs;
                
                $model->id_report = $id_rep;

                // Uncomment the following line if AJAX validation is needed
                // $this->performAjaxValidation($model);

                if(isset($_POST['Ov_kurs']))
                {
                    $model->attributes=$_POST['Ov_kurs'];
                    if($model->save())
                        $this->redirect(array('edit','id_rep'=>$model->id_report));
                }

                $this->render('create_kurs',array(
                    'model'=>$model,
                ));
            }
        }

        /**
         * Updates a particular model.
         * If update is successful, the browser will be redirected to the 'view' page.
         * @param integer $id the ID of the model to be updated
         */
        public function actionUpdate_kurs($id_mer)
        {
            $model=$this->loadModelKurs($id_mer);

            // Uncomment the following line if AJAX validation is needed
            // $this->performAjaxValidation($model);
            
            if ($this->check_prava($model->id_report)) {            

                if(isset($_POST['Ov_kurs']))
                {
                    $model->attributes=$_POST['Ov_kurs'];
                    if($model->save()) {
                        $report = $this->loadModel($model->id_report);
                        $report->prov = 1;
                        $report->status = 2;
                        $report->save();
                        $this->redirect(array('edit','id_rep'=>$model->id_report));                    
                    }
                }

                $this->render('update_kurs',array(
                    'model'=>$model,
                ));
            
            }
        }

        /**
         * Deletes a particular model.
         * If deletion is successful, the browser will be redirected to the 'admin' page.
         * @param integer $id the ID of the model to be deleted
         */
        public function actionDelete_kurs($id_mer)
        {
            if(Yii::app()->request->isPostRequest)
            {
                if ($this->check_prava($this->loadModelKurs($id_mer)->id_report)) {                
                    // we only allow deletion via POST request
                    $this->loadModelKurs($id_mer)->delete();

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
        protected function loadModelKurs($id_mer)
        {
            $model=Ov_kurs::model()->findByPk((int)$id_mer);
            if($model===null)
                throw new CHttpException(404,'The requested page does not exist.');
            return $model;
        }
        
        public function actionP_okp() {
            if(Yii::app()->request->isAjaxRequest && isset($_POST['data'])) {
                if($_POST['data'] == '') {
                    echo '';
                    die();
                }
                $id_okpdtr = $_POST['data'];
                echo Okpdtr::model()->findByPk($id_okpdtr)->okpdtr_naim;
            }            
        }      


        protected function check_prava($id_rep)
        {
            $id_rep = (int)$id_rep;
            $command = Yii::app()->db->createCommand('select report.id_est, report.status, rep_name.rep_name, rep_name.rep_type from report, rep_name where rep_name.archive is null and report.id_rep_type = rep_name.id_rep_type and report.id_report='.$id_rep);
            $reader = $command->queryRow();
            if(is_array($reader) && in_array($reader['id_est'], Yii::app()->session['pid'])) { 
                if(Yii::app()->session['type_adm'] == 0 && $reader['status'] > 3) throw new CHttpException(403,'У Вас нет необходимых прав1');
                if(Yii::app()->session['type_adm'] == 3 && $reader['status'] > 4) throw new CHttpException(403,'У Вас нет необходимых прав2');
                return true;
            }
            else throw new CHttpException(403,'У Вас нет необходимых прав3');                 
        } 
        
        protected function edit_report_index($data, $row) {
            return Okpdtr::model()->findByPk($data->id_okpdtr)->okpdtr_naim;
        }         
                 
}
