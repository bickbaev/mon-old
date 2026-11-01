<?php

/**
 * This is the model class for table "raiting_list_dou".
 *
 * The followings are the available columns in table 'raiting_list_dou':
 * @property string $id_report
 * @property integer $pok1_1
 * @property integer $pok1_2
 * @property double $pok1_3
 * @property integer $pok1_4
 * @property double $pok1_5
 * @property integer $pok2_1
 * @property integer $pok2_2
 * @property integer $pok2_3
 * @property integer $pok2_4
 * @property integer $pok2_5
 * @property integer $pok3_1
 * @property integer $pok4_1
 * @property integer $pok4_2
 * @property integer $pok4_3
 * @property integer $pok4_4
 * @property integer $pok4_5
 * @property integer $pok4_6
 * @property integer $pok4_7
 * @property integer $pok4_8
 * @property integer $pok4_9
 * @property integer $pok5_1
 * @property integer $pok5_2
 * @property integer $pok5_3
 * @property integer $pok5_4
 * @property integer $pok5_5
 * @property integer $pok6_1
 * @property integer $pok6_2
 * @property integer $pok6_3
 * @property double $pok6_4
 * @property integer $pok6_5
 * @property integer $pok6_6
 * @property integer $pok6_7
 * @property integer $pok6_8
 * @property string $remark
 */
class Raiting_list_dou extends CActiveRecord
{
    /**
     * Returns the static model of the specified AR class.
     * @return Raiting_list_dou the static model class
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
        return 'raiting_list_dou';
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
            array('pok1_1, pok1_2, pok1_4, pok2_1, pok2_2, pok2_3, pok2_4, pok2_5, pok3_1, pok4_1, pok4_2, pok4_3, pok4_4, pok4_5, pok4_6, pok4_7, pok4_8, pok4_9, pok5_1, pok5_2, pok5_3, pok5_4, pok5_5, pok6_1, pok6_2, pok6_3, pok6_5, pok6_6, pok6_7, pok6_8', 'numerical', 'integerOnly'=>true),
            array('pok1_3, pok1_5, pok6_4', 'numerical'),
            array('pok1_1', 'numerical', 'min' => 0, 'max' => 3),
            array('pok1_2', 'numerical', 'min' => 0, 'max' => 2),
            array('pok1_3', 'numerical', 'min' => 0, 'max' => 2),
            array('pok1_4', 'numerical', 'min' => 0, 'max' => 3),
            array('pok1_5', 'numerical', 'min' => 0, 'max' => 3),
            array('pok2_1', 'numerical', 'min' => 0, 'max' => 3),
            array('pok2_2', 'numerical', 'min' => 0, 'max' => 1),
            array('pok2_3', 'numerical', 'min' => 0, 'max' => 3),
            array('pok2_4', 'numerical', 'min' => 0, 'max' => 3),
            array('pok2_5', 'numerical', 'min' => 0, 'max' => 1),
            array('pok3_1', 'numerical', 'min' => 0, 'max' => 3),
            array('pok4_1', 'numerical', 'min' => 0, 'max' => 2),
            array('pok4_2', 'numerical', 'min' => 0, 'max' => 2),
            array('pok4_3', 'numerical', 'min' => 0, 'max' => 1),
            array('pok4_4', 'numerical', 'min' => 0, 'max' => 3),
            array('pok4_5', 'numerical', 'min' => 0, 'max' => 1),
            array('pok4_6', 'numerical', 'min' => 0, 'max' => 3),
            array('pok4_7', 'numerical', 'min' => 0, 'max' => 2),
            array('pok4_8', 'numerical', 'min' => 0, 'max' => 2),
            array('pok4_9', 'numerical', 'min' => 0, 'max' => 1),
            array('pok5_1', 'numerical', 'min' => 0, 'max' => 1),
            array('pok5_2', 'numerical', 'min' => 0, 'max' => 2),
            array('pok5_3', 'numerical', 'min' => 0, 'max' => 2),
            array('pok5_4', 'numerical', 'min' => 0, 'max' => 1),
            array('pok5_5', 'numerical', 'min' => 0, 'max' => 1),
            array('pok6_1', 'numerical', 'min' => 0, 'max' => 1),
            array('pok6_2', 'numerical', 'min' => 0, 'max' => 2),
            array('pok6_3', 'numerical', 'min' => -1, 'max' => 0),
            array('pok6_4', 'numerical', 'min' => 0, 'max' => 2),
            array('pok6_5', 'numerical', 'min' => 0, 'max' => 1),
            array('pok6_6', 'numerical', 'min' => -3, 'max' => 0),
            array('pok6_7', 'numerical', 'min' => -1, 'max' => 0),
            array('pok6_8', 'numerical', 'min' => 0, 'max' => 1),
            array('id_report', 'length', 'max'=>10),
            array('remark', 'safe'),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('id_report, pok1_1, pok1_2, pok1_3, pok1_4, pok1_5, pok2_1, pok2_2, pok2_3, pok2_4, pok2_5, pok3_1, pok4_1, pok4_2, pok4_3, pok4_4, pok4_5, pok4_6, pok4_7, pok4_8, pok4_9, pok5_1, pok5_2, pok5_3, pok5_4, pok5_5, pok6_1, pok6_2, pok6_3, pok6_4, pok6_5, pok6_6, pok6_7, pok6_8, remark', 'safe', 'on'=>'search'),
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
            'pok1_1' => '1.1 Результаты выполнения временных требований государственного образовательного стандарта по дошкольному образованию (в среднем по учреждению): от 50% до 70% воспитанников показывают результаты на высоком уровне – 2 балла; 70% воспитанников и выше показывают результаты на высоком уровне – 3 балла',
            'pok1_2' => '1.2 Положительная динамика или сохранение стабильно высокого показателя количества дней пребывания ребёнка в ДОУ: положительная динамика – 1 балл, показатель выше среднего по муниципальному образованию – 2 балла',
            'pok1_3' => '1.3 Доля воспитанников, постоянно занимающихся по дополнительным общеобразовательным программам дошкольного образования, реализуемым ДОУ: за каждые 25% – 0,5 балла',
            'pok1_4' => '1.4 Реализация дополнительных общеобразовательных программ дошкольного образования в соответствии с лицензией: 1-2 направления – 1 балл, 3-4 направления – 2 балла, 5 направлений и более – 3 балла',
            'pok1_5' => '1.5 Количество воспитанников (в личном первенстве) и/или команд, организованных ДОУ, ставших победителями или призёрами спортивных соревнований, конкурсов, фестивалей и др.: наличие на муниципальном уровне (за исключением городов Самара и Тольятти) – 0,5 балла; наличие на уровне «образовательного округа» – 1 балл; 3 и более на уровне «образовательного округа» – 2 балла; наличие на уровне области – 2 балла; 3 и более на уровне области – 3 балла; наличие на всероссийском или международном уровне – 3 балла',
            'pok2_1' => '2.1 Распространение педагогического опыта учреждения в профессиональном сообществе через проведение семинаров, конференций, организованных самим образовательным учреждением: на муниципальном уровне или на уровне «образовательного округа» – 1 балл; на областном уровне – 2 балла; на российском или международном уровнях – 3 балла',
            'pok2_2' => '2.2 Наличие публикаций руководителя по распространению педагогического опыта учреждения в профессиональном сообществе – 1 балл',
            'pok2_3' => '2.3 Наличие достижений (награды, гранты) у педагогического коллектива (индивидуальные и/или коллективные) по внедрению в практику современных образовательных технологий: на уровне «образовательного округа» – 1 балл; на уровне области – 2 балла; на российском и/или международном уровнях – 3 балла',
            'pok2_4' => '2.4 Наличие сайта образовательного учреждения, обновляемого не реже 1 раза в  месяц – 3 балла',
            'pok2_5' => '2.5 Наличие электронного документооборота с органами управления образованием с использованием сети Интернет – 1 балл',
            'pok3_1' => '3.1 Наличие групп кратковременного пребывания воспитанников в различных вариантах: 1 балл за группу (но не более 3 баллов)',
            'pok4_1' => '4.1 Наличие действующей программы развития (срок действия – не менее 3-х лет), утверждённой органом самоуправления образовательного учреждения – 2 балла',
            'pok4_2' => '4.2 Наличие публичного отчёта о деятельности учреждения за год, включая информацию о расходовании внебюджетных средств (в СМИ, в сети Интернет) – 2 балла',
            'pok4_3' => '4.3 Наличие органа самоуправления образовательного учреждения, участниками которого являются педагоги, а также родители и сторонние лица и/или организации – 1 балл',
            'pok4_4' => '4.4 Наличие у органа самоуправления учреждением (согласно устава) прав в инициировании и согласования следующих изменений: содержания образовательного процесса и режима работы образовательного учреждения, стратегии и тактики его развития – 3 балла',
            'pok4_5' => '4.5 Наличие договоров и планов совместной работы с различными учреждениями, организациями (не менее 5 учреждений, организаций) – 1 балл',
            'pok4_6' => '4.6 Наличие позитивных материалов в СМИ о деятельности учреждения: на муниципальном уровне или уровне «образовательного округа» – 1 балл; на уровне области – 2 балла; на федеральном уровне – 3 балла',
            'pok4_7' => '4.7 Деятельность учреждения в режиме ресурсной (экспериментальной, опорной и т.д.) площадки (при наличии подтверждающих документов): на уровне «образовательного округа» – 1 балл, на региональном уровне и выше – 2 балла',
            'pok4_8' => '4.8 Участие руководителя ДОУ в составе экспертных (рабочих и т.п.) групп: на уровне «образовательного округа» – 1 балл, на региональном уровне и выше – 2 балла',
            'pok4_9' => '4.9 Отсутствие обоснованных обращений родителей воспитанников по поводу конфликтных ситуаций – 1 балл',
            'pok5_1' => '5.1 Наличие у образовательного учреждения программы, пропагандирующей здоровый образ жизни – 1 балл',
            'pok5_2' => '5.2 Отсутствие предписаний, замечаний и обоснованных жалоб в части организации охраны жизни и здоровья обучающихся и сотрудников, не связанных с капитальным вложением средств – 2 балла',
            'pok5_3' => '5.3 Снижение или стабильно низкий уровень заболеваемости воспитанников: снижение – 1 балл, уровень заболеваемости воспитанников ниже среднего по муниципальному образованию – 2 балла',
            'pok5_4' => '5.4 Отсутствие травматизма среди воспитанников и работников учреждения во время образовательно-воспитательного  процесса – 1 балл',
            'pok5_5' => '5.5 Отсутствие замечаний и обоснованных жалоб к организации и качеству питания, в том числе к соблюдению норм физиологического питания – 1 балл',
            'pok6_1' => '6.1 Наличие не менее чем у 50 % педагогических работников (включая совместителей) квалификационных категорий – 1 балл',
            'pok6_2' => '6.2 Доля педагогических работников, прошедших обучение на курсах повышения квалификации в объёме не менее 72 часов: от 10% до 20% от общего числа – 1 балл; 20 % и более – 2 балла',
            'pok6_3' => '6.3 Число уволившихся педагогических работников по собственному желанию составляет 3 и более человек (за исключением лиц пенсионного возраста) – (-1) балл',
            'pok6_4' => '6.4 Результативность участия педагогических работников в конкурсах профессионального мастерства: участие  на уровне «образовательного округа» – 0,5 балла, наличие победителей и призеров на уровне «образовательного округа» – 1 балл, участие на областном уровне – 1,5 балла, наличие победителей на областном уровне и выше – 2 балла',
            'pok6_5' => '6.5 Наличие в образовательном учреждении молодых специалистов, принятых на работу на основе ученического договора – 1 балл',
            'pok6_6' => '6.6 Оборудование, поставленное за счёт средств бюджета, не используется спустя месяц с момента поставки в учреждение – (-3) балла',
            'pok6_7' => '6.7 Наличие кредиторских задолженностей и остатков средств на счетах учреждения на конец календарного года – (- 1) балл',
            'pok6_8' => '6.8 Отсутствие замечаний по итогам ревизий и других проверок по вопросам финансово-хозяйственной деятельности – 1 балл',
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
        $criteria->compare('pok2_1',$this->pok2_1);
        $criteria->compare('pok2_2',$this->pok2_2);
        $criteria->compare('pok2_3',$this->pok2_3);
        $criteria->compare('pok2_4',$this->pok2_4);
        $criteria->compare('pok2_5',$this->pok2_5);
        $criteria->compare('pok3_1',$this->pok3_1);
        $criteria->compare('pok4_1',$this->pok4_1);
        $criteria->compare('pok4_2',$this->pok4_2);
        $criteria->compare('pok4_3',$this->pok4_3);
        $criteria->compare('pok4_4',$this->pok4_4);
        $criteria->compare('pok4_5',$this->pok4_5);
        $criteria->compare('pok4_6',$this->pok4_6);
        $criteria->compare('pok4_7',$this->pok4_7);
        $criteria->compare('pok4_8',$this->pok4_8);
        $criteria->compare('pok4_9',$this->pok4_9);
        $criteria->compare('pok5_1',$this->pok5_1);
        $criteria->compare('pok5_2',$this->pok5_2);
        $criteria->compare('pok5_3',$this->pok5_3);
        $criteria->compare('pok5_4',$this->pok5_4);
        $criteria->compare('pok5_5',$this->pok5_5);
        $criteria->compare('pok6_1',$this->pok6_1);
        $criteria->compare('pok6_2',$this->pok6_2);
        $criteria->compare('pok6_3',$this->pok6_3);
        $criteria->compare('pok6_4',$this->pok6_4);
        $criteria->compare('pok6_5',$this->pok6_5);
        $criteria->compare('pok6_6',$this->pok6_6);
        $criteria->compare('pok6_7',$this->pok6_7);
        $criteria->compare('pok6_8',$this->pok6_8);
        $criteria->compare('remark',$this->remark,true);

        return new CActiveDataProvider(get_class($this), array(
            'criteria'=>$criteria,
        ));
    }
}
