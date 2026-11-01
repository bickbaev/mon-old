<?php

class AdminController extends Controller
{
	/**
	 * Declares class-based actions.
	 */
	public function actions()
	{

	}

        public function filters()
        {
            return array(
                'accessControl'
            );
        }

        function filterAccessControl($filterChain)
        {
            if (Yii::app()->session['id'] != 'bickbaev')
                    $this->redirect('index.php?r=site/login');
            else
                    $filterChain->run();
        }

	/**
	 * This is the default 'index' action that is invoked
	 * when an action is not explicitly requested by users.
	 */
	public function actionIndex()
	{
            $this->render('index');
	}

        public function actionOtchet()
        {
            $command = Yii::app()->db->createCommand('select archive is not null as archive, rep_name, date_type, DATE_FORMAT(s_date, "%d.%m.%Y") AS s_date, DATE_FORMAT(f_date, "%d.%m.%Y") AS f_date, id_rep_type from rep_name');
            $reader = $command->queryAll();
            /*$command = Yii::app()->db->createCommand('select id_est from est where id_okr = 5 and id_est > 20000');
            $reader_est = $command->queryColumn();
            $command = Yii::app()->db->createCommand('select max(id_report) from report');
            $id_report = $command->queryScalar();
            $id_rep_type = 2;
            $status = 1;
            $table = 'osn';
            for ($i = 0; $i < sizeof($reader_est); $i++) {
                $id_report = $id_report + 1;
                $id_reports[$i] = $id_report;
                $command = Yii::app()->db->createCommand('insert into report set id_report = '.$id_report.', id_rep_type = '.$id_rep_type.', id_est = '.$reader_est[$i].', status = '.$status);
                $command->execute();
            }
            for ($i = 0; $i < sizeof($id_reports); $i++) {
                $command = Yii::app()->db->createCommand('insert into '.$table.' set id_report = '.$id_reports[$i]);
                $command->execute();
            }*/
            $model = new RepName('add');
            if(isset($_POST['RepName']))
            {
                $model->attributes=$_POST['RepName'];
                // validate user input and redirect to the previous page if valid
                /*$model->salt = $model->generateSalt();
                $model->id_est = $id_est;
                $model->pass = $model->hashPassword($model->pass1, $model->salt);
                if($model->save()) {
                    //Yii::app()->user->setFlash('add_user',"Пользователь добавлен");
                    //$this->redirect(Yii::app()->user->returnUrl);
                    $this->redirect('index.php?r=site/cabinet&id='.$id_est);
                }*/
            }
            $this->render('otchet', array('model' => $model, 'otchet' => $reader));
        }

        public function actionArchive() {
            if (isset($_GET['id_rep_type']) && $_GET['id_rep_type'] != '') {
                $id_rep_type = (int) $_GET['id_rep_type'];
                $deistv = (int) $_GET['deistv'];
                if (!$deistv) {
                    $command = Yii::app()->db->createCommand('update rep_name set archive = 1 where id_rep_type = '.$id_rep_type);
                    $command->execute();
                }
                else {
                    $command = Yii::app()->db->createCommand('update rep_name set archive = null where id_rep_type = '.$id_rep_type);
                    $command->execute();
                }
                $this->redirect('index.php?r=admin/otchet');
            }
            else $this->redirect(Yii::app()->user->returnUrl);
        } 
        
        public function actionUser() {
            $criteria = new CDbCriteria;
            $criteria->condition = 'id_est = 1';
            $users = new CActiveDataProvider('User', array('criteria'=>$criteria, 'pagination'=>array('pageSize'=>200)));
            $this->render('user',array('users'=>$users));
        }
        
        public function actionUser_add()
        {
            $model=new User;            
            $model->setScenario('add');

            // Uncomment the following line if AJAX validation is needed
            // $this->performAjaxValidation($model);

            if(isset($_POST['User']))
            {
                $model->attributes=$_POST['User'];
                $model->id_est = 1;
                $model->salt = $model->generateSalt();
                $model->pass = $model->hashPassword($model->pass1, $model->salt);
                if($model->save())                    
                    $this->redirect(array('admin/user'));
            }

            $this->render('user_add',array(
                'model'=>$model,
            ));
        }

        /**
         * Updates a particular model.
         * If update is successful, the browser will be redirected to the 'view' page.
         * @param integer $id the ID of the model to be updated
         */
        public function actionUser_update($user_id)
        {
            $model=$this->loadUser($user_id);
            $model->setScenario('edit');

            // Uncomment the following line if AJAX validation is needed
            // $this->performAjaxValidation($model);

            if(isset($_POST['User']))
            {
                $model->attributes=$_POST['User'];
                if($model->pass1 != '') $model->pass = $model->hashPassword($model->pass1, $model->salt);
                if($model->save())
                    $this->redirect(array('admin/user'));
            }

            $this->render('user_update',array(
                'model'=>$model,
            ));
        }

        /**
         * Deletes a particular model.
         * If deletion is successful, the browser will be redirected to the 'index' page.
         * @param integer $id the ID of the model to be deleted
         */
        public function actionUser_delete($user_id)
        {
            if(Yii::app()->request->isPostRequest)
            {
                // we only allow deletion via POST request
                $this->loadUser($user_id)->delete();

                // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
                if(!isset($_GET['ajax']))
                    $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
            }
            else
                throw new CHttpException(400,'Invalid request. Please do not repeat this request again.');
        }
        
        public function loadUser($user_id)
        {
            $model=User::model()->findByPk($user_id);
            if($model===null)
                throw new CHttpException(404,'The requested page does not exist.');
            return $model;
        }
        
        public function actionBbb() {
             $bbb=Yii::app()->bigbluebutton;
             try {            
                $dataProvider=new CActiveDataProvider('Bbb', array('pagination'=>array('pageSize'=>200)));
                $this->render('bbb',array(
                    'dataProvider'=>$dataProvider,
                ));
             } 
             catch (BigBlueButtonException $ex)
             {
                 //i'd better implement more adequate error handling :)
                 throw new CHttpException(500, $ex->getMessage());
             }            
        }
        
        
        
        public function actionBbb_create() {
             $model=new Bbb();
             $model->moderatorPW = $this->gen_pass(8);
             $model->attendeePW = $this->gen_pass(6);             
             if(isset($_POST['Bbb']))
             {
                 $model->attributes=$_POST['Bbb'];
                 if ($model->terupr)
                 {
                    $command = Yii::app()->db->createCommand('select id_est from est where type_adm = 3');
                    $ests = $command->queryColumn();                    
                    foreach($ests as $k => $est) {
                        if($k == 0) $model->attendee = $est;
                        else $model->attendee.='##'.$est;
                    }
                 }                 
                 if($model->save())
                 {
                     $this->redirect(array('admin/bbb'));
                 }
             }
             $this->render('bbb_create', array("model"=>$model));              
        }
        
        public function actionBbb_join($meetingid) {
            $model = Bbb::model()->findByPk((int)$meetingid);
            $bbb=Yii::app()->bigbluebutton;
            $moderator = explode('##', $model->moderator);
            $attendee = explode('##', $model->attendee);
            if(in_array(Yii::app()->session['est'], $moderator)) {
                $role = 'BigBlueButton::ROLE_MODERATOR';
                $pass = array("password"=>$model->moderatorPW);
            }
            elseif(in_array(Yii::app()->session['est'], $attendee)) {
                $role = 'BigBlueButton::ROLE_ATTENDEE';
                $pass = array("password"=>$model->attendeePW);                
            }
            else throw new CHttpException(400,'Доступ запрещен');
            if($bbb->meetingIsRunning($meetingid)) {
                 $url=$bbb->getJoinMeetingUrl(
                         $model->meetingID, 
                         Yii::app()->session['est_name'].'-'.Yii::app()->session['fio'],
                         Yii::app()->user->id,
                         $role,
                         $pass);
                 $this->redirect($url);                  
            }
            else {
                 $meeting=$bbb->createMeeting(
                         $model->name,
                         array(
                                 "meetingID"=>$model->meetingID,
                                 "welcome"=>$model->welcome,
                                 "moderatorPW"=>$model->moderatorPW,
                                 "attendeePW"=>$model->attendeePW,
                                 "maxParticipants"=>$model->max_participants,
                                 "duration"=>$model->duration,                                     
                                 "record"=>$model->record,
                         ));                                 
                 $url=$bbb->getJoinMeetingUrl(
                         $model->meetingID, 
                         Yii::app()->session['est_name'].'-'.Yii::app()->session['fio'],
                         Yii::app()->user->id,
                         $role,
                         $pass);
                 $this->redirect($url);              
            }
            
        }
        
        public function bbb_status($data, $row) {
            $bbb=Yii::app()->bigbluebutton;
            if($bbb->meetingIsRunning($data->meetingID)) return 'Да';
            else return 'Нет';
        }
        
        public function actionBbb_edit($meetingid) {
             $model = Bbb::model()->findByPk((int)$meetingid);
             if(isset($_POST['Bbb']))
             {
                 $model->attributes=$_POST['Bbb'];
                 if($model->save())
                 {                     
                     $this->redirect(array('admin/bbb'));
                 }
            }             
            $this->render('bbb_edit', array("model"=>$model));
        }
        
        public function actionBbb_delete($meetingid)
        {
            if(Yii::app()->request->isPostRequest)
            {
                // we only allow deletion via POST request
                Bbb::model()->findByPk((int)$meetingid)->delete();

                // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
                if(!isset($_GET['ajax']))
                    $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
            }
            else
                throw new CHttpException(400,'Invalid request. Please do not repeat this request again.');
        }         
        
        public function actionBbb_end($meetingid) {
            $meeting = Bbb::model()->findByPk((int)$meetingid);
            $bbb=Yii::app()->bigbluebutton;
            try 
            {
                $bbb->endMeeting($meeting->meetingID, $meeting->moderatorPW);
                $this->redirect(array('admin/bbb'));
                
            } catch (BigBlueButtonException $ex)
            {
                //remember to properly handle exception if something goes wrong
                throw new CHttpException(500, $ex->getMessage());
            }            
        }        

        
        protected function gen_pass($max) {


            // Символы, которые будут использоваться в пароле.
            $chars="qazxswedcvfrtbnhymkp123456789QAZXSWEDCVFRTBNHYMKP";
            // Количество символов в пароле.
            //$max=6;
            // Определяем количество символов в $chars
            $size=StrLen($chars)-1;
            // Определяем пустую переменную, в которую и будем записывать символы.
            $password=null;
            // Создаём пароль.
                while($max--)
                $password.=$chars[rand(0,$size)];
            // Выводим созданный пароль.
            return $password;   
            
        }        


        protected function stat_only($data, $row) {
            if($data->stat_only) return 'да';
            else return '';
        }
        
        protected function phone($data, $row) {
            if($data->phone) return "(".$data->reg_cod_phone.")".$data->phone;
            else return '';
        }
        
        protected function mobile($data, $row) {
            if($data->mobile_phone) return "+7(".$data->reg_cod_mobile.")".$data->mobile_phone;
            else return '';
        }
    

}