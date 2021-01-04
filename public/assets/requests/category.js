function saveCategory(){
    var name = document.getElementById('ct-name').value;
    var active = document.getElementById('ct-active').checked ;
    var url = document.getElementById('ct-url').value;
    
    $.ajax({
        url: url,
        headers:{
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        data: {
          name:name,
          state: active ? '1' : '0',
        },
        error: function(xhr, ajaxOptions, thrownError) {
            console.log(xhr.responseText);
            console.log(ajaxOptions);
            console.log(thrownError);
        },
        dataType: 'json',
        success: function(data) {
            document.getElementById('ct-name').value = '';
            document.getElementById('ct-active').checked = false;
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
                                <input class="form-check-input" onchange="stateCategory(this,'`+data.state+`')" type="checkbox" `+data.state+` value="">
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
                        <button type="button" rel="tooltip" title="" onclick="deleteCategory(this,'`+data.delete+`/edit')" class="btn btn-link"
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
                                <input class="form-check-input" onchange="stateCategory(this,'`+data.delete+`/edit')" type="checkbox" `+data.state+` value="">
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
                        <button type="button" rel="tooltip" title="" onclick="deleteCategory(this,'`+data.delete+`')" class="btn btn-link"
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
function deleteCategory(node,url){
    console.log(url);
    $.ajax({
        url: url,
        dataType: "json",
        contentType: "application/json",
        headers:{
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
        },
        error: function(xhr, ajaxOptions, thrownError) {
            console.log(xhr.responseText);
            console.log(ajaxOptions);
            console.log(thrownError);
            demo.showNotification('top','right','Application Deleted Successfully','primary');

        },
        dataType: 'json',
        success: function(data) {
            demo.showNotification('top','right','Application Deleted Successfully','primary');
            node.parentNode.parentNode.remove();
        },
        type: 'DELETE'
      });
}
function stateCategory(node,url) {
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
function updateCategory (id,url){
    var name = document.getElementById('ct-name-'+id).value;
    var active = document.getElementById('ct-active-'+id).checked ;
    console.log(name);
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