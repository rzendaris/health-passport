$(document).ready(function() {
    const minus1 = $('#quantity__minus1');
    const plus1 = $('#quantity__plus1');
    const input1 = $('#quantity__input1');
    const minus2 = $('#quantity__minus2');
    const plus2 = $('#quantity__plus2');
    const input2 = $('#quantity__input2');
    const minus3 = $('#quantity__minus3');    
    const plus3 = $('#quantity__plus3');
    const input3 = $('#quantity__input3');

    minus1.click(function(e) {
      e.preventDefault();
      var value = input1.val();
      if (value > 1) {
        value--;
      }
      input1.val(value);
    });
    
    plus1.click(function(e) {
      e.preventDefault();
      var value = input1.val();
      value++;
      input1.val(value);
    })

    minus3.click(function(e) {
        e.preventDefault();
        var value = input3.val();
        if (value > 1) {
          value--;
        }
        input3.val(value);
      });
      
      plus3.click(function(e) {
        e.preventDefault();
        var value = input3.val();
        value++;
        input3.val(value);
      })

      minus2.click(function(e) {
        e.preventDefault();
        var value = input2.val();
        if (value > 1) {
          value--;
        }
        input2.val(value);
      });
      
      plus2.click(function(e) {
        e.preventDefault();
        var value = input2.val();
        value++;
        input2.val(value);
      })
  });