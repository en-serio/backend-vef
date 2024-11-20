<?php 
include_once dirname(__DIR__, 2) . "/globals/globals.php";
include_once BASE_URL."views/common/initMeta.php";
?>
<body id="kt_body" class="app-blank app-blank">

		<script>
		var defaultThemeMode = "light"; 
		var themeMode; if ( document.documentElement ) 
			{ if ( document.documentElement.hasAttribute("data-bs-theme-mode")) 
			{ themeMode = document.documentElement.getAttribute("data-bs-theme-mode"); } 
				else { if ( localStorage.getItem("data-bs-theme") !== null ) 
				{ themeMode = localStorage.getItem("data-bs-theme"); } 
				else { themeMode = defaultThemeMode; } } if (themeMode === "system") 
				{ themeMode = window.matchMedia("(prefers-color-scheme: dark)").matches ? "dark" : "light"; }
				 document.documentElement.setAttribute("data-bs-theme", themeMode); }
				 </script>
		
		
		<div class="d-flex flex-column flex-root" id="kt_app_root">
			<div class="d-flex flex-column flex-lg-row flex-column-fluid">
				<div class="d-flex flex-lg-row-fluid w-lg-50 bgi-size-cover bgi-position-center" style="background-image: url(assets/img/auth-bg.png)">
					<div class="d-flex flex-column flex-center p-6 p-lg-10 w-100">
						<img alt="Logo" src="assets/img/default-white.svg" class="h-80px h-20px h-lg-120px h-lg-100px " />
						<img class="d-none d-lg-block mx-auto w-300px w-lg-75 w-xl-500px mb-10 mb-lg-20" alt="" />
						<h1 class="d-none d-lg-block text-white fs-2qx fw-bold text-center mb-7"></h1>
						
					</div>
				</div>
				<div class="d-flex flex-column flex-lg-row-fluid w-lg-50 p-10">
					<div class="d-flex flex-center flex-column flex-lg-row-fluid">
						<div class="w-lg-500px w-500px p-10">
							<form class="form w-100" novalidate="novalidate" id="kt_sign_in_form" data-kt-redirect-url="../../demo1/dist/index.html" action="#">
								<div class="text-center mb-11">
									<h1 class="text-dark fw-bolder mb-3">Iniciar sesión</h1>
								</div>
								<div class="fv-row mb-8">
									<input type="text" placeholder="Usuario" name="username" autocomplete="off" class="form-control bg-transparent" value="german.biosca"/>
								</div>
								<div class="fv-row mb-3">
									<input type="password" placeholder="Contraseña" name="password" autocomplete="off" class="form-control bg-transparent" value="passwordbuenobueno"/>
								</div>
								<div class="d-flex flex-stack flex-wrap gap-3 fs-base fw-semibold mb-8">
									<div></div>
									<a href="reset-password" class="link-primary">Has olvidado el password ?</a>
								</div>
								<div class="d-grid mb-10">
									<button type="submit" id="kt_sign_in_submit" class="btn btn-primary">
										<span class="indicator-label">Login</span>
										<span class="indicator-progress">Please wait...
										<span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
									</button>
								</div>
								
							</form>
						</div>
					</div>
					
				</div>
			</div>
		</div>
		<script>var hostUrl = "assets/";</script>
		<script src="assets/plugins/global/plugins.bundle.js"></script>
		<script src="assets/js/scripts.bundle.js"></script>
		<script src="assets/js/sign-in.js"></script>
		
	</body>
</html>