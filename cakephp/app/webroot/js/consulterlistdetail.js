function checkbox(check){
	var caseId = check.id;
	var caseValue ='0';

	if(check.checked){
		caseValue='1';
	}


	$.ajax({
		async:true,
		type : "POST",
		url:"/PPIL/cakephp/Tasks/cocher/"+caseId+"/"+caseValue,
		success: function(error) {
		},
		error: function(){
		}
	});	

}


