<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\UserBackend */

$this->title = '添加新用户';
$this->params['breadcrumbs'][] = ['label' => '用户管理', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-backend-create">


    <div class="user-backend-form">

        <?php $form = ActiveForm::begin([
            'id' => 'form-signup'
        ]); ?>

        <?= $form->field($model, 'username')->label('用户名')->textInput(['autofocus' => true]) ?>

        <?= $form->field($model, 'password')->label('密码')->passwordInput() ?>

        <?= $form->field($model, 'password_repeat')->passwordInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'nickname')->label('姓名') ?>

        <?= $form->field($model, 'telephone')->label('手机号码') ?>

        <?= $form->field($model, 'unit')->label('单位') ?>

        <div class="form-group">
            <?= Html::submitButton('添加', ['class' => 'btn btn-primary', 'name' => 'signup-button']) ?>
        </div>

        <?php ActiveForm::end(); ?>

    </div>

</div>
