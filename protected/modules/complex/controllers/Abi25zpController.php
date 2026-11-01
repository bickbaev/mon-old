<?php

class Abi25zpController extends Controller
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
                $part = new CActiveDataProvider('Abi25_zp_part', array(
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
                ));
            }
        }
        
        public function actionUpdate_obsh($id_rep)
        {
            $model = $this->loadObsh($id_rep);
            
            $report = Report::model()->findByPk((int)$id_rep);
            $id_comp = $report->abi25_zp_comp_link->id;
            
            $model->id_comp = $id_comp;             

            // Uncomment the following line if AJAX validation is needed
            // $this->performAjaxValidation($model);                      
                
            if(isset($_POST['Abi25_zp_obsh']))
            {
                $model->attributes=$_POST['Abi25_zp_obsh'];
                
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
                                
                $model = new Abi25_zp_part;
                
                $report = Report::model()->findByPk((int)$id_rep);
                $id_comp = $report->abi25_zp_comp_link->id;                 
                
                $model->setScenario('add');
                
                $model->id_report = $id_rep;
                
                $model->id_comp = $id_comp;
                
                if($model->report->est->id_type == 2 || $model->report->est->id_type == 6) $school = true;
                else $school = false;

                // Uncomment the following line if AJAX validation is needed
                $this->performAjaxValidation($model);

                if(isset($_POST['Abi25_zp_part']))
                {
                    $model->attributes=$_POST['Abi25_zp_part'];
                    $model->id_est = $model->report->id_est;                    
                    
                    $model->file1 = CUploadedFile::getInstance($model, 'file1');
                    $model->file2 = CUploadedFile::getInstance($model, 'file2');
                    $model->file3 = CUploadedFile::getInstance($model, 'file3');
                    $model->file4 = CUploadedFile::getInstance($model, 'file4');
                    
                    if($model->validate()) {
                        $cals_vozr = $model->calc_vozr();
                        if($cals_vozr[1] < 7) $model->id_cat = 1;
                        elseif($cals_vozr[1] > 6 && $cals_vozr[1] < 12) $model->id_cat = 2;
                        else $model->id_cat = 3;                        
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
            if(isset($_POST['ajax']) && $_POST['ajax']==='abi25zp-part-form')
            {
                echo CActiveForm::validate($model);
                Yii::app()->end();
            }
        }   

        public function actionUpdate($id)
        {
            $model = $this->loadPart($id);
            
            $report = Report::model()->findByPk($model->id_report);
            $id_comp = $report->abi25_zp_comp_link->id;               

            if($model->report->est->id_type == 2 || $model->report->est->id_type == 6) $school = true;
            else $school = false;

            // Включаем AJAX-валидацию для update
            $this->performAjaxValidation($model);

            if(isset($_POST['Abi25_zp_part']))
            {
                $model->attributes=$_POST['Abi25_zp_part'];                         

                $model->file1 = CUploadedFile::getInstance($model, 'file1');
                $model->file2 = CUploadedFile::getInstance($model, 'file2');
                $model->file3 = CUploadedFile::getInstance($model, 'file3');
                $model->file4 = CUploadedFile::getInstance($model, 'file4');

                if($model->validate()) {
                    $cals_vozr = $model->calc_vozr();
                    if($cals_vozr[1] < 7) $model->id_cat = 1;
                    elseif($cals_vozr[1] > 6 && $cals_vozr[1] < 12) $model->id_cat = 2;
                    else $model->id_cat = 3;                    
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
                'id_comp'=>$id_comp
            ));
        }
        
        public function actionGet_compet_list()
        {
            if (!Yii::app()->request->isAjaxRequest) {
                throw new CHttpException(400, 'Некорректный запрос.');
            }

            $birthdate = Yii::app()->request->getParam('birthdate');
            $refdate   = Yii::app()->request->getParam('refdate'); // дата расчета возраста
            $id_comp   = (int)Yii::app()->request->getParam('id_comp'); // дата расчета возраста

            if (!$birthdate || !$refdate|| !$id_comp) {
                echo CJSON::encode([]);
                Yii::app()->end();
            }

            $birth_ts = strtotime($birthdate);
            $ref_ts   = strtotime($refdate);

            if ($birth_ts === false || $ref_ts === false || $id_comp == 0) {
                echo CJSON::encode([]);
                Yii::app()->end();
            }

            // Расчёт возраста на дату refdate
            $age = floor(($ref_ts - $birth_ts) / (365.25 * 24 * 60 * 60));

            $criteria = new CDbCriteria();
            $criteria->addCondition('id_comp = '.$id_comp);
            $criteria->addCondition('nov = 1');
            if ($age < 7) {
                $criteria->addCondition('jun = 1');
            } elseif ($age < 12) {
                $criteria->addCondition('osn1 = 1');
            } else {
                $criteria->addCondition('osn2 = 1');
            }

            $data = Abi25_zp_compet::model()->findAll($criteria);

            $result = [];
            foreach ($data as $item) {
                $result[] = ['id' => $item->id, 'naim' => $item->naim];
            }

            echo CJSON::encode($result);
            Yii::app()->end();
        }        
        
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
        
        protected function loadReport($id_rep)
        {
            $model=Report::model()->findByPk((int)$id_rep);
            if($model===null)
                throw new CHttpException(403,'У Вас нет необходимых прав');                          
            return $model;
        }        

        protected function loadObsh($id_rep)
        {
            $model= Abi25_zp_obsh::model()->findByPk((int)$id_rep);
            if($model===null) throw new CHttpException(404,'The requested page does not exist.');
            $this->check_prava($model->id_report);
            return $model;
        }        

        protected function loadPart($id)
        {
            $model= Abi25_zp_part::model()->findByPk((int)$id);
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


