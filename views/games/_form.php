<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

?>

<div class="games-form">


  
    <?php $form = ActiveForm::begin();
    ?>

        <?php if (!isset($model->tournament_id)): ?>
            <?php
            $tournaments = \app\models\Tournaments::find()->all();
            $items = \yii\helpers\ArrayHelper::map($tournaments,'id','name');
            $params = [
                'prompt' => 'Укажите турнир...'
            ];
            ?>
            <?= $form->field($model, 'tournament_id')->dropDownList($items,$params);?>
        <?php else: ?>
            <?= $form->field($model, 'tournament_id')->textInput(['value'=>$model->tournament_id]);?>

            <?php
            $tournaments = \app\models\Teams::find()
                ->join('LEFT JOIN', 'games', 'teams.id = games.winner_id')
                ->where(['tournament_id'=>$model->tournament_id])
                ->all();
            $items = \yii\helpers\ArrayHelper::map($tournaments,'id','name');
            $params = [
                'prompt' => 'Укажите победившую команду...'
            ];
            ?>

            <?= $form->field($model, 'winner_id')->dropDownList($items,$params);?>

            <?php
            $tournaments = \app\models\Teams::find()
                ->join('LEFT JOIN', 'games', 'teams.id = games.loser_id')
                ->where(['tournament_id'=>$model->tournament_id])
                ->all();
            $items = \yii\helpers\ArrayHelper::map($tournaments,'id','name');
            $params = [
                'prompt' => 'Укажите проигравшую команду...'
            ];
            ?>

            <?= $form->field($model, 'loser_id')->dropDownList($items,$params);?>

            <?php
            $items = [
                '0' => '0',
                '1' => '1',
                '2' => '2',
                '3' => '3',
                '4' => '4',
                '5' => '5',
                '6' => '6',
                '7' => '7',
                '8' => '8',
                '9' => '9',
                '10' => '10',
                '11' => '11',
                '12' => '12',
                '13' => '13',
            ];
            $params1 = [
                'prompt' => 'Очки победившей команды...'
            ];
            $params2 = [
                'prompt' => 'Очки победившей команды...'
            ];
            ?>
            <?= $form->field($model, 'winner_scores')->dropDownList($items,$params1);?>
            <?= $form->field($model, 'loser_scores')->dropDownList($items,$params2);?>


        <?php endif; ?>


    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>
