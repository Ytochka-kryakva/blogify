

$(function () {
  $(".article__button").on("click", function (e) { // anything with class add-to-cart

    var form = $(this).closest("form").attr("id"); // The form this add-to-cart is in
    var formID = $('#' + form);
    console.log(form);
    var msg = jQuery(formID).serialize(); // ID формы
    jQuery.ajax({
      method: 'POST', // Метод отправки
      url: './handler/comment.php', // Адрес обработчика
      data: msg,
      cache: false,
      success: function (html) {
        jQuery(`#responsecontainer${form}`).html(html);
        $('.article__newComment').val('');
      }
    });  // Вывод ответа

  });
});