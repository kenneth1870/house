<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "tbl_resi".
 *
 * @property integer $id
 * @property string $img
 * @property integer $valor
 * @property string $caracteristicas
 * @property integer $ubicacion
 */
class Resi extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public $file;

    public static function tableName()
    {
        return 'tbl_resi';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
         [['file'], 'file', 'skipOnEmpty' => false, 'extensions' => 'png, jpg', 'maxFiles' => 4],
        [['valor', 'ubicacion'], 'integer'],
        [['caracteristicas'], 'string'],
        [['img'], 'string', 'max' => 512],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
        'id' => 'ID',
        'img' => 'Img',
        'valor' => 'Valor',
        'caracteristicas' => 'Caracteristicas',
        'ubicacion' => 'Ubicacion',
        ];
    }
}
