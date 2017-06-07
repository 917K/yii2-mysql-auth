<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\SignupForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Signup';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-signup">
    <h1><?= Html::encode($this->title) ?></h1>
    <div class="row">
        <div class="col-lg-5">
            
            <div class="form-group">
                <?= Html::a('Facebook', '/site/auth?authclient=facebook', ['class' => 'btn btn-primary btn-block']) ?>
            </div>

            <p>or fill out the following fields to signup:</p>
            
            <?php $form = ActiveForm::begin([
                'id' => 'form-signup',]
            ); ?>

                <?= $form->field($model, 'username')->textInput(['autofocus' => true]) ?>

                <?= $form->field($model, 'email') ?>

                <?= $form->field($model, 'password')->passwordInput() ?>

                <?= $form->field($model, 'passwordRepeat')->passwordInput()->label('Repeat Password') ?>
            
                <?= 
                    $form->field($model, 'reCaptcha')->widget(
                        \himiklab\yii2\recaptcha\ReCaptcha::className(),
                        [
                            'siteKey' => $googleRecaptchaPublic,
                        ]
                    )
                ?>

                <div class="form-group">
                    <?= Html::submitButton('Signup', ['class' => 'btn btn-primary', 'name' => 'signup-button']) ?>
                </div>

            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>
