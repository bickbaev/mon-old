<?php

class Placement_specController extends Controller
{
	public function actionEdit($id_rep)
	{
            if ($this->check_prava($id_rep)) {
                    $report = Report::model()->findByPk((int)$id_rep);
                    $report->prov = 1;
                    $report->status = 2;
                    $report->save();                    
                    $po = new CActiveDataProvider('Placement_spec', array(
                    'criteria'=>array(
                        'condition' => 'id_report ='.$id_rep,
                        'order' => 'id_spec ASC'
                    ), 
                    'pagination'=>array('pageSize'=>200)
                    ));                    
                    $id_est = Report::model()->findByPk($id_rep)->id_est;
                    $naim_est = Est::model()->findByPk($id_est)->est_name;
                    $this->render('edit', array(
                        'po'=>$po,
                        'naim_est'=>$naim_est,
                        'id_rep'=>$id_rep,                  
                    )); 
            }
	}
        
        public function actionCreate_po($id_rep)
        {
            if ($this->check_prava($id_rep)) {                  
                $model=new Placement_spec;
                
                $model->id_report = $id_rep;                              

                // Uncomment the following line if AJAX validation is needed
                // $this->performAjaxValidation($model);

                if(isset($_POST['Placement_spec']))
                {
                    $model->attributes=$_POST['Placement_spec'];
                    if($model->save())
                        $this->redirect(array('edit_po','id_spec'=>$model->id_spec));
                }

                $this->render('create_po',array(
                    'model'=>$model,                  
                ));
            }
        }

        /**
         * Updates a particular model.
         * If update is successful, the browser will be redirected to the 'view' page.
         * @param integer $id the ID of the model to be updated
         */
        public function actionEdit_po($id_spec)
        {
            $model=$this->loadModelPo($id_spec);
            
            $org = new CActiveDataProvider('Placement_org', array(
            'criteria'=>array(
                'condition' => 'id_spec ='.$id_spec,
                'order' => 'id_org ASC'
            ), 
            'pagination'=>array('pageSize'=>200)
            ));            

            // Uncomment the following line if AJAX validation is needed
            // $this->performAjaxValidation($model);
            
            if ($this->check_prava($model->id_report)) {                          

                $this->render('edit_po',array(
                    'model'=>$model,
                    'org'=>$org,
                ));
            
            }
        }
        
        public function actionUpdate_po($id_spec)
        {
            $model=$this->loadModelPo($id_spec);           

            // Uncomment the following line if AJAX validation is needed
            // $this->performAjaxValidation($model);
            
            if ($this->check_prava($model->id_report)) {                          
                
                if(isset($_POST['Placement_spec']))
                {
                    $model->attributes=$_POST['Placement_spec'];
                    if($model->save())
                        $this->redirect(array('edit_po','id_spec'=>$model->id_spec));
                }

                $this->render('update_po',array(
                    'model'=>$model,                    
                ));
            
            }
        }        

        /**
         * Deletes a particular model.
         * If deletion is successful, the browser will be redirected to the 'admin' page.
         * @param integer $id the ID of the model to be deleted
         */
        public function actionDelete_po($id_spec)
        {
            if(Yii::app()->request->isPostRequest)
            {
                if(Yii::app()->db->createCommand('select count(id_org) from placement_org where id_spec = '.$id_spec)->queryScalar()) throw new CHttpException(405,'Перед удаление профессии/специальности удалите все места трудоустройства');
                if ($this->check_prava($this->loadModelPo($id_spec)->id_report)) {                
                    // we only allow deletion via POST request
                    $this->loadModelPo($id_spec)->delete();

                    // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
                    if(!isset($_GET['ajax']))
                        $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
                }   
            }
            else
                throw new CHttpException(400,'Invalid request. Please do not repeat this request again.');
        }        
        
        protected function loadModelPo($id_spec)
        {
            $model=Placement_spec::model()->findByPk((int)$id_spec);
            if($model===null)
                throw new CHttpException(404,'The requested page does not exist.');
            return $model;
        } 
        
        protected function prof_po($data) {
            $prof = Po_new::model()->findByPk($data->id_po)->naim_po;
            return '<strong>'.$prof.' ('.$data->id_po.')</strong>';
        }
        
        protected function place_all($data) {
            return Yii::app()->db->createCommand('select sum(p_out) from placement_org where id_spec = '.$data->id_spec)->queryScalar();
        }
        
        protected function place_pred($data) {
            return Yii::app()->db->createCommand('select count(id_org) from placement_org where id_spec = '.$data->id_spec)->queryScalar();
        }        

        public function actionCreate_org($id_spec)
        {
            $spec = $this->loadModelPo($id_spec);
            if ($this->check_prava($spec->id_report)) {                  
                $model=new Placement_org;
                
                $model->id_spec = $id_spec;                               

                // Uncomment the following line if AJAX validation is needed
                // $this->performAjaxValidation($model);

                if(isset($_POST['Placement_org']))
                {
                    $model->attributes=$_POST['Placement_org'];
                    if($model->save())
                        $this->redirect(array('edit_po','id_spec'=>$model->id_spec));
                }

                $this->render('create_org',array(
                    'model'=>$model,                    
                ));
            }
        }

        /**
         * Updates a particular model.
         * If update is successful, the browser will be redirected to the 'view' page.
         * @param integer $id the ID of the model to be updated
         */
        public function actionUpdate_org($id_org)
        {
            $model=$this->loadModelOrg($id_org);
            $spec = $this->loadModelPo($model->id_spec);
            // Uncomment the following line if AJAX validation is needed
            // $this->performAjaxValidation($model);
            
            if ($this->check_prava($spec->id_report)) {                         
                
                if(isset($_POST['Placement_org']))
                {
                    $model->attributes=$_POST['Placement_org'];
                    if($model->save())
                        $this->redirect(array('edit_po','id_spec'=>$model->id_spec));
                }

                $this->render('update_org',array(
                    'model'=>$model,                     
                ));
            
            }
        }

        /**
         * Deletes a particular model.
         * If deletion is successful, the browser will be redirected to the 'admin' page.
         * @param integer $id the ID of the model to be deleted
         */
        public function actionDelete_org($id_org)
        {
            if(Yii::app()->request->isPostRequest)
            {
                $spec = $this->loadModelPo($this->loadModelOrg($id_org)->id_spec);
                if ($this->check_prava($spec->id_report)) {                
                    // we only allow deletion via POST request
                    $this->loadModelOrg($id_org)->delete();

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
        protected function loadModelOrg($id_org)
        {
            $model = Placement_org::model()->findByPk((int)$id_org);
            if($model===null)
                throw new CHttpException(404,'The requested page does not exist.');
            return $model;
        } 
        
        public function est($data) {
            $rab = array(
                '1' => 'АО "РКЦ "Прогресс"', 
                '2' => 'ОАО "Кузнецов"', 
                '3' => 'ОАО "Салют"',
                '4' => 'ОАО "Авиакор – авиационный завод"',
                '5' => 'ОАО "Агрегат"',
                '6' => 'ОАО "АвтоВАЗ"',
                '7' => 'другой работодатель (поле ниже)',
            );            
            if($data->id_est == 7) return $data->est;
            else return $rab[$data->id_est];
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
