function removeMember(link) {


    var id = link.id;
    var id_liste = $("#idliste").text();

    alert(id);
    alert(id_liste);

    $.ajax({
            async: true,
            type: "POST",
            cache: false,
            url: "/PPILFINAL/PPIL/cakephp/Users/removeMember/"+id,

            success: function () {

                $("#ligne" + id).remove();
                $("#flash").empty().append("utilisateur supprimé");

            },

            error: function (xhr, ajaxOptions, thrownError) {
                alert(xhr.status);
                alert(thrownError);
            }
        }
    );


}

$(function() {
    $(".ajax").click(function() {
        return false;
    });
});