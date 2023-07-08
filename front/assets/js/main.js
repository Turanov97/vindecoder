jQuery(document).ready(function ($) {
  // Обработчик отправки формы
  $('#vi_form').submit(function (event) {
    event.preventDefault(); // Предотвращаем обычное поведение отправки формы

    var formData = $('#vin_value').val(); // Сериализуем данные формы

    $.ajax({
      url: myAjax.ajaxurl,
      method: 'POST',
      data: {
        action: 'my_ajax_handler',
        form_data: formData
      },
      success: function (response) {
        // Код, выполняемый при успешном выполнении запроса
        let res = JSON.parse(response)
        if (res.message) {
          $('#responseContainer').html(res.message);
        }
        // $('#responseContainer').html(response);
      },
      error: function (xhr, status, error) {
        // Код, выполняемый при ошибке выполнения запроса
        console.log(error);
      }
    });
  });
});
