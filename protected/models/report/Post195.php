<?php

/**
 * This is the model class for table "post195".
 *
 * The followings are the available columns in table 'post195':
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
 * @property string $pok10
 * @property string $pok11
 * @property string $pok12
 * @property string $pok13
 * @property string $pok14
 * @property string $pok15
 * @property string $pok16
 * @property string $pok17
 * @property string $pok18
 * @property string $pok19
 * @property string $pok20
 * @property string $pok21
 * @property string $pok22
 * @property string $pok23
 * @property string $pok24
 */
class Post195 extends CActiveRecord
{
    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return 'post195';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('id_report', 'required'),
            array('id_report', 'length', 'max'=>8),
            array('pok1, pok3, pok4, pok5, pok6, pok7, pok9, pok10, pok11, pok12, pok13, pok14, pok15, pok17, pok18, pok20, pok21, pok23, pok24', 'length', 'max'=>4),
            array('pok16, pok19, pok22', 'numerical'),
            array('pok16, pok19, pok22', 'length', 'max'=>5),
            array('pok1, pok3, pok4, pok5, pok6, pok7, pok9, pok10, pok11, pok12, pok13, pok14, pok15, pok17, pok18, pok20, pok21, pok23, pok24', 'numerical', 'integerOnly'=>true),
            array('pok2, pok8', 'match', 'pattern'=>'/^[a-zA-Zа-яА-ЯёЁ0-9№,\.\(\)\-\:\s\"\_\?\!\=\%\&\/]*$/u', 'message'=>'В строке "{attribute}" можно использовать только буквы кириллицы, латиницы, цифры, тире, точку, двоеточие, знак номера, скобки и кавычки, дробь'),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('id_report, pok1, pok2, pok3, pok4, pok5, pok6, pok7, pok8, pok9, pok10, pok11, pok12, pok13, pok14, pok15, pok16, pok17, pok18, pok19, pok20, pok21, pok22', 'safe', 'on'=>'search'),
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
            'id_report' => 'Id Report',
            'pok1' => 'Количество массовых физкультурных и спортивных мероприятий среди учащихся и студентов с целью профилактики употребления наркотических веществ',
            'pok2' => 'Тематика массовых физкультурных и спортивных мероприятий среди учащихся и студентов с целью профилактики употребления наркотических веществ',
            'pok3' => 'Количество участников областного конкурса антинаркотических профилактических программ в сфере образования (1, 4 квартал, ЦСМ)',
            'pok4' => 'Количество участников межрегионального фестиваля спорта и здоровья «Молодая Россия говорит наркотикам нет!» (3 квартал, Областной детско-юношеский центр развития физической культуры и спорта)',
            'pok5' => 'Количество участников областного конкурса рисунков и плакатов «Спорт против наркотиков!» (4 квартал, Областной детско-юношеский центр развития физической культуры и спорта)',
            'pok6' => 'Количество проведенных мероприятий «Выпускник – Здоровье» в целях профилактики употребления несовершеннолетними наркотических средств и психотропных веществ и выявления противоправных действий, связанных с незаконным оборотом наркотиков, во взаимодействии с заинтересованными органами (2  квартал, ТУ-МВД)',
            'pok7' => 'Количество проведенных дней профилактики и уроков здоровья',
            'pok8' => 'Тематика проведенных дней профилактики и уроков здоровья',
            'pok9' => 'Количество участников областного слета волонтеров, работающих по программе профилактики вредных привычек «Свежий ветер» (ежеквартально, ЦСМ)',
            'pok10' => 'Количество обучаемых, привлеченных к занятиям физической культурой и спортом в детско-юношеских спортивных школах, спортивных секциях, клубах по месту жительства',
            'pok11' => 'Количество участников районных, городских, областных фестивалей художественного творчества, реализации программы развития технического творчества учащихся',
            'pok12' => 'Количество специалистов, занимающихся профилактикой наркомании в образовательной организации, прошедших повышение квалификации по антинаркотической тематике',
            'pok13' => 'Количество специалистов, занимающихся профилактикой наркомании в образовательной организации, обучившихся на семинарах антинаркотической направленности (ежеквартально, ЦПО —Самарский областной центр медицинской профилактики)',
            'pok14' => '',
            'pok15' => '',
            'pok16' => '',
            'pok17' => '',
            'pok18' => '',
            'pok19' => '',
            'pok20' => '',
            'pok21' => '',
            'pok22' => '',
            'pok23' => 'Количество обучаемых-участников мероприятий в рамках акции «Выпускник – Здоровье»',
            'pok24' => 'Количество обучаемых-участников дней профилактики и уроков здоровья в образовательных организациях',
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
        $criteria->compare('pok10',$this->pok10,true);
        $criteria->compare('pok11',$this->pok11,true);
        $criteria->compare('pok12',$this->pok12,true);
        $criteria->compare('pok13',$this->pok13,true);
        $criteria->compare('pok14',$this->pok14,true);
        $criteria->compare('pok15',$this->pok15,true);
        $criteria->compare('pok16',$this->pok16,true);
        $criteria->compare('pok17',$this->pok17,true);
        $criteria->compare('pok18',$this->pok18,true);
        $criteria->compare('pok19',$this->pok19,true);
        $criteria->compare('pok20',$this->pok20,true);
        $criteria->compare('pok21',$this->pok21,true);
        $criteria->compare('pok22',$this->pok22,true);

        return new CActiveDataProvider($this, array(
            'criteria'=>$criteria,
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return Post195 the static model class
     */
    public static function model($className=__CLASS__)
    {
        return parent::model($className);
    }
}

