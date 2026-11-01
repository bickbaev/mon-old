<?php

class Ws25Controller extends Controller
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
                $part1 = new CActiveDataProvider('Ws25_part', array(
                    'criteria'=>array(
                        'condition' => 'id_stat = 1 and id_report ='.$id_rep,
                        'order' => 'id ASC'
                    ), 
                    'pagination'=>array('pageSize'=>200)
                ));                
                $part2 = new CActiveDataProvider('Ws25_part', array(
                    'criteria'=>array(
                        'condition' => 'id_stat > 3 and id_report ='.$id_rep,
                        'order' => 'id ASC'
                    ), 
                    'pagination'=>array('pageSize'=>200)
                ));
                $this->render('edit', array(
                    'rep'=> $rep,
                    'est'=> $rep->est,
                    'obsh'=> $this->loadObsh($id_rep),
                    'part1'=> $part1,
                    'part2'=> $part2,
                ));
            }
        }

        public function actionUpdate_obsh($id_rep)
        {
            $model = $this->loadObsh($id_rep);
            
            $pok6_vr = $model->pok6_vr;
            $pok7_vr = $model->pok7_vr;
            $pok8_vr = $model->pok8_vr;

            // Uncomment the following line if AJAX validation is needed
            // $this->performAjaxValidation($model);                      
                
            if(isset($_POST['Ws25_obsh']))
            {
                $model->attributes=$_POST['Ws25_obsh'];
                $model->id_comp = $model->report->ws25->id;
                
                if(CUploadedFile::getInstance($model, 'file6')) $model->pok6_vr = date('Y-m-d H:i:s',time());
                else {
                    $model->pok6_vr = date('Y-m-d H:i:s',strtotime($pok6_vr));                  
                }                
                if(CUploadedFile::getInstance($model, 'file7')) $model->pok7_vr = date('Y-m-d H:i:s',time());
                else {
                    $model->pok7_vr = date('Y-m-d H:i:s',strtotime($pok7_vr));                
                }                 
                if(CUploadedFile::getInstance($model, 'file8')) $model->pok8_vr = date('Y-m-d H:i:s',time());  
                else {
                    $model->pok8_vr = date('Y-m-d H:i:s',strtotime($pok8_vr));                   
                } 
                
                if($model->save()) {                   
                    $this->redirect(array('edit','id_rep'=>$model->id_report));                    
                }
            }

            $this->render('update_obsh',array(
                'model'=>$model,                    
            ));

        }
        
        protected function loadReport($id_rep)
        {
            $model=Report::model()->findByPk((int)$id_rep);
            if($model===null)
                throw new CHttpException(403,'У Вас нет необходимых прав');                          
            return $model;
        }

        public function actionScandown($id, $type) {
            if(!in_array((int)$type, [1, 2])) throw new CHttpException(404,'The requested file does not exist2.');
            $model = $this->loadPart($id);
            if($type == 1) {
                $file = $model::FILE_PATH.'/'.Report::model()->findByPk($model->id_report)->id_rep_type.'/'.$model->id_report.'/'.$model->sogl;             
                $naim = $model->sogl_r;
            }
            else {
                $file = $model::FILE_PATH.'/'.Report::model()->findByPk($model->id_report)->id_rep_type.'/'.$model->id_report.'/'.$model->exp;
                $naim = $model->exp_r;
            }
            if(file_exists($file)) {
                Yii::app()->request->sendFile($naim, file_get_contents($file));
            }
            else throw new CHttpException(404,'The requested file does not exist.');            
        }        
        
        public function actionScandown2($id_rep, $id) {
            if(!in_array((int)$id, [6, 7, 8])) throw new CHttpException(404,'The requested file does not exist2.');
            $pok = 'pok'.$id;
            $pokr = 'pok'.$id.'_r';             
            $model = $this->loadObsh($id_rep);
            $file = $model::FILE_PATH.'/'.Report::model()->findByPk($id_rep)->id_rep_type.'/'.$id_rep.'/'.$model->$pok;             
            if(file_exists($file)) {
                Yii::app()->request->sendFile($model->$pokr, file_get_contents($file));
            }
            else throw new CHttpException(404,'The requested file does not exist.');            
        }
        
        public function actionCreate($id_rep)
        {
            if ($this->check_prava($id_rep)) {                                 
                $report = Report::model()->findByPk((int)$id_rep);
                $id_comp = $report->ws25->id;
                $models = array(
                    'contest' => new Ws25_part(),
                    'accomp' => new Ws25_part(),
                    'mentor' => new Ws25_part(),
                );
                
                foreach($models as $key => $model) {
                    $model->id_report = $id_rep;
                    $model->id_comp = $id_comp;
                    $model->setScenario($key);
                }                
                
                if($models['contest']->report->est->id_type == 2 || $model->report->est->id_type == 6) $school = true;
                else $school = false;

                // Uncomment the following line if AJAX validation is needed
                // $this->performAjaxValidation($model);

                if(isset($_POST['Ws25_part']))
                {
                    $valid = true;
                    $emails = array();

                    // Загружаем данные и файлы для каждой модели
                    foreach($models as $key => $model) {
                        
                        $model->attributes = $_POST['Ws25_part'][$key]; 
                        
                        $model->id_est = $model->report->id_est;
                        
                        if($model->pers_mail) $emails[] = $model->pers_mail; 
                        
                        if($school) $model->id_cat = 2; 
                        
                        if($key != 'contest') {
                            $model->id_cat = $models['contest']->id_cat;
                            $model->id_compet = $models['contest']->id_compet;
                            if(!$model->ano_org) $model->rabota = $model->report->est->est_name;
                            if($key == 'mentor') $model->id_stat = 2;
                            if($key == 'accomp') $model->id_stat = 3;                            
                        }
                        else {
                            $model->id_stat = 1;
                            if(!$model->ano_org) $model->rabota = $model->report->est->est_name;
                        }    
                        
                        $model->file1 = CUploadedFile::getInstance($model, $key.'[file1]');
                        $model->file2 = CUploadedFile::getInstance($model, $key.'[file2]');

                    }
                    
                    $nsov = $models['contest']->nsov();
                    
                    // Проверяем, что все email уникальны
                    if (count($emails) > 1 && (count($emails) !== count(array_unique($emails)))) {
                        Yii::app()->user->setFlash('error_mail', 'Все email-адреса должны быть уникальными');
                        $valid = false;
                    }                    
                    
                    foreach($models as $key => $model) {
                        if($key == 'accomp' && !$nsov) continue;
                        if(!$model->validate()) {
                            $valid = false;
                            Yii::app()->user->setFlash('error_all', 'В данных есть ошибки. Смотрите ниже');
                        }
                    }
                                        
                    if($valid) {
                        if($models['contest']->save()) {
                            $report = $this->loadReport($model->id_report);
                            if($report->status == 1) {
                                $report->prov = 1;
                                $report->status = 2;
                                $report->save();
                            }                            
                            $models['mentor']->parent_id = $models['contest']->id;
                            if($nsov) $models['accomp']->parent_id = $models['contest']->id;
                            if($models['mentor']->save()) {
                                if($nsov) {
                                    if($models['accomp']->save()) {
                                        $this->redirect(array('edit','id_rep'=>$models['contest']->id_report));
                                    }    
                                }            
                                else $this->redirect(array('edit','id_rep'=>$models['contest']->id_report));
                            }    
                        }    
                    }   
                }
                
                $this->render('create',array(
                    'models'=>$models,
                    'school'=>$school,
                    'id_comp'=>$id_comp
                ));                
            }
        }
        
        public function actionUpdate($id) {
            
                $models['contest'] = $this->loadPart($id);
                if(!$models['contest']->can_red()) throw new CHttpException(403,'У Вас нет необходимых прав');
                
                $models['mentor'] = $models['contest']->load_zav($id, 2);
                
                $models['accomp'] = $models['contest']->load_zav($id, 3);
                
                if($models['accomp'] === null) {
                    $models['accomp'] = new Ws25_part();
                    $models['accomp']->id_report = $models['contest']->id_report;
                }    
                
                foreach($models as $key => $model) {
                    $model->setScenario($key);
                }                
            
                if($models['contest']->report->est->id_type == 2 || $model->report->est->id_type == 6) $school = true;
                else $school = false;
                
                $report = Report::model()->findByPk((int)$model->id_report);
                $id_comp = $report->ws25->id;
                                

                // Uncomment the following line if AJAX validation is needed
                // $this->performAjaxValidation($model);

                if(isset($_POST['Ws25_part']))
                {
                    $valid = true;

                    // Загружаем данные и файлы для каждой модели
                    foreach($models as $key => $model) {
                        
                        $model->attributes = $_POST['Ws25_part'][$key]; 
                        
                        $model->id_est = $model->report->id_est;
                        
                        if($school) $model->id_cat = 2; 
                        
                        if($key != 'contest') {
                            $model->id_cat = $models['contest']->id_cat;
                            $model->id_compet = $models['contest']->id_compet;
                            if(!$model->ano_org ) $model->rabota = $model->report->est->est_name;
                            if($key == 'mentor') $model->id_stat = 2;
                            if($key == 'accomp') $model->id_stat = 3;                            
                        }
                        else $model->id_stat = 1;
                        
                        $model->file1 = CUploadedFile::getInstance($model, $key.'[file1]');
                        $model->file2 = CUploadedFile::getInstance($model, $key.'[file2]');

                    }
                    
                    $nsov = $models['contest']->nsov();
                    
                    foreach($models as $key => $model) {
                        if($key == 'accomp' && !$nsov) continue;
                        if(!$model->validate()) {
                            $valid = false;
                            Yii::app()->user->setFlash('error_all', 'В данных есть ошибки. Смотрите ниже');
                        }
                    }
                                        
                    if($valid) {
                        if($models['contest']->save()) {
                            $models['mentor']->parent_id = $models['contest']->id;
                            if($nsov) $models['accomp']->parent_id = $models['contest']->id;
                            if($models['mentor']->save()) {
                                if($nsov) {
                                    if($models['accomp']->save()) {
                                        $this->redirect(array('edit','id_rep'=>$models['contest']->id_report));
                                    }    
                                }            
                                else $this->redirect(array('edit','id_rep'=>$models['contest']->id_report));
                            }    
                        }    
                    }   
                }            
            
                $this->render('update',array(
                    'models'=>$models,
                    'school'=>$school,
                    'id_comp'=>$id_comp
                ));              
            
        }
        
        public function actionView($id)
        {
            $models['contest'] = $this->loadPart($id);
            $models['mentor'] = $models['contest']->load_zav($id, 2);
            $models['accomp'] = $models['contest']->load_zav($id, 3);

            $this->render('view', array(
                'models'=>$models,
            ));
        }

        public function actionView2($id)
        {
            $model=$this->loadPart($id);

            $this->render('view2', array(
                'model'=>$model,
            ));
            
        }        

        public function actionDelete($id)
        {
            if(Yii::app()->request->isPostRequest)
            {
                $models['contest'] = $this->loadPart($id);
                
                $models['mentor'] = $models['contest']->load_zav($id, 2);
                
                $models['accomp'] = $models['contest']->load_zav($id, 3);

                // we only allow deletion via POST request
                if($models['accomp'] != null) $models['accomp']->delete();
                $models['mentor']->delete();
                $models['contest']->delete();

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

        public function actionSo_complete() {
            $term = Yii::app()->getRequest()->getParam('term');

            if(Yii::app()->request->isAjaxRequest && $term) {
                $criteria = new CDbCriteria;
                // формируем критерий поиска
                $criteria->addSearchCondition('naim', $term);
                //$criteria->group = 'name';
                $decls = Ws25_so::model()->findAll($criteria);
                // обрабатываем результат
                $result = array();
                foreach($decls as $decl) {
                    $result[] = array('id'=>$decl['id'], 'label'=>$decl['naim'], 'value'=>$decl['naim']);
                }
                echo CJSON::encode($result);
                Yii::app()->end();
            }
        }        

        public function actionCreate2($id_rep)
        {
            if ($this->check_prava($id_rep)) {
                
                $report = Report::model()->findByPk((int)$id_rep);
                
                $id_comp = $report->ws25->id;
                                
                $model = new Ws25_part;               
                
                $model->setScenario('user2');
                
                $model->id_report = $id_rep;
                
                $model->id_comp = $id_comp;                
                
                if($model->report->est->id_type == 2 || $model->report->est->id_type == 6) $school = true;
                else $school = false;

                // Uncomment the following line if AJAX validation is needed
                // $this->performAjaxValidation($model);

                if(isset($_POST['Ws25_part']))
                {
                    $model->attributes=$_POST['Ws25_part'];
                    $model->id_est = $model->report->id_est;
                    if(!$model->ano_org) $model->rabota = $model->report->est->est_name;
                    if($school) $model->id_cat = 2;
                    
                    $model->file1 = CUploadedFile::getInstance($model, 'file1');
                    
                    if($model->save()) {
                        $this->redirect(array('edit','id_rep'=>$model->id_report));
                    }    
                }
                
                $this->render('create2',array(
                    'model'=>$model,
                    'school'=>$school,
                    'id_comp'=>$id_comp
                ));                
            }
        }
        
        public function actionUpdate2($id)
        {
            $model=$this->loadPart($id);

            if($model->report->est->id_type == 2) $school = true;
            else $school = false;
            
            if(isset($_POST['Ws25_part']))
            {
                $model->attributes=$_POST['Ws25_part'];                           
                
                $model->file1 = CUploadedFile::getInstance($model, 'file1');
                if($model->save()) {
                    $this->redirect(array('edit','id_rep'=>$model->id_report));                    
                }
            }

            $this->render('update2',array(
                'model'=>$model,
                'school'=>$school,
            ));
            
        }
        
        public function actionDelete2($id)
        {
            if(Yii::app()->request->isPostRequest)
            {
                $model = $this->loadPart($id);

                // we only allow deletion via POST request
                $model->delete();

                // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
                if(!isset($_GET['ajax']))
                    $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));  
            }
            else
                throw new CHttpException(400,'Invalid request. Please do not repeat this request again.');
        }        

        protected function loadPart($id)
        {
            $model= Ws25_part::model()->findByPk((int)$id);
            if($model===null) throw new CHttpException(404,'The requested page does not exist.');
            $this->check_prava($model->report->id_report);
            return $model;
        } 
        
        public function actionLoadcompet()
        {
           if(!Yii::app()->request->isAjaxRequest) throw new CHttpException('Url should be requested via ajax only');            
           $id_cat = (int)$_POST['id_cat'];
           $id_comp = (int)$_POST['id_comp'];
           $act = (int)$_POST['act'];
           $compet = Ws25_compet::model()->get_compet_cat($id_cat, $id_comp, $act); 
           //if($schools == -1) throw new CHttpException(404,'The requested page does not exist.'); 
           echo '<div class="control-group ">
                <label class="control-label required" for="Ws25_part_contest_id_compet">Компетенция <span class="required">*</span></label>
                <div class="controls">
                <select class="span6" name="Ws25_part[contest][id_compet]" id="Ws25_part_contest_id_compet">
                <option value="">Выберите компетенцию</option>';
           foreach($compet as $item) {
               echo CHtml::tag('option', array('value'=>$item->id),CHtml::encode($item->naim),true);
           }
           echo '</select></div></div>';
        }        
                

        public function actionLoadcompet2()
        {
           if(!Yii::app()->request->isAjaxRequest) throw new CHttpException('Url should be requested via ajax only');            
           $id_cat = (int)$_POST['id_cat'];
           $compet = Ws25_compet::model()->get_compet_cat($id_cat); 
           //if($schools == -1) throw new CHttpException(404,'The requested page does not exist.'); 
           echo '<div class="control-group ">
                <label class="control-label required" for="Ws25_part_id_compet">Компетенция <span class="required">*</span></label>
                <div class="controls">
                <select class="span6" name="Ws25_part[id_compet]" id="Ws25_part_id_compet">
                <option value="">Выберите компетенцию</option>';
           foreach($compet as $item) {
               echo CHtml::tag('option', array('value'=>$item->id),CHtml::encode($item->naim),true);
           }
           echo '</select></div></div>';
        }        

        protected function loadObsh($id_rep)
        {
            $model= Ws25_obsh::model()->findByPk((int)$id_rep);
            if($model===null) throw new CHttpException(404,'The requested page does not exist.');
            $this->check_prava($model->id_report);
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