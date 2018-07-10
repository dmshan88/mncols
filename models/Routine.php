<?php
namespace app\models;
use app\models\Report;

class Routine
{
    const LANG_EN = 'en-US';
    const LANG_CN = 'zh-CN';
	private $report = null;
	private $valid = false;
	private $new = false;
    private $needinput = false;
    private $lang = self::LANG_EN;
	public function __construct($array = [])
    {
        if (isset($array['mid']) 
            && isset($array['testtime']) 
            && !empty($array['mid']) 
            && !empty($array['testtime'])) 
        {
            $report = Report::find()
                ->where(['mid' => $array['mid'],'testtime' => $array['testtime']])
                ->one();
            if (!$report) {
            	$report = new Report;
                $report->load([$report->formName() => $array]);
                $report->stat = Report::STAT_NEW;
                if ($report->save()) {
                	$this->new = true;
                    $this->report = $report;
                    $this->valid = true;
                    $this->needinput = true;
                } else {
                    var_dump($report->getErrors());
                }
            } else {
                $this->report = $report;
                $this->valid= true;
                if ($report->stat == Report::STAT_NEW) {
                    $this->needinput = true;
                }
            }
        }
        if (isset($array['id']) && !empty($array['id'])) {
            $report = Report::findOne($array['id']);
            if ($report) {
                $this->report = $report;
                $this->valid = true;
                if ($report->stat == Report::STAT_NEW) {
                    $this->new = false;
                    $this->needinput = true;
                }
            }
        }
        if (isset($array['lang'])) {
            $this->setLang($array['lang']);
        } 
    }
    public function isValid()
    {
        return $this->valid;   
    }
    public function isNew()
    {
        return $this->new;
    }
    public function needInput()
    {
        return $this->needinput;
    }
    public function getLang()
    {
        return $this->lang;
    }
    public function getReportObj()
    {

        return $this->report;

    }
    public function getReportid()
    {
        if (is_object($this->report) && isset($this->report['idreport']))
            return $this->report->idreport;
        else
            return null;
    }
    private function setLang($value='')
    {
        switch ($value) {
            case Report::LANG_CN:
                $this->lang = self::LANG_CN;
                break;
            case Report::LANG_EN:
                $this->lang = self::LANG_EN;
                break;
        }
    }
    public function inputInfo($array = [])
    {
        if ($this->valid) {
            $model = $this->report;
            if ($model->load($array)) {
                $model->scenario = Report::SCENARIO_INPUT;
                $model->stat = Report::STAT_EXIST;
                if ($model->save()) {
                    sendmail('new report '.$model->mid, $model->hospital);
                    return true;
                }
            }
        }
        return false;
    }
}
function sendmail($subject = '', $content = '')
{
    \Yii::$app->mailer->compose()
    ->setFrom('shanjinlong@mnchip.com')
    ->setTo('shanjinlong@mnchip.com')
    ->setSubject($subject)
    ->setTextBody($content)
    // ->setHtmlBody('<b>HTML content</b>')
    ->send();
}