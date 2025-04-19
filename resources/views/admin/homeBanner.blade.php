@extends('admin.layout')

@section('content')

    <div class="page-wrapper">
        <div class="page-content">
            <!--breadcrumb-->
            <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
                <div class="breadcrumb-title pe-3">HOME BANNER</div>
                <div class="ps-3">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0 p-0">
                            <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">Home Banner</li>
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
            <h6 class="mb-0 text-uppercase">Home Banner</h6>
            <hr />
            <div class="col my-2">
                <button type="button" class="btn btn-outline-primary px-5 radius-30" data-bs-toggle="modal"
                    data-bs-target="#exampleLargeModal" onclick="emptyModel()">Add New</button>
            </div>
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="example2" class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Text</th>
                                    <th>Link</th>
                                    <th>Image</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($items as $item )
                                <tr>
                                    <td>{{ $item->id }}</td>
                                    <td>{{ $item->text }}</td>
                                    <td>{{ $item->link }}</td>
                                    <td><img src="{{ asset($item->image ?? 'assets/logo/goshop.png') }}" class="align-self-end rounded-circle p-1 border" width="40" height="40" alt="..."></td>
                                    
                                    <td>
                                        <button type="button" class="btn btn-primary px-3" data-bs-toggle="modal"
                                            data-bs-target="#exampleLargeModal" onclick="Update({{ json_encode($item) }})" >Update</button>
                                        <button type="button" class="btn btn-danger px-3"
                                            onclick="Delete({{ json_encode($item) }}, 'home_banners')" >Delete</button>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>ID</th>
                                    <th>Text</th>
                                    <th>Link</th>
                                    <th>Image</th>
                                    <th>Action</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="exampleLargeModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Home Banner</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ Route('admin.home.banner.store') }}" id="formSubmit" >
                    @csrf
                <div class="row">
                    <div class="col-xl-9 mx-auto">

                        <div class="card border-top border-0 mt-4 border-4 border-primary">
                            <div class="card-body">
                                <hr />
                                <div class="row mb-3">
                                    <label for="text" class="col-sm-3 col-form-label">Enter Text</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" name="text" id="text"
                                            placeholder="Enter Text" value="">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="link" class="col-sm-3 col-form-label">Enter Link</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" name="link" id="link"
                                            placeholder="Enter Link" value="">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="photo" class="col-sm-3 col-form-label">Image</label>
                                    <div class="col-sm-9">
                                        <input type="file" class="form-control" name="image" id="photo" value="">
									<img src="{{  asset('assets/logo/goshop.png')}}" alt="..." class="card-img mt-3" style="height:300px;" id="imagepreview">
								
                                    </div>
                                </div>

                                <input type="hidden" class="form-control" id="id"
                                name="id" value="">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <span id="submitButton">
                        <input type="submit" class="btn btn-primary">
                    </spa>
                </div>
                </form>
            </div>
        </div>
    </div>
@endsection