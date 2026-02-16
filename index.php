<?php
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
    '1968 Post'             => 'm68p',
    '1970 Post'             => 'm70p',
    '1975 Post'             => 'm75p',
    '1978 Post'             => 'm78p',
    '1978 Super Sips candy' => 's78s',
    '1979 Post'             => 'm79p',
    '1980 Post'             => 'm80p',
    '1981 Post'             => 'm81p',
    '1982 Post'             => 'm82p',
    '1983 Post'             => 'm83p',
    '1984 Post'             => 'm84p',
    '1986 Post'             => 'm86p',
    '1987 Post'             => 'm87p',
    '1988 Post'             => 'm88p',
    '1989 Post'             => 'm89p',
    '1990 Post'             => 'm90p',
];

// Compute availability + thumbnail (first "*a.xxx" image) per set
$availableSets  = [];
$setThumbnails  = [];

foreach ($folderMap as $setName => $folder) {
    $dirPath = __DIR__ . '/plates/' . $folder;
    $availableSets[$setName] = false;
    $setThumbnails[$setName] = null;

    if (is_dir($dirPath)) {
        $files = scandir($dirPath);
        foreach ($files as $file) {
            // look for first "a" image (e.g., 001a.jpg)
            if (preg_match('/a\.(jpg|jpeg|png|gif|webp|bmp)$/i', $file)) {
                $availableSets[$setName] = true;
                $setThumbnails[$setName] = $folder . '/' . $file; // web path
                break;
            }
        }
    }
}

$selectedSet = isset($_GET['year']) ? $_GET['year'] : null; // 'year' now holds the set label
$images = [];

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
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Cereal and other premium prize miniature license plates</title>
    <link rel="stylesheet" href="main.css" />
</head>
<body>
        <?php include 'header.php'; ?>

        <div class="content-wrapper">
    <!-- Everything currently inside goes here -->

    <?php if (!$selectedSet): ?>
        <!-- Home view: show all sets -->
        <div class="set-list set-width">
            <?php foreach ($folderMap as $setName => $folder): ?>
                <?php $enabled = !empty($availableSets[$setName]); ?>
                <a
                    class="set-box<?php echo $enabled ? '' : ' disabled'; ?>"
                    <?php if ($enabled): ?>
                        href="?year=<?php echo urlencode($setName); ?>"
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
                    <span class="set-label">
                        <?php echo htmlspecialchars($setName, ENT_QUOTES, 'UTF-8'); ?>
                    </span>
                </a>
            <?php endforeach; ?>
        </div>
    <?php else: ?>
        <!-- Instruction text + Home button when inside a set -->
        <div class="set-width">
                    The Full Library of mini license plate images. We are still working on this section, but keep coming back to see
        more sets listed as we obtain samples for images. If you have any sets that you do not see here, please feel free to contact me and we will arrange
        having them listed here. Enjoy!
            <br>Click on any image to see the front of the plate in full screen size.<br><br>
            <a class="home-box" href="<?php echo htmlspecialchars($_SERVER['PHP_SELF'], ENT_QUOTES, 'UTF-8'); ?>">
                Home
            </a>
        </div>
    <?php endif; ?>

    <?php if ($selectedSet && !empty($images)): ?>
        <div class="image-container set-width">
            <?php foreach ($images as $pair): ?>
                <?php if ($pair['b']): ?>
                    <img class="thumb-img"
                         src="<?php echo htmlspecialchars($pair['a'], ENT_QUOTES, 'UTF-8'); ?>"
                         data-hover="<?php echo htmlspecialchars($pair['b'], ENT_QUOTES, 'UTF-8'); ?>"
                         data-original="<?php echo htmlspecialchars($pair['a'], ENT_QUOTES, 'UTF-8'); ?>"
                         onmouseover="this.src=this.dataset.hover"
                         onmouseout="this.src=this.dataset.original">
                <?php else: ?>
                    <img class="thumb-img"
                         src="<?php echo htmlspecialchars($pair['a'], ENT_QUOTES, 'UTF-8'); ?>"
                         data-original="<?php echo htmlspecialchars($pair['a'], ENT_QUOTES, 'UTF-8'); ?>"
                         alt="">
                <?php endif; ?>
            <?php endforeach; ?>
        </div>
    <?php elseif ($selectedSet && empty($images)): ?>
        <p>No images found for <?php echo htmlspecialchars($selectedSet, ENT_QUOTES, 'UTF-8'); ?>.</p>
    <?php endif; ?>

    <!-- Modal -->
    <div id="imageModal" class="modal">
        <span class="modal-close">&times;</span>
        <img id="modalImg" src="" alt="">
    </div>


        </div>

        <?php include 'footer.php'; ?>

</body>

    <script>
        (function () {
            const modal = document.getElementById('imageModal');
            const modalImg = document.getElementById('modalImg');
            const closeBtn = document.querySelector('.modal-close');

            if (!modal || !modalImg || !closeBtn) return;

            // Open modal – always show "a" side
            document.querySelectorAll('.thumb-img').forEach(function (img) {
                img.addEventListener('click', function () {
                    modal.style.display = 'flex';
                    let src = this.dataset.original || this.src;
                    src = src.replace(/([ab])(\.[^.]+)$/i, 'a$2');
                    modalImg.src = src;
                });
            });

            const closeModal = function () {
                modal.style.display = 'none';
                modalImg.src = '';
            };

            closeBtn.addEventListener('click', closeModal);
            modal.addEventListener('click', function (e) {
                if (e.target === modal) closeModal();
            });
            modalImg.addEventListener('click', closeModal);
            document.addEventListener('keydown', function (e) {
                if (e.key === 'Escape' && modal.style.display === 'flex') {
                    closeModal();
                }
            });
        })();
    </script>

</body>
</html>