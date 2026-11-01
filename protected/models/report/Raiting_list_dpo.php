<?php

/**
 * This is the model class for table "raiting_list_dpo".
 *
 * The followings are the available columns in table 'raiting_list_dpo':
 * @property string $id_report
 * @property integer $pok1_1
 * @property integer $pok1_2
 * @property integer $pok1_3
 * @property double $pok1_4
 * @property integer $pok1_5
 * @property integer $pok1_6
 * @property integer $pok1_7
 * @property integer $pok1_8
 * @property integer $pok1_9
 * @property integer $pok1_10
 * @property integer $pok1_11
 * @property integer $pok2_1
 * @property integer $pok2_2
 * @property integer $pok2_3
 * @property integer $pok2_4
 * @property integer $pok2_5
 * @property integer $pok2_6
 * @property integer $pok3_1
 * @property integer $pok3_2
 * @property integer $pok4_1
 * @property integer $pok4_2
 * @property double $pok4_3
 * @property integer $pok4_4
 * @property integer $pok4_5
 * @property integer $pok4_6
 * @property string $remark
 */
class Raiting_list_dpo extends CActiveRecord
{
    /**
     * Returns the static model of the specified AR class.
     * @return Raiting_list_dpo the static model class
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
        return 'raiting_list_dpo';
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
            array('pok1_1, pok1_2, pok1_3, pok1_5, pok1_6, pok1_7, pok1_8, pok1_9, pok1_10, pok1_11, pok2_1, pok2_2, pok2_3, pok2_4, pok2_5, pok2_6, pok3_1, pok3_2, pok4_1, pok4_2, pok4_4, pok4_5, pok4_6', 'numerical', 'integerOnly'=>true),
            array('pok1_4, pok4_3', 'numerical'),
            array('pok1_1', 'numerical', 'min' => 0, 'max' => 3),
            array('pok1_2', 'numerical', 'min' => 0, 'max' => 3),
            array('pok1_3', 'numerical', 'min' => 0, 'max' => 1),
            array('pok1_4', 'numerical', 'min' => 0, 'max' => 5),
            array('pok1_5', 'numerical', 'min' => 0, 'max' => 2),
            array('pok1_6', 'numerical', 'min' => 0, 'max' => 1),
            array('pok1_7', 'numerical', 'min' => 0, 'max' => 2),
            array('pok1_8', 'numerical', 'min' => 0, 'max' => 1),
            array('pok1_9', 'numerical', 'min' => 0, 'max' => 1),
            array('pok1_10', 'numerical', 'min' => 0, 'max' => 2),
            array('pok1_11', 'numerical', 'min' => 0, 'max' => 3),
            array('pok2_1', 'numerical', 'min' => 0, 'max' => 2),
            array('pok2_2', 'numerical', 'min' => 0, 'max' => 1),
            array('pok2_3', 'numerical', 'min' => 0, 'max' => 3),
            array('pok2_4', 'numerical', 'min' => 0, 'max' => 2),
            array('pok2_5', 'numerical', 'min' => 0, 'max' => 2),
            array('pok2_6', 'numerical', 'min' => 0, 'max' => 5),
            array('pok3_1', 'numerical', 'min' => 0, 'max' => 1),
            array('pok3_2', 'numerical', 'min' => 0, 'max' => 1),
            array('pok4_1', 'numerical', 'min' => 0, 'max' => 1),
            array('pok4_2', 'numerical', 'min' => 0, 'max' => 2),
            array('pok4_3', 'numerical', 'min' => 0, 'max' => 2),
            array('pok4_4', 'numerical', 'min' => 0, 'max' => 1),
            array('pok4_5', 'numerical', 'min' => -1, 'max' => 0),
            array('pok4_6', 'numerical', 'min' => 0, 'max' => 1),
            array('id_report', 'length', 'max'=>10),
            array('remark', 'safe'),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('id_report, pok1_1, pok1_2, pok1_3, pok1_4, pok1_5, pok1_6, pok1_7, pok1_8, pok1_9, pok1_10, pok1_11, pok2_1, pok2_2, pok2_3, pok2_4, pok2_5, pok2_6, pok3_1, pok3_2, pok4_1, pok4_2, pok4_3, pok4_4, pok4_5, pok4_6, remark', 'safe', 'on'=>'search'),
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
            'pok1_1' => '1.1 Разработка работниками учреждения и внедрение авторских образовательных программ: 3-5 программ – 1 балл, 6-8 программ – 2 балла, 9 программ и более – 3 балла',
            'pok1_2' => '1.2 Разработка работниками учреждения учебно-методических комплектов (УМК), обеспечивающих реализацию авторских образовательных программ: 1-2 УМК – 1 балл, 3-5 УМК – 2 балла, 6 УМК и более – 3 балла',
            'pok1_3' => '1.3 Наличие публикаций руководителя по распространению педагогического (научного) опыта учреждения в профессиональном сообществе – 1 балл',
            'pok1_4' => '1.4 Распространение педагогического (научного) опыта учреждения в профессиональном сообществе через проведение семинаров, конференций, организованных самим учреждением: на уровне муниципалитета или «образовательного округа» – 0,5 балла за каждое мероприятие; на областном уровне и выше – 1 балл за каждое мероприятие (но не более 5 баллов)',
            'pok1_5' => '1.5 Участие учреждения в выставках, форумах, ярмарках, конференциях: на региональном уровне – 1 балл, на российском (международном) уровне – 2 балла',
            'pok1_6' => '1.6 Наличие газеты (тиражируемой), выходящей не реже 1 раза в месяц – 1 балл',
            'pok1_7' => '1.7 Наличие достижений (награды, гранты) у педагогического (научного) коллектива (индивидуальные и/или коллективные) по внедрению в практику современных образовательных технологий: на региональном уровне – 1 балл; на российском и/или международном уровнях – 2 балла',
            'pok1_8' => '1.8 Наличие сайта учреждения, обновляемого не реже 1 раза в  месяц – 1 балл',
            'pok1_9' => '1.9 Наличие электронного документооборота с органами управления образованием с использованием сети Интернет – 1 балл',
            'pok1_10' => '1.10 Позитивная динамика в результатах коррекционно-развивающей, психологической работы, проявляемая в достижениях обучающихся, воспитанников: доля детей с положительной динамикой от 50% до 70% – 1 балл, 70% и выше – 2 балла',
            'pok1_11' => '1.11 Охват психолого-педагогической и медико-социальной помощью образовательных учреждений на курируемой территории (подтверждённый наличием договоров): от 50% до 70% – 1 балл, от 70% до 90% – 2 балла, 90% и выше – 3 балла',
            'pok2_1' => '2.1 Наличие действующей программы развития (срок действия – не менее 3-х лет), утверждённой органом самоуправления учреждения – 2 балла',
            'pok2_2' => '2.2 Наличие договоров и планов совместной работы с различными учреждениями, организациями (не менее 5 учреждений, организаций) – 1 балл',
            'pok2_3' => '2.3 Наличие позитивных материалов в СМИ о деятельности учреждения: на муниципальном уровне или уровне «образовательного округа» – 1 балл; на уровне области – 2 балла; на федеральном уровне – 3 балла',
            'pok2_4' => '2.4 Участие руководителя образовательного учреждения в составе экспертных (рабочих и т.п.) групп: на уровне «образовательного округа» – 1 балл, на региональном уровне и выше – 2 балла',
            'pok2_5' => '2.5 Наличие публичного отчёта о деятельности учреждения за год, включая информацию о расходовании внебюджетных средств (в СМИ, в сети Интернет) – 2 балла',
            'pok2_6' => '2.6 Отсутствие замечаний, обоснованных жалоб по качеству и срокам выполнения работ в рамках государственного задания – 5 баллов',
            'pok3_1' => '3.1 Отсутствие предписаний, замечаний и обоснованных жалоб в части организации охраны жизни и здоровья участников научно-образовательного процесса, не связанных с капитальным вложением средств – 1 балл',
            'pok3_2' => '3.2 Отсутствие травматизма среди участников научно-образовательного процесса – 1 балл',
            'pok4_1' => '4.1 Наличие не менее чем у 50 % педагогических работников (включая совместителей) квалификационных категорий – 1 балл',
            'pok4_2' => '4.2 Доля педагогических работников, прошедших обучение на курсах повышения квалификации в объёме не менее 72 часов: от 10% до 20% от общего числа – 1 балл; 20% и выше – 2 балла',
            'pok4_3' => '4.3 Результативность участия педагогов в конкурсах профессионального мастерства: участие  на уровне «образовательного округа» – 0,5 балла, наличие победителей и призеров на уровне «образовательного округа» – 1 балл, участие на областном уровне – 1,5 балла, наличие победителей на областном уровне и выше – 2 балла',
            'pok4_4' => '4.4 Наличие в образовательном учреждении молодых специалистов, принятых на работу на основе ученического договора – 1 балл',
            'pok4_5' => '4.5 Наличие кредиторских задолженностей и остатков средств на счетах учреждения на конец календарного года – (- 1) балл',
            'pok4_6' => '4.6 Отсутствие замечаний по итогам ревизий и других проверок по вопросам финансово-хозяйственной деятельности – 1 балл',
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
        $criteria->compare('pok1_5',$this->pok1_5);
        $criteria->compare('pok1_6',$this->pok1_6);
        $criteria->compare('pok1_7',$this->pok1_7);
        $criteria->compare('pok1_8',$this->pok1_8);
        $criteria->compare('pok1_9',$this->pok1_9);
        $criteria->compare('pok1_10',$this->pok1_10);
        $criteria->compare('pok1_11',$this->pok1_11);
        $criteria->compare('pok2_1',$this->pok2_1);
        $criteria->compare('pok2_2',$this->pok2_2);
        $criteria->compare('pok2_3',$this->pok2_3);
        $criteria->compare('pok2_4',$this->pok2_4);
        $criteria->compare('pok2_5',$this->pok2_5);
        $criteria->compare('pok2_6',$this->pok2_6);
        $criteria->compare('pok3_1',$this->pok3_1);
        $criteria->compare('pok3_2',$this->pok3_2);
        $criteria->compare('pok4_1',$this->pok4_1);
        $criteria->compare('pok4_2',$this->pok4_2);
        $criteria->compare('pok4_3',$this->pok4_3);
        $criteria->compare('pok4_4',$this->pok4_4);
        $criteria->compare('pok4_5',$this->pok4_5);
        $criteria->compare('pok4_6',$this->pok4_6);
        $criteria->compare('remark',$this->remark,true);

        return new CActiveDataProvider(get_class($this), array(
            'criteria'=>$criteria,
        ));
    }
}