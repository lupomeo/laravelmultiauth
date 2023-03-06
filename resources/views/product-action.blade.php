                    <div  style="margin: 0 auto; text-align:center;">
                        <button class="btn btn-link text-dark"
                            data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <svg class="icon icon-xs" fill="currentColor" viewBox="0 0 20 20"
                                xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M6 10a2 2 0 11-4 0 2 2 0 014 0zM12 10a2 2 0 11-4 0 2 2 0 014 0zM16 12a2 2 0 100-4 2 2 0 000 4z">
                                </path>
                            </svg>
                            <span class="visually-hidden">Toggle Dropdown</span>
                        </button>
                        <div class="dropdown-menu dashboard-dropdown dropdown-menu-start mt-2 py-1">
                            <a class="dropdown-item d-flex align-items-center" href="javascript:void(0)" onClick="editFunc({{ $id }})">
                                <span class="fas fa-user-shield me-2"></span>
                                Modifica
                            </a>
                            <a class="dropdown-item text-danger d-flex align-items-center" href="javascript:void(0)" onClick="deleteFunc({{ $id }})">
                                <span class="fas fa-user-times me-2"></span>
                                Elimina
                            </a>
                        </div>
                    </div>

