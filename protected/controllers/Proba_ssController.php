<?php

class Proba_ssController extends Controller
{
    
        protected $data_p = '2025-01-22';
        protected $vr = '11:00:00';
        protected $path = 'protected/res/27-01-2025';
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
        
        public function actionImport() {
            $this->svo_school();
            $this->svo_school_neg();
            $this->svo_sad();
            $this->svo_sad_neg();
            echo 'Импорт выполнен успешно';
        }        
        
        public function svo_school() {
            $filename = $this->path.'/school_pol.txt';
            $result = $this->read_file($filename);
            foreach($result as $rs) {                
                $sql = 'update zpmp_school_2022'
                . ' set pok15 = 2,'
                //. ' pok16 = "'.date('Y-m-d H:i:s', time()).'"'
                . ' pok16 = "'.$this->data_p.' '.$this->vr.'"'         
                . ' where id_zpmp = "'.$rs.'"';
                //echo $sql.'<br>';
                Yii::app()->db->createCommand($sql)->execute();
            }         
        }
        
        public function svo_school_neg() {
            $filename = $this->path.'/school_neg.txt';
            $result = $this->read_file($filename);
            foreach($result as $rs) {                
                $sql = 'update zpmp_school_2022'
                . ' set pok15 = 1,'
                //. ' pok16 = "'.date('Y-m-d H:i:s', time()).'"'
                . ' pok16 = "'.$this->data_p.' '.$this->vr.'"'         
                . ' where id_zpmp = "'.$rs.'"';
                //echo $sql.'<br>';
                Yii::app()->db->createCommand($sql)->execute();
            }            
        }        

        public function svo_sad() {
            $filename = $this->path.'/sad_pol.txt';
            $result = $this->read_file($filename);
            foreach($result as $rs) {                
                $sql = 'update zpmp_sad_2022'
                . ' set pok15 = 2,'
                //. ' pok16 = "'.date('Y-m-d H:i:s', time()).'"'
                . ' pok16 = "'.$this->data_p.' '.$this->vr.'"'                        
                . ' where id_zpmp = "'.$rs.'"';
                //echo $sql.'<br>';
                Yii::app()->db->createCommand($sql)->execute();
            }            
        }

        public function svo_sad_neg() {
            $filename = $this->path.'/sad_neg.txt';
            $result = $this->read_file($filename);
            foreach($result as $rs) {                
                $sql = 'update zpmp_sad_2022'
                . ' set pok15 = 1,'
                //. ' pok16 = "'.date('Y-m-d H:i:s', time()).'"'
                . ' pok16 = "'.$this->data_p.' '.$this->vr.'"'                        
                . ' where id_zpmp = "'.$rs.'"';
                //echo $sql.'<br>';
                Yii::app()->db->createCommand($sql)->execute();
            }           
        }
        
        protected function read_file($filename) {
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
            return $result;
        }

}        