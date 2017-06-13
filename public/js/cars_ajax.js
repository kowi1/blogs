$(document).ready(function(){

    var url = "cars";

    //display modal form for task editing
    $('.open-modal').click(function(){
        var car_id = $(this).val();

        $.get(url + '/' + car_id, function (data) {
            //success data
            console.log(data);
            $('#car_id').val(data.id);
            $('#model').val(data.model);
            $('#produced_on').val(data.produced_on);
            $('#btn-save').val("update");

            $('#myModal').modal('show');
        }) 
    });

    //display modal form for creating new task
    $('#btn-add').click(function(){
        $('#btn-save').val("add");
        $('#frmTasks').trigger("reset");
        $('#myModal').modal('show');
    });

    //delete task and remove it from list
    $('.delete-task').click(function(){
        var car_id = $(this).val();
         $.ajaxSetup({

        headers: {
            'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
        }

})

        $.ajax({

            type: "DELETE",
            url: url + '/' + car_id,
            success: function (data) {
                console.log(data);

                $("#car" + car_id).remove();
            },
            error: function (data) {
                console.log('Error:', data);
            }
        });
    });

    //create new task / update existing task
    $("#btn-save").click(function (e) {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
            }
        })

        e.preventDefault(); 

        var formData = {
            model: $('#model').val(),
            Manufacture: $('#produced_on').val(),
        }

        //used to determine the http verb to use [add=POST], [update=PUT]
        var state = $('#btn-save').val();

        var type = "POST"; //for creating new resource
        var car_id = $('#car_id').val();;
        var my_url = url;

        if (state == "update"){
            type = "PUT"; //for updating existing resource
            my_url += '/' + car_id;
        }

        console.log(formData);

        $.ajax({

            type: type,
            url: my_url,
            data: formData,
            dataType: 'json',
            success: function (data) {
                console.log(data);

                var car = '<tr id="car' + data.id + '"><td>' + data.id + '</td><td>' + data.model + '</td><td>' + data.produced_on + '</td><td>' + data.created_at + '</td>';
                car += '<td><button class="btn btn-warning btn-xs btn-detail open-modal" value="' + data.id + '">Edit</button>';
                car += '<button class="btn btn-danger btn-xs btn-delete delete-task" value="' + data.id + '">Delete</button></td></tr>';

                if (state == "add"){ //if user added a new record
                    $('#cars-list').append(car);
                }else{ //if user updated an existing record

                    $("#car" + car_id).replaceWith( car );
                }

                $('#frmCars').trigger("reset");

                $('#myModal').modal('hide')
            },
            error: function (data) {
                console.log('Error:', data);
            }
        });
    });
});
