function checkbox(check){
	var caseId = check.id;
	var caseValue ='0';

	if(check.checked){
		caseValue='1';
	}


	$.ajax({
		async:true,
		type : "POST",
		cache: false,
		url:"/PPIL/cakephp/Tasks/cocher/"+caseId+"/"+caseValue,

		success: function() {
			var link = $("#div"+caseId+" .ui-collapsible-heading a");

			if(check.checked){
				link.removeClass("ui-icon-none");
				link.addClass("ui-icon-check");
			}
			else {
				link.removeClass("ui-icon-check");
				link.addClass("ui-icon-none");
			}
		},

		error: function(){

		}
	});	

}


