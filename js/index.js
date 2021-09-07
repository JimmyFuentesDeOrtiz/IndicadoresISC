$(window).scroll(function(){
   if($("#menu").offset().top>56) {
       $("#menu").addClass("dark");
   }else{
       $("#menu").removeClass("dark");
   }
});
const nav = document.querySelector('#hamburger button');
nav.addEventListener('click', e => {
    nav.classList.toggle('open');
});

//DatosEsp = function (esp) {
//    window.alert(esp);
//    window.location.href = window.location.href + "#tab3?w1=" + esp;
//};

/* inicio animación texto 'acerda de' */
const resolver = {
    resolve: function resolve(options, callback) {
      // The string to resolve
      const resolveString = options.resolveString || options.element.getAttribute('data-target-resolver');
      const combinedOptions = Object.assign({}, options, {resolveString: resolveString});
      
      function getRandomInteger(min, max) {
        return Math.floor(Math.random() * (max - min + 1)) + min;
      };
      
      function randomCharacter(characters) {
        return characters[getRandomInteger(0, characters.length - 1)];
      };
      
      function doRandomiserEffect(options, callback) {
        const characters = options.characters;
        const timeout = options.timeout;
        const element = options.element;
        const partialString = options.partialString;
  
        let iterations = options.iterations;
  
        setTimeout(() => {
          if (iterations >= 0) {
            const nextOptions = Object.assign({}, options, {iterations: iterations - 1});
  
            // Ensures partialString without the random character as the final state.
            if (iterations === 0) {
              element.textContent = partialString;
            } else {
              // Replaces the last character of partialString with a random character
              element.textContent = partialString.substring(0, partialString.length - 1) + randomCharacter(characters);
            }
  
            doRandomiserEffect(nextOptions, callback)
          } else if (typeof callback === "function") {
            callback(); 
          }
        }, options.timeout);
      };
      
      function doResolverEffect(options, callback) {
        const resolveString = options.resolveString;
        const characters = options.characters;
        const offset = options.offset;
        const partialString = resolveString.substring(0, offset);
        const combinedOptions = Object.assign({}, options, {partialString: partialString});
  
        doRandomiserEffect(combinedOptions, () => {
          const nextOptions = Object.assign({}, options, {offset: offset + 1});
  
          if (offset <= resolveString.length) {
            doResolverEffect(nextOptions, callback);
          } else if (typeof callback === "function") {
            callback();
          }
        });
      };
  
      doResolverEffect(combinedOptions, callback);
    } 
  }
  
  /* Some GLaDOS quotes from Portal 2 chapter 9: The Part Where He Kills You
   * Source: http://theportalwiki.com/wiki/GLaDOS_voice_lines#Chapter_9:_The_Part_Where_He_Kills_You
   */
  const strings = [
    'Ingenieros altamente competitivos quienes se estan formando para tener las competencias profesionales y poder así, implementar aplicaciones computaciones para solucionar problemas complejos de ingeniería en diversos contextos.',
    'Diseñar, implementar y administrar bases de datos, aplicaciones móviles, redes de computadoras, sistemas con inteligencia artificial o realidad aumentada. ',
    'La ingeniería en Sistemas Computaciones, cuenta con laboratorios de Programación y Base de Datos, Laboratorio de Redes de computadoras, Laboratorio de Multimedia, equipo de robótica, con una fábrica de software donde los estudiantes desarrollan Sistemas Computaciones con el apoyo de profesores altamente capacitados, así mismo se cuenta con una serie de dispositivos móviles como apoyo para la realización de las prácticas académicas.',
    'El 80% de su plantilla docente, cuenta estudios de posgrado, lo que habla de la calidad de quienes estudian esta ingeniería.',
    'Actualmente la ingeniería en Sistemas Computaciones está ofertando las especialidades de DESARROLLO DE APLICACIONES MÓVILES cómo CIENCIA DE DATOS.',
    'Sus estudiantes han participado en eventos locales, regionales, estatales y nacionales, estando entre los mejores en la Competencia Internacional NetRiders 2017, Segundo lugar a nivel estatal en el 17° Concurso de Creatividad e Ingenio.',
    ' La Ingeniería en Sistemas Computaciones, pertenece a la Academia de CISCO y de ORACLE, lo que permite que sus estudiantes tengan acceso a certificaciones internacionales.',
    '#ORGULLOITSOEH',
    '#ORGULLOISIC',
    '#SOMOSSISTEMAS',
    '......'
  ];
  
  let counter = 0;
  
  const options = {
    // Initial position
    offset: 0,
    // Timeout between each random character
    timeout: 5,
    // Number of random characters to show
    iterations: 10,
    // Random characters to pick from
    characters: ['a', 'b', 'c', 'd', 'e', 'f', 'g', 'h', 'i', 'j', 'k', 'l', 'm', 'n', 'o', 'p', 'q', 'r', 's', 't', 'u', 'v', 'x', 'y', 'x', '#', '%', '&', '-', '+', '_', '?', '/', '\\', '='],
    // String to resolve
    resolveString: strings[counter],
    // The element
    element: document.querySelector('[data-target-resolver]')
  }
  
  // Callback function when resolve completes
  function callback() {
    setTimeout(() => {
      counter ++;
      
      if (counter >= strings.length) {
        counter = 0;
      }
      
      let nextOptions = Object.assign({}, options, {resolveString: strings[counter]});
      resolver.resolve(nextOptions, callback);
    }, 1000);
  }
  
  resolver.resolve(options, callback);

  /* FIN animación texto 'acerda de' */