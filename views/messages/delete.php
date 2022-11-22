<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Messages */

$this->title = 'Delete Messages';
$this->params['breadcrumbs'][] = ['label' => 'Messages', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="row">
    <div class="col-md-12">
        <div class="box">
            <div class="box-header with-border">
                <h1 class="box-title"><?= Html::encode($this->title) ?></h1>
            </div><!-- /.box-header -->
            <div class="box-body">

			    <?= $this->render('_form', [
			        'model' => $model,
			    ]) ?>
			</div>
		</div>
	</div>
</div>
