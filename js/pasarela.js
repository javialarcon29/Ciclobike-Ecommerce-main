/*
 * It's a mess but, Daily UI is a sprint.
 */


$("#helpSec").hover(
    function(){
      $(".popup-info.card-info").show();
    },
    function(){
      $(".popup-info.card-info").hide();
    }
  );
  
  $("#helpZip").hover(
    function(){
      $(".popup-info.zip-info").show();
    },
    function(){
      $(".popup-info.zip-info").hide();
    }
  );
  
   $("#formClose").click(function(){
    $('.form-container').hide();
  });
  
  //validation
  function correctInput( $ele ){
    $ele.addClass('input-correct');
  }
  
  function notCorrectInput( $ele ){
    $ele.removeClass('input-correct');
  }
  
  function removeError( $ele ){
    $ele.next().removeClass('active');
    $ele.removeClass('input-error');
  }
  
  function activateError($ele){
    $ele.addClass('input-error');
    $ele.removeClass('input-correct');
    $ele.next().addClass('active');
  }
  
  function keyIsNum(event){
    console.log(event);
    if((event.keyCode >= 48 && event.keyCode <= 57) || (event.keyCode >= 96 && event.keyCode <= 105) ){
      return true;
    } else {
      return false;
    }
  }
  
  function checkIfEmpty( $ele ){
    if( $ele.val().length == 0 ) {
      $ele.addClass('input-error');
      return false;
    } else {
      return true;
    }
  }
  
  $('#CreditCardNumber').keydown(function(e){
    var cnum = $(this).val();
    var countnum = cnum.replace(/[^0-9]/g,"").length;
  
    if ( cnum.length != 0 && e.keyCode != 8 && e.keyCode != 46 ){
      // Card icon
      switch( cnum.charAt(0) ) {
        case '3': //amex
        $(this).addClass('card-amex');
        if( countnum == 4 | countnum == 10 ){
          $(this).val( cnum + ' ' );
        }
        if( countnum == 15 ) {
          checkCardNumber($(this));
        } else {
          notCorrectInput($(this));
        }
        break;
        case '4': //visa
        $(this).addClass('card-visa');
        if( countnum == 4 | countnum == 8 | countnum == 12 ){
          $(this).val( cnum + ' ' );
        }
        if( countnum == 16 ) {
          checkCardNumber($(this));
        } else {
          notCorrectInput($(this));
        }
        break;
        case '5': //master
        $(this).addClass('card-master');
        if( countnum == 4 | countnum == 8 | countnum == 12 ){
          $(this).val( cnum + ' ' );
        }
        if( countnum == 16 ) {
          checkCardNumber($(this));
        } else {
          notCorrectInput($(this));
        }
        break;
        default:
        $(this).removeClass();
        break;
      }
  
      // Letters entered
      var nonNum = /[^0-9 ]+/;
      if ( nonNum.exec(cnum)){
        activateError($(this));
        $(this).next().text('Enter only numbers.');
      } else {
        removeError( $(this) );
      }
    }
  }); // card num input
  
  function checkCardNumber($ele){
    var cnum = $ele.val();
    cnum = cnum.replace(/ /g,'');
    console.log(cnum);
    if ( cnum.length != 0 ){
      var creditNumberRegex = /^(?:4[0-9]{12}(?:[0-9]{3})?|5[1-5][0-9]{14}|3[47][0-9]{13}|3(?:0[0-5]|[68][0-9])[0-9]{11}|6(?:011|5[0-9]{2})[0-9]{12}|(?:2131|1800|35\d{3})\d{11})$/;
      if ( !creditNumberRegex.exec(cnum)){
        activateError($ele);
        $ele.next().text('Card number is not valid.');
      } else {
        correctInput( $ele );
        removeError( $ele );
      }
    }
  }
  
  // Prevent from adding more numbers if it's full
  $('#CreditCardNumber').keydown(function(e){
    var cnum = $(this).val();
    var countnum = cnum.replace(/[^0-9]/g,"").length;
    console.log(countnum);
    switch( cnum.charAt(0) ) {
      case '3': //amex
      if ( countnum == 15 && keyIsNum(e) ) {
        e.preventDefault();
        return false;
      }
      break;
      default: //visa
      if ( countnum == 16 && keyIsNum(e) ) {
        e.preventDefault();
        return false;
      }
      break;
    }
  });
  
  $('#CreditCardNumber').blur( function() {
    checkCardNumber($(this));
  }); // card num blur*/
  
  
  function checkExpDate($ele){
    var exdate = $ele.val();
    var dateregex = /^(0[1-9]|1[0-2])\/?([0-9]{2})$/;
    if (exdate.length != 0) {
     if ( !dateregex.exec(exdate) ){
      activateError($ele);
      $ele.next().text('Date is not valid.');
      } else {
        var today = new Date(),
        someday = new Date();
        someday.setFullYear('20' + exdate.substr(3,4), exdate.substr(0,2), 1);
        if(someday < today){
          activateError($ele);
          $ele.next().text('Card is expired.');
        } else {
          correctInput( $ele );
          removeError( $ele );
        }
      }
    } else {
     correctInput( $ele );
     removeError( $ele );
    }
  }
  
  $('#ExpDate').blur( function(){
    checkExpDate($(this));
    if($(this).val().length == 0){
      notCorrectInput($(this));
    }
  }); //exp date on blur
  
  $('#ExpDate').on('input',function(){
    var expdate = $(this).val();
    if (expdate.length == 5){
      checkExpDate($(this));
    } else {
      notCorrectInput($(this));
      removeError($(this));
    }
  
    if( expdate.indexOf("\\") > -1 ) {
      $(this).val(expdate.replace("\\","/"));
      expdate = expdate.replace("\\","/");
    }
  
    if(expdate.length == 2 && expdate.indexOf("/") > -1 ){
      $(this).val( '0' + expdate );
    }
  });
  
  $('#ExpDate').keydown( function(e){
    var exdate = $(this).val();
    if(exdate.length == 5 && keyIsNum(e)){
      e.preventDefault();
      return false;
    }
  });
  
  $('#SecCode').blur( function(){
    var seccode = $(this).val();
    var coderegex = /^[0-9]{3,4}$/;
    if (seccode.length != 0) {
      if( !coderegex.exec(seccode) ){
        activateError($(this));
        $(this).next().text('Code is invalid.');
      } else {
        removeError( $(this) );
      }
    } else {
      removeError( $(this) );
    }
  }); // sec code on blur
  
  $('#SecCode').keydown( function(e){
    var seccode = $(this).val();
    if(seccode.length == 4 && keyIsNum(e)){
      e.preventDefault();
      return false;
    }
  });
  
  
  // Prevent unintended characters to be entered
  $('#CreditCardNumber').keydown(function(e){
    if( (e.keyCode > 64 && e.keyCode < 91) || (e.keyCode > 185 && e.keyCode < 193) ) {
      e.preventDefault();
      return false;
    }
  });
  $('#ExpDate').keydown(function(e){
    if( (e.keyCode > 64 && e.keyCode < 91) || (e.keyCode > 185 && e.keyCode < 191) ) {
      e.preventDefault();
      return false;
    }
  });
  $('#SecCode').keydown(function(e){
    if( (e.keyCode > 64 && e.keyCode < 91) || (e.keyCode > 185 && e.keyCode < 193) ) {
      e.preventDefault();
      return false;
    }
  });
  
  
  $('#pay').click(function(){
    var filed = [];
    filed.push( checkIfEmpty($('#CreditCardNumber')));
    filed.push( checkIfEmpty($('#ExpDate')));
    filed.push( checkIfEmpty($('#SecCode')));
    filed.push( checkIfEmpty($('#OwnerName')));
    filed.push( checkIfEmpty($('#ZipCode')));
  
    if(filed.indexOf(false) > -1){
      // fill all fields first
      return;
    }
    if( $('.help-info').hasClass('active') ){
      // correct all fields first
      return;
    }
    $('.processing').show();
    setTimeout(function(){
      $('.processing').hide();
      $('.success').show();
    }, 1500);
  });
  
  $('#goback').click(function(){
    $('.success').hide()
  });