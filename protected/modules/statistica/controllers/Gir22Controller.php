<?php

class Gir22Controller extends Controller
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
                'accessControl'
            );
        }

        function filterAccessControl($filterChain)
        {
            if (Yii::app()->user->isGuest)
                    $this->redirect('index.php?r=site/login');
            else
                    $filterChain->run();
        }
        
	public function actionIndex($id_rep_type)
        {
            $id_rep_type = (int) $_GET['id_rep_type'];
            $command = Yii::app()->db->createCommand('select rep_name, DATE_FORMAT(s_date, "%d.%m.%Y") AS s_date, DATE_FORMAT(f_date, "%d.%m.%Y") AS f_date from rep_name where id_rep_type ='.$id_rep_type);
            $otchet = $command->queryRow();  
            if(!sizeof($otchet)) $this->redirect(Yii::app()->user->returnUrl);
            $this->render('index', array('otchet'=> $otchet, 'id_rep_type'=>$id_rep_type));
        }
        
        public function actionExcel_otv($id_rep_type) {
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
                            gir22_otv.name as name,
                            gir22_otv.par as par,
                            gir22_otv.sur as sur,
                            gir22_otv.dol as dol,
                            gir22_otv.cod_phone as cod_phone,
                            gir22_otv.phone as phone,
                            gir22_otv.mail as mail
                            from gir22_otv, report, est where
                            gir22_otv.id_report = report.id_report 
                            and report.id_est = est.id_est
                            and report.id_rep_type ='.$id_rep_type.' order by est.id_okr, est.id_raion, est.est_name');
                    $data = $command->queryAll();
                }
                else {
                    if(Yii::app()->session['parent'] != 1) $this->redirect(Yii::app()->user->returnUrl);
                    $command = Yii::app()->db->createCommand('select
                            est.id_okr as id_okr,
                            est.id_raion as id_raion,
                            est.est_name as est_name,
                            gir22_otv.name as name,
                            gir22_otv.par as par,
                            gir22_otv.sur as sur,
                            gir22_otv.dol as dol,
                            gir22_otv.cod_phone as cod_phone,
                            gir22_otv.phone as phone,
                            gir22_otv.mail as mail
                            from gir22_otv, report, est where
                            gir22_otv.id_report = report.id_report  
                            and report.id_est = est.id_est
                            and report.id_rep_type ='.$id_rep_type.'
                            and est.id_okr = '.Yii::app()->session['est'].' order by est.id_okr, est.id_raion, est.est_name');
                    $data = $command->queryAll();                    
                }
                for($i=0; $i <sizeof($data); $i++) {
                    $data[$i]['id_okr'] = $okrug[$data[$i]['id_okr']];
                    $data[$i]['id_raion'] = $raion[$data[$i]['id_raion']];
                }
                for($i=0; $i <sizeof($data); $i++) {
                    $itog_res[$i]['id_okr'] = $data[$i]['id_okr'];
                    $itog_res[$i]['id_raion'] = $data[$i]['id_raion'];
                    $itog_res[$i]['est_name'] = $data[$i]['est_name'];
                    $itog_res[$i]['fio'] = $data[$i]['sur'].' '.$data[$i]['name'].' '.$data[$i]['par'];
                    $itog_res[$i]['dol'] = $data[$i]['dol'];
                    if($data[$i]['phone']) $itog_res[$i]['phone'] = '('.$data[$i]['cod_phone'].')'.$data[$i]['phone'];
                    else $itog_res[$i]['phone'] = '';
                    $itog_res[$i]['email'] = $data[$i]['mail'];
                }                
                /*$pok_zam = array('pok1', 'pok2', 'pok3', 'pok4', 'pok5', 'pok21', 'pok22', 'pok23', 'pok24', 'pok25', 'pok26', 'pok27', 'pok28', 'pok29', 'pok30', 'pok31', 'pok32', 'pok33', 'pok34', 'pok35', 'pok36', 'pok37', 'pok38', 'pok39', 'pok40', 'pok41', 'pok42', 'pok43', 'pok44', 'pok45', 'pok46', 'pok47', 'pok48');
                foreach($data as $i => $dt) {
                    foreach($pok_zam as $zam) {
                        if($dt[$zam]) $data[$i][$zam] = $dt[$zam] - 1;                                     
                    }
                }*/
                //print_r($data);
                /*$pokaz = Mkf22::model()->attributeLabels();
                array_shift($pokaz);
                $dabavka = array('id_okr'=>'Округ', 'id_raion'=>'Район', 'est_name'=>'Организация');
                $pokaz = $dabavka + $pokaz;*/
                $pokaz = array('Округ', 'Район', 'Учреждение', 'ФИО', 'Должность', 'Телефон', 'Электронная почта');
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
                $aSheet->setTitle('ГИР');
                $aSheet->getColumnDimension('A')->setWidth(25);
                $aSheet->getColumnDimension('B')->setWidth(25);
                $aSheet->getColumnDimension('C')->setWidth(40);
                $aSheet->getColumnDimension('D')->setWidth(40);
                $aSheet->getColumnDimension('E')->setWidth(40);
                $aSheet->getColumnDimension('F')->setWidth(25);
                $aSheet->getColumnDimension('G')->setWidth(30);
                $aSheet->setCellValue('A1',$zag);
                $aSheet->getStyle('A1')->getFont()->setBold(true);
                $i = 0;
                foreach ($pokaz as $value) {                
                    $aSheet->setCellValueByColumnAndRow($i, 2, $value);
                    $i = $i + 1;
                }
                $left = array(
                    'alignment'=>array(
                        'horizontal'=>PHPExcel_Style_Alignment::HORIZONTAL_LEFT,
                        'vertical'=>PHPExcel_Style_Alignment::VERTICAL_TOP
                    ),                    
                );                
                $aSheet->getStyle('A2:BC2')->getFont()->setBold(true);
                $aSheet->getStyle('A2:BC2')->getAlignment()->setWrapText(true);
                $aSheet->getStyle('A2:BC2')->applyFromArray($left);
                $aSheet->getRowDimension('2')->setRowHeight(200);
                for($i = 0; $i < sizeof($itog_res); $i++) {
                    $k = 0;
                    foreach ($itog_res[$i] as $value) {                
                        $aSheet->setCellValueByColumnAndRow($k, ($i + 3), $value);
                        $k = $k + 1;
                    }
                }                   
                include($phpExcelPath . DIRECTORY_SEPARATOR.'PHPExcel/Writer/Excel5.php');
                $objWriter = new PHPExcel_Writer_Excel5($pExcel);
                header('Content-Type: application/vnd.ms-excel');
                header('Content-Disposition: attachment;filename="gir22_otv.xls"');
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

        public function actionExcel($id_rep_type) {
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
                            gir22.pok1,
                            gir22.pok2,
                            gir22.pok3,
                            gir22.pok4,
                            gir22.pok5,
                            gir22.pok6,
                            gir22.pok7,
                            gir22.pok8,
                            gir22.pok9,
                            gir22.pok10,
                            gir22.pok11,
                            gir22.pok12,
                            gir22.pok13,
                            gir22.pok14,
                            gir22.pok15,
                            gir22.pok16,
                            gir22.pok17,
                            gir22.pok18,
                            gir22.pok19,
                            gir22.pok20,
                            gir22.pok21,
                            gir22.pok22,
                            gir22.pok23,
                            gir22.pok24,
                            gir22.pok25,
                            gir22.pok26,
                            gir22.pok27,
                            gir22.pok28,
                            gir22.pok29,
                            gir22.pok30,
                            gir22.pok31,
                            gir22.pok32,
                            gir22.pok33,
                            gir22.pok34,
                            gir22.pok35,
                            gir22.pok36,
                            gir22.pok37,
                            gir22.pok38,
                            gir22.pok39,
                            gir22.pok40
                            from gir22, report, est where
                            gir22.id_report = report.id_report 
                            and report.id_est = est.id_est
                            and report.id_rep_type ='.$id_rep_type.' order by est.id_okr, est.id_raion, est.est_name');
                    $data = $command->queryAll();
                }
                else {
                    if(Yii::app()->session['parent'] != 1) $this->redirect(Yii::app()->user->returnUrl);
                    $command = Yii::app()->db->createCommand('select
                            est.id_okr as id_okr,
                            est.id_raion as id_raion,
                            est.est_name as est_name,
                            gir22.pok1,
                            gir22.pok2,
                            gir22.pok3,
                            gir22.pok4,
                            gir22.pok5,
                            gir22.pok6,
                            gir22.pok7,
                            gir22.pok8,
                            gir22.pok9,
                            gir22.pok10,
                            gir22.pok11,
                            gir22.pok12,
                            gir22.pok13,
                            gir22.pok14,
                            gir22.pok15,
                            gir22.pok16,
                            gir22.pok17,
                            gir22.pok18,
                            gir22.pok19,
                            gir22.pok20,
                            gir22.pok21,
                            gir22.pok22,
                            gir22.pok23,
                            gir22.pok24,
                            gir22.pok25,
                            gir22.pok26,
                            gir22.pok27,
                            gir22.pok28,
                            gir22.pok29,
                            gir22.pok30,
                            gir22.pok31,
                            gir22.pok32,
                            gir22.pok33,
                            gir22.pok34,
                            gir22.pok35,
                            gir22.pok36,
                            gir22.pok37,
                            gir22.pok38,
                            gir22.pok39,
                            gir22.pok40
                            from gir22, report, est where
                            gir22.id_report = report.id_report 
                            and report.id_est = est.id_est
                            and report.id_rep_type ='.$id_rep_type.'
                            and est.id_okr = '.Yii::app()->session['est'].' order by est.id_okr, est.id_raion, est.est_name');
                    $data = $command->queryAll();                    
                }
                $par = array(1=>'10', 2=>'11');
                for($i=0; $i <sizeof($data); $i++) {
                    $data[$i]['id_okr'] = $okrug[$data[$i]['id_okr']];
                    $data[$i]['id_raion'] = $raion[$data[$i]['id_raion']];
                    $data[$i]['pok1'] = $par[$data[$i]['pok1']];
                }
                /*$pok_zam = array('pok1', 'pok2', 'pok3', 'pok4', 'pok5', 'pok21', 'pok22', 'pok23', 'pok24', 'pok25', 'pok26', 'pok27', 'pok28', 'pok29', 'pok30', 'pok31', 'pok32', 'pok33', 'pok34', 'pok35', 'pok36', 'pok37', 'pok38', 'pok39', 'pok40', 'pok41', 'pok42', 'pok43', 'pok44', 'pok45', 'pok46', 'pok47', 'pok48');
                foreach($data as $i => $dt) {
                    foreach($pok_zam as $zam) {
                        if($dt[$zam]) $data[$i][$zam] = $dt[$zam] - 1;                                     
                    }
                }*/
                //print_r($data);
                /*$pokaz = Gir22::model()->attributeLabels();
                array_shift($pokaz);
                $dabavka = array('id_okr'=>'Округ', 'id_raion'=>'Район', 'est_name'=>'Учреждение');
                $pokaz = $dabavka + $pokaz;*/
                $pokaz = array('Округ', 'Район', 'Учреждение', 'Параллель', 'Первая буква фамилии обучающегося', 'Имя обучающего', 'Русский язык', 'Средний балл', 'Математика', 'Средний балл', 'Литература', 'Средний балл', 'Физика', 'Средний балл', 'Химия', 'Средний балл', 'Биология', 'Средний балл', 'География', 'Средний балл', 'История', 'Средний балл', 'Обществознание', 'Средний балл', 'Иностранный язык (английский)', 'Средний балл', 'Иностранный язык (немецкий)', 'Средний балл', 'Иностранный язык (французский)', 'Средний балл', 'Иностранный язык (испанский)', 'Средний балл', 'Иностранный язык (китайский)', 'Средний балл', 'Информатика и информационно-коммуникационные технологии (ИКТ)', 'Средний балл', 'Результаты  участия за последние два учебных года в олимпиадах и конкурсах', 'Предполагаемый для поступления ВУЗ 1', 'Специальность', 'Предполагаемый для поступления ВУЗ 2', 'Специальность', 'Предполагаемый для поступления ВУЗ 3', 'Специальность');
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
                $aSheet->setTitle('ГИР');
                $aSheet->getColumnDimension('A')->setWidth(25);
                $aSheet->getColumnDimension('B')->setWidth(25);
                $aSheet->getColumnDimension('C')->setWidth(40);               
                $aSheet->setCellValue('A1',$zag);
                $aSheet->getStyle('A1')->getFont()->setBold(true);
                $i = 0;
                foreach ($pokaz as $value) {                
                    $aSheet->setCellValueByColumnAndRow($i, 2, $value);
                    $i = $i + 1;
                }
                $left = array(
                    'alignment'=>array(
                        'horizontal'=>PHPExcel_Style_Alignment::HORIZONTAL_LEFT,
                        'vertical'=>PHPExcel_Style_Alignment::VERTICAL_TOP
                    ),                    
                );                
                $aSheet->getStyle('A2:BC2')->getFont()->setBold(true);
                $aSheet->getStyle('A2:BC2')->getAlignment()->setWrapText(true);
                $aSheet->getStyle('A2:BC2')->applyFromArray($left);
                $aSheet->getRowDimension('2')->setRowHeight(200);
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
                header('Content-Disposition: attachment;filename="gir22.xls"');
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
