<?php

class AbiController extends Controller
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
        
	public function actionIndex()
        {
            $abi = Abi25_comp::model()->findAll();
            $fv = Abi25_fv_comp::model()->findAll();
            $zp = Abi25_zp_comp::model()->findAll();
            $this->render('index',array('abi'=>$abi, 'fv'=>$fv, 'zp'=>$zp));
        }        
}        

