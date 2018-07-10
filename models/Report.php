<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "report".
 *
 * @property int $idreport
 * @property string $mid
 * @property int $type
 * @property int $testtime
 * @property int $errcode
 * @property int $lang
 * @property string $phone
 * @property string $hospital
 * @property int $stat
 */
class Report extends \yii\db\ActiveRecord
{
    const STAT_NEW = 0;
    const STAT_EXIST = 1;
    const STAT_ERROR = 2;
    const TYPE_CM = 0;
    const TYPE_CV = 1;
    const TYPE_PM = 2;
    const TYPE_PV = 3;
    const LANG_CN = 0;
    const LANG_EN = 1;
    const SCENARIO_NEW = 'new';
    const SCENARIO_INPUT = 'input';
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'report';
    }

    public static function getTypeArray() 
    {
        return [
            self::TYPE_CM,
            self::TYPE_CV,
            self::TYPE_PM,
            self::TYPE_PV,
        ];
    } 
    public static function getTypeName() 
    {
        return [
            self::TYPE_CM => "CM",
            self::TYPE_CV => "CV",
            self::TYPE_PM => "PM",
            self::TYPE_PV => "PV",
        ];
    }
    public static function getLangArray() 
    {
        return [
            self::LANG_CN,
            self::LANG_EN,
        ];
    } 

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['mtype', 'testtime', 'errcode', 'lang', 'stat'], 'integer'],
            [['mid'], 'string', 'max' => 6],
            [['phone'], 'string', 'max' => 15],
            [['phone'], 'integer'],
            [['phone'], 'string', 'min' => 8 ,'on'=>self::SCENARIO_INPUT],
            [['hospital'], 'string', 'min' => 3 ,'on'=>self::SCENARIO_INPUT],
            [['phone','hospital'], 'required','on'=>self::SCENARIO_INPUT],
            [['hospital'], 'string', 'max' => 45],
            [['mid', 'testtime'], 'unique', 'targetAttribute' => ['mid', 'testtime']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'idreport' => Yii::t('app', 'Idreport'),
            'mid' => Yii::t('app', 'Mid'),
            'mtype' => Yii::t('app', 'Mtype'),
            'testtime' => Yii::t('app', 'Testtime'),
            'errcode' => Yii::t('app', 'Errcode'),
            'lang' => Yii::t('app', 'Lang'),
            'phone' => Yii::t('app', 'Phone'),
            'hospital' => Yii::t('app', 'Hospital'),
            'stat' => Yii::t('app', 'Stat'),
        ];
    }

}
