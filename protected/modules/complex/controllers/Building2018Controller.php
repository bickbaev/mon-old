<?php

class Building2018Controller extends Controller
{
    
	public function actionEdit($id_rep)
	{
            if ($this->check_prava($id_rep)) {
                    $buildings = new CActiveDataProvider('Building2018', array(
                        'criteria'=>array(
                            'condition' => 'id_report ='.$id_rep,
                            'order' => 'id_building ASC'
                        ), 
                        'pagination'=>array('pageSize'=>200)
                        )
                    );                     
                    //$id_est = Report::model()->findByPk($id_rep)->id_est;
                    //$naim_est = Est::model()->findByPk($id_est)->est_name;
                    $naim_est = Report::model()->findByPk($id_rep)->est->est_name;
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
                $id_building = Yii::app()->db->createCommand('select max(id_building) from building2018')->queryScalar();    
                $id_building = $id_building + 1;
                Yii::app()->db->createCommand('insert into building2018 set id_building = '.$id_building.', id_report = '.$id_rep)->execute();
                $report = $this->loadReport($id_rep);
                if($report->status == 1) {
                    $report->prov = 1;
                    $report->status = 2;
                    $report->save(); 
                }
                $this->redirect(array('update','id_building'=>$id_building));
            }
        }

        public function actionUpdate($id_building)
        {
            $model=$this->loadModel($id_building);
            $rem = new CActiveDataProvider('Building2018_rem', array(
                'criteria'=>array(
                    'condition' => 'id_building ='.$model->id_building,
                    'order' => 'id_rem ASC'
                ), 
                'pagination'=>array('pageSize'=>200)
                )
            );
            $potr = new CActiveDataProvider('Building2018_potr', array(
                'criteria'=>array(
                    'condition' => 'id_building ='.$model->id_building,
                    'order' => 'id_potr ASC'
                ), 
                'pagination'=>array('pageSize'=>200)
                )
            );            
            // Uncomment the following line if AJAX validation is needed
            // $this->performAjaxValidation($model);
            
            if ($this->check_prava($model->id_report)) {

                $this->render('update',array(
                    'model'=>$model,
                    'rem' => $rem,
                    'potr' => $potr,
                ));
            
            }
        }

        public function actionBupdate($id_building)
        {
            $model=$this->loadModel($id_building);

            // Uncomment the following line if AJAX validation is needed
            // $this->performAjaxValidation($model);;            
            
            if ($this->check_prava($model->id_report)) {            

                if(isset($_POST['Building2018']))
                {
                    $model->attributes=$_POST['Building2018'];
                    if($model->save()) {
                        $this->redirect(array('update','id_building'=>$model->id_building));                    
                    }
                }

                $this->render('b_update',array(
                    'model'=>$model,
                ));
            
            }
        }
        
        public function actionBdown($id, $id_report, $id_building) {
            $id = (int)$id;
            $id_report = (int)$id_report;
            $id_building = (int)$id_building;
            if ($this->check_prava($id_report)) {
                $poks = array(1 => 'sszd', 2 => 'sszem', 3 => 'tp', 4 => 'inoe1', 5 => 'inoe2', 6 => 'inoe3', 7 => 'inoe4', 8 => 'inoe5');
                if(in_array($id, $poks)) throw new CHttpException(404,'The requested file does not exist3.');
                $model = $this->loadModel($id_building);
                $doc = $poks[$id];
                $file = '/var/www/cposo/data/www/mon.cposo.ru/protected/building18'.'/'.$this->loadReport($id_report)->id_rep_type.'/'.$model->$doc;
                if(file_exists($file)) { 
                    Yii::app()->request->sendFile($id.'.zip', file_get_contents($file));
                }
                else throw new CHttpException(404,'The requested file does not exist3.');
            }
        }

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
        
        public function actionCreate_rem($id_building)
        {
            $building=$this->loadModel($id_building);

            // Uncomment the following line if AJAX validation is needed
            // $this->performAjaxValidation($model);;            
            
            if ($this->check_prava($building->id_report)) {                    
                $model=new Building2018_rem;
                $model->id_building = $building->id_building;
                $model->id_report = $building->id_report;
                // Uncomment the following line if AJAX validation is needed
                // $this->performAjaxValidation($model);

                if(isset($_POST['Building2018_rem']))
                {
                    $model->attributes=$_POST['Building2018_rem'];
                    if($model->cap) $model->vid = '';
                    if($model->save())
                        $this->redirect(array('update','id_building'=>$model->id_building));
                }

                $this->render('create_rem',array(
                    'model'=>$model,
                ));
            }
        }
        
        public function actionUpdate_rem($id_rem)
        {
            $model=$this->loadRem($id_rem);

            // Uncomment the following line if AJAX validation is needed
            // $this->performAjaxValidation($model);
            if ($this->check_prava($model->id_report)) {
                if(isset($_POST['Building2018_rem']))
                {
                    $model->attributes=$_POST['Building2018_rem'];
                    if($model->save())
                        $this->redirect(array('update','id_building'=>$model->id_building));
                }

                $this->render('update_rem',array(
                    'model'=>$model,
                ));
            }
        }    
            
        
        public function actionDelete_rem($id_rem)
        {
            if(Yii::app()->request->isPostRequest)
            {
                if ($this->check_prava($this->loadRem($id_rem)->id_report)) {                
                    $this->loadRem($id_rem)->delete();
                    if(!isset($_GET['ajax']))
                        $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));                    
                }    

            // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
            }
            else
                throw new CHttpException(400,'Invalid request. Please do not repeat this request again.');
        }
        
        public function actionCreate_potr($id_building)
        {
            $building=$this->loadModel($id_building);

            // Uncomment the following line if AJAX validation is needed
            // $this->performAjaxValidation($model);;            
            
            if ($this->check_prava($building->id_report)) {                    
                $model=new Building2018_potr;
                $model->id_building = $building->id_building;
                $model->id_report = $building->id_report;
                $model->id_status = 1;
                // Uncomment the following line if AJAX validation is needed
                // $this->performAjaxValidation($model);

                if(isset($_POST['Building2018_potr']))
                {
                    $model->attributes=$_POST['Building2018_potr'];
                    if($model->save())
                        $this->redirect(array('update','id_building'=>$model->id_building));
                }

                $this->render('create_potr',array(
                    'model'=>$model,
                ));
            }
        }
        
        public function actionUpdate_potr($id_potr)
        {
            $model=$this->loadPotr($id_potr);

            // Uncomment the following line if AJAX validation is needed
            // $this->performAjaxValidation($model);
            if ($this->check_prava($model->id_report)) {
                if(isset($_POST['Building2018_potr']))
                {
                    $model->attributes=$_POST['Building2018_potr'];
                    /*$file = CUploadedFile::getInstance($model, 'doc1u');
                    $extension = 'zip';
                    $id_rep_type = Report::model()->findByPk($model->id_report)->id_rep_type;
                    $file_path = '/var/www/cposo/data/www/mon.cposo.ru/protected/building18'.'/'.$id_rep_type; 
                    $filename = $this->getRandomFileName($file_path, $extension);
                    $basename = $filename.'.'.$extension;
                    if($file->saveAs('/var/www/cposo/data/www/mon.cposo.ru/protected/building18/143/123.zip')) $model->techz = $basename;*/
                            
                    /*if(!file_exists($file_path)) mkdir($file_path, 0700, true);      
                    $poks = array(1 => 'techz', 2 => 'zakl', 3 => 'psd');                    
                    for($k = 1; $k < 4; $k++) {
                        $doc = 'doc'.$k;
                        $pok = $poks[$k];
                        $filed = 'file'.$k.'d';
                        if($model->$filed) {
                            if($model->$pok) {
                                unlink($file_path.'/'.$model->$pok);
                            }
                            $model->$pok = '';                    
                        }
                        if($file = CUploadedFile::getInstance($model, $doc.'u'))
                        {               
                            $filename = $this->getRandomFileName($file_path, $extension);
                            $basename = $filename.'.'.$extension;
                            echo $basename;
                            if($file->saveAs($file_path.'/'.$basename)) {
                                if($model->$pok) {
                                    unlink($file_path.'/'.$this->$pok);
                                }
                                $model->$pok = $basename;
                            }
                        }
                    }*/                    
                    //$model->save();
                    if($model->save()) {
                        $this->redirect(array('update','id_building'=>$model->id_building));
                    } 
                }

                $this->render('update_potr',array(
                    'model'=>$model,
                ));
            }
        }
        
        public function getRandomFileName($path, $extension='')
        {
            $extension = $extension ? '.' . $extension : '';
            $path = $path ? $path . '/' : '';

            do {
                $name = md5(microtime() . rand(0, 9999));
                $file = $path . $name . $extension;
            } while (file_exists($file));

            return $name;
        }        
            
        
        public function actionDelete_potr($id_potr)
        {
            if(Yii::app()->request->isPostRequest)
            {
                $model = $this->loadPotr($id_potr);
                if ($this->check_prava($model->id_report)) {                
                    $model->delete();
                    if(!isset($_GET['ajax']))
                        $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));                    
                }    

            // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
            }
            else
                throw new CHttpException(400,'Invalid request. Please do not repeat this request again.');
        }

        public function actionPdown($id, $id_report, $id_potr) {
            $id = (int)$id;
            $id_report = (int)$id_report;
            $id_potr = (int)$id_potr;
            if ($this->check_prava($id_report)) {
                $poks = array(1 => 'techz', 2 => 'zakl', 3 => 'psd');
                if(in_array($id, $poks)) throw new CHttpException(404,'The requested file does not exist3.');
                $model = $this->loadPotr($id_potr);
                $doc = $poks[$id];
                $file = '/var/www/cposo/data/www/mon.cposo.ru/protected/building18'.'/'.$this->loadReport($id_report)->id_rep_type.'/'.$model->$doc;
                if(file_exists($file)) { 
                    Yii::app()->request->sendFile($id.'.zip', file_get_contents($file));
                }
                else throw new CHttpException(404,'The requested file does not exist3.');
            }
        }

        public function potr_doc($data) {
            $res = '';
            $poks = array(1 => 'techz', 2 => 'zakl', 3 => 'psd');
            $attr = array(1 => 'Техническое заключение', 2 => 'Положительное заключение государственной экспертизы', 3 => 'Проектно-сметная документация');
            for($i = 1; $i < 4; $i++) {
                $pok = $poks[$i];
                if($data->$pok) {
                    if($res == '') $res = CHtml::link($attr[$i],array('building2018/pdown','id'=>$i, 'id_report' => $data->id_report, 'id_potr' => $data->id_potr));
                    else $res = $res.'<br/>'.CHtml::link($attr[$i],array('building2018/pdown','id'=>$i, 'id_report' => $data->id_report, 'id_potr' => $data->id_potr));
                }            
            }
            return $res;
        }        
        
        public function rem_vid($data) {
            if($data->cap) $res = 'Капитальный ремонт';
            else $res = $data->vid;
            return $res;
        }         

        public function loadRem($id_rem)
        {
            $model=Building2018_rem::model()->findByPk((int)$id_rem);
            if($model===null)
                throw new CHttpException(404,'The requested page does not exist.');
            return $model;
        } 
        
        public function loadPotr($id_potr)
        {
            $model=Building2018_potr::model()->findByPk((int)$id_potr);
            if($model===null)
                throw new CHttpException(404,'The requested page does not exist.');
            return $model;
        }        
        
        protected function loadModel($id_building)
        {
            $model = Building2018::model()->findByPk((int)$id_building);
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
        
        public function potr_rekv($data) {
            return '№ '.$data->num.' от '.$data->datar;
        }

        public function potr_inic($data) {          
            return Building2018_inic::model()->findByPk($data->id_inic)->naim_inic;
        }
        
        public function potr_status($data) {          
            return Building2018_status::model()->findByPk($data->id_status)->naim_status;
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

