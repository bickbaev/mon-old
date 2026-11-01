<?php

/**
 * This is the model class for table "building2018_potr".
 *
 * The followings are the available columns in table 'building2018_potr':
 * @property string $id_potr
 * @property string $id_report
 * @property string $id_building
 * @property string $datar
 * @property string $num
 * @property integer $id_inic
 * @property string $techz
 * @property string $zakl
 * @property string $psd
 * @property integer $price
 * @property integer $id_status
 */
class Building2018_potr extends CActiveRecord
{
    
    public $file1d;
    public $file2d;
    public $file3d;
    public $doc1u;    
    public $doc2u; 
    public $doc3u; 
    const DOC_PATH = '/var/www/cposo/data/www/mon.cposo.ru/protected/building18';
    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return 'building2018_potr';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('id_report, id_building, datar, id_inic, price, id_status', 'required'),
            array('id_inic, price, id_status', 'numerical', 'integerOnly'=>true),
            array('id_report, id_building', 'length', 'max'=>10),
            array('num, techz, zakl, psd', 'length', 'max'=>255),
            array('datar', 'date', 'format' => 'dd.MM.yyyy'),
            array('doc1u, doc2u, doc3u', 'file',
                'allowEmpty'  => true,
                'maxFiles'   => 1,
                'maxSize'   => 26214400,
                'minSize'   => 0,
                'types'   => 'zip',
                'tooLarge'   => 'Вы загружаете файл слишком большого размера',
            ), 
            array('file1d, file2d, file3d', 'in','range'=>array(0, 1)),
            array('price', 'price'),
            array('doc2u', 'doc2u'),
            array('doc3u', 'doc3u'),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('id_potr, id_report, id_building, datar, num, id_inic, techz, zakl, psd, price, id_status', 'safe', 'on'=>'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations()
    {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'inic'=>array(self::BELONGS_TO, 'Building2018_inic', 'id_inic'), 
            'status'=>array(self::BELONGS_TO, 'Building2018_status', 'id_status'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return array(
            'id_potr' => 'Id Potr',
            'id_report' => 'Id Report',
            'id_building' => 'Id Building',
            'datar' => 'Дата документа основания',
            'num' => 'Номер документа основания',
            'id_inic' => 'Инициатор',
            'techz' => 'Техническое заключение',
            'zakl' => 'Положительное заключение государственной экспертизы',
            'psd' => 'Проектно-сметная документация',
            'price' => 'Объем средств, руб',
            'id_status' => 'Статус',           
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

        $criteria->compare('id_potr',$this->id_potr,true);
        $criteria->compare('id_report',$this->id_report,true);
        $criteria->compare('id_building',$this->id_building,true);
        $criteria->compare('datar',$this->datar,true);
        $criteria->compare('num',$this->num,true);
        $criteria->compare('id_inic',$this->inic);
        $criteria->compare('techz',$this->techz,true);
        $criteria->compare('zakl',$this->zakl,true);
        $criteria->compare('psd',$this->psd,true);
        $criteria->compare('price',$this->price);
        $criteria->compare('id_status',$this->stat);

        return new CActiveDataProvider($this, array(
            'criteria'=>$criteria,
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return Building2018_potr the static model class
     */
    public static function model($className=__CLASS__)
    {
        return parent::model($className);
    }
    
    protected function beforeSave()
    {
        $extension = 'zip';
        $id_rep_type = Report::model()->findByPk($this->id_report)->id_rep_type;
        $file_path = self::DOC_PATH.'/'.$id_rep_type;        
        if(!file_exists($file_path)) mkdir($file_path, 0700, true);      
        $poks = array(1 => 'techz', 2 => 'zakl', 3 => 'psd');
        for($k = 1; $k < 4; $k++) {
            $doc = 'doc'.$k;
            $pok = $poks[$k];
            $file = 'file'.$k.'d';
            if($this->$file) {
                if($this->$pok) {
                    unlink($file_path.'/'.$this->$pok);
                }
                $this->$pok = '';                    
            }
            elseif ($file = CUploadedFile::getInstance($this, $doc.'u'))
            {               
                $filename = $this->getRandomFileName($file_path, $extension);
                $basename = $filename.'.'.$extension;
                if($file->saveAs($file_path.'/'.$basename)) {
                    if($this->$pok) {
                        unlink($file_path.'/'.$this->$pok);
                    }
                    $this->$pok = $basename;
                }
            }
        }        
        if($this->datar != '') $this->datar=date('Y-m-d', strtotime($this->datar));        
        return TRUE;
    }

    protected function afterFind()
    { 
        if($this->datar == '0000-00-00' || $this->datar == '') $this->datar='';
        else $this->datar=date('d.m.Y', strtotime($this->datar));
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
    
    public function price($attribute,$params) {
        if($this->price > 0) $this->addError('price','Необходимо прикрепить все файлы документации');
    }   

    public function doc2u($attribute,$params) {
        if(CUploadedFile::getInstance($this, 'doc2u')->size && !$this->doc1u && !$this->techz) $this->addError('doc2u','Необходимо прикрепить техническое заключение');
    }

    public function doc3u($attribute,$params) {
        if(CUploadedFile::getInstance($this, 'doc3u')->size && !$this->doc2u && !$this->zakl) $this->addError('doc3u','Необходимо прикрепить положительное заключение государственной экспертизы');
    }    
}
