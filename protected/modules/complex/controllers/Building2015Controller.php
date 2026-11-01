<?php

class Building2015Controller extends Controller
{
	public function actionEdit($id_rep)
	{
            if ($this->check_prava($id_rep)) {
                    $buildings = new CActiveDataProvider('Building2015', array(
                        'criteria'=>array(
                            'condition' => 'id_report ='.$id_rep,
                            'order' => 'id_building ASC'
                        ), 
                        'pagination'=>array('pageSize'=>200)
                        )
                    );                     
                    $id_est = Report::model()->findByPk($id_rep)->id_est;
                    $naim_est = Est::model()->findByPk($id_est)->est_name;
                    $this->render('edit', array(
                        'buildings'=>$buildings,
                        'naim_est'=>$naim_est,
                        'id_rep'=>$id_rep,
                    )); 
            }
	}
        
        public function actionCreate($id_rep)
        {
            if ($this->check_prava($id_rep)) {  
                
                $model=new Building2015;
                
                $model->id_report = $id_rep;

                // Uncomment the following line if AJAX validation is needed
                // $this->performAjaxValidation($model);

                if(isset($_POST['Building2015']))
                {
                    $model->attributes=$_POST['Building2015'];
                    if($model->save()) {
                        $report = $this->loadReport($model->id_report);
                        $report->prov = 1;
                        $report->status = 2;
                        $report->save();                        
                        $this->redirect(array('edit','id_rep'=>$model->id_report));
                    }
                }

                $this->render('create',array(
                    'model'=>$model,
                ));
            }
        }

        /**
         * Updates a particular model.
         * If update is successful, the browser will be redirected to the 'view' page.
         * @param integer $id the ID of the model to be updated
         */
        public function actionUpdate($id_building)
        {
            $model=$this->loadModel($id_building);

            // Uncomment the following line if AJAX validation is needed
            // $this->performAjaxValidation($model);
            
            if ($this->check_prava($model->id_report)) {            

                if(isset($_POST['Building2015']))
                {
                    $model->attributes=$_POST['Building2015'];
                    if($model->save()) {
                        $this->redirect(array('edit','id_rep'=>$model->id_report));                    
                    }
                }

                $this->render('update',array(
                    'model'=>$model,
                ));
            
            }
        }

        /**
         * Deletes a particular model.
         * If deletion is successful, the browser will be redirected to the 'admin' page.
         * @param integer $id the ID of the model to be deleted
         */
        public function actionDelete($id_building)
        {
            if(Yii::app()->request->isPostRequest)
            {
                if ($this->check_prava($this->loadModel($id_building)->id_report)) {                
                    // we only allow deletion via POST request
                    $this->loadModel($id_building)->delete();

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
        protected function loadModel($id_building)
        {
            $model = Building2015::model()->findByPk((int)$id_building);
            if($model===null)
                throw new CHttpException(404,'The requested page does not exist.');
            return $model;
        }
        
        protected function loadReport($id_rep)
        {
            $model=Report::model()->findByPk((int)$id_rep);
            if($model===null)
                throw new CHttpException(403,'У Вас нет необходимых прав');                          
            return $model;
        }         
        
        public function address($data) {
            if($data->litera) $korpus = ', корпус '.$data->litera;
            return Contact_gor::model()->findByPk($data->nas_punkt_type)->naim_gor.' '.$data->nas_punkt.', '.Contact_ul::model()->findByPk($data->street_type)->naim_ul.' '.$data->street.', дом №'.$data->dom.$korpus;
        }

        protected function check_prava($id_rep)
        {
            $id_rep = (int)$id_rep;
            $command = Yii::app()->db->createCommand('select report.id_est, report.status, rep_name.rep_name, rep_name.rep_type from report, rep_name where rep_name.archive is null and report.id_rep_type = rep_name.id_rep_type and report.id_report='.$id_rep);
            $reader = $command->queryRow();
            if(Yii::app()->session['type_adm'] == 4) return true;
            if(is_array($reader) && in_array($reader['id_est'], Yii::app()->session['pid'])) { 
                if(Yii::app()->session['type_adm'] == 0 && $reader['status'] > 3) throw new CHttpException(403,'У Вас нет необходимых прав');
                if(Yii::app()->session['type_adm'] == 3 && $reader['status'] > 4) throw new CHttpException(403,'У Вас нет необходимых прав');
                return true;
            }
            else throw new CHttpException(403,'У Вас нет необходимых прав');                 
        }          
}        

