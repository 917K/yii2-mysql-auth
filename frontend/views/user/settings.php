<?php
/* @var $this yii\web\View */
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Change password';
?>
<h1>user/settings</h1>

<div class="site-reset-password">
    <h3><?= Html::encode($this->title) ?></h3>

    <div class="row">
        <div class="col-lg-5">
            <?php $form = ActiveForm::begin(['id' => $changePasswordFormName]); ?>

                <?= $form->field($changePasswordModel, 'oldPassword')->passwordInput() ?>

                <?= $form->field($changePasswordModel, 'newPassword')->passwordInput() ?>

                <?= $form->field($changePasswordModel, 'newPasswordRepeat')->passwordInput()->label('Repeat new Password') ?>

                <div class="form-group">
                    <?= Html::submitButton('Save', ['class' => 'btn btn-primary']) ?>
                </div>

            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>

<?= Html::dropDownList('list', 1, $timezones) ?>