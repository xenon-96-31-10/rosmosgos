$(document).ready(function () {

  //$(":input").inputmask();
  $("#snils").inputmask({"mask": "999-999-999 99"});
  $("#pass-seria").inputmask({"mask": "9999"});
  $("#pass-nomer").inputmask({"mask": "999999"});
  $("#codepass").inputmask({"mask": "999-999"});
  $("#datepass").inputmask("99/99/9999",{ "placeholder": "dd/mm/yyyy" });
  $("#datebirth").inputmask("99/99/9999",{ "placeholder": "dd/mm/yyyy" });
  $("#datedov").inputmask("99/99/9999",{ "placeholder": "dd/mm/yyyy" });

  $( function() {

    $( "#datebirth" ).datepicker({
      dateFormat: 'dd.mm.yy',
      changeMonth: true,
      changeYear: true,
      yearRange: '-99:-18'
    });
    $( "#datepass" ).datepicker({
        dateFormat: 'dd/mm/yy'
    });

    $("#datedov").datepicker({
        dateFormat: 'dd/mm/yy'
    });
} );


  var token = "67fd1083a94980b339851baf73f373e31510c813";

  $("#kempass").suggestions({
        token: token,
        type: "fms_unit"
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

    $("#namebank").suggestions({
        token: token,
        type: "BANK",
        /* Вызывается, когда пользователь выбирает одну из подсказок */
        onSelect: function(suggestion) {
            console.log(suggestion);
        }
    });

    function typeDescription(type) {
        var TYPES = {
            'INDIVIDUAL': 'Индивидуальный предприниматель',
            'LEGAL': 'Организация'
        }
        return TYPES[type];
    }

    function join(arr /*, separator */) {
        var separator = arguments.length > 1 ? arguments[1] : ", ";
        return arr.filter(function(n){return n}).join(separator);
    }

    function showSuggestion(suggestion) {
        console.log(suggestion);
        var data = suggestion.data;
        if (!data)
            return;

        $("#type").text(
            typeDescription(data.type) + " (" + data.type + ")"
        );

        if (data.name) {
            $("#name_short").val(data.name.short_with_opf || "");
            $("#name_full").val(data.name.full_with_opf || "");
        }

        $("#inncom").val(join([data.inn, data.kpp], " / "));
        const str = data.management.name;
        const re = str.split(" ");
        $("#fizsurnamec").val(re[0]);
        $("#fiznamec").val(re[1]);
        $("#fizlastnamec").val(re[2]);
        if (data.address) {
            var address = "";
            if (data.address.data.qc == "0") {
                address = join([data.address.data.postal_code, data.address.value]);
            } else {
                address = data.address.data.source;
            }
            $("#address").val(address);
        }
    }
    $("#party").suggestions({
        token: token,
        type: "PARTY",
        count: 5,
        /* Вызывается, когда пользователь выбирает одну из подсказок */
        onSelect: showSuggestion
    });

    });
