<?php
namespace backend\controllers;

use Yii;
use yii\web\Controller;

/**
 * Site controller
 */
class LangController extends Controller
{

public function init()
{
	\Yii::$app->language=\Yii::$app->session['lang'];
}
    public function actionIndex()
    {
        return $this->render('index');
    }

public function actionChangeLang($lang)
{
	$session=\Yii::$app->session;
	$session->set('lang',$lang);
	\Yii::$app->language=\Yii::$app->session['lang'];
	return $this->render("index");
}
}