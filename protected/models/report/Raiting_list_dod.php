<?php

/**
 * This is the model class for table "raiting_list_dod".
 *
 * The followings are the available columns in table 'raiting_list_dod':
 * @property string $id_report
 * @property integer $pok1_1
 * @property integer $pok1_2
 * @property integer $pok1_3
 * @property integer $pok1_4
 * @property integer $pok1_5
 * @property integer $pok1_6
 * @property integer $pok1_7
 * @property integer $pok1_8
 * @property integer $pok1_9
 * @property integer $pok1_10
 * @property integer $pok2_1
 * @property integer $pok2_2
 * @property integer $pok2_3
 * @property integer $pok2_4
 * @property integer $pok2_5
 * @property integer $pok3_1
 * @property integer $pok3_2
 * @property integer $pok3_3
 * @property integer $pok3_4
 * @property integer $pok3_5
 * @property integer $pok3_6
 * @property integer $pok3_7
 * @property integer $pok3_8
 * @property integer $pok3_9
 * @property double $pok3_10
 * @property integer $pok4_1
 * @property integer $pok4_2
 * @property integer $pok4_3
 * @property integer $pok5_1
 * @property integer $pok5_2
 * @property integer $pok5_3
 * @property double $pok5_4
 * @property integer $pok5_5
 * @property integer $pok5_6
 * @property integer $pok5_7
 * @property integer $pok5_8
 * @property integer $pok5_9
 * @property string $remark
 */
class Raiting_list_dod extends CActiveRecord
{
    /**
     * Returns the static model of the specified AR class.
     * @return Raiting_list_dod the static model class
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
        return 'raiting_list_dod';
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
            array('pok1_1, pok1_2, pok1_3, pok1_4, pok1_5, pok1_6, pok1_7, pok1_8, pok1_9, pok1_10, pok2_1, pok2_2, pok2_3, pok2_4, pok2_5, pok3_1, pok3_2, pok3_3, pok3_4, pok3_5, pok3_6, pok3_7, pok3_8, pok3_9, pok4_1, pok4_2, pok4_3, pok5_1, pok5_2, pok5_3, pok5_5, pok5_6, pok5_7, pok5_8, pok5_9', 'numerical', 'integerOnly'=>true),
            array('pok3_10, pok5_4', 'numerical'),
            array('pok1_1', 'numerical', 'min' => 0, 'max' => 5),
            array('pok1_2', 'numerical', 'min' => 0, 'max' => 2),
            array('pok1_3', 'numerical', 'min' => 0, 'max' => 2),
            array('pok1_4', 'numerical', 'min' => 0, 'max' => 2),
            array('pok1_5', 'numerical', 'min' => 0, 'max' => 4),
            array('pok1_6', 'numerical', 'min' => 0, 'max' => 2),
            array('pok1_7', 'numerical', 'min' => 0, 'max' => 2),
            array('pok1_8', 'numerical', 'min' => 0, 'max' => 2),
            array('pok1_9', 'numerical', 'min' => 0, 'max' => 3),
            array('pok1_10', 'numerical', 'min' => 0, 'max' => 2),
            array('pok2_1', 'numerical', 'min' => 0, 'max' => 3),
            array('pok2_2', 'numerical', 'min' => 0, 'max' => 1),
            array('pok2_3', 'numerical', 'min' => 0, 'max' => 3),
            array('pok2_4', 'numerical', 'min' => 0, 'max' => 1),
            array('pok2_5', 'numerical', 'min' => 0, 'max' => 1),
            array('pok3_1', 'numerical', 'min' => 0, 'max' => 2),
            array('pok3_2', 'numerical', 'min' => 0, 'max' => 2),
            array('pok3_3', 'numerical', 'min' => 0, 'max' => 1),
            array('pok3_4', 'numerical', 'min' => 0, 'max' => 3),
            array('pok3_5', 'numerical', 'min' => 0, 'max' => 1),
            array('pok3_6', 'numerical', 'min' => 0, 'max' => 3),
            array('pok3_7', 'numerical', 'min' => 0, 'max' => 2),
            array('pok3_8', 'numerical', 'min' => 0, 'max' => 2),
            array('pok3_9', 'numerical', 'min' => 0, 'max' => 1),
            array('pok3_10', 'numerical', 'min' => 0, 'max' => 10),
            array('pok4_1', 'numerical', 'min' => 0, 'max' => 2),
            array('pok4_2', 'numerical', 'min' => 0, 'max' => 1),
            array('pok4_3', 'numerical', 'min' => 0, 'max' => 1),
            array('pok5_1', 'numerical', 'min' => 0, 'max' => 2),
            array('pok5_2', 'numerical', 'min' => 0, 'max' => 2),
            array('pok5_3', 'numerical', 'min' => -1, 'max' => 0),
            array('pok5_4', 'numerical', 'min' => 0, 'max' => 2),
            array('pok5_5', 'numerical', 'min' => 0, 'max' => 1),
            array('pok5_6', 'numerical', 'min' => 0, 'max' => 1),
            array('pok5_7', 'numerical', 'min' => -3, 'max' => 0),
            array('pok5_8', 'numerical', 'min' => -1, 'max' => 0),
            array('pok5_9', 'numerical', 'min' => 0, 'max' => 1),
            array('id_report', 'length', 'max'=>10),
            array('remark', 'safe'),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('id_report, pok1_1, pok1_2, pok1_3, pok1_4, pok1_5, pok1_6, pok1_7, pok1_8, pok1_9, pok1_10, pok2_1, pok2_2, pok2_3, pok2_4, pok2_5, pok3_1, pok3_2, pok3_3, pok3_4, pok3_5, pok3_6, pok3_7, pok3_8, pok3_9, pok3_10, pok4_1, pok4_2, pok4_3, pok5_1, pok5_2, pok5_3, pok5_4, pok5_5, pok5_6, pok5_7, pok5_8, pok5_9, remark', 'safe', 'on'=>'search'),
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
            'pok1_1' => '1.1 Результативность обеспечения повышения уровня подготовленности обучающихся (выполнение контрольно-переводных нормативов, выполнение спортивных разрядов) за отчетный период: массовые разряды (не менее 10 уч-ся) – 1 балл; 1 разряд: наличие – 1 балл, 5 и более уч-ся – 2 балла;  КМС: наличие – 2 балла, 3 и более уч-ся – 3 балла;  МС: наличие – 3 балла, 2 и более – 4 балла; МСМК, ЗМС: наличие – 5 баллов ',
            'pok1_2' => '1.2 Реализация авторских образовательных программ: от 10% до 20% – 1 балл, 20% и выше – 2 балла',
            'pok1_3' => '1.3 Доля реализуемых авторских образовательных программ, обеспеченных УМК: от20% до 50% – 1 балл, 50% и выше – 2 балла',
            'pok1_4' => '1.4 Наличие детских (детско-молодежных) объединений, имеющих  звания «образцовый коллектив», групп спортивного совершенствования  и групп высшего спортивного мастерства: 1-2 объединения (группы) – 1 балл, 3 и более объединений (групп) – 2 балла',
            'pok1_5' => '1.5 Наличие победителей, призёров (обучающихся, команд обучающихся) в конкурсах, фестивалях, соревнованиях и т.д.: наличие на уровне «образовательного округа» – 1 балл; 3 и более на уровне «образовательного округа» – 2 балла; наличие на уровне области – 2 балла; 3 и более на уровне области – 3 балла; наличие на всероссийском или международном уровне – 4 балла',
            'pok1_6' => '1.6 Сохранность контингента обучающихся в объединениях (группах) образовательного учреждения в течение учебного года: от 80% до 90% – 1 балл, 90% и выше – 2 балла',
            'pok1_7' => '1.7 Организация на базе учреждения курсов в рамках  предпрофильной подготовки учащихся 9-х классов общеобразовательных школ – 2 балла',
            'pok1_8' => '1.8 Организация на базе учреждения профильных (элективных) курсов в рамках профильного обучения для учащихся 10-11 классов общеобразовательных школ – 2 балла',
            'pok1_9' => '1.9 Охват учащихся старше 14 лет от общего числа занимающихся в объединениях: от 15% до 25% – 1 балл, от 25% до 35% – 2 балла, 35% и выше – 3 балла',
            'pok1_10' => '1.10 Наличие в образовательном учреждении детских (молодёжных) объединений или организаций (при наличии локального акта) – 2 балла',
            'pok2_1' => '2.1 Распространение педагогического опыта учреждения в профессиональном сообществе через проведение семинаров, конференций, организованных самим образовательным учреждением: на муниципальном уровне или на уровне «образовательного округа» – 1 балл; на областном уровне – 2 балла; на российском или международном уровнях – 3 балла',
            'pok2_2' => '2.2 Наличие публикаций руководителя по распространению педагогического опыта образовательного учреждения в профессиональном сообществе – 1 балл',
            'pok2_3' => '2.3 Наличие достижений (награды, гранты) у педагогического коллектива (индивидуальные и/или коллективные) по внедрению в практику современных образовательных технологий: на уровне «образовательного округа» – 1 балл; на уровне области – 2 балла; на российском и/или международном уровнях – 3 балла',
            'pok2_4' => '2.4 Наличие сайта образовательного учреждения, обновляемого не реже 1 раза в месяц – 1 балл',
            'pok2_5' => '2.5 Наличие электронного документооборота с органами управления образованием с использованием сети Интернет – 1 балл',
            'pok3_1' => '3.1 Наличие действующей программы развития (срок действия – не менее 3-х лет), согласованной с органом самоуправления образовательного учреждения – 2 балла',
            'pok3_2' => '3.2 Наличие публичного отчёта о деятельности учреждения за год, включая информацию о расходовании внебюджетных средств (в СМИ, в сети Интернет) – 2 балла',
            'pok3_3' => '3.3 Наличие органа самоуправления учреждением, участниками которого являются все представители образовательного процесса (педагоги, родители, учащиеся, сторонние лица и/или организации) – 1 балл',
            'pok3_4' => '3.4 Наличие у органа самоуправления учреждением (согласно устава) прав инициирования и согласования следующих изменений: содержания образовательного процесса и режима работы образовательного учреждения, стратегии и тактики его развития – 3 балла',
            'pok3_5' => '3.5 Наличие договоров и планов совместной работы с различными учреждениями, организациями (не менее 10 учреждений, организаций) – 1 балл',
            'pok3_6' => '3.6 Наличие позитивных материалов в СМИ о деятельности учреждения: на муниципальном уровне или уровне «образовательного округа» – 1 балл; на уровне области – 2 балла; на федеральном уровне – 3 балла',
            'pok3_7' => '3.7 Деятельность учреждения в режиме ресурсной (экспериментальной, опорной и т.д.) площадки (при наличии подтверждающих документов): на уровне «образовательного округа» – 1 балл, на региональном уровне и выше – 2 балла',
            'pok3_8' => '3.8 Участие руководителя образовательного учреждения в составе экспертных (рабочих и т.п.) групп: на уровне «образовательного округа» – 1 балл, на региональном уровне и выше – 2 балла',
            'pok3_9' => '3.9 Отсутствие обоснованных обращений родителей по поводу конфликтных ситуаций – 1 балл',
            'pok3_10' => '3.10 Организация и проведение массовых мероприятий (профильных смен, учебно-тренировочных сборов и т.п.) (баллы могут суммироваться): на уровне «образовательного округа» – 0,5 балла за каждое мероприятие (но не более 2 баллов), на региональном уровне и выше – 2 балла за каждое мероприятие (но не более 8 баллов)',
            'pok4_1' => '4.1 Отсутствие предписаний, замечаний и обоснованных жалоб в части организации охраны жизни и здоровья обучающихся и сотрудников, не связанных с капитальным вложением средств – 2 балла',
            'pok4_2' => '4.2 Отсутствие травматизма среди воспитанников и работников учреждения во время образовательно-воспитательного  процесса – 1 балл',
            'pok4_3' => '4.3 Наличие и реализация в учреждении программы, направленной на формирование здоровьесберегающего образовательного пространства – 1 балл',
            'pok5_1' => '5.1 Доля педагогических работников (включая совместителей), имеющих квалификационные категории: от 50% до 70% – 1 балл, 70% и выше – 2 балла',
            'pok5_2' => '5.2 Доля педагогических работников, прошедших обучение на курсах повышения квалификации в объёме не менее 72 часов: от 10% до 20% от общего числа – 1 балл; 20% и более – 2 балла',
            'pok5_3' => '5.3 Число уволившихся педагогических работников по собственному желанию составляет 3 и более человек для сельских учреждений, 5 и более человек для городских учреждений за исключением лиц пенсионного возраста – (-1) балл',
            'pok5_4' => '5.4 Результативность участия педагогических работников в конкурсах профессионального мастерства: участие  на уровне «образовательного округа» – 0,5 балла, наличие победителей и призеров на уровне «образовательного округа» – 1 балл, участие на областном уровне – 1,5 балла, наличие победителей на областном уровне и выше – 2 балла',
            'pok5_5' => '5.5 Наличие в образовательном учреждении молодых специалистов, принятых на работу на основе ученического договора – 1 балл',
            'pok5_6' => '5.6 Наличие библиотеки (медиатеки), в которую организован свободный доступ – 1 балл',
            'pok5_7' => '5.7 Оборудование, поставленное за счёт средств бюджета, не используется спустя месяц с момента поставки в учреждение –  (-3) балла',
            'pok5_8' => '5.8 Наличие кредиторских задолженностей и остатков средств на счетах учреждения на конец календарного года – (- 1) балл',
            'pok5_9' => '5.9 Отсутствие замечаний по итогам ревизий и других проверок по вопросам финансово-хозяйственной деятельности – 1 балл',
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
        $criteria->compare('pok2_1',$this->pok2_1);
        $criteria->compare('pok2_2',$this->pok2_2);
        $criteria->compare('pok2_3',$this->pok2_3);
        $criteria->compare('pok2_4',$this->pok2_4);
        $criteria->compare('pok2_5',$this->pok2_5);
        $criteria->compare('pok3_1',$this->pok3_1);
        $criteria->compare('pok3_2',$this->pok3_2);
        $criteria->compare('pok3_3',$this->pok3_3);
        $criteria->compare('pok3_4',$this->pok3_4);
        $criteria->compare('pok3_5',$this->pok3_5);
        $criteria->compare('pok3_6',$this->pok3_6);
        $criteria->compare('pok3_7',$this->pok3_7);
        $criteria->compare('pok3_8',$this->pok3_8);
        $criteria->compare('pok3_9',$this->pok3_9);
        $criteria->compare('pok3_10',$this->pok3_10);
        $criteria->compare('pok4_1',$this->pok4_1);
        $criteria->compare('pok4_2',$this->pok4_2);
        $criteria->compare('pok4_3',$this->pok4_3);
        $criteria->compare('pok5_1',$this->pok5_1);
        $criteria->compare('pok5_2',$this->pok5_2);
        $criteria->compare('pok5_3',$this->pok5_3);
        $criteria->compare('pok5_4',$this->pok5_4);
        $criteria->compare('pok5_5',$this->pok5_5);
        $criteria->compare('pok5_6',$this->pok5_6);
        $criteria->compare('pok5_7',$this->pok5_7);
        $criteria->compare('pok5_8',$this->pok5_8);
        $criteria->compare('pok5_9',$this->pok5_9);
        $criteria->compare('remark',$this->remark,true);

        return new CActiveDataProvider(get_class($this), array(
            'criteria'=>$criteria,
        ));
    }
} 