<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\UserAdmin */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'User Admin',
]) . (!empty($model->user) 
        ? $model->user->username 
        : $model->id);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'User Admins'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => (!empty($model->user) ? $model->user->username : $model->id), 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="user-admin-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>