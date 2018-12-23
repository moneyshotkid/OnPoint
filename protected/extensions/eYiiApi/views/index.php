<?php
if(isset($_POST['myiiapi'])  && !empty($_POST['search'])) {
    $this->failSearch();
} else {
    $this->beginWidget('zii.widgets.jui.CJuiDraggable', array(
        "options"=>array(
            "handle"=>"div.myiiapi-header"
        )   
    ));
    ?>

    <div class="myiiapi" style='position: fixed;'>
	    <div class="myiiapi-header">
        <div class="myiiapi-bar">
            <span>emyiiapi</span>
            <span id="myiiapi-bar-toggle" style="background: white" >_</span>
        </div>
            <?php 
            $form=$this->beginWidget('CActiveForm', array(
                'id'=>'myiiapi-form'
            )); 
		    echo CHtml::textField('search','',
                array('maxlength'=>45,
                'id'=>'myiiapi-search-text',
            ));
		    echo CHtml::hiddenField('myiiapi','1');
		    echo CHtml::ajaxSubmitButton('Search',
                Yii::app()->createUrl(''),
                array("success"=>"js: function(data) {
                    searchSuccess(data);
                }",
                ),
                array('id'=>'myiiapi-search-button')

            );
            $this->endWidget(); ?>
    	</div>
        <div class="myiiapi-content">
            <div class="myiiapi-item">
                <span class="myiiapi-item-header">
                    <a href='http://www.yiiframework.com/extension/emyiiapi' >emyiiapi</a>
                </span>
                <table class='detail-view' >
                    <tbody>
                <?php $information = Info::model()->findAll();
                $row = "odd";
                foreach($information as $info)
                {
                ?>
                    		<tr class='<?php echo $row;?>' >
                    			<th><?php echo $info->attribute; ?></th>
                    			<td><?php echo $info->value; ?></td>
                    		</tr>
                <?php
                    $row = ($row == "odd") ? "even" : "odd" ;
                }?>
                   </tbody>
                </table>
                <p>emyiiapi extension is quick reference of yii documentation 
                and is purpose is to be used in your current development application.                
                </p>
            </div>
        </div>
    </div>
    <?php 
    $this->endWidget();
}
