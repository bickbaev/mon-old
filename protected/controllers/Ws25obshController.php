<?php

class Ws25obshController extends Controller
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
        
        public function actionComp() {
            $comps = Ws25_comp::model()->findAll();
            $this->render('comp',array(
                'comps'=>$comps,
            ));            
        }
        
	public function actionIndex($id_comp)
	{
            $comp = $this->loadComp($id_comp);
            $model = new Ws25_part('search');
            $model->unsetAttributes();  // clear any default values
            if(isset($_GET['Ws25_part'])) {
                $model->attributes=$_GET['Ws25_part'];                
            }    
            $this->render('index',array(
                'model'=>$model,
                'comp'=>$comp,
            ));
        }
        
	public function actionOtv($id_comp)
	{
            $comp = $this->loadComp($id_comp);
            $model = new Ws25_obsh('search');
            $model->unsetAttributes();  // clear any default values
            if(isset($_GET['Ws25_obsh'])) {
                $model->attributes=$_GET['Ws25_obsh'];                
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

            // Маппинг id_type на названия
            /*$typeNames = array(
                1 => 'Дошкольные образовательные учреждения',
                2 => 'Общеобразовательные учреждения',
                3 => 'Учреждения дополнительного образования детей',
                //4 => 'Учреждения начального профессионального образования',
                5 => 'Учреждения среднего профессионального образования',
                //6 => 'Специальные (коррекционные) образовательные учреждения',
                7 => 'Учреждения высшего профеcсионального образования',
                8 => 'Учреждения для детей, нуждающихся в психолого-педагогической и медико-социальной помощи',
                9 => 'Иные учреждения',
            );*/
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
                $row['id_comp'] = $comp->id;
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
                LEFT JOIN ws25_part ws ON r.id_report = ws.id_report 
                    AND ws.id_stat = 1
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
                    //'value' => '$data["okr_name"]',
                    'value'=>'CHtml::link($data["okr_name"], array("ws25obsh/stats_okr", "id_comp"=>$data["id_comp"], "id_okr"=>$data["id_okr"]))',
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
            
            $this->render('stats', array(
                'dataProvider' => $dataProvider,
                'columns' => $columns,
                'comp'=>$comp,
            ));
        }
        
        public function actionStats_okr($id_comp, $id_okr)
        {
            $comp = $this->loadComp($id_comp);
            $est = $this->loadEst($id_okr);
            if($est->type_adm != 3) throw new CHttpException(404,'The requested page does not exist.');
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
            foreach ($typeNames as $type => $item_name) {
                //$data['id_type'] = $type;
                $data[$type]['name'] = $item_name;
                $sql = "SELECT 
                            e.id_est as id_est,
                            e.est_name as est_name,
                            COUNT(w.id) as cnt
                        FROM est e
                        INNER JOIN report r 
                            ON r.id_est = e.id_est 
                           AND r.id_rep_type =  ".$comp->id_rep_type."
                        LEFT JOIN ws25_part w 
                            ON w.id_report = r.id_report
                            AND w.id_stat = 1
                        WHERE e.id_okr = ".$est->id_est."
                          AND e.id_type = ".$type."
                          AND e.type_adm = 0
                        GROUP BY e.id_est, e.est_name
                        ORDER BY e.est_name;";
                $res = Yii::app()->db->createCommand($sql)->queryAll();
                $data[$type]['provider'] = new CArrayDataProvider($res, array(
                    'keyField' => 'id_est',
                    'pagination' => array(
                        'pageSize' => 200,
                    ),
                ));                
            }
            //print_r($data);
            $this->render('stats_okr', array(
                'data' => $data,
                'comp'=>$comp,
                'est'=>$est,
            ));           
        }    

	public function actionCompet($id_comp)
	{
            $comp = $this->loadComp($id_comp);
            $model = new Ws25_compet('search');
            $model->unsetAttributes();  // clear any default values
            if(isset($_GET['Ws25_compet'])) {
                $model->attributes=$_GET['Ws25_compet'];                
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

            if(isset($_POST['Ws25_compet']))
            {
                $model->attributes=$_POST['Ws25_compet'];
                if($model->save()) {
                    $this->redirect(array('ws25obsh/compet','id_comp'=>$model->id_comp));
                }
            }

            $this->render('update_compet',array(
                'model'=>$model,
            ));
        }        
        

        public function actionScandown($id, $type) {
            if(!in_array((int)$type, [1, 2])) throw new CHttpException(404,'The requested file does not exist2.');
            $model = $this->loadPart($id);
            if($type == 1) {
                $file = $model::FILE_PATH.'/'.Report::model()->findByPk($model->id_report)->id_rep_type.'/'.$model->id_report.'/'.$model->sogl;             
                $naim = $model->sogl_r;
            }
            else {
                $file = $model::FILE_PATH.'/'.Report::model()->findByPk($model->id_report)->id_rep_type.'/'.$model->id_report.'/'.$model->exp;
                $naim = $model->exp_r;
            }
            if(file_exists($file)) {
                Yii::app()->request->sendFile($naim, file_get_contents($file));
            }
            else throw new CHttpException(404,'The requested file does not exist.');            
        }        
        
        public function actionScandown2($id_rep, $id) {
            if(!in_array((int)$id, [6, 7, 8])) throw new CHttpException(404,'The requested file does not exist2.');
            $pok = 'pok'.$id;
            $pokr = 'pok'.$id.'_r';             
            $model = $this->loadObsh($id_rep);
            $file = $model::FILE_PATH.'/'.Report::model()->findByPk($id_rep)->id_rep_type.'/'.$id_rep.'/'.$model->$pok;             
            if(file_exists($file)) {
                Yii::app()->request->sendFile($model->$pokr, file_get_contents($file));
            }
            else throw new CHttpException(404,'The requested file does not exist.');            
        }        

        public function actionOrg_complete($term)
        {
            $data = Est::getAutocompleteData($term);
            echo CJSON::encode($data);
            Yii::app()->end();
        }        
        
        public function actionSurname_complete() {
            $term = Yii::app()->getRequest()->getParam('term');
            $id_comp = Yii::app()->getRequest()->getParam('id_comp');

            if(Yii::app()->request->isAjaxRequest && $term) {
                $criteria = new CDbCriteria;
                // формируем критерий поиска
                $criteria->addSearchCondition('surname', $term);
                if (!empty($id_comp)) {
                    $criteria->addCondition('id_comp = :id_comp');
                    $criteria->params[':id_comp'] = $id_comp;
                }                
                $criteria->group = 'surname';
                $decls = Ws25_part::model()->findAll($criteria);
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
            $id_comp = Yii::app()->getRequest()->getParam('id_comp');

            if(Yii::app()->request->isAjaxRequest && $term) {
                $criteria = new CDbCriteria;
                // формируем критерий поиска
                $criteria->addSearchCondition('pok1', $term);
                if (!empty($id_comp)) {
                    $criteria->addCondition('id_comp = :id_comp');
                    $criteria->params[':id_comp'] = $id_comp;
                }                
                $criteria->group = 'pok1';
                $decls = Ws25_obsh::model()->findAll($criteria);
                // обрабатываем результат
                $result = array();
                foreach($decls as $decl) {
                    $result[] = array('id'=>$decl['id_report'], 'label'=>$decl['pok1'], 'value'=>$decl['pok1']);
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
        
        public function actionUpdate($id) {
            
                $mf = $this->loadPart($id);
                
                if($mf->parent_id) $id_real = $mf->parent_id;
                else $id_real = $id;               
            
                $models['contest'] = $this->loadPart($id_real);
                
                $models['mentor'] = $models['contest']->load_zav($id_real, 2);
                
                $models['accomp'] = $models['contest']->load_zav($id_real, 3);
                
                if($models['accomp'] === null) {
                    $models['accomp'] = new Ws25_part();
                    $models['accomp']->id_report = $models['contest']->id_report;
                }    
                
                foreach($models as $key => $model) {
                    $model->setScenario($key);
                }                
            
                if($models['contest']->report->est->id_type == 2) $school = true;
                else $school = false;

                // Uncomment the following line if AJAX validation is needed
                // $this->performAjaxValidation($model);

                if(isset($_POST['Ws25_part']))
                {
                    $valid = true;

                    // Загружаем данные и файлы для каждой модели
                    foreach($models as $key => $model) {
                        
                        $model->attributes = $_POST['Ws25_part'][$key]; 
                        
                        $model->id_est = $model->report->id_est;
                        
                        if($school) $model->id_cat = 2; 
                        
                        if($key != 'contest') {
                            $model->id_cat = $models['contest']->id_cat;
                            $model->id_compet = $models['contest']->id_compet;
                            if(!$model->ano_org ) $model->rabota = $model->report->est->est_name;
                            if($key == 'mentor') $model->id_stat = 2;
                            if($key == 'accomp') $model->id_stat = 3;                            
                        }
                        else $model->id_stat = 1;
                        
                        $model->file1 = CUploadedFile::getInstance($model, $key.'[file1]');
                        $model->file2 = CUploadedFile::getInstance($model, $key.'[file2]');

                    }
                    
                    $nsov = $models['contest']->nsov();
                    
                    foreach($models as $key => $model) {
                        if($key == 'accomp' && !$nsov) continue;
                        if(!$model->validate()) {
                            $valid = false;
                            Yii::app()->user->setFlash('error_all', 'В данных есть ошибки. Смотрите ниже');
                        }
                    }
                                        
                    if($valid) {
                        if($models['contest']->save()) {
                            $models['mentor']->parent_id = $models['contest']->id;
                            if($nsov) $models['accomp']->parent_id = $models['contest']->id;
                            if($models['mentor']->save()) {
                                if($nsov) {
                                    if($models['accomp']->save()) {
                                        $this->redirect(array('index','id_comp'=>$model->report->ws25->id));
                                    }    
                                }            
                                else $this->redirect(array('index','id_comp'=>$model->report->ws25->id));
                            }    
                        }    
                    }   
                }            
            
                $this->render('update',array(
                    'models'=>$models,
                    'school'=>$school,
                ));              
            
        }        

        public function actionUpdate2($id)
        {
            $model=$this->loadPart($id);

            if($model->report->est->id_type == 2) $school = true;
            else $school = false;
            
            if(isset($_POST['Ws25_part']))
            {
                $model->attributes=$_POST['Ws25_part'];                           
                
                $model->file1 = CUploadedFile::getInstance($model, 'file1');
                if($model->save()) {
                    $this->redirect(array('index','id_comp'=>$model->report->ws25->id));                    
                }
            }

            $this->render('update2',array(
                'model'=>$model,
                'school'=>$school,
            ));
            
        }
        
        public function actionDelete($id)
        {
            if(Yii::app()->request->isPostRequest)
            {
                $mf = $this->loadPart($id);
                
                if($mf->parent_id) $id_real = $mf->parent_id;
                else $id_real = $id;                    
                                
                $models['contest'] = $this->loadPart($id_real);
                
                $models['mentor'] = $models['contest']->load_zav($id_real, 2);
                
                $models['accomp'] = $models['contest']->load_zav($id_real, 3);

                // we only allow deletion via POST request
                if(!$models['accomp'] === null) $models['accomp']->delete();
                $models['mentor']->delete();
                $models['contest']->delete();

                // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
                if(!isset($_GET['ajax']))
                    $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));  
            }
            else
                throw new CHttpException(400,'Invalid request. Please do not repeat this request again.');
        }  

        public function actionDelete2($id)
        {
            if(Yii::app()->request->isPostRequest)
            {
                $model = $this->loadPart($id);

                // we only allow deletion via POST request
                $model->delete();

                // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
                if(!isset($_GET['ajax']))
                    $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));  
            }
            else
                throw new CHttpException(400,'Invalid request. Please do not repeat this request again.');
        }
        
        public function actionExcel2($id_comp, $id_cat) {
            $comp = $this->loadComp($id_comp);
            $cat = Ws25_cat::model()->findByPk((int)$id_cat);
            if($cat === null) throw new CHttpException(404,'The requested page does not exist.');
            $criteria = new CDbCriteria;
            $criteria->with = array(
                'report.ws25' => array(
                    'together' => true,
                    'alias' => 'ws25' // явно задаем алиас для таблицы ws25_comp
                )
            );
            $criteria->condition = 'ws25.id = :id_comp AND t.id_cat = :id_cat';
            $criteria->params = array(
                ':id_comp' => $id_comp,
                ':id_cat' => $id_cat
            );
            $criteria->order = 't.id ASC';
            $items = Ws25_part::model()->findAll($criteria);            
            
            foreach($items as $i=>$item) {
                $otv = $this->loadObsh($item->id_report);
                $res[$i]['okr'] = $this->loadEst($item->report->est->id_okr)->est_name;
                $res[$i]['raion'] = $this->loadEst($item->report->est->id_raion)->est_name;
                $res[$i]['est_name'] = $item->report->est->est_name;
                $res[$i]['id'] = $item->id;
                $res[$i]['parent_id '] = $item->parent_id;
                $res[$i]['id_compet'] = $item->compet->naim;
                $res[$i]['id_cat'] = $item->cat->naim;
                $res[$i]['id_stat'] = $item->stat->naim;
                $res[$i]['surname'] = $item->surname;                
                $res[$i]['name'] = $item->name;
                $res[$i]['patr'] = $item->patr;
                $res[$i]['burthdate'] = $item->burthdate;
                $res[$i]['pers_mail'] = $item->pers_mail;
                $res[$i]['nas_punkt'] = $item->nas_punkt;
                $res[$i]['lic_tel'] = '+7'.$item->lic_code.$item->lic_tel;                
                $res[$i]['id_gr'] = $item->gr->naim;
                $res[$i]['rabota'] = $item->rabota;
                $res[$i]['org_mail'] = $item->org_mail;                                
                $res[$i]['id_po'] = $item->id_po.' '.$item->po->naim_po;
                $res[$i]['klass'] = $item->klass;
                $res[$i]['dol'] = $item->dol;                
                $res[$i]['end_god'] = $item->end_god;
                $res[$i]['per_name'] = $item->per_name;
                $res[$i]['per_patr'] = $item->per_patr;
                $res[$i]['per_surname'] = $item->per_surname;
                $res[$i]['per_tel'] = $item->per_tel?'+7'.$item->per_code.$item->per_tel:'';                 
                $res[$i]['id_size'] = $item->size->naim;
                $res[$i]['housing'] = $item->housing?'Да':'Нет';
                $res[$i]['comment'] = $item->comment;
                $res[$i]['red'] = $otv->pok1.' '.$otv->pok2.' '.$otv->pok3.' '.'+7('.$otv->pok4.')'.$otv->pok5.' '.$item->report->est->est_name; 
                $res[$i]['r_date'] = $item->r_date; 
            }
            $pokaz_src = Ws25_part::model()->attributeLabels();
            foreach ($pokaz_src as $key=>$item) {
                //if($key == 'id_report' || $key == 'pok19') continue;                
                if(in_array($key, array('id_report', 'sogl', 'sogl_r', 'sogl_r', 'exp', 'exp_r', 'ano_org', 'id_est', 'lic_code', 'per_code', '[contest]housing', '[mentor]ano_org', '[mentor]housing', '[accomp]ano_org', '[accomp]housing', 'file1', 'file2', '[contest]ano_org'))) continue;
                $pokaz[$key] = $item;
                if($key == 'red') $pokaz['red'] = 'Ответственный';
            }
            $dabavka = array('id_okr'=>'Округ', 'id_raion'=>'Район', 'est_name'=>'Организация');
            $pokaz = $dabavka + $pokaz;
            $zag = 'ВЧД. Категория "'.$cat->naim.'". По состоянию на '.date('d.m.Y H:i', time());
            
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
            $aSheet->setTitle($cat->naim);
            
            $aSheet->getColumnDimension('A')->setWidth(25);
            $aSheet->getColumnDimension('B')->setWidth(25);
            $aSheet->getColumnDimension('C')->setWidth(25);
            $aSheet->getColumnDimension('F')->setWidth(25);
            $aSheet->getColumnDimension('H')->setWidth(20);
            $aSheet->getColumnDimension('I')->setWidth(15);
            $aSheet->getColumnDimension('J')->setWidth(15);
            $aSheet->getColumnDimension('K')->setWidth(20);            
            $aSheet->getColumnDimension('L')->setWidth(15);
            $aSheet->getColumnDimension('M')->setWidth(15);
            $aSheet->getColumnDimension('N')->setWidth(20);
            $aSheet->getColumnDimension('O')->setWidth(15);
            $aSheet->getColumnDimension('Q')->setWidth(20);
            $aSheet->getColumnDimension('R')->setWidth(20);
            $aSheet->getColumnDimension('S')->setWidth(25);
            $aSheet->getColumnDimension('U')->setWidth(15);
            $aSheet->getColumnDimension('W')->setWidth(20);
            $aSheet->getColumnDimension('X')->setWidth(20);
            $aSheet->getColumnDimension('Y')->setWidth(20);
            $aSheet->getColumnDimension('Z')->setWidth(20);
            
            $aSheet->getColumnDimension('AE')->setWidth(25);
            $aSheet->getColumnDimension('AD')->setWidth(20);
            
            $aSheet->setCellValue('A1',$zag);
            $aSheet->getStyle('A1')->getFont()->setBold(true);
            $i = 0;
            foreach ($pokaz as $value) {
                $aSheet->setCellValueByColumnAndRow($i, 2, $value);
                $i = $i + 1;
            }
            $headerStyle = $aSheet->getStyle('A2:AE2');
            $headerStyle->getFont()->setBold(true);
            $headerStyle->getAlignment()->setWrapText(true);
            $headerStyle->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_TOP);
            $headerStyle->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
            $aSheet->getRowDimension('2')->setRowHeight(100);
            
            $dataStyle = $aSheet->getStyle('A3:AE'.(sizeof($res)+2));
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
            header('Content-Disposition: attachment;filename="ws25.xls"');
            header('Cache-Control: max-age=0');
            $objWriter->save('php://output');
            spl_autoload_register(array('YiiBase','autoload'));            
        }
        
        public function actionExcel($id_comp, $id_cat) {
            $comp = $this->loadComp($id_comp);
            $cat = Ws25_cat::model()->findByPk((int)$id_cat);
            if ($cat === null) throw new CHttpException(404, 'The requested page does not exist.');

            $criteria = new CDbCriteria;
            $criteria->with = array(
                'report.ws25' => array(
                    'together' => true,
                    'alias'    => 'ws25',
                ),
            );
            $criteria->condition = 'ws25.id = :id_comp AND t.id_cat = :id_cat';
            $criteria->params = array(
                ':id_comp' => $id_comp,
                ':id_cat'  => $id_cat,
            );
            $criteria->order = 't.id ASC';
            $items = Ws25_part::model()->findAll($criteria);

            $res = array();
            foreach ($items as $i => $item) {
                $otv = $this->loadObsh($item->id_report);
                $res[$i]['okr']         = $this->loadEst($item->report->est->id_okr)->est_name;
                $res[$i]['raion']       = $this->loadEst($item->report->est->id_raion)->est_name;
                $res[$i]['est_name']    = $item->report->est->est_name;
                $res[$i]['id']          = $item->id;
                $res[$i]['parent_id']   = $item->parent_id; // исправлена опечатка: было 'parent_id ' с пробелом
                $res[$i]['id_compet']   = $item->compet->naim;
                $res[$i]['id_cat']      = $item->cat->naim;
                $res[$i]['id_stat']     = $item->stat->naim;
                $res[$i]['surname']     = $item->surname;
                $res[$i]['name']        = $item->name;
                $res[$i]['patr']        = $item->patr;
                $res[$i]['burthdate']   = $item->burthdate;
                $res[$i]['pers_mail']   = $item->pers_mail;
                $res[$i]['nas_punkt']   = $item->nas_punkt;
                $res[$i]['lic_tel']     = '+7' . $item->lic_code . $item->lic_tel;
                $res[$i]['id_gr']       = $item->gr->naim;
                $res[$i]['rabota']      = $item->rabota;
                $res[$i]['org_mail']    = $item->org_mail;
                $res[$i]['id_po']       = $item->id_po . ' ' . $item->po->naim_po;
                $res[$i]['klass']       = $item->klass;
                $res[$i]['dol']         = $item->dol;
                $res[$i]['end_god']     = $item->end_god;
                $res[$i]['per_name']    = $item->per_name;
                $res[$i]['per_patr']    = $item->per_patr;
                $res[$i]['per_surname'] = $item->per_surname;
                $res[$i]['per_tel']     = $item->per_tel ? '+7' . $item->per_code . $item->per_tel : '';
                $res[$i]['id_size']     = $item->size->naim;
                $res[$i]['housing']     = $item->housing ? 'Да' : 'Нет';
                $res[$i]['comment']     = $item->comment;
                $res[$i]['red']         = $otv->pok1 . ' ' . $otv->pok2 . ' ' . $otv->pok3 . ' '
                                        . '+7(' . $otv->pok4 . ')' . $otv->pok5 . ' '
                                        . $item->report->est->est_name;
                $res[$i]['r_date']      = $item->r_date;
            }

            $pokaz_src = Ws25_part::model()->attributeLabels();
            $pokaz = array();
            $exclude = array(
                'id_report', 'sogl', 'sogl_r', 'exp', 'exp_r', 'ano_org', 'id_est',
                'lic_code', 'per_code', '[contest]housing', '[mentor]ano_org',
                '[mentor]housing', '[accomp]ano_org', '[accomp]housing',
                'file1', 'file2', '[contest]ano_org',
            );
            foreach ($pokaz_src as $key => $item) {
                if (in_array($key, $exclude)) continue;
                $pokaz[$key] = $item;
                if ($key == 'red') $pokaz['red'] = 'Ответственный';
            }
            $dabavka = array('id_okr' => 'Округ', 'id_raion' => 'Район', 'est_name' => 'Организация');
            $pokaz = $dabavka + $pokaz;

            $zag = 'ВЧД. Категория "' . $cat->naim . '". По состоянию на ' . date('d.m.Y H:i', time());
            
            // Подключаем автозагрузчик Composer из папки protected/vendor
            require_once(Yii::app()->basePath . DIRECTORY_SEPARATOR . 'vendor' . DIRECTORY_SEPARATOR . 'autoload.php');            

            // --- PhpSpreadsheet ---
            // Автозагрузка теперь через Composer (vendor/autoload.php),
            // ручной spl_autoload_unregister/include больше не нужен.
            $pExcel = new \PhpOffice\PhpSpreadsheet\Spreadsheet();
            $pExcel->setActiveSheetIndex(0);
            $pExcel->getDefaultStyle()->getFont()->setName('Arial');
            $pExcel->getDefaultStyle()->getFont()->setSize(10);

            $aSheet = $pExcel->getActiveSheet();

            // Название листа: убираем недопустимые символы и обрезаем до 31 символа
            $sheetTitle = preg_replace('/[\\\\\\/\\?\\*\\[\\]:]/u', '', $cat->naim);
            $sheetTitle = mb_substr($sheetTitle, 0, 31);
            if ($sheetTitle === '') $sheetTitle = 'Sheet1';
            $aSheet->setTitle($sheetTitle);

            $aSheet->getColumnDimension('A')->setWidth(25);
            $aSheet->getColumnDimension('B')->setWidth(25);
            $aSheet->getColumnDimension('C')->setWidth(25);
            $aSheet->getColumnDimension('F')->setWidth(25);
            $aSheet->getColumnDimension('H')->setWidth(20);
            $aSheet->getColumnDimension('I')->setWidth(15);
            $aSheet->getColumnDimension('J')->setWidth(15);
            $aSheet->getColumnDimension('K')->setWidth(20);
            $aSheet->getColumnDimension('L')->setWidth(15);
            $aSheet->getColumnDimension('M')->setWidth(15);
            $aSheet->getColumnDimension('N')->setWidth(20);
            $aSheet->getColumnDimension('O')->setWidth(15);
            $aSheet->getColumnDimension('Q')->setWidth(20);
            $aSheet->getColumnDimension('R')->setWidth(20);
            $aSheet->getColumnDimension('S')->setWidth(25);
            $aSheet->getColumnDimension('U')->setWidth(15);
            $aSheet->getColumnDimension('W')->setWidth(20);
            $aSheet->getColumnDimension('X')->setWidth(20);
            $aSheet->getColumnDimension('Y')->setWidth(20);
            $aSheet->getColumnDimension('Z')->setWidth(20);
            $aSheet->getColumnDimension('AE')->setWidth(25);
            $aSheet->getColumnDimension('AD')->setWidth(20);

            $aSheet->setCellValue('A1', $zag);
            $aSheet->getStyle('A1')->getFont()->setBold(true);

            // Заголовки (вторая строка)
            $i = 0;
            foreach ($pokaz as $value) {
                $col = \PhpOffice\PhpSpreadsheet\Cell\Coordinate::stringFromColumnIndex($i + 1);
                $aSheet->setCellValue($col . '2', $value);
                $i++;
            }

            $headerStyle = $aSheet->getStyle('A2:AE2');
            $headerStyle->getFont()->setBold(true);
            $headerStyle->getAlignment()->setWrapText(true);
            $headerStyle->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_TOP);
            $headerStyle->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_LEFT);
            $aSheet->getRowDimension(2)->setRowHeight(100);

            // Данные
            $lastRow = count($res) + 2;
            $dataStyle = $aSheet->getStyle('A3:AE' . $lastRow);
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

            // Выгрузка
            $objWriter = new \PhpOffice\PhpSpreadsheet\Writer\Xls($pExcel);

            header('Content-Type: application/vnd.ms-excel');
            header('Content-Disposition: attachment;filename="ws25.xls"');
            header('Cache-Control: max-age=0');

            $objWriter->save('php://output');

            // Освобождаем память (важно для PhpSpreadsheet)
            $pExcel->disconnectWorksheets();
            unset($pExcel);
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
                    Yii::app()->db->createCommand('insert into ws25_obsh set id_report = '.$model->id_report)->execute();
                    //$this->redirect(array('site/tree'));
                    $this->redirect(array('index','id_comp'=>$comp->id));
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

        protected function usl_data($data) {
            if($data->housing) $housing = "Требуется проживание";
            else $housing = "Не требуется проживание";
            if($data->id_stat == 2) $pd = "<br>".CHtml::link("Подтв. док.", array("ws25obsh/scandown", "id"=>$data->id, "type" => 2));
            else $pd = "";
            return $housing.
                    "<br>Разм. одеж. ".Ws25_size::model()->findByPk($data->id_size)->naim.
                    "<br>".CHtml::link(Согласие, array("ws25obsh/scandown", "id"=>$data->id, "type" => 1)).
                    $pd;
        }

        protected function loadObsh($id_rep)
        {
            $model= Ws25_obsh::model()->findByPk((int)$id_rep);
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
        
        protected function loadRep_name($id_rep_type)
        {
            $model= RepName::model()->findByPk((int)$id_rep_type);
            if($model===null) throw new CHttpException(404,'The requested page does not exist.');
            return $model;
        }           
        
        public function load_zav($id, $id_stat) {
            return Ws25_part::model()->find('parent_id=:parent_id and id_stat = :id_stat', array(':parent_id'=>$id, ':id_stat'=>$id_stat));
        }        
        
        protected function loadPart($id)
        {
            $model= Ws25_part::model()->findByPk((int)$id);
            if($model===null) throw new CHttpException(404,'The requested page does not exist2.');
            return $model;
        }         
        
        protected function loadComp($id_comp)
        {
            $model = Ws25_comp::model()->findByPk((int)$id_comp);
            if($model === null) throw new CHttpException(404,'The requested page does not exist.');
            return $model;
        }
        
        protected function loadCompet($id)
        {
            $model = Ws25_compet::model()->findByPk((int)$id);
            if($model === null) throw new CHttpException(404,'The requested page does not exist.');
            return $model;
        }        

}        