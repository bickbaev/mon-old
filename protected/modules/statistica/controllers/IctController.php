<?php

class IctController extends Controller
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
        public function actionIct_excel() {
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
                            ict.col_teach as col_teach,
                            ict.col_uch as col_uch,                          
                            ict.desktop as desktop,
                            ict.laptop as laptop,
                            ict.tablet as tablet,
                            ict.pda as pda,
                            ict.comp_adm as comp_adm,
                            ict.comp_uch as comp_uch,
                            ict.comp_lvs as comp_lvs,
                            ict.comp_inet as comp_inet,
                            ict.comp_05 as comp_05,
                            ict.comp_06 as comp_06,
                            ict.comp_07 as comp_07,
                            ict.comp_08 as comp_08,
                            ict.comp_09 as comp_09,
                            ict.comp_10 as comp_10,
                            ict.comp_11 as comp_11,
                            ict.comp_class as comp_class,
                            ict.server as server,
                            ict.doska as doska,
                            ict.proektor as proektor,
                            ict.golos as golos,
                            ict.printer as printer,
                            ict.scaner as scaner,
                            ict.doc_cam as doc_cam,
                            ict.site as site,
                            ict.telefon as telefon,
                            ict.radio as radio,
                            ict.opto as opto,
                            ict.sat as sat,
                            ict.win as win,
                            ict.mac as mac,
                            ict.linux as linux,
                            ict.oper_other as oper_other,
                            ict.of_mic as of_mic,
                            ict.of_mac as of_mac,
                            ict.of_lin as of_lin,
                            ict.graf_adobe as graf_adobe,
                            ict.graf_corel as graf_corel,
                            ict.graf_visio as graf_visio,
                            ict.graf_linux as graf_linux,
                            ict.graf_other as graf_other,
                            ict.anti_kas as anti_kas,
                            ict.anti_web as anti_web,
                            ict.anti_nod as anti_nod,
                            ict.anti_rar as anti_rar,
                            ict.anti_other as anti_other,
                            ict.spec_lingvo as spec_lingvo,
                            ict.spec_fr as spec_fr,
                            ict.spec_1C as spec_1C,
                            ict.spec_linux as spec_linux,
                            ict.kf_kerio as kf_kerio,
                            ict.kf_ti as kf_ti,
                            ict.kf_ug as kf_ug,
                            ict.kf_np as kf_np,
                            ict.kf_skf as kf_skf,
                            ict.kf_ic as kf_ic,
                            ict.kf_squid as kf_squid,
                            ict.kf_other as kf_other,
                            ict.potr_linux as potr_linux,
                            ict.potr_pk_linux as potr_pk_linux,
                            est.id_est as id_est
                            from ict, report, est where
                            ict.id_report = report.id_report
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
                            ict.col_teach as col_teach,
                            ict.col_uch as col_uch,                          
                            ict.desktop as desktop,
                            ict.laptop as laptop,
                            ict.tablet as tablet,
                            ict.pda as pda,
                            ict.comp_adm as comp_adm,
                            ict.comp_uch as comp_uch,
                            ict.comp_lvs as comp_lvs,
                            ict.comp_inet as comp_inet,
                            ict.comp_05 as comp_05,
                            ict.comp_06 as comp_06,
                            ict.comp_07 as comp_07,
                            ict.comp_08 as comp_08,
                            ict.comp_09 as comp_09,
                            ict.comp_10 as comp_10,
                            ict.comp_11 as comp_11,
                            ict.comp_class as comp_class,
                            ict.server as server,
                            ict.doska as doska,
                            ict.proektor as proektor,
                            ict.golos as golos,
                            ict.printer as printer,
                            ict.scaner as scaner,
                            ict.doc_cam as doc_cam,
                            ict.site as site,
                            ict.telefon as telefon,
                            ict.radio as radio,
                            ict.opto as opto,
                            ict.sat as sat,
                            ict.win as win,
                            ict.mac as mac,
                            ict.linux as linux,
                            ict.oper_other as oper_other,
                            ict.of_mic as of_mic,
                            ict.of_mac as of_mac,
                            ict.of_lin as of_lin,
                            ict.graf_adobe as graf_adobe,
                            ict.graf_corel as graf_corel,
                            ict.graf_visio as graf_visio,
                            ict.graf_linux as graf_linux,
                            ict.graf_other as graf_other,
                            ict.anti_kas as anti_kas,
                            ict.anti_web as anti_web,
                            ict.anti_nod as anti_nod,
                            ict.anti_rar as anti_rar,
                            ict.anti_other as anti_other,
                            ict.spec_lingvo as spec_lingvo,
                            ict.spec_fr as spec_fr,
                            ict.spec_1C as spec_1C,
                            ict.spec_linux as spec_linux,
                            ict.kf_kerio as kf_kerio,
                            ict.kf_ti as kf_ti,
                            ict.kf_ug as kf_ug,
                            ict.kf_np as kf_np,
                            ict.kf_skf as kf_skf,
                            ict.kf_ic as kf_ic,
                            ict.kf_squid as kf_squid,
                            ict.kf_other as kf_other,
                            ict.potr_linux as potr_linux,
                            ict.potr_pk_linux as potr_pk_linux,
                            est.id_est as id_est
                            from ict, report, est where
                            ict.id_report = report.id_report
                            and report.id_est = est.id_est
                            and report.id_rep_type ='.$id_rep_type.'
                            and est.id_okr = '.Yii::app()->session['est']);
                    $data = $command->queryAll();
                }
                for($i=0; $i <sizeof($data); $i++) {
                    $data[$i]['id_okr'] = $okrug[$data[$i]['id_okr']];
                    $data[$i]['id_raion'] = $raion[$data[$i]['id_raion']];
                    $command = Yii::app()->db->createCommand('select contact_info.nas_punkt, contact_info.street, contact_info.dom, contact_info.korpus from contact_info, report where report.id_rep_type = 1 and report.id_report = contact_info.id_report and report.id_est = '.$data[$i]['id_est']);
                    $reader = $command->queryRow();
                    $data[$i]['adr'] = $reader['nas_punkt'].', '.$reader['street'].', '.$reader['dom'].', '.$reader['korpus'];               
                }
                $pokaz = Ict::model()->attributeLabels();
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
                $aSheet->setTitle('ИКТ');
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
                header('Content-Disposition: attachment;filename="ict.xls"');
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