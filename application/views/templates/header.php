<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&family=Poppins:wght@400;600;700;800&display=swap" rel="stylesheet">
    <meta name="description" content="RENTCAM — Platform sewa kamera dan drone profesional terlengkap dan terpercaya. Dapatkan peralatan foto dan video terbaik untuk momen berharga Anda.">
    <meta name="keywords" content="rental kamera, sewa drone, sewa kamera murah, rental dslr, sewa perlengkapan video, rentcam">
    <meta name="author" content="RENTCAM Team">
    
    <!-- Open Graph / Facebook -->
    <meta property="og:type" content="website">
    <meta property="og:url" content="<?= base_url() ?>">
    <meta property="og:title" content="<?= isset($title) ? htmlspecialchars($title) : 'RENTCAM — Sewa Kamera & Drone Profesional' ?>">
    <meta property="og:description" content="Platform sewa kamera dan drone profesional terlengkap dan terpercaya.">
    <meta property="og:image" content="<?= base_url('assets/picture/hero-bg.jpg') ?>">

    <title><?= isset($title) ? htmlspecialchars($title) : 'RENTCAM — Sewa Kamera & Drone Profesional' ?></title>
    <link rel="icon" href="<?= base_url('assets/img/logo.png') ?>" type="image/png">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <!-- Chart.js (for dashboard) -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>
    <!-- AOS Animate On Scroll -->
    <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />
    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!-- Main CSS -->
    <link rel="stylesheet" href="<?= base_url('assets/css/style.css') ?>">
</head>
<body>
