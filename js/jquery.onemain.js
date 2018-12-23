$(function(){
    //original field values
    var field_values = {
            //id        :  value
            'company'  : 'Cultivator Name',
            'address'  : 'Address',
			'zip':'Zip Code',
            'email' : 'email',
			   'cost'  : 'Cost',
            'phone'  : 'phone',
            'Vendor_representative'  : 'Representative',
            'notes'  : 'notes',
			    'weight' : 'weight',
            'duedate'  : 'Date Due',
            'total'  : 'total',
			     'tags'  : 'tags,tag',
			     'qty'  : 'Qty',
				  'Strain'  : 'Strain Name',
            'notes'  : 'notes',
			'Inventory_cpg':'1 G',
			'Inventory_twograms':'2 G',
			'Inventory_eigth':'3.5 G',
			'Inventory_fourgrams':'4 G'
    };


    //inputfocus
    $('input#Vendor_company').inputfocus({ value: field_values['company'] });
    $('input#Vendor_address').inputfocus({ value: field_values['address'] });
	    $('input#Vendor_zip').inputfocus({ value: field_values['zip'] });
    $('input#Vendor_email').inputfocus({ value: field_values['email'] }); 
    $('input#Vendor_phone').inputfocus({ value: field_values['phone'] });
    $('input#Vendor_representative').inputfocus({ value: field_values['Vendor_representative'] });
    $('input#Vendor_notes').inputfocus({ value: field_values['notes'] }); 
    $('input#weight').inputfocus({ value: field_values['weight'] });
	$('input#Inventory_cost').inputfocus({ value: field_values['cost'] });
		$('input#Inventory_strain').inputfocus({ value: field_values['Strain'] });
    $('input#Inventory_duedate').inputfocus({ value: field_values['duedate'] });
	    $('input#Inventory_tags').inputfocus({ value: field_values['tags'] });
    $('input#quantity').inputfocus({ value: field_values['weight'] }); 
    $('input#total').inputfocus({ value: field_values['total'] });
    $('input#Vendor_representative').inputfocus({ value: field_values['Vendor_representative'] });
    $('input#Vendor_notes').inputfocus({ value: field_values['notes'] }); 
 $('.qty').inputfocus({ value: field_values['qty'] });
 $('input#Inventory_cpg').inputfocus({ value: field_values['Inventory_cpg'] });
$('input#Inventory_twograms').inputfocus({ value: field_values['Inventory_twograms'] });
  $('input#Inventory_eigth').inputfocus({ value: field_values['Inventory_eigth'] });
$('input#Inventory_fourgrams').inputfocus({ value: field_values['Inventory_fourgrams'] });



});