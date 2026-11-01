<?php

class Siroty_contController extends Controller
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
            if (!isset($_GET['id_rep_type']) || $_GET['id_rep_type'] == '') {
                header("Location: http://mon.cposo.ru/");
                exit;
            }

            if (Yii::app()->session['type_adm'] < 3) $this->redirect(Yii::app()->user->returnUrl);
            $id_rep_type = (int) $_GET['id_rep_type'];

            $otchet = Yii::app()->db->createCommand(
                'select rep_name, DATE_FORMAT(s_date, "%d.%m.%Y") AS s_date, DATE_FORMAT(f_date, "%d.%m.%Y") AS f_date
                 from rep_name where id_rep_type = ' . $id_rep_type
            )->queryRow();

            $okrug = array();
            $raion = array();

            $reader = Yii::app()->db->createCommand('select id_est, est_name from est where type_adm = 3')->queryAll();
            foreach ($reader as $value) {
                $okrug[$value['id_est']] = $value['est_name'];
            }
            $reader = Yii::app()->db->createCommand('select id_est, est_name from est where type_adm = 2')->queryAll();
            foreach ($reader as $value) {
                $raion[$value['id_est']] = $value['est_name'];
            }

            $selectBase = 'select
                est.id_okr as id_okr,
                est.id_raion as id_raion,
                est.est_name as est_name,
                siroty_cont.vsego as vsego,
                siroty_cont.vsego_gos as vsego_gos,
                siroty_cont.priem as priem,
                siroty_cont.izm as izm,
                siroty_cont.kurs1 as kurs1,
                siroty_cont.kurs2 as kurs2,
                siroty_cont.kurs3 as kurs3,
                siroty_cont.kurs4 as kurs4,
                siroty_cont.kurs5 as kurs5,
                siroty_cont.exit_plan as exit_plan,
                siroty_cont.exit_plan_gos as exit_plan_gos,
                siroty_cont.exit_plan_money as exit_plan_money,
                siroty_cont.exit_trud as exit_trud,
                siroty_cont.exit_ptrud as exit_ptrud,
                siroty_cont.exit_obuch as exit_obuch,
                siroty_cont.exit_arm as exit_arm,
                siroty_cont.exit_bez as exit_bez,
                siroty_cont.obsh as obsh,
                siroty_cont.isp as isp,
                siroty_cont.tel as tel
                from siroty_cont, report, est where
                siroty_cont.id_report = report.id_report
                and report.id_est = est.id_est
                and report.id_rep_type = ';

            if (Yii::app()->session['type_adm'] == 4) {
                $data = Yii::app()->db->createCommand($selectBase . $id_rep_type)->queryAll();
            } else {
                if (Yii::app()->session['parent'] != 1) $this->redirect(Yii::app()->user->returnUrl);
                $data = Yii::app()->db->createCommand(
                    $selectBase . $id_rep_type . '
                    and est.id_okr = ' . (int) Yii::app()->session['est']
                )->queryAll();
            }

            for ($i = 0; $i < count($data); $i++) {
                $data[$i]['id_okr']   = isset($okrug[$data[$i]['id_okr']]) ? $okrug[$data[$i]['id_okr']] : '';
                $data[$i]['id_raion'] = isset($raion[$data[$i]['id_raion']]) ? $raion[$data[$i]['id_raion']] : '';
            }

            $pokaz = Siroty_cont::model()->attributeLabels();
            array_shift($pokaz);
            $dabavka = array('id_okr' => 'Округ', 'id_raion' => 'Район', 'est_name' => 'Учреждение');
            $pokaz = $dabavka + $pokaz;

            $zag = 'Отчет - ' . $otchet['rep_name'] . ' период ' . $otchet['s_date'] . '-' . $otchet['f_date'];
            
            // Подключаем автозагрузчик Composer из папки protected/vendor
            require_once(Yii::app()->basePath . DIRECTORY_SEPARATOR . 'vendor' . DIRECTORY_SEPARATOR . 'autoload.php');            

            // --- PhpSpreadsheet ---
            $pExcel = new \PhpOffice\PhpSpreadsheet\Spreadsheet();
            $pExcel->setActiveSheetIndex(0);
            $pExcel->getDefaultStyle()->getFont()->setName('Arial');
            $pExcel->getDefaultStyle()->getFont()->setSize(10);

            $aSheet = $pExcel->getActiveSheet();
            $aSheet->setTitle('Контингент сирот');

            $aSheet->getColumnDimension('A')->setWidth(25);
            $aSheet->getColumnDimension('B')->setWidth(25);
            $aSheet->getColumnDimension('C')->setWidth(25);
            $aSheet->getColumnDimension('V')->setWidth(35);
            $aSheet->getColumnDimension('W')->setWidth(25);

            $aSheet->setCellValue('A1', $zag);
            $aSheet->getStyle('A1')->getFont()->setBold(true);

            $i = 0;
            foreach ($pokaz as $value) {
                $col = \PhpOffice\PhpSpreadsheet\Cell\Coordinate::stringFromColumnIndex($i + 1);
                $aSheet->setCellValue($col . '2', $value);
                $i++;
            }

            $aSheet->getStyle('A2:BM2')->getFont()->setBold(true);
            $aSheet->getStyle('A2:BM2')->getAlignment()->setWrapText(true);
            $aSheet->getStyle('A2:BM2')->getAlignment()
                   ->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_TOP);
            $aSheet->getStyle('A2:BM2')->getAlignment()
                   ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_LEFT);
            $aSheet->getRowDimension(2)->setRowHeight(100);

            for ($i = 0; $i < count($data); $i++) {
                $k = 0;
                foreach ($data[$i] as $value) {
                    $col = \PhpOffice\PhpSpreadsheet\Cell\Coordinate::stringFromColumnIndex($k + 1);
                    $aSheet->setCellValue($col . ($i + 3), $value);
                    $k++;
                }
            }

            $objWriter = new \PhpOffice\PhpSpreadsheet\Writer\Xls($pExcel);

            header('Content-Type: application/vnd.ms-excel');
            header('Content-Disposition: attachment;filename="siroty.xls"');
            header('Cache-Control: max-age=0');

            $objWriter->save('php://output');

            $pExcel->disconnectWorksheets();
            unset($pExcel);
        }        
        
        public function actionExcel2() {
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
                            siroty_cont.vsego as vsego,
                            siroty_cont.vsego_gos as vsego_gos,
                            siroty_cont.priem as priem,
                            siroty_cont.izm as izm,
                            siroty_cont.kurs1 as kurs1,
                            siroty_cont.kurs2 as kurs2,
                            siroty_cont.kurs3 as kurs3,
                            siroty_cont.kurs4 as kurs4,
                            siroty_cont.kurs5 as kurs5,
                            siroty_cont.exit_plan as exit_plan,
                            siroty_cont.exit_plan_gos as exit_plan_gos,
                            siroty_cont.exit_plan_money as exit_plan_money,
                            siroty_cont.exit_trud as exit_trud,
                            siroty_cont.exit_ptrud as exit_ptrud,
                            siroty_cont.exit_obuch as exit_obuch,
                            siroty_cont.exit_arm as exit_arm,
                            siroty_cont.exit_bez as exit_bez,                            
                            siroty_cont.obsh as obsh,
                            siroty_cont.isp as isp,
                            siroty_cont.tel as tel
                            from siroty_cont, report, est where
                            siroty_cont.id_report = report.id_report
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
                            siroty_cont.vsego as vsego,
                            siroty_cont.vsego_gos as vsego_gos,
                            siroty_cont.priem as priem,
                            siroty_cont.izm as izm,
                            siroty_cont.kurs1 as kurs1,
                            siroty_cont.kurs2 as kurs2,
                            siroty_cont.kurs3 as kurs3,
                            siroty_cont.kurs4 as kurs4,
                            siroty_cont.kurs5 as kurs5,
                            siroty_cont.exit_plan as exit_plan,
                            siroty_cont.exit_plan_gos as exit_plan_gos,
                            siroty_cont.exit_plan_money as exit_plan_money,
                            siroty_cont.exit_trud as exit_trud,
                            siroty_cont.exit_ptrud as exit_ptrud,
                            siroty_cont.exit_obuch as exit_obuch,
                            siroty_cont.exit_arm as exit_arm,
                            siroty_cont.exit_bez as exit_bez,                             
                            siroty_cont.obsh as obsh,
                            siroty_cont.isp as isp,
                            siroty_cont.tel as tel
                            from siroty_cont, report, est where
                            siroty_cont.id_report = report.id_report
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
                $pokaz = Siroty_cont::model()->attributeLabels();
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
                $aSheet->setTitle('Контингент сирот');
                $aSheet->getColumnDimension('A')->setWidth(25);
                $aSheet->getColumnDimension('B')->setWidth(25);
                $aSheet->getColumnDimension('C')->setWidth(25);
                $aSheet->getColumnDimension('V')->setWidth(35);
                $aSheet->getColumnDimension('W')->setWidth(25);
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
                header('Content-Disposition: attachment;filename="siroty.xls"');
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
        
        public function actionExcel_okr() {
            if (isset($_GET['id_rep_type']) && $_GET['id_rep_type'] != '') {
                if(Yii::app()->session['type_adm'] < 4) $this->redirect(Yii::app()->user->returnUrl);
                $id_rep_type = (int) $_GET['id_rep_type'];
                $command = Yii::app()->db->createCommand('select rep_name, DATE_FORMAT(s_date, "%d.%m.%Y") AS s_date, DATE_FORMAT(f_date, "%d.%m.%Y") AS f_date from rep_name where id_rep_type ='.$id_rep_type);
                $otchet = $command->queryRow();
                $command = Yii::app()->db->createCommand('select id_est, est_name from est where type_adm = 3');
                $reader = $command->queryAll();
                foreach ($reader as $k=>$value) {                            
                    $command = Yii::app()->db->createCommand('select
                            est.id_okr as id_okr,
                            sum(siroty_cont.vsego) as vsego,
                            sum(siroty_cont.vsego_gos) as vsego_gos,
                            sum(siroty_cont.priem) as priem,
                            sum(siroty_cont.izm) as izm,
                            sum(siroty_cont.kurs1) as kurs1,
                            sum(siroty_cont.kurs2) as kurs2,
                            sum(siroty_cont.kurs3) as kurs3,
                            sum(siroty_cont.kurs4) as kurs4,
                            sum(siroty_cont.kurs5) as kurs5,
                            sum(siroty_cont.exit_plan) as exit_plan,
                            sum(siroty_cont.exit_plan_gos) as exit_plan_gos,
                            sum(siroty_cont.exit_plan_money) as exit_plan_money,
                            sum(siroty_cont.exit_trud) as exit_trud,
                            sum(siroty_cont.exit_ptrud) as exit_ptrud,
                            sum(siroty_cont.exit_obuch) as exit_obuch,
                            sum(siroty_cont.exit_arm) as exit_arm,
                            sum(siroty_cont.exit_bez) as exit_bez,                               
                            sum(siroty_cont.obsh) as obsh
                            from siroty_cont, report, est where
                            siroty_cont.id_report = report.id_report
                            and report.id_est = est.id_est
                            and report.id_rep_type ='.$id_rep_type.'
                            and est.id_okr = '.$value['id_est']);
                    $data_s = $command->queryAll();
                    $data[$k] = $data_s[0];
                    $data[$k]['id_okr'] = $value['est_name'];
                }
                $pokaz = Siroty_cont::model()->attributeLabels();
                //array_shift($pokaz);
                $pokaz = array_slice($pokaz, 1, -2);
                $dabavka = array('id_okr'=>'Округ');
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
                $aSheet->setTitle('Контингент сирот');
                $aSheet->getColumnDimension('A')->setWidth(25);
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
                header('Content-Disposition: attachment;filename="siroty_okr.xls"');
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