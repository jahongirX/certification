<?php
namespace frontend\controllers;

use common\models\Member;
use common\models\Menu;
use common\models\Post;
use frontend\models\CertificationForm;
use kartik\mpdf\Pdf;
use Yii;
use yii\base\InvalidParamException;
use yii\data\ActiveDataProvider;
use yii\data\Pagination;
use yii\helpers\Url;
use yii\httpclient\Client;
use yii\web\BadRequestHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\web\Cookie;
use yii\web\Response;
use common\models\Languages;
use common\models\TelegramUser;
use common\models\District;
use common\models\Email;
use common\models\Polls;
use common\models\Reception;
use common\models\SearchForm;
use common\models\Faq;
use common\components\Controller;
use common\models\LoginForm;
use frontend\models\PasswordResetRequestForm;
use frontend\models\ResetPasswordForm;
use yii\widgets\ActiveForm;

class SiteController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout', 'signup'],
                'rules' => [
                    [
                        'actions' => ['signup'],
                        'allow' => true,
                        'roles' => ['?'],
                    ],
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
             'captcha' => [
//                 'class' => 'yii\captcha\CaptchaAction',
                  'class' => 'common\components\MyCaptchaAction',
                 'fixedVerifyCode' => YII_ENV_TEST ? 'test' : null,
//                 'TestLimit'=>99,
             ],
        ];
    }

    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionCheckForPdf(){
        $model = new CertificationForm();
        if($model->load(Yii::$app->request->post())){

            $member = Member::find()->where(['email'=>$model->email])->one();

            if(!empty($member)){


                Yii::$app->session->setFlash('success','Спасибо за участие в конференции! Ваш файл сертификата уже скачан и отправлен на ваш E-mail! ) Если этого не сулчилось , пожалуйста нажмите кнпоку "скачать" !');
                Yii::$app->session->setFlash('refresh',"refresh");
                Yii::$app->session->set('fio',$model->fio);
                return $this->goBack();

            }else{
                Yii::$app->session->setFlash('error','Участника с таким E-mail ом не найдено! Попробуйте вводит правильный E-mail или обратитесь в <a class="badge badge-primary p-1" href="http://t.me/xushboqov_jahongir" target="_blank">службу поддержки</a> !');
                return $this->goBack();
            }


        }else{
            return $this->goHome();
        }
    }

    public function actionDownloadPdf(){
//        echo 1; die;
        $fio = Yii::$app->session->get('fio');
//        print_r($fio);
        if(empty($fio)){
           return $this->goBack();
        }
        $content = $this->renderPartial('generatePdf',[
            'fio' => $fio
        ]);

        // setup kartik\mpdf\Pdf component
        $pdf = new Pdf([
            // set to use core fonts only
            'mode' => Pdf::MODE_UTF8,
            'marginTop' => 0,
            'marginBottom' => 0,
            'marginLeft' => 0,
            'marginRight' => 0,
            // A4 paper format
            'format' => Pdf::FORMAT_A4,
            // portrait orientation
            'orientation' => Pdf::ORIENT_PORTRAIT,
            // stream to browser inline
            'destination' => Pdf::DEST_FILE,
            // your html content input
            'content' => $content,
            // format content from your own css file if needed or use the
            // enhanced bootstrap css built by Krajee for mPDF formatting
            'cssFile' => '@vendor/kartik-v/yii2-mpdf/src/assets/kv-mpdf-bootstrap.min.css',
            // any css to be embedded if required
            'cssInline' => '.name{position:absolute;left:21.4%;top:29%;font-size: 70px;color: #000;}.pdf{height:100%;background-image: url(/images/cert-bg.jpg);background-size:cover;}',
            // set mPDF properties on the fly
//                'options' => ['title' => 'Krajee Report Title'],
            // call mPDF methods on the fly
            'methods' => [
//                    'SetHeader'=>['Krajee Report Header'],
//                    'SetFooter'=>['{PAGENO}'],
                'SetWatermarkImage' => ['../images/cert-bg.jpg'],
            ],


        ]);

        $filename = "cerificate_" . date('d_m_Y__H_i_s') . "___" . $fio . '.pdf';

        $pdf->content = $content;
        $pdf->filename = $filename;
        $pdf->destination = pdf::DEST_DOWNLOAD;

        return $pdf->output($content,$filename, pdf::DEST_DOWNLOAD);
    }

    public function actionGeneratePdf(){
        return $this->renderAjax('generatePdf');
    }

    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        } else {
            return $this->render('login', [
                'model' => $model,
            ]);
        }
    }

    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }



    public function actionSitemap()
    {
        $models = $models = Menu::find()->where('status=1')->andWhere(['parent' => NULL,'type' => Menu::HEADER])->orderBy(['order_by' => SORT_ASC])->all();
        return $this->render('sitemap',[
            'models' => $models
        ]);
    }







    public function actionGetcity()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        if (isset($_POST['depdrop_parents'])) {
            $pid = (int)$_POST['depdrop_parents'][0];
            $out = District::find()->where('parent LIKE '.$pid)->all();
        } else {
            $out = [];
        }
        return ['output'=>$out, 'selected'=>''];
    }


    public function actionSearch()
    {
        $model = new SearchForm();
        $results = null;
        $formSubmitted = false;
        $count = 0;
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            $results = $model->search();
            $count = count($results);
            $formSubmitted = true;
        }

        return $this->render('search', [
            'model' => $model,
            'formSubmitted' => $formSubmitted,
            'results' => $results,
            'count' => $count
        ]);
    }

    public function actionAbout()
    {
        $adverts = Advertise::find()->limit(4)->all();
        return $this->render('about',['adverts' => $adverts]);
    }

    public function actionRequestPasswordReset()
    {
        $model = new PasswordResetRequestForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail()) {
                Yii::$app->session->setFlash('success', 'Check your email for further instructions.');

                return $this->goHome();
            } else {
                Yii::$app->session->setFlash('error', 'Sorry, we are unable to reset password for email provided.');
            }
        }

        return $this->render('requestPasswordResetToken', [
            'model' => $model,
        ]);
    }

    public function actionResetPassword($token)
    {
        try {
            $model = new ResetPasswordForm($token);
        } catch (InvalidParamException $e) {
            throw new BadRequestHttpException($e->getMessage());
        }

        if ($model->load(Yii::$app->request->post()) && $model->validate() && $model->resetPassword()) {
            Yii::$app->session->setFlash('success', 'New password was saved.');

            return $this->goHome();
        }

        return $this->render('resetPassword', [
            'model' => $model,
        ]);
    }

    public function actionFaq()
    {
        $model = new Faq();

        if(Yii::$app->language == Yii::$app->params['main_language'])
        {
            $models = Faq::find()->where('status=1 AND answer IS NOT NULL')->orderBy(['id' => SORT_DESC])->all();

        } else {

            $lang = Yii::$app->language;
            $id = Languages::find()->filterWhere(['abb' => $lang])->one()->id;
            $models = Faq::find()->leftJoin('faq_lang', 'faq.id=faq_lang.parent')->where('faq_lang.status=1 AND faq_lang.answer IS NOT NULL AND faq_lang.lang=' . $id)->orderBy(['faq.id' => SORT_DESC])->all();

        }

        return $this->render('faq', [
            'model' => $model,
            'models' => $models
        ]);
    }

    public function actionFaqForm()
    {
        $model = new Faq();
        $model->scenario = 'frontend';

        if ( $model->load(Yii::$app->request->post()) )
        {
            if ( $model->save() )
            {
                $template = TelegramSettings::findOne(['id' => 'FaqTemplate']);
                $users = TelegramUser::find()->all();

                $name = $model->name;
                $phone = $model->phone;
                $email = $model->email;
                $question = $model->question;

                $rplc_name = '/{\$name}/';
                $rplc_phone = '/{\$phone}/';
                $rplc_email = '/{\$email}/';
                $rplc_question = '/{\$question}/';

                $tpl = $template->value;

                $tpl = preg_replace($rplc_name, $name, $tpl);
                $tpl = preg_replace($rplc_phone, $phone, $tpl);
                $tpl = preg_replace($rplc_email, $email, $tpl);
                $tpl = preg_replace($rplc_question, $question, $tpl);

                foreach ($users as $user) {
                    $query = [
                        'chat_id' => $user->user_id,
                        'text' => $tpl,
                        'parse_mode' => 'HTML'
                    ];

                    $text = Yii::$app->httpclient->get('https://api.telegram.org/bot484198503:AAHL8gGK6NKPPIVwliyvbE88GOKv3Ka9tLw/sendMessage?' . http_build_query($query));
                }

                Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
                return ['success' => true];
            }
        }

        return false;
    }



    public function actionContacts()
    {
        $model = new \common\models\Contact();
        
        $request = Yii::$app->request->post();
        
        if ($model->load(Yii::$app->request->post()))
        {
            
            $model->created_date = date('U');

            //$Template = TelegramSettings::findOne(['id' => 'contactstemplate']);
            //$Users = TelegramUser::find()->all();


            if($model->save()){
                Yii::$app->session->setFlash('success', 'Murojaatingiz qabul qilindi!');
                /*$name = $model->name;
                $email = $model->email;
                $subject = $model->subject;
                $body = $model->body;
            
                /*$rplc_name = '/{\$name}/';
                $rplc_email = '/{\$email}/';
                $rplc_subject = '/{\$subject}/';
                $rplc_body = '/{\$body}/';
                
                $tpl = $Template->value;
                
                $tpl = preg_replace($rplc_name, $name, $tpl);
                $tpl = preg_replace($rplc_email, $email, $tpl);
                $tpl = preg_replace($rplc_subject, $subject, $tpl);
                $tpl = preg_replace($rplc_body, $body, $tpl);
                
                 foreach ($Users as $user) 
                 {
                    $query = [
                        'chat_id' => $user->user_id,
                        'text' => $tpl
                    ];
    
                    $text = Yii::$app->httpclient->get('https://api.telegram.org/bot449415262:AAGBKavsedIhPpLo12vMd4XnXkaVBsSVI-Q/sendMessage?' . http_build_query($query) );
                 }*/
                $model = new \common\models\Contact();
                return $this->render('contacts', [
                    'model' => $model
                ]);
            }
            
        } else {
            $session = Yii::$app->session;
            $session->remove('success');
            return $this->render('contacts', [
                'model' => $model
            ]);

        }
    }

    public function actionContactForm()
    {
        $model = new Contact();
        $query = Yii::$app->request->post();

        if (!empty($query))
        {
            $model->name = $query['name'];
            $model->phone = $query['phone'];
            $model->body = '';
            $model->subject = '1000';

            if ($model->save())
            {
                $template = TelegramSettings::findOne(['id' => 'contactstemplate']);
                $users = TelegramUser::find()->all();

                $name = $model->name;
                $subject = 'Message from "Call-back"';
                if(!empty($query['course-name'])){
                    $subject = $query['course-name'] . " - " . $query['course-price'];
                }
                $phone = $model->phone;
                $body = '';

                $rplc_name = '/{\$name}/';
                $rplc_subject = '/{\$subject}/';
                $rplc_phone = '/{\$phone}/';
                $rplc_body = '/{\$body}/';

                $tpl = $template->value;

                $tpl = preg_replace($rplc_name, $name, $tpl);
                $tpl = preg_replace($rplc_subject, $subject, $tpl);
                $tpl = preg_replace($rplc_phone, $phone, $tpl);
                $tpl = preg_replace($rplc_body, $body, $tpl);

                foreach ($users as $user)
                {
                    $query = [
                        'chat_id' => $user->user_id,
                        'text' => $tpl,
                        'parse_mode' => 'HTML'
                    ];

                    Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
                    $client = new Client(['baseUrl' => 'https://api.telegram.org/bot737497514:AAFJL8Et4izVVad7rq5igDDK9K0-vmmeSnY/']);
                    return [
                        'success' => true,
                        'link' => $client->get('sendMessage' ,$query )->send()
                    ];


                }


            }
        }

        return false;
    }

    public function actionRegister()
    {
        $this->layout = 'register';
        $model = new Contact();

        if (Yii::$app->request->isAjax && $model->load(Yii::$app->request->post()))
        {
            Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
            return ActiveForm::validate($model);
        }

        if ($model->load(Yii::$app->request->post()))
        {

            if ($model->save())
            {

                 $template = TelegramSettings::findOne(['id' => 'contactstemplate']);
                 $users = TelegramUser::find()->all();

                 $name = $model->name;
                 $email = $model->email;
                 $subject = $model->subject;
                 $phone = $model->phone;
                 $body = $model->body;

                 $rplc_name = '/{\$name}/';
                 $rplc_subject = '/{\$subject}/';
                 $rplc_phone = '/{\$phone}/';
                 $rplc_body = '/{\$body}/';
                 $rplc_email = '/{\$email}/';

                 $tpl = $template->value;

                 $tpl = preg_replace($rplc_name, $name, $tpl);
                 $tpl = preg_replace($rplc_subject, $subject, $tpl);
                 $tpl = preg_replace($rplc_phone, $phone, $tpl);
                 $tpl = preg_replace($rplc_body, $body, $tpl);
                 $tpl = preg_replace($rplc_email, $email, $tpl);

                 foreach ($users as $user)
                 {
                     $query = [
                         'chat_id' => $user->user_id,
                         'text' => $tpl,
                         'parse_mode' => 'HTML'
                     ];

                    Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
                    $client = new Client(['baseUrl' => 'https://api.telegram.org/bot737497514:AAFJL8Et4izVVad7rq5igDDK9K0-vmmeSnY/']);
                    $client->get('sendMessage' ,$query )->send();

                 }

                 Yii::$app->session->setFlash('register-success','Muvaffaqiyatli yuborildi!');
                 return $this->refresh();
            }
        }

        return $this->render('register',[
            'model' => $model
        ]);
            
    }


}

