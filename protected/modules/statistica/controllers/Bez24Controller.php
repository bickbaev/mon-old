<?php

class Bez24Controller extends Controller
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
            if ($this->check_prava($id_rep_type)) { 
                $otchet = Yii::app()->db->createCommand('select rep_name, DATE_FORMAT(s_date, "%d.%m.%Y") AS s_date, DATE_FORMAT(f_date, "%d.%m.%Y") AS f_date from rep_name where id_rep_type ='.$id_rep_type)->queryRow();  
                if(!sizeof($otchet)) $this->redirect(Yii::app()->user->returnUrl);
                $this->render('index', array('otchet'=> $otchet, 'id_rep_type'=>$id_rep_type));
            }
        }        

        public function actionExcel($id_rep_type) {
            if (isset($_GET['id_rep_type']) && $_GET['id_rep_type'] != '') { 
                if(Yii::app()->session['type_adm'] < 3) $this->redirect(Yii::app()->user->returnUrl);
                $id_rep_type = (int) $_GET['id_rep_type'];
                $otchet = Yii::app()->db->createCommand('select rep_name, DATE_FORMAT(s_date, "%d.%m.%Y") AS s_date, DATE_FORMAT(f_date, "%d.%m.%Y") AS f_date from rep_name where id_rep_type ='.$id_rep_type)->queryRow();
                $reader = Yii::app()->db->createCommand('select id_est, est_name from est where type_adm = 3')->queryAll();
                foreach ($reader as $value) {
                    $okrug[$value['id_est']] = $value['est_name'];
                }
                $reader = Yii::app()->db->createCommand('select id_est, est_name from est where type_adm = 2')->queryAll();
                foreach ($reader as $value) {
                    $raion[$value['id_est']] = $value['est_name'];
                }
                $reader = Yii::app()->db->createCommand('select id_mun, naim_mun from mun')->queryAll();
                foreach ($reader as $value) {
                    $mun[$value['id_mun']] = $value['naim_mun'];
                }                
                if(Yii::app()->session['type_adm'] == 4) {
                    $command = Yii::app()->db->createCommand('select
                            est.id_okr as id_okr,
                            est.id_raion as id_raion,
                            est.est_name as est_name,
                            bez24.pok1,
                            bez24.pok2,
                            bez24.pok3,
                            DATE_FORMAT(bez24.pok4, "%d.%m.%Y"),
                            bez24.pok5,
                            bez24.pok6,
                            bez24.pok7,
                            bez24.pok8,
                            bez24.pok9,
                            bez24.pok10,
                            bez24.pok11,
                            bez24.pok12,
                            bez24.pok13,
                            bez24.pok14,
                            bez24.pok15,
                            bez24.pok16,
                            bez24.pok17,
                            bez24.pok18,
                            bez24.pok19,
                            bez24.pok20,
                            bez24.pok21,
                            bez24.pok22,
                            bez24.pok23,
                            bez24.pok24,
                            bez24.pok25,
                            DATE_FORMAT(create_date, "%d.%m.%Y %H:%i"),
                            DATE_FORMAT(red, "%d.%m.%Y %H:%i")
                            from bez24, report, est where
                            bez24.id_report = report.id_report 
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
                            bez24.pok1,
                            bez24.pok2,
                            bez24.pok3,
                            DATE_FORMAT(bez24.pok4, "%d.%m.%Y"),
                            bez24.pok5,
                            bez24.pok6,
                            bez24.pok7,
                            bez24.pok8,
                            bez24.pok9,
                            bez24.pok10,
                            bez24.pok11,
                            bez24.pok12,
                            bez24.pok13,
                            bez24.pok14,
                            bez24.pok15,
                            bez24.pok16,
                            bez24.pok17,
                            bez24.pok18,
                            bez24.pok19,
                            bez24.pok20,
                            bez24.pok21,
                            bez24.pok22,
                            bez24.pok23,
                            bez24.pok24,
                            bez24.pok25,
                            DATE_FORMAT(create_date, "%d.%m.%Y %H:%i"),
                            DATE_FORMAT(red, "%d.%m.%Y %H:%i")
                            from bez24, report, est where
                            bez24.id_report = report.id_report 
                            and report.id_est = est.id_est
                            and report.id_rep_type ='.$id_rep_type.'
                            and est.id_okr = '.Yii::app()->session['est'].' order by est.id_okr, est.id_raion, est.est_name');
                    $data = $command->queryAll();                    
                }
                for($i=0; $i <sizeof($data); $i++) {
                    $data[$i]['id_okr'] = $okrug[$data[$i]['id_okr']];
                    $data[$i]['id_raion'] = $raion[$data[$i]['id_raion']];
                    $data[$i]['pok10'] = $mun[$data[$i]['pok10']];
                    if($data[$i]['pok25'] == 0) $data[$i]['pok25'] = '';
                }
                $pokaz = Bez24::model()->attributeLabels();
                $dabavka = array('id_okr'=>'Округ', 'id_raion'=>'Район', 'est_name'=>'Учреждение');
                $pokaz = $dabavka + $pokaz;                
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
                $aSheet->setTitle('Прибывшие учащиеся');
                $aSheet->getColumnDimension('A')->setWidth(25);
                $aSheet->getColumnDimension('B')->setWidth(25);
                $aSheet->getColumnDimension('C')->setWidth(45);
                $aSheet->getColumnDimension('D')->setWidth(15);
                $aSheet->getColumnDimension('E')->setWidth(15);
                $aSheet->getColumnDimension('F')->setWidth(15);
                $aSheet->getColumnDimension('G')->setWidth(15);
                $aSheet->getColumnDimension('J')->setWidth(20);
                $aSheet->getColumnDimension('K')->setWidth(20);
                $aSheet->getColumnDimension('L')->setWidth(20);
                $aSheet->getColumnDimension('M')->setWidth(25);
                $aSheet->getColumnDimension('N')->setWidth(20);
                $aSheet->getColumnDimension('AC')->setWidth(15);
                $aSheet->getColumnDimension('AD')->setWidth(15);
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
                $aSheet->getStyle('A2:AD2')->getFont()->setBold(true);
                $aSheet->getStyle('A2:AD2')->getAlignment()->setWrapText(true);
                $aSheet->getStyle('A2:AD2')->applyFromArray($left);
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
                header('Content-Disposition: attachment;filename="bez24.xls"');
                header('Cache-Control: max-age=0');
                $objWriter->save('php://output');
                spl_autoload_register(array('YiiBase','autoload'));
            }
            else {
                header("Location: http://mon.cposo.ru/"); /* Redirect browser */
                exit;
            }
        } 

        protected function check_prava($id_rep_type)
        {
            $id_rep_type = (int)$id_rep_type;
            $rep_name = Yii::app()->db->createCommand('select rep_name from rep_name where id_rep_type = '.$id_rep_type)->queryScalar();
            if($rep_name && Yii::app()->session['type_adm'] > 2) { 
                return true;
            }            
            else throw new CHttpException(403,'У Вас нет необходимых прав');                
        }        
        
}
