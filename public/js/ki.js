$(document).ready(function () {

  //$(":input").inputmask();
  $("#sertificate").inputmask({"mask": "99-99-9{1,4}"});





  var token = "67fd1083a94980b339851baf73f373e31510c813";

  var type  = "FIAS";
  var $region = $("#region");

  function join(arr /*, separator */) {
  var separator = arguments.length > 1 ? arguments[1] : ", ";
  return arr.filter(function(n){return n}).join(separator);
}

function makeAddressString(address){
  return join([
    join([address.region], " "),
    ]);
}

function formatResult(value, currentValue, suggestion) {
  var addressValue = makeAddressString(suggestion.data);
  suggestion.value = addressValue;
  return addressValue;
}

function formatSelected(suggestion){
  var addressValue = makeAddressString(suggestion.data);
  return addressValue;
}

  // регион
  $region.suggestions({
    token: token,
    type: type,
    hint: false,
    bounds: "region",
    formatResult: formatResult,
    formatSelected: formatSelected
  });

  function init($surname, $name, $patronymic) {
    var self = {};
    self.$surname = $surname;
    self.$name = $name;
    self.$patronymic = $patronymic;
    var fioParts = ["SURNAME", "NAME", "PATRONYMIC"];
    $.each([$surname, $name, $patronymic], function(index, $el) {
      var sgt = $el.suggestions({
        token: token,
        type: "NAME",
        triggerSelectOnSpace: false,
        hint: "",
        noCache: true,
        params: {
          // каждому полю --- соответствующая подсказка
          parts: [fioParts[index]]
        }
      });
    });
  };

  init($("#familia"), $("#name"), $("#lastname"));

  $("#nameobj").change(function() {

    if (this.value == 'Другое') {
        $('#drugoe').fadeIn(300);
    }else{
        $('#drugoe').fadeOut(300);
    }

   });



});

var y = 0;

function addInputkn() {
    if (y < 10) {
        var str = '<br><div class="row mb-3">'+
            '<div class="col-sm-4">' +
            '<label for="cadnumber' + (y + 3) + '">Кадастровый номер ' + (y + 3) + '</label>'+
        '</div>'+
        '<div class="col-sm-8">'+
            '<input name="cadnumber' + (y + 3) + '" type="text" class="form-control" id="cadnumber' + (y + 3) + '" value="" placeholder="Введите кадастровый номер ' + (y + 3) + '" >'+
            '</div>'+
            '</div><div id="inputkn' + (y + 1) + '"></div>';
        document.getElementById('inputkn' + y).innerHTML = str;
        y++;
    } else
    {
        alert('На данный момент это предел, приносим свои извинения!');
    }
}

var z = 0;

function addInputc() {
    if (z < 10) {
        var str = '<br><div class="row mb-3">'+
            '<div class="col-sm-4">' +
            '<label for="coordinata' + (z + 3) + '">Координата ' + (z + 3) + '</label>'+
            '</div>'+
            '<div class="col-sm-8">'+
            '<input name="coordinata' + (z + 3) + '" type="text" class="form-control" id="coordinata' + (z + 3) + '" value="" placeholder="Введите координату ' + (z + 3) + '" >'+
            '</div>'+
            '</div><div id="inputcoordinata' + (z + 1) + '"></div>';
        document.getElementById('inputcoordinata' + z).innerHTML = str;
        z++;
    } else
    {
        alert('На данный момент это предел, приносим свои извинения!');
    }
}
var k = 0;

function addInputr() {
    if (z < 10) {
        var str = '<br><div class="row mb-3">'+
            '<div class="col-sm-4">' +
            '<label for="razmer' + (k + 3) + '">Размер ' + (k + 3) + '</label>'+
            '</div>'+
            '<div class="col-sm-8">'+
            '<input name="razmer' + (k + 3) + '" type="text" class="form-control" id="razmer' + (k + 3) + '" value="" placeholder="Введите размер ' + (k + 3) + '" >'+
            '</div>'+
            '</div><div id="inputr' + (k + 1) + '"></div>';
        document.getElementById('inputr' + k).innerHTML = str;
        k++;
    } else
    {
        alert('На данный момент это предел, приносим свои извинения!');
    }
}
