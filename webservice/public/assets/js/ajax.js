function ajax_changeLogo(data)
{
  console.log(site_url);
  var request = $.ajax({
    url: site_url + "/change-logo",
    type: "POST",
    dataType: 'JSON',
    data: data,
    beforeSend: function (xhr) {
        var token = $('meta[name="_token"]').attr('content');

        if (token) {
              return xhr.setRequestHeader('X-CSRF-TOKEN', token);
        }
    }
  });

  request.done(function(response) {
    console.log('done');
    console.log(response);
  });

  request.fail(function(response){
    console.log('fail');
    console.log(response);
  });

}
