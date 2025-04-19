<div class="sidebar-wrapper" data-simplebar="true">
			<div class="sidebar-header">
				<div>
					<img src="{{ asset ('assets/logo/goshop.png')}}" class="logo-icon" alt="logo icon">
				</div>
				<div class="toggle-icon ms-auto"><i class='bx bx-arrow-to-left'></i>
				</div>
			</div>
			<!--navigation-->
			<ul class="metismenu" id="menu">
				<li>
					<a href="{{ Route('admin.dashboard') }}" >
						<div class="parent-icon" ><i class='bx bx-home-circle'></i>
						</div>
						<div class="menu-title">Dashboard</div>
					</a>
				</li>
				<li class="menu-label">HOME</li>
				<li>
					<a href="{{ Route('admin.home.banner') }}">
						<div class="parent-icon"><i class="bx bx-category"></i>
						</div>
						<div class="menu-title">Home Banner</div>
					</a>
				</li>
				<li>
					<a href="{{ Route('admin.size') }}">
						<div class="parent-icon"><i class="bx bx-category"></i>
						</div>
						<div class="menu-title">Size</div>
					</a>
				</li>
				<li>
					<a href="{{ Route('admin.color') }}">
						<div class="parent-icon"><i class="bx bx-category"></i>
						</div>
						<div class="menu-title">Color</div>
					</a>
				</li>
				<li>
					<a href="javascript:;" class="has-arrow">
						<div class="parent-icon"><i class='bx bx-cart'></i>
						</div>
						<div class="menu-title">ATTRIBUTE</div>
					</a>
					<ul>
						<li> <a href="{{ Route('admin.attribute') }}"><i class="bx bx-right-arrow-alt"></i>Attribute</a>
						</li>
						<li> <a href="{{ Route('admin.attribute.value') }}"><i class="bx bx-right-arrow-alt"></i>Attribute Value</a>
						</li>
					</ul>
				</li>
				<li>
					<a href="javascript:;" class="has-arrow">
						<div class="parent-icon"><i class='bx bx-category'></i>
						</div>
						<div class="menu-title">CATEGORY</div>
					</a>
					<ul>
						<li> <a href="{{ Route('admin.category') }}"><i class="bx bx-right-arrow-alt"></i>Category</a>
						</li>
						<li> <a href="{{ Route('admin.category.attribute.store') }}"><i class="bx bx-right-arrow-alt"></i>Category Attribute</a>
						</li>
					</ul>
				</li>
				<li>
					<a href="{{ Route('admin.brand') }}">
						<div class="parent-icon"><i class="bx bx-user-circle"></i>
						</div>
						<div class="menu-title">Brands</div>
					</a>
				</li>
				<li>
					<a href="{{ Route('admin.tax') }}">
						<div class="parent-icon"><i class="bx bx-user-circle"></i>
						</div>
						<div class="menu-title">Taxes</div>
					</a>
				</li>
				<li>
					<a href="javascript:;" class="has-arrow">
						<div class="parent-icon"><i class='bx bx-category'></i>
						</div>
						<div class="menu-title">PRODUCTS</div>
					</a>
					<ul>
						<li> <a href="{{ Route('admin.product') }}"><i class="bx bx-right-arrow-alt"></i>Products</a>
						</li>
						<li> <a href="{{ Route('admin.new.product', 0) }}"><i class="bx bx-right-arrow-alt"></i>Manage Product</a>
						</li>
					</ul>
				</li>
				<li>
					<a href="{{ Route('admin.profile') }}">
						<div class="parent-icon"><i class="bx bx-user-circle"></i>
						</div>
						<div class="menu-title">User Profile</div>
					</a>
				</li>
			</ul>
			<!--end navigation-->
		</div>