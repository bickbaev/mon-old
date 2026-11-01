<?php

class Atz26Controller extends Controller
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
            if(!sizeof($otchet)) $this->redirect(Yii::app()->user->returnUrl);
            $this->render('index', array('otchet'=> $otchet, 'id_rep_type'=>$id_rep_type));
        }
        
        public function actionPart($id_rep_type, $cat) {
            if(Yii::app()->session['type_adm'] < 3) $this->redirect(Yii::app()->user->returnUrl);
            $rep_name = RepName::model()->findByPk((int)$id_rep_type);
            if($rep_name === null) throw new CHttpException(404,'The requested page does not exist.');
            if(!in_array($cat, [1,2,3,4])) throw new CHttpException(404,'The requested page does not exist.');
            
            for ($pok1 = 1; $pok1 <= 3; $pok1++) {
                $row = [];

                // Базовое условие: pok1 = X и pok4 = 1
                $baseCriteria = new CDbCriteria();
                $baseCriteria->condition = 'pok1 = :pok1 AND pok4 = :pok4';
                $baseCriteria->params = [':pok1' => $pok1, ':pok4' => $cat];
                
                if(Yii::app()->session['est'] == 1) {                
                    $baseCriteria->with = [
                        'report' => [
                            'condition' => 'report.id_rep_type = '.$id_rep_type
                        ]
                    ];
                }
                else {
                    $baseCriteria->with = [
                        'report' => [
                            'with' => [
                                'est' => [
                                    'condition' => 'est.id_okr = '.Yii::app()->session['est']
                                ]
                            ],
                            'condition' => 'report.id_rep_type = '.$id_rep_type
                        ]
                    ];                    
                }               

                $row[] = Atz26_obj::model()->count($baseCriteria);
                
                $row[] = Atz26_obj::model()->count_full($id_rep_type, $pok1, $cat, Yii::app()->session['est']);

                for ($k = 7; $k <= 29; $k++) {
                    if($k == 13 || $k == 14) continue;
                    $pokField = 'pok'.$k;
                    $criteria = clone $baseCriteria;
                    
                    if ($k == 27 || $k == 28) {
                        // Для k=27 и k=28 считаем сумму значений в столбцах pok27 и pok28
                        /*$criteria->select = "SUM($pokField) as sum_value";
                        $command = Atz26_obj::model()->getCommandBuilder()->createFindCommand(Atz26_obj::model()->getTableSchema(), $criteria);
                        $result = $command->queryRow();
                        $row[] = $result['sum_value'] ? $result['sum_value'] : 0;*/
                        $row[] = Atz26_obj::model()->sum_field(
                            $id_rep_type, 
                            $pok1, 
                            $cat, 
                            Yii::app()->session['est'], 
                            $pokField
                        );                        
                    }
                    elseif ($k == 19) {
                        $criteria->condition .= ' AND (pok19 = 1 or pok20 = 1)';
                        $row[] = Atz26_obj::model()->count($criteria);
                    }
                    elseif($k == 20) {continue;}                    
                    else {
                        // Для остальных случаев считаем количество записей где поле = 1
                        $criteria->condition .= " AND $pokField = :$pokField";
                        $criteria->params[":$pokField"] = 1;
                        $row[] = Atz26_obj::model()->count($criteria);
                    }                    
                }

                $itog[] = $row;
            }
            
            //print_r($itog);
            //die();
            
            foreach($itog as $i=>$item) {
                $res[$i][0] = $item[0];
                $m = 1;
                for($k = 1; $k <= 21; $k++) {
                    if($k == 19) {continue;}                        
                    elseif($k == 20) {
                        $res[$i][$m] = $item[$k];
                        if($item[19]) $res[$i][$m + 1] = round($item[$k]*100/$item[19], 2);
                        else $res[$i][$m + 1] = 0;                        
                    }
                    elseif($k == 21) {
                        $res[$i][$m] = $item[$k];                       
                    }
                    else {
                        $res[$i][$m] = $item[$k];
                        if($item[0]) $res[$i][$m + 1] = round($item[$k]*100/$item[0], 2);
                        else $res[$i][$m + 1] = 0;
                    }
                    $m = $m + 2;
                }
            }
            //print_r($res);
            //die();
            $part = array(1 => 'part1.xls', 2 => 'part2.xls', 3 => 'part3.xls', 4 => 'part4.xls');
            if($cat > 1) $res = $this->applySorting($res, $cat);
            $templatePath = Yii::getPathOfAlias('application.res') . '/atz25/'.$part[$cat];
            $this->excel($res, 7, 1, $templatePath, $part[$cat]);            
           
        }
        
        private function applySorting($data, $cat)
        {
            $order =[
                        //2 => [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22, 23, 24, 25, 26, 27, 28, 29, 30, 35, 36, 37, 38, 39, 40, 31, 32, 33, 34, 41],
                        //3 => [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22, 23, 24, 25, 26, 35, 36, 37, 38, 39, 40, 27, 28, 29, 30, 31, 32, 33, 34, 41],
                        //4 => [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 35, 36, 37, 38, 39, 40, 15, 16, 17, 18, 19, 20, 21, 22, 23, 24, 25, 26, 27, 28, 29, 30, 31, 32, 33, 34, 41],
                        2 => [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22, 23, 24, 25, 26, 27, 28, 33, 34, 35, 36, 37, 38, 29, 30, 31, 32, 39],
                        3 => [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22, 23, 24, 33, 34, 35, 36, 37, 38, 25, 26, 27, 28, 29, 30, 31, 32, 39],
                        4 => [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 33, 34, 35, 36, 37, 38, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22, 23, 24, 25, 26, 27, 28, 29, 30, 31, 32, 39],                         
                    ];

            $result = [];

            foreach ($data as $row) {
                $newRow = [];
                foreach ($order[$cat] as $col) {
                    $newRow[] = $row[$col];
                }
                $result[] = $newRow;
            }

            return $result;
        }
        
        public function actionSvod($id_rep_type) {
            if(Yii::app()->session['type_adm'] < 3) $this->redirect(Yii::app()->user->returnUrl);
            $rep_name = RepName::model()->findByPk((int)$id_rep_type);
            if($rep_name === null) throw new CHttpException(404,'The requested page does not exist.');
            
            for ($pok1 = 1; $pok1 <= 3; $pok1++) {
                $row = [];

                // Базовое условие: pok1 = X и pok4 = 1
                $baseCriteria = new CDbCriteria();
                $baseCriteria->condition = 'pok1 = :pok1';
                $baseCriteria->params = [':pok1' => $pok1];
                
                if(Yii::app()->session['est'] == 1) {                
                    $baseCriteria->with = [
                        'report' => [
                            'condition' => 'report.id_rep_type = '.$id_rep_type
                        ]
                    ];
                }
                else {
                    $baseCriteria->with = [
                        'report' => [
                            'with' => [
                                'est' => [
                                    'condition' => 'est.id_okr = '.Yii::app()->session['est']
                                ]
                            ],
                            'condition' => 'report.id_rep_type = '.$id_rep_type
                        ]
                    ];                    
                }
                
                //$row[] = Report::model()->count('id_rep_type=:id_rep_type', array(':id_rep_type'=>$id_rep_type));

                $row[] = Atz26_obj::model()->count($baseCriteria);
                
                $criteria_pass = clone $baseCriteria;
                $criteria_pass->condition .= " AND pok2 = 1 AND pok4 = :pok4";
                
                for($cat = 1; $cat <= 4; $cat++) {
                    $criteria_pass->params[':pok4'] = $cat;
                    $row[] = Atz26_obj::model()->count($criteria_pass);
                }
                
                for($cat = 1; $cat <= 4; $cat++) {
                    $row[] = Atz26_obj::model()->count_full($id_rep_type, $pok1, $cat, Yii::app()->session['est']);
                }    
                
                $poks = array(2,5,31,32,29,30);

                foreach($poks as $k => $num) {
                    $pokField = 'pok'.$num;
                    $criteria = clone $baseCriteria;
                    
                    if ($num == 31 || $num == 32) {
                        $row[] = Atz26_obj::model()->sum_field_all(
                            $id_rep_type, 
                            $pok1,  
                            Yii::app()->session['est'], 
                            $pokField
                        );                        
                    }                  
                    else {
                        // Для остальных случаев считаем количество записей где поле = 1
                        $criteria->condition .= " AND $pokField = :$pokField";
                        $criteria->params[":$pokField"] = 1;
                        $row[] = Atz26_obj::model()->count($criteria);
                    }                    
                }

                $itog[] = $row;
            }
            
            //print_r($itog);
            //die();
            $sootv = array(
                0 => 0,
                1 => 9,
                2 => 10,
                3 => 1,
                4 => 2,
                5 => 3,
                6 => 4,
                8 => 5,
                9 => 6,
                10=> 7,
                11 => 8,
                12 => 11,
                13 => 12,
                14 => 13,
                15 => 14,                
            );
            
            foreach($itog as $i=>$item) {
                for($k = 0; $k <= 16; $k++) {
                    if($k == 7){
                        $res[$i][$k] = $item[5] + $item[6] + $item[7] + $item[8];
                    }
                    elseif($k == 16) {
                        if($item[0] > 0) $res[$i][$k] = round($item[14]*100/$item[0], 2);
                        else $res[$i][$k] = 0;
                    }                   
                    else {
                        $res[$i][$k] = $item[$sootv[$k]];
                    } 
                }
            }
            //print_r($res);
            //die();
            $templatePath = Yii::getPathOfAlias('application.res') . '/atz25/svod.xls';
            $this->excel($res, 5, 2, $templatePath, 'svod.xls');            
           
        }

        public function actionPart5($id_rep_type) {
            if(Yii::app()->session['type_adm'] < 3) $this->redirect(Yii::app()->user->returnUrl);
            $rep_name = RepName::model()->findByPk((int)$id_rep_type);
            if($rep_name === null) throw new CHttpException(404,'The requested page does not exist.');
            for ($pok4 = 1; $pok4 <= 4; $pok4++) {
                $m = 33; 
                $itog_pr = array();
                for($k = 0; $k <= 14; $k++) {
                    $row = array();
                    //if($pok4 == 2 && ($k == 12 || $k == 13)) continue;
                    //if($pok4 == 3 && $k > 10) continue;
                    //if($pok4 == 4 && ($k > 5 || $k == 2)) continue;
                    for($i = 2; $i <= 10; $i++ ) {
                        $row[] = Atz26_obj::model()->sum_field_all_cat($id_rep_type, $pok4,  Yii::app()->session['est'], 'pok'.($m + $i + $k*11));
                    }
                    $row[] = Atz26_obj::model()->sum_field_all_cat($id_rep_type, $pok4,  Yii::app()->session['est'], 'pok'.($m + $k*11)) + Atz26_obj::model()->sum_field_all_cat($id_rep_type, $pok4,  Yii::app()->session['est'], 'pok'.($m + 1 + $k*11));                                        
                    $itog_pr[] = $row;
                }                
                $itog[] = $itog_pr;
            }
            for($b = 200; $b<= 208; $b++) {
                $bp[0][] = Atz26_obj::model()->sum_field_all_bp($id_rep_type,  Yii::app()->session['est'], 'pok'.$b);
            }
            $bp[0][] = Atz26_obj::model()->sum_field_all_bp($id_rep_type,  Yii::app()->session['est'], 'pok198') + Atz26_obj::model()->sum_field_all_bp($id_rep_type,  Yii::app()->session['est'], 'pok199');
            for($b = 211; $b<= 219; $b++) {
                $bp[1][] = Atz26_obj::model()->sum_field_all_bp($id_rep_type,  Yii::app()->session['est'], 'pok'.$b);
            }
            $bp[1][] = Atz26_obj::model()->sum_field_all_bp($id_rep_type,  Yii::app()->session['est'], 'pok209') + Atz26_obj::model()->sum_field_all_bp($id_rep_type,  Yii::app()->session['est'], 'pok210');             
            $itog[] = $bp;
            $this->excel_part5($itog);
            //print_r($itog);
            //die();            
        }
        
        public function excel_part5($itog) {
            $phpExcelPath = '/var/www/cposo/data/www/mon.cposo.ru/protected/vendors/phpexcel';
             // Turn off our amazing library autoload
            spl_autoload_unregister(array('YiiBase','autoload'));
             //
             // making use of our reference, include the main class
             // when we do this, phpExcel has its own autoload registration
             // procedure (PHPExcel_Autoloader::Register();)
            include($phpExcelPath . DIRECTORY_SEPARATOR . 'PHPExcel.php');
            //подключаем и создаем класс PHPExcel
            $templatePath = Yii::getPathOfAlias('application.res') . '/atz25/part5-26.xls';
            $pExcel = PHPExcel_IOFactory::load($templatePath);
            // Получаем активный лист
            $sheet = $pExcel->getActiveSheet();
            
            $cat = array(
                0 => array(9, 2),
                1 => array(26, 2),
                2 => array(43, 2),
                3 => array(60, 2),
                4 => array(76, 2),
            );

            // Заполняем данные из массива
            foreach($itog as $k => $dataArray) {
                foreach ($dataArray as $rowIndex => $rowData) {
                    $currentRow = $cat[$k][0] + $rowIndex;
                    foreach ($rowData as $colIndex => $value) {
                        $currentCol = $cat[$k][1] + $colIndex;
                        $sheet->setCellValueByColumnAndRow($currentCol, $currentRow, $value);
                    }
                }
            }           
            include($phpExcelPath . DIRECTORY_SEPARATOR.'PHPExcel/Writer/Excel5.php');
            $objWriter = new PHPExcel_Writer_Excel5($pExcel);
            header('Content-Type: application/vnd.ms-excel');
            header('Content-Disposition: attachment;filename="part5.xls"');
            header('Cache-Control: max-age=0');
            $objWriter->save('php://output');
            spl_autoload_register(array('YiiBase','autoload'));                         
        }        
        
        public function excel($dataArray, $startRow, $startColumn, $templatePath, $file_name) {
            $phpExcelPath = '/var/www/cposo/data/www/mon.cposo.ru/protected/vendors/phpexcel';
             // Turn off our amazing library autoload
            spl_autoload_unregister(array('YiiBase','autoload'));
             //
             // making use of our reference, include the main class
             // when we do this, phpExcel has its own autoload registration
             // procedure (PHPExcel_Autoloader::Register();)
            include($phpExcelPath . DIRECTORY_SEPARATOR . 'PHPExcel.php');
            //подключаем и создаем класс PHPExcel
            $pExcel = PHPExcel_IOFactory::load($templatePath);
            // Получаем активный лист
            $sheet = $pExcel->getActiveSheet();

            // Заполняем данные из массива
            foreach ($dataArray as $rowIndex => $rowData) {
                $currentRow = $startRow + $rowIndex;

                foreach ($rowData as $colIndex => $value) {
                    $currentCol = $startColumn + $colIndex;

                    // Получаем буквенное обозначение колонки (B, C, D...)
                    //$columnLetter = PHPExcel_Cell::stringFromColumnIndex($currentCol);

                    // Устанавливаем значение ячейки
                    //$sheet->setCellValue($columnLetter . $currentRow, $value);
                    
                    $sheet->setCellValueByColumnAndRow($currentCol, $currentRow, $value);
                }
            }            
            include($phpExcelPath . DIRECTORY_SEPARATOR.'PHPExcel/Writer/Excel5.php');
            $objWriter = new PHPExcel_Writer_Excel5($pExcel);
            header('Content-Type: application/vnd.ms-excel');
            header('Content-Disposition: attachment;filename="'.$file_name.'"');
            header('Cache-Control: max-age=0');
            $objWriter->save('php://output');
            spl_autoload_register(array('YiiBase','autoload'));                         
        }
        
        public function actionF2_part1($id_rep_type) {
            if(Yii::app()->session['type_adm'] < 3) $this->redirect(Yii::app()->user->returnUrl);
            $rep_name = RepName::model()->findByPk((int)$id_rep_type);
            if($rep_name === null) throw new CHttpException(404,'The requested page does not exist.'); 
            $pok1 = array(8, 9, 10, 11, 12, 15, 16, 17, 18);
            $pok2 = array(21, 22, 23, 24, 29);
            
            $baseCriteria = new CDbCriteria();
            if(Yii::app()->session['est'] == 1) {                
                $baseCriteria->with = [
                    'report' => [
                        'condition' => 'report.id_rep_type = '.$id_rep_type
                    ]
                ];
            }
            else {
                $baseCriteria->with = [
                    'report' => [
                        'with' => [
                            'est' => [
                                'condition' => 'est.id_okr = '.Yii::app()->session['est']
                            ]
                        ],
                        'condition' => 'report.id_rep_type = '.$id_rep_type
                    ]
                ];                    
            }
            $atz_obj = Atz26_obj::model()->findAll($baseCriteria);           
            foreach($atz_obj as $item) {
                $row = array();
                $row[] = Est::model()->findByPk($item->report->est->id_raion)->est_name;
                $row[] = $item->get_addr(1);
                $row[] = $item->sob_link->naim;
                $row[] = ($item->pok2 == 1)?'Да':'Нет';
                $row[] = $item->pok3;
                $row[] = $item->cat_link->naim;
                $row[] = ($item->pok5 == 1)?'Да':'Нет';
                $row[] = $item->pok6;
                $pok = '';
                foreach($pok1 as $val) {
                    $pok = 'pok'.$val;
                    $row[] = ($item->$pok == 2)?0:1;
                }
                if(($item->pok19 == 1) || ($item->pok20 == 1)) $row[] = 1;
                else $row[] = 0;
                foreach($pok2 as $k) {
                    $pok = 'pok'.$k;
                    $row[] = ($item->$pok == 2)?0:1;
                }                
                $itog[] = $row;        
            }
            $templatePath = Yii::getPathOfAlias('application.res') . '/atz25/f2_part1_26.xls';
            $this->excel($itog, 4, 0, $templatePath, 'f2_part1.xls');      
            //print_r($itog);
            //die();               
        }
        
        public function actionF2_part2($id_rep_type) {
            if(Yii::app()->session['type_adm'] < 3) $this->redirect(Yii::app()->user->returnUrl);
            $rep_name = RepName::model()->findByPk((int)$id_rep_type);
            if($rep_name === null) throw new CHttpException(404,'The requested page does not exist.'); 
            
            $baseCriteria = new CDbCriteria();
            if(Yii::app()->session['est'] == 1) {                
                $baseCriteria->with = [
                    'report' => [
                        'condition' => 'report.id_rep_type = '.$id_rep_type
                    ]
                ];
            }
            else {
                $baseCriteria->with = [
                    'report' => [
                        'with' => [
                            'est' => [
                                'condition' => 'est.id_okr = '.Yii::app()->session['est']
                            ]
                        ],
                        'condition' => 'report.id_rep_type = '.$id_rep_type
                    ]
                ];                    
            }
            $atz_obj = Atz26_obj::model()->findAll($baseCriteria);
            foreach($atz_obj as $item) {
                $row = array();
                $row[] = Est::model()->findByPk($item->report->est->id_raion)->est_name;
                $row[] = $item->get_addr(1);
                for ($k = 35; $k <= 43; $k++) {
                    $row[] = $item->sum_god($k);
                }                               
                $itog[] = $row;        
            }
            $templatePath = Yii::getPathOfAlias('application.res') . '/atz25/f2_part2.xls';
            $this->excel($itog, 5, 0, $templatePath, 'f2_part2.xls');      
            //print_r($itog);
            //die();               
        }

        public function actionF2_part3($id_rep_type) {
            if(Yii::app()->session['type_adm'] < 3) $this->redirect(Yii::app()->user->returnUrl);
            $rep_name = RepName::model()->findByPk((int)$id_rep_type);
            if($rep_name === null) throw new CHttpException(404,'The requested page does not exist.'); 
            
            $baseCriteria = new CDbCriteria();
            if(Yii::app()->session['est'] == 1) {                
                $baseCriteria->with = [
                    'report' => [
                        'condition' => 'report.id_rep_type = '.$id_rep_type
                    ]
                ];
            }
            else {
                $baseCriteria->with = [
                    'report' => [
                        'with' => [
                            'est' => [
                                'condition' => 'est.id_okr = '.Yii::app()->session['est']
                            ]
                        ],
                        'condition' => 'report.id_rep_type = '.$id_rep_type
                    ]
                ];                    
            }
            $atz_obj = Atz26_obj::model()->findAll($baseCriteria);
            $poks = array(44, 45, 66, 67, array(77,78), 88, 89, 99, 100, 110, 111, array(55,56), 121, 122, 132, 133, 143, 144, 154, 155, 165, 166, 176, 177, 187, 188);
            foreach($atz_obj as $item) {
                $row = array();
                $row[] = Est::model()->findByPk($item->report->est->id_raion)->est_name;
                $row[] = $item->get_addr(1);
                foreach($poks as $num) {                    
                    if(is_array($num)) {
                        $pok1 = 'pok'.$num[0];
                        $pok2 = 'pok'.$num[1];
                        $row[] = $item->$pok1 + $item->$pok2;                        
                    }
                    else {
                        $pok = 'pok'.$num;
                        $row[] = $item->$pok;
                    }                    
                }
                $itog[] = $row;        
            }
            $templatePath = Yii::getPathOfAlias('application.res') . '/atz25/f2_part3.xls';
            $this->excel($itog, 5, 0, $templatePath, 'f2_part3.xls');      
            //print_r($itog);
            //die();               
        }        
        
        public function excel_f2($dataArray, $startRow, $startColumn, $templatePath, $file_name) {
            $phpExcelPath = '/var/www/cposo/data/www/mon.cposo.ru/protected/vendors/phpexcel';
             // Turn off our amazing library autoload
            spl_autoload_unregister(array('YiiBase','autoload'));
             //
             // making use of our reference, include the main class
             // when we do this, phpExcel has its own autoload registration
             // procedure (PHPExcel_Autoloader::Register();)
            include($phpExcelPath . DIRECTORY_SEPARATOR . 'PHPExcel.php');
            //подключаем и создаем класс PHPExcel
            $pExcel = PHPExcel_IOFactory::load($templatePath);
            // Получаем активный лист
            $sheet = $pExcel->getActiveSheet();

            // Заполняем данные из массива
            foreach ($dataArray as $rowIndex => $rowData) {
                $currentRow = $startRow + $rowIndex;

                foreach ($rowData as $colIndex => $value) {
                    $currentCol = $startColumn + $colIndex;

                    // Получаем буквенное обозначение колонки (B, C, D...)
                    //$columnLetter = PHPExcel_Cell::stringFromColumnIndex($currentCol);

                    // Устанавливаем значение ячейки
                    //$sheet->setCellValue($columnLetter . $currentRow, $value);
                    
                    $sheet->setCellValueByColumnAndRow($currentCol, $currentRow, $value);
                }
            }           
            include($phpExcelPath . DIRECTORY_SEPARATOR.'PHPExcel/Writer/Excel5.php');
            $objWriter = new PHPExcel_Writer_Excel5($pExcel);
            header('Content-Type: application/vnd.ms-excel');
            header('Content-Disposition: attachment;filename="'.$file_name.'"');
            header('Cache-Control: max-age=0');
            $objWriter->save('php://output');
            spl_autoload_register(array('YiiBase','autoload'));                         
        }        
}        