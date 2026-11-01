<?php

/**
 * This is the model class for table "bbb".
 *
 * The followings are the available columns in table 'bbb':
 * @property string $meetingID
 * @property string $name
 * @property string $moderator
 * @property string $attendee
 * @property string $attendeePW
 * @property string $moderatorPW
 * @property string $welcome
 * @property string $dialNumber
 * @property string $voiceBridge
 * @property string $webVoice
 * @property string $logoutURL
 * @property string $record
 * @property string $duration
 * @property string $meta
 * @property string $max_participants
 */
class Bbb extends CActiveRecord
{
    public $terupr;
    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return Bbb the static model class
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
        return 'bbb';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('name', 'required'),
            array('name, attendeePW, moderatorPW, dialNumber, voiceBridge, webVoice', 'length', 'max'=>255),
            array('max_participants, duration, meetingID, record, terupr', 'numerical', 'integerOnly'=>true),
            array('record, terupr', 'length', 'max'=>1),
            array('attendeePW', 'length', 'is'=>6),
            array('moderatorPW', 'length', 'is'=>8),
            array('duration', 'length', 'max'=>5),
            array('welcome, logoutURL, meta, moderator, attendee', 'safe'),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('meetingID, name, attendeePW, moderatorPW, welcome, dialNumber, voiceBridge, webVoice, logoutURL, record, duration, meta', 'safe', 'on'=>'search'),
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
            'meetingID' => 'Meeting',
            'name' => 'Наименование конференции',
            'moderator' => 'Модератор(ы)',
            'attendee' => 'Участники',
            'attendeePW' => 'Пароль участника',
            'moderatorPW' => 'Пароль модератора',
            'welcome' => 'Приветственное сообщение',
            'dialNumber' => 'Dial Number',
            'voiceBridge' => 'Voice Bridge',
            'webVoice' => 'Web Voice',
            'logoutURL' => 'Url выхода',
            'record' => 'Записать',
            'duration' => 'Продолжительность, мин (по умолчанию "до последнего клиента")',
            'meta' => 'Meta-тэги',
            'terupr' => 'Совещание с теруправлениями',
            'max_participants' => 'Максимальное число участников',
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

        $criteria->compare('meetingID',$this->meetingID,true);
        $criteria->compare('name',$this->name,true);
        $criteria->compare('moderator',$this->moderator,true);
        $criteria->compare('attendee',$this->attendee,true);
        $criteria->compare('attendeePW',$this->attendeePW,true);
        $criteria->compare('moderatorPW',$this->moderatorPW,true);
        $criteria->compare('welcome',$this->welcome,true);
        $criteria->compare('dialNumber',$this->dialNumber,true);
        $criteria->compare('voiceBridge',$this->voiceBridge,true);
        $criteria->compare('webVoice',$this->webVoice,true);
        $criteria->compare('logoutURL',$this->logoutURL,true);
        $criteria->compare('record',$this->record,true);
        $criteria->compare('duration',$this->duration,true);
        $criteria->compare('meta',$this->meta,true);
        $criteria->compare('max_participants',$this->max_participants,true);

        return new CActiveDataProvider($this, array(
            'criteria'=>$criteria,
        ));
    }
}