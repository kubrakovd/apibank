<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Transaction */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'Transaction',
]) . $model->transactionId;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Transactions'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->transactionId, 'url' => ['view', 'id' => $model->transactionId]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="transaction-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
