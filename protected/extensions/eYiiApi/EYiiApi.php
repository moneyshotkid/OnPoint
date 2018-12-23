<?php
class EYiiApi extends CWidget
{
    const CL = "cl";
    const METH = "meth";
    const PROPER = "proper";

    private $detailAttributes = array(
        "cl"=>array(
            'cl_package',
            'cl_inheritance',
            'cl_subclasses',
            'cl_since',
            //'cl_version',
        ),
        'proper'=>array(
		    'pr_type', 
        	'pr_definedby', 
	    	'pr_access', 
		    //'pr_link', 
        ),
        'meth'=>array(
            'me_returns',
            'me_definedby',
            'me_access',
            //'me_link',
        ),
    );
    private $searchTypes = array(
        'property'      => '#^(?<class>\w[\w\d]*?)::\$(?<property>\w[\w\d]*?)$#',
        'method'        => '#^(?<class>\w[\w\d]*?)::(?<method>\w[\w\d]*?)\s*?(\(\))?#',
        'class'         => '#^(?<class>\w[\w\d]*?)$#',
    );
    private $css = null;
    /** 
     * If thte eyiiapi div should be a dialog.
     * 
     * @var boolean 
     **/
    private $dialog = false;

    public function init()
	{   
        Yii::import('application.extensions.EYiiApi.models.*');
        $this->registerScripts();
        parent::init();

	}
    public function run()
    {

        $this->render('index');
    }
    private function registerScripts()
    {
        $cs = Yii::app()->clientScript;

        if($this->css===null) {
            $epath = dirname(__FILE__).DIRECTORY_SEPARATOR;
            $cssPath = $epath.'css'.DIRECTORY_SEPARATOR;
            $cssFiles = array('myiiapi.css');

            $this->css = Yii::app()->getAssetManager()->publish($cssPath);
            $this->css .= DIRECTORY_SEPARATOR;
            foreach($cssFiles as $file)
            {
                $cs->registerCssFile($this->css.$file);
            }
        }
        if(!$cs->isScriptRegistered('jquery')) {
            $cs->registerCoreScript('jquery');
        }
        $jsAssetPath = Yii::app()->getAssetManager()->publish($epath.'eyiiapi.js');
        $cs->registerScriptFile($jsAssetPath, CClientScript::POS_HEAD);
    }
	public function failSearch()
	{
        if(isset($_POST['search'])) {
            $args = trim($_POST['search']);
            foreach( $this->searchTypes as $name => $pattern ) 
            {
                if(preg_match($pattern, $args, $matches))
                {
                    $functionName = 'search' . ucfirst($name);
                    if(!method_exists($this, $functionName))
                        continue;
                    $results = $this->$functionName($matches);
                }
            }
            if(isset($results)) echo $results;
            return;
        }
	}
    private function searchMethod($args)
    {
        $params = array(
            "cl_name"=>$args['class'],
            "me_name"=>$args['method'],
        );
        return $this->search($params, self::METH);
    }
    private function searchProperty($args)
    {
        $params = array(
            "cl_name"=>$args['class'],
            "pr_name"=>$args['property'],
        );
        return $this->search($params, self::PROPER);
    }
    private function searchClass($args)
    {
        $params = array(
            "cl_name"=>$args['class'],
        );
        return $this->search($params, self::CL);
    }
    private function search($params, $type)
    {   
        $modelName = ucfirst($type);
        $model = new $modelName('search');
        $model->unsetAttributes();
        if(!empty($params)) {
            foreach($params as $attr=>$value)
            {
                $model->{$attr} = $value;
            }
        }
        $prefix = substr($type, 0 , 2);

        $html = null;
        $html .= $this->render("default/_view", array(
            'results'=>$model->search(), 
            'attributes'=>$this->attrs($type),
            'prefix'=>$prefix
        ),true, false);
        
        return (empty($html)) ? "No result found." : $html;
    }
    private function attrs($type)
    {
        return $this->detailAttributes[$type];
    }
}
