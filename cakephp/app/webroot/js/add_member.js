$(document).ready(function () {
});


function add_member(link) {


    var id = link.id;

    var id_liste = $("#idliste").text();

    $.ajax({
            async: true,
            type: "POST",
            cache: false,
            url: "/PPIL/cakephp/Users/addListetoUser/" +id+"/"+id_liste,

            success: function () {

               $("#ligne" + id).remove();
                $("#flash").empty().append("utilisateur"+ id+" ajouté");

            },

            error: function (xhr, ajaxOptions, thrownError) {
              //  alert(xhr.status);
              //  alert(thrownError);
            }
        }
    );


}

$(function() {
    $(".ajax").click(function() {
        return false;
    });
});