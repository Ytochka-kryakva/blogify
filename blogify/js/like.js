$(document).ready(function () {
  $(".article__like-img").bind("click", function () {
    var link = $(this);
    var id = $(this).data('id');
    $.ajax({
      url: "./handler/like.php",
      type: "POST",
      data: { id: id }, // Передаем ID нашей статьи
      dataType: "json",
      success: function (result) {
        if (!result.error) { //если на сервере не произойло ошибки то обновляем количество лайков на странице
          link.addClass('active'); // помечаем лайк как "понравившийся"
          $('.article__like-count', link).html(result.count);
        } else {
          link.removeClass('active');
          $('.article__like-count', link).html(result.count);
        }
      }
    });
  });
});