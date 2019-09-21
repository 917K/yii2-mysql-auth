<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\DetailView;
use common\helpers\C;

/* @var $this yii\web\View */
/* @var $model backend\models\UserAdmin */

$this->title = $model->user->username;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'User Admins'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-admin-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            [
                'attribute' => 'username',
                'format' => 'html',
                'value' => Html::a($model->user->username, Url::to(['user/view', 'id' => $model->user_id], true)),
            ],
            [
                'attribute' => 'admin_role_id',
                'value' => C::getConstantsByPrefix(\backend\models\AdminRole::class, 'ADMIN_ROLE_')[$model->role->id],
            ],
            /*[
                'attribute' => 'role_id',
                'format' => 'html',
                'value' => function ($model) {
                    //return C::getConstantsByPrefix(UserRole::class, 'USER_ROLE_')[$model->role->id];
                    $roles = [];
                    foreach ($model->roles as $role) {
                        $roles[] = Html::encode($role->itemName->description);
                    }
                    return implode("<br>", $roles);
                },
            ],*/
            [
                'attribute' => 'created_at',
                'format' => ['date', 'php:Y-m-d H:i'],
            ],
        ],
    ]) ?>

</div>