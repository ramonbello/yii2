<?php

namespace common\models;

use yii\db\ActiveRecord;
use yii\db\Expression;
use \yii\behaviors\BlameableBehavior;
use \yii\behaviors\SluggableBehavior;
use yii\web\UploadedFile;


use Yii;


/**
 * This is the model class for table "categoria".
 *
 * @property integer $id
 * @property string $categoria
 * @property string $seo_slug
 * @property string $imagen
 * @property string $created_at
 * @property string $created_by
 * @property string $updated_at
 * @property string $updated_by
 *
 * @property User $createdBy
 * @property User $updatedBy
 * @property Noticia[] $noticias
 */
class Categoria extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'categoria';
    }

        public function behaviors() {
        return [
            'timestamp' => [
                'class' => 'yii\behaviors\TimestampBehavior',
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => ['created_at', 'updated_at'],
                    ActiveRecord::EVENT_BEFORE_UPDATE => ['updated_at'],
                ],
                'value' => new Expression('NOW()'),
            ],
            'blameable' => [
                'class' => \yii\behaviors\BlameableBehavior::className(),
                'createdByAttribute' => 'created_by',
                'updatedByAttribute' => 'updated_by',
            ],
            [
                'class' => SluggableBehavior::className(),
                'attribute' => 'categoria',
                'slugAttribute' => 'seo_slug',
            ],
        ];
    }


    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['categoria'], 'required'],
            [['created_at', 'updated_at'], 'safe'],
            [['created_by', 'updated_by'], 'integer'],
            [['categoria', 'imagen'], 'string', 'max' => 45],
            [['seo_slug'], 'string', 'max' => 100],
          //   [['imagen'], 'file', 'extensions' => 'png, jpg'],
        ];
    }


 public function upload()
    {
        if ($this->validate()) {
            $this->imagen->saveAs('uploads/' . $this->imagen->baseName . '.' . $this->imagen->extension);
            return true;
        } else {
            return false;
        }
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('traduccion', 'ID'),
            'categoria' => Yii::t('traduccion', 'Categoria'),
            'seo_slug' => Yii::t('traduccion', 'Seo Slug'),
            'imagen' => Yii::t('traduccion', 'Imagen'),
            'created_at' => Yii::t('traduccion', 'Created At'),
            'created_by' => Yii::t('traduccion', 'Created By'),
            'updated_at' => Yii::t('traduccion', 'Updated At'),
            'updated_by' => Yii::t('traduccion', 'Updated By'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCreatedBy()
    {
        return $this->hasOne(User::className(), ['id' => 'created_by']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUpdatedBy()
    {
        return $this->hasOne(User::className(), ['id' => 'updated_by']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getNoticias()
    {
        return $this->hasMany(Noticia::className(), ['categoria_id' => 'id']);
    }
}
