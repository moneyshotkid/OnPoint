<?php
/**
 * JuiBlockUI class file.
 *
 * @author Stefan Volkmar <volkmar_yii@email.de>
 * @license BSD
 * @version 1.2
 * 
 */

/** 
 *
 * This widget encapsulates the jQuery BlockUI Plugin.
 * The jQuery BlockUI Plugin lets you simulate synchronous behavior when using AJAX,
 * without locking the browser. When activated, it will prevent user
 * activity with the page (or part of the page) until it is deactivated.
 * BlockUI adds elements to the DOM to give it both the appearance and behavior
 * of blocking user interaction.
 * ({@link http://jquery.malsup.com/block/}).
 *
 * @author Stefan Volkmar <volkmar_yii@email.de>
 */
Yii::import('zii.widgets.jui.CJuiWidget');

class JuiBlockUI extends CJuiWidget
{	
	/**
	 * @var boolean Decide if you want use an external Stylesheet to override
     * the default settings of the plugin
	 * Defaults to false.
	 */
    public $useExternalStylesheet = false;
	/**
	 * @var mixed the CSS file used for the widget.
	 * If false, the default CSS file will be used. Otherwise, the specified CSS file
	 * will be included when using this widget.
	 */
	public $cssFile=false;

	/**
	 * @var array internal List for javascript code pieces
	 */
    protected $scriptLines=array();

	/**
	 * @var string base url for the asset files
	 */
    protected $baseUrl;
    
	/**
	 * Initializes the widget.
	 * This method registers all needed client scripts
	 */
	public function init()
	{
		parent::init();
		      	
      	$this->baseUrl = CHtml::asset(dirname(__FILE__).DIRECTORY_SEPARATOR.'assets');
        $url = ($this->cssFile!==false)
             ? $this->cssFile
             : $this->baseUrl.'/css/juiBlockUI.css';

        $blockUI = (YII_DEBUG)
                 ?'/js/jquery.blockUI.js'
                 :'/js/jquery.blockUI.min.js';

        $cs=Yii::app()->getClientScript();
        $cs->registerScriptFile($this->baseUrl.$blockUI);
        if ($this->useExternalStylesheet){                        
            $cs->registerCssFile($url);
            $this->addScriptLines(array('$.blockUI.defaults.css = {}'));
        }                    
	}

    /**
	 * Get a Image from 'assets'-folder
     * @param string $name the name of the file
     * @return void
	 */
    public function getImage($name='indicator.gif')
    {
        return $this->baseUrl.'/img/'.$name;

    }

	/**
	 * Add code pieces of Javascript to the internal list.
     * @param array $code Javascript code
	 */
    public function addScriptLines(array $code)
    {
        $this->scriptLines=array_merge($this->scriptLines, $code);

    }

	/**
	 * Clear the internal list for Javascript.
	 */
    private function resetScriptLines()
    {
        $this->scriptLines=array();
    }

	/**
	 * Generates a piece of Javascript - event handler for a HTML element.
     * @param string $selector the jQuery selector
     * @param string $eventName the name of a javascript event
     * @param array $functionBody the code lines
     * @return void
	 */
    public function addEventHandler($selector, $eventName, array $functionBody){
        $code=array();
        $code[] = "$('$selector').$eventName(function(){";
        $code[] = implode("\n", $functionBody);
        $code[] = "})";
        $this->addScriptLines($code);
    }

    /**
     * Registers and generate the javascript code for the plugin.
     * @param integer $position the position of the JavaScript code. Valid values include the following:
     * <ul>
     * <li>CClientScript::POS_HEAD : the script is inserted in the head section right before the title element.</li>
     * <li>CClientScript::POS_BEGIN : the script is inserted at the beginning of the body section.</li>
     * <li>CClientScript::POS_END : the script is inserted at the end of the body section.</li>
     * <li>CClientScript::POS_LOAD : the script is inserted in the window.onload() function.</li>
     * <li>CClientScript::POS_READY : the script is inserted in the jQuery's ready function.</li>
     * </ul>
     */
    public function registerScript($position=CClientScript::POS_READY){
        $js = implode("\n", $this->scriptLines);
		Yii::app()->getClientScript()
            ->registerScript(__CLASS__.'#'.$this->getId().$position, $js, $position);        
        $this->resetScriptLines();
    }

	/**
	 * Generates a piece of Javascript - jquery method 'blockUI'.
     * @param array $options the BlockUI's options
     * Defaults to null.
     * @param string $selector the jQuery selector
     * Defaults to null.
     * @return string the generated script
     * @see http://jquery.malsup.com/block/#options
	 */
    public static function blockUI($options=null, $selector=null){
        $opts=is_null($options)?'':CJavaScript::encode($options);
        return ($selector)
            ?"$('$selector').blockUI($opts.);"
            :"$.blockUI($opts);";
    }
    
	/**
	 * Generates a piece of Javascript - jquery method 'unblockUI'.
     * @param array $options the BlockUI's options
     * Defaults to null.
     * @param string $selector the jQuery selector
     * Defaults to null.
     * @return string the generated script
     * @see http://jquery.malsup.com/block/#options
	 */
    public static function unblockUI($options=null, $selector=null){

        if (is_null($options)) {
            $opts='';
        } else {
            // onUnblock callback
            foreach(array('onUnblock','onunblock') as $name)
            {
                if(isset($options[$name]) && strpos($options[$name],'js:')!==0)
                    $options[$name]='js:'.$options[$name];
            }
            $opts=CJavaScript::encode($options);
        }
        return ($selector)
            ?"$('$selector').unblockUI($opts);"
            :"$.unblockUI($opts);";
    }

	/**
	 * Generates a piece of Javascript - jquery method 'block'.
     * @param array $options the BlockUI's options
     * Defaults to null.
     * @param string $selector the jQuery selector
     * Defaults to null.
     * @return string the generated script
     * @see http://jquery.malsup.com/block/#options
	 */
    public static function block($options=null, $selector=null){
        $opts=is_null($options)?'':CJavaScript::encode($options);
        return ($selector)
            ?"$('$selector').block($opts);"
            :"$.block($opts);";
    }

	/**
	 * Generates a piece of Javascript - jquery method 'unblock'.
     * @param array $options the BlockUI's options
     * Defaults to null.
     * @param string $selector the jQuery selector
     * Defaults to null.
     * @return string the generated script
     * @see http://jquery.malsup.com/block/#options
	 */
    public static function unblock($options=null, $selector=null){
        $opts=is_null($options)?'':CJavaScript::encode($options);
        return ($selector)
            ?"$('$selector').unblock($opts);"
            :"$.unblock($opts);";
    }

	/**
	 * Generates a piece of Javascript - jquery method 'growlUI'.
     * @return string the generated script
	 */
    public static function growlUI($title=null, $message=null, $timeout=null, $onClose=null){
        $params='';
        if ($title)
            $params.=(is_null($var))?'':"'$title'";
        if ($message)
            $params.=(is_null($var))?'':", '$message'";
        if ($timeout)
            $params.=(is_null($var))?'null':", '$timeout', ";
        if ($onClose)
            $params.=(is_null($var))?'null':", $onClose";

        return "$.growlUI($params)";
    }

	/**
	 * Generates a piece of Javascript to unblock the UI after a time
     * @param array $milliSeconds the time in milliseconds
     * @return string the generated JavaScript
	 */

    public static function setUnblockTimeout($milliSeconds=2000){
        return 'setTimeout($.unblockUI,'.$milliSeconds.');';
    }

	/**
	 * Generates a piece of Javascript.
     * If you want to use the default settings and have the UI blocked for
     * all ajax requests, then use this method.
     * @return string the generated JavaScript
	 */
    public static function blockAjaxRequests($selector='document'){
        return '$('.$selector.').ajaxStart($.blockUI).ajaxStop($.unblockUI);';
    }

    /**
     * Generates the JavaScript that initiates an AJAX request.
     * @param array $options AJAX options. The valid options are specified in the jQuery ajax documentation.
     * The following special options are added for convenience:
     * <ul>
     * <li>update: string, specifies the selector whose HTML content should be replaced
     *   by the AJAX request result.</li>
     * <li>replace: string, specifies the selector whose target should be replaced
     *   by the AJAX request result.</li>
     * </ul>
     * Note, if you specify the 'success' option, the above options will be ignored.
     * @return string the generated JavaScript
     * @see http://docs.jquery.com/Ajax/jQuery.ajax#options
     */
    public static function ajax($options){
        return CHtml::ajax($options);
    }

}
