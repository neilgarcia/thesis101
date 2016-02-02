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
