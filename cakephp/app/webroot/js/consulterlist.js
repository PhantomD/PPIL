$(document).ready(function () {

    refresh();

    function refresh() {


        setTimeout(function () {

            $.ajax({
                async: true,
                type: "GET",
                cache: false,
                url: "/PPIL/cakephp/Todolists/refresh",
                success: function (data) {

                    if (data) {
                        data = JSON.parse(data);

                        // partie pour ajouter et pour supprimer
                        $.each(data, function (index, value) {

                            if (index === 'listeAdd') {

                                // savoir dans quelle partie ajouter
                                $.each(value, function (index, value) {

                                    if (index == 'today') {
                                        var table = $("#table_tache_listes_today tbody");
                                    } else if (index == 'week') {
                                        var table = $("#table_tache_listes_week tbody");
                                    } else {
                                        var table = $("#table_tache_listes_other tbody");
                                    }

                                    // pour chaque liste de la bonne table
                                    $.each(value, function (index, value) {

                                        var id = value['id'];
                                        var name = value['name'];

                                        table.append(" <tr>" +
                                        " <td>" + name + "</td>" +
                                        " <td class = 'fleche'> <a class='ui-link' href='/PPIL/cakephp/Todolists/consulterlistdetail/" + id + "' data-ajax=false>" +
                                        "<img src='/PPIL/cakephp/img/fleche-droite-grise.png' alt=''></a> </td>" +
                                        "</tr>");

                                    });
                                });
                            } else if (index === 'listeRemove') {

                                $.each(value, function (index, id_liste) {
                                    $("#ligneListe" + id_liste).remove();
                                });


                            }

                        });
                    }
                },
                error: function () {
                }
            });

            refresh();
        }, 10000);

    }

})
;
