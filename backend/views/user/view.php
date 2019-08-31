<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use common\helpers\C;
use common\models\UserStatus;
use common\models\UserRole;

/* @var $this yii\web\View */
/* @var $model common\models\User */

$this->title = $model->username;
$this->params['breadcrumbs'][] = ['label' => 'Users', 'url' => ['index']];
$this->params['breadcrumbs'][] = $model->username . ' (id = ' . $model->id . ')';
$formatter = \Yii::$app->formatter;

?>
<div class="user-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?php /*Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) */?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'username',
            'email',
            [
                'attribute' => 'status_id',
                'value' => C::getConstantsByPrefix(UserStatus::class, 'USER_STATUS_')[$model->status->id],
            ],
            [
                'attribute' => 'created_at',
                'format' => ['date', 'php:Y-m-d H:i'],
            ],
            [
                'attribute' => 'updated_at',
                'format' => ['date', 'php:Y-m-d H:i'],
            ],
            [
                'attribute' => 'last_login_at',
                'format' => ['date', 'php:Y-m-d H:i'],
            ],
            [
                'attribute' => 'role_id',
                'format' => 'html',
                'value' => function ($model) {
                    $roles = [];
                    foreach ($model->roles as $role) {
                        $roles[] = Html::encode($role->itemName->description);
                    }
                    return implode("<br>", $roles);
                },
            ],
            'last_login_ip',
        ],
    ]) ?>

</div>