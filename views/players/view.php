<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

$this->title = 'Информация об игроке';
//    $model->name . ' ' . $model->last_name;

?>
<div class="personal">
    <div class="holder">
        <div class="title">
            <h1><?= Html::encode($this->title) ?></h1>

        </div>
    </div>
    <div class="player_ava">
        <?='<img class="ava"src=' . $model->img?>
    </div>
    <div class="player-view">


        <?= DetailView::widget([
            'model' => $model,
            'attributes' => [
                [
                    'label'=>'Полное имя',
                    'value' => $model->last_name . ' ' . $model->name,
                ],
                'email:email',
                'date_created',

            ],
        ]) ?>

    </div>
    <div class="player-view">


        <?= DetailView::widget([
            'model' => $model,
            'attributes' => [
                'scores',
                'club.name',
                'license'
            ],
        ]) ?>
    </div>

    <div class="player-view">


        <?= DetailView::widget([
            'model' => $model,
            'attributes' => [

                [
                    'attribute'=>'tournaments_count',
                    'value' => $model->getTournamentCount(),
                ],
                [
                    'attribute'=>'games_count',
                    'value' => $model->getGamesCount(),
                ],
                [
                    'attribute'=>'wins',
                    'value' => $model->getWinsCount(),
                ],
                [
                    'attribute'=>'loses',
                    'value' => $model->getLosesCount(),
                ],
                [
                    'label'=>'Место в рейтинге',
                    'value' => $model->getRatingPlace(),
                ],


            ],
        ]) ?>
    </div>
</div>

