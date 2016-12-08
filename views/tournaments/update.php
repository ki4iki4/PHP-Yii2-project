<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Tournaments */

$this->title = 'Update Tournaments: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Tournaments', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="tournaments-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_upform', [
        'model' => $model,
    ]) ?>

</div>
