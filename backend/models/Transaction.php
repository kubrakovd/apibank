<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "transaction".
 *
 * @property integer $transactionId
 * @property integer $customerId
 * @property double $amout
 * @property string $date
 */
class Transaction extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'transaction';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            // [['customerId', 'amount', 'date'], 'required'],
            [['customerId'], 'integer'],
            [['amount'], 'number'],
            [['date'], 'string', 'max' => 13],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'transactionId' => Yii::t('app', 'Transaction ID'),
            'customerId' => Yii::t('app', 'Customer ID'),
            'amout' => Yii::t('app', 'Amout'),
            'date' => Yii::t('app', 'Date'),
        ];
    }
}
