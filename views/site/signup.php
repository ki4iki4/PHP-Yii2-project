<h2> SignUP</h2>
<?php
use yii\widgets\ActiveForm;
?>
<?php
    $form = ActiveForm::begin(['class'=>'form-horizontal']);
?>
<?= $form->field($model,'name')->textInput()?>
<?= $form->field($model,'last_name')->textInput()?>
<?= $form->field($model,'password')->passwordInput()?>
<?= $form->field($model,'email')->textInput()?>

<div>
    <button type="submit" class="btn btn-primary">Submit</button>
</div>
<?php
    ActiveForm::end();
?>