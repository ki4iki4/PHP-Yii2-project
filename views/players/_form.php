<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Player */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="player-form">

    <?php $form = ActiveForm::begin([
        'options'=>['class' => "table table-bordered"]
    ]);
    ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'last_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'password')->passwordInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'role_id')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'club_id')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'sex')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'birth_date')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'license')->textInput(['maxlength' => true]) ?>

    
    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
