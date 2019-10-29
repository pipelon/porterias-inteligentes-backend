<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Authorizations */

$this->title = 'Crear autorización';
$this->params['breadcrumbs'][] = ['label' => 'Autorizaciones', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="authorizations-create">

    <?= $this->render('_form', [
    'model' => $model,
    ]) ?>

</div>
