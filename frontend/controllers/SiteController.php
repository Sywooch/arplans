<?php

namespace frontend\controllers;

use common\models\LoginForm;
use common\models\Request;
use frontend\models\PasswordResetRequestForm;
use frontend\models\ResetPasswordForm;
use frontend\models\SignupForm;
use modules\partner\models\About;
use modules\partner\models\AboutBenefit;
use modules\partner\models\AboutReady;
use modules\partner\models\Reviews;
use Yii;
use yii\base\InvalidParamException;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\helpers\FileHelper;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\web\Response;
use yii\web\UploadedFile;
use yii\widgets\ActiveForm;

/**
 * Site controller
 */
class SiteController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only'  => ['logout', 'signup'],
                'rules' => [
                    [
                        'actions' => ['signup'],
                        'allow'   => true,
                        'roles'   => ['?'],
                    ],
                    [
                        'actions' => ['logout'],
                        'allow'   => true,
                        'roles'   => ['@'],
                    ],
                ],
            ],
            'verbs'  => [
                'class'   => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post', 'get'],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error'   => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class'           => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return mixed
     */
    public function actionIndex()
    {
        return $this->render('index');
    }

    /**
     * Logs in a user.
     *
     * @return mixed
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            if (Yii::$app->user->can('adminPanel')) {
                return $this->redirect('/admin');
            }
            return $this->goBack();
        } else {
            $model->password = '';

            return $this->render('login', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Logs out the current user.
     *
     * @return mixed
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();
        if (Yii::$app->request->get('toLogin')) {
            return $this->redirect('/site/login');
        }
        return $this->goHome();
    }

    /**
     * Displays contact page.
     *
     * @return mixed
     */
    public function actionContacts()
    {
        $request = new Request();
        if (Yii::$app->request->isAjax && $request->load(Yii::$app->request->post())) {
            Yii::$app->response->format = Response::FORMAT_JSON;
            return ActiveForm::validate($request);
        }
        if ($request->load(Yii::$app->request->post()) && $request->validate()) {
            $file = UploadedFile::getInstance($request, 'file');
            if ($file && $file->tempName) {
                $request->file = $file;
                if ($request->validate(['file'])) {
                    $dir = Yii::getAlias('@webroot/uploads/request/');
                    $time = time();
                    $path = $dir . $time . '/';
                    FileHelper::createDirectory($path);
                    $fileName = $request->file->name;
                    $request->file->saveAs($path . $fileName);
                    $request->file = '/uploads/request/' . $time . '/' . $fileName;
                }
            }
            if ($request->save()) {
                Yii::$app->mailer->compose('request', ['model' => $request])
                    ->setFrom([Yii::$app->params['adminEmail'] => Yii::$app->name])
                    ->setTo(Yii::$app->params['supportEmail'])
                    ->setSubject('Новый комментарий')->send();
            }
            return $this->redirect(Yii::$app->request->referrer);
        }
        $model = About::getModel();
        $query = About::getFilteredQuery(Yii::$app->request->get());
        return $this->render('contacts', [
            'model'   => $model,
            'request' => $request,
            'query'   => $query
        ]);
    }

    /**
     * Displays about page.
     *
     * @return mixed
     */
    public function actionAbout()
    {
        $benefits = AboutBenefit::find()->all();
        $reviews = Reviews::find()->all();
        $readyProjects = AboutReady::find()->all();
        $model = About::getModel();
        $query = About::getFilteredQuery(Yii::$app->request->get());
        return $this->render('about', [
            'query'         => $query,
            'model'         => $model,
            'benefits'      => $benefits,
            'reviews'       => $reviews,
            'readyProjects' => $readyProjects
        ]);
    }

    /**
     * Signs user up.
     *
     * @return mixed
     */
    public function actionSignup()
    {
        $model = new SignupForm();
        if ($model->load(Yii::$app->request->post())) {
            if ($user = $model->signup()) {
                if (Yii::$app->getUser()->login($user)) {
                    Yii::$app->mailer->compose('registration', ['model' => $model])
                        ->setFrom([Yii::$app->params['supportEmail'] => Yii::$app->name])
                        ->setTo($user->email)
                        ->setSubject('Регистрация на сайте ' . Yii::$app->name)
                        ->send();
                    return $this->goHome();
                }
            }
        }

        return $this->render('signup', ['model' => $model,]);
    }

    /**
     * Requests password reset.
     *
     * @return mixed
     */
    public
    function actionRequestPasswordReset()
    {
        $model = new PasswordResetRequestForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail()) {
                Yii::$app->session->setFlash('success', 'Check your email for further instructions.');

                return $this->goHome();
            } else {
                Yii::$app->session->setFlash('error', 'Sorry, we are unable to reset password for the provided email address.');
            }
        }

        return $this->render('requestPasswordResetToken', [
            'model' => $model,
        ]);
    }

    /**
     * Resets password.
     *
     * @param string $token
     * @return mixed
     * @throws BadRequestHttpException
     */
    public
    function actionResetPassword($token)
    {
        try {
            $model = new ResetPasswordForm($token);
        } catch (InvalidParamException $e) {
            throw new BadRequestHttpException($e->getMessage());
        }

        if ($model->load(Yii::$app->request->post()) && $model->validate() && $model->resetPassword()) {
            Yii::$app->session->setFlash('success', 'New password saved.');

            return $this->goHome();
        }

        return $this->render('resetPassword', [
            'model' => $model,
        ]);
    }
}
