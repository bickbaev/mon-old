<?php

/**
 * This is the model class for table "abi25_obsh".
 *
 * The followings are the available columns in table 'abi25_obsh':
 * @property string $id_report
 * @property string $name
 * @property string $patr
 * @property string $surname
 * @property string $code
 * @property string $tel
 * @property string $mail
 * @property string $dol
 */
class Abi25_obsh extends CActiveRecord
{
    public $file1;
    
    public $id_type;
    public $id_okr;
    public $est_name;       
    
    const FILE_PATH = '/var/www/cposo/data/www/mon.cposo.ru/protected/spz/abi25';
    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return 'abi25_obsh';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('name, patr, surname, code, tel, mail, dol', 'required'),
            array('name, patr, surname, mail, dol', 'length', 'max'=>255),
            array('name, patr, surname', 'match', 'pattern'=>'/^[А-ЯЁ][а-яё\-]+$/u', 'message'=>'В строке "{attribute}" можно использовать только буквы кириллицы и дефис. Первый символ должен быть заглавной буквой, остальные строчными'),
            array('code', 'length', 'is'=>3),
            array('tel', 'length', 'is'=>7),
            array('code, tel', 'match', 'pattern'=>'/^[0-9]*$/u', 'message'=>'В строке "{attribute}" можно использовать только цифры'),
            array('dol, comment, est_name', 'match', 'pattern'=>'/^[а-яА-ЯёЁa-zA-Z0-9№,\.\:\?\!\(\)\-\—\–\r\n\s\+\&\/\«\»\"\"]*$/u', 'message'=>'В строке "{attribute}" можно использовать только буквы кириллицы, латиницы, цифры, тире, дефис, точку, запятую, восклицательный знак, +, &, /, знак номера, кавычки вида ", «, » и скобки'),
            array('mail', 'email'),
            array('mail', 'match', 'pattern' => '/^[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$/', 'message' => 'Адрес электронной почты должен содержать только строчные буквы'),            
            array('mail', 'EmailDomainValidator', 
                  'checkMX' => true, 'checkA' => false),
            array('file1', 'file',
                'allowEmpty'  => true,
                'maxFiles'   => 1,
                'maxSize'   => 5242880,
                'minSize'   => 0,
                'types'   => 'zip, pdf',
                'tooLarge'   => 'Вы загружаете файл слишком большого размера',
            ),
            array('file1', 'file1_val'),
            array('id_okr', 'InTableValidator', 
                'table' => 'est',
                'valueColumn' => 'id_okr',
                'message' => 'Указанного значения не существует',
            ),
            array('id_comp', 'InTableValidator', 
                'table' => 'abi25_comp',
                'valueColumn' => 'id',
                'message' => 'Указанного значения не существует',
            ),            
            array('id_type', 'in','range'=>range(1, 9)),             
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('id_report, name, patr, surname, code, tel, mail, dol', 'safe', 'on'=>'search'),
        );
    }
    
    public function file1_val ($attribute,$params)
    {            
        if(!CUploadedFile::getInstance($this, 'file1')->size && !$this->obsh_r) $this->addError('file1', 'Необходимо загрузить файл заявки');
    }    

    /**
     * @return array relational rules.
     */
    public function relations()
    {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'report'=>array(self::BELONGS_TO, 'Report', 'id_report'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return array(
            'id_report' => 'Id Report',
            'name' => 'Имя',
            'patr' => 'Отчество',
            'surname' => 'Фамилия',
            'code' => 'Код',
            'tel' => 'Сотовый телефон',
            'mail' => 'Официальный адрес электронной почты организации',
            'dol' => 'Должность',
            'comment' => 'Комментарий ЦРД',
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
    public function search($id_comp)
    {
        // @todo Please modify the following code to remove attributes that should not be searched.

        $criteria=new CDbCriteria;      
        
        $criteria->condition = "surname != ''";
        
        if (!empty($id_comp)) {
            $criteria->addCondition('id_comp = :id_comp');
            $criteria->params[':id_comp'] = $id_comp;
        }         
        
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

        $criteria->compare('id_report',$this->id_report,true);
        $criteria->compare('name',$this->name,true);
        $criteria->compare('patr',$this->patr,true);
        $criteria->compare('surname',$this->surname,true);
        $criteria->compare('code',$this->code,true);
        $criteria->compare('tel',$this->tel,true);
        $criteria->compare('mail',$this->mail,true);
        $criteria->compare('dol',$this->dol,true);

        return new CActiveDataProvider($this, array(
            'criteria'=>$criteria,
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return Abi25_obsh the static model class
     */
    public static function model($className=__CLASS__)
    {
        return parent::model($className);
    }
    
    protected function beforeSave()
    {         
        $file_path = self::FILE_PATH.'/'.Report::model()->findByPk($this->id_report)->id_rep_type.'/'.$this->id_report;

        if ($file = CUploadedFile::getInstance($this, 'file1'))
        {               
            if(!file_exists($file_path)) mkdir($file_path, 0700, true);
            $extension = strtolower($file->extensionName);
            if($this->obsh_r) unlink($file_path.'/'.$this->obsh);
            if ($file->saveAs($file_path.'/'.strtolower('obsh.'.$extension))) {
                $this->obsh = strtolower('obsh.'.$extension);
                $this->obsh_r= $file->name;
            }    
        } 

        return TRUE;   
    }

    public function get_part() {
        return Yii::app()->db->createCommand('SELECT count(*) FROM `abi25_part` WHERE id_report = '.$this->id_report)->queryScalar(); 
    }     
}
