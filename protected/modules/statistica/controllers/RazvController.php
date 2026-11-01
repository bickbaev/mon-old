<?php

class RazvController extends Controller
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
                'accessControl + index, razv_upr, podr_mun'
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
                $oblast['kol'] = 0;
                $oblast['razv'] = 0;
                $oblast['razv_11'] = 0;
                $oblast['razv_12'] = 0;
                $oblast['razv_13'] = 0;
                $oblast['razv_14'] = 0;
                $oblast['razv_15'] = 0;
                $oblast['sovet'] = 0;
                $oblast['expert'] = 0;
                for($i = 0; $i < sizeof($okrug); $i++) {
                    $command = Yii::app()->db->createCommand('
                        SELECT report.id_report
                        FROM report
                        INNER JOIN est
                        ON report.id_est = est.id_est
                        WHERE report.id_rep_type = '.$id_rep_type.' and est.id_okr = '.$okrug[$i]['id_est']);
                    $rep_reader[$i] = $command->queryColumn();
                    $okrug[$i]['razv'] = 0;
                    $okrug[$i]['razv_11'] = 0;
                    $okrug[$i]['razv_12'] = 0;
                    $okrug[$i]['razv_13'] = 0;
                    $okrug[$i]['razv_14'] = 0;
                    $okrug[$i]['razv_15'] = 0;
                    $okrug[$i]['sovet'] = 0;
                    $okrug[$i]['expert'] = 0;
                    $okrug[$i]['kol'] = count($rep_reader[$i]);
                    $oblast['kol']=$oblast['kol'] + $okrug[$i]['kol'];
                    for($k = 0; $k < sizeof($rep_reader[$i]); $k++) {
                        $command = Yii::app()->db->createCommand('
                        SELECT
                        program,
                        s_year,
                        f_year,
                        sogl,
                        expert
                        FROM razv
                        WHERE
                        id_report = '.$rep_reader[$i][$k]);
                        $reader = $command->queryRow();
                        if($reader['program']) {
                            $okrug[$i]['razv']+=1;
                            $oblast['razv']+=1;
                        }
                        if($reader['f_year'] == '2012') {
                            $okrug[$i]['razv_11']+=1;
                            $oblast['razv_11']+=1;
                        }
                        if($reader['f_year'] == '2013') {
                            $okrug[$i]['razv_12']+=1;
                            $oblast['razv_12']+=1;
                        }
                        if($reader['f_year'] == '2014') {
                            $okrug[$i]['razv_13']+=1;
                            $oblast['razv_13']+=1;
                        }
                        if($reader['f_year'] == '2015') {
                            $okrug[$i]['razv_14']+=1;
                            $oblast['razv_14']+=1;
                        }
                        if($reader['f_year'] > '2015') {
                            $okrug[$i]['razv_15']+=1;
                            $oblast['razv_15']+=1;
                        }
                        if($reader['sogl']) {
                            $okrug[$i]['sovet']+=1;
                            $oblast['sovet']+=1;
                        }
                        if($reader['expert']) {
                            $okrug[$i]['expert']+=1;
                            $oblast['expert']+=1;
                        }
                    }
                }
                $this->render('index', array('okrug' => $okrug, 'id_rep_type' => $id_rep_type, 'otchet' => $otchet, 'oblast' => $oblast));
          }
          else $this->redirect(Yii::app()->user->returnUrl);
        }
        public function actionRazv_upr()
	{
            if (isset($_GET['id_okr']) && $_GET['id_okr'] != '') {
                $id_okr = (int) $_GET['id_okr'];
                $id_rep_type = (int) $_GET['id_rep_type'];
                $command = Yii::app()->db->createCommand('select rep_name, DATE_FORMAT(s_date, "%d.%m.%Y") AS s_date, DATE_FORMAT(f_date, "%d.%m.%Y") AS f_date from rep_name where id_rep_type ='.$id_rep_type);
                $otchet = $command->queryRow();
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
                                program,
                                s_year,
                                f_year,
                                sogl,
                                DATE_FORMAT(sogl_date, "%d.%m.%Y") as sogl_date,
                                naim_sogl,
                                expert,
                                expert_fio,
                                expert_dol,
                                DATE_FORMAT(expert_date, "%d.%m.%Y") as expert_date,
                                expert_mesto
                                FROM razv
                                WHERE
                                id_report = '.$raion[$i]['reports'][$k]['id_report']);
                            $raion[$i]['reports'][$k]['report'] = $command->queryAll();;
                        }
                }
                $this->render('razv_upr', array('raion' => $raion, 'id_rep_type' => $id_rep_type, 'okrug' => $okrug, 'otchet'=> $otchet));
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
                $oblast['kol'] = 0;
                $oblast['razv'] = 0;
                $oblast['sovet'] = 0;
                $oblast['expert'] = 0;
                for($i = 0; $i < sizeof($raion); $i++) {
                    $command = Yii::app()->db->createCommand('
                        SELECT report.id_report
                        FROM report
                        INNER JOIN est
                        ON report.id_est = est.id_est
                        WHERE report.id_rep_type = '.$id_rep_type.' and est.id_raion = '.$raion[$i]['id_est']);
                    $rep_reader[$i] = $command->queryColumn();
                    $raion[$i]['razv'] = 0;
                    $raion[$i]['sovet'] = 0;
                    $raion[$i]['expert'] = 0;
                    $raion[$i]['kol'] = count($rep_reader[$i]);
                    $oblast['kol']+=count($rep_reader[$i]);
                    for($k = 0; $k < sizeof($rep_reader[$i]); $k++) {
                        $command = Yii::app()->db->createCommand('
                        SELECT
                        program,
                        s_year,
                        f_year,
                        sogl,
                        expert
                        FROM razv
                        WHERE
                        id_report = '.$rep_reader[$i][$k]);
                        $reader = $command->queryRow();
                        if($reader['program']) {
                            $raion[$i]['razv']+=1;
                            $oblast['razv']+=1;
                        }
                        if($reader['sogl']) {
                            $raion[$i]['sovet']+=1;
                            $oblast['sovet']+=1;
                        }
                        if($reader['expert']) {
                            $raion[$i]['expert']+=1;
                            $oblast['expert']+=1;
                        }
                    }
                }
                $this->render('podr_mun', array('raion' => $raion, 'id_rep_type' => $id_rep_type, 'otchet' => $otchet, 'oblast' => $oblast));
          }
          else $this->redirect(Yii::app()->user->returnUrl);
        }

        public function actionRazv_excel() {
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
                            razv.program as program,
                            razv.s_year as s_year,
                            razv.f_year as f_year,
                            razv.sogl as sogl,
                            razv.sogl_date as sogl_date,
                            razv.naim_sogl as naim_sogl,
                            razv.expert as expert,
                            razv.expert_fio as expert_fio,
                            razv.expert_dol as expert_dol,
                            razv.expert_date as expert_date,
                            razv.expert_mesto as expert_mesto
                            from razv, report, est where
                            razv.id_report = report.id_report
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
                            razv.program as program,
                            razv.s_year as s_year,
                            razv.f_year as f_year,
                            razv.sogl as sogl,
                            razv.sogl_date as sogl_date,
                            razv.naim_sogl as naim_sogl,
                            razv.expert as expert,
                            razv.expert_fio as expert_fio,
                            razv.expert_dol as expert_dol,
                            razv.expert_date as expert_date,
                            razv.expert_mesto as expert_mesto
                            from razv, report, est where
                            razv.id_report = report.id_report
                            and report.id_est = est.id_est
                            and report.id_rep_type ='.$id_rep_type.'
                            and est.id_okr = '.Yii::app()->session['est']);
                    $data = $command->queryAll();
                }
                for($i=0; $i <sizeof($data); $i++) {
                    $data[$i]['id_okr'] = $okrug[$data[$i]['id_okr']];
                    $data[$i]['id_raion'] = $raion[$data[$i]['id_raion']];
                }
                $pokaz = Razv::model()->attributeLabels();
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
                $aSheet->setTitle('Программы развития');
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
                $aSheet->getStyle('A2:AB2')->getFont()->setBold(true);
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
                header('Content-Disposition: attachment;filename="razv.xls"');
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
