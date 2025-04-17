<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;

class Curriculum extends ActiveRecord
{
    public static array $zile = ['Luni', 'Marti', 'Miercuri', 'Joi', 'Vineri'];

    public static function tableName()
    {
        return 'Curriculum';
    }

    public static function findByUser($userId)
    {
        return self::find()->where(['ID_User' => $userId])->one();
    }

    public function rules()
    {
        return [
            [['Luni', 'Marti', 'Miercuri', 'Joi', 'Vineri'], 'safe'],
            [['Nota_Luni', 'Nota_Marti', 'Nota_Miercuri', 'Nota_Joi', 'Nota_Vineri'], 'safe'],
        ];
    }
}

