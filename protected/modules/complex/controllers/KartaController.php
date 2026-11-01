<?php

class KartaController extends Controller
{
	public function actionEdit($id_rep)
	{
            if ($this->check_prava($id_rep)) {
                    $info = $this->loadModelInfo($id_rep);
                    /*$fil = new CActiveDataProvider('Karta_filial', array(
                    'criteria'=>array(
                        'condition' => 'id_report ='.$id_rep,
                        'order' => 'id_fil ASC'
                    ),
                    'pagination'=>array('pageSize'=>200)
                    ));*/ 
                    /*$npo = new CActiveDataProvider('Karta_npo', array(
                    'criteria'=>array(
                        'condition' => 'id_report ='.$id_rep,
                        'order' => 'id_npo_prof ASC'
                    ), 
                    'pagination'=>array('pageSize'=>200)
                    ));
                    $spo = new CActiveDataProvider('Karta_spo', array(
                    'criteria'=>array(
                        'condition' => 'id_report ='.$id_rep,
                        'order' => 'id_spo_prof ASC'
                    ), 
                    'pagination'=>array('pageSize'=>200)
                    )); */
                    $po_new = new CActiveDataProvider('Karta_po_new', array(
                    'criteria'=>array(
                        'condition' => 'id_report ='.$id_rep,
                        'order' => 'id_po_new ASC'
                    ), 
                    'pagination'=>array('pageSize'=>200)
                    ));                     
                    $id_est = Report::model()->findByPk($info->id_report)->id_est;
                    $naim_est = Est::model()->findByPk($id_est)->est_name;
                    $this->render('edit', array(
                        'info'=>$info,
                        //'fil'=>$fil,
                        //'npo'=>$npo,
                        //'spo'=>$spo,
                        'po_new'=>$po_new,
                        'naim_est'=>$naim_est,
                    )); 
            }
	}
        //все для инфы об учреждении
        public function actionEdit_info($id_rep)
        {
            if ($this->check_prava($id_rep)) {            
                $model=$this->loadModelInfo($id_rep);

                // Uncomment the following line if AJAX validation is needed
                // $this->performAjaxValidation($model);

                if(isset($_POST['Karta_info']))
                {
                    $model->attributes=$_POST['Karta_info'];
                    if($model->save()) {
                        $report = $this->loadModel($id_rep);
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
 
        protected function loadModelInfo($id_rep)
        {
            $model=Karta_info::model()->findByPk((int)$id_rep);
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
        
        public function actionCreate_po($id_rep)
        {
            if ($this->check_prava($id_rep)) {                  
                $model=new Karta_po_new;
                
                $model->id_report = $id_rep;

                // Uncomment the following line if AJAX validation is needed
                // $this->performAjaxValidation($model);

                if(isset($_POST['Karta_po_new']))
                {
                    $model->attributes=$_POST['Karta_po_new'];
                    if($model->save()) {
                        $report = $this->loadModel($model->id_report);
                        $report->prov = 1;
                        $report->status = 2;
                        $report->save();                        
                        $this->redirect(array('edit','id_rep'=>$model->id_report));
                    }    
                }

                $this->render('create_po',array(
                    'model'=>$model,
                ));
            }
        }
        
        public function actionUpdate_po($id_po_new)
        {
            $model=$this->loadModelPo($id_po_new);

            // Uncomment the following line if AJAX validation is needed
            // $this->performAjaxValidation($model);
            
            if ($this->check_prava($model->id_report)) {            

                if(isset($_POST['Karta_po_new']))
                {
                    $model->attributes=$_POST['Karta_po_new'];
                    if($model->save()) {
                        $report = $this->loadModel($model->id_report);
                        $report->prov = 1;
                        $report->status = 2;
                        $report->save();                        
                        $this->redirect(array('edit','id_rep'=>$model->id_report));                    
                    }
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
        public function actionDelete_po($id_po_new)
        {
            if(Yii::app()->request->isPostRequest)
            {
                if ($this->check_prava($this->loadModelPo($id_po_new)->id_report)) {                
                    // we only allow deletion via POST request
                    $this->loadModelPo($id_po_new)->delete();

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
        protected function loadModelPo($id_po_new)
        {
            $model=Karta_po_new::model()->findByPk((int)$id_po_new);
            if($model===null)
                throw new CHttpException(404,'The requested page does not exist.');
            return $model;
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
        
        protected function prof_po($data) {
            $prof = Po_new::model()->findByPk($data->id_po)->naim_po;
            $po_prog = Karta_spo_prog::model()->findByPk($data->po_prog)->spo_prog_naim;
            $po_forma = Karta_spo_forma::model()->findByPk($data->po_forma)->spo_prog_naim;
            $po_oplata = Karta_spo_oplata::model()->findByPk($data->po_oplata)->spo_prog_naim;
            return '<strong>'.$prof.' ('.$data->id_po.')'.'</strong><br />Программа обучения - '.$po_prog.'<br />Форма обучения - '.$po_forma.'<br />Оплата - '.$po_oplata;
        }        
        
        //общие функции
        
        protected function prof_obsh($data) {
            if($data->obsh) return '<i class="icon-ok-sign"></i>';
            return 'нет';
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
        
        //все для филиала

        /**
         * Creates a new model.
         * If creation is successful, the browser will be redirected to the 'view' page.
         */
        /*public function actionCreate_fil($id_rep)
        {
            if ($this->check_prava($id_rep)) {                  
                $model=new Karta_filial;
                
                $model->id_report = $id_rep;

                // Uncomment the following line if AJAX validation is needed
                // $this->performAjaxValidation($model);

                if(isset($_POST['Karta_filial']))
                {
                    $model->attributes=$_POST['Karta_filial'];
                    if($model->save())
                        $this->redirect(array('edit','id_rep'=>$model->id_report));
                }

                $this->render('create_fil',array(
                    'model'=>$model,
                ));
            }
        }*/

        /**
         * Updates a particular model.
         * If update is successful, the browser will be redirected to the 'view' page.
         * @param integer $id the ID of the model to be updated
         */
        /*public function actionUpdate_fil($id_fil)
        {
            $model=$this->loadModelFil($id_fil);

            // Uncomment the following line if AJAX validation is needed
            // $this->performAjaxValidation($model);
            
            if ($this->check_prava($model->id_report)) {            

                if(isset($_POST['Karta_filial']))
                {
                    $model->attributes=$_POST['Karta_filial'];
                    if($model->save()) {
                        $report = $this->loadModel($model->id_report);
                        $report->prov = 1;
                        $report->status = 2;
                        $report->save();
                        $this->redirect(array('edit','id_rep'=>$model->id_report));                    
                    }
                }

                $this->render('update_fil',array(
                    'model'=>$model,
                ));
            
            }
        }*/

        /**
         * Deletes a particular model.
         * If deletion is successful, the browser will be redirected to the 'admin' page.
         * @param integer $id the ID of the model to be deleted
         */
        /*public function actionDelete_fil($id_fil)
        {
            if(Yii::app()->request->isPostRequest)
            {
                if ($this->check_prava($this->loadModelFil($id_fil)->id_report)) {                
                    // we only allow deletion via POST request
                    $this->loadModelFil($id_fil)->delete();

                    // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
                    if(!isset($_GET['ajax']))
                        $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
                }   
            }
            else
                throw new CHttpException(400,'Invalid request. Please do not repeat this request again.');
        }*/

        /**
         * Returns the data model based on the primary key given in the GET variable.
         * If the data model is not found, an HTTP exception will be raised.
         * @param integer the ID of the model to be loaded
         */
        /*protected function loadModelFil($id_fil)
        {
            $model=Karta_filial::model()->findByPk((int)$id_fil);
            if($model===null)
                throw new CHttpException(404,'The requested page does not exist.');
            return $model;
        }*/
        
        //все для НПО

        /**
         * Creates a new model.
         * If creation is successful, the browser will be redirected to the 'view' page.
         */
        /*public function actionCreate_npo($id_rep)
        {
            if ($this->check_prava($id_rep)) {                  
                $model=new Karta_npo;
                
                $model->id_report = $id_rep;

                // Uncomment the following line if AJAX validation is needed
                // $this->performAjaxValidation($model);

                if(isset($_POST['Karta_npo']))
                {
                    $model->attributes=$_POST['Karta_npo'];
                    if($model->save())
                        $this->redirect(array('edit','id_rep'=>$model->id_report));
                }

                $this->render('create_npo',array(
                    'model'=>$model,
                ));
            }
        }*/

        /**
         * Updates a particular model.
         * If update is successful, the browser will be redirected to the 'view' page.
         * @param integer $id the ID of the model to be updated
         */
        /*public function actionUpdate_npo($id_npo_prof)
        {
            $model=$this->loadModelNpo($id_npo_prof);

            // Uncomment the following line if AJAX validation is needed
            // $this->performAjaxValidation($model);
            
            if ($this->check_prava($model->id_report)) {            

                if(isset($_POST['Karta_npo']))
                {
                    $model->attributes=$_POST['Karta_npo'];
                    if($model->save()) {
                        $report = $this->loadModel($model->id_report);
                        $report->prov = 1;
                        $report->status = 2;
                        $report->save();
                        $this->redirect(array('edit','id_rep'=>$model->id_report));                    
                    }
                }

                $this->render('update_npo',array(
                    'model'=>$model,
                ));
            
            }
        }*/

        /**
         * Deletes a particular model.
         * If deletion is successful, the browser will be redirected to the 'admin' page.
         * @param integer $id the ID of the model to be deleted
         */
        /*public function actionDelete_npo($id_npo_prof)
        {
            if(Yii::app()->request->isPostRequest)
            {
                if ($this->check_prava($this->loadModelNpo($id_npo_prof)->id_report)) {                
                    // we only allow deletion via POST request
                    $this->loadModelNpo($id_npo_prof)->delete();

                    // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
                    if(!isset($_GET['ajax']))
                        $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
                }   
            }
            else
                throw new CHttpException(400,'Invalid request. Please do not repeat this request again.');
        }*/

        /**
         * Returns the data model based on the primary key given in the GET variable.
         * If the data model is not found, an HTTP exception will be raised.
         * @param integer the ID of the model to be loaded
         */
        /*protected function loadModelNpo($id_npo_prof)
        {
            $model=Karta_npo::model()->findByPk((int)$id_npo_prof);
            if($model===null)
                throw new CHttpException(404,'The requested page does not exist.');
            return $model;
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
        
        protected function prof_npo($data) {
            $prof = Npo::model()->findByPk($data->id_npo)->naim_npo;
            $npo_prog = Karta_npo_prog::model()->findByPk($data->npo_prog)->npo_prog_naim;
            $npo_forma = Karta_npo_forma::model()->findByPk($data->npo_forma)->npo_prog_naim;
            $npo_oplata = Karta_npo_oplata::model()->findByPk($data->npo_oplata)->npo_prog_naim;
            return '<strong>'.$prof.' ('.$data->id_npo.')'.'</strong><br />Программа обучения - '.$npo_prog.'<br />Форма обучения - '.$npo_forma.'<br />Оплата - '.$npo_oplata;
        }*/
        
        
        //все для CПО

        /**
         * Creates a new model.
         * If creation is successful, the browser will be redirected to the 'view' page.
         */
        /*public function actionCreate_spo($id_rep)
        {
            if ($this->check_prava($id_rep)) {                  
                $model=new Karta_spo;
                
                $model->id_report = $id_rep;

                // Uncomment the following line if AJAX validation is needed
                // $this->performAjaxValidation($model);

                if(isset($_POST['Karta_spo']))
                {
                    $model->attributes=$_POST['Karta_spo'];
                    if($model->save())
                        $this->redirect(array('edit','id_rep'=>$model->id_report));
                }

                $this->render('create_spo',array(
                    'model'=>$model,
                ));
            }
        }*/
        
       

        /**
         * Updates a particular model.
         * If update is successful, the browser will be redirected to the 'view' page.
         * @param integer $id the ID of the model to be updated
         */
        /*public function actionUpdate_spo($id_spo_prof)
        {
            $model=$this->loadModelSpo($id_spo_prof);

            // Uncomment the following line if AJAX validation is needed
            // $this->performAjaxValidation($model);
            
            if ($this->check_prava($model->id_report)) {            

                if(isset($_POST['Karta_spo']))
                {
                    $model->attributes=$_POST['Karta_spo'];
                    if($model->save()) {
                        $report = $this->loadModel($model->id_report);
                        $report->prov = 1;
                        $report->status = 2;
                        $report->save();                        
                        $this->redirect(array('edit','id_rep'=>$model->id_report));                    
                    }
                }

                $this->render('update_spo',array(
                    'model'=>$model,
                ));
            
            }
        }*/

        /**
         * Deletes a particular model.
         * If deletion is successful, the browser will be redirected to the 'admin' page.
         * @param integer $id the ID of the model to be deleted
         */
        /*public function actionDelete_spo($id_spo_prof)
        {
            if(Yii::app()->request->isPostRequest)
            {
                if ($this->check_prava($this->loadModelSpo($id_spo_prof)->id_report)) {                
                    // we only allow deletion via POST request
                    $this->loadModelSpo($id_spo_prof)->delete();

                    // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
                    if(!isset($_GET['ajax']))
                        $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
                }   
            }
            else
                throw new CHttpException(400,'Invalid request. Please do not repeat this request again.');
        }*/

        /**
         * Returns the data model based on the primary key given in the GET variable.
         * If the data model is not found, an HTTP exception will be raised.
         * @param integer the ID of the model to be loaded
         */
        /*protected function loadModelSpo($id_spo_prof)
        {
            $model=Karta_spo::model()->findByPk((int)$id_spo_prof);
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
              
        
        protected function prof_spo($data) {
            $prof = Spo::model()->findByPk($data->id_spo)->naim_spo;
            $spo_prog = Karta_spo_prog::model()->findByPk($data->spo_prog)->spo_prog_naim;
            $spo_forma = Karta_spo_forma::model()->findByPk($data->spo_forma)->spo_prog_naim;
            $spo_oplata = Karta_spo_oplata::model()->findByPk($data->spo_oplata)->spo_prog_naim;
            return '<strong>'.$prof.' ('.$data->id_spo.')'.'</strong><br />Программа обучения - '.$spo_prog.'<br />Форма обучения - '.$spo_forma.'<br />Оплата - '.$spo_oplata;
        } */ 
        
        //Новые коды
               
                 
}
