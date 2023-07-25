<div class="pie">
    <h6>Desarrollado por ( <i class="fa-solid fa-user"></i> Eduardo Recoliza ) - <i class="fa-solid fa-earth-americas"></i> Argentina (2023)</h6>
</div>

<script>
    let dropdowns = document.querySelectorAll('.dropdown-submenu')
    dropdowns.forEach((dd) => {
        dd.addEventListener('click', function(e) {
            var el = this.nextElementSibling
            el.style.display = el.style.display === 'block' ? 'none' : 'block'
        })
    })
</script>

<script src="../css/currency.js"></script>
