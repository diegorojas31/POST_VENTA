@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')


    <div style="display: flex; align-items: center;">
        <h1 style="margin-left: 10px;">Todas Las Ventas</h1>
    </div>
@stop

@section('content')



    <header class="invoice-header">
        <div class="d-flex align-items-center">
            <a class="invoiceapp-title dropdown-toggle link-dark" data-bs-toggle="dropdown" href="#" role="button"
                aria-haspopup="true" aria-expanded="false">
                <h1>All Ventas</h1>

            </a>
            <div class="dropdown-menu">
                <a class="dropdown-item" href="#"><span class="feather-icon dropdown-icon"><i
                            data-feather="users"></i></span><span>All Invoices</span></a>
                <a class="dropdown-item" href="#"><span class="feather-icon dropdown-icon"><i
                            data-feather="star"></i></span><span>Sent</span></a>
                <a class="dropdown-item" href="#"><span class="feather-icon dropdown-icon"><i
                            data-feather="archive"></i></span><span>Archive</span></a>
                <a class="dropdown-item" href="#"><span class="feather-icon dropdown-icon"><i
                            data-feather="edit"></i></span><span>Pending</span></a>
                <a class="dropdown-item" href="#"><span class="feather-icon dropdown-icon"><i
                            data-feather="trash-2"></i></span><span>Deleted</span></a>
            </div>


        </div>
        <button type="button" class="btn btn-primary btn-sm">
            Registrar Venta
        </button>

    </header>

    <div data-simplebar class="nicescroll-bar">
        <div class="invoice-list-view">
            <table id="datable_1" class="table nowrap w-100 mb-5">
                <thead>
                    <tr>
                        <th><span class="form-check mb-0">
                                <input type="checkbox" class="form-check-input check-select-all" id="customCheck1">
                                <label class="form-check-label" for="customCheck1"></label>
                            </span></th>
                        <th>Invoice #</th>
                        <th>Date</th>
                        <th>Reciplent</th>
                        <th>Status</th>
                        <th>Activity</th>
                        <th>Amount</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td></td>
                        <td><a href="#" class="table-link-text link-high-em">11234</a></td>
                        <td>13 Jan, 2020</td>
                        <td>
                            <div class="text-dark">Patrik Schelton</div>
                            <div class="fs-7">morgan@jampack.com</div>
                        </td>
                        <td><span class="badge badge-light">draft</span></td>
                        <td>-</td>
                        <td>$ 2,300.00 USD</td>
                        <td>
                            <div class="d-flex align-items-center">
                                <div class="btn-group selectable-split-dropdown">
                                    <button type="button" class="btn btn-outline-light btn-dyn-text w-100p">Edit</button>
                                    <button type="button"
                                        class="btn btn-outline-light dropdown-toggle dropdown-toggle-split me-3"
                                        data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <span class="sr-only">Toggle Dropdown</span>
                                    </button>
                                    <div class="dropdown-menu dropdown-menu-end">
                                        <a class="dropdown-item" href="#">Remind</a>
                                        <a class="dropdown-item" href="#">Sent</a>
                                        <a class="dropdown-item" href="#">Active</a>
                                        <div class="dropdown-divider"></div>
                                        <a class="dropdown-item" href="#">Edit</a>
                                    </div>
                                </div>
                                <div class="d-flex">
                                    <a class="btn btn-icon btn-flush-dark btn-rounded flush-soft-hover"
                                        data-bs-toggle="tooltip" data-bs-placement="top" title=""
                                        data-bs-original-title="Archive" href="#"><span class="btn-icon-wrap"><span
                                                class="feather-icon"><i data-feather="archive"></i></span></span></a>
                                    <a class="btn btn-icon btn-flush-dark btn-rounded flush-soft-hover"
                                        data-bs-toggle="tooltip" data-bs-placement="top" title=""
                                        data-bs-original-title="Edit" href="contact-details.html"><span
                                            class="btn-icon-wrap"><span class="feather-icon"><i
                                                    data-feather="edit"></i></span></span></a>
                                    <a class="btn btn-icon btn-flush-dark btn-rounded flush-soft-hover del-button"
                                        data-bs-toggle="tooltip" data-bs-placement="top" title=""
                                        data-bs-original-title="Delete" href="#"><span class="btn-icon-wrap"><span
                                                class="feather-icon"><i data-feather="trash-2"></i></span></span></a>
                                </div>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td></td>
                        <td><a href="#" class="table-link-text link-high-em">11235</a></td>
                        <td>13 Jan, 2020</td>
                        <td>
                            <div class="text-dark">Huma Therman</div>
                            <div class="fs-7">huma@clariesup.au</div>
                        </td>
                        <td>
                            <span class="badge badge-danger">Unpaid</span>
                            <div class="fs-8 mt-1">Due 25 Apr 2020</div>
                        </td>
                        <td>Sent</td>
                        <td>$ 780.00 USD</td>
                        <td>
                            <div class="d-flex align-items-center">
                                <div class="btn-group selectable-split-dropdown">
                                    <button type="button"
                                        class="btn btn-outline-light btn-dyn-text w-100p">Remind</button>
                                    <button type="button"
                                        class="btn btn-outline-light dropdown-toggle dropdown-toggle-split me-3"
                                        data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <span class="sr-only">Toggle Dropdown</span>
                                    </button>
                                    <div class="dropdown-menu dropdown-menu-end">
                                        <a class="dropdown-item" href="#">Remind</a>
                                        <a class="dropdown-item" href="#">Sent</a>
                                        <a class="dropdown-item" href="#">Active</a>
                                        <div class="dropdown-divider"></div>
                                        <a class="dropdown-item" href="#">Edit</a>
                                    </div>
                                </div>
                                <div class="d-flex">
                                    <a class="btn btn-icon btn-flush-dark btn-rounded flush-soft-hover"
                                        data-bs-toggle="tooltip" data-bs-placement="top" title=""
                                        data-bs-original-title="Archive" href="#"><span class="btn-icon-wrap"><span
                                                class="feather-icon"><i data-feather="archive"></i></span></span></a>
                                    <a class="btn btn-icon btn-flush-dark btn-rounded flush-soft-hover"
                                        data-bs-toggle="tooltip" data-bs-placement="top" title=""
                                        data-bs-original-title="Edit" href="contact-details.html"><span
                                            class="btn-icon-wrap"><span class="feather-icon"><i
                                                    data-feather="edit"></i></span></span></a>
                                    <a class="btn btn-icon btn-flush-dark btn-rounded flush-soft-hover del-button"
                                        data-bs-toggle="tooltip" data-bs-placement="top" title=""
                                        data-bs-original-title="Delete" href="#"><span class="btn-icon-wrap"><span
                                                class="feather-icon"><i data-feather="trash-2"></i></span></span></a>
                                </div>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td></td>
                        <td><a href="#" class="table-link-text link-high-em">11236</a></td>
                        <td>13 Jan, 2020</td>
                        <td>
                            <div class="text-dark">Charlie Chaplin</div>
                            <div class="fs-7">charlie@leernoca.monster</div>
                        </td>
                        <td>
                            <span class="badge badge-primary">Paid</span>
                        </td>
                        <td>Done</td>
                        <td>$ 567.00 USD</td>
                        <td>
                            <div class="d-flex align-items-center">
                                <div class="btn-group selectable-split-dropdown">
                                    <button type="button"
                                        class="btn btn-outline-light btn-dyn-text w-100p">Active</button>
                                    <button type="button"
                                        class="btn btn-outline-light dropdown-toggle dropdown-toggle-split me-3"
                                        data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <span class="sr-only">Toggle Dropdown</span>
                                    </button>
                                    <div class="dropdown-menu dropdown-menu-end">
                                        <a class="dropdown-item" href="#">Remind</a>
                                        <a class="dropdown-item" href="#">Sent</a>
                                        <a class="dropdown-item" href="#">Active</a>
                                        <div class="dropdown-divider"></div>
                                        <a class="dropdown-item" href="#">Edit</a>
                                    </div>
                                </div>
                                <div class="d-flex">
                                    <a class="btn btn-icon btn-flush-dark btn-rounded flush-soft-hover"
                                        data-bs-toggle="tooltip" data-bs-placement="top" title=""
                                        data-bs-original-title="Archive" href="#"><span class="btn-icon-wrap"><span
                                                class="feather-icon"><i data-feather="archive"></i></span></span></a>
                                    <a class="btn btn-icon btn-flush-dark btn-rounded flush-soft-hover"
                                        data-bs-toggle="tooltip" data-bs-placement="top" title=""
                                        data-bs-original-title="Edit" href="contact-details.html"><span
                                            class="btn-icon-wrap"><span class="feather-icon"><i
                                                    data-feather="edit"></i></span></span></a>
                                    <a class="btn btn-icon btn-flush-dark btn-rounded flush-soft-hover del-button"
                                        data-bs-toggle="tooltip" data-bs-placement="top" title=""
                                        data-bs-original-title="Delete" href="#"><span class="btn-icon-wrap"><span
                                                class="feather-icon"><i data-feather="trash-2"></i></span></span></a>
                                </div>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td></td>
                        <td><a href="#" class="table-link-text link-high-em">11237</a></td>
                        <td>13 Jan, 2020</td>
                        <td>
                            <div class="text-dark">Winston Churchil</div>
                            <div class="fs-7">winston@worthniza.ga</div>
                        </td>
                        <td>
                            <span class="badge badge-danger">Unpaid</span>
                            <div class="fs-8 mt-1">Due 12 Sep 2020</div>
                        </td>
                        <td>-</td>
                        <td>$ 1,500.00 USD</td>
                        <td>
                            <div class="d-flex align-items-center">
                                <div class="btn-group selectable-split-dropdown">
                                    <button type="button" class="btn btn-outline-light btn-dyn-text w-100p">Sent</button>
                                    <button type="button"
                                        class="btn btn-outline-light dropdown-toggle dropdown-toggle-split me-3"
                                        data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <span class="sr-only">Toggle Dropdown</span>
                                    </button>
                                    <div class="dropdown-menu dropdown-menu-end">
                                        <a class="dropdown-item" href="#">Remind</a>
                                        <a class="dropdown-item" href="#">Sent</a>
                                        <a class="dropdown-item" href="#">Active</a>
                                        <div class="dropdown-divider"></div>
                                        <a class="dropdown-item" href="#">Edit</a>
                                    </div>
                                </div>
                                <div class="d-flex">
                                    <a class="btn btn-icon btn-flush-dark btn-rounded flush-soft-hover"
                                        data-bs-toggle="tooltip" data-bs-placement="top" title=""
                                        data-bs-original-title="Archive" href="#"><span class="btn-icon-wrap"><span
                                                class="feather-icon"><i data-feather="archive"></i></span></span></a>
                                    <a class="btn btn-icon btn-flush-dark btn-rounded flush-soft-hover"
                                        data-bs-toggle="tooltip" data-bs-placement="top" title=""
                                        data-bs-original-title="Edit" href="contact-details.html"><span
                                            class="btn-icon-wrap"><span class="feather-icon"><i
                                                    data-feather="edit"></i></span></span></a>
                                    <a class="btn btn-icon btn-flush-dark btn-rounded flush-soft-hover del-button"
                                        data-bs-toggle="tooltip" data-bs-placement="top" title=""
                                        data-bs-original-title="Delete" href="#"><span class="btn-icon-wrap"><span
                                                class="feather-icon"><i data-feather="trash-2"></i></span></span></a>
                                </div>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td></td>
                        <td><a href="#" class="table-link-text link-high-em">11238</a></td>
                        <td>13 Jan, 2020</td>
                        <td>
                            <div class="text-dark">Jaquiline Joker</div>
                            <div class="fs-7">jaquljoker@jampack.com</div>
                        </td>
                        <td>
                            <span class="badge badge-danger">Unpaid</span>
                            <div class="fs-8 mt-1">Due 18 Oct 2020</div>
                        </td>
                        <td>Sent</td>
                        <td>$ 900.00 USD</td>
                        <td>
                            <div class="d-flex align-items-center">
                                <div class="btn-group selectable-split-dropdown">
                                    <button type="button"
                                        class="btn btn-outline-light btn-dyn-text w-100p">Remind</button>
                                    <button type="button"
                                        class="btn btn-outline-light dropdown-toggle dropdown-toggle-split me-3"
                                        data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <span class="sr-only">Toggle Dropdown</span>
                                    </button>
                                    <div class="dropdown-menu dropdown-menu-end">
                                        <a class="dropdown-item" href="#">Remind</a>
                                        <a class="dropdown-item" href="#">Sent</a>
                                        <a class="dropdown-item" href="#">Active</a>
                                        <div class="dropdown-divider"></div>
                                        <a class="dropdown-item" href="#">Edit</a>
                                    </div>
                                </div>
                                <div class="d-flex">
                                    <a class="btn btn-icon btn-flush-dark btn-rounded flush-soft-hover"
                                        data-bs-toggle="tooltip" data-bs-placement="top" title=""
                                        data-bs-original-title="Archive" href="#"><span class="btn-icon-wrap"><span
                                                class="feather-icon"><i data-feather="archive"></i></span></span></a>
                                    <a class="btn btn-icon btn-flush-dark btn-rounded flush-soft-hover"
                                        data-bs-toggle="tooltip" data-bs-placement="top" title=""
                                        data-bs-original-title="Edit" href="contact-details.html"><span
                                            class="btn-icon-wrap"><span class="feather-icon"><i
                                                    data-feather="edit"></i></span></span></a>
                                    <a class="btn btn-icon btn-flush-dark btn-rounded flush-soft-hover del-button"
                                        data-bs-toggle="tooltip" data-bs-placement="top" title=""
                                        data-bs-original-title="Delete" href="#"><span class="btn-icon-wrap"><span
                                                class="feather-icon"><i data-feather="trash-2"></i></span></span></a>
                                </div>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td></td>
                        <td><a href="#" class="table-link-text link-high-em">11239</a></td>
                        <td>3 July, 2020</td>
                        <td>
                            <div class="text-dark">Tom Cruz</div>
                            <div class="fs-7">tomcz@jampack.com</div>
                        </td>
                        <td>
                            <span class="badge badge-primary">Paid</span>
                        </td>
                        <td>Done</td>
                        <td>$ 4,750.00 USD</td>
                        <td>
                            <div class="d-flex align-items-center">
                                <div class="btn-group selectable-split-dropdown">
                                    <button type="button"
                                        class="btn btn-outline-light btn-dyn-text w-100p">Active</button>
                                    <button type="button"
                                        class="btn btn-outline-light dropdown-toggle dropdown-toggle-split me-3"
                                        data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <span class="sr-only">Toggle Dropdown</span>
                                    </button>
                                    <div class="dropdown-menu dropdown-menu-end">
                                        <a class="dropdown-item" href="#">Remind</a>
                                        <a class="dropdown-item" href="#">Sent</a>
                                        <a class="dropdown-item" href="#">Active</a>
                                        <div class="dropdown-divider"></div>
                                        <a class="dropdown-item" href="#">Edit</a>
                                    </div>
                                </div>
                                <div class="d-flex">
                                    <a class="btn btn-icon btn-flush-dark btn-rounded flush-soft-hover"
                                        data-bs-toggle="tooltip" data-bs-placement="top" title=""
                                        data-bs-original-title="Archive" href="#"><span class="btn-icon-wrap"><span
                                                class="feather-icon"><i data-feather="archive"></i></span></span></a>
                                    <a class="btn btn-icon btn-flush-dark btn-rounded flush-soft-hover"
                                        data-bs-toggle="tooltip" data-bs-placement="top" title=""
                                        data-bs-original-title="Edit" href="contact-details.html"><span
                                            class="btn-icon-wrap"><span class="feather-icon"><i
                                                    data-feather="edit"></i></span></span></a>
                                    <a class="btn btn-icon btn-flush-dark btn-rounded flush-soft-hover del-button"
                                        data-bs-toggle="tooltip" data-bs-placement="top" title=""
                                        data-bs-original-title="Delete" href="#"><span class="btn-icon-wrap"><span
                                                class="feather-icon"><i data-feather="trash-2"></i></span></span></a>
                                </div>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td></td>
                        <td><a href="#" class="table-link-text link-high-em">11240</a></td>
                        <td>24 Jun, 2019</td>
                        <td>
                            <div class="text-dark">Danial Craig</div>
                            <div class="fs-7">danialc@jampack.com</div>
                        </td>
                        <td>
                            <span class="badge badge-primary">Paid</span>
                            <div class="fs-8 mt-1">Due 25 Apr 2020</div>
                        </td>
                        <td>Done</td>
                        <td>$ 2,300.00 USD</td>
                        <td>
                            <div class="d-flex align-items-center">
                                <div class="btn-group selectable-split-dropdown">
                                    <button type="button"
                                        class="btn btn-outline-light btn-dyn-text w-100p">Active</button>
                                    <button type="button"
                                        class="btn btn-outline-light dropdown-toggle dropdown-toggle-split me-3"
                                        data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <span class="sr-only">Toggle Dropdown</span>
                                    </button>
                                    <div class="dropdown-menu dropdown-menu-end">
                                        <a class="dropdown-item" href="#">Remind</a>
                                        <a class="dropdown-item" href="#">Sent</a>
                                        <a class="dropdown-item" href="#">Active</a>
                                        <div class="dropdown-divider"></div>
                                        <a class="dropdown-item" href="#">Edit</a>
                                    </div>
                                </div>
                                <div class="d-flex">
                                    <a class="btn btn-icon btn-flush-dark btn-rounded flush-soft-hover"
                                        data-bs-toggle="tooltip" data-bs-placement="top" title=""
                                        data-bs-original-title="Archive" href="#"><span class="btn-icon-wrap"><span
                                                class="feather-icon"><i data-feather="archive"></i></span></span></a>
                                    <a class="btn btn-icon btn-flush-dark btn-rounded flush-soft-hover"
                                        data-bs-toggle="tooltip" data-bs-placement="top" title=""
                                        data-bs-original-title="Edit" href="contact-details.html"><span
                                            class="btn-icon-wrap"><span class="feather-icon"><i
                                                    data-feather="edit"></i></span></span></a>
                                    <a class="btn btn-icon btn-flush-dark btn-rounded flush-soft-hover del-button"
                                        data-bs-toggle="tooltip" data-bs-placement="top" title=""
                                        data-bs-original-title="Delete" href="#"><span class="btn-icon-wrap"><span
                                                class="feather-icon"><i data-feather="trash-2"></i></span></span></a>
                                </div>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td></td>
                        <td><a href="#" class="table-link-text link-high-em">11241</a></td>
                        <td>24 Jun, 2019</td>
                        <td>
                            <div class="text-dark">Katharine Jones</div>
                            <div class="fs-7">joneskath@jampack.com</div>
                        </td>
                        <td>
                            <span class="badge badge-primary">Paid</span>
                        </td>
                        <td>Done</td>
                        <td>$ 7,650.00 USD</td>
                        <td>
                            <div class="d-flex align-items-center">
                                <div class="btn-group selectable-split-dropdown">
                                    <button type="button"
                                        class="btn btn-outline-light btn-dyn-text w-100p">Active</button>
                                    <button type="button"
                                        class="btn btn-outline-light dropdown-toggle dropdown-toggle-split me-3"
                                        data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <span class="sr-only">Toggle Dropdown</span>
                                    </button>
                                    <div class="dropdown-menu dropdown-menu-end">
                                        <a class="dropdown-item" href="#">Remind</a>
                                        <a class="dropdown-item" href="#">Sent</a>
                                        <a class="dropdown-item" href="#">Active</a>
                                        <div class="dropdown-divider"></div>
                                        <a class="dropdown-item" href="#">Edit</a>
                                    </div>
                                </div>
                                <div class="d-flex">
                                    <a class="btn btn-icon btn-flush-dark btn-rounded flush-soft-hover"
                                        data-bs-toggle="tooltip" data-bs-placement="top" title=""
                                        data-bs-original-title="Archive" href="#"><span class="btn-icon-wrap"><span
                                                class="feather-icon"><i data-feather="archive"></i></span></span></a>
                                    <a class="btn btn-icon btn-flush-dark btn-rounded flush-soft-hover"
                                        data-bs-toggle="tooltip" data-bs-placement="top" title=""
                                        data-bs-original-title="Edit" href="contact-details.html"><span
                                            class="btn-icon-wrap"><span class="feather-icon"><i
                                                    data-feather="edit"></i></span></span></a>
                                    <a class="btn btn-icon btn-flush-dark btn-rounded flush-soft-hover del-button"
                                        data-bs-toggle="tooltip" data-bs-placement="top" title=""
                                        data-bs-original-title="Delete" href="#"><span class="btn-icon-wrap"><span
                                                class="feather-icon"><i data-feather="trash-2"></i></span></span></a>
                                </div>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td></td>
                        <td><a href="#" class="table-link-text link-high-em">11242</a></td>
                        <td>24 Jun, 2019</td>
                        <td>
                            <div class="text-dark">Hence Work</div>
                            <div class="fs-7">contact@hencework.com</div>
                        </td>
                        <td>
                            <span class="badge badge-light">Draft</span>
                        </td>
                        <td>-</td>
                        <td>$ 4,500.00 USD</td>
                        <td>
                            <div class="d-flex align-items-center">
                                <div class="btn-group selectable-split-dropdown">
                                    <button type="button" class="btn btn-outline-light btn-dyn-text w-100p">Sent</button>
                                    <button type="button"
                                        class="btn btn-outline-light dropdown-toggle dropdown-toggle-split me-3"
                                        data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <span class="sr-only">Toggle Dropdown</span>
                                    </button>
                                    <div class="dropdown-menu dropdown-menu-end">
                                        <a class="dropdown-item" href="#">Remind</a>
                                        <a class="dropdown-item" href="#">Sent</a>
                                        <a class="dropdown-item" href="#">Active</a>
                                        <div class="dropdown-divider"></div>
                                        <a class="dropdown-item" href="#">Edit</a>
                                    </div>
                                </div>
                                <div class="d-flex">
                                    <a class="btn btn-icon btn-flush-dark btn-rounded flush-soft-hover"
                                        data-bs-toggle="tooltip" data-bs-placement="top" title=""
                                        data-bs-original-title="Archive" href="#"><span class="btn-icon-wrap"><span
                                                class="feather-icon"><i data-feather="archive"></i></span></span></a>
                                    <a class="btn btn-icon btn-flush-dark btn-rounded flush-soft-hover"
                                        data-bs-toggle="tooltip" data-bs-placement="top" title=""
                                        data-bs-original-title="Edit" href="contact-details.html"><span
                                            class="btn-icon-wrap"><span class="feather-icon"><i
                                                    data-feather="edit"></i></span></span></a>
                                    <a class="btn btn-icon btn-flush-dark btn-rounded flush-soft-hover del-button"
                                        data-bs-toggle="tooltip" data-bs-placement="top" title=""
                                        data-bs-original-title="Delete" href="#"><span class="btn-icon-wrap"><span
                                                class="feather-icon"><i data-feather="trash-2"></i></span></span></a>
                                </div>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>

        </div>

    </div>














    <!----------- MODAL PARA  CERRAR VENTA-->
    <div class="modal" tabindex="-1" id="miModal" style="display: none;">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Monto Final</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Modal body text goes here.</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <a href="{{ route('cerrar_caja', ['cajaventa_id' => $caja->id]) }}" class="btn btn-primary">Terminar
                        Ventas</a>
                </div>
            </div>
        </div>
    </div>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
    <!-- Data Table CSS -->
    <link href="{{ asset('Template/vendors/datatables.net-bs5/css/dataTables.bootstrap5.min.css') }}" rel="stylesheet"
        type="text/css" />
    <link href="{{ asset('Template/vendors/datatables.net-responsive-bs5/css/responsive.bootstrap5.min.css') }}"
        rel="stylesheet" type="text/css" />

    <!-- CSS -->
    <link href="{{ asset('Template/dist/css/style.css') }}" rel="stylesheet" type="text/css">
@stop

@section('js')
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

    <!-- Data Table JS -->
    <script src="{{ asset('Template/vendors/datatables.net/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('Template/vendors/datatables.net-bs5/js/dataTables.bootstrap5.min.js') }}"></script>
    <script src="{{ asset('Template/vendors/datatables.net-select/js/dataTables.select.min.js') }}"></script>

    <!-- Init JS -->
    <script src="{{ asset('Template/dist/js/init.js') }}"></script>
    <script src="{{ asset('Template/dist/js/invoice-data.js') }}"></script>
    <script src="{{ asset('Template/dist/js/chips-init.js') }}"></script>
    <script>
        $('.cerrar_caja').click(function() {
            console.log('le di click');
            var caja_id = $('#caja_id').val();

            $.ajax({
                url: '/allventas_caja/' + caja_id,
                type: 'GET',
                success: function(data) {
                    if (data) {

                    } else {
                        alert('No se pueden cerrar las ventas de la caja en este momento.');
                    }
                }
            });
        });
    </script>
@stop
