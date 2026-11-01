<?php

class OsnController extends Controller
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
                'accessControl + index, osn_upr, osn_uch, podr_mun, det_upr, det_raion, excel'
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
                        temp,
                        voda,
                        tualet,
                        vihod,
                        provoda,
                        stolovaya,
                        sportzal,
                        signal,
                        ohrana,
                        kompclass > 0,
                        fizika,
                        himia,
                        territoria,
                        gorpitanie,
                        kompsert > 0,
                        proektor > 0,                        
                        lpo,                        
                        fizika_lab,
                        himia_lab,
                        bio_lab,
                        geokarta,
                        hiskarta,
                        internet,
                        teacher,
                        profil,
                        klass,
                        director
                        FROM osn
                        WHERE
                        id_report = '.$rep_reader[$i][$k]);
                        $reader = array_sum($command->queryRow());
                        switch ($reader) {
                            case 27:
                                $okrug[$i]['sovr']++;
                                $oblast['sovr']++;
                                break;
                            case 26:
                                $okrug[$i]['sovr']++;
                                $oblast['sovr']++;
                                break;
                            case 25:
                                $okrug[$i]['sovr']++;
                                $oblast['sovr']++;
                                break;
                            case 24:
                                $okrug[$i]['sovr_1']++;
                                $oblast['sovr_1']++;
                                break;
                            case 23:
                                $okrug[$i]['sovr_2']++;
                                $oblast['sovr_2']++;
                                break;
                            case 22:
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
                                temp,
                                voda,
                                tualet,
                                vihod,
                                provoda,
                                stolovaya,
                                sportzal,
                                signal,
                                ohrana,
                                kompclass > 0,
                                fizika,
                                himia,
                                territoria,
                                gorpitanie,
                                kompsert > 0,
                                proektor > 0,
                                lpo,
                                fizika_lab,
                                himia_lab,
                                bio_lab,
                                geokarta,
                                hiskarta,
                                internet,
                                teacher,
                                profil,
                                klass,
                                director
                                FROM osn
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
                                temp,
                                voda,
                                tualet,
                                vihod,
                                provoda,
                                stolovaya,
                                sportzal,
                                signal,
                                ohrana,
                                kompclass,
                                fizika,
                                himia,
                                territoria,
                                gorpitanie,
                                medkabinet,
                                kompsert,
                                proektor,
                                doska,
                                lpo,
                                atletica,
                                fizika_lab,
                                himia_lab,
                                bio_lab,
                                geokarta,
                                hiskarta,
                                internet,
                                teacher,
                                profil,
                                klass,
                                director
                                FROM osn
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
                    $raion[$i]['kol'] = count($rep_reader[$i]);
                    $oblast['kol']+=count($rep_reader[$i]);
                    for($k = 0; $k < sizeof($rep_reader[$i]); $k++) {
                        $command = Yii::app()->db->createCommand('
                        SELECT
                        temp,
                        voda,
                        tualet,
                        vihod,
                        provoda,
                        stolovaya,
                        sportzal,
                        signal,
                        ohrana,
                        kompclass > 0,
                        fizika,
                        himia,
                        territoria,
                        gorpitanie,
                        kompsert > 0,
                        proektor > 0,
                        lpo,
                        fizika_lab,
                        himia_lab,
                        bio_lab,
                        geokarta,
                        hiskarta,
                        internet,
                        teacher,
                        profil,
                        klass,
                        director
                        FROM osn
                        WHERE
                        id_report = '.$rep_reader[$i][$k]);
                        $reader = array_sum($command->queryRow());
                        switch ($reader) {
                            case 27:
                                $raion[$i]['sovr']++;
                                $oblast['sovr']++;
                                break;
                            case 26:
                                $raion[$i]['sovr']++;
                                $oblast['sovr']++;
                                break;
                            case 25:
                                $raion[$i]['sovr']++;
                                $oblast['sovr']++;
                                break;
                            case 24:
                                $raion[$i]['sovr_1']++;
                                $oblast['sovr_1']++;
                                break;
                            case 23:
                                $raion[$i]['sovr_2']++;
                                $oblast['sovr_2']++;
                                break;
                            case 22:
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
                    $command = Yii::app()->db->createCommand('select count(osn.id_report) from osn, report, est where 
                        osn.id_report = report.id_report 
                        and report.id_rep_type = '.$id_rep_type.'
                        and report.id_est = est.id_est
                        and est.id_okr = '.$okrug[$i]['id_est']);
                    $okrug[$i]['col'] = $command->queryScalar();
                    $command = Yii::app()->db->createCommand('select 
                            sum(osn.temp) as temp,
                            sum(osn.voda) as voda,
                            sum(osn.tualet) as tualet,
                            sum(osn.vihod) as vihod,
                            sum(osn.provoda) as provoda,
                            sum(osn.stolovaya) as stolovaya,
                            sum(osn.sportzal) as sportzal,
                            sum(osn.signal) as signal,
                            sum(osn.ohrana) as ohrana,
                            sum(osn.kompclass) as kompclass,
                            sum(osn.fizika) as fizika,
                            sum(osn.himia) as himia,
                            sum(osn.territoria) as territoria,
                            sum(osn.gorpitanie) as gorpitanie,
                            sum(osn.medkabinet) as medkabinet,
                            sum(osn.kompsert) as kompsert,
                            sum(osn.proektor) as proektor,
                            sum(osn.doska) as doska,
                            sum(osn.lpo) as lpo,
                            sum(osn.atletica) as atletica,
                            sum(osn.fizika_lab) as fizika_lab,
                            sum(osn.himia_lab) as himia_lab,
                            sum(osn.bio_lab) as bio_lab,
                            sum(osn.geokarta) as geokarta,
                            sum(osn.hiskarta) as hiskarta,
                            sum(osn.internet) as internet,
                            sum(osn.teacher) as teacher,
                            sum(osn.profil) as profil,
                            sum(osn.klass) as klass,
                            sum(osn.director) as director
                            from osn, report, est where
                            osn.id_report = report.id_report 
                            and report.id_rep_type = '.$id_rep_type.'
                            and report.id_est = est.id_est
                            and est.id_okr = '.$okrug[$i]['id_est']);
                    $data = $command->queryAll();
                    $okrug[$i] = $okrug[$i] + $data;
                }
                $command = Yii::app()->db->createCommand('select count(osn.id_report) from osn, report where 
                    osn.id_report = report.id_report 
                    and report.id_rep_type = '.$id_rep_type);
                $oblast['col'] = $command->queryScalar();
                $command = Yii::app()->db->createCommand('select 
                        sum(osn.temp) as temp,
                        sum(osn.voda) as voda,
                        sum(osn.tualet) as tualet,
                        sum(osn.vihod) as vihod,
                        sum(osn.provoda) as provoda,
                        sum(osn.stolovaya) as stolovaya,
                        sum(osn.sportzal) as sportzal,
                        sum(osn.signal) as signal,
                        sum(osn.ohrana) as ohrana,
                        sum(osn.kompclass) as kompclass,
                        sum(osn.fizika) as fizika,
                        sum(osn.himia) as himia,
                        sum(osn.territoria) as territoria,
                        sum(osn.gorpitanie) as gorpitanie,
                        sum(osn.medkabinet) as medkabinet,
                        sum(osn.kompsert) as kompsert,
                        sum(osn.proektor) as proektor,
                        sum(osn.doska) as doska,
                        sum(osn.lpo) as lpo,
                        sum(osn.atletica) as atletica,
                        sum(osn.fizika_lab) as fizika_lab,
                        sum(osn.himia_lab) as himia_lab,
                        sum(osn.bio_lab) as bio_lab,
                        sum(osn.geokarta) as geokarta,
                        sum(osn.hiskarta) as hiskarta,
                        sum(osn.internet) as internet,
                        sum(osn.teacher) as teacher,
                        sum(osn.profil) as profil,
                        sum(osn.klass) as klass,
                        sum(osn.director) as director
                        from osn, report where
                        osn.id_report = report.id_report 
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
                    $command = Yii::app()->db->createCommand('select count(osn.id_report) from osn, report, est where 
                        osn.id_report = report.id_report 
                        and report.id_rep_type = '.$id_rep_type.'
                        and report.id_est = est.id_est
                        and est.id_raion = '.$raion[$i]['id_est']);
                    $raion[$i]['col'] = $command->queryScalar();
                    $command = Yii::app()->db->createCommand('select 
                            sum(osn.temp) as temp,
                            sum(osn.voda) as voda,
                            sum(osn.tualet) as tualet,
                            sum(osn.vihod) as vihod,
                            sum(osn.provoda) as provoda,
                            sum(osn.stolovaya) as stolovaya,
                            sum(osn.sportzal) as sportzal,
                            sum(osn.signal) as signal,
                            sum(osn.ohrana) as ohrana,
                            sum(osn.kompclass) as kompclass,
                            sum(osn.fizika) as fizika,
                            sum(osn.himia) as himia,
                            sum(osn.territoria) as territoria,
                            sum(osn.gorpitanie) as gorpitanie,
                            sum(osn.medkabinet) as medkabinet,
                            sum(osn.kompsert) as kompsert,
                            sum(osn.proektor) as proektor,
                            sum(osn.doska) as doska,
                            sum(osn.lpo) as lpo,
                            sum(osn.atletica) as atletica,
                            sum(osn.fizika_lab) as fizika_lab,
                            sum(osn.himia_lab) as himia_lab,
                            sum(osn.bio_lab) as bio_lab,
                            sum(osn.geokarta) as geokarta,
                            sum(osn.hiskarta) as hiskarta,
                            sum(osn.internet) as internet,
                            sum(osn.teacher) as teacher,
                            sum(osn.profil) as profil,
                            sum(osn.klass) as klass,
                            sum(osn.director) as director
                            from osn, report, est where
                            osn.id_report = report.id_report 
                            and report.id_rep_type = '.$id_rep_type.'
                            and report.id_est = est.id_est
                            and est.id_raion = '.$raion[$i]['id_est']);
                    $data = $command->queryAll();
                    $raion[$i] = $raion[$i] + $data;
                }
                $command = Yii::app()->db->createCommand('select count(osn.id_report) from osn, report where 
                    osn.id_report = report.id_report 
                    and report.id_rep_type = '.$id_rep_type);
                $oblast['col'] = $command->queryScalar();
                $command = Yii::app()->db->createCommand('select 
                        sum(osn.temp) as temp,
                        sum(osn.voda) as voda,
                        sum(osn.tualet) as tualet,
                        sum(osn.vihod) as vihod,
                        sum(osn.provoda) as provoda,
                        sum(osn.stolovaya) as stolovaya,
                        sum(osn.sportzal) as sportzal,
                        sum(osn.signal) as signal,
                        sum(osn.ohrana) as ohrana,
                        sum(osn.kompclass) as kompclass,
                        sum(osn.fizika) as fizika,
                        sum(osn.himia) as himia,
                        sum(osn.territoria) as territoria,
                        sum(osn.gorpitanie) as gorpitanie,
                        sum(osn.medkabinet) as medkabinet,
                        sum(osn.kompsert) as kompsert,
                        sum(osn.proektor) as proektor,
                        sum(osn.doska) as doska,
                        sum(osn.lpo) as lpo,
                        sum(osn.atletica) as atletica,
                        sum(osn.fizika_lab) as fizika_lab,
                        sum(osn.himia_lab) as himia_lab,
                        sum(osn.bio_lab) as bio_lab,
                        sum(osn.geokarta) as geokarta,
                        sum(osn.hiskarta) as hiskarta,
                        sum(osn.internet) as internet,
                        sum(osn.teacher) as teacher,
                        sum(osn.profil) as profil,
                        sum(osn.klass) as klass,
                        sum(osn.director) as director
                        from osn, report where
                        osn.id_report = report.id_report 
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
                            osn.temp as temp,
                            osn.voda as voda,
                            osn.tualet as tualet,
                            osn.vihod as vihod,
                            osn.provoda as provoda,
                            osn.stolovaya as stolovaya,
                            osn.sportzal as sportzal,
                            osn.signal as signal,
                            osn.ohrana as ohrana,
                            osn.kompclass as kompclass,
                            osn.fizika as fizika,
                            osn.himia as himia,
                            osn.territoria as territoria,
                            osn.gorpitanie as gorpitanie,
                            osn.medkabinet as medkabinet,
                            osn.kompsert as kompsert,
                            osn.proektor as proektor,
                            osn.doska as doska,
                            osn.lpo as lpo,
                            osn.atletica as atletica,
                            osn.fizika_lab as fizika_lab,
                            osn.himia_lab as himia_lab,
                            osn.bio_lab as bio_lab,
                            osn.geokarta as geokarta,
                            osn.hiskarta as hiskarta,
                            osn.internet as internet,
                            osn.teacher as teacher,
                            osn.profil as profil,
                            osn.klass as klass,
                            osn.director as director
                            from osn, report, est where
                            osn.id_report = report.id_report 
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
                            osn.temp as temp,
                            osn.voda as voda,
                            osn.tualet as tualet,
                            osn.vihod as vihod,
                            osn.provoda as provoda,
                            osn.stolovaya as stolovaya,
                            osn.sportzal as sportzal,
                            osn.signal as signal,
                            osn.ohrana as ohrana,
                            osn.kompclass as kompclass,
                            osn.fizika as fizika,
                            osn.himia as himia,
                            osn.territoria as territoria,
                            osn.gorpitanie as gorpitanie,
                            osn.medkabinet as medkabinet,
                            osn.kompsert as kompsert,
                            osn.proektor as proektor,
                            osn.doska as doska,
                            osn.lpo as lpo,
                            osn.atletica as atletica,
                            osn.fizika_lab as fizika_lab,
                            osn.himia_lab as himia_lab,
                            osn.bio_lab as bio_lab,
                            osn.geokarta as geokarta,
                            osn.hiskarta as hiskarta,
                            osn.internet as internet,
                            osn.teacher as teacher,
                            osn.profil as profil,
                            osn.klass as klass,
                            osn.director as director
                            from osn, report, est where
                            osn.id_report = report.id_report 
                            and report.id_est = est.id_est
                            and report.id_rep_type ='.$id_rep_type.'
                            and est.id_okr = '.Yii::app()->session['est']);
                    $data = $command->queryAll();
                }
                for($i=0; $i <sizeof($data); $i++) {
                    $data[$i]['id_okr'] = $okrug[$data[$i]['id_okr']];
                    $data[$i]['id_raion'] = $raion[$data[$i]['id_raion']];
                }
                $pokaz = Osn::model()->attributeLabels();
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
                $aSheet->getStyle('A2:AG2')->getFont()->setBold(true);
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
                header('Content-Disposition: attachment;filename="osn.xls"');
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