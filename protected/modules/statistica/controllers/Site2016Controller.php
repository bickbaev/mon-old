<?php

class Site2016Controller extends Controller
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
        
        public function actionExcel2() {
               $phpExcelPath = '/var/www/cposo/data/www/mon.cposo.ru/protected/vendors/phpexcel';
                //print_r($data);
                 // Turn off our amazing library autoload
                spl_autoload_unregister(array('YiiBase','autoload'));
                 //
                 // making use of our reference, include the main class
                 // when we do this, phpExcel has its own autoload registration
                 // procedure (PHPExcel_Autoloader::Register();)
                include($phpExcelPath . DIRECTORY_SEPARATOR . 'PHPExcel.php');
                //подключаем и создаем класс PHPExcel
                $pExcel = new PHPExcel();
                /*$pExcel->setActiveSheetIndex(0);
                $pExcel->getDefaultStyle()->getFont()->setName('Arial');
                $pExcel->getDefaultStyle()->getFont()->setSize(10);
                $aSheet = $pExcel->getActiveSheet();
                $aSheet->setTitle('Проверка сайтов 2016');
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
                }*/
                include($phpExcelPath . DIRECTORY_SEPARATOR.'PHPExcel/Writer/Excel5.php');
                $objWriter = new PHPExcel_Writer_Excel5($pExcel);
                header('Content-Type: application/vnd.ms-excel');
                header('Content-Disposition: attachment;filename="site2015.xls"');
                header('Cache-Control: max-age=0');
                $objWriter->save('php://output');
                spl_autoload_register(array('YiiBase','autoload'));            
        }
        
        public function actionExcel() {
              if (isset($_GET['id_rep_type']) && $_GET['id_rep_type'] != '') {
                if(Yii::app()->session['type_adm'] < 4) $this->redirect(Yii::app()->user->returnUrl);
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
                            site2016.site2 as site2,
                            site2016.pok0 as pok0,
                            site2016.pok1 as pok1,
                            site2016.pok2 as pok2,
                            site2016.pok3 as pok3,
                            site2016.pok4 as pok4,
                            site2016.pok5 as pok5,
                            site2016.pok6 as pok6,
                            site2016.pok7 as pok7,
                            site2016.pok8 as pok8,
                            site2016.pok9 as pok9,
                            site2016.pok10 as pok10,
                            site2016.pok11 as pok11,
                            site2016.pok12 as pok12,
                            site2016.pok13 as pok13,
                            site2016.pok14 as pok14,
                            site2016.pok15 as pok15,
                            site2016.pok16 as pok16,
                            site2016.pok17 as pok17,
                            site2016.pok18 as pok18,
                            site2016.pok19 as pok19,
                            site2016.pok20 as pok20,
                            site2016.pok21 as pok21,
                            site2016.pok22 as pok22,
                            site2016.pok23 as pok23,
                            site2016.pok24 as pok24,
                            site2016.pok25 as pok25,
                            site2016.pok26 as pok26,
                            site2016.pok27 as pok27,
                            site2016.pok28 as pok28,
                            site2016.pok29 as pok29,
                            site2016.pok30 as pok30,
                            site2016.pok31 as pok31,
                            site2016.pok32 as pok32,
                            site2016.pok33 as pok33,
                            site2016.pok34 as pok34,
                            site2016.pok35 as pok35,
                            site2016.pok36 as pok36,
                            site2016.pok37 as pok37,
                            site2016.pok38 as pok38,
                            site2016.pok39 as pok39,
                            site2016.pok40 as pok40,
                            site2016.pok41 as pok41,
                            site2016.pok42 as pok42,
                            site2016.pok43 as pok43,
                            site2016.pok44 as pok44,
                            site2016.pok45 as pok45,
                            site2016.pok46 as pok46,
                            site2016.pok47 as pok47,
                            site2016.pok48 as pok48,
                            site2016.pok49 as pok49,
                            site2016.pok50 as pok50,
                            site2016.pok51 as pok51,
                            site2016.pok52 as pok52,
                            site2016.pok53 as pok53,
                            site2016.pok54 as pok54,
                            site2016.pok55 as pok55,
                            site2016.pok56 as pok56,
                            site2016.pok57 as pok57,
                            site2016.pok58 as pok58,
                            site2016.pok59 as pok59,
                            site2016.pok60 as pok60,
                            site2016.pok61 as pok61,
                            site2016.pok62 as pok62,
                            site2016.pok63 as pok63,
                            site2016.pok64 as pok64,
                            site2016.pok65 as pok65,
                            site2016.pok66 as pok66,
                            site2016.pok67 as pok67,
                            site2016.pok68 as pok68,
                            site2016.pok69 as pok69,
                            site2016.pok70 as pok70,
                            site2016.pok71 as pok71,
                            site2016.pok71 as pok72,
                            site2016.pok71 as pok73,
                            site2016.pok71 as pok74,
                            site2016.p_date as p_date,
                            site2016.remark as remark
                            from site2016, report, est where
                            site2016.id_report = report.id_report
                            and report.id_est = est.id_est
                            and report.id_rep_type ='.$id_rep_type);
                    $data = $command->queryAll();
                }
                for($i=0; $i <sizeof($data); $i++) {
                    $data[$i]['id_okr'] = $okrug[$data[$i]['id_okr']];
                    $data[$i]['id_raion'] = $raion[$data[$i]['id_raion']];                
                }
                $pokaz = Site2016::model()->attributeLabels();
                array_shift($pokaz);
                $dabavka = array('id_okr'=>'Округ', 'id_raion'=>'Район', 'est_name'=>'Учреждение');
                $pokaz = $dabavka + $pokaz;
                //array_unshift($data, $pokaz);
                $zag = 'Отчет - '.$otchet['rep_name'].' период '.$otchet['s_date'].'-'.$otchet['f_date'];
                $phpExcelPath = '/var/www/cposo/data/www/mon.cposo.ru/protected/vendors/phpexcel';
                //print_r($data);
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
                $aSheet->setTitle('Проверка сайтов 2017');
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
                $aSheet->getStyle('A2:CC2')->getFont()->setBold(true);
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
                header('Content-Disposition: attachment;filename="site2017.xls"');
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

