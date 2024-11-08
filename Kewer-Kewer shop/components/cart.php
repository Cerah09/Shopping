<div class="<?=isset($dropdownClass) ? $dropdownClass : 'dropdown';?>">
    <a href="#" class="dropdown-toggle text-decoration-none text-dark" id="cartDropdown" role="button"
        data-bs-toggle="dropdown" aria-expanded="false">
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24"
            stroke-width="1.5" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round"
                d="M2.25 3h1.386c.51 0 .955.343 1.087.835l.383 1.437M7.5 14.25a3 3 0 0 0-3 3h15.75m-12.75-3h11.218c1.121-2.3 2.1-4.684 2.924-7.138a60.114 60.114 0 0 0-16.536-1.84M7.5 14.25 5.106 5.272M6 20.25a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0Zm12.75 0a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0Z" />
        </svg>
        <span class="badge bg-danger">3</span>
    </a>
    <ul class="dropdown-menu dropdown-menu-end mt-3" aria-labelledby="cartDropdown" style="width: 320px;">
        <li>
            <h6 class="dropdown-header">Keranjang Belanja</h6>
        </li>
        <li class="dropdown-item d-flex align-items-center">
            <img src="https://via.placeholder.com/50" alt="Produk 1" class="me-2" width="50">
            <div class="flex-grow-1">
                <small class="text-truncate d-inline-block" style="max-width: 150px;">
                    Lorem ipsum dolor sit amet.
                </small>
                <br>
                <span class="text-muted">2 pcs - Rp 100.000</span>
            </div>
            <span>Rp 200.000</span>
        </li>
        <li class="dropdown-item d-flex align-items-center">
            <img src="https://via.placeholder.com/50" alt="Produk 2" class="me-2" width="50">
            <div class="flex-grow-1">
                <small class="text-truncate d-inline-block" style="max-width: 150px;">
                    Lorem ipsum dolor sit amet.
                </small>
                <br>
                <span class="text-muted">1 pcs - Rp 150.000</span>
            </div>
            <span>Rp 150.000</span>
        </li>
        <li class="dropdown-item d-flex align-items-center">
            <img src="https://via.placeholder.com/50" alt="Produk 3" class="me-2" width="50">
            <div class="flex-grow-1">
                <small class="text-truncate d-inline-block" style="max-width: 150px;">
                    Lorem ipsum dolor sit amet.
                </small>
                <br>
                <span class="text-muted">3 pcs - Rp 200.000</span>
            </div>
            <span>Rp 600.000</span>
        </li>
        <li>
            <hr class="dropdown-divider">
        </li>
        <li><a class="dropdown-item" href="#">Lihat Keranjang</a></li>
    </ul>
</div>