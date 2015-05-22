function removeMember(link) {

    var id = link.id;
    var id_liste = $("#idliste").text();


    $.ajax({
            async: true,
            type: "POST",
            cache: false,
                url: "/PPIL/cakephp/Todolists/removeMember/"+id_liste+"/"+id,

            success: function () {

                $("#ligne" + id).remove();
                $("#flash").empty().append("utilisateur supprimé");

            },

            error: function (xhr, ajaxOptions, thrownError) {
              //  alert(xhr.status);
            }
        }
    );


}

$(function() {
    $(".ajax").click(function() {
        return false;
    });
});