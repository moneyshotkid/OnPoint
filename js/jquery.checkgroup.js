//edit by cuongvv
//for multi group and max item can choose
//15/10/2009
//v1.1
(function($){
	$.fn.checkgroup = function(options){
		//merge settings
		settings=$.extend({
			groupSelector:null,
			maxItem:0,
			enabledOnly:false,
			message:null,
			onComplete:null,
			onChange:null
		},options || {});

		var ctrl_box=this;

		//allow a group selector override option
		var grp_slctr = (settings.groupSelector==null) ? 'myGroup' : settings.groupSelector;
		settings.message = (settings.message==null) ? 'Only pick' : settings.message;		
		var grp_data = settings;
		
		//setup the callback functions
		var _onComplete = settings.onComplete;
		var _onChange = settings.onChange;

		//internal functions
		_ctrl_box_autoenable = function (cur_grp,maxItem,e,mess){
			if(cur_grp!=null){
				if((maxItem>0) && ($(cur_grp+':checked').size()>maxItem)){
					$(e).attr('checked',false);
					alert(mess+" "+maxItem+"!");
				}
				else{
					if($(cur_grp).size()==$(cur_grp+':checked').size()){
						$(cur_grp+"_checkall").attr('checked',true);
					}
				}
			}
		}
		_ctrl_box_autodisable = function(cur_grp){
			$(cur_grp+"_checkall").attr('checked',false);
		}

		//grab only enabled checkboxes if required
		if(settings.enabledOnly){
			grp_slctr += ':enabled';
		}
		//attach click event to the "check all" checkbox(s)
		ctrl_box.click(function(e){
			cur_grp = grp_data.groupSelector;
			var chk_val=(e.target.checked);
			if(chk_val==true){
				if((grp_data.maxItem>0) && ($(cur_grp).size()>grp_data.maxItem)){
					$(cur_grp+"_checkall").attr('checked',false);
					alert(grp_data.message+" "+grp_data.maxItem+"!");
				}
				else{
					$(cur_grp).attr('checked',chk_val);
				}
			}
			else{
				$(cur_grp).attr('checked',chk_val);
			}
		});
		//attach click event to checkboxes in the "group"
		$(grp_slctr).click(function(){
			cur_grp = grp_data.groupSelector;
			if(!this.checked){
				_ctrl_box_autodisable(cur_grp);
			}
			else{
				_ctrl_box_autoenable(cur_grp,grp_data.maxItem,this,grp_data.message);
			}
		});

		//make this function chainable within jquery
		return this;
	};
})(jQuery);