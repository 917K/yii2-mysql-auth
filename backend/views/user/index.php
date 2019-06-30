<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use common\helpers\C;
use common\models\UserStatus;
use common\models\UserRole;
/* @var $this yii\web\View */
/* @var $searchModel backend\models\UserSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Users';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-index">

    <h1><?= Html::encode($this->title) ?></h1><?php
    Pjax::begin();
    echo GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'username',
            'email',
            [
                'attribute' => 'status_id',
                'filter' => $userStatuses,
                'filterInputOptions' => ['prompt' => 'All', 'class' => 'form-control', 'id' => null],
                'content' => function ($model, $key, $index, $column) {
                    return C::getConstantsByPrefix(UserStatus::class, 'USER_STATUS_')[$model->status->id];
                }
            ],
            [
                'attribute' => 'created_at',
                'format' => ['date', 'php:Y-m-d H:i']
            ],
            [
                'attribute' => 'updated_at',
                'format' => ['date', 'php:Y-m-d H:i']
            ],
            [
                'attribute' => 'last_login_at',
                'format' => ['date', 'php:Y-m-d H:i']
            ],
            [
                'attribute' => 'role_id',
                'filter' => $userRoles,
                'filterInputOptions' => ['prompt' => 'All', 'class' => 'form-control', 'id' => null],
                'content' => function ($model, $key, $index, $column) {
                    return C::getConstantsByPrefix(UserRole::class, 'USER_ROLE_')[$model->role->id];
                }
            ],
            'last_login_ip',
            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{view} {update}'
            ],
        ],
    ]);
    Pjax::end(); ?></div>