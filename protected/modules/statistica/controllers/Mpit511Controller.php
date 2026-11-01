<?php

class Mpit511Controller extends Controller
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
            $otchet = Yii::app()->db->createCommand('select rep_name, DATE_FORMAT(s_date, "%d.%m.%Y") AS s_date, DATE_FORMAT(f_date, "%d.%m.%Y") AS f_date from rep_name where id_rep_type ='.$id_rep_type)->queryRow();
            $this->render('index', array('id_rep_type' => $id_rep_type, 'otchet' => $otchet));
        }

        public function actionExcel($id_rep_type) {
            $id_rep_type = (int)$id_rep_type;
            $otchet = Yii::app()->db->createCommand('select rep_name, DATE_FORMAT(s_date, "%d.%m.%Y") AS s_date, DATE_FORMAT(f_date, "%d.%m.%Y") AS f_date from rep_name where id_rep_type ='.$id_rep_type)->queryRow();            
            $reader = Yii::app()->db->createCommand('select id_est, est_name from est where type_adm = 3')->queryAll();
            foreach ($reader as $value) {
                $okrug[$value['id_est']] = $value['est_name'];
            }
            $reader = Yii::app()->db->createCommand('select id_est, est_name from est where type_adm = 2')->queryAll();
            foreach ($reader as $value) {
                $raion[$value['id_est']] = $value['est_name'];
            }
            
            if(Yii::app()->session['type_adm'] == 4) {
                $command = Yii::app()->db->createCommand('select
                        est.id_okr as id_okr,
                        est.id_raion as id_raion,
                        est.est_name as est_name,
                        mpit511.site2 as site2,
                        mpit511.pok1 as pok1,
                        mpit511.pok2 as pok2,
                        mpit511.pok3 as pok3,
                        mpit511.pok4 as pok4,
                        mpit511.pok5 as pok5,
                        mpit511.pok6 as pok6,
                        mpit511.pok7 as pok7,
                        mpit511.pok8 as pok8,
                        mpit511.pok9 as pok9,
                        mpit511.pok10 as pok10,
                        mpit511.pok11 as pok11,
                        mpit511.pok12 as pok12,
                        mpit511.pok13 as pok13,
                        mpit511.pok14 as pok14,
                        mpit511.pok15 as pok15,
                        mpit511.pok16 as pok16,
                        mpit511.pok17 as pok17,
                        mpit511.pok18 as pok18,
                        mpit511.pok19 as pok19,
                        mpit511.pok20 as pok20,
                        mpit511.pok21 as pok21,
                        mpit511.pok22 as pok22,
                        mpit511.pok23 as pok23,
                        mpit511.pok24 as pok24,
                        mpit511.pok25 as pok25,
                        mpit511.pok26 as pok26,
                        mpit511.pok27 as pok27,
                        mpit511.pok28 as pok28,
                        mpit511.pok29 as pok29,
                        mpit511.pok30 as pok30,
                        mpit511.pok31 as pok31,
                        mpit511.pok32 as pok32,
                        mpit511.pok33 as pok33
                        from mpit511, report, est where
                        mpit511.id_report = report.id_report 
                        and report.id_est = est.id_est
                        and report.id_rep_type ='.$id_rep_type.' order by est.id_okr, est.id_raion, est.est_name');
                $data = $command->queryAll();
            }
            else {
                if(Yii::app()->session['type_adm'] < 3) $this->redirect(Yii::app()->user->returnUrl);
                $command = Yii::app()->db->createCommand('select
                        est.id_okr as id_okr,
                        est.id_raion as id_raion,
                        est.est_name as est_name,
                        mpit511.site2 as site2,
                        mpit511.pok1 as pok1,
                        mpit511.pok2 as pok2,
                        mpit511.pok3 as pok3,
                        mpit511.pok4 as pok4,
                        mpit511.pok5 as pok5,
                        mpit511.pok6 as pok6,
                        mpit511.pok7 as pok7,
                        mpit511.pok8 as pok8,
                        mpit511.pok9 as pok9,
                        mpit511.pok10 as pok10,
                        mpit511.pok11 as pok11,
                        mpit511.pok12 as pok12,
                        mpit511.pok13 as pok13,
                        mpit511.pok14 as pok14,
                        mpit511.pok15 as pok15,
                        mpit511.pok16 as pok16,
                        mpit511.pok17 as pok17,
                        mpit511.pok18 as pok18,
                        mpit511.pok19 as pok19,
                        mpit511.pok20 as pok20,
                        mpit511.pok21 as pok21,
                        mpit511.pok22 as pok22,
                        mpit511.pok23 as pok23,
                        mpit511.pok24 as pok24,
                        mpit511.pok25 as pok25,
                        mpit511.pok26 as pok26,
                        mpit511.pok27 as pok27,
                        mpit511.pok28 as pok28,
                        mpit511.pok29 as pok29,
                        mpit511.pok30 as pok30,
                        mpit511.pok31 as pok31,
                        mpit511.pok32 as pok32,
                        mpit511.pok33 as pok33
                        from mpit511, report, est where
                        mpit511.id_report = report.id_report 
                        and report.id_est = est.id_est
                        and report.id_rep_type ='.$id_rep_type.'
                        and est.id_okr = '.Yii::app()->session['est'].' order by est.id_okr, est.id_raion, est.est_name');
                $data = $command->queryAll();                    
            }
            for($i=0; $i <sizeof($data); $i++) {
                $data[$i]['id_okr'] = $okrug[$data[$i]['id_okr']];
                $data[$i]['id_raion'] = $raion[$data[$i]['id_raion']];
            }
            $zag = 'Отчет - '.$otchet['rep_name'].' период '.$otchet['s_date'].'-'.$otchet['f_date'];
            
            $phpExcelPath = '/var/www/cposo/data/www/mon.cposo.ru/protected/vendors/phpexcel';
            spl_autoload_unregister(array('YiiBase','autoload'));
            include($phpExcelPath . DIRECTORY_SEPARATOR . 'PHPExcel.php');
            require_once($phpExcelPath .'/PHPExcel/IOFactory.php');
            $pExcel = new PHPExcel();                

            $file_tmpl = PHPExcel_IOFactory::load('/var/www/cposo/data/www/mon.cposo.ru/protected/res/mpit511.xlsx');                

            $sheet = $file_tmpl->getActiveSheet();  
            $pExcel->addExternalSheet($sheet);
            $pExcel->removeSheetByIndex(0);
            unset($file_tmpl);                

            $aSheet = $pExcel->getActiveSheet();
            
            $pExcel->getDefaultStyle()->getFont()->setName('Arial');
            $pExcel->getDefaultStyle()->getFont()->setSize(10); 
            
            $aSheet->setCellValue('E1',$zag);
            $aSheet->setCellValue('B2','данные сформированы по состоянию на '.date('d.m.Y H:i:s'));
            
            for($i = 0; $i < sizeof($data); $i++) {
                $k = 0;
                foreach ($data[$i] as $value) {                
                    $aSheet->setCellValueByColumnAndRow($k, ($i + 8), $value);
                    $k = $k + 1;
                }
            }             
            
            include($phpExcelPath . DIRECTORY_SEPARATOR.'PHPExcel/Writer/Excel2007.php');
            $objWriter = new PHPExcel_Writer_Excel2007($pExcel);                
            header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
            header('Content-Disposition: attachment;filename="mpit511.xlsx"');
            header('Cache-Control: max-age=0');
            $objWriter->save('php://output');
            spl_autoload_register(array('YiiBase','autoload'));                    
        }        
}  