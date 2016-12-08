<?php

namespace app\controllers;

use app\models\Login;
use app\models\Signup;
use yii;
use yii\web\Controller;

class SiteController extends Controller
{
    public function actionIndex()
    {
        return $this->render('index');
    }
    
    public function actionForum()
    {
        return $this->render('forum');
    }

    public function actionRating()
    {
    return $this->render('rating');
    }

    public function actionSignup()
    {
        $model = new Signup;

        if (isset($_POST['Signup']))
        {
            $model->attributes = Yii::$app->request->post('Signup');
            if ($model->validate() && $model->signup())
            {
                return $this->goHome();
            }
        }
        return $this->render('signup', ['model' => $model]);
    }
    public function actionLogin()
    {
        if(!Yii::$app->user->isGuest)
        {
            return $this->goHome();
        }
        else
        {
            $login_model = new Login();
            if(Yii::$app->request->post('Login'))
            {
                $login_model->attributes = Yii::$app->request->post('Login');
                if($login_model->validate())
                {
                    Yii::$app->user->login($login_model->getUser());
                    return $this->goHome();
                }
            }
            return $this->render('login',['model'=>$login_model]);
        }
    }
    public function actionLogout(){
        if(!Yii::$app->user->isGuest)
        {
            Yii::$app->user->logout();
            return $this->redirect(['index']);
        }
    }
}