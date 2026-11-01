<?php

/**
 * This is the model class for table "ws25_obsh".
 *
 * The followings are the available columns in table 'ws25_obsh':
 * @property string $id_report
 * @property string $pok1
 * @property string $pok2
 * @property string $pok3
 * @property string $pok4
 * @property string $pok5
 * @property string $pok6
 * @property string $pok6_r
 * @property string $pok7
 * @property string $pok7_r
 * @property string $pok8
 * @property string $pok8_r
 * @property string $pok9
 * @property string $red
 * @property string $r_date
 */
class Ws25_obsh extends CActiveRecord
{
    public $file6;
    public $file7;
    public $file8;
    
    public $id_type;
    public $id_okr;
    public $est_name;
    
    /*public $org_name;
    public $id_est;
    public $id_comp;
    public $id_raion;*/
    
    const FILE_PATH = '/var/www/cposo/data/www/mon.cposo.ru/protected/spz/ws';
    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return 'ws25_obsh';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('pok1, pok2, pok3, pok4, pok5, pok9', 'required'),
            array('id_report', 'length', 'max'=>10),
            array('pok1, pok2, pok3', 'length', 'max'=>255),
            //array('pok1, pok2, pok3', 'match', 'pattern'=>'/^[а-яА-ЯёЁ0-9\-\s]*$/u', 'message'=>'В строке "{attribute}" можно использовать только буквы кириллицы и тире'),
            array('pok1, pok2, pok3', 'match', 'pattern'=>'/^[А-ЯЁ][а-яё\-]+$/u', 'message'=>'В строке "{attribute}" можно использовать только буквы кириллицы и дефис. Первый символ должен быть заглавной буквой, остальные строчными'),
            array('pok4', 'length', 'is'=>3),
            array('pok5', 'length', 'is'=>7),
            array('pok4, pok5', 'match', 'pattern'=>'/^[0-9]*$/u', 'message'=>'В строке "{attribute}" можно использовать только цифры'),
            array('pok9, est_name', 'match', 'pattern'=>'/^[а-яА-ЯёЁa-zA-Z0-9№,\.\:\?\!\(\)\-\—\–\r\n\s\+\&\/\«\»\"\"]*$/u', 'message'=>'В строке "{attribute}" можно использовать только буквы кириллицы, латиницы, цифры, тире, дефис, точку, запятую, восклицательный знак, +, &, /, знак номера, кавычки вида ", «, » и скобки'),
            array('file6, file8', 'file',
                'allowEmpty'  => true,
                'maxFiles'   => 1,
                'maxSize'   => 5242880,
                'minSize'   => 0,
                'types'   => 'zip, pdf, jpg, gif, png, jpeg',
                'tooLarge'   => 'Вы загружаете файл слишком большого размера',
            ),
            array('file7', 'file',
                'allowEmpty'  => true,
                'maxFiles'   => 1,
                'maxSize'   => 5242880,
                'minSize'   => 0,
                'types'   => 'zip, pdf',
                'tooLarge'   => 'Вы загружаете файл слишком большого размера',
            ),
            array('file6', 'file6_val'),
            array('file7', 'file7_val'),
            array('file8', 'file8_val'),
            array('id_comp', 'InTableValidator', 
                'table' => 'ws25_compet',
                'valueColumn' => 'id',
                'message' => 'Указанного приемной кампании не существует',
            ),             
            /*array('id_est', 'InTableValidator', 
                'table' => 'est',
                'valueColumn' => 'id_est',
                'message' => 'Указанного гражданства не существует',
            ), 
            array('id_comp', 'InTableValidator', 
                'table' => 'ws25_comp',
                'valueColumn' => 'id_comp',
                'message' => 'Указанного значения не существует',
            ),*/
            array('id_okr', 'InTableValidator', 
                'table' => 'est',
                'valueColumn' => 'id_okr',
                'message' => 'Указанного значения не существует',
            ),
            array('id_type', 'in','range'=>range(1, 9)),            
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('id_report, pok1, pok2, pok3, pok4, pok5, pok6, pok6_r, pok7, pok7_r, pok8, pok8_r, red, r_date', 'safe', 'on'=>'search'),
        );
    }
    
    public function file6_val ($attribute,$params)
    {            
        if(!CUploadedFile::getInstance($this, 'file6')->size && !$this->pok6) $this->addError('file6', 'Необходимо загрузить файл заявки');
    }

    public function file7_val ($attribute,$params)
    {            
        if(!CUploadedFile::getInstance($this, 'file7')->size && !$this->pok7) $this->addError('file7', 'Необходимо загрузить файл протоколов отборочных соревнований');
    }
    
    public function file8_val ($attribute,$params)
    {            
        if(!CUploadedFile::getInstance($this, 'file8')->size && !$this->pok8) $this->addError('file8', 'Необходимо загрузить файл письма о потребности в проживании');
    }    

    /**
     * @return array relational rules.
     */
    public function relations()
    {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'report'=>array(self::HAS_ONE, 'Report', 'id_report'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return array(
            'id_report' => 'Id Report',
            'pok1' => 'Фамилия',
            'pok2' => 'Имя',
            'pok3' => 'Отчество',
            'pok4' => 'Код',
            'pok5' => 'Мобильный телефон',
            'pok6' => 'Заявка',
            'pok6_r' => 'Pok6 R',
            'pok7' => 'Протоколы отборочных соревнований',
            'pok7_r' => 'Pok7 R',
            'pok8' => 'Письмо – подтверждение потребности/отсутствия потребности в проживании',
            'pok8_r' => 'Pok8 R',
            'pok9' => 'Должность',
            'red' => 'Кто редактировал',
            'r_date' => 'Время последнего реадктирования',
            'file6' => 'Заявка',
            'file7' => 'Протоколы отборочных соревнований',
            'file8' => 'Письмо – подтверждение потребности/отсутствия потребности в проживании',
            'id_raion' => 'Муниципалитет',
            'id_type' => 'Тип организации',
            'id_okr' => 'ТУ/ДО',
            'est_name' => 'Название организации',            
        );
    }

    /**
     * Retrieves a list of models based on the current search/filter conditions.
     *
     * Typical usecase:
     * - Initialize the model fields with values from filter form.
     * - Execute this method to get CActiveDataProvider instance which will filter
     * models according to data in model fields.
     * - Pass data provider to CGridView, CListView or any similar widget.
     *
     * @return CActiveDataProvider the data provider that can return the models
     * based on the search/filter conditions.
     */
    public function search($id_comp = null)
    {
        // @todo Please modify the following code to remove attributes that should not be searched.

        $criteria=new CDbCriteria;
        
        //if(!$id_comp) $criteria->condition = 'id_comp = '.$id_comp;
        if (!empty($id_comp)) {
            $criteria->addCondition('id_comp = :id_comp');
            $criteria->params[':id_comp'] = $id_comp;
        }      

        $criteria->addCondition("pok1 != ''");
        
        /*if($this->id_est) {
            $comp = Ws25_comp::model()->findByPk($this->id_comp);
            $query = self::find()
                ->joinWith(['report']) // Подключаем связи с report и через report с est
                ->where(['est.id_est' => $this->id_est, 'id_rep_type' => $comp->id_rep_type]); // Условие для est.id_est = 1            
        }*/
        /*if($this->id_est && $this->id_comp) {
            $comp = Ws25_comp::model()->findByPk($this->id_comp);

            // Для Yii1 используем with() для жадной загрузки связей
            $criteria->with = array(
                'report' => array(
                    /*'with' => array(
                        'est' => array(
                            'condition' => 'est.id_est = :id_est',
                            'params' => array(':id_est' => $this->id_est),
                        )
                    ),*/
                    /*'condition' => 'id_rep_type = :id_rep_type and id_est = :id_est',
                    'params' => array(':id_rep_type' => $comp->id_rep_type, ':id_est' => $this->id_est),
                )
            );
        }

        if($this->id_raion && $this->id_comp) {
            $comp = Ws25_comp::model()->findByPk($this->id_comp);

            // Для Yii1 используем with() для жадной загрузки связей
            $criteria->with = array(
                'report' => array(
                    'with' => array(
                        'est' => array(
                            'condition' => 'est.id_raion = :id_raion',
                            'params' => array(':id_raion' => $this->id_raion),
                        )
                    ),
                    'condition' => 'id_rep_type = :id_rep_type',
                    'params' => array(':id_rep_type' => $comp->id_rep_type),
                )
            );
        } */ 
        
        // Добавляем join с таблицей report
        $criteria->with = array(
            'report' => array(
                'with' => array(
                    'est' // связь из модели Report с моделью Est
                )
            )
        );

        // Фильтрация по id_type
        if (!empty($this->id_type)) {
            $criteria->compare('est.id_type', $this->id_type);
        }

        // Фильтрация по id_okr
        if (!empty($this->id_okr)) {
            $criteria->compare('est.id_okr', $this->id_okr);
        }
        
        // Фильтрация по est_name
        if (!empty($this->est_name)) {
            $criteria->compare('est.est_name', $this->est_name, true);
        }        
        
        $criteria->compare('pok1',$this->pok1,true);

        return new CActiveDataProvider($this, array(
            'criteria'=>$criteria,
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return Ws25_obsh the static model class
     */
    public static function model($className=__CLASS__)
    {
        return parent::model($className);
    }
    
    protected function beforeSave()
    { 
        $this->r_date = date('Y-m-d H:i:s',time());
        $this->red = Yii::app()->session['id'];
        
        //if(CUploadedFile::getInstance($this, 'file6')->size) $this->pok6_vr = date('Y-m-d H:i:s',time());
        //if(CUploadedFile::getInstance($this, 'file7')->size) $this->pok7_vr = date('Y-m-d H:i:s',time());
        //if(CUploadedFile::getInstance($this, 'file8')->size) $this->pok8_vr = date('Y-m-d H:i:s',time());
        
        $file_path = self::FILE_PATH.'/'.Report::model()->findByPk($this->id_report)->id_rep_type.'/'.$this->id_report;
        
        for($i = 6; $i <= 8; $i++) {
            
            $pok = 'pok'.$i;
            $pokr = 'pok'.$i.'_r'; 

            if ($file = CUploadedFile::getInstance($this, 'file'.$i))
            {               
                if(!file_exists($file_path)) mkdir($file_path, 0700, true);
                $extension = strtolower($file->extensionName);
                if($this->$pokr) unlink($file_path.'/'.$this->$pok);
                if ($file->saveAs($file_path.'/'.strtolower($pok.'.'.$extension))) {
                    $this->$pok = strtolower($pok.'.'.$extension);
                    $this->$pokr= $file->name;
                }    
            } 
        }

        return TRUE;        
    }

    protected function afterFind()
    { 
        if($this->r_date == '0000-00-00 00:00:00' || $this->r_date == '') $this->r_date='';
        else $this->r_date=date('d.m.Y H:i:s', strtotime($this->r_date));
        if($this->pok6_vr == '0000-00-00 00:00:00' || $this->pok6_vr == '') $this->pok6_vr='';
        else $this->pok6_vr=date('d.m.Y H:i:s', strtotime($this->pok6_vr));
        if($this->pok7_vr == '0000-00-00 00:00:00' || $this->pok7_vr == '') $this->pok7_vr='';
        else $this->pok7_vr=date('d.m.Y H:i:s', strtotime($this->pok7_vr));  
        if($this->pok8_vr == '0000-00-00 00:00:00' || $this->pok8_vr == '') $this->pok8_vr='';
        else $this->pok8_vr=date('d.m.Y H:i:s', strtotime($this->pok8_vr));          
        return TRUE;
    }

    public function get_part() {
        return Yii::app()->db->createCommand('SELECT count(*) FROM `ws25_part` WHERE id_report = '.$this->id_report)->queryScalar(); 
    }
    
    public function get_conc() {
        return Yii::app()->db->createCommand('SELECT count(*) FROM `ws25_part` WHERE id_stat = 1 and id_report = '.$this->id_report)->queryScalar(); 
    }    
}