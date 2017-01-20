<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
    <h4 class="modal-title">@yield('title')</h4>
    <div class="subtitle">@yield('subtitle')</div>
</div>
<div class="modal-body">
    @yield('content')
</div>
<div class="modal-footer">
    @yield('footer')
</div>