<?php

class Zpmp_school_2022Controller extends Controller
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
        
        public function actionIndex($id_rep_type) {
            $rep_name = $this->loadRep_name($id_rep_type);
            if(Yii::app()->session['type_adm'] < 3) $this->redirect(Yii::app()->user->returnUrl);
            if(Yii::app()->session['type_adm'] == 3) $this->redirect($this->createUrl('zpmp_school_2022/okr',array('id_okr'=>Yii::app()->session['est'], 'id_rep_type' => $id_rep_type)));
            $okrs = Yii::app()->db->createCommand('SELECT id_est, est_name from est where type_adm = 3')->queryAll();
            foreach($okrs as $i=>$okr) {
                $itog[$i]['id'] = $okr['id_est'];
                $itog[$i]['naim'] = $okr['est_name'];
                $itog[$i]['items'] = Yii::app()->db->createCommand('select count(z.id_zpmp) from zpmp_school_2022 as z, report, est where z.id_report = report.id_report and report.id_est = est.id_est and est.id_okr = '.$okr['id_est'])->queryScalar();
            }
            $itog_data['naim'] = 'Область';
            $itog_data['items'] = Yii::app()->db->createCommand('select count(z.id_zpmp) from zpmp_school_2022 as z')->queryScalar();            
            $itogProvider = new CArrayDataProvider($itog, array(  
                 'pagination' => array(  
                    'pageSize' => 20,  
                 ),  
            ));
            $this->render('index',array(
                'rep_name'=>$rep_name,
                'itogProvider' => $itogProvider,
                'itog_data' => $itog_data,
            ));            
        }
        
        public function actionOkr($id_okr, $id_rep_type) {
            $rep_name = $this->loadRep_name($id_rep_type);
            if(Yii::app()->session['type_adm'] < 3) $this->redirect(Yii::app()->user->returnUrl);
            if(Yii::app()->session['type_adm'] == 3) $id_okr = Yii::app()->session['est'];
            $okr = Yii::app()->db->createCommand('SELECT id_est, est_name from est where type_adm = 3 and id_est = '.(int)$id_okr)->queryRow();
            if(!is_array($okr)) $this->redirect(Yii::app()->user->returnUrl);            
            $muns = Yii::app()->db->createCommand('SELECT id_est, est_name from est where type_adm = 2 and id_okr = '.$okr['id_est'])->queryAll();            
            if(sizeof($muns) == 1) $this->redirect($this->createUrl('zpmp_school_2022/mun',array('id_mun'=>$muns[0]['id_est'], 'id_rep_type' => $id_rep_type)));
            foreach($muns as $i=>$mun) {
                $itog[$i]['id'] = $mun['id_est'];
                $itog[$i]['naim'] = $mun['est_name'];
                $itog[$i]['items'] = Yii::app()->db->createCommand('select count(z.id_zpmp) from zpmp_school_2022 as z, report, est where z.id_report = report.id_report and report.id_est = est.id_est and est.id_raion = '.$mun['id_est'])->queryScalar();
            }
            $itog_data['naim'] = $okr['est_name'];
            $itog_data['items'] = Yii::app()->db->createCommand('select count(z.id_zpmp) from zpmp_school_2022 as z, report, est where z.id_report = report.id_report and report.id_est = est.id_est and est.id_okr = '.$okr['id_est'])->queryScalar();            
            $itogProvider = new CArrayDataProvider($itog, array(  
                 'pagination' => array(  
                    'pageSize' => 20,  
                 ),  
            ));
            $this->render('okr',array(
                'rep_name'=>$rep_name,
                'itogProvider' => $itogProvider,
                'itog_data' => $itog_data,
            ));            
        }

        public function actionMun($id_mun, $id_rep_type) {
            $rep_name = $this->loadRep_name($id_rep_type);
            if(Yii::app()->session['type_adm'] < 3) $this->redirect(Yii::app()->user->returnUrl);
            $mun = Yii::app()->db->createCommand('SELECT id_est, est_name from est where type_adm = 2 and id_est = '.(int)$id_mun)->queryRow();
            if(!is_array($mun)) $this->redirect(Yii::app()->user->returnUrl);
            if(Yii::app()->session['type_adm'] == 3) {
                $mun_pr = Yii::app()->db->createCommand('SELECT id_est, est_name from est where type_adm = 2 and id_okr = '.Yii::app()->session['est'].' and id_est = '.(int)$id_mun)->queryRow();
                if(!is_array($mun_pr)) $this->redirect(Yii::app()->user->returnUrl);                 
            }            
            $sads = Yii::app()->db->createCommand('SELECT est.id_est, est.est_name, report.id_report from report, est where est.id_est = report.id_est and report.id_rep_type = '.$rep_name->id_rep_type.' and est.id_raion = '.$mun['id_est'].' order by est.id_type, est.est_name')->queryAll();            
            foreach($sads as $i=>$sad) {
                $itog[$i]['id'] = $sad['id_est'];
                $itog[$i]['naim'] = $sad['est_name'];
                $itog[$i]['items'] = Yii::app()->db->createCommand('select count(z.id_zpmp) from zpmp_school_2022 as z where z.id_report = '.$sad['id_report'])->queryScalar();
            }
            $itog_data['naim'] = $mun['est_name'];
            $itog_data['items'] = Yii::app()->db->createCommand('select count(z.id_zpmp) from zpmp_school_2022 as z, report, est where z.id_report = report.id_report and report.id_est = est.id_est and est.id_raion = '.$mun['id_est'])->queryScalar();            
            $itogProvider = new CArrayDataProvider($itog, array(  
                 'pagination' => array(  
                    'pageSize' => 200,  
                 ),  
            ));
            $this->render('mun',array(
                'rep_name'=>$rep_name,
                'itogProvider' => $itogProvider,
                'itog_data' => $itog_data,
            ));            
        }        
        
        public function actionExcel($id_rep_type) {
            if(Yii::app()->session['id'] != 'bickbaev') throw new CHttpException(404,'The requested page does not exist.');
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
                $command = Yii::app()->db->createCommand('select id_mun, naim_mun from mun');
                $reader = $command->queryAll();
                foreach ($reader as $value) {
                    $mun[$value['id_mun']] = $value['naim_mun'];
                }                
                $command = Yii::app()->db->createCommand('select
                        est.id_okr as id_okr,
                        est.id_raion as id_raion,
                        est.est_name as est_name,
                        zpmp_school_2022.id_zpmp,
                        zpmp_school_2022.pok1,
                        zpmp_school_2022.pok2,
                        zpmp_school_2022.pok3,
                        DATE_FORMAT(zpmp_school_2022.pok4, "%d.%m.%Y") AS pok4,
                        zpmp_school_2022.pok5,
                        zpmp_school_2022.pok6,
                        zpmp_school_2022.pok7,
                        zpmp_school_2022.pok8,
                        zpmp_school_2022.pok9,
                        zpmp_school_2022.pok10,
                        zpmp_school_2022.pok11,
                        zpmp_school_2022.pok12,
                        zpmp_school_2022.pok13,
                        zpmp_school_2022.pok14,
                        zpmp_school_2022.pok17,
                        zpmp_school_2022.pok18,
                        zpmp_school_2022.pok19
                        from zpmp_school_2022, report, est where
                        zpmp_school_2022.id_report = report.id_report 
                        and zpmp_school_2022.pok15 is null 
                        and report.id_est = est.id_est
                        and report.id_rep_type ='.$id_rep_type.' order by est.id_okr, est.id_raion, est.est_name');
                $data = $command->queryAll();

                $par = array(1 => 'мобилизованный', 2 => 'контрактник', 3 => 'доброволец');
                for($i = 0; $i <sizeof($data); $i++) {
                    $data[$i]['id_okr'] = $okrug[$data[$i]['id_okr']];
                    $data[$i]['id_raion'] = $raion[$data[$i]['id_raion']];
                    //$data[$i]['pok5'] = $mun[$data[$i]['pok5']];
                    $data[$i]['pok14'] = $par[$data[$i]['pok14']];
                    //if($data[$i]['pok18'] == '') $data[$i]['pok18'] = 63;
                }
                for($i = 0; $i <sizeof($data); $i++) {
                    $itog[$i]['id'] = $data[$i]['id_zpmp'];
                    $itog[$i]['id_okr'] = $data[$i]['id_okr'];
                    $itog[$i]['id_raion'] = $data[$i]['id_raion'];
                    $itog[$i]['est_name'] = $data[$i]['est_name'];
                    $itog[$i]['pok1'] = $data[$i]['pok1'];
                    $itog[$i]['pok2'] = $data[$i]['pok2'];
                    $itog[$i]['pok3'] = $data[$i]['pok3'];
                    $itog[$i]['pok4'] = $data[$i]['pok4'];
                    
                    if($data[$i]['pok17'] == 1) {
                        $itog[$i]['pok5'] = Region::model()->findByPk($data[$i]['pok18'])->naim_region;
                        $itog[$i]['pok6'] = $data[$i]['pok19'];
                    }
                    else {
                        $itog[$i]['pok5'] = 'Самарская область';
                        $itog[$i]['pok6'] = Mun::model()->findByPk($data[$i]['pok5'])->naim_mun;
                    }
                    $itog[$i]['pok7'] = $this->get_addr($data[$i]);
                    $itog[$i]['pok8'] = $data[$i]['pok14'];
                }
                //print_r($itog);
                //die();
                $pokaz = array('ID', 'Округ', 'Район', 'Учреждение', 'Фамилия', 'Имя', 'Отчество', 'Дата рождения', 'Регион', 'Муниципалитет', 'Адрес регистрации', 'Тип');
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
                $aSheet->setTitle('Питание в школе');
                $aSheet->getColumnDimension('B')->setWidth(25);
                $aSheet->getColumnDimension('C')->setWidth(25);
                $aSheet->getColumnDimension('D')->setWidth(40);
                $aSheet->getColumnDimension('E')->setWidth(15);
                $aSheet->getColumnDimension('F')->setWidth(15);
                $aSheet->getColumnDimension('G')->setWidth(15);
                $aSheet->getColumnDimension('H')->setWidth(15);
                $aSheet->getColumnDimension('I')->setWidth(25);
                $aSheet->getColumnDimension('J')->setWidth(25);
                $aSheet->getColumnDimension('K')->setWidth(40);
                $aSheet->getColumnDimension('L')->setWidth(15);
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
                $aSheet->getStyle('A2:L2')->getFont()->setBold(true);
                $aSheet->getStyle('A2:L2')->getAlignment()->setWrapText(true);
                $aSheet->getStyle('A2:L2')->applyFromArray($left);
                $aSheet->getRowDimension('2')->setRowHeight(50);
                for($i = 0; $i < sizeof($itog); $i++) {
                    $k = 0;
                    foreach ($itog[$i] as $value) {                
                        $aSheet->setCellValueByColumnAndRow($k, ($i + 3), $value);
                        $k = $k + 1;
                    }
                }                   
                include($phpExcelPath . DIRECTORY_SEPARATOR.'PHPExcel/Writer/Excel5.php');
                $objWriter = new PHPExcel_Writer_Excel5($pExcel);
                header('Content-Type: application/vnd.ms-excel');
                header('Content-Disposition: attachment;filename="zpmp_school_2022.xls"');
                header('Cache-Control: max-age=0');
                $objWriter->save('php://output');
                spl_autoload_register(array('YiiBase','autoload'));
            }
            else {
                header("Location: http://mon.cposo.ru/"); /* Redirect browser */
                exit;
            }
        }
        
        public function actionExcel_resh($id_rep_type) {
            if(Yii::app()->session['id'] != 'bickbaev') throw new CHttpException(404,'The requested page does not exist.');
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
                $command = Yii::app()->db->createCommand('select id_mun, naim_mun from mun');
                $reader = $command->queryAll();
                foreach ($reader as $value) {
                    $mun[$value['id_mun']] = $value['naim_mun'];
                }                
                $command = Yii::app()->db->createCommand('select
                        est.id_okr as id_okr,
                        est.id_raion as id_raion,
                        est.est_name as est_name,
                        zpmp_school_2022.id_zpmp,
                        zpmp_school_2022.pok1,
                        zpmp_school_2022.pok2,
                        zpmp_school_2022.pok3,
                        DATE_FORMAT(zpmp_school_2022.pok4, "%d.%m.%Y") AS pok4,
                        zpmp_school_2022.pok5,
                        zpmp_school_2022.pok6,
                        zpmp_school_2022.pok7,
                        zpmp_school_2022.pok8,
                        zpmp_school_2022.pok9,
                        zpmp_school_2022.pok10,
                        zpmp_school_2022.pok11,
                        zpmp_school_2022.pok12,
                        zpmp_school_2022.pok13,
                        zpmp_school_2022.pok14,
                        zpmp_school_2022.pok17,
                        zpmp_school_2022.pok18,
                        zpmp_school_2022.pok19,
                        zpmp_school_2022.pok15
                        from zpmp_school_2022, report, est where
                        zpmp_school_2022.id_report = report.id_report 
                        and zpmp_school_2022.pok15 is not null 
                        and report.id_est = est.id_est
                        and report.id_rep_type ='.$id_rep_type.' order by est.id_okr, est.id_raion, est.est_name');
                $data = $command->queryAll();

                $par = array(1 => 'мобилизованный', 2 => 'контрактник', 3 => 'доброволец');
                $resh = array(1 => 'нет', 2 => 'да');
                for($i = 0; $i <sizeof($data); $i++) {
                    $data[$i]['id_okr'] = $okrug[$data[$i]['id_okr']];
                    $data[$i]['id_raion'] = $raion[$data[$i]['id_raion']];
                    //$data[$i]['pok5'] = $mun[$data[$i]['pok5']];
                    $data[$i]['pok14'] = $par[$data[$i]['pok14']];
                    $data[$i]['pok15'] = $resh[$data[$i]['pok15']];
                    //if($data[$i]['pok18'] == '') $data[$i]['pok18'] = 63;
                }
                for($i = 0; $i <sizeof($data); $i++) {
                    $itog[$i]['id'] = $data[$i]['id_zpmp'];
                    $itog[$i]['id_okr'] = $data[$i]['id_okr'];
                    $itog[$i]['id_raion'] = $data[$i]['id_raion'];
                    $itog[$i]['est_name'] = $data[$i]['est_name'];
                    $itog[$i]['pok1'] = $data[$i]['pok1'];
                    $itog[$i]['pok2'] = $data[$i]['pok2'];
                    $itog[$i]['pok3'] = $data[$i]['pok3'];
                    $itog[$i]['pok4'] = $data[$i]['pok4'];
                    
                    if($data[$i]['pok17'] == 1) {
                        $itog[$i]['pok5'] = Region::model()->findByPk($data[$i]['pok18'])->naim_region;
                        $itog[$i]['pok6'] = $data[$i]['pok19'];
                    }
                    else {
                        $itog[$i]['pok5'] = 'Самарская область';
                        $itog[$i]['pok6'] = Mun::model()->findByPk($data[$i]['pok5'])->naim_mun;
                    }
                    $itog[$i]['pok7'] = $this->get_addr($data[$i]);
                    $itog[$i]['pok8'] = $data[$i]['pok14'];
                    $itog[$i]['pok9'] = $data[$i]['pok15'];
                }
                //print_r($itog);
                //die();
                $pokaz = array('ID', 'Округ', 'Район', 'Учреждение', 'Фамилия', 'Имя', 'Отчество', 'Дата рождения', 'Регион', 'Муниципалитет', 'Адрес регистрации', 'Тип', 'Решение');
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
                $aSheet->setTitle('Питание в школе');
                $aSheet->getColumnDimension('B')->setWidth(25);
                $aSheet->getColumnDimension('C')->setWidth(25);
                $aSheet->getColumnDimension('D')->setWidth(40);
                $aSheet->getColumnDimension('E')->setWidth(15);
                $aSheet->getColumnDimension('F')->setWidth(15);
                $aSheet->getColumnDimension('G')->setWidth(15);
                $aSheet->getColumnDimension('H')->setWidth(15);
                $aSheet->getColumnDimension('I')->setWidth(25);
                $aSheet->getColumnDimension('J')->setWidth(25);
                $aSheet->getColumnDimension('K')->setWidth(40);
                $aSheet->getColumnDimension('L')->setWidth(15);
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
                $aSheet->getStyle('A2:M2')->getFont()->setBold(true);
                $aSheet->getStyle('A2:M2')->getAlignment()->setWrapText(true);
                $aSheet->getStyle('A2:M2')->applyFromArray($left);
                $aSheet->getRowDimension('2')->setRowHeight(50);
                for($i = 0; $i < sizeof($itog); $i++) {
                    $k = 0;
                    foreach ($itog[$i] as $value) {                
                        $aSheet->setCellValueByColumnAndRow($k, ($i + 3), $value);
                        $k = $k + 1;
                    }
                }                   
                include($phpExcelPath . DIRECTORY_SEPARATOR.'PHPExcel/Writer/Excel5.php');
                $objWriter = new PHPExcel_Writer_Excel5($pExcel);
                header('Content-Type: application/vnd.ms-excel');
                header('Content-Disposition: attachment;filename="zpmp_school_2022.xls"');
                header('Cache-Control: max-age=0');
                $objWriter->save('php://output');
                spl_autoload_register(array('YiiBase','autoload'));
            }
            else {
                header("Location: http://mon.cposo.ru/"); /* Redirect browser */
                exit;
            }
        }        
        
        public function get_addr($data) {
            if($data['pok17'] == 1) {
                $gorod = Contact_gor::model()->findByPk($data['pok6'])->naim_gor.' '.$data['pok7'].', ';
            }
            else {
                if($data['pok5'] < 11) $gorod = '';
                else $gorod = Contact_gor::model()->findByPk($data['pok6'])->naim_gor.' '.$data['pok7'].', ';
            }    
            if($data['pok8'] == 22) $ul = $data['pok9'];
            else $ul = Contact_ul::model()->findByPk($data['pok8'])->naim_ul.' '.$data['pok9'];
            if(!$data['pok11']) $kv = '';
            else $kv = ', кв.'.$data['pok11'];
            return $gorod.$ul.', д.'.$data['pok10'].$kv;             
        }
        
        protected function loadRep_name($id_rep_type)
        {
            $model = RepName::model()->findByPk((int)$id_rep_type);
            if($model === null)
                throw new CHttpException(403,'У Вас нет необходимых прав');                          
            return $model;
        }         
        
}
        



