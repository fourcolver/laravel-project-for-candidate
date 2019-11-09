jQuery(document).ready(function () {
    var DropDrownVal = "";
    var datatable;
    var gauge_data;
    var emp_gauge_data;
    // $('#m_form_type').one('change', function (event) {
    //       DropDrownVal = $(this).val();
    //       datatable.reload();
    //    });
    (function () {
        $('.loader_msg').css('display', 'none');
        var accountsdata;
        var edit_url = 'tasks/edit';
        var delete_url = 'tasks/delete';
        var view_url = 'tasks/view';
        datatable = $('.m_datatable').mDatatable({
            // datasource definition
            data: {
                type: 'remote',
                source: {
                    read: {
                        url: 'dashboard/getTasksData',
                        method: 'GET',
                        // custom headers
                        headers: {'x-my-custom-header': 'some value', 'x-test-header': 'the value'},
                        params: {
                            // custom query params
                            query: {
                                generalSearch: '',
                            }
                        },
                        map: function (raw) {
                            console.log('ITS RUN');
                            console.log(raw);
                            // sample data mapping
                            var dataSet = raw;
                            if (typeof raw.data !== 'undefined') {
                                dataSet = raw.data;
                            }
                            console.log('Result');
                            console.log(dataSet);
                            return dataSet;
                        },
                    }
                },
                pageSize: 10,
                saveState: {
                    cookie: false,
                    webstorage: false
                },

                serverPaging: false,
                serverFiltering: false,
                serverSorting: false
            },
            // layout definition
            layout: {
                theme: 'default', // datatable theme
                class: '', // custom wrapper class
                scroll: false, // enable/disable datatable scroll both horizontal and vertical when needed.
                // height: 450, // datatable's body's fixed height
                footer: false // display/hide footer
            },

            // column sorting
            sortable: true,

            pagination: true,

            search: {
                input: $('#generalSearch')
            },

            // inline and bactch editing(cooming soon)
            // editable: false,

            // columns definition
            columns: [{
                field: "id",
                title: "S. No",
                textAlign: 'center',
                width: 40
            },
                {
                    field: "priority",
                    title: "Priority",
                    textAlign: 'center',
                    width: 90,
                    template: function (row) {
                        var dropup = (row.getDatatable().getPageSize() - row.getIndex()) <= 4 ? 'dropup' : '';
                        if (row.priority == 'Medium') {
                            return '\
              <div >\
              <span class="m-badge m-badge--info m-badge--wide">' + row.priority + '</span>\
              </div>\
              ';
                        }
                        else if (row.priority == 'Low') {
                            return '\
             <div >\
             <span class="m-badge m-badge--success m-badge--wide">' + row.priority + '</span>\
             </div>\
             ';
                        }
                        else if (row.priority == 'High') {
                            return '\
             <div >\
             <span class="m-badge m-badge--warning m-badge--wide">' + row.priority + '</span>\
             </div>\
             ';
                        }
                        else {
                            return '\
            <div >\
            <span class="m-badge m-badge--danger m-badge--wide">' + row.priority + '</span>\
            </div>\
            ';
                        }
                    }
                },
                {
                    field: "task_date",
                    title: "Task Date",
                    textAlign: 'center',
                    width: 80,
                    template: function (row) {
                        var dropup = (row.getDatatable().getPageSize() - row.getIndex()) <= 4 ? 'dropup' : '';
                        date = row.task_date.split(' ')[0];
                        return '\
          <div >\
          ' + date + '\
          </div>\
          ';
                    }
                },
                {
                    field: "account_name",
                    title: "Kunden Name",
                    width: 120,
                    textAlign: 'center',
                    template: function (row) {
                        var dropup = (row.getDatatable().getPageSize() - row.getIndex()) <= 4 ? 'dropup' : '';
                        date = row.task_date.split(' ')[0];
                        if (row.account_status == 0) {
                            return '\
            <div >\
            <a title="View Task Account" href="admin/accounts/view/' + row.account_id + '/0">' + row.account_name + '</a>\
            </div>\
            ';
                        }
                        return '\
          <div >\
          <a title="View Task Account Not in Database" href="admin/ad_accounts/view/' + row.account_id + '">' + row.account_name + '</a>\
          </div>\
          ';
                    }
                },
                {
                    field: "task_status",
                    title: "Task Status",
                    width: 100
                },
                {
                    field: "description",
                    title: "Description",
                },
                {
                    field: "first_name",
                    title: "Owner of Task",
                }
            ]
        });
        $('#m_form_status, #m_form_type').selectpicker();
        $('#m_form_status').on('change', function (event) {
            var value = $(this).val();
            datatable.search(value, 'Status')
            //datatable.setDataSourceQuery({searchhotness:value});
            //datatable.reload();
        });
    })();
    $.ajax({
        url: 'dashboard/getAllGaugeDetails',
        'async': false,
        success: function (response) {
            gauge_data = response;
        }
    });
    $.ajax({
        url: 'dashboard/getAllEmployeeGoals',
        'async': false,
        success: function (response) {
            emp_gauge_data = response;
        }
    });
    var goal_by = $('#auth_id').val();
    $.ajax({
        url: 'dashboard/getgoalDetails',
        data: {id: goal_by},
        'async': false,
        success: function (response) {
            if (response != '') {
                var goalset = response;
                $('#client_activity').val(response.client_activity);
                $('#client_add').val(response.client_add);
                $('#candidate_add').val(response.candidate_add);
                $('#oppo_add').val(response.oppo_add);
            }

        }
    });
    $("#client_activity").keydown(function (e) {
        // Allow: backspace, delete, tab, escape, enter and .
        if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 110, 190]) !== -1 ||
            // Allow: Ctrl+A, Command+A
            (e.keyCode === 65 && (e.ctrlKey === true || e.metaKey === true)) ||
            // Allow: home, end, left, right, down, up
            (e.keyCode >= 35 && e.keyCode <= 40)) {
            // let it happen, don't do anything
            return;
        }
        // Ensure that it is a number and stop the keypress
        if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
            e.preventDefault();
        }
    });
    ;
    var client_activity_max = 50;
    var client_add_max = 50;
    var candidate_add_max = 50;
    var oppo_add_max = 50;
    $.each(emp_gauge_data, function (index, value) {
        var goal_by = value.id;
        $('#client_activity' + value.id).val(value.client_activities);
        $('#client_add' + value.id).val(value.client_added);
        $('#candidate_add' + value.id).val(value.candidate_added);
        $('#oppo_add' + value.id).val(value.opportunity_added);
        $('#client_activity' + value.id + ',#client_add' + value.id + ',#candidate_add' + value.id + ',#oppo_add' + value.id).blur(function () {
            var emp_client_activity = $('#client_activity' + value.id).val();
            var emp_client_add = $('#client_add' + value.id).val();
            var emp_candidate_add = $('#candidate_add' + value.id).val();
            var emp_oppo_add = $('#oppo_add' + value.id).val();
            $.ajax({
                url: 'dashboard/setGoal',
                data: {
                    goal_by: goal_by,
                    emp_client_activity: emp_client_activity,
                    emp_client_add: emp_client_add,
                    emp_candidate_add: emp_candidate_add,
                    emp_oppo_add: emp_oppo_add
                },
                success: function (response) {

                }
            });
            client_activity_max = emp_client_activity > 0 ? emp_client_activity : 50;
            $('#client_activities' + value.id).html('');
            var client_activitiy_gauge = new JustGage({
                id: 'client_activities' + value.id,
                value: value.client_activities,
                min: 0,
                max: client_activity_max,
                title: "Client Activities Added",
                label: "",
                levelColors: [
                    "#F03E3E",
                    "#FFDD00",
                    "#30B32D"
                ]
            });

            $('#client_added' + value.id).html('');
            client_add_max = emp_client_add > 0 ? emp_client_add : 50;
            var client_added_gauge = new JustGage({
                id: 'client_added' + value.id,
                value: value.client_added,
                min: 0,
                max: client_add_max,
                title: "Client Added",
                label: "",
                levelColors: [
                    "#F03E3E",
                    "#FFDD00",
                    "#30B32D"
                ]
            });

            $('#candidate_added' + value.id).html('');
            candidate_add_max = emp_candidate_add > 0 ? emp_candidate_add : 50;
            var client_added_gauge = new JustGage({
                id: 'candidate_added' + value.id,
                value: value.candidate_added,
                min: 0,
                max: candidate_add_max,
                title: "Candidate Added",
                label: "",
                levelColors: [
                    "#F03E3E",
                    "#FFDD00",
                    "#30B32D"
                ]
            });

            $('#opportunity_added' + value.id).html('');
            oppo_add_max = emp_oppo_add > 0 ? emp_oppo_add : 50;
            var client_added_gauge = new JustGage({
                id: 'opportunity_added' + value.id,
                value: value.opportunity_added,
                min: 0,
                max: oppo_add_max,
                title: "Opportunity Added",
                label: "",
                levelColors: [
                    "#F03E3E",
                    "#FFDD00",
                    "#30B32D"
                ]
            });
        });

        /******************************Client Activities Gauge*****************************/
        var client_activity_value = $('#client_activity' + value.id).val();
        if (client_activity_value != '' && client_activity_value != null) {
            client_activity_max = client_activity_value
        }
        $('#client_activity'+value.id).val(value.client_activity_max > 0 && value.client_activity_max != 50 ? value.client_activity_max : '');
        var client_activitiy_gauge = new JustGage({
            id: "client_activities" + value.id,
            value: value.client_activities,
            min: 0,
            max: value.client_activity_max,
            title: "Client Activities Added",
            label: "",
            levelColors: [
                "#F03E3E",
                "#FFDD00",
                "#30B32D"
            ]
        });

        /******************************Client Added Gauge *****************************/
        var client_add_value = $('#client_add' + value.id).val();
        client_add_max = client_add_value > 0 ? client_add_value : 50;
        if (client_add_value != '' && client_add_value != null) {
            client_add_max = client_add_value
        }
        $('#client_add'+value.id).val(value.client_added_max > 0 && value.client_added_max != 50 ? value.client_added_max : '');
        var client_added_gauge = new JustGage({
            id: "client_added" + value.id,
            value: value.client_added,
            min: 0,
            max: value.client_added_max,
            title: "Client Added",
            label: "",
            levelColors: [
                "#F03E3E",
                "#FFDD00",
                "#30B32D"
            ]
        });

        /******************************Candidates Added Gauge *****************************/
        var candidate_add_value = $('#candidate_add' + value.id).val();
        if (candidate_add_value != '' && candidate_add_value != null) {
            candidate_add_max = candidate_add_value
        }
        $('#candidate_add'+value.id).val(value.candidate_added_max > 0 && value.candidate_added_max != 50 ? value.candidate_added_max : '');
        var client_activitiy_gauge = new JustGage({
            id: "candidate_added" + value.id,
            value: value.candidate_added,
            min: 0,
            max: value.candidate_added_max,
            title: "Candidate Added",
            label: "",
            levelColors: [
                "#F03E3E",
                "#FFDD00",
                "#30B32D"
            ]
        });

        /******************************Opportunity Added Gauge *****************************/
        var oppo_add_value = $('#oppo_add' + value.id).val();
        if (oppo_add_value != '' && oppo_add_value != null) {
            oppo_add_max = oppo_add_value
        }
        $('#opportunity_add'+value.id).val(value.opportunity_added_max > 0 && value.opportunity_added_max != 50 ? value.opportunity_added_max : '');
        var client_activitiy_gauge = new JustGage({
            id: "opportunity_added" + value.id,
            value: value.opportunity_added,
            min: 0,
            max: value.opportunity_added_max,
            title: "Opportunity Added",
            label: "",
            levelColors: [
                "#F03E3E",
                "#FFDD00",
                "#30B32D"
            ]
        });

    });
    /***********************************On Change Gauge*******************************/
    var goal_by = $('#auth_id').val();
    $('#client_activity,#client_add,#candidate_add,#oppo_add').blur(function () {
        var client_activity = $('#client_activity').val();
        var client_add = $('#client_add').val();
        var candidate_add = $('#candidate_add').val();
        var oppo_add = $('#oppo_add').val();
        $.ajax({
            url: 'dashboard/setGoal',
            data: {
                goal_by: goal_by,
                client_activity: client_activity,
                client_add: client_add,
                candidate_add: candidate_add,
                oppo_add: oppo_add
            },
            success: function (response) {

            }
        });

        $('#client_activities').html('');
        client_activity_max = client_activity > 0 ? client_activity : 50;
        var client_activitiy_gauge = new JustGage({
            id: "client_activities",
            value: gauge_data.client_activities,
            min: 0,
            max: client_activity_max,
            title: "Client Activities Added",
            label: "",
            levelColors: [
                "#F03E3E",
                "#FFDD00",
                "#30B32D"
            ]
        });

        $('#client_added').html('');
        client_add_max = client_add > 0 ? client_add : 50;
        var client_added_gauge = new JustGage({
            id: "client_added",
            value: gauge_data.client_added,
            min: 0,
            max: client_add_max,
            title: "Client Added",
            label: "",
            levelColors: [
                "#F03E3E",
                "#FFDD00",
                "#30B32D"
            ]
        });

        $('#candidate_added').html('');
        candidate_add_max = candidate_add > 0 ? candidate_add :50;
        var client_added_gauge = new JustGage({
            id: "candidate_added",
            value: gauge_data.candidate_added,
            min: 0,
            max: candidate_add_max,
            title: "Candidate Added",
            label: "",
            levelColors: [
                "#F03E3E",
                "#FFDD00",
                "#30B32D"
            ]
        });

        $('#opportunity_added').html('');
        oppo_add_max = oppo_add > 0 ? oppo_add : 50;
        var client_added_gauge = new JustGage({
            id: "opportunity_added",
            value: gauge_data.opportunity_added,
            min: 0,
            max: oppo_add_max,
            title: "Opportunity Added",
            label: "",
            levelColors: [
                "#F03E3E",
                "#FFDD00",
                "#30B32D"
            ]
        });
    });
    /******************************Client Activities Gauge*****************************/
    var client_activity_value = $('#client_activity').val();
    client_activity_max = client_activity_value > 0 ? client_activity_value : 50;
    var client_activitiy_gauge = new JustGage({
        id: "client_activities",
        value: gauge_data.client_activities,
        min: 0,
        max: client_activity_max,
        title: "Client Activities Added",
        label: "",
        levelColors: [
            "#F03E3E",
            "#FFDD00",
            "#30B32D"
        ]
    });

    /******************************Client Added Gauge *****************************/
    var client_add_value = $('#client_add').val();
    client_add_max = client_add_value > 0 ? client_add_value : 50;
    var client_added_gauge = new JustGage({
        id: "client_added",
        value: gauge_data.client_added,
        min: 0,
        max: client_add_max,
        title: "Client Added",
        label: "",
        levelColors: [
            "#F03E3E",
            "#FFDD00",
            "#30B32D"
        ]
    });

    /******************************Candidates Added Gauge *****************************/
    var candidate_add_value = $('#candidate_add').val();
    candidate_add_max = candidate_add_value > 0 ? candidate_add_value : 50;
    var client_activitiy_gauge = new JustGage({
        id: "candidate_added",
        value: gauge_data.candidate_added,
        min: 0,
        max: candidate_add_max,
        title: "Candidate Added",
        label: "",
        levelColors: [
            "#F03E3E",
            "#FFDD00",
            "#30B32D"
        ]
    });

    /******************************Opportunity Added Gauge *****************************/
    var oppo_add_value = $('#oppo_add').val();
    oppo_add_max = oppo_add_value > 0 ? oppo_add_value : 50;
    var client_activitiy_gauge = new JustGage({
        id: "opportunity_added",
        value: gauge_data.opportunity_added,
        min: 0,
        max: oppo_add_max,
        title: "Opportunity Added",
        label: "",
        levelColors: [
            "#F03E3E",
            "#FFDD00",
            "#30B32D"
        ]
    });
});
