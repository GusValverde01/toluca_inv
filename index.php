<?php
require("admin/db.php");

/* Verificar que la conexión está establecida */
if (!$conexion) {
    die("Error en la conexión a la base de datos.");
}

/* Seleccionar registros */
$sentencia = $conexion->prepare("SELECT * FROM `anuncio`");
$sentencia->execute();
$lista_anuncios = $sentencia->fetchAll(PDO::FETCH_ASSOC);

$sentencia = $conexion->prepare("SELECT * FROM `entrada`");
$sentencia->execute();
$lista_entrada = $sentencia->fetchAll(PDO::FETCH_ASSOC);


?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Inversiones Toluca - Principal</title>
    <!-- Favicon-->
    <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
    
    <!-- Bootstrap Icons-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet" />
    <!-- Google fonts-->
    <link href="https://fonts.googleapis.com/css?family=Merriweather+Sans:400,700" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css?family=Merriweather:400,300,300italic,400italic,700,700italic" rel="stylesheet" />
    <!-- Core theme CSS (includes Bootstrap) -->
    <link href="css/styles.css" rel="stylesheet" />

    <style>
        /* Aplica la misma fuente a los elementos del dropdown */
        .dropdown-menu .dropdown-item {
            font-family: 'Merriweather Sans', sans-serif; /* Misma fuente que el navbar */
        }

        /* Agrega un poco de margen superior para bajar la lista */
        .offcanvas-body .navbar-nav {
            margin-top: 1.5rem; /* Ajusta el valor según necesites */
        }
    </style>

</head>

<body id="page-top">
    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-light fixed-top py-3" id="mainNav">
        <div class="container-fluid px-4 px-lg-5">
            <a class="navbar-brand" href="#page-top">Inversiones Toluca</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
            </button>
            <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasNavbar" aria-labelledby="offcanvasNavbarLabel">
            <div class="offcanvas-header">
                <h5 class="offcanvas-title" id="offcanvasNavbarLabel">Menú</h5>
                <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
            </div>
            <div class="offcanvas-body">
                <ul class="navbar-nav justify-content-end flex-grow-1 pe-3">
                <li class="nav-item">
                    <a class="nav-link" href="#about">Nosotros</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#services">Servicios</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#portfolio">Anuncios</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#contact">Contacto</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    Más
                    </a>
                    <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="propiedades.php">Propiedades</a></li>
                    </ul>
                </li>
                </ul>
                <form action="propiedades.php" method="GET" class="d-flex mt-3" role="search">
                <input class="form-control me-2" type="search" name="busqueda" placeholder="Buscar Zona de Interés" aria-label="Search">
                <button class="btn btn-primary" type="submit">Buscar</button>
                </form>
            </div>
            </div>
        </div>
    </nav>

        <!-- Masthead-->
        <header class="masthead">
            <div class="container px-4 px-lg-5 h-100">
                <div class="row gx-4 gx-lg-5 h-100 align-items-center justify-content-center text-center">
                    <div class="col-lg-8 align-self-end">
                        <h1 class="text-white font-weight-bold">Haz Realidad tus Proyectos en el Lugar Ideal</h1>
                        <hr class="divider" />
                    </div>
                    <div class="col-lg-8 align-self-baseline">
                        <p class="text-white-75 mb-4">¡Inicia tu búsqueda o publica el terreno ideal para tus proyectos!</p>
                        <p class="text-white-75 mb-5">Conecta con oportunidades únicas, sin compromisos.</p>
                        <a class="btn btn-primary btn-xl" href="#about">Ver más</a>
                    </div>
                </div>
            </div>
        </header>
        <!-- About-->
        <section class="page-section bg-primary" id="about">
            <div class="container px-4 px-lg-5">
                <div class="row gx-4 gx-lg-5 justify-content-center">
                    <div class="col-lg-8 text-center">
                        <h2 class="text-white mt-0">¡Tenemos los que tú necesitas!</h2>
                        <hr class="divider divider-light" />
                        <p class="text-white-75 mb-4">Ya sea que estés interesado en comprar, vender o simplemente conocer más sobre nuestras ofertas...</p>
                        <p class="text-white-75 mb-4">Comunícate directamente con nosotros.</p>
                        <a class="btn btn-light btn-xl" href="#portfolio">Empecémos!</a>
                    </div>
                </div>
            </div>
        </section>
        
        <!-- Services -->
        <section class="page-section" id="services">
            <div class="container px-4 px-lg-5">
                <h2 class="text-center mt-0">Nuestros Compromisos</h2>
                <hr class="divider" />
                <div class="row gx-4 gx-lg-5">
                    <!-- Verification Check -->
                    <div class="col-lg-3 col-md-6 text-center">
                        <div class="mt-5">
                            <div class="mb-2"><i class="bi-check-circle fs-1 text-primary"></i></div>
                            <h3 class="h4 mb-2">Experiencia</h3>
                            <p class="text-muted mb-0">Contamos con años de experiencia en el mercado inmobiliario del Estado de México.</p>
                        </div>
                    </div>
                    <!-- Security Lock -->
                    <div class="col-lg-3 col-md-6 text-center">
                        <div class="mt-5">
                            <div class="mb-2"><i class="bi-shield-lock fs-1 text-primary"></i></div>
                            <h3 class="h4 mb-2">Seguridad</h3>
                            <p class="text-muted mb-0">Garantizamos procesos seguros y transparentes, para que compres o vendas con total tranquilidad.</p>
                        </div>
                    </div>
                    <!-- Globe -->
                    <div class="col-lg-3 col-md-6 text-center">
                        <div class="mt-5">
                            <div class="mb-2"><i class="bi-globe fs-1 text-primary"></i></div>
                            <h3 class="h4 mb-2">Alcance</h3>
                            <p class="text-muted mb-0">¡Pon tu propiedad a la venta fácilmente y llega a compradores potenciales!</p>
                        </div>
                    </div>
                    <!-- Dollar Sign -->
                    <div class="col-lg-3 col-md-6 text-center">
                        <div class="mt-5">
                            <div class="mb-2"><i class="bi-currency-dollar fs-1 text-primary"></i></div>
                            <h3 class="h4 mb-2">Precio</h3>
                            <p class="text-muted mb-0">Ofrecemos opciones competitivas, asegurando el mejor valor por tu inversión!</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Call to action-->
        <section class="page-section bg-dark text-white">
            <div class="container px-4 px-lg-5 text-center">
                <h2 class="mb-4">¡Explora las Propiedades Disponibles!</h2>
                <a class="btn btn-light btn-xl" href="propiedades.php">Ver Todas</a>
            </div>
        </section>

        <!-- Portfolio-->
        <div id="portfolio">
            <div class="container px-4 px-lg-5 h-100">
                <!--Anuncios-->
                <section class="anun row gx-4 gx-lg-5 h-100 align-items-center justify-content-center text-center">
                    <div class="contenedor-anuncios">
                        <?php foreach(array_slice($lista_anuncios, 0, 3) as $registros) { ?>
                            <div class="anuncio">
                                <picture class="picture-img">
                                    <source srcset="./assets/img/portfolio/<?php echo $registros["imagen"]; ?>" type="image/jpeg">
                                    <img loading="lazy" src="./assets/img/portfolio/<?php echo $registros["imagen"]; ?>" alt="anuncio">
                                </picture>

                                <div class="contenido-anuncio">
                                    <h3><?php echo $registros["titulo"]; ?></h3>
                                    <h3 class="precio"><?php echo $registros["metros"]; ?> m²</h3>
                                    <p><?php echo $registros["descripcion"]; ?></p>
                                    <p class="precio">$ <?php echo $registros["precio"]; ?></p>

                                    <a class="btn btn-primary btn-xl" href="propiedad.php?id=<?php echo $registros["id_propiedad"]; ?>">Ver más</a>
                                </div>
                            </div>
                        <?php } ?>
                    </div>

                    <div class="ver-todas">
                        <a class="btn btn-primary btn-xl" href="propiedades.php">Ver todas</a>
                    </div>
                </section>
            </div>
        </div>


        <!-- Contact-->
        <section class="page-section-contact" id="contact">
        <?php foreach($lista_entrada as $registros) { ?>

            <div class="container px-4 px-lg-5">
                <div class="row gx-4 gx-lg-5 justify-content-center">
                    <div class="col-lg-8 col-xl-6 text-center">
                        <h2 class="mt-0">¡Pongámonos en Contacto!</h2>
                        <hr class="divider" />
                        <p class="text-muted mb-5">¿Listo para comenzar tu próximo proyecto con nosotros? ¡Envíanos un mensaje y nos comunicaremos contigo lo antes posible!</p>
                    </div>
                </div>

                <div class="row gx-4 gx-lg-5 justify-content-center contacto-final">
                    <div class="col-lg-4 text-center mb-5 mb-lg-0">
                        <i class="bi-phone fs-1 mb-3 text-muted"></i>
                            <div class="row justify-content-center">
                                <a class="btn btn-primary btn-xl" href="<?php echo $registros["contacto"]; ?>">Contactar</a>
                            </div>
                    </div>
                    <div class="col-lg-4 text-center mb-5 mb-lg-0">
                        <i class="bi-envelope fs-1 mb-3 text-muted"></i>
                        <div> <?php echo $registros["correo"]; ?> </div>
                    </div>
                </div>
                <?php } ?>

                
                
            </div>
        </section>
        <!-- Footer-->
        <footer class="bg-light py-5">
            <div class="container px-4 px-lg-5">
                <div class="small text-center text-muted"> I T &copy; - <span id="year"></span> </div>
            </div>
        </footer>

        <script>
            document.getElementById("year").textContent = new Date().getFullYear();
        </script>

        <!-- Bootstrap core JS-->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
        <!-- SimpleLightbox plugin JS-->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/SimpleLightbox/2.1.0/simpleLightbox.min.js"></script>
        
        <!-- Core theme JS-->
        <script src="js/scripts.js"></script>
        
        <!-- * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *-->
        <!-- * *                               SB Forms JS                               * *-->
        <!-- * * Activate your form at https://startbootstrap.com/solution/contact-forms * *-->
        <!-- * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *-->
        <script src="https://cdn.startbootstrap.com/sb-forms-latest.js"></script>

    </body>
</html>
