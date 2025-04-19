<!doctype html>
<html lang="en">

<!-- head import -->
<x-admin-header-css />

<body>
	<!-- body -->
	<div class="wrapper">
		<div class="section-authentication-signin d-flex align-items-center justify-content-center my-5 my-lg-0">
			<div class="container-fluid">
				<div class="row row-cols-1 row-cols-lg-2 row-cols-xl-3">
					<div class="col mx-auto">
						<div class="mb-4 text-center">
							<!-- logo -->
						</div>
						<div class="card">
							<div class="card-body">
								<div class="border p-4 rounded">
									<div class="text-center">
										<h3 class="">Sign in</h3>
										<p>Don't have an account yet? <a href="authentication-signup.html">Sign up
												here</a>
										</p>
									</div>
									<div class="login-separater text-center mb-4"> <span>SIGN IN WITH EMAIL</span>
										<hr />
									</div>
									<div class="form-body">
										<form class="row g-3" id="formSubmit" method="post" action="{{ Route('user.login') }}"> 
											@csrf
											<div class="col-12">
												<label for="inputEmailAddress" class="form-label">Email Address</label>
												<input type="email" name="email" class="form-control"
													id="inputEmailAddress" placeholder="Email Address" required>
											</div>
											<div class="col-12">
												<label for="inputChoosePassword" class="form-label">Enter
													Password</label>
												<div class="input-group" id="show_hide_password">
													<input type="password" name="password"
														class="form-control border-end-0" id="inputChoosePassword"
														placeholder="Enter Password" required> <a href="javascript:;"
														class="input-group-text bg-transparent"><i
															class='bx bx-hide'></i></a>
												</div>
											</div>
											<div class="col-md-6">
												<div class="form-check form-switch">
													<input class="form-check-input" type="checkbox"
														id="flexSwitchCheckChecked" checked>
													<label class="form-check-label"
														for="flexSwitchCheckChecked">Remember Me</label>
												</div>
											</div>
											<div class="col-md-6 text-end"> <a
													href="authentication-forgot-password.html">Forgot Password ?</a>
											</div>
											<div class="col-12">
												<div class="d-grid">
													<button type="submit" class="btn btn-primary"><i
															class="bx bxs-lock-open"></i>Sign in</button>
												</div>
											</div>
										</form>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<!--end row-->
			</div>
		</div>
	</div>
	<!-- include the js files -->
	<x-admin-footer-js />