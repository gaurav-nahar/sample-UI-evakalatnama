<?php
/**
 * Shared header.
 * Set these before including:
 *   $pageTitle  string   e.g. 'Dashboard'
 *   $activeNav  string   'home' | 'vakalatnama' | 'members' | 'profile' | 'login' | 'register'
 *   $user       ?array   ['name' => ..., 'email' => ...] when logged in, null otherwise
 */
require_once __DIR__ . '/helpers.php';
$pageTitle = $pageTitle ?? 'e-Vakalatnama';
$activeNav = $activeNav ?? '';
$user      = $user ?? null;
$initial   = $user ? strtoupper(mb_substr($user['name'] ?: $user['email'], 0, 1)) : '';

$navLink = function ($key, $href, $label) use ($activeNav) {
    $cls = $activeNav === $key ? ' class="is-active" aria-current="page"' : '';
    return '<a href="' . e($href) . '"' . $cls . '>' . e($label) . '</a>';
};
?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title><?= e($pageTitle) ?> · e-Vakalatnama</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,500;0,600;0,700;1,500&family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
  <link rel="stylesheet" href="assets/css/app.css">
</head>
<body>
<header class="site-header">
  <div class="container">
    <a class="brand" href="<?= $user ? 'dashboard.php' : 'index.php' ?>">
      <span class="brand__mark"><i class="bi bi-bank2"></i></span>
      e-Vakalatnama
    </a>

    <button class="nav-toggle" type="button" aria-label="Open menu" aria-expanded="false" data-nav-toggle>
      <i class="bi bi-list"></i>
    </button>

    <nav class="nav" data-nav>
      <?php if ($user): ?>
        <?= $navLink('home', 'dashboard.php', 'Dashboard') ?>
        <?= $navLink('vakalatnama', 'create_vakalatnama.php', 'Vakalatnama') ?>
        <?= $navLink('members', 'members.php', 'Members') ?>

        <div class="account" data-account>
          <button class="account__btn" type="button" aria-haspopup="true" aria-expanded="false">
            <span class="avatar"><?= e($initial) ?></span>
            <i class="bi bi-chevron-down"></i>
          </button>
          <div class="account__menu" role="menu">
            <div class="account__who">
              <span class="avatar avatar--lg"><?= e($initial) ?></span>
              <div>
                <strong><?= e($user['name'] ?: 'Advocate') ?></strong>
                <span><?= e($user['email']) ?></span>
              </div>
            </div>
            <a href="profile.php" role="menuitem"><i class="bi bi-person"></i> Profile</a>
            <a href="logout.php" role="menuitem" class="danger"><i class="bi bi-box-arrow-right"></i> Log out</a>
          </div>
        </div>
      <?php else: ?>
        <a href="index.php#how">What It Does</a>
        <a href="index.php#features">Why Digital</a>
        <a href="index.php#security">Security</a>
        <a class="btn btn--ghost btn--sm nav__signin" href="index.php#login">Sign In</a>
      <?php endif; ?>
    </nav>
  </div>
</header>
