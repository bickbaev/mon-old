<?php

class Abi25Controller extends Controller
{
        
        public function filters()
        {
            return array(
                'accessControl',                
            );
        }
        
        function filterAccessControl($filterChain)
        {
            if(Yii::app()->user->isGuest || (Yii::app()->session['type_adm'] != 4))
                    $this->redirect('index.php?r=site/login');
            else
                    $filterChain->run();
        }
        
	public function actionIndex($id_comp)
        {
            $comp = $this->loadComp($id_comp);
            $model = new Abi25_part('search');
            $model->unsetAttributes();  // clear any default values
            if(isset($_GET['Abi25_part'])) {
                $model->attributes=$_GET['Abi25_part'];                
            }    
            $this->render('index',array(
                'model'=>$model,
                'comp'=>$comp,
            ));
        }
        
	public function actionExp($id_comp)
        {
            $comp = $this->loadComp($id_comp);
            $model = new Abi25_exp('search');
            $model->unsetAttributes();  // clear any default values
            if(isset($_GET['Abi25_exp'])) {
                $model->attributes=$_GET['Abi25_exp'];                
            }    
            $this->render('exp',array(
                'model'=>$model,
                'comp'=>$comp,
            ));
        }

        public function actionUpdate_exp($id, $id_comp)
        {
            $comp = $this->loadComp($id_comp);
            $model = $this->loadExp($id);

            // Uncomment the following line if AJAX validation is needed
            $this->performAjaxValidation($model);

            if(isset($_POST['Abi25_exp']))
            {
                $model->attributes=$_POST['Abi25_exp'];

                $model->file1 = CUploadedFile::getInstance($model, 'file1');
                $model->file2 = CUploadedFile::getInstance($model, 'file2');
                $model->file3 = CUploadedFile::getInstance($model, 'file3');
                $model->file4 = CUploadedFile::getInstance($model, 'file4');                    

                if($model->validate()) {
                    if($model->save()) {
                        if (Yii::app()->request->isAjaxRequest) {
                            echo CJSON::encode(array(
                                'status' => 'success',
                                'redirect' => $this->createUrl('edit', array('id_rep'=>$model->id_report))
                            ));
                            Yii::app()->end();
                        } else {
                            $this->redirect(array('edit','id_rep'=>$model->id_report));
                        }
                    }
                } else {
                    if (Yii::app()->request->isAjaxRequest) {
                        echo CJSON::encode(array(
                            'status' => 'error',
                            'errors' => $model->getErrors(),
                        ));
                        Yii::app()->end();
                    }
                }                   

            }

            $this->render('update_exp',array(
                'model'=>$model,
                'comp'=>$comp,
            ));                
        }                
        
        public function actionDelete_exp($id)
        {
            if(Yii::app()->request->isPostRequest)
            {
                $model = $this->loadExp($id)->delete();

                // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
                if(!isset($_GET['ajax']))
                    $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));  
            }
            else
                throw new CHttpException(400,'Invalid request. Please do not repeat this request again.');
        }         
        
        public function actionUpdate($id, $id_comp)
        {
            $comp = $this->loadComp($id_comp);
            $model = $this->loadPart($id);

            if($model->report->est->id_type == 2 || $model->report->est->id_type == 6) $school = true;
            else $school = false;

            // Включаем AJAX-валидацию для update
            $this->performAjaxValidation($model);

            if(isset($_POST['Abi25_part']))
            {
                $model->attributes=$_POST['Abi25_part'];                         

                $model->file1 = CUploadedFile::getInstance($model, 'file1');
                $model->file2 = CUploadedFile::getInstance($model, 'file2');
                $model->file3 = CUploadedFile::getInstance($model, 'file3');
                $model->file4 = CUploadedFile::getInstance($model, 'file4');

                if($model->validate()) {
                    if($model->save()) {
                        if (Yii::app()->request->isAjaxRequest) {
                            echo CJSON::encode(array(
                                'status' => 'success',
                                'redirect' => $this->createUrl('index', array('id_comp'=>$model->report->abi25_comp_link->id))
                            ));
                            Yii::app()->end();
                        } else {
                            $this->redirect(array('edit','id_rep'=>$model->id_report));
                        }
                    }
                } else {
                    if (Yii::app()->request->isAjaxRequest) {
                        echo CJSON::encode(array(
                            'status' => 'error',
                            'errors' => $model->getErrors(),
                        ));
                        Yii::app()->end();
                    }
                }
            }

            $this->render('update',array(
                'model' => $model,
                'school' => $school,
                'comp' => $comp,
            ));
        }
        
        public function actionDelete($id, $id_comp)
        {
            if(Yii::app()->request->isPostRequest)
            {
                $comp = $this->loadComp($id_comp);
                $model = $this->loadPart($id)->delete();

                // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
                if(!isset($_GET['ajax']))
                    $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));  
            }
            else
                throw new CHttpException(400,'Invalid request. Please do not repeat this request again.');
        }

        
        protected function performAjaxValidation($model)
        {
            if(isset($_POST['ajax']) && $_POST['ajax']==='abi25-part-form')
            {
                echo CActiveForm::validate($model);
                Yii::app()->end();
            }
        }

        public function actionPo_complete() {
            $term = Yii::app()->getRequest()->getParam('term');

            if(Yii::app()->request->isAjaxRequest && $term) {
                $criteria = new CDbCriteria;
                // формируем критерий поиска
                $criteria->addSearchCondition('id_po', $term);
                //$criteria->group = 'name';
                $decls = Po_new::model()->findAll($criteria);
                // обрабатываем результат
                $result = array();
                foreach($decls as $decl) {
                    $result[] = array('id'=>$decl['id_po'], 'label'=>$decl['id_po'].'/'.$decl['naim_po'], 'value'=>$decl['id_po']);
                }
                echo CJSON::encode($result);
                Yii::app()->end();
            }
        }

        public function actionScandown($id, $type) {
            if(!in_array((int)$type, [1, 2, 3, 4])) throw new CHttpException(404,'The requested file does not exist2.');
            $model = $this->loadPart($id);
            if($type == 1) {
                $file = $model::FILE_PATH.'/'.Report::model()->findByPk($model->id_report)->id_rep_type.'/'.$model->id_report.'/'.$model->spr;             
                $naim = $model->spr_r;
            }            
            elseif($type == 2) {
                $file = $model::FILE_PATH.'/'.Report::model()->findByPk($model->id_report)->id_rep_type.'/'.$model->id_report.'/'.$model->sogl;             
                $naim = $model->sogl_r;
            }
            elseif($type == 3) {
                $file = $model::FILE_PATH.'/'.Report::model()->findByPk($model->id_report)->id_rep_type.'/'.$model->id_report.'/'.$model->per_sogl;             
                $naim = $model->per_sogl_r;
            }
            else {
                $file = $model::FILE_PATH.'/'.Report::model()->findByPk($model->id_report)->id_rep_type.'/'.$model->id_report.'/'.$model->spro;             
                $naim = $model->spro_r;
            }            
            if(file_exists($file)) {
                Yii::app()->request->sendFile($naim, file_get_contents($file));
            }
            else throw new CHttpException(404,'The requested file does not exist.');            
        }
        
        public function actionScandown2($id) {
            $model = $this->loadObsh($id);
            $file = $model::FILE_PATH.'/'.Report::model()->findByPk($model->id_report)->id_rep_type.'/'.$model->id_report.'/'.$model->obsh;             
            $naim = $model->obsh_r;            
            if(file_exists($file)) {
                Yii::app()->request->sendFile($naim, file_get_contents($file));
            }
            else throw new CHttpException(404,'The requested file does not exist.');            
        }        

        public function actionScandown_exp($id, $type) {
            if(!in_array((int)$type, [1, 2, 3, 4])) throw new CHttpException(404,'The requested file does not exist2.');
            $model = $this->loadExp($id);
            if($type == 1) {
                $file = $model::FILE_PATH.'/'.Report::model()->findByPk($model->id_report)->id_rep_type.'/'.$model->id_report.'/'.$model->scan;             
                $naim = $model->scan_r;
            }            
            elseif($type == 2) {
                $file = $model::FILE_PATH.'/'.Report::model()->findByPk($model->id_report)->id_rep_type.'/'.$model->id_report.'/'.$model->sogl;             
                $naim = $model->sogl_r;
            }
            elseif($type == 3) {
                $file = $model::FILE_PATH.'/'.Report::model()->findByPk($model->id_report)->id_rep_type.'/'.$model->id_report.'/'.$model->doc_obr;             
                $naim = $model->doc_obr_r;
            }
            elseif($type == 4) {
                $file = $model::FILE_PATH.'/'.Report::model()->findByPk($model->id_report)->id_rep_type.'/'.$model->id_report.'/'.$model->doc_staz;             
                $naim = $model->doc_staz_r;
            }             
            if(file_exists($file)) {
                Yii::app()->request->sendFile($naim, file_get_contents($file));
            }
            else throw new CHttpException(404,'The requested file does not exist.');            
        }          
        
        public function actionSurname_complete() {
            $term = Yii::app()->getRequest()->getParam('term');

            if(Yii::app()->request->isAjaxRequest && $term) {
                $criteria = new CDbCriteria;
                // формируем критерий поиска
                $criteria->addSearchCondition('surname', $term);
                $criteria->group = 'surname';
                $decls = Abi25_part::model()->findAll($criteria);
                // обрабатываем результат
                $result = array();
                foreach($decls as $decl) {
                    $result[] = array('id'=>$decl['id'], 'label'=>$decl['surname'], 'value'=>$decl['surname']);
                }
                echo CJSON::encode($result);
                Yii::app()->end();
            }
        }
        
        public function actionSurname_complete2() {
            $term = Yii::app()->getRequest()->getParam('term');

            if(Yii::app()->request->isAjaxRequest && $term) {
                $criteria = new CDbCriteria;
                // формируем критерий поиска
                $criteria->addSearchCondition('surname', $term);
                $criteria->group = 'surname';
                $decls = Abi25_exp::model()->findAll($criteria);
                // обрабатываем результат
                $result = array();
                foreach($decls as $decl) {
                    $result[] = array('id'=>$decl['id'], 'label'=>$decl['surname'], 'value'=>$decl['surname']);
                }
                echo CJSON::encode($result);
                Yii::app()->end();
            }
        }        
        
        public function actionPok1_complete() {
            $term = Yii::app()->getRequest()->getParam('term');

            if(Yii::app()->request->isAjaxRequest && $term) {
                $criteria = new CDbCriteria;
                // формируем критерий поиска
                $criteria->addSearchCondition('surname', $term);
                $criteria->group = 'surname';
                $decls = Abi25_obsh::model()->findAll($criteria);
                // обрабатываем результат
                $result = array();
                foreach($decls as $decl) {
                    $result[] = array('id'=>$decl['id_report'], 'label'=>$decl['surname'], 'value'=>$decl['surname']);
                }
                echo CJSON::encode($result);
                Yii::app()->end();
            }
        }
        
        public function actionEst_complete() {
            $term = Yii::app()->getRequest()->getParam('term');

            if(Yii::app()->request->isAjaxRequest && $term) {
                $criteria = new CDbCriteria;
                // формируем критерий поиска
                $criteria->addSearchCondition('est_name', $term);
                $criteria->group = 'est_name';
                $decls = Est::model()->findAll($criteria);
                // обрабатываем результат
                $result = array();
                foreach($decls as $decl) {
                    $result[] = array('id'=>$decl['id_est'], 'label'=>$decl['est_name'], 'value'=>$decl['est_name']);
                }
                echo CJSON::encode($result);
                Yii::app()->end();
            }
        }
        
        public function actionExcel($id_comp) {
            $comp = $this->loadComp($id_comp);

            $criteria = new CDbCriteria();
            $criteria->alias = 'p';
            $criteria->join = '
                INNER JOIN report r ON r.id_report = p.id_report
                INNER JOIN abi25_comp c ON c.id_rep_type = r.id_rep_type
            ';
            $criteria->condition = 'c.id = :compId';
            $criteria->params = array(':compId' => $id_comp);

            $items = Abi25_part::model()->findAll($criteria);

            $res = array();
            foreach ($items as $i => $item) {
                $res[$i]['okr']         = $this->loadEst($item->report->est->id_okr)->est_name;
                $res[$i]['raion']       = $this->loadEst($item->report->est->id_raion)->est_name;
                $res[$i]['est_name']    = $item->report->est->est_name;
                $res[$i]['id']          = $item->id;
                $res[$i]['surname']     = $item->surname;
                $res[$i]['name']        = $item->name;
                $res[$i]['patr']        = $item->patr;
                $res[$i]['burthdate']   = $item->burthdate;
                $res[$i]['id_compet']   = $item->compet->naim;
                $res[$i]['id_cat']      = $item->cat->naim;
                $res[$i]['id_po']       = $item->id_po ? $item->id_po . ' ' . $item->po->naim_po : '';
                $res[$i]['klass']       = $item->klass;
                $res[$i]['lic_tel']     = '+7' . $item->lic_code . $item->lic_tel;
                $res[$i]['lic_mail']    = $item->lic_mail;
                $res[$i]['id_noz']      = $item->noz->naim;
                $res[$i]['id_gr']       = $item->gr->naim;
                $res[$i]['id_spr']      = $item->spr_link->naim;
                $res[$i]['spr_date']    = $item->spr_date;
                $res[$i]['ovz']         = $item->ovz ? 'Да' : 'Нет';
                $res[$i]['id_size']     = $item->size->naim;
                $res[$i]['osob1']       = $item->osob1 ? 'Да' : '';
                $res[$i]['osob2']       = $item->osob2 ? 'Да' : '';
                $res[$i]['osob3']       = $item->osob3 ? 'Да' : '';
                $res[$i]['osob4']       = $item->osob4 ? 'Да' : '';
                $res[$i]['osob5']       = $item->osob5 ? 'Да' : '';
                $res[$i]['osob6']       = $item->osob6 ? 'Да' : '';
                $res[$i]['osob7']       = $item->osob7 ? 'Да' : '';
                $res[$i]['osob7_podr']  = $item->osob7_podr;
                $res[$i]['per_name']    = $item->per_name;
                $res[$i]['per_patr']    = $item->per_patr;
                $res[$i]['per_surname'] = $item->per_surname;
                $res[$i]['per_tel']     = $item->per_tel ? '+7' . $item->per_code . $item->per_tel : '';
                $res[$i]['rabota']      = $item->rabota;
                $res[$i]['dol']         = $item->dol;
                $res[$i]['per_mail']    = $item->per_mail;
                $res[$i]['per_size']    = $item->size->naim;
                $res[$i]['nonq']        = $item->nonq ? 'Да' : '';
                $res[$i]['notap']       = $item->notap ? 'Да' : '';
                $res[$i]['red']         = $item->user->surname . ' ' . $item->user->name . ' '
                                        . $item->user->patronymic . ' ' . $item->user->est->est_name;
                $res[$i]['r_date']      = $item->r_date;
            }

            $pokaz_src = Abi25_part::model()->attributeLabels();
            $pokaz = array();
            $exclude = array(
                'id_report', 'id_est', 'lic_code', 'per_code',
                'spro', 'spro_r', 'spr', 'spr_r',
                'sogl', 'sogl_r', 'per_sogl', 'per_sogl_r', 'comment',
            );
            foreach ($pokaz_src as $key => $item) {
                if (in_array($key, $exclude)) continue;
                $pokaz[$key] = $item;
            }
            $dabavka = array('id_okr' => 'Округ', 'id_raion' => 'Район', 'est_name' => 'Организация');
            $pokaz = $dabavka + $pokaz;
            $zag = 'Абилимпикс. По состоянию на ' . date('d.m.Y H:i', time());
            
            // Подключаем автозагрузчик Composer из папки protected/vendor
            require_once(Yii::app()->basePath . DIRECTORY_SEPARATOR . 'vendor' . DIRECTORY_SEPARATOR . 'autoload.php');            

            // --- PhpSpreadsheet ---
            $pExcel = new \PhpOffice\PhpSpreadsheet\Spreadsheet();
            $pExcel->setActiveSheetIndex(0);
            $pExcel->getDefaultStyle()->getFont()->setName('Arial');
            $pExcel->getDefaultStyle()->getFont()->setSize(10);

            $aSheet = $pExcel->getActiveSheet();
            $aSheet->setTitle('Абилимпикс');

            $aSheet->getColumnDimension('A')->setWidth(25);
            $aSheet->getColumnDimension('B')->setWidth(25);
            $aSheet->getColumnDimension('C')->setWidth(25);
            $aSheet->getColumnDimension('D')->setWidth(10);
            $aSheet->getColumnDimension('E')->setWidth(20);
            $aSheet->getColumnDimension('F')->setWidth(20);
            $aSheet->getColumnDimension('G')->setWidth(20);
            $aSheet->getColumnDimension('H')->setWidth(20);
            $aSheet->getColumnDimension('I')->setWidth(15);
            $aSheet->getColumnDimension('J')->setWidth(15);
            $aSheet->getColumnDimension('K')->setWidth(20);
            $aSheet->getColumnDimension('L')->setWidth(10);
            $aSheet->getColumnDimension('M')->setWidth(15);
            $aSheet->getColumnDimension('N')->setWidth(20);
            $aSheet->getColumnDimension('O')->setWidth(25);
            $aSheet->getColumnDimension('P')->setWidth(20);
            $aSheet->getColumnDimension('Q')->setWidth(20);
            $aSheet->getColumnDimension('R')->setWidth(15);
            $aSheet->getColumnDimension('S')->setWidth(10);
            $aSheet->getColumnDimension('AB')->setWidth(20);
            $aSheet->getColumnDimension('AC')->setWidth(20);
            $aSheet->getColumnDimension('AD')->setWidth(20);
            $aSheet->getColumnDimension('AE')->setWidth(25);
            $aSheet->getColumnDimension('AF')->setWidth(15);
            $aSheet->getColumnDimension('AG')->setWidth(15);
            $aSheet->getColumnDimension('AH')->setWidth(15);
            $aSheet->getColumnDimension('AI')->setWidth(20);
            $aSheet->getColumnDimension('AM')->setWidth(25);
            $aSheet->getColumnDimension('AN')->setWidth(20);

            $aSheet->setCellValue('A1', $zag);
            $aSheet->getStyle('A1')->getFont()->setBold(true);

            $i = 0;
            foreach ($pokaz as $value) {
                $col = \PhpOffice\PhpSpreadsheet\Cell\Coordinate::stringFromColumnIndex($i + 1);
                $aSheet->setCellValue($col . '2', $value);
                $i++;
            }

            $headerStyle = $aSheet->getStyle('A2:AN2');
            $headerStyle->getFont()->setBold(true);
            $headerStyle->getAlignment()->setWrapText(true);
            $headerStyle->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_TOP);
            $headerStyle->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_LEFT);
            $aSheet->getRowDimension(2)->setRowHeight(110);

            $lastRow = count($res) + 2;
            $dataStyle = $aSheet->getStyle('A3:AN' . $lastRow);
            $dataStyle->getAlignment()->setWrapText(true);
            $dataStyle->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_TOP);
            $dataStyle->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_LEFT);

            for ($i = 0; $i < count($res); $i++) {
                $k = 0;
                foreach ($res[$i] as $value) {
                    $col = \PhpOffice\PhpSpreadsheet\Cell\Coordinate::stringFromColumnIndex($k + 1);
                    $aSheet->setCellValue($col . ($i + 3), $value);
                    $k++;
                }
            }

            $objWriter = new \PhpOffice\PhpSpreadsheet\Writer\Xls($pExcel);

            header('Content-Type: application/vnd.ms-excel');
            header('Content-Disposition: attachment;filename="abi25.xls"');
            header('Cache-Control: max-age=0');

            $objWriter->save('php://output');

            $pExcel->disconnectWorksheets();
            unset($pExcel);
        }        

        public function actionExcel2($id_comp) {
            $comp = $this->loadComp($id_comp);
            $criteria = new CDbCriteria();
            $criteria->alias = 'p';
            $criteria->join = '
                INNER JOIN report r ON r.id_report = p.id_report
                INNER JOIN abi25_comp c ON c.id_rep_type = r.id_rep_type
            ';
            $criteria->condition = 'c.id = :compId';
            $criteria->params = array(':compId' => $id_comp);

            $items = Abi25_part::model()->findAll($criteria);             
            
            foreach($items as $i=>$item) {
                $res[$i]['okr'] = $this->loadEst($item->report->est->id_okr)->est_name;
                $res[$i]['raion'] = $this->loadEst($item->report->est->id_raion)->est_name;
                $res[$i]['est_name'] = $item->report->est->est_name;
                $res[$i]['id'] = $item->id;
                $res[$i]['surname'] = $item->surname;                
                $res[$i]['name'] = $item->name;
                $res[$i]['patr'] = $item->patr;
                $res[$i]['burthdate'] = $item->burthdate;                
                $res[$i]['id_compet'] = $item->compet->naim;
                $res[$i]['id_cat'] = $item->cat->naim;
                $res[$i]['id_po'] = $item->id_po?$item->id_po.' '.$item->po->naim_po:'';
                $res[$i]['klass'] = $item->klass;
                $res[$i]['lic_tel'] = '+7'.$item->lic_code.$item->lic_tel;
                $res[$i]['lic_mail'] = $item->lic_mail;
                $res[$i]['id_noz'] = $item->noz->naim;
                $res[$i]['id_gr'] = $item->gr->naim;                
                $res[$i]['id_spr'] = $item->spr_link->naim;
                $res[$i]['spr_date'] = $item->spr_date;
                $res[$i]['ovz'] = $item->ovz?'Да':'Нет';
                $res[$i]['id_size'] = $item->size->naim;
                $res[$i]['osob1'] = $item->osob1?'Да':'';
                $res[$i]['osob2'] = $item->osob2?'Да':'';
                $res[$i]['osob3'] = $item->osob3?'Да':'';
                $res[$i]['osob4'] = $item->osob4?'Да':'';
                $res[$i]['osob5'] = $item->osob5?'Да':'';
                $res[$i]['osob6'] = $item->osob6?'Да':'';
                $res[$i]['osob7'] = $item->osob7?'Да':'';
                $res[$i]['osob7_podr'] = $item->osob7_podr;                
                $res[$i]['per_name'] = $item->per_name;
                $res[$i]['per_patr'] = $item->per_patr;
                $res[$i]['per_surname'] = $item->per_surname;
                $res[$i]['per_tel'] = $item->per_tel?'+7'.$item->per_code.$item->per_tel:''; 
                $res[$i]['rabota'] = $item->rabota;
                $res[$i]['dol'] = $item->dol;  
                $res[$i]['per_mail'] = $item->per_mail; 
                $res[$i]['per_size'] = $item->size->naim;
                $res[$i]['nonq'] = $item->nonq?'Да':'';
                $res[$i]['notap'] = $item->notap?'Да':'';
                $res[$i]['red'] = $item->user->surname.' '.$item->user->name.' '.$item->user->patronymic.' '.$item->user->est->est_name; 
                $res[$i]['r_date'] = $item->r_date; 
            }
            $pokaz_src = Abi25_part::model()->attributeLabels();
            foreach ($pokaz_src as $key=>$item) {
                //if($key == 'id_report' || $key == 'pok19') continue;
                if(in_array($key, array('id_report', 'id_est', 'lic_code', 'per_code', 'spro', 'spro_r', 'spr', 'spr_r', 'sogl', 'sogl_r', 'per_sogl', 'per_sogl_r', 'comment'))) continue;
                $pokaz[$key] = $item;
            }
            $dabavka = array('id_okr'=>'Округ', 'id_raion'=>'Район', 'est_name'=>'Организация');
            $pokaz = $dabavka + $pokaz;
            $zag = 'Абилимпикс. По состоянию на '.date('d.m.Y H:i', time());
            
            
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
            $aSheet->setTitle('Абилимпикс');
            
            $aSheet->getColumnDimension('A')->setWidth(25);
            $aSheet->getColumnDimension('B')->setWidth(25);
            $aSheet->getColumnDimension('C')->setWidth(25);
            $aSheet->getColumnDimension('D')->setWidth(10);
            $aSheet->getColumnDimension('E')->setWidth(20);
            $aSheet->getColumnDimension('F')->setWidth(20);
            $aSheet->getColumnDimension('H')->setWidth(20);
            $aSheet->getColumnDimension('G')->setWidth(20);
            $aSheet->getColumnDimension('I')->setWidth(15);
            $aSheet->getColumnDimension('J')->setWidth(15);
            $aSheet->getColumnDimension('K')->setWidth(20);            
            $aSheet->getColumnDimension('L')->setWidth(10);
            $aSheet->getColumnDimension('M')->setWidth(15);
            $aSheet->getColumnDimension('N')->setWidth(20);
            $aSheet->getColumnDimension('O')->setWidth(25);
            $aSheet->getColumnDimension('P')->setWidth(20);
            $aSheet->getColumnDimension('Q')->setWidth(20);
            $aSheet->getColumnDimension('R')->setWidth(15);
            $aSheet->getColumnDimension('S')->setWidth(10);
            
            $aSheet->getColumnDimension('AB')->setWidth(20);
            $aSheet->getColumnDimension('AC')->setWidth(20);
            $aSheet->getColumnDimension('AD')->setWidth(20);
            $aSheet->getColumnDimension('AG')->setWidth(15);
            $aSheet->getColumnDimension('AH')->setWidth(15);
            $aSheet->getColumnDimension('AF')->setWidth(15);
            $aSheet->getColumnDimension('AI')->setWidth(20);             
            
            $aSheet->getColumnDimension('AE')->setWidth(25);
            $aSheet->getColumnDimension('AM')->setWidth(25);
            $aSheet->getColumnDimension('AN')->setWidth(20);            
            
            $aSheet->setCellValue('A1',$zag);
            $aSheet->getStyle('A1')->getFont()->setBold(true);
            $i = 0;
            foreach ($pokaz as $value) {
                $aSheet->setCellValueByColumnAndRow($i, 2, $value);
                $i = $i + 1;
            }
            $headerStyle = $aSheet->getStyle('A2:AN2');
            $headerStyle->getFont()->setBold(true);
            $headerStyle->getAlignment()->setWrapText(true);
            $headerStyle->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_TOP);
            $headerStyle->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
            $aSheet->getRowDimension('2')->setRowHeight(110);
            
            $dataStyle = $aSheet->getStyle('A3:AN'.(sizeof($res)+2));
            $dataStyle->getAlignment()->setWrapText(true);
            $dataStyle->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_TOP);
            $dataStyle->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);            
            
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
            header('Content-Disposition: attachment;filename="abi25.xls"');
            header('Cache-Control: max-age=0');
            $objWriter->save('php://output');
            spl_autoload_register(array('YiiBase','autoload'));            
        }
        
        public function actionExcel_exp($id_comp) {
            $comp = $this->loadComp($id_comp);

            $criteria = new CDbCriteria();
            $criteria->alias = 'p';
            $criteria->join = '
                INNER JOIN report r ON r.id_report = p.id_report
                INNER JOIN abi25_comp c ON c.id_rep_type = r.id_rep_type
            ';
            $criteria->condition = 'c.id = :compId';
            $criteria->params = array(':compId' => $id_comp);

            $items = Abi25_exp::model()->findAll($criteria);

            $res = array();
            foreach ($items as $i => $item) {
                $res[$i]['okr']         = $this->loadEst($item->report->est->id_okr)->est_name;
                $res[$i]['raion']       = $this->loadEst($item->report->est->id_raion)->est_name;
                $res[$i]['est_name']    = $item->report->est->est_name;
                $res[$i]['id']          = $item->id;
                $res[$i]['surname']     = $item->surname;
                $res[$i]['name']        = $item->name;
                $res[$i]['patr']        = $item->patr;
                $res[$i]['burthdate']   = $item->burthdate;
                $res[$i]['lic_tel']     = '+7' . $item->lic_code . $item->lic_tel;
                $res[$i]['lic_mail']    = $item->lic_mail;
                $res[$i]['id_compet']   = $item->compet->naim;
                $res[$i]['gl_exp']      = $item->gl_exp ? 'Да' : '';
                $res[$i]['exp']         = $item->exp ? 'Да' : '';
                $res[$i]['podg_exp']    = $item->podg_exp ? 'Да' : '';
                $res[$i]['podg_nac_exp']= $item->podg_nac_exp ? 'Да' : '';
                $res[$i]['rabota']      = $item->rabota;
                $res[$i]['dol']         = $item->dol;
                $res[$i]['id_obr']      = $item->obr->naim;
                $res[$i]['uch_st']      = $item->uch_st ? 'Да' : '';
                $res[$i]['spec']        = $item->spec;
                $res[$i]['dop']         = $item->dop;
                $res[$i]['staz']        = $item->staz;
                $res[$i]['opit']        = $item->opit;
                $res[$i]['data_att']    = $item->data_att;
                $res[$i]['red']         = $item->user->surname . ' ' . $item->user->name . ' '
                                        . $item->user->patronymic . ' ' . $item->user->est->est_name;
                $res[$i]['r_date']      = $item->r_date;
            }

            $pokaz_src = Abi25_exp::model()->attributeLabels();
            $pokaz = array();
            $exclude = array(
                'id_report', 'lic_code', 'scan', 'scan_r', 'sogl', 'spr', 'spr_r',
                'sogl_r', 'doc_obr', 'doc_obr_r', 'doc_staz', 'doc_staz_r', 'comment',
            );
            foreach ($pokaz_src as $key => $item) {
                if (in_array($key, $exclude)) continue;
                $pokaz[$key] = $item;
            }
            $dabavka = array('id_okr' => 'Округ', 'id_raion' => 'Район', 'est_name' => 'Организация');
            $pokaz = $dabavka + $pokaz;
            $zag = 'Абилимпикс. По состоянию на ' . date('d.m.Y H:i', time());
            
            // Подключаем автозагрузчик Composer из папки protected/vendor
            require_once(Yii::app()->basePath . DIRECTORY_SEPARATOR . 'vendor' . DIRECTORY_SEPARATOR . 'autoload.php');            

            // --- PhpSpreadsheet ---
            $pExcel = new \PhpOffice\PhpSpreadsheet\Spreadsheet();
            $pExcel->setActiveSheetIndex(0);
            $pExcel->getDefaultStyle()->getFont()->setName('Arial');
            $pExcel->getDefaultStyle()->getFont()->setSize(10);

            $aSheet = $pExcel->getActiveSheet();
            $aSheet->setTitle('Абилимпикс');

            $aSheet->getColumnDimension('A')->setWidth(25);
            $aSheet->getColumnDimension('B')->setWidth(25);
            $aSheet->getColumnDimension('C')->setWidth(25);
            $aSheet->getColumnDimension('D')->setWidth(10);
            $aSheet->getColumnDimension('E')->setWidth(20);
            $aSheet->getColumnDimension('F')->setWidth(20);
            $aSheet->getColumnDimension('G')->setWidth(20);
            $aSheet->getColumnDimension('H')->setWidth(20);
            $aSheet->getColumnDimension('I')->setWidth(15);
            $aSheet->getColumnDimension('J')->setWidth(15);
            $aSheet->getColumnDimension('K')->setWidth(20);
            $aSheet->getColumnDimension('L')->setWidth(10);
            $aSheet->getColumnDimension('M')->setWidth(15);
            $aSheet->getColumnDimension('N')->setWidth(20);
            $aSheet->getColumnDimension('O')->setWidth(25);
            $aSheet->getColumnDimension('P')->setWidth(20);
            $aSheet->getColumnDimension('Q')->setWidth(20);
            $aSheet->getColumnDimension('R')->setWidth(15);
            $aSheet->getColumnDimension('S')->setWidth(10);
            $aSheet->getColumnDimension('T')->setWidth(20);
            $aSheet->getColumnDimension('U')->setWidth(25);
            $aSheet->getColumnDimension('Y')->setWidth(25);
            $aSheet->getColumnDimension('Z')->setWidth(20);

            $aSheet->setCellValue('A1', $zag);
            $aSheet->getStyle('A1')->getFont()->setBold(true);

            $i = 0;
            foreach ($pokaz as $value) {
                $col = \PhpOffice\PhpSpreadsheet\Cell\Coordinate::stringFromColumnIndex($i + 1);
                $aSheet->setCellValue($col . '2', $value);
                $i++;
            }

            $headerStyle = $aSheet->getStyle('A2:AZ2');
            $headerStyle->getFont()->setBold(true);
            $headerStyle->getAlignment()->setWrapText(true);
            $headerStyle->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_TOP);
            $headerStyle->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_LEFT);
            $aSheet->getRowDimension(2)->setRowHeight(130);

            $lastRow = count($res) + 2;
            $dataStyle = $aSheet->getStyle('A3:AZ' . $lastRow);
            $dataStyle->getAlignment()->setWrapText(true);
            $dataStyle->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_TOP);
            $dataStyle->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_LEFT);

            for ($i = 0; $i < count($res); $i++) {
                $k = 0;
                foreach ($res[$i] as $value) {
                    $col = \PhpOffice\PhpSpreadsheet\Cell\Coordinate::stringFromColumnIndex($k + 1);
                    $aSheet->setCellValue($col . ($i + 3), $value);
                    $k++;
                }
            }

            $objWriter = new \PhpOffice\PhpSpreadsheet\Writer\Xls($pExcel);

            header('Content-Type: application/vnd.ms-excel');
            header('Content-Disposition: attachment;filename="abi25_exp.xls"');
            header('Cache-Control: max-age=0');

            $objWriter->save('php://output');

            $pExcel->disconnectWorksheets();
            unset($pExcel);
        }        
        
        public function actionExcel_exp2($id_comp) {
            $comp = $this->loadComp($id_comp);
            $criteria = new CDbCriteria();
            $criteria->alias = 'p';
            $criteria->join = '
                INNER JOIN report r ON r.id_report = p.id_report
                INNER JOIN abi25_comp c ON c.id_rep_type = r.id_rep_type
            ';
            $criteria->condition = 'c.id = :compId';
            $criteria->params = array(':compId' => $id_comp);

            $items = Abi25_exp::model()->findAll($criteria);             
            
            foreach($items as $i=>$item) {
                $res[$i]['okr'] = $this->loadEst($item->report->est->id_okr)->est_name;
                $res[$i]['raion'] = $this->loadEst($item->report->est->id_raion)->est_name;
                $res[$i]['est_name'] = $item->report->est->est_name;
                $res[$i]['id'] = $item->id;
                $res[$i]['surname'] = $item->surname;                
                $res[$i]['name'] = $item->name;
                $res[$i]['patr'] = $item->patr;
                $res[$i]['burthdate'] = $item->burthdate;  
                $res[$i]['lic_tel'] = '+7'.$item->lic_code.$item->lic_tel;
                $res[$i]['lic_mail'] = $item->lic_mail;                
                $res[$i]['id_compet'] = $item->compet->naim;
                $res[$i]['gl_exp'] = $item->gl_exp?'Да':'';
                $res[$i]['exp'] = $item->exp?'Да':'';
                $res[$i]['podg_exp'] = $item->podg_exp?'Да':'';
                $res[$i]['podg_nac_exp'] = $item->podg_nac_exp?'Да':'';
                $res[$i]['rabota'] = $item->rabota;
                $res[$i]['dol'] = $item->dol;
                $res[$i]['id_obr'] = $item->obr->naim;
                $res[$i]['uch_st'] = $item->uch_st?'Да':'';
                $res[$i]['spec'] = $item->spec;
                $res[$i]['dop'] = $item->dop;
                $res[$i]['staz'] = $item->staz;
                $res[$i]['opit'] = $item->opit;
                $res[$i]['data_att'] = $item->data_att;              
              
                $res[$i]['red'] = $item->user->surname.' '.$item->user->name.' '.$item->user->patronymic.' '.$item->user->est->est_name; 
                $res[$i]['r_date'] = $item->r_date; 
            }
            $pokaz_src = Abi25_exp::model()->attributeLabels();
            foreach ($pokaz_src as $key=>$item) {
                if(in_array($key, array('id_report', 'lic_code', 'scan', 'scan_r', 'sogl', 'spr', 'spr_r', 'sogl', 'sogl_r', 'doc_obr', 'doc_obr_r', 'doc_staz', 'doc_staz_r', 'comment'))) continue;
                $pokaz[$key] = $item;
            }
            $dabavka = array('id_okr'=>'Округ', 'id_raion'=>'Район', 'est_name'=>'Организация');
            $pokaz = $dabavka + $pokaz;
            $zag = 'Абилимпикс. По состоянию на '.date('d.m.Y H:i', time());
            
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
            $aSheet->setTitle('Абилимпикс');
            
            $aSheet->getColumnDimension('A')->setWidth(25);
            $aSheet->getColumnDimension('B')->setWidth(25);
            $aSheet->getColumnDimension('C')->setWidth(25);
            $aSheet->getColumnDimension('D')->setWidth(10);
            $aSheet->getColumnDimension('E')->setWidth(20);
            $aSheet->getColumnDimension('F')->setWidth(20);
            $aSheet->getColumnDimension('H')->setWidth(20);
            $aSheet->getColumnDimension('G')->setWidth(20);
            $aSheet->getColumnDimension('I')->setWidth(15);
            $aSheet->getColumnDimension('J')->setWidth(15);
            $aSheet->getColumnDimension('K')->setWidth(20);            
            $aSheet->getColumnDimension('L')->setWidth(10);
            $aSheet->getColumnDimension('M')->setWidth(15);
            $aSheet->getColumnDimension('N')->setWidth(20);
            $aSheet->getColumnDimension('O')->setWidth(25);
            $aSheet->getColumnDimension('P')->setWidth(20);
            $aSheet->getColumnDimension('Q')->setWidth(20);
            $aSheet->getColumnDimension('R')->setWidth(15);
            $aSheet->getColumnDimension('S')->setWidth(10);
            $aSheet->getColumnDimension('T')->setWidth(20);                       
            $aSheet->getColumnDimension('U')->setWidth(25);
            $aSheet->getColumnDimension('Y')->setWidth(25);
            $aSheet->getColumnDimension('Z')->setWidth(20);
            
            $aSheet->setCellValue('A1',$zag);
            $aSheet->getStyle('A1')->getFont()->setBold(true);
            $i = 0;
            foreach ($pokaz as $value) {
                $aSheet->setCellValueByColumnAndRow($i, 2, $value);
                $i = $i + 1;
            }
            $headerStyle = $aSheet->getStyle('A2:AZ2');
            $headerStyle->getFont()->setBold(true);
            $headerStyle->getAlignment()->setWrapText(true);
            $headerStyle->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_TOP);
            $headerStyle->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
            $aSheet->getRowDimension('2')->setRowHeight(130);
            
            $dataStyle = $aSheet->getStyle('A3:AZ'.(sizeof($res)+2));
            $dataStyle->getAlignment()->setWrapText(true);
            $dataStyle->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_TOP);
            $dataStyle->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);            
            
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
            header('Content-Disposition: attachment;filename="abi25_exp.xls"');
            header('Cache-Control: max-age=0');
            $objWriter->save('php://output');
            spl_autoload_register(array('YiiBase','autoload'));            
        }        
        
	public function actionOtv($id_comp)
	{
            $comp = $this->loadComp($id_comp);
            $model = new Abi25_obsh('search');
            $model->unsetAttributes();  // clear any default values
            if(isset($_GET['Abi25_obsh'])) {
                $model->attributes=$_GET['Abi25_obsh'];                
            }    
            $this->render('otv',array(
                'model'=>$model,
                'comp'=>$comp,
            ));
        }

        public function actionStats($id_comp)
        {
            $comp = $this->loadComp($id_comp);            
            // Получаем данные для кросс-таблицы
            // Конфигурация подключения к базе данных
            $connection = Yii::app()->db;

            $typeNames = array(
                1 => 'ДОУ',
                2 => 'ООО',
                3 => 'УДОД',
                //4 => 'Учреждения начального профессионального образования',
                5 => 'СПО',
                6 => 'СКОУ',
                7 => 'ВПО',
                //8 => 'Учреждения для детей, нуждающихся в психолого-педагогической и медико-социальной помощи',
                9 => 'Иные',
            );            

            // Получаем все уникальные id_okr
            $okrQuery = "SELECT DISTINCT id_okr FROM est WHERE id_okr IS NOT NULL ORDER BY id_okr";
            $allOkr = $connection->createCommand($okrQuery)->queryColumn();
            
            $okrName = $connection->createCommand("SELECT id_est, est_name FROM est WHERE type_adm = 3 ORDER BY id_est")->queryAll(); 
            
            $resultOkrName = array();
            foreach ($okrName as $row) {
                $resultOkrName[$row['id_est']] = $row['est_name'];
            }            

            // Получаем все уникальные id_type
            $typeQuery = "SELECT DISTINCT id_type FROM est WHERE id_type IS NOT NULL ORDER BY id_type";
            $allTypes = $connection->createCommand($typeQuery)->queryColumn();

            // Создаем структуру для данных
            $data = array();
            foreach ($allOkr as $okr) {
                $row = array('id_okr' => $okr);
                $row['okr_name'] = $resultOkrName[$okr];
                foreach ($allTypes as $type) {
                    $row['type_' . $type] = 0; // Инициализируем нулями
                }
                $row['total'] = 0;
                $data[$okr] = $row;
            }
            
            $data['itog'] = array();
            foreach ($allTypes as $type) {
                $data['itog']['type_' . $type] = 0; // Инициализируем нулями
            }
            $data['itog']['okr_name'] = 'Всего';
            $data['itog']['id_okr'] = 0;

            // SQL запрос для получения статистики
            $sql = "SELECT 
                    e.id_okr,
                    e.id_type,
                    COUNT(DISTINCT ws.id) as count
                FROM est e
                LEFT JOIN report r ON e.id_est = r.id_est
                LEFT JOIN abi25_part ws ON r.id_report = ws.id_report 
                WHERE r.id_rep_type = ".$comp->id_rep_type."
                GROUP BY e.id_okr, e.id_type
                ORDER BY e.id_okr, e.id_type
            ";

            $results = $connection->createCommand($sql)->queryAll();

            // Заполняем данные результатами запроса
            foreach ($results as $row) {
                $okr = $row['id_okr'];
                $type = $row['id_type'];
                $count = $row['count'];

                if (isset($data[$okr])) {
                    $data[$okr]['type_' . $type] = $count;
                    $data['itog']['type_' . $type] += $count;
                    $data['itog']['total'] += $count;
                    $data[$okr]['total'] += $count;
                }
            }

            // Преобразуем ассоциативный массив в индексированный
            $finalData = array_values($data);
            
            //print_r($data);

            // Создаем CArrayDataProvider
            $dataProvider = new CArrayDataProvider($finalData, array(
                'keyField' => 'id_okr',
                'pagination' => array(
                    'pageSize' => 50,
                ),
            ));

            // Создаем колонки для GridView
            $columns = array(
                array(
                    'name' => 'id_okr',
                    'header' => 'Округ',
                    'type' => 'raw',
                    'value' => '$data["okr_name"]',
                )
            );

            // Добавляем колонки для каждого типа
            foreach ($allTypes as $type) {
                if (isset($typeNames[$type])) {
                    $columns[] = array(
                        'name' => 'type_' . $type,
                        'header' => $typeNames[$type],
                        'type' => 'raw',
                        'value' => 'isset($data["type_' . $type . '"]) ? $data["type_' . $type . '"] : 0',
                    );
                }
            }
            
            $columns[] = array(
                'name' => 'total',
                'header' => 'Всего',
                'type' => 'raw',
                'value' => '$data["total"]',
                'htmlOptions' => array('style' => 'text-align: center; font-weight: bold;'),
                'headerHtmlOptions' => array('style' => 'text-align: center; font-weight: bold;')
            );

            // 1. Получаем категории с id < 3
            $cats = Yii::app()->db->createCommand()
                ->select('id, naim')
                ->from('abi25_cat')
                ->where('id < 3')
                ->queryAll();

            // 2. Получаем все компетенции
            $competList = Yii::app()->db->createCommand()
                ->select('id, naim')
                ->from('abi25_compet')
                ->where('id_comp = '.$id_comp)    
                ->queryAll();

            // 3. Получаем количество участников по компетенции и категории
            $partCounts = Yii::app()->db->createCommand()
                ->select('id_compet, id_cat, COUNT(*) AS cnt')
                ->from('abi25_part')
                ->where('id_cat < 3 and id_comp = '.$id_comp)
                ->group('id_compet, id_cat')
                ->queryAll();

            // 4. Получаем количество экспертов по компетенции
            $expCounts = Yii::app()->db->createCommand()
                ->select('id_compet, COUNT(*) AS cnt')
                ->from('abi25_exp')
                ->where('id_comp = '.$id_comp)    
                ->group('id_compet')
                ->queryAll();

            // Преобразуем результаты в удобные массивы
            $partData = [];
            foreach ($partCounts as $row) {
                $partData[$row['id_compet']][$row['id_cat']] = $row['cnt'];
            }

            $expData = [];
            foreach ($expCounts as $row) {
                $expData[$row['id_compet']] = $row['cnt'];
            }

            // 5. Формируем массив данных для CArrayDataProvider
            $data2 = [];
            $totals = array_fill_keys(array_column($cats, 'id'), 0);
            $totals['exp'] = 0;

            foreach ($competList as $compet) {
                $row = [
                    'compet' => $compet['naim'],
                ];
                foreach ($cats as $cat) {
                    $count = isset($partData[$compet['id']][$cat['id']]) ? $partData[$compet['id']][$cat['id']] : 0;
                    $row['cat_' . $cat['id']] = $count;
                    $totals[$cat['id']] += $count;
                }
                $expCount = isset($expData[$compet['id']]) ? $expData[$compet['id']] : 0;
                $row['exp'] = $expCount;
                $totals['exp'] += $expCount;

                $data2[] = $row;
            }

            // Добавляем итоговую строку
            $sumRow = ['compet' => 'Итого'];
            foreach ($cats as $cat) {
                $sumRow['cat_' . $cat['id']] = $totals[$cat['id']];
            }
            $sumRow['exp'] = $totals['exp'];
            $data2[] = $sumRow;

            // 6. Отдаём данные в представление
            $dataProvider2 = new CArrayDataProvider($data2, [
                'pagination' => false,
            ]);           
            
            $this->render('stats', array(
                'dataProvider' => $dataProvider,
                'dataProvider2' => $dataProvider2,
                'cats' => $cats,
                'columns' => $columns,
                'comp'=>$comp,
            ));
        }

        public function actionAdd_report($id_comp) {
            $comp = $this->loadComp($id_comp);
            $model = new Report;
            $model->id_rep_type = $comp->id_rep_type;
            $model->status = 1;
            if(isset($_POST['Report']))
            {
                $model->attributes=$_POST['Report'];
                if($model->save()) {
                    Yii::app()->db->createCommand('insert into abi25_obsh set id_report = '.$model->id_report)->execute();
                    //$this->redirect(array('site/tree'));
                    $this->redirect(array('abi25/index','id_comp'=>$comp->id));
                }    
            }            
            $this->render('add_report', array(
                'model' => $model,
                'comp' => $comp,
            ));            
        }
        
        public function actionLoadraion()
        {
           if(!Yii::app()->request->isAjaxRequest) throw new CHttpException('Url should be requested via ajax only');            
           $okr = $this->loadEst((int)$_POST['id_okr']);
           $muns = Yii::app()->db->createCommand('select id_est, est_name from est where status <> 0 and type_adm = 2  and id_okr = '.$okr->id_est.' order by id_est ASC')->queryAll(); 
           echo '<option value="">Выберите муниципалитет</option>';
           foreach($muns as $item) {
               echo CHtml::tag('option', array('value'=>$item['id_est']),CHtml::encode($item['est_name']),true);
           }
        }

        public function actionLoadtype()
        {
           if(!Yii::app()->request->isAjaxRequest) throw new CHttpException('Url should be requested via ajax only');            
           $raion = $this->loadEst((int)$_POST['id_raion']);
           $types = Yii::app()->db->createCommand('select est.id_est, est.est_name from est where est.status <> 0 and est.type_adm = 1 and id_raion = '.$raion->id_est.' order by id_est ASC')->queryAll(); 
           echo '<option value="">Выберите тип</option>';
           foreach($types as $item) {
               echo CHtml::tag('option', array('value'=>$item['id_est']),CHtml::encode($item['est_name']),true);
           }
        } 

        public function actionLoadest()
        {
           if(!Yii::app()->request->isAjaxRequest) throw new CHttpException('Url should be requested via ajax only');            
           $type = $this->loadEst((int)$_POST['id_est']);
           $rep_name = $this->loadRep_name((int)$_POST['id_rep_type']);
           //$ests = Yii::app()->db->createCommand('select id_est, est_name from est where status <> 0 and type_adm = 0 and pid_est = '.$type->id_est.' order by id_est ASC')->queryAll();
           $ests = Yii::app()->db->createCommand('SELECT est.id_est, est.est_name
                                                FROM est
                                                LEFT JOIN report ON est.id_est = report.id_est AND report.id_rep_type = '.$rep_name->id_rep_type.'
                                                WHERE est.pid_est = '.$type->id_est.' and est.status <> 0
                                                AND report.id_report IS NULL')->queryAll();           
           echo '<option value="">Выберите организацию</option>';
           foreach($ests as $item) {
               echo CHtml::tag('option', array('value'=>$item['id_est']),CHtml::encode($item['est_name']),true);
           }
        } 
        

	public function actionCompet($id_comp)
	{
            $comp = $this->loadComp($id_comp);
            $model = new Abi25_compet('search');
            $model->unsetAttributes();  // clear any default values
            if(isset($_GET['Abi25_compet'])) {
                $model->attributes=$_GET['Abi25_compet'];                
            }    
            $this->render('compet',array(
                'model'=>$model,
                'comp'=>$comp,
            ));
        } 
        
	public function actionUpdate_compet($id)
	{
            $model = $this->loadCompet($id);

            // Uncomment the following line if AJAX validation is needed
            // $this->performAjaxValidation($model);

            if(isset($_POST['Abi25_compet']))
            {
                $model->attributes=$_POST['Abi25_compet'];
                if($model->save()) {
                    $this->redirect(array('abi25/compet','id_comp'=>$model->id_comp));
                }
            }

            $this->render('update_compet',array(
                'model'=>$model,
            ));
        }
        
        protected function loadCompet($id)
        {
            $model = Abi25_compet::model()->findByPk((int)$id);
            if($model === null) throw new CHttpException(404,'The requested page does not exist.');
            return $model;
        }          
        
        protected function loadRep_name($id_rep_type)
        {
            $model= RepName::model()->findByPk((int)$id_rep_type);
            if($model===null) throw new CHttpException(404,'The requested page does not exist.');
            return $model;
        }          
        
        protected function loadExp($id)
        {
            $model= Abi25_exp::model()->findByPk((int)$id);
            if($model===null) throw new CHttpException(404,'The requested page does not exist.');
            return $model;
        }         

        protected function loadObsh($id_rep)
        {
            $model= Abi25_obsh::model()->findByPk((int)$id_rep);
            if($model===null) throw new CHttpException(404,'The requested page does not exist.');
            //$this->check_prava($model->id_report);
            return $model;
        }          
        
        protected function loadEst($id_est)
        {
            $model = Est::model()->findByPk((int)$id_est);
            if($model === null) throw new CHttpException(404,'The requested page does not exist.');
            return $model;
        }             
        
        protected function loadPart($id)
        {
            $model= Abi25_part::model()->findByPk((int)$id);
            if($model===null) throw new CHttpException(404,'The requested page does not exist2.');
            return $model;
        }         
        
        protected function loadComp($id_comp)
        {
            $model = Abi25_comp::model()->findByPk((int)$id_comp);
            if($model === null) throw new CHttpException(404,'The requested page does not exist.');
            return $model;
        }        
}