<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\GridView;
use yii\widgets\Pjax;
use common\helpers\C;
/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */
/* @var $searchModel backend\models\search\UserAdminSearch */

$this->title = Yii::t('app', 'User Admins');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-admin-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Create User Admin'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>
<?php Pjax::begin(); ?>    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => yii\grid\SerialColumn::class],

            'id',
            'user_id',
            [
                'attribute' => 'username',
                'format' => 'html',
                'value' => function ($data) {
                    return Html::a($data->user->username, Url::to(['user/view', 'id' => $data->user_id], true));
                },
            ],
            [
                'attribute' => 'admin_role_id',
                'filter' => $adminRoles,
                'filterInputOptions' => ['prompt' => 'All', 'class' => 'form-control', 'id' => null],
                'content' => function ($model, $key, $index, $column) {
                    return C::getConstantsByPrefix(\backend\models\AdminRole::class, 'ADMIN_ROLE_')[$model->role->id];
                }
            ],
            [
                'attribute' => 'created_at',
                'format' => ['date', 'php:Y-m-d H:i']
            ],

            ['class' => yii\grid\ActionColumn::class],
        ],
    ]); ?>
<?php Pjax::end(); ?></div>