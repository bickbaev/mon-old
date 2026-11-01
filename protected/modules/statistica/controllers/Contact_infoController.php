<?php

class Contact_infoController extends Controller
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
                'accessControl + index, contact_upr, podr, podr_mun, p_cont, p_doc'
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
                $command = Yii::app()->db->createCommand('select id_est, est_name from est where type_adm = 3');
                $okrug = $command->queryAll();
                $this->render('index', array('okrug'=>$okrug, 'id_rep_type'=> $id_rep_type, 'otchet' => $otchet));
          }
          else $this->redirect(Yii::app()->user->returnUrl);
        }

        public function actionContact_upr()
        {
           if (isset($_GET['id_rep_type']) && $_GET['id_rep_type'] != '') {
                $id_rep_type = (int) $_GET['id_rep_type'];
                $id_okr = (int) $_GET['id_okr'];
                $command = Yii::app()->db->createCommand('select rep_name, DATE_FORMAT(s_date, "%d.%m.%Y") AS s_date, DATE_FORMAT(f_date, "%d.%m.%Y") AS f_date from rep_name where id_rep_type ='.$id_rep_type);
                $otchet = $command->queryRow();
                $command = Yii::app()->db->createCommand('select est_name from est where id_est ='.$id_okr);
                $okrug = $command->queryScalar();
                $command = Yii::app()->db->createCommand('select id_est, est_name from est where type_adm = 2 and id_okr='.$id_okr);
                $raion = $command->queryAll();
                for($i = 0; $i < sizeof($raion); $i++) {
                        $command = Yii::app()->db->createCommand('SELECT est.est_name, report.id_report
                        FROM report
                        INNER JOIN est
                        ON report.id_est = est.id_est
                        WHERE report.id_rep_type = '.$id_rep_type.' and est.id_raion = '.$raion[$i]['id_est']);
                        $raion[$i]['reports'] = $command->queryAll();
                        for($k = 0; $k < sizeof($raion[$i]['reports']); $k++) {
                            $command = Yii::app()->db->createCommand('
                                SELECT
                                nas_punkt_type,
                                nas_punkt,
                                street_type,
                                street,
                                dom,
                                korpus,
                                dir_name,
                                dir_par,
                                dir_sur,
                                cod_phone,
                                phone,
                                cod_fax,
                                fax,
                                mail,
                                site,
                                samo as publ,
                                akkr,
                                lic,
                                ustav,
                                gos,
                                opl
                                FROM contact_info
                                WHERE
                                id_report = '.$raion[$i]['reports'][$k]['id_report']);
                            $raion[$i]['reports'][$k]['znach'] = $command->queryRow();
                        }
                }
                $this->render('contact_upr', array('raion' => $raion, 'okrug'=>$okrug, 'id_rep_type'=> $id_rep_type, 'otchet' => $otchet, 'id_okr' => $id_okr));
          }
          else $this->redirect(Yii::app()->user->returnUrl);
        }

        public function actionP_cont()
        {
           if (isset($_GET['id_rep_type']) && $_GET['id_rep_type'] != '') {
                $id_rep_type = (int) $_GET['id_rep_type'];
                $id_okr = (int) $_GET['id_okr'];
                $command = Yii::app()->db->createCommand('select rep_name, DATE_FORMAT(s_date, "%d.%m.%Y") AS s_date, DATE_FORMAT(f_date, "%d.%m.%Y") AS f_date from rep_name where id_rep_type ='.$id_rep_type);
                $otchet = $command->queryRow();
                $command = Yii::app()->db->createCommand('select est_name from est where id_est ='.$id_okr);
                $okrug = $command->queryScalar();
                $command = Yii::app()->db->createCommand('select id_est, est_name from est where type_adm = 2 and id_okr='.$id_okr);
                $raion = $command->queryAll();
                for($i = 0; $i < sizeof($raion); $i++) {
                        $command = Yii::app()->db->createCommand('SELECT est.est_name, report.id_report
                        FROM report
                        INNER JOIN est
                        ON report.id_est = est.id_est
                        WHERE report.id_rep_type = '.$id_rep_type.' and est.id_raion = '.$raion[$i]['id_est']);
                        $raion[$i]['reports'] = $command->queryAll();
                        for($k = 0; $k < sizeof($raion[$i]['reports']); $k++) {
                            $command = Yii::app()->db->createCommand('
                                SELECT
                                mail,
                                site
                                FROM contact_info
                                WHERE
                                id_report = '.$raion[$i]['reports'][$k]['id_report']);
                            $raion[$i]['reports'][$k]['znach'] = $command->queryRow();
                        }
                }
                $this->render('p_cont', array('raion' => $raion, 'okrug'=>$okrug, 'id_rep_type'=> $id_rep_type, 'otchet' => $otchet, 'id_okr' => $id_okr));
          }
          else $this->redirect(Yii::app()->user->returnUrl);
        }

        public function actionP_doc()
        {
           if (isset($_GET['id_rep_type']) && $_GET['id_rep_type'] != '') {
                $id_rep_type = (int) $_GET['id_rep_type'];
                $id_okr = (int) $_GET['id_okr'];
                $command = Yii::app()->db->createCommand('select rep_name, DATE_FORMAT(s_date, "%d.%m.%Y") AS s_date, DATE_FORMAT(f_date, "%d.%m.%Y") AS f_date from rep_name where id_rep_type ='.$id_rep_type);
                $otchet = $command->queryRow();
                $command = Yii::app()->db->createCommand('select est_name from est where id_est ='.$id_okr);
                $okrug = $command->queryScalar();
                $command = Yii::app()->db->createCommand('select id_est, est_name from est where type_adm = 2 and id_okr='.$id_okr);
                $raion = $command->queryAll();
                for($i = 0; $i < sizeof($raion); $i++) {
                        $command = Yii::app()->db->createCommand('SELECT est.est_name, report.id_report
                        FROM report
                        INNER JOIN est
                        ON report.id_est = est.id_est
                        WHERE report.id_rep_type = '.$id_rep_type.' and est.id_raion = '.$raion[$i]['id_est']);
                        $raion[$i]['reports'] = $command->queryAll();
                        for($k = 0; $k < sizeof($raion[$i]['reports']); $k++) {
                            $command = Yii::app()->db->createCommand('
                                SELECT
                                samo as publ,
                                akkr,
                                lic,
                                ustav,
                                gos,
                                opl
                                FROM contact_info
                                WHERE
                                id_report = '.$raion[$i]['reports'][$k]['id_report']);
                            $raion[$i]['reports'][$k]['znach'] = $command->queryRow();
                        }
                }
                $this->render('p_doc', array('raion' => $raion, 'okrug'=>$okrug, 'id_rep_type'=> $id_rep_type, 'otchet' => $otchet, 'id_okr' => $id_okr));
          }
          else $this->redirect(Yii::app()->user->returnUrl);
        }

        public function actionPodr() {
            if (isset($_GET['id_rep_type']) && $_GET['id_rep_type'] != '') {
                $id_rep_type = (int) $_GET['id_rep_type'];
                $command = Yii::app()->db->createCommand('select rep_name, DATE_FORMAT(s_date, "%d.%m.%Y") AS s_date, DATE_FORMAT(f_date, "%d.%m.%Y") AS f_date from rep_name where id_rep_type ='.$id_rep_type);
                $otchet = $command->queryRow();
                $command = Yii::app()->db->createCommand('select id_est, est_name from est where type_adm = 3');
                $okrug = $command->queryAll();
                $pokaz = array('site', 'publ', 'akkr', 'lic', 'ustav', 'gos', 'opl');
                for($i = 1; $i < 7; $i++) { //уровни образования ОУ, ДОУ и т.д
                    for($k = 0; $k < sizeof($okrug); $k++) { //округа
                        $report[$i][$k][0] = $okrug[$k]['est_name'];
                        for($m = 0; $m < sizeof($pokaz); $m++) { //Показатели
                            $command = Yii::app()->db->createCommand(
                                    'select
                                    count(contact_info.id_report)
                                    from
                                    contact_info, report, est
                                    where
                                    est.type_adm = 0 and
                                    est.id_type = '.$i.' and
                                    est.id_okr = '.$okrug[$k]['id_est'].' and
                                    est.id_est = report.id_est and
                                    report.id_rep_type = '.$id_rep_type.' and
                                    report.id_report = contact_info.id_report and
                                    contact_info.'.$pokaz[$m].' = ""');
                            $report[$i][$k][$m + 1] = $command->queryScalar();
                        }
                        $command = Yii::app()->db->createCommand(
                                    'select
                                    count(contact_info.id_report)
                                    from
                                    contact_info, report, est
                                    where
                                    est.type_adm = 0 and
                                    est.id_type = '.$i.' and
                                    est.id_okr = '.$okrug[$k]['id_est'].' and
                                    est.id_est = report.id_est and
                                    report.id_rep_type = '.$id_rep_type.' and
                                    report.id_report = contact_info.id_report');
                        $report[$i][$k][8] = $command->queryScalar();
                    }

                }
                $this->render('podr', array('id_rep_type'=> $id_rep_type, 'otchet' => $otchet, 'report' => $report));
            }
            else $this->redirect(Yii::app()->user->returnUrl);
        }
        public function actionPodr_mun() {
            if (isset($_GET['id_rep_type']) && $_GET['id_rep_type'] != '') {
                $id_rep_type = (int) $_GET['id_rep_type'];
                $command = Yii::app()->db->createCommand('select rep_name, DATE_FORMAT(s_date, "%d.%m.%Y") AS s_date, DATE_FORMAT(f_date, "%d.%m.%Y") AS f_date from rep_name where id_rep_type ='.$id_rep_type);
                $otchet = $command->queryRow();
                $command = Yii::app()->db->createCommand('select id_est, est_name from est where type_adm = 2');
                $okrug = $command->queryAll();
                $pokaz = array('site', 'publ', 'akkr', 'lic', 'ustav', 'gos', 'opl');
                for($i = 1; $i < 7; $i++) { //уровни образования ОУ, ДОУ и т.д
                    for($k = 0; $k < sizeof($okrug); $k++) { //округа
                        $report[$i][$k][0] = $okrug[$k]['est_name'];
                        for($m = 0; $m < sizeof($pokaz); $m++) { //Показатели
                            $command = Yii::app()->db->createCommand(
                                    'select
                                    count(contact_info.id_report)
                                    from
                                    contact_info, report, est
                                    where
                                    est.type_adm = 0 and
                                    est.id_type = '.$i.' and
                                    est.id_raion = '.$okrug[$k]['id_est'].' and
                                    est.id_est = report.id_est and
                                    report.id_rep_type = '.$id_rep_type.' and
                                    report.id_report = contact_info.id_report and
                                    contact_info.'.$pokaz[$m].' = ""');
                            $report[$i][$k][$m + 1] = $command->queryScalar();
                        }
                        $command = Yii::app()->db->createCommand(
                                    'select
                                    count(contact_info.id_report)
                                    from
                                    contact_info, report, est
                                    where
                                    est.type_adm = 0 and
                                    est.id_type = '.$i.' and
                                    est.id_raion = '.$okrug[$k]['id_est'].' and
                                    est.id_est = report.id_est and
                                    report.id_rep_type = '.$id_rep_type.' and
                                    report.id_report = contact_info.id_report');
                        $report[$i][$k][8] = $command->queryScalar();
                    }

                }
                $this->render('podr_mun', array('id_rep_type'=> $id_rep_type, 'otchet' => $otchet, 'report' => $report));
            }
            else $this->redirect(Yii::app()->user->returnUrl);
        }
        
        public function actionCon_excel() {
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
                $command = Yii::app()->db->createCommand('select * from contact_type');
                $reader = $command->queryAll();
                foreach ($reader as $value) {
                    $contact_type[$value['id_contact_info']] = $value['naim_type'];
                }
                $command = Yii::app()->db->createCommand('select * from contact_ur');
                $reader = $command->queryAll();
                foreach ($reader as $value) {
                    $contact_ur[$value['id_contact_ur']] = $value['naim_ur'];
                }
                $command = Yii::app()->db->createCommand('select * from contact_gor');
                $reader = $command->queryAll();
                foreach ($reader as $value) {
                    $contact_gor[$value['id_contact_gor']] = $value['naim_gor'];
                }
                $command = Yii::app()->db->createCommand('select * from contact_ul');
                $reader = $command->queryAll();
                foreach ($reader as $value) {
                    $contact_ul[$value['id_contact_ul']] = $value['naim_ul'];
                }                 
                if(Yii::app()->session['type_adm'] == 4) { 
                    $command = Yii::app()->db->createCommand('select
                            est.id_okr as id_okr,
                            est.id_raion as id_raion,
                            est.est_name as est_name,
                            contact_info.uch_type as uch_type,
                            contact_info.uch_status as uch_status,
                            contact_info.nas_punkt_type as nas_punkt_type,
                            contact_info.nas_punkt as nas_punkt,
                            contact_info.street_type as street_type,
                            contact_info.street as street,
                            contact_info.dom as dom,
                            contact_info.korpus as korpus,
                            contact_info.dir_name as dir_name,
                            contact_info.dir_par as dir_par,
                            contact_info.dir_sur as dir_sur,
                            contact_info.cod_phone as cod_phone,
                            contact_info.phone as phone,
                            contact_info.cod_fax as cod_fax,
                            contact_info.fax as fax,
                            contact_info.mail as mail,
                            contact_info.site as site,
                            est.id_type as id_type,
                            est.id_est as id_est
                            from contact_info, report, est where
                            contact_info.id_report = report.id_report 
                            and report.id_est = est.id_est
                            and est.status = 1 
                            and report.id_rep_type ='.$id_rep_type);
                    $data = $command->queryAll();
                }
                else {
                    if(Yii::app()->session['parent'] != 1) $this->redirect(Yii::app()->user->returnUrl);
                    $command = Yii::app()->db->createCommand('select
                            est.id_okr as id_okr,
                            est.id_raion as id_raion,
                            est.est_name as est_name,
                            contact_info.uch_type as uch_type,
                            contact_info.uch_status as uch_status,
                            contact_info.nas_punkt_type as nas_punkt_type,
                            contact_info.nas_punkt as nas_punkt,
                            contact_info.street_type as street_type,
                            contact_info.street as street,
                            contact_info.dom as dom,
                            contact_info.korpus as korpus,
                            contact_info.dir_name as dir_name,
                            contact_info.dir_par as dir_par,
                            contact_info.dir_sur as dir_sur,
                            contact_info.cod_phone as cod_phone,
                            contact_info.phone as phone,
                            contact_info.cod_fax as cod_fax,
                            contact_info.fax as fax,
                            contact_info.mail as mail,
                            contact_info.site as site,
                            est.id_type as id_type
                            from contact_info, report, est where
                            contact_info.id_report = report.id_report 
                            and report.id_est = est.id_est
                            and est.status = 1
                            and report.id_rep_type ='.$id_rep_type.'
                            and est.id_okr = '.Yii::app()->session['est']);
                    $data = $command->queryAll();
                }
                for($i=0; $i <sizeof($data); $i++) {
                    $data[$i]['id_okr'] = $okrug[$data[$i]['id_okr']];
                    $data[$i]['id_raion'] = $raion[$data[$i]['id_raion']];
                    $data[$i]['uch_type'] = $contact_type[$data[$i]['uch_type']];
                    $data[$i]['uch_status'] = $contact_ur[$data[$i]['uch_status']];
                    $data[$i]['nas_punkt_type'] = $contact_gor[$data[$i]['nas_punkt_type']];
                    $data[$i]['street_type'] = $contact_ul[$data[$i]['street_type']];
                }
                $pokaz = Contact::model()->attributeLabels();
                array_shift($pokaz);
                $dabavka = array('id_okr'=>'Округ', 'id_raion'=>'Район', 'est_name'=>'Учреждение');
                $pokaz = $dabavka + $pokaz;
                $pokaz = array_slice($pokaz, 0, 20);
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
                $aSheet->setTitle('Контактные_данные');
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
                $aSheet->getStyle('A2:AB2')->getFont()->setBold(true);
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
                header('Content-Disposition: attachment;filename="contact_info.xls"');
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