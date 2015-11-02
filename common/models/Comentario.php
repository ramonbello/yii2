<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "comentario".
 *
 * @property integer $id
 * @property string $nombre
 * @property string $correo
 * @property string $comentario
 * @property string $estado
 * @property integer $noticia_id
 * @property string $fecha
 *
 * @property Noticia $noticia
 */
class Comentario extends \yii\db\ActiveRecord
{
        public $verifyCode;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'comentario';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['noticia_id'], 'required'],
            [['noticia_id'], 'integer'],
            [['fecha'], 'safe'],
            [['nombre', 'correo', 'comentario', 'estado'], 'string', 'max' => 45],
        ['verifyCode', 'captcha'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('traduccion', 'ID'),
            'nombre' => Yii::t('traduccion', 'Nombre'),
            'correo' => Yii::t('traduccion', 'Correo'),
            'comentario' => Yii::t('traduccion', 'Comentario'),
            'estado' => Yii::t('traduccion', 'Estado'),
            'noticia_id' => Yii::t('traduccion', 'Noticia ID'),
            'fecha' => Yii::t('traduccion', 'Fecha'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getNoticia()
    {
        return $this->hasOne(Noticia::className(), ['id' => 'noticia_id']);
    }
}
