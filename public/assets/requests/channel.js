
function deleteChannel(node,url){
  if (confirm("Are You Sure Delete this Channel ?") == true) {
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

        },
        dataType: 'json',
        success: function(data) {
            demo.showNotification('top','right','Application Deleted Successfully','primary');
            node.parentNode.parentNode.remove();
        },
        type: 'DELETE'
      });
  } 
}
function stateChannel(node,url) {
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
