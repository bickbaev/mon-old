<?php

class Abi25Controller extends Controller
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
            $id_rep = (int)$id_rep;
            if ($this->check_prava($id_rep)) {
                $rep = Report::model()->findByPk($id_rep);
                $part = new CActiveDataProvider('Abi25_part', array(
                    'criteria'=>array(
                        'condition' => 'id_report ='.$id_rep,
                        'order' => 'id ASC'
                    ), 
                    'pagination'=>array('pageSize'=>200)
                ));
                $exp = new CActiveDataProvider('Abi25_exp', array(
                    'criteria'=>array(
                        'condition' => 'id_report ='.$id_rep,
                        'order' => 'id ASC'
                    ), 
                    'pagination'=>array('pageSize'=>200)
                ));                 
                $this->render('edit', array(
                    'rep'=> $rep,
                    'est'=> $rep->est,
                    'obsh'=> $this->loadObsh($id_rep),
                    'part'=> $part,
                    'exp'=> $exp,
                ));
            }
        }
        
        public function actionUpdate_obsh($id_rep)
        {
            $model = $this->loadObsh($id_rep);
            
            $report = Report::model()->findByPk((int)$id_rep);
            $id_comp = $report->abi25_comp_link->id;
            
            $model->id_comp = $id_comp;

            // Uncomment the following line if AJAX validation is needed
            // $this->performAjaxValidation($model);                      
                
            if(isset($_POST['Abi25_obsh']))
            {
                $model->attributes=$_POST['Abi25_obsh'];
                
                if($model->save()) {                 
                    $this->redirect(array('edit','id_rep'=>$model->id_report));                    
                }
            }

            $this->render('update_obsh',array(
                'model'=>$model,                    
            ));

        }
        
        public function actionCreate($id_rep)
        {
            if ($this->check_prava($id_rep)) {  
                                
                $model = new Abi25_part;
                
                $report = Report::model()->findByPk((int)$id_rep);
                $id_comp = $report->abi25_comp_link->id; 
                
                $model->setScenario('add');
                
                $model->id_report = $id_rep;
                
                $model->id_comp = $id_comp;
                
                if($model->report->est->id_type == 2 || $model->report->est->id_type == 6) $school = true;
                else $school = false;
                

                // Uncomment the following line if AJAX validation is needed
                $this->performAjaxValidation($model);

                if(isset($_POST['Abi25_part']))
                {
                    $model->attributes=$_POST['Abi25_part'];
                    $model->id_est = $model->report->id_est;
                    if($school) $model->id_cat = 1;
                    else $model->id_cat = 2;
                    
                    $model->file1 = CUploadedFile::getInstance($model, 'file1');
                    $model->file2 = CUploadedFile::getInstance($model, 'file2');
                    $model->file3 = CUploadedFile::getInstance($model, 'file3');
                    $model->file4 = CUploadedFile::getInstance($model, 'file4');
                    
                    if($model->validate()) {
                        if($model->save()) {
                            $report = $this->loadReport($model->id_report);
                            if($report->status == 1) {
                                $report->prov = 1;
                                $report->status = 2;
                                $report->save();
                            }
                            if (Yii::app()->request->isAjaxRequest) {
                                echo CJSON::encode(array(
                                    'status' => 'success',
                                    'redirect' => $this->createUrl('edit', array('id_rep'=>$model->id_report))
                                ));
                                Yii::app()->end();
                            } else {
                                $this->redirect(array('edit','id_rep'=>$model->id_report));
                            }
                        }
                    } else {
                        if (Yii::app()->request->isAjaxRequest) {
                            echo CJSON::encode(array(
                                'status' => 'error',
                                'errors' => $model->getErrors(),
                            ));
                            Yii::app()->end();
                        }
                    }                   
                    
                }
                
                $this->render('create',array(
                    'model'=>$model,
                    'school'=>$school,
                    'id_comp'=>$id_comp
                ));                
            }
        }                
        
        protected function performAjaxValidation($model)
        {
            if(isset($_POST['ajax']) && $_POST['ajax']==='abi25-part-form')
            {
                echo CActiveForm::validate($model);
                Yii::app()->end();
            }
        }

        public function actionUpdate($id)
        {
            $model = $this->loadPart($id);
            
            $report = Report::model()->findByPk($model->id_report);
            $id_comp = $report->abi25_comp_link->id;             

            if($model->report->est->id_type == 2) $school = true;
            else $school = false;

            // Включаем AJAX-валидацию для update
            $this->performAjaxValidation($model);

            if(isset($_POST['Abi25_part']))
            {
                $model->attributes=$_POST['Abi25_part'];                         

                $model->file1 = CUploadedFile::getInstance($model, 'file1');
                $model->file2 = CUploadedFile::getInstance($model, 'file2');
                $model->file3 = CUploadedFile::getInstance($model, 'file3');
                $model->file4 = CUploadedFile::getInstance($model, 'file4');

                if($model->validate()) {
                    if($model->save()) {
                        if (Yii::app()->request->isAjaxRequest) {
                            echo CJSON::encode(array(
                                'status' => 'success',
                                'redirect' => $this->createUrl('edit', array('id_rep'=>$model->id_report))
                            ));
                            Yii::app()->end();
                        } else {
                            $this->redirect(array('edit','id_rep'=>$model->id_report));
                        }
                    }
                } else {
                    if (Yii::app()->request->isAjaxRequest) {
                        echo CJSON::encode(array(
                            'status' => 'error',
                            'errors' => $model->getErrors(),
                        ));
                        Yii::app()->end();
                    }
                }
            }

            $this->render('update',array(
                'model' => $model,
                'school' => $school,
                'id_comp'=> $id_comp
            ));
        }        
        
        /*public function actionUpdate($id)
        {
            $model = $this->loadPart($id);

            if($model->report->est->id_type == 2) $school = true;
            else $school = false;
            
            if(isset($_POST['Abi25_part']))
            {
                $model->attributes=$_POST['Abi25_part'];                         
                
                $model->file1 = CUploadedFile::getInstance($model, 'file1');
                $model->file2 = CUploadedFile::getInstance($model, 'file2');
                $model->file3 = CUploadedFile::getInstance($model, 'file3');
                
                if($model->save()) {
                    $this->redirect(array('edit','id_rep'=>$model->id_report));                    
                }
            }

            $this->render('update',array(
                'model' => $model,
                'school' => $school,
            ));
            
        } */  
        
        public function actionDelete($id)
        {
            if(Yii::app()->request->isPostRequest)
            {
                $model = $this->loadPart($id)->delete();

                // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
                if(!isset($_GET['ajax']))
                    $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));  
            }
            else
                throw new CHttpException(400,'Invalid request. Please do not repeat this request again.');
        }

        public function actionCreate_exp($id_rep)
        {
            if ($this->check_prava($id_rep)) {  
                                
                $model = new Abi25_exp;
                
                $model->setScenario('add');
                
                $report = Report::model()->findByPk((int)$id_rep);
                $id_comp = $report->abi25_comp_link->id;                 
                
                $model->id_report = $id_rep;
                
                $model->id_comp = $id_comp;

                // Uncomment the following line if AJAX validation is needed
                $this->performAjaxValidation($model);

                if(isset($_POST['Abi25_exp']))
                {
                    $model->attributes=$_POST['Abi25_exp'];
                    
                    $model->file1 = CUploadedFile::getInstance($model, 'file1');
                    $model->file2 = CUploadedFile::getInstance($model, 'file2');
                    $model->file3 = CUploadedFile::getInstance($model, 'file3');
                    $model->file4 = CUploadedFile::getInstance($model, 'file4');
                    $model->file5 = CUploadedFile::getInstance($model, 'file5');
                    $model->file6 = CUploadedFile::getInstance($model, 'file6');
                    
                    if($model->validate()) {
                        if($model->save()) {
                            if (Yii::app()->request->isAjaxRequest) {
                                echo CJSON::encode(array(
                                    'status' => 'success',
                                    'redirect' => $this->createUrl('edit', array('id_rep'=>$model->id_report))
                                ));
                                Yii::app()->end();
                            } else {
                                $this->redirect(array('edit','id_rep'=>$model->id_report));
                            }
                        }
                    } else {
                        if (Yii::app()->request->isAjaxRequest) {
                            echo CJSON::encode(array(
                                'status' => 'error',
                                'errors' => $model->getErrors(),
                            ));
                            Yii::app()->end();
                        }
                    }                   
                    
                }
                
                $this->render('create_exp',array(
                    'model'=>$model,
                    'id_comp'=>$id_comp
                ));                
            }
        } 
        

        public function actionUpdate_exp($id)
        {                                 
                $model = $this->loadExp($id);
                
                $report = Report::model()->findByPk($model->id_report);
                $id_comp = $report->abi25_comp_link->id;                   

                // Uncomment the following line if AJAX validation is needed
                $this->performAjaxValidation($model);

                if(isset($_POST['Abi25_exp']))
                {
                    $model->attributes=$_POST['Abi25_exp'];
                    
                    $model->file1 = CUploadedFile::getInstance($model, 'file1');
                    $model->file2 = CUploadedFile::getInstance($model, 'file2');
                    $model->file3 = CUploadedFile::getInstance($model, 'file3');
                    $model->file4 = CUploadedFile::getInstance($model, 'file4');
                    $model->file5 = CUploadedFile::getInstance($model, 'file5');
                    $model->file6 = CUploadedFile::getInstance($model, 'file6');                    
                    
                    if($model->validate()) {
                        if($model->save()) {
                            if (Yii::app()->request->isAjaxRequest) {
                                echo CJSON::encode(array(
                                    'status' => 'success',
                                    'redirect' => $this->createUrl('edit', array('id_rep'=>$model->id_report))
                                ));
                                Yii::app()->end();
                            } else {
                                $this->redirect(array('edit','id_rep'=>$model->id_report));
                            }
                        }
                    } else {
                        if (Yii::app()->request->isAjaxRequest) {
                            echo CJSON::encode(array(
                                'status' => 'error',
                                'errors' => $model->getErrors(),
                            ));
                            Yii::app()->end();
                        }
                    }                   
                    
                }
                
                $this->render('update_exp',array(
                    'model'=>$model,
                    'id_comp'=>$id_comp
                ));                
        }

        
        public function actionDelete_exp($id)
        {
            if(Yii::app()->request->isPostRequest)
            {
                $model = $this->loadExp($id)->delete();

                // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
                if(!isset($_GET['ajax']))
                    $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));  
            }
            else
                throw new CHttpException(400,'Invalid request. Please do not repeat this request again.');
        }        

        public function actionPo_complete() {
            $term = Yii::app()->getRequest()->getParam('term');

            if(Yii::app()->request->isAjaxRequest && $term) {
                $criteria = new CDbCriteria;
                // формируем критерий поиска
                $criteria->addSearchCondition('id_po', $term);
                //$criteria->group = 'name';
                $decls = Po_new::model()->findAll($criteria);
                // обрабатываем результат
                $result = array();
                foreach($decls as $decl) {
                    $result[] = array('id'=>$decl['id_po'], 'label'=>$decl['id_po'].'/'.$decl['naim_po'], 'value'=>$decl['id_po']);
                }
                echo CJSON::encode($result);
                Yii::app()->end();
            }
        }

        public function actionScandown($id, $type) {
            if(!in_array((int)$type, [1, 2, 3, 4])) throw new CHttpException(404,'The requested file does not exist2.');
            $model = $this->loadPart($id);
            if($type == 1) {
                $file = $model::FILE_PATH.'/'.Report::model()->findByPk($model->id_report)->id_rep_type.'/'.$model->id_report.'/'.$model->spr;             
                $naim = $model->spr_r;
            }            
            elseif($type == 2) {
                $file = $model::FILE_PATH.'/'.Report::model()->findByPk($model->id_report)->id_rep_type.'/'.$model->id_report.'/'.$model->sogl;             
                $naim = $model->sogl_r;
            }
            elseif($type == 3) {
                $file = $model::FILE_PATH.'/'.Report::model()->findByPk($model->id_report)->id_rep_type.'/'.$model->id_report.'/'.$model->per_sogl;             
                $naim = $model->per_sogl_r;
            }
            else {
                $file = $model::FILE_PATH.'/'.Report::model()->findByPk($model->id_report)->id_rep_type.'/'.$model->id_report.'/'.$model->spro;             
                $naim = $model->spro_r;
            }            
            if(file_exists($file)) {
                Yii::app()->request->sendFile($naim, file_get_contents($file));
            }
            else throw new CHttpException(404,'The requested file does not exist.');            
        }
        
        public function actionScandown2($id, $type) {
            if(!in_array((int)$type, [1])) throw new CHttpException(404,'The requested file does not exist2.');
            $model = $this->loadObsh($id);
            if($type == 1) {
                $file = $model::FILE_PATH.'/'.Report::model()->findByPk($model->id_report)->id_rep_type.'/'.$model->id_report.'/'.$model->obsh;             
                $naim = $model->obsh_r;
            }             
            if(file_exists($file)) {
                Yii::app()->request->sendFile($naim, file_get_contents($file));
            }
            else throw new CHttpException(404,'The requested file does not exist.');            
        }        

        public function actionScandown_exp($id, $type) {
            if(!in_array((int)$type, [1, 2, 3, 4, 5, 6])) throw new CHttpException(404,'The requested file does not exist2.');
            $model = $this->loadExp($id);
            if($type == 1) {
                $file = $model::FILE_PATH.'/'.Report::model()->findByPk($model->id_report)->id_rep_type.'/'.$model->id_report.'/'.$model->scan;             
                $naim = $model->scan_r;
            }            
            elseif($type == 2) {
                $file = $model::FILE_PATH.'/'.Report::model()->findByPk($model->id_report)->id_rep_type.'/'.$model->id_report.'/'.$model->sogl;             
                $naim = $model->sogl_r;
            }
            elseif($type == 3) {
                $file = $model::FILE_PATH.'/'.Report::model()->findByPk($model->id_report)->id_rep_type.'/'.$model->id_report.'/'.$model->doc_obr;             
                $naim = $model->doc_obr_r;
            }
            elseif($type == 4) {
                $file = $model::FILE_PATH.'/'.Report::model()->findByPk($model->id_report)->id_rep_type.'/'.$model->id_report.'/'.$model->doc_staz;             
                $naim = $model->doc_staz_r;
            }
            elseif($type == 5) {
                $file = $model::FILE_PATH.'/'.Report::model()->findByPk($model->id_report)->id_rep_type.'/'.$model->id_report.'/'.$model->doc_snils;             
                $naim = $model->doc_snils_r;
            }
            elseif($type == 6) {
                $file = $model::FILE_PATH.'/'.Report::model()->findByPk($model->id_report)->id_rep_type.'/'.$model->id_report.'/'.$model->doc_pass;             
                $naim = $model->doc_pass_r;
            }            
            if(file_exists($file)) {
                Yii::app()->request->sendFile($naim, file_get_contents($file));
            }
            else throw new CHttpException(404,'The requested file does not exist.');            
        }         
        
        protected function loadReport($id_rep)
        {
            $model=Report::model()->findByPk((int)$id_rep);
            if($model===null)
                throw new CHttpException(403,'У Вас нет необходимых прав');                          
            return $model;
        }        

        protected function loadObsh($id_rep)
        {
            $model= Abi25_obsh::model()->findByPk((int)$id_rep);
            if($model===null) throw new CHttpException(404,'The requested page does not exist.');
            $this->check_prava($model->id_report);
            return $model;
        }        

        protected function loadPart($id)
        {
            $model= Abi25_part::model()->findByPk((int)$id);
            if($model===null) throw new CHttpException(404,'The requested page does not exist.');
            $this->check_prava($model->report->id_report);
            return $model;
        }
        
        protected function loadExp($id)
        {
            $model= Abi25_exp::model()->findByPk((int)$id);
            if($model===null) throw new CHttpException(404,'The requested page does not exist.');
            $this->check_prava($model->report->id_report);
            return $model;
        }          
        
        protected function check_prava($id_rep)
        {            
            $reader = Yii::app()->db->createCommand('select report.id_est, report.status, rep_name.rep_name, rep_name.rep_type from report, rep_name where rep_name.archive is null and report.id_rep_type = rep_name.id_rep_type and report.id_report='.$id_rep)->queryRow();            
            if(is_array($reader) && in_array($reader['id_est'], Yii::app()->session['pid'])) { 
                if(Yii::app()->session['type_adm'] == 0 && $reader['status'] > 3) throw new CHttpException(403,'У Вас нет необходимых прав');
                if(Yii::app()->session['type_adm'] == 3 && $reader['status'] > 4) throw new CHttpException(403,'У Вас нет необходимых прав');
                return true;
            }
            else throw new CHttpException(403,'У Вас нет необходимых прав');                 
        } 

}         