<?php

class Site2024Controller extends Controller
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
        
        public function actionExcel_obl($id_rep_type) {
            $this->loadRepName($id_rep_type);
            $criteria = new CDbCriteria;
            $criteria->with = array(
                'report' => array(
                    'joinType' => 'INNER JOIN',
                    'condition' => 'report.id_rep_type = :id_rep_type',
                    'params' => array(':id_rep_type' => $id_rep_type),
                ),
            );
           
            // Выполнение запроса
            $items = Site2024::model()->findAll($criteria);

            foreach($items as $i=>$item) {
                $res[$i]['okr'] = $this->loadEst($item->report->est->id_okr)->est_name;
                $res[$i]['raion'] = $this->loadEst($item->report->est->id_raion)->est_name;
                $res[$i]['est_name'] = $item->report->est->est_name;
                $res[$i]['site'] = $item->site2;
                for($k = 1; $k < 80; $k++) {
                    $pok = 'pok'.$k;
                    if($k == 19) continue;
                    else $res[$i][$pok] = $item->$pok;                    
                }
                $res[$i]['p_date'] = $item->p_date; 
                $res[$i]['red'] = $item->red; 
                $res[$i]['remark'] = $item->remark; 
            }
            $pokaz_src = Site2024::model()->attributeLabels();
            foreach ($pokaz_src as $key=>$item) {
                if($key == 'id_report' || $key == 'pok19') continue;
                $pokaz[$key] = $item;
            }
            $dabavka = array('id_okr'=>'Округ', 'id_raion'=>'Район', 'est_name'=>'Учреждение');
            $pokaz = $dabavka + $pokaz;
            

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
            $aSheet->setTitle('Проверка сайтов');
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
            for($i = 0; $i < sizeof($res); $i++) {
                $k = 0;
                foreach ($res[$i] as $value) {
                    $aSheet->setCellValueByColumnAndRow($k, ($i + 3), $value);
                    $k = $k + 1;
                }
            }
            include($phpExcelPath . DIRECTORY_SEPARATOR.'PHPExcel/Writer/Excel5.php');
            $objWriter = new PHPExcel_Writer_Excel5($pExcel);
            header('Content-Type: application/vnd.ms-excel');
            header('Content-Disposition: attachment;filename="site2024.xls"');
            header('Cache-Control: max-age=0');
            $objWriter->save('php://output');
            spl_autoload_register(array('YiiBase','autoload'));           
        }

        public function actionExcel_spo_obl($id_rep_type) {
            $this->loadRepName($id_rep_type);
            $criteria = new CDbCriteria;
            $criteria->with = array(
                'report' => array(
                    'joinType' => 'INNER JOIN',
                    'condition' => 'report.id_rep_type = :id_rep_type',
                    'params' => array(':id_rep_type' => $id_rep_type),
                ),
            );
           
            // Выполнение запроса
            $items = Site2024_spo::model()->findAll($criteria);

            foreach($items as $i=>$item) {
                $res[$i]['okr'] = $this->loadEst($item->report->est->id_okr)->est_name;;
                $res[$i]['raion'] = $this->loadEst($item->report->est->id_raion)->est_name;
                $res[$i]['est_name'] = $item->report->est->est_name;
                $res[$i]['site'] = $item->site2;
                for($k = 1; $k < 83; $k++) {
                    $pok = 'pok'.$k;
                    if($k == 19) continue;
                    else $res[$i][$pok] = $item->$pok;                    
                }
                $res[$i]['p_date'] = $item->p_date; 
                $res[$i]['red'] = $item->red; 
                $res[$i]['remark'] = $item->remark; 
            }
            $pokaz_src = Site2024_spo::model()->attributeLabels();
            foreach ($pokaz_src as $key=>$item) {
                if($key == 'id_report' || $key == 'pok19') continue;
                $pokaz[$key] = $item;
            }
            $dabavka = array('id_okr'=>'Округ', 'id_raion'=>'Район', 'est_name'=>'Учреждение');
            $pokaz = $dabavka + $pokaz;
            

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
            $aSheet->setTitle('Проверка сайтов');
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
            $aSheet->getStyle('A2:DH2')->getFont()->setBold(true);
            $aSheet->getRowDimension('2')->setRowHeight(100);
            for($i = 0; $i < sizeof($res); $i++) {
                $k = 0;
                foreach ($res[$i] as $value) {
                    $aSheet->setCellValueByColumnAndRow($k, ($i + 3), $value);
                    $k = $k + 1;
                }
            }
            include($phpExcelPath . DIRECTORY_SEPARATOR.'PHPExcel/Writer/Excel5.php');
            $objWriter = new PHPExcel_Writer_Excel5($pExcel);
            header('Content-Type: application/vnd.ms-excel');
            header('Content-Disposition: attachment;filename="site2024_spo.xls"');
            header('Cache-Control: max-age=0');
            $objWriter->save('php://output');
            spl_autoload_register(array('YiiBase','autoload'));           
        }        
        
        public function actionExcel_okr($id_rep_type, $id_okr) {
            $this->loadRepName($id_rep_type);
            $okr = $this->loadEst($id_okr);
            $criteria = new CDbCriteria;
            $criteria->with = array(
                'report' => array(
                    'joinType' => 'INNER JOIN',
                    'condition' => 'report.id_rep_type = :id_rep_type',
                    'params' => array(':id_rep_type' => $id_rep_type),
                    'with' => array(
                        'est' => array(
                            'joinType' => 'INNER JOIN',
                            'condition' => 'est.id_okr = :id_okr',
                            'params' => array(':id_okr' => $id_okr),
                        ),
                    ),
                ),
            );
           
            // Выполнение запроса
            $items = Site2024::model()->findAll($criteria);

            foreach($items as $i=>$item) {
                $res[$i]['okr'] = $okr->est_name;
                $res[$i]['raion'] = $this->loadEst($item->report->est->id_raion)->est_name;
                $res[$i]['est_name'] = $item->report->est->est_name;
                $res[$i]['site'] = $item->site2;
                for($k = 1; $k < 80; $k++) {
                    $pok = 'pok'.$k;
                    if($k == 19) continue;
                    else $res[$i][$pok] = $item->$pok;                    
                }
                $res[$i]['p_date'] = $item->p_date; 
                $res[$i]['red'] = $item->red; 
                $res[$i]['remark'] = $item->remark; 
            }
            $pokaz_src = Site2024::model()->attributeLabels();
            foreach ($pokaz_src as $key=>$item) {
                if($key == 'id_report' || $key == 'pok19') continue;
                $pokaz[$key] = $item;
            }
            $dabavka = array('id_okr'=>'Округ', 'id_raion'=>'Район', 'est_name'=>'Учреждение');
            $pokaz = $dabavka + $pokaz;
            

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
            $aSheet->setTitle('Проверка сайтов');
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
            for($i = 0; $i < sizeof($res); $i++) {
                $k = 0;
                foreach ($res[$i] as $value) {
                    $aSheet->setCellValueByColumnAndRow($k, ($i + 3), $value);
                    $k = $k + 1;
                }
            }
            include($phpExcelPath . DIRECTORY_SEPARATOR.'PHPExcel/Writer/Excel5.php');
            $objWriter = new PHPExcel_Writer_Excel5($pExcel);
            header('Content-Type: application/vnd.ms-excel');
            header('Content-Disposition: attachment;filename="site2024.xls"');
            header('Cache-Control: max-age=0');
            $objWriter->save('php://output');
            spl_autoload_register(array('YiiBase','autoload'));           
        }
       
        
        protected function loadRepName($id_rep_type)
        {
            $model = RepName::model()->findByPk((int)$id_rep_type);
            if($model === null) throw new CHttpException(404,'The requested page does not exist.');
            return $model;
        }

        protected function loadEst($id_est)
        {
            $model = Est::model()->findByPk((int)$id_est);
            if($model === null) throw new CHttpException(404,'The requested page does not exist2.');
            return $model;
        }
                
}        