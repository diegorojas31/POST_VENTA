@extends('adminlte::page')

@section('title', 'All users')
<link rel="icon" href="{{ asset('vendor/adminlte/dist/img/LOGOPOSTVENTA.jpg') }}" type="image/x-icon" style="border-radius: 50%;">


@section('content_header')
<h2>TODOS LOS USUARIOS</h2>
@stop

@section('content')

	
				<div class="contactapp-wrap">

					<div class="contactapp-content">
						<div class="contactapp-detail-wrap">
							<header class="contact-header">
								<div class="d-flex align-items-center">
									<div class="dropdown">
										<a class="contactapp-title dropdown-toggle link-dark" data-bs-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
											<h1>Empleados</h1>
										</a>
			
									</div>
									<div class="dropdown ms-3">
										<a href="{{ route('abrir_crear_users') }}" class="btn btn-sm btn-outline-secondary flex-shrink-0 " >Create New</a>
				
									</div>
								</div>

								
							</header>
							<div class="contact-body">
								<div data-simplebar class="nicescroll-bar">
                                    

									<div class="contact-list-view">
										<table id="datable_1" class="table nowrap w-100 mb-5">
											<thead>
												<tr>
													<th><span class="form-check mb-0">
														<input type="checkbox" class="form-check-input check-select-all" id="customCheck1">
														<label class="form-check-label" for="customCheck1"></label>
													</span></th>
													<th>Nombre</th>
													<th>Correo</th>
													<th>Celular</th>
													
													<th>Rol</th>
													<th>Actions</th>
												</tr>
											</thead>
											<tbody>
                                                @foreach($empleados as $empleado)
                                                <tr>
                                                    <td>
														<div class="d-flex align-items-center">
															<span class="contact-star marked"><span class="feather-icon"><i data-feather="star"></i></span></span>
														</div>
													</td>
                                                    <td>
														<div class="media align-items-center">
									
															<div class="media-body">
																<span class="d-block text-high-em">{{ $empleado['name'] }}</span> 
															</div>
														</div>
													</td>
                                                    <td class="text-truncate">{{ $empleado['email'] }}</td>
                                                    <td>{{ $empleado['celular_empleado'] }}</td>
                                                    
													<td><span class="badge badge-soft-violet my-1  me-2">{{ $empleado['name_rol'] }}</span></td>
                                                    <td>
														<div class="d-flex align-items-center">
															<div class="d-flex">

																<a class="btn btn-icon btn-flush-dark btn-rounded flush-soft-hover del-button" data-bs-toggle="tooltip" data-placement="top" title="" data-bs-original-title="Delete" href="{{ route('user_delete',['id'=>$empleado->usuario_id]) }}"><span class="icon"><span class="feather-icon"><i data-feather="trash"></i></span></span></a>
															</div>
															<div class="dropdown">
																<button class="btn btn-icon btn-flush-dark btn-rounded flush-soft-hover dropdown-toggle no-caret" aria-expanded="false" data-bs-toggle="dropdown"><span class="icon"><span class="feather-icon"><i data-feather="more-vertical"></i></span></span></button>
																<div class="dropdown-menu dropdown-menu-end">
																	<span class="d-block text-high-em">Cambiar Rol</span>
																	<a class="dropdown-item" href="{{ route('update_rol',['id'=>$empleado->usuario_id,'nuevo_rol'=>1]) }}"><span class="feather-icon dropdown-icon"><i data-feather="edit"></i></span><span>Master</span></a>
																	<a class="dropdown-item" href="{{ route('update_rol',['id'=>$empleado->usuario_id,'nuevo_rol'=>2]) }}"><span class="feather-icon dropdown-icon"><i data-feather="trash-2"></i></span><span>Administrador</span></a>
																	<a class="dropdown-item" href="{{ route('update_rol',['id'=>$empleado->usuario_id,'nuevo_rol'=>3]) }}"><span class="feather-icon dropdown-icon"><i data-feather="copy"></i></span><span>Empleado</span></a>
											
																</div>
															</div>
														</div>
													</td>
                                                </tr>
                                            @endforeach

	
											</tbody>
										</table>
									</div>
								</div>
							</div>
						</div>
						<!-- Edit Info -->
						<div id="add_new_contact" class="modal fade add-new-contact" tabindex="-1" role="dialog" aria-hidden="true">
							<div class="modal-dialog modal-dialog-centered modal-lg" role="document">
								<div class="modal-content">
									<div class="modal-body">
										<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
											<span aria-hidden="true">×</span>
										</button>
										<h5 class="mb-5">Create New Conatct</h5>
										<form>
											<div class="row gx-3">
												<div class="col-sm-2 form-group">
													<div class="dropify-square">
														<input type="file"  class="dropify-1"/>
													</div>
												</div>
												<div class="col-sm-10 form-group">
													<textarea class="form-control mnh-100p" rows="4" placeholder="Add Biography"></textarea>
												</div>
											</div>
											<div class="title title-xs title-wth-divider text-primary text-uppercase my-4"><span>Basic Info</span></div>
											<div class="row gx-3">
												<div class="col-sm-4">
													<div class="form-group">
														<label class="form-label">First Name</label>
														<input class="form-control" type="text"/>
													</div>
												</div>
												<div class="col-sm-4">
													<div class="form-group">
														<label class="form-label">Middle Name</label>
														<input class="form-control" type="text"/>
													</div>
												</div>
												<div class="col-sm-4">
													<div class="form-group">
														<label class="form-label">Last Name</label>
														<input class="form-control" type="text"/>
													</div>
												</div>
											</div>
											<div class="row gx-3">
												<div class="col-sm-6">
													<div class="form-group">
														<label class="form-label">Email ID</label>
														<input class="form-control" type="text"/>
													</div>
												</div>
												<div class="col-sm-6">
													<div class="form-group">
														<label class="form-label">Phone</label>
														<input class="form-control" type="text"/>
													</div>
												</div>
											</div>
											<div class="row gx-3">
												<div class="col-sm-4">
													<div class="form-group">
														<label class="form-label">City</label>
														<select class="form-select">
															<option selected="">--</option>
															<option value="1">One</option>
															<option value="2">Two</option>
															<option value="3">Three</option>
														</select>
													</div>
												</div>
												<div class="col-sm-4">
													<div class="form-group">
														<label class="form-label">State</label>
														<select class="form-select">
															<option selected="">--</option>
															<option value="1">One</option>
															<option value="2">Two</option>
															<option value="3">Three</option>
														</select>
													</div>
												</div>
												<div class="col-sm-4">
													<div class="form-group">
														<label class="form-label">Country</label>
														<select class="form-select">
															<option selected="">--</option>
															<option value="1">One</option>
															<option value="2">Two</option>
															<option value="3">Three</option>
														</select>
													</div>
												</div>
											</div>
											<div class="title title-xs title-wth-divider text-primary text-uppercase my-4"><span>Company Info</span></div>
											<div class="row gx-3">
												<div class="col-sm-6">
													<div class="form-group">
														<label class="form-label">Company Name</label>
														<input class="form-control" type="text"/>
													</div>
												</div>
												<div class="col-sm-6">
													<div class="form-group">
														<label class="form-label">Designation</label>
														<input class="form-control" type="text"/>
													</div>
												</div>
												<div class="col-sm-6">
													<div class="form-group">
														<label class="form-label">Website</label>
														<input class="form-control" type="text"/>
													</div>
												</div>
												<div class="col-sm-6">
													<div class="form-group">
														<label class="form-label">Work Phone</label>
														<input class="form-control" type="text"/>
													</div>
												</div>
											</div>
											<div class="title title-xs title-wth-divider text-primary text-uppercase my-4"><span>Additional Info</span></div>
											<div class="row gx-3">
												<div class="col-sm-12">
													<div class="form-group">
														<label class="form-label">Tags</label>
														<select id="input_tags_2" class="form-control" multiple="multiple">
														</select>
														<small class="form-text text-muted">
														   You can add upto 4 tags per contact
														</small>
													</div>
												</div>
											</div>
											<div class="row gx-3">
												<div class="col-sm-6">
													<div class="form-group">
														<input class="form-control" type="text" placeholder="Facebook"/>
													</div>
												</div>
												<div class="col-sm-6">
													<div class="form-group">
														<input class="form-control" type="text" placeholder="Twitter"/>
													</div>
												</div>
												<div class="col-sm-6">
													<div class="form-group">
														<input class="form-control" type="text" placeholder="LinkedIn"/>
													</div>
												</div>
												<div class="col-sm-6">
													<div class="form-group">
														<input class="form-control" type="text" placeholder="Gmail"/>
													</div>
												</div>
											</div>
										</form>
									</div>
									<div class="modal-footer align-items-center">
										<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Discard</button>
										<button type="button" class="btn btn-primary" data-bs-dismiss="modal">Create Contact</button>
									</div>
								</div>
							</div>
						</div>
						<!-- /Edit Info -->
						
						<!-- Add Label -->
						<div id="add_new_label" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
							<div class="modal-dialog modal-dialog-centered modal-sm" role="document">
								<div class="modal-content">
									<div class="modal-body">
										<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
											<span aria-hidden="true">×</span>
										</button>
										<h6 class="text-uppercase fw-bold mb-3">Add Label</h6>
										<form>
											<div class="row gx-3">
												<div class="col-sm-12">
													<div class="form-group">
														<input class="form-control" type="text" placeholder="Label Name"/>
													</div>
												</div>
											</div>
											<button type="button" class="btn btn-primary float-end" data-bs-dismiss="modal">Add</button>
										</form>
									</div>
								</div>
							</div>
						</div>
						<!-- Add Label -->
						
						<!-- Add Tag -->
						<div id="add_new_tag" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
							<div class="modal-dialog modal-dialog-centered modal-sm" role="document">
								<div class="modal-content">
									<div class="modal-body">
										<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
											<span aria-hidden="true">×</span>
										</button>
										<h6 class="text-uppercase fw-bold mb-3">Add Tag</h6>
										<form>
											<div class="row gx-3">
												<div class="col-sm-12">
													<div class="form-group">
														<select id="input_tags_3" class="form-control" multiple="multiple">
															<option selected="selected">Collaborator</option>
															<option selected="selected">Designer</option>
															<option selected="selected">React Developer</option>
															<option selected="selected">Promotion</option>
															<option selected="selected">Advertisement</option>
														</select>
													</div>
												</div>
											</div>
											<button type="button" class="btn btn-primary float-end" data-bs-dismiss="modal">Add</button>
										</form>
									</div>
								</div>
							</div>
						</div>
						<!-- Add Tag -->
					</div>
				</div>
			
			

@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
    <!-- Bootstrap Dropify CSS -->
    <link href="{{ asset('Template/vendors/dropify/dist/css/dropify.min.css') }}" rel="stylesheet" type="text/css" />

    <!-- select2 CSS -->
    <link href="{{ asset('Template/vendors/select2/dist/css/select2.min.css') }}" rel="stylesheet" type="text/css" />

    <!-- CSS -->
    <link href="{{ asset('Template/dist/css/style.css') }}" rel="stylesheet" type="text/css">
@stop

@section('js')
    <script>
        console.log('Hi!');
    </script>
      <!-- jQuery -->
      <script src="{{ asset('Template/vendors/jquery/dist/jquery.min.js') }}"></script>

      <!-- Bootstrap Core JS -->
      <script src="{{ asset('Template/vendors/bootstrap/dist/js/bootstrap.bundle.min.js') }}"></script>
  
      <!-- FeatherIcons JS -->
      <script src="{{ asset('Template/dist/js/feather.min.js') }}"></script>
  
      <!-- Fancy Dropdown JS -->
      <script src="{{ asset('Template/dist/js/dropdown-bootstrap-extended.js') }}"></script>
  
      <!-- Simplebar JS -->
      <script src="{{ asset('Template/vendors/simplebar/dist/simplebar.min.js') }}"></script>
  
      <!-- Select2 JS -->
      <script src="{{ asset('Template/vendors/select2/dist/js/select2.full.min.js') }}"></script>
      <script src="dist/js/select2-data.js"></script>
  
      <!-- Dropify JS -->
      <script src="{{ asset('Template/vendors/dropify/dist/js/dropify.min.js') }}"></script>
      <script src="{{ asset('Template/dist/js/dropify-data.js') }}"></script>
  
      <!-- Init JS -->
      <script src="{{ asset('Template/dist/js/init.js') }}"></script>
      <script src="{{ asset('Template/dist/js/contact-data.js') }}"></script>
      <script src="{{ asset('Template/dist/js/chips-init.js') }}"></script>

@stop
