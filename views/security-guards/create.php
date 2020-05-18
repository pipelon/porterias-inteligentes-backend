<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\SecurityGuards */

$this->title = 'Asignar porteros';
$this->params['breadcrumbs'][] = ['label' => 'Security Guards', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="security-guards-create">

    <?= $this->render('_form', [
    'model' => $model,
    ]) ?>

</div>
