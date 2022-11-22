<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use kartik\widgets\Select2;
use kartik\widgets\FileInput;


/* @var $this yii\web\View */
/* @var $model app\models\Messages */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="col-md-12">

    <?php $form = ActiveForm::begin([
    	'layout' => 'horizontal',
        'fieldConfig' => [
            'template' => "{label}\n{beginWrapper}\n{input}\n{hint}\n{error}\n{endWrapper}",
            'horizontalCssClasses' => [
                'label' => 'col-sm-3',
                'offset' => 'col-sm-offset-3',
                'wrapper' => 'col-sm-6',
                'error' => '',
                'hint' => '',
            ],
        ],
        'options' => ['enctype' => 'multipart/form-data']
    ]); ?>

    <?= $form->field($model, 'type')->widget(Select2::classname(), [
        'data' => [
        	'1'=>'Message',
        	'2'=>'Videos',
        	'3'=>'Audio',
            '4'=>'Images',
			'5'=>'Running Message',
			'6'=>'Pdf',
			'7'=>'Ppt'
        ],
        'options' => ['placeholder' => 'Select a category ...','style'=>'padding:0px; display: none;'],
        'pluginOptions' => [
            'allowClear' => true,
        ],
    ]); ?>

    <?php
    	if ($model->attachement) {
            echo $form->field($model, 'attachement')->widget(FileInput::classname(), [
                'options'=>['accept'=>'*'],
                'pluginOptions'=>[
                    'showUpload'=>false,
                    'showRemove'=>false,
                    'initialPreview'=>[
                        Html::img(Yii::$app->params['uploadPath'].$model->attachement, ['class'=>'file-preview-image', 'alt'=>'The Moon', 'title'=>'The Moon']),
                    ],
                    'initialCaption'=>"Your Attachement",
                    'overwriteInitial'=>true
                ]
            ]);
        } else {
            echo $form->field($model, 'attachement')->widget(FileInput::classname(), [
                'options'=>['accept'=>'*'],
                'pluginOptions'=>[
                    //'showCaption'=>false,
                    'showUpload'=>false,
                    'showRemove'=>false,
                ],
            ]);
        }
    ?>

    <?= $form->field($model, 'message')->textarea(['rows' => 6]) ?>

    <div class="col-md-5 col-md-offset-3">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
