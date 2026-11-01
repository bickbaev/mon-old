<?php

/**
 * This is the model class for table "raiting_list_night_prison".
 *
 * The followings are the available columns in table 'raiting_list_night_prison':
 * @property string $id_report
 * @property integer $pok1_1
 * @property integer $pok1_2
 * @property integer $pok1_3
 * @property integer $pok1_4
 * @property integer $pok2_1
 * @property integer $pok2_2
 * @property integer $pok2_3
 * @property integer $pok2_4
 * @property integer $pok3_1
 * @property integer $pok3_2
 * @property integer $pok3_3
 * @property integer $pok3_4
 * @property integer $pok3_5
 * @property integer $pok4_1
 * @property integer $pok4_2
 * @property integer $pok4_3
 * @property integer $pok4_4
 * @property integer $pok4_5
 * @property integer $pok5_1
 * @property integer $pok5_2
 * @property integer $pok6_1
 * @property integer $pok6_2
 * @property integer $pok6_3
 * @property integer $pok6_4
 * @property integer $pok6_5
 * @property string $remark
 */
class Raiting_list_night_prison extends CActiveRecord
{
    /**
     * Returns the static model of the specified AR class.
     * @return Raiting_list_night_prison the static model class
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
        return 'raiting_list_night_prison';
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
            array('pok1_1, pok1_2, pok1_3, pok1_4, pok2_1, pok2_2, pok2_3, pok2_4, pok3_1, pok3_2, pok3_3, pok3_4, pok3_5, pok4_1, pok4_2, pok4_3, pok4_4, pok4_5, pok5_1, pok5_2, pok6_1, pok6_2, pok6_3, pok6_4, pok6_5', 'numerical', 'integerOnly'=>true),
            array('pok1_1', 'numerical', 'min' => 0, 'max' => 4),
            array('pok1_2', 'numerical', 'min' => 0, 'max' => 4),
            array('pok1_3', 'numerical', 'min' => 0, 'max' => 3),
            array('pok1_4', 'numerical', 'min' => 0, 'max' => 6),
            array('pok2_1', 'numerical', 'min' => 0, 'max' => 3),
            array('pok2_2', 'numerical', 'min' => 0, 'max' => 2),
            array('pok2_3', 'numerical', 'min' => 0, 'max' => 3),
            array('pok2_4', 'numerical', 'min' => 0, 'max' => 6),
            array('pok3_1', 'numerical', 'min' => 0, 'max' => 3),
            array('pok3_2', 'numerical', 'min' => 0, 'max' => 2),
            array('pok3_3', 'numerical', 'min' => 0, 'max' => 3),
            array('pok3_4', 'numerical', 'min' => 0, 'max' => 3),
            array('pok3_5', 'numerical', 'min' => 0, 'max' => 3),
            array('pok4_1', 'numerical', 'min' => 0, 'max' => 3),
            array('pok4_2', 'numerical', 'min' => 0, 'max' => 2),
            array('pok4_3', 'numerical', 'min' => 0, 'max' => 4),
            array('pok4_4', 'numerical', 'min' => 0, 'max' => 2),
            array('pok4_5', 'numerical', 'min' => 0, 'max' => 3),
            array('pok5_1', 'numerical', 'min' => 0, 'max' => 2),
            array('pok5_2', 'numerical', 'min' => 0, 'max' => 2),
            array('pok6_1', 'numerical', 'min' => 0, 'max' => 2),
            array('pok6_2', 'numerical', 'min' => 0, 'max' => 3),
            array('pok6_3', 'numerical', 'min' => 0, 'max' => 3),
            array('pok6_4', 'numerical', 'min' => -1, 'max' => 0),
            array('pok6_5', 'numerical', 'min' => 0, 'max' => 1),
            array('id_report', 'length', 'max'=>10),
            array('remark', 'safe'),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('id_report, pok1_1, pok1_2, pok1_3, pok1_4, pok2_1, pok2_2, pok2_3, pok2_4, pok3_1, pok3_2, pok3_3, pok3_4, pok3_5, pok4_1, pok4_2, pok4_3, pok4_4, pok4_5, pok5_1, pok5_2, pok6_1, pok6_2, pok6_3, pok6_4, pok6_5, remark', 'safe', 'on'=>'search'),
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
            'pok1_1' => 'Снижение доли неуспевающих выпускников по результатам итоговой аттестации – 4 балла ',
            'pok1_2' => 'Снижение доли неуспевающих учащихся – 4 балла',
            'pok1_3' => 'Динамика доли учащихся, оставленных на повторное обучение: снижение – 2 балла, отсутствие учащихся, оставленных на повторное обучение – 3 балла',
            'pok1_4' => 'Наличие выпускников, получивших аттестаты особого образца – 6 баллов',
            'pok2_1' => 'Снижение (отсутствие) пропусков учащимися уроков без уважительной причины – 3 балла',
            'pok2_2' => 'Наличие символики, созданной школой и утверждённой локальными актами (гимн, герб, флаг) – 2 балла',
            'pok2_3' => 'Наличие школьной газеты – 3 балла',
            'pok2_4' => 'Участие обучающихся в социальных проектах: наличие – 2 балла; победы в муниципальных или областных конкурсах – 4 балла; победы на всероссийских или международных конкурсах – 6 баллов',
            'pok3_1' => 'Распространение педагогического опыта учреждения в профессиональном сообществе через проведение семинаров, конференций – 3 балла',
            'pok3_2' => 'Наличие публикаций руководителя по распространению педагогического опыта учреждения в профессиональном сообществе – 2 балла',
            'pok3_3' => 'Наличие достижений (награды, гранты) у педагогического коллектива (индивидуальные и/или коллективные) по внедрению в практику современных образовательных технологий – 3 балла',
            'pok3_4' => 'Наличие сайта учреждения – 3 балла',
            'pok3_5' => 'Наличие электронного документооборота с органом управления образованием с использованием сети Интернет – 3 балла',
            'pok4_1' => 'Наличие программы развития (срок действия – не менее 3-х лет) – 3 балла',
            'pok4_2' => 'Наличие договоров и планов совместной работы с различными учреждениями, организациями (не менее 5 учреждений, организаций) – 2 балла',
            'pok4_3' => 'Наличие позитивных материалов в СМИ о деятельности учреждения: на муниципальном уровне – 2 балла; на уровне области – 3 балла; на федеральном уровне – 4 балла',
            'pok4_4' => 'Участие руководителя образовательного учреждения в составе экспертных (рабочих и т.п.) групп – 2 балла',
            'pok4_5' => 'Наличие публичного отчёта о деятельности образовательного учреждения (включая информацию о поступлении и расходовании финансовых и материальных средств) за прошедший учебный год в СМИ, в сети Интернет, в библиотеке – 3 балла',
            'pok5_1' => 'Наличие у образовательного учреждения программы, пропагандирующей здоровый образ жизни – 2 балла',
            'pok5_2' => 'Отсутствие травматизма среди обучающихся и работников учреждения во время образовательного процесса – 2 балла',
            'pok6_1' => 'Доля педагогических работников (включая совместителей), имеющих квалификационные категории: от 30% до 50% – 1 балл, 50% и выше – 2 балла',
            'pok6_2' => 'Доля педагогических работников, прошедших обучение на курсах повышения квалификации в объёме не менее 72 часов: от 10% до 20% от общего числа – 2 балла; 20 % и более – 3 балла',
            'pok6_3' => 'Результативность участия педагогов в конкурсах профессионального мастерства: наличие участников – 2 балла, наличие победителей и призеров – 3 балла',
            'pok6_4' => 'Наличие кредиторских задолженностей и остатков средств на счетах учреждения на конец календарного года – (- 1) балл',
            'pok6_5' => 'Отсутствие замечаний по итогам ревизий и других проверок по вопросам финансово-хозяйственной деятельности – 1 балл',
            'remark' => 'Remark',
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

        $criteria->compare('id_report',$this->id_report,true);
        $criteria->compare('pok1_1',$this->pok1_1);
        $criteria->compare('pok1_2',$this->pok1_2);
        $criteria->compare('pok1_3',$this->pok1_3);
        $criteria->compare('pok1_4',$this->pok1_4);
        $criteria->compare('pok2_1',$this->pok2_1);
        $criteria->compare('pok2_2',$this->pok2_2);
        $criteria->compare('pok2_3',$this->pok2_3);
        $criteria->compare('pok2_4',$this->pok2_4);
        $criteria->compare('pok3_1',$this->pok3_1);
        $criteria->compare('pok3_2',$this->pok3_2);
        $criteria->compare('pok3_3',$this->pok3_3);
        $criteria->compare('pok3_4',$this->pok3_4);
        $criteria->compare('pok3_5',$this->pok3_5);
        $criteria->compare('pok4_1',$this->pok4_1);
        $criteria->compare('pok4_2',$this->pok4_2);
        $criteria->compare('pok4_3',$this->pok4_3);
        $criteria->compare('pok4_4',$this->pok4_4);
        $criteria->compare('pok4_5',$this->pok4_5);
        $criteria->compare('pok5_1',$this->pok5_1);
        $criteria->compare('pok5_2',$this->pok5_2);
        $criteria->compare('pok6_1',$this->pok6_1);
        $criteria->compare('pok6_2',$this->pok6_2);
        $criteria->compare('pok6_3',$this->pok6_3);
        $criteria->compare('pok6_4',$this->pok6_4);
        $criteria->compare('pok6_5',$this->pok6_5);
        $criteria->compare('remark',$this->remark,true);

        return new CActiveDataProvider(get_class($this), array(
            'criteria'=>$criteria,
        ));
    }
}