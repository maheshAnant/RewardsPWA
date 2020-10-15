function confirmDelete(id, controller_name) {
    $("#model_status").text("are you sure want to delete this ?");
    $("#model_btn").click(function () {
        $.ajax({
            type: "POST",
            data: {id: id},
            url: urls + controller_name + "/delete/",
            cache: false,
            success: function (data) {
                window.location.href = urls + controller_name;
            }
        });
    });
}

function saveRole(action) {
    $(".ajaxLoader").fadeIn();
    $.ajax({
        url: urls + "role/" + action,
        type: "POST",
        dataType: "json",
        data: $('form#roleForm').serialize(),
        success: function (data, textStatus, jqXHR)
        {
            if (data.status == 'failure')
            {
                $(".ajaxLoader").fadeOut();
                error_msg(data.error, 'id');
            } else
            {
                if (data.status == 'error') {
                    $(".ajaxLoader").fadeOut();
                    showMsgPopup("Error", data.data, '', 'error');
                } else {
                    showMsgPopup(data.status, data.data, urls + 'role', 'normal');
                }
            }
        },
        error: function (jqXHR, textStatus, errorThrown)
        {

        }
    });
}

function saveUser() {
    $(".ajaxLoader").fadeIn();
    $.ajax({
        url: urls + "users/store",
        type: "POST",
        dataType: "json",
        data: $('form#userForm').serialize(),
        success: function (data, textStatus, jqXHR)
        {
            if (data.status == 'failure')
            {
                $(".ajaxLoader").fadeOut();
                error_msg(data.error, 'id');
            } else
            {
                if (data.status == 'error') {
                    $(".ajaxLoader").fadeOut();
                    showMsgPopup("Error", data.data, '', 'error');
                } else {
                    var page_url = urls + 'users';
                    showMsgPopup(data.status, data.data, page_url, 'normal');
                }
            }
        },
        error: function (jqXHR, textStatus, errorThrown)
        {

        }
    });
}

function updateUser() {
    $(".ajaxLoader").fadeIn();
    $.ajax({
        url: urls + "users/update",
        type: "POST",
        dataType: "json",
        data: $('form#userForm').serialize(),
        success: function (data, textStatus, jqXHR)
        {
            if (data.status == 'failure')
            {
                $(".ajaxLoader").fadeOut();
                error_msg(data.error, 'id');
            } else
            {
                if (data.status == 'error') {
                    $(".ajaxLoader").fadeOut();
                    showMsgPopup("Error", data.data, '', 'error');
                } else {
                    var page_url = urls + 'users';
                    showMsgPopup(data.status, data.data, page_url, 'normal');
                }
            }
        },
        error: function (jqXHR, textStatus, errorThrown)
        {

        }
    });
}

function save_ka_user(event) {
    $(event).attr("disabled", true);
    $(".ajaxLoader").fadeIn();
    $.ajax({
        url: urls + "ka_users/store",
        type: "POST",
        dataType: "json",
        data: $('form#kauserForm').serialize(),
        success: function (data, textStatus, jqXHR)
        {
            if (data.status == 'failure')
            {
                $(".ajaxLoader").fadeOut();
                error_msg(data.error, 'id');
                $(event).removeAttr("disabled");
            } else
            {
                if (data.status == 'error')
                {
                    $(".ajaxLoader").fadeOut();
                    showMsgPopup("Error", data.data, '', 'error');
                    $(event).removeAttr("disabled");
                } else
                {
                    var page_url = urls + 'ka_users/edit/' + data.id;
                    showMsgPopup(data.status, data.data, page_url, 'normal');
                }
            }
        },
        error: function (jqXHR, textStatus, errorThrown) { }
    });
}

function save_datafields() {
    $(".ajaxLoader").fadeIn();
    $.ajax({
        url: urls + "datafields/addEdit",
        type: "POST",
        dataType: "json",
        data: $('form#datafieldsForm').serialize(),
        success: function (data, textStatus, jqXHR)
        {
            if (data.status == 'failuer') {
                $(".ajaxLoader").fadeOut();
                error_msg(data.error, 'id');
            } else {
                if (data.status == 'error') {
                    $(".ajaxLoader").fadeOut();
                    showMsgPopup('Error', data.data, '', 'error');
                } else {
                    var page_url = urls + 'datafields';
                    showMsgPopup(data.status, data.data, page_url, 'normal')
                }
            }
        },
        error: function (jqXHR, textStatus, errorThrown) { }
    });
}

function save_news() {
    var formData = new FormData(document.querySelector('form'));
    $(".ajaxLoader").fadeIn();
    $.ajax({
        url: urls + "news_updates/addEdit",
        type: "POST",
        dataType: "json",
        contentType: false,
        processData: false,
        data: formData,
        success: function (data, textStatus, jqXHR) {
            if (data.status == 'failuer') {
                error_msg(data.error);
            } else {
                if (data.status == 'error') {
                    $(".ajaxLoader").fadeOut();

                    //  showMsgPopup(data.status, data.data, '', 'error');
                } else {
                    var page_url = urls + 'news_updates';
                    showMsgPopup(data.status, data.data, page_url, 'normal');
                }
            }
        },
        error: function (jqXHR, textStatus, errorThrown) {}
    });
}

function save_project_type() {
    $(".ajaxLoader").fadeIn();
    $.ajax({
        url: urls + "project_types/save",
        type: "POST",
        dataType: "json",
        data: $('form#projecttypeForm').serialize(),
        success: function (data, textStatus, jqXHR)
        {
            if (data.status == 'failure') {
                $(".ajaxLoader").fadeOut();
                error_msg(data.error, 'id');
            } else {
                if (data.status == 'error') {
                    $(".ajaxLoader").fadeOut();
                    showMsgPopup('Error', data.data, '', 'error');
                } else {
                    var page_url = urls + 'project_types';
                    showMsgPopup(data.status, data.data, page_url, 'normal')
                }
            }
        },
        error: function (jqXHR, textStatus, errorThrown) {}
    });
}

function saveproject(action) {
    $(".ajaxLoader").fadeIn();
    if (action == 'update')
        type = "PUT";
    else
        type = "POST";
    $.ajax({
        url: urls + "project/" + action,
        type: type,
        dataType: "json",
        data: $('form#projectForm').serialize(),
        success: function (data, textStatus, jqXHR)
        {
            console.log();
            if (data.status == 'failure') {
                $(".ajaxLoader").fadeOut();
                error_msg(data.error, 'id');
            } else {
                if (data.status == 'error') {
                    $(".ajaxLoader").fadeOut();
                    showMsgPopup("Error", data.data, '', 'error');
                } else {
                    showMsgPopup(data.status, data.data, urls + 'project/edit/' + data.id, 'normal');
                }
            }
        },
        error: function (jqXHR, textStatus, errorThrown)
        {

        }
    });
}

function delete_record(controller, id) {
    if (confirm("Are you sure you want to delete this record!") == true) {
        $(".ajaxLoader").fadeIn();
        $.ajax({
            type: "POST",
            data: {id: id},
            dataType: "json",
            url: urls + controller + '/delete',
            cache: false,
            success: function (data) {
                showMsgPopup('Success', "Record Deactivted Successfully.", urls + controller, 'normal');
            }
        });
    }

}

function delete_project_template(id) {
    if (confirm("Are you sure you want to delete this record!") == true) {
        $(".ajaxLoader").fadeIn();
        $.ajax({
            type: "GET",
            data: {},
            dataType: "json",
            url: urls + 'project_templates/delete/' + id,
            cache: false,
            success: function (data) {
                if (data.status == 'error') {
                    showMsgPopup("Error", data.data, '', 'error');
                } else {
                    showMsgPopup(data.status, data.data, urls + 'project_templates', 'normal');
                }

            }
        });
    }

}

function delete_ka_user(id) {
    if (confirm("Are you sure you want to delete this user!") == true) {
        $(".ajaxLoader").fadeIn();
        $.ajax({
            type: "POST",
            data: {id: id},
            dataType: "json",
            url: urls + "ka_users/delete",
            cache: false,
            success: function (data) {
                showMsgPopup(data.status, data.data, urls + 'ka_users', 'error');
            }
        });
    }

}

function delete_user(id) {
    if (confirm("Are you sure you want to delete this user!") == true) {
        $(".ajaxLoader").fadeIn();
        $.ajax({
            type: "GET",
            data: {},
            dataType: "json",
            url: urls + "users/delete/" + id,
            cache: false,
            success: function (data) {

                if (data.status == 'error') {
                    showMsgPopup("Error", data.data, '', 'error');
                } else {
                    showMsgPopup(data.status, data.data, urls + 'users', 'normal');
                }
            }
        });
    }

}

function deactivate_user(id) {
    if (confirm("Are you sure you want to deactivate this user!") == true) {
        $(".ajaxLoader").fadeIn();
        $.ajax({
            type: "POST",
            data: {},
            dataType: "json",
            url: urls + "users/change_status/",
            data: {status: '2', 'id': id},
            success: function (data) {

                if (data.status == 'error') {
                    showMsgPopup("Error", data.data, '', 'error');
                } else {
                    showMsgPopup(data.status, 'User deactivate successfully', urls + 'users', 'normal');
                }
            }
        });
    }

}

function activate_user(id) {
    if (confirm("Are you sure you want to activate this user!") == true) {
        $(".ajaxLoader").fadeIn();
        $.ajax({
            type: "POST",
            data: {},
            dataType: "json",
            url: urls + "users/change_status/",
            data: {status: '1', 'id': id},
            success: function (data) {

                if (data.status == 'error') {
                    showMsgPopup("Error", data.data, '', 'error');
                } else {
                    showMsgPopup(data.status, 'User activate successfully', urls + 'users', 'normal');
                }
            }
        });
    }

}

function deactivate_ka_user(id) {
    if (confirm("Are you sure you want to deactivate this user!") == true) {
        $(".ajaxLoader").fadeIn();
        $.ajax({
            type: "POST",
            data: {},
            dataType: "json",
            url: urls + "ka_users/change_status/",
            data: {status: '2', 'id': id},
            success: function (data) {

                if (data.status == 'error') {
                    showMsgPopup("Error", data.data, '', 'error');
                } else {
                    showMsgPopup(data.status, data.data, urls + 'ka_users', 'normal');
                }
            }
        });
    }

}

function activate_ka_user(id) {
    if (confirm("Are you sure you want to activate this user!") == true) {
        $(".ajaxLoader").fadeIn();
        $.ajax({
            type: "POST",
            data: {},
            dataType: "json",
            url: urls + "ka_users/change_status/",
            data: {status: '1', 'id': id},
            success: function (data) {

                if (data.status == 'error') {
                    showMsgPopup("Error", data.data, '', 'error');
                } else {
                    showMsgPopup(data.status, data.data, urls + 'ka_users', 'normal');
                }
            }
        });
    }

}

function deactive_record(controller_name, id, value) {
    $(".ajaxLoader").fadeIn();
    $.ajax({
        type: "POST",
        data: {id: id, value: value},
        dataType: "json",
        url: urls + controller_name + "/deactive",
        cache: false,
        success: function (data) {
            if (controller_name == 'User')
                controller_name = 'Users';
            showMsgPopup('Success', "Record Deactivted Successfully.", urls + controller_name, 'normal');
        }
    });
}

function savecenter(action) {
    $(".ajaxLoader").fadeIn();
    $.ajax({
        url: urls + "center/" + action,
        type: "POST",
        dataType: "json",
        data: $('form#centerForm').serialize(),
        success: function (data, textStatus, jqXHR)
        {
            if (data.status == 'failure') {
                $(".ajaxLoader").fadeOut();
                error_msg(data.error, 'id');
            } else {
                if (data.status == 'error') {
                    $(".ajaxLoader").fadeOut();
                    showMsgPopup("Error", data.data, '', 'error');
                } else {
                    showMsgPopup(data.status, data.data, urls + 'center', 'normal');
                }
            }
        },
        error: function (jqXHR, textStatus, errorThrown)
        {

        }
    });
}

function create_modal(status, center_name, id, controller, redirect, text_msg, full_redirect) {
    if (typeof (redirect) === 'undefined')
        redirect = "";
    if (typeof (text_msg) === 'undefined')
        text_msg = "";
    if (typeof (full_redirect) === 'undefined')
        full_redirect = "";


    if (status == 1) {
        status_txt = "Enabled";
        newstatus_txt = "Disabled";
        new_status = 0;

    } else if (status == 2) {
        new_status = 3;
    } else if (status == 3) {
        new_status = 1;
    } else if (status == 4) {
        new_status = 4;
    } else {
        status_txt = "Disabled";
        newstatus_txt = "Enabled";
        new_status = 1;
    }
    if (text_msg != "")
        msg = text_msg;
    else
        msg = "Are You Sure To " + newstatus_txt + " " + center_name;


    if (full_redirect != "") {
        var new_redirect_url = urls + redirect;
    } else {
        var new_redirect_url = urls + controller + redirect;
    }
    $('#modal_heading').text(center_name);
    $("#modal_body_cnf").text(msg);
    $("#confirm_modal").modal();
    $("#btn_yes").unbind().click(function () {
        $(".ajaxLoader").fadeIn();
        $.ajax({
            type: "POST",
            data: {id: id, status: new_status},
            dataType: "json",
            url: urls + controller + "/change_status",
            cache: false,
            success: function (data) {
                $(".ajaxLoader").fadeOut();
                /*$("#btn_no").click();*/
                showMsgPopup('Success', "Status Successfully Changed", new_redirect_url, 'normal');
            }
        });
    });
}

function saveProjectTemplate(action) {
    $(".ajaxLoader").fadeIn();

    type = "POST";

    $.ajax({
        url: urls + "project_templates/" + action,
        type: type,
        dataType: "json",
        data: $('form#projectTemplateForm').serialize(),
        success: function (data, textStatus, jqXHR)
        {
            if (data.status == 'failure') {
                $(".ajaxLoader").fadeOut();
                error_msg(data.error, 'id');
            } else {
                if (data.status == 'error') {
                    $(".ajaxLoader").fadeOut();
                    showMsgPopup("Error", data.data, '', 'error');
                } else {
                    showMsgPopup(data.status, data.data, urls + 'project_templates', 'normal');
                }
            }
        },
        error: function (jqXHR, textStatus, errorThrown)
        {

        }
    });
}

function saveProjectFields() {
    $(".ajaxLoader").fadeIn();

    type = "POST";

    $.ajax({
        url: urls + "project/save_project_fields",
        type: type,
        dataType: "json",
        data: $('form#projectTemplateFields').serialize(),
        success: function (data, textStatus, jqXHR)
        {
            if (data.status == 'failure') {
                $(".ajaxLoader").fadeOut();
                error_msg(data.error, 'id');
            } else {
                if (data.status == 'error') {
                    $(".ajaxLoader").fadeOut();
                    showMsgPopup("Error", data.data, '', 'error');
                } else {
                    showMsgPopup(data.status, data.data, urls + 'project/project_fields/' + data.id, 'normal');
                }
            }
        },
        error: function (jqXHR, textStatus, errorThrown)
        {

        }
    });
}

function Edit_user_access() {
    $.ajax({
        url: urls + "Set_access/update",
        type: "POST",
        dataType: "json",
        data: $('form#User_access').serialize(),
        success: function (data, textStatus, jqXHR)
        {
            if (data.status == 'failure')
            {
                error_msg(data.error);

            } else if (data.status == "success") {
                showMsgPopup("Success", "Successfully Updated", '', 'normal')
                setTimeout(function () {
                    location.reload();

                }, 2000)
            } else {

                showMsgPopup("Error", "Something Went Wrong Try Again", '', 'error')
                setTimeout(function () {
                    location.reload();

                }, 2000)
            }
        },
        error: function (jqXHR, textStatus, errorThrown)
        {

        }
    });
}

function saveClient() {
    $(".ajaxLoader").fadeIn();
    $.ajax({
        url: urls + "clients/addEdit",
        type: "POST",
        dataType: "json",
        data: $('form#clientForm').serialize(),
        success: function (data, textStatus, jqXHR)
        {

            if (data.status == 'failure')
            {

                $(".ajaxLoader").fadeOut();
                error_msg(data.error, 'id');
            } else
            {
                if (data.status == 'error') {
                    $(".ajaxLoader").fadeOut();
                    showMsgPopup("Error", data.data, '', 'error');
                } else {
                    var page_url = urls + 'clients/listing';
                    showMsgPopup(data.status, data.data, page_url, 'normal');
                }
            }
        },
        error: function (jqXHR, textStatus, errorThrown)
        {

        }
    });
}

function saveprojectInputData(action) {
    $(".ajaxLoader").fadeIn();
    type = "POST";
    $.ajax({
        url: urls + "project_input_data/" + action,
        type: type,
        dataType: "json",
        data: $('form#projectDataForm').serialize(),
        success: function (data, textStatus, jqXHR)
        {
            if (data.status == 'failure') {
                $(".ajaxLoader").fadeOut();
                error_msg(data.error, 'id');
            } else {
                if (data.status == 'error') {
                    $(".ajaxLoader").fadeOut();
                    showMsgPopup("Error", data.data, '', 'error');
                } else {
                    showMsgPopup(data.status, data.data, urls + 'project_input_data/' + data.id, 'normal');
                }
            }
        },
        error: function (jqXHR, textStatus, errorThrown)
        {

        }
    });
}

function get_autoselect_data(controller = "", action = "", id = "", element_id) {
    var ajax_url = "";
    if (action != "")
        ajax_url += action + "/";
    $.ajax({
        url: urls + controller + '/' + ajax_url,
        type: "GET",
        dataType: "json",
        data: {id: id},
        success: function (data, textStatus, jqXHR)
        {
            var project_data = data.project_data;
            var previous_ka_users = data.previous_ka_users;
            for (var i = 0; i < project_data.length; i++) {
                $("#allocate_project_name").val(project_data[i].project_name)
                $("#planned_research_start_date").val(project_data[i].planned_research_start_date);
                $("#planned_research_end_date").val(project_data[i].planned_research_end_date);
            }
            /*get_ka_users(id);*/
        },
        error: function (jqXHR, textStatus, errorThrown)
        {

        }
    });
}

function get_ka_users(project_id) {
    $.ajax({
        url: urls + 'project_allocation/get_unallocate_ka_users',
        type: "GET",
        dataType: "json",
        data: {project_id: project_id},
        success: function (data, textStatus, jqXHR)
        {
            var html = '<select multiple class="selectator form-control multiselect_user" data-selectator-keep-open="true" data-MORE-OPTION="OPTION VALUE" name="project_allocate[ka_user][]">';
            var html2 = "";
            for (var i = 0; i < data.length; i++) {
                html += '<option value="' + data[i].id + '" id="user' + data[i].id + '" class="ka_users ka_user' + data[i].id + '">' + data[i].emp_code + '-' + data[i].name + '</option>';
                /*  html2 += '<li class="selectator_option selectator_value_6 ka_users ka_user6"><div class="selectator_option_title">KA00TZ4197-mahesh</div></li>';*/
            }
            html += "</select>";
            reload_script("multiselect_dropdown", dropdown_js_path);
            /*           $(".selectator_options").html(); */
            $("#user_select").html(html);
        },
        error: function (jqXHR, textStatus, errorThrown)
        {

        }
    });
}

function reload_script(script_id, path) {
    $('#' + script_id).remove();
    $.getScript(path, function () {
        $('script:last').attr('id', script_id);
    });
}

function get_priority_project(controller = "", action = "", id = "", element_id) {
    var ajax_url = "";
    if (action != "")
        ajax_url += action + "/";

    $.ajax({
        url: urls + controller + '/' + ajax_url,
        type: "GET",
        dataType: "json",
        data: {id: id},
        success: function (data, textStatus, jqXHR)
        {
            var option = "<option value=''>Select Project Code</option>";
            if (data.length > 0) {
                for (var i = 0; i < data.length; i++) {
                    option += "<option value='" + data[i].id + "'>" + data[i].project_code + "</option>";
                }
            } else {
                option = "<option value=''>No Project Found</option>";
            }

            $("#project_code_drop_dwn").html(option);
        },
        error: function (jqXHR, textStatus, errorThrown)
        {

        }
    });
}

function save_project_allocation(action, project_id, is_reallocate) {
    $(".ajaxLoader").fadeIn();
    if (action == 'update')
        type = "PUT";
    else
        type = "POST";
    $(".ajaxLoader").fadeIn();
    type = "POST";
    $.ajax({
        url: urls + "project_allocation/" + action,
        type: type,
        dataType: "json",
        data: $('form#project_allocation_frm').serialize(),
        success: function (data, textStatus, jqXHR)
        {
            if (data.status == 'failure') {
                $(".ajaxLoader").fadeOut();
                error_msg(data.error, 'id');
            } else {
                if (data.status == 'error') {
                    $(".ajaxLoader").fadeOut();
                    showMsgPopup("Error", data.data, '', 'error');
                } else {
                    if (is_reallocate == "reallocate")
                        showMsgPopup(data.status, data.data, urls + 'project/' + project_id + '/data', 'normal');
                    else
                        showMsgPopup(data.status, data.data, urls + 'project/edit/' + project_id, 'normal');
                }
            }
        },
        error: function (jqXHR, textStatus, errorThrown)
        {

        }
    });
}

function save_project_reallocation(action, project_id, is_reallocate) {
    $(".ajaxLoader").fadeIn();
    if (action == 'update')
        type = "PUT";
    else
        type = "POST";
    $(".ajaxLoader").fadeIn();
    type = "POST";
    $.ajax({
        url: urls + "project_reallocation/" + action,
        type: type,
        dataType: "json",
        data: $('form#project_allocation_frm').serialize(),
        success: function (data, textStatus, jqXHR)
        {
            if (data.status == 'failure') {
                $(".ajaxLoader").fadeOut();
                error_msg(data.error, 'id');
            } else {
                if (data.status == 'error') {
                    $(".ajaxLoader").fadeOut();
                    showMsgPopup("Error", data.data, '', 'error');
                } else {
                    showMsgPopup(data.status, data.data, urls + 'project/' + project_id + '/data', 'normal');
                }
            }
        },
        error: function (jqXHR, textStatus, errorThrown)
        {

        }
    });
}

function save_ka_user_front() {
    $.ajax({
        url: urls + "auth/add",
        type: "POST",
        dataType: "json",
        data: $('form#form_registration').serialize(),
        success: function (data, textStatus, jqXHR) {
            if (data.status == 'failure') {
                error_msg(data.error, 'id');
            } else {
                if (data.status == 'error') {
                    showMsgPopup("Error", data.data, '', 'error');
                } else {
                    var page_url = urls + 'auth/ka_user_registration';
                    showMsgPopup(data.status, data.data, page_url, 'normal');
                }
            }
        },
        error: function (jqXHR, textStatus, errorThrown) {
        }
    });
}

function update_ka_user(userid) {
    var formData = new FormData(document.querySelector('form'));
    $.ajax({
        url: urls + "user_profile/update_ka_user",
        type: "POST",
        dataType: "json",
        contentType: false,
        processData: false,
        data: formData,
        success: function (data, textStatus, jqXHR) {
            if (data.status == 'failure') {
                error_msg(data.error, 'id');
            } else {
                if (data.status == 'error') {
                    showMsgPopup("Error", data.data, '', 'error');
                } else {
                    var page_url = urls + 'user_profile/view/' + userid + '';
                    showMsgPopup(data.status, data.data, page_url, 'normal');
                }
            }
        },
        error: function (jqXHR, textStatus, errorThrown) {
        }
    });
}

function verify_data(project_id, record_id, status) {
    $.ajax({
        url: urls + "project/data/verify_data/" + record_id + "/" + status,
        type: "POST",
        dataType: "json",
        contentType: false,
        success: function (data, textStatus, jqXHR) {
            if (data.status == 'failure') {
                error_msg(data.error, 'id');
            } else {
                showMsgPopup(data.status, data.data, urls + "project/" + project_id + "/data", 'normal');
            }
        },
        error: function (jqXHR, textStatus, errorThrown) {
        }
    });
}

function approve_data1(project_id, record_id, status) {
    $.ajax({
        url: urls + "project/data/approve_data/" + record_id + '/' + status,
        type: "POST",
        dataType: "json",
        contentType: false,
        success: function (data, textStatus, jqXHR) {
            if (data.status == 'failure') {
                error_msg(data.error, 'id');
            } else {

                // showMsgPopup(data.status, data.data, urls + "project/" + project_id + "/data", 'normal');
            }
        },
        error: function (jqXHR, textStatus, errorThrown) {
        }
    });
}

function approve_data(status) {
    var formData = new FormData(document.querySelector('form#task_remark'));
    formData.append("status", status)
    $.ajax({
        url: urls + "project/data/approve_data/",
        type: "POST",
        dataType: "json",
        data: formData,
        contentType: false,
        processData: false,
        success: function (data, textStatus, jqXHR) {
            if (data.status == 'failure') {
                error_msg(data.error, 'id');
            } else {
                if (data.status == 'error') {
                    showMsgPopup("Error", data.data, '', 'error');
                } else {
                    var page_url = urls + 'project/' + data.project_id + "/data";
                    showMsgPopup(data.status, data.data, page_url, 'normal');
                }
            }
        },
        error: function (jqXHR, textStatus, errorThrown) {
        }
    });
}

function bulk_approve_data(status) {
    var formData = new FormData(document.querySelector('form#reallocation_frm'));
    formData.append("status", status)
    formData.append("remark", $('#task_remark').val())
    $.ajax({
        url: urls + "project/data/bulk_approve_data/",
        type: "POST",
        dataType: "json",
        data: formData,
        contentType: false,
        processData: false,
        success: function (data, textStatus, jqXHR) {
            if (data.status == 'failure') {
                error_msg(data.error, 'id');
            } else {
                if (data.status == 'error') {
                    showMsgPopup("Error", data.data, '', 'error');
                } else {
                    var page_url = urls + 'project/' + data.project_id + "/data";
                    showMsgPopup(data.status, data.data, page_url, 'normal');
                }
            }
        },
        error: function (jqXHR, textStatus, errorThrown) {
        }
    });
}

function reallocate_project(project_id) {
    $.ajax({
        url: urls + "project_allocation/reallocate_project/" + project_id,
        type: "POST",
        dataType: "json",
        contentType: false,
        success: function (data, textStatus, jqXHR) {
            if (data.status == 'failure') {
                error_msg(data.error, 'id');
            } else {
                showMsgPopup(data.status, data.data, urls + "project/" + project_id + "/data", 'normal');
            }
        },
        error: function (jqXHR, textStatus, errorThrown) {
        }
    });
}

function check_availability(user_id, status) {
    $.ajax({
        url: urls + "user_availability/add",
        type: "POST",
        data: {user_id: user_id, status: status},
        success: function (data, textStatus, jqXHR) {
            $('#availability_popup').html(data);
            $('#availability').modal('show');
            add_datepicker("datepicker");
        },
        error: function (jqXHR, textStatus, errorThrown) {
        }
    });
}

function view_payment_details(project_id, user_id) {
    $.ajax({
        url: urls + "users/payment_information/" + project_id + '/' + user_id,
        type: "POST",
        dataType: "json",
        contentType: false,
        success: function (data, textStatus, jqXHR) {
            console.log(data.modal_data)
            $('#information_detail_modal').html(data.modal_data);
            $('#payment_imformation_modal').modal('show');
        },
        error: function (jqXHR, textStatus, errorThrown) {
        }
    });
}

function getAvailabilityCalender(user_id, date) {
    $.ajax({
        url: urls + "user_availability/view",
        type: "GET",
        data: {user_id: user_id, date: date},
        success: function (data)
        {
            $("#availability_view").html(data).show();
            $("#dash_availability_view").html(data).show();
        },
        error: function (jqXHR, textStatus, errorThrown)
        {

        }
    });//ajax end
}

function saveAvailability(method_name, id, ajax_type) {
    $(".loader-section1").show();
    $.ajax({
        url: urls + "user_availability/" + method_name,
        type: ajax_type,
        data: $('form#availabilityForm').serialize() + "&id=" + id,
        success: function (data, textStatus, jqXHR) {
            $("#availability_view").html(data).show();
            $('#availabilityForm')[0].reset();
            showMsgPopup('Success', "Availability has been added successfully.", "", 'normal');

        },
        error: function (jqXHR, textStatus, errorThrown) {

        }
    });
}

function add_datepicker(id) {
    jQuery('.' + id).datepicker({
        format: 'yyyy-mm-dd',
        autoclose: true,
        todayHighlight: true,
        orientation: "top auto",
//        endDate: new Date
    });
}

function import_data_input_excel(status) {
    $('.ajaxLoader').show();
    $('.errors').html('');
    var formdata = new FormData();
    var file_data = $('input[type="file"]')[0].files;
    var product_id = $('#product_id').val();
    formdata.append("file_0", file_data[0]);
    formdata.append("product_id", product_id);
    formdata.append("import_status", status)
    $.ajax({
        url: urls + "project_input_data/save_import_data",
        type: "POST",
        dataType: "json",
        contentType: false,
        processData: false,
        data: formdata,
        success: function (data, textStatus, jqXHR)
        {
            $('.ajaxLoader').hide();
            if (data.status == 'failure')
            {
                $(".ajaxLoader").fadeOut();
                showMsgPopup("Error", data.data, '', 'error');
            } else
            {
                showMsgPopup(data.status, data.data, urls + "project_input_data/" + product_id, 'normal');
            }
        },
        error: function (jqXHR, textStatus, errorThrown)
        {
        }
    });
}


function import_complete_task_excel(status) {
    $('.ajaxLoader').show();
    $('.errors').html('');
    var formdata = new FormData();
    var file_data = $('input[type="file"]')[0].files;
    var product_id = $('#product_id').val();
    formdata.append("file_0", file_data[0]);
    formdata.append("product_id", product_id);
    $.ajax({
        url: urls + "project_data/import_complete_task_data",
        type: "POST",
        dataType: "json",
        contentType: false,
        processData: false,
        data: formdata,
        success: function (data, textStatus, jqXHR)
        {
            $('.ajaxLoader').hide();
            if (data.status == 'failure')
            {
                $(".ajaxLoader").fadeOut();
                showMsgPopup("Error", data.data, '', 'error');
            } else
            {
                showMsgPopup(data.status, data.data, urls + "project/" + product_id + "/data", 'normal');
            }
        },
        error: function (jqXHR, textStatus, errorThrown)
        {
        }
    });
}

function import_data_suppression_excel(status) {
    $('.ajaxLoader').show();
    $('.errors').html('');
    var formdata = new FormData();
    var file_data = $('input[type="file"]')[0].files;
    var product_id = $('#product_id').val();
    formdata.append("file_0", file_data[0]);
    formdata.append("product_id", product_id);
    formdata.append("import_status", status)
    $.ajax({
        url: urls + "project_input_data/save_import_data",
        type: "POST",
        dataType: "json",
        contentType: false,
        processData: false,
        data: formdata,
        success: function (data, textStatus, jqXHR)
        {
            $('.ajaxLoader').hide();
            if (data.status == 'failure')
            {
                $(".ajaxLoader").fadeOut();
                showMsgPopup("Error", data.data, '', 'error');
            } else
            {
                showMsgPopup(data.status, data.data, urls + "project_suppression_data/index/" + product_id, 'normal');
            }
        },
        error: function (jqXHR, textStatus, errorThrown)
        {

        }
    });
}

function checkprojectStatus(project_id, user_id) {
    $.ajax({
        url: urls + "user_profile/checkprojectStatus",
        type: "POST",
        data: {project_id: project_id, user_id: user_id},
        success: function (data, textStatus, jqXHR) {
            $('#project_status_popup').html(data);
            $('#project_status').modal('show');

        },
        error: function (jqXHR, textStatus, errorThrown) {}
    });
}

function view_news(method_name, news_id) {
    $.ajax({
        url: urls + method_name + "/view",
        type: "POST",
        data: {id: news_id},
        success: function (data, textStatus, jqXHR) {
            $('#news_popup').html(data);
            $('#news').modal('show');
        },
        error: function (jqXHR, textStatus, errorThrown) {}
    });
}

function project_report_type_data() {
    var selected_value = $('#project_report_type').val();
    var redirect_url = urls + 'project_reports/' + selected_value;
    window.location = redirect_url;

}

function start_stop_project(project_id, status) {
    $(".loader-section1").show();
    $.ajax({
        url: urls + "project/start_stop_project/" + project_id,
        type: 'POST',
        data: {project_id: project_id, status: status},
        dataType: "json",
        success: function (data, textStatus, jqXHR) {
            showMsgPopup(data.status, data.data, urls + "project/edit/" + project_id, 'normal');
        },
        error: function (jqXHR, textStatus, errorThrown) {

        }
    });
}

function accept_reject_project(project_id, status) {
    $(".loader-section1").show();
    $.ajax({
        url: urls + "project/accept_reject_project/" + project_id,
        type: 'POST',
        data: {project_id: project_id, status: status},
        dataType: "json",
        success: function (data, textStatus, jqXHR) {
            showMsgPopup(data.status, data.data, urls + "project/edit/" + project_id, 'normal');
        },
        error: function (jqXHR, textStatus, errorThrown) {

        }
    });
}

function request_approval(project_id) {
    $(".loader-section1").show();
    $.ajax({
        url: urls + "project/request_approval/" + project_id,
        type: 'POST',
        data: {},
        dataType: "json",
        success: function (data, textStatus, jqXHR) {
            showMsgPopup(data.status, data.data, urls + "project/edit/" + project_id, 'normal');
        },
        error: function (jqXHR, textStatus, errorThrown) {

        }
    });
}

if (page_title == "Create Project") {
    create_project()
}

function create_project() {
    $('.ajaxLoader').show();
    $.ajax({
        url: urls + "project/add_pupup",
        type: "GET",
        dataType: "json",
        success: function (data, textStatus, jqXHR) {
            console.log(data);
            removeAllPopUP();
            $('.ajaxLoader').hide();
            $('body').append(data.html);
            $('#project_create').modal('show');
            $('#project_create').on('shown.bs.modal', function () {});
        },
        error: function (jqXHR, textStatus, errorThrown) {

        }
    });
}

function open_form(page_name, id, controller_name, ajax_type, method) {
    prev_manu = '';
    $('.ajaxLoader').show();
    $.ajax({
        url: urls + controller_name + "/" + method,
        type: ajax_type,
        dataType: "json",
        data: {page_name: page_name, id: id},
        success: function (data, textStatus, jqXHR) {
            removeAllPopUP();
            $('.ajaxLoader').hide();
            ;
            $('body').append(data.html);
            $('#' + controller_name).modal('show');
            $('#' + controller_name).on('shown.bs.modal', function () {});
        },
        error: function (jqXHR, textStatus, errorThrown) {

        }
    });
}

function removeAllPopUP() {
    var popuIds = ['project_information', 'project_management', 'project_details', 'project_cost', 'news_updates', 'assign_ka_lead', 'project_acceptance', 'project_target', 'project_target_date', 'address_details',
        'client_personal_details', 'since_details', 'mobile_details', 'spoc_details', 'invoicing_details',
        'contact_details', 'bank_details', 'current_occupation', 'guardian_details', 'joining_details',
        'ka_remarks', 'qualification', 'status', 'status_ojt', 'training_details', 'Real_time_dashboard',
        'payment_information', 'project_data', 'feedback_information'];

    for (var i = 0; i < popuIds.length; i++)
        $("#" + popuIds[i]).remove();
}

function save_project_infromation() {

    $('.ajaxLoader').show();
    $.ajax({
        url: urls + "project_information/update",
        type: 'POST',
        dataType: "json",
        data: $('form#project_information').serialize(),
        success: function (data, textStatus, jqXHR) {
            $('.ajaxLoader').hide();
            if (data.status == 'failure') {
                error_msg(data.error);
            } else {
                showMsgPopup('Success', "Data Successfully Update.", "", 'normal');
                $("#project_information_view").html(data.html).show();
                $('#project_information').modal('hide');
            }
        },
        error: function (jqXHR, textStatus, errorThrown) {

        }
    });
}

function save_project_management() {
    $('.ajaxLoader').show();
    $.ajax({
        url: urls + "project_management/update",
        type: 'POST',
        dataType: "json",
        data: $('form#project_management').serialize(),
        success: function (data, textStatus, jqXHR) {
            $('.ajaxLoader').hide();
            if (data.status == 'failure') {
                error_msg(data.error);
            } else {
                showMsgPopup('Success', "Data Successfully Update.", "", 'normal');
                $("#project_management_view").html(data.html).show();
                $('#project_management').modal('hide');
                location.reload();
            }
        },
        error: function (jqXHR, textStatus, errorThrown) {

        }
    });
}

function save_project_details() {
    $('.ajaxLoader').show();
    $.ajax({
        url: urls + "project_details/update",
        type: 'PUT',
        dataType: "json",
        data: $('form#project_details').serialize(),
        success: function (data, textStatus, jqXHR) {
            $('.ajaxLoader').hide();
            if (data.status == 'failure') {
                error_msg(data.error);
            } else {
                showMsgPopup('Success', "Data Successfully Update.", "", 'normal');
                $("#project_details_view").html(data.html).show();
                $('#project_details').modal('hide');
            }
        },
        error: function (jqXHR, textStatus, errorThrown) {

        }
    });
}

function save_project_target() {
    $('.ajaxLoader').show();
    $.ajax({
        url: urls + "project_target/update",
        type: 'POST',
        dataType: "json",
        data: $('form#project_target').serialize(),
        success: function (data, textStatus, jqXHR) {
            $('.ajaxLoader').hide();
            if (data.status == 'failure') {
                error_msg(data.error);
            } else {
                showMsgPopup('Success', "Data Successfully Update.", "", 'normal');
                $("#project_target_view").html(data.html).show();
                $('#project_target').modal('hide');
            }
        },
        error: function (jqXHR, textStatus, errorThrown) {

        }
    });
}

function save_project_cost() {
    $('.ajaxLoader').show();
    $.ajax({
        url: urls + "project_cost/update",
        type: 'PUT',
        dataType: "json",
        data: $('form#project_cost').serialize(),
        success: function (data, textStatus, jqXHR) {
            $('.ajaxLoader').hide();
            if (data.status == 'failure') {
                error_msg(data.error);
            } else {
                showMsgPopup('Success', "Data Successfully Update.", "", 'normal');
                $("#project_cost_view").html(data.html).show();
                $('#project_cost').modal('hide');
            }
        },
        error: function (jqXHR, textStatus, errorThrown) {

        }
    });
}

function save_project_mis() {
    $('.ajaxLoader').show();
    $.ajax({
        url: urls + "project_mis/update",
        type: 'PUT',
        dataType: "json",
        data: $('form#project_mis').serialize(),
        success: function (data, textStatus, jqXHR) {
            $('.ajaxLoader').hide();
            if (data.status == 'failure') {
                error_msg(data.error);
            } else {
                showMsgPopup('Success', "Data Successfully Update.", "", 'normal');
                $("#project_mis_view").html(data.html).show();
                $('#project_mis').modal('hide');
            }
        },
        error: function (jqXHR, textStatus, errorThrown) {

        }
    });
}

function save_project_status() {
    $('.ajaxLoader').show();
    $.ajax({
        url: urls + "project_status/update",
        type: 'PUT',
        dataType: "json",
        data: $('form#project_status').serialize(),
        success: function (data, textStatus, jqXHR) {
            $('.ajaxLoader').hide();
            if (data.status == 'failure') {
                error_msg(data.error);
            } else {
                showMsgPopup('Success', "Data Successfully Update.", "", 'normal');
                $("#project_status_view").html(data.html).show();
                $('#project_status').modal('hide');
            }
        },
        error: function (jqXHR, textStatus, errorThrown) {

        }
    });
}

function save_project_acceptance() {
    $('.ajaxLoader').show();
    $.ajax({
        url: urls + "project_acceptance/update",
        type: 'PUT',
        dataType: "json",
        data: $('form#project_acceptance').serialize(),
        success: function (data, textStatus, jqXHR) {
            $('.ajaxLoader').hide();
            if (data.status == 'failure') {
                error_msg(data.error);
            } else {
                showMsgPopup('Success', "Data Successfully Update.", "", 'normal');
                $("#project_acceptance_view").html(data.html).show();
                $('#project_acceptance').modal('hide');
            }
        },
        error: function (jqXHR, textStatus, errorThrown) {

        }
    });
}

function save_project_conversation() {
    $('.ajaxLoader').show();
    $.ajax({
        url: urls + "project_conversation/update",
        type: 'PUT',
        dataType: "json",
        data: $('form#project_conversation').serialize(),
        success: function (data, textStatus, jqXHR) {
            $('.ajaxLoader').hide();
            if (data.status == 'failure') {
                error_msg(data.error);
            } else {
                showMsgPopup('Success', "Data Successfully Update.", "", 'normal');
                $("#project_conversation_view").html(data.html).show();
                $('#project_conversation').modal('hide');
            }
        },
        error: function (jqXHR, textStatus, errorThrown) {

        }
    });
}

function save_project_target_date() {
    $('.ajaxLoader').show();
    $.ajax({
        url: urls + "project_target_date/update",
        type: 'PUT',
        dataType: "json",
        data: $('form#project_target_date').serialize(),
        success: function (data, textStatus, jqXHR) {
            $('.ajaxLoader').hide();
            if (data.status == 'failure') {
                error_msg(data.error);
            } else {
                showMsgPopup('Success', "Data Successfully Update.", "", 'normal');
                $("#project_target_date_view").html(data.html).show();
                $('#project_target_date').modal('hide');
            }
        },
        error: function (jqXHR, textStatus, errorThrown) {

        }
    });
}

function save_project_ka_leads() {
    $('.ajaxLoader').show();
    $.ajax({
        url: urls + "assign_ka_lead/update",
        type: 'PUT',
        dataType: "json",
        data: $('form#assign_ka_lead').serialize(),
        success: function (data, textStatus, jqXHR) {
            $('.ajaxLoader').hide();
            if (data.status == 'failure') {
                error_msg(data.error);
            } else {
                showMsgPopup('Success', "Data Successfully Update.", "", 'normal');
                $("#assign_ka_lead_view").html(data.html).show();
                $('#assign_ka_lead').modal('hide');
            }
        },
        error: function (jqXHR, textStatus, errorThrown) {

        }
    });
}


function login_to_firebase(username) {
    $.ajax({
        url: urls + "live_chat/check_users",
        data: {
            data: 'login',
            name: username,
            avatar: ""
        },
        type: "post",
        crossDomain: true,
        dataType: 'json',
        success: function (a) {
            if (a.status == 'success') {
                var x = new Date(),
                        b = x.getDate(),
                        c = (x.getMonth() + 1),
                        d = x.getFullYear(),
                        e = x.getHours(),
                        f = x.getMinutes(),
                        g = x.getSeconds(),
                        date = d + '-' + (c < 10 ? '0' + c : c) + '-' + (b < 10 ? '0' + b : b) + ' ' + (e < 10 ? '0' + e : e) + ':' + (f < 10 ? '0' + f : f) + ':' + (g < 10 ? '0' + g : g);
                var h = {
                    name: a.name,
                    avatar: "",
                    login: date,
                    tipe: 'login'
                };
                userRef.push(h);
            } else {
                $('#status').html("<div class='alert alert-danger'>Username sudah di pakai.</div>")
            }
        }
    })
}

function logout_from_firebase(username, role_id) {
    if (role_id == 4 || role_id == 5)
    {
        $.ajax({
            url: urls + "live_chat/check_users",
            data: {
                data: 'logout'
            },
            type: "post",
            crossDomain: true,
            dataType: 'json',
            success: function (a) {
                if (a.status == 'success') {
                    var b = {
                        name: username,
                        tipe: 'logout'
                    };
                    userRef.push(b);
                    showMsgPopup('Success', "Succesfully Logout", urls + "auth/logout", 'normal');
                }
            }
        })
    } else {
        showMsgPopup('Success', "Succesfully Logout", urls + "auth/logout", 'normal');
    }
}

function login(type) {
    username = $("#username").val()
    $.ajax({
        url: urls + "auth/login1/" + type,
        type: "POST",
        dataType: "json",
        data: $('form#form-validation').serialize(),
        success: function (data, textStatus, jqXHR) {
            if (data.status == 'failure') {
                error_msg(data.error);
            }
            if (data.status == 'role_error') {
                showMsgPopup('failuer', "Please select user role", '', 'error');
            }
            if (data.status == 'success') {
                if (data.role_id == 4 || data.role_id == 5) {
                    login_to_firebase(username);
                }
                showMsgPopup('Success', "Succesfully Login", urls + data.data, 'normal');

            }
            if (data.status == 'roler') {
                var i = 0;
                $('#role-in').empty();
                $.each(data.role_name, function (k, v) {
                    var a = '<div class="col-lg-3 col-md-6 col-sm-6 col-6 form-group"><div class="form-check"><p><input type="radio" id="r' + i + '" name="rr" value="' + data.role_id[i] + '" /><label for="r' + i + '"><span></span>' + v + '</label><p></div>';
                    $('#role-in').append(a);
                    i++;
                });
                $('#roles').css('display', 'block');
                $('#log12').css('display', 'none');
                $('#username').prop('disabled', true);
                $('#password').prop('disabled', true);

            }
        }
    });
}

function hideroleid() {
    $('#roles').css('display', 'none');
    $('#log12').css('display', 'block');
    $('#username').prop('disabled', false);
   $('#password').prop('disabled', false);
}

function save_contact_details() {
    $('.ajaxLoader').show();
    $.ajax({
        url: urls + "contact_details/update",
        type: 'POST',
        dataType: "json",
        data: $('form#contact_details_form').serialize(),
        success: function (data, textStatus, jqXHR) {

            $('.ajaxLoader').hide();
            if (data.status == 'failure') {
                error_msg(data.error);
            } else {
                showMsgPopup('Success', "Data Successfully Update.", "", 'normal');
                $("#contact_details_html").html(data.html).show();
                $('#contact_details').modal('hide');

            }
        },
        error: function (jqXHR, textStatus, errorThrown) {

        }
    });
}

function save_training_details() {
    $('.ajaxLoader').show();
    $.ajax({
        url: urls + "training_details/update",
        type: 'POST',
        dataType: "json",
        data: $('form#training_details_form').serialize(),
        success: function (data, textStatus, jqXHR) {
            $('.ajaxLoader').hide();
            if (data.status == 'failure') {
                error_msg(data.error);
            } else {
                showMsgPopup('Success', "Data Successfully Update.", "", 'normal');
                $("#training_details_html").html(data.html).show();
                $('#training_details').modal('hide');
            }
        },
        error: function (jqXHR, textStatus, errorThrown) {

        }
    });
}

function save_bank_details() {
    $('.ajaxLoader').show();
    $.ajax({
        url: urls + "bank_details/update",
        type: 'POST',
        dataType: "json",
        data: $('form#bank_details_form').serialize(),
        success: function (data, textStatus, jqXHR) {
            $('.ajaxLoader').hide();
            if (data.status == 'failure') {
                error_msg(data.error);
            } else {
                showMsgPopup('Success', "Data Successfully Update.", "", 'normal');
                $("#bank_details_html").html(data.html).show();
                $('#bank_details').modal('hide');
            }
        },
        error: function (jqXHR, textStatus, errorThrown) {

        }
    });
}

function save_joining_details() {
    $('.ajaxLoader').show();
    $.ajax({
        url: urls + "joining_details/update",
        type: 'POST',
        dataType: "json",
        data: $('form#joining_details_form').serialize(),
        success: function (data, textStatus, jqXHR) {
            $('.ajaxLoader').hide();
            if (data.status == 'failure') {
                error_msg(data.error);
            } else {
                showMsgPopup('Success', "Data Successfully Update.", "", 'normal');
                $("#joining_details_html").html(data.html).show();
                $('#joining_details').modal('hide');
            }
        },
        error: function (jqXHR, textStatus, errorThrown) {

        }
    });
}

function save_guardian_details() {
    $('.ajaxLoader').show();
    $.ajax({
        url: urls + "guardian_details/update",
        type: 'POST',
        dataType: "json",
        data: $('form#guardian_details_form').serialize(),
        success: function (data, textStatus, jqXHR) {
            $('.ajaxLoader').hide();
            if (data.status == 'failure') {
                error_msg(data.error);
            } else {
                showMsgPopup('Success', "Data Successfully Update.", "", 'normal');
                $("#guardian_details_html").html(data.html).show();
                $('#guardian_details').modal('hide');
            }
        },
        error: function (jqXHR, textStatus, errorThrown) {

        }
    });
}

function save_current_occupation() {
    $('.ajaxLoader').show();
    $.ajax({
        url: urls + "current_occupation/update",
        type: 'POST',
        dataType: "json",
        data: $('form#current_occupation_form').serialize(),
        success: function (data, textStatus, jqXHR) {
            $('.ajaxLoader').hide();
            if (data.status == 'failure') {
                error_msg(data.error);
            } else {
                showMsgPopup('Success', "Data Successfully Update.", "", 'normal');
                $("#current_occupation_html").html(data.html).show();
                $('#current_occupation').modal('hide');
            }
        },
        error: function (jqXHR, textStatus, errorThrown) {

        }
    });
}

function save_qualification() {
    $('.ajaxLoader').show();
    $.ajax({
        url: urls + "qualification/update",
        type: 'POST',
        dataType: "json",
        data: $('form#qualification_form').serialize(),
        success: function (data, textStatus, jqXHR) {
            $('.ajaxLoader').hide();
            if (data.status == 'failure') {
                error_msg(data.error);
            } else {
                showMsgPopup('Success', "Data Successfully Update.", "", 'normal');
                $("#qualification_html").html(data.html).show();
                $('#qualification').modal('hide');
            }
        },
        error: function (jqXHR, textStatus, errorThrown) {

        }
    });
}

function save_status_ojt() {
    $('.ajaxLoader').show();
    $.ajax({
        url: urls + "status_ojt/update",
        type: 'POST',
        dataType: "json",
        data: $('form#status_ojt_form').serialize(),
        success: function (data, textStatus, jqXHR) {
            $('.ajaxLoader').hide();
            if (data.status == 'failure') {
                error_msg(data.error);
            } else {
                showMsgPopup('Success', "Data Successfully Update.", "", 'normal');
                $("#status_ojt_html").html(data.html).show();
                $('#status_ojt').modal('hide');
            }
        },
        error: function (jqXHR, textStatus, errorThrown) {

        }
    });
}

function save_ka_remarks() {
    $('.ajaxLoader').show();
    $.ajax({
        url: urls + "ka_remarks/update",
        type: 'POST',
        dataType: "json",
        data: $('form#ka_remarks_form').serialize(),
        success: function (data, textStatus, jqXHR) {
            $('.ajaxLoader').hide();
            if (data.status == 'failure') {
                error_msg(data.error);
            } else {
                showMsgPopup('Success', "Data Successfully Update.", "", 'normal');
                $("#ka_remarks_html").html(data.html).show();
                $('#ka_remarks').modal('hide');
            }
        },
        error: function (jqXHR, textStatus, errorThrown) {

        }
    });
}

function save_ka_status() {
    $('.ajaxLoader').show();
    $.ajax({
        url: urls + "status/update",
        type: 'POST',
        dataType: "json",
        data: $('form#status_form').serialize(),
        success: function (data, textStatus, jqXHR) {
            $('.ajaxLoader').hide();
            if (data.status == 'failure') {
                error_msg(data.error);
            } else {
                showMsgPopup('Success', "Data Successfully Update.", "", 'normal');
                $("#status_html").html(data.html).show();
                $('#status').modal('hide');
            }
        },
        error: function (jqXHR, textStatus, errorThrown) {

        }
    });
}

function saveclientdetails(formname, controller) {
    $('.ajaxLoader').show();
    $.ajax({

        url: urls + controller + "/update",
        type: 'POST',
        dataType: "json",
        data: $('form#' + formname).serialize(),
        success: function (data, textStatus, jqXHR) {
            $('.ajaxLoader').hide();
            if (data.status == 'failure') {
                error_msg(data.error);
            } else {
                if (data.status == 'add') {
                    showMsgPopup('Success', 'Data Successfully Added.', urls + 'clients/edit/' + data.data, 'normal');
                } else {
                    showMsgPopup('Success', 'Data Successfully Updated.', '', 'normal');
                    $("#" + controller + "_html").html(data.html).show();
                    $('#' + controller).modal('hide');
                }
            }
        },
        error: function (jqXHR, textStatus, errorThrown) {}

    });
}

function updateProfilePicture() {
    var formData = new FormData(document.querySelector('form#updateProfilePicture'));
    $('.ajaxLoader').show();
    $.ajax({
        url: urls + "user_image/update",
        type: 'POST',
        dataType: "json",
        contentType: false,
        processData: false,
        data: formData,
        success: function (data, textStatus, jqXHR) {
            $('.ajaxLoader').hide();
            if (data.status == 'failure') {
                showMsgPopup('Error', "Please upload jpeg/jpg/png files", "", 'error');
            } else {
                showMsgPopup('Success', 'Iamge Successfully Updated.', '', 'normal');
                $("#user_image_html").html(data.html).show();
                location.reload(true);
            }
        },
        error: function (jqXHR, textStatus, errorThrown) {

        }
    });
}

function change_user_role(event) {
    var role_id = $(event).val();
    if (role_id != '') {
        $('.ajaxLoader').show();
        $.ajax({
            url: urls + "auth/change_current_login_role",
            type: 'POST',
            dataType: "json",
            data: {role_id: role_id},
            success: function (data, textStatus, jqXHR) {
                $('.ajaxLoader').hide();
                if (data.status == 'failure') {
                    showMsgPopup('Error', "Please upload jpeg/jpg/png files", "", 'error');
                } else {
                    showMsgPopup('Success', "User role Updated!", urls, 'normal');
                }
            },
            error: function (jqXHR, textStatus, errorThrown) {

            }
        });
    }
}

function updateProjectData(action) {
    $(".ajaxLoader").fadeIn();
    $.ajax({
        url: urls + "my_projects/" + action,
        type: "POST",
        dataType: "json",
        data: $('form#projectDataForm').serialize(),
        success: function (data, textStatus, jqXHR)
        {
            if (data.status == 'failure')
            {
                $(".ajaxLoader").fadeOut();
                error_msg(data.error, 'id');
            } else
            {
                if (data.status == 'error') {
                    alert("Error: " + data.data);
                } else {
                    window.location.href = data.next_url;
                }
            }
        },
        error: function (jqXHR, textStatus, errorThrown)
        {

        }
    });
}

function confirm_reallocation() {
    $("form#conform_reassign").submit();
}

function get_month_news(type) {
    var date = $('#curr_date_value').val();
    $.ajax({
        url: urls + "news_updates/get_month_news",
        type: "get",
        dataType: "json",
        data: {curr_date: date, type: type},
        success: function (data, textStatus, jqXHR) {
            $("#cur_mnth").html(data.prv_month_year);
            $("#curr_date_value").val(data.new_date);
            $("#content_news").empty();

            if (data.data != "") {
                $("#content_news").append(data.data);
            } else {
                var html = "No News and Updates";
                $("#content_news").append(html);
            }
        },
        error: function (jqXHR, textStatus, errorThrown)
        {

        }
    });

}
function display_image(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function (e) {
            $('#news-images')
                    .attr('src', e.target.result)
                    .width(250)
                    .height(200);

        };
        reader.readAsDataURL(input.files[0]);
    }
}

function export_data(value) {
    if (value == "all") {
        $("#batch").hide();
        $("#disposition").hide();
        $("#disposition_custom").hide();
    } else if (value == "batches") {
        $("#batch").show();
        $("#disposition").show();
        $("#disposition_custom").hide();
        $("#disposition_custom input[type='checkbox']").prop('checked', false);
    } else if (value == "dispose") {
        /* $("#disposition input[type='checkbox']").removeAttr("disabled");*/
        $("#batch").hide();
        $("#disposition").hide();
        $("#disposition_custom").show();
        $("#disposition input[type='checkbox']").prop('checked', false);
    } else {
        $("#batch").hide();
        $("#disposition").hide();
        $("#disposition_custom").hide();
    }
}


function download_approved_status_xlsx() {
    $("#import_appreoved_status_frm").submit();
}




