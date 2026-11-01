<?php
class SiteController extends Controller
{
        //public $defaultAction = 'tree';
        public $breadcrumbs = array();

        /**
	 * Declares class-based actions.
	 */
	public function actions()
	{
		return array(
			// captcha action renders the CAPTCHA image displayed on the contact page
			'captcha'=>array(
				'class'=>'CCaptchaAction',
				'backColor'=>0xFFFFFF,
			),
			// page action renders "static" pages stored under 'protected/views/site/pages'
			// They can be accessed via: index.php?r=site/page&view=FileName
			'page'=>array(
				'class'=>'CViewAction',
			),
		);
	}

        public function filters()
        {
            return array(
                'accessControl + cabinet, ajaxFillTree, tree, fill_est, est_check, bbb_join',
                'regionControl + add_est'
            );
        }

        function filterAccessControl($filterChain)
        {
            if (Yii::app()->user->isGuest)
                    $this->redirect('index.php?r=site/login');
            elseif(Yii::app()->session['stat_only']) $this->redirect('index.php?r=stat/index');
            else
                    $filterChain->run();
        }

        function filterRegionControl($filterChain)
        {
            if (Yii::app()->session['type_adm'] != 4)
                    $this->redirect('index.php?r=site/login');
            else
                    $filterChain->run();
        }        

	/**
	 * This is the default 'index' action that is invoked
	 * when an action is not explicitly requested by users.
	 */
	public function actionIndex2()
	{
                $command = Yii::app()->db->createCommand('select est_name, id_est from est where type_adm = 2');
                $raions = $command->queryAll();
                $this->render('index', array('raions'=>$raions));                
	}
        
	public function actionIndex()
	{
                $command=Yii::app()->db->createCommand('select id_est, est_name from est where id_est > 14 and id_est < 25');
                $gos = $command->queryAll();
                $command=Yii::app()->db->createCommand('select id_est, est_name from est where id_est > 24 and id_est < 52');
                $mos = $command->queryAll();            
                $this->render('index2', array('gos'=>$gos, 'mos'=>$mos));             
	}        

        public function actionType() {
            if (isset($_GET['id_raion']) && $_GET['id_raion'] != '') {
                $raion = (int) $_GET['id_raion'];
                $command = Yii::app()->db->createCommand('select id_est from est where type_adm = 2');
                $raions = $command->queryColumn();
                if(in_array($raion, $raions)) {
                    $command = Yii::app()->db->createCommand('select est_name from est where id_est = '.$raion);
                    $name = $command->queryScalar();
                    $command = Yii::app()->db->createCommand('select est_name, id_est from est where status = 1 and pid_est = '.$raion);
                    $types = $command->queryAll();
                    $this->render('type', array('types'=>$types, 'name' => $name));
                }
                else throw new CHttpException(403,'У Вас нет необходимых прав');
           }
           else $this->redirect(Yii::app()->user->returnUrl);
        }

        public function actionSchools() {
            if (isset($_GET['id_type']) && $_GET['id_type'] != '') {
                $type = (int) $_GET['id_type'];
                $command = Yii::app()->db->createCommand('select id_est from est where type_adm = 1');
                $types = $command->queryColumn();
                if(in_array($type, $types)) {
                    $command = Yii::app()->db->createCommand('select est_name, id_raion from est where id_est = '.$type);
                    $id_raion = $command->queryRow();
                    $command = Yii::app()->db->createCommand('select est_name from est where id_est = '.$id_raion['id_raion']);
                    $name = $command->queryScalar();
                    $command = Yii::app()->db->createCommand('select est_name, id_est from est where status > 0 and pid_est = '.$type);
                    $schools = $command->queryAll();
                    $this->render('schools', array('schools'=>$schools, 'id_raion' => $id_raion, 'name' => $name));
                }
                else throw new CHttpException(403,'У Вас нет необходимых прав');
           }
           else $this->redirect(Yii::app()->user->returnUrl);
        }

        public function actionReport() {
           if (isset($_GET['id_school']) && $_GET['id_school'] != '') {
                $school = (int) $_GET['id_school'];
                $command = Yii::app()->db->createCommand('select id_est from est where type_adm = 0');
                $schools = $command->queryColumn();
                //$this->render('report', array('report'=>$schools));
                if(in_array($school, $schools)) {
                    $command = Yii::app()->db->createCommand('select pid_est, id_raion, est_name from est where id_est = '.$school);
                    $school_name_a = $command->queryRow();
                    $school_name = $school_name_a['est_name'];
                    $command = Yii::app()->db->createCommand('select est_name from est where id_est = '.$school_name_a['id_raion']);
                    $id_raion = $command->queryScalar();
                    $command = Yii::app()->db->createCommand('select est_name from est where id_est = '.$school_name_a['pid_est']);
                    $type = $command->queryScalar();
                    //$command = Yii::app()->db->createCommand('select id_rep_type from rep_name where rep_type = 1 and archive is null order by id_rep_type desc');
                    $command = Yii::app()->db->createCommand('select id_rep_type from rep_name where rep_type = 1 order by id_rep_type asc');
                    $reader = $command->queryColumn();
                    $id_report_type = $reader[sizeof($reader) - 1];
                    if($id_report_type) {
                        $command = Yii::app()->db->createCommand('select id_report from report where id_rep_type = '.$id_report_type.' and id_est = '.$school);
                        $id_report = $command->queryScalar();
                        if($id_report) {
                            $command = Yii::app()->db->createCommand('select nas_punkt_type, nas_punkt, street_type, street, dom, korpus, dir_name, dir_par, dir_sur, cod_phone, phone, cod_fax, fax, mail, site, publ, samo, akkr, lic, ustav from contact_info where id_report = '.$id_report);
                            $report = $command->queryRow();
                            if($report) {
                                $this->render('report', array('report'=>$report, 'school_name'=>$school_name, 'type' =>$type, 'id_raion' => $id_raion, 'school_name_a' => $school_name_a));
                            }
                            else throw new CHttpException(403,'У Вас нет необходимых прав');
                        }
                        else throw new CHttpException(403,'У Вас нет необходимых прав');
                    }
                    else throw new CHttpException(403,'У Вас нет необходимых прав');
                }
                else throw new CHttpException(403,'У Вас нет необходимых прав');
           }
           else $this->redirect(Yii::app()->user->returnUrl);
        }
        
        public function actionUpo_index()
	{
                $command = Yii::app()->db->createCommand('select est_name, id_est from est where type_adm = 2');
                $raions = $command->queryAll();
                $k = 0;
                foreach($raions as $raion) {
                    $reader = 0;
                    //$command = Yii::app()->db->createCommand('select count(id_est) from est where (id_type = 5 or id_type = 4) and id_raion ='.$raion['id_est']);
                    $reader = Yii::app()->db->createCommand('select count(id_est) from est where id_type = 5 and status = 1 and id_raion ='.$raion['id_est'])->queryScalar();
                    if($reader){
                        $raion_upo[$k]['id_est'] = $raion['id_est'];
                        $raion_upo[$k]['est_name'] = $raion['est_name'];
                        $k = $k + 1;
                    }
                }
                $this->render('upo_index', array('raions'=>$raion_upo));                
	}        
        
        public function actionUpo_type($id_raion) {
                $raion = (int)$id_raion;
                $raions = Yii::app()->db->createCommand('select id_est from est where type_adm = 2')->queryColumn();
                if(in_array($raion, $raions)) {
                    $name = Yii::app()->db->createCommand('select est_name from est where id_est = '.$raion)->queryScalar();
                    $spo = Yii::app()->db->createCommand('select est_name, id_est from est where type_adm = 0 and status = 1 and id_type = 5 and id_raion = '.$raion)->queryAll();
                    $this->render('upo_type', array('name'=>$name, 'spo'=>$spo));
                }
                else throw new CHttpException(403,'У Вас нет необходимых прав');
        }
        
        /*public function actionUpo_report2($id_school) {
                $school = (int)$id_school;
                $schools = Yii::app()->db->createCommand('select id_est from est where type_adm = 0')->queryColumn();
                //$this->render('report', array('report'=>$schools));
                if(in_array($school, $schools)) {
                    $school_name_a = Yii::app()->db->createCommand('select pid_est, id_raion, est_name from est where id_est = '.$school)->queryRow();
                    $school_name = $school_name_a['est_name'];
                    $id_raion = Yii::app()->db->createCommand('select est_name from est where id_est = '.$school_name_a['id_raion'])->queryScalar();
                    $type = Yii::app()->db->createCommand('select est_name from est where id_est = '.$school_name_a['pid_est'])->queryScalar();
                    $reader = Yii::app()->db->createCommand('select id_rep_type from rep_name where rep_type = 1 and archive is null order by id_rep_type desc')->queryColumn();
                    $id_report_type = $reader[sizeof($reader) - 1];
                    if($id_report_type) {
                        $id_report = Yii::app()->db->createCommand('select id_report from report where id_rep_type = '.$id_report_type.' and id_est = '.$school)->queryScalar();
                        if($id_report) {
                            $report = Yii::app()->db->createCommand('select nas_punkt_type, nas_punkt, street_type, street, dom, korpus, dir_name, dir_par, dir_sur, cod_phone, phone, cod_fax, fax, mail, site, publ, akkr, lic, ustav from contact_info where id_report = '.$id_report)->queryRow();
                            if($report) {
                                $this->render('upo_report', array('report'=>$report, 'school_name'=>$school_name, 'type' =>$type, 'id_raion' => $id_raion, 'school_name_a' => $school_name_a));
                            }
                            else throw new CHttpException(403,'У Вас нет необходимых прав');
                        }
                        else throw new CHttpException(403,'У Вас нет необходимых прав');
                    }
                    else throw new CHttpException(403,'У Вас нет необходимых прав');
                }
                else throw new CHttpException(403,'У Вас нет необходимых прав');
        }*/

        public function actionUpo_report($id_school) {
            $school = (int)$id_school;
            $real = Yii::app()->db->createCommand('select count(id_est) as c_est, est_name, id_raion from est where status = 1 and id_type = 5 and id_est = '.$school)->queryRow();            
            if(!$real['c_est']) throw new CHttpException(403,'У Вас нет необходимых прав');
            $raion = Yii::app()->db->createCommand('select id_est, est_name from est where id_est = '.$real['id_raion'])->queryRow();
            $id_rep_type = 39;
            $id_report = Yii::app()->db->createCommand('select id_report from report where id_rep_type = '.$id_rep_type.' and id_est = '.$school)->queryScalar();
            if(!$id_report) throw new CHttpException(403,'У Вас нет необходимых прав');
            $report = Yii::app()->db->createCommand('select nas_punkt_type, nas_punkt, street_type, street, dom, korpus, dir_name, dir_par, dir_sur, cod_phone, phone, cod_fax, fax, mail, site from contact_info where id_report = '.$id_report)->queryRow();
            $this->render('upo_report2', array('report'=>$report, 'school_name'=>$real['est_name'], 'raion' => $raion));
        }        

	/**
	 * This is the action to handle external exceptions.
	 */
	public function actionError()
	{
	    if($error=Yii::app()->errorHandler->error)
	    {
	    	if(Yii::app()->request->isAjaxRequest)
	    		echo $error['message'];
	    	else
	        	$this->render('error', $error);
	    }
	}


	/**
	 * Displays the login page
	 */
	public function actionLogin()
	{
		$model=new LoginForm;

		// if it is ajax validation request
		if(isset($_POST['ajax']) && $_POST['ajax']==='login-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}

		// collect user input data
		if(isset($_POST['LoginForm']))
		{
			$model->attributes=$_POST['LoginForm'];
			// validate user input and redirect to the previous page if valid
			if($model->validate() && $model->login()) {
                            //$this->redirect(Yii::app()->user->returnUrl);
                            $pers = Yii::app()->db->createCommand('select pers from user where user_id = "'.Yii::app()->session['id'].'"')->queryScalar();
                            if(!$pers) $this->redirect(array('pers'));                            
                            elseif(Yii::app()->session['stat_only']) $this->redirect('index.php?r=stat/index');
                            else $this->redirect('index.php?r=site/tree');
                        }
		}
		// display the login form
		$this->render('login',array('model'=>$model));
	}
        
        public function actionPers() {
            $model = new PersForm();
            if(isset($_POST['PersForm']))
            {                
                $model->attributes=$_POST['PersForm'];
                if($model->validate()) {
                    Yii::app()->db->createCommand('update user set pers = 1, pers_data = NOW() where user_id = "'.Yii::app()->session['id'].'"')->execute();
                    $this->redirect(array('index'));
                }    
            }
            // рендерим представление
            $this->render('pers',array('model'=>$model));            
        }         

	/**
	 * Logs out the current user and redirect to homepage.
	 */
	public function actionLogout()
	{
		Yii::app()->user->logout();
		$this->redirect(Yii::app()->homeUrl);
	}

        public function actionTree()
        {
                if (Yii::app()->session['type_adm'] > 0) {
                    $this->render('tree');

                }
                else {
                    $this->redirect('index.php?r=site/cabinet&id='.Yii::app()->session['est']);
                }
        }

        public function actionAjaxFillTree()
        {
            // если пробуют получить прямой доступ к экшину (не через ajax)
            // тогда обрубаем "крылья")) т.е. возвращаем белую страницу

            if (!Yii::app()->request->isAjaxRequest) {
                exit();
            }

            // с какого узла начинаем вывод дерева? 0 - с первого
            if (isset($_GET['root']) && $_GET['root'] != 'source') {
                // переменная $_GET['root'] говорит нам о том, по какому узлу в дереве
                // кликнули. Исходя из этого получаем данные детей (подкатегорий)
                $parentId = (int) $_GET['root'];
                $req = Yii::app()->db->createCommand(
                "SELECT m1.id_est as id, m1.est_name AS text, m1.type_adm as type_adm, m2.id_est IS NOT NULL AS hasChildren, m1.cab_status AS cab"
                ." FROM est AS m1 LEFT JOIN est AS m2 ON m1.id_est=m2.pid_est"
                ." WHERE m1.pid_est <=> $parentId and m1.status != 0"
                ." GROUP BY m1.id_est ORDER BY m1.est_name ASC"
                );
            }
            else {
                $parentId = Yii::app()->session['est'];
                $req = Yii::app()->db->createCommand(
                "SELECT m1.id_est as id, m1.est_name AS text, m1.type_adm as type_adm, m2.id_est IS NOT NULL AS hasChildren, m1.cab_status AS cab"
                ." FROM est AS m1 LEFT JOIN est AS m2 ON m1.id_est=m2.pid_est"
                ." WHERE m1.id_est <=> $parentId"
                ." GROUP BY m1.id_est ORDER BY m1.est_name ASC"
                );
            }
            // сам запрос на получение данных детей (через обычный LEFT JOIN)
            $children = $req->queryAll();
            for($n = 0; $n < sizeof($children); $n++) {
                if($children[$n]['cab'] != 0) {
                    if (Yii::app()->session['type_adm'] == 4) {                                             
                        if(!$children[$n]['type_adm']) $children[$n]['text'] = '<div class="stroka"><span id="s_'.$children[$n]['id'].'">'.$children[$n]['text'].'</span><a href="index.php?r=site/cabinet&id='.$children[$n]['id'].'" style="float:right"><img src="./images/blog.png" /></a>'.CHtml::link('<img src="./images/blueprint.png" />', 'javascript:edit('.$children[$n]['id'].')', array('class'=>'edit_tree', 'style'=>'float:right;')).'</div>';
                        else $children[$n]['text'] = '<div class="stroka">'.$children[$n]['text'].'<a href="index.php?r=site/cabinet&id='.$children[$n]['id'].'" style="float:right"><img src="./images/blog.png" /></a></div>';
                    }
                    else {
                        if (Yii::app()->params['edit_est']) {
                            if(!$children[$n]['type_adm']) $children[$n]['text'] = '<div class="stroka"><span id="s_'.$children[$n]['id'].'">'.$children[$n]['text'].'</span><a href="index.php?r=site/cabinet&id='.$children[$n]['id'].'" style="float:right"><img src="./images/blog.png" /></a>'.CHtml::link('<img src="./images/blueprint.png" />', 'javascript:edit('.$children[$n]['id'].')', array('class'=>'edit_tree', 'style'=>'float:right;')).'</div>';
                            else $children[$n]['text'] = '<div class="stroka">'.$children[$n]['text'].'<a href="index.php?r=site/cabinet&id='.$children[$n]['id'].'" style="float:right"><img src="./images/blog.png" /></a></div>';
                        }              
                        else $children[$n]['text'] = '<div class="stroka">'.$children[$n]['text'].'<a href="index.php?r=site/cabinet&id='.$children[$n]['id'].'" style="float:right"><img src="./images/blog.png" /></a></div>';
                    }
                }
                else {
                    if(($children[$n]['type_adm'] == 1) && (Yii::app()->session['type_adm'] == 4)) $children[$n]['text'] = '<div class="stroka">'.$children[$n]['text'].'<a href="index.php?r=site/add_est&id='.$children[$n]['id'].'" style="float:right"><i class="icon-plus"></i></div>';
                    else $children[$n]['text'] = '<div class="stroka">'.$children[$n]['text'].'</div>';
                }    
            }
            // возвращаем данные
            echo str_replace(
                '"hasChildren":"0"',
                '"hasChildren":false',
                CTreeView::saveDataAsJson($children)
            );
            exit();
        }
        
        public function actionAdd_est($id) {
            $pid_est = $this->loadEst($id);
            
            $model = new Est;                
            $model->pid_est = $pid_est->id_est;
            $model->type_adm = 0;
            $model->status = $pid_est->status;
            $model->cab_status = 1;
            $model->id_okr = $pid_est->id_okr;
            $model->id_raion = $pid_est->id_raion;
            $model->id_type = $pid_est->id_type;

            // Uncomment the following line if AJAX validation is needed
            // $this->performAjaxValidation($model);

            if(isset($_POST['Est']))
            {
                $model->attributes=$_POST['Est'];
                if($model->save()) $this->redirect(array('site/tree'));
            }
            
            $this->render('add_est', array('model'=>$model));
        }
        
        
        protected function loadEst($id_est)
        {
            $model = Est::model()->findByPk((int)$id_est);
            if($model === null) throw new CHttpException(404,'The requested page does not exist.');
            return $model;
        }          

        public function actionCabinet($id) {
            $id_est = (int)$id;
            if(in_array($id_est, Yii::app()->session['pid'])) {
                $est = Est::model()->find('id_est=?', array($id_est));
                if(!$est->cab_status || !$est->status) throw new CHttpException(403,'У Вас нет необходимых прав');
                if ($id_est == Yii::app()->session['est']) {
                    $user[0] = array(Yii::app()->session['id'], Yii::app()->session['fio'], 1);
                    $user_add = 0;
                    if($est->type_adm > 2) {$otchet_stat = 1;}
                    //блок касающийся вывода списка отчетов
                    for($m = 0; $m < 4; $m++){
                        $req = Yii::app()->db->createCommand('SELECT
                                report.id_report,
                                report.status,
                                rep_name.rep_name,
                                rep_name.rep_mv,
                                DATE_FORMAT(rep_name.s_date, "%d.%m.%Y") AS s_date,
                                DATE_FORMAT(rep_name.f_date, "%d.%m.%Y") AS f_date
                                FROM
                                report,
                                rep_name
                                WHERE
                                rep_name.archive is null and
                                report.status < 6 and
                                rep_name.date_type = '.$m.' and
                                report.id_rep_type = rep_name.id_rep_type and 
                                report.id_est='.$id_est);
                        $reports[$m] = $req->queryAll();
                        if(sizeof($reports[$m])) {
                            for($n = 0; $n < sizeof($reports[$m]); $n++) {
                                if($reports[$m][$n]['status'] > 3) $reports[$m][$n]['deistv'] = array(0,0,0,0,0,0);
                                //elseif($reports[$m][$n]['status'] == 2) $reports[$m][$n]['deistv'] = array(1,1,0,0,0,0);
                                else $reports[$m][$n]['deistv'] = array(1,0,0,0,0,0);
                            }
                        }
                    }
                    $video = $this->bbb_check();
                }
                else {
                    if($est->type_adm > 2) $otchet_stat = 1 ;
                    //блок касающийся вывода данных по отчетам
                   for($m = 0; $m < 4; $m++){
                       if(Yii::app()->session['type_adm'] == 3) {
                           $req = Yii::app()->db->createCommand('SELECT
                                    report.id_report,
                                    report.status,
                                    rep_name.rep_name,
                                    rep_name.rep_mv,
                                    DATE_FORMAT(rep_name.s_date, "%d.%m.%Y") AS s_date,
                                    DATE_FORMAT(rep_name.f_date, "%d.%m.%Y") AS f_date
                                    FROM
                                    report,
                                    rep_name
                                    WHERE
                                    rep_name.archive is null and
                                    report.status < 6 and
                                    rep_name.date_type = '.$m.' and
                                    report.id_rep_type = rep_name.id_rep_type and 
                                    report.id_est='.$id_est);
                        }
                        else {
                            $req = Yii::app()->db->createCommand('SELECT
                                    report.id_report,
                                    report.status,
                                    rep_name.rep_name,
                                    rep_name.rep_mv,
                                    DATE_FORMAT(rep_name.s_date, "%d.%m.%Y") AS s_date,
                                    DATE_FORMAT(rep_name.f_date, "%d.%m.%Y") AS f_date
                                    FROM
                                    report,
                                    rep_name
                                    WHERE
                                    rep_name.archive is null and
                                    rep_name.date_type = '.$m.' and
                                    report.id_rep_type = rep_name.id_rep_type and
                                    report.id_est='.$id_est);
                        }
                        $reports[$m] = $req->queryAll();
                        if(sizeof($reports[$m])) {
                            if(Yii::app()->session['type_adm'] == 3) {
                                for($n = 0; $n < sizeof($reports[$m]); $n++) {
                                    if($reports[$m][$n]['status'] == 1) $reports[$m][$n]['deistv'] = array(1,0,1,0,0,0);
                                    elseif($reports[$m][$n]['status'] == 2 || $reports[$m][$n]['status'] == 3) $reports[$m][$n]['deistv'] = array(1,1,1,0,0,0);
                                    elseif($reports[$m][$n]['status'] == 4) $reports[$m][$n]['deistv'] = array(1,0,1,1,0,0);
                                    elseif($reports[$m][$n]['status'] == 5) $reports[$m][$n]['deistv'] = array(0,0,0,0,0,0);
                                }
                            }
                            elseif(Yii::app()->session['type_adm'] == 4){
                                for($n = 0; $n < sizeof($reports[$m]); $n++) {
                                    if($reports[$m][$n]['status'] < 4) $reports[$m][$n]['deistv'] = array(1,0,1,0,1,0);
                                    elseif($reports[$m][$n]['status'] == 4) $reports[$m][$n]['deistv'] = array(1,0,1,1,0,0);
                                    elseif($reports[$m][$n]['status'] == 5) $reports[$m][$n]['deistv'] = array(1,0,1,0,1,0);
                                    else $reports[$m][$n]['deistv'] = array(1,0,1,0,0,1);;
                                }
                            }
                            else throw new CHttpException(403,'У Вас нет необходимых прав');
                        }
                    }
                    //это для генерации данных по пользователю
                    $command = Yii::app()->db->createCommand('select user_id, surname, name, patronymic from user where id_est="'.$id_est.'"');
                    $dataReader=$command->query();
                    foreach($dataReader as $row) {
                        $user[] = array($row['user_id'], $row['surname'].' '.$row['name'].' '.$row['patronymic'], 0);
                    }
                    $user_add = 1;
                }
                if(!$est->type_adm) {
                    $pred = Yii::app()->db->createCommand('select contact_info.uch_status, contact_info.site, report.status from contact_info, report where contact_info.id_report = report.id_report and report.id_rep_type = 39 and report.id_est = '.$id_est)->queryRow();
                    if(($pred['status'] > 1) && !$pred['uch_status'] && $pred['site']) $pred_res = 1;
                    else $pred_res = 0;
                }
                else $pred_res = 2;
                $this->render('cabinet', array('name'=> Est::model()->find('id_est=?', array($id_est))->est_name, 'users'=>$user, 'user_add'=>$user_add, 'id_est'=>$id_est , 'reports'=> $reports, 'otchet_stat' => $otchet_stat, 'video'=>$video, 'pred_res'=>$pred_res));
            }
            else {
              throw new CHttpException(403,'У Вас нет необходимых прав');
            }
        }

        public function actionFill_est() {
            if (!Yii::app()->request->isAjaxRequest) {
                exit();
            }
            if(isset($_POST['data'])) {
                $id = (int) $_POST['data'];
                $command = Yii::app()->db->createCommand('select est_name from est where id_est='.$id);
                $reader_est = $command->queryScalar();
                echo $reader_est;
             }

        }
        public function actionEst_check() {
            if (!Yii::app()->request->isAjaxRequest) {
                exit();
            }
            if(isset($_POST['id']) && isset($_POST['name'])) {
                $id = (int) $_POST['id'];
                $est_name = $_POST['name'];
                if(in_array($id, Yii::app()->session['pid'])) {
                    if(preg_match('/^[а-яА-Я0-9№,\.\-\s\"\«\»\(\)]+$/u', $est_name)) {
                        $command = Yii::app()->db->createCommand("update est set est_name ='".$est_name."' where id_est=".$id);
                        $reader_est = $command->execute();
                        echo true;
                    }
                    else echo false;
                }
                else echo false;
             }

        }
        
        public function actionBbb_join($meetingid) {
            $model = Bbb::model()->findByPk((int)$meetingid, 'active = 1');
            if($model) {
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
            else throw new CHttpException(400,'Доступ запрещен');
            
        }
        
        protected function bbb_check() {
            $command = Yii::app()->db->createCommand('select meetingID as id, name, moderator, attendee from bbb where active = 1');
            $datas = $command->queryAll();
            $k = 0;
            foreach($datas as $data) {
                $mod = explode('##', $data['moderator']);
                $att = explode('##', $data['attendee']);
                if(in_array(Yii::app()->session['est'], $mod) || in_array(Yii::app()->session['est'], $att)) {
                    $bbb[$k]['id'] = $data['id'];
                    $bbb[$k]['name'] = $data['name'];
                    $k = $k + 1;
                }                
            }
            if(sizeof($bbb)) {
                $video = new CArrayDataProvider($bbb, array(  
                    'pagination' => array(  
                        'pageSize' => 200,  
                    ),  
                ));
                return $video;
            }
            else return false;
        }
        
        protected function geocoder($naim) {
            $params = array(
                'geocode' => $naim, // адрес
                'format'  => 'json',                          // формат ответа
                'results' => 1,                               // количество выводимых результатов
            );
            $response = json_decode(file_get_contents('http://geocode-maps.yandex.ru/1.x/?'.http_build_query($params, '', '&')));

            if ($response->response->GeoObjectCollection->metaDataProperty->GeocoderResponseMetaData->found > 0)
            {
                return explode(' ', $response->response->GeoObjectCollection->featureMember[0]->GeoObject->Point->pos);
            }
            else
            {
                return false;
            }  
        }
}