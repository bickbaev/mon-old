<?php

class Raiting_list_ouController extends Controller
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
                'accessControl + index, excel'
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
                $oblast['per_1'] = 0;
                $oblast['per_2'] = 0;
                $oblast['kol'] = 0;
                for($i = 0; $i < sizeof($okrug); $i++) {
                    $command = Yii::app()->db->createCommand('
                        SELECT report.id_report
                        FROM report
                        INNER JOIN est
                        ON report.id_est = est.id_est
                        WHERE report.id_rep_type = '.$id_rep_type.' and est.id_okr = '.$okrug[$i]['id_est']);
                    $rep_reader[$i] = $command->queryColumn();
                    $okrug[$i]['per_1'] = 0;
                    $okrug[$i]['per_2'] = 0;
                    $okrug[$i]['kol'] = count($rep_reader[$i]);
                    $oblast['kol']+=count($rep_reader[$i]);
                    for($k = 0; $k < sizeof($rep_reader[$i]); $k++) {
                        $command = Yii::app()->db->createCommand('
                        SELECT
                        pok1_1,
                        pok1_2,
                        pok1_3,
                        pok1_4,
                        pok1_5,
                        pok1_6,
                        pok1_7,
                        pok1_8,
                        pok1_9,
                        pok1_10,
                        pok1_11,
                        pok2_1,
                        pok2_2,
                        pok2_3,
                        pok2_4,
                        pok2_5,
                        pok2_6,
                        pok2_7,
                        pok2_8,
                        pok2_9,
                        pok2_10,
                        pok3_1,
                        pok3_2,
                        pok3_3,
                        pok3_4,
                        pok3_5,
                        pok3_6,
                        pok3_7,
                        pok4_1,
                        pok4_2,
                        pok4_3,
                        pok4_4,
                        pok4_5,
                        pok5_1,
                        pok5_2,
                        pok5_3,
                        pok5_4,
                        pok5_5,
                        pok5_6,
                        pok6_1,
                        pok6_2,
                        pok6_3,
                        pok6_4,
                        pok6_5,
                        pok6_6,
                        pok7_1,
                        pok7_2,
                        pok7_3,
                        pok7_4,
                        pok7_5,
                        pok7_6,
                        pok7_7,
                        pok7_8,
                        pok7_9,
                        pok7_10
                        FROM raiting_list_ou
                        WHERE
                        id_report = '.$rep_reader[$i][$k]);
                        $reader = array_sum($command->queryRow());
                        if($reader>=33.5 || $reader <=44.5) {
                                $okrug[$i]['per_1']++;
                                $oblast['per_1']++;
                        }
                        if($reader>=45) {
                                $okrug[$i]['per_2']++;
                                $oblast['per_2']++;
                        }
                    }
                }
                $this->render('index', array('okrug' => $okrug, 'id_rep_type' => $id_rep_type, 'otchet' => $otchet, 'oblast' => $oblast));
          }
          else $this->redirect(Yii::app()->user->returnUrl);
        }

        public function actionRaiting_list_upr()	{
            if (isset($_GET['id_okr']) && $_GET['id_okr'] != '') {
                $id_okr = (int) $_GET['id_okr'];
                $id_rep_type = (int) $_GET['id_rep_type'];
                $command = Yii::app()->db->createCommand('select est_name from est where type_adm = 3 and id_okr='.$id_okr);
                $okrug['est_name'] = $command->queryScalar();
                $command = Yii::app()->db->createCommand('select id_est, est_name from est where type_adm = 2 and id_okr='.$id_okr);
                $raion = $command->queryAll();
                $rep_reader = array();
                $okrug['per_1'] = 0;
                $okrug['per_2'] = 0;
                $okrug['kol'] = 0;
                for($i = 0; $i < sizeof($raion); $i++) {
                        $command = Yii::app()->db->createCommand('SELECT est.id_est, est.est_name, report.id_report
                        FROM report
                        INNER JOIN est
                        ON report.id_est = est.id_est
                        WHERE report.id_rep_type = '.$id_rep_type.' and est.id_raion = '.$raion[$i]['id_est']);
                        $raion[$i]['reports'] = $command->queryAll();
                        $raion[$i]['per_1'] = 0;
                        $raion[$i]['per_2'] = 0;
                        $raion[$i]['kol'] = count($rep_reader[$i]);
                        $okrug['kol']+=count($rep_reader[$i]);
                        for($k = 0; $k < sizeof($raion[$i]['reports']); $k++) {
                            $command = Yii::app()->db->createCommand('
                                SELECT
                                pok1_1,
                                pok1_2,
                                pok1_3,
                                pok1_4,
                                pok1_5,
                                pok1_6,
                                pok1_7,
                                pok1_8,
                                pok1_9,
                                pok1_10,
                                pok1_11,
                                pok2_1,
                                pok2_2,
                                pok2_3,
                                pok2_4,
                                pok2_5,
                                pok2_6,
                                pok2_7,
                                pok2_8,
                                pok2_9,
                                pok2_10,
                                pok3_1,
                                pok3_2,
                                pok3_3,
                                pok3_4,
                                pok3_5,
                                pok3_6,
                                pok3_7,
                                pok4_1,
                                pok4_2,
                                pok4_3,
                                pok4_4,
                                pok4_5,
                                pok5_1,
                                pok5_2,
                                pok5_3,
                                pok5_4,
                                pok5_5,
                                pok5_6,
                                pok6_1,
                                pok6_2,
                                pok6_3,
                                pok6_4,
                                pok6_5,
                                pok6_6,
                                pok7_1,
                                pok7_2,
                                pok7_3,
                                pok7_4,
                                pok7_5,
                                pok7_6,
                                pok7_7,
                                pok7_8,
                                pok7_9,
                                pok7_10
                                FROM raiting_list_ou
                                WHERE
                                id_report = '.$raion[$i]['reports'][$k]['id_report']);
                            $raion[$i]['reports'][$k]['sum'] = array_sum($command->queryRow());
                            if($reader>=33.5 || $reader <=44.5) {
                                    $raion[$i]['per_1']++;
                                    $okrug['per_1']++;
                            }
                            if($reader>=45) {
                                    $raion[$i]['per_2']++;
                                    $okrug['per_2']++;
                            }
                        }
                }
                $this->render('raiting_list_upr', array('raion' => $raion, 'id_rep_type' => $id_rep_type, 'okrug' => $okrug));
            }
            else $this->redirect(Yii::app()->user->returnUrl);
        }
        
        public function actionExcel() {
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
                            raiting_list_ou.pok1_1,
                            raiting_list_ou.pok1_2,
                            raiting_list_ou.pok1_3,
                            raiting_list_ou.pok1_4,
                            raiting_list_ou.pok1_5,
                            raiting_list_ou.pok1_6,
                            raiting_list_ou.pok1_7,
                            raiting_list_ou.pok1_8,
                            raiting_list_ou.pok1_9,
                            raiting_list_ou.pok1_10,
                            raiting_list_ou.pok1_11,
                            raiting_list_ou.pok2_1,
                            raiting_list_ou.pok2_2,
                            raiting_list_ou.pok2_3,
                            raiting_list_ou.pok2_4,
                            raiting_list_ou.pok2_5,
                            raiting_list_ou.pok2_6,
                            raiting_list_ou.pok2_7,
                            raiting_list_ou.pok2_8,
                            raiting_list_ou.pok2_9,
                            raiting_list_ou.pok2_10,
                            raiting_list_ou.pok3_1,
                            raiting_list_ou.pok3_2,
                            raiting_list_ou.pok3_3,
                            raiting_list_ou.pok3_4,
                            raiting_list_ou.pok3_5,
                            raiting_list_ou.pok3_6,
                            raiting_list_ou.pok3_7,
                            raiting_list_ou.pok4_1,
                            raiting_list_ou.pok4_2,
                            raiting_list_ou.pok4_3,
                            raiting_list_ou.pok4_4,
                            raiting_list_ou.pok4_5,
                            raiting_list_ou.pok5_1,
                            raiting_list_ou.pok5_2,
                            raiting_list_ou.pok5_3,
                            raiting_list_ou.pok5_4,
                            raiting_list_ou.pok5_5,
                            raiting_list_ou.pok5_6,
                            raiting_list_ou.pok6_1,
                            raiting_list_ou.pok6_2,
                            raiting_list_ou.pok6_3,
                            raiting_list_ou.pok6_4,
                            raiting_list_ou.pok6_5,
                            raiting_list_ou.pok6_6,
                            raiting_list_ou.pok7_1,
                            raiting_list_ou.pok7_2,
                            raiting_list_ou.pok7_3,
                            raiting_list_ou.pok7_4,
                            raiting_list_ou.pok7_5,
                            raiting_list_ou.pok7_6,
                            raiting_list_ou.pok7_7,
                            raiting_list_ou.pok7_8,
                            raiting_list_ou.pok7_9,
                            raiting_list_ou.pok7_10
                            from raiting_list_ou, report, est where
                            raiting_list_ou.id_report = report.id_report
                            and report.id_est = est.id_est
                            and report.id_rep_type ='.$id_rep_type);
                    $data = $command->queryAll();
                }
                for($i=0; $i <sizeof($data); $i++) {
                    $data[$i]['id_okr'] = $okrug[$data[$i]['id_okr']];
                    $data[$i]['id_raion'] = $raion[$data[$i]['id_raion']];                
                }
                $pokaz = Raiting_list_ou::model()->attributeLabels();
                array_shift($pokaz);
                $dabavka = array('id_okr'=>'Округ', 'id_raion'=>'Район', 'est_name'=>'Учреждение');
                $pokaz = $dabavka + $pokaz;
                //array_unshift($data, $pokaz);
                $zag = 'Отчет - '.$otchet['rep_name'].' период '.$otchet['s_date'].'-'.$otchet['f_date'];
                $phpExcelPath = '/var/www/mon/public_html/www/protected/vendors/phpexcel';
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
                $aSheet->setTitle('Лист оценивания СОШ');
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
                $aSheet->getStyle('A2:BJ2')->getFont()->setBold(true);
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
                header('Content-Disposition: attachment;filename="raiting_list_ou.xls"');
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