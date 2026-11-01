<?php

class Site2022_2Controller extends Controller
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
                //'accessControl + index, excel, excel_spo'
            );
        }

        function filterAccessControl($filterChain)
        {
            if (Yii::app()->user->isGuest)
                    $this->redirect('index.php?r=site/login');
            else
                    $filterChain->run();
        }
        
        public function actionIndex() {
             echo 1;
        }

        public function actionExcel($id_rep_type) {
                $id_rep_type = (int)$id_rep_type;
                if(Yii::app()->session['type_adm'] < 4) $this->redirect(Yii::app()->user->returnUrl);
                $otchet = Yii::app()->db->createCommand('select rep_name, DATE_FORMAT(s_date, "%d.%m.%Y") AS s_date, DATE_FORMAT(f_date, "%d.%m.%Y") AS f_date from rep_name where id_rep_type ='.$id_rep_type)->queryRow();
                $reader = Yii::app()->db->createCommand('select id_est, est_name from est where type_adm = 3')->queryAll();
                foreach ($reader as $value) {
                    $okrug[$value['id_est']] = $value['est_name'];
                }
                $reader = Yii::app()->db->createCommand('select id_est, est_name from est where type_adm = 2')->queryAll();
                foreach ($reader as $value) {
                    $raion[$value['id_est']] = $value['est_name'];
                }
                $command = Yii::app()->db->createCommand('select
                        est.id_okr as id_okr,
                        est.id_raion as id_raion,
                        est.est_name as est_name,
                        site2022.site2 as site2,
                        site2022.pok1 as pok1,
                        site2022.pok2 as pok2,
                        site2022.pok3 as pok3,
                        site2022.pok4 as pok4,
                        site2022.pok5 as pok5,
                        site2022.pok6 as pok6,
                        site2022.pok7 as pok7,
                        site2022.pok8 as pok8,
                        site2022.pok9 as pok9,
                        site2022.pok10 as pok10,
                        site2022.pok11 as pok11,
                        site2022.pok12 as pok12,
                        site2022.pok13 as pok13,
                        site2022.pok14 as pok14,
                        site2022.pok15 as pok15,
                        site2022.pok16 as pok16,
                        site2022.pok17 as pok17,
                        site2022.pok18 as pok18,
                        site2022.pok19 as pok19,
                        site2022.pok20 as pok20,
                        site2022.pok21 as pok21,
                        site2022.pok22 as pok22,
                        site2022.pok23 as pok23,
                        site2022.pok24 as pok24,
                        site2022.pok25 as pok25,
                        site2022.pok26 as pok26,
                        site2022.pok27 as pok27,
                        site2022.pok28 as pok28,
                        site2022.pok29 as pok29,
                        site2022.pok30 as pok30,
                        site2022.pok31 as pok31,
                        site2022.pok32 as pok32,
                        site2022.pok33 as pok33,
                        site2022.pok34 as pok34,
                        site2022.pok35 as pok35,
                        site2022.pok36 as pok36,
                        site2022.pok37 as pok37,
                        site2022.pok38 as pok38,
                        site2022.pok39 as pok39,
                        site2022.pok40 as pok40,
                        site2022.pok41 as pok41,
                        site2022.pok42 as pok42,
                        site2022.pok43 as pok43,
                        site2022.pok44 as pok44,
                        site2022.pok45 as pok45,
                        site2022.pok46 as pok46,
                        site2022.pok47 as pok47,
                        site2022.pok48 as pok48,
                        site2022.pok49 as pok49,
                        site2022.pok50 as pok50,
                        site2022.pok51 as pok51,
                        site2022.pok52 as pok52,
                        site2022.pok53 as pok53,
                        site2022.pok54 as pok54,
                        site2022.pok55 as pok55,
                        site2022.pok56 as pok56,
                        site2022.pok57 as pok57,
                        site2022.pok58 as pok58,
                        site2022.pok59 as pok59,
                        site2022.pok60 as pok60,
                        site2022.pok61 as pok61,
                        site2022.pok62 as pok62,
                        site2022.pok63 as pok63,
                        site2022.pok64 as pok64,
                        site2022.pok65 as pok65,
                        site2022.pok66 as pok66,
                        site2022.pok67 as pok67,
                        site2022.pok68 as pok68,
                        site2022.pok69 as pok69,
                        site2022.pok70 as pok70,
                        site2022.pok71 as pok71,
                        site2022.pok72 as pok72,
                        site2022.pok73 as pok73,
                        site2022.pok74 as pok74,
                        site2022.pok75 as pok75,
                        site2022.pok76 as pok76,
                        site2022.pok77 as pok77,
                        site2022.pok78 as pok78,
                        site2022.pok79 as pok79,
                        site2022.pok80 as pok80,
                        site2022.pok81 as pok81,
                        site2022.pok82 as pok82,
                        site2022.pok83 as pok83,
                        site2022.pok84 as pok84,
                        site2022.pok85 as pok85,
                        site2022.pok86 as pok86,
                        site2022.pok87 as pok87,
                        site2022.pok88 as pok88,
                        site2022.pok89 as pok89,
                        site2022.pok90 as pok90,
                        site2022.pok91 as pok91,
                        site2022.pok92 as pok92,
                        site2022.pok93 as pok93,
                        site2022.pok94 as pok94,
                        site2022.pok95 as pok95,
                        site2022.pok96 as pok96,
                        site2022.pok97 as pok97,
                        site2022.pok98 as pok98,
                        site2022.pok99 as pok99,
                        site2022.pok100 as pok100,                                                
                        DATE_FORMAT(site2022.p_date, "%d.%m.%Y") AS p_date,
                        site2022.red as red,
                        site2022.remark as remark 
                        from site2022, report, est where
                        site2022.id_report = report.id_report
                        and report.id_est = est.id_est
                        and report.id_rep_type ='.$id_rep_type);
                $data = $command->queryAll();
                for($i=0; $i <sizeof($data); $i++) {
                    $data[$i]['id_okr'] = $okrug[$data[$i]['id_okr']];
                    $data[$i]['id_raion'] = $raion[$data[$i]['id_raion']];                
                }
                $pokaz = Site2022::model()->attributeLabels();
                array_shift($pokaz);
                $dabavka = array('id_okr'=>'Округ', 'id_raion'=>'Район', 'est_name'=>'Учреждение');
                $pokaz = $dabavka + $pokaz;
                $zag = 'Отчет - '.$otchet['rep_name'].' период '.$otchet['s_date'].'-'.$otchet['f_date'];
                $phpExcelPath = '/var/www/cposo/data/www/mon.cposo.ru/protected/vendors/phpexcel';
//                print_r($data);
//                die();
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
                $aSheet->setTitle('Проверка сайтов 2022');
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
                $aSheet->getStyle('A2:DD2')->getFont()->setBold(true);
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
                header('Content-Disposition: attachment;filename="site2022.xls"');
                header('Cache-Control: max-age=0');
                $objWriter->save('php://output');
                spl_autoload_register(array('YiiBase','autoload'));
        }
        
        public function actionExcel_spo($id_rep_type) {
                $id_rep_type = (int)$id_rep_type;
                if(Yii::app()->session['type_adm'] < 4) $this->redirect(Yii::app()->user->returnUrl);
                $otchet = Yii::app()->db->createCommand('select rep_name, DATE_FORMAT(s_date, "%d.%m.%Y") AS s_date, DATE_FORMAT(f_date, "%d.%m.%Y") AS f_date from rep_name where id_rep_type ='.$id_rep_type)->queryRow();
                $reader = Yii::app()->db->createCommand('select id_est, est_name from est where type_adm = 3')->queryAll();
                foreach ($reader as $value) {
                    $okrug[$value['id_est']] = $value['est_name'];
                }
                $reader = Yii::app()->db->createCommand('select id_est, est_name from est where type_adm = 2')->queryAll();
                foreach ($reader as $value) {
                    $raion[$value['id_est']] = $value['est_name'];
                }
                $command = Yii::app()->db->createCommand('select
                        est.id_okr as id_okr,
                        est.id_raion as id_raion,
                        est.est_name as est_name,
                        site2022_spo.site2 as site2,
                        site2022_spo.pok1 as pok1,
                        site2022_spo.pok2 as pok2,
                        site2022_spo.pok3 as pok3,
                        site2022_spo.pok4 as pok4,
                        site2022_spo.pok5 as pok5,
                        site2022_spo.pok6 as pok6,
                        site2022_spo.pok7 as pok7,
                        site2022_spo.pok8 as pok8,
                        site2022_spo.pok9 as pok9,
                        site2022_spo.pok10 as pok10,
                        site2022_spo.pok11 as pok11,
                        site2022_spo.pok12 as pok12,
                        site2022_spo.pok13 as pok13,
                        site2022_spo.pok14 as pok14,
                        site2022_spo.pok15 as pok15,
                        site2022_spo.pok16 as pok16,
                        site2022_spo.pok17 as pok17,
                        site2022_spo.pok18 as pok18,
                        site2022_spo.pok19 as pok19,
                        site2022_spo.pok20 as pok20,
                        site2022_spo.pok21 as pok21,
                        site2022_spo.pok22 as pok22,
                        site2022_spo.pok23 as pok23,
                        site2022_spo.pok24 as pok24,
                        site2022_spo.pok25 as pok25,
                        site2022_spo.pok26 as pok26,
                        site2022_spo.pok27 as pok27,
                        site2022_spo.pok28 as pok28,
                        site2022_spo.pok29 as pok29,
                        site2022_spo.pok30 as pok30,
                        site2022_spo.pok31 as pok31,
                        site2022_spo.pok32 as pok32,
                        site2022_spo.pok33 as pok33,
                        site2022_spo.pok34 as pok34,
                        site2022_spo.pok35 as pok35,
                        site2022_spo.pok36 as pok36,
                        site2022_spo.pok37 as pok37,
                        site2022_spo.pok38 as pok38,
                        site2022_spo.pok39 as pok39,
                        site2022_spo.pok40 as pok40,
                        site2022_spo.pok41 as pok41,
                        site2022_spo.pok42 as pok42,
                        site2022_spo.pok43 as pok43,
                        site2022_spo.pok44 as pok44,
                        site2022_spo.pok45 as pok45,
                        site2022_spo.pok46 as pok46,
                        site2022_spo.pok47 as pok47,
                        site2022_spo.pok48 as pok48,
                        site2022_spo.pok49 as pok49,
                        site2022_spo.pok50 as pok50,
                        site2022_spo.pok51 as pok51,
                        site2022_spo.pok52 as pok52,
                        site2022_spo.pok53 as pok53,
                        site2022_spo.pok54 as pok54,
                        site2022_spo.pok55 as pok55,
                        site2022_spo.pok56 as pok56,
                        site2022_spo.pok57 as pok57,
                        site2022_spo.pok58 as pok58,
                        site2022_spo.pok59 as pok59,
                        site2022_spo.pok60 as pok60,
                        site2022_spo.pok61 as pok61,
                        site2022_spo.pok62 as pok62,
                        site2022_spo.pok63 as pok63,
                        site2022_spo.pok64 as pok64,
                        site2022_spo.pok65 as pok65,
                        site2022_spo.pok66 as pok66,
                        site2022_spo.pok67 as pok67,
                        site2022_spo.pok68 as pok68,
                        site2022_spo.pok69 as pok69,
                        site2022_spo.pok70 as pok70,
                        site2022_spo.pok71 as pok71,
                        site2022_spo.pok72 as pok72,
                        site2022_spo.pok73 as pok73,
                        site2022_spo.pok74 as pok74,
                        site2022_spo.pok75 as pok75,
                        site2022_spo.pok76 as pok76,
                        site2022_spo.pok77 as pok77,
                        site2022_spo.pok78 as pok78,
                        site2022_spo.pok79 as pok79,
                        site2022_spo.pok80 as pok80,
                        site2022_spo.pok81 as pok81,
                        site2022_spo.pok82 as pok82,
                        site2022_spo.pok83 as pok83,
                        site2022_spo.pok84 as pok84,
                        site2022_spo.pok85 as pok85,
                        site2022_spo.pok86 as pok86,
                        site2022_spo.pok87 as pok87,
                        site2022_spo.pok88 as pok88,
                        site2022_spo.pok89 as pok89,
                        site2022_spo.pok90 as pok90,
                        site2022_spo.pok91 as pok91,
                        site2022_spo.pok92 as pok92,
                        site2022_spo.pok93 as pok93,
                        site2022_spo.pok94 as pok94,
                        site2022_spo.pok95 as pok95,
                        site2022_spo.pok96 as pok96,
                        site2022_spo.pok97 as pok97,
                        site2022_spo.pok98 as pok98,
                        site2022_spo.pok99 as pok99,
                        site2022_spo.pok100 as pok100,                         
                        DATE_FORMAT(site2022_spo.p_date, "%d.%m.%Y") AS p_date,
                        site2022_spo.red as red,
                        site2022_spo.remark as remark  
                        from site2022_spo, report, est where
                        site2022_spo.id_report = report.id_report
                        and report.id_est = est.id_est
                        and report.id_rep_type ='.$id_rep_type);
                $data = $command->queryAll();
                for($i=0; $i <sizeof($data); $i++) {
                    $data[$i]['id_okr'] = $okrug[$data[$i]['id_okr']];
                    $data[$i]['id_raion'] = $raion[$data[$i]['id_raion']];                
                }
                $pokaz = Site2022_spo::model()->attributeLabels();
                array_shift($pokaz);
                $dabavka = array('id_okr'=>'Округ', 'id_raion'=>'Район', 'est_name'=>'Учреждение');
                $pokaz = $dabavka + $pokaz;
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
                $aSheet->setTitle('Проверка сайтов 2022');
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
                $aSheet->getStyle('A2:DC2')->getFont()->setBold(true);
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
                header('Content-Disposition: attachment;filename="site2022_spo.xls"');
                header('Cache-Control: max-age=0');
                $objWriter->save('php://output');
                spl_autoload_register(array('YiiBase','autoload'));
        }


        public function actionExcel_2023($id_rep_type) {
                $id_rep_type = (int)$id_rep_type;
                if(Yii::app()->session['type_adm'] < 4) $this->redirect(Yii::app()->user->returnUrl);
                $otchet = Yii::app()->db->createCommand('select rep_name, DATE_FORMAT(s_date, "%d.%m.%Y") AS s_date, DATE_FORMAT(f_date, "%d.%m.%Y") AS f_date from rep_name where id_rep_type ='.$id_rep_type)->queryRow();
                $reader = Yii::app()->db->createCommand('select id_est, est_name from est where type_adm = 3')->queryAll();
                foreach ($reader as $value) {
                    $okrug[$value['id_est']] = $value['est_name'];
                }
                $reader = Yii::app()->db->createCommand('select id_est, est_name from est where type_adm = 2')->queryAll();
                foreach ($reader as $value) {
                    $raion[$value['id_est']] = $value['est_name'];
                }
                $command = Yii::app()->db->createCommand('select
                        est.id_okr as id_okr,
                        est.id_raion as id_raion,
                        est.est_name as est_name,
                        site2023.site2 as site2,
                        site2023.pok1 as pok1,
                        site2023.pok2 as pok2,
                        site2023.pok3 as pok3,
                        site2023.pok4 as pok4,
                        site2023.pok5 as pok5,
                        site2023.pok6 as pok6,
                        site2023.pok7 as pok7,
                        site2023.pok8 as pok8,
                        site2023.pok9 as pok9,
                        site2023.pok10 as pok10,
                        site2023.pok11 as pok11,
                        site2023.pok12 as pok12,
                        site2023.pok13 as pok13,
                        site2023.pok14 as pok14,
                        site2023.pok15 as pok15,
                        site2023.pok16 as pok16,
                        site2023.pok17 as pok17,
                        site2023.pok18 as pok18,
                        site2023.pok19 as pok19,
                        site2023.pok20 as pok20,
                        site2023.pok21 as pok21,
                        site2023.pok22 as pok22,
                        site2023.pok23 as pok23,
                        site2023.pok24 as pok24,
                        site2023.pok25 as pok25,
                        site2023.pok26 as pok26,
                        site2023.pok27 as pok27,
                        site2023.pok28 as pok28,
                        site2023.pok29 as pok29,
                        site2023.pok30 as pok30,
                        site2023.pok31 as pok31,
                        site2023.pok32 as pok32,
                        site2023.pok33 as pok33,
                        site2023.pok34 as pok34,
                        site2023.pok35 as pok35,
                        site2023.pok36 as pok36,
                        site2023.pok37 as pok37,
                        site2023.pok38 as pok38,
                        site2023.pok39 as pok39,
                        site2023.pok40 as pok40,
                        site2023.pok41 as pok41,
                        site2023.pok42 as pok42,
                        site2023.pok43 as pok43,
                        site2023.pok44 as pok44,
                        site2023.pok45 as pok45,
                        site2023.pok46 as pok46,
                        site2023.pok47 as pok47,
                        site2023.pok48 as pok48,
                        site2023.pok49 as pok49,
                        site2023.pok50 as pok50,
                        site2023.pok51 as pok51,
                        site2023.pok52 as pok52,
                        site2023.pok53 as pok53,
                        site2023.pok54 as pok54,
                        site2023.pok55 as pok55,
                        site2023.pok56 as pok56,
                        site2023.pok57 as pok57,
                        site2023.pok58 as pok58,
                        site2023.pok59 as pok59,
                        site2023.pok60 as pok60,
                        site2023.pok61 as pok61,
                        site2023.pok62 as pok62,
                        site2023.pok63 as pok63,
                        site2023.pok64 as pok64,
                        site2023.pok65 as pok65,
                        site2023.pok66 as pok66,
                        site2023.pok67 as pok67,
                        site2023.pok68 as pok68,
                        site2023.pok69 as pok69,
                        site2023.pok70 as pok70,
                        site2023.pok71 as pok71,
                        site2023.pok72 as pok72,
                        site2023.pok73 as pok73,
                        site2023.pok74 as pok74,
                        site2023.pok75 as pok75,
                        site2023.pok76 as pok76,
                        site2023.pok77 as pok77,
                        site2023.pok78 as pok78,
                        site2023.pok79 as pok79,
                        site2023.pok80 as pok80,
                        site2023.pok81 as pok81,
                        site2023.pok82 as pok82,
                        site2023.pok83 as pok83,
                        site2023.pok84 as pok84,
                        site2023.pok85 as pok85,
                        site2023.pok86 as pok86,
                        site2023.pok87 as pok87,
                        site2023.pok88 as pok88,
                        site2023.pok89 as pok89,
                        site2023.pok90 as pok90,
                        site2023.pok91 as pok91,
                        site2023.pok92 as pok92,
                        site2023.pok93 as pok93,
                        site2023.pok94 as pok94,
                        site2023.pok95 as pok95,
                        site2023.pok96 as pok96,
                        site2023.pok97 as pok97,
                        site2023.pok98 as pok98,
                        site2023.pok99 as pok99,
                        site2023.pok100 as pok100,
                        site2023.pok101 as pok101,
                        site2023.pok102 as pok102,
                        site2023.pok103 as pok103,
                        site2023.pok104 as pok104,
                        site2023.pok105 as pok105,
                        site2023.pok106 as pok106,
                        site2023.pok107 as pok107,
                        site2023.pok108 as pok108,
                        site2023.pok109 as pok109,                        
                        DATE_FORMAT(site2023.p_date, "%d.%m.%Y") AS p_date,
                        site2023.red as red,
                        site2023.remark as remark 
                        from site2023, report, est where
                        site2023.id_report = report.id_report
                        and report.id_est = est.id_est
                        and report.id_rep_type ='.$id_rep_type);
                $data = $command->queryAll();
                for($i=0; $i <sizeof($data); $i++) {
                    $data[$i]['id_okr'] = $okrug[$data[$i]['id_okr']];
                    $data[$i]['id_raion'] = $raion[$data[$i]['id_raion']];                
                }
                $pokaz = Site2023::model()->attributeLabels();
                array_shift($pokaz);
                $dabavka = array('id_okr'=>'Округ', 'id_raion'=>'Район', 'est_name'=>'Учреждение');
                $pokaz = $dabavka + $pokaz;
                $zag = 'Отчет - '.$otchet['rep_name'].' период '.$otchet['s_date'].'-'.$otchet['f_date'];
                $phpExcelPath = '/var/www/cposo/data/www/mon.cposo.ru/protected/vendors/phpexcel';
//                print_r($data);
//                die();
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
                $aSheet->setTitle('Проверка сайтов 2023');
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
                $aSheet->getStyle('A2:DD2')->getFont()->setBold(true);
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
                header('Content-Disposition: attachment;filename="site2023.xls"');
                header('Cache-Control: max-age=0');
                $objWriter->save('php://output');
                spl_autoload_register(array('YiiBase','autoload'));
        }

        public function actionExcel_spo_2023($id_rep_type) {
                $id_rep_type = (int)$id_rep_type;
                if(Yii::app()->session['type_adm'] < 4) $this->redirect(Yii::app()->user->returnUrl);
                $otchet = Yii::app()->db->createCommand('select rep_name, DATE_FORMAT(s_date, "%d.%m.%Y") AS s_date, DATE_FORMAT(f_date, "%d.%m.%Y") AS f_date from rep_name where id_rep_type ='.$id_rep_type)->queryRow();
                $reader = Yii::app()->db->createCommand('select id_est, est_name from est where type_adm = 3')->queryAll();
                foreach ($reader as $value) {
                    $okrug[$value['id_est']] = $value['est_name'];
                }
                $reader = Yii::app()->db->createCommand('select id_est, est_name from est where type_adm = 2')->queryAll();
                foreach ($reader as $value) {
                    $raion[$value['id_est']] = $value['est_name'];
                }
                $command = Yii::app()->db->createCommand('select
                        est.id_okr as id_okr,
                        est.id_raion as id_raion,
                        est.est_name as est_name,
                        site2023_spo.site2 as site2,
                        site2023_spo.pok1 as pok1,
                        site2023_spo.pok2 as pok2,
                        site2023_spo.pok3 as pok3,
                        site2023_spo.pok4 as pok4,
                        site2023_spo.pok5 as pok5,
                        site2023_spo.pok6 as pok6,
                        site2023_spo.pok7 as pok7,
                        site2023_spo.pok8 as pok8,
                        site2023_spo.pok9 as pok9,
                        site2023_spo.pok10 as pok10,
                        site2023_spo.pok11 as pok11,
                        site2023_spo.pok12 as pok12,
                        site2023_spo.pok13 as pok13,
                        site2023_spo.pok14 as pok14,
                        site2023_spo.pok15 as pok15,
                        site2023_spo.pok16 as pok16,
                        site2023_spo.pok17 as pok17,
                        site2023_spo.pok18 as pok18,
                        site2023_spo.pok19 as pok19,
                        site2023_spo.pok20 as pok20,
                        site2023_spo.pok21 as pok21,
                        site2023_spo.pok22 as pok22,
                        site2023_spo.pok23 as pok23,
                        site2023_spo.pok24 as pok24,
                        site2023_spo.pok25 as pok25,
                        site2023_spo.pok26 as pok26,
                        site2023_spo.pok27 as pok27,
                        site2023_spo.pok28 as pok28,
                        site2023_spo.pok29 as pok29,
                        site2023_spo.pok30 as pok30,
                        site2023_spo.pok31 as pok31,
                        site2023_spo.pok32 as pok32,
                        site2023_spo.pok33 as pok33,
                        site2023_spo.pok34 as pok34,
                        site2023_spo.pok35 as pok35,
                        site2023_spo.pok36 as pok36,
                        site2023_spo.pok37 as pok37,
                        site2023_spo.pok38 as pok38,
                        site2023_spo.pok39 as pok39,
                        site2023_spo.pok40 as pok40,
                        site2023_spo.pok41 as pok41,
                        site2023_spo.pok42 as pok42,
                        site2023_spo.pok43 as pok43,
                        site2023_spo.pok44 as pok44,
                        site2023_spo.pok45 as pok45,
                        site2023_spo.pok46 as pok46,
                        site2023_spo.pok47 as pok47,
                        site2023_spo.pok48 as pok48,
                        site2023_spo.pok49 as pok49,
                        site2023_spo.pok50 as pok50,
                        site2023_spo.pok51 as pok51,
                        site2023_spo.pok52 as pok52,
                        site2023_spo.pok53 as pok53,
                        site2023_spo.pok54 as pok54,
                        site2023_spo.pok55 as pok55,
                        site2023_spo.pok56 as pok56,
                        site2023_spo.pok57 as pok57,
                        site2023_spo.pok58 as pok58,
                        site2023_spo.pok59 as pok59,
                        site2023_spo.pok60 as pok60,
                        site2023_spo.pok61 as pok61,
                        site2023_spo.pok62 as pok62,
                        site2023_spo.pok63 as pok63,
                        site2023_spo.pok64 as pok64,
                        site2023_spo.pok65 as pok65,
                        site2023_spo.pok66 as pok66,
                        site2023_spo.pok67 as pok67,
                        site2023_spo.pok68 as pok68,
                        site2023_spo.pok69 as pok69,
                        site2023_spo.pok70 as pok70,
                        site2023_spo.pok71 as pok71,
                        site2023_spo.pok72 as pok72,
                        site2023_spo.pok73 as pok73,
                        site2023_spo.pok74 as pok74,
                        site2023_spo.pok75 as pok75,
                        site2023_spo.pok76 as pok76,
                        site2023_spo.pok77 as pok77,
                        site2023_spo.pok78 as pok78,
                        site2023_spo.pok79 as pok79,
                        site2023_spo.pok80 as pok80,
                        site2023_spo.pok81 as pok81,
                        site2023_spo.pok82 as pok82,
                        site2023_spo.pok83 as pok83,
                        site2023_spo.pok84 as pok84,
                        site2023_spo.pok85 as pok85,
                        site2023_spo.pok86 as pok86,
                        site2023_spo.pok87 as pok87,
                        site2023_spo.pok88 as pok88,
                        site2023_spo.pok89 as pok89,
                        site2023_spo.pok90 as pok90,
                        site2023_spo.pok91 as pok91,
                        site2023_spo.pok92 as pok92,
                        site2023_spo.pok93 as pok93,
                        site2023_spo.pok94 as pok94,
                        site2023_spo.pok95 as pok95,
                        site2023_spo.pok96 as pok96,
                        site2023_spo.pok97 as pok97,
                        site2023_spo.pok98 as pok98,
                        site2023_spo.pok99 as pok99,
                        site2023_spo.pok100 as pok100,
                        site2023_spo.pok101 as pok101,
                        site2023_spo.pok102 as pok102,
                        site2023_spo.pok103 as pok103,
                        site2023_spo.pok104 as pok104,
                        site2023_spo.pok105 as pok105,
                        site2023_spo.pok106 as pok106,
                        site2023_spo.pok107 as pok107,                        
                        DATE_FORMAT(site2023_spo.p_date, "%d.%m.%Y") AS p_date,
                        site2023_spo.red as red,
                        site2023_spo.remark as remark  
                        from site2023_spo, report, est where
                        site2023_spo.id_report = report.id_report
                        and report.id_est = est.id_est
                        and report.id_rep_type ='.$id_rep_type);
                $data = $command->queryAll();
                for($i=0; $i <sizeof($data); $i++) {
                    $data[$i]['id_okr'] = $okrug[$data[$i]['id_okr']];
                    $data[$i]['id_raion'] = $raion[$data[$i]['id_raion']];                
                }
                $pokaz = Site2023_spo::model()->attributeLabels();
                array_shift($pokaz);
                $dabavka = array('id_okr'=>'Округ', 'id_raion'=>'Район', 'est_name'=>'Учреждение');
                $pokaz = $dabavka + $pokaz;
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
                $aSheet->setTitle('Проверка сайтов 2023');
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
                $aSheet->getStyle('A2:DJ2')->getFont()->setBold(true);
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
                header('Content-Disposition: attachment;filename="site2023_spo.xls"');
                header('Cache-Control: max-age=0');
                $objWriter->save('php://output');
                spl_autoload_register(array('YiiBase','autoload'));
        }        
        
}        
