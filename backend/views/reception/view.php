<?php

use common\models\District;
use yii\helpers\Html;
use yii\widgets\DetailView;
use common\components\StaticFunctions;

$this->title = StaticFunctions::getPartOfText( $model->name, 50 );
$this->params['breadcrumbs'][] = ['label' => Yii::t('main', 'Murojaatnomalar'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

?>

<div class="container-fluid container-fixed-lg m-t-20">

    <div class="panel panel-transparent">

        <div class="panel-body no-padding">

            <div class="panel panel-default">

                <div class="panel-body page-header-block">

                        <h2><?=  Yii::t('main', 'Murojaatnoma : ') ?> <?= Html::encode($this->title) ?></h2>

                    <?=  Html::a(Yii::t('main', "Javob yo'llash"), ['answer', 'id' => $model->id], ['class' => 'btn btn-success']) ?>

                    <?=  Html::a(Yii::t('main', "Inkor qilish"), ['decline', 'id' => $model->id], ['class' => 'btn btn-danger']) ?>

                </div>

            </div>

        </div>

        <div class="panel-body no-padding">

            <div class="panel panel-default">

                <div class="panel-body">

                    <?= DetailView::widget([
                            'model' => $model,
                            'attributes' => [
                                            'id',
            'name',
                                [
                                    'attribute' => 'region_id',
                                    'value' => function($data){
                                        return \common\models\Region::findOne($data->region_id)->name;
                                    }
                                ],
                                [
                                    'attribute' => 'district_id',
                                    'value' => function($data){
                                        return District::findOne($data->district_id)->name;
                                    }
                                ],
            'address',
            'email:email',
            'phone',
            [
                    'attribute'=>'gender',
                    'value' => function($data){
                        $lang = Yii::$app->session->get('lang');
                        if(empty($lang)){
                            $lang = 'uz';
                        }
                        return Yii::$app->params['genders'][$lang][$data->gender];
                    }
            ],
            'birth_date',
                                [
                                    'attribute' => 'reception_type',
                                    'value' => function($data){
                                        $lang = Yii::$app->session->get('lang');
                                        if(empty($lang)){
                                            $lang = 'uz';
                                        }
                                        return Yii::$app->params['reception_type'][$lang][$data->reception_type];
                                    }
                                ],
            'message:ntext',
                                [
                                    'attribute' => 'file',
                                    'format' => 'html',
                                    'value' => function($data){
                                        if($data->file && file_exists(Yii::getAlias('@frontend') . '/web' . Yii::$app->params['uploads_url'] . 'reception/' . $data->id . "/" . $data->file )) {

                                            $file = Yii::$app->params['frontend'] . Yii::$app->params['uploads_url'] . 'reception/' . $data->id . "/" . $data->file;

                                        } else {

                                            $file = "#No File";

                                        }

                                        return "<a download='download' href='". $file . "'>" . $data->file ."</a>";
                                    }
                                ],
            'unique_id',
            'password',
            [
                                            'attribute' => 'status',
                                            'format' => 'html',
                                            'value' => function($data){

                                                $lang = Yii::$app->session->get('lang');
                                                if(empty($lang)){
                                                    $lang = 'uz';
                                                }

                                                $result = "";
                                                switch ($data->status){
                                                    case 0: $result = "<div class='btn btn-warning btn-xs'>" . Yii::$app->params['reception_status'][$lang][$data->status] . "</div>"; break;
                                                    case 1: $result = "<div class='btn btn-info btn-xs'>" . Yii::$app->params['reception_status'][$lang][$data->status] . "</div>"; break;
                                                    case 2: $result = "<div class='btn btn-success btn-xs'>" . Yii::$app->params['reception_status'][$lang][$data->status] . "</div>"; break;
                                                    case 3: $result = "<div class='btn btn-danger btn-xs'>" . Yii::$app->params['reception_status'][$lang][$data->status] . "</div>"; break;
                                                    default : $result = "<div class='btn btn-warning btn-xs'>" . Yii::t('main','went-wrong') . "</div>";
                                                }
                                                return $result;
                                            }
                                        ],
            'created_date',
            'reply_text',
            'reply_date',
            'reply_file',
                            ],
                        ]) ?>

                </div>

            </div>

        </div>

    </div>

</div>
