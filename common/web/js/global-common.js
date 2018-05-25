$(document).ready(function(){
	//fadeout flash message
	$(".alert").delay(10000).slideUp(500);
	
	//Global multiselect
	if($.fn.multiSelect){
    	$('.hc-multiselect').multiSelect({
            selectableHeader: "<div class='custom-header'>Selectable</div>",
            selectionHeader: "<div class='custom-header'>Selected</div>",
        });
    }

    //GLOBAL TOGGLE SWITCH
    $('.btn-toggle').click(function() {
        $(this).find('.btn').toggleClass('active');  
        
        if ($(this).find('.btn-primary').size()>0) {
            $(this).find('.btn').toggleClass('btn-primary');
        }
        if ($(this).find('.btn-danger').size()>0) {
            $(this).find('.btn').toggleClass('btn-danger');
        }
        if ($(this).find('.btn-success').size()>0) {
            $(this).find('.btn').toggleClass('btn-success');
        }
        if ($(this).find('.btn-info').size()>0) {
            $(this).find('.btn').toggleClass('btn-info');
        }
        
        $(this).find('.btn').toggleClass('btn-default');
        var URL = BASE_URL + '/global-settings/maintenance-mode';
        var DATA = {'is_active': $(this).find('.btn.active').val()};
        var METHOD = 'POST';
        //SAVE MAINTENANCE MODE
        normalAjax(URL, DATA, METHOD);
        console.log($(this).find('.btn.active').val());       
    });

    //PASSWORD FIELD TEXT OR PASSWORD
    $('.password-visible').click(function(){
    	if($(this).find('i').hasClass('fa-eye-slash'))
    	{
    		$(this).parents('.row').find('.passwordInput').attr('type', 'text');
    		$(this).find('i').removeClass('fa-eye-slash').addClass('fa-eye');
    	}
    	else
    	{
    		$(this).parents('.row').find('.passwordInput').attr('type', 'password');
			$(this).find('i').removeClass('fa-eye').addClass('fa-eye-slash');	
    	}
    })
    
    //GET STATES BY COUNTRY
    $('#users-country_id').change(function(){
    	var URL = BASE_URL + '/common/get-states-by-country';
    	var DATA = {country_id: $(this).val()};
    	var resultData = normalAjax(URL, DATA, 'POST');
    	$('#users-state_id').html(resultData);
    });

    //GET CITIES BY STATES
    $('#users-state_id').change(function(){
    	var URL = BASE_URL + '/common/get-cities-by-state';
    	var DATA = {state_id: $(this).val()};
    	var resultData = normalAjax(URL, DATA, 'POST');
    	$('#users-city_id').html(resultData);
    });
});
//NORMAL GLOBAL AJAX FUNCTION
function normalAjax(URL, DATA, METHOD){
	var returnResult;
	$.ajax({
	  	url: URL,
	  	method: METHOD,
		data: DATA,
		async: false,  
	}).success(function(result) {
        if(result)
        {
	  	    var rawData = jQuery.parseJSON(result);
	  	    returnResult = rawData;
        }
	});
	return returnResult;
}
