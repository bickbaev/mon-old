<?php

class Profor_anketaController extends Controller
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
                $this->render('index', array('id_rep_type' => $id_rep_type, 'otchet' => $otchet));
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
                            profor_anketa.pok1_1 as pok1_1,
                            profor_anketa.pok1_2 as pok1_2,
                            profor_anketa.pok1_3 as pok1_3,
                            profor_anketa.pok1_4 as pok1_4,
                            profor_anketa.pok1_5 as pok1_5,
                            profor_anketa.pok1_6 as pok1_6,
                            profor_anketa.pok1_7 as pok1_7,
                            profor_anketa.pok1_8 as pok1_8,
                            profor_anketa.pok1_9 as pok1_9,
                            profor_anketa.pok1_10 as pok1_10,
                            profor_anketa.pok1_11 as pok1_11,
                            profor_anketa.pok2_1 as pok2_1,
                            profor_anketa.pok2_2 as pok2_2,
                            profor_anketa.pok2_3 as pok2_3,
                            profor_anketa.pok2_4 as pok2_4,
                            profor_anketa.pok2_5 as pok2_5,
                            profor_anketa.pok2_6 as pok2_6,
                            profor_anketa.pok2_7 as pok2_7,
                            profor_anketa.pok2_8 as pok2_8,
                            profor_anketa.pok2_9 as pok2_9,
                            profor_anketa.pok2_10 as pok2_10,
                            profor_anketa.pok2_11 as pok2_11,
                            profor_anketa.pok2_12 as pok2_12,
                            profor_anketa.pok2_13 as pok2_13,
                            profor_anketa.pok2_14 as pok2_14,
                            profor_anketa.pok2_15 as pok2_15,
                            profor_anketa.pok2_16 as pok2_16,
                            profor_anketa.pok2_17 as pok2_17,
                            profor_anketa.pok2_18 as pok2_18,
                            profor_anketa.pok2_19 as pok2_19,
                            profor_anketa.pok2_20 as pok2_20,
                            profor_anketa.pok2_21 as pok2_21,
                            profor_anketa.pok2_22 as pok2_22,
                            profor_anketa.pok2_23 as pok2_23,
                            profor_anketa.pok2_24 as pok2_24,
                            profor_anketa.pok2_25 as pok2_25,
                            profor_anketa.pok2_26 as pok2_26,
                            profor_anketa.pok2_27 as pok2_27,
                            profor_anketa.pok2_28 as pok2_28,
                            profor_anketa.pok2_29 as pok2_29,
                            profor_anketa.pok2_30 as pok2_30,
                            profor_anketa.pok2_31 as pok2_31,
                            profor_anketa.pok2_32 as pok2_32,
                            profor_anketa.pok2_33 as pok2_33,
                            profor_anketa.pok2_34 as pok2_34,
                            profor_anketa.pok2_35 as pok2_35,
                            profor_anketa.pok2_36 as pok2_36,
                            profor_anketa.pok2_37 as pok2_37,
                            profor_anketa.pok2_38 as pok2_38,
                            profor_anketa.pok3_1 as pok3_1,
                            profor_anketa.pok3_2 as pok3_2,
                            profor_anketa.pok3_3 as pok3_3,
                            profor_anketa.pok3_4 as pok3_4,
                            profor_anketa.pok3_5 as pok3_5,
                            profor_anketa.pok3_6 as pok3_6,
                            profor_anketa.pok3_7 as pok3_7,
                            profor_anketa.pok3_8 as pok3_8,
                            profor_anketa.pok3_9 as pok3_9,
                            profor_anketa.pok4_1 as pok4_1,
                            profor_anketa.pok4_2 as pok4_2,
                            profor_anketa.pok4_3 as pok4_3,
                            profor_anketa.pok4_4 as pok4_4,
                            profor_anketa.pok4_5 as pok4_5,
                            profor_anketa.pok4_6 as pok4_6,
                            profor_anketa.pok4_7 as pok4_7,
                            profor_anketa.pok4_8 as pok4_8,
                            profor_anketa.pok4_9 as pok4_9,
                            profor_anketa.pok5_1 as pok5_1,
                            profor_anketa.pok6_1 as pok6_1,
                            profor_anketa.pok7_1 as pok7_1,
                            profor_anketa.pok7_2 as pok7_2,
                            profor_anketa.pok7_3 as pok7_3,
                            profor_anketa.pok7_4 as pok7_4,
                            profor_anketa.pok7_5 as pok7_5,
                            profor_anketa.pok7_6 as pok7_6,
                            profor_anketa.pok7_7 as pok7_7,
                            profor_anketa.pok7_8 as pok7_8,
                            profor_anketa.pok7_9 as pok7_9,
                            profor_anketa.pok7_10 as pok7_10,
                            profor_anketa.pok7_11 as pok7_11,
                            profor_anketa.pok7_12 as pok7_12,
                            profor_anketa.pok7_13 as pok7_13,
                            profor_anketa.pok7_14 as pok7_14,
                            profor_anketa.pok7_15 as pok7_15,
                            profor_anketa.pok8_1 as pok8_1,
                            profor_anketa.pok8_2 as pok8_2,
                            profor_anketa.pok8_3 as pok8_3,
                            profor_anketa.pok8_4 as pok8_4,
                            profor_anketa.pok8_5 as pok8_5,
                            profor_anketa.pok8_6 as pok8_6,
                            profor_anketa.pok8_7 as pok8_7,
                            profor_anketa.pok9_1 as pok9_1,
                            profor_anketa.pok10_1 as pok10_1,
                            profor_anketa.pok10_2 as pok10_2,
                            profor_anketa.pok10_3 as pok10_3,
                            profor_anketa.pok10_4 as pok10_4,
                            profor_anketa.pok10_5 as pok10_5,
                            profor_anketa.pok10_6 as pok10_6,
                            profor_anketa.pok10_7 as pok10_7,
                            profor_anketa.pok11_1 as pok11_1,
                            profor_anketa.pok12_1 as pok12_1
                            from profor_anketa, report, est where
                            profor_anketa.id_report = report.id_report
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
                            profor_anketa.pok1_1 as pok1_1,
                            profor_anketa.pok1_2 as pok1_2,
                            profor_anketa.pok1_3 as pok1_3,
                            profor_anketa.pok1_4 as pok1_4,
                            profor_anketa.pok1_5 as pok1_5,
                            profor_anketa.pok1_6 as pok1_6,
                            profor_anketa.pok1_7 as pok1_7,
                            profor_anketa.pok1_8 as pok1_8,
                            profor_anketa.pok1_9 as pok1_9,
                            profor_anketa.pok1_10 as pok1_10,
                            profor_anketa.pok1_11 as pok1_11,
                            profor_anketa.pok2_1 as pok2_1,
                            profor_anketa.pok2_2 as pok2_2,
                            profor_anketa.pok2_3 as pok2_3,
                            profor_anketa.pok2_4 as pok2_4,
                            profor_anketa.pok2_5 as pok2_5,
                            profor_anketa.pok2_6 as pok2_6,
                            profor_anketa.pok2_7 as pok2_7,
                            profor_anketa.pok2_8 as pok2_8,
                            profor_anketa.pok2_9 as pok2_9,
                            profor_anketa.pok2_10 as pok2_10,
                            profor_anketa.pok2_11 as pok2_11,
                            profor_anketa.pok2_12 as pok2_12,
                            profor_anketa.pok2_13 as pok2_13,
                            profor_anketa.pok2_14 as pok2_14,
                            profor_anketa.pok2_15 as pok2_15,
                            profor_anketa.pok2_16 as pok2_16,
                            profor_anketa.pok2_17 as pok2_17,
                            profor_anketa.pok2_18 as pok2_18,
                            profor_anketa.pok2_19 as pok2_19,
                            profor_anketa.pok2_20 as pok2_20,
                            profor_anketa.pok2_21 as pok2_21,
                            profor_anketa.pok2_22 as pok2_22,
                            profor_anketa.pok2_23 as pok2_23,
                            profor_anketa.pok2_24 as pok2_24,
                            profor_anketa.pok2_25 as pok2_25,
                            profor_anketa.pok2_26 as pok2_26,
                            profor_anketa.pok2_27 as pok2_27,
                            profor_anketa.pok2_28 as pok2_28,
                            profor_anketa.pok2_29 as pok2_29,
                            profor_anketa.pok2_30 as pok2_30,
                            profor_anketa.pok2_31 as pok2_31,
                            profor_anketa.pok2_32 as pok2_32,
                            profor_anketa.pok2_33 as pok2_33,
                            profor_anketa.pok2_34 as pok2_34,
                            profor_anketa.pok2_35 as pok2_35,
                            profor_anketa.pok2_36 as pok2_36,
                            profor_anketa.pok2_37 as pok2_37,
                            profor_anketa.pok2_38 as pok2_38,
                            profor_anketa.pok3_1 as pok3_1,
                            profor_anketa.pok3_2 as pok3_2,
                            profor_anketa.pok3_3 as pok3_3,
                            profor_anketa.pok3_4 as pok3_4,
                            profor_anketa.pok3_5 as pok3_5,
                            profor_anketa.pok3_6 as pok3_6,
                            profor_anketa.pok3_7 as pok3_7,
                            profor_anketa.pok3_8 as pok3_8,
                            profor_anketa.pok3_9 as pok3_9,
                            profor_anketa.pok4_1 as pok4_1,
                            profor_anketa.pok4_2 as pok4_2,
                            profor_anketa.pok4_3 as pok4_3,
                            profor_anketa.pok4_4 as pok4_4,
                            profor_anketa.pok4_5 as pok4_5,
                            profor_anketa.pok4_6 as pok4_6,
                            profor_anketa.pok4_7 as pok4_7,
                            profor_anketa.pok4_8 as pok4_8,
                            profor_anketa.pok4_9 as pok4_9,
                            profor_anketa.pok5_1 as pok5_1,
                            profor_anketa.pok6_1 as pok6_1,
                            profor_anketa.pok7_1 as pok7_1,
                            profor_anketa.pok7_2 as pok7_2,
                            profor_anketa.pok7_3 as pok7_3,
                            profor_anketa.pok7_4 as pok7_4,
                            profor_anketa.pok7_5 as pok7_5,
                            profor_anketa.pok7_6 as pok7_6,
                            profor_anketa.pok7_7 as pok7_7,
                            profor_anketa.pok7_8 as pok7_8,
                            profor_anketa.pok7_9 as pok7_9,
                            profor_anketa.pok7_10 as pok7_10,
                            profor_anketa.pok7_11 as pok7_11,
                            profor_anketa.pok7_12 as pok7_12,
                            profor_anketa.pok7_13 as pok7_13,
                            profor_anketa.pok7_14 as pok7_14,
                            profor_anketa.pok7_15 as pok7_15,
                            profor_anketa.pok8_1 as pok8_1,
                            profor_anketa.pok8_2 as pok8_2,
                            profor_anketa.pok8_3 as pok8_3,
                            profor_anketa.pok8_4 as pok8_4,
                            profor_anketa.pok8_5 as pok8_5,
                            profor_anketa.pok8_6 as pok8_6,
                            profor_anketa.pok8_7 as pok8_7,
                            profor_anketa.pok9_1 as pok9_1,
                            profor_anketa.pok10_1 as pok10_1,
                            profor_anketa.pok10_2 as pok10_2,
                            profor_anketa.pok10_3 as pok10_3,
                            profor_anketa.pok10_4 as pok10_4,
                            profor_anketa.pok10_5 as pok10_5,
                            profor_anketa.pok10_6 as pok10_6,
                            profor_anketa.pok10_7 as pok10_7,
                            profor_anketa.pok11_1 as pok11_1,
                            profor_anketa.pok12_1 as pok12_1
                            from profor_anketa, report, est where
                            profor_anketa.id_report = report.id_report
                            and report.id_est = est.id_est
                            and report.id_rep_type ='.$id_rep_type.'
                            and est.id_okr = '.Yii::app()->session['est']);
                    $data = $command->queryAll();
                }
                for($i=0; $i <sizeof($data); $i++) {
                    $data[$i]['id_okr'] = $okrug[$data[$i]['id_okr']];
                    $data[$i]['id_raion'] = $raion[$data[$i]['id_raion']];
                    //$command = Yii::app()->db->createCommand('select contact_info.nas_punkt, contact_info.street, contact_info.dom, contact_info.korpus from contact_info, report where report.id_rep_type = 1 and report.id_report = contact_info.id_report and report.id_est = '.$data[$i]['id_est']);
                    //$reader = $command->queryRow();
                    //$data[$i]['adr'] = $reader['nas_punkt'].', '.$reader['street'].', '.$reader['dom'].', '.$reader['korpus'];               
                }
                $pokaz = Profor_anketa::model()->attributeLabels();
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
                $aSheet->setTitle('Профориентация');
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
                $aSheet->getStyle('A2:BM2')->getFont()->setBold(true);
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
                header('Content-Disposition: attachment;filename="prof.xls"');
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
?>