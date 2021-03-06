<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use common\helpers\C;
use common\models\UserStatus;
use common\models\UserRole;

/* @var $this yii\web\View */
/* @var $model common\models\User */
/* @var $form yii\widgets\ActiveForm */

?>

<div class="user-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'username')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'status_id')->dropdownList(C::getConstantsByPrefix(UserStatus::class, 'USER_STATUS_'));?>

    <?= $form->field($model, 'role_id')->dropdownList(C::getConstantsByPrefix(UserRole::class, 'USER_ROLE_')) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>