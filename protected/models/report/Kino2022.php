<?php

/**
 * This is the model class for table "kino2022".
 *
 * The followings are the available columns in table 'kino2022':
 * @property string $id_report
 * @property string $pok1
 * @property string $pok2
 * @property string $pok3
 * @property string $pok4
 * @property string $pok5
 * @property string $pok6
 * @property string $pok7
 * @property string $pok8
 * @property string $pok9
 * @property string $p_date
 */
class Kino2022 extends CActiveRecord
{
    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return 'kino2022';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('id_report, pok1, pok2, pok3, pok4, pok5, pok6, pok7, pok8, pok9', 'required'),
            array('id_report, pok7, pok8' , 'numerical', 'integerOnly'=>true),
            array('pok1, pok2, pok3', 'match', 'pattern'=>'/^[а-яА-ЯёЁ\-\s]*$/u', 'message'=>'В имени, фамилии и отчестве можно использовать только буквы кириллицы и тире'),
            array('pok4', 'match', 'pattern'=>'/^[а-яА-ЯёЁ0-9\-\.\s]*$/u', 'message'=>'В строке "{attribute}" можно использовать только буквы кириллицы, цифры и тире'),
            array('pok6', 'email'),
            array('pok5', 'length', 'max'=>10),
            array('pok5', 'match', 'pattern'=>'/^[0-9]*$/u', 'message'=>'В строке "{attribute}" можно использовать только цифры'),
            array('pok1, pok2, pok3, pok4, pok5, pok6, pok7, pok8', 'length', 'max'=>255),
            array('pok9', 'match', 'pattern'=>'/^[а-яА-ЯёЁa-zA-Z0-9№,\.\%\:\?\!\(\)\-\_\=\—\–\r\n\s\+\&\/\«\»\"\"\s]*$/u', 'message'=>'В строке "{attribute}" можно использовать только буквы кириллицы, латиницы, цифры, тире, дефис, точку, запятую, восклицательный знак, +, &, /, знак номера, кавычки вида ", «, » и скобки'),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('id_report, pok1, pok2, pok3, pok4, pok5, pok6, pok7, pok8, pok9, p_date', 'safe', 'on'=>'search'),
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
            'pok1' => 'Фамилия',
            'pok2' => 'Имя',
            'pok3' => 'Отчество',
            'pok4' => 'Должность',
            'pok5' => 'Номер телефона',
            'pok6' => 'E-mail',
            'pok7' => 'Просмотрено и обсуждено, ед.',
            'pok8' => 'Реализовано социальных практик, ед.',
            'pok9' => 'Ссылки (каждую ссылку размещайте с новой строки)',
            'p_date' => 'Последнее сохранение',
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

        $criteria->compare('id_report',$this->id_report,true);
        $criteria->compare('pok1',$this->pok1,true);
        $criteria->compare('pok2',$this->pok2,true);
        $criteria->compare('pok3',$this->pok3,true);
        $criteria->compare('pok4',$this->pok4,true);
        $criteria->compare('pok5',$this->pok5,true);
        $criteria->compare('pok6',$this->pok6,true);
        $criteria->compare('pok7',$this->pok7,true);
        $criteria->compare('pok8',$this->pok8,true);
        $criteria->compare('pok9',$this->pok9,true);
        $criteria->compare('p_date',$this->p_date,true);

        return new CActiveDataProvider($this, array(
            'criteria'=>$criteria,
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return Kino2022 the static model class
     */
    public static function model($className=__CLASS__)
    {
        return parent::model($className);
    }
    
    protected function beforeSave()
    {
        $this->p_date=date('Y-m-d H:i:s', time());
        return TRUE;
    }

    protected function afterFind()
    {
        if($this->p_date == '0000-00-00 00:00:00' || $this->p_date == '') $this->p_date='';
        else $this->p_date=date('d.m.Y', strtotime($this->p_date));
    }     
}