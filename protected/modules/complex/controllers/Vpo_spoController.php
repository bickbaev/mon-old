<?php

class Vpo_spoController extends Controller
{
	public function actionEdit($id_rep)
	{
            if ($this->check_prava($id_rep)) {
                    $po_new = new CActiveDataProvider('Vpo_spo', array(
                    'criteria'=>array(
                        'condition' => 'id_report ='.$id_rep,
                        'order' => 'id_po_new ASC'
                    ), 
                    'pagination'=>array('pageSize'=>200)
                    ));                     
                    $id_est = Report::model()->findByPk($id_rep)->id_est;
                    $naim_est = Est::model()->findByPk($id_est)->est_name;
                    $this->render('edit', array(
                        'po_new'=>$po_new,
                        'naim_est'=>$naim_est,
                        'id_rep'=>$id_rep,
                    )); 
            }
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
                $model=new Vpo_spo;
                
                $model->id_report = $id_rep;

                // Uncomment the following line if AJAX validation is needed
                // $this->performAjaxValidation($model);

                if(isset($_POST['Vpo_spo']))
                {
                    $model->attributes=$_POST['Vpo_spo'];
                    $report = $this->loadModel($model->id_report);
                    $report->prov = 1;
                    $report->status = 2;
                    $report->save();                     
                    if($model->save())
                        $this->redirect(array('edit','id_rep'=>$model->id_report));
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

                if(isset($_POST['Vpo_spo']))
                {
                    $model->attributes=$_POST['Vpo_spo'];
                    if($model->save()) {                       
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
                $model = $this->loadModelPo($id_po_new);
                if ($this->check_prava($model->id_report)) {                
                    // we only allow deletion via POST request
                    $model->delete();

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
            $model=Vpo_spo::model()->findByPk((int)$id_po_new);
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
        
}        

