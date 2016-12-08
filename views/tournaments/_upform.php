<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\jui\DatePicker;

/* @var $this yii\web\View */
/* @var $model app\models\Tournaments */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="tournaments-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'tournament_date')->widget(DatePicker::classname(), [
        'language' => 'ru',
        'dateFormat' => 'yyyy-MM-dd'
    ]) ?>
    <?php
    $types = \app\models\Types::find()->all();
    $items = \yii\helpers\ArrayHelper::map($types,'id','name');
    $params = [
        'prompt' => 'Укажите тип турнира...'
    ];
    ?>
    <?= $form->field($model, 'type_id')->dropDownList($items,$params);?>

    <?= $form->field($model, 'created_by')->textInput(['maxlength' => true]) ?>

    <?php
    $items = [
        'Теты' => 'Теты',
        'Дуплеты' => 'Дуплеты',
        'Триплеты' => 'Триплеты',
        'Супермеле' => 'Супермеле'
    ];
    $params = [
        'prompt' => 'Укажите формат турнира...'
    ];
    ?>
    <?= $form->field($model, 'format')->dropDownList($items,$params);?>
    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
