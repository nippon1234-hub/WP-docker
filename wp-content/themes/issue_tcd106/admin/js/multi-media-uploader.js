jQuery(function ($) {
  /*
   * Select/Upload image(s) event
   */
$('body').on('click', '.js-multi-media-upload-button', function (e) {
  
  e.preventDefault();

  var button = $(this);
  var buttonId = $(this).attr('id');
  var custom_uploader = {};

  custom_uploader[buttonId] = wp.media({
    title: MULTI_UPLOADER_TEXTS.image_title,
    button: {
      text: MULTI_UPLOADER_TEXTS.image_button
    },
    library: {
      type: [ 'image' ]
    },
    multiple: 'add' 
  });

  custom_uploader[buttonId].on('select', function () { 
    var attech_ids = '';
    attachments
    var attachments = custom_uploader[buttonId].state().get('selection'),
    attachment_ids = new Array(),
    i = 0;

    $(button).siblings('ul').empty();

    attachments.each(function (attachment) {
      attachment_ids[i] = attachment['id'];
      attech_ids += ',' + attachment['id'];

      if (attachment.attributes.type == 'image') {
        var thumbnailUrl = attachment.attributes.sizes.thumbnail?.url ?? attachment.attributes.url;
        $(button).siblings('ul').append('<li data-attechment-id="' + attachment['id'] + '"><img class="true_pre_image" src="' + thumbnailUrl + '" /><span class="delete-img"></span></li>');
      } else {
        $(button).siblings('ul').append('<li data-attechment-id="' + attachment['id'] + '"><div class="image"><img loading="lazy" class="true_pre_image" src="' + attachment.attributes.icon + '" /></div><span class="delete-img"></span></li>');
      }
      i++;

    });

    $(button).siblings('.attechments-ids').attr('value', attachment_ids);
    $(button).siblings('.js-multi-media-remove-button').show();

  });

  custom_uploader[buttonId].on('open',function() {
    var selection = custom_uploader[buttonId].state().get('selection');
    var ids_value = $(button).siblings('.attechments-ids').val();

    if(ids_value.length > 0) {
      var ids = ids_value.split(',');

      ids.forEach(function(id) {
        attachment = wp.media.attachment(id);
        attachment.fetch();
        selection.add(attachment ? [attachment] : []);
      });
    }
  });

  custom_uploader[buttonId].open();
  
});

  /*
   * Remove image event
   */
  $('body').on('click', '.js-multi-media-remove-button', function () {
    $(this).hide().prev().val('').prev().addClass('button');
    $(this).parent().find('ul').empty();
    return false;
  });

  $(document).on('click', '.multi-media-uploader ul li .delete-img', function () {
    var ids = [];
    var attach_id =  $(this).parents('li').attr('data-attechment-id');
    var parent = $(this).closest('.multi-media-uploader');
    parent.find('li').each(function () {
      if( attach_id != $(this).attr('data-attechment-id') ){
        ids.push($(this).attr('data-attechment-id'));
      }
    });
    parent.find('input[type="hidden"]').val(ids);
    $(this).parent().remove();
  });

});