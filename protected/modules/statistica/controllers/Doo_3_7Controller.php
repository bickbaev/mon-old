<?php

class Doo_3_7Controller extends Controller
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
        
        
	public function actionIndex()
	{
            if (isset($_GET['id_rep_type']) && $_GET['id_rep_type'] != '') {
                $id_rep_type = (int) $_GET['id_rep_type'];
                $otchet = Yii::app()->db->createCommand('select rep_name, DATE_FORMAT(s_date, "%d.%m.%Y") AS s_date, DATE_FORMAT(f_date, "%d.%m.%Y") AS f_date from rep_name where id_rep_type ='.$id_rep_type)->queryRow();
                if(Yii::app()->session['type_adm'] == 3) {
                    $okr = array();
                }
                elseif(Yii::app()->session['type_adm'] == 4) {
                    $okr = Yii::app()->db->createCommand('select id_est, est_name from est where type_adm = 3')->queryAll();
                }
                else {
                    throw new CHttpException(403,'У Вас нет необходимых прав');
                }
                $this->render('index', array('id_rep_type' => $id_rep_type, 'otchet' => $otchet, 'okr'=>$okr));
            }
            else $this->redirect(Yii::app()->user->returnUrl);
        }

        public function actionExcel_mun($id_rep_type) {
            if(!Yii::app()->session['type_adm']) $this->redirect(Yii::app()->user->returnUrl);
            $id_rep_type = (int)$id_rep_type;
            $otchet = Yii::app()->db->createCommand('select rep_name, DATE_FORMAT(s_date, "%d.%m.%Y") AS s_date, DATE_FORMAT(f_date, "%d.%m.%Y") AS f_date from rep_name where id_rep_type ='.$id_rep_type)->queryRow();                            
            if(!sizeof($otchet)) throw new CHttpException(403,'У Вас нет необходимых прав');
            $reader = Yii::app()->db->createCommand('select id_est, est_name from est where type_adm = 2')->queryAll();
            foreach ($reader as $value) {
                $mun[$value['id_est']] = $value['est_name'];
            }
            $reader = Yii::app()->db->createCommand('select id_est, est_name from est where type_adm = 3')->queryAll();
            foreach ($reader as $value) {
                $okr[$value['id_est']] = $value['est_name'];
            }            
            $data = Yii::app()->db->createCommand('select
                est.id_okr as id_okr,                
                est.id_raion as id_mun,
                doo_3_7.pok1,
                doo_3_7.pok2,
                doo_3_7.pok3,
                doo_3_7.pok4,
                doo_3_7.pok5,
                doo_3_7.pok6,
                doo_3_7.pok7,
                doo_3_7.pok8,
                doo_3_7.pok9,
                doo_3_7.pok10,
                doo_3_7.pok11,
                doo_3_7.pok12,
                doo_3_7.pok13,
                doo_3_7.pok14,
                doo_3_7.pok15,
                doo_3_7.pok16,
                doo_3_7.pok17,
                doo_3_7.pok18,
                doo_3_7.pok19,
                doo_3_7.remark
                from doo_3_7, report, est where
                doo_3_7.id_report = report.id_report 
                and report.id_est = est.id_est 
                and report.id_rep_type ='.$id_rep_type.' order by est.id_okr ASC')->queryAll();
            
            for($i = 0; $i <sizeof($data); $i++) {
                $data[$i]['id_mun'] = $mun[$data[$i]['id_mun']];
                $data[$i]['id_okr'] = $okr[$data[$i]['id_okr']];
            }
            //print_r($data);
            $pokaz = Doo_3_7::model()->attributeLabels();
            $pokaz = array_slice($pokaz, 1, 20);
            $mun = array('id_okr'=>'Управление', 'mun'=>'Муниципалитет');
            $pokaz = array_merge($mun, $pokaz);
            $zag = 'Отчет - '.$otchet['rep_name'].' период '.$otchet['s_date'].'-'.$otchet['f_date'];            
            //echo $_SERVER['SCRIPT_FILENAME'];
            //$this->render('excel_mun', array('data' => $data, 'pokaz' =>$pokaz, 'zag'=>$zag));
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
            $aSheet->setTitle('ДОО_3_7');
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
            header('Content-Disposition: attachment;filename="excel_mun.xls"');
            header('Cache-Control: max-age=0');
            $objWriter->save('php://output');
            spl_autoload_register(array('YiiBase','autoload'));            
        }
        
        public function actionExcel($id_rep_type, $id_okr) {
            if(Yii::app()->session['type_adm'] < 3) $this->redirect(Yii::app()->user->returnUrl);
            $id_rep_type = (int)$id_rep_type;
            $otchet = Yii::app()->db->createCommand('select rep_name, DATE_FORMAT(s_date, "%d.%m.%Y") AS s_date, DATE_FORMAT(f_date, "%d.%m.%Y") AS f_date from rep_name where id_rep_type ='.$id_rep_type)->queryRow();                            
            if(!sizeof($otchet)) throw new CHttpException(403,'У Вас нет необходимых прав');
            $id_okr = (int)$id_okr;
            if($id_okr) {
                $okr = Yii::app()->db->createCommand('select est_name from est where type_adm = 3 and id_est ='.$id_okr)->queryScalar();
                if(!$okr) throw new CHttpException(403,'У Вас нет необходимых прав');
            }
            else $okr = '';
            $sql = 'select
                sum(doo_3_7.pok1) as pok1,
                sum(doo_3_7.pok2) as pok2,
                sum(doo_3_7.pok3) as pok3,
                sum(doo_3_7.pok4) as pok4,
                sum(doo_3_7.pok5) as pok5,
                sum(doo_3_7.pok6) as pok6,
                sum(doo_3_7.pok7) as pok7,
                sum(doo_3_7.pok8) as pok8,
                sum(doo_3_7.pok9) as pok9,
                sum(doo_3_7.pok10) as pok10,
                sum(doo_3_7.pok11) as pok11,
                sum(doo_3_7.pok12) as pok12,
                sum(doo_3_7.pok13) as pok13,
                sum(doo_3_7.pok14) as pok14,
                sum(doo_3_7.pok15) as pok15,
                sum(doo_3_7.pok16) as pok16,
                sum(doo_3_7.pok17) as pok17,
                sum(doo_3_7.pok18) as pok18,
                sum(doo_3_7.pok19) as pok19
                from doo_3_7, report, est where
                doo_3_7.id_report = report.id_report 
                and report.id_est = est.id_est 
                and report.id_rep_type ='.$id_rep_type;
            if($id_okr > 0) $sql = $sql.' and est.id_okr = '.$id_okr;
            $data = Yii::app()->db->createCommand($sql)->queryAll();
            //print_r($data[0]);
            $this->render('excel', array('data' => $data[0], 'okr'=>$okr, 'f_date'=>$otchet['f_date'])); 
        }        
        
}         

