require('./bootstrap');


$(document).ready(function () {

  $(function () {
    $('[data-toggle="tooltip"]').tooltip()
  })

  error = function(){
    alert('Наша компания постоянно работает над улучшением сервиса и скоро данная услуга будет доступна для Вас, спасибо за то, что выбрали нас!');
  }

  $('a[href^="#"]').on('click',function (e) {
      e.preventDefault();

      var target = $(this.hash);
      $('html, body').stop().animate({
          'scrollTop': target.offset().top
      }, 500);
  });

  SM = function(idx,idmore,idless) {
    $('#'+idx).show(300);
    $('#'+idmore).hide(300);
    $('#'+idless).show(300)
  }

  SL = function(idx,idmore,idless) {
    $('#'+idx).hide(300);
    $('#'+idmore).show(300);
    $('#'+idless).hide(300)
  }

  ScrollTo = function(el){
    var destination = el.offset().top;
    $('html').animate({ scrollTop: destination }, 1100);
  }

  BtnChange = function(el){
    $('#'+el+'').prop( "readonly", false );
    $('#'+el+'').val('');
    $('#'+el+'').focus();
    $('#'+el+'btn').fadeOut(300);
    alert('Теперь Вы можете изменить поле');
  }


});
