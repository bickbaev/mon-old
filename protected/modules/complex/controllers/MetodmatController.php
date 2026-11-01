<?php

class MetodmatController extends Controller
{
	public function actionEdit($id_rep)
	{
            if ($this->check_prava($id_rep)) {
                $metodmat = new CActiveDataProvider('Metodmat', array(
                    'criteria'=>array(
                        'condition' => 'id_report ='.$id_rep,
                        'order' => 'id_metodmat ASC'
                    ), 
                    'pagination'=>array('pageSize'=>200)
                ));                                
                $report = Report::model()->findByPk($id_rep);
                $id_est = $report->id_est;
                $naim_est = Est::model()->findByPk($id_est)->est_name;
                $report->prov = 1;
                $report->status = 2;
                $report->save();
                $this->render('edit', array(
                    'metodmat'=>$metodmat,
                    'naim_est'=>$naim_est,
                    'id_rep'=>$id_rep,
                )); 
            }
	}
        
        public function actionCreate($id_rep)
        {
            if ($this->check_prava($id_rep)) {                  
                $model=new Metodmat;
                
                $model->id_report = $id_rep;

                // Uncomment the following line if AJAX validation is needed
                // $this->performAjaxValidation($model);

                if(isset($_POST['Metodmat']))
                {
                    $model->attributes=$_POST['Metodmat'];
                    if($model->save())
                        $this->redirect(array('edit','id_rep'=>$model->id_report));
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
        public function actionUpdate($id_metodmat)
        {
            $model=$this->loadModel($id_metodmat);

            // Uncomment the following line if AJAX validation is needed
            // $this->performAjaxValidation($model);
            
            if ($this->check_prava($model->id_report)) {            

                if(isset($_POST['Metodmat']))
                {
                    $model->attributes=$_POST['Metodmat'];
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
        public function actionDelete($id_metodmat)
        {
            if(Yii::app()->request->isPostRequest)
            {
                if ($this->check_prava($this->loadModel($id_metodmat)->id_report)) {                
                    // we only allow deletion via POST request
                    $this->loadModel($id_metodmat)->delete();

                    // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
                    if(!isset($_GET['ajax']))
                        $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
                }   
            }
            else
                throw new CHttpException(400,'Invalid request. Please do not repeat this request again.');
        }         
        
        protected function izdat($data) {
            if($data->god) $god = $data->god.' г.<br />';
            return $data->mesto.',<br />'.$data->izdat.',<br />'.$god.$data->isbn.'<br />';
        }
        
        protected function prof($data) {
            $mes = '';
            if($data->id_npo) $mes = 'НПО - '.$data->id_npo;
            if($data->id_spo) $mes = $mes.'<br />СПО - '.$data->id_spo;
            return $mes;
        }        
        
        protected function loadModel($id_metodmat)
        {
            $model = Metodmat::model()->findByPk((int)$id_metodmat);
            if($model===null)
                throw new CHttpException(404,'The requested page does not exist.');
            return $model;
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
