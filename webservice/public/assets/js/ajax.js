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

    },
    error: function(response) {
      alert('Er is iets fout gegaan, probeer het later opnieuw');
    }
  });

}

function ajax_acceptRequest(data)
{

  $.ajax({
    url: "/accept-request",
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
      $('.requests').find('li[data-id="' + data['user'] + '"]').remove();

      console.log($('.requests').find('ul li').length);
      if ($('.requests').find('ul li').length < 1) {
        $('.requests').remove();
      }
    }
  });

}

function ajax_denyRequest(data)
{

  $.ajax({
    url: "/deny-request",
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
      $('.requests').find('li[data-id="' + data['user'] + '"]').remove();

      console.log($('.requests').find('ul li').length);
      if ($('.requests').find('ul li').length < 1) {
        $('.requests').remove();
      }
    }
  });

}

function ajax_removeSkill(data)
{

  $.ajax({
    url: "/remove-skill",
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
      $('div[data-card="skills"] span[data-id="' + data + '"]').remove();
    }
  });

}

function searchSkillsTable(text, limit, idName)
{

  $.ajax({
    url: "/skill/search",
    type: "POST",
    data: { text: text, limit: limit },
    dataType: 'json',
    beforeSend: function (xhr) {
        var token = $('meta[name="_token"]').attr('content');

        if (token) {
              return xhr.setRequestHeader('X-CSRF-TOKEN', token);
        }
    },
    success: function(response) {
       $('#'+idName).html('');
      if(response.length >= 1){
        for (i = 0; i < response.length; i++) {
           $('#'+idName).append('<button class="btn btn-simple btn-primary btn-xs skillResultButton" style="width:100%;">'+response[i].name+'<div class="ripple-container"></div></button>')
        }
      }
    }
  });

}

function searchUserTable(text, limit, idName)
{

  $.ajax({
    url: "/user/search",
    type: "POST",
    data: { text: text, limit: limit },
    dataType: 'json',
    beforeSend: function (xhr) {
        var token = $('meta[name="_token"]').attr('content');

        if (token) {
              return xhr.setRequestHeader('X-CSRF-TOKEN', token);
        }
    },
    success: function(response) {
         $('#'+idName).html('');

        if(response.length >= 1){
          for (i = 0; i < response.length; i++) {
             $('#'+idName).append('<button type="button" class="btn btn-simple btn-primary btn-xs userResultButton" style="width:100%;">'+response[i].email+'<div class="ripple-container"></div></button>')
          }
        }
    }
  });
}

