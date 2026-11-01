<?php

/**
 * This is the model class for table "metodmat".
 *
 * The followings are the available columns in table 'metodmat':
 * @property string $id_metodmat
 * @property string $id_report
 * @property integer $id_type
 * @property string $naim
 * @property string $author
 * @property string $mesto
 * @property string $izdat
 * @property integer $god
 * @property integer $isbn
 * @property string $discipl
 * @property string $id_npo
 * @property string $id_spo
 */
class Metodmat extends CActiveRecord
{
    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return Metodmat the static model class
     */
    public static function model($className=__CLASS__)
    {
        return parent::model($className);
    }

    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return 'metodmat';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('id_report, naim, id_type, discipl', 'required'),
            array('god, isbn, id_type', 'numerical', 'integerOnly'=>true),
            array('id_report', 'length', 'max'=>12),
            array('author, mesto, izdat, discipl, id_npo, id_spo', 'length', 'max'=>255),
            array('isbn', 'length', 'is'=>13),
            array('naim, author, mesto, izdat, god, isbn, discipl, id_npo, id_spo','filter','filter'=>array($obj=new CHtmlPurifier(),'purify')),
            array('id_npo, id_spo, discipl, mesto', 'match', 'pattern'=>'/^[а-яА-Я\.\,\-\s]*$/u', 'message'=>'В показателе можно использовать только буквы кириллицы, цифры, тире и запятую'),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('id_metodmat, id_report, naim, author, mesto, izdat, god, isbn, discipl, id_npo, id_spo', 'safe', 'on'=>'search'),
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
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return array(
            'id_metodmat' => 'Id Metodmat',
            'id_report' => 'Id Report',
            'id_type'=>'Тип учебно-методического материала',
            'naim' => 'Наименование',
            'author' => 'Автор(ы)/составитель(и)',
            'mesto' => 'Место издания (в случае официального издания)',
            'izdat' => 'Издательство (в случае официального издания)',
            'god' => 'Год издания (в случае официального издания)',
            'isbn' => 'ISBN (в случае официального издания)',
            'discipl' => 'Наименование учебной дисциплины или МДК(ПМ), в рамках которой (го) используется',
            'id_npo' => 'Профессии, в рамках которых используется (перечислите через запятую)',
            'id_spo' => 'Специальности, в рамках которых используется (перечислите через запятую)',
        );
    }

    /**
     * Retrieves a list of models based on the current search/filter conditions.
     * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
     */
    public function search()
    {
        // Warning: Please modify the following code to remove attributes that
        // should not be searched.

        $criteria=new CDbCriteria;

        $criteria->compare('id_metodmat',$this->id_metodmat,true);
        $criteria->compare('id_report',$this->id_report,true);
        $criteria->compare('naim',$this->naim,true);
        $criteria->compare('author',$this->author,true);
        $criteria->compare('mesto',$this->mesto,true);
        $criteria->compare('izdat',$this->izdat,true);
        $criteria->compare('god',$this->god);
        $criteria->compare('isbn',$this->isbn);
        $criteria->compare('discipl',$this->discipl,true);
        $criteria->compare('id_npo',$this->id_npo,true);
        $criteria->compare('id_spo',$this->id_spo,true);

        return new CActiveDataProvider($this, array(
            'criteria'=>$criteria,
        ));
    }
} 