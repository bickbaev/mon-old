<?php

class ReportController extends Controller
{
	/**
	 * Declares class-based actions.
	 */
	public function actions()
	{

	}
        //block razb sprav
        public function filters()
        {
            return array(
                'accessControl + index, edit, prov, sogl, prin, dorab, view, stat, stat_podr, rep_isp, block, razb, sprav'
            );
        }

        function filterAccessControl($filterChain)
        {
            if (Yii::app()->user->isGuest) $this->redirect('index.php?r=site/login');
            elseif(Yii::app()->session['stat_only']) $this->redirect('index.php?r=stat/index');
            else $filterChain->run();
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

        public function actionEdit() {
            if (isset($_GET['id_rep']) && $_GET['id_rep'] != '') {
                $id_rep = (int) $_GET['id_rep'];
                $command = Yii::app()->db->createCommand('select report.id_est, report.status, rep_name.rep_mv, rep_name.rep_name, rep_name.rep_type, rep_name.s_date, rep_name.f_date from report, rep_name where rep_name.archive is null and report.id_rep_type = rep_name.id_rep_type and report.id_report='.$id_rep);
                $reader = $command->queryRow();
                if(is_array($reader) && in_array($reader['id_est'], Yii::app()->session['pid'])) {
                    if(Yii::app()->session['type_adm'] == 0 && $reader['status'] > 3) throw new CHttpException(403,'У Вас нет необходимых прав');
                    if(Yii::app()->session['type_adm'] == 3 && $reader['status'] > 4) throw new CHttpException(403,'У Вас нет необходимых прав');
                    $command = Yii::app()->db->createCommand('select complex from rep_type where rep_type = '.$reader['rep_type']); //проверка отчета на комплексность
                    $rep_type = $command->queryScalar();
                    if($rep_type) $this->redirect(array('/complex/'.$reader['rep_mv'].'/edit', 'id_rep'=>$id_rep));
                    $mv = $reader['rep_mv'];
                    eval('$model = '.ucfirst($mv).'::model()->findByPk('.$id_rep.');');                    
                    $command2 = Yii::app()->db->createCommand('select est_name from est where id_est = "'.$reader['id_est'].'"');
                    $est_name = $command2->queryScalar();
                    $mv_p = ucfirst($mv);
                    if (isset($_POST[$mv_p]) && isset($_POST[$mv_p]['id_report'])) {
                        $model->attributes=$_POST[$mv_p];
                        if($model->save()) {
                            $status = 2;
                            if($reader['status'] == 6) $status = 6; //для редактирования отчетов в статусе "принят" - например проверка сайтов
                            $command3 = Yii::app()->db->createCommand('update report set status = '.$status.' where id_report = '.$id_rep);
                            $command3->execute();
                            $this->redirect('index.php?r=site/cabinet&id='.$reader['id_est']);
                        }
                        //echo 'Hello';
                    }
                    $this->render($mv, array('model' => $model, 'rep_name'=>$reader['rep_name'], 's_date'=>$reader['s_date'], 'f_date'=>$reader['f_date'], 'est_name'=>$est_name, 'id_est'=>$reader['id_est']));
                }
                else throw new CHttpException(403,'У Вас нет необходимых прав');
            }
            else $this->redirect(Yii::app()->user->returnUrl);
        }

        /*public function actionProv() {
            if (isset($_GET['id_rep']) && $_GET['id_rep'] != '') {
                $id_rep = (int) $_GET['id_rep'];
                $command = Yii::app()->db->createCommand('select report.id_est, rep_name.rep_type, report.prov from report, rep_name where rep_name.archive is null and report.id_rep_type = rep_name.id_rep_type and report.id_report='.$id_rep);
                $reader = $command->queryRow();
                $command = Yii::app()->db->createCommand('select complex from rep_type where rep_type='.$reader['rep_type']);
                $complex = $command->queryScalar(); 
                if(($complex == 1) && ($reader['prov'] != 1)) throw new CHttpException(403,'У Вас нет необходимых прав');
                if(Yii::app()->session['est'] == $reader['id_est']) {
                    $command = Yii::app()->db->createCommand('update report set status = 4 where id_report = '.$id_rep);
                    $command->execute();
                    $this->redirect('index.php?r=site/cabinet&id='.$reader['id_est']);
                }
                else throw new CHttpException(403,'У Вас нет необходимых прав');
            }
            else $this->redirect(Yii::app()->user->returnUrl);
        }*/

        /*public function actionSogl() {
           if (isset($_GET['id_rep']) && $_GET['id_rep'] != '') {
                $id_rep = (int) $_GET['id_rep'];
                $command = Yii::app()->db->createCommand('select report.id_est from report, rep_name where rep_name.archive is null and report.id_rep_type = rep_name.id_rep_type and report.id_report='.$id_rep);
                $id_est = $command->queryScalar();
                if(in_array($id_est, Yii::app()->session['pid']) && Yii::app()->session['type_adm'] == 3) {
                    $command = Yii::app()->db->createCommand('update report set status = 5 where id_report = '.$id_rep);
                    $command->execute();
                    $this->redirect('index.php?r=site/cabinet&id='.$id_est);
                }
                else throw new CHttpException(403,'У Вас нет необходимых прав');
            }
            else $this->redirect(Yii::app()->user->returnUrl);
        }*/
        
        public function actionRazb() {
           if (isset($_GET['id_rep']) && $_GET['id_rep'] != '') {
                $id_rep = (int) $_GET['id_rep'];
                $command = Yii::app()->db->createCommand('select report.id_est from report, rep_name where rep_name.archive is null and report.id_rep_type = rep_name.id_rep_type and report.id_report='.$id_rep);
                $id_est = $command->queryScalar();
                if(in_array($id_est, Yii::app()->session['pid']) && Yii::app()->session['type_adm'] == 3) {
                    $command = Yii::app()->db->createCommand('update report set status = 2 where id_report = '.$id_rep);
                    $command->execute();
                    $this->redirect('index.php?r=site/cabinet&id='.$id_est);
                }
                else throw new CHttpException(403,'У Вас нет необходимых прав');
            }
            else $this->redirect(Yii::app()->user->returnUrl);
        }  
        
        public function actionBlock() {
           if (isset($_GET['id_rep']) && $_GET['id_rep'] != '') {
                $id_rep = (int) $_GET['id_rep'];
                $command = Yii::app()->db->createCommand('select report.id_est from report, rep_name where rep_name.archive is null and report.id_rep_type = rep_name.id_rep_type and report.id_report='.$id_rep);
                $id_est = $command->queryScalar();
                if(in_array($id_est, Yii::app()->session['pid']) && Yii::app()->session['type_adm'] == 3) {
                    $command = Yii::app()->db->createCommand('update report set status = 4 where id_report = '.$id_rep);
                    $command->execute();
                    $this->redirect('index.php?r=site/cabinet&id='.$id_est);
                }
                else throw new CHttpException(403,'У Вас нет необходимых прав');
            }
            else $this->redirect(Yii::app()->user->returnUrl);
        }        
        
        public function actionPrin() {
            if (isset($_GET['id_rep']) && $_GET['id_rep'] != '') {
                $id_rep = (int) $_GET['id_rep'];
                $command = Yii::app()->db->createCommand('select report.id_est from report, rep_name where rep_name.archive is null and report.id_rep_type = rep_name.id_rep_type and report.id_report='.$id_rep);
                $id_est = $command->queryScalar();
                if(in_array($id_est, Yii::app()->session['pid']) && Yii::app()->session['type_adm'] == 4) {
                    $command = Yii::app()->db->createCommand('update report set status = 6 where id_report = '.$id_rep);
                    $command->execute();
                    $this->redirect('index.php?r=site/cabinet&id='.$id_est);
                }
                else throw new CHttpException(403,'У Вас нет необходимых прав');
            }
            else $this->redirect(Yii::app()->user->returnUrl);
        }

        public function actionDorab() {
            if (isset($_GET['id_rep']) && $_GET['id_rep'] != '') {
                $id_rep = (int) $_GET['id_rep'];
                $command = Yii::app()->db->createCommand('select report.id_est, report.status from report, rep_name where rep_name.archive is null and report.id_rep_type = rep_name.id_rep_type and report.id_report='.$id_rep);
                $reader = $command->queryRow();
                if(Yii::app()->session['type_adm'] == 0) throw new CHttpException(403,'У Вас нет необходимых прав');
                if($reader['status'] > 4 && Yii::app()->session['type_adm'] != 4) throw new CHttpException(403,'У Вас нет необходимых прав');
                if(is_array($reader) && in_array($reader['id_est'], Yii::app()->session['pid']) && $reader['id_est'] != Yii::app()->session['est']) {
                    $command = Yii::app()->db->createCommand('update report set status = 3 where id_report = '.$id_rep);
                    $command->execute();
                    $this->redirect('index.php?r=site/cabinet&id='.$reader['id_est']);
                }
                else throw new CHttpException(403,'У Вас нет необходимых прав');
            }
            else $this->redirect(Yii::app()->user->returnUrl);
        }
        public function actionView() {
            if (isset($_GET['id_rep']) && $_GET['id_rep'] != '') {
                $id_rep = (int) $_GET['id_rep'];
                $command = Yii::app()->db->createCommand('select report.id_est, report.status, rep_name.rep_mv, rep_name.rep_name from report, rep_name where rep_name.archive is null and report.id_rep_type = rep_name.id_rep_type and report.id_report='.$id_rep);
                $reader = $command->queryRow();
                if(is_array($reader) && in_array($reader['id_est'], Yii::app()->session['pid']) && Yii::app()->session['type_adm'] == 4) {
                    $mv = $reader['rep_mv'];
                    eval('$model = '.ucfirst($mv).'::model()->findByPk('.$id_rep.');');
                    $command2 = Yii::app()->db->createCommand('select est_name from est where id_est = "'.$reader['id_est'].'"');
                    $est_name = $command2->queryScalar();
                    $mv_v = $mv.'_view';
                    $this->render($mv_v, array('model' => $model, 'rep_name'=>$reader['rep_name'], 'est_name'=>$est_name));
                }
                else throw new CHttpException(403,'У Вас нет необходимых прав');
            }
            else $this->redirect(Yii::app()->user->returnUrl);
        }

        public function actionStat() {
            if (isset($_GET['id_est']) && $_GET['id_est'] != '') {
                $id_est = (int) $_GET['id_est'];
                if(Yii::app()->session['type_adm'] < 3) $this->redirect(Yii::app()->user->returnUrl);
                if(in_array($id_est, Yii::app()->session['pid'])) {
                    $command = Yii::app()->db->createCommand('select type_adm from est where id_est = '.$id_est);
                    $type_adm = $command->queryScalar();
                    if($type_adm == 4) {
                        $command = Yii::app()->db->createCommand('select id_est from est');
                        $pid = $command->queryColumn();
                    }
                    elseif($type_adm == 3) {
                        $command = Yii::app()->db->createCommand('select id_est from est where id_okr = '.$id_est);
                        $pid = $command->queryColumn();
                    }
                    else throw new CHttpException(403,'У Вас нет необходимых прав');
                    $command = Yii::app()->db->createCommand('select id_rep_type, rep_name, DATE_FORMAT(s_date, "%d.%m.%Y") AS s_date, DATE_FORMAT(f_date, "%d.%m.%Y") AS f_date, date_type from rep_name where archive is null order by rep_type DESC');
                    $reports_type = $command->queryAll();
                    foreach ($reports_type as $key=>$report_type) {
                        $command = Yii::app()->db->createCommand('select id_est from report where id_rep_type = '.$report_type['id_rep_type']);
                        $report_est = $command->queryColumn();
                        if(sizeof(array_intersect($report_est, $pid))) {
                            $report_info[] = $report_type;
                        }
                    }
                    $this->render('stat', array('report'=>$report_info, 'id_est'=>$id_est));
                }
                else throw new CHttpException(403,'У Вас нет необходимых прав');
            }
            else $this->redirect(Yii::app()->user->returnUrl);
        }
        
        public function actionStat_podr() {
            if (isset($_GET['id_rep_type']) && $_GET['id_rep_type'] != '') {
                $id_rep_type = (int) $_GET['id_rep_type'];
                if(Yii::app()->session['type_adm'] < 3) $this->redirect(Yii::app()->user->returnUrl);
                if(isset($_GET['id_est']) && $_GET['id_est'] != '') {
                    $id_est = (int) $_GET['id_est'];
                    if(in_array($id_est, Yii::app()->session['pid'])) {
                        $command = Yii::app()->db->createCommand('select rep_name, DATE_FORMAT(s_date, "%d.%m.%Y") AS s_date, DATE_FORMAT(f_date, "%d.%m.%Y") AS f_date from rep_name where id_rep_type = '.$id_rep_type);
                        $report_name = $command->queryRow();
                        if($id_est == 1) {
                            $command = Yii::app()->db->createCommand('select id_est, est_name from est where pid_est = 1');
                            $ests = $command->queryAll();
                            for($k = 0; $k <sizeof($ests); $k++) {
                                $report[$k][0] = $ests[$k]['est_name'];
                                for($i = 1; $i < 7; $i++) {
                                    $command = Yii::app()->db->createCommand('select count(report.id_report) from report, est where report.id_est = est.id_est and report.id_rep_type = '.$id_rep_type.' and est.id_okr = '.$ests[$k]['id_est'].' and report.status = '.$i);
                                    $report[$k][$i] = $command->queryScalar();
                                }
                                $report[$k][8] = $ests[$k]['id_est'];
                            }
                            $this->render('stat_podr_obl', array('report'=>$report, 'id_rep_type' => $id_rep_type, 'report_name' => $report_name));
                        }
                        else {
                            $command = Yii::app()->db->createCommand('select id_est, est_name from est where pid_est = '.$id_est);
                            $ests = $command->queryAll();
                            for($k = 0; $k <sizeof($ests); $k++) {
                                $report[$k][0] = $ests[$k]['est_name'];
                                for($i = 1; $i < 7; $i++) {
                                    $command = Yii::app()->db->createCommand('select count(report.id_report) from report, est where report.id_est = est.id_est and report.id_rep_type = '.$id_rep_type.' and est.id_raion = '.$ests[$k]['id_est'].' and report.status = '.$i);
                                    $report[$k][$i] = $command->queryScalar();
                                }
                                $report[$k][8] = $ests[$k]['id_est'];
                            }
                            $this->render('stat_podr', array('report'=>$report, 'id_rep_type' => $id_rep_type, 'report_name' => $report_name));
                        }
                    }
                    else throw new CHttpException(403,'У Вас нет необходимых прав');
                }
                else $this->redirect(Yii::app()->user->returnUrl);
            }
            else $this->redirect(Yii::app()->user->returnUrl);
        }

        public function actionRep_isp() {
            if (isset($_GET['id_est']) && $_GET['id_est'] != '') {
                $id_est = (int) $_GET['id_est'];
                $status = (int) $_GET['status'];
                $id_rep_type = (int) $_GET['id_rep_type'];
                if ($status > 6 || $status < 1) $this->redirect(Yii::app()->user->returnUrl);
                if(Yii::app()->session['type_adm'] < 3) $this->redirect(Yii::app()->user->returnUrl);
                $command = Yii::app()->db->createCommand('select rep_name, DATE_FORMAT(rep_name.s_date, "%d.%m.%Y") AS s_date, DATE_FORMAT(rep_name.f_date, "%d.%m.%Y") AS f_date from rep_name where id_rep_type = '.$id_rep_type);
                $rep_name = $command->queryRow();
                if($rep_name['rep_name'] == '') $this->redirect(Yii::app()->user->returnUrl);
                if(in_array($id_est, Yii::app()->session['pid'])) {
                     $req = Yii::app()->db->createCommand('SELECT
                        report.id_report,
                        report.status,
                        est.est_name,
                        est.id_est
                        FROM
                        report,
                        rep_name,
                        est
                        WHERE
                        rep_name.archive is null and
                        report.status = '.$status.' and
                        report.id_rep_type = '.$id_rep_type.' and
                        report.id_rep_type = rep_name.id_rep_type and
                        report.id_est=est.id_est and
                        est.id_raion = '.$id_est);
                    $reports = $req->queryAll();
                    if(sizeof($reports)) {
                        if(Yii::app()->session['type_adm'] == 4) {
                            for($n = 0; $n < sizeof($reports); $n++) {
                                if($reports[$n]['status'] < 4) $reports[$n]['deistv'] = array(1,0,1,0,0,0);
                                elseif($reports[$n]['status'] == 4) $reports[$n]['deistv'] = array(1,0,1,1,0,0);
                                elseif($reports[$n]['status'] == 5) $reports[$n]['deistv'] = array(1,0,1,0,1,0);
                                else $reports[$n]['deistv'] = array(0,0,1,0,0,1);;
                            }
                        }
                        elseif(Yii::app()->session['type_adm'] == 3) {
                            for($n = 0; $n < sizeof($reports); $n++) {
                                //if($reports[$n]['status'] < 4) $reports[$n]['deistv'] = array(1,1,1,0,0,0);
                                if($reports[$n]['status'] == 1) $reports[$n]['deistv'] = array(1,0,1,0,0,0);
                                elseif($reports[$n]['status'] == 2 || $reports[$n]['status'] == 3) $reports[$n]['deistv'] = array(1,1,1,0,0,0);                                
                                elseif($reports[$n]['status'] == 4) $reports[$n]['deistv'] = array(1,0,1,1,0,0);
                                elseif($reports[$n]['status'] == 5) $reports[$n]['deistv'] = array(0,0,0,0,0,0);
                            }
                        }
                        else throw new CHttpException(403,'У Вас нет необходимых прав');
                    }
                    //else $this->redirect(Yii::app()->user->returnUrl);
                    $this->render('rep_isp', array('reports'=>$reports, 'rep_name'=>$rep_name));
                }
                else throw new CHttpException(403,'У Вас нет необходимых прав');
            }
            else $this->redirect(Yii::app()->user->returnUrl);
        }
        public function actionSprav() {
            if (isset($_GET['id_est']) && $_GET['id_est'] != '') {
                $id_est = (int) $_GET['id_est'];
                $command = Yii::app()->db->createCommand('select est_name, type_adm from est where id_est  = '.$id_est);
                $est_inf = $command->queryRow();
                if($est_inf['type_adm'] < 3) throw new CHttpException(403,'У Вас нет необходимых прав');
                if(Yii::app()->session['type_adm'] < 3)throw new CHttpException(403,'У Вас нет необходимых прав');
                if(in_array($id_est, Yii::app()->session['pid'])) {
                    if($id_est == 1) {
                        $command = Yii::app()->db->createCommand('select id_est, est_name from est where pid_est  = '.$id_est);
                        $ests = $command->queryAll();
                        for ($i = 0; $i <sizeof($ests); $i++) {
                            $command = Yii::app()->db->createCommand('select mail, name, patronymic, surname, reg_cod_phone, phone, reg_cod_mobile, mobile_phone from user where id_est  = '.$ests[$i]['id_est']);
                            $ests[$i]['oper'] = $command->queryAll();
                        }
                        $this->render('sprav_obl', array('ests' => $ests));
                    }
                     else {
                        for($i = 1; $i < 7; $i++) {
                            $command = Yii::app()->db->createCommand('select id_est, est_name from est where type_adm = 0 and id_okr = '.$id_est.' and id_type = '.$i);
                            $uch[$i] = $command->queryAll();
                            for ($k = 0; $k <sizeof($uch[$i]); $k++) {
                                $command = Yii::app()->db->createCommand('select mail, name, patronymic, surname, reg_cod_phone, phone, reg_cod_mobile, mobile_phone from user where id_est  = '.$uch[$i][$k]['id_est']);
                                $uch[$i][$k]['oper'] = $command->queryAll();
                            }
                        }
                        $this->render('sprav_upr', array('uch' => $uch, 'est_inf'=>$est_inf));
                    }
                }
                else throw new CHttpException(403,'У Вас нет необходимых прав');
            }
            else $this->redirect(Yii::app()->user->returnUrl);
        }
        
}