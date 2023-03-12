<?php

    include './app/main.php';
    include './app/Includes/header.php';
?>

    <section class="row m-0 p-0" id="aboutUs">

        <div class="col-11" id="pageTitle">
            <h1>Sobre Nosotros</h1>
        </div>

        <article class="row col-12 px-4">

            <p class="col-12 col-md-6 col-lg-8 text-justify">
            Bienvenidos al cine "CIME", un espacio dedicado a brindar una experiencia única y emocionante a todos nuestros espectadores.

            Desde que abrimos nuestras puertas en el año 2005, nos hemos esforzado por ofrecer la mejor calidad de imagen y sonido, para que nuestros visitantes disfruten de las películas como nunca antes. Contamos con tecnología de punta en proyección digital y sonido envolvente, para que puedas sumergirte en la historia como si estuvieras dentro de la pantalla.
            Pero no solo se trata de la calidad de imagen y sonido. En "Aventura en la Gran Pantalla" queremos que cada visita sea una experiencia inolvidable, por lo que hemos creado una decoración temática que transporta a los espectadores a diferentes lugares y épocas. Nuestro lobby es un espacio donde puedes relajarte antes de la función, y disfrutar de nuestras deliciosas palomitas y bebidas.    
            </p>

            <div class="col-12 col-md-6 col-lg-4 div-img"
            style="min-height: 300px;background-image: url(<?=WEB_URL?>/app/Storage/aboutus/sala.jfif)">
            </div>

        </article>

        <article class="row col-12 px-4 my-3">

            <div class="col-12 col-md-6 col-lg-4 div-img"
            style="min-height: 300px;background-image: url(<?=WEB_URL?>/app/Storage/aboutus/perrito.jpg)">
            </div>

            <p class="col-12 col-md-6 col-lg-8 text-justify">
                Y hablando de películas, nuestra selección es de lo mejor que hay. Desde los grandes éxitos de Hollywood hasta producciones independientes y cine de arte, tenemos algo para todos los gustos. Además, organizamos eventos especiales, como funciones temáticas, maratones de películas y estrenos exclusivos.

                Hablemos ahora de una historia ficticia. Imagina que en nuestro cine se presenta una película de aventuras ambientada en una antigua selva, donde un grupo de exploradores buscan un tesoro perdido. La emoción comienza desde el momento en que los espectadores entran al cine, donde han sido recibidos con una decoración que simula la selva, con hojas verdes, animales de cartón y música de tambor.

                Una vez que las luces se apagan y la película comienza, los espectadores se sumergen en la historia. La emoción es palpable, con escenas de persecución, luchas con espadas, saltos por precipicios y muchas sorpresas más. La calidad de la imagen y sonido hacen que todo se sienta real, como si los espectadores estuvieran allí mismo, en la selva, junto a los personajes.
            </p>

        </article>

    </section>

<?php
    include './app/Includes/footer.php';
?>