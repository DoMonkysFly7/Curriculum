<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;

use app\models\Curriculum;

class SiteController extends Controller
{

    /**
     * {..show curriculum.}
     */
    public function actionCurriculum()
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(['site/login']);
        }

        $userId = Yii::$app->user->id;

        $curriculum = Curriculum::findByUser($userId);


        // Data pt. view
        $schedule = [
            'Luni' => json_decode($curriculum['Luni'], true),
            'Marti' => json_decode($curriculum['Marti'], true),
            'Miercuri' => json_decode($curriculum['Miercuri'], true),
            'Joi' => json_decode($curriculum['Joi'], true),
            'Vineri' => json_decode($curriculum['Vineri'], true),
        ];

        $zile = ['Luni', 'Marti', 'Miercuri', 'Joi', 'Vineri'];

        $notite = [
            'Luni' => $curriculum->Nota_Luni ?? '',
            'Marti' => $curriculum->Nota_Marti ?? '',
            'Miercuri' => $curriculum->Nota_Miercuri ?? '',
            'Joi' => $curriculum->Nota_Joi ?? '',
            'Vineri' => $curriculum->Nota_Vineri ?? '',
        ];


        return $this->render('curriculum', [
            'schedule' => $schedule,
            'zile' => $zile,
            'notite' => $notite,
        ]);
    }

    /**
     * {..edit curriculum form.}
     */
    public function actionEditCurriculum()
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(['site/login']);
        }

        if (Yii::$app->request->isPost) {
            $post = Yii::$app->request->post();
            $userId = Yii::$app->user->id;

            $model = Curriculum::findByUser($userId);

            // array de zile în ordine, fiecare zi reprezinta un index (Luni => 0, Marti => 1...)
            $zile = ['Luni', 'Marti', 'Miercuri', 'Joi', 'Vineri'];

            // trimite si notitele cu tot cu modificarile lor, fiecare notita corespunzatoare fiecarei zile
            $noteFields = [
                'Nota_Luni' => 'notita_0',
                'Nota_Marti' => 'notita_1',
                'Nota_Miercuri' => 'notita_2',
                'Nota_Joi' => 'notita_3',
                'Nota_Vineri' => 'notita_4',
            ];

            foreach ($noteFields as $field => $postKey) {
                if (isset($post[$postKey])) {
                    $model->$field = trim($post[$postKey]);
                }
            }

            foreach ($zile as $index => $zi) {
                if (isset($post['materii'][$index])) {
                    $materii = $post['materii'][$index];

                    if (count($materii) > 8) {

                        Yii::$app->session->setFlash('error', 'O zi nu poate avea mai mult decat 8 materii!');

                        return $this->redirect(['site/curriculum']);

                    }

                    // transformam in JSON
                    $model->$zi = json_encode($materii, JSON_UNESCAPED_UNICODE);

                } else {


                    // dacă nu există deloc acea zi în $_POST...e goala
                    $model->$zi = json_encode([]);
                }
            }

            if ($model->save(false)) {
                Yii::$app->session->setFlash('success', 'Orar salvat!');
            } else {
                Yii::$app->session->setFlash('error', 'Eroare la salvare!');
            }

            return $this->redirect(['site/curriculum']);
        }
    }




    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'only' => ['logout', 'curriculum'],
                'rules' => [
                    [
                        'actions' => ['logout', 'curriculum'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'logout' => ['post'],
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
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index');
    }

    /**
     * Login action.
     *
     * @return Response|string
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->redirect(['site/curriculum']);
//            return $this->goBack();
        }

        $model->password = '';
        return $this->render('login', [
            'model' => $model,
        ]);
    }

    /**
     * Logout action.
     *
     * @return Response
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * Displays contact page.
     *
     * @return Response|string
     */
    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
            Yii::$app->session->setFlash('contactFormSubmitted');

            return $this->refresh();
        }
        return $this->render('contact', [
            'model' => $model,
        ]);
    }

    /**
     * Displays about page.
     *
     * @return string
     */
    public function actionAbout()
    {
        return $this->render('about');
    }
}
