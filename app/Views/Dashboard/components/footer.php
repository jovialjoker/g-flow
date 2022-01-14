    <footer class="footer">
        <div class="row align-items-center justify-content-xl-between">
          <div class="col-xl-6">
            <div class="copyright text-center text-xl-left text-muted">
              <?= lang('app.love1', [], session('language')); ?><i class='fas fa-heart' style='color:red'></i><?= lang('app.love2', [], session('language')); ?>
            </div>
          </div>
          <div class="col-x6-6">
            <div class="copyright text-center text-xl-left text-muted">
          <a class="nav-link" href="<?= route_to('language'); ?>"><?= lang('app.lang_switch', [], session('language')); ?></a>
        </div>
        </div>
        </div>
      </footer>
    </div>
  </div>
  <!-- Argon Scripts -->
  <!-- Core -->
  <script src="/assets/vendor/jquery/dist/jquery.min.js"></script>
  <script src="/assets/vendor/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
  <!-- Argon JS -->
  <script src="/assets/js/argon.js?v=1.0.0"></script>
</body>

</html>