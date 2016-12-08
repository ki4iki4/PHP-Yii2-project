<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\GameSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="games-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'tournament_id') ?>

    <?= $form->field($model, 'first_team_id') ?>

    <?= $form->field($model, 'second_team_id') ?>

    <?= $form->field($model, 'difference') ?>

    <?php // echo $form->field($model, 'first_team_scores') ?>

    <?php // echo $form->field($model, 'second_team_scores') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
