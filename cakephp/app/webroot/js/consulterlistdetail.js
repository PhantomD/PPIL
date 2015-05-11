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

            var popup = $("#popupEditTask");
            var id = popup.data("id");

            var text = $.trim($("#editTaskName").val());

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
    //erreurCommentTask
//ajout commentaire
    $("a.comment").on('click', function (event) {

        var id = this.name; // id tache
        var popup = $("#popupAddComment");
        popup.data("id", id);
        popup.popup("open");

        $("#commentOk").click(function () {

            var popup = $("#popupAddComment");
            var id = popup.data("id");

            var text = $.trim($("#inputTextCommment").val());

            var text_i = text.replace(/ /gm, "___");

            $.ajax({
                async: true,
                type: "POST",
                cache: false,
                url: "/PPIL/cakephp/Commentary/newcommentary/" + id + "/" + text_i,

                success: function (data) {
                    data = JSON.parse(data);

                    var liste = $("#listeCommentaire" + id);

                    liste.append("<li>" + text + " </li> <div id='comment-name'>" + data['User']['firstname'] + " " + data['User']['name'] + "</div>");
                    //  $("#div" + id).remove();
                    popup.popup('close');
                },
                error: function (request) {
                    var erreur = request.responseText;
                    $("#erreurCommentTask").empty();
                    $("#erreurCommentTask").append(erreur);

                }
            });
            return false;

        });
        popup.popup({
            afterclose: function (event, ui) {
                $("#inputTextCommment").val('');
                $("#erreurCommentTask").empty();
            }
        });

    });

    $("#newTaskOk").click(function () {
        $("#erreurNewTask").empty();
        var text = $.trim($("#inputNameNewTask").val());

        if (text == "") {
            $("#erreurNewTask").append("champ nom tâche vide");
            return false;
        }

        var regex = /^[a-zA-Z0-9 ]*$/;

        if (!regex.test(text)) {
            $("#erreurNewTask").append("le nom de la tâche est incorrect (alphanumérique)");
            return false;
        }

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
        error: function (request) {
            var erreur = request.responseText;
            ;
            $("#erreurTask" + caseId).append("<p class='flash-message-error' style='text-align:center' > la tâche à déjà été choisie </p>");

            setTimeout(function () {
                $("#erreurTask" + caseId).empty();
            }, 2000);
        }

    });

}

// ouverture popup confirmation pour supprimer tache
function deleteTask(id) {
    var popup = $("#popupDeleteTask");
    popup.data("id", id);
    popup.popup("open");
}

