$(function () {

    $(document).off("click", ".form-edit-mesin-absen")
        .on("click", ".form-edit-mesin-absen", function () {
            var idmesin = $(this).attr("idmesin");

            modalInfo('Loading please wait... <span id="progress_load_subpage"></span>', "hide-btn", "medium", "Edit Mesin Absen");
            setTimeout(function () {
                if ($("#progress_load_subpage img").length === 0) {
                    $("#progress_load_subpage").html('<img src="ajax-loading.gif" style="margin-right:5px;">');
                    $.post("dashboard-admin-mesin-absen-edit-form-popup.html", { idmesin: idmesin },
                        function (data) {
                            $("#progress_load_subpage img").remove();
                            modalInfo(data, "hide-btn", "medium", "Edit Mesin Absen");

                        }).fail(function () { $("#progress_load_subpage img").remove(); alert('Connection Failed'); });
                }
            }, 200);
        });

    $(document).off("click", ".form-tambah-mesin-absen")
        .on("click", ".form-tambah-mesin-absen", function () {
            modalInfo('Loading please wait... <span id="progress_load_subpage"></span>', "hide-btn", "medium", "Tambah Mesin Absen");
            setTimeout(function () {
                if ($("#progress_load_subpage img").length === 0) {
                    $("#progress_load_subpage").html('<img src="ajax-loading.gif" style="margin-right:5px;">');
                    $.post("dashboard-admin-mesin-absen-tambah-form-popup.html", {},
                        function (data) {
                            $("#progress_load_subpage img").remove();
                            modalInfo(data, "hide-btn", "medium", "Tambah Mesin Absen");

                        }).fail(function () { $("#progress_load_subpage img").remove(); alert('Connection Failed'); });
                }
            }, 200);
        });

    $(document).off("click", "#TambahDataMesin")
        .on("click", "#TambahDataMesin", function () {
            var idcabang = $("#idcabang").val();
            var serial_number = $("#serial_number").val();
            var status_layanan = $("#status_layanan").val();
            var textBtn = $("#TambahDataMesin").html();
            var inputElm = $("#idcabang, #serial_number, #status_layanan, #TambahDataMesin");

            if ($("#TambahDataMesin img").length === 0) {
                inputElm.prop("disabled", true);
                $("#TambahDataMesin").html('<img src="ajax-loading.gif"">');
                $.post("ajax-dashboard-admin-mesin-absen-tambah.html",
                    {
                        idcabang: idcabang,
                        serial_number: serial_number,
                        status_layanan: status_layanan
                    },
                    function (data) {
                        inputElm.prop("disabled", false);
                        $("#TambahDataMesin").html(textBtn);

                        var data = isJSON(data) ? JSON.parse(data) : { "respon": data };
                        if (data.respon == "success") {
                            loadSubPage("reload");
                            alert("Data berhasil ditambahkan");
                        }
                        else alert(data.respon);

                    }).fail(function () { inputElm.prop("disabled", false); $("#TambahDataMesin").html(textBtn); alert('Connection Failed'); });
            }
        });

    $(document).off("click", "#SimpanDataMesin")
        .on("click", "#SimpanDataMesin", function () {
            var idmesin = $("#idmesin").val();
            var idcabang = $("#idcabang").val();
            var serial_number = $("#serial_number").val();
            var status_layanan = $("#status_layanan").val();
            var textBtn = $("#SimpanDataMesin").html();
            var inputElm = $("#idcabang, #serial_number, #status_layanan, #SimpanDataMesin");

            if ($("#SimpanDataMesin img").length === 0) {
                inputElm.prop("disabled", true);
                $("#SimpanDataMesin").html('<img src="ajax-loading.gif"">');
                $.post("ajax-dashboard-admin-mesin-absen-edit.html",
                    {
                        idmesin: idmesin,
                        idcabang: idcabang,
                        serial_number: serial_number,
                        status_layanan: status_layanan
                    },
                    function (data) {
                        inputElm.prop("disabled", false);
                        $("#SimpanDataMesin").html(textBtn);

                        var data = isJSON(data) ? JSON.parse(data) : { "respon": data };
                        if (data.respon == "success") {
                            loadSubPage("reload");
                            alert("Data berhasil disimpan");
                        }
                        else alert(data.respon);

                    }).fail(function () { inputElm.prop("disabled", false); $("#SimpanDataMesin").html(textBtn); alert('Connection Failed'); });
            }
        });

    $(document).off("click", ".hapus-mesin-absen")
        .on("click", ".hapus-mesin-absen", function () {
            var idmesin = $(this).attr("idmesin");
            var textBtn = $("#actbtn_mesin_absen" + idmesin).html();

            if ($("#actbtn_mesin_absen" + idmesin + " img").length === 0 && confirm("Konfirmasi Hapus?")) {
                $("#actbtn_mesin_absen" + idmesin).html('<img src="ajax-loading.gif"">');
                $.post("ajax-dashboard-admin-mesin-absen-hapus.html", { idmesin: idmesin },
                    function (data) {
                        $("#actbtn_mesin_absen" + idmesin).html(textBtn);

                        var data = isJSON(data) ? JSON.parse(data) : { "respon": data };
                        if (data.respon == "success") {
                            $("#row_mesin_absen" + idmesin).remove();
                        }
                        else alert(data.respon);

                    }).fail(function () { $("#actbtn_mesin_absen" + idmesin).html(textBtn); alert('Connection Failed'); });
            }
        });

});