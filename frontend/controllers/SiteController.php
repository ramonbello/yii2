<?php
namespace frontend\controllers;

use Yii;
use common\models\LoginForm;
use common\models\Categoria;
use common\models\Noticia;
use common\models\Comentario;
use yii\data\Pagination;

use frontend\models\PasswordResetRequestForm;
use frontend\models\ResetPasswordForm;
use frontend\models\SignupForm;
use frontend\models\ContactForm;
use yii\base\InvalidParamException;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\db\Expression;

/**
 * Site controller
 */
class SiteController extends Controller
{
    /**
     * @inheritdoc
     */
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

    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
        'error' => [
        'class' => 'yii\web\ErrorAction',
        ],
        'captcha' => [
        'class' => 'yii\captcha\CaptchaAction',
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
        $query = Noticia::find();

        $pagination = new Pagination([
            'defaultPageSize'   => 4,
            'totalCount'        => $query->count(),
            ]);

        $noticias = $query->orderBy('id desc')
        ->offset($pagination->offset)
        ->limit($pagination->limit)
        ->all();
        
        $categorias = Categoria::find()->all();
        
        return $this->render(
            'index',
            [
            'categorias'    => $categorias,
            'pagination'    => $pagination,
            'noticias'      => $noticias,
            ]
            );
    }

    /**
     * Logs in a user.
     *
     * @return mixed
     */
    public function actionLogin()
    {
        if (!\Yii::$app->user->isGuest) {
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

    /**
     * Logs out the current user.
     *
     * @return mixed
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * Displays contact page.
     *
     * @return mixed
     */
    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail(Yii::$app->params['adminEmail'])) {
                Yii::$app->session->setFlash('success', 'Thank you for contacting us. We will respond to you as soon as possible.');
            } else {
                Yii::$app->session->setFlash('error', 'There was an error sending email.');
            }

            return $this->refresh();
        } else {
            return $this->render('contact', [
                'model' => $model,
                ]);
        }
    }

    /**
     * Displays about page.
     *
     * @return mixed
     */
    public function actionAbout()
    {
        return $this->render('about');
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
                    return $this->goHome();
                }
            }
        }

        return $this->render('signup', [
            'model' => $model,
            ]);
    }

    /**
     * Requests password reset.
     *
     * @return mixed
     */
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

    /**
     * Resets password.
     *
     * @param string $token
     * @return mixed
     * @throws BadRequestHttpException
     */
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


    public function actionNoticia($slug)
    {
        $categorias = Categoria::find()->all();
        $noticia = Noticia::find()
        ->where("seo_slug = :slug", [":slug" => $slug])
        ->orderBy('id')
        ->one();

      /*
            CONSULTA DE LOS COMENTARIOS DESDE EL CONTROLADOR

       $idNoticia=$noticia->id;
        $comentarios= Comentario::find()
        ->where("noticia_id = :idNoticia", [":idNoticia" => $idNoticia])
        ->all();
    */

        $comentario = new Comentario;

        if ($comentario->load(Yii::$app->request->post())) {

            $comentario->estado         = '0';
            $comentario->noticia_id     = $noticia->id;
            $comentario->fecha          = new Expression("NOW()");
            if ($comentario->save()) {
                Yii::$app->session->setFlash('success', 'Gracias por su comentario');
            } else {
                Yii::$app->session->setFlash('error', 'Su comentario no pudo ser registrado');
            }

            return $this->redirect(["/noticia/$slug"]);
        }


        return $this->render(
            'noticia',
            [
            'comentario'    => $comentario,
          //  'comentarios'   =>$comentarios,
            'categorias'    => $categorias,
            'noticia'       => $noticia,
            ]
            );
    }

}
