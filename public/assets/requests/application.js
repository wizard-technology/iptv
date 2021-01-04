function saveApp(){
    var name = document.getElementById('app-name').value;
    var access = document.getElementById('app-access').value;
    var secret = document.getElementById('app-secret').value;
    var platform = document.getElementById('app-platform').value;
    var fcm = document.getElementById('app-fcm').value;
    var active = document.getElementById('app-active').checked ;
    var url = document.getElementById('app-url').value;
    
    $.ajax({
        url: url,
        headers:{
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        data: {
          name:name,
          access:access != '' ? access : generatePassword(16),
          secret:secret != '' ? secret :  generatePassword(32),
          platform:platform,
          fcm:fcm,
          state: active ? '1' : '0',
        },
        error: function(xhr, ajaxOptions, thrownError) {
            console.log(xhr.responseText);
            console.log(ajaxOptions);
            console.log(thrownError);
        },
        dataType: 'json',
        success: function(data) {
            document.getElementById('app-name').value = '';
            document.getElementById('app-secret').value = '';
            document.getElementById('app-access').value = '';
            document.getElementById('app-active').checked = false;
            document.getElementById('app-fcm').value = '';
            document.getElementById('app-platform').selectedIndex  = 0;
            demo.showNotification('top','right','Application Added Successfully','primary');
            $('.add-new').modal('hide');
            data = data.data;
            var tbody = $("#table tbody")
            if(tbody.children().length == 0){
                $("#table tbody:last-child").append(`
                <tr id='`+data.id+`'>
                    <td>
                        <div class="form-check">
                            <label class="form-check-label">
                                <input class="form-check-input" onchange="stateApp(this,'`+data.state+`')" type="checkbox" `+data.state+` value="">
                                <span class="form-check-sign">
                                    <span class="check"></span>
                                </span>
                            </label>
                        </div>
                    </td>
                    <td>
                        <p class="title">`+data.name+`</p>
                        <p class="text-muted">Created At, `+data.created+`</p>
                    </td>
                    <td class="td-actions text-right">
                        <button type="button" rel="tooltip" title="" class="btn btn-link" data-toggle="modal" data-target=".add-updated-`+data.id+`"
                            data-original-title="Edit Task">
                            <i class="tim-icons icon-pencil"></i>
                        </button>
                        <button type="button" rel="tooltip" title="" onclick="deleteApp(this,'`+data.delete+`/edit')" class="btn btn-link"
                            data-original-title="Edit Task">
                            <i class="tim-icons icon-trash-simple"></i>
                        </button>
                    </td>
                </tr>
                `);
            }else{
                $("#table tr:first").before(`
                <tr id='`+data.id+`'>
                    <td>
                        <div class="form-check">
                            <label class="form-check-label">
                                <input class="form-check-input" onchange="stateApp(this,'`+data.delete+`/edit')" type="checkbox" `+data.state+` value="">
                                <span class="form-check-sign">
                                    <span class="check"></span>
                                </span>
                            </label>
                        </div>
                    </td>
                    <td>
                        <p class="title">`+data.name+`</p>
                        <p class="text-muted">Created At, `+data.created+`</p>
                    </td>
                    <td class="td-actions text-right">
                        <button type="button" rel="tooltip" title="" class="btn btn-link" data-toggle="modal" data-target=".add-updated-`+data.id+`"
                            data-original-title="Edit Task">
                            <i class="tim-icons icon-pencil"></i>
                        </button>
                        <button type="button" rel="tooltip" title="" onclick="deleteApp(this,'`+data.delete+`')" class="btn btn-link"
                            data-original-title="Edit Task">
                            <i class="tim-icons icon-trash-simple"></i>
                        </button>
                    </td>
                </tr>
                `);
            }
        },
        type: 'POST'
      });
}
function deleteApp (node,url){
    console.log();
    $.ajax({
        url: url,
        contentType: "application/json",
        dataType: "json",
        headers:{
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
        },
        error: function(xhr, ajaxOptions, thrownError) {
            console.log(xhr.responseText);
            console.log(ajaxOptions);
            console.log(thrownError);

        },
        dataType: 'json',
        success: function(data) {
            demo.showNotification('top','right','Application Deleted Successfully','primary');
            node.parentNode.parentNode.remove();
        },
        type: 'DELETE'
      });
}
function stateApp(node,url) {
    console.log(url);
    $.ajax({
        url: url,
        contentType: "application/json",
        dataType: "json",
        headers:{
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
        },
        error: function(xhr, ajaxOptions, thrownError) {
            console.log(xhr.responseText);
            console.log(ajaxOptions);
            console.log(thrownError);
            // demo.showNotification('top','right','Application Updated Successfully','danger');

        },
        dataType: 'json',
        success: function(data) {
            demo.showNotification('top','right','Application Updated Successfully','success');
        },
        type: 'GET'
      });
}
function updateApp (id,url){
    var name = document.getElementById('app-name-'+id).value;
    var access = document.getElementById('app-access-'+id).value;
    var secret = document.getElementById('app-secret-'+id).value;
    var platform = document.getElementById('app-platform-'+id).value;
    var fcm = document.getElementById('app-fcm-'+id).value;
    var active = document.getElementById('app-active-'+id).checked ;
    console.log(name);
    console.log(access);
    console.log(secret);
    console.log(platform);
    console.log(fcm);
    console.log(active);
    $.ajax({
        url: url,
        // contentType: "application/json",
        // dataType: "json",
        headers:{
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
        },
        data:{
          
            name:name,
            access:access != '' ? access : generatePassword(16),
            secret:secret != '' ? secret :  generatePassword(32),
            platform:platform,
            fcm:fcm,
            state: active ? '1' : '0',
        },
        error: function(xhr, ajaxOptions, thrownError) {
            console.log(xhr.responseText);
            console.log(ajaxOptions);
            console.log(thrownError);
            // demo.showNotification('top','right','Application Updated Successfully','danger');
        },
        dataType: 'json',
        success: function(data) {
            // console.log($('#tr-'+id).find("td:eq(1)").text());
            $('#tr-'+id+' td:first-child :input').prop('checked', data.data.state);
            $('#tr-'+id).find("td:eq(1)").empty();
            $('#tr-'+id).find("td:eq(1)").prepend(`
                <p class="title">`+data.data.name+`</p>
                <p class="text-muted">Created At, `+data.data.created+`</p>
            `);

            demo.showNotification('top','right','Application Updated Successfully','success');
        },
        type: 'PUT'
      });
}