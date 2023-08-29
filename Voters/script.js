$(document).ready(function() {
  $('.platform').click(function() {
    var bookId = $(this).data('bookid');
    alert(bookId);
    $.ajax({
      url: 'show_Plat.php',
      type: 'post',
      data: {
        bookId: bookId,
        table: 'candidates'
      },
      success: function(data) {
        $('.pop-up .form').html(data);
        $('.pop-up').addClass('active');
      }
    });
  });
  $('.close-btn').click(function() {
  $('.pop-up').removeClass('active');
  });
});