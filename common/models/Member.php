<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "member".
 *
 * @property int $id
 * @property string $fio
 * @property string $phone_number
 * @property string $company_name
 * @property string $worker_status
 * @property string $email
 * @property string $lid_source
 * @property string $responsible
 * @property string $region
 * @property string $crm_id
 * @property int $download_count
 * @property string $download_date
 */
class Member extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'member';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['fio', 'email', 'responsible', 'region', 'crm_id'], 'required'],
            [['download_count'], 'integer'],
            [['download_date'], 'safe'],
            [['fio', 'phone_number', 'company_name', 'worker_status', 'email', 'lid_source', 'responsible', 'region'], 'string', 'max' => 500],
            [['crm_id'], 'string', 'max' => 100],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'fio' => 'Fio',
            'phone_number' => 'Phone Number',
            'company_name' => 'Company Name',
            'worker_status' => 'Worker Status',
            'email' => 'Email',
            'lid_source' => 'Lid Source',
            'responsible' => 'Responsible',
            'region' => 'Region',
            'crm_id' => 'Crm ID',
            'download_count' => 'Download Count',
            'download_date' => 'Download Date',
        ];
    }
}
