<?php

/**
 * This is the model class for table "pr_pred".
 *
 * The followings are the available columns in table 'pr_pred':
 * @property string $id_pr
 * @property string $id_build
 * @property string $id_type
 * @property string $organ
 * @property string $doc_type
 * @property string $doc_date
 * @property string $doc_num
 * @property string $isp
 * @property string $isp_naim
 * @property string $compl
 * @property string $pred_r
 * @property string $pred
 * @property string $crt
 * @property string $red
 * @property string $user
 */
class Pr_pred extends CActiveRecord
{
    public $image1;
    public $del_pred;
    const FILE_PATH = '/var/www/cposo/data/www/mon.cposo.ru/protected/pred';
    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return 'pr_pred';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('id_build, id_type, organ, doc_type, doc_date, doc_num, isp', 'required'),
            array('image1', 'file',
                'allowEmpty'  => true,
                'maxFiles'   => 1,
                'maxSize'   => 10485760,
                'minSize'   => 0,
                'types'   => 'docx, doc, zip, pdf, jpg, gif, png, jpeg',
                'tooLarge'   => 'Вы загружаете файл слишком большого размера',
            ),
            array('del_pred', 'in','range'=>array(0, 1)),            
            array('id_type', 'in','range'=>range(1, 8)),
            array('doc_type', 'in','range'=>range(1, 4)),
            array('organ, isp_naim', 'match', 'pattern'=>'/^[а-яА-Я0-9\-\s]*$/u', 'message'=>'В строке "{attribute}" можно использовать только буквы кириллицы, цифры и тире'),
            array('doc_date', 'date', 'format' => 'dd.MM.yyyy'),
            array('doc_num', 'match', 'pattern'=>'/^[а-яА-ЯёЁ0-9,\.\(\)\-\s\"\/]*$/u', 'message'=>'В строке "{attribute}" можно использовать только буквы кириллицы, цифры, дефис, точку, скобки, дробь и кавычки'),
            array('isp', 'in','range'=>array(1, 2)),
            array('isp', 'isp'),
            array('isp_naim', 'length', 'max'=>512),
            array('organ, doc_num, pred_r, pred', 'length', 'max'=>255),
            array('id_type', 'pr_type'),
            array('compl, crt, red, user', 'safe'),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('id_pr, id_build, id_type, organ, doc_type, doc_date, doc_num', 'safe', 'on'=>'search'),
        );
    }
    
    public function pr_type($attribute, $params) {
        if(!$this->isNewRecord) {
            $mers = Yii::app()->db->createCommand('select count(id_mer) from pr_mer where id_pr = '.$this->id_pr)->queryScalar();
            if($mers) {
                $step2 = Yii::app()->db->createCommand('select distinct step2 from pr_mer where id_pr = "'.$this->id_pr.'" group by step2')->queryScalar();
                if($step2) {
                    $id_type_step2 = Yii::app()->db->createCommand('select id_type from pr_type where step2 = '.$step2)->queryScalar();
                    if($this->id_type != $id_type_step2) $this->addError('id_type', 'Перед изменением типа предписания удалите мероприятия для других типов предписаний');
                }
            }
        }
    }
    
    public function isp ($attribute,$params)
    {            
        if(($this->isp == 2) && ($this->isp_naim == '')) $this->addError('isp_naim', 'Необходимо заполнить наименование исполнителя');
    }    

    /**
     * @return array relational rules.
     */
    public function relations()
    {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'building' => array(self::BELONGS_TO, 'Building_pr', 'id_build'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return array(
            'id_pr' => 'Id Pr',
            'id_build' => 'Id Build',
            'id_type' => 'Тип предписания',
            'organ' => 'Орган, проводивший провеку',
            'doc_type' => 'Тип документа по результатам проверки',
            'doc_date' => 'Дата документа по результатам проверки',
            'doc_num' => 'Номер документа по результатам проверки',
            'isp' => 'Исполнитель по предписанию',
            'isp_naim' => 'Наименование исполнителя',
            'image1' => 'Скан-копия предписания (допустимый размер файла не более 10 Мбайт. Допустимые форматы файла .pdf, .zip, .jpg, .gif, .png, .jpeg, .docx, .doc)',
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
    public function search()
    {
        // @todo Please modify the following code to remove attributes that should not be searched.

        $criteria=new CDbCriteria;

        $criteria->compare('id_pr',$this->id_pr,true);
        $criteria->compare('id_build',$this->id_build,true);
        $criteria->compare('id_type',$this->id_type,true);
        $criteria->compare('organ',$this->organ,true);
        $criteria->compare('doc_type',$this->doc_type,true);
        $criteria->compare('doc_date',$this->doc_date,true);
        $criteria->compare('doc_num',$this->doc_num,true);

        return new CActiveDataProvider($this, array(
            'criteria'=>$criteria,
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return Pr_pred the static model class
     */
    public static function model($className=__CLASS__)
    {
        return parent::model($className);
    }
    
    protected function beforeSave()
    {
        $file_path = self::FILE_PATH.'/'.date('Y', strtotime($this->crt)).'/'.$this->id_build;
        if($this->del_pred) {
            if($this->pred) unlink($file_path.'/'.$this->pred);
            $this->pred = '';
            $this->pred_r = '';   
            $this->del_pred = '';
        }
        if ($file = CUploadedFile::getInstance($this, 'image1'))
        {
            if(!file_exists($file_path)) mkdir($file_path, 0700, true);
            $extension = strtolower($file->extensionName);
            if($this->pred) unlink($file_path.'/'.$this->pred);
            $filename = $this->getRandomFileName($file_path, $extension);
            $basename = $filename . '.' . $extension;

            if ($file->saveAs($file_path.'/'.$basename)){
                $this->pred = $basename;
                $this->pred_r = $file->name;                
            }
        }
        $this->doc_date = date('Y-m-d', strtotime($this->doc_date));        
        $this->red = date('Y-m-d H:i:s', time());
        $this->user = Yii::app()->session['id'];
        return TRUE;
    }
    
    protected function beforeDelete()
    {
        //Yii::app()->db->createCommand('delete from pr_mer where id_pr = '.$this->id_pr)->execute();
        if($this->pred) {
            $file_path = self::FILE_PATH.'/'.date('Y', strtotime($this->crt)).'/'.$this->id_build.'/'.$this->pred;
            if(file_exists($file_path)) unlink($file_path);
        }
        return true;
    }    

    protected function afterFind()
    {
        if($this->doc_date == '0000-00-00' || $this->doc_date == '') $this->doc_date ='';
        else $this->doc_date = date('d.m.Y', strtotime($this->doc_date));         
        if($this->red == '0000-00-00' || $this->red == '') $this->red ='';
        else $this->red = date('d.m.Y', strtotime($this->red));    
        return TRUE;
    }
    
    public function getRandomFileName($path, $extension='')
    {
        $extension = $extension ? '.' . $extension : '';
        $path = $path ? $path . '/' : '';
 
        do {
            $name = md5(microtime() . rand(0, 9999));
            $file = $path . $name . $extension;
        } while (file_exists($file));
 
        return $name;
    }

    public function check_status() {
        $fsrok = Yii::app()->db->createCommand('select count(id_mer) from pr_mer where (fsrok = "0000-00-00" or fsrok is null) and id_pr = '.$this->id_pr)->queryScalar();
        if($fsrok) {
            if($this->compl == 2) {
                $this->compl = 1;
                $this->save();
            }
        }
        else {
            if($this->compl == 1) {
                $this->compl = 2;
                $this->save();
            }
        }
    }
    
    public function mer_count() {
        $mer = Yii::app()->db->createCommand('select count(id_mer) from pr_mer where id_pr = '.$this->id_pr)->queryScalar();
        return $mer;
    } 
    
    public function get_isp() {
        return array(1 => 'Образовательная организация', 2 => 'Орган местного самоуправления');
    }

    public function get_isp_r() {
        $isp = $this->get_isp();
        return $isp[$this->isp];
    }    
}