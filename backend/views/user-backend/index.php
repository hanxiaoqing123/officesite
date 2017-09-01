<?php

use yii\helpers\Html;
use yii\bootstrap\Modal;
use yii\helpers\Url;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\UserBackendSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '用户列表';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-backend-index">


    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('添加新用户', ['signup'], [
        'class' => 'btn btn-success',
        'id' => 'signup',
        'data-toggle' => 'modal',
        'data-target' => '#operate-modal',
        ]) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
           // ['class' => 'yii\grid\SerialColumn'],

            'id',
            'username',
            'nickname',
            'unit',
            'telephone',
            // 'auth_key',
            // 'password_hash',
             'created_at',
             'updated_at',
             'last_login',
             'last_ip',

    [
    'class' => 'yii\grid\ActionColumn',
    'template' => '{update} {resetpwd} {delete}',
    'header' => '操作',
    'buttons' => [
    'update' => function ($url, $model, $key) {
    return Html::a("用户信息", $url, [
    'title' => '用户信息',
    // btn-update 目标class
    'class' => 'btn btn-default btn-update',
    'data-toggle' => 'modal',
    'data-target' => '#operate-modal',
    ]);
    },

   'resetpwd' => function ($url, $model, $key) {
    return Html::a("重置密码", $url, [
    'title' => '重置密码',
    'class' => 'btn btn-default btn-resetpwd ',
    'data-toggle' => 'modal',
    'data-target' => '#operate-modal',
    ]);
    },

    'delete' => function ($url, $model, $key) {
    return Html::a('删除', $url, [
    'title' => '删除',
    'class' => 'btn btn-default',
    'data' => [
    'confirm' => '确定要删除么?',
    'method' => 'post',
    ],
    ]);
    },
    ],
    ],
        ],
    ]); ?>
</div>
<?php
// 创建modal
Modal::begin([
'id' => 'operate-modal',
'header' => '<h4 class="modal-title"></h4>',
]);

Modal::end();


// 创建
$requestCreateUrl = Url::toRoute('signup');

// 更新
$requestUpdateUrl = Url::toRoute('update');

$requestResetpwdUrl = Url::toRoute('resetpwd');
$js = <<<JS

// 创建操作
$('#signup').on('click', function () {
$('.modal-title').html('添加新用户');
$.get('{$requestCreateUrl}',
function (data) {
$('.modal-body').html(data);
}
);
});

// 重置密码
$('.btn-resetpwd').on('click', function () {
$('.modal-title').html('重置密码');
$.get('{$requestResetpwdUrl}', { id: $(this).closest('tr').data('key') },
function (data) {
$('.modal-body').html(data);
}
);
});

// 更新操作
$('.btn-update').on('click', function () {
$('.modal-title').html('用户信息');
$.get('{$requestUpdateUrl}', { id: $(this).closest('tr').data('key') },
function (data) {
$('.modal-body').html(data);
}
);
});
JS;
$this->registerJs($js);

?>
