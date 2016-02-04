$(document).ready(function(){
  $('#moduleA').hover(function(){
    content = "<h1><strong>User Given Equation - Auto</strong><br></h1><h2>A module that allows the user input his or her own equation.</h2>After inputting an equation, PIA will then solve the given equation or problem showing how she's done it step by step until she gets the final answer. No interaction will be made between PIA and her student besides inputting the equation.";
    $('.module-message').html(content);
  });
  $('#moduleB').hover(function(){
    content = "<h1><strong>User Given Equation - Manual</strong><br></h1><h2>A module that allows the user input his or her own equation.</h2>After inputting an equation, PIA will then solve the given equation or problem showing how she's done it step by step until she gets the final answer. No interaction will be made between PIA and her student besides inputting the equation.";
    $('.module-message').html(content);
  });
  $('#moduleC').hover(function(){
    content = "<h1><strong>Computer Generated Equation</strong><br></h1><h2>A module that allows the user input his or her own equation.</h2>After inputting an equation, PIA will then solve the given equation or problem showing how she's done it step by step until she gets the final answer. No interaction will be made between PIA and her student besides inputting the equation.";
    $('.module-message').html(content);
  });

  function isScrolledIntoView(elem)
  {
    var $elem = $(elem);
    var $window = $(window);

    var docViewTop = $window.scrollTop();
    var docViewBottom = docViewTop + $window.height();

    var elemTop = $elem.offset().top;
    var elemBottom = elemTop + $elem.height();

    return ((elemBottom < docViewBottom) && (elemTop > docViewTop));
  }

  $(window).on('scroll', function(){

    if(isScrolledIntoView($('#maker-container li img'))){
      // alert('test');
      $('#maker-container li img').css({'visibility': 'visible', 'opacity': '1'});
    }else{
      $('#maker-container li img').css({'visibility': 'hidden', 'opacity': '0'});
    }
  });

});


// "<h1>
//               <strong>User Given Equation - Auto</strong>
//               <br>
//             </h1>
//             <h2>
//               A module that allows the user input his or her own equation.
//             </h2>
//               After inputting an equation,
//               PIA will then solve the given equation or problem showing how she's done it step by step
//               until she gets the final answer. No interaction will be made between PIA and
//               her student besides inputting the equation.";
