function ajax_requestCompany(data)
{

  $.ajax({
    url: "/request",
    type: "POST",
    data: { data: data },
    dataType: 'json',
    success: function(response) {
      notification(response);

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
    success: function(response) {
      notification(response);

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
    success: function(response) {
      notification(response);

      $('.posts').find('.remove-post[data-id="' + post_id + '"]').parent()
      .slideUp(350, function() {
        $(this).remove();
      });

      $('#removePostModal').modal('hide');


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
    success: function(response) {
      notification(response);
      $('.requests').find('li[data-id="' + data['user'] + '"]').remove();

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
    success: function(response) {
      notification(response);
      $('.requests').find('li[data-id="' + data['user'] + '"]').remove();

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
    success: function(response) {
      notification(response);
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
    success: function(response) {
      notification(response);
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
    success: function(response) {
      notification(response);
         $('#'+idName).html('');

        if(response.length >= 1){
          for (i = 0; i < response.length; i++) {
             $('#'+idName).append('<button type="button" class="btn btn-simple btn-primary btn-xs userResultButton" style="width:100%;">'+response[i].email+'<div class="ripple-container"></div></button>')
          }
        }
    }
  });
}

function ajax_saveProfile(data)
{

  $.ajax({
    url: site_url +'/'+ currPage,
    type: "POST",
    dataType: "JSON",
    data: { data: data },
    beforeSend: function (xhr) {
          var token = $('meta[name="_token"]').attr('content');

          if (token) {
              return xhr.setRequestHeader('X-CSRF-TOKEN', token);
          }
      },
    success: function (response) {
      notification(response);
      showSaveButton('saved');
    }
  })

function searchCompanyTable(searchValue)
{

  $.ajax({
    url: "/company/search",
    type: "POST",
    data: { name: searchValue },
    dataType: 'json',
    success: function(response) {
        $('#companySearchResult').html('');

        if(response.length > 0){
          for (i = 0; i < response.length; i++) {
            $('#companySearchResult').append('<a href="/company/'+response[i].id+'"><button type="button" class="btn btn-simple btn-primary btn-xs" style="width:100%;">'+response[i].name+'<div class="ripple-container"></div></button></a>')
          }
        } else {
          $('#companySearchResult').html('<h4 class="no-result">Geen bedrijven gevonden.</h4>');
        }

       $('#companySearchResult').append('<button type="button" class="btn btn-simple btn-danger btn-xs cancelCompanySearch" style="width:100%;">Zoeken Annuleren<div class="ripple-container"></div></button>');
    }
  });


}
