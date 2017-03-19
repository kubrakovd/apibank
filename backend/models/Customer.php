<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "customer".
 *
 * @property integer $customerId
 * @property string $name
 * @property integer $cnp
 */
class Customer extends \yii\db\ActiveRecord
{
    // public $name;
    public $email;
    public $password;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'customer';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'cnp'], 'required'],
            [['cnp'], 'integer'],
            [['name'], 'string', 'max' => 50],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'customerId' => Yii::t('app', 'Customer ID'),
            'name' => Yii::t('app', 'Name'),
            'cnp' => Yii::t('app', 'Cnp'),
        ];
    }
}
