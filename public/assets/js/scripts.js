$(function (){

    $('#add').click(function (){

        Swal.fire({
            title: 'Add new Event',
            html: '' +
                '<div style="text-align: left">' +

                '<p><strong>Title : <input type="text" id="addTitle" name="title" class="form-control"/></strong></p>' +
                '<p><strong>Description : <input type="text" id="addDesc" name="description" class="form-control"/></strong></p>' +
                ' <p><strong>Start</strong></p><div\n' +
                '     class=\'input-group\'\n' +
                '     id=\'datetimepicker1\'\n' +
                '     data-td-target-input=\'nearest\'\n' +
                '     data-td-target-toggle=\'nearest\'\n' +
                ' >\n' +
                '   <input\n' +
                '     id=\'addStart\'\n' +
                '     type=\'text\'\n' +
                '     class=\'form-control\'\n' +
                '     data-td-target=\'#datetimepicker1\'\n' +
                '     name = \'start\'\n' +
                '     readonly = \'readonly\'\n' +
                '   />\n' +
                '   <span\n' +
                '     class=\'input-group-text\'\n' +
                '     data-td-target=\'#datetimepicker1\'\n' +
                '     data-td-toggle=\'datetimepicker\'\n' +
                '   >\n' +
                '     <span class=\'fa-solid fa-calendar\'></span>\n' +
                '   </span>\n' +
                ' </div>' +

                ' <p><br /><strong>End</strong></p><div\n' +
                '     class=\'input-group\'\n' +
                '     id=\'datetimepicker2\'\n' +
                '     data-td-target-input=\'nearest\'\n' +
                '     data-td-target-toggle=\'nearest\'\n' +
                ' >\n' +
                '   <input\n' +
                '     id=\'addEnd\'\n' +
                '     type=\'text\'\n' +
                '     class=\'form-control\'\n' +
                '     data-td-target=\'#datetimepicker2\'\n' +
                '     name = \'end\'\n' +
                '     readonly = \'readonly\'\n' +
                '   />\n' +
                '   <span\n' +
                '     class=\'input-group-text\'\n' +
                '     data-td-target=\'#datetimepicker2\'\n' +
                '     data-td-toggle=\'datetimepicker\'\n' +
                '   >\n' +
                '     <span class=\'fa-solid fa-calendar\'></span>\n' +
                '   </span>\n' +
                ' </div>' +
                '' +
                '<p><br /><strong>Select User: </strong></p>' +
                '<select class="form-control" id="addUser">' +
                '<option value="1">Admin</option>' +
                '<option value="2">Daniel Dumas</option>' +
                '<option value="3">Adam Santos</option>' +
                '</select>' +
                '' +
                '<p>&nbsp</p>' +

                '<button id="addEvent" class="btn btn-primary btn-sm">Add Event</button>' +

                '</div>',
            showCloseButton: true,
            showCancelButton: false,
            confirmButtonColor: '#1ab394',
            focusConfirm: false,
            showConfirmButton: false,
            didRender : function () {

                new tempusDominus.TempusDominus(document.getElementById('datetimepicker1'));
                new tempusDominus.TempusDominus(document.getElementById('datetimepicker2'));

                $('#addEvent').click(function (){

                    var title = $('#addTitle').val();
                    var desc = $('#addDesc').val();
                    var start = $('#addStart').val();
                    var end = $('#addEnd').val();
                    var user = $('#addUser').val();
                    var success = true;

                    if(title==='') success = false;
                    if(desc==='') success = false;
                    if(start==='') success = false;
                    if(user==='') success = false;

                    if(!success) {
                        alert('Please complete all the fields!');
                        return;
                    } else {

                        app.request({
                            url : 'add_event',
                            data : {title : title, description : desc, start : start, end : end, user_id : user},
                            success : function (data) {
                                if(data.success) {
                                    app.redirect();
                                }
                            }
                        });
                    }




                });

            }
        })

    });

});