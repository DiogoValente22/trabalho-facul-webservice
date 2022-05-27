<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title>Signos</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href=" {{ asset('css/style.css') }} " />
    <link
      rel="stylesheet"
      href="https://unpkg.com/swiper/swiper-bundle.min.css"
    />
  </head>

  <body>
    
    <section class="formkk">
      <form class="form-login">
        <div class="form-container1">
          <p class="form-title">Informe seus dados e descubra seu signo!</p>
          <div class="form-group-name">
            <input type="text" class="form-control" id="inputName" placeholder="Digite seu nome">
          </div>
          <div class="form-group-date">
            <input type="date" class="form-control" id="inputDate">
          </div>
        </div>
        <button type="submit" id="btn-enviar" class="btn btn-primary">Enviar</button>
      </form>
    </section>
    

    <section id="sectionone" class="screen">
      <div id="scene">
        <div data-depth="0.1" class="bg">
          <img src="{{ asset('img/background2.jpg') }}" alt="" />
        </div>
        <div data-depth="0.2" class="rock1">
          <img src="{{ asset('img/rock.png') }}" alt="" />
        </div>
        <div data-depth="1.2" class="earth">
          <img src="{{ asset('img/earth.png') }}" alt="" />
        </div>
        <div data-depth="0.1" class="text">
          <h1>SIGNOS</h1>
        </div>
        
        <div data-depth="0.4" class="mid">
          <img src="{{ asset('img/mid.png') }}" alt="" />
        </div>
        <div data-depth="0.1" class="fore">
          <img src="{{ asset('img/foreground.png') }}" alt="" />
        </div>
      </div>
    </section>

    <section id="apiInfos" class="hidden">
      {{-- <img src={{ asset('img/bgsection.jpg') }} /> --}}
        <h2 class="signo-title">Olá, </h2>
        <div class="signo-container">
          <div class="signo-image">
            <div id="signo-image-id">
              
            </div>
            
            <div id="signo-name1">
              
            </div>
            
          </div>
          <div class="signo-caracteristica">
          
          </div>
        </div>
    </section>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.5.1/gsap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/parallax/3.1.0/parallax.min.js"></script>
    <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script type="text/javascript">
        // LANDING PAGE ANIMATION
        var scene = document.getElementById("scene");
        var parallaxInstance = new Parallax(scene);

        // Startando o jquery
        $(document).ready(function() {

          $btn = $('#btn-enviar');
          $btn.on('click', function(e) {
            e.preventDefault();

            $('#apiInfos').removeClass('hidden');
            
            // variaveis contendo nome, dia e mês para consultas futuras
            var $name = $('#inputName').val();
            var date = new Date($('#inputDate').val());
            var month = date.getUTCMonth() + 1; //months from 1-12
            var day = date.getUTCDate();

            // exibe o nome da pessoa
            var spanName = `<span id="signo-title1">${$name}</span>`;
            $('#signo-title1').remove();
            $('.signo-title').append(spanName);

            // Requisição da api + guardando infos na variavel signosData
            let request = new XMLHttpRequest()
            request.open("GET", 'http://127.0.0.1:8000/api/posts', false)
            request.send()
            let data = request.responseText; 
            let signosData = JSON.parse(data);

            // função para inserir infos do signo
            function insereData (index, signo) {
              // insere nome do signo
              var signoName = `<span class="signo-name">${signosData[index]['title']}</span`;
                $('.signo-name').remove();
                $('#signo-name1').append(signoName);

                // insere caracteristicas do signo
                var signoCaracteristica = `<p>${signosData[index]['content']}</p>`;
                $('.signo-caracteristica p').remove();
                $('.signo-caracteristica').append(signoCaracteristica);

                // insere a imagem do signo
                var signoImage = `<img src="https://raw.githubusercontent.com/DiogoValente22/Estudando-SASS/master/teste/${signo}.png" alt="signo">`
                $('#signo-image-id img').remove();
                $('#signo-image-id').append(signoImage);
            }

            // Verificação de signo
            switch (true) {
              case ((day >= 21 && day <= 31 && month == 1) || (day >= 1 && day <= 18 && month == 2)) :
                insereData(10, 'aquario');
                break;
              case ((day >= 19 && day <= 28 && month == 2) || (day >= 1 && day <= 20 && month == 3)) :
                insereData(11, 'peixes');
                break;
              case ((day >= 21 && day <= 31 && month == 3) || (day >= 1 && day <= 20 && month == 4)) :
                insereData(0, 'aries');
                break;
              case ((day >= 21 && day <= 31 && month == 4) || (day >= 1 && day <= 20 && month == 5)) :
                insereData(1, 'touro');
                break;
              case ((day >= 21 && day <= 31 && month == 5) || (day >= 1 && day <= 20 && month == 6)) :
                insereData(2, 'gemeos');
                break;
              case ((day >= 21 && day <= 30 && month == 6) || (day >= 1 && day <= 22 && month == 7)) :
                insereData(3, 'cancer');
                break;
              case ((day >= 23 && day <= 31 && month == 7) || (day >= 1 && day <= 22 && month == 8)) :
                insereData(4, 'leao');
                break;
              case ((day >= 23 && day <= 31 && month == 8) || (day >= 1 && day <= 22 && month == 9)) :
                insereData(5, 'virgem');
                break;
              case ((day >= 23 && day <= 30 && month == 9) || (day >= 1 && day <= 22 && month == 10)) :
                insereData(6, 'libra');
                break;
              case ((day >= 23 && day <= 31 && month == 10) || (day >= 1 && day <= 21 && month == 11)) :
                insereData(7, 'escorpiao');
                break;
              case ((day >= 22 && day <= 30 && month == 11) || (day >= 1 && day <= 21 && month == 12)) :
                insereData(8, 'sagitario');
                break;
              case ((day >= 22 && day <= 31 && month == 12) || (day >= 1 && day <= 20 && month == 1)) :
                insereData(9, 'capricornio');
                break;
            }

            //scrolla pra baixo
            $([document.documentElement, document.body]).animate({
                scrollTop: $("#apiInfos").offset().top
            });

          })
        });
        
    </script>
  </body>
</html>