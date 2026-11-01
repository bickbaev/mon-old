<?php

class UserController extends Controller
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
                'accessControl + add, edit, pass, del'
            );
        }

        function filterAccessControl($filterChain)
        {
            if (Yii::app()->user->isGuest)
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

		// renders the view file 'protected/views/site/index.php'
		// using the default layout 'protected/views/layouts/main.php'
		$this->redirect('index.php?r=site/cabinet');
	}
        public function actionEdit()
	{
            if (isset($_GET['id_est']) && $_GET['id_est'] != '') {
                $id_est = (int) $_GET['id_est'];
                if(in_array($id_est, Yii::app()->session['pid'])) {
                    $est = Est::model()->find('id_est=?', array($id_est));
                    if(!$est->cab_status || !$est->status) throw new CHttpException(403,'У Вас нет необходимых прав');
                    $user_id = $_GET['id'];
                    $command = Yii::app()->db->createCommand('select user_id from user where id_est='.$id_est);
                    $rows = $command->queryColumn();
                    if (in_array($user_id, $rows)) {
                        $model = User::model()->findByPk($user_id);
                        $model->setScenario('edit');
                        if (isset($_POST['User']) && isset($_POST['User']['user_id'])) {
                            $model->attributes=$_POST['User'];
                            if($model->pass1 != '') $model->pass = $model->hashPassword($model->pass1, $model->salt);
                            if($model->save()) {
                                Yii::app()->user->setFlash('success',"Данные изменены!");
                                $this->redirect('index.php?r=site/cabinet&id='.$model->id_est);
                            }
                        }
                        $this->render('edit',array('model'=>$model, 'user_id'=>$model->user_id, 'id_est'=>$model->id_est));
                    }
                    else throw new CHttpException(403,'У Вас нет необходимых прав');
                }
                else throw new CHttpException(403,'У Вас нет необходимых прав');
             }
            else $this->redirect(Yii::app()->user->returnUrl);
        }
        public function actionDel()
        {
            if (isset($_GET['id_est']) && $_GET['id_est'] != '') {
                $id_est = (int) $_GET['id_est'];
                if(in_array($id_est, Yii::app()->session['pid'])) {
                    $est = Est::model()->find('id_est=?', array($id_est));
                    if(!$est->cab_status || !$est->status) throw new CHttpException(403,'У Вас нет необходимых прав');
                    $user_id = $_GET['id'];
                    $command = Yii::app()->db->createCommand('select user_id from user where id_est='.$id_est);
                    $rows = $command->queryColumn();
                    if (in_array($user_id, $rows)) {
                        $command = Yii::app()->db->createCommand('delete from user where user_id="'.$user_id.'"');
                        $rowCount=$command->execute();
                        $this->redirect('index.php?r=site/cabinet&id='.$id_est);
                    }
                    else throw new CHttpException(403,'У Вас нет необходимых прав');
                }
                else throw new CHttpException(403,'У Вас нет необходимых прав');
            }
            else $this->redirect(Yii::app()->user->returnUrl);
        }
        public function actionAdd()
        {
            if (isset($_GET['id_est']) && $_GET['id_est'] != '') {
                $id_est = (int) $_GET['id_est'];
                if(in_array($id_est, Yii::app()->session['pid'])) {
                    $est = Est::model()->find('id_est=?', array($id_est));
                    if(!$est->cab_status || !$est->status) throw new CHttpException(403,'У Вас нет необходимых прав');
                    $model = new User('add');
                    if(isset($_POST['User']))
                        {
                            $model->attributes=$_POST['User'];
                            // validate user input and redirect to the previous page if valid
                            $model->salt = $model->generateSalt();
                            $model->id_est = $id_est;
                            $model->pass = $model->hashPassword($model->pass1, $model->salt);
                            if($model->save()) {
                                //Yii::app()->user->setFlash('add_user',"Пользователь добавлен");
                                //$this->redirect(Yii::app()->user->returnUrl);
                                $this->redirect('index.php?r=site/cabinet&id='.$id_est);
                            }
                        }
                    $this->render('add',array('model'=>$model, 'id_est'=>$model->id_est));
                }
                else throw new CHttpException(403,'У Вас нет необходимых прав');
            }
            else $this->redirect(Yii::app()->user->returnUrl);
        }
        public function actionPass()
        {
            $model = User::model()->find('LOWER(user_id)=?',array(Yii::app()->session['id']));
            $model->setScenario('change');
		// collect user input data
            if(isset($_POST['User']))
		{
                    $model->attributes=$_POST['User'];
                    if(!$model->validatePassword($model->old_pass)) $model->addError('old_pass', 'Вы ввели неверный пароль');
                    else {
                        $pass = $model->hashPassword($_POST['User']['pass1'], $model->salt);
                        $model->pass = $pass;
                        // validate user input and redirect to the previous page if valid
                        if($model->save()) {
                            Yii::app()->user->setFlash('success',"Пароль изменен!");
                            $this->redirect('index.php?r=site/cabinet&id='.Yii::app()->session['est']);
                            //$this->redirect('index.php?r=site/index');
                        }
                    }
		}
            $this->render('change',array('model'=>$model));
        }
}
