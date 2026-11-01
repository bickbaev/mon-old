<?php

class VpoController extends Controller
{
	public function actionEdit($id_rep)
	{
            if ($this->check_prava($id_rep)) {
                $info = $this->loadModelInfo($id_rep);
                $faculty = new CActiveDataProvider('Vpo_faculty', array(
                    'criteria'=>array(
                        'condition' => 'id_report ='.$id_rep,
                        'order' => 'id_faculty ASC'
                    ), 
                    'pagination'=>array('pageSize'=>200)
                ));                
                $id_est = Report::model()->findByPk($id_rep)->id_est;
                $naim_est = Est::model()->findByPk($id_est)->est_name;                
                $this->render('edit', array(
                    'faculty' => $faculty,
                    'naim_est'=>$naim_est,
                    'id_rep'=>$id_rep,
                    'info'=>$info,
                ));                
            }
	}
        
        public function actionEdit_info($id_rep)
        {
            if ($this->check_prava($id_rep)) {            
                $model=$this->loadModelInfo($id_rep);

                // Uncomment the following line if AJAX validation is needed
                // $this->performAjaxValidation($model);

                if(isset($_POST['Vpo_info']))
                {
                    $model->attributes=$_POST['Vpo_info'];
                    if($model->save()) {
                        $report = $this->loadModel($model->id_report);
                        $report->prov = 1;
                        $report->status = 2;
                        $report->save();
                        $this->redirect(array('edit','id_rep'=>$model->id_report));
                    }
                }

                $this->render('edit_info',array(
                    'model'=>$model,
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
        
        protected function loadModelInfo($id_rep)
        {
            $model=Vpo_info::model()->findByPk((int)$id_rep);
            if($model===null)
                throw new CHttpException(403,'У Вас нет необходимых прав');                          
            return $model;
        }         
        
        
	public function actionEdit_faculty($id_faculty)
	{
            $model=$this->loadModelFaculty($id_faculty);
            $spec = new CActiveDataProvider('Vpo_data', array(
                'criteria'=>array(
                    'condition' => 'id_report ='.$model->id_report.' and id_faculty = '.$model->id_faculty,
                    'order' => 'id_vpo ASC'
                ), 
                'pagination'=>array('pageSize'=>200)
            ));            
            $this->render('edit_faculty',array(
                'model'=>$model,
                'spec'=>$spec,
            ));            
	}       
        
        public function actionCreate_faculty($id_rep)
        {
            if ($this->check_prava($id_rep)) {
                $model=new Vpo_faculty;

                // Uncomment the following line if AJAX validation is needed
                // $this->performAjaxValidation($model);

                if(isset($_POST['Vpo_faculty']))
                {
                    $model->attributes=$_POST['Vpo_faculty'];
                    $model->id_report = $id_rep;
                    if($model->save()) $this->redirect(array('edit','id_rep'=>$model->id_report));
                }

                $this->render('create_faculty',array(
                    'model'=>$model,
                ));
            }
        }
        
        public function actionUpdate_faculty($id_faculty)
        {
            $model=$this->loadModelFaculty($id_faculty);

            // Uncomment the following line if AJAX validation is needed
            // $this->performAjaxValidation($model);

            if(isset($_POST['Vpo_faculty']))
            {
                $model->attributes=$_POST['Vpo_faculty'];
                if($model->save()) $this->redirect(array('edit_faculty','id_faculty'=>$model->id_faculty));
            }

            $this->render('update_faculty',array(
                'model'=>$model,
            ));
        }

        /**
         * Deletes a particular model.
         * If deletion is successful, the browser will be redirected to the 'admin' page.
         * @param integer $id the ID of the model to be deleted
         */
        public function actionDelete_faculty($id_faculty)
        {
            if(Yii::app()->request->isPostRequest)
            {
                $model = $this->loadModelFaculty($id_faculty);
                Yii::app()->db->createCommand('delete from vpo_data where id_report ='.$model->id_report.' and id_faculty = '.$model->id_faculty)->execute();
                // we only allow deletion via POST request
                $model->delete();

                // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
                if(!isset($_GET['ajax']))
                    $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
            }
            else
                throw new CHttpException(400,'Invalid request. Please do not repeat this request again.');
        }

        public function loadModelFaculty($id_faculty)
        {
            $model=Vpo_faculty::model()->findByPk((int)$id_faculty);
            if($model===null) throw new CHttpException(404,'The requested page does not exist.');
            if($this->check_prava($model->id_report)) true;
            return $model;
        }        

        public function fac_info($data) {
            return '<p>'.$data->naim_faculty.'<br><small>'.CHtml::link($data->link,$data->link).'<small></p>';
        }
        
        public function fac_spec($data) {            
            return Yii::app()->db->createCommand('select count(id_vpo) from vpo_data where id_report ='.$data->id_report.' and id_faculty = '.$data->id_faculty)->queryScalar();
        }        
        
        public function actionCreate_vpo_data($id_rep, $id_faculty)
        {
            if ($this->check_prava($id_rep)) {
                $model=new Vpo_data;
                $faculty = $this->loadModelFaculty($id_faculty);                
                $model->id_report = $id_rep;
                $model->id_faculty = $faculty->id_faculty;                

                // Uncomment the following line if AJAX validation is needed
                // $this->performAjaxValidation($model);

                if(isset($_POST['Vpo_data']))
                {
                    $model->attributes=$_POST['Vpo_data'];
                    if($model->save()) $this->redirect(array('edit_faculty','id_faculty'=>$model->id_faculty));
                }

                $this->render('create_data',array(
                    'model'=>$model,
                    'faculty'=>$faculty,
                ));
            }
        }

        /**
         * Updates a particular model.
         * If update is successful, the browser will be redirected to the 'view' page.
         * @param integer $id the ID of the model to be updated
         */
        public function actionUpdate_vpo_data($id_vpo)
        {
            $model=$this->loadModelVpodata($id_vpo);
            $faculty = $this->loadModelFaculty($model->id_faculty);
            // Uncomment the following line if AJAX validation is needed
            // $this->performAjaxValidation($model);

            if(isset($_POST['Vpo_data']))
            {
                $model->attributes=$_POST['Vpo_data'];
                if($model->save()) $this->redirect(array('edit_faculty','id_faculty'=>$model->id_faculty));
            }

            $this->render('update_data',array(
                'model'=>$model,
                'faculty'=>$faculty,                
            ));
        }

        /**
         * Deletes a particular model.
         * If deletion is successful, the browser will be redirected to the 'admin' page.
         * @param integer $id the ID of the model to be deleted
         */
        public function actionDelete_vpo_data($id_vpo)
        {
            if(Yii::app()->request->isPostRequest)
            {
                // we only allow deletion via POST request
                $this->loadModelVpodata($id_vpo)->delete();

                // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
                if(!isset($_GET['ajax']))
                    $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
            }
            else
                throw new CHttpException(400,'Invalid request. Please do not repeat this request again.');
        }

        public function loadModelVpodata($id_vpo)
        {
            $model = Vpo_data::model()->findByPk((int)$id_vpo);
            if($model===null) throw new CHttpException(404,'The requested page does not exist.');
            if($this->check_prava($model->id_report)) true;
            return $model;
        }

        public function actionPo_complete() {
            $term = Yii::app()->getRequest()->getParam('term');

            if(Yii::app()->request->isAjaxRequest && $term) {
                $criteria = new CDbCriteria;
                // формируем критерий поиска
                $criteria->addSearchCondition('id_vpo', $term);
                //$criteria->group = 'name';
                $decls = Vpo_code::model()->findAll($criteria);
                // обрабатываем результат
                $result = array();
                foreach($decls as $decl) {
                    $result[] = array('id'=>$decl['id_vpo'], 'label'=>$decl['id_vpo'].'/'.$decl['naim_vpo'], 'value'=>$decl['id_vpo']);
                }
                echo CJSON::encode($result);
                Yii::app()->end();
            }
        }        

        protected function check_prava($id_rep)
        {
            $id_rep = (int)$id_rep;
            $reader = Yii::app()->db->createCommand('select report.id_est, report.status, rep_name.rep_name, rep_name.rep_type from report, rep_name where rep_name.archive is null and report.id_rep_type = rep_name.id_rep_type and report.id_report = '.$id_rep)->queryRow();
            if(is_array($reader) && in_array($reader['id_est'], Yii::app()->session['pid'])) { 
                if(Yii::app()->session['type_adm'] == 0 && $reader['status'] > 3) throw new CHttpException(403,'У Вас нет необходимых прав');
                if(Yii::app()->session['type_adm'] == 3 && $reader['status'] > 4) throw new CHttpException(403,'У Вас нет необходимых прав');
                return true;
            }
            else throw new CHttpException(403,'У Вас нет необходимых прав');                 
        }         
}        
