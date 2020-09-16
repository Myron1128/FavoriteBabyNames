// send subscribe email
$('form.myform').on('submit', function() {
    var that = $(this);
    url = that.attr('action'),
    type = that.attr('method'),
    data = {};

    that.find('[name]').each(function(value){
      var that = $(this),
      name = that.attr('name'),
      value = that.val();

      data[name] = value;
    });

    $.ajax({
      url: url,
      type: type,
      data: data,

      success: function(response) {
        console.log(response);
        location.reload();
      }
    });
    return false;
  });