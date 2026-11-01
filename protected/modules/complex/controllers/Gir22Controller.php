<?php

class Gir22Controller extends Controller
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
                $naim_est = Report::model()->findByPk($id_rep)->est->est_name;
                $id_est = Report::model()->findByPk($id_rep)->est->id_est;
                $girs = new CActiveDataProvider('Gir22', array(
                    'criteria'=>array(
                        'condition' => 'id_report ='.$id_rep,
                        'order' => 'id_gir ASC'
                    ), 
                    'pagination'=>array('pageSize'=>200)
                ));
                $motv = $this->loadOtv($id_rep);
                if($motv->sur) $otv = '<span><i>'.$motv->sur.' '.$motv->name.' '.$motv->par.'</i></span>';
                else $otv = '<span class="text-error"><i>Информация не заполнена</i></span>';
                $report = $this->loadModel($id_rep);
                $report->status = 2;
                $report->save();                
                $this->render('edit', array(
                    'id_rep'=> $id_rep,
                    'naim_est'=>$naim_est,
                    'girs'=>$girs,
                    'id_est'=>$id_est,
                    'otv'=>$otv,                   
                ));
            }
        }
        
        public function uch($data) {
            $type1 = array(1 => '10 класс', 2 => '11 класс');
            return '<b>'.$data->pok3.' '.$data->pok2.'.</b><br>'.$type1[$data->pok1];
        }

        public function vuz($data) {
            $type1 = array(1 => '10 класс', 2 => '11 класс');
            $res = $data->pok35.' ('.$data->pok36.')';
            if($data->pok37) $res = $res.'<br'.$data->pok37.' ('.$data->pok38.')';
            if($data->pok39) $res = $res.'<br'.$data->pok39.' ('.$data->pok40.')';
            return $res;
        }        
        
        public function actionUpdate_otv($id_rep)
        {
            $model=$this->loadOtv($id_rep);           

            // Uncomment the following line if AJAX validation is needed
            // $this->performAjaxValidation($model);                      
                
            if(isset($_POST['Gir22_otv']))
            {
                $model->attributes=$_POST['Gir22_otv'];
                if($model->save()) {               
                    $this->redirect(array('edit','id_rep'=>$model->id_report));                    
                }
            }

            $this->render('update_otv',array(
                'model'=>$model,                    
            ));

        }

        public function actionCreate_gir($id_rep)
        {
            if($this->check_prava($id_rep)) {                  
                $model=new Gir22;
                
                $model->id_report = $id_rep;                              

                // Uncomment the following line if AJAX validation is needed
                // $this->performAjaxValidation($model);

                if(isset($_POST['Gir22']))
                {
                    $model->attributes=$_POST['Gir22'];
                    if($model->save()) $this->redirect(array('edit','id_rep'=>$model->id_report));;
                }

                $this->render('create_gir',array(
                    'model'=>$model,                  
                ));
            }
        }

        public function actionUpdate_gir($id_gir)
        {
            $model=$this->loadGir($id_gir);           

            // Uncomment the following line if AJAX validation is needed
            // $this->performAjaxValidation($model);                      
                
            if(isset($_POST['Gir22']))
            {
                $model->attributes=$_POST['Gir22'];
                if($model->save()) $this->redirect(array('edit','id_rep'=>$model->id_report));;
            }

            $this->render('update_gir',array(
                'model'=>$model,                    
            ));

        }       

        public function actionDelete_gir($id_gir)
        {
            if(Yii::app()->request->isPostRequest)
            {                
                // we only allow deletion via POST request
                $this->loadGir($id_gir)->delete();

                // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
                if(!isset($_GET['ajax']))
                    $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));  
            }
            else
                throw new CHttpException(400,'Invalid request. Please do not repeat this request again.');
        }        
        
        protected function loadGir($id_master)
        {
            $model= Gir22::model()->findByPk((int)$id_master);
            if($model===null) throw new CHttpException(404,'The requested page does not exist.');
            $this->check_prava($model->id_report);
            return $model;
        }

        protected function loadOtv($id_report)
        {
            $model= Gir22_otv::model()->findByPk((int)$id_report);
            if($model===null) throw new CHttpException(404,'The requested page does not exist.');
            $this->check_prava($model->id_report);
            return $model;
        }

        protected function loadModel($id_rep)
        {
            $model=Report::model()->findByPk((int)$id_rep);
            if($model===null)
                throw new CHttpException(403,'У Вас нет необходимых прав');                          
            return $model;
        }        
        
        protected function check_prava($id_rep)
        {
            $id_rep = (int)$id_rep;
            $reader = Yii::app()->db->createCommand('select report.id_est, report.status from report, rep_name where rep_name.archive is null and report.id_rep_type = rep_name.id_rep_type and report.id_report='.$id_rep)->queryRow();            
            if(is_array($reader) && in_array($reader['id_est'], Yii::app()->session['pid'])) { 
                if(Yii::app()->session['type_adm'] == 3 && $reader['status'] > 3) throw new CHttpException(403,'У Вас нет необходимых прав');
                if(Yii::app()->session['type_adm'] == 1 && $reader['status'] > 4) throw new CHttpException(403,'У Вас нет необходимых прав');
                return true;
            }
            else throw new CHttpException(403,'У Вас нет необходимых прав');                 
        }         

}        
