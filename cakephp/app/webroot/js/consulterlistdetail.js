$(document).ready(function() {

	$( "#DeleteTaskAnnule" ).click(function() {
		$("#popupDeleteTask" ).data("id","null");
	});

	$( "#popupDeleteTask" ).popup({
		afterclose: function( event, ui ) {
			var id= $(this).data("id");

			if(id=="null"){
				return false;
			}

		$.ajax({
		async:true,
		type : "POST",
		cache: false,
		url:"/PPIL/cakephp/Tasks/supprimer/"+id,

		success: function() {
	$("#div"+id).remove();
		},

		error: function(){
		}
	});










		}
	});








});

function cocher(check){
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
				$("#div"+caseId).collapsible({
					collapsedIcon: "check"
				});
				$("#div"+caseId).collapsible({
					expandedIcon: "check"
				});
			}
			else {
				$("#div"+caseId).collapsible({
					collapsedIcon: false
				});
			}

		},

		error: function(){

		}
	});	

}

function deleteTask(id){
	var popup = $( "#popupDeleteTask" );
	popup.data("id", id);
	popup.popup("open");
}

