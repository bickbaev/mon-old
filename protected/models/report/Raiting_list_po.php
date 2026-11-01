<?php

/**
 * This is the model class for table "raiting_list_po".
 *
 * The followings are the available columns in table 'raiting_list_po':
 * @property string $id_report
 * @property integer $pok1_1
 * @property integer $pok1_2
 * @property integer $pok1_3
 * @property integer $pok1_4
 * @property integer $pok1_5
 * @property integer $pok1_6
 * @property integer $pok1_7
 * @property integer $pok1_8
 * @property integer $pok2_1
 * @property integer $pok2_2
 * @property double $pok2_3
 * @property integer $pok2_4
 * @property double $pok2_5
 * @property integer $pok2_6
 * @property integer $pok2_7
 * @property integer $pok2_8
 * @property integer $pok3_1
 * @property integer $pok3_2
 * @property integer $pok3_3
 * @property integer $pok3_4
 * @property integer $pok3_5
 * @property integer $pok4_1
 * @property integer $pok4_2
 * @property integer $pok4_3
 * @property integer $pok5_1
 * @property integer $pok5_2
 * @property integer $pok5_3
 * @property integer $pok5_4
 * @property integer $pok5_5
 * @property integer $pok5_6
 * @property integer $pok5_7
 * @property integer $pok5_8
 * @property integer $pok5_9
 * @property integer $pok5_10
 * @property integer $pok5_11
 * @property integer $pok5_12
 * @property integer $pok5_13
 * @property integer $pok5_14
 * @property integer $pok6_1
 * @property double $pok6_2
 * @property integer $pok6_3
 * @property integer $pok6_4
 * @property integer $pok7_1
 * @property integer $pok7_2
 * @property integer $pok7_3
 * @property integer $pok7_4
 * @property integer $pok7_5
 * @property integer $pok7_6
 * @property integer $pok7_7
 * @property integer $pok7_8
 * @property string $remark
 */
class Raiting_list_po extends CActiveRecord
{
    /**
     * Returns the static model of the specified AR class.
     * @return Raiting_list_po the static model class
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
        return 'raiting_list_po';
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
            array('pok1_1, pok1_2, pok1_3, pok1_4, pok1_5, pok1_6, pok1_7, pok1_8, pok2_1, pok2_2, pok2_4, pok2_6, pok2_7, pok2_8, pok3_1, pok3_2, pok3_3, pok3_4, pok3_5, pok4_1, pok4_2, pok4_3, pok5_1, pok5_2, pok5_3, pok5_4, pok5_5, pok5_6, pok5_7, pok5_8, pok5_9, pok5_10, pok5_11, pok5_12, pok5_13, pok5_14, pok6_1, pok6_3, pok6_4, pok7_1, pok7_2, pok7_3, pok7_4, pok7_5, pok7_6, pok7_7, pok7_8', 'numerical', 'integerOnly'=>true),
            array('pok2_3, pok2_5, pok6_2', 'numerical'),
            array('pok1_1', 'numerical', 'min' => -1, 'max' => 2),
            array('pok1_2', 'numerical', 'min' => 0, 'max' => 1),
            array('pok1_3', 'numerical', 'min' => 0, 'max' => 3),
            array('pok1_4', 'numerical', 'min' => 0, 'max' => 2),
            array('pok1_5', 'numerical', 'min' => 0, 'max' => 2),
            array('pok1_6', 'numerical', 'min' => 0, 'max' => 3),
            array('pok1_7', 'numerical', 'min' => 0, 'max' => 2),
            array('pok1_8', 'numerical', 'min' => 0, 'max' => 2),
            array('pok2_1', 'numerical', 'min' => -1, 'max' => 2),
            array('pok2_2', 'numerical', 'min' => 0, 'max' => 1),
            array('pok2_3', 'numerical', 'min' => 0, 'max' => 2),
            array('pok2_4', 'numerical', 'min' => 0, 'max' => 1),
            array('pok2_5', 'numerical', 'min' => 0, 'max' => 2),
            array('pok2_6', 'numerical', 'min' => -2, 'max' => 0),
            array('pok2_7', 'numerical', 'min' => 0, 'max' => 2),
            array('pok2_8', 'numerical', 'min' => 0, 'max' => 2),
            array('pok3_1', 'numerical', 'min' => 0, 'max' => 3),
            array('pok3_2', 'numerical', 'min' => 0, 'max' => 1),
            array('pok3_3', 'numerical', 'min' => 0, 'max' => 3),
            array('pok3_4', 'numerical', 'min' => 0, 'max' => 1),
            array('pok3_5', 'numerical', 'min' => 0, 'max' => 2),
            array('pok4_1', 'numerical', 'min' => 0, 'max' => 3),
            array('pok4_2', 'numerical', 'min' => 0, 'max' => 2),
            array('pok4_3', 'numerical', 'min' => 0, 'max' => 2),
            array('pok5_1', 'numerical', 'min' => 0, 'max' => 4),
            array('pok5_2', 'numerical', 'min' => 0, 'max' => 3),
            array('pok5_3', 'numerical', 'min' => 0, 'max' => 3),
            array('pok5_4', 'numerical', 'min' => 0, 'max' => 1),
            array('pok5_5', 'numerical', 'min' => 0, 'max' => 1),
            array('pok5_6', 'numerical', 'min' => 0, 'max' => 2),
            array('pok5_7', 'numerical', 'min' => 0, 'max' => 3),
            array('pok5_8', 'numerical', 'min' => 0, 'max' => 1),
            array('pok5_9', 'numerical', 'min' => 0, 'max' => 3),
            array('pok5_10', 'numerical', 'min' => 0, 'max' => 1),
            array('pok5_11', 'numerical', 'min' => 0, 'max' => 2),
            array('pok5_12', 'numerical', 'min' => 0, 'max' => 1),
            array('pok5_13', 'numerical', 'min' => 0, 'max' => 1),
            array('pok5_14', 'numerical', 'min' => 0, 'max' => 2),
            array('pok6_1', 'numerical', 'min' => 0, 'max' => 1),
            array('pok6_2', 'numerical', 'min' => 0, 'max' => 2),
            array('pok6_3', 'numerical', 'min' => 0, 'max' => 2),
            array('pok6_4', 'numerical', 'min' => 0, 'max' => 1),
            array('pok7_1', 'numerical', 'min' => 0, 'max' => 2),
            array('pok7_2', 'numerical', 'min' => -1, 'max' => 0),
            array('pok7_3', 'numerical', 'min' => 0, 'max' => 2),
            array('pok7_4', 'numerical', 'min' => 0, 'max' => 2),
            array('pok7_5', 'numerical', 'min' => 0, 'max' => 1),
            array('pok7_6', 'numerical', 'min' => -3, 'max' => 0),
            array('pok7_7', 'numerical', 'min' => -1, 'max' => 0),
            array('pok7_8', 'numerical', 'min' => 0, 'max' => 1),
            array('id_report', 'length', 'max'=>10),
            array('remark', 'safe'),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('id_report, pok1_1, pok1_2, pok1_3, pok1_4, pok1_5, pok1_6, pok1_7, pok1_8, pok2_1, pok2_2, pok2_3, pok2_4, pok2_5, pok2_6, pok2_7, pok2_8, pok3_1, pok3_2, pok3_3, pok3_4, pok3_5, pok4_1, pok4_2, pok4_3, pok5_1, pok5_2, pok5_3, pok5_4, pok5_5, pok5_6, pok5_7, pok5_8, pok5_9, pok5_10, pok5_11, pok5_12, pok5_13, pok5_14, pok6_1, pok6_2, pok6_3, pok6_4, pok7_1, pok7_2, pok7_3, pok7_4, pok7_5, pok7_6, pok7_7, pok7_8, remark', 'safe', 'on'=>'search'),
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
            'pok1_1' => '1.1 Динамика доли  неуспевающих обучающихся: отсутствие неуспевающих – 2 балла, снижение – 1 балл, увеличение – (-1) балл',
            'pok1_2' => '1.2 Отсутствие неуспевающих выпускников по результатам итоговой аттестации – 1 балл',
            'pok1_3' => '1.3 Доля выпускников по профессиям (специальностям) включенным в процедуру сертификации, получивших повышенные разряды составляет: от 5% до 10% – 1 балл, от 10%  до 15% – 2 балла, 15% и выше – 3 балла',
            'pok1_4' => '1.4 Количество выпускников, получивших дипломы с отличием: наличие – 1 балл; рост (по сравнению с предыдущим годом) – 2 балла',
            'pok1_5' => '1.5 Отсутствие неуспевающих выпускников (обучающихся) по результатам ЕГЭ  (в случае прохождения данной формы итоговой аттестации) – 2 балла',
            'pok1_6' => '1.6 Количество обучающихся,  ставших победителями или призёрами конкурсов профессионального мастерства, научно-практических конференций: наличие на уровне области – 1 балл; 3 и более человек на уровне области – 2 балла; наличие на межрегиональном, всероссийском или международном уровнях – 3 балла',
            'pok1_7' => '1.7 Наличие разработанных на базе образовательного учреждения экспериментально-конструкторских разработок, соответствующих сфере деятельности образовательного учреждения – 2 балла',
            'pok1_8' => '1.8 Наличие разработанных на базе образовательного учреждения и внедрённых в образовательный процесс учебно-методических (научно-методических) материалов, рекомендованных к применению в образовательном процессе на федеральном или региональном уровне – 2 балла',
            'pok2_1' => '2.1 Число несовершеннолетних обучающихся, поставленных на учёт в комиссии по делам несовершеннолетних: отсутствие – 2 балла; снижение – 1 балл, повышение – (-1) балл',
            'pok2_2' => '2.2 Наличие в образовательном учреждении молодежных объединений или организаций  (при наличии локального акта) – 1 балл',
            'pok2_3' => '2.3 Наличие символики, созданной образовательным учреждением и утверждённой локальными актами (баллы могут суммироваться): гимн – 1 балл; герб – 0,5 балла; флаг – 0,5 балла',
            'pok2_4' => '2.4 Наличие ученического (студенческого) органа самоуправления, установленного уставом учреждения – 1 балл',
            'pok2_5' => '2.5 Количество обучающихся (в личном первенстве) и/или команд, организованных образовательным учреждением, ставших победителями или призёрами спортивных соревнований, конкурсов, фестивалей и др. (за исключением конкурсов профессионального мастерства и научно-практических конференций): наличие на уровне «образовательного округа» – 1 балл; 3 и более на уровне «образовательного округа» – 1,5 балла; наличие на уровне области – 1,5 балла; 3 и более на уровне области – 2 балла; наличие на всероссийском или международном уровне – 2 балла ',
            'pok2_6' => '2.6 Количество обучающихся, не посещающих учебные занятия по неуважительным причинам более 1 месяца: 5 и более человек – (-2) балла.',
            'pok2_7' => '2.7 Организация деятельности СМИ образовательного учреждения (баллы могут суммироваться): наличие газеты (тиражируемой), выходящей не реже 1 раза в месяц – 1 балл; наличие телестудии – 1 балл',
            'pok2_8' => '2.8 Результаты участия обучающихся в социальных проектах: победы в муниципальных или областных конкурсах – 1 балл; победы на всероссийских или международных конкурсах – 2 балла',
            'pok3_1' => '3.1 Распространение педагогического опыта учреждения в профессиональном сообществе через проведение семинаров, конференций, организованных самим образовательным учреждением: на муниципальном уровне или на уровне «образовательного округа» – 1 балл; на областном уровне – 2 балла; на российском или международном уровнях – 3 балла',
            'pok3_2' => '3.2 Наличие публикаций руководителя по распространению педагогического опыта учреждения в профессиональном сообществе – 1 балл',
            'pok3_3' => '3.3 Наличие достижений (награды, гранты) у педагогического коллектива (индивидуальные и/или коллективные) по внедрению в практику современных образовательных технологий: на уровне «образовательного округа» – 1 балл; на уровне области – 2 балла; на российском и/или международном уровнях – 3 балла',
            'pok3_4' => '3.4 Наличие сайта образовательного учреждения, обновляемого не реже 1 раза в  месяц – 1 балл',
            'pok3_5' => '3.5 Доля учебных кабинетов, оборудованных компьютером для работы преподавателя на уроке: от 25 до 50 % – 1 балл; 50 % и выше – 2 балла',
            'pok4_1' => '4.1 Изменение доли учащихся по окончании учебного года от их общего числа в начале учебного года: сохранение контингента – 2 балла, увеличение контингента на 3% и выше – 3 балла',
            'pok4_2' => '4.2 Организация на базе учреждения курсов в рамках предпрофильной подготовки учащихся 9-х классов общеобразовательных школ – 2 балла',
            'pok4_3' => '4.3 Организация на базе учреждения профильных (элективных) курсов в рамках профильного обучения для учащихся 10-11 классов общеобразовательных школ – 2 балла',
            'pok5_1' => '5.1 Выполнение государственного регионального задания (контрольных цифр приема обучающихся) на подготовку квалифицированных рабочих и специалистов – 4 балла',
            'pok5_2' => '5.2 Организация обучения граждан с полным возмещением затрат (% от контингента обучающихся, осваивающих основные профессиональные образовательные программы за счет средств областного бюджета): от 10% до 20% – 1 балл, от 20% до 30% – 2 балла, 30% и более – 3 балла',
            'pok5_3' => '5.3 Введение в отчетном периоде новых профессий, (специальностей): 1 балл за каждую (всего – не более 3 баллов)',
            'pok5_4' => '5.4 Наличие действующей программы развития (срок действия – не менее 3-х лет), согласованной с органом самоуправления образовательного учреждения – 1 балл',
            'pok5_5' => '5.5 Наличие органа самоуправления учреждением, участниками которого являются все представители образовательного процесса (педагоги, обучающиеся, родители, сторонние лица и/или организации) – 1 балл',
            'pok5_6' => '5.6 Наличие у органа самоуправления учреждением (согласно устава) прав инициирования  и согласования следующих изменений: открытие новых профессий (специальностей), режима работы образовательного учреждения, стратегии и тактики его развития – 2 балла',
            'pok5_7' => '5.7 Организация производственной практики на предприятиях различных форм собственности и отраслевой направленности: 1-3 предприятия – 1 балл, 4-6 предприятий – 2 балла, 7 и более предприятий – 3 балла',
            'pok5_8' => '5.8 аличие договоров и планов совместной работы с различными учреждениями, организациями (не менее 5 учреждений, организаций) (за исключением договоров на прохождение производственной практики) – 1 балл',
            'pok5_9' => '5.9 аличие позитивных материалов в СМИ о деятельности учреждения: на уровне «образовательного округа» – 1 балл; на уровне области – 2 балла; на федеральном уровне – 3 балла',
            'pok5_10' => '5.10  Деятельность учреждения в режиме ресурсной (экспериментальной, опорной и т.д.) площадки (при наличии подтверждающих документов) – 1 балл',
            'pok5_11' => '5.11 Участие руководителя образовательного учреждения в составе экспертных (рабочих и т.п.) групп: на уровне «образовательного округа» – 1 балл, на региональном уровне и выше – 2 балла. ',
            'pok5_12' => '5.12 Отсутствие обоснованных обращений обучающихся, родителей, педагогов по поводу конфликтных ситуаций – 1 балл',
            'pok5_13' => '5.13 Многообразие системы профессиональной подготовки по дополнительным программам (на основе хоздоговоров) реализация не менее 7-ми программ  – 1 балл',
            'pok5_14' => '5.14 Наличие публичного отчёта о деятельности образовательного учреждения (включая информацию о поступлении и расходовании финансовых и материальных средств) за прошедший учебный год в СМИ, в сети Интернет – 2 балла',
            'pok6_1' => '6.1 Наличие у образовательного учреждения программы, пропагандирующей здоровый образ жизни – 1 балл',
            'pok6_2' => '6.2 Доля внебюджетных средств, направленных на укрепление здоровья участников образовательного процесса – 0,5 баллов за каждые 25 %',
            'pok6_3' => '6.3 Отсутствие предписаний, замечаний и обоснованных жалоб в части организации охраны жизни и здоровья обучающихся и сотрудников, не связанных с капитальным вложением средств – 2 балла',
            'pok6_4' => '6.4 Отсутствие травматизма среди обучающихся и работников учреждения во время образовательного процесса – 1 балл',
            'pok7_1' => '7.1 Доля педагогических работников, прошедших обучение на курсах повышения квалификации в объёме не менее 72 часов: от 10% до 20% от общего числа – 1 балл; 20 % и более – 2 балла',
            'pok7_2' => '7.2 Число уволившихся педагогических работников по собственному желанию составляет 5 и более человек (за исключением лиц пенсионного возраста) – (-1) балл',
            'pok7_3' => '7.3 Результативность участия педагогов (мастеров производственного обучения) в конкурсах профессионального мастерства: участие на областном уровне – 1 балл, наличие победителей на областном уровне и выше – 2 балла',
            'pok7_4' => '7.4 Доля обучающихся, обеспеченных учебниками из фондов образовательного учреждения: от 80 до 90 % – 1 балл; 90 % и выше – 2 балла',
            'pok7_5' => '7.5 Наличие медиатеки, в которую обучающимся организован свободный доступ – 1 балл',
            'pok7_6' => '7.6 Оборудование, поставленное за счёт средств бюджета, не используется спустя месяц с момента поставки в учреждение – (-3) балла',
            'pok7_7' => '7.7 Наличие кредиторских задолженностей и остатков средств на счетах учреждения на конец календарного года – (- 1) балл',
            'pok7_8' => '7.8 Отсутствие замечаний по итогам ревизий и других проверок по вопросам финансово-хозяйственной деятельности – 1 балл',
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
        $criteria->compare('pok2_1',$this->pok2_1);
        $criteria->compare('pok2_2',$this->pok2_2);
        $criteria->compare('pok2_3',$this->pok2_3);
        $criteria->compare('pok2_4',$this->pok2_4);
        $criteria->compare('pok2_5',$this->pok2_5);
        $criteria->compare('pok2_6',$this->pok2_6);
        $criteria->compare('pok2_7',$this->pok2_7);
        $criteria->compare('pok2_8',$this->pok2_8);
        $criteria->compare('pok3_1',$this->pok3_1);
        $criteria->compare('pok3_2',$this->pok3_2);
        $criteria->compare('pok3_3',$this->pok3_3);
        $criteria->compare('pok3_4',$this->pok3_4);
        $criteria->compare('pok3_5',$this->pok3_5);
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
        $criteria->compare('pok5_10',$this->pok5_10);
        $criteria->compare('pok5_11',$this->pok5_11);
        $criteria->compare('pok5_12',$this->pok5_12);
        $criteria->compare('pok5_13',$this->pok5_13);
        $criteria->compare('pok5_14',$this->pok5_14);
        $criteria->compare('pok6_1',$this->pok6_1);
        $criteria->compare('pok6_2',$this->pok6_2);
        $criteria->compare('pok6_3',$this->pok6_3);
        $criteria->compare('pok6_4',$this->pok6_4);
        $criteria->compare('pok7_1',$this->pok7_1);
        $criteria->compare('pok7_2',$this->pok7_2);
        $criteria->compare('pok7_3',$this->pok7_3);
        $criteria->compare('pok7_4',$this->pok7_4);
        $criteria->compare('pok7_5',$this->pok7_5);
        $criteria->compare('pok7_6',$this->pok7_6);
        $criteria->compare('pok7_7',$this->pok7_7);
        $criteria->compare('pok7_8',$this->pok7_8);
        $criteria->compare('remark',$this->remark,true);

        return new CActiveDataProvider(get_class($this), array(
            'criteria'=>$criteria,
        ));
    }
}