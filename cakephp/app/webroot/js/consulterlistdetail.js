$(document).ready(function () {


    // SUPPRIMER TACHE
    $("#DeleteTaskAnnule").click(function () {
        $("#popupDeleteTask").data("id", "null");
    });

    $("#popupDeleteTask").popup({
        afterclose: function (event, ui) {
            var id = $(this).data("id");

            if (id == "null") {
                return false;
            }

            $.ajax({
                async: true,
                type: "POST",
                cache: false,
                url: "/PPIL/cakephp/Tasks/supprimer/" + id,

                success: function () {
                    $("#div" + id).remove();
                },

                error: function () {
                }
            });


        }
    });
//****************************************

    //edit task

    $("a.editTask").click(function () {

        var id = this.name; // id tache

        var popup = $("#popupEditTask");
        popup.data("id", id);
        popup.popup("open");

        $("#editTaskOk").click(function () {

            var id = popup.data("id");

            var text = $.trim($("#editTaskName").val());

            if (id == "null") {
                return false;
            }

            $.ajax({
                async: true,
                type: "POST",
                cache: false,
                url: "/PPIL/cakephp/Tasks/modifyTask/" + id + "/" + text,

                success: function () {
                    popup.popup('close');


                    $("#nameTask" + id).text(text);
                },
                error: function (request) {
                    var erreur = request.responseText;
                    $("#erreurEditTask").empty();
                    $("#erreurEditTask").append(erreur);
                }
            });
            return false;
        });

        popup.bind({
            popupafterclose: function (event, ui) {
                $("#editTaskName").val('');
                $("#erreurEditTask").empty();

            }
        });


    });
//****************************************

//SUPPRIMER LISTE
    $("#deleteList").click(function () {


        $("#popupMenu").bind({
            popupafterclose: function (event, ui) {
                var popup = $("#DeleteList");
                popup.popup();
                popup.popup("open");
            }
        });
        $("#popupMenu").popup('close');
        return false;
    });
//****************************************

//ajout commentaire
    $("a.comment").on('click', function (event) {

        var id = this.name; // id tache
        var popup = $("#popupAddComment");
        popup.data("id", id);
        popup.popup("open");

        $("#commentCancel").click(function () {
            popup.data("id", "null");
        });

        popup.popup({
            afterclose: function (event, ui) {
                var id = $(this).data("id");

                var text = $.trim($("#inputTextCommment").val());
                $("#inputTextCommment").val('');

                if (id == "null") {
                    return false;
                }


                var text_i = text.replace(/ /gm, "___");

                $.ajax({
                    async: true,
                    type: "POST",
                    cache: false,
                    url: "/PPIL/cakephp/Commentary/newcommentary/" + id + "/" + text_i,

                    success: function (data) {
                        alert(data);
                        data = JSON.parse(data);

                        var liste = $("#listeCommentaire");

                        liste.append("<li>" + text + " </li> <div id='comment-name'>" + data['User']['firstname'] + " " + data['User']['name'] + "</div>");
                        //  $("#div" + id).remove();
                    },

                    error: function () {
                    }
                });

                return false;
            }
        });

    });

});
//****************************************


function cocher(check) {
    var caseId = check.id;
    var caseValue = '0';

    if (check.checked) {
        caseValue = '1';
    }


    $.ajax({
        async: true,
        type: "POST",
        cache: false,
        url: "/PPIL/cakephp/Tasks/cocher/" + caseId + "/" + caseValue,

        success: function () {
            var link = $("#div" + caseId + " .ui-collapsible-heading a");

            if (check.checked) {
                $("#div" + caseId).collapsible({
                    collapsedIcon: "check"
                });
                $("#div" + caseId).collapsible({
                    expandedIcon: "check"
                });
            }
            else {
                $("#div" + caseId).collapsible({
                    collapsedIcon: false
                });
            }

        },

        error: function () {


        }
    });

}

// ouverture popup confirmation pour supprimer tache
function deleteTask(id) {
    var popup = $("#popupDeleteTask");
    popup.data("id", id);
    popup.popup("open");
}

