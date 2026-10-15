<footer class="site-footer">
  <div class="container footer-grid">
    <div class="footer-about">
      <a class="brand" href="index.php"><span class="brand__mark"><i class="bi bi-bank2"></i></span> e-Vakalatnama</a>
      <p>Create, sign and file digital vakalatnamas, securely and from any device.</p>
    </div>
    <nav class="footer-col" aria-label="Product">
      <h4>Product</h4>
      <a href="index.php#how">What It Does</a>
      <a href="index.php#security">Security</a>
      <a href="index.php#login">Sign In</a>
      <a href="register.php">Register</a>
    </nav>
    <nav class="footer-col" aria-label="Legal">
      <h4>Legal</h4>
      <a href="privacy.php">Privacy Policy</a>
      <a href="terms.php">Terms of Service</a>
      <a href="disclaimer.php">Legal Disclaimer</a>
      <a href="support.php">Support</a>
    </nav>
  </div>
  <div class="container footer-bar">
    <span>&copy; <?= date('Y') ?> e-Vakalatnama. All rights reserved.</span>
    <span><i class="bi bi-lock-fill"></i> Bank-grade 256-bit encryption</span>
  </div>
</footer>

<script>
(function () {
  // Count-up stats
  var nums = document.querySelectorAll('[data-count]');
  if (nums.length && 'IntersectionObserver' in window && !window.matchMedia('(prefers-reduced-motion: reduce)').matches) {
    var co = new IntersectionObserver(function (es) {
      es.forEach(function (e) {
        if (!e.isIntersecting) return;
        co.unobserve(e.target);
        var el = e.target, t = parseFloat(el.dataset.count), fin = el.dataset.final, st = null, dec = t % 1 !== 0;
        function step(ts) {
          st = st || ts;
          var p = Math.min((ts - st) / 1400, 1), v = t * (1 - Math.pow(1 - p, 3));
          if (p === 1) { el.textContent = fin; return; }
          el.textContent = dec ? v.toFixed(1) + '%' : (t >= 1000 ? Math.round(v / 1000) + 'k' : Math.round(v)) + (fin.indexOf('+') > -1 ? '+' : (fin.indexOf('min') > -1 ? ' min' : ''));
          requestAnimationFrame(step);
        }
        requestAnimationFrame(step);
      });
    }, { threshold: 0.4 });
    nums.forEach(function (n) { co.observe(n); });
  }
  // Scroll reveal
  var els = document.querySelectorAll('.reveal, .process');
  if ('IntersectionObserver' in window) {
    document.documentElement.classList.add('js');
    var io = new IntersectionObserver(function (entries) {
      entries.forEach(function (e) {
        if (e.isIntersecting) { e.target.classList.add('is-visible'); io.unobserve(e.target); }
      });
    }, { threshold: 0.2 });
    els.forEach(function (el) { io.observe(el); });
  }
})();
(function () {
  // Mobile nav
  var toggle = document.querySelector('[data-nav-toggle]');
  var nav = document.querySelector('[data-nav]');
  if (toggle && nav) {
    toggle.addEventListener('click', function () {
      var open = nav.classList.toggle('is-open');
      toggle.setAttribute('aria-expanded', open);
    });
  }
  // Account menu
  var acc = document.querySelector('[data-account]');
  if (acc) {
    var btn = acc.querySelector('.account__btn');
    btn.addEventListener('click', function (ev) {
      ev.stopPropagation();
      var open = acc.classList.toggle('is-open');
      btn.setAttribute('aria-expanded', open);
    });
    document.addEventListener('click', function () { acc.classList.remove('is-open'); btn.setAttribute('aria-expanded', 'false'); });
    document.addEventListener('keydown', function (e) { if (e.key === 'Escape') acc.classList.remove('is-open'); });
  }
  // Tabs (login: password / OTP)
  document.querySelectorAll('[data-tabs]').forEach(function (group) {
    var tabs = group.querySelectorAll('[role="tab"]');
    tabs.forEach(function (tab) {
      tab.addEventListener('click', function () {
        tabs.forEach(function (t) {
          var on = t === tab;
          t.setAttribute('aria-selected', on);
          document.getElementById(t.getAttribute('aria-controls')).hidden = !on;
        });
      });
    });
  });
  // Task filter chips
  document.querySelectorAll('[data-filter]').forEach(function (chip) {
    chip.addEventListener('click', function () {
      var f = chip.getAttribute('data-filter');
      document.querySelectorAll('[data-filter]').forEach(function (c) { c.setAttribute('aria-pressed', c === chip); });
      document.querySelectorAll('[data-stage]').forEach(function (row) {
        row.hidden = f !== 'all' && row.getAttribute('data-stage') !== f;
      });
    });
  });
})();
</script>
</body>
</html>
