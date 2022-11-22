<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\LoginForm */

$this->title = 'IDove-Login';
$this->params['breadcrumbs'][] = $this->title;
?>
<?php $form = ActiveForm::begin([
    'id' => 'login-form',
    'fieldConfig' => [
        'template' => "<div class=\"form-group\">{input}<div class=\"col-lg-8\">{error}</div></div>\n",
    ],
]); ?>

<?= $form->field($model, 'username')->textInput(['placeholder'=>'Username']) ?>

<?= $form->field($model, 'password')->passwordInput(['placeholder'=>'Password']) ?>

<div class="row">
    <div class="col-xs-8">
        <div class="checkbox icheck">
            <?= $form->field($model, 'rememberMe', [
                'template' => "<div class=\"col-lg-offset-1 col-lg-3\">{input}</div>\n<div class=\"col-lg-8\">{error}</div>",
            ])->checkbox() ?>
        </div>
    </div><!-- /.col -->
    <div class="col-xs-4">
        <?= Html::submitButton('Login', ['class' => 'btn btn-primary', 'name' => 'login-button']) ?>
    </div><!-- /.col -->
</div>
<?php ActiveForm::end(); ?>
