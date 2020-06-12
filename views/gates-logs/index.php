<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use kartik\export\ExportMenu;

/* @var $this yii\web\View */
/* @var $searchModel app\models\GatesLogsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Logs Porterias';
$this->params['breadcrumbs'][] = $this->title;

$template = '';
?>
<div class="gates-logs-index box box-primary">    
    <div class="box-body table-responsive">
        <?php // echo $this->render('_search', ['model' => $searchModel]);  ?>
        <?php
        //COLUMNAS PRELIMINARES DEL REPORTE TAR CON FILTROS
        $gridColumns = [
            [
                'attribute' => 'gate_id',
                'format' => 'raw',
                'value' => function ($data) {
                    return '<b>' . $data->gate->housingEstate->name . ' </b>'
                            . ' - ' . $data->gate->name;
                },
                'filter' => yii\helpers\ArrayHelper::map(
                        \app\models\Gates::find()                                
                                ->all()
                        , 'id', 'name', 'housingEstate.name')
            ],
            [
                'attribute' => 'state',
                'format' => 'raw',
                'value' => function ($data) {
                    return Yii::$app->utils->getStategate($data->state);
                },
                'filter' => Yii::$app->utils->getFilterStategate()
            ],
            'state_description',
            [
                'attribute' => 'created',
                'format' => 'date',
                'filter' => false
            ],
            [
                'class' => 'yii\grid\ActionColumn',
                'template' => $template,
            ],
        ];
        //COLUMNAS PARA EL EXPORTABLE DEL TAR EN EXCEL
        $exportColumns = [
            [
                'attribute' => 'gate_id',
                'format' => 'raw',
                'value' => function ($data) {
                    return '<b>' . $data->gate->housingEstate->name . ' </b>'
                            . ' - ' . $data->gate->name;
                }
            ],
            [
                'attribute' => 'state',
                'format' => 'raw',
                'value' => function ($data) {
                    return Yii::$app->utils->getStategate($data->state);
                }
            ],
            'state_description',
            [
                'attribute' => 'created',
                'format' => 'date',
            ],
        ];
        //TIPOS DE EXPORTACION
        $exportConfig = [
            ExportMenu::FORMAT_TEXT => false,
            ExportMenu::FORMAT_CSV => false,
            ExportMenu::FORMAT_HTML => false,
            ExportMenu::FORMAT_PDF => false
        ];
        //MENU DE EXPORTACION
        $fullExportMenu = ExportMenu::widget(
                        [
                            'dataProvider' => $dataProvider,
                            'filterModel' => $searchModel,
                            'columns' => $exportColumns,
                            'showConfirmAlert' => false,
                            'fontAwesome' => true,
                            'target' => '_blank',
                            'filename' => "LogsGates_" . date('Y-m-d-H-i-s'),
                            'exportConfig' => $exportConfig,
                            'dropdownOptions' => [
                                'label' => 'Exportar',
                                'class' => 'btn btn-secondary'
                            ]
                        ]
        );
        ?>
        <?=
        GridView::widget([
            'id' => 'insured-values-roofs-table',
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'layout' => "{toolbar}{items}\n{summary}\n{pager}",
            'columns' => $gridColumns,
            'toolbar' => [
                $fullExportMenu,                
            ],
            'bordered' => true,
            'striped' => true,
            'condensed' => true,
            'responsive' => true,
            'persistResize' => false
        ]);
        ?>
    </div>
</div>
