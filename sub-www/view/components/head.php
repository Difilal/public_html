<?php
// Default nilai jika tidak diberikan
$title          = $title ?? 'Title';
$description    = $description ?? '';
$keyword        = $keyword ?? '';
$author         = $author ?? '';
$ogTitle        = $ogTitle ?? '';
$ogDescription  = $ogDescription ?? '';
$ogType         = $ogType ?? '';
$ogUrl          = $ogUrl ?? '';
$ogImage        = $ogImage ?? '';
$relIcon        = $relIcon ?? '';
$relStylesheet  = $relStylesheet ?? [];
?>

<title><?= htmlspecialchars($title) ?></title>
<meta name="description"        content="<?= htmlspecialchars($description) ?>">
<meta name="keywords"           content="<?= htmlspecialchars($keyword) ?>">
<meta name="author"             content="<?= htmlspecialchars($author) ?>">

<!-- Open Graph Meta -->
<meta property="og:title"       content="<?= htmlspecialchars($ogTitle) ?>">
<meta property="og:description" content="<?= htmlspecialchars($ogDescription) ?>">
<meta property="og:type"        content="<?= htmlspecialchars($ogType) ?>">
<meta property="og:url"         content="<?= htmlspecialchars($ogUrl) ?>">
<meta property="og:image"       content="<?= htmlspecialchars($ogImage) ?>">

<!-- Favicon -->
<link rel="icon"                href="<?= htmlspecialchars($relIcon) ?>" type="image/png">

<!-- Stylesheets -->
<?php foreach ($relStylesheet as $stylesheet): ?>
    <link rel="stylesheet"      href="<?= htmlspecialchars($stylesheet['link']) ?>" integrity="sha384-..." crossorigin="anonymous">
<?php endforeach; ?>