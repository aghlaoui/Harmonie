 <!DOCTYPE html>
 <html lang="en">

 <head>
     <?php wp_head() ?>
 </head>

 <body style=" position: relative; min-height: 100%; overflow: hidden; ">

     <!-- Start main Section -->
     <section class="ec-under-maintenance">

         <div class="container">
             <div class="row">
                 <div class="col-md-6">
                     <div class="under-maintenance">
                         <h1>Error 404</h1>
                         <h4>La page n'a pas été trouvée.</h4>
                         <a href="<?php echo home_url() ?>" class="btn btn-lg btn-primary" tabindex="0">Retour à l'accueil</a>
                     </div>
                 </div>
                 <div class="col-md-6 disp-768">
                     <div class="under-maintenance">
                         <img class="maintenance-img" src="<?php echo get_theme_file_uri('/src/images/common/404.png') ?>" alt="maintenance">
                     </div>
                 </div>
             </div>
         </div>
     </section>


 </body>

 </html>