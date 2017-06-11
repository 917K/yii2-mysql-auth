<?php
/* @var $this yii\web\View */
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

?>
<h1>user/settings</h1>

<?php if (!empty($activeSocials)) { ?>
<div class="site-active-socials">
    <h3>Bound socials networks</h3>
    <?php foreach ($activeSocials as $activeSocial => $data) { ?>
    <div class="row">
        <div class="col-lg-5">
            <div class="form-group">
                <?= Html::a($activeSocial, '/site/auth?authclient='.$activeSocial, ['class' => 'btn btn-primary btn-block']) ?>
            </div>
        </div>
    </div>
</div>
<?php
    }
}
?>

<div class="site-reset-password">
    <h3>Change password</h3>

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