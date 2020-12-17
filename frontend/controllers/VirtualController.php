<?php


namespace frontend\controllers;


use common\components\Controller;
use common\components\StaticFunctions;
use common\models\District;
use common\models\Reception;
use common\models\TelegramSettings;
use common\models\TelegramUser;
use Yii;
use yii\helpers\Url;
use yii\web\UploadedFile;

class VirtualController extends Controller
{
    public function actionQabulxona(){
        $this->view->title = \common\models\Settings::findOne('title')->getLang('val') . " - Yangi murojaat yuborish";
        $model = new Reception();

        if($model->load(Yii::$app->request->post()) && $model->save()){
            $model->birth_date = date('Y-m-d',strtotime($model->birth_date));
            $model->status = 0;
            $model->unique_id = substr(str_shuffle(str_repeat('0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ', 15)), 0, 15);
            $model->password = substr(str_shuffle(str_repeat('0123456789', 8)), 0, 8);
            $file = UploadedFile::getInstance($model, 'file');
            if($file){
                $model->file =  StaticFunctions::saveFile($file, $model->id,'reception');
            }
            if($model->save()){
                $template = TelegramSettings::findOne(['id' => 'reception']);
                $users = TelegramUser::find()->all();

                $name = $model->name;
                $phone = $model->phone;
                $email = $model->email;
                $message = $model->message;
                $link = Yii::$app->params['backend'] . "/reception/view/" . $model->id;

                $rplc_name = '/{\$name}/';
                $rplc_phone = '/{\$phone}/';
                $rplc_email = '/{\$email}/';
                $rplc_message = '/{\$message}/';
                $rplc_link = '/{\$link}/';

                $tpl = $template->value;

                $tpl = preg_replace($rplc_name, $name, $tpl);
                $tpl = preg_replace($rplc_phone, $phone, $tpl);
                $tpl = preg_replace($rplc_email, $email, $tpl);
                $tpl = preg_replace($rplc_message, $message, $tpl);
                $tpl = preg_replace($rplc_link, $link, $tpl);
                foreach ($users as $user) {
                    $query = [
                        'chat_id' => $user->user_id,
                        'text' => $tpl,
                        'parse_mode' => 'HTML'
                    ];

                    $text = Yii::$app->httpclient->get('https://api.telegram.org/bot998677061:AAGNIhVWTkt7w1o-LKLxohhvwf79u84EVZM/sendMessage?' . http_build_query($query));
                }
                return $this->redirect(['success','id'=>$model->unique_id]);
            }
        }

        return $this->render('qabulxona',[
            'model' => $model
        ]);
    }

    public function actionSuccess(){
        $this->view->title = \common\models\Settings::findOne('title')->getLang('val') . " - Murojaat muvaffaqiyatli yuborildi";
        $id = Yii::$app->request->get('id');
        $model = Reception::find()->where(['unique_id'=>$id])->one();
        return $this->render('success',[
            'model' => $model
        ]);
    }

    public function actionCheck(){
        $this->view->title = \common\models\Settings::findOne('title')->getLang('val') . " - Murojaat holatini tekshirish";
        $model = new Reception();
        $found = "";
        if($model->load(Yii::$app->request->post())){
            $found = Reception::find()->where(['unique_id'=>$model->unique_id,'password'=>$model->password])->one();
        }
        return $this->render('check',[
            'model' => $model,
            'found' => $found
        ]);
    }

    public function actionRegion(){
        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        $out = [];
        if (isset($_POST['depdrop_parents'])) {
            $parents = $_POST['depdrop_parents'];
            if ($parents != null) {
                $cat_id = $parents[0];
                $out = District::find()->where(['parent'=>$cat_id])->asArray()->all();
                return ['output'=>$out, 'selected'=>''];
            }
        }
        return ['output'=>'', 'selected'=>''];
    }
}