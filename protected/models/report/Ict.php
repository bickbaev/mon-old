<?php

/**
 * This is the model class for table "ict".
 *
 * The followings are the available columns in table 'ict':
 * @property string $id_report
 * @property string $col_teach
 * @property integer $col_uch
 * @property integer $desktop
 * @property integer $laptop
 * @property integer $tablet
 * @property integer $pda
 * @property integer $comp_adm
 * @property integer $comp_uch
 * @property integer $comp_lvs
 * @property integer $comp_inet
 * @property integer $comp_05
 * @property integer $comp_06
 * @property integer $comp_07
 * @property integer $comp_08
 * @property integer $comp_09
 * @property integer $comp_10
 * @property integer $comp_11
 * @property integer $comp_class
 * @property integer $server
 * @property integer $doska
 * @property integer $proektor
 * @property integer $golos
 * @property integer $printer
 * @property integer $scaner
 * @property integer $doc_cam
 * @property integer $site
 * @property integer $telefon
 * @property integer $radio
 * @property integer $opto
 * @property integer $sat
 * @property integer $win
 * @property integer $mac
 * @property integer $linux
 * @property integer $oper_other
 * @property integer $of_mic
 * @property integer $of_mac
 * @property integer $of_lin
 * @property integer $graf_adobe
 * @property integer $graf_corel
 * @property integer $graf_visio
 * @property integer $graf_linux
 * @property integer $graf_other
 * @property integer $anti_kas
 * @property integer $anti_web
 * @property integer $anti_nod
 * @property integer $anti_rar
 * @property integer $anti_other
 * @property integer $spec_lingvo
 * @property integer $spec_fr
 * @property integer $spec_1C
 * @property integer $spec_linux
 * @property integer $kf_kerio
 * @property integer $kf_ti
 * @property integer $kf_ug
 * @property integer $kf_np
 * @property integer $kf_skf
 * @property integer $kf_ic
 * @property integer $kf_squid
 * @property integer $kf_other
 * @property string $potr_linux
 * @property integer $potr_pk_linux
 * @property string $remark
 */
class Ict extends CActiveRecord
{
    /**
     * Returns the static model of the specified AR class.
     * @return Ict the static model class
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
        return 'ict';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('id_report, col_teach, col_uch', 'required'),
            array('doc_cam, col_teach, col_uch, desktop, laptop, tablet, pda, comp_adm, comp_uch, comp_lvs, comp_inet, comp_05, comp_06, comp_07, comp_08, comp_09, comp_10, comp_11, comp_class, server, doska, proektor, golos, printer, scaner, site, telefon, radio, opto, sat, win, mac, linux, oper_other, of_mic, of_mac, of_lin, graf_adobe, graf_corel, graf_visio, graf_linux, graf_other, anti_kas, anti_web, anti_nod, anti_rar, anti_other, spec_lingvo, spec_fr, spec_1C, spec_linux, kf_kerio, kf_ti, kf_ug, kf_np, kf_skf, kf_ic, kf_squid, kf_other, potr_pk_linux', 'numerical', 'integerOnly'=>true),
            array('id_report', 'length', 'max'=>10),
            array('potr_linux, site', 'length', 'max'=>1),
            array('potr_linux, site', 'in', 'range' => array(0, 1)),
            array('remark', 'safe'),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('doc_cam, col_teach, id_report, col_uch, desktop, laptop, tablet, pda, comp_adm, comp_uch, comp_lvs, comp_inet, comp_05, comp_06, comp_07, comp_08, comp_09, comp_10, comp_11, comp_class, server, doska, proektor, golos, printer, scaner, site, telefon, radio, opto, sat, win, mac, linux, oper_other, of_mic, of_mac, of_lin, graf_adobe, graf_corel, graf_visio, graf_linux, graf_other, anti_kas, anti_web, anti_nod, anti_rar, anti_other, spec_lingvo, spec_fr, spec_1C, spec_linux, kf_kerio, kf_ti, kf_ug, kf_np, kf_skf, kf_ic, kf_squid, kf_other, potr_linux, potr_pk_linux, remark', 'safe', 'on'=>'search'),
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
            'col_teach' => 'Количество учителей(преподавателей) без совместителей',
            'col_uch' => 'Количество учащихся',
            'desktop' => 'Настольный компьютер',
            'laptop' => 'Портативный компьютер(ноутбук)',
            'tablet' => 'Планшетный компьютер',
            'pda' => 'Карманный компьютер(КПК)',
            'comp_adm' => 'в административном пользовании',
            'comp_uch' => 'в пользовании учителей (ноутбуки)',
            'comp_lvs' => 'объединенных в локальные сети (ЛВС)',
            'comp_inet' => 'имеющих доступ в сеть Интернет',
            'comp_05' => '2006',
            'comp_06' => '2007',
            'comp_07' => '2008',
            'comp_08' => '2009',
            'comp_09' => '2010',
            'comp_10' => '2011',
            'comp_11' => '2012',
            'comp_class' => 'Количество компьютерных классов',
            'server' => 'Сервер',
            'doska' => 'Интерактивная доска',
            'proektor' => 'Мультимедиапроектор',
            'golos' => 'Система интерактивного голосования',
            'printer' => 'Принтер (лазерный, струйный)',
            'scaner' => 'Сканер',
            'doc_cam' => 'Документ-камера',
            'site' => 'Наличие сайта или web-страницы в сети Интернет',
            'telefon' => 'Телефонная линия (выделенный канал)',
            'radio' => 'Беспроводная линия (радиоканал, WiMax)',
            'opto' => 'Оптоволоконная линия',
            'sat' => 'Спутниковый канал',
            'win' => 'MS Windows',
            'mac' => 'Mac OS',
            'linux' => 'Linux',
            'oper_other' => 'Другое',
            'of_mic' => 'MS Office',
            'of_mac' => 'Mac OS-совместимый',
            'of_lin' => 'OpenOffice',
            'graf_adobe' => 'Adobe Creative',
            'graf_corel' => 'CorelDRAW',
            'graf_visio' => 'MS Visio',
            'graf_linux' => 'Linux-приложения',
            'graf_other' => 'Другое',
            'anti_kas' => 'Kaspersky Anti-Virus',
            'anti_web' => 'Doctor Web',
            'anti_nod' => 'NOD32',
            'anti_rar' => 'WinRAR',
            'anti_other' => 'Другое',
            'spec_lingvo' => 'ABBYY Lingvo',
            'spec_fr' => 'ABBYY FineReader',
            'spec_1C' => '1С: управление (1C: бухгалтерия)',
            'spec_linux' => 'Linux-приложения',
            'kf_kerio' => 'Kerio Control + Web Filter',
            'kf_ti' => 'Traffic inspector',
            'kf_ug' => 'UserGate Proxy & Firewall',
            'kf_np' => 'Netpolice',
            'kf_skf' => '«Контент-фильтр» (СКФ)',
            'kf_ic' => 'Интернет Цензор',
            'kf_squid' => 'списки доступа Squid',
            'kf_other' => 'Другое',
            'potr_linux' => 'Потребность в технической поддержке ОС ALT Linux и Linux-приложений',
            'potr_pk_linux' => 'Потребность в повышении квалификации персонала по использованию СПО: ALT Linux и Linux-приложений (чел.)',
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
        $criteria->compare('col_teach',$this->col_teach);
        $criteria->compare('doc_cam',$this->doc_cam);
        $criteria->compare('col_uch',$this->col_uch);
        $criteria->compare('desktop',$this->desktop);
        $criteria->compare('laptop',$this->laptop);
        $criteria->compare('tablet',$this->tablet);
        $criteria->compare('pda',$this->pda);
        $criteria->compare('comp_adm',$this->comp_adm);
        $criteria->compare('comp_uch',$this->comp_uch);
        $criteria->compare('comp_lvs',$this->comp_lvs);
        $criteria->compare('comp_inet',$this->comp_inet);
        $criteria->compare('comp_05',$this->comp_05);
        $criteria->compare('comp_06',$this->comp_06);
        $criteria->compare('comp_07',$this->comp_07);
        $criteria->compare('comp_08',$this->comp_08);
        $criteria->compare('comp_09',$this->comp_09);
        $criteria->compare('comp_10',$this->comp_10);
        $criteria->compare('comp_11',$this->comp_11);
        $criteria->compare('comp_class',$this->comp_class);
        $criteria->compare('server',$this->server);
        $criteria->compare('doska',$this->doska);
        $criteria->compare('proektor',$this->proektor);
        $criteria->compare('golos',$this->golos);
        $criteria->compare('printer',$this->printer);
        $criteria->compare('scaner',$this->scaner);
        $criteria->compare('site',$this->site);
        $criteria->compare('telefon',$this->telefon);
        $criteria->compare('radio',$this->radio);
        $criteria->compare('opto',$this->opto);
        $criteria->compare('sat',$this->sat);
        $criteria->compare('win',$this->win);
        $criteria->compare('mac',$this->mac);
        $criteria->compare('linux',$this->linux);
        $criteria->compare('oper_other',$this->oper_other);
        $criteria->compare('of_mic',$this->of_mic);
        $criteria->compare('of_mac',$this->of_mac);
        $criteria->compare('of_lin',$this->of_lin);
        $criteria->compare('graf_adobe',$this->graf_adobe);
        $criteria->compare('graf_corel',$this->graf_corel);
        $criteria->compare('graf_visio',$this->graf_visio);
        $criteria->compare('graf_linux',$this->graf_linux);
        $criteria->compare('graf_other',$this->graf_other);
        $criteria->compare('anti_kas',$this->anti_kas);
        $criteria->compare('anti_web',$this->anti_web);
        $criteria->compare('anti_nod',$this->anti_nod);
        $criteria->compare('anti_rar',$this->anti_rar);
        $criteria->compare('anti_other',$this->anti_other);
        $criteria->compare('spec_lingvo',$this->spec_lingvo);
        $criteria->compare('spec_fr',$this->spec_fr);
        $criteria->compare('spec_1C',$this->spec_1C);
        $criteria->compare('spec_linux',$this->spec_linux);
        $criteria->compare('kf_kerio',$this->kf_kerio);
        $criteria->compare('kf_ti',$this->kf_ti);
        $criteria->compare('kf_ug',$this->kf_ug);
        $criteria->compare('kf_np',$this->kf_np);
        $criteria->compare('kf_skf',$this->kf_skf);
        $criteria->compare('kf_ic',$this->kf_ic);
        $criteria->compare('kf_squid',$this->kf_squid);
        $criteria->compare('kf_other',$this->kf_other);
        $criteria->compare('potr_linux',$this->potr_linux,true);
        $criteria->compare('potr_pk_linux',$this->potr_pk_linux);
        $criteria->compare('remark',$this->remark,true);

        return new CActiveDataProvider(get_class($this), array(
            'criteria'=>$criteria,
        ));
    }
} 