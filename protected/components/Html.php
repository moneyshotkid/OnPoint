<?php


class Html
{

	/**
	 * Create a link (a tag) that loads a page into the content area using ajax.
	 *
	 * @param	string						target (without #)
	 * @param	array						additional html attributes
	 * @param	content						inner contnent of tag
	 * @param	bool						close tag
	 * @return	string
	 */
	public static function ajaxLink($target, array $htmloptions = array(), $content = null, $close = false)
	{
		if(strpos(strtolower($target), 'javascript:') === 0)
		{
			$htmloptions['href'] = $target;
		}
		else
		{
			if(Yii::app()->getUrlManager()->showScriptName)
			{
				$scriptUrl = basename($_SERVER['SCRIPT_NAME']);
				if(strpos($_SERVER['REQUEST_URI'], $scriptUrl) === false && strpos($target, $scriptUrl) === false)
				{
					$target = $scriptUrl . "/" . $target;
				}
			}
			
			$htmloptions['href'] = '#' . $target;
			$htmloptions['onclick'] = 'chive.goto("' . $target . '"); return false;';
		}
		
		return CHtml::tag('a', $htmloptions, $content, $close);
	}

	/**
	 * Creates an image tag that points to an icon in the choosen icon pack.
	 *
	 * @param	string						icon name
	 * @param	string						size
	 * @param	bool						show icon as disabled
	 * @param	string						text to use for alt/title attributes
	 * @param	array						additional html attributes
	 * @return	string
	 */
	public static function icon($name, $size = 16, $disabled = false, $text = null, array $htmloptions = array())
	{
		// Text
		if($text)
		{
			if(strpos($text, 'plain:') === 0)
			{
				$text = substr($text, 6);
			}
			else
			{
				list($category, $var) = explode('.', $text);
				$text = Yii::t($category, $var);
			}
			$htmloptions['title'] = $text;
		}

		// Classes
		$classes = 'icon icon' . $size . ' icon_' . $name . ($disabled ? ' disabled' : '');
		if(isset($htmloptions['class']))
		{
			$htmloptions['class'] .= ' ' . $classes;
		}
		else
		{
			$htmloptions['class'] = $classes;
		}

		// Return image
		return CHtml::image(ICONPATH . '/' . $size . '/' . $name . '.png', $text, $htmloptions);
	}

	/**
	 * Returns the form icon buttons submit and cancel.
	 *
	 * @param	bool						include container
	 * @param	bool						include submit button
	 * @param	bool						include cancel button
	 * @return	string
	 */
	public static function submitFormArea($container = true, $submit = true, $cancel = true)
	{
		if($submit)
		{
			$submitButton = '<a href="javascript:void(0)" onclick="$(\'#' . CHtml::$idPrefix . '\').submit()" class="icon button primary">'
					. Html::icon('save')
					. '<span>' . Yii::t('core', 'save') . '</span>'
				. '</a>'
				. CHtml::submitButton(Yii::t('core', 'save'), array('style' => 'display: none'));
		}
		else
		{
			$submitButton = '';
		}

		if($cancel)
		{
			$cancelButton = '<a href="javascript:void(0)" onclick="$(\'#' . CHtml::$idPrefix . '\').slideUp(500, function() { $(this).parents(\'tr\').remove(); })" class="icon button">'
					. Html::icon('delete')
					. '<span>' . Yii::t('core', 'cancel') . '</span>'
				. '</a>';
		}
		else
		{
			$cancelButton = '';
		}

		if($container)
		{
			return '<div class="buttonContainer">' . $submitButton . $cancelButton . '</div>';
		}
		else
		{
			return $submitButton . $cancelButton;
		}

	}

}