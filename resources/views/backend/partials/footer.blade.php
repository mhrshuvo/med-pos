<footer class="main-footer">
    <div class="footer-left">
        Copyright &copy; {{date('Y')}} <div class="bullet"></div> Design By <a href="javascript:void(0)">Name</a>
    </div>
    <div class="footer-right">

    </div>
    <input type="hidden" class="status_change" value="{{ route('change.status') }}">
    <input type="hidden" class="csrf" value="{{ csrf_token() }}">
</footer>
