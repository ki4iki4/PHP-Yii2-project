<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "posts".
 *
 * @property integer $id
 * @property string $title
 * @property string $description
 * @property integer $autor_id
 *
 * @property Players $autor
 */
class Posts extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'posts';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title', 'description', 'autor_id'], 'required'],
            [['autor_id'], 'integer'],
            [['title'], 'string', 'max' => 30],
            [['description'], 'string', 'max' => 10000],
            [['autor_id'], 'exist', 'skipOnError' => true, 'targetClass' => Players::className(), 'targetAttribute' => ['autor_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Title',
            'description' => 'Description',
            'autor_id' => 'Autor ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAutor()
    {
        return $this->hasOne(Players::className(), ['id' => 'autor_id']);
    }
}
