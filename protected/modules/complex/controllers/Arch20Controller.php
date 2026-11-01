<?php

class Arch20Controller extends Controller
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
                $builds = new CActiveDataProvider('Arch20', array(
                    'criteria'=>array(
                        'condition' => 'id_report ='.$id_rep,
                        'order' => 'id_zd ASC'
                    ), 
                    'pagination'=>array('pageSize'=>200)
                )); 
                $this->render('edit', array(
                    'id_rep'=> $id_rep,
                    'naim_est'=>$naim_est,
                    'builds'=>$builds,
                    'id_est'=>$id_est,
                ));
            }
        }
        
        public function address($data) {
            if($data->pok6) $korpus = ', корпус '.$data->pok6;
            return Contact_gor::model()->findByPk($data->pok1)->naim_gor.' '.$data->pok2.', '.Contact_ul::model()->findByPk($data->pok3)->naim_ul.' '.$data->pok4.', дом №'.$data->pok5.$korpus;
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
        
        
        public function actionCreate_zd($id_rep)
        {
            if($this->check_prava($id_rep)) {                  
                $model=new Arch20;
                
                $model->id_report = $id_rep;

                // Uncomment the following line if AJAX validation is needed
                // $this->performAjaxValidation($model);

                if(isset($_POST['Arch20']))
                {
                    $model->attributes=$_POST['Arch20'];
                    if($model->save()) {
                        $report = Report::model()->findByPk($model->id_report);
                        $report->prov = 1;
                        $report->status = 2;
                        $report->save();                         
                        $this->redirect(array('edit','id_rep'=>$model->id_report));
                    }    
                }

                $this->render('create_zd',array(
                    'model'=>$model,
                    'mesto'=>$mesto,
                ));
            }
        }
        
        public function actionUpdate_zd($id_zd)
        {
            $model=$this->loadZd($id_zd);
            

            // Uncomment the following line if AJAX validation is needed
            // $this->performAjaxValidation($model);                      
                
            if(isset($_POST['Arch20']))
            {
                $model->attributes=$_POST['Arch20'];
                if($model->save()) $this->redirect(array('edit','id_rep'=>$model->id_report));;
            }

            $this->render('update_zd',array(
                'model'=>$model,
                'mesto'=>$mesto,
            ));

        }        

        /**
         * Deletes a particular model.
         * If deletion is successful, the browser will be redirected to the 'admin' page.
         * @param integer $id the ID of the model to be deleted
         */
        public function actionDelete_zd($id_zd)
        {
            if(Yii::app()->request->isPostRequest)
            {                
                // we only allow deletion via POST request
                $this->loadZd($id_zd)->delete();

                // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
                if(!isset($_GET['ajax']))
                    $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));  
            }
            else
                throw new CHttpException(400,'Invalid request. Please do not repeat this request again.');
        }
        
        protected function loadZd($id_zd)
        {
            $model=Arch20::model()->findByPk((int)$id_zd);
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


