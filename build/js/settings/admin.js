/* global OCP, OC */

$(function() {
   $('#pwkAdblockerWarning').hide();

   function showRequestResult(element, result) {
      if (element.attr('type') === 'checkbox') {
         element = $('label[for="' + element.attr('id') + '"]');
      }

      element.removeClass('pwk-success pwk-error');
      element.addClass('pwk-' + result);

      var timeout = element.data('timeout');

      if (timeout) {
         clearTimeout(timeout);
      }

      timeout = setTimeout(function() {
         element.removeClass('pwk-success pwk-error');
      }, 1000);

      element.data('timeout', timeout);
   }

   $('#pwkUrl').attr('placeholder', 'e.g. //' + window.location.host + '/pwk/');

   $('#pwkSettings input').change(function() {
      var element = $(this);
      var key = $(this).attr('name');
      var value = $(this).attr('type') === 'checkbox' ? $(this).prop('checked') : $(this).val();

      $.ajax({
         method: 'PUT',
         url: OC.generateUrl('apps/pwk/settings/' + key),
         data: {
            value: value
         },
         success: function(response) {
            showRequestResult(element, response.status)
         },
         error: function() {
            showRequestResult(element, 'error') 
         }
      });
   });
});
