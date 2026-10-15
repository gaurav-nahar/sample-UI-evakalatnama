<?php
session_start();
require_once __DIR__ . '/includes/helpers.php';

// ---------------------------------------------------------------
// Replace this block with your existing session + DB code.
// ---------------------------------------------------------------
$user = $_SESSION['user'] ?? ['name' => 'Arjun', 'email' => 'aadv1@gmail.com'];

$currentStep = (int)($_GET['step'] ?? 5);          // 1..6
$case = [
    'id'          => (int)($_GET['id'] ?? 103),
    'petitioner'  => 'Verma',
    'respondent'  => 'State of M.P.',
    'court'       => 'District Court, Bhopal',
    'case_no'     => 'CS/1234/2026',
    'amount'      => 149.86,
    'paid'        => true,
];
$members = [
    ['id' => 1, 'name' => 'Shyam Verma', 'role' => 'Advocate', 'mobile' => '9294642384', 'signed_at' => '2026-08-08 07:41:00'],
    ['id' => 2, 'name' => 'Ramlal',      'role' => 'Party',    'mobile' => '9876543210', 'signed_at' => null],
];
// ---------------------------------------------------------------

$steps = [1 => 'Case & parties', 2 => 'Advocates', 3 => 'Review', 4 => 'Pay', 5 => 'e-Sign', 6 => 'Done'];
$signedCount = count(array_filter($members, fn($m) => !empty($m['signed_at'])));
$allSigned   = $signedCount === count($members);

$pageTitle = 'Collect signatures';
$activeNav = 'vakalatnama';
include __DIR__ . '/includes/header.php';
?>

<main class="page">
  <div class="container">
    <a class="back-link" href="dashboard.php"><i class="bi bi-chevron-left"></i> All Vakalatnamas</a>
    <div class="page-head">
      <div>
        <h1>Collect signatures</h1>
        <p>Each person signs from their own phone with an OTP. You'll get the signed copy once everyone has signed.</p>
      </div>
    </div>

    <ol class="stepper">
      <?php foreach ($steps as $n => $label):
        $state = $n < $currentStep ? 'is-done' : ($n === $currentStep ? 'is-current' : '');
      ?>
        <li class="<?= $state ?>"<?= $n === $currentStep ? ' aria-current="step"' : '' ?>>
          <span class="dot"><?= $n < $currentStep ? '<i class="bi bi-check-lg"></i>' : $n ?></span>
          <span class="label"><?= e($label) ?></span>
        </li>
      <?php endforeach; ?>
    </ol>

    <div class="wizard">
      <section class="panel">
        <div class="panel__head">
          <h2>Signatures <span class="muted"><?= $signedCount ?> of <?= count($members) ?></span></h2>
          <a class="btn btn--ghost btn--sm" href="view_vakalatnama.php?id=<?= urlencode($case['id']) ?>" target="_blank">
            <i class="bi bi-file-earmark-arrow-down"></i> View Vakalatnama
          </a>
        </div>
        <div class="panel__body">
          <ul class="signers">
            <?php foreach ($members as $m): ?>
              <li class="signer">
                <span class="avatar <?= $m['signed_at'] ? 'avatar--soft' : 'avatar--muted' ?>"><?= e(initials($m['name'])) ?></span>
                <div>
                  <div class="signer__name"><?= e($m['name']) ?></div>
                  <div class="signer__role">
                    <?= e($m['role']) ?> ·
                    <?= $m['signed_at'] ? 'signed ' . e(date('j M, H:i', strtotime($m['signed_at']))) : e(mask_mobile($m['mobile'])) ?>
                  </div>
                </div>
                <div class="signer__action">
                  <?php if ($m['signed_at']): ?>
                    <span class="signed"><i class="bi bi-check-circle"></i> Signed</span>
                  <?php else: ?>
                    <form method="post" action="send_sign_link.php">
                      <input type="hidden" name="member_id" value="<?= (int)$m['id'] ?>">
                      <button class="btn btn--ghost btn--sm" type="submit">Send link by SMS</button>
                    </form>
                    <a class="btn btn--stamp btn--sm" href="esign.php?member_id=<?= (int)$m['id'] ?>">e-Sign now</a>
                  <?php endif; ?>
                </div>
              </li>
            <?php endforeach; ?>
          </ul>

          <?php if ($allSigned): ?>
            <div class="notice"><i class="bi bi-check2-circle"></i> Everyone has signed. Continue to download the signed copy.</div>
            <div class="wizard__nav">
              <span></span>
              <a class="btn btn--primary" href="create_vakalatnama.php?id=<?= urlencode($case['id']) ?>&step=6">Finish</a>
            </div>
          <?php else: ?>
            <div class="notice"><i class="bi bi-info-circle"></i> If your client is with you, choose e-Sign now and hand them your phone. Otherwise send the link and they can sign from home.</div>
          <?php endif; ?>
        </div>
      </section>

      <aside class="panel summary">
        <p class="summary__case"><?= e($case['petitioner']) ?> <em>vs.</em> <?= e($case['respondent']) ?></p>
        <dl>
          <div><dt>Court</dt><dd><?= e($case['court']) ?></dd></div>
          <div><dt>Case no.</dt><dd><?= e($case['case_no']) ?></dd></div>
          <div><dt>Fee</dt><dd>₹<?= number_format($case['amount'], 2) ?></dd></div>
          <div><dt>Payment</dt><dd><span class="pill <?= $case['paid'] ? 'pill--done' : 'pill--payment' ?>"><?= $case['paid'] ? 'Paid' : 'Due' ?></span></dd></div>
        </dl>
      </aside>
    </div>
  </div>
</main>

<?php include __DIR__ . '/includes/footer.php'; ?>
