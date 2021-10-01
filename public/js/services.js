
$(document).ready(function () {


  // var $element = $('#stopscroll');
  //
  //   $(window).scroll(function() {
  //       var scroll = $(window).scrollTop() + $(window).height();
  //       //Если скролл до конца елемента
  //       //var offset = $element.offset().top + $element.height();
  //       //Если скролл до начала елемента
  //       var offset = $element.offset().top;
  //
  //       if (scroll > offset) {
  //           $('#divscrolitog').removeClass('fixed-bottom');
  //       }
  //       if(offset > scroll+100){
  //           $('#divscrolitog').addClass('fixed-bottom');
  //       }
  //       if (scroll > offset) {
  //           $('#divscrolitog2').removeClass('fixed-bottom');
  //       }
  //       if(offset > scroll+100){
  //           $('#divscrolitog2').addClass('fixed-bottom');
  //       }
  //   });

  examplesearch = function(id) {
      var myP = document.getElementById(id);
      document.getElementById("datatosearchkn").value = myP.innerText;
  }

  $("#phone").inputmask({"mask": "+9(999)999-9999","autoUnmask" : true, "removeMaskOnSubmit" : true });
  $("#register_phone").inputmask({"mask": "+9(999)999-9999","autoUnmask" : true, "removeMaskOnSubmit" : true });
  $("#dataki").inputmask("99/99/9999",{ "placeholder": "dd/mm/yyyy" });

  $( function() {
    var date = new Date();
    date.setDate(date.getDate() + 1);

    $( "#dataki" ).datepicker({
        minDate: date,
        maxDate: "+2m +1w",
        dateFormat: 'dd/mm/yy'
    });

} );

$( "#dataki" ).change(function () {
        if($( "#dataki" ).val() != ''){
            var date = new Date();
            var year = date.getFullYear();
            // date.setDate(date.getDate() + 1);
            var sDate = $('#dataki').val();
            var date = sDate.split('/');

            if (date[0] >= 1 && date[0] <= 31){
              if (date[1] >= 1 && date[1] <= 12){
                if (date[2] >= year && date[2] <= 2025){

                }else{
                  document.getElementById('dataki').value = '';
                  alert('Проверьте дату приезда специалиста, возможно Вы вписали не правильную дату.');
                }
              }else{
                document.getElementById('dataki').value = '';
                alert('Проверьте дату приезда специалиста, возможно Вы вписали не правильную дату.');
              }
            }else{
              document.getElementById('dataki').value = '';
              alert('Проверьте дату приезда специалиста, возможно Вы вписали не правильную дату.');
            }
        }
    });

// $("#timeki1").keydown(function (event) { event.preventDefault(); });
// $("#timeki2").keydown(function (event) { event.preventDefault(); });


    var token = "67fd1083a94980b339851baf73f373e31510c813";

    var $address = $("#datatosearchkn");
    var $message = $("#message");
    var $continue = $("#btnsearchkn");
    var selectedAddress;


    function selectAddress(suggestion) {
        if (suggestion.data.house) {
          $continue.prop("disabled", false);
        } else {
            $("#messageblock").toggleClass('d-none');
            $message.text("Укажите адрес до дома, чтобы продолжить");
            $continue.prop("disabled", true);
        }
        selectedAddress = suggestion.data;
    }

    function selectNone() {
        selectedAddress = null;
        $("#messageblock").toggleClass('d-none');
        $message.text("Возможно, Вы вводите адрес неправильно");
        $continue.prop("disabled", false);
    }

    $address.suggestions({
        token: token,
        type: "ADDRESS",
        onSelect: selectAddress,
        onSelectNothing: selectNone
    });

    $("#adresdostavki").suggestions({
        token: token,
        type: "ADDRESS",
        /* Вызывается, когда пользователь выбирает одну из подсказок*/
        onSelect: function(suggestion) {
            console.log(suggestion);
        }
    });


  $('#searchobjForm').on('submit', function (e) {
      e.preventDefault();
      var typeservices = $('#typeservices').val();
      var cadnomer;
      if($("#datatosearchkn").val() == ''){
        $("#messageblock").toggleClass('d-none');
        $message.text("Убедитесь, что поле с данными для поиска не пустые");
      }else{
        document.getElementById('btnsearch').disabled = true;
        $('#btnsearchspinner').toggleClass('d-none');
        $('#loadingblock').toggleClass('d-none');
        $.ajax({
          url:     "/search", //Адрес подгружаемой страницы
          type:     "POST", //Тип запроса
          data: $('#searchobjForm').serialize(),
          success: function(data) {
            document.getElementById('btnsearch').disabled = false;
            $('#btnsearchspinner').toggleClass('d-none');
            $('#loadingblock').toggleClass('d-none');
            if ((data['error'].length == 0)&&(data['found'] > 0)) {
              if(data['found'] > 1){
                window.location.replace("/phonetic-obj/"+typeservices+"");
              }else{
                cadnomer = data['objects']['0']['CADNOMER'];
                window.location.replace("/order/"+typeservices+"/"+cadnomer+"");
              }
            }else{
              $("#messageblock").toggleClass('d-none');
              $message.text("Увы Росреестр,не смог обработать Ваш запрос. Вам придется попробовать заново через некоторое время, приносим свои извенения!");
            }
            }

          });
      }
  });

  $('#phoneticForm').on('submit', function (e) {
      e.preventDefault();
      var typeservices = $('#typeservices').val();
      var cadnomer;
      var count = false;
      var inp = document.getElementsByName('cadastrnumber');
      for (var i = 0; i < inp.length; i++) {
          if (inp[i].type == "radio" && inp[i].checked) {
              count = true;
              cadnomer = inp[i].value;
          }
      }

      if(!count){
        $("#messageblock").toggleClass('d-none');
        $message.text("Выберите адрес для продолжения");
      }else{
        document.getElementById('phoneticbtn').disabled = true;
        $('#phoneticbtnspinner').toggleClass('d-none');
        window.location.replace("/order/"+typeservices+"/"+cadnomer+"");
      }
  });


$(".onlypaytrans").change(function() {
  if (($('#egrn').prop("checked"))||($('#egrp').prop("checked"))||($('#cadst').prop("checked"))||($('#arest').prop("checked"))) {
    $('#payki').prop("disabled", true);
    $('#paykides1').show();
    $('#paykides2').hide();
    $('#paykiblock').hide();
    document.getElementById('payki').checked = false;
    document.getElementById('paytrans').checked = true;
  }else{
    $('#payki').prop("disabled", false);
    $('#paykides1').hide();
    $('#paykides2').show();
    $('#paykiblock').show();
    document.getElementById('payki').checked = true;
    document.getElementById('paytrans').checked = false;
  }

});

$("#livinghouse").change(function() {
    if ($('#livinghouse').prop("checked")) {
        $('#livinghouseareablock').fadeIn(300);
        $('#sposobpodachiblock').fadeIn(300);
        $('#datakiblock').fadeIn(300);
        var typerealtygp = ChecktyperealtiGP();
        if(typerealtygp.x>0){
            if ($('#sposobpodachi1').prop("checked")) {
                $('#gosposhlinablock').fadeIn(300);
                document.getElementById('gosposhlina').checked = true;
            }
        }

    } else {
        $('#livinghouseareablock').fadeOut(300);
        if (!$('#nonlivinghouse').prop("checked")) {
            $('#sposobpodachiblock').fadeOut(300);
            $('#datakiblock').fadeOut(300);
            $('#gosposhlinanblock').fadeOut(300);
            $('#sposob1').fadeOut(300);
            $('#sposob2').fadeOut(300);
            $('#adresdatadostavki').fadeOut(300);
            $('#datakiblock').fadeOut(300);
            document.getElementById("adresdostavki").value = '';
            document.getElementById("dataki").value = '';
            document.getElementById('livinghouse').checked = false;
            document.getElementById('nonlivinghouse').checked = false;
            document.getElementById('sposobpodachi1').checked = false;
            document.getElementById('sposobpodachi2').checked = false;
            document.getElementById('resulttoemail').checked = false;
            document.getElementById('resulttokurier').checked = false;
            document.getElementById('zapistpnacd').checked = false;
            document.getElementById('tpkurierom').checked = false;

        }
        if ($('#sposobpodachi1').prop("checked")) {
            $('#gosposhlinablock').fadeOut(300);
            document.getElementById('gosposhlina').checked = false;
        }
    }
    Summa();
  });

  $('#livinghousearea').change(function(){
    tmpval = $(this).val();
    if(tmpval == '') {
    } else {
        var response = confirm('Сохранить значение для примерной площади равное '+tmpval+' кв. м. ?');
        if(response){
          $(this).prop( "readonly", true );
          $('#livinghouseareabtn').fadeIn(300);
        }
    }
  });

  $("#nonlivinghouse").change(function() {
    if ($('#nonlivinghouse').prop("checked")) {
        $('#nlhselect').fadeIn(300);
        $('#sposobpodachiblock').fadeIn(300);
        $('#datakiblock').fadeIn(300);
        if ($('#typerealtynlh').val()=='Другое') {
            $('#nlhdrugoe').fadeIn(300);
        }
        var typerealtygp = ChecktyperealtiGP();
        if(typerealtygp.y>0) {
            if ($('#sposobpodachi1').prop("checked")) {
                $('#gosposhlinanblock').fadeIn(300);
                document.getElementById('gosposhlinan').checked = true;
                document.getElementById('countnlh').innerHTML = typerealtygp.y;
            }
        }
    } else {
        $('#nlhselect').fadeOut(300);
        $('#nlhdrugoe').fadeOut(300);
        if (!$('#livinghouse').prop("checked")) {
            $('#sposobpodachiblock').fadeOut(300);
            $('#datakiblock').fadeOut(300);
            $('#gosposhlinanblock').fadeOut(300);
            $('#sposob1').fadeOut(300);
            $('#sposob2').fadeOut(300);
            $('#adresdatadostavki').fadeOut(300);
            $('#datakiblock').fadeOut(300);
            document.getElementById("adresdostavki").value = '';
            document.getElementById("dataki").value = '';
            document.getElementById('livinghouse').checked = false;
            document.getElementById('nonlivinghouse').checked = false;
            document.getElementById('sposobpodachi1').checked = false;
            document.getElementById('sposobpodachi2').checked = false;
            document.getElementById('resulttoemail').checked = false;
            document.getElementById('resulttokurier').checked = false;
            document.getElementById('zapistpnacd').checked = false;
            document.getElementById('tpkurierom').checked = false;
        }
        var typerealtygp = ChecktyperealtiGP();
        if(!typerealtygp.y>0) {
            if ($('#sposobpodachi1').prop("checked")) {
                $('#gosposhlinanblock').fadeOut(300);
                document.getElementById('gosposhlinan').checked = false;
                document.getElementById('countnlh').innerHTML = typerealtygp.y;
            }
        }
    }
    Summa();
  });

  $("#regpraval").change(function() {
      if ($('#regpraval').prop("checked")) {
          $('#regpravalareablock').fadeIn(300);
          $('#sposobpodachiblock').fadeIn(300);
          $('#datakiblock').fadeIn(300);
          ScrollTo($('#regpravalareablock'));
      } else {
        $('#regpravalareablock').fadeOut(300);
        if (!$('#uchet').prop("checked")) {
          $('#sposobpodachiblock').fadeOut(300);
          $('#datakiblock').fadeOut(300);
          $('#gosposhlinanblock').fadeOut(300);
          $('#sposob1').fadeOut(300);
          $('#sposob2').fadeOut(300);
          $('#adresdatadostavki').fadeOut(300);
          $('#datakiblock').fadeOut(300);
          document.getElementById("adresdostavki").value = '';
          document.getElementById("dataki").value = '';
          document.getElementById('livinghouse').checked = false;
          document.getElementById('nonlivinghouse').checked = false;
          document.getElementById('sposobpodachi1').checked = false;
          document.getElementById('sposobpodachi2').checked = false;
          document.getElementById('resulttoemail').checked = false;
          document.getElementById('resulttokurier').checked = false;
          document.getElementById('zapistpnacd').checked = false;
          document.getElementById('tpkurierom').checked = false;
        }
      }
      Summa();
  });

  $('#regpravalarea').change(function(){
    tmpval = $(this).val();
    if(tmpval == '') {
    } else {
        var response = confirm('Сохранить значение для примерной площади равное '+tmpval+' кв. м. ?');
        if(response){
          $(this).prop( "readonly", true );
          $('#regpravalareabtn').fadeIn(300);
        }
    }
  });



  $("#regprava").change(function() {
      if ($('#regprava').prop("checked")) {
          $('#regpravanlhselect').fadeIn(300);
          $('#sposobpodachiblock').fadeIn(300);
          $('#datakiblock').fadeIn(300);
      } else {
          $('#regpravanlhselect').fadeOut(300);
          $('#regpravanlhdrugoe').fadeOut(300);
          document.getElementById('regpravanlh').value='Список';
        if (!$('#uchet').prop("checked")) {
          $('#sposobpodachiblock').fadeOut(300);
          $('#datakiblock').fadeOut(300);
          $('#gosposhlinanblock').fadeOut(300);
          $('#sposob1').fadeOut(300);
          $('#sposob2').fadeOut(300);
          $('#adresdatadostavki').fadeOut(300);
          $('#datakiblock').fadeOut(300);
          document.getElementById("adresdostavki").value = '';
          document.getElementById("dataki").value = '';
          document.getElementById('livinghouse').checked = false;
          document.getElementById('nonlivinghouse').checked = false;
          document.getElementById('sposobpodachi1').checked = false;
          document.getElementById('sposobpodachi2').checked = false;
          document.getElementById('resulttoemail').checked = false;
          document.getElementById('resulttokurier').checked = false;
          document.getElementById('zapistpnacd').checked = false;
          document.getElementById('tpkurierom').checked = false;
      }
    }
    Summa();
  });

  $("#uchet").change(function() {
      if ($('#uchet').prop("checked")) {
          $('#livinghousecheckblock').fadeIn(300);
          $('#nonlivinghousecheckblock').fadeIn(300);

      } else {
        if(($('#regpraval').prop("checked"))||($('#regprava').prop("checked"))){
            $('#livinghousecheckblock').fadeOut(300);
            $('#livinghouseareablock').fadeOut(300);
            $('#nonlivinghousecheckblock').fadeOut(300);
            $('#gosposhlinablock').fadeOut(300);
            document.getElementById('gosposhlina').checked = false;
            $('#gosposhlinanblock').fadeOut(300);
            document.getElementById('livinghouse').checked = false;
            document.getElementById('nonlivinghouse').checked = false;
            var typerealtygp = ChecktyperealtiGP();
            if(!typerealtygp.y>0) {
                if ($('#sposobpodachi1').prop("checked")) {
                    $('#gosposhlinanblock').fadeOut(300);
                    document.getElementById('gosposhlinan').checked = false;
                    document.getElementById('countnlh').innerHTML = typerealtygp.y;
                }
            }
            addInput();
        }else{
            $('#livinghousecheckblock').fadeOut(300);
            $('#livinghouseareablock').fadeOut(300);
            $('#nonlivinghousecheckblock').fadeOut(300);
            $('#sposobpodachiblock').fadeOut(300);
            $('#gosposhlinablock').fadeOut(300);
            $('#gosposhlinanblock').fadeOut(300);
            $('#sposob1').fadeOut(300);
            $('#sposob2').fadeOut(300);
            $('#adresdatadostavki').fadeOut(300);
            $('#datakiblock').fadeOut(300);
            document.getElementById("adresdostavki").value = '';
            document.getElementById("dataki").value = '';
            document.getElementById('livinghouse').checked = false;
            document.getElementById('nonlivinghouse').checked = false;
            document.getElementById('gosposhlina').checked = false;
            var typerealtygp = ChecktyperealtiGP();
            if(!typerealtygp.y>0) {
                if ($('#sposobpodachi1').prop("checked")) {
                    $('#gosposhlinanblock').fadeOut(300);
                    document.getElementById('gosposhlinan').checked = false;
                    document.getElementById('countnlh').innerHTML = typerealtygp.y;
                }
            }
            document.getElementById('sposobpodachi1').checked = false;
            document.getElementById('sposobpodachi2').checked = false;
            document.getElementById('resulttoemail').checked = false;
            document.getElementById('resulttokurier').checked = false;
            document.getElementById('zapistpnacd').checked = false;
            document.getElementById('tpkurierom').checked = false;
            addInput();
        }
      }
    Summa();
  });

$(".form_radio_group-item").change(function() {
  if ($('#sposobpodachi1').prop("checked")) {
      $('#sposob1').fadeIn(300);
      $('#sposob2').fadeOut(300);
      var typerealtygp = ChecktyperealtiGP();
      if(typerealtygp.x>0){
          $('#gosposhlinablock').fadeIn(300);
          document.getElementById('gosposhlina').checked = true;
      }
      if(typerealtygp.y>0){
          $('#gosposhlinanblock').fadeIn(300);
          document.getElementById('gosposhlinan').checked = true;
          document.getElementById('countnlh').innerHTML = typerealtygp.y;
      }

  } else {
      $('#sposob1').fadeOut(300);
      $('#sposob2').fadeIn(300);
      $('#gosposhlinablock').fadeOut(300);
      document.getElementById('gosposhlina').checked = false;
      $('#gosposhlinanblock').fadeOut(300);
      document.getElementById('gosposhlinan').checked = false;
  }

  Summa();

});

$("#resulttokurier").change(function() {

    if ($('#resulttokurier').prop("checked")) {
        $('#adresdatadostavki').fadeIn(300);

    } else {
        $('#adresdatadostavki').fadeOut(300);
    }
    Summa();
});
$("#payonline").change(function() {
    if ($('#payonline').prop("checked")) {
        document.getElementById('payki').checked = false;
        document.getElementById('paytrans').checked = false;
        $('#paykides1').show();
        $('#paykides2').hide();

    } else {
        document.getElementById('payki').checked = true;
    }
});
$("#payki").change(function() {
    if ($('#payki').prop("checked")) {
        document.getElementById('payonline').checked = false;
        document.getElementById('paytrans').checked = false;
        $('#paykides1').hide();
        $('#paykides2').show();

    } else {
        document.getElementById('paytrans').checked = true;
        $('#paykides1').show();
        $('#paykides2').hide();
    }
});

$("#paytrans").change(function() {
    if ($('#paytrans').prop("checked")) {
        document.getElementById('payonline').checked = false;
        document.getElementById('payki').checked = false;
        $('#paykides1').show();
        $('#paykides2').hide();

    } else {
        document.getElementById('payki').checked = true;

    }
});

$("#tpkurierom").change(function() {

    if ($('#tpkurierom').prop("checked")) {
        $('#adresdatadostavki').fadeIn(300);
    } else {
        $('#adresdatadostavki').fadeOut(300);
    }
    Summa();
});

$("#saveadresdostavki").change(function() {
    if ($('#saveadresdostavki').prop("checked")) {
        var getAdres = document.getElementById('adresspan').innerHTML;
        document.getElementById("adresdostavki").value = ''+getAdres;
    } else {
        document.getElementById("adresdostavki").value = ''
    }
});


$("#typerealtynlh").change(function() {
    if ($('#typerealtynlh').val()=='Другое') {
        $('#nlhdrugoe').fadeIn(300);
    } else {
        $('#nlhdrugoe').fadeOut(300);
    }
    Summa();
});

$("#regpravanlh").change(function() {
    if ($('#regpravanlh').val()=='Другое') {
        $('#regpravanlhdrugoe').fadeIn(300);
    } else {
        $('#regpravanlhdrugoe').fadeOut(300);
    }
    Summa();
});


var usl2 = 0;
    $("#topografs").change(function() {

        if ($('#topografs').prop("checked")) {
            $('#sqzemuchblock').fadeIn();
            ScrollTo($('#sqzemuchblock'));
            $('#datakiblock').fadeIn();
            usl2++;
        } else {
            $('#sqzemuchblock').fadeOut();
            usl2--;

            if(usl2 < 1){
                $('#datakiblock').fadeOut();
            }

            document.getElementById('sqzemuch').value = '';
            $('#sqzemuch').prop( "readonly", false );
            $('#sqzemuchbtn').fadeOut(300);
        }
    });

    $('#sqzemuch').change(function(){
      tmpval = $(this).val();
      if(tmpval == '') {
      } else {
          var response = confirm('Сохранить значение для примерной площади равное '+tmpval+' соток/соткам ?');
          if(response){
            $(this).prop( "readonly", true );
            $('#sqzemuchbtn').fadeIn(300);
          }
      }
    });

    $("#vinosgranic").change(function() {

        if ($('#vinosgranic').prop("checked")) {
            $('#vinosgranicblock').fadeIn();
            $('#datakiblock').fadeIn();
            usl2++;
        } else {
            $('#vinosgranicblock').fadeOut();
            usl2--;

            if(usl2 < 1){
                $('#datakiblock').fadeOut();
            }
            document.getElementById('colznakov').value = '';
            $('#colznakov').prop( "readonly", false );
            $('#colznakovbtn').fadeOut(300);
        }
    });

    $('#colznakov').change(function(){
      tmpval = $(this).val();
      if(tmpval == '') {
      } else {
          var response = confirm('Сохранить значение для количества межевых знаков равное '+tmpval+' з. ?');
          if(response){
            $(this).prop( "readonly", true );
            $('#colznakovbtn').fadeIn(300);
          }
      }
    });

    $("#semkacomm").change(function() {

        if ($('#semkacomm').prop("checked")) {
            $('#semkacommblock').fadeIn();
            $('#datakiblock').fadeIn();
            usl2++;
        } else {
            $('#semkacommblock').fadeOut();
            usl2--;

            if(usl2 < 1){
                $('#datakiblock').fadeOut();
            }
            document.getElementById('prottrass').value = '';
            $('#prottrass').prop( "readonly", false );
            $('#prottrassbtn').fadeIn(300);
        }
    });

    $('#prottrass').change(function(){
      tmpval = $(this).val();
      if(tmpval == '') {
      } else {
          var response = confirm('Сохранить значение для протяженности трассы равное '+tmpval+' м ?');
          if(response){
            $(this).prop( "readonly", true );
            $('#prottrassbtn').fadeIn(300);
          }
      }
    });

    $("#razbivkaos").change(function() {

        if ($('#razbivkaos').prop("checked")) {
            $('#razbivkaosblock').fadeIn();
            $('#datakiblock').fadeIn();
            usl2++;
        } else {
            $('#razbivkaosblock').fadeOut();
            usl2--;

            if(usl2 < 1){
                $('#datakiblock').fadeOut();
            }
            document.getElementById('colosey').value = '';
            $('#colosey').prop( "readonly", false );
            $('#coloseybtn').fadeIn(300);
        }
    });

    $('#colosey').change(function(){
      tmpval = $(this).val();
      if(tmpval == '') {
      } else {
          var response = confirm('Сохранить значение для количества осей равное '+tmpval+' о. ?');
          if(response){
            $(this).prop( "readonly", true );
            $('#coloseybtn').fadeIn(300);
          }
      }
    });

    $("#cadsemzu").change(function() {

        if ($('#cadsemzu').prop("checked")) {
            $('#cadsemzublock').fadeIn();
            $('#datakiblock').fadeIn();
            usl2++;
        } else {
            $('#cadsemzublock').fadeOut();
            usl2--;

            if(usl2 < 1){
                $('#datakiblock').fadeOut();
            }
            document.getElementById('sqzemuccs').value = '';
            $('#sqzemuccs').prop( "readonly", false );
            $('#sqzemuccsbtn').fadeIn(300);
        }
    });

    $('#sqzemuccs').change(function(){
      tmpval = $(this).val();
      if(tmpval == '') {
      } else {
          var response = confirm('Сохранить значение для примерной площади равное '+tmpval+' соток/соткам ?');
          if(response){
            $(this).prop( "readonly", true );
            $('#sqzemuccsbtn').fadeIn(300);
          }
      }
    });

    var usl3 = 0;
        $("#mezhplot").change(function() {

            if ($(this).prop("checked")) {
                $('#sqmezhblock').fadeIn();
                ScrollTo($('#sqmezhblock'));
                $('#datakiblock').fadeIn();
                usl3++;
            } else {
                $('#sqmezhblock').fadeOut();
                usl3--;

                if(usl3 < 1){
                    $('#datakiblock').fadeOut();
                }

                document.getElementById('sqmezh').value = '';
                $('#sqmezh').prop( "readonly", false );
                $('#sqmezhbtn').fadeOut(300);
            }
        });

        $('#sqmezh').change(function(){
          tmpval = $(this).val();
          if(tmpval == '') {
          } else {
              var response = confirm('Сохранить значение для примерной площади равное '+tmpval+' соток/соткам ?');
              if(response){
                $(this).prop( "readonly", true );
                $('#sqmezhbtn').fadeIn(300);
              }
          }
        });

        $("#razdelplot").change(function() {

            if ($(this).prop("checked")) {
                $('#colpieblock').fadeIn();
                $('#datakiblock').fadeIn();
                usl3++;
            } else {
                $('#colpieblock').fadeOut();
                usl3--;

                if(usl3 < 1){
                    $('#datakiblock').fadeOut();
                }

                document.getElementById('colpie').value = '';
                $('#colpie').prop( "readonly", false );
                $('#colpiebtn').fadeOut(300);
            }
        });

        $('#colpie').change(function(){
          tmpval = $(this).val();
          if(tmpval == '') {
          }else if(tmpval < 2){
            alert("Выберите значение для этого поля более 2.");
            $(this).val('');
          } else {
              var response = confirm('Сохранить значение для колличества частей равное '+tmpval+' ч. ?');
              if(response){
                $(this).prop( "readonly", true );
                $('#colpiebtn').fadeIn(300);
              }
          }
        });

        $("#soedplot").change(function() {

            if ($(this).prop("checked")) {
                $('#colpeaceblock').fadeIn();
                $('#datakiblock').fadeIn();
                usl3++;
            } else {
                $('#colpeaceblock').fadeOut();
                usl3--;

                if(usl3 < 1){
                    $('#datakiblock').fadeOut();
                }

                document.getElementById('colpeace').value = '';
                $('#colpeace').prop( "readonly", false );
                $('#colpeacebtn').fadeOut(300);
            }
        });

        $('#colpeace').change(function(){
          tmpval = $(this).val();
          if(tmpval == '') {
          }else if(tmpval < 2){
            alert("Выберите значение для этого поля более 2.");
            $(this).val('');
          }  else {
              var response = confirm('Сохранить значение для колличества участков равное '+tmpval+' уч. ?');
              if(response){
                $(this).prop( "readonly", true );
                $('#colpeacebtn').fadeIn(300);
              }
          }
        });

        $("#servplot").change(function() {

            if ($(this).prop("checked")) {
                $('#datakiblock').fadeIn();
                usl3++;
            } else {
                usl3--;

                if(usl3 < 1){
                    $('#datakiblock').fadeOut();
                }
            }
        });

        $("#expertplot").change(function() {

            if ($(this).prop("checked")) {
                $('#datakiblock').fadeIn();
                usl3++;
            } else {
                usl3--;

                if(usl3 < 1){
                    $('#datakiblock').fadeOut();
                }
            }
        });




  function AjaxFormRequest(result_id,form_id,url) {
      $.ajax({
          url:     url, //Адрес подгружаемой страницы
          type:     "POST", //Тип запроса
          dataType: "html", //Тип данных
          data: jQuery("#"+form_id).serialize(),
          success: function(response) { //Если все нормально
              document.getElementById(result_id).innerHTML = response;
          },
          error: function(response) { //Если ошибка
              document.getElementById(result_id+"_error").innerHTML = "Ошибка при отправке формы";
          }
      });

  }
});


var x = 0;

//Добавление полей нежилое
function addInput() {

  var str = '<table class="border-bottom mb-2" width="100%" cellspacing="0" cellpadding="5">' +
      '<tr>' +
      '<td width="10%" valign="top">' +
      '<div class="checkbox-other">' +
      '<input type="checkbox" value="Нежилое строение" id="nonlivinghouse' + (x + 1) + '" name="nonlivinghouse' + (x + 1) + '" class="summa" onclick="Summa();addInput()">' +
      '</div>' +
      '</td>' +
      '<td valign="top">' +
      '<label class="checkbox-other" for="nonlivinghouse' + (x + 1) + '">' +
      '<p>Нежилое строение</p>' +
      '<div id="nonelivinghousedescr' + (x + 1) + '" style="display: none">' +
      '<p><span>Согласно закону, любая хозяйственная постройка такая как баня, гараж, навес, курятник, беседка должна быть зарегестрирован . Для занесения в базу Росреестра такой постройки потребуется следующий набор документов: </span></p>' +
      '<p><span>1. Заявление на регистрацию (или декларация &ndash; при амнистии);</span><br /><span>2. Копия паспорта владельца участка (или его представителя);</span><br /><span>3. Документы, подтверждающие право на участок (свидетельство о праве, договор, выписка из ЕГРН);</span><br /><span>4. Межевой и технический планы дачного участка (делается кадастровыми инженерами);</span><br /><span>5. Разрешение на строительство (не нужно при амнистии).</span></p>' +
      '<p><span>Уполномоченные органы регистрируют хозяйственную постройку на протяжении 7-10 рабочих дней. По окончанию операции владельцу земельного участка выдается выписка из ЕГРН с обновленными данными. Стоимость регистрации зависит от статуса хозяйственного блока:</span></p>' +
      '<ul>' +
      '<li><span>Цена государственной пошлины для участков, которые попали под дачную амнистию может варьироваться&nbsp;</span><span>и отличается от стоимости тех построек которые строятся с разрешением.</span></li>' +
      '<li><span>Если собственник бани пренебрегает регистрированием, то рано или поздно ему придется уплатить штраф.</span><br /><span></span><span></span><span></span></li>' +
      '</ul>' +
      '<span>Санкции имеют два слагаемых: 20% от совокупной невнесенной суммы налога + уплата налога за три года. Также важно помнить, что отсутствующие в базе Росреестра постройки запрещено отчуждать, вводить в эксплуатацию и подключать к инженерным сетям.</span>' +
      '</div>' +
      '<p><del><span id="pricenlhd' + (x + 1) + '">'+$('#pricenlhd').text()+'</span> руб.</del> <span style="color: red;" id="pricenlh' + (x + 1) + '">'+$('#pricenlh').text()+'</span><span style="color: red;"> руб.</span></p>' +
      '</label>' +
      '<div class="mb-3" id="nlhselect' + (x + 1) + '" style="display:none">'+
      '  <select class="mdb-select md-form mb-2" id="typerealtynlh' + (x + 1) + '" name="typerealtynlh' + (x + 1) + '" onclick="Summa();">'+
            '<option value="Список" class="summa">Выберите из списка</option>'+
            '<option value="Гараж" class="summa">Гараж: <span style="color: red;">'+$('#garazh').text()+'</span></option>'+
            '<option value="Баня" class="summa" >Баня: <span style="color: red;">'+$('#bany').text()+'</span></option>'+
            '<option value="Хозяйственный блок" class="summa" >Хозяйственный блок: <span style="color: red;">'+$('#hozblock').text()+'</span></option>'+
            '<option value="Навес" class="summa" >Навес: <span style="color: red;">'+$('#naves').text()+'</span></option>'+
            '<option value="Теплица" class="summa" >Теплица: <span style="color: red;">'+$('#tepl').text()+'</span></option>'+
            '<option value="Садовый дом" class="summa" >Садовый дом: <span style="color: red;">'+$('#saddom').text()+'</span></option>'+
            '<option value="Другое" class="summa" >Другое: <span style="color: red;">'+$('#drugoe').text()+'</span></option>'+
        '</select>'+
        '<div id="nlhdrugoe' + (x + 1) + '" style="display: none;">'+
          '<div class="input-group" >'+
            '<div class="input-group-prepend">'+
              '<span class="input-group-text" id="typerealtydrprepend' + (x + 1) + '">Укажите другое:</span>'+
            '</div>'+
            '<input type="text" class="form-control" id="typerealtydr' + (x + 1) + '" name="typerealtydr' + (x + 1) + '" aria-describedby="typerealtydrprepend' + (x + 1) + '">'+
          '</div>'+
        '</div>'+
      '</div>'+
      '<p id="morenlh' + (x + 1) + '" style="cursor: pointer" class="text-right" onclick="SM(\'nonelivinghousedescr' + (x + 1) + '\',\'morenlh' + (x + 1) + '\',\'lessnlh' + (x + 1) + '\')" >Подробнее &#8595;</p>' +
      '<p id="lessnlh' + (x + 1) + '" onclick="SL(\'nonelivinghousedescr' + (x + 1) + '\',\'morenlh' + (x + 1) + '\',\'lessnlh' + (x + 1) + '\')" class="text-right" style="cursor: pointer; display: none">Скрыть &#8593;</p>' +
      '</td>' +
      '</tr>' +
      '</table>' +
      '<div id="input' + (x + 1) + '"></div>';
    if (x < 10) {

        if($('#nonlivinghouse').prop("checked")){
            if(x==0){
                document.getElementById('input' + x).innerHTML = str;
                x++;
            }
            else if($('#nonlivinghouse'+x).prop("checked")){
                document.getElementById('input' + x).innerHTML = str;
                $('#nlhselect'+x).fadeIn();
                $("#typerealtynlh"+x).change(function() {

                  if (this.value == 'Другое') {
                      $('#nlhdrugoe'+(x-1)).fadeIn(300);
                  }

                 });
                x++;
                var typerealtygp = ChecktyperealtiGP();
                if(typerealtygp.y>0) {
                    if ($('#sposobpodachi1').prop("checked")) {
                        $('#gosposhlinanblock').fadeIn(300);
                        document.getElementById('gosposhlinan').checked = true;
                        document.getElementById('countnlh').innerHTML = typerealtygp.y;
                        Summa();
                    }
                }
            }else
            {
                x--;
                $('#nlhselect'+x).fadeOut();
                $('#nlhdrugoe'+x).fadeOut(300);
                document.getElementById('typerealtynlh' + x).value='Список';
                Summa();
                $('#nonlivinghouse' + x).checked = false;
                //$('#nlhselect'+x).fadeOut();
                document.getElementById('input' + x).innerHTML = '';
                var typerealtygp = ChecktyperealtiGP();
                if(typerealtygp.y>0) {
                    if ($('#sposobpodachi1').prop("checked")) {
                        $('#gosposhlinanblock').fadeIn(300);
                        document.getElementById('gosposhlinan').checked = true;
                        document.getElementById('countnlh').innerHTML = typerealtygp.y;
                        Summa();
                    }
                }
            }


        }
        else{
            document.getElementById('typerealtynlh').value='Список';

            while(x!=0){
                x--;
                $('#nonlivinghouse' + x).checked = false;
                document.getElementById('input' + x).innerHTML = '';
            }
            Summa();


        }

    } else
    {
        alert('Приносим свои извенения, но пока оформить нежилых строений больше нельзя, спасибо за Ваш выбор!');
    }
}

function ChecktyperealtiGP() {
    var arrayChecked = [];
    $('.summa:checked').each(function() {
        arrayChecked.push($(this).val());
    });
    var x=0,y = 0;
    for (index = 0, len = arrayChecked.length; index < len; ++index) {
        if(arrayChecked[index]=='Жилой дом'){
            x++;
        }
        if(arrayChecked[index]=='Нежилое строение'){
            y++;
        }
    }
    return {x : x, y : y};
}



function Summa() {
      var arrayChecked = [];
      if($('#type').val() =='realty'){
        $('.summa:checked').each(function() {
            arrayChecked.push($(this).val());
        });
      }else if($('#type').val() =='geo') {
        arrayChecked = geo();
      }else{
        arrayChecked = plot();
      }

      console.log(arrayChecked)
      jQuery.ajax({
          url:     "/itogcost", //Адрес подгружаемой страницы
          type:     "POST", //Тип запроса
          data: {"_token": $('meta[name="csrf-token"]').attr('content'), "arrayChecked" : arrayChecked, 'type' : $('#type').val()},
          success: function(response) { //Если все нормально
              $('#itogcost').text(response['itog']);
              $('#discount').text(response['discount']);
              $('#cost').val(response['itog']);
              console.log(response);
          }
      });
  }

  function geo () {
    var arrayChecked = [];
    $('.summa:checked').each(function() {
        arrayChecked.push($(this).val());
        if($(this).val() == 'Топографическая съемка'){
            var sqzemuch = $('#sqzemuch').val();
            if(sqzemuch == ''){
                sqzemuch = '0';
            }
            arrayChecked.push(sqzemuch);
        }

        if($(this).val() == 'Вынос границ земельных участков'){
            var colznakov = $('#colznakov').val();
            if(colznakov == ''){
                colznakov = '0';
            }
            arrayChecked.push(colznakov);
        }

        if($(this).val() == 'Исполнительная съемка коммуникаций'){
            var prottrass = $('#prottrass').val();
            if(prottrass == ''){
                prottrass = '0';
            }
            arrayChecked.push(prottrass);
        }

        if($(this).val() == 'Разбивка осей зданий и сооружений'){
            var colosey = $('#colosey').val();
            if(colosey == ''){
                colosey = '0';
            }
            arrayChecked.push(colosey);
        }

        if($(this).val() == 'Кадастровая съемка земельного участка'){
            var sqzemuccs = $('#sqzemuccs').val();
            if(sqzemuccs == ''){
                sqzemuccs = '0';
            }
            arrayChecked.push(sqzemuccs);
        }
      });

        return arrayChecked;
  }

  function plot () {
    var arrayChecked = [];
    $('.summa:checked').each(function() {
        arrayChecked.push($(this).val());
        if($(this).val() == 'Межевание земельного участка'){
            var sqmezh = $('#sqmezh').val();
            if(sqmezh == ''){
                sqmezh = '0';
            }
            arrayChecked.push(sqmezh);
        }

        if($(this).val() == 'Раздел земельного участка'){
            var colpie = $('#colpie').val();
            if(colpie == ''){
                colpie = '0';
            }
            arrayChecked.push(colpie);
        }

        if($(this).val() == 'Объеденние земельных участков'){
            var colpeace = $('#colpeace').val();
            if(colpeace == ''){
                colpeace = '0';
            }
            arrayChecked.push(colpeace);
        }

      });

        return arrayChecked;
  }

  function ValidationZakaz() {
    var i = 0;

    if((!$('#uchet').prop("checked"))&&(!$('#regpraval').prop("checked"))&&(!$('#regprava').prop("checked"))&&(!$('#egrn').prop("checked"))&&(!$('#egrp').prop("checked"))&&(!$('#cadst').prop("checked"))&&(!$('#arest').prop("checked"))&&(i == 0)) {
        alert('Выберите для продолжения необходимую услугу');
        i++;
    }

    if(($('#regprava').prop("checked"))&&(i == 0)) {
      if(($('#regpravanlh').val()=='Список')&&(i == 0)){
          alert('Выберите из списка для Оформления права собственности на нежилое строение');
          i++;
      }

      if (($('#regpravanlh').val()=='Другое')&&($('#regpravadr').val()=='')&&(i == 0)){
          alert('Напишите другое для Оформления права собственности на нежилое строение');
          i++;
      }
    }

    if((!$('#nonlivinghouse').prop("checked"))&&(!$('#livinghouse').prop("checked"))&&($('#uchet').prop("checked"))&&(i == 0)) {
        alert('Выберите услугу Жилой дом или Нежилое строение');
        i++;
    }

    if(($('#nonlivinghouse').prop("checked"))&&(i == 0)) {
        if(($('#typerealtynlh').val()=='Список')&&(i == 0)){
            alert('Выберите из списка для Нежилого строения');
            i++;
        }

        if (($('#typerealtynlh').val()=='Другое')&&($('#typerealtydr').val()=='')&&(i == 0)){
            alert('Напишите другое для Нежилого Строения');
            i++;
        }
        for (var j = 1; j < 10; j++) {
            if (($('#nonlivinghouse'+j).prop("checked")) && (i == 0)) {
                if (($('#typerealtynlh'+j).val() == 'Список') && (i == 0)) {
                    alert('Выберите из списка для Нежилого строения '+(j+1));
                    i++;
                }

                if (($('#typerealtynlh'+j).val() == 'Другое')&&($('#typerealtydr'+j).val() == '')&&(i == 0)) {
                    alert('Напишите другое для Нежилого Строения '+(j+1));
                    i++;
                }
            }
        }

    }


    if((!$('#sposobpodachi1').prop("checked"))&&(!$('#sposobpodachi2').prop("checked"))&&(($('#regprava').prop("checked"))||($('#regpraval').prop("checked"))||($('#uchet').prop("checked")))&&(i == 0)) {
        alert('Выберите способ подачи документов в Россреестр');
        i++;
    }

    if(($('#sposobpodachi1').prop("checked"))&&(i == 0)) {
        if((!$('#resulttoemail').prop("checked"))&&(!$('#resulttokurier').prop("checked"))) {
            alert('Выберите способ доставки результатов подачи документов КИ');
            i++;
        }
    }

    if(($('#sposobpodachi2').prop("checked"))&&(i == 0)) {
        if ((!$('#zapistpnacd').prop("checked")) && (!$('#tpkurierom').prop("checked"))) {
            alert('Выберите способ доставки тех. паспорта при самостоятельной подаче');
            i++;
        }
    }

    if(($('#dataki').val() == '')&&(($('#regprava').prop("checked"))||($('#regpraval').prop("checked"))||($('#uchet').prop("checked")))&&(i == 0)) {
        alert('Введите дату приезда кадастрового инженера');
        i++;
    }

    if ((($('#resulttokurier').prop("checked")) || ($('#tpkurierom').prop("checked")))&&($('#adresdostavki').val()=='')&&(i == 0)) {
        alert('Укажите адрес доставки документов');
        i++;
    }

    if(i == 0) {
      document.getElementById('btnrealty').disabled = true;
      var typeservices = $('#type').val();
      $('#btnrealtyspinner').toggleClass('d-none');
      $.ajax({
        url:     "/realty-data-save", //Адрес подгружаемой страницы
        type:     "POST", //Тип запроса
        data: $('#orderRealty').serialize(),
        success: function(data) {
            document.getElementById('btnrealty').disabled = false;
            $('#btnrealtyspinner').toggleClass('d-none');

            if(data == '200'){
              window.location.replace("/reg-with-order/"+typeservices+"");
            }else if(data == '300'){
              window.location.replace("/lk");
            }else{
              $("#messageblock").toggleClass('d-none');
              $("#message").text("Произошла неизвестная ошибка, повторите Ваш заказ еще раз, спасибо!");
            }
          }

        });
    }

}


function ValidationZakaz2() {
    var i = 0;

    if((!$('#topografs').prop("checked"))&&(!$('#vinosgranic').prop("checked"))&&(!$('#semkacomm').prop("checked"))&&(!$('#razbivkaos').prop("checked"))&&(!$('#cadsemzu').prop("checked"))&&(i == 0)) {
        alert('Выберите для продолжения необходимую услугу');
        i++;
    }

    if(($('#topografs').prop("checked"))&&($('#sqzemuch').val()=='')&&(i == 0)){
        alert('Укажите пожалуйста примерную площадь земельного участка ( в сотках)');
        i++;
    }

    if(($('#vinosgranic').prop("checked"))&&($('#colznakov').val()=='')&&(i == 0)){
        alert('Укажите пожалуйста количество межевых знаков');
        i++;
    }

    if(($('#semkacomm').prop("checked"))&&($('#prottrass').val()=='')&&(i == 0)){
        alert('Укажите пожалуйста предполагаемую протяженность трассы ( в метрах )');
        i++;
    }

    if(($('#razbivkaos').prop("checked"))&&($('#colosey').val()=='')&&(i == 0)){
        alert('Укажите пожалуйста предполагаемое количество осей');
        i++;
    }

    if(($('#cadsemzu').prop("checked"))&&($('#sqzemuccs').val()=='')&&(i == 0)){
        alert('Укажите пожалуйста примерную площадь земельного участка (в сотках) для услуги Кадастровая съемка');
        i++;
    }

    if((($('#topografs').prop("checked"))||($('#vinosgranic').prop("checked"))||($('#semkacomm').prop("checked"))||($('#razbivkaos').prop("checked"))||($('#cadsemzu').prop("checked")))&&($('#dataki').val() == '')&&(i == 0)) {
        alert('Выберите для продолжения дату приезда специалиста');
        i++;
    }

    if(i == 0) {
      document.getElementById('btnrealty').disabled = true;
      var typeservices = $('#type').val();
      $('#btnrealtyspinner').toggleClass('d-none');
      $.ajax({
        url:     "/geo-data-save", //Адрес подгружаемой страницы
        type:     "POST", //Тип запроса
        data: $('#orderGeo').serialize(),
        success: function(data) {
            document.getElementById('btnrealty').disabled = false;
            $('#btnrealtyspinner').toggleClass('d-none');

            if(data == '200'){
              window.location.replace("/reg-with-order/"+typeservices+"");
            }else if(data == '300'){
              window.location.replace("/lk");
            }else{
              $("#messageblock").toggleClass('d-none');
              $("#message").text("Произошла неизвестная ошибка, повторите Ваш заказ еще раз, спасибо!");
            }
          }

        });
    }
}

function ValidationZakaz3() {
    var i = 0;

    if((!$('#mezhplot').prop("checked"))&&(!$('#razdelplot').prop("checked"))&&(!$('#servplot').prop("checked"))&&(!$('#soedplot').prop("checked"))&&(!$('#erplot').prop("checked"))&&(!$('#expertplot').prop("checked"))&&(i == 0)) {
        alert('Выберите для продолжения необходимую услугу');
        i++;
    }

    if(($('#mezhplot').prop("checked"))&&($('#sqmezh').val()=='')&&(i == 0)){
        alert('Укажите пожалуйста примерную площадь земельного участка ( в сотках)');
        i++;
    }

    if(($('#razdelplot').prop("checked"))&&($('#colpie').val()=='')&&(i == 0)){
        alert('Укажите пожалуйста количество частей для раздела земельного участка');
        i++;
    }

    if(($('#soedplot').prop("checked"))&&($('#colpeace').val()=='')&&(i == 0)){
        alert('Укажите пожалуйста количество земельных участков для объедененния');
        i++;
    }

    if((($('#mezhplot').prop("checked"))||($('#razdelplot').prop("checked"))||($('#soedplot').prop("checked"))||($('#expertplot').prop("checked")))&&($('#dataki').val() == '')&&(i == 0)) {
        alert('Выберите для продолжения дату приезда специалиста');
        i++;
    }

    if(i == 0) {
      document.getElementById('btnrealty').disabled = true;
      var typeservices = $('#type').val();
      $('#btnrealtyspinner').toggleClass('d-none');
      $.ajax({
        url:     "/plot-data-save", //Адрес подгружаемой страницы
        type:     "POST", //Тип запроса
        data: $('#orderGeo').serialize(),
        success: function(data) {
            document.getElementById('btnrealty').disabled = false;
            $('#btnrealtyspinner').toggleClass('d-none');

            if(data == '200'){
              window.location.replace("/reg-with-order/"+typeservices+"");
            }else if(data == '300'){
              window.location.replace("/lk");
            }else{
              $("#messageblock").toggleClass('d-none');
              $("#message").text("Произошла неизвестная ошибка, повторите Ваш заказ еще раз, спасибо!");
            }
          }

        });
    }
}
