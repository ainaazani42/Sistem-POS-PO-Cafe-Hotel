@props(['menus'])

<script>
    window.MENUS = @json($menus);
    window.BIAYA_ADMIN = 1000;
    window.MAX_CART_ITEMS = 5;   // maksimal menu berbeda per pesanan
    window.SERVER_ERROR = @json(session('error') ?? $errors->first());
</script>
<script src="{{ asset('js/menu-cart.js') }}"></script>
