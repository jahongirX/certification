<?php

namespace common\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\db\Expression;

/**
 * This is the model class for table "reception".
 *
 * @property int $id
 * @property string $name
 * @property int $district_id
 * @property int $region_id
 * @property string $address
 * @property string $email
 * @property string $phone
 * @property int $gender
 * @property string $birth_date
 * @property int $reception_type
 * @property string $message
 * @property string $file
 * @property string $unique_id
 * @property string $password
 * @property int $status
 * @property string $created_date
 * @property int $reply_text
 * @property string $reply_date
 * @property string $reply_file
 */
class Reception extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'reception';
    }
    public function behaviors()
    {
        return [
            [
                'class' => TimestampBehavior::className(),
                'attributes'=>[
                    ActiveRecord::EVENT_BEFORE_INSERT =>['created_date']
                ],
                'value' => new Expression('NOW()'),
            ],
        ];
    }


    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'district_id', 'region_id', 'address', 'phone', 'gender', 'message','reception_type'], 'required'],
            [['district_id', 'region_id', 'gender', 'reception_type', 'status'], 'integer'],
            [['birth_date', 'created_date', 'reply_date'], 'safe'],
            [['message','reply_text'], 'string'],
            [['name', 'address', 'email'], 'string', 'max' => 500],
            [['phone'], 'string', 'max' => 15],
            [['file', 'unique_id', 'password', 'reply_file'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => Yii::t('main','name'),
            'district_id' => Yii::t('main','district'),
            'region_id' => Yii::t('main','region'),
            'address' => Yii::t('main','address'),
            'email' => Yii::t('main','email'),
            'phone' => Yii::t('main','phone'),
            'gender' => Yii::t('main','gender'),
            'birth_date' => Yii::t('main','birth_date'),
            'reception_type' => Yii::t('main','reception_type'),
            'message' => Yii::t('main','message'),
            'file' => Yii::t('main','file'),
            'unique_id' => Yii::t('main','unique_id'),
            'password' => Yii::t('main','password'),
            'status' => Yii::t('main','status'),
            'created_date' => Yii::t('main','created_date'),
            'reply_text' => Yii::t('main','reply_text'),
            'reply_date' => Yii::t('main','reply_date'),
            'reply_file' => Yii::t('main','reply_file'),
        ];
    }
}
