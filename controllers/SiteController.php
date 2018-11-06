<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\FilmeForm;

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
                'only' => ['logout'],
                'rules' => [
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
    
    private function listaFilmes()
    {
        $connection = Yii::$app->getDb();
        $command = $connection->createCommand("
            SELECT nome,
                   ano_lancamento
            FROM filme");
        $result = $command->queryAll();

        foreach ($result as $filme)
        {
            $model = FilmeForm::criarFilme($filme['nome'], $filme['ano_lancamento'], '0');
            $models[] = $model;
        }
		
		return $models;
    }

    public function actionIndex()
    {
        return $this->render('filmes', array('listaFilmes'=>$this->listaFilmes()));
    }
	
	public function actionFilmes()
    {
        return $this->render('filmes', array('listaFilmes'=>$this->listaFilmes()));
    }

    public function actionInserir()
    {
		return $this->render('inserir');
    }
	
	public function actionAlugar()
    {
        return $this->render('alugar');
    }
}
