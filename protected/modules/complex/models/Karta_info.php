<?php

/**
 * This is the model class for table "karta_info".
 *
 * The followings are the available columns in table 'karta_info':
 * @property string $id_report
 * @property string $id_mun
 * @property string $address
 * @property string $uch_inf
 * @property string $dir_name
 * @property string $dir_par
 * @property string $dir_sur
 * @property integer $cod_phone
 * @property integer $phone
 * @property integer $cod_fax
 * @property integer $fax
 * @property string $mail
 * @property string $site
 * @property string $pr_address
 * @property integer $pr_cod_phone
 * @property integer $pr_phone
 * @property integer $pr_cod_fax
 * @property integer $pr_fax
 * @property string $pr_mail
 * @property string $pr_s_day
 * @property string $pr_f_day
 * @property string $pr_s_hour
 * @property string $pr_f_hour
 * @property string $pr_s_obed
 * @property string $pr_f_obed
 * @property string $pr_priem
 * @property string $pr_prim
 * @property string $res_centr
 * @property string $res_profil
 * @property string $res_link
 */
class Karta_info extends CActiveRecord
{
    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return Karta_info the static model class
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
        return 'karta_info';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('id_report, id_mun, address, cod_phone, phone, site', 'required'),
            array('id_mun, pr_s_day, pr_f_day, pr_s_hour, pr_f_hour, pr_s_obed, pr_f_obed', 'numerical', 'integerOnly'=>true),
            array('dir_name, dir_par, dir_sur', 'match', 'pattern'=>'/^[а-яА-Я\-\s]*$/u', 'message'=>'В имени, фамилии и отчестве можно использовать только буквы кириллицы, цифры и тире'),
            array('site, pr_priem, res_link', 'url'),
            array('mail, pr_mail', 'email'),            
            array('id_report', 'length', 'max'=>10),
            array('pr_s_day, pr_f_day', 'numerical', 'min' => 1, 'max' => 7),
            array('pr_s_hour, pr_f_hour, pr_s_obed, pr_f_obed', 'numerical', 'min' => 0, 'max' => 23),
            array('id_mun', 'length', 'max'=>2),
            array('address, dir_name, dir_par, dir_sur, mail, site, pr_address, pr_mail, pr_priem, res_profil, res_link', 'length', 'max'=>255),
            array('res_centr', 'length', 'max'=>1),
            array('cod_phone, cod_fax, pr_cod_phone, pr_cod_fax', 'length', 'is'=>3),
            array('phone, fax, pr_phone, pr_fax', 'length', 'is'=>7),
            array('cod_phone, phone, cod_fax, fax, pr_cod_phone, pr_phone, pr_cod_fax, pr_fax', 'match', 'pattern'=>'/^[0-9]*$/u', 'message'=>'В строке "{attribute}" можно использовать только цифры'),            
            array('uch_inf, pr_prim', 'safe'),
            array('address, uch_inf, mail, site, pr_address, pr_mail, pr_priem, pr_prim, res_profil, res_link','filter','filter'=>array($obj=new CHtmlPurifier(),'purify')),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('id_report, id_mun, address, dir_name, dir_par, dir_sur, cod_phone, phone, cod_fax, fax, mail, site, pr_address, pr_cod_phone, pr_phone, pr_cod_fax, pr_fax, pr_mail, pr_s_day, pr_f_day, pr_s_hour, pr_f_hour, pr_s_obed, pr_f_obed, pr_priem, pr_prim, res_centr, res_profil, res_link', 'safe', 'on'=>'search'),
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
			'id_mun' => 'Муниципалитет',
			'address' => 'Почтовый адрес',
                        'uch_inf' => 'Краткая информация об учреждении для абитуриентов(не более 10-15 предложений)',
			'dir_name' => 'Имя директора',
			'dir_par' => 'Отчество директора',
			'dir_sur' => 'Фамилия директора',
			'cod_phone' => 'Код телефона',
			'phone' => 'Телефон учреждения',
			'cod_fax' => 'Код факса',
			'fax' => 'Факс учреждения',
			'mail' => 'E-mail',
			'site' => 'Адрес сайта',
			'pr_address' => 'Почтовый адрес приемной комиссии',
			'pr_cod_phone' => 'Pr Cod Phone',
			'pr_phone' => 'Телефон приемной комиссии',
			'pr_cod_fax' => 'Pr Cod Fax',
			'pr_fax' => 'Факс приемной комиссии',
			'pr_mail' => 'E-mail приемной комиссии',
			'pr_s_day' => 'Начальный день недели работы приемной комиссии',
			'pr_f_day' => 'Конечный день недели работы приемной комиссии',
			'pr_s_hour' => 'Час начала работы приемной комиссии',
			'pr_f_hour' => 'Час окончания работы приемной комиссии',
                        'pr_s_obed' => 'Час начала обеда в приемной комиссии',
                        'pr_f_obed' => 'Час окончания обеда в приемной комиссии',                    
			'pr_priem' => 'Ссылка на правила приема',
			'pr_prim' => 'Дополнительная информация о приемной комиссии',
			'res_centr' => 'Учреждение является ресурсным центром профессионального образования',
			'res_profil' => 'Профиль ресурсного центра',
			'res_link' => 'Ссылка на раздел сайта с информацией о ресурсном центре',
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
        $criteria->compare('id_mun',$this->id_mun,true);
        $criteria->compare('address',$this->address,true);
        $criteria->compare('uch_inf',$this->uch_inf,true);
        $criteria->compare('dir_name',$this->dir_name,true);
        $criteria->compare('dir_par',$this->dir_par,true);
        $criteria->compare('dir_sur',$this->dir_sur,true);
        $criteria->compare('cod_phone',$this->cod_phone);
        $criteria->compare('phone',$this->phone);
        $criteria->compare('cod_fax',$this->cod_fax);
        $criteria->compare('fax',$this->fax);
        $criteria->compare('mail',$this->mail,true);
        $criteria->compare('site',$this->site,true);
        $criteria->compare('pr_address',$this->pr_address,true);
        $criteria->compare('pr_cod_phone',$this->pr_cod_phone);
        $criteria->compare('pr_phone',$this->pr_phone);
        $criteria->compare('pr_cod_fax',$this->pr_cod_fax);
        $criteria->compare('pr_fax',$this->pr_fax);
        $criteria->compare('pr_mail',$this->pr_mail,true);
        $criteria->compare('pr_s_day',$this->pr_s_day,true);
        $criteria->compare('pr_f_day',$this->pr_f_day,true);
        $criteria->compare('pr_s_hour',$this->pr_s_hour,true);
        $criteria->compare('pr_f_hour',$this->pr_f_hour,true);
        $criteria->compare('pr_s_obed',$this->pr_s_obed,true);
        $criteria->compare('pr_f_obed',$this->pr_f_obed,true);
        $criteria->compare('pr_priem',$this->pr_priem,true);
        $criteria->compare('pr_prim',$this->pr_prim,true);
        $criteria->compare('res_centr',$this->res_centr,true);
        $criteria->compare('res_profil',$this->res_profil,true);
        $criteria->compare('res_link',$this->res_link,true);

        return new CActiveDataProvider($this, array(
            'criteria'=>$criteria,
        ));
    }
}