<?php

/**
 * This is the model class for table "raiting_list_gimn".
 *
 * The followings are the available columns in table 'raiting_list_gimn':
 * @property string $id_report
 * @property double $pok1_1
 * @property double $pok1_2
 * @property double $pok1_3
 * @property double $pok1_4
 * @property double $pok1_5
 * @property double $pok1_6
 * @property double $pok1_7
 * @property double $pok1_8
 * @property double $pok1_9
 * @property double $pok1_10
 * @property double $pok1_11
 * @property double $pok2_1
 * @property double $pok2_2
 * @property double $pok2_3
 * @property double $pok2_4
 * @property double $pok2_5
 * @property double $pok2_6
 * @property double $pok2_7
 * @property double $pok2_8
 * @property double $pok2_9
 * @property double $pok2_10
 * @property double $pok3_1
 * @property double $pok3_2
 * @property double $pok3_3
 * @property double $pok3_4
 * @property double $pok3_5
 * @property double $pok3_6
 * @property double $pok3_7
 * @property double $pok4_1
 * @property double $pok4_2
 * @property double $pok4_3
 * @property double $pok4_4
 * @property double $pok4_5
 * @property double $pok5_1
 * @property double $pok5_2
 * @property double $pok5_3
 * @property double $pok5_4
 * @property double $pok5_5
 * @property double $pok5_6
 * @property double $pok6_1
 * @property double $pok6_2
 * @property double $pok6_3
 * @property double $pok6_4
 * @property double $pok6_5
 * @property double $pok6_6
 * @property double $pok7_1
 * @property double $pok7_2
 * @property double $pok7_3
 * @property double $pok7_4
 * @property double $pok7_5
 * @property double $pok7_6
 * @property double $pok7_7
 * @property double $pok7_8
 * @property double $pok7_9
 * @property double $pok7_10
 * @property string $remark
 */
class Raiting_list_gimn extends CActiveRecord
{
    /**
     * Returns the static model of the specified AR class.
     * @return RaitingListOu the static model class
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
        return 'raiting_list_gimn';
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
            array('pok1_1, pok1_2, pok1_3, pok1_4, pok1_5, pok1_6, pok1_7, pok1_8, pok1_9, pok1_10, pok1_11, pok2_1, pok2_2, pok2_3, pok2_4, pok2_5, pok2_6, pok2_7, pok2_8, pok2_9, pok2_10, pok3_1, pok3_2, pok3_3, pok3_4, pok3_5, pok3_6, pok3_7, pok4_1, pok4_2, pok4_3, pok4_4, pok4_5, pok5_1, pok5_2, pok5_3, pok5_4, pok5_5, pok5_6, pok6_1, pok6_2, pok6_3, pok6_4, pok6_5, pok6_6, pok7_1, pok7_2, pok7_3, pok7_4, pok7_5, pok7_6, pok7_7, pok7_8, pok7_9, pok7_10', 'numerical'),
            array('pok1_1', 'numerical', 'min' => 0, 'max' => 1),
            array('pok1_2', 'numerical', 'min' => 0, 'max' => 1),
            array('pok1_3', 'numerical', 'min' => 0, 'max' => 2),
            array('pok1_4', 'numerical', 'min' => 0, 'max' => 2),
            array('pok1_5', 'numerical', 'min' => 0, 'max' => 1.5),
            array('pok1_6', 'numerical', 'min' => 0, 'max' => 1.5),
            array('pok1_7', 'numerical', 'min' => 0, 'max' => 2),
            array('pok1_8', 'numerical', 'min' => 0, 'max' => 1.5),
            array('pok1_9', 'numerical', 'min' => 0, 'max' => 1.5),
            array('pok1_10', 'numerical', 'min' => 0, 'max' => 1),
            array('pok1_11', 'numerical', 'min' => 0, 'max' => 3),
            array('pok2_1', 'numerical', 'min' => -1, 'max' => 2),
            array('pok2_2', 'numerical', 'min' => 0, 'max' => 2),
            array('pok2_3', 'numerical', 'min' => 0, 'max' => 2),
            array('pok2_4', 'numerical', 'min' => 0, 'max' => 1),
            array('pok2_5', 'numerical', 'min' => 0, 'max' => 2),
            array('pok2_6', 'numerical', 'min' => 0, 'max' => 1),
            array('pok2_7', 'numerical', 'min' => 0, 'max' => 2),
            array('pok2_8', 'numerical', 'min' => -1, 'max' => 0),
            array('pok2_9', 'numerical', 'min' => 0, 'max' => 2),
            array('pok2_10', 'numerical', 'min' => 0, 'max' => 2),
            array('pok3_1', 'numerical', 'min' => 0, 'max' => 3),
            array('pok3_2', 'numerical', 'min' => 0, 'max' => 1),
            array('pok3_3', 'numerical', 'min' => 0, 'max' => 3),
            array('pok3_4', 'numerical', 'min' => 0, 'max' => 1),
            array('pok3_5', 'numerical', 'min' => 0, 'max' => 1),
            array('pok3_6', 'numerical', 'min' => 0, 'max' => 2),
            array('pok3_7', 'numerical', 'min' => 0, 'max' => 3),
            array('pok4_1', 'numerical', 'min' => 0, 'max' => 2),
            array('pok4_2', 'numerical', 'min' => 0, 'max' => 1),
            array('pok4_3', 'numerical', 'min' => 0, 'max' => 2),
            array('pok4_4', 'numerical', 'min' => 0, 'max' => 4),
            array('pok4_5', 'numerical', 'min' => 0, 'max' => 3),
            array('pok5_1', 'numerical', 'min' => 0, 'max' => 3),
            array('pok5_2', 'numerical', 'min' => 0, 'max' => 3),
            array('pok5_3', 'numerical', 'min' => 0, 'max' => 1),
            array('pok5_4', 'numerical', 'min' => 0, 'max' => 3),
            array('pok5_5', 'numerical', 'min' => 0, 'max' => 2),
            array('pok5_6', 'numerical', 'min' => 0, 'max' => 2),
            array('pok6_1', 'numerical', 'min' => 0, 'max' => 1),
            array('pok6_2', 'numerical', 'min' => 0, 'max' => 2),
            array('pok6_3', 'numerical', 'min' => 0, 'max' => 2),
            array('pok6_4', 'numerical', 'min' => 0, 'max' => 1),
            array('pok6_5', 'numerical', 'min' => 0, 'max' => 2),
            array('pok6_6', 'numerical', 'min' => 0, 'max' => 1),
            array('pok7_1', 'numerical', 'min' => 0, 'max' => 1),
            array('pok7_2', 'numerical', 'min' => 0, 'max' => 2),
            array('pok7_3', 'numerical', 'min' => -1, 'max' => 0),
            array('pok7_4', 'numerical', 'min' => 0, 'max' => 2),
            array('pok7_5', 'numerical', 'min' => 0, 'max' => 1),
            array('pok7_6', 'numerical', 'min' => 0, 'max' => 2),
            array('pok7_7', 'numerical', 'min' => 0, 'max' => 1),
            array('pok7_8', 'numerical', 'min' => -3, 'max' => 3),
            array('pok7_9', 'numerical', 'min' => -1, 'max' => 3),
            array('pok7_10', 'numerical', 'min' => 0, 'max' => 1),
            array('id_report', 'length', 'max' =>10),
            array('remark', 'safe'),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('id_report, pok1_1, pok1_2, pok1_3, pok1_4, pok1_5, pok1_6, pok1_7, pok1_8, pok1_9, pok1_10, pok1_11, pok2_1, pok2_2, pok2_3, pok2_4, pok2_5, pok2_6, pok2_7, pok2_8, pok2_9, pok2_10, pok3_1, pok3_2, pok3_3, pok3_4, pok3_5, pok3_6, pok3_7, pok4_1, pok4_2, pok4_3, pok4_4, pok4_5, pok5_1, pok5_2, pok5_3, pok5_4, pok5_5, pok5_6, pok6_1, pok6_2, pok6_3, pok6_4, pok6_5, pok6_6, pok7_1, pok7_2, pok7_3, pok7_4, pok7_5, pok7_6, pok7_7, pok7_8, pok7_9, pok7_10, remark', 'safe', 'on'=>'search'),
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
            'pok1_1' => '1.1 % успеваемости в выпускных классах ступени начального общего образования: при положительной динамике или сохранении 100 % успеваемости – 1 балл',
            'pok1_2' => '1.2 Положительная динамика качества обучения в выпускных классах ступени начального общего образования – 1 балл',
            'pok1_3' => '1.3 Доля выпускников ступени основного общего образования, получивших аттестаты особого образца: наличие – 1 балл; доля данных выпускников от их общего числа выше средней по «образовательному округу» – 2 балла',
            'pok1_4' => '1.4 Количество выпускников ступени среднего (полного) общего образования, награжденных медалями «За особые успехи в учении»: наличие – 1 балл; доля данных выпускников от их общего числа выше средней по «образовательному округу» – 2 балла',
            'pok1_5' => '1.5 Результаты ЕГЭ выпускников ступени среднего (полного) общего образования (русский язык по 100-бальной шкале): выше средних значений по «образовательному округу» – 1 балл; выше средних значений по области (для сельских школ) – 1,5 балла ',
            'pok1_6' => '1.6 Результаты ЕГЭ выпускников ступени среднего (полного) общего образования (математика по 100-бальной шкале): выше средних значений по «образовательному округу» – 1 балл; выше средних значений по области (для сельских школ) – 1,5 балла',
            'pok1_7' => '1.7 Доля выпускников ступени среднего (полного) общего образования, получивших на итоговой аттестации в форме ЕГЭ 80 и более баллов, от их общего числа: наличие – 1 балл; рост – 2 балла',
            'pok1_8' => '1.8 Результаты выпускников ступени основного общего образования по результатам итоговой аттестации в новой форме (русский язык по 5-бальной шкале): рост – 0,5 балла; выше средних значений по «образовательному округу» – 1 балл; выше средних значений по области (для сельских школ) – 1,5 балла ',
            'pok1_9' => '1.9 Результаты выпускников ступени основного общего образования по результатам итоговой аттестации в новой форме (математика по 5-бальной шкале): рост – 0,5 балла; выше средних значений по «образовательному округу» – 1 балл; выше средних значений по области (для сельских школ) – 1,5 балла',
            'pok1_10' => '1.10 Отсутствие учащихся, оставленных на повторное обучение – 1 балл ',
            'pok1_11' => '1.11 Количество учащихся, ставших победителями или призёрами предметных олимпиад, научно-практических конференций: наличие на уровне «образовательного округа» – 1 балл; 3 и более человек на уровне «образовательного округа» – 1,5 балла; наличие на уровне области – 2 балла; 3 и более человек на уровне области – 2,5 балла; наличие на «зональном», всероссийском или международном уровнях – 3 балла',
            'pok2_1' => '2.1 Число учащихся, поставленных на учёт в комиссии по делам несовершеннолетних: отсутствие – 2 балла; снижение – 1 балл, повышение – (-1) балл',
            'pok2_2' => '2.2 Наличие в образовательном учреждении детских объединений или организаций  (при наличии локального акта) – 2 балла',
            'pok2_3' => '2.3 Наличие символики, созданной школой и утверждённой локальными актами (баллы могут суммироваться): гимн – 1 балл; герб – 0,5 балла; флаг – 0,5 балла',
            'pok2_4' => '2.4 Наличие ученического органа самоуправления, установленного уставом учреждения – 1 балл',
            'pok2_5' => '2.5 Доля учащихся, постоянно занимающихся в системе дополнительного образования общеобразовательного учреждения или на его базе: за каждые 25% – 0,5 балла',
            'pok2_6' => '2.6 Многообразие системы дополнительного образования общеобразовательного учреждения: наличие (по лицензии) и реализация не менее 3-х направлений  – 1 балл',
            'pok2_7' => '2.7 Количество учащихся (в личном первенстве) и/или команд, организованных образовательным учреждением, ставших победителями или призёрами спортивных соревнований, конкурсов, фестивалей и др. (за исключением предметных олимпиад и научно-практических конференций): наличие на муниципальном уровне (за исключением городов Самара и Тольятти) – 0,5 балла; наличие на уровне «образовательного округа» – 1 балл; 3 и более на уровне «образовательного округа» – 1,5 балла; наличие на уровне области – 1,5 балла; 3 и более на уровне области – 2 балла; наличие на всероссийском или международном уровне – 2 балла ',
            'pok2_8' => '2.8 Количество учащихся, не посещающих учебные занятие по неуважительным причинам более 1 месяца: 2 и более человек (для сельской школы) – (-1) балл; 5 и более человек (для городской школы) – (-1) балл',
            'pok2_9' => '2.9 Организация деятельности школьных средств массовой информации (баллы могут суммироваться): наличие школьной газеты (тиражируемой), выходящей не реже 1 раза в месяц – 1 балл; наличие школьной телестудии   – 1 балл',
            'pok2_10' => '2.10 Результаты участия обучающихся в социальных проектах: победы в муниципальных или областных конкурсах – 1 балл; победы на всероссийских или международных конкурсах – 2 балла',
            'pok3_1' => '3.1 Распространение педагогического опыта учреждения в профессиональном сообществе через проведение семинаров, конференций, организованных самим образовательным учреждением: на муниципальном уровне или на уровне «образовательного округа» – 1 балл; на областном уровне – 2 балла; на российском или международном уровнях – 3 балла',
            'pok3_2' => '3.2 Наличие публикаций руководителя по распространению педагогического опыта учреждения в профессиональном сообществе – 1 балл',
            'pok3_3' => '3.3 Наличие достижений (награды, гранты) у педагогического коллектива (индивидуальные и/или коллективные) по внедрению в практику современных образовательных технологий: на уровне «образовательного округа» – 1 балл; на уровне области – 2 балла; на российском и/или международном уровнях – 3 балла',
            'pok3_4' => '3.4 Наличие сайта образовательного учреждения, обновляемого не реже 1 раза в  месяц – 1 балл',
            'pok3_5' => '3.5 Наличие электронного документооборота с органами управления образованием с использованием сети Интернет – 1 балл',
            'pok3_6' => '3.6 Доля учебных кабинетов, оборудованных компьютером для работы учителя на уроке: от 25 до 50 % – 1 балл; 50 % и выше – 2 балла',
            'pok3_7' => '3.7 Обучение учащихся «слепому» печатанию на уроках информатики в течение учебного года или на годичных бесплатных курсах, организованных учреждением (при наличии данных контрольного среза, подтверждающего освоение метода «слепого» печатания  не менее 70% прошедших обучение учащихся): наличие – 3 балла',
            'pok4_1' => '4.1 Изменение доли учащихся на ступени среднего (полного) общего образования по окончании учебного года от их общего числа в начале учебного года: сохранение контингента - 1 балл, увеличение контингента на 3% и выше - 2 балла.',
            'pok4_2' => '4.2 Сохранение количества учащихся по окончании учебного года от их общего числа в начале учебного года (баллы могут суммироваться): в 8-х классах – 0,5 балла, в 9-х классах – 0,5 балла.',
            'pok4_3' => '4.3 Доля профильных классов на ступени среднего (полного) общего образования (за исключением универсального профиля): 50% и выше – 1 балл; 100 % – 2 балла',
            'pok4_4' => '4.4 Наличие индивидуальных учебных планов у обучающихся на ступени среднего (полного) общего образования: у 20%-50% учащихся – 2 балла; у более 50 % учащихся – 3 балла; у 100 % учащихся – 4 балла',
            'pok4_5' => '4.5 Реализация предпрофильной подготовки в 9-х классах: наличие – 1 балл; реализация не менее 10 предпрофильных курсов (для сельской школы) – 3 балла; реализация не менее 15 предпрофильных курсов (для городской школы) – 3 балла',
            'pok5_1' => '5.1 Наличие действующей программы развития (срок действия – не менее 3-х лет), утверждённой органом самоуправления образовательного учреждения – 2 балла',
            'pok5_2' => '5.2 Наличие у органа самоуправления учреждением (согласно устава) прав в определении: содержания школьного компонента и режима работы образовательного учреждения, стратегии и тактики его развития – 3 балла',
            'pok5_3' => '5.3 Наличие договоров и планов совместной работы с различными учреждениями, организациями (не менее 5 учреждений, организаций) – 1 балл',
            'pok5_4' => '5.4 Наличие позитивных материалов в СМИ о деятельности учреждения: на муниципальном уровне или уровне «образовательного округа» – 1 балл; на уровне области – 2 балла; на федеральном уровне – 3 балла',
            'pok5_5' => '5.5 Деятельность учреждения в режиме ресурсной (экспериментальной, опорной и т.д.) площадки (при наличии подтверждающих документов). На уровне «образовательного округа» - 1 балл, на региональном уровне и выше – 2 балла',
            'pok5_6' => '5.6 Участие руководителя образовательного учреждения в составе экспертных (рабочих и т.п.) групп. На уровне округа – 1 балл, на региональном уровне и выше – 2 балла',
            'pok6_1' => '6.1 Наличие у образовательного учреждения программы, пропагандирующей здоровый образ жизни – 1 балл',
            'pok6_2' => '6.2 Доля внебюджетных средств, направленных на укрепление здоровья участников образовательного процесса – 0,5 баллов за каждые 25 %',
            'pok6_3' => '6.3 % охвата учащихся горячим питанием выше, чем в среднем по муниципальному образованию – 1 балл, 80% и более – 2 балла',
            'pok6_4' => '6.4 Наличие в учебном плане образовательного учреждения дополнительного часа для проведения урока двигательной активности за счёт часов школьного компонента: (при охвате не менее 50% классов учреждения) – 1 балл',
            'pok6_5' => '6.5 Отсутствие предписаний и обоснованных жалоб в части организации охраны жизни и здоровья обучающихся и сотрудников, не связанных с капитальным вложением средств – 2 балла',
            'pok6_6' => '6.6 Отсутствие травматизма среди обучающихся и работников учреждения во время образовательного процесса – 1 балл',
            'pok7_1' => '7.1 Наличие не менее чем у 50 % педагогических работников (включая совместителей) квалификационных категорий – 1 балл',
            'pok7_2' => '7.2 Доля педагогических работников, прошедших обучение на курсах повышения квалификации в объёме не менее 72 часов: от 10 до 20% от общего числа – 1 балл; 20 % и более – 2 балла',
            'pok7_3' => '7.3 Число уволившихся педагогов по собственному желанию составляет 3 и более человек (для сельских школ), 5 и более человек (для городских школ) за исключением лиц пенсионного возраста – (-1) балл',
            'pok7_4' => '7.4 Результативность участия педагогов в конкурсах профессионального мастерства: участие  на уровне «образовательного округа» - 0,5 балла, наличие победителей и призеров на уровне «образовательного округа» - 1 балл, участие на областном уровне – 1,5 балла, наличие победителей на областном уровне и выше – 2 балла',
            'pok7_5' => '7.5 Наличие в образовательном учреждении молодых специалистов, принятых на работу на основе ученического договора – 1 балл',
            'pok7_6' => '7.6 Доля учащихся, обеспеченных учебниками из школьных фондов: от 80 до 90% – 1 балл; выше 90% – 2 балла',
            'pok7_7' => '7.7 Наличие медиатеки, в которую учащимся организован свободный доступ – 1 балл',
            'pok7_8' => '7.8 Оборудование, поставленное за счёт средств бюджета, не используется спустя месяц с момента поставки в учреждение –  (-3) балла',
            'pok7_9' => '7.9 Наличие кредиторских задолженностей и остатков средств на счетах учреждения на конец календарного года: (- 1) балл',
            'pok7_10' => '7.10 Отсутствие замечаний по итогам ревизий и других проверок по вопросам финансово-хозяйственной деятельности -  1 балл',
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
        $criteria->compare('pok2_7',$this->pok2_7);
        $criteria->compare('pok2_8',$this->pok2_8);
        $criteria->compare('pok2_9',$this->pok2_9);
        $criteria->compare('pok2_10',$this->pok2_10);
        $criteria->compare('pok3_1',$this->pok3_1);
        $criteria->compare('pok3_2',$this->pok3_2);
        $criteria->compare('pok3_3',$this->pok3_3);
        $criteria->compare('pok3_4',$this->pok3_4);
        $criteria->compare('pok3_5',$this->pok3_5);
        $criteria->compare('pok3_6',$this->pok3_6);
        $criteria->compare('pok3_7',$this->pok3_7);
        $criteria->compare('pok4_1',$this->pok4_1);
        $criteria->compare('pok4_2',$this->pok4_2);
        $criteria->compare('pok4_3',$this->pok4_3);
        $criteria->compare('pok4_4',$this->pok4_4);
        $criteria->compare('pok4_5',$this->pok4_5);
        $criteria->compare('pok5_1',$this->pok5_1);
        $criteria->compare('pok5_2',$this->pok5_2);
        $criteria->compare('pok5_3',$this->pok5_3);
        $criteria->compare('pok5_4',$this->pok5_4);
        $criteria->compare('pok5_5',$this->pok5_5);
        $criteria->compare('pok5_6',$this->pok5_6);
        $criteria->compare('pok6_1',$this->pok6_1);
        $criteria->compare('pok6_2',$this->pok6_2);
        $criteria->compare('pok6_3',$this->pok6_3);
        $criteria->compare('pok6_4',$this->pok6_4);
        $criteria->compare('pok6_5',$this->pok6_5);
        $criteria->compare('pok6_6',$this->pok6_6);
        $criteria->compare('pok7_1',$this->pok7_1);
        $criteria->compare('pok7_2',$this->pok7_2);
        $criteria->compare('pok7_3',$this->pok7_3);
        $criteria->compare('pok7_4',$this->pok7_4);
        $criteria->compare('pok7_5',$this->pok7_5);
        $criteria->compare('pok7_6',$this->pok7_6);
        $criteria->compare('pok7_7',$this->pok7_7);
        $criteria->compare('pok7_8',$this->pok7_8);
        $criteria->compare('pok7_9',$this->pok7_9);
        $criteria->compare('pok7_10',$this->pok7_10);
        $criteria->compare('remark',$this->remark,true);

        return new CActiveDataProvider(get_class($this), array(
            'criteria'=>$criteria,
        ));
    }
}
