<?php

class ProbaController extends Controller
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
            if (Yii::app()->session['id'] != 'bickbaev')
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
            $this->render('index');
	}
        
        public function actionDep() {
            $this->render('dep');            
        }
        
        public function actionLoadcities()
        {
           /*$data=RegionCity::model()->findAll('region_id=:region_id', 
           array(':region_id'=>(int) $_POST['region_id']));

           $data=CHtml::listData($data,'id','city_name');*/
           echo '<select id="city_name" name="city_name">'; 
           echo "<option value=''>Select City</option>";
           for($i = 1; $i < 5; $i++) {
               echo CHtml::tag('option', array('value'=>$i),CHtml::encode($i),true);
           }
           echo '</select>';
           /*foreach($data as $value=>$city_name)
           echo CHtml::tag('option', array('value'=>$value),CHtml::encode($city_name),true);*/
        } 
        
        public function actionLoadraion()
        {
           /*$data=RegionCity::model()->findAll('region_id=:region_id', 
           array(':region_id'=>(int) $_POST['region_id']));

           $data=CHtml::listData($data,'id','city_name');*/
           echo '<select id="city_name" name="city_name">'; 
           echo "<option value=''>Select City</option>";
           for($i = 6; $i < 11; $i++) {
               echo CHtml::tag('option', array('value'=>$i),CHtml::encode($i),true);
           }
           echo '</select>';
           /*foreach($data as $value=>$city_name)
           echo CHtml::tag('option', array('value'=>$value),CHtml::encode($city_name),true);*/
        }        

        public function actionOtchet()
        {
            $command = Yii::app()->db->createCommand('select archive is not null as archive, rep_name, date_type, DATE_FORMAT(s_date, "%d.%m.%Y") AS s_date, DATE_FORMAT(f_date, "%d.%m.%Y") AS f_date, id_rep_type from rep_name');
            $reader = $command->queryAll();
            /*$command = Yii::app()->db->createCommand('select id_est from est where id_okr = 5 and id_est > 20000');
            $reader_est = $command->queryColumn();
            $command = Yii::app()->db->createCommand('select max(id_report) from report');
            $id_report = $command->queryScalar();
            $id_rep_type = 2;
            $status = 1;
            $table = 'osn';
            for ($i = 0; $i < sizeof($reader_est); $i++) {
                $id_report = $id_report + 1;
                $id_reports[$i] = $id_report;
                $command = Yii::app()->db->createCommand('insert into report set id_report = '.$id_report.', id_rep_type = '.$id_rep_type.', id_est = '.$reader_est[$i].', status = '.$status);
                $command->execute();
            }
            for ($i = 0; $i < sizeof($id_reports); $i++) {
                $command = Yii::app()->db->createCommand('insert into '.$table.' set id_report = '.$id_reports[$i]);
                $command->execute();
            }*/
            $model = new RepName('add');
            if(isset($_POST['RepName']))
            {
                $model->attributes=$_POST['RepName'];
                // validate user input and redirect to the previous page if valid
                /*$model->salt = $model->generateSalt();
                $model->id_est = $id_est;
                $model->pass = $model->hashPassword($model->pass1, $model->salt);
                if($model->save()) {
                    //Yii::app()->user->setFlash('add_user',"Пользователь добавлен");
                    //$this->redirect(Yii::app()->user->returnUrl);
                    $this->redirect('index.php?r=site/cabinet&id='.$id_est);
                }*/
            }
            $this->render('otchet', array('model' => $model, 'otchet' => $reader));
        }

        public function actionArchive() {
            if (isset($_GET['id_rep_type']) && $_GET['id_rep_type'] != '') {
                $id_rep_type = (int) $_GET['id_rep_type'];
                $deistv = (int) $_GET['deistv'];
                if (!$deistv) {
                    $command = Yii::app()->db->createCommand('update rep_name set archive = 1 where id_rep_type = '.$id_rep_type);
                    $command->execute();
                }
                else {
                    $command = Yii::app()->db->createCommand('update rep_name set archive = null where id_rep_type = '.$id_rep_type);
                    $command->execute();
                }
                $this->redirect('index.php?r=admin/otchet');
            }
            else $this->redirect(Yii::app()->user->returnUrl);
        }


      public function actionAutoComplete() {
          if (isset($_GET['q'])) {
              $criteria = new CDbCriteria;
              $criteria->condition = 'rep_name LIKE :name';
              $criteria->params = array(':name'=>$_GET['q'].'%');
              if (isset($_GET['limit']) && is_numeric($_GET['limit'])) {
                  $criteria->limit = $_GET['limit'];
               }
              $reports = RepName::model()->findAll($criteria);
              $resStr = '';
              foreach ($reports as $report) {
                  $resStr .= $report->rep_name."\n";
              }
              echo $resStr;
          }
      }
      
      public function actionGenreport() {
          echo '<table class="table table-bordered table-hover" style="width: 900px;">
        <tbody>';          
          for($i = 0; $i < 113; $i++) {
              echo '<tr>
                <td>
                    <?php echo $form->labelEx($model,"pok'.$i.'"); ?><?php echo $form->error($model,"pok'.$i.'"); ?>
                </td>
                <td style="width: 60px;">
                    <?php echo $form->checkBox($model,"pok'.$i.'"); ?>
                </td>                
            </tr>';
          }
          echo '        </tbody>
    </table> ';          
      }

      public function actionChange() {
            /*$command = Yii::app()->db->createCommand('select id_est from est where type_adm = 0');
            $reader_est = $command->queryColumn();
            $reader = array();
            for ($i = 0; $i < sizeof($reader_est); $i++) {
                $command = Yii::app()->db->createCommand('select id_report from report where id_rep_type = 1 and id_est ='.$reader_est[$i]);
                if(!$command->queryScalar()) $reader[$i] = $reader_est[$i];
                /*$id_report = $command->queryScalar();
                $reader[$i] = array($id_report, $reader_est[$i]);
            }
            $this->render('test', array('reader' => $reader));*/
            /*$command = Yii::app()->db->createCommand('select id_est from est where type_adm is null');
            $reader_est = $command->queryColumn();

            for ($i = 0; $i < sizeof($reader_est); $i++) {
                $command = Yii::app()->db->createCommand('update est set type_adm = 0 where id_est ='.$reader_est[$i]);
                $command->execute();
            }
            
            $this->render('test');*/
            /*$command = Yii::app()->db->createCommand('select id_est from est where id_okr = 5 and id_type = 2 and type_adm = 0');
            $reader_est = $command->queryColumn();
            for ($i = 0; $i < sizeof($reader_est); $i++) {
                $command = Yii::app()->db->createCommand('select id_report from report where id_est = '.$reader_est[$i].' and id_report > 1605');
                $id_reports[$i] = $command->queryScalar();
            }
            
            for ($i = 0; $i < sizeof($id_reports); $i++) {
                $command = Yii::app()->db->createCommand('delete from report where id_report = '.$id_reports[$i]);
                $command->execute();
                $command = Yii::app()->db->createCommand('delete from osn where id_report = '.$id_reports[$i]);
                $command->execute();
            }*/
            /*$reports = Yii::app()->db->createCommand('select id_report from report where id_rep_type = 79')->queryColumn();
            foreach($reports as $report) {
                $okr = Yii::app()->db->createCommand('select est.id_okr, est.id_raion from est, report where report.id_est = est.id_est and report.id_rep_type = 79 and report.id_report = '.$report)->queryRow();
                $result = Yii::app()->db->createCommand('update ons_equipment2011 set id_okr = '.$okr['id_okr'].', id_raion = '.$okr['id_raion'].' where id_report = '.$report)->execute();
            }*/
          
            //$this->render('test', array('reader'=>$id_reports));

                /*$id_rep_type = 20;
                $status = 5;
                $status_new = 4;
                $command = Yii::app()->db->createCommand('SELECT id_report from report where id_rep_type = '.$id_rep_type.' and status = '.$status);
                $id_reports = $command->queryColumn();
                for ($i = 0; $i < sizeof($id_reports); $i++) {
                    $command = Yii::app()->db->createCommand('update report set status = '.$status_new.' where id_report = '.$id_reports[$i]);
                    //echo $id_reports[$i].'<br />';
                    $command->execute();
                }*/


                /*$id_rep_type = 296;
                $status = 1;
                $table = 'mpit14';
                $id_type = 2;
                $rep_type_ish = 20;
                $uch_type = 6;
                $command = Yii::app()->db->createCommand('select est.id_est from est, report, contact_info where contact_info.uch_status = 0 and est.id_type = '.$id_type.' and contact_info.uch_type = '.$uch_type.' and report.id_rep_type = '.$rep_type_ish.' and est.id_est = report.id_est and report.id_report = contact_info.id_report and est.id_okr >3');
                $reader_est = $command->queryColumn();
                $command = Yii::app()->db->createCommand('select max(id_report) from report');
                $id_report = $command->queryScalar();
                //$id_report = 9035;
                for ($i = 0; $i < sizeof($reader_est); $i++) {
                    $id_report = $id_report + 1;
                    $command = Yii::app()->db->createCommand('insert into report set id_report = '.$id_report.', id_rep_type = '.$id_rep_type.', id_est = '.$reader_est[$i].', status = '.$status);
                    $command->execute();
                    $command = Yii::app()->db->createCommand('insert into '.$table.' set id_report = '.$id_report);
                    $command->execute();
                }*/
          
            /*$id_rep_type = 177;
            $status = 1;
            $table = 'vpo_info';
            /*$command = Yii::app()->db->createCommand('select est.id_est from report, contact_info, est where contact_info.uch_status = 0 and report.id_rep_type = 39 and est.id_type > 4 and est.type_adm = 0 and est.status = 1 and report.id_report = contact_info.id_report and est.id_est = report.id_est and est.id_okr < 4');
            $reader_est = $command->queryColumn();*/
            /*$reader_est = Yii::app()->db->createCommand('select id_est from est where id_type = 7 and status = 1 and type_adm = 0')->queryColumn();
            $command = Yii::app()->db->createCommand('select max(id_report) from report');
            $id_report = $command->queryScalar();
            for ($i = 0; $i < sizeof($reader_est); $i++) {
                $id_report = $id_report + 1;
                $command = Yii::app()->db->createCommand('insert into report set id_report = '.$id_report.', id_rep_type = '.$id_rep_type.', id_est = '.$reader_est[$i].', status = '.$status);
                $command->execute();
                //$command = Yii::app()->db->createCommand('insert into '.$table.' set id_report = '.$id_report);
                //$command->execute();
            }*/
            
            
            /*$id_rep_type = 125;
            $status = 1;
            $table = 'ons_equipment2011';
            $reader_est =  Yii::app()->db->createCommand('select est.id_est, est.id_okr, est.id_raion from report, contact_info, est where contact_info.uch_status = 0 and report.id_rep_type = 39 and est.id_type = 2 and est.type_adm = 0 and est.status = 1 and report.id_report = contact_info.id_report and est.id_est = report.id_est')->queryAll();
            $id_report = Yii::app()->db->createCommand('select max(id_report) from report')->queryScalar();
            for ($i = 0; $i < sizeof($reader_est); $i++) {
                $id_report = $id_report + 1;
                $sql1 = 'insert into report set id_report = '.$id_report.', id_rep_type = '.$id_rep_type.', id_est = '.$reader_est[$i]['id_est'].', status = '.$status;
                //echo $sql1.'<br>';
                Yii::app()->db->createCommand($sql1)->execute();
                //$sql2 = 'insert into '.$table.' set id_report = '.$id_report.', id_rep_type = '.$id_rep_type.', id_est = '.$reader_est[$i]['id_est'].', id_okr = '.$reader_est[$i]['id_okr'].', id_raion = '.$reader_est[$i]['id_raion'];
                $sql2 = 'insert into '.$table.' set id_report = '.$id_report.', id_rep_type = '.$id_rep_type.', id_okr = '.$reader_est[$i]['id_okr'].', id_raion = '.$reader_est[$i]['id_raion'];
                //$sql2 = 'insert into '.$table.' set id_report = '.$id_report;
                //echo $sql2.'<br>';
                Yii::app()->db->createCommand($sql2)->execute();

            }*/
                        
            /*$command = Yii::app()->db->createCommand('select est.id_est, est.id_okr, est.id_raion, report.id_report from est, report where report.id_rep_type = 90 and report.id_est = est.id_est');
            $reports = $command->queryAll();
            foreach ($reports as $report) {
                //$sql = 'update ons2014 set id_est = '.$report['id_est'].' where id_report = '.$report['id_report'];
                //echo $sql.'<br />';
                $command = Yii::app()->db->createCommand('update ons2014 set id_est = '.$report['id_est'].', id_raion = '.$report['id_raion'].', id_okr = '.$report['id_okr'].', id_rep_type = 90 where id_report = '.$report['id_report']);
                $command->execute();
            }*/
            
            /*$command = Yii::app()->db->createCommand('select id_est, pok2_1_1, pok2_1_3, pok2_1_5 from ons2014 where id_rep_type = 100');
            $reports = $command->queryAll();
            foreach ($reports as $report) {
                $id_report = 0;
                $id_report = Yii::app()->db->createCommand('select id_report from report where id_rep_type = 125 and id_est = '.$report['id_est'])->queryScalar();
                //$sql = 'update ons_equipment2011 set step1 = '.$report['pok2_1_1'].', step2 = '.$report['pok2_1_3'].', step3 = '.$report['pok2_1_5'].', where id_report = '.$id_report;
                //echo $sql.'<br />';
                if($id_report) Yii::app()->db->createCommand('update ons_equipment2011 set step1 = "'.$report['pok2_1_1'].'", step2 = "'.$report['pok2_1_3'].'", step3 = "'.$report['pok2_1_5'].'" where id_report = '.$id_report)->execute();
            }*/
            //ФИЛАТОВА
            $est = array(1245, 1248, 1249, 1255, 1257, 1259, 1260, 1262, 1263, 1264, 1265, 1266, 1267, 1268, 1269, 1270, 1271, 1272, 1273, 1274, 1277, 1279, 1280, 1283, 1284, 1286, 1287, 1288, 1289, 1290, 1291, 1292, 1293, 1294, 1296, 1297, 1298, 1299, 1301, 1302, 1303, 1304, 1306, 1308, 1309, 1312, 1313, 1314, 1315, 1317, 2346, 2348, 2349, 2350, 2352, 2353, 2354, 2362, 2365, 2389, 1295, 1275, 2469);
            //$est = array(1275, 2469);
            $id_rep_type = 664;
            $status = 1;
            $table = 'post196';          
            $id_report = Yii::app()->db->createCommand('select max(id_report) from report')->queryScalar();
            for ($i = 0; $i < sizeof($est); $i++) {
                $id_report = $id_report + 1;
                Yii::app()->db->createCommand('insert into report set id_report = '.$id_report.', id_rep_type = '.$id_rep_type.', id_est = '.$est[$i].', status = '.$status)->execute();
                Yii::app()->db->createCommand('insert into '.$table.' set id_report = '.$id_report)->execute();
            }
            //ФИЛАТОВА
            /*$est = array(1257, 1259, 1260, 1262, 1263, 1264, 1266, 1269, 1270, 1271, 1272, 1306, 1308, 1309, 1312, 1275, 2469);
            $id_rep_type = 343;
            $status = 1;        
            $command = Yii::app()->db->createCommand('select max(id_report) from report');
            $id_report = $command->queryScalar();
            for ($i = 0; $i < sizeof($est); $i++) {
                $id_report = $id_report + 1;
                $command = Yii::app()->db->createCommand('insert into report set id_report = '.$id_report.', id_rep_type = '.$id_rep_type.', id_est = '.$est[$i].', status = '.$status);
                $command->execute();
                //$command = Yii::app()->db->createCommand('insert into '.$table.' set id_report = '.$id_report);
                //$command->execute();
            }*/
            /*$est = array(1257, 1259, 1260, 1262, 1263, 1264, 1266, 1269, 1270, 1271, 1272, 1306, 1308, 1309, 1312);       
            $id_num = Yii::app()->db->createCommand('select max(id_num) from uslugi_num')->queryScalar();
            for ($i = 0; $i < sizeof($est); $i++) {
                $id_num = $id_num + 1;
                Yii::app()->db->createCommand('insert into uslugi_num set id_num = '.$id_num.', id_est = '.$est[$i])->execute();
                //$command = Yii::app()->db->createCommand('insert into '.$table.' set id_report = '.$id_report);
                //$command->execute();
            }*/          
            //$id_report = 28613;
            /*for($m = 2; $m < 4; $m++) {
                //$m = 3;
                $id_rep_type = 254;
                $status = 1;
                //$table = 'siroty_cont';
                $id_type = 2;
                $command = Yii::app()->db->createCommand('select id_est from est where id_okr = '.$m.' and type_adm = 0 and status = 1 and id_type = '.$id_type);
                $reader_est = $command->queryColumn();
                $command = Yii::app()->db->createCommand('select max(id_report) from report');
                $id_report = $command->queryScalar();
                //$id_report = 19915;
                for ($i = 0; $i < sizeof($reader_est); $i++) {
                    $id_report = $id_report + 1;
                    $command = Yii::app()->db->createCommand('insert into report set id_report = '.$id_report.', id_rep_type = '.$id_rep_type.', id_est = '.$reader_est[$i].', status = '.$status);
                    $command->execute();
                    //$command = Yii::app()->db->createCommand('insert into '.$table.' set id_report = '.$id_report);
                    //$command->execute();
                }
            }*/
            //ФИШШШШ
            /*$id_rep_type = 427;
            $status = 1;
            //$table = 'doo_3_7';
            $reader_est = Yii::app()->db->createCommand('select id_est from est where type_adm = 3')->queryColumn();
            $id_report = Yii::app()->db->createCommand('select max(id_report) from report')->queryScalar();
            for ($i = 0; $i < sizeof($reader_est); $i++) {
                $id_report = $id_report + 1;
                Yii::app()->db->createCommand('insert into report set id_report = '.$id_report.', id_rep_type = '.$id_rep_type.', id_est = '.$reader_est[$i].', status = '.$status)->execute();
                //Yii::app()->db->createCommand('insert into '.$table.' set id_report = '.$id_report)->execute();
            }*/
            //ФИШШШШ
            //МОНИТОРИНГ ПИТАНИЯ
            /*$id_rep_type = 299;
            $status = 1;
            $table = 'mpit511';
            $reader_est = Yii::app()->db->createCommand('select id_est from pr_est where id_type = 6')->queryColumn();
            $id_report = Yii::app()->db->createCommand('select max(id_report) from report')->queryScalar();
            for ($i = 0; $i < sizeof($reader_est); $i++) {
                $id_report = $id_report + 1;
                Yii::app()->db->createCommand('insert into report set id_report = '.$id_report.', id_rep_type = '.$id_rep_type.', id_est = '.$reader_est[$i].', status = '.$status)->execute();
                Yii::app()->db->createCommand('insert into '.$table.' set id_report = '.$id_report)->execute();
            }*/
            //МОНИТОРИНГ ПИТАНИЯ
            //ОБЫЧНЫЙ ОТЧЕТ
            /*$id_rep_type = 493;
            $status = 1;
            $table = 'ovz24';
            $uch_type = 6;
            $reader_est = Yii::app()->db->createCommand('select id_est from pr_est where id_type = '.$uch_type)->queryColumn();
            $id_report = Yii::app()->db->createCommand('select max(id_report) from report')->queryScalar();
            for ($i = 0; $i < sizeof($reader_est); $i++) {
                $id_report = $id_report + 1;
                Yii::app()->db->createCommand('insert into report set id_report = '.$id_report.', id_rep_type = '.$id_rep_type.', id_est = '.$reader_est[$i].', status = '.$status)->execute();
                //Yii::app()->db->createCommand('insert into '.$table.' set id_report = '.$id_report)->execute();
            }*/          
            //ОБЫЧНЫЙ ОТЧЕТ
            /*
            $okrs = Yii::app()->db->createCommand('select id_est from est where type_adm = 3 and status = 1')->queryColumn();
                //for($m = 2; $m < 15; $m++) {
            foreach($okrs as $m) {
                //$m = 10;
                //if($m == 8 || $m == 10) continue;
                $id_rep_type = 526;
                $status = 1;
                $table = 'site2023';
                $id_type = 2;
                //$command = Yii::app()->db->createCommand('select id_est from est where id_okr = '.$m.' and type_adm = 0 and status = 1 and id_type = '.$id_type);
                $command = Yii::app()->db->createCommand('select est.id_est from report, contact_info, est where contact_info.uch_status = 0 and report.id_rep_type = 39 and est.id_type = '.$id_type.' and est.type_adm = 0 and est.status = 1 and report.id_report = contact_info.id_report and est.id_est = report.id_est and est.id_okr = '.$m);
                $reader_est = $command->queryColumn();                
                $command = Yii::app()->db->createCommand('select max(id_report) from report');
                $id_report = $command->queryScalar();
                for ($i = 0; $i < sizeof($reader_est); $i++) {
                    $id_report = $id_report + 1;                    
                    //$command = Yii::app()->db->createCommand('insert into report set id_report = '.$id_report.', id_rep_type = '.$id_rep_type.', id_est = '.$reader_est[$i].', status = '.$status);
                    //$command->execute();
                    //$command = Yii::app()->db->createCommand('insert into '.$table.' set id_report = '.$id_report);
                    //$command->execute();                   
                    $rep_cont = Yii::app()->db->createCommand('select id_report from report where id_rep_type = 39 and id_est = '.$reader_est[$i])->queryScalar();
                    $site = Yii::app()->db->createCommand('select site from contact_info where id_report= '.$rep_cont)->queryScalar();
                    Yii::app()->db->createCommand('insert into report set id_report = '.$id_report.', id_rep_type = '.$id_rep_type.', id_est = '.$reader_est[$i].', status = '.$status)->execute();
                    //Yii::app()->db->createCommand('insert into '.$table.' set id_report = '.$id_report.', site2 = "'.$site.'"')->execute();
                }
            }*/
            //ГОСЗАДАНИЕ
            /*$rep_num = Yii::app()->db->createCommand('select max(id_report) from report')->queryScalar();
            $reports = Yii::app()->db->createCommand('select report.id_report, report.id_est from report, est where report.id_rep_type = 215 and est.id_est = report.id_est and est.status = 1')->queryAll();
            //$rep_mun = 42794;
            //$reports = array(0 => array('id_report' => 35653, 'id_est' => 1286));
            foreach ($reports as $report) {
                $rep_num = $rep_num + 1;                
                Yii::app()->db->createCommand('insert into report set id_rep_type = 265, status = 1, id_report = '.$rep_num.', id_est = '.$report['id_est'])->execute();
                //echo 'insert into report set id_rep_type = 178, status = 1, id_report = '.$rep_num.', id_est = '.$report['id_est'].'<br>';
                $usls = Yii::app()->db->createCommand('select id_pok, col1, col2, col3, col4, col5, col6 from us19_res where id_report = '.$report['id_report'])->queryAll();
                foreach($usls as $usl) {
                    Yii::app()->db->createCommand('insert into us19_res set id_pok = '.$usl['id_pok'].', col1 = '.$usl['col1'].', col2 = '.$usl['col2'].', col3 = '.$usl['col3'].', col4 = '.$usl['col4'].', col5 = '.$usl['col5'].', col6 = '.$usl['col6'].', id_report = '.$rep_num)->execute();
                    //echo '---insert into usluga17_res set id_pok = '.$usl['id_pok'].', col = '.$usl['col'].', col2 = '.$usl['col2'].', id_report = '.$rep_num.'<br>';
                }
            }*/
            //ГОСЗАДАНИЕ
            //Новогодние елки
            /*$rep_num = Yii::app()->db->createCommand('select max(id_report) from report')->queryScalar();
            $reports = Yii::app()->db->createCommand('select report.id_report, report.id_est from report, est where report.id_rep_type = 215 and est.id_est = report.id_est and est.status = 1 and est.id_type = 2')->queryAll();
            //$reports = Yii::app()->db->createCommand('select est.id_est from est where type_adm = 0 and est.status = 1 and est.id_type = 6 and id_raion != 16 and id_est != 2272')->queryAll();
            //$rep_mun = 42794;
            //$reports = array(0 => array('id_report' => 35653, 'id_est' => 1286));
            foreach ($reports as $report) {
                $rep_num = $rep_num + 1;                
                Yii::app()->db->createCommand('insert into report set id_rep_type = 254, status = 1, id_report = '.$rep_num.', id_est = '.$report['id_est'])->execute();
                //echo 'insert into report set id_rep_type = 221, status = 1, id_report = '.$rep_num.', id_est = '.$report['id_est'].'<br>';
            }*/
            //Новогодние елки          
            /*$reports = Yii::app()->db->createCommand('select report.id_est from report, est where report.id_rep_type = 215 and report.id_est = est.id_est order by est.id_okr, est.id_raion, est.id_type')->queryColumn(); 
            foreach ($reports as $report) {            
                Yii::app()->db->createCommand('insert into uslugi_num set id_est = '.$report)->execute();
            }*/    
            $this->render('test');
      }
      
      
    public function actionChange_post() {
        
        $posts = [
            ['id_rep_type' => 517, 'table' => 'post188'],
            ['id_rep_type' => 518, 'table' => 'post195'],
            ['id_rep_type' => 519, 'table' => 'post196'],
        ];
        
        foreach($posts as $post) {
            $est = array(1245, 1248, 1249, 1255, 1257, 1259, 1260, 1262, 1263, 1264, 1265, 1266, 1267, 1268, 1269, 1270, 1271, 1272, 1273, 1274, 1277, 1279, 1280, 1283, 1284, 1286, 1287, 1288, 1289, 1290, 1291, 1292, 1293, 1294, 1296, 1297, 1298, 1299, 1301, 1302, 1303, 1304, 1306, 1308, 1309, 1312, 1313, 1314, 1315, 1317, 2346, 2348, 2349, 2350, 2352, 2353, 2354, 2362, 2365, 2389, 1295, 1275, 2469);
            //$est = array(1275, 2469);
            $status = 1;        
            $id_report = Yii::app()->db->createCommand('select max(id_report) from report')->queryScalar();
            for ($i = 0; $i < sizeof($est); $i++) {
                $id_report = $id_report + 1;
                Yii::app()->db->createCommand('insert into report set id_report = '.$id_report.', id_rep_type = '.$post['id_rep_type'].', id_est = '.$est[$i].', status = '.$status)->execute();
                Yii::app()->db->createCommand('insert into '.$post['table'].' set id_report = '.$id_report)->execute();
            } 
        }
        echo 'Ok';
    }  
      
    public function actionChange_site23() {
            $id_rep_type = 444;
            $status = 6;
            $table = 'site2023_spo';
            $uch_type = 5;
            $reader_est = Yii::app()->db->createCommand('select id_est from pr_est where id_type = '.$uch_type)->queryColumn();
            $id_report = Yii::app()->db->createCommand('select max(id_report) from report')->queryScalar();
            for ($i = 0; $i < sizeof($reader_est); $i++) {
                if(($i % 2) == 0) continue;
                $site = '';
                $id_report = $id_report + 1;
                $rep_cont = Yii::app()->db->createCommand('select id_report from report where id_rep_type = 39 and id_est = '.$reader_est[$i])->queryScalar();
                $site = Yii::app()->db->createCommand('select site from contact_info where id_report= '.$rep_cont)->queryScalar();
                Yii::app()->db->createCommand('insert into report set id_report = '.$id_report.', id_rep_type = '.$id_rep_type.', id_est = '.$reader_est[$i].', status = '.$status)->execute();
                Yii::app()->db->createCommand('insert into '.$table.' set id_report = '.$id_report.', site2 = "'.$site.'"')->execute();
            }
            $this->render('test');
    }  
      
    public function actionIsb22() {
            $est = array(21468, 21808, 21422, 21723, 21443, 21464, 21472, 21427, 21721, 21457, 21590, 21293, 21298, 21841, 21438, 21561, 21833, 21654, 21662, 21621, 21771, 21645, 21945, 21962, 21991, 21992, 21849, 21699, 21431, 21451, 21517, 21518, 21509, 21923, 21389, 21674, 21689, 21401, 21313, 21971, 21365, 23535, 21676, 21586, 2458, 21490, 21501, 21532, 21791, 21442, 21387, 21612, 21810, 21668, 21711, 21355, 21305, 21571, 21980, 21845, 21392, 21440);
            $id_rep_type = 353;
            $status = 1;
            $table = 'isb22';
            $command = Yii::app()->db->createCommand('select max(id_report) from report');
            $id_report = $command->queryScalar();
            /*for ($i = 0; $i < sizeof($est); $i++) {
                $id_report = $id_report + 1;
                $command = Yii::app()->db->createCommand('insert into report set id_report = '.$id_report.', id_rep_type = '.$id_rep_type.', id_est = '.$est[$i].', status = '.$status);
                $command->execute();
                $command = Yii::app()->db->createCommand('insert into '.$table.' set id_report = '.$id_report);
                $command->execute();
            }*/
            $this->render('test');
    } 
      
    public function actionChange_gos() {
        $prev_rep = 658;
        $new_rep = 667;
        $rep_num = Yii::app()->db->createCommand('select max(id_report) from report')->queryScalar();
        $reports = Yii::app()->db->createCommand('select report.id_report, report.id_est from report, est where report.id_rep_type = '.$prev_rep.' and est.id_est = report.id_est and est.status = 1')->queryAll();
        foreach ($reports as $report) {
            $rep_num = $rep_num + 1;                
            Yii::app()->db->createCommand('insert into report set id_rep_type = '.$new_rep.', status = 1, id_report = '.$rep_num.', id_est = '.$report['id_est'])->execute();
            //echo 'insert into report set id_rep_type = 178, status = 1, id_report = '.$rep_num.', id_est = '.$report['id_est'].'<br>';
            $usls = Yii::app()->db->createCommand('select id_pok, col1, col2, col3, col4, col5, col6 from us19_res where id_report = '.$report['id_report'])->queryAll();
            foreach($usls as $usl) {
                Yii::app()->db->createCommand('insert into us19_res set id_pok = '.$usl['id_pok'].', col1 = '.$usl['col1'].', col2 = '.$usl['col2'].', col3 = '.$usl['col3'].', col4 = '.$usl['col4'].', col5 = '.$usl['col5'].', col6 = '.$usl['col6'].', id_report = '.$rep_num)->execute();
                //echo '---insert into usluga17_res set id_pok = '.$usl['id_pok'].', col = '.$usl['col'].', col2 = '.$usl['col2'].', id_report = '.$rep_num.'<br>';
            }
        }
        $this->render('test');
    }
    
    public function actionChange_gos2() { //в другой год, аккуратно!!!
        $prev_rep = 601;
        $new_rep = 624;
        $rep_num = Yii::app()->db->createCommand('select max(id_report) from report')->queryScalar();
        $reports = Yii::app()->db->createCommand('select report.id_report, report.id_est from report, est where report.id_rep_type = '.$prev_rep.' and est.id_est = report.id_est and est.status = 1')->queryAll();
        foreach ($reports as $report) {
            $rep_num = $rep_num + 1;                
            /*Yii::app()->db->createCommand('insert into report set id_rep_type = '.$new_rep.', status = 1, id_report = '.$rep_num.', id_est = '.$report['id_est'])->execute();
            //echo 'insert into report set id_rep_type = 178, status = 1, id_report = '.$rep_num.', id_est = '.$report['id_est'].'<br>';
            $usls = Yii::app()->db->createCommand('select id_pok, col1, col2, col3, col4, col5, col6 from us19_res where id_report = '.$report['id_report'])->queryAll();
            foreach($usls as $usl) {
                Yii::app()->db->createCommand('insert into us19_res set id_pok = '.$usl['id_pok'].', col1 = '.$usl['col3'].', col2 = '.$usl['col4'].', col3 = '.$usl['col5'].', col4 = '.$usl['col6'].', col5 = "", col6 = "", id_report = '.$rep_num)->execute();
                //echo '---insert into usluga17_res set id_pok = '.$usl['id_pok'].', col = '.$usl['col'].', col2 = '.$usl['col2'].', id_report = '.$rep_num.'<br>';
            }*/
        }
        $this->render('test');
    }    
    
      
    public function actionChange_inf23() {
        $prev_rep = 410;
        $new_rep = 427;
        $rep_num = Yii::app()->db->createCommand('select max(id_report) from report')->queryScalar();
        $reports = Yii::app()->db->createCommand('select report.id_report, report.id_est from report, est where report.id_rep_type = '.$prev_rep.' and est.id_est = report.id_est and est.status = 1')->queryAll();
        foreach ($reports as $report) {
            $rep_num = $rep_num + 1;                
            //Yii::app()->db->createCommand('insert into report set id_rep_type = '.$new_rep.', status = 1, id_report = '.$rep_num.', id_est = '.$report['id_est'])->execute();
            //echo 'insert into report set id_rep_type = '.$new_rep.', status = 1, id_report = '.$rep_num.', id_est = '.$report['id_est'].'<br>';
        }
        $this->render('test');
    }

    public function actionChange_inf23_2() {
            $est = array(2490, 39701, 39702, 39703, 39704, 39705, 39710, 39711, 39715, 39716, 39718, 39719, 39720, 39721, 39725);
            $id_rep_type = 427;
            $status = 1;
            $command = Yii::app()->db->createCommand('select max(id_report) from report');
            $id_report = $command->queryScalar();
            for ($i = 0; $i < sizeof($est); $i++) {
                $id_report = $id_report + 1;
                Yii::app()->db->createCommand('insert into report set id_report = '.$id_report.', id_rep_type = '.$id_rep_type.', id_est = '.$est[$i].', status = '.$status)->execute();
            }
            $this->render('test');
    }     
    
    public function actionChange_karta() {
        $prev_rep = 573;
        $new_rep = 644;
        $rep_num = Yii::app()->db->createCommand('select max(id_report) from report')->queryScalar();
        $reports = Yii::app()->db->createCommand('select report.id_report, report.id_est from report, est where report.id_rep_type = '.$prev_rep.' and est.id_est = report.id_est and est.status = 1')->queryAll();
        foreach ($reports as $report) {
            $rep_num = $rep_num + 1;                
            Yii::app()->db->createCommand('insert into report set id_rep_type = '.$new_rep.', status = 1, id_report = '.$rep_num.', id_est = '.$report['id_est'])->execute();
            //echo 'insert into report set id_rep_type = '.$new_rep.', status = 1, id_report = '.$rep_num.', id_est = '.$report['id_est'].'<br>';
            $usls = Yii::app()->db->createCommand('select * from karta_info where id_report = '.$report['id_report'])->queryAll();
            foreach($usls as $usl) {
                Yii::app()->db->createCommand('insert into karta_info set id_mun = "'.addslashes($usl['id_mun']).'", address = "'.addslashes($usl['address']).'", uch_inf = "'.addslashes($usl['uch_inf']).'", dir_name = "'.addslashes($usl['dir_name']).'", dir_par = "'.addslashes($usl['dir_par']).'", dir_sur = "'.addslashes($usl['dir_sur']).'", cod_phone = "'.addslashes($usl['cod_phone']).'", phone = "'.addslashes($usl['phone']).'", cod_fax = "'.addslashes($usl['cod_fax']).'", fax = "'.addslashes($usl['fax']).'", mail = "'.addslashes($usl['mail']).'", site = "'.addslashes($usl['site']).'", pr_address = "'.addslashes($usl['pr_address']).'", pr_cod_phone = "'.addslashes($usl['pr_cod_phone']).'", pr_phone = "'.addslashes($usl['pr_phone']).'", pr_cod_fax = "'.addslashes($usl['pr_cod_fax']).'", pr_fax = "'.addslashes($usl['pr_fax']).'", pr_mail = "'.addslashes($usl['pr_mail']).'", pr_s_day = "'.addslashes($usl['pr_s_day']).'", pr_f_day = "'.addslashes($usl['pr_f_day']).'", pr_s_hour = "'.addslashes($usl['pr_s_hour']).'", pr_f_hour = "'.addslashes($usl['pr_f_hour']).'", pr_s_obed = "'.addslashes($usl['pr_s_obed']).'", pr_f_obed = "'.addslashes($usl['pr_f_obed']).'", pr_priem = "'.addslashes($usl['pr_priem']).'", pr_prim = "'.addslashes($usl['pr_prim']).'", id_report = '.$rep_num)->execute();
                //echo '---insert into karta_info set id_mun = "'.addslashes($usl['id_mun']).'", address = "'.addslashes($usl['address']).'", uch_inf = "'.addslashes($usl['uch_inf']).'", dir_name = "'.addslashes($usl['dir_name']).'", dir_par = "'.addslashes($usl['dir_par']).'", dir_sur = "'.addslashes($usl['dir_sur']).'", cod_phone = "'.addslashes($usl['cod_phone']).'", phone = "'.addslashes($usl['phone']).'", cod_fax = "'.addslashes($usl['cod_fax']).'", fax = "'.addslashes($usl['fax']).'", mail = "'.addslashes($usl['mail']).'", site = "'.addslashes($usl['site']).'", pr_address = "'.addslashes($usl['pr_address']).'", pr_cod_phone = "'.addslashes($usl['pr_cod_phone']).'", pr_phone = "'.addslashes($usl['pr_phone']).'", pr_cod_fax = "'.addslashes($usl['pr_cod_fax']).'", pr_fax = "'.addslashes($usl['pr_fax']).'", pr_mail = "'.addslashes($usl['pr_mail']).'", pr_s_day = "'.addslashes($usl['pr_s_day']).'", pr_f_day = "'.addslashes($usl['pr_f_day']).'", pr_s_hour = "'.addslashes($usl['pr_s_hour']).'", pr_f_hour = "'.addslashes($usl['pr_f_hour']).'", pr_s_obed = "'.addslashes($usl['pr_s_obed']).'", pr_f_obed = "'.addslashes($usl['pr_f_obed']).'", pr_priem = "'.addslashes($usl['pr_priem']).'", pr_prim = "'.addslashes($usl['pr_prim']).'", id_report = "'.$rep_num.'"<br>';
            }
        }
        $this->render('test');
    }

    public function actionChange_abi() {
        $prev_rep = 600;
        $new_rep = 669;
        $table = 'abi25_zp_obsh';
        $id_comp = 2;
        $rep_num = Yii::app()->db->createCommand('select max(id_report) from report')->queryScalar();
        $reports = Yii::app()->db->createCommand('select report.id_report, report.id_est from report, est where report.id_rep_type = '.$prev_rep.' and est.id_est = report.id_est and est.status = 1')->queryAll();
        foreach ($reports as $report) {
            $rep_num = $rep_num + 1;                
            //Yii::app()->db->createCommand('insert into report set id_rep_type = '.$new_rep.', status = 1, id_report = '.$rep_num.', id_est = '.$report['id_est'])->execute();
            //echo 'insert into report set id_rep_type = '.$new_rep.', status = 1, id_report = '.$rep_num.', id_est = '.$report['id_est'].'<br>';
            //Yii::app()->db->createCommand('insert into '.$table.' set id_report = '.$rep_num.', id_comp = '.$id_comp)->execute();
            //echo 'insert into '.$table.' set id_report = '.$rep_num.', id_comp = '.$id_comp.'<br>';
        }
        $this->render('test');
    }     
    
    public function actionChange_mpit14() {
        $prev_rep = 310;
        $new_rep = 313;
        $rep_num = Yii::app()->db->createCommand('select max(id_report) from report')->queryScalar();
        $reports = Yii::app()->db->createCommand('select report.id_report, report.id_est from report, est where report.id_rep_type = '.$prev_rep.' and est.id_est = report.id_est and est.status = 1')->queryAll();
        foreach ($reports as $report) {
            $site = '';
            $rep_num = $rep_num + 1;                
            Yii::app()->db->createCommand('insert into report set id_rep_type = '.$new_rep.', status = 1, id_report = '.$rep_num.', id_est = '.$report['id_est'])->execute();
            //echo 'insert into report set id_rep_type = '.$new_rep.', status = 1, id_report = '.$rep_num.', id_est = '.$report['id_est'].'<br>';
            $usls = Yii::app()->db->createCommand('select * from mpit14 where id_report = '.$report['id_report'])->queryAll();
            $rep_cont = Yii::app()->db->createCommand('select id_report from report where id_rep_type = 39 and id_est = '.$report['id_est'])->queryScalar();
            $site = Yii::app()->db->createCommand('select site from contact_info where id_report= '.$rep_cont)->queryScalar();            
            foreach($usls as $usl) {
                $sql = 'insert into mpit14 set id_report = '.$rep_num.', site2 = "'.addslashes($site).'"';
                for ($i = 1; $i < 34; $i++) {
                    $sql = $sql.', pok'.$i.' = "'.addslashes($usl['pok'.$i]).'"';
                }
                Yii::app()->db->createCommand($sql)->execute();
                //echo $sql.'<br/>';
            }
        }
        $this->render('test');        
    }
    
    public function actionChange_mpit511() {
        $prev_rep = 299;
        $new_rep = 308;
        $rep_num = Yii::app()->db->createCommand('select max(id_report) from report')->queryScalar();
        $reports = Yii::app()->db->createCommand('select report.id_report, report.id_est from report, est where report.id_rep_type = '.$prev_rep.' and est.id_est = report.id_est and est.status = 1')->queryAll();
        foreach ($reports as $report) {
            $site = '';
            $rep_num = $rep_num + 1;                
            Yii::app()->db->createCommand('insert into report set id_rep_type = '.$new_rep.', status = 1, id_report = '.$rep_num.', id_est = '.$report['id_est'])->execute();
            //echo 'insert into report set id_rep_type = '.$new_rep.', status = 1, id_report = '.$rep_num.', id_est = '.$report['id_est'].'<br>';
            $usls = Yii::app()->db->createCommand('select * from mpit511 where id_report = '.$report['id_report'])->queryAll();
            $rep_cont = Yii::app()->db->createCommand('select id_report from report where id_rep_type = 39 and id_est = '.$report['id_est'])->queryScalar();
            $site = Yii::app()->db->createCommand('select site from contact_info where id_report= '.$rep_cont)->queryScalar();            
            foreach($usls as $usl) {
                $sql = 'insert into mpit511 set id_report = '.$rep_num.', site2 = "'.addslashes($site).'"';
                for ($i = 1; $i < 34; $i++) {
                    $sql = $sql.', pok'.$i.' = "'.addslashes($usl['pok'.$i]).'"';
                }
                Yii::app()->db->createCommand($sql)->execute();
                //echo $sql.'<br/>';
            }
        }
        $this->render('test');        
    }
    
    public function actionChange_site22_dob() {
        $prev_rep = 368;
        $new_rep = 415;
        $rep_num = Yii::app()->db->createCommand('select max(id_report) from report')->queryScalar();
        $ests = array(21365, 21390, 21483, 21503, 21526, 21545, 21548, 21549, 21578, 21762, 21926, 2257, 21330, 21355, 21703, 21709, 21447, 21490, 21579, 21590, 21529, 21559, 21566, 21519, 21554, 21508, 21509, 21533, 21496, 21573, 21431, 21472, 21475, 21546, 21433, 21488, 21893, 21528, 21550, 21527, 21535, 21544, 21451, 21462, 21653, 21434, 21454, 21466, 21487, 21540, 21556, 21534, 21537, 21552, 21443, 21450, 21524, 21525, 21553, 2413, 21485, 21565, 21437, 21455, 21464, 21493, 21445, 21456, 21458, 21501, 21515, 21560, 21589, 21897, 21517, 21558, 21468, 21471, 21557, 21562, 2259, 21500, 21510, 21521, 21523, 21594, 21441, 21449, 21592, 21473, 21494, 21497, 21555, 21563, 21567, 21452, 21484, 21561, 2258, 21430, 21457, 21461, 21507, 21512, 21514, 21516, 2264, 21371, 21536, 21571, 21582, 21657, 21474, 21518, 21564, 21361, 21460, 21463, 21489, 21502, 21572, 21575, 39509, 2263, 21440, 21453, 21465, 21470, 21585, 21432, 21439, 21467, 21492, 21539, 21541, 21446, 21945, 21381, 21551, 21584, 21597, 21580, 2260, 21586, 21444, 21538, 21363, 21481, 21486, 21495, 21543, 21438, 21476, 21522, 21478, 23536, 2412, 2265, 21354, 21498, 21577, 21499, 21588, 21435, 21532, 21547, 21583, 21937, 39384, 21360, 21386, 21480, 21505, 21513, 21574, 21482, 21884, 21368, 21370, 21459, 21504, 21362, 21436, 21359, 21377, 21690, 21736, 21883, 2255, 21367, 21511, 21531, 21587, 21681, 21832, 21662, 21673, 21856, 21923, 22016, 21699, 21707, 21798, 21900, 2262, 2274, 21666, 21667, 21924, 21593, 21711, 21836, 21852, 21861, 21882, 21929, 21366, 21477, 21656, 21674, 21677, 21678, 21691, 21693, 21696, 21705, 21804, 21840, 21857, 21878, 21894, 21909, 21931, 22031, 21364, 21384, 21685, 21826, 21847, 21917, 22042, 21293, 21542, 21658, 21659, 21688, 21717, 21721, 21730, 21733, 21734, 21737, 21875, 21877, 21886, 21899, 21928, 21932, 21933, 21939, 21372, 21626, 21644, 21679, 21814, 21853, 21862, 21904, 21921, 21942, 21943, 2256, 2325, 21379, 21383, 21672, 21715, 21741, 21848, 21859, 21864, 21871, 22026, 2268, 21313, 21374, 21387, 21631, 21686, 21697, 21735, 21794, 21831, 21833, 21855, 21905, 21911, 21930, 21938, 21944, 21946, 21947, 21969, 2327, 21369, 21388, 21605, 21619, 21665, 21695, 21714, 21739, 21874, 21335, 21604, 21611, 21615, 21632, 21634, 21643, 21668, 21689, 21706, 21724, 21728, 21732, 21830, 21834, 21841, 21888, 21902, 21916, 21927, 21992, 22019, 21420, 21421, 21764, 21768);        
        foreach ($ests as $est) {
            $site = '';
            $rep_num = $rep_num + 1;                
            Yii::app()->db->createCommand('insert into report set id_rep_type = '.$new_rep.', status = 6, id_report = '.$rep_num.', id_est = '.$est)->execute();
            //echo 'insert into report set id_rep_type = '.$new_rep.', status = 6, id_report = '.$rep_num.', id_est = '.$est.'<br>';
            $id_report = Yii::app()->db->createCommand('select report.id_report from report, est where report.id_rep_type = '.$prev_rep.' and report.id_est = '.$est)->queryScalar();
            $usl = Yii::app()->db->createCommand('select * from site2022 where id_report = '.$id_report)->queryRow();
            //print_r($usl);
            $rep_cont = Yii::app()->db->createCommand('select id_report from report where id_rep_type = 39 and id_est = '.$est)->queryScalar();
            $site = Yii::app()->db->createCommand('select site from contact_info where id_report= '.$rep_cont)->queryScalar();            
            $sql = 'insert into site2022 set id_report = '.$rep_num.', site2 = "'.addslashes($site).'"';
            for ($i = 1; $i < 101; $i++) {
                $sql = $sql.', pok'.$i.' = "'.addslashes($usl['pok'.$i]).'"';
            }
            Yii::app()->db->createCommand($sql)->execute();
            //echo $sql.'<br/>';
        }
        $this->render('test');        
    }

    public function actionChange_site22_spo_dob() {
        $prev_rep = 369;
        $new_rep = 416;
        $rep_num = Yii::app()->db->createCommand('select max(id_report) from report')->queryScalar();
        $ests = array(1263, 2346, 1259, 1277, 1270, 1275, 1248, 1267, 1297, 2350, 1291, 1284, 1280, 2469, 1273, 1257, 1317, 1288, 1279, 1295, 1249, 1266, 1286, 1268, 1296, 1293, 1313, 1315, 2354, 1255, 1271);        
        foreach ($ests as $est) {
            $site = '';
            $rep_num = $rep_num + 1;                
            Yii::app()->db->createCommand('insert into report set id_rep_type = '.$new_rep.', status = 6, id_report = '.$rep_num.', id_est = '.$est)->execute();
            //echo 'insert into report set id_rep_type = '.$new_rep.', status = 6, id_report = '.$rep_num.', id_est = '.$est.'<br>';
            $id_report = Yii::app()->db->createCommand('select report.id_report from report, est where report.id_rep_type = '.$prev_rep.' and report.id_est = '.$est)->queryScalar();
            $usl = Yii::app()->db->createCommand('select * from site2022_spo where id_report = '.$id_report)->queryRow();
            $rep_cont = Yii::app()->db->createCommand('select id_report from report where id_rep_type = 39 and id_est = '.$est)->queryScalar();
            $site = Yii::app()->db->createCommand('select site from contact_info where id_report= '.$rep_cont)->queryScalar();            
            $sql = 'insert into site2022_spo set id_report = '.$rep_num.', site2 = "'.addslashes($site).'"';
            for ($i = 1; $i < 101; $i++) {
                $sql = $sql.', pok'.$i.' = "'.addslashes($usl['pok'.$i]).'"';
            }
            Yii::app()->db->createCommand($sql)->execute();
            //echo $sql.'<br/>';
        }
        $this->render('test');        
    }

    public function actionChange_site22_spo() {
        $prev_rep = 341;
        $new_rep = 369;
        $rep_num = Yii::app()->db->createCommand('select max(id_report) from report')->queryScalar();
        $reports = Yii::app()->db->createCommand('select report.id_report, report.id_est from report, est where report.id_rep_type = '.$prev_rep.' and est.id_est = report.id_est and est.status = 1')->queryAll();
        foreach ($reports as $report) {
            $site = '';
            $rep_num = $rep_num + 1;                
            Yii::app()->db->createCommand('insert into report set id_rep_type = '.$new_rep.', status = 6, id_report = '.$rep_num.', id_est = '.$report['id_est'])->execute();
            //echo 'insert into report set id_rep_type = '.$new_rep.', status = 6, id_report = '.$rep_num.', id_est = '.$report['id_est'].'<br>';            
            $usl = Yii::app()->db->createCommand('select * from site2021_spo where id_report = '.$report['id_report'])->queryRow();
            $rep_cont = Yii::app()->db->createCommand('select id_report from report where id_rep_type = 39 and id_est = '.$report['id_est'])->queryScalar();
            $site = Yii::app()->db->createCommand('select site from contact_info where id_report= '.$rep_cont)->queryScalar();            
            $sql = 'insert into site2022_spo set id_report = '.$rep_num.', site2 = "'.addslashes($site).'"';
            for ($i = 1; $i < 99; $i++) {
                if($i < 7) $sql = $sql.', pok'.$i.' = "'.addslashes($usl['pok'.$i]).'"';
                else $sql = $sql.', pok'.($i+2).' = "'.addslashes($usl['pok'.$i]).'"';
            }
            Yii::app()->db->createCommand($sql)->execute();
            //echo $sql.'<br/>';
        }
        $this->render('test');        
    }
    
    public function actionChange_site22_spo_dva() {
        $prev_rep = 306;
        $new_rep = 369;
        $prom_rep = 341;
        $rep_num = Yii::app()->db->createCommand('select max(id_report) from report')->queryScalar();
        $reports = Yii::app()->db->createCommand('select report.id_report, report.id_est from report, est where report.id_rep_type = '.$prev_rep.' and est.id_est = report.id_est and est.status = 1')->queryAll();
        foreach ($reports as $report) {
            $site = '';
            $hr = 0;
            $hr = Yii::app()->db->createCommand('select id_report from report where id_rep_type = '.$prom_rep.' and id_est = '.$report['id_est'])->queryScalar();
            if(!$hr) {
                $rep_num = $rep_num + 1;                
                Yii::app()->db->createCommand('insert into report set id_rep_type = '.$new_rep.', status = 6, id_report = '.$rep_num.', id_est = '.$report['id_est'])->execute();
                //echo 'insert into report set id_rep_type = '.$new_rep.', status = 6, id_report = '.$rep_num.', id_est = '.$report['id_est'].'<br>';            
                $usl = Yii::app()->db->createCommand('select * from site2021_spo where id_report = '.$report['id_report'])->queryRow();
                $rep_cont = Yii::app()->db->createCommand('select id_report from report where id_rep_type = 39 and id_est = '.$report['id_est'])->queryScalar();
                $site = Yii::app()->db->createCommand('select site from contact_info where id_report= '.$rep_cont)->queryScalar();            
                $sql = 'insert into site2022_spo set id_report = '.$rep_num.', site2 = "'.addslashes($site).'"';
                for ($i = 1; $i < 99; $i++) {
                    if($i < 7) $sql = $sql.', pok'.$i.' = "'.addslashes($usl['pok'.$i]).'"';
                    else $sql = $sql.', pok'.($i+2).' = "'.addslashes($usl['pok'.$i]).'"';
                }
                Yii::app()->db->createCommand($sql)->execute();
                //echo $sql.'<br/>';
            }
        }
        $this->render('test');        
    }

    public function actionChange_site22() {
        $prev_rep = 340;
        $new_rep = 368;
        $rep_num = Yii::app()->db->createCommand('select max(id_report) from report')->queryScalar();
        $reports = Yii::app()->db->createCommand('select report.id_report, report.id_est from report, est where report.id_rep_type = '.$prev_rep.' and est.id_est = report.id_est and est.status = 1')->queryAll();
        foreach ($reports as $report) {
            $site = '';
            $rep_num = $rep_num + 1;                
            Yii::app()->db->createCommand('insert into report set id_rep_type = '.$new_rep.', status = 6, id_report = '.$rep_num.', id_est = '.$report['id_est'])->execute();
            //echo 'insert into report set id_rep_type = '.$new_rep.', status = 6, id_report = '.$rep_num.', id_est = '.$report['id_est'].'<br>';            
            $usl = Yii::app()->db->createCommand('select * from site2021 where id_report = '.$report['id_report'])->queryRow();
            $rep_cont = Yii::app()->db->createCommand('select id_report from report where id_rep_type = 39 and id_est = '.$report['id_est'])->queryScalar();
            $site = Yii::app()->db->createCommand('select site from contact_info where id_report= '.$rep_cont)->queryScalar();            
            $sql = 'insert into site2022 set id_report = '.$rep_num.', site2 = "'.addslashes($site).'"';
            for ($i = 1; $i < 94; $i++) {
                if($i < 7) $sql = $sql.', pok'.$i.' = "'.addslashes($usl['pok'.$i]).'"';
                elseif($i < 62) $sql = $sql.', pok'.($i+2).' = "'.addslashes($usl['pok'.$i]).'"';
                else $sql = $sql.', pok'.($i+7).' = "'.addslashes($usl['pok'.$i]).'"';
            }
            Yii::app()->db->createCommand($sql)->execute();
            //echo $sql.'<br/>';
        }
        $this->render('test');        
    } 
    
    public function actionChange_site22_dva() {
        $prev_rep = 305;
        $new_rep = 368;
        $prom_rep = 340;
        $rep_num = Yii::app()->db->createCommand('select max(id_report) from report')->queryScalar();
        $reports = Yii::app()->db->createCommand('select report.id_report, report.id_est from report, est where report.id_rep_type = '.$prev_rep.' and est.id_est = report.id_est and est.status = 1')->queryAll();
        foreach ($reports as $report) {
            $site = '';
            $hr = 0;
            $hr = Yii::app()->db->createCommand('select id_report from report where id_rep_type = '.$prom_rep.' and id_est = '.$report['id_est'])->queryScalar();
            if(!$hr) {            
                $rep_num = $rep_num + 1;                
                Yii::app()->db->createCommand('insert into report set id_rep_type = '.$new_rep.', status = 6, id_report = '.$rep_num.', id_est = '.$report['id_est'])->execute();
                //echo 'insert into report set id_rep_type = '.$new_rep.', status = 6, id_report = '.$rep_num.', id_est = '.$report['id_est'].'<br>';            
                $usl = Yii::app()->db->createCommand('select * from site2021 where id_report = '.$report['id_report'])->queryRow();
                $rep_cont = Yii::app()->db->createCommand('select id_report from report where id_rep_type = 39 and id_est = '.$report['id_est'])->queryScalar();
                $site = Yii::app()->db->createCommand('select site from contact_info where id_report= '.$rep_cont)->queryScalar();            
                $sql = 'insert into site2022 set id_report = '.$rep_num.', site2 = "'.addslashes($site).'"';
                for ($i = 1; $i < 94; $i++) {
                    if($i < 7) $sql = $sql.', pok'.$i.' = "'.addslashes($usl['pok'.$i]).'"';
                    elseif($i < 62) $sql = $sql.', pok'.($i+2).' = "'.addslashes($usl['pok'.$i]).'"';
                    else $sql = $sql.', pok'.($i+7).' = "'.addslashes($usl['pok'.$i]).'"';
                }
                Yii::app()->db->createCommand($sql)->execute();
                //echo $sql.'<br/>';
            }
        }
        $this->render('test');        
    }

    public function actionChange_site23_dva() {
        $prev_rep = 615;
        $new_rep = 650;
        $status = 6;
        $table = 'site2024_spo';
        $id_type = 5;        
        $rep_num = Yii::app()->db->createCommand('select max(id_report) from report')->queryScalar();
        $ests = Yii::app()->db->createCommand('select id_est from pr_est where id_type = '.$id_type)->queryColumn();
        foreach ($ests as $est) {
            $site = '';
            $hr = 0;
            $hr = Yii::app()->db->createCommand('select id_report from report where id_rep_type = '.$prev_rep.' and id_est = '.$est)->queryScalar();
            if(!$hr) {            
                $rep_num = $rep_num + 1;                
                $rep_cont = Yii::app()->db->createCommand('select id_report from report where id_rep_type = 39 and id_est = '.$est)->queryScalar();
                $site = Yii::app()->db->createCommand('select site from contact_info where id_report= '.$rep_cont)->queryScalar();
                //echo 'insert into report set id_report = '.$rep_num.', id_rep_type = '.$new_rep.', id_est = '.$est.', status = '.$status.'||';
                //echo 'insert into '.$table.' set id_report = '.$rep_num.', site2 = "'.$site.'"'.'<br>';
                Yii::app()->db->createCommand('insert into report set id_report = '.$rep_num.', id_rep_type = '.$new_rep.', id_est = '.$est.', status = '.$status)->execute();
                Yii::app()->db->createCommand('insert into '.$table.' set id_report = '.$rep_num.', site2 = "'.$site.'"')->execute();
            }
        }
        $this->render('test');        
    }     

    public function actionProba_prosto() {
        //$okrs = Yii::app()->db->createCommand('select id_est from est where type_adm = 3 and status = 1 and id_est > 15')->queryColumn(); //самарское и тольяттинское управление
        //$okrs = Yii::app()->db->createCommand('select id_est from est where type_adm = 3 and status = 1 and id_est < 4')->queryColumn(); //департаменты
        //$okrs = Yii::app()->db->createCommand('select id_est from est where type_adm = 3 and status = 1 and id_est > 3')->queryColumn(); //кроме департаменты
        $okrs = Yii::app()->db->createCommand('select id_est from est where type_adm = 3 and status = 1')->queryColumn();
        //for($m = 2; $m < 15; $m++) {
        foreach($okrs as $m) {
            $id_rep_type = 636;
            $status = 1;
            $table = 'ovz24';
            $id_type = 6;
            $reader_est = array();
            $reader_est = Yii::app()->db->createCommand('select id_est from pr_est where id_type = '.$id_type.' and id_okr = '.$m)->queryColumn();          
            $id_report = Yii::app()->db->createCommand('select max(id_report) from report')->queryScalar();
            if(sizeof($reader_est)) {
                for ($i = 0; $i < sizeof($reader_est); $i++) {
                    $id_report = $id_report + 1;                                     
                    Yii::app()->db->createCommand('insert into report set id_report = '.$id_report.', id_rep_type = '.$id_rep_type.', id_est = '.$reader_est[$i].', status = '.$status)->execute();
                    Yii::app()->db->createCommand('insert into '.$table.' set id_report = '.$id_report)->execute();
                }
            }
        }
        $this->render('test');        
    }
    
    public function actionProsto_complex() {
        $id_rep_type = 616;
        $status = 1;
        $table = 'atz25';
        //$reader_est = [2449];
        //$reader_est = Yii::app()->db->createCommand('select id_est from est where id_type = '.$id_type.' and id_okr = '.$m)->queryColumn();
        //$reader_est = Yii::app()->db->createCommand('select id_est from est where id_type = 9 and status = 1 and type_adm = 0')->queryColumn();          
        $reader_est = Yii::app()->db->createCommand('select id_est from pr_est')->queryColumn();
        $id_report = Yii::app()->db->createCommand('select max(id_report) from report')->queryScalar();
        if(sizeof($reader_est)) {
            for ($i = 0; $i < sizeof($reader_est); $i++) {
                $id_report = $id_report + 1;                                     
                Yii::app()->db->createCommand('insert into report set id_report = '.$id_report.', id_rep_type = '.$id_rep_type.', id_est = '.$reader_est[$i].', status = '.$status)->execute();
                //Yii::app()->db->createCommand('insert into '.$table.' set id_report = '.$id_report)->execute();
            }
        }
        $this->render('test');        
    }

    public function actionProba_ws() {
        $okrs = Yii::app()->db->createCommand('select id_est from est where type_adm = 3 and status = 1')->queryColumn();
        //for($m = 2; $m < 15; $m++) {
        foreach($okrs as $m) {
            $id_rep_type = 656;
            $status = 1;
            $table = 'ws25_obsh';
            $id_type = 9;
            $id_comp = 2;
            $reader_est = array();
            $reader_est = Yii::app()->db->createCommand('select id_est from est where status = 1 and type_adm = 0 and id_type = '.$id_type.' and id_okr = '.$m)->queryColumn();          
            $id_report = Yii::app()->db->createCommand('select max(id_report) from report')->queryScalar();
            if(sizeof($reader_est)) {
                for ($i = 0; $i < sizeof($reader_est); $i++) {
                    $id_report = $id_report + 1;                                     
                    Yii::app()->db->createCommand('insert into report set id_report = '.$id_report.', id_rep_type = '.$id_rep_type.', id_est = '.$reader_est[$i].', status = '.$status)->execute();
                    Yii::app()->db->createCommand('insert into '.$table.' set id_report = '.$id_report.', id_comp = '.$id_comp)->execute();
                }
            }
        }
        $this->render('test');        
    }    
    
    public function actionChange_kino22() {
        $prev_rep = 638;
        $new_rep = 645;
        $rep_num = Yii::app()->db->createCommand('select max(id_report) from report')->queryScalar();
        $reports = Yii::app()->db->createCommand('select report.id_report, report.id_est from report, est where report.id_rep_type = '.$prev_rep.' and est.id_est = report.id_est and est.status = 1')->queryAll();
        foreach ($reports as $report) {
            $site = '';
            $rep_num = $rep_num + 1;                
            Yii::app()->db->createCommand('insert into report set id_rep_type = '.$new_rep.', status = 1, id_report = '.$rep_num.', id_est = '.$report['id_est'])->execute();
            //echo 'insert into report set id_rep_type = '.$new_rep.', status = 1, id_report = '.$rep_num.', id_est = '.$report['id_est'].'<br>';
            $usls = Yii::app()->db->createCommand('select * from kino2022 where id_report = '.$report['id_report'])->queryAll();           
            foreach($usls as $usl) {
                $sql = 'insert into kino2022 set id_report = '.$rep_num;
                for ($i = 1; $i < 7; $i++) {
                    $sql = $sql.', pok'.$i.' = "'.addslashes($usl['pok'.$i]).'"';
                }
                Yii::app()->db->createCommand($sql)->execute();
                //echo $sql.'<br/>';
            }
        }
        $this->render('test');        
    }
    
    public function actionChange_atz() {
        $prev_rep = 616;
        $new_rep = 647;
        $rep_num = Yii::app()->db->createCommand('select max(id_report) from report')->queryScalar();
        $reports = Yii::app()->db->createCommand('select report.id_report, report.id_est from report, est where report.id_rep_type = '.$prev_rep.' and est.id_est = report.id_est and est.status = 1')->queryAll();
        foreach ($reports as $report) {
            $rep_num = $rep_num + 1;                
            Yii::app()->db->createCommand('insert into report set id_rep_type = '.$new_rep.', status = 1, id_report = '.$rep_num.', id_est = '.$report['id_est'])->execute();
            //echo 'insert into report set id_rep_type = '.$new_rep.', status = 1, id_report = '.$rep_num.', id_est = '.$report['id_est'].'<br />';
            $objs = Yii::app()->db->createCommand('select * from atz25_obj where id_report = '.$report['id_report'])->queryAll();
            $obj_num = Yii::app()->db->createCommand('select max(id) from atz26_obj')->queryScalar();
            foreach($objs as $obj) {
                $obj_num = $obj_num + 1; 
                $sql = 'insert into atz26_obj set id = '.$obj_num.', id_report = '.$rep_num;
                for ($i = 1; $i < 33; $i++) {
                    $sql = $sql.', pok'.$i.' = "'.addslashes($obj['pok'.$i]).'"';
                }
                Yii::app()->db->createCommand($sql)->execute();
                //echo '--'.$sql.'<br />';
                $adrs = Yii::app()->db->createCommand('select * from atz25_adr where id_obj = '.$obj['id'])->queryAll();
                foreach($adrs as $adr) {
                    $sql2 = 'insert into atz26_adr set id_obj = '.$obj_num.
                             ', obj_name = "'.addslashes($adr['obj_name']).'"'
                            .', obj_index = "'.addslashes($adr['obj_index']).'"'
                            .', id_mun = "'.addslashes($adr['id_mun']).'"'
                            .', nas_punkt_type = "'.$adr['nas_punkt_type'].'"'
                            .', nas_punkt = "'.addslashes($adr['nas_punkt']).'"'
                            .', street_type = "'.$adr['street_type'].'"'
                            .', street = "'.addslashes($adr['street']).'"'
                            .', dom = "'.addslashes($adr['dom']).'"'
                            .', kad_num = "'.addslashes($adr['kad_num']).'"';
                    Yii::app()->db->createCommand($sql2)->execute();
                    //echo '----'.$sql2.'<br />';
                }
            }
        }
        $this->render('test');       
    }    

    public function actionKino22_del() {
        $rep = 503;
        $reports = Yii::app()->db->createCommand('select report.id_report, report.id_est from report, est where report.id_rep_type = '.$rep.' and est.id_est = report.id_est and est.status = 1')->queryAll();
        foreach ($reports as $report) {
            if($report['id_report']%2 == 1) {
                //echo 'delete from kino2022 where id_report = '.$report['id_report'].'<br>';
                //echo 'delete from report where id_report = '.$report['id_report'].'<br>';
                //Yii::app()->db->createCommand('delete from kino2022 where id_report = '.$report['id_report'])->execute();
                //Yii::app()->db->createCommand('delete from report where id_report = '.$report['id_report'])->execute();
            }
        }
        $this->render('test');
    }
      
    public function actionAddnewest() {
        $id_rep_type = 39;
        $status = 1;
        $table = 'contact_info';
        $type = array(
            1 => 'Дошкольные образовательные учреждения',
            2 => 'Общеобразовательные учреждения',
            3 => 'Учреждения дополнительного образования детей',
            4 => 'Учреждения начального профессионального образования',
            5 => 'Учреждения среднего профессионального образования',
            6 => 'Специальные (коррекционные) образовательные учреждения',
            7 => 'Учреждения высшего професcионального образования',
            8 => 'Учреждения для детей, нуждающихся в психолого-педагогической и медико-социальной помощи',
            9 => 'Иные учреждения',
        );
        $new_est = array(
            array('est_name' => 'МБОУ Школа № 68 г.о. Самара', 'id_okr'=> 2, 'id_raion' => 15, 'id_type' => 2),
            array('est_name' => 'МБОУ Школа № 26 г.о. Самара', 'id_okr'=> 2, 'id_raion' => 15, 'id_type' => 2),
            array('est_name' => 'МБОУ ОДПО ЦРО г.о. Самара', 'id_okr'=> 2, 'id_raion' => 15, 'id_type' => 9),
        );
        foreach($new_est as $item) {
            $pid_est = Yii::app()->db->createCommand('SELECT id_est FROM `est` WHERE type_adm = 1 and id_okr = '.$item['id_okr'].' and id_raion = '.$item['id_raion'].' and id_type = '.$item['id_type'])->queryScalar();
            if(!$pid_est) {
                $pid_est = Yii::app()->db->createCommand('select max(id_est)+1 from est WHERE type_adm = 1')->queryScalar();
                Yii::app()->db->createCommand('insert into est set id_est = '.$pid_est.', pid_est = '.$item['id_raion'].', est_name = "'.addslashes($type[$item['id_type']]).'", type_adm = 1, status = 1, cab_status = 0, id_okr = '.$item['id_okr'].', id_raion = '.$item['id_raion'].', id_type = '.$item['id_type'])->execute();
            }
            $id_est = Yii::app()->db->createCommand('select max(id_est)+1 from est')->queryScalar();
            Yii::app()->db->createCommand('insert into est set id_est = '.$id_est.', pid_est = '.$pid_est.', est_name = "'.addslashes($item['est_name']).'", type_adm = 0, status = 1, cab_status = 1, id_okr = '.$item['id_okr'].', id_raion = '.$item['id_raion'].', id_type = '.$item['id_type'])->execute();
            $id_report = Yii::app()->db->createCommand('select max(id_report)+1 from report')->queryScalar();
            Yii::app()->db->createCommand('insert into report set id_report = '.$id_report.', id_rep_type = '.$id_rep_type.', id_est = '.$id_est.', status = '.$status)->execute();
            Yii::app()->db->createCommand('insert into '.$table.' set id_report = '.$id_report)->execute();            
        }
        $this->render('test');
    }

    public function actionKarta() {
            $id_rep_type = 573;
            $id_rep_type_new = 644;
            $status = 1;
            $table = 'karta_info';
            $rep_num = Yii::app()->db->createCommand('select max(id_report) from report')->queryScalar();
            $reports = Yii::app()->db->createCommand('select report.id_report, report.id_est from report, est where report.id_rep_type = '.$id_rep_type.' and est.id_est = report.id_est and est.status = 1')->queryAll();
            foreach ($reports as $report) {
                $rep_num = $rep_num + 1;                
                Yii::app()->db->createCommand('insert into report set id_rep_type = '.$id_rep_type_new.', status = '.$status.', id_report = '.$rep_num.', id_est = '.$report['id_est'])->execute();
                //echo 'insert into report set id_rep_type = '.$id_rep_type_new.', status = '.$status.', id_report = '.$rep_num.', id_est = '.$report['id_est'].'<br>';
                $info = Yii::app()->db->createCommand('select * from karta_info where id_report = '.$report['id_report'])->queryRow();
                /*echo 'insert into karta_info set id_report = '.$rep_num.', '
                        . 'id_mun = "'.addslashes($info['id_mun']).'",'
                        . 'address = "'.addslashes($info['address']).'",'
                        . 'uch_inf = "'.addslashes($info['uch_inf']).'",'
                        . 'dir_name = "'.addslashes($info['dir_name']).'",'
                        . 'dir_par = "'.addslashes($info['dir_par']).'",'
                        . 'dir_sur = "'.addslashes($info['dir_sur']).'",'
                        . 'cod_phone = "'.addslashes($info['cod_phone']).'",'
                        . 'phone = "'.addslashes($info['phone']).'",'
                        . 'cod_fax = "'.addslashes($info['cod_fax']).'",'
                        . 'fax = "'.addslashes($info['fax']).'",'
                        . 'mail = "'.addslashes($info['mail']).'",'
                        . 'site = "'.addslashes($info['site']).'",'
                        . 'pr_address = "'.addslashes($info['pr_address']).'",'
                        . 'pr_cod_phone = "'.addslashes($info['pr_cod_phone']).'",'
                        . 'pr_phone = "'.addslashes($info['pr_phone']).'",'
                        . 'pr_cod_fax = "'.addslashes($info['pr_cod_fax']).'",'
                        . 'pr_fax = "'.addslashes($info['pr_fax']).'",'
                        . 'pr_mail = "'.addslashes($info['pr_mail']).'",'
                        . 'pr_s_day = "'.addslashes($info['pr_s_day']).'",'
                        . 'pr_f_day = "'.addslashes($info['pr_f_day']).'",'
                        . 'pr_s_hour = "'.addslashes($info['pr_s_hour']).'",'
                        . 'pr_f_hour = "'.addslashes($info['pr_f_hour']).'",'
                        . 'pr_s_obed = "'.addslashes($info['pr_s_obed']).'",'
                        . 'pr_f_obed = "'.addslashes($info['pr_f_obed']).'",'
                        . 'pr_priem = "'.addslashes($info['pr_priem']).'",'
                        . 'pr_prim = "'.addslashes($info['pr_prim']).'"'.'<br>'; */               
                Yii::app()->db->createCommand('insert into karta_info set id_report = '.$rep_num.', '
                        . 'id_mun = "'.addslashes($info['id_mun']).'",'
                        . 'address = "'.addslashes($info['address']).'",'
                        . 'uch_inf = "'.addslashes($info['uch_inf']).'",'
                        . 'dir_name = "'.addslashes($info['dir_name']).'",'
                        . 'dir_par = "'.addslashes($info['dir_par']).'",'
                        . 'dir_sur = "'.addslashes($info['dir_sur']).'",'
                        . 'cod_phone = "'.addslashes($info['cod_phone']).'",'
                        . 'phone = "'.addslashes($info['phone']).'",'
                        . 'cod_fax = "'.addslashes($info['cod_fax']).'",'
                        . 'fax = "'.addslashes($info['fax']).'",'
                        . 'mail = "'.addslashes($info['mail']).'",'
                        . 'site = "'.addslashes($info['site']).'",'
                        . 'pr_address = "'.addslashes($info['pr_address']).'",'
                        . 'pr_cod_phone = "'.addslashes($info['pr_cod_phone']).'",'
                        . 'pr_phone = "'.addslashes($info['pr_phone']).'",'
                        . 'pr_cod_fax = "'.addslashes($info['pr_cod_fax']).'",'
                        . 'pr_fax = "'.addslashes($info['pr_fax']).'",'
                        . 'pr_mail = "'.addslashes($info['pr_mail']).'",'
                        . 'pr_s_day = "'.addslashes($info['pr_s_day']).'",'
                        . 'pr_f_day = "'.addslashes($info['pr_f_day']).'",'
                        . 'pr_s_hour = "'.addslashes($info['pr_s_hour']).'",'
                        . 'pr_f_hour = "'.addslashes($info['pr_f_hour']).'",'
                        . 'pr_s_obed = "'.addslashes($info['pr_s_obed']).'",'
                        . 'pr_f_obed = "'.addslashes($info['pr_f_obed']).'",'
                        . 'pr_priem = "'.addslashes($info['pr_priem']).'",'
                        . 'pr_prim = "'.addslashes($info['pr_prim']).'"')->execute();
                $usls = Yii::app()->db->createCommand('select * from karta_po_new where id_report = '.$report['id_report'])->queryAll();
                foreach($usls as $usl) {
                    Yii::app()->db->createCommand('insert into karta_po_new set id_report = '.$rep_num.', '
                        . 'id_po = "'.addslashes($usl['id_po']).'",'
                        . 'po_prog = "'.addslashes($usl['po_prog']).'",'
                        . 'po_forma = "'.addslashes($usl['po_forma']).'",'
                        . 'po_oplata = "'.addslashes($usl['po_oplata']).'",'
                        . 'srok = "'.addslashes($usl['srok']).'",'
                        . 'nachalo = "",'
                        . 'zdorov = "'.addslashes($usl['zdorov']).'",'
                        . 'obsh = "'.addslashes($usl['obsh']).'",'
                        . 'address = "'.addslashes($usl['address']).'",'
                        . 'kurs = "'.addslashes($usl['kurs']).'",'
                        . 'link = "'.addslashes($usl['link']).'"')->execute();
                    /*echo 'insert into karta_po_new set id_report = '.$rep_num.', '
                        . 'id_po = "'.addslashes($usl['id_po']).'",'
                        . 'po_prog = "'.addslashes($usl['po_prog']).'",'
                        . 'po_forma = "'.addslashes($usl['po_forma']).'",'
                        . 'po_oplata = "'.addslashes($usl['po_oplata']).'",'
                        . 'srok = "'.addslashes($usl['srok']).'",'
                        . 'nachalo = "",'
                        . 'zdorov = "'.addslashes($usl['zdorov']).'",'
                        . 'obsh = "'.addslashes($usl['obsh']).'",'
                        . 'address = "'.addslashes($usl['address']).'",'
                        . 'kurs = "'.addslashes($usl['kurs']).'",'
                        . 'link = "'.addslashes($usl['link']).'"'.'<br>';*/                    
                }                
            }
            $this->render('test');            
      }
      
      public function actionOv() {
            $id_rep_type = 572;
            $id_rep_type_new = 643;
            $status = 1;
            $rep_num = Yii::app()->db->createCommand('select max(id_report) from report')->queryScalar();
            $reports = Yii::app()->db->createCommand('select report.id_report, report.id_est from report, est where report.id_rep_type = '.$id_rep_type.' and est.id_est = report.id_est and est.status = 1')->queryAll();
            foreach ($reports as $report) {
                $rep_num = $rep_num + 1;                
                Yii::app()->db->createCommand('insert into report set id_rep_type = '.$id_rep_type_new.', status = '.$status.', id_report = '.$rep_num.', id_est = '.$report['id_est'])->execute();
                //echo 'insert into report set id_rep_type = '.$id_rep_type_new.', status = '.$status.', id_report = '.$rep_num.', id_est = '.$report['id_est'].'<br>';
                $otv = Yii::app()->db->createCommand('select * from ov_otv where id_report = '.$report['id_report'])->queryRow();
                /*echo 'insert into ov_otv set id_report = '.$rep_num.', '
                    . 'fio_otv= "'.addslashes($otv['fio_otv']).'",'
                    . 'cod_tel= "'.addslashes($otv['cod_tel']).'",'
                    . 'tel= "'.addslashes($otv['tel']).'",'
                    . 'mail= "'.addslashes($otv['mail']).'"'.'<br>';*/               
                Yii::app()->db->createCommand('insert into ov_otv set id_report = '.$rep_num.', '
                    . 'fio_otv="'.addslashes($otv['fio_otv']).'",'
                    . 'cod_tel="'.addslashes($otv['cod_tel']).'",'
                    . 'tel="'.addslashes($otv['tel']).'",'
                    . 'mail="'.addslashes($otv['mail']).'"')->execute();
                $usls = Yii::app()->db->createCommand('select * from ov_kurs where id_report = '.$report['id_report'])->queryAll();
                foreach($usls as $usl) {
                    /*echo '--insert into ov_kurs set id_report = '.$rep_num.', '
                        . 'id_okpdtr = "'.addslashes($usl['id_okpdtr']).'",'
                        . 'naim_kurs = "'.addslashes($usl['naim_kurs']).'",'
                        . 'hours_kurs = "'.addslashes($usl['hours_kurs']).'",'
                        . 'forma_kurs1 = "'.addslashes($usl['forma_kurs1']).'",'
                        . 'forma_kurs2 = "'.addslashes($usl['forma_kurs2']).'",'
                        . 'forma_kurs3 = "'.addslashes($usl['forma_kurs3']).'",'
                        . 'forma_kurs4 = "'.addslashes($usl['forma_kurs4']).'",'
                        . 'razr = "'.addslashes($usl['razr']).'",'
                        . 'id_doc = "'.addslashes($usl['id_doc']).'",'
                        . 'oplata = "'.addslashes($usl['oplata']).'",'
                        . 'dop = "'.addslashes($usl['dop']).'"'.'<br>';*/             
                    Yii::app()->db->createCommand('insert into ov_kurs set id_report = '.$rep_num.', '
                        . 'id_okpdtr = "'.addslashes($usl['id_okpdtr']).'",'
                        . 'naim_kurs = "'.addslashes($usl['naim_kurs']).'",'
                        . 'hours_kurs = "'.addslashes($usl['hours_kurs']).'",'
                        . 'forma_kurs1 = "'.addslashes($usl['forma_kurs1']).'",'
                        . 'forma_kurs2 = "'.addslashes($usl['forma_kurs2']).'",'
                        . 'forma_kurs3 = "'.addslashes($usl['forma_kurs3']).'",'
                        . 'forma_kurs4 = "'.addslashes($usl['forma_kurs4']).'",'
                        . 'razr = "'.addslashes($usl['razr']).'",'
                        . 'id_doc = "'.addslashes($usl['id_doc']).'",'
                        . 'oplata = "'.addslashes($usl['oplata']).'",'
                        . 'dop = "'.addslashes($usl['dop']).'"')->execute();                  
                }                
            }
            $this->render('test');            
      }

      public function actionVpo_spo() {
            $id_rep_type = 295;
            $id_rep_type_new = 443;
            $status = 1;
            $rep_num = Yii::app()->db->createCommand('select max(id_report) from report')->queryScalar();
            $reports = Yii::app()->db->createCommand('select report.id_report, report.id_est from report, est where report.id_rep_type = '.$id_rep_type.' and est.id_est = report.id_est and est.status = 1')->queryAll();
            foreach ($reports as $report) {
                $rep_num = $rep_num + 1;                
                Yii::app()->db->createCommand('insert into report set id_rep_type = '.$id_rep_type_new.', status = '.$status.', id_report = '.$rep_num.', id_est = '.$report['id_est'])->execute();
                //echo 'insert into report set id_rep_type = '.$id_rep_type_new.', status = '.$status.', id_report = '.$rep_num.', id_est = '.$report['id_est'].'<br>';
                $usls = Yii::app()->db->createCommand('select * from vpo_spo where id_report = '.$report['id_report'])->queryAll();
                foreach($usls as $usl) {
                    /*echo 'insert into vpo_spo set id_report = '.$rep_num.', '
                        . 'id_po = "'.addslashes($usl['id_po']).'",'
                        . 'po_prog = "'.addslashes($usl['po_prog']).'",'
                        . 'po_forma = "'.addslashes($usl['po_forma']).'",'
                        . 'po_oplata = "'.addslashes($usl['po_oplata']).'",'
                        . 'srok = "'.addslashes($usl['srok']).'",'
                        . 'nachalo = "'.addslashes($usl['nachalo']).'",'
                        . 'zdorov = "'.addslashes($usl['zdorov']).'",'
                        . 'obsh = "'.addslashes($usl['obsh']).'",'
                        . 'address = "'.addslashes($usl['address']).'",'
                        . 'kurs = "'.addslashes($usl['kurs']).'",'
                        . 'link = "'.addslashes($usl['link']).'"'.'<br>';*/             
                    /*Yii::app()->db->createCommand('insert into vpo_spo set id_report = '.$rep_num.', '
                        . 'id_po = "'.addslashes($usl['id_po']).'",'
                        . 'po_prog = "'.addslashes($usl['po_prog']).'",'
                        . 'po_forma = "'.addslashes($usl['po_forma']).'",'
                        . 'po_oplata = "'.addslashes($usl['po_oplata']).'",'
                        . 'srok = "'.addslashes($usl['srok']).'",'
                        . 'nachalo = "'.addslashes($usl['nachalo']).'",'
                        . 'zdorov = "'.addslashes($usl['zdorov']).'",'
                        . 'obsh = "'.addslashes($usl['obsh']).'",'
                        . 'address = "'.addslashes($usl['address']).'",'
                        . 'kurs = "'.addslashes($usl['kurs']).'",'
                        . 'link = "'.addslashes($usl['link']).'"')->execute();*/               
                }                
            }
            $this->render('test');            
      }

      public function actionVpo() {
            $id_rep_type = 442;
            $id_rep_type_new = 574;
            $status = 1;
            $rep_num = Yii::app()->db->createCommand('select max(id_report) from report')->queryScalar();
            $id_faculty = Yii::app()->db->createCommand('select max(id_faculty) from vpo_faculty')->queryScalar();
            $reports = Yii::app()->db->createCommand('select report.id_report, report.id_est from report, est where report.id_rep_type = '.$id_rep_type.' and est.id_est = report.id_est and est.status = 1')->queryAll();
            foreach ($reports as $report) {
                $rep_num = $rep_num + 1;                
                Yii::app()->db->createCommand('insert into report set id_rep_type = '.$id_rep_type_new.', status = '.$status.', id_report = '.$rep_num.', id_est = '.$report['id_est'])->execute();
                //echo 'insert into report set id_rep_type = '.$id_rep_type_new.', status = '.$status.', id_report = '.$rep_num.', id_est = '.$report['id_est'].'<br>';
                $info = Yii::app()->db->createCommand('select * from vpo_info where id_report = '.$report['id_report'])->queryRow();
                /*echo 'insert into vpo_info set id_report = '.$rep_num.', '
                        . 'id_mun = "'.addslashes($info['id_mun']).'",'
                        . 'address = "'.addslashes($info['address']).'",'
                        . 'dir_name = "'.addslashes($info['dir_name']).'",'
                        . 'dir_par = "'.addslashes($info['dir_par']).'",'
                        . 'dir_sur = "'.addslashes($info['dir_sur']).'",'
                        . 'cod_phone = "'.addslashes($info['cod_phone']).'",'
                        . 'phone = "'.addslashes($info['phone']).'",'
                        . 'mail = "'.addslashes($info['mail']).'",'
                        . 'site = "'.addslashes($info['site']).'",'
                        . 'pr_address = "'.addslashes($info['pr_address']).'",'
                        . 'pr_cod_phone = "'.addslashes($info['pr_cod_phone']).'",'
                        . 'pr_phone = "'.addslashes($info['pr_phone']).'",'
                        . 'pr_mail = "'.addslashes($info['pr_mail']).'",'
                        . 'pr_s_day = "'.addslashes($info['pr_s_day']).'",'
                        . 'pr_f_day = "'.addslashes($info['pr_f_day']).'",'
                        . 'pr_s_hour = "'.addslashes($info['pr_s_hour']).'",'
                        . 'pr_f_hour = "'.addslashes($info['pr_f_hour']).'",'
                        . 'pr_s_obed = "'.addslashes($info['pr_s_obed']).'",'
                        . 'pr_f_obed = "'.addslashes($info['pr_f_obed']).'",'
                        . 'pr_priem = "'.addslashes($info['pr_priem']).'",'
                        . 'podg = "'.addslashes($info['podg']).'"'.'<br>';*/                
                Yii::app()->db->createCommand('insert into vpo_info set id_report = '.$rep_num.', '
                        . 'id_mun = "'.addslashes($info['id_mun']).'",'
                        . 'address = "'.addslashes($info['address']).'",'
                        . 'dir_name = "'.addslashes($info['dir_name']).'",'
                        . 'dir_par = "'.addslashes($info['dir_par']).'",'
                        . 'dir_sur = "'.addslashes($info['dir_sur']).'",'
                        . 'cod_phone = "'.addslashes($info['cod_phone']).'",'
                        . 'phone = "'.addslashes($info['phone']).'",'
                        . 'mail = "'.addslashes($info['mail']).'",'
                        . 'site = "'.addslashes($info['site']).'",'
                        . 'pr_address = "'.addslashes($info['pr_address']).'",'
                        . 'pr_cod_phone = "'.addslashes($info['pr_cod_phone']).'",'
                        . 'pr_phone = "'.addslashes($info['pr_phone']).'",'
                        . 'pr_mail = "'.addslashes($info['pr_mail']).'",'
                        . 'pr_s_day = "'.addslashes($info['pr_s_day']).'",'
                        . 'pr_f_day = "'.addslashes($info['pr_f_day']).'",'
                        . 'pr_s_hour = "'.addslashes($info['pr_s_hour']).'",'
                        . 'pr_f_hour = "'.addslashes($info['pr_f_hour']).'",'
                        . 'pr_s_obed = "'.addslashes($info['pr_s_obed']).'",'
                        . 'pr_f_obed = "'.addslashes($info['pr_f_obed']).'",'
                        . 'pr_priem = "'.addslashes($info['pr_priem']).'",'
                        . 'podg = "'.addslashes($info['podg']).'"')->execute();
                $facs = Yii::app()->db->createCommand('select * from vpo_faculty where id_report = '.$report['id_report'])->queryAll();                
                foreach($facs as $fac) {
                    $id_faculty = $id_faculty + 1;
                    /*echo 'insert into vpo_faculty set id_faculty = '.$id_faculty.', '
                        . 'id_report = "'.addslashes($rep_num).'",'
                        . 'naim_faculty = "'.addslashes($fac['naim_faculty']).'",'
                        . 'link = "'.addslashes($fac['link']).'"'.'<br>'; */            
                    Yii::app()->db->createCommand('insert into vpo_faculty set id_faculty = '.$id_faculty.', '
                        . 'id_report = "'.addslashes($rep_num).'",'
                        . 'naim_faculty = "'.addslashes($fac['naim_faculty']).'",'
                        . 'link = "'.addslashes($fac['link']).'"')->execute();
                    $datas = Yii::app()->db->createCommand('select * from vpo_data where id_faculty = '.$fac['id_faculty'])->queryAll();
                    foreach($datas as $data) {
                        /*echo 'insert into vpo_data set id_report = '.$rep_num.', '
                                . 'id_faculty = "'.addslashes($id_faculty).'",'
                                . 'code_vpo = "'.addslashes($data['code_vpo']).'",'
                                . 'profil = "'.addslashes($data['profil']).'",'
                                . 'id_forma = "'.addslashes($data['id_forma']).'",'
                                . 'srok = "'.addslashes($data['srok']).'",'
                                . 'isp = "'.addslashes($data['isp']).'",'
                                . 'budget = "'.addslashes($data['budget']).'",'
                                . 'war = "'.addslashes($data['war']).'",'
                                . 'zdorov = "'.addslashes($data['zdorov']).'",'
                                . 'link = "'.addslashes($data['link']).'",'
                                . 'stoim = "'.addslashes($data['stoim']).'",'
                                . 'bud = "'.addslashes($data['bud']).'",'
                                . 'vbud = "'.addslashes($data['vbud']).'",'
                                . 'pr1 = "'.addslashes($data['pr1']).'",'
                                . 'pr2 = "'.addslashes($data['pr2']).'",'
                                . 'pr3 = "'.addslashes($data['pr3']).'",'
                                . 'pr4 = "'.addslashes($data['pr4']).'",'
                                . 'pr5 = "'.addslashes($data['pr5']).'",'
                                . 'pr6 = "'.addslashes($data['pr6']).'",'
                                . 'pr7 = "'.addslashes($data['pr7']).'",'
                                . 'pr8 = "'.addslashes($data['pr8']).'",'
                                . 'pr9 = "'.addslashes($data['pr9']).'",'
                                . 'pr10 = "'.addslashes($data['pr10']).'",'
                                . 'pr11 = "'.addslashes($data['pr11']).'",'
                                . 'pr12 = "'.addslashes($data['pr12']).'",'
                                . 'pr13 = "'.addslashes($data['pr13']).'"'.'<br>'; */               
                        Yii::app()->db->createCommand('insert into vpo_data set id_report = '.$rep_num.', '
                                . 'id_faculty = "'.addslashes($id_faculty).'",'
                                . 'code_vpo = "'.addslashes($data['code_vpo']).'",'
                                . 'profil = "'.addslashes($data['profil']).'",'
                                . 'id_forma = "'.addslashes($data['id_forma']).'",'
                                . 'srok = "'.addslashes($data['srok']).'",'
                                . 'isp = "'.addslashes($data['isp']).'",'
                                . 'budget = "'.addslashes($data['budget']).'",'
                                . 'war = "'.addslashes($data['war']).'",'
                                . 'zdorov = "'.addslashes($data['zdorov']).'",'
                                . 'link = "'.addslashes($data['link']).'",'
                                . 'stoim = "'.addslashes($data['stoim']).'",'
                                . 'bud = "'.addslashes($data['bud']).'",'
                                . 'vbud = "'.addslashes($data['vbud']).'",'
                                . 'pr1 = "'.addslashes($data['pr1']).'",'
                                . 'pr2 = "'.addslashes($data['pr2']).'",'
                                . 'pr3 = "'.addslashes($data['pr3']).'",'
                                . 'pr4 = "'.addslashes($data['pr4']).'",'
                                . 'pr5 = "'.addslashes($data['pr5']).'",'
                                . 'pr6 = "'.addslashes($data['pr6']).'",'
                                . 'pr7 = "'.addslashes($data['pr7']).'",'
                                . 'pr8 = "'.addslashes($data['pr8']).'",'
                                . 'pr9 = "'.addslashes($data['pr9']).'",'
                                . 'pr10 = "'.addslashes($data['pr10']).'",'
                                . 'pr11 = "'.addslashes($data['pr11']).'",'
                                . 'pr12 = "'.addslashes($data['pr12']).'",'
                                . 'pr13 = "'.addslashes($data['pr13']).'"')->execute();                      
                    }
                }
            }
            $this->render('test');            
      }      
      
      public function actionExcel() {
         $phpExcelPath = '/var/www/mon.cposo.ru/protected/vendors/phpexcel';
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
        $aSheet->setTitle('Первый лист');
        //устанавливаем данные
        //номера по порядку
        $aSheet->setCellValue('A1','№');
        $aSheet->setCellValue('A2','1');
        $aSheet->setCellValue('A3','2');
        $aSheet->setCellValue('A4','3');
        $aSheet->setCellValue('A5','4');
        //названия сайтов
        $aSheet->setCellValue('B1','Названия');
        $aSheet->setCellValue('B2','http://www.web-junior.net');
        $aSheet->setCellValue('B3','http://www.google.com');
        $aSheet->setCellValue('B4','http://www.yandex.ru');
        $aSheet->setCellValue('B5','http://www.twitter.com');
        //мой личный рейтинг
        $aSheet->setCellValue('C1','Рейтинг');
        $aSheet->setCellValue('C2','100');
        $aSheet->setCellValue('C3','99');
        $aSheet->setCellValue('C4','90');
        $aSheet->setCellValue('C5','85');
        //устанавливаем ширину
        $aSheet->getColumnDimension('B')->setWidth(25);
        //отдаем пользователю в браузер
        include($phpExcelPath . DIRECTORY_SEPARATOR.'PHPExcel/Writer/Excel5.php');
        $objWriter = new PHPExcel_Writer_Excel5($pExcel);
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="rate.xls"');
        header('Cache-Control: max-age=0');
        $objWriter->save('php://output');
        spl_autoload_register(array('YiiBase','autoload'));
      }
        public function actionTree()
        {
                if (Yii::app()->session['type_adm'] > 0) {
                    $this->render('tree');

                }
                else {
                    $this->redirect('index.php?r=site/cabinet&id='.Yii::app()->session['est']);
                }
        }

        public function actionAjaxFillTree()
        {
            // если пробуют получить прямой доступ к экшину (не через ajax)
            // тогда обрубаем "крылья")) т.е. возвращаем белую страницу

            if (!Yii::app()->request->isAjaxRequest) {
                exit();
            }

            // с какого узла начинаем вывод дерева? 0 - с первого
            if (isset($_GET['root']) && $_GET['root'] != 'source') {
                // переменная $_GET['root'] говорит нам о том, по какому узлу в дереве
                // кликнули. Исходя из этого получаем данные детей (подкатегорий)
                $parentId = (int) $_GET['root'];
                $req = Yii::app()->db->createCommand(
                "SELECT m1.id_est as id, m1.est_name AS text, m1.type_adm as type_adm, m2.id_est IS NOT NULL AS hasChildren, m1.cab_status AS cab"
                ." FROM est AS m1 LEFT JOIN est AS m2 ON m1.id_est=m2.pid_est"
                ." WHERE m1.pid_est <=> $parentId and m1.status != 0"
                ." GROUP BY m1.id_est ORDER BY m1.est_name ASC"
                );
            }
            else {
                $parentId = Yii::app()->session['est'];
                $req = Yii::app()->db->createCommand(
                "SELECT m1.id_est as id, m1.est_name AS text, m1.type_adm as type_adm, m2.id_est IS NOT NULL AS hasChildren, m1.cab_status AS cab"
                ." FROM est AS m1 LEFT JOIN est AS m2 ON m1.id_est=m2.pid_est"
                ." WHERE m1.id_est <=> $parentId"
                ." GROUP BY m1.id_est ORDER BY m1.est_name ASC"
                );
            }
            // сам запрос на получение данных детей (через обычный LEFT JOIN)
            $children = $req->queryAll();
            for($n = 0; $n < sizeof($children); $n++) {
                if($children[$n]['cab'] != 0) {
                    if (Yii::app()->session['type_adm'] == 4) {
                        if(!$children[$n]['type_adm']) $children[$n]['text'] = '<div class="stroka"><span id="s_'.$children[$n]['id'].'">'.$children[$n]['text'].'</span><a href="index.php?r=site/cabinet&id='.$children[$n]['id'].'" style="float:right"><img src="./images/blog.png" /></a>'.CHtml::link('<img src="./images/blueprint.png" />', 'javascript:edit('.$children[$n]['id'].')', array('class'=>'edit_tree', 'style'=>'float:right;')).'</div>';
                        else $children[$n]['text'] = '<div class="stroka">'.$children[$n]['text'].'<a href="index.php?r=site/cabinet&id='.$children[$n]['id'].'" style="float:right"><img src="./images/blog.png" /></a></div>';
                    }
                    else {
                        if (Yii::app()->params['edit_est']) {
                            if(!$children[$n]['type_adm']) $children[$n]['text'] = '<div class="stroka"><span id="s_'.$children[$n]['id'].'">'.$children[$n]['text'].'</span><a href="index.php?r=site/cabinet&id='.$children[$n]['id'].'" style="float:right"><img src="./images/blog.png" /></a>'.CHtml::link('<img src="./images/blueprint.png" />', 'javascript:edit('.$children[$n]['id'].')', array('class'=>'edit_tree', 'style'=>'float:right;')).'</div>';
                            else $children[$n]['text'] = '<div class="stroka">'.$children[$n]['text'].'<a href="index.php?r=site/cabinet&id='.$children[$n]['id'].'" style="float:right"><img src="./images/blog.png" /></a></div>';
                        }
                        else $children[$n]['text'] = '<div class="stroka">'.$children[$n]['text'].'<a href="index.php?r=site/cabinet&id='.$children[$n]['id'].'" style="float:right"><img src="./images/blog.png" /></a></div>';
                    }
                }
                else $children[$n]['text'] = '<div class="stroka">'.$children[$n]['text'].'</div>';
            }
            // возвращаем данные
            echo str_replace(
                '"hasChildren":"0"',
                '"hasChildren":false',
                CTreeView::saveDataAsJson($children)
            );
            exit();
        }

        public function actionFill_est() {
            if (!Yii::app()->request->isAjaxRequest) {
                exit();
            }
            if(isset($_POST['data'])) {
                $id = (int) $_POST['data'];
                $command = Yii::app()->db->createCommand('select est_name from est where id_est='.$id);
                $reader_est = $command->queryScalar();
                echo $reader_est;
             }

        }
        public function actionEst_check() {
            if (!Yii::app()->request->isAjaxRequest) {
                exit();
            }
            if(isset($_POST['id']) && isset($_POST['name'])) {
                $id = (int) $_POST['id'];
                $est_name = $_POST['name'];
                if(in_array($id, Yii::app()->session['pid'])) {
                    if(preg_match('/^[а-яА-Я0-9№,\.\-\s\"]+$/u', $est_name)) {
                        $command = Yii::app()->db->createCommand('update est set est_name ="'.$est_name.'" where id_est='.$id);
                        $reader_est = $command->execute();                    
                        echo true;
                    }
                    else echo false;
                }
                else echo false;
             }

        }
        
        public function actionGrid() {
            $this->render('grid');
        }

        public function actionDobavka_del() {
            /*$id_rep_type = 20;
            $status = 0;
            $table = 'contact_info';
            $id_type = 2;
            $command = Yii::app()->db->createCommand('
                select report.id_report
                from est, report
                where report.id_rep_type = '.$id_rep_type.'
                    and est.status = '.$status.'
                    and est.id_est = report.id_est
                    and est.id_type = '.$id_type
                    );
            $reports = $command->queryColumn();
            foreach ($reports as $report) {
                //echo $report.'<br/>';
                $command = Yii::app()->db->createCommand('delete from report where id_report = '.$report);
                $reader = $command->execute();
                $command = Yii::app()->db->createCommand('delete from '.$table.' where id_report = '.$report);
                $reader = $command->execute();
            }
            $this->render('test');*/
        }
        public function actionDobavka() {
            /*$id_rep_type = 23;
            $status = 0;
            $table = 'osn_udod';
            $id_type = 3;
            $command = Yii::app()->db->createCommand('select max(id_report) from report');
            $max_report = $command->queryScalar();
            //echo $max_report.'<br>';
            $command = Yii::app()->db->createCommand('select id_est from est where status = 1 and id_est >999 and id_type ='.$id_type);
            $id_est = $command->queryColumn();
            foreach ($id_est as $id) {
                $command = Yii::app()->db->createCommand('select id_report from report
                    where id_rep_type='.$id_rep_type.'
                        and id_est = '.$id);
                if(!$command->queryScalar()) {
                    $max_report = $max_report + 1;
                    $command = Yii::app()->db->createCommand('insert into report set id_report = '.$max_report.', id_rep_type = '.$id_rep_type.', id_est = '.$id.', status = 1');
                    $command->execute();
                    $command = Yii::app()->db->createCommand('insert into '.$table.' set id_report = '.$max_report);
                    $command->execute();
                    echo $id.'-'.$max_report.' выполнено<br />';
                }
                else continue;
            }*/
        }
        
        public function actionGen() {
            $command = Yii::app()->db->createCommand('select * from gen where compl is null');
            $reports = $command->queryAll();
            $year = date('Y');
            $month = date('m');
            foreach($reports as $report) {
                switch($report['type']) {
                    case 1:     //разовый                   
                        $report['s_date'] = date('Y-m-d', strtotime($report['chislo'].'.'.$report['mes'].'.'.$report['god']));
                        break;
                    case 2:     //еженедельный
                        $s_date = new DateTime(date('Y-m-d', strtotime(date('Y').'W'.date('W').'7'))); //определяем прошедшее воскресенье
                        date_add($s_date, date_interval_create_from_date_string($report['chislo'].' days'));
                        $report['s_date'] = $s_date->format('Y-m-d');
                        break;
                    case 3:     //ежемесячный
                        $report['s_date'] = date('Y-m-d', strtotime($report['chislo'].'.'.$month.'.'.$year));
                        break;
                    case 4:     //квартальный
                        $kv_mes = floor($month/3)*3 + $report['mes'];
                        $report['s_date'] = date('Y-m-d', strtotime($report['chislo'].'.'.$kv_mes.'.'.$year));
                        break;
                    case 5:     //полугодовой
                        if($month > 5) $report['s_date'] = date('Y-m-d', strtotime($report['chislo'].'.'.($report['mes'] + 6).'.'.$year)); //второе полугодие
                        else $report['s_date'] = date('Y-m-d', strtotime($report['chislo'].'.'.$report['mes'].'.'.$year));
                        break;
                    case 6:     //годовой
                        $report['s_date'] = date('Y-m-d', strtotime($report['chislo'].'.'.$report['mes'].'.'.$year));
                        break;
                }
                if(date('Y-m-d', time()) != $report['s_date']) continue;

                $command = Yii::app()->db->createCommand('select max(id_rep_type) from rep_name');
                $id_rep_type = $command->queryScalar() + 1; 
                
                $f_date = new DateTime($report['s_date']);
                date_add($f_date, date_interval_create_from_date_string($report['prodol'].' days'));
                $report['f_date'] = $f_date->format('Y-m-d');
                
                $zakr = new DateTime($report['s_date']);
                date_add($zakr, date_interval_create_from_date_string($report['zakr'].' days'));
                $report['z_date'] = $zakr->format('Y-m-d');
                
                
                //$command = Yii::app()->db->createCommand('insert into rep_name set id_rep_type = '.$id_rep_type.', rep_name = "'.$report['rep_name'].'", rep_mv = "'.$report['rep_mv'].'", s_date = "'.$report['s_date'].'", f_date = "'.$report['f_date'].'", date_type = '.$report['date_type'].', rep_type = '.$report['rep_type'].', zakr = '.$report['z_date']);
                //$command->execute();
                
                $types = explode('##', $report['id_type']);    
                $okrs = Yii::app()->db->createCommand('select id_est from est where type_adm = 3 and status = 1')->queryColumn();                
                foreach($types as $type)  {
                //for($m = 2; $m < 15; $m++) {
                    foreach($okrs as $m) {
                        $status = $report['status'];
                        $table = $report['rep_mv'];
                        $id_type = $type;
                        $command = Yii::app()->db->createCommand('select id_est from est where id_okr = '.$m.' and type_adm = 0 and status = 1 and id_type = '.$id_type);
                        $reader_est = $command->queryColumn();
                        $command = Yii::app()->db->createCommand('select max(id_report) from report');
                        $id_report = $command->queryScalar();
                        /*for ($i = 0; $i < sizeof($reader_est); $i++) {
                            $id_report = $id_report + 1;
                            $command = Yii::app()->db->createCommand('insert into report set id_report = '.$id_report.', id_rep_type = '.$id_rep_type.', id_est = '.$reader_est[$i].', status = '.$status);
                            $command->execute();
                            $command = Yii::app()->db->createCommand('insert into '.$table.' set id_report = '.$id_report);
                            $command->execute();
                        }*/
                    }
                }
                //print_r($report);
            }
            //$this->render('gen');
        }
        
        public function actionZakr() {
            $command = Yii::app()->db->createCommand('select id_rep_type from rep_name where zakr="'.date('Y-m-d', time()).'"');
            $reports = $command->queryColumn(); 
            foreach($reports as $report) {
                   $command = Yii::app()->db->createCommand('update rep_name set archive = 1 where id_rep_type = '.$report);
                   $command->execute();
            }
        }
        
        public function actionBbb() {
            $bbb=Yii::app()->bigbluebutton;
            try 
            {
                $url=$bbb->createApiQuery("getMeetings");
                $data=$bbb->getApiResponse($url);
                CVarDumper::dump($data, 10, 1);
            } catch (BigBlueButtonException $ex)
            {
                //remember to properly handle exception if something goes wrong
                throw $ex;
            }            
        }
        
        public function actionEnd_bbb() {
            $bbb=Yii::app()->bigbluebutton;
            try 
            {
                $data = $bbb->endMeeting('1', 'DaSQy8sE');
                CVarDumper::dump($data, 10, 1);
            } catch (BigBlueButtonException $ex)
            {
                //remember to properly handle exception if something goes wrong
                throw $ex;
            }            
        }        
        
        public function actionPass() {


            // Символы, которые будут использоваться в пароле.

            $chars="qazxswedcvfrtbnhymkp123456789QAZXSWEDCVFRTBNHYMKP";

            // Количество символов в пароле.

            $max=6;

            // Определяем количество символов в $chars

            $size=StrLen($chars)-1;

            // Определяем пустую переменную, в которую и будем записывать символы.

            $password=null;

            // Создаём пароль.

                while($max--)
                $password.=$chars[rand(0,$size)];

            // Выводим созданный пароль.

            echo
            "<center>
            Сгенерированный пароль:
            <hr><font face=verdana color=red size=7><b>".$password."</b></font><hr>
            <a href=&#63;>Создать новый пароль.</a></center>";
            
        }
        
        public function actionGeo() {
            $this->render('geo');
        }
        
        public function actionGeocoder() {
            /*$ch = curl_init('http://geocode-maps.yandex.ru/1.x/?geocode=Самара, улица Теннисная, 25 В');           
            $result = curl_exec($ch); // выполняем запрос curl - обращаемся к сервера php.su
            curl_close($ch);
            $xml = new SimpleXMLElement($result);

            foreach ($xml->xpath('//point') as $point) {
                echo $point->pos.PHP_EOL;
            }  */      
            //$data = CJSON::decode($result, true);
            //$data = json_decode($result);
            //print_r($result);
            $params = array(
                'geocode' => 'Самара, улица Теннисная, 25 В', // адрес
                'format'  => 'json',                          // формат ответа
                'results' => 1,                               // количество выводимых результатов
                //'key'     => '...',                           // ваш api key
            );
            $response = json_decode(file_get_contents('http://geocode-maps.yandex.ru/1.x/?' . http_build_query($params, '', '&')));

            if ($response->response->GeoObjectCollection->metaDataProperty->GeocoderResponseMetaData->found > 0)
            {
                echo $response->response->GeoObjectCollection->featureMember[0]->GeoObject->Point->pos;
            }
            else
            {
                echo 'Ничего не найдено';
            }            
        }
        
        public function actionOkr_user() {
            $ests = Yii::app()->db->createCommand('select id_est, est_name from est where type_adm = 3')->queryAll();
            foreach($ests as $est) {
                $users = User::model()->findAll("id_est=:id_est", array(":id_est"=>$est['id_est']));
                foreach ($users as $user) {
                    echo $user->user_id.';'.$user->pass.';'.$user->salt.';'.$user->name.';'.$user->patronymic.';'.$user->surname.';'.$est['est_name'].';'.$est['id_est'].'<br />';
                }
            }            
        }
        
        public function actionUsluga() {
            $filename = 'images/uslugi16.csv';
            if (!file_exists ($filename)) print "File $filename does not exist!";
            else {
                $fh = fopen($filename, "r");
                $m = 1;
                while (!feof($fh)) {                    
                    $line = fgets($fh, 4096);
                    $line = trim($line);
                    $sostav = explode(";", $line);
                    foreach ($sostav as $key => $ss) { 
                        $result[$m][] = $ss;
                    }
                    $m = $m + 1;
                }
                fclose($fh);           
            }
            //print_r($result);
            /*foreach($result as $rs) {
                //$data = Yii::app()->db->createCommand('insert into po_est set id_po_est = "'.$kv.'", id_est = "'.$rs[0].'", cod = "'.$rs[1].'", pravo = "'.$rs[2].'", type = "'.$rs[3].'", type_spo = "'.$rs[4].'"')->execute();
                $sql = 'insert into uslugi2016 '
                . 'set id_pok = "'.$rs[0].'",'
                . ' pok1 = "'.mysql_escape_string($rs[1]).'",'
                . ' pok2 = "'.$rs[2].'",'
                . ' pok3 = "'.$rs[3].'",'
                . ' pok4 = "'.$rs[4].'",'
                . ' pok5 = "'.$rs[5].'",'
                . ' pok6 = "'.mysql_escape_string($rs[6]).'",'
                . ' pok7 = "'.$rs[7].'",'
                . ' pok8 = "'.$rs[8].'",'
                . ' pok9 = "'.$rs[9].'",'
                . ' pok10 = "'.$rs[10].'",'
                . ' type = "'.$rs[11].'",'
                . ' forma = "'.$rs[12].'"';
                $data = Yii::app()->db->createCommand($sql)->execute();
            }*/
            echo 'Ok';            
        }
        
        /*public function actionUsluga3() {
            $forma = array('очная', 'очно-заочная', 'заочная', 'на дому', 'семейного образования', 'в медицинских организациях', 'не определена');
            $type = array('Реализация основных общеобразовательных программ дошкольного образования', 
                'Реализация основных общеобразовательных программ начального общего образования', 
                'Реализация основных общеобразовательных программ основного общего образования', 
                'Реализация основных общеобразовательных программ среднего общего образования', 
                'Реализация дополнительных общеобразовательных общеразвивающих программ', 
                'Реализация основных профессиональных образовательных программ профессионального обучения - программ профессиональной подготовки по профессиям рабочих, должностям служащих', 
                'Реализация основных профессиональных образовательных программ СПО - программ подготовки специалистов среднего звена на базе ООО', 
                'Реализация основных профессиональных образовательных программ среднего профессионального образования - программ подготовки квалифицированных рабочих, служащих на базе основного общего образования', 
                'Реализация основных профессиональных образовательных программ среднего профессионального образования - программ подготовки квалифицированных рабочих, служащих на базе среднего общего образования', 
                'Реализация основных профессиональных образовательных программ среднего профессионального образования - программ подготовки специалистов среднего звена на базе основного общего образования', 
                'Реализация основных профессиональных образовательных программ среднего профессионального образования - программ подготовки специалистов среднего звена на базе среднего общего образования', 
                'Реализация основных профессиональных образовательных программ высшего образования - программ бакалавриата', 
                'Реализация основных профессиональных образовательных программ высшего образования - программ магистратуры', 
                'Реализация основных профессиональных образовательных программ высшего образования - программ подготовки научно-педагогических кадров в аспирантуре (адъюнктуре)', 
                'Реализация дополнительных профессиональных образовательных программ повышения квалификации', 
                'Административное обеспечение деятельности организаций', 
                'Организация и проведение олимпиад, конкурсов, мероприятий, направленных на выявление и развитие у обучающихся интеллектуальных и творческих способностей, способностей к занятиям физической культурой и спортом, интереса к научной (научно-исследовательской)', 
                'Предоставление консультационных и методических услуг', 
                'Присмотр и уход');
            foreach ($type as $k=>$tp) {
                $data = Yii::app()->db->createCommand('insert into uslugi_type set naim_type = "'.$tp.'"')->execute();
            }            
            
        }*/
        
        /*public function actionUsluga2() {
            $forma = array('очная', 'очно-заочная', 'заочная', 'на дому', 'семейного образования', 'в медицинских организациях');
            $type = array('Реализация основных общеобразовательных программ дошкольного образования', 
                'Реализация основных общеобразовательных программ начального общего образования', 
                'Реализация основных общеобразовательных программ основного общего образования', 
                'Реализация основных общеобразовательных программ среднего общего образования', 
                'Реализация дополнительных общеобразовательных общеразвивающих программ', 
                'Реализация основных профессиональных образовательных программ профессионального обучения - программ профессиональной подготовки по профессиям рабочих, должностям служащих', 
                'Реализация основных профессиональных образовательных программ СПО - программ подготовки специалистов среднего звена на базе ООО', 
                'Реализация основных профессиональных образовательных программ среднего профессионального образования - программ подготовки квалифицированных рабочих, служащих на базе основного общего образования', 
                'Реализация основных профессиональных образовательных программ среднего профессионального образования - программ подготовки квалифицированных рабочих, служащих на базе среднего общего образования', 
                'Реализация основных профессиональных образовательных программ среднего профессионального образования - программ подготовки специалистов среднего звена на базе основного общего образования', 
                'Реализация основных профессиональных образовательных программ среднего профессионального образования - программ подготовки специалистов среднего звена на базе среднего общего образования', 
                'Реализация основных профессиональных образовательных программ высшего образования - программ бакалавриата', 
                'Реализация основных профессиональных образовательных программ высшего образования - программ магистратуры', 
                'Реализация основных профессиональных образовательных программ высшего образования - программ подготовки научно-педагогических кадров в аспирантуре (адъюнктуре)', 
                'Реализация дополнительных профессиональных образовательных программ повышения квалификации', 
                'Административное обеспечение деятельности организаций', 
                'Организация и проведение олимпиад, конкурсов, мероприятий, направленных на выявление и развитие у обучающихся интеллектуальных и творческих способностей, способностей к занятиям физической культурой и спортом, интереса к научной (научно-исследовательской)', 
                'Предоставление консультационных и методических услуг', 
                'Присмотр и уход');
            $poks = Yii::app()->db->createCommand('select id_pok, pok1, pok10 from uslugi2015')->queryAll();
            foreach($poks as $pok) {
                $frm = '';
                $tpe = '';
                if($pok['pok10'] == '') $frm = 7;
                else {
                    foreach ($forma as $k=>$fm) {
                        if($fm == $pok['pok10']) $frm = $k+1;
                    }
                }
                foreach ($type as $l=>$tp) {
                    if($tp == $pok['pok1']) $tpe = $l+1;
                }                
                $data = Yii::app()->db->createCommand('update uslugi2015 set type = "'.$tpe.'", forma = "'.$frm.'" where id_pok = '.$pok['id_pok'])->execute();
            }
            //print_r($pok1);
        }*/
        
        
        public function actionSelo() {
            /*$ests = array(1260, 1272, 1269, 1258, 1262, 1266, 1257, 1312, 1264, 1270, 1263, 1308, 1271, 1259, 1306, 1309);
            foreach ($ests as $i => $est) {
                $report = Yii::app()->db->createCommand('select id_report from report where id_rep_type = 115 and id_est = '.$est)->queryScalar();
                $usls = Yii::app()->db->createCommand('select id_usluga from usluga_res where id_report = '.$report)->queryColumn();
                foreach($usls as $usl) {
                    $sql1 = '';
                    $sql1 = 'delete from usluga_res where id_usluga = '.$usl;
                    Yii::app()->db->createCommand($sql1)->execute();
                    //echo $sql1.'<br>';
                }
                $sql2 = '';
                $sql2 = 'delete from report where id_report = '.$report;
                Yii::app()->db->createCommand($sql2)->execute();
                //echo $sql2.'<br>';
            }
            echo 'ok';*/
            //print_r($report);
        }
        
        public function actionIsb() {
            $filename = 'images/ege.csv';
            if (!file_exists ($filename)) print "File $filename does not exist!";
            else {
                $fh = fopen($filename, "r");
                $m = 1;
                while (!feof($fh)) {                    
                    $line = fgets($fh, 4096);
                    $line = trim($line);
                    $sostav = explode(";", $line);
                    foreach ($sostav as $key => $ss) { 
                        $result[$m][] = $ss;
                    }
                    $m = $m + 1;
                }
                fclose($fh);           
            }
            //print_r($result);
            /*echo '<table border = 1>';*/
            foreach($result as $res) {
                /*echo '<tr>';
                $sys = Yii::app()->db->createCommand('select est.est_name from isb, report, est where isb.pok11 = '.$res[0].' and isb.id_report = report.id_report and report.id_est = est.id_est')->queryScalar();
                echo '<td>'.$res[0].'</td>'.'<td>'.$res[1].'</td>'.'<td>'.$sys.'</td>'.'<td>'.$res[2].'</td>';
                echo '</tr>';*/
                $id_report = 0;
                $id_report = Yii::app()->db->createCommand('select id_report from isb where isb.pok11 = '.$res[0])->queryScalar();
                //if($id_report > 0) echo 'update isb set rg1 = "'.$res[1].'", rg2 = "'.$res[2].'", rg3 = "'.$res[3].'", mg1 = "'.$res[4].'", mg2 = "'.$res[5].'", mg3 = "'.$res[6].'" where isb.pok11 = '.$res[0].'<br>';
                //if($id_report > 0) Yii::app()->db->createCommand('update isb set rg1 = "'.$res[1].'", rg2 = "'.$res[2].'", rg3 = "'.$res[3].'", mg1 = "'.$res[4].'", mg2 = "'.$res[5].'", mg3 = "'.$res[6].'" where isb.pok11 = '.$res[0])->execute();
                
                //if($id_report > 0) echo 'update isb set re1 = "'.$res[1].'", re2 = "'.$res[2].'", re3 = "'.$res[3].'", me1 = "'.$res[4].'", me2 = "'.$res[5].'", me3 = "'.$res[6].'" where isb.pok11 = '.$res[0].'<br>';
                //if($id_report > 0) Yii::app()->db->createCommand('update isb set re1 = "'.$res[1].'", re2 = "'.$res[2].'", re3 = "'.$res[3].'", me1 = "'.$res[4].'", me2 = "'.$res[5].'", me3 = "'.$res[6].'" where isb.pok11 = '.$res[0])->execute();
                
            }            
            //echo '</table>';
        }
        
        public function actionNsoko() {
            $reps = Yii::app()->db->createCommand('select * from busgov')->queryAll();
            foreach($reps as $rep) {
                echo $rep['pok1'].'|'.$rep['pok2'].'|'.$rep['pok3'].'|'.$rep['pok4'].'|'.$rep['pok5'].'|'.$rep['pok6'].'|'.$rep['pok7'].'|'.$rep['pok8'].'|'.$rep['pok9'].'<br>';
            }
        }
        
        public function actionEgemath() {
            $filename = 'images/435/rus.csv';
            if (!file_exists ($filename)) print "File $filename does not exist!";
            else {
                $fh = fopen($filename, "r");
                $m = 1;
                while (!feof($fh)) {                    
                    $line = fgets($fh, 4096);
                    $line = trim($line);
                    $sostav = explode("|", $line);
                    foreach ($sostav as $key => $ss) { 
                        $result[$m][] = $ss;
                    }
                    $m = $m + 1;
                }
                fclose($fh);           
            }
            foreach($result as $res) {
                $kr_str = array();
                $ras_str = array();
                $kr = 0;
                $ras = 0;
                $kr_str = str_split($res[15]);
                $ras_str = str_split($res[16]);
                foreach($kr_str as $kr_s) {
                    if($kr_s == '+') $kr = $kr + 1;
                    elseif($kr_s == '-') continue;
                    elseif($kr_s > 0) $kr = $kr + $kr_s;
                }
                $ras = $ras_str[0] + $ras_str[4] + $ras_str[8] + $ras_str[12] + $ras_str[16] + $ras_str[20] + $ras_str[24] + $ras_str[28] + $ras_str[32] + $ras_str[36] + $ras_str[40] + $ras_str[44];
                //$ras = $ras_str[0] + $ras_str[4] + $ras_str[8] + $ras_str[12];
                //echo $kr.'|'.$ras.'<br>';
                //if($ras >= 17  && $kr <= 6) print_r($res);
                if($ras >= 17) print_r($res);
            }
        }
        
        
        public function actionGos_num() {
            $nums = Yii::app()->db->createCommand('select est.id_est, est.est_name from est, report where report.id_est = est.id_est and report.id_rep_type = 166 order by est.id_okr, est.id_raion')->queryAll();
            echo '<table>';
            foreach($nums as $num) {
                echo '<tr>';
                echo '<td>'.$num['id_est'].'</td>';
                echo '<td>'.$num['est_name'].'</td>';
                echo '</tr>';
            }
            echo '</table>';
        }
        
        public function actionSvo_school() {
            $data_p = '2024-01-19';
            $filename = 'protected/res/17-01/school_pol.txt';
            if (!file_exists ($filename)) print "File $filename does not exist!";
            else {
                $fh = fopen($filename, "r");
                $m = 1;
                while (!feof($fh)) {                    
                    $line = fgets($fh, 4096);
                    $line = trim($line);
                    $result[$m] = $line;
                    $m = $m + 1;
                }
                fclose($fh);           
            }
            //print_r($result);
            foreach($result as $rs) {                
                $sql = 'update zpmp_school_2022'
                . ' set pok15 = 2,'
                //. ' pok16 = "'.date('Y-m-d H:i:s', time()).'"'
                . ' pok16 = "'.$data_p.' 11:00:00"'         
                . ' where id_zpmp = "'.$rs.'"';
                //echo $sql.'<br>';
                Yii::app()->db->createCommand($sql)->execute();
            }
            echo 'Ok';            
        }
        
        public function actionSvo_school_neg() {
            $data_p = '2024-01-19';
            $filename = 'protected/res/17-01/school_neg.txt';
            if (!file_exists ($filename)) print "File $filename does not exist!";
            else {
                $fh = fopen($filename, "r");
                $m = 1;
                while (!feof($fh)) {                    
                    $line = fgets($fh, 4096);
                    $line = trim($line);
                    $result[$m] = $line;
                    $m = $m + 1;
                }
                fclose($fh);           
            }
            //print_r($result);
            foreach($result as $rs) {                
                $sql = 'update zpmp_school_2022'
                . ' set pok15 = 1,'
                //. ' pok16 = "'.date('Y-m-d H:i:s', time()).'"'
                . ' pok16 = "'.$data_p.' 11:00:00"'         
                . ' where id_zpmp = "'.$rs.'"';
                //echo $sql.'<br>';
                Yii::app()->db->createCommand($sql)->execute();
            }
            echo 'Ok';            
        }        

        public function actionSvo_sad() {
            $data_p = '2024-01-19';
            $filename = 'protected/res/17-01/sad_pol.txt';
            if (!file_exists ($filename)) print "File $filename does not exist!";
            else {
                $fh = fopen($filename, "r");
                $m = 1;
                while (!feof($fh)) {                    
                    $line = fgets($fh, 4096);
                    $line = trim($line);
                    $result[$m] = $line;
                    $m = $m + 1;
                }
                fclose($fh);           
            }
            //print_r($result);
            foreach($result as $rs) {                
                $sql = 'update zpmp_sad_2022'
                . ' set pok15 = 2,'
                //. ' pok16 = "'.date('Y-m-d H:i:s', time()).'"'
                . ' pok16 = "'.$data_p.' 11:00:00"'                        
                . ' where id_zpmp = "'.$rs.'"';
                //echo $sql.'<br>';
                Yii::app()->db->createCommand($sql)->execute();
            }
            echo 'Ok';            
        }

        public function actionSvo_sad_neg() {
            $data_p = '2024-01-19';
            $filename = 'protected/res/17-01/sad_neg.txt';
            if (!file_exists ($filename)) print "File $filename does not exist!";
            else {
                $fh = fopen($filename, "r");
                $m = 1;
                while (!feof($fh)) {                    
                    $line = fgets($fh, 4096);
                    $line = trim($line);
                    $result[$m] = $line;
                    $m = $m + 1;
                }
                fclose($fh);           
            }
            //print_r($result);
            foreach($result as $rs) {                
                $sql = 'update zpmp_sad_2022'
                . ' set pok15 = 1,'
                //. ' pok16 = "'.date('Y-m-d H:i:s', time()).'"'
                . ' pok16 = "'.$data_p.' 11:00:00"'                        
                . ' where id_zpmp = "'.$rs.'"';
                //echo $sql.'<br>';
                Yii::app()->db->createCommand($sql)->execute();
            }
            echo 'Ok';            
        }            
}