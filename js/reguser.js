$('#nivel').change(function() {
  // alert('Handler for .change() called.');
  var vnivel = $('#nivel').val();
  if (vnivel == 4) {
    $('.areasec').show('slow');
    // alert('You have to select the user area.');
    $('#area').removeAttr('disabled');
  } else {
    $('#area').attr('disabled','disabled');
    $('.areasec').hide('slow');  
  }
});