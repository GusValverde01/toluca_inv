<?php
    include("admin/db.php");
    /*seleccionar registros */
    //$sentencia=$conexion->prepare("SELECT * FROM `anuncio`");
    //$sentencia->execute();
    //$lista_anuncios=$sentencia->fetchAll(PDO::FETCH_ASSOC);
    // Verificar si hay una búsqueda en la URL
    $busqueda = isset($_GET['busqueda']) ? trim($_GET['busqueda']) : '';

    if (!empty($busqueda)) {
        // Preparar consulta para filtrar por título o descripción
        $sentencia = $conexion->prepare("SELECT * FROM `anuncio` WHERE titulo LIKE :busqueda OR descripcion LIKE :busqueda");
        $sentencia->execute(['busqueda' => "%$busqueda%"]);
    } else {
        // Si no hay búsqueda, mostrar todos los anuncios
        $sentencia = $conexion->prepare("SELECT * FROM `anuncio`");
        $sentencia->execute();
    }
    $lista_anuncios = $sentencia->fetchAll(PDO::FETCH_ASSOC);
    //
     /*seleccionar registros */
     $sentencia=$conexion->prepare("SELECT * FROM `entrada`");
     $sentencia->execute();
     $lista_entrada=$sentencia->fetchAll(PDO::FETCH_ASSOC);

?>

<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Inversiones Toluca - Propiedades</title>
        <!-- Favicon-->
        <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
        <!-- Bootstrap Icons-->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet" />
        <!-- Google fonts-->
        <link href="https://fonts.googleapis.com/css?family=Merriweather+Sans:400,700" rel="stylesheet" />
        <link href="https://fonts.googleapis.com/css?family=Merriweather:400,300,300italic,400italic,700,700italic" rel="stylesheet" type="text/css" />
        <!-- SimpleLightbox plugin CSS-->
        <link href="https://cdnjs.cloudflare.com/ajax/libs/SimpleLightbox/2.1.0/simpleLightbox.min.css" rel="stylesheet" />
        <!-- Core theme CSS (includes Bootstrap)-->
        <link href="css/styles.css" rel="stylesheet" />

        <style>
            .sin-resultados {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 20vh; /* Ocupa toda la altura de la pantalla */
            width: 100%; /* Asegura que ocupe todo el ancho */
            text-align: center;
            font-size: 1.2rem;
            font-weight: bold;
            color: #333;
            padding: 1rem;
            flex-direction: column; /* Asegura que el contenido se apile bien */
        }

        @media (max-width: 768px) {
            .sin-resultados {
                font-size: 1rem;
            }
        }

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
        <!-- Navigation-->
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
                    <a class="nav-link" href="index.php">Regresar a Página Principal</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#portfolio">Propiedades</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#contact">Contacto</a>
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
                        <h1 class="text-white font-weight-bold">Encuentra y Publica Propiedades con Facilidad</h1>
                        <hr class="divider" />
                    </div>
                    <div class="col-lg-8 align-self-baseline">
                        <p class="text-white-75 mb-4">¡Conecta con compradores y vendedores en una forma sencilla y confiable!</p>
                        <a class="btn btn-primary btn-xl" href="#portfolio">Ver más</a>
                    </div>
                </div>
            </div>
        </header>

        <!-- Portfolio-->
        <div id="portfolio">
            <div class="container px-4 px-lg-5 h-100 page-section-contact">
                
                <div class="row gx-4 gx-lg-5 justify-content-center">
                    <div class="col-lg-8 col-xl-6 text-center">
                        <h2 class="mt-0">¡Propiedades en Venta!</h2>
                        <hr class="divider" />
                    </div>
                </div>
                            <!--Anuncios-->
                <section class="anun row gx-4 gx-lg-5 h-100 align-items-center justify-content-center text-center">
                    <div >
                    <?php if (empty($lista_anuncios)) : ?>
                        <div class="sin-resultados">
                            <h4>Sin resultados para tu búsqueda.</h4>
                            <p>Intenta con otra palabra clave o revisa nuestras propiedades disponibles.</p>
                        </div>
                    <?php else : ?>
                    </div>
                    <div class="contenedor-anuncios">    
                        <?php foreach($lista_anuncios as $registros) { ?>
                            <div class="anuncio">
                                <picture class="picture-img">
                                    <source srcset="./assets/img/portfolio/<?php echo $registros["imagen"]; ?>" type="image/jpeg">
                                    <img loading="lazy" src="./assets/img/portfolio/<?php echo $registros["imagen"]; ?>" alt="anuncio">
                                </picture>

                                <div class="contenido-anuncio">
                                    <h3> <?php echo $registros["titulo"]; ?> </h3>
                                    <h3 class="precio"><?php echo $registros["metros"]; ?> m²</h3>
                                    <p><?php echo $registros["descripcion"]; ?></p>
                                    <p class="precio"><?php echo $registros["precio"]; ?></p>

                                    <a class="btn btn-primary btn-xl" href="propiedad.php?id=<?php echo $registros["id_propiedad"]; ?>">Ver más</a>
                                </div>
                            </div>
                        <?php } ?>
                    <?php endif; ?>

                    </div>
        
                </section>
            </div>
        </div>

        <!-- Contact-->
        <section class="page-section-contact-page" id="contact">
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
            </div>
        <?php } ?>
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
