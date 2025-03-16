<?php
    include("admin/db.php");
    /*seleccionar registros de anuncios */
    $sentencia=$conexion->prepare("SELECT * FROM `anuncio`");
    $sentencia->execute();
    $lista_anuncios=$sentencia->fetchAll(PDO::FETCH_ASSOC);

    /*seleccionar registros */
    $sentencia=$conexion->prepare("SELECT * FROM `entrada`");
    $sentencia->execute();
    $lista_entrada=$sentencia->fetchAll(PDO::FETCH_ASSOC);

    //Seleccionar registros de propiedad
    $id = $_GET['id'] ?? null; // Obtiene el ID de la URL
    if (!$id) {
        echo "No se ha especificado una propiedad.";
        exit;
    }

    $sentencia = $conexion->prepare("SELECT * FROM `propiedad` WHERE id = :id");
    $sentencia->bindParam(':id', $id, PDO::PARAM_INT);
    $sentencia->execute();
    $propiedad = $sentencia->fetch(PDO::FETCH_ASSOC);

    if (!$propiedad) {
        echo "Propiedad no encontrada.";
        exit;
    }

?>

<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Inversiones Toluca - Propiedad</title>
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
        <nav class="navbar navbar-expand-lg navbar-light fixed-top py-3 navbar-shrink" id="mainNav">
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
                    <a class="nav-link" href="propiedades.php">Explorar Propiedades</a>
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
        

        <section class="container px-4 px-lg-5 h-100 page-section">
           
                <!-- Titulo -->
                <div class="row gx-4 gx-lg-5 justify-content-center">
                    <div class="col-lg-8 col-xl-6 text-center">
                        <h2 class="mt-0"> <?php echo $propiedad["titulo"]; ?> </h2>
                        <hr class="divider" />
                    </div>
                </div>
                <!-- Imagen -->
                <div id="portfolio">
                    <div class="container-fluid p-0 centrar-imagen">
                        <div class="">
                            <div class="">
                                <a class="portfolio-box" href="assets/img/portfolio/<?php echo $propiedad["imgprincipal"]; ?>" title="">
                                    <img class="img-fluid" src="assets/img/portfolio/<?php echo $propiedad["imgprincipal"]; ?>" alt="..." />
                                    <div class="portfolio-box-caption">
                                        <div class="project-category text-white-50">Principal</div>
                                        <div class="project-name"></div>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                <section class="page-section-titulo">
                    <div class="container px-1 px-lg-5 text-center">
                        <h3 class="mb-0 precio-color"><?php echo $propiedad["precio"]; ?></h4>
                        <h4 class="mb-0 precio-color mt-4"><?php echo $propiedad["metros"]; ?> m²</h4>
                    </div>
                </section>

                <section class="page-section-titul">
                    <div class="container px-1 px-lg-5 text-center">
                        <h4 class="mb-0">Servicios Disponibles</h4>
                    </div>
                </section>

                <!-- Iconos -->
                <div class="row gx-4 gx-lg-5">
                    <!-- Verification Check -->
                    <div class="col-lg-3 col-md-6 text-center">
                        <div class="mt-5">
                            <div class="mb-2"><i class="bi-droplet fs-1 text-primary"></i></div>
                            <h3 class="h4 mb-2">Agua</h3>
                            <p class="text-muted mb-0"><?php echo $propiedad["agua"]; ?></p>
                        </div>
                    </div>
                    <!-- Security Lock -->
                    <div class="col-lg-3 col-md-6 text-center">
                        <div class="mt-5">
                            <div class="mb-2"><i class="bi-lightbulb fs-1 text-primary"></i></div>
                            <h3 class="h4 mb-2">Luz</h3>
                            <p class="text-muted mb-0"><?php echo $propiedad["luz"]; ?></p>
                        </div>
                    </div>
                    <!-- Globe -->
                    <div class="col-lg-3 col-md-6 text-center">
                        <div class="mt-5">
                            <div class="mb-2"><i class="bi-wifi fs-1 text-primary"></i></div>
                            <h3 class="h4 mb-2">Teléfono</h3>
                            <p class="text-muted mb-0"><?php echo $propiedad["telefono"]; ?></p>
                        </div>
                    </div>
                    <!-- Dollar Sign -->
                    <div class="col-lg-3 col-md-6 text-center">
                        <div class="mt-5">
                            <div class="mb-2"><i class="bi-gear fs-1 text-primary"></i></div>
                            <h3 class="h4 mb-2">Drenaje</h3>
                            <p class="text-muted mb-0"><?php echo $propiedad["drenaje"]; ?></p>
                        </div>
                    </div>
                </div>
                <!-- Descripción -->
                <section class="page-section-propiedad">
                    <div class="container px-1 px-lg-5 text-center">
                        <h4 class="mb-0">Descripción del inmueble</h4>
                        <p class="mb-0"> <?php echo $propiedad["descripcion"]; ?>
                        </p>
                    </div>
                </section>
                <!-- Galeria -->
                <div id="portfolio">
                    <div class="container-fluid p-0">
                        <div class="row g-0">
                            <div class="col-lg-4 col-sm-6">
                                <a class="portfolio-box" href="assets/img/portfolio/<?php echo $propiedad["img1"]; ?>" title="">
                                    <img class="img-fluid" src="assets/img/portfolio/<?php echo $propiedad["img1"]; ?>" alt="..." />
                                    <div class="portfolio-box-caption">
                                        <div class="project-category text-white-50"></div>
                                        <div class="project-name"></div>
                                    </div>
                                </a>
                            </div>
                            <div class="col-lg-4 col-sm-6">
                                <a class="portfolio-box" href="assets/img/portfolio/<?php echo $propiedad["img2"]; ?>" title="">
                                    <img class="img-fluid" src="assets/img/portfolio/<?php echo $propiedad["img2"]; ?>" alt="..." />
                                    <div class="portfolio-box-caption">
                                        <div class="project-category text-white-50"></div>
                                        <div class="project-name"></div>
                                    </div>
                                </a>
                            </div>
                            <div class="col-lg-4 col-sm-6">
                                <a class="portfolio-box" href="assets/img/portfolio/<?php echo $propiedad["img3"]; ?>" title="">
                                    <img class="img-fluid" src="assets/img/portfolio/<?php echo $propiedad["img3"]; ?>" alt="..." />
                                    <div class="portfolio-box-caption">
                                        <div class="project-category text-white-50"></div>
                                        <div class="project-name"></div>
                                    </div>
                                </a>
                            </div>
                            <div class="col-lg-4 col-sm-6">
                                <a class="portfolio-box" href="assets/img/portfolio/<?php echo $propiedad["img4"]; ?>" title="">
                                    <img class="img-fluid" src="assets/img/portfolio/<?php echo $propiedad["img4"]; ?>" alt="..." />
                                    <div class="portfolio-box-caption">
                                        <div class="project-category text-white-50"></div>
                                        <div class="project-name"></div>
                                    </div>
                                </a>
                            </div>
                            <div class="col-lg-4 col-sm-6">
                                <a class="portfolio-box" href="assets/img/portfolio/<?php echo $propiedad["img5"]; ?>" title="">
                                    <img class="img-fluid" src="assets/img/portfolio/<?php echo $propiedad["img5"]; ?>" alt="..." />
                                    <div class="portfolio-box-caption">
                                        <div class="project-category text-white-50"></div>
                                        <div class="project-name"></div>
                                    </div>
                                </a>
                            </div>
                            <div class="col-lg-4 col-sm-6">
                                <a class="portfolio-box" href="assets/img/portfolio/<?php echo $propiedad["img6"]; ?>" title="">
                                    <img class="img-fluid" src="assets/img/portfolio/<?php echo $propiedad["img6"]; ?>" alt="..." />
                                    <div class="portfolio-box-caption p-3">
                                        <div class="project-category text-white-50"></div>
                                        <div class="project-name"></div>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                
                <div class="grid-container .mb-xxl-5">
                    <!-- Sección Contacto Directo -->
                    <section class="page-section-titulo">
                        <div class="px-1 px-lg-5 text-center">
                            <h4 class="mb-0">Contacto Directo:</h4>
                            <p class="mb-4"> <?php echo $propiedad["vendedor"]; ?> </p>   
                            <div class="row justify-content-center">
                                <a class="btn btn-primary btn-xl" href="<?php echo $propiedad["contacto"]; ?>">Contactar</a>
                            </div>
                        </div>
                    </section>

                    <!-- Sección Ubicación -->
                    <section class="page-section-titulo">
                        <div class="text-center">
                            <h4 class="mb-4">Ubicación</h4>
                            <div class="iframe-container">
                                <iframe 
                                    src="<?php echo htmlspecialchars($propiedad["ubicacion"], ENT_QUOTES, 'UTF-8'); ?>" 
                                    width="600" height="450" 
                                    style="border:0;" 
                                    allowfullscreen="" 
                                    loading="lazy" 
                                    referrerpolicy="no-referrer-when-downgrade">
                                </iframe>
                            </div>
                        </div>
                    </section>
                </div>

            

        </section>


        
        

        <!-- Bootstrap core JS-->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
        <!-- SimpleLightbox plugin JS-->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/SimpleLightbox/2.1.0/simpleLightbox.min.js"></script>
        <!-- Core theme JS-->
        <script src="js/script.js"></script>
        <!-- * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *-->
        <!-- * *                               SB Forms JS                               * *-->
        <!-- * * Activate your form at https://startbootstrap.com/solution/contact-forms * *-->
        <!-- * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *-->
        <script src="https://cdn.startbootstrap.com/sb-forms-latest.js"></script>
    </body>
</html>
