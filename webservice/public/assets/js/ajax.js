function ajax_changeLogo(data)
{

  $.ajax({
    url: site_url + "/change-logo",
    type: "POST",
    dataType: 'JSON',
    data: { data: data },
    beforeSend: function (xhr) {
        var token = $('meta[name="_token"]').attr('content');

        if (token) {
              return xhr.setRequestHeader('X-CSRF-TOKEN', token);
        }
    },
    success: function (response) {
      console.log('success');
      console.log(response);
    },
    error: function (response) {
      console.log('error');
      console.log(response);
    }
  });

}

function ajax_newPost(data)
{

  $.ajax({
    url: "/new-post",
    type: "POST",
    data: { data: data },
    dataType: 'json',
    processData: false,
    beforeSend: function (xhr) {
        var token = $('meta[name="_token"]').attr('content');

        if (token) {
              return xhr.setRequestHeader('X-CSRF-TOKEN', token);
        }
    }
  });

}

function ajax_removePost(post_id)
{

  $.ajax({
    url: "/remove-post",
    type: "POST",
    data: { data: post_id },
    dataType: 'json',
    beforeSend: function (xhr) {
        var token = $('meta[name="_token"]').attr('content');

        if (token) {
              return xhr.setRequestHeader('X-CSRF-TOKEN', token);
        }
    },
    success: function(response) {

      // if ($('.posts').find('.remove-post').data('id') === post_id) {
      //   $(this).parent().fadeOut().remove();
      // }

    },
    error: function(response) {
      alert('Er is iets fout gegaan, probeer het later opnieuw');
    }
  });

}
