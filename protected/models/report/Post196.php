<?php

/**
 * This is the model class for table "post196".
 *
 * The followings are the available columns in table 'post196':
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
 */
class Post196 extends CActiveRecord
{
    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return 'post196';
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
            array('pok1, pok3, pok4, pok6, pok7, pok9, pok10, pok11', 'length', 'max'=>4),
            array('pok1, pok3, pok4, pok6, pok7, pok9, pok10, pok11, pok15, pok16, pok18', 'numerical', 'integerOnly'=>true),
            array('pok2, pok5, pok8, pok12, pok13, pok14, pok17', 'match', 'pattern'=>'/^[a-zA-Zа-яА-ЯёЁ0-9№,\.\(\)\-\:\s\"\_\?\!\=\%\&\/]*$/u', 'message'=>'В строке "{attribute}" можно использовать только буквы кириллицы, латиницы, цифры, тире, точку, двоеточие, знак номера, скобки и кавычки, дробь'),
            array('pok19', 'in','range'=>array(0,1)),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('id_report, pok1, pok2, pok3, pok4, pok5, pok6, pok7, pok8, pok9, pok10, pok11, pok12, pok13', 'safe', 'on'=>'search'),
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
            'pok1' => 'Количество лекционных занятий, семинаров, круглых столов, конференций, национально-культурных и религиозных праздников на базе образовательных организаций, направленных на предотвращение конфликтов на межнациональной и межрелигиозной почве и развитие межнационального / межконфессионального диалога с приглашением представителей заинтересованных органов',
            'pok2' => 'Тематика лекционных занятий, семинаров, круглых столов, конференций, национально-культурных и религиозных праздников на базе образовательных организаций, направленных на предотвращение конфликтов на межнациональной и межрелигиозной почве и развитие межнационального / межконфессионального диалога с приглашением представителей заинтересованных органов',
            'pok3' => 'Количество обучаемых – участников лекционных занятий, семинаров, круглых столов, конференций, национально-культурных и религиозных праздников на базе образовательных организаций, направленных на предотвращение конфликтов на межнациональной и межрелигиозной почве и развитие межнационального / межконфессионального диалога с приглашением представителей заинтересованных органов',
            'pok4' => 'Количество профилактических мероприятий, направленных на недопущение вовлечения детей и подростков в незаконную деятельность религиозных сект и экстремистских организаций',
            'pok5' => 'Тематика профилактических мероприятий, направленных на недопущение вовлечения детей и подростков в незаконную деятельность религиозных сект и экстремистских организаций',
            'pok6' => 'Количество обучаемых – участников профилактических мероприятий, направленных на недопущение вовлечения детей и подростков в незаконную деятельность религиозных сект и экстремистских организаций',
            'pok7' => 'Количество профилактических мероприятий, направленных на распространение идей межнациональной терпимости, дружбы, добрососедства, взаимного уважения',
            'pok8' => 'Тематика профилактических мероприятий, направленных на распространение идей межнациональной терпимости, дружбы, добрососедства, взаимного уважения',
            'pok9' => 'Количество обучаемых – участников профилактических мероприятий, направленных на распространение идей межнациональной терпимости, дружбы, добрососедства, взаимного уважения',
            'pok10' => 'Количество выступлений (докладов, рефератов) в научно-практической конференции «Противодействие терроризму» (ИРО)',
            'pok11' => 'Количество проведенных совместно с аппаратом антитеррористической комиссии Самарской области цикла лекций, круглых столов, семинаров по вопросам противодействия терроризму и экстремизму в среде учащейся молодежи',
            'pok12' => 'Тематика проведенных совместно с аппаратом антитеррористической комиссии Самарской области цикла лекций, круглых столов, семинаров по вопросам противодействия терроризму и экстремизму в среде учащейся молодежи',
            'pok13' => 'Результаты проведения анонимного анкетирования в образовательных организациях по вопросам их отношения к лицам других национальностей и причин такого отношения с целью выработки мер по профилактике и пресечению экстремистских проявлений в молодежной среде (ИРО)',
            'pok14' => 'Наименование и количество информационных материалов с указанием формата (электронный или печатный), направленных на воспитание культуры толерантности, взаимоуважения и взаимопонимания. Например: печатный буклет (листовка, плакат и т.д.) СтопТерроризм 100 эк.; электронная публикация (статья, пост-релиз, пресс-релиз и т.д.) Экстремизм – угроза обществу! 3 эк. ',
            'pok15' => 'Общее количество информационных материалов, направленных на воспитание культуры толерантности, взаимоуважения и взаимопонимания',
            'pok16' => 'Количество проведенных совместно с общественными и религиозными организациями культурно-просветительских программ, в том числе по изучению русского языка и российских культурных традиций',
            'pok17' => 'Тематика проведенных совместно с общественными и религиозными организациями культурно-просветительских программ, в том числе по изучению русского языка и российских культурных традиций',
            'pok18' => 'Количество обучаемых – участников культурно-просветительских программ, в том числе по изучению русского языка и российских культурных традиций',
            'pok19' => 'Наличие размещенной информации на официальном сайте / стенде образовательной организации с указанием для обучающихся детского телефона доверия для обращения по фактам жестокого обращения, причинения телесных повреждений, иных действий насильственного характера со стороны родителей или иных проживающих с ними лиц',
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

        return new CActiveDataProvider($this, array(
            'criteria'=>$criteria,
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return Post196 the static model class
     */
    public static function model($className=__CLASS__)
    {
        return parent::model($className);
    }
}

