<?php

class Atz25Controller extends Controller
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
            if ($this->check_prava($id_rep)) {
                $est = Report::model()->findByPk($id_rep)->est;
                $atz_obj = new CActiveDataProvider('Atz25_obj', array(
                    'criteria'=>array(
                        'condition' => 'id_report ='.$id_rep,
                        'order' => 'id ASC'
                    ), 
                    'pagination'=>array('pageSize'=>200)
                )); 
                $this->render('edit', array(
                    'id_rep'=> $id_rep,
                    'est'=>$est,
                    'atz_obj'=>$atz_obj,
                ));
            }
        }
        
        public function actionCreate_obj($id_rep)
        {
            if ($this->check_prava($id_rep)) {
                $model = new Atz25_obj;
                $model->id_report = $id_rep;

                if (isset($_POST['Atz25_obj'])) {
                    $model->attributes = $_POST['Atz25_obj'];

                    // Создаём объекты адресов из массива POST
                    $addresses = [];
                    if (isset($_POST['Atz25_adr']) && is_array($_POST['Atz25_adr'])) {
                        foreach ($_POST['Atz25_adr'] as $i => $addressData) {
                            $address = new Atz25_adr;
                            $address->attributes = $addressData;
                            $addresses[] = $address;
                        }
                    }

                    $model->addresses = $addresses;

                    // Проверяем всё сразу
                    $valid = $model->validate();
                    foreach ($addresses as $address) {
                        $valid = $address->validate() && $valid;
                    }    

                    if ($valid) {
                        $transaction = Yii::app()->db->beginTransaction();
                        try {
                            if($model->save(false)) {
                                foreach ($addresses as $address) {
                                    $address->id_obj = $model->id;
                                    $address->save(false);
                                }
                                $transaction->commit();
                                $report = Report::model()->findByPk($model->id_report);
                                $report->prov = 1;
                                $report->status = 2;
                                $report->save();                                 
                                Yii::app()->user->setFlash('success', 'Объект успешно сохранён.');
                                $this->redirect(['edit', 'id_rep' => $model->id_report]);
                            }
                        } catch (Exception $e) {
                            $transaction->rollback();
                            Yii::log($e->getMessage(), CLogger::LEVEL_ERROR);
                        }
                    }
                }

                $this->render('create_obj', ['model' => $model]);
            }
        }

        public function actionAddr_delete()
        {
            if (Yii::app()->request->isPostRequest) {
                $id = Yii::app()->request->getPost('id');
                $model = Atz25_adr::model()->findByPk($id);
                if ($model !== null) {
                    $model->delete();
                    echo 'OK';
                    Yii::app()->end();
                }
            }
            throw new CHttpException(400, 'Неверный запрос.');
        }

        public function actionUpdate_obj($id)
        {
            $model = $this->loadObj($id);

            if (isset($_POST['Atz25_obj'])) {
                $model->attributes = $_POST['Atz25_obj'];

                $addresses = [];
                if (isset($_POST['Atz25_adr']) && is_array($_POST['Atz25_adr'])) {
                    foreach ($_POST['Atz25_adr'] as $addressData) {
                        if (!empty($addressData['id'])) {
                            $address = Atz25_adr::model()->findByPk($addressData['id']);
                            if (!$address) continue;
                        } else {
                            $address = new Atz25_adr;
                            $address->id_obj = $model->id;
                        }
                        $address->attributes = $addressData;
                        $addresses[] = $address;
                    }
                }

                $model->addresses = $addresses;

                $valid = $model->validate();
                foreach ($addresses as $address) {
                    $valid = $address->validate() && $valid;
                }    
                /*if ($valid) {
                    $tx = Yii::app()->db->beginTransaction();
                    try {
                        $model->save(false);
                        foreach ($addresses as $address) {
                            $address->id_obj = $model->id;
                            $address->save(false);
                        }
                        $tx->commit();
                        Yii::app()->user->setFlash('success', 'Изменения сохранены.');
                        $this->redirect(['edit', 'id_rep' => $model->id_report]);
                    } catch (Exception $e) {
                        $tx->rollback();
                        Yii::log($e->getMessage(), CLogger::LEVEL_ERROR);
                    }
                }*/
                if ($valid) {
                    $transaction = Yii::app()->db->beginTransaction();
                    try {
                        if($model->save(false)) {
                            foreach ($addresses as $address) {
                                $address->id_obj = $model->id;
                                $address->save(false);
                            }
                            $transaction->commit();
                            Yii::app()->user->setFlash('success', 'Изменения сохранены.');
                            $this->redirect(['edit', 'id_rep' => $model->id_report]);
                        }
                    } catch (Exception $e) {
                        $transaction->rollback();
                        Yii::log($e->getMessage(), CLogger::LEVEL_ERROR);
                    }
                }
            }

            $this->render('update_obj', ['model' => $model]);
        }
        
        public function actionDelete_obj($id)
        {
            if(Yii::app()->request->isPostRequest)
            {
                $model = $this->loadObj($id)->delete();

                // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
                if(!isset($_GET['ajax']))
                    $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));  
            }
            else
                throw new CHttpException(400,'Invalid request. Please do not repeat this request again.');
        }        

        protected function loadObj($id)
        {
            $model= Atz25_obj::model()->findByPk((int)$id);
            if($model===null) throw new CHttpException(404,'The requested page does not exist.');
            $this->check_prava($model->report->id_report);
            $addresses = Atz25_adr::model()->findAllByAttributes(['id_obj' => $model->id]);
            // Превращаем их в массив моделей внутри основной модели
            $model->addresses = $addresses;
            return $model;
        }         

        protected function check_prava($id_rep)
        {            
            $reader = Yii::app()->db->createCommand('select report.id_est, report.status, rep_name.rep_name, rep_name.rep_type from report, rep_name where rep_name.archive is null and report.id_rep_type = rep_name.id_rep_type and report.id_report='.(int)$id_rep)->queryRow();            
            if(is_array($reader) && in_array($reader['id_est'], Yii::app()->session['pid'])) { 
                if(Yii::app()->session['type_adm'] == 0 && $reader['status'] > 3) throw new CHttpException(403,'У Вас нет необходимых прав');
                if(Yii::app()->session['type_adm'] == 3 && $reader['status'] > 4) throw new CHttpException(403,'У Вас нет необходимых прав');
                return true;
            }
            else throw new CHttpException(403,'У Вас нет необходимых прав2');                 
        }         
}        