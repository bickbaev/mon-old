<?php

class Osn_douController extends Controller
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
                'accessControl + index, osn_upr, osn_uch'
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
          if (isset($_GET['id_rep_type']) && $_GET['id_rep_type'] != '') {
                $id_rep_type = (int) $_GET['id_rep_type'];
                $command = Yii::app()->db->createCommand('select rep_name, DATE_FORMAT(s_date, "%d.%m.%Y") AS s_date, DATE_FORMAT(f_date, "%d.%m.%Y") AS f_date from rep_name where id_rep_type ='.$id_rep_type);
                $otchet = $command->queryRow();
                $command = Yii::app()->db->createCommand('select id_est, est_name from est where type_adm = 3');
                $okrug = $command->queryAll();
                $rep_reader = array();
                $oblast['sovr'] = 0;
                $oblast['sovr_1'] = 0;
                $oblast['sovr_2'] = 0;
                $oblast['sovr_3'] = 0;
                $oblast['kol'] = 0;
                for($i = 0; $i < sizeof($okrug); $i++) {
                    $command = Yii::app()->db->createCommand('
                        SELECT report.id_report
                        FROM report
                        INNER JOIN est
                        ON report.id_est = est.id_est
                        WHERE report.id_rep_type = '.$id_rep_type.' and est.id_okr = '.$okrug[$i]['id_est']);
                    $rep_reader[$i] = $command->queryColumn();
                    $okrug[$i]['sovr'] = 0;
                    $okrug[$i]['sovr_1'] = 0;
                    $okrug[$i]['sovr_2'] = 0;
                    $okrug[$i]['sovr_3'] = 0;
                    $okrug[$i]['kol'] = count($rep_reader[$i]);
                    $oblast['kol']+=count($rep_reader[$i]);
                    for($k = 0; $k < sizeof($rep_reader[$i]); $k++) {
                        $command = Yii::app()->db->createCommand('
                        SELECT
                        grup,
                        fiz,
                        zem,
                        ozel,
                        ten,
                        med,
                        pandus,
                        zal,
                        pol,
                        obor,
                        didact > 0,
                        muz > 0,
                        igr,
                        po,
                        kanal,
                        krov,
                        osv,
                        lumen,
                        temp,
                        gor,
                        dezinf,
                        post,
                        pit,
                        mineral,
                        iod,
                        posuda,
                        pomesh,
                        pit1,
                        pozar,
                        electro,
                        signal,
                        ochrana,
                        inet,
                        vospit
                        FROM osn_dou
                        WHERE
                        id_report = '.$rep_reader[$i][$k]);
                        $reader = array_sum($command->queryRow());
                        switch ($reader) {
                            case 34:
                                $okrug[$i]['sovr']++;
                                $oblast['sovr']++;
                                break;
                            case 33:
                                $okrug[$i]['sovr']++;
                                $oblast['sovr']++;
                                break;
                            case 32:
                                $okrug[$i]['sovr']++;
                                $oblast['sovr']++;
                                break;
                            case 31:
                                $okrug[$i]['sovr']++;
                                $oblast['sovr']++;
                                break;
                            case 30:
                                $okrug[$i]['sovr']++;
                                $oblast['sovr']++;
                                break;
                            case 29:
                                $okrug[$i]['sovr']++;
                                $oblast['sovr']++;
                                break;
                            case 28:
                                $okrug[$i]['sovr']++;
                                $oblast['sovr']++;
                                break;
                            case 27:
                                $okrug[$i]['sovr']++;
                                $oblast['sovr']++;
                                break;
                            case 26:
                                $okrug[$i]['sovr_1']++;
                                $oblast['sovr_1']++;
                                break;
                            case 25:
                                $okrug[$i]['sovr_2']++;
                                $oblast['sovr_2']++;
                                break;
                            case 24:
                                $okrug[$i]['sovr_3']++;
                                $oblast['sovr_3']++;
                                break;
                            default:
                                break;
                        }

                    }
                }
                $this->render('index', array('okrug' => $okrug, 'id_rep_type' => $id_rep_type, 'otchet' => $otchet, 'oblast' => $oblast));
          }
          else $this->redirect(Yii::app()->user->returnUrl);
        }

        public function actionOsn_upr()	{
            if (isset($_GET['id_okr']) && $_GET['id_okr'] != '') {
                $id_okr = (int) $_GET['id_okr'];
                $id_rep_type = (int) $_GET['id_rep_type'];
                $command = Yii::app()->db->createCommand('select est_name from est where type_adm = 3 and id_okr='.$id_okr);
                $okrug = $command->queryScalar();
                $command = Yii::app()->db->createCommand('select id_est, est_name from est where type_adm = 2 and id_okr='.$id_okr);
                $raion = $command->queryAll();
                $rep_reader = array();
                for($i = 0; $i < sizeof($raion); $i++) {
                        $command = Yii::app()->db->createCommand('SELECT est.id_est, est.est_name, report.id_report
                        FROM report
                        INNER JOIN est
                        ON report.id_est = est.id_est
                        WHERE report.id_rep_type = '.$id_rep_type.' and est.id_raion = '.$raion[$i]['id_est']);
                        $raion[$i]['reports'] = $command->queryAll();
                        for($k = 0; $k < sizeof($raion[$i]['reports']); $k++) {
                            $command = Yii::app()->db->createCommand('
                                SELECT
                                grup,
                                fiz,
                                zem,
                                ozel,
                                ten,
                                med,
                                pandus,
                                zal,
                                pol,
                                obor,
                                didact > 0,
                                muz > 0,
                                igr,
                                po,
                                kanal,
                                krov,
                                osv,
                                lumen,
                                temp,
                                gor,
                                dezinf,
                                post,
                                pit,
                                mineral,
                                iod,
                                posuda,
                                pomesh,
                                pit1,
                                pozar,
                                electro,
                                signal,
                                ochrana,
                                inet,
                                vospit
                                FROM osn_dou
                                WHERE
                                id_report = '.$raion[$i]['reports'][$k]['id_report']);
                            $raion[$i]['reports'][$k]['sum'] = array_sum($command->queryRow());
                        }
                }
                $this->render('osn_upr', array('raion' => $raion, 'id_rep_type' => $id_rep_type, 'okrug' => $okrug));
            }
            else $this->redirect(Yii::app()->user->returnUrl);
        }

        public function actionOsn_uch()	{
            if (isset($_GET['id_est']) && $_GET['id_est'] != '') {
                $id_est = (int) $_GET['id_est'];
                $id_report = (int) $_GET['id_report'];
                $command = Yii::app()->db->createCommand('select est_name from est where id_est='.$id_est);
                $uch = $command->queryScalar();
                $command = Yii::app()->db->createCommand('
                                SELECT
                                grup,
                                fiz,
                                zem,
                                ozel,
                                ten,
                                med,
                                pandus,
                                zal,
                                pol,
                                obor,
                                didact,
                                muz,
                                igr,
                                po,
                                kanal,
                                krov,
                                osv,
                                lumen,
                                temp,
                                gor,
                                dezinf,
                                post,
                                pit,
                                mineral,
                                iod,
                                posuda,
                                pomesh,
                                pit1,
                                pozar,
                                electro,
                                signal,
                                ochrana,
                                inet,
                                vospit
                                FROM osn_dou
                                WHERE
                                id_report ='.$id_report);
                $report = $command->queryRow();
                $this->render('osn_uch', array('report'=>$report, 'uch' => $uch));
            }
            else $this->redirect(Yii::app()->user->returnUrl);
        }
        public function actionPodr_mun()
	{
          if (isset($_GET['id_rep_type']) && $_GET['id_rep_type'] != '') {
                $id_rep_type = (int) $_GET['id_rep_type'];
                $command = Yii::app()->db->createCommand('select rep_name, DATE_FORMAT(s_date, "%d.%m.%Y") AS s_date, DATE_FORMAT(f_date, "%d.%m.%Y") AS f_date from rep_name where id_rep_type ='.$id_rep_type);
                $otchet = $command->queryRow();
                $command = Yii::app()->db->createCommand('select id_est, est_name from est where type_adm = 2');
                $raion = $command->queryAll();
                $rep_reader = array();
                $oblast['sovr'] = 0;
                $oblast['sovr_1'] = 0;
                $oblast['sovr_2'] = 0;
                $oblast['sovr_3'] = 0;
                $oblast['kol'] = 0;
                for($i = 0; $i < sizeof($raion); $i++) {
                    $command = Yii::app()->db->createCommand('
                        SELECT report.id_report
                        FROM report
                        INNER JOIN est
                        ON report.id_est = est.id_est
                        WHERE report.id_rep_type = '.$id_rep_type.' and est.id_raion = '.$raion[$i]['id_est']);
                    $rep_reader[$i] = $command->queryColumn();
                    $raion[$i]['sovr'] = 0;
                    $raion[$i]['sovr_1'] = 0;
                    $raion[$i]['sovr_2'] = 0;
                    $raion[$i]['sovr_3'] = 0;
                    $raion[$i]['kol'] = count($rep_reader[$i]);
                    $oblast['kol']+=count($rep_reader[$i]);
                    for($k = 0; $k < sizeof($rep_reader[$i]); $k++) {
                        $command = Yii::app()->db->createCommand('
                        SELECT
                        grup,
                        fiz,
                        zem,
                        ozel,
                        ten,
                        med,
                        pandus,
                        zal,
                        pol,
                        obor,
                        didact > 0,
                        muz > 0,
                        igr,
                        po,
                        kanal,
                        krov,
                        osv,
                        lumen,
                        temp,
                        gor,
                        dezinf,
                        post,
                        pit,
                        mineral,
                        iod,
                        posuda,
                        pomesh,
                        pit1,
                        pozar,
                        electro,
                        signal,
                        ochrana,
                        inet,
                        vospit
                        FROM osn_dou
                        WHERE
                        id_report = '.$rep_reader[$i][$k]);
                        $reader = array_sum($command->queryRow());
                        switch ($reader) {
                            case 34:
                                $raion[$i]['sovr']++;
                                $oblast['sovr']++;
                                break;
                            case 33:
                                $raion[$i]['sovr']++;
                                $oblast['sovr']++;
                                break;
                            case 32:
                                $raion[$i]['sovr']++;
                                $oblast['sovr']++;
                                break;
                            case 31:
                                $raion[$i]['sovr']++;
                                $oblast['sovr']++;
                                break;
                            case 30:
                                $raion[$i]['sovr']++;
                                $oblast['sovr']++;
                                break;
                            case 29:
                                $raion[$i]['sovr']++;
                                $oblast['sovr']++;
                                break;
                            case 28:
                                $raion[$i]['sovr']++;
                                $oblast['sovr']++;
                                break;
                            case 27:
                                $raion[$i]['sovr']++;
                                $oblast['sovr']++;
                                break;
                            case 26:
                                $raion[$i]['sovr_1']++;
                                $oblast['sovr_1']++;
                                break;
                            case 25:
                                $raion[$i]['sovr_2']++;
                                $oblast['sovr_2']++;
                                break;
                            case 24:
                                $raion[$i]['sovr_3']++;
                                $oblast['sovr_3']++;
                                break;
                            default:
                                break;
                        }
                    }
                }
                $this->render('podr_mun', array('raion' => $raion, 'id_rep_type' => $id_rep_type, 'otchet' => $otchet, 'oblast' => $oblast));
          }
          else $this->redirect(Yii::app()->user->returnUrl);
        }
        
        public function actionDet_upr() {
            if (isset($_GET['id_rep_type']) && $_GET['id_rep_type'] != '') {
                $id_rep_type = (int) $_GET['id_rep_type'];
                $command = Yii::app()->db->createCommand('select rep_name, DATE_FORMAT(s_date, "%d.%m.%Y") AS s_date, DATE_FORMAT(f_date, "%d.%m.%Y") AS f_date from rep_name where id_rep_type ='.$id_rep_type);
                $otchet = $command->queryRow();
                $command = Yii::app()->db->createCommand('select id_est, est_name from est where type_adm = 3');
                $okrug = $command->queryAll();
                for($i = 0; $i < sizeof($okrug); $i++) {
                    $command = Yii::app()->db->createCommand('select count(osn_dou.id_report) from osn_dou, report, est where 
                        osn_dou.id_report = report.id_report 
                        and report.id_rep_type = '.$id_rep_type.'
                        and report.id_est = est.id_est
                        and est.id_okr = '.$okrug[$i]['id_est']);
                    $okrug[$i]['col'] = $command->queryScalar();
                    $command = Yii::app()->db->createCommand('select 
                            sum(osn_dou.grup) as grup,
                            sum(osn_dou.fiz) as fiz,
                            sum(osn_dou.zem) as zem,
                            sum(osn_dou.ozel) as ozel,
                            sum(osn_dou.ten) as ten,
                            sum(osn_dou.med) as med,
                            sum(osn_dou.pandus) as pandus,
                            sum(osn_dou.zal) as zal,
                            sum(osn_dou.pol) as pol,
                            sum(osn_dou.obor) as obor,
                            sum(osn_dou.didact) as didact,
                            sum(osn_dou.muz) as muz,
                            sum(osn_dou.igr) as igr,
                            sum(osn_dou.po) as po,
                            sum(osn_dou.kanal) as kanal,
                            sum(osn_dou.krov) as krov,
                            sum(osn_dou.osv) as osv,
                            sum(osn_dou.lumen) as lumen,
                            sum(osn_dou.temp) as temp,
                            sum(osn_dou.gor) as gor,
                            sum(osn_dou.dezinf) as dezinf,
                            sum(osn_dou.post) as post,
                            sum(osn_dou.pit) as pit,
                            sum(osn_dou.mineral) as mineral,
                            sum(osn_dou.iod) as iod,
                            sum(osn_dou.posuda) as posuda,
                            sum(osn_dou.pomesh) as pomesh,
                            sum(osn_dou.pit1) as pit1,
                            sum(osn_dou.pozar) as pozar,
                            sum(osn_dou.electro) as electro,
                            sum(osn_dou.signal) as signal,
                            sum(osn_dou.ochrana) as ochrana,
                            sum(osn_dou.inet) as inet,
                            sum(osn_dou.vospit) as vospit
                            from osn_dou, report, est where
                            osn_dou.id_report = report.id_report 
                            and report.id_rep_type = '.$id_rep_type.'
                            and report.id_est = est.id_est
                            and est.id_okr = '.$okrug[$i]['id_est']);
                    $data = $command->queryAll();
                    $okrug[$i] = $okrug[$i] + $data;
                }
                $command = Yii::app()->db->createCommand('select count(osn_dou.id_report) from osn_dou, report where 
                    osn_dou.id_report = report.id_report 
                    and report.id_rep_type = '.$id_rep_type);
                $oblast['col'] = $command->queryScalar();
                $command = Yii::app()->db->createCommand('select 
                        sum(osn_dou.grup) as grup,
                        sum(osn_dou.fiz) as fiz,
                        sum(osn_dou.zem) as zem,
                        sum(osn_dou.ozel) as ozel,
                        sum(osn_dou.ten) as ten,
                        sum(osn_dou.med) as med,
                        sum(osn_dou.pandus) as pandus,
                        sum(osn_dou.zal) as zal,
                        sum(osn_dou.pol) as pol,
                        sum(osn_dou.obor) as obor,
                        sum(osn_dou.didact) as didact,
                        sum(osn_dou.muz) as muz,
                        sum(osn_dou.igr) as igr,
                        sum(osn_dou.po) as po,
                        sum(osn_dou.kanal) as kanal,
                        sum(osn_dou.krov) as krov,
                        sum(osn_dou.osv) as osv,
                        sum(osn_dou.lumen) as lumen,
                        sum(osn_dou.temp) as temp,
                        sum(osn_dou.gor) as gor,
                        sum(osn_dou.dezinf) as dezinf,
                        sum(osn_dou.post) as post,
                        sum(osn_dou.pit) as pit,
                        sum(osn_dou.mineral) as mineral,
                        sum(osn_dou.iod) as iod,
                        sum(osn_dou.posuda) as posuda,
                        sum(osn_dou.pomesh) as pomesh,
                        sum(osn_dou.pit1) as pit1,
                        sum(osn_dou.pozar) as pozar,
                        sum(osn_dou.electro) as electro,
                        sum(osn_dou.signal) as signal,
                        sum(osn_dou.ochrana) as ochrana,
                        sum(osn_dou.inet) as inet,
                        sum(osn_dou.vospit) as vospit
                        from osn_dou, report where
                        osn_dou.id_report = report.id_report 
                        and report.id_rep_type = '.$id_rep_type);
                $data = $command->queryAll();
                $oblast = $oblast + $data;
                $this->render('det_upr', array('otchet' => $otchet, 'id_rep_type' => $id_rep_type, 'okrug' => $okrug, 'oblast' => $oblast));
            }
            else $this->redirect(Yii::app()->user->returnUrl);
        }
        public function actionDet_raion() {
            if (isset($_GET['id_rep_type']) && $_GET['id_rep_type'] != '') {
                $id_rep_type = (int) $_GET['id_rep_type'];
                $command = Yii::app()->db->createCommand('select rep_name, DATE_FORMAT(s_date, "%d.%m.%Y") AS s_date, DATE_FORMAT(f_date, "%d.%m.%Y") AS f_date from rep_name where id_rep_type ='.$id_rep_type);
                $otchet = $command->queryRow();
                $command = Yii::app()->db->createCommand('select id_est, est_name from est where type_adm = 2');
                $raion = $command->queryAll();
                for($i = 0; $i < sizeof($raion); $i++) {
                    $command = Yii::app()->db->createCommand('select count(osn_dou.id_report) from osn_dou, report, est where 
                        osn_dou.id_report = report.id_report 
                        and report.id_rep_type = '.$id_rep_type.'
                        and report.id_est = est.id_est
                        and est.id_raion = '.$raion[$i]['id_est']);
                    $raion[$i]['col'] = $command->queryScalar();
                    $command = Yii::app()->db->createCommand('select 
                            sum(osn_dou.grup) as grup,
                            sum(osn_dou.fiz) as fiz,
                            sum(osn_dou.zem) as zem,
                            sum(osn_dou.ozel) as ozel,
                            sum(osn_dou.ten) as ten,
                            sum(osn_dou.med) as med,
                            sum(osn_dou.pandus) as pandus,
                            sum(osn_dou.zal) as zal,
                            sum(osn_dou.pol) as pol,
                            sum(osn_dou.obor) as obor,
                            sum(osn_dou.didact) as didact,
                            sum(osn_dou.muz) as muz,
                            sum(osn_dou.igr) as igr,
                            sum(osn_dou.po) as po,
                            sum(osn_dou.kanal) as kanal,
                            sum(osn_dou.krov) as krov,
                            sum(osn_dou.osv) as osv,
                            sum(osn_dou.lumen) as lumen,
                            sum(osn_dou.temp) as temp,
                            sum(osn_dou.gor) as gor,
                            sum(osn_dou.dezinf) as dezinf,
                            sum(osn_dou.post) as post,
                            sum(osn_dou.pit) as pit,
                            sum(osn_dou.mineral) as mineral,
                            sum(osn_dou.iod) as iod,
                            sum(osn_dou.posuda) as posuda,
                            sum(osn_dou.pomesh) as pomesh,
                            sum(osn_dou.pit1) as pit1,
                            sum(osn_dou.pozar) as pozar,
                            sum(osn_dou.electro) as electro,
                            sum(osn_dou.signal) as signal,
                            sum(osn_dou.ochrana) as ochrana,
                            sum(osn_dou.inet) as inet,
                            sum(osn_dou.vospit) as vospit
                            from osn_dou, report, est where
                            osn_dou.id_report = report.id_report 
                            and report.id_rep_type = '.$id_rep_type.'
                            and report.id_est = est.id_est
                            and est.id_raion = '.$raion[$i]['id_est']);
                    $data = $command->queryAll();
                    $raion[$i] = $raion[$i] + $data;
                }
                $command = Yii::app()->db->createCommand('select count(osn_dou.id_report) from osn_dou, report where 
                    osn_dou.id_report = report.id_report 
                    and report.id_rep_type = '.$id_rep_type);
                $oblast['col'] = $command->queryScalar();
                $command = Yii::app()->db->createCommand('select 
                        sum(osn_dou.grup) as grup,
                        sum(osn_dou.fiz) as fiz,
                        sum(osn_dou.zem) as zem,
                        sum(osn_dou.ozel) as ozel,
                        sum(osn_dou.ten) as ten,
                        sum(osn_dou.med) as med,
                        sum(osn_dou.pandus) as pandus,
                        sum(osn_dou.zal) as zal,
                        sum(osn_dou.pol) as pol,
                        sum(osn_dou.obor) as obor,
                        sum(osn_dou.didact) as didact,
                        sum(osn_dou.muz) as muz,
                        sum(osn_dou.igr) as igr,
                        sum(osn_dou.po) as po,
                        sum(osn_dou.kanal) as kanal,
                        sum(osn_dou.krov) as krov,
                        sum(osn_dou.osv) as osv,
                        sum(osn_dou.lumen) as lumen,
                        sum(osn_dou.temp) as temp,
                        sum(osn_dou.gor) as gor,
                        sum(osn_dou.dezinf) as dezinf,
                        sum(osn_dou.post) as post,
                        sum(osn_dou.pit) as pit,
                        sum(osn_dou.mineral) as mineral,
                        sum(osn_dou.iod) as iod,
                        sum(osn_dou.posuda) as posuda,
                        sum(osn_dou.pomesh) as pomesh,
                        sum(osn_dou.pit1) as pit1,
                        sum(osn_dou.pozar) as pozar,
                        sum(osn_dou.electro) as electro,
                        sum(osn_dou.signal) as signal,
                        sum(osn_dou.ochrana) as ochrana,
                        sum(osn_dou.inet) as inet,
                        sum(osn_dou.vospit) as vospit
                        from osn_dou, report where
                        osn_dou.id_report = report.id_report 
                        and report.id_rep_type = '.$id_rep_type);
                $data = $command->queryAll();
                $oblast = $oblast + $data;
                $this->render('det_raion', array('otchet' => $otchet, 'id_rep_type' => $id_rep_type, 'raion' => $raion, 'oblast' => $oblast));
            }
            else $this->redirect(Yii::app()->user->returnUrl);
        }
        
        public function actionOsn_excel() {
            if (isset($_GET['id_rep_type']) && $_GET['id_rep_type'] != '') { 
                if(Yii::app()->session['type_adm'] < 3) $this->redirect(Yii::app()->user->returnUrl);
                $id_rep_type = (int) $_GET['id_rep_type'];
                $command = Yii::app()->db->createCommand('select rep_name, DATE_FORMAT(s_date, "%d.%m.%Y") AS s_date, DATE_FORMAT(f_date, "%d.%m.%Y") AS f_date from rep_name where id_rep_type ='.$id_rep_type);
                $otchet = $command->queryRow();
                $command = Yii::app()->db->createCommand('select id_est, est_name from est where type_adm = 3');
                $reader = $command->queryAll();
                foreach ($reader as $value) {
                    $okrug[$value['id_est']] = $value['est_name'];
                }
                $command = Yii::app()->db->createCommand('select id_est, est_name from est where type_adm = 2');
                $reader = $command->queryAll();
                foreach ($reader as $value) {
                    $raion[$value['id_est']] = $value['est_name'];
                }
                if(Yii::app()->session['type_adm'] == 4) { 
                    $command = Yii::app()->db->createCommand('select
                            est.id_okr as id_okr,
                            est.id_raion as id_raion,
                            est.est_name as est_name,
                            osn_dou.grup as grup,
                            osn_dou.fiz as fiz,
                            osn_dou.zem as zem,
                            osn_dou.ozel as ozel,
                            osn_dou.ten as ten,
                            osn_dou.med as med,
                            osn_dou.pandus as pandus,
                            osn_dou.zal as zal,
                            osn_dou.pol as pol,
                            osn_dou.obor as obor,
                            osn_dou.didact as didact,
                            osn_dou.muz as muz,
                            osn_dou.igr as igr,
                            osn_dou.po as po,
                            osn_dou.kanal as kanal,
                            osn_dou.krov as krov,
                            osn_dou.osv as osv,
                            osn_dou.lumen as lumen,
                            osn_dou.temp as temp,
                            osn_dou.gor as gor,
                            osn_dou.dezinf as dezinf,
                            osn_dou.post as post,
                            osn_dou.pit as pit,
                            osn_dou.mineral as mineral,
                            osn_dou.iod as iod,
                            osn_dou.posuda as posuda,
                            osn_dou.pomesh as pomesh,
                            osn_dou.pit1 as pit1,
                            osn_dou.pozar as pozar,
                            osn_dou.electro as electro,
                            osn_dou.signal as signal,
                            osn_dou.ochrana as ochrana,
                            osn_dou.inet as inet,
                            osn_dou.vospit as vospit
                            from osn_dou, report, est where
                            osn_dou.id_report = report.id_report 
                            and report.id_est = est.id_est
                            and report.id_rep_type ='.$id_rep_type);
                    $data = $command->queryAll();
                }
                else {
                    if(Yii::app()->session['parent'] != 1) $this->redirect(Yii::app()->user->returnUrl);
                    $command = Yii::app()->db->createCommand('select
                            est.id_okr as id_okr,
                            est.id_raion as id_raion,
                            est.est_name as est_name,
                            osn_dou.grup as grup,
                            osn_dou.fiz as fiz,
                            osn_dou.zem as zem,
                            osn_dou.ozel as ozel,
                            osn_dou.ten as ten,
                            osn_dou.med as med,
                            osn_dou.pandus as pandus,
                            osn_dou.zal as zal,
                            osn_dou.pol as pol,
                            osn_dou.obor as obor,
                            osn_dou.didact as didact,
                            osn_dou.muz as muz,
                            osn_dou.igr as igr,
                            osn_dou.po as po,
                            osn_dou.kanal as kanal,
                            osn_dou.krov as krov,
                            osn_dou.osv as osv,
                            osn_dou.lumen as lumen,
                            osn_dou.temp as temp,
                            osn_dou.gor as gor,
                            osn_dou.dezinf as dezinf,
                            osn_dou.post as post,
                            osn_dou.pit as pit,
                            osn_dou.mineral as mineral,
                            osn_dou.iod as iod,
                            osn_dou.posuda as posuda,
                            osn_dou.pomesh as pomesh,
                            osn_dou.pit1 as pit1,
                            osn_dou.pozar as pozar,
                            osn_dou.electro as electro,
                            osn_dou.signal as signal,
                            osn_dou.ochrana as ochrana,
                            osn_dou.inet as inet,
                            osn_dou.vospit as vospit
                            from osn_dou, report, est where
                            osn_dou.id_report = report.id_report 
                            and report.id_est = est.id_est
                            and report.id_rep_type ='.$id_rep_type.'
                            and est.id_okr = '.Yii::app()->session['est']);
                    $data = $command->queryAll();
                }
                for($i=0; $i <sizeof($data); $i++) {
                    $data[$i]['id_okr'] = $okrug[$data[$i]['id_okr']];
                    $data[$i]['id_raion'] = $raion[$data[$i]['id_raion']];
                }
                $pokaz = Osn_dou::model()->attributeLabels();
                array_shift($pokaz);
                $dabavka = array('id_okr'=>'Округ', 'id_raion'=>'Район', 'est_name'=>'Учреждение');
                $pokaz = $dabavka + $pokaz;
                //array_unshift($data, $pokaz);
                $zag = 'Отчет - '.$otchet['rep_name'].' период '.$otchet['s_date'].'-'.$otchet['f_date'];
                $phpExcelPath = '/var/www/cposo/data/www/mon.cposo.ru/protected/vendors/phpexcel';
                 // Turn off our amazing library autoload
                spl_autoload_unregister(array('YiiBase','autoload'));
                 //
                 // making use of our reference, include the main class
                 // when we do this, phpExcel has its own autoload registration
                 // procedure (PHPExcel_Autoloader::Register();)
                include($phpExcelPath . DIRECTORY_SEPARATOR . 'PHPExcel.php');
                //подключаем и создаем класс PHPExcel
                $pExcel = new PHPExcel();
                $pExcel->setActiveSheetIndex(0);
                $pExcel->getDefaultStyle()->getFont()->setName('Arial');
                $pExcel->getDefaultStyle()->getFont()->setSize(10); 
                $aSheet = $pExcel->getActiveSheet();
                $aSheet->setTitle('Оснащенность');
                $aSheet->getColumnDimension('A')->setWidth(25);
                $aSheet->getColumnDimension('B')->setWidth(25);
                $aSheet->getColumnDimension('C')->setWidth(25);
                $aSheet->setCellValue('A1',$zag);
                $aSheet->getStyle('A1')->getFont()->setBold(true);
                $i = 0;
                foreach ($pokaz as $value) {                
                    $aSheet->setCellValueByColumnAndRow($i, 2, $value);
                    $i = $i + 1;
                }
                $aSheet->getStyle('A2:AK2')->getFont()->setBold(true);
                $aSheet->getRowDimension('2')->setRowHeight(100);
                for($i = 0; $i < sizeof($data); $i++) {
                    $k = 0;
                    foreach ($data[$i] as $value) {                
                        $aSheet->setCellValueByColumnAndRow($k, ($i + 3), $value);
                        $k = $k + 1;
                    }
                }                   
                include($phpExcelPath . DIRECTORY_SEPARATOR.'PHPExcel/Writer/Excel5.php');
                $objWriter = new PHPExcel_Writer_Excel5($pExcel);
                header('Content-Type: application/vnd.ms-excel');
                header('Content-Disposition: attachment;filename="osn_dou.xls"');
                header('Cache-Control: max-age=0');
                $objWriter->save('php://output');
                spl_autoload_register(array('YiiBase','autoload'));
                /*$xls = new Excel_XML('UTF-8', false, 'osn');
                $xls->addArray($data);
                $xls->generateXML('osn');*/
            }
            else {
                header("Location: http://mon.cposo.ru/"); /* Redirect browser */
                exit;
            }
        }

}