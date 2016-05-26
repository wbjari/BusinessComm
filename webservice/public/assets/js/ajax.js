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

function ajax_requestCompany(data)
{

  $.ajax({
    url: "/request",
    type: "POST",
    data: { data: data },
    dataType: 'json',
    beforeSend: function (xhr) {
        var token = $('meta[name="_token"]').attr('content');

        if (token) {
              return xhr.setRequestHeader('X-CSRF-TOKEN', token);
        }
    },
    success: function(response) {
      $('button.requester')
      .attr('id', 'cancelRequestCompany')
      .html('Annuleren')
      .removeClass('btn-primary')
      .addClass('btn-danger');
    }
  });

}

function ajax_cancelRequestCompany(data)
{

  $.ajax({
    url: "/cancel-request",
    type: "POST",
    data: { data: data },
    dataType: 'json',
    beforeSend: function (xhr) {
        var token = $('meta[name="_token"]').attr('content');

        if (token) {
              return xhr.setRequestHeader('X-CSRF-TOKEN', token);
        }
    },
    success: function(response) {
      $('button.requester')
      .attr('id', 'requestCompany')
      .html('Aansluiten')
      .removeClass('btn-danger')
      .addClass('btn-primary');
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

      $('.posts').find('.remove-post[data-id="' + post_id + '"]').parent()
      .slideUp(350, function() {
        $(this).remove();
      });

      $('#removePostModal').modal('hide');

      if($('.posts > .card').length < 1) {
        $('.posts').append('\
        <div class="card">\
          <div class="col-md-12">\
            <h4>Er zijn nog geen berichten</h4>\
          </div>\
        </div>\
        ')
      }

    },
    error: function(response) {
      alert('Er is iets fout gegaan, probeer het later opnieuw');
    }
  });

}
