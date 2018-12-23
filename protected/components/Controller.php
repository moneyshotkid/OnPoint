<?php
/**
 * Controller is the customized base controller class.
 * All controller classes for this application should extend from this base class.
 */
class Controller extends CController
{
	/**
	 * @var string the default layout for the controller view. Defaults to '//layouts/column1',
	 * meaning using a single column layout. See 'protected/views/layouts/column1.php'.
	 */
	public $layout='//layouts/column2';
	/**
* Specifies the access control rules.
* This method is used by the 'accessControl' filter.
* @return array access control rules
*/
public function accessRules()
{
return array(
array('allow', 
'controllers'=>array('dispatcher','driver','patient','user'),
'actions'=>array('index','view'),
'users'=>array('@'),
),
array('allow', 
'controllers'=>array('dispatcher','driver','patient'),
'actions'=>array('create','update'),
'users'=>array('@'),
),
array('allow',
'controllers'=>array('dispatcher','driver','patient'),
'actions'=>array('admin','delete'),
'users'=>array('admin'),
),
array('deny', // deny all users
'controllers'=>array('dispatcher','driver','patient'),
'users'=>array('*'),
),
);
}
   public function timeAgo ($time)
    {
        $time = strtotime($time);
        $time = time() - $time; // to get the time since that moment

        $tokens = array (
            31536000 => 'year',
            2592000 => 'month',
            604800 => 'week',
            86400 => 'day',
            3600 => 'hour',
            60 => 'minute',
            1 => 'second'
        );

        foreach ($tokens as $unit => $text) {
            if ($time < $unit) continue;
            $numberOfUnits = floor($time / $unit);
            return $numberOfUnits.' '.$text.(($numberOfUnits>1)?'s':'').' ago';
        }

    }



 public FUNCTION getTimeDiff($dtime,$atime){

        $nextDay=$dtime>$atime?1:0;
        $dep=EXPLODE(':',$dtime);
        $arr=EXPLODE(':',$atime);
        $diff=ABS(MKTIME($dep[0],$dep[1],0,DATE('n'),DATE('j'),DATE('y'))-MKTIME($arr[0],$arr[1],0,DATE('n'),DATE('j')+$nextDay,DATE('y')));
        $hours=FLOOR($diff/(60*60));
        $mins=FLOOR(($diff-($hours*60*60))/(60));
        $secs=FLOOR(($diff-(($hours*60*60)+($mins*60))));
        IF(STRLEN($hours)<2){$hours="0".$hours;}
        IF(STRLEN($mins)<2){$mins="0".$mins;}
        IF(STRLEN($secs)<2){$secs="0".$secs;}
        RETURN $hours.':'.$mins.':'.$secs;
    }


    public function timecountdown($time)
    {
        $date = strtotime($time);
        $remaining = $date - time();
        $days_remaining = floor($remaining / 86400);
        $hours_remaining = floor(($remaining % 86400) / 3600);
        $mins=floor($hours_remaining/60);
        return $hours_remaining.' hrs '.$mins.' mins';
    }

	/**
	 * @var array context menu items. This property will be assigned to {@link CMenu::items}.
	 */
	public $menu=array();
	/**
	 * @var array the breadcrumbs of the current page. The value of this property will
	 * be assigned to {@link CBreadcrumbs::links}. Please refer to {@link CBreadcrumbs::links}
	 * for more details on how to specify this property.
	 */
	public $breadcrumbs=array();

    public function getUnreadCount(){
$model=new Message;
        $userId=Yii::app()->user->id;
        $num=$model->getCountUnreaded($userId);
        return $num;
    }






}