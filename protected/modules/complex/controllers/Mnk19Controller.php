<?php

class Mnk19Controller extends Controller
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
                $mer = new CActiveDataProvider('Mnk19', array(
                    'criteria'=>array(
                        'condition' => 'id_report ='.$id_rep,
                        'order' => 'id_mnk ASC'
                    ), 
                    'pagination'=>array('pageSize'=>200)
                )); 
                $this->render('edit', array(
                    'id_rep'=> $id_rep,
                    'naim_est'=>$naim_est,
                    'mer'=>$mer,
                    'id_est'=>$id_est,
                ));
            }
        }
        
        /*public function actionExcel($id_rep) {
            $this->check_prava($id_rep);
            $god = Report::model()->findByPk($id_rep)->rep_name->dop;         
            $datas = Yii::app()->db->createCommand('select * from am_mer20 where id_report ='.$id_rep.' order by id_mer ASC')->queryAll();  
            
            for($i=0; $i <sizeof($datas); $i++) {
                $data[$i]['pok1'] = $this->kole($datas[$i]);
                $data[$i]['pok2'] = $this->mere($datas[$i]);
                $data[$i]['pok3'] = $this->rese($datas[$i]);
                $data[$i]['pok4'] = $this->fine($datas[$i]);
            }
            $pokaz = array('pok1'=>'Коллектив', 'pok2'=>'Мероприятие', 'pok3'=>'Результат участия', 'pok4'=>'Источник финансирования');
            $naim_est = Report::model()->findByPk($id_rep)->est->est_name; 
            $zag = 'Информация об участии творческих коллективов культурно–досуговых учреждений клубного типа Самарской области в международных, всероссийских, межрегиональных, региональных конкурсах (фестивалях) в '.$god.' году'.'. '.$naim_est;
            //print_r($pokaz);
            $this->render('excel', array('data' => $data, 'pokaz' =>$pokaz, 'zag'=>$zag));             
        }*/        
        
        
        public function actionCreate_mnk($id_rep)
        {
            if($this->check_prava($id_rep)) {                  
                $model=new Mnk19;
                
                $model->id_report = $id_rep;

                // Uncomment the following line if AJAX validation is needed
                // $this->performAjaxValidation($model);

                if(isset($_POST['Mnk19']))
                {
                    $model->attributes=$_POST['Mnk19'];
                    if($model->save()) {
                        $report = Report::model()->findByPk($model->id_report);
                        $report->prov = 1;
                        $report->status = 2;
                        $report->save();                         
                        $this->redirect(array('edit','id_rep'=>$model->id_report));
                    }    
                }

                $this->render('create_mnk',array(
                    'model'=>$model,
                    'mesto'=>$mesto,
                ));
            }
        }
        
        public function actionUpdate_mnk($id_mnk)
        {
            $model=$this->loadMnk($id_mnk);
            

            // Uncomment the following line if AJAX validation is needed
            // $this->performAjaxValidation($model);                      
                
            if(isset($_POST['Mnk19']))
            {
                $model->attributes=$_POST['Mnk19'];
                if($model->save()) $this->redirect(array('edit','id_rep'=>$model->id_report));;
            }

            $this->render('update_mnk',array(
                'model'=>$model,
                'mesto'=>$mesto,
            ));

        }        

        /**
         * Deletes a particular model.
         * If deletion is successful, the browser will be redirected to the 'admin' page.
         * @param integer $id the ID of the model to be deleted
         */
        public function actionDelete_mnk($id_mnk)
        {
            if(Yii::app()->request->isPostRequest)
            {                
                // we only allow deletion via POST request
                $this->loadMnk($id_mnk)->delete();

                // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
                if(!isset($_GET['ajax']))
                    $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));  
            }
            else
                throw new CHttpException(400,'Invalid request. Please do not repeat this request again.');
        }
        
        protected function loadMnk($id_mnk)
        {
            $model=Mnk19::model()->findByPk((int)$id_mnk);
            if($model===null) throw new CHttpException(404,'The requested page does not exist.');
            $this->check_prava($model->id_report);
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
