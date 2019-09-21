<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use common\helpers\C;

/* @var $this yii\web\View */
/* @var $model backend\models\UserAdmin */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="user-admin-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'user_id')->textInput() ?>

    <?= $form->field($model, 'admin_role_id')->dropdownList(C::getConstantsByPrefix(\backend\models\AdminRole::class, 'ADMIN_ROLE_')) ?>

    <?php /*$form->field($model, 'role')->checkboxList($allRoles, ['value' => $userRoles]);*/ ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>