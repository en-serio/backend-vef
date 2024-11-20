<?php
include_once dirname(__DIR__, 2) . "/globals/globals.php";
include_once BASE_URL . "views/common/initMeta.php";

?>

<body id="kt_body" class="app-blank app-blank">
	<script>
		var defaultThemeMode = "light";
		var themeMode;
		if (document.documentElement) {
			if (document.documentElement.hasAttribute("data-bs-theme-mode")) {
				themeMode = document.documentElement.getAttribute("data-bs-theme-mode");
			} else {
				if (localStorage.getItem("data-bs-theme") !== null) {
					themeMode = localStorage.getItem("data-bs-theme");
				} else {
					themeMode = defaultThemeMode;
				}
			}
			if (themeMode === "system") {
				themeMode = window.matchMedia("(prefers-color-scheme: dark)").matches ? "dark" : "light";
			}
			document.documentElement.setAttribute("data-bs-theme", themeMode);
		}
	</script>
	<div class="d-flex flex-column flex-root" id="kt_app_root">
		<div class="d-flex flex-column flex-lg-row flex-column-fluid">
			<div class="d-flex flex-lg-row-fluid w-lg-50 bgi-size-cover bgi-position-center" style="background-image: url(assets/media/misc/auth-bg.png)">
				<div class="d-flex flex-column flex-center p-6 p-lg-10 w-100">
					<img alt="Logo" src="assets/img/logo.svg" class="h-80px h-20px h-lg-120px h-lg-100px " />
					<img class="d-none d-lg-block mx-auto w-300px w-lg-75 w-xl-500px mb-10 mb-lg-20" src="assets/media/misc/auth-screens.png" alt="" />
					<h1 class="d-none d-lg-block text-white fs-2qx fw-bold text-center mb-7">Fast, Efficient and Productive</h1>
					<div class="d-none d-lg-block text-white fs-base text-center">In this kind of post,
						<a href="#" class="opacity-75-hover text-warning fw-semibold me-1">the blogger</a>introduces a person they’ve interviewed
						<br />and provides some background information about
						<a href="#" class="opacity-75-hover text-warning fw-semibold me-1">the interviewee</a>and their
						<br />work following this is a transcript of the interview.
					</div>
				</div>
			</div>
			<div class="d-flex flex-column flex-lg-row-fluid w-lg-50 p-10">
				<div class="d-flex flex-center flex-column flex-lg-row-fluid">
					<div class="w-lg-500px p-10">
						<form class="form w-100" novalidate="novalidate" id="kt_password_reset_form" action="javascript:;">
							<div class="text-center mb-10">
								<h1 class="text-dark fw-bolder mb-3">Has olvidado el acceso ?</h1>
								<div class="text-gray-500 fw-semibold fs-6">Introduce tu email para restablecer acceso.</div>
							</div>
							<div class="fv-row mb-8">	
								<input type="text" placeholder="Email" name="email" autocomplete="off" class="form-control bg-transparent" />
							</div>
							<div class="d-flex flex-wrap justify-content-center pb-lg-0">
								<button type="button" id="kt_password_reset_submit" class="btn btn-primary me-4">
									<span class="indicator-label">Submit</span>
									<span class="indicator-progress">Please wait...
										<span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
								</button>
								<a href="login" class="btn btn-light">Cancel</a>
							</div>
						</form>
					</div>
				</div>
				
			</div>
		</div>
	</div>
	<script>
		var hostUrl = "assets/";
	</script>
	<script src="assets/plugins/global/plugins.bundle.js"></script>
	<script src="assets/js/scripts.bundle.js"></script>
	<script src="assets/js/reset-password.js"></script>
</body>
</html>