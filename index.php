<?php
session_start();

$pageTitle = 'Home';
$activeNav = 'home';
$user      = null; // landing page is for logged-out visitors

// Keep your existing login handler; just point the form actions at it.
$loginAction = 'login_action.php';
$otpAction   = 'send_otp.php';
$loginError  = $_SESSION['login_error'] ?? '';
unset($_SESSION['login_error']);

include __DIR__ . '/includes/header.php';
?>

<main>
  <section class="hero" id="login">
    <div class="container hero__grid">
      <div class="hero__copy">
        <p class="hero__badge"><i class="bi bi-shield-check"></i> Court-ready &amp; legally valid</p>
        <h1>Execute Vakalatnama in Minutes.
          <em class="shine" aria-label="100% Digitally &amp; Legally Binding."><span class="w" style="--i:0" aria-hidden="true">100%</span> <span class="w" style="--i:1" aria-hidden="true">Digitally</span> <span class="w" style="--i:2" aria-hidden="true">&amp;</span> <span class="w" style="--i:3" aria-hidden="true">Legally</span> <span class="w" style="--i:4" aria-hidden="true">Binding.</span></em>
        </h1>
        <p class="hero__lead">The definitive platform for advocates and litigants to create, sign and file digital vakalatnamas, with secure encryption, real-time tracking and a fully paperless process, from any device.</p>
        <ul class="trust">
          <li><i class="bi bi-patch-check"></i> Court-ready format</li>
          <li><i class="bi bi-link-45deg"></i> Blockchain-verified timestamps</li>
          <li><i class="bi bi-shield-lock"></i> Bank-grade 256-bit encryption</li>
        </ul>
      </div>

      <div class="stamp-sheet">
        <div class="stamp-sheet__inner">
          <div class="stamp-sheet__head">
            <div>
              <h2>Log in</h2>
              <p class="stamp-sheet__sub">Welcome back to chambers.</p>
            </div>
            <div class="seal" aria-hidden="true"><i class="bi bi-vector-pen"></i></div>
          </div>

          <?php if ($loginError): ?>
            <div class="alert" role="alert"><i class="bi bi-exclamation-circle"></i> <?= e($loginError) ?></div>
          <?php endif; ?>

          <div class="tabs" role="tablist" data-tabs>
            <button type="button" role="tab" aria-selected="true" aria-controls="tab-password">Password</button>
            <button type="button" role="tab" aria-selected="false" aria-controls="tab-otp">One-time code</button>
          </div>

          <form id="tab-password" class="tab-panel" method="post" action="<?= e($loginAction) ?>">
            <div class="field">
              <label for="login-id">Mobile number or email</label>
              <input id="login-id" name="username" type="text" autocomplete="username" placeholder="98765 43210" required>
            </div>
            <div class="field">
              <div class="field__row">
                <label for="login-pw">Password</label>
                <a href="forgot_password.php">Forgot password?</a>
              </div>
              <input id="login-pw" name="password" type="password" autocomplete="current-password" required>
            </div>
            <button class="btn btn--primary btn--block" type="submit">Log in</button>
          </form>

          <form id="tab-otp" class="tab-panel" method="post" action="<?= e($otpAction) ?>" hidden>
            <div class="field">
              <label for="otp-mobile">Mobile number</label>
              <input id="otp-mobile" name="mobile" type="tel" inputmode="numeric" autocomplete="tel" placeholder="98765 43210" required>
            </div>
            <button class="btn btn--primary btn--block" type="submit">Send code</button>
          </form>

          <p class="stamp-sheet__foot">New to e-Vakalatnama? <a href="register.php">Create an account</a></p>
        </div>
    </div>
  </section>
              <section class="section section--white statsband">
    <div class="container">
      <ul class="statrow reveal">
        <li><strong data-count="50000" data-final="50k+">50k+</strong><span>Documents signed</span></li>
        <li><strong data-count="12000" data-final="12k">12k</strong><span>Advocates</span></li>
        <li><strong data-count="99.9" data-final="99.9%">99.9%</strong><span>Uptime</span></li>
        <li><strong data-count="15" data-final="15 min">15 min</strong><span>Average completion</span></li>
      </ul>
    </div>
  </section>

  <section class="compliance" id="security">
    <div class="container compliance__inner reveal">
      <div class="compliance__icon"><i class="bi bi-bank2"></i></div>
      <div>
        <span class="eyebrow eyebrow--gold">Compliance &amp; security</span>
        <h2>Built to be trusted with every filing.</h2>
        <p>e-Vakalatnama produces court-ready, legally valid documents. Documents carry blockchain-verified timestamps so they stay immutable, and all client data and documents are protected with bank-grade 256-bit encryption.</p>
        <ul class="badges"><li><i class="bi bi-patch-check"></i> Court-Ready Format</li><li><i class="bi bi-link-45deg"></i> Blockchain-Verified Timestamps</li><li><i class="bi bi-lock"></i> 256-bit Encryption</li></ul>
      </div>
      <img class="compliance__fig" src="assets/img/lady-justice.png" alt="" aria-hidden="true" loading="lazy">
    </div>
  </section>
  <section class="section section--white" id="how">
    <div class="container">
      <div class="section__head reveal">
        <span class="eyebrow">What it does</span>
        <h2>From case details to signed copy in six steps</h2>
        <p>Built for lawyers who need speed, security and complete trust in every filing.</p>
      </div>
      <ol class="what">
        <li class="what__row reveal">
          <div class="what__art" aria-hidden="true"><svg viewBox="0 0 240 150" xmlns="http://www.w3.org/2000/svg"><rect x="30" y="14" width="180" height="122" rx="10" class="a-card"/>
<rect x="42" y="26" width="76" height="30" rx="6" class="a-tile a-pulse"/><rect x="122" y="26" width="76" height="30" rx="6" class="a-tile"/>
<rect x="52" y="38" width="56" height="6" rx="3" class="a-gold"/><rect x="132" y="38" width="56" height="6" rx="3" class="a-line"/>
<rect x="42" y="66" width="156" height="16" rx="4" class="a-field"/><rect x="46" y="72" width="0" height="4" rx="2" class="a-fill a-type1"/>
<rect x="42" y="90" width="74" height="16" rx="4" class="a-field"/><rect x="46" y="96" width="0" height="4" rx="2" class="a-fill a-type2"/>
<rect x="124" y="90" width="74" height="16" rx="4" class="a-field"/><rect x="128" y="96" width="0" height="4" rx="2" class="a-fill a-type3"/>
<rect x="42" y="114" width="156" height="14" rx="7" class="a-btn"/></svg></div>
          <div class="what__txt">
            <p class="what__lab"><b>01</b><i></i>Case details</p>
            <h3>Case &amp; Parties</h3>
            <p>Choose the court, enter the case details and pick the parties from your master list. Everything is saved as you go, so you can pick up where you left off.</p>
            <ul><li>District Court and High Court supported</li><li>Optional CNR number to pre-fill case info</li><li>Reuse saved parties with one click</li></ul>
          </div>
        </li>
        <li class="what__row reveal">
          <div class="what__art" aria-hidden="true"><svg viewBox="0 0 240 150" xmlns="http://www.w3.org/2000/svg"><rect x="30" y="14" width="180" height="122" rx="10" class="a-card"/>
<g class="a-pop p1"><circle cx="78" cy="58" r="18" class="a-av"/><circle cx="78" cy="53" r="6" class="a-gold"/><path d="M66 70a12 9 0 0 1 24 0z" class="a-gold"/><rect x="58" y="84" width="40" height="6" rx="3" class="a-line"/></g>
<g class="a-pop p2"><circle cx="162" cy="58" r="18" class="a-av"/><circle cx="162" cy="53" r="6" class="a-gold"/><path d="M150 70a12 9 0 0 1 24 0z" class="a-gold"/><rect x="142" y="84" width="40" height="6" rx="3" class="a-line"/></g>
<g class="a-pop p3"><circle cx="90" cy="48" r="7" class="a-ok"/><path d="M86.5 48l2.5 2.5 4.5-5" class="a-tick"/></g>
<g class="a-pop p4"><circle cx="174" cy="48" r="7" class="a-ok"/><path d="M170.5 48l2.5 2.5 4.5-5" class="a-tick"/></g>
<rect x="72" y="104" width="96" height="16" rx="8" class="a-btn"/><path d="M114 112h12M120 108v8" class="a-plus"/></svg></div>
          <div class="what__txt">
            <p class="what__lab"><b>02</b><i></i>Advocate assignment</p>
            <h3>Advocates</h3>
            <p>Add the advocates who will appear in the matter. Each one gets a signing request and their authorization is captured digitally, with no printouts.</p>
            <ul><li>Add one or several advocates per case</li><li>Main and additional advocates handled separately</li><li>Each advocate gets their own signing request</li></ul>
          </div>
        </li>
        <li class="what__row reveal">
          <div class="what__art" aria-hidden="true"><svg viewBox="0 0 240 150" xmlns="http://www.w3.org/2000/svg"><rect x="60" y="10" width="120" height="130" rx="8" class="a-card"/>
<rect x="74" y="24" width="60" height="7" rx="3.5" class="a-gold"/>
<rect x="74" y="42" width="92" height="5" rx="2.5" class="a-line"/><rect x="74" y="56" width="92" height="5" rx="2.5" class="a-line"/>
<rect x="74" y="70" width="92" height="9" rx="2" class="a-hl"/><rect x="74" y="72" width="92" height="5" rx="2.5" class="a-line"/>
<rect x="74" y="88" width="92" height="5" rx="2.5" class="a-line"/><rect x="74" y="102" width="60" height="5" rx="2.5" class="a-line"/>
<g class="a-pencil"><path d="M0 0l12-12 6 6-12 12-8 2z" class="a-gold"/><path d="M0 0l-2 8 8-2z" class="a-fillk"/></g></svg></div>
          <div class="what__txt">
            <p class="what__lab"><b>03</b><i></i>Draft review</p>
            <h3>Preview &amp; Edit</h3>
            <p>See the vakalatnama exactly as it will be filed. Spot a typo or wrong detail and fix it before payment, with the preview updating as you edit.</p>
            <ul><li>Full-page preview of the final document</li><li>Edit party, case or advocate details anytime</li><li>No surprises after payment</li></ul>
          </div>
        </li>
        <li class="what__row reveal">
          <div class="what__art" aria-hidden="true"><svg viewBox="0 0 240 150" xmlns="http://www.w3.org/2000/svg"><rect x="40" y="14" width="160" height="122" rx="10" class="a-card"/>
<rect x="54" y="28" width="60" height="6" rx="3" class="a-gold"/>
<rect x="54" y="44" width="80" height="5" rx="2.5" class="a-line"/><rect x="164" y="44" width="22" height="5" rx="2.5" class="a-line"/>
<rect x="54" y="58" width="70" height="5" rx="2.5" class="a-line"/><rect x="164" y="58" width="22" height="5" rx="2.5" class="a-line"/>
<path d="M54 74h132" class="a-sep"/><rect x="54" y="82" width="40" height="8" rx="4" class="a-fillk"/><rect x="154" y="82" width="32" height="8" rx="4" class="a-gold"/>
<g class="a-btnwrap"><rect x="54" y="104" width="132" height="22" rx="11" class="a-btn"/><rect x="104" y="112" width="32" height="6" rx="3" fill="#fff" class="a-btntxt"/><path d="M110 115l6 6 14-13" class="a-tick a-paid"/></g></svg></div>
          <div class="what__txt">
            <p class="what__lab"><b>04</b><i></i>Secure payment</p>
            <h3>Pay</h3>
            <p>The fee is shown as a clear breakdown of court fee, advocate charges and GST. Pay online in one step and the signing stage unlocks immediately.</p>
            <ul><li>Transparent itemised fee and GST</li><li>Pay securely online by UPI, card or net banking</li><li>Instant confirmation once paid</li></ul>
          </div>
        </li>
        <li class="what__row reveal">
          <div class="what__art" aria-hidden="true"><svg viewBox="0 0 240 150" xmlns="http://www.w3.org/2000/svg"><rect x="40" y="10" width="160" height="130" rx="8" class="a-card"/>
<rect x="54" y="24" width="60" height="7" rx="3.5" class="a-gold"/>
<rect x="54" y="42" width="132" height="5" rx="2.5" class="a-line"/><rect x="54" y="56" width="132" height="5" rx="2.5" class="a-line"/><rect x="54" y="70" width="90" height="5" rx="2.5" class="a-line"/>
<path d="M58 112c8-18 14-18 12-4s6 8 12-2 8 6 16-4 8 4 16-2" class="a-sign"/>
<path d="M54 120h80" class="a-sep"/>
<g class="a-stamp"><circle cx="168" cy="106" r="16" class="a-ok"/><path d="M160 106l6 6 11-12" class="a-tick"/></g></svg></div>
          <div class="what__txt">
            <p class="what__lab"><b>05</b><i></i>Digital signature</p>
            <h3>Sign</h3>
            <p>Advocates and clients sign from any device. Each signature is time-stamped and the status of every member is tracked live on the page.</p>
            <ul><li>Sign from phone, tablet or desktop</li><li>Blockchain-verified timestamps on every signature</li><li>Live Signed / Pending status per member</li></ul>
          </div>
        </li>
        <li class="what__row reveal">
          <div class="what__art" aria-hidden="true"><svg viewBox="0 0 240 150" xmlns="http://www.w3.org/2000/svg"><g class="a-doc"><rect x="76" y="14" width="88" height="112" rx="8" class="a-card"/>
<rect x="88" y="28" width="44" height="6" rx="3" class="a-gold"/><rect x="88" y="44" width="64" height="5" rx="2.5" class="a-line"/><rect x="88" y="58" width="64" height="5" rx="2.5" class="a-line"/><rect x="88" y="72" width="40" height="5" rx="2.5" class="a-line"/></g>
<g class="a-done"><circle cx="120" cy="96" r="22" class="a-ok"/><path d="M109 96l8 8 15-16" class="a-tick a-big"/></g>
<circle cx="120" cy="96" r="22" class="a-ring"/></svg></div>
          <div class="what__txt">
            <p class="what__lab"><b>06</b><i></i>Completion</p>
            <h3>Done</h3>
            <p>Once everyone has signed, your vakalatnama is ready. Download the signed copy and file it, and find it again anytime in your dashboard.</p>
            <ul><li>Download the signed PDF instantly</li><li>Stored safely with 256-bit encryption</li><li>Track every case from your dashboard</li></ul>
          </div>
        </li>
      </ol>
    </div>
  </section>

  <section class="section" id="features">
    <div class="container">
      <div class="section__head reveal">
        <span class="eyebrow">Why digital vakalatnama</span>
        <h2>Trust, security and speed in every filing</h2>
        <p>Designed for advocates and litigants who would rather spend time on the case than the paperwork.</p>
      </div>
      <div class="vgrid">
      <div class="vcard reveal" style="--d:0.00s"><span class="vcard__ic"><i class="bi bi-file-earmark-plus"></i></span><h3>Create Online</h3><p>Add case details and parties and generate your vakalatnama in minutes.</p></div>
      <div class="vcard reveal" style="--d:0.10s"><span class="vcard__ic"><i class="bi bi-person-check"></i></span><h3>Digital Advocate Authorization</h3><p>Assign advocates and capture authorization digitally, with no printouts.</p></div>
      <div class="vcard reveal" style="--d:0.20s"><span class="vcard__ic"><i class="bi bi-clock-history"></i></span><h3>Blockchain-Verified Timestamps</h3><p>Every signature is time-stamped, so your documents stay immutable and widely accepted.</p></div>
      <div class="vcard reveal" style="--d:0.00s"><span class="vcard__ic"><i class="bi bi-shield-lock"></i></span><h3>Bank-Grade Encryption</h3><p>256-bit encryption protects all client data and document storage.</p></div>
      <div class="vcard reveal" style="--d:0.10s"><span class="vcard__ic"><i class="bi bi-phone"></i></span><h3>Paperless, Anytime Access</h3><p>Open, sign and download your vakalatnama whenever you need it, from your phone or desk.</p></div>
      <div class="vcard reveal" style="--d:0.20s"><span class="vcard__ic"><i class="bi bi-lightning-charge"></i></span><h3>Minutes, Not Days</h3><p>Reduce filing time from days to minutes, built for advocates and litigants.</p></div>
      </div>
    </div>
  </section>




  <!-- <section class="cta" id="cta">
    <div class="container cta__inner reveal">
      <div>
        <h2>Ready to file your Vakalatnama digitally?</h2>
        <p>Join thousands of legal professionals who trust e-Vakalatnama for secure, fast and paperless advocate authorizations.</p>
      </div>
      <form class="cta__form" method="get" action="register.php">
        <input type="text" name="contact" placeholder="Phone number or email" aria-label="Phone number or email" required>
        <button class="btn btn--gold" type="submit">Get Started Free</button>
      </form>
    </div>
  </section> -->
</main>

<?php include __DIR__ . '/includes/footer.php'; ?>
