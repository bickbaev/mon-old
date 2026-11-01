<?php

/**
 * This is the model class for table "site2022_spo".
 *
 * The followings are the available columns in table 'site2022_spo':
 * @property string $id_report
 * @property string $site2
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
 * @property string $pok25
 * @property string $pok26
 * @property string $pok27
 * @property string $pok28
 * @property string $pok29
 * @property string $pok30
 * @property string $pok31
 * @property string $pok32
 * @property string $pok33
 * @property string $pok34
 * @property string $pok35
 * @property string $pok36
 * @property string $pok37
 * @property string $pok38
 * @property string $pok39
 * @property string $pok40
 * @property string $pok41
 * @property string $pok42
 * @property string $pok43
 * @property string $pok44
 * @property string $pok45
 * @property string $pok46
 * @property string $pok47
 * @property string $pok48
 * @property string $pok49
 * @property string $pok50
 * @property string $pok51
 * @property string $pok52
 * @property string $pok53
 * @property string $pok54
 * @property string $pok55
 * @property string $pok56
 * @property string $pok57
 * @property string $pok58
 * @property string $pok59
 * @property string $pok60
 * @property string $pok61
 * @property string $pok62
 * @property string $pok63
 * @property string $pok64
 * @property string $pok65
 * @property string $pok66
 * @property string $pok67
 * @property string $pok68
 * @property string $pok69
 * @property string $pok70
 * @property string $pok71
 * @property string $pok72
 * @property string $pok73
 * @property string $pok74
 * @property string $pok75
 * @property string $pok76
 * @property string $pok77
 * @property string $pok78
 * @property string $pok79
 * @property string $pok80
 * @property string $pok81
 * @property string $pok82
 * @property string $pok83
 * @property string $pok84
 * @property string $pok85
 * @property string $pok86
 * @property string $pok87
 * @property string $pok88
 * @property string $pok89
 * @property string $pok90
 * @property string $pok91
 * @property string $pok92
 * @property string $pok93
 * @property string $pok94
 * @property string $pok95
 * @property string $pok96
 * @property string $pok97
 * @property string $pok98
 * @property string $pok99
 * @property string $pok100
 * @property string $p_date
 * @property string $red
 * @property string $remark
 */
class Site2022_spo extends CActiveRecord
{
    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return 'site2022_spo';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('site2, red', 'length', 'max'=>255),
            array('pok1, pok2, pok3, pok4, pok5, pok6, pok7, pok8, pok9, pok10, pok11, pok12, pok13, pok14, pok15, pok16, pok17, pok18, pok19, pok20, pok21, pok22, pok23, pok24, pok25, pok26, pok27, pok28, pok29, pok30, pok31, pok32, pok33, pok34, pok35, pok36, pok37, pok38, pok39, pok40, pok41, pok42, pok43, pok44, pok45, pok46, pok47, pok48, pok49, pok50, pok51, pok52, pok53, pok54, pok55, pok56, pok57, pok58, pok59, pok60, pok61, pok62, pok63, pok64, pok65, pok66, pok67, pok68, pok69, pok70, pok71, pok72, pok73, pok74, pok75, pok76, pok77, pok78, pok79, pok80, pok81, pok82, pok83, pok84, pok85, pok86, pok87, pok88, pok89, pok90, pok91, pok92, pok93, pok94, pok95, pok96, pok97, pok98, pok99, pok100, p_date, remark', 'safe'),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('id_report, site2, pok1, pok2, pok3, pok4, pok5, pok6, pok7, pok8, pok9, pok10, pok11, pok12, pok13, pok14, pok15, pok16, pok17, pok18, pok19, pok20, pok21, pok22, pok23, pok24, pok25, pok26, pok27, pok28, pok29, pok30, pok31, pok32, pok33, pok34, pok35, pok36, pok37, pok38, pok39, pok40, pok41, pok42, pok43, pok44, pok45, pok46, pok47, pok48, pok49, pok50, pok51, pok52, pok53, pok54, pok55, pok56, pok57, pok58, pok59, pok60, pok61, pok62, pok63, pok64, pok65, pok66, pok67, pok68, pok69, pok70, pok71, pok72, pok73, pok74, pok75, pok76, pok77, pok78, pok79, pok80, pok81, pok82, pok83, pok84, pok85, pok86, pok87, pok88, pok89, pok90, pok91, pok92, pok93, pok94, pok95, pok96, pok97, pok98, pok99, pok100, p_date, red, remark', 'safe', 'on'=>'search'),
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
            'site2' => 'Site2',
            'pok1' => 'Pok1',
            'pok2' => 'Pok2',
            'pok3' => 'Pok3',
            'pok4' => 'Pok4',
            'pok5' => 'Pok5',
            'pok6' => 'Pok6',
            'pok7' => 'Pok7',
            'pok8' => 'Pok8',
            'pok9' => 'Pok9',
            'pok10' => 'Pok10',
            'pok11' => 'Pok11',
            'pok12' => 'Pok12',
            'pok13' => 'Pok13',
            'pok14' => 'Pok14',
            'pok15' => 'Pok15',
            'pok16' => 'Pok16',
            'pok17' => 'Pok17',
            'pok18' => 'Pok18',
            'pok19' => 'Pok19',
            'pok20' => 'Pok20',
            'pok21' => 'Pok21',
            'pok22' => 'Pok22',
            'pok23' => 'Pok23',
            'pok24' => 'Pok24',
            'pok25' => 'Pok25',
            'pok26' => 'Pok26',
            'pok27' => 'Pok27',
            'pok28' => 'Pok28',
            'pok29' => 'Pok29',
            'pok30' => 'Pok30',
            'pok31' => 'Pok31',
            'pok32' => 'Pok32',
            'pok33' => 'Pok33',
            'pok34' => 'Pok34',
            'pok35' => 'Pok35',
            'pok36' => 'Pok36',
            'pok37' => 'Pok37',
            'pok38' => 'Pok38',
            'pok39' => 'Pok39',
            'pok40' => 'Pok40',
            'pok41' => 'Pok41',
            'pok42' => 'Pok42',
            'pok43' => 'Pok43',
            'pok44' => 'Pok44',
            'pok45' => 'Pok45',
            'pok46' => 'Pok46',
            'pok47' => 'Pok47',
            'pok48' => 'Pok48',
            'pok49' => 'Pok49',
            'pok50' => 'Pok50',
            'pok51' => 'Pok51',
            'pok52' => 'Pok52',
            'pok53' => 'Pok53',
            'pok54' => 'Pok54',
            'pok55' => 'Pok55',
            'pok56' => 'Pok56',
            'pok57' => 'Pok57',
            'pok58' => 'Pok58',
            'pok59' => 'Pok59',
            'pok60' => 'Pok60',
            'pok61' => 'Pok61',
            'pok62' => 'Pok62',
            'pok63' => 'Pok63',
            'pok64' => 'Pok64',
            'pok65' => 'Pok65',
            'pok66' => 'Pok66',
            'pok67' => 'Pok67',
            'pok68' => 'Pok68',
            'pok69' => 'Pok69',
            'pok70' => 'Pok70',
            'pok71' => 'Pok71',
            'pok72' => 'Pok72',
            'pok73' => 'Pok73',
            'pok74' => 'Pok74',
            'pok75' => 'Pok75',
            'pok76' => 'Pok76',
            'pok77' => 'Pok77',
            'pok78' => 'Pok78',
            'pok79' => 'Pok79',
            'pok80' => 'Pok80',
            'pok81' => 'Pok81',
            'pok82' => 'Pok82',
            'pok83' => 'Pok83',
            'pok84' => 'Pok84',
            'pok85' => 'Pok85',
            'pok86' => 'Pok86',
            'pok87' => 'Pok87',
            'pok88' => 'Pok88',
            'pok89' => 'Pok89',
            'pok90' => 'Pok90',
            'pok91' => 'Pok91',
            'pok92' => 'Pok92',
            'pok93' => 'Pok93',
            'pok94' => 'Pok94',
            'pok95' => 'Pok95',
            'pok96' => 'Pok96',
            'pok97' => 'Pok97',
            'pok98' => 'Pok98',
            'pok99' => 'Pok99',
            'pok100' => 'Pok100',
            'p_date' => 'P Date',
            'red' => 'Red',
            'remark' => 'Remark',
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
        $criteria->compare('site2',$this->site2,true);
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
        $criteria->compare('pok23',$this->pok23,true);
        $criteria->compare('pok24',$this->pok24,true);
        $criteria->compare('pok25',$this->pok25,true);
        $criteria->compare('pok26',$this->pok26,true);
        $criteria->compare('pok27',$this->pok27,true);
        $criteria->compare('pok28',$this->pok28,true);
        $criteria->compare('pok29',$this->pok29,true);
        $criteria->compare('pok30',$this->pok30,true);
        $criteria->compare('pok31',$this->pok31,true);
        $criteria->compare('pok32',$this->pok32,true);
        $criteria->compare('pok33',$this->pok33,true);
        $criteria->compare('pok34',$this->pok34,true);
        $criteria->compare('pok35',$this->pok35,true);
        $criteria->compare('pok36',$this->pok36,true);
        $criteria->compare('pok37',$this->pok37,true);
        $criteria->compare('pok38',$this->pok38,true);
        $criteria->compare('pok39',$this->pok39,true);
        $criteria->compare('pok40',$this->pok40,true);
        $criteria->compare('pok41',$this->pok41,true);
        $criteria->compare('pok42',$this->pok42,true);
        $criteria->compare('pok43',$this->pok43,true);
        $criteria->compare('pok44',$this->pok44,true);
        $criteria->compare('pok45',$this->pok45,true);
        $criteria->compare('pok46',$this->pok46,true);
        $criteria->compare('pok47',$this->pok47,true);
        $criteria->compare('pok48',$this->pok48,true);
        $criteria->compare('pok49',$this->pok49,true);
        $criteria->compare('pok50',$this->pok50,true);
        $criteria->compare('pok51',$this->pok51,true);
        $criteria->compare('pok52',$this->pok52,true);
        $criteria->compare('pok53',$this->pok53,true);
        $criteria->compare('pok54',$this->pok54,true);
        $criteria->compare('pok55',$this->pok55,true);
        $criteria->compare('pok56',$this->pok56,true);
        $criteria->compare('pok57',$this->pok57,true);
        $criteria->compare('pok58',$this->pok58,true);
        $criteria->compare('pok59',$this->pok59,true);
        $criteria->compare('pok60',$this->pok60,true);
        $criteria->compare('pok61',$this->pok61,true);
        $criteria->compare('pok62',$this->pok62,true);
        $criteria->compare('pok63',$this->pok63,true);
        $criteria->compare('pok64',$this->pok64,true);
        $criteria->compare('pok65',$this->pok65,true);
        $criteria->compare('pok66',$this->pok66,true);
        $criteria->compare('pok67',$this->pok67,true);
        $criteria->compare('pok68',$this->pok68,true);
        $criteria->compare('pok69',$this->pok69,true);
        $criteria->compare('pok70',$this->pok70,true);
        $criteria->compare('pok71',$this->pok71,true);
        $criteria->compare('pok72',$this->pok72,true);
        $criteria->compare('pok73',$this->pok73,true);
        $criteria->compare('pok74',$this->pok74,true);
        $criteria->compare('pok75',$this->pok75,true);
        $criteria->compare('pok76',$this->pok76,true);
        $criteria->compare('pok77',$this->pok77,true);
        $criteria->compare('pok78',$this->pok78,true);
        $criteria->compare('pok79',$this->pok79,true);
        $criteria->compare('pok80',$this->pok80,true);
        $criteria->compare('pok81',$this->pok81,true);
        $criteria->compare('pok82',$this->pok82,true);
        $criteria->compare('pok83',$this->pok83,true);
        $criteria->compare('pok84',$this->pok84,true);
        $criteria->compare('pok85',$this->pok85,true);
        $criteria->compare('pok86',$this->pok86,true);
        $criteria->compare('pok87',$this->pok87,true);
        $criteria->compare('pok88',$this->pok88,true);
        $criteria->compare('pok89',$this->pok89,true);
        $criteria->compare('pok90',$this->pok90,true);
        $criteria->compare('pok91',$this->pok91,true);
        $criteria->compare('pok92',$this->pok92,true);
        $criteria->compare('pok93',$this->pok93,true);
        $criteria->compare('pok94',$this->pok94,true);
        $criteria->compare('pok95',$this->pok95,true);
        $criteria->compare('pok96',$this->pok96,true);
        $criteria->compare('pok97',$this->pok97,true);
        $criteria->compare('pok98',$this->pok98,true);
        $criteria->compare('pok99',$this->pok99,true);
        $criteria->compare('pok100',$this->pok100,true);
        $criteria->compare('p_date',$this->p_date,true);
        $criteria->compare('red',$this->red,true);
        $criteria->compare('remark',$this->remark,true);

        return new CActiveDataProvider($this, array(
            'criteria'=>$criteria,
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return Site2022_spo the static model class
     */
    public static function model($className=__CLASS__)
    {
        return parent::model($className);
    }
}