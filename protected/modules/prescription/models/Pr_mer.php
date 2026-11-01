<?php

/**
 * This is the model class for table "pr_mer".
 *
 * The followings are the available columns in table 'pr_mer':
 * @property string $id_mer
 * @property string $id_pr
 * @property integer $step2
 * @property integer $id_naim
 * @property string $naim
 * @property string $norm
 * @property string $stat
 * @property string $srok
 * @property double $summa
 * @property integer $id_ist
 * @property double $vsumma
 * @property integer $ppf
 * @property string $psrok
 * @property string $fsrok
 * @property string $crt
 * @property string $red
 * @property string $user
 */
class Pr_mer extends CActiveRecord
{
    public $image1;
    public $del_pod;
    const FILE_PATH = '/var/www/cposo/data/www/mon.cposo.ru/protected/pred';    
    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return 'pr_mer';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('id_pr, norm, stat, srok', 'required'),
            array('image1', 'file',
                'allowEmpty'  => true,
                'maxFiles'   => 1,
                'maxSize'   => 5242880,
                'minSize'   => 0,
                'types'   => 'docx, doc, zip, pdf, jpg, gif, png, jpeg',
                'tooLarge'   => 'Вы загружаете файл слишком большого размера',
            ),            
            array('id_ist, ppf, step2, id_naim', 'numerical', 'integerOnly'=>true),
            array('summa, vsumma', 'numerical'),
            array('norm, stat, user', 'length', 'max'=>255),
            array('naim, norm, stat', 'match', 'pattern'=>'/^[а-яА-ЯёЁ0-9,\.\(\)\-\s\"\/\№]*$/u', 'message'=>'В строке "{attribute}" можно использовать только буквы кириллицы, цифры, дефис, точку, скобки, №, дробь и кавычки'),
            array('srok, psrok, fsrok', 'date', 'format' => 'dd.MM.yyyy'),
            array('ppf, del_pod', 'in','range'=>array(0, 1)), 
            array('id_ist', 'in','range'=>range(1, 5)),
            array('naim', 'naim'),
            array('fsrok', 'fsrok'),
            array('image1', 'image1'),
            array('del_pod', 'del_pod'),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('id_mer, id_pr, naim, norm, stat, srok, summa, id_ist, vsumma, ppf, psrok, fsrok, crt, red, user', 'safe', 'on'=>'search'),
        );
    }
    
    public function naim($attribute, $params)
    {            
        if((!$this->step2 || ($this->step2 == 2 && $this->id_naim == 24)|| ($this->step2 == 1 && $this->id_naim == 23)) && !$this->naim) $this->addError('naim', 'Необходимо заполнить название наименование мероприятия');
    }
    
    public function fsrok($attribute, $params)
    {            
        if((!$this->fsrok && (CUploadedFile::getInstance($this, 'image1') != NULL)) || (!$this->fsrok && $this->pod && !$this->del_pod)) $this->addError('fsrok', 'Необходимо указать фактическую дату устаранения нарушения');
    }
    
    public function image1($attribute, $params)
    {            
        if($this->fsrok && (CUploadedFile::getInstance($this, 'image1') == NULL) && !$this->pod) $this->addError('image1', 'Необходимо прикрепить cкан-копию подтверждения выполнения мероприятия');
    }
    
    public function del_pod($attribute, $params)
    {            
        if($this->fsrok && $this->del_pod) $this->addError('fsrok', 'Перед удалением файла сотрите данные в поле фактическая дата устаранения');
    }     
    
    public function relations()
    {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'pr_pred' => array(self::BELONGS_TO, 'Pr_pred', 'id_pr'),
        );
    }    

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return array(
            'id_mer' => 'Id Mer',
            'id_pr' => 'Id Pr',
            'naim' => 'Наименование мероприятия предписания',
            'norm' => 'Нормативный правовой документ, положения которого были нарушены',
            'stat' => 'Пункт/статья нормативного документа',
            'srok' => 'Срок исполнения мероприятия по предписанию',
            'summa' => 'Необходимая сумма для устранения нарушения, руб. (разделитель разрядов точка)',
            'id_ist' => 'Источник финансирования',
            'vsumma' => 'Выделяемая сумма, руб. (разделитель разрядов точка)',
            'ppf' => 'по мере поступления финансирования',
            'psrok' => 'Планируемый срок устаранения',
            'fsrok' => 'Фактическая дата устаранения',
            'image1' => 'Скан-копия подтверждения выполнения мероприятия (Акт выполненных работ, справка директора, иные документы. Допустимый размер файла не более 5 Мбайт. Допустимые форматы файла .pdf, .zip, .jpg, .gif, .png, .jpeg, .docx, .doc)',
            'crt' => 'Crt',
            'red' => 'Red',
            'user' => 'User',
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

        $criteria->compare('id_mer',$this->id_mer,true);
        $criteria->compare('id_pr',$this->id_pr,true);
        $criteria->compare('naim',$this->naim,true);
        $criteria->compare('norm',$this->norm,true);
        $criteria->compare('stat',$this->stat,true);
        $criteria->compare('srok',$this->srok,true);
        $criteria->compare('summa',$this->summa);
        $criteria->compare('id_ist',$this->id_ist);
        $criteria->compare('vsumma',$this->vsumma);
        $criteria->compare('ppf',$this->ppf);
        $criteria->compare('psrok',$this->psrok,true);
        $criteria->compare('fsrok',$this->fsrok,true);
        $criteria->compare('crt',$this->crt,true);
        $criteria->compare('red',$this->red,true);
        $criteria->compare('user',$this->user,true);

        return new CActiveDataProvider($this, array(
            'criteria'=>$criteria,
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return Pr_mer the static model class
     */
    public static function model($className=__CLASS__)
    {
        return parent::model($className);
    }

    protected function beforeSave()
    {
        $file_path = self::FILE_PATH.'/'.date('Y', strtotime($this->crt)).'/'.Pr_pred::model()->findByPk($this->id_pr)->building->id_build;
        if($this->del_pod) {
            if($this->pod) unlink($file_path.'/'.$this->pod);
            $this->pod = '';
            $this->pod_r = '';   
            $this->del_pod = '';
        }
        if ($file = CUploadedFile::getInstance($this, 'image1'))
        {
            if(!file_exists($file_path)) mkdir($file_path, 0700, true);
            $extension = strtolower($file->extensionName);
            if($this->pod) unlink($file_path.'/'.$this->pod);
            $filename = $this->getRandomFileName($file_path, $extension);
            $basename = $filename . '.' . $extension;

            if ($file->saveAs($file_path.'/'.$basename)){
                $this->pod = $basename;
                $this->pod_r = $file->name;                
            }
        }        
        if($this->srok) $this->srok = date('Y-m-d', strtotime($this->srok));
        if($this->psrok) $this->psrok = date('Y-m-d', strtotime($this->psrok)); 
        if($this->fsrok) $this->fsrok = date('Y-m-d', strtotime($this->fsrok));         
        $this->red = date('Y-m-d H:i:s', time());
        $this->user = Yii::app()->session['id'];
        return TRUE;
    }    
    
    protected function afterFind()
    {
        if($this->srok == '0000-00-00' || $this->srok == '') $this->srok ='';
        else $this->srok = date('d.m.Y', strtotime($this->srok)); 
        if($this->psrok == '0000-00-00' || $this->psrok == '') $this->psrok ='';
        else $this->psrok = date('d.m.Y', strtotime($this->psrok));
        if($this->fsrok == '0000-00-00' || $this->fsrok == '') $this->fsrok ='';
        else $this->fsrok = date('d.m.Y', strtotime($this->fsrok));        
        if($this->red == '0000-00-00' || $this->red == '') $this->red ='';
        else $this->red = date('d.m.Y', strtotime($this->red));    
        return TRUE;
    }
    
    protected function beforeDelete()
    {
        if($this->pod) {
            $file_path = self::FILE_PATH.'/'.date('Y', strtotime($this->crt)).'/'.Pr_pred::model()->findByPk($this->id_pr)->building->id_build.'/'.$this->pod;
            if(file_exists($file_path)) unlink($file_path);
        }
        return true;
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
}