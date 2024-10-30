<?php
session_start();
if (!isset($_SESSION['user'])) {
    header("Location: ./inicio.php");
    exit();
}
$allowedRoles = ['Empresa'];
if (!in_array($_SESSION['user']['user_type'], $allowedRoles)) {
    echo "Acceso denegado. No tienes permisos para acceder a esta página.";
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Perfil de Empresa</title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" defer></script>
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
	<link rel="stylesheet" href="/css/global.css">
	<link rel="stylesheet" href="/Empresa/Perfil-Empresa/perfil-empresa.css">
	<script src="perfil-empresa.js" defer></script>
</head>

<body class="bg-inicio">
	<header>
		<nav class="navbar sticky-top bg-navbar">
			<div class="container-fluid">
				<a class="navbar-brand" href="#"><img src="../../img/logo.png" alt="logo"></a>
				<form class="d-none d-sm-flex" role="search">
					<input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
					<button class="btn btn-outline-success d-grid align-content-center" type="submit">
						<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
							<path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001q.044.06.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1 1 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0" />
						</svg>
					</button>
				</form>
				<button class="navbar-toggler shadow-sm" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar" aria-label="Toggle navigation">
					<span class="navbar-toggler-icon"></span>
				</button>
				<div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasNavbar" aria-labelledby="offcanvasNavbarLabel">
					<div class="offcanvas-header">
						<img src="../../img/logo.png" alt="logo">
						<button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
					</div>
					<div class="offcanvas-body">
						<ul class="navbar-nav justify-content-start flex-grow-1 pe-3">
							<li class="nav-item">
								<a class="nav-link" href="/Empresa/Perfil-Empresa/perfil-empresa.html">Mi perfil</a>
							</li>
							<li class="nav-item">
								<a class="nav-link" href="/Empresa/Publicar-Empleo/publicar-empleo.html">Publicar empleo</a>
							</li>
							<li class="nav-item">
								<a class="nav-link" href="/Empresa/Publicaciones-Empresa/publicaciones-empresa.html">Publicaciones</a>
							</li>
							<li class="nav-item">
								<a class="nav-link" href="/Empresa/Reclutar-empresa/reclutar-empresa.html">Reclutar</a>
							</li>
						</ul>
						<form class="d-flex d-sm-none mt-3" role="search">
							<input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
							<button class="btn btn-outline-success d-grid align-content-center" type="submit">
								<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
									<path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001q.044.06.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1 1 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0" />
								</svg>
							</button>
						</form>
					</div>
				</div>
			</div>
		</nav>
	</header>
    <div class="container p-sm-4 bg-secondary-subtle">
        <div class="container mt-5">
			<div class="pb-5">
				<h1>Mi Perfil</h1>
			</div>
			<div class="perfil-header">
				<img src="/Nav-bar/perfil.jpg" alt="Foto de perfil" id="foto-perfil">
				<div class="info">
					<div class="nombre">
						<h3>Empresa S.A.</h3>
					</div>
					<div class="descripcion">
						<p>Descripción de empresa</p>
					</div>
					<a href="/Empresa/Editar-Perfil/editar-perfil-empresa.html" class="btn btn-outline-success">Editar perfil</a>
				</div>
			</div>
			<div class="mt-4">
				<h3>Información de Contacto</h3>
				<ul class="list-unstyled">
					<li><strong>Email:</strong> contacto@empresa.com</li>
					<li><strong>Teléfono:</strong> +11 111 111 111</li>
					<li><strong>Sitio web:</strong> <a href="https://www.empresa.com" target="_blank">www.empresa.com</a></li>
				</ul>
			</div>
			<div class="mt-4">
				<h3>Dirección</h3>
				<p>Calle Ejemplo, 123, Ciudad, País</p>
			</div>
			<div class="mt-4">
				<h3>Publicaciones Recientes</h3>
				<div class="list-group col-12 p-0">
					<a href="/Empresa/Publicaciones-Empresa/puesto.html" class="list-group-item list-group-item-action" aria-current="true">
						<div class="d-flex w-100 justify-content-between">
						  <h5 class="mb-1">Desarrollador de Software</h5>
						  <small>Hace 3 días</small>
						</div>
						<p class="mb-1">Responsable del diseño, desarrollo y mantenimiento de aplicaciones web y móviles.</p>
						<small>Conocimiento en lenguajes de programación como Java, Python y C#.</small>
					</a>
					<a href="/Empresa/Publicaciones-Empresa/puesto.html" class="list-group-item list-group-item-action">
						<div class="d-flex w-100 justify-content-between">
						  <h5 class="mb-1">Especialista en Seguridad e Higiene</h5>
						  <small class="text-muted">Hace 5 días</small>
						</div>
						<p class="mb-1">Encargado de implementar y supervisar normas de seguridad en el lugar de trabajo.</p>
						<small class="text-muted">Certificaciones en normativas de seguridad industrial y ambiental.</small>
					</a>
					<a href="/Empresa/Publicaciones-Empresa/puesto.html" class="list-group-item list-group-item-action">
						<div class="d-flex w-100 justify-content-between">
						  <h5 class="mb-1">Analista de Comercio Internacional</h5>
						  <small class="text-muted">Hace 1 semana</small>
						</div>
						<p class="mb-1">Gestiona operaciones de exportación e importación, asegurando el cumplimiento de regulaciones aduaneras.</p>
						<small class="text-muted">Experiencia en tratados internacionales y logística global.</small>
					</a>
				</div>
			</div>
		</div>
	</div>
</body>

</html>