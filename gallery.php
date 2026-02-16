<?php
$pageTitle = 'Gallery | MiniLicensePlates.com';
include __DIR__ . '/inc/page_top.php';

// "set name" => folder name
$folderMap = [
    '1936 Goudey Cards'     => 'c36g',
    '1937 Goudey Cards'     => 'c37g',
    '1938 Goudey Cards'     => 'c38g',
    '1939 Goudey Cards'     => 'c39g',
    '1939 Worldwide Gum Cards'     => 'c39w',
    '1939 Globe Trotters'   => 'm39g',
    '1949 Topps Cards'      => 'c49t',
    '1950 Topps Cards'      => 'c50t',
    '1952 Licade Wrappers'  => 'c52m',
    '1953 Gen. Mills (Wheaties)'         => 'm53p',
    '1954 Gen. Mills (Wheaties)'         => 'm54p',
    '1953-54 Cracker Jack cards'    => 'c53c',
    '1954 Canada Quaker Cereal'  => 'm54q',
    '1955 Leader Candy'     => 'm55l',
    '1959 Bakers Chocolate' => 'm59p',
    '1960 Post'             => 'm60p',
    '1961 Topps Stickers'   => 's61t',
    '1963 General Mills'    => 'm63p',
    '1963 Canada GM Stickers'   => 's63g',
    '1966 Canada GM Stickers'   => 's66g',
    '1968 Maple Leaf'       => 'm68m',
    '1968 Quaker Cereal'    => 'm68q',
    '1968 Post Cereal Plates'             => 'm68p',
    '1970 Post Cereal Plates'             => 'm70p',
    '1975 Post Cereal Plates'             => 'm75p',
    '1978 Post Cereal Plates'             => 'm78p',
    '1978 Super Sips candy' => 's78s',
    '1979 Post Cereal Plates'             => 'm79p',
    '1980 Post Cereal Plates'             => 'm80p',
    '1981 Post Cereal Plates'             => 'm81p',
    '1982 Post Cereal Plates'             => 'm82p',
    '1983 Post Cereal Plates'             => 'm83p',
    '1984 Post Cereal Plates'             => 'm84p',
    '1986 Post Cereal Plates'             => 'm86p',
    '1987 Post Cereal Plates'             => 'm87p',
    '1988 Post Cereal Plates'             => 'm88p',
    '1989 Post Cereal Plates'             => 'm89p',
    '1990 Post Cereal Plates'             => 'm90p',
];

// Compute availability + thumbnail (first "*a.xxx" image) per set
$availableSets  = [];
$setThumbnails  = [];

foreach ($folderMap as $setName => $folder) {
    $dirPath = __DIR__ . '/' . $folder;
    $availableSets[$setName] = false;
    $setThumbnails[$setName] = null;

    if (is_dir($dirPath)) {
        $files = scandir($dirPath);
        foreach ($files as $file) {
            if (preg_match('/a\.(jpg|jpeg|png|gif|webp|bmp)$/i', $file)) {
                $availableSets[$setName] = true;
                $setThumbnails[$setName] = $folder . '/' . $file; // web path
                break;
            }
        }
    }
}

$selectedSet = isset($_GET['year']) ? $_GET['year'] : null; // 'year' holds the set label
$images = [];
$folder = null;

if ($selectedSet && isset($folderMap[$selectedSet])) {
    $folder = $folderMap[$selectedSet];
    $dirPath = __DIR__ . '/' . $folder;
    $webPath = $folder;

    if (is_dir($dirPath)) {
        $files = scandir($dirPath);
        $allowedExtensions = ['jpg', 'jpeg', 'png', 'gif', 'webp', 'bmp'];

        foreach ($files as $file) {
            if ($file === '.' || $file === '..') continue;

            $ext = strtolower(pathinfo($file, PATHINFO_EXTENSION));
            $basename = pathinfo($file, PATHINFO_FILENAME);

            // Only filenames ending with 'a'
            if (preg_match('/a$/i', $basename) && in_array($ext, $allowedExtensions)) {
                $baseNoLetter = substr($basename, 0, -1);
                $aFile = $webPath . '/' . $file;
                $bFile = $webPath . '/' . $baseNoLetter . 'b.' . $ext;

                if (file_exists($dirPath . '/' . $baseNoLetter . 'b.' . $ext)) {
                    $images[] = ['a' => $aFile, 'b' => $bFile];
                } else {
                    $images[] = ['a' => $aFile, 'b' => null];
                }
            }
        }
    }
}
?>

<?php if (!$selectedSet): ?>
  <!-- Home view: show all sets -->
  <div class="set-list set-width">
    <?php foreach ($folderMap as $setName => $folderCode): ?>
      <?php $enabled = !empty($availableSets[$setName]); ?>
      <a
        class="set-box<?php echo $enabled ? '' : ' disabled'; ?>"
        <?php if ($enabled): ?>
          href="gallery.php?year=<?php echo urlencode($setName); ?>"
        <?php else: ?>
          href="javascript:void(0)"
        <?php endif; ?>
      >
        <?php if ($enabled && !empty($setThumbnails[$setName])): ?>
          <img
            src="<?php echo htmlspecialchars($setThumbnails[$setName], ENT_QUOTES, 'UTF-8'); ?>"
            alt="<?php echo htmlspecialchars($setName, ENT_QUOTES, 'UTF-8'); ?> thumbnail"
            class="set-thumb">
        <?php else: ?>
          <div class="set-thumb placeholder"></div>
        <?php endif; ?>
        <span class="set-label"><?php echo htmlspecialchars($setName, ENT_QUOTES, 'UTF-8'); ?></span>
      </a>
    <?php endforeach; ?>
  </div>

<?php else: ?>

  <?php
  // Show your per-set info.php if it exists
  if ($folder && file_exists(__DIR__ . '/' . $folder . '/info.php')) {
      include __DIR__ . '/' . $folder . '/info.php';
  } else {
      // fallback (no layout changes)
      echo '<div class="set-width"><a class="home-box" href="gallery.php">Gallery Home</a></div>';
  }
  ?>

  <?php if (!empty($images)): ?>
    <div class="image-container set-width">
      <?php foreach ($images as $pair): ?>
        <?php if ($pair['b']): ?>
          <img class="thumb-img"
               src="<?php echo htmlspecialchars($pair['a'], ENT_QUOTES, 'UTF-8'); ?>"
               data-hover="<?php echo htmlspecialchars($pair['b'], ENT_QUOTES, 'UTF-8'); ?>"
               data-original="<?php echo htmlspecialchars($pair['a'], ENT_QUOTES, 'UTF-8'); ?>"
               onmouseover="this.src=this.dataset.hover"
               onmouseout="this.src=this.dataset.original" alt="">
        <?php else: ?>
          <img class="thumb-img"
               src="<?php echo htmlspecialchars($pair['a'], ENT_QUOTES, 'UTF-8'); ?>"
               data-original="<?php echo htmlspecialchars($pair['a'], ENT_QUOTES, 'UTF-8'); ?>"
               alt="">
        <?php endif; ?>
      <?php endforeach; ?>
    </div>

    <?php
    // Show per-set varieties.php if it exists
    if ($folder && file_exists(__DIR__ . '/' . $folder . '/varieties.php')) {
        include __DIR__ . '/' . $folder . '/varieties.php';
    }
    ?>
  <?php else: ?>
    <p>No images found for <?php echo htmlspecialchars($selectedSet, ENT_QUOTES, 'UTF-8'); ?>.</p>
  <?php endif; ?>

  <!-- Modal -->
  <div id="imageModal" class="modal">
    <span class="modal-close">&times;</span>
    <img id="modalImg" src="" alt="">
  </div>

  <?php include __DIR__ . '/inc/modal_script.php'; ?>

<?php endif; ?>

<?php include __DIR__ . '/inc/page_bottom.php'; ?>
