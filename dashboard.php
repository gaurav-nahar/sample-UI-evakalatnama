<?php
session_start();
require_once __DIR__ . '/includes/helpers.php';

// ---------------------------------------------------------------
// Replace this block with your existing session + DB code.
// ---------------------------------------------------------------
$user = $_SESSION['user'] ?? ['name' => 'Arjun', 'email' => 'aadv1@gmail.com'];

$completedCount = 5;
// Each pending task: id, petitioner, respondent, created_at, stage ('PAYMENT' | 'ESIGN'),
// plus signed / total signer counts for e-Sign tasks.
$pendingTasks = [
    ['id' => 101, 'petitioner' => 'Mehta', 'respondent' => 'Kapoor Builders',      'created_at' => '2026-09-07 11:34:30', 'stage' => 'PAYMENT'],
    ['id' => 102, 'petitioner' => 'Singh', 'respondent' => 'Union of India',       'created_at' => '2026-09-03 21:35:46', 'stage' => 'PAYMENT'],
    ['id' => 103, 'petitioner' => 'Verma', 'respondent' => 'State of M.P.',        'created_at' => '2026-08-08 07:37:54', 'stage' => 'ESIGN', 'signed' => 1, 'signers' => 2],
    ['id' => 104, 'petitioner' => 'Rao',   'respondent' => 'Rao',                  'created_at' => '2026-08-08 06:39:26', 'stage' => 'ESIGN', 'signed' => 0, 'signers' => 2],
    ['id' => 105, 'petitioner' => 'Patel', 'respondent' => 'Gujarat Housing Board','created_at' => '2026-08-08 06:16:23', 'stage' => 'ESIGN', 'signed' => 1, 'signers' => 3],
];
// ---------------------------------------------------------------

$pendingCount = count($pendingTasks);
$paymentCount = count(array_filter($pendingTasks, fn($t) => $t['stage'] === 'PAYMENT'));
$esignCount   = $pendingCount - $paymentCount;
$total        = $pendingCount + $completedCount;
$rate         = $total ? round($completedCount / $total * 100) : 0;
$oldest       = $pendingTasks ? min(array_column($pendingTasks, 'created_at')) : null;

$pageTitle = 'Dashboard';
$activeNav = 'home';
include __DIR__ . '/includes/header.php';
?>

<main class="page">
  <div class="container">
    <div class="page-head">
      <div>
        <h1><?= e(greeting()) ?>, <?= e(first_name($user['name'] ?? '')) ?></h1>
        <?php if ($pendingCount): ?>
          <p><?= $pendingCount ?> Vakalatnama<?= $pendingCount === 1 ? ' is' : 's are' ?> waiting on you.
             <?= $paymentCount ?> need payment, <?= $esignCount ?> need signatures.</p>
        <?php else: ?>
          <p>Nothing is waiting on you. Start a new Vakalatnama when you're ready.</p>
        <?php endif; ?>
      </div>
      <a class="btn btn--stamp" href="create_vakalatnama.php"><i class="bi bi-plus-lg"></i> New Vakalatnama</a>
    </div>

    <div class="stats">
      <div class="stat stat--pending">
        <div class="stat__label"><span class="dot dot--amber"></span>Pending</div>
        <div class="stat__value"><?= $pendingCount ?></div>
        <div class="stat__note"><?= $oldest ? 'Oldest waiting since ' . e(date('j M', strtotime($oldest))) : 'All caught up' ?></div>
      </div>
      <div class="stat stat--done">
        <div class="stat__label"><span class="dot dot--stamp"></span>Completed</div>
        <div class="stat__value"><?= $completedCount ?></div>
        <div class="stat__note">Signed copies ready to download</div>
      </div>
      <div class="stat">
        <div class="stat__label">Completion rate</div>
        <div class="stat__value"><?= $rate ?>%</div>
        <div class="meter" role="img" aria-label="<?= $rate ?> percent complete"><span style="width: <?= $rate ?>%"></span></div>
      </div>
    </div>

    <div class="list-head">
      <h2>Waiting on you</h2>
      <?php if ($pendingCount): ?>
      <div class="chips" role="group" aria-label="Filter tasks">
        <button type="button" class="chip" data-filter="all" aria-pressed="true">All <?= $pendingCount ?></button>
        <button type="button" class="chip" data-filter="PAYMENT" aria-pressed="false">Payment <?= $paymentCount ?></button>
        <button type="button" class="chip" data-filter="ESIGN" aria-pressed="false">e-Sign <?= $esignCount ?></button>
      </div>
      <?php endif; ?>
    </div>

    <?php if ($pendingCount): ?>
      <ul class="tasks">
        <?php foreach ($pendingTasks as $t):
          $isPay = $t['stage'] === 'PAYMENT';
          $meta  = $isPay ? 'Fee not paid' : (int)($t['signed'] ?? 0) . ' of ' . (int)($t['signers'] ?? 0) . ' signed';
          $href  = 'create_vakalatnama.php?id=' . urlencode($t['id']) . '&step=' . ($isPay ? 4 : 5);
        ?>
          <li class="task" data-stage="<?= e($t['stage']) ?>">
            <span class="task__icon"><i class="bi bi-file-earmark-text"></i></span>
            <div>
              <p class="task__title"><?= e($t['petitioner']) ?><span class="vs">vs.</span><?= e($t['respondent']) ?></p>
              <p class="task__meta">Created <?= e(date('j M Y, H:i', strtotime($t['created_at']))) ?> · <?= e($meta) ?></p>
            </div>
            <?php if ($isPay): ?>
              <span class="pill pill--payment">Payment due</span>
            <?php else: ?>
              <span class="pill pill--esign">Awaiting e-Sign</span>
            <?php endif; ?>
            <a class="btn btn--ghost btn--sm" href="<?= e($href) ?>"><?= $isPay ? 'Pay fee' : 'Continue' ?></a>
          </li>
        <?php endforeach; ?>
      </ul>
    <?php else: ?>
      <div class="tasks empty">
        <i class="bi bi-check2-circle"></i>
        <h3>You're all caught up</h3>
        <p>New Vakalatnamas you start will appear here until they're signed.</p>
      </div>
    <?php endif; ?>
  </div>
</main>

<?php include __DIR__ . '/includes/footer.php'; ?>
