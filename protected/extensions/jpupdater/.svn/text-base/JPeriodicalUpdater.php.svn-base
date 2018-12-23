<?php
/**
 * JPeriodicalUpdater class file.
 *
 */

/**
 * This widget encapsulates the PeriodicalUpdater-jQuery plugin for timed, decaying ajax calls
 * ({@link http://www.360innovate.co.uk/blog/2009/03/periodicalupdater-for-jquery/}).
 *
 */

Yii::setPathOfAlias('JPeriodicalUpdater',dirname(__FILE__));

class JPeriodicalUpdater extends CWidget
{
	/**
	 * @var string|array the URL for the ajax-request.
	 * See {@link CHtml::normalizeUrl} for possible URL formats.	 
	 */
	public $url;

	/**
	 * @var string the ajax-method ('get' or 'post')
	 * Defaults to 'get'.
	 */
	public $method;

	/**
	 * @var array the values to be passed to the page - e.g. {name: "John", greeting: "hello"}
	 */
	public $sendData;
	/**
     * @var integer the starting value for the timeout in milliseconds
	 * Defaults to 1000.
	 */
	public $minTimeout;
	/**
	 * @var integer the maximum length of time between requests
	 * Defaults to 8000.
	 */
	public $maxTimeout;
	/**
	 * @var integer if set to 2, timerInterval will double each time the response hasn't changed (up to maxTimeout)
	 * Defaults to 2.
	 */
	public $multiplier;
	/**
	 * @var string the response type - text, xml, json, etc.  See $.ajax config options
	 * Defaults to 'text'.
	 */
	public $type;

	/**
	 * @var array the javascript lines to handle the new data (only called when there was a change)
	 */
	public $callback;
	/**
	 * @var array the javascript lines
	 */
	public $autoStopCallback;

    /**
	 * @var array additional options that can be passed to the constructor of the js object.
	 */
	public $options=array();

	/**
	 * Initializes the widget.
	 * This method registers all needed client scripts 
	 */
	public function init()
	{
		if($this->url!==null)
			$this->url=CHtml::normalizeUrl($this->url);
        else
            throw new CException(Yii::t("JPeriodicalUpdater.main", 'JPeriodicalUpdater.url must be set!'));

      	$dir = dirname(__FILE__).DIRECTORY_SEPARATOR.'assets';
      	$baseUrl = CHtml::asset($dir);

  		$cs = Yii::app()->getClientScript();
		$cs->registerCoreScript('jquery');
        $cs->registerScriptFile($baseUrl.'/js/jquery.periodicalupdater.js');

		$options=$this->getClientOptions();
		$options=$options===array()?'{}' : CJavaScript::encode($options);

        $js  = "$.PeriodicalUpdater(";
        $js .= "$options,\n";
        $js .= (isset ($this->callback))
             ? $this->createCallbackScript($this->callback)
             : "\n";
        $js .= (isset ($this->autoStopCallback))
             ? ",\n".$this->createCallbackScript($this->autoStopCallback)."\n"
             : "\n";
        $js .= ");";
		$cs->registerScript('Yii.JPeriodicalUpdater#'.$this->Id, $js);
	}

	/**
	 * @return array the javascript options
	 */
	protected function getClientOptions()
	{
		$options=$this->options;
		foreach(array('url','method','sendData','minTimeout','maxTimeout','multiplier','type') as $name)
		{
			if($this->$name!==null)
				$options[$name]=$this->$name;
		}
		return $options;
	}

	/**
	 * @return string the javascript for callback functions
	 */
	protected function createCallbackScript(array $pieces)
	{
        $js = "function(data) {\n";
        $js .= implode(";\n", $pieces);
        $js .= "}";
		return $js;
	}
}
