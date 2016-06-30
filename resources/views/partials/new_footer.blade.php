<footer class="Footer bg-dark dker">
    <p>2016 &copy; Nauzet Plasencia - Auret S.L.P. </p>
</footer><!-- /#footer -->

<!-- #helpModal -->
<div id="helpModal" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Ayuda</h4>
            </div>
            <div class="modal-body">
                <p>
                    Esta aplicación ha sido desarrollada por la empresa Auret S.L.P.. Si tienes cualquier problema, no dudes en contactar con ellos a través del email
                    <a href="mailto:nplasencia@auret.es?subject=[CuadrantesApp]%20Ayuda">nplasencia@auret.es</a>.
                </p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal --><!-- /#helpModal -->

<!--jQuery -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-tagsinput/1.3.6/jquery.tagsinput.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/autosize.js/3.0.15/autosize.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-switch/3.3.2/js/bootstrap-switch.min.js"></script>

<!--Bootstrap -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.6/js/bootstrap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jasny-bootstrap/3.1.3/js/jasny-bootstrap.min.js"></script>

<!-- MetisMenu -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/metisMenu/2.5.2/metisMenu.min.js"></script>

<!-- Screenfull -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/screenfull.js/3.0.0/screenfull.min.js"></script>

<!-- Metis core scripts -->
<script src="{{ asset('assets/js/core.min.js') }}"></script>

<!-- Metis demo scripts -->
<script src="{{ asset('assets/js/auret.js') }}"></script>

@stack('scripts')