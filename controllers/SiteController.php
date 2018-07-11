<?php

namespace app\controllers;
use Yii;
use yii\data\ArrayDataProvider;
use yii\web\NotFoundHttpException;
use yii\web\ServerErrorHttpException;
use yii\helpers\Url;
use app\models\Routine;
use app\models\Report;
use Qcloud\Sms\SmsMultiSender;
// use yii\db\Query;
class SiteController extends \yii\web\Controller
{
    public function actionTest()
    {
        $mtypearr = Report::getTypeArray();
        $langarr = Report::getLangArray();

        $mid=rand('1','999999');
        $mtype=$mtypearr[array_rand($mtypearr)];
        $testtime=time()-rand(100,1000);
        $errcode=rand(0,10000);
        $lang=$langarr[array_rand($langarr)];
        // $url=U('Service/Index/index',array(
        //     'mid'=>$mid,
        //     'mtype'=>$mtype,
        //     'testtime'=>$testtime,
        //     'errcode'=>$errcode,
        //     'lang'=>$lang,
        // ));
        $url= [
        // U('Service/Index/index',array(
            'site/index',
            'mid' => $mid,
            'mtype' => $mtype,
            'testtime' => $testtime,
            'errcode' => $errcode,
            'lang' => $lang,
        ];
        $name= " machine:".$mid
                ." type:".$mtype
                ." testtime:".$testtime
                ." errcode:".$errcode
                ." lang:".$lang;
        echo "<a href=". Url::toRoute($url) ." target='_blank'>".$name."</a> ";

    }
    public function actionWait($lang = '')
    {
        if ($lang == Routine::LANG_CN) {
            \Yii::$app->language = 'zh-CN';
        } else {
        }     
        return $this->render('wait');
    }
    public function actionError()
    {
        return $this->render('error');
    }
    public function actionIndex()
    {
        $request = Yii::$app->request;
        $routine = new Routine($request->get());
        if ($routine->isValid()) {
            if ($routine->isNew() || $routine->needInput()) {
                return $this->redirect(['input', 'id'=>$routine->getReportid() , 'lang'=>$routine->getLang()]);
            } else {
                return $this->redirect(['wait', 'lang'=>$routine->getLang()]);
            }
        } else {
            return $this->redirect(['error']);
        }
    }
    public function actionInput($lang = '')
    {
        if ($lang == Routine::LANG_CN) {
            \Yii::$app->language = 'zh-CN';
        } else {
        }
        $request = Yii::$app->request;
        $routine = new Routine($request->get());
        if ($routine->isValid() && $routine->needInput()) {
            if ($routine->inputInfo($request->post())) {
               return $this->redirect(['wait','lang'=>$lang]);
            }
            return $this->render('input', [
                'model' => $routine->getReportObj(),
            ]);       
        } else {
            return $this->redirect(['error']);
        }
    } 
}
