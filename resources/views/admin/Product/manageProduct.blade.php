@extends('admin.layout')

@section('content')


	<script src="{{ asset('ckeditor4/ckeditor.js') }}"></script>
	<script src="{{ asset('ckfinder/ckfinder.js') }}"></script>

	<div class="page-wrapper">
		<div class="page-content">
			<!--breadcrumb-->
			<div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
				<div class="breadcrumb-title pe-3">MANAGE PRODUCT</div>
				<div class="ps-3">
					<nav aria-label="breadcrumb">
						<ol class="breadcrumb mb-0 p-0">
							<li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
							</li>
							<li class="breadcrumb-item active" aria-current="page">Product</li>
						</ol>
					</nav>
				</div>
				<div class="ms-auto">
					<div class="btn-group">
						<button type="button" class="btn btn-primary">Settings</button>
						<button type="button" class="btn btn-primary split-bg-primary dropdown-toggle dropdown-toggle-split"
							data-bs-toggle="dropdown"> <span class="visually-hidden">Toggle Dropdown</span>
						</button>
						<div class="dropdown-menu dropdown-menu-right dropdown-menu-lg-end"> <a class="dropdown-item"
								href="javascript:;">Action</a>
							<a class="dropdown-item" href="javascript:;">Another action</a>
							<a class="dropdown-item" href="javascript:;">Something else here</a>
							<div class="dropdown-divider"></div> <a class="dropdown-item" href="javascript:;">Separated
								link</a>
						</div>
					</div>
				</div>
			</div>
			<!-- Section -->
			<h6 class="mb-0 text-uppercase">Manage Product</h6>
			<hr />
			<div class="row">
				<div class="col-xl-10 mx-auto">
					<div class="card border-top border-0 border-4 border-info">
						<div class="card-body">
							<div class="border p-4 rounded">
								<div class="card-title d-flex align-items-center">
									<div><i class="bx bxs-user me-1 font-22 text-info"></i>
									</div>
									<h5 class="mb-0 text-info">Set Product</h5>
								</div>
								<hr>
								<form action="{{ Route('admin.product.store') }}" id="formSubmit"
									enctype="multipart/form-data">
									@csrf
									<input type="hidden" value="{{ $product->id > 0 ? $product->id : '' }}" name="id" id="product_id">
									<div class="row mb-3">
										<label for="inputEnterYourName" class="col-sm-3 col-form-label">Product Name</label>
										<div class="col-sm-9">
											<input type="text" class="form-control" id="inputEnterYourName"
												name="product_name" placeholder="Enter Product Name"
												value="{{ $product->name }}">
										</div>
									</div>
									<div class="row mb-3">
										<label for="inputPhoneNo2" class="col-sm-3 col-form-label">Product Slug</label>
										<div class="col-sm-9">
											<input type="text" class="form-control" id="inputPhoneNo2" name="product_slug"
												placeholder="Product Slug" value="{{ $product->slug }}">
										</div>
									</div>
									<div class="row mb-3">
										<label for="photo" class="col-sm-3 col-form-label">Product Image</label>
										<div class="col-sm-9">
											<input type="file" class="form-control" id="photo" name="product_image"
												placeholder="Product Slug">

											<img src="{{ $product->image ? asset($product->image) : asset('assets/logo/goshop.png') }}"
												alt="Product Image" class="product-img-2 my-2"
												style="height: 100px; width: 100px;" id="imagepreview">
										</div>
									</div>

									<div class="row mb-3">
										<label for="description" class="col-sm-3 col-form-label">Description</label>
										<div class="col-sm-9">
											<textarea type="text" class="form-control" id="description"
												name="description">{{ $product->description }}</textarea>
										</div>
									</div>
									<div class="row mb-3">
										<label for="itemcode" class="col-sm-3 col-form-label">Product Item Code</label>
										<div class="col-sm-9">
											<input type="text" class="form-control" id="itemcode" name="product_itemcode"
												placeholder="Product Item Code" value="{{ $product->item_code }}">
										</div>
									</div>
									<div class="row mb-3">
										<label for="keywords" class="col-sm-3 col-form-label">Product KeyWords</label>
										<div class="col-sm-9">
											<input type="text" class="form-control" id="keywords" name="product_keywords"
												placeholder="Product Keywords" value="{{ $product->keywords }}">
										</div>
									</div>
									<div class="row mb-3">
										<label for="category" class="col-sm-3 col-form-label">Category</label>
										<div class="col-sm-9">
											<select name="category" id="category" class="form-control">
												<option value="">Select Category</option>
												@foreach($category as $categorylist)
													<option value="{{ $categorylist->id }}" {{ $product->category_id == $categorylist
													->id ? 'selected' : '' }}>
																							{{ $categorylist->name }}
													</option>
												@endforeach
											</select>
										</div>
									</div>
									<div class="row mb-3">
										<label for="attribute" class="col-sm-3 col-form-label">Select Attribute</label>
										<div class="col-sm-9">
											<span id="multiAttr">


											@if (isset($product['attribute'][0]->id))

											<select id="attribute" name="attribute[]" class="form-control"  multiple >

											@foreach ( $product['attribute'] as $attributeList )
											<option value="{{ $attributeList['attr_value']->id }}"  selected>{{ $attributeList['attr_value']->value }} ({{ $attributeList['attr_value']->id }})</option>
											@endforeach
										</select>
											@endif

											</span>
										</div>

									</div>
									<div class="row mb-3">
										<label for="keywords" class="col-sm-3 col-form-label">Brand</label>
										<div class="col-sm-9">
											<select name="brand" id="brand" class="form-control">
												<option value="">Select Brand</option>
												@foreach($brand as $bra)
																						<option value="{{ $bra->id }}" {{ $product->brand_id == $bra
													->id ? 'selected' : '' }}>{{ $bra->name }}</option>
												@endforeach
											</select>
										</div>
									</div>
									<div class="row mb-3">
										<label for="tax" class="col-sm-3 col-form-label">Tax</label>
										<div class="col-sm-9">
											<select name="tax" id="tax" class="form-control">
												<option value="">Select Tax Rate</option>
												@foreach($tax as $taxes)
																						<option value="{{ $taxes->id }}" {{ $product->tax_id == $taxes
													->id ? 'selected' : '' }}>{{ $taxes->tax }}</option>
												@endforeach
											</select>
										</div>
									</div>
									<div class="row mb-3">
										<label for="keywords" class="col-sm-3 col-form-label">Attribute</label>
										<div class="row col-sm-9">

											@php
												$count = 1
											@endphp
											<div class="row" id="addnewattribute">

											@if (!empty($product['productAttribute']) && count($product['productAttribute']) > 0)
													@foreach ($product['productAttribute'] as $product_attr)
														<span class="row" id="addnewattribute_{{$count}}">
															<div class="row col-sm-12">
																<div class="col-12 mb-1">
																	<label class="col-form-label">Attribute Properties</label>
																</div>
															</div>

															<input type="hidden" name="product_attr_id[]" value="{{ $product_attr->id }}">

															<div class="col-sm-3 mb-1">
																<select name="color[]" class="form-control" id="colorId">
																	<option value="">Color</option>
																	@foreach ($color as $colorList)
																		<option value="{{ $colorList->id }}" {{ $colorList->id == $product_attr->color_id ? 'selected' : '' }} style="background-color: {{ $colorList->value }}">
																			{{ $colorList->text }}
																		</option>
																	@endforeach
																</select>
															</div>

															<div class="col-sm-3 mb-1">
																<select name="size[]" class="form-control" id="sizeId">
																	<option value="">Size</option>
																	@foreach ($size as $sizeList)
																		<option value="{{ $sizeList->id }}" {{ $sizeList->id == $product_attr->size_id ? 'selected' : '' }}>
																			{{ $sizeList->text }}
																		</option>
																	@endforeach
																</select>
															</div>

															<div class="col-sm-3 mb-1">
																<input type="text" class="form-control" name="sku[]" placeholder="SKU" value="{{ $product_attr->sku }}">
															</div>

															<div class="col-sm-3 mb-1">
																<input type="text" class="form-control" name="mrp[]" placeholder="MRP" value="{{ $product_attr->impr }}">
															</div>

															<div class="col-sm-3 mb-1">
																<input type="text" class="form-control" name="qty[]" placeholder="Quantity" value="{{ $product_attr->qty }}">
															</div>

															<div class="col-sm-3 mb-1">
																<input type="text" class="form-control" name="price[]" placeholder="Price" value="{{ $product_attr->price }}">
															</div>

															<div class="col-sm-3 mb-1">
																<input type="text" class="form-control" name="length[]" placeholder="Length" value="{{ $product_attr->length }}">
															</div>

															<div class="col-sm-3 mb-1">
																<input type="text" class="form-control" name="breadth[]" placeholder="Breadth" value="{{ $product_attr->breadth }}">
															</div>

															<div class="col-sm-3 mb-1">
																<input type="text" class="form-control" name="height[]" placeholder="Height" value="{{ $product_attr->height }}">
															</div>

															<div class="col-sm-3 mb-1">
																<input type="text" class="form-control" name="width[]" placeholder="Width" value="{{ $product_attr->width }}">
															</div>

															{{-- Attribute Images --}}
															<div class="row col-sm-12">
																<div class="col-12 mb-1">
																	<label class="col-form-label">Attribute Images</label>
																</div>
																@php $img_count = 9999; @endphp
																<div id="addattrnewimg_{{$count}}" class="row">
																	@foreach ($product_attr['images'] as $attr_img)
																		<span id="addattrnewimg_{{$img_count}}" class="row col-sm-3 me-1">
																			<div class="mb-1">
																				<input type="file" class="form-control" name="attr_image_{{$count}}[]">
																				<img src="{{ asset($attr_img->image_path) }}" alt="..." class="product-img-2 my-2" style="height:70px; width:70px">
																				@if ($img_count != 9999)
																					<button type="button" class="btn btn-danger px-2" onclick="removeattr('addattrnewimg_{{$img_count}}' , '{{ $attr_img->id }}' , 'product_attr_images' )">Remove</button>
																				@endif
																			</div>
																		</span>
																		@php $img_count++; @endphp
																	@endforeach
																</div>

																<div class="row col-12 my-2 p-1 ms-1">
																	<input type="hidden" name="imageValue[]" value="{{ $count }}">
																	<button type="button" onclick="addattrimg('addattrnewimg_{{$count}}', {{$count}})" class="btn btn-info px-5 m-1">Add Image</button>
																	@if ($count != 1)
																		<button type="button" class="btn btn-danger px-5 m-1" onclick="removeattr('addnewattribute_{{$count}}', '{{ $product_attr->id }}' , 'product_attrs')">Remove Attribute</button>
																	@endif
																</div>
															</div>
														</span>
														@php $count++; @endphp
													@endforeach
												@else

													<span class="row" id="addnewattribute_{{$count}}">
														<div class="row col-sm-12">
															<div class="col-12 mb-1">
																<label class="col-form-label">Attribute Properties</label>
															</div>
														</div>

														<input type="hidden" name="product_attr_id[]" value="0">

														<div class="col-sm-3 mb-1">
															<select name="color[]" class="form-control" id="colorId">
																<option value="">Color</option>
																@foreach ($color as $colorList)
																	<option value="{{ $colorList->id }}" style="background-color: {{ $colorList->value }}">{{ $colorList->text }}</option>
																@endforeach
															</select>
														</div>

														<div class="col-sm-3 mb-1">
															<select name="size[]" class="form-control"  id="sizeId">
																<option value="">Size</option>
																@foreach ($size as $sizeList)
																	<option value="{{ $sizeList->id }}">{{ $sizeList->text }}</option>
																@endforeach
															</select>
														</div>

														<div class="col-sm-3 mb-1">
															<input type="text" class="form-control" name="sku[]" placeholder="SKU" value="">
														</div>

														<div class="col-sm-3 mb-1">
															<input type="text" class="form-control" name="mrp[]" placeholder="MRP" value="">
														</div>

														<div class="col-sm-3 mb-1">
															<input type="text" class="form-control" name="qty[]" placeholder="Quantity" value="">
														</div>

														<div class="col-sm-3 mb-1">
															<input type="text" class="form-control" name="price[]" placeholder="Price" value="">
														</div>

														<div class="col-sm-3 mb-1">
															<input type="text" class="form-control" name="length[]" placeholder="Length" value="">
														</div>

														<div class="col-sm-3 mb-1">
															<input type="text" class="form-control" name="breadth[]" placeholder="Breadth" value="">
														</div>

														<div class="col-sm-3 mb-1">
															<input type="text" class="form-control" name="height[]" placeholder="Height" value="">
														</div>

														<div class="col-sm-3 mb-1">
															<input type="text" class="form-control" name="width[]" placeholder="Width" value="">
														</div>

														{{-- Default Image Box --}}
														<div class="row col-sm-12">
															<div class="col-12 mb-1">
																<label class="col-form-label">Attribute Images</label>
															</div>
															@php $img_count = 9999; @endphp
															<div id="addattrnewimg_{{$count}}" class="row">
																<span id="addattrnewimg_{{$img_count}}" class="row col-sm-3 me-1">
																	<div class="mb-1">
																		<input type="file" class="form-control" name="attr_image_{{$count}}[]">
																		<img src="{{ asset('assets/logo/goshop.png') }}" alt="..." class="product-img-2 my-2" style="height:70px; width:70px">
																	</div>
																</span>
															</div>

															<div class="row col-12 my-2 p-1 ms-1">
																<input type="hidden" name="imageValue[]" value="{{ $count }}">
																<button type="button" onclick="addattrimg('addattrnewimg_{{$count}}', {{$count}})" class="btn btn-info px-5 m-1">Add Image</button>
																@if ($count != 1)
																	<button type="button" class="btn btn-danger px-5 m-1" onclick="removeattr('addnewattribute_{{$count}}')">Remove Attribute</button>
																@endif
															</div>
														</div>
													</span>
												@endif

											</div>
											<div class="col-12 mb-1">
												<button type="button" id="addattributebtn"
													class="btn btn-info px-5 my-3">Add New Arrtibute</button>
											</div>
										</div>

									</div>
									<div class="row">
										<label class="col-sm-3 col-form-label"></label>
										<div class="col-sm-9">
											<span id="submitButton">
												<input type="submit" class="btn btn-info px-5">
												</spa>
										</div>
									</div>
								</form>

							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<script>
		var editor = CKEDITOR.replace('description');
		CKFinder.setupCKEditor(editor);
	</script>
	<script>
		$('#category').change(function (e) {

			var cat = $('#category').val()

			var url = "{{ Route('admin.product.getAttribute') }}"

			$.ajax({
				url: url,
				type: 'POST',
				data: {
					'cat': cat
				},
				headers: {
					'X-CSRF-TOKEN': '{{csrf_token()}}'
				},
				success: function (response) {

					var html = '';

					if (response.status === "Success") {

						html += '<select id="attribute" name="attribute[]" class="form-control"  multiple >'
						jQuery.each(response.data.data, function (key, val) {
							jQuery.each(val.values, function (attrkey, attrval) {
								html += '<option value="' + attrval.id + '">' + val.attribute.name + ' (' + attrval.value + ')</option>';
							})
						})

						html += '</select>'

						$('#multiAttr').html(html);
						$('#attribute').multiSelect();


					} else {

					}
				},
				error: function (xhr) {
					SnackBar({
						status: xhr.responseJSON?.status || 'error',
						message: xhr.responseJSON?.message || 'Something went wrong.',
						position: "tr"
					});
				}
			});
		});
	</script>
	

	<script>
		var count = 1111;
		var img_count = 9999;
		$('#addattributebtn').click(function (e) {
			count++
			img_count++
			var id = 'addnewattribute_' + count + '';
			var new_attr_img = 'addattrnewimg_' + count + '';
			var html = '';
			var color = $('#colorId').html();
			var size = $('#sizeId').html() ;

			html += '<span class="row" id="addnewattribute_' + count + '"><input type="hidden" name="product_attr_id" value="0"><div class="row col-sm-12"><div class="col-12 mb-1"><label for="keywords" class=" col-form-label">AttributeProperties</label></div></div>';
			html += '<div class="col-sm-3 mb-1"><select name="color[]" id="color" class="form-control">' + color + '</select></div>';
			html += '<div class="col-sm-3 mb-1"><select name="size[]" id="size" class="form-control">' + size + '</select></div>';
			html += '<div class="col-sm-3 mb-1"><input type="text" class="form-control" id="sku" name="sku[]"placeholder="SKU" value=""></div>';
			html += '<div class="col-sm-3 mb-1"><input type="text" class="form-control" id="mrp" name="mrp[]"placeholder="MRP" value=""></div>';
			html += '<div class="col-sm-3 mb-1"><input type="text" class="form-control" id="qty" name="qty[]"placeholder="Quantity" value=""></div>';
			html += '<div class="col-sm-3 mb-1"><input type="text" class="form-control" id="price" name="price[]"placeholder="Price" value=""></div>';
			html += '<div class="col-sm-3 mb-1"><input type="text" class="form-control" id="length" name="length[]"placeholder="Length" value=""></div>';
			html += '<div class="col-sm-3 mb-1"><input type="text" class="form-control" id="breadth" name="breadth[]"placeholder="Breadth" value=""></div>';
			html += '<div class="col-sm-3 mb-1"><input type="text" class="form-control" id="height" name="height[]"placeholder="Height" value=""></div>';
			html += '<div class="col-sm-3 mb-1"><input type="text" class="form-control" id="width" name="width[]"placeholder="Width" value=""></div>';
			html += '<div class="row col-sm-12"><div class="col-12 mb-1"><label for="keywords" class=" col-form-label">Attribute Images</label></div>'
			html += '<div id="addattrnewimg_' + count + '" class="row">'
			html += '<span id="addattrnewimg_' + img_count + '" class="row col-sm-3 me-1">'
			html += '<div class="col-sm-3 mb-1">'
			html += '<input type="file" class="form-control" id="photo" name="attr_image_' + count + '[]" placeholder="Product Keywords" value="">'
			html += '<img src="{{  asset('assets/logo/goshop.png')}}" alt="..." class="product-img-2 my-2" style="height:70px; width:70px" id="imagepreview">'
			html += '</div>'
			html += '</span>'
			html += '</div>'
			html += '<div class="row my-2 p-1 ms-1">'
			html += '<input type="hidden" name="imageValue[]" value="' + count + '">'
			html += '<button type="button" id="addattrimage" class="btn btn-info px-5 m-1" onclick="addattrimg(\'' + new_attr_img + '\',\'' + count + '\')">Add Iamge</button>'
			html += '<button type="button" class="btn btn-danger px-5 m-1" onclick="removeattr(\'' + id + '\')">Remove Attribute</button>';
			html += '</div></div></span>';


			$('#addnewattribute').append(html);
		});
	</script>
<script>
	function abc(id, table) {
		var url = "{{ Route('admin.product.deleteAttribute') }}";

		$.ajax({
			url: url,
			type: 'POST',
			data: {
				'id': id,
				'table': table
			},
			headers: {
				'X-CSRF-TOKEN': '{{ csrf_token() }}'
			},
			success: function (response) {
				if (response.status === 200) {
					SnackBar({
						status: response.status,
						message: response.message,
						position: "tr"
					});
				} else {
					SnackBar({
						status: response.status || 'error',
						message: response.message || 'Something went wrong.',
						position: "tr"
					});
				}
			},
			error: function (xhr) {
				SnackBar({
					status: xhr.responseJSON?.status || 'error',
					message: xhr.responseJSON?.message || 'Something went wrong.',
					position: "tr"
				});
			}
		});
	}
</script>

<script>
	function removeattr(id, attrId = '', table = '') {
		$('#' + id).remove();

		if (table != '') {
			abc(attrId, table);
		}
	}
</script>

	<script>
		function removeattr(id, attrId='',table='') {

			$('#' + id + '').remove();

			if(table!=''){
				abc(attrId,table)
			}

		}
	</script>
	<script>
		var img_count = 9999
		function addattrimg(id, count) {
			var html = '';
			img_count++
			var img_id = 'addattrnewimg_' + img_count + '';
			html += '<span class="row col-sm-3 me-1" id="addattrnewimg_' + img_count + '"><div class="mb-1"><input type="file" class="form-control" id="photo" name="attr_image_' + count + '[]"placeholder="Product Keywords" value=""><img src="{{  asset('assets/logo/goshop.png')}}" alt="..." class="product-img-2 my-2" style="height:70px; width:70px"id="imagepreview"><button type="button" class="btn btn-danger px-2" onclick="removeattr(\'' + img_id + '\')">Remove</button></div></span>';
			$('#' + id + '').append(html);
		}
	</script>

@endsection