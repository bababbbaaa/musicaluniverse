$(document).ready(function() {
  $('.favor').on('click', function(e) {
    var favorID = $(this).attr('data-item');
    if($(this).hasClass('active'))
      var doAction = 'delete';
    else
      var doAction = 'add';
    addFavorite(favorID, doAction);
  });

  $('.like-btn').on('click', function(e) {
    var likeID = $(this).attr('data-item');
    addLike(likeID);
  });
});

function addFavorite(id, action)
{
  var param = 'id='+id+"&action="+action;
  $.ajax({
    url:     '/local/ajax/favorites.php',
    type:     "GET",
    dataType: "html",
    data: param,
    success: function(response) {
      var result = $.parseJSON(response);
      if(result == 1){
        $('.favor[data-item="'+id+'"]').addClass('active');
      } else if(result == -1){
        $('.favor[data-item="'+id+'"]').removeClass('active');
      }
    },
    error: function(jqXHR, textStatus, errorThrown){
      console.log('Error: '+ errorThrown);
    }
  });
}

function addLike(id)
{
  let count = Number($('.like-btn[data-item="'+id+'"] + div').text());
  if(count<1) count = 0;

  var param = 'id='+id;
  $.ajax({
    url:     '/local/ajax/likes.php',
    type:     "GET",
    dataType: "html",
    data: param,
    success: function(response) {
      var result = $.parseJSON(response);

      if(!$('.like-btn[data-item="'+id+'"]').hasClass('liked')){
        $('.like-btn[data-item="'+id+'"]').addClass('liked');
        $('.like-btn[data-item="'+id+'"] + div').text(result);
      } else {
        $('.like-btn[data-item="'+id+'"]').removeClass('liked');
        $('.like-btn[data-item="'+id+'"] + div').text(result);
      }
    },
    error: function(jqXHR, textStatus, errorThrown){
      console.log('Error: '+ errorThrown);
    }
  });
}