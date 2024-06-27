<?php
// Determine which section to hide
$currentType = $postType ?? '';
?>

<div class="sticky h-full tablet-medium:hidden">
    <?php if ($currentType !== 'guide') : ?>
        <div class="rounded-xl border-2 border-vkl-bg-card border-solid overflow-y-scroll p-3 mb-6">
            <h2 class="h3-bar">آخرین راهنماها</h2>
            <ul class="[&_li:first-child_a]:pt-0 text-justify">
                <?php foreach ($latestGuides as $guide) : ?>
                    <li>
                        <a href="/post/<?php echo $guide['id']; ?>" class="pt-8 pl-2 grid grid-cols-[20%_80%] gap-x-2">
                            <img src="<?php echo $guide['image']; ?>" class="w-full h-full object-cover rounded-md max-h-10 grayscale" alt="<?php echo $guide['title']; ?>" />
                            <p><?php echo $guide['title']; ?></p>
                        </a>
                    </li>
                <?php endforeach; ?>
            </ul>
        </div>
    <?php endif; ?>

    <?php if ($currentType !== 'notice') : ?>
        <div class="rounded-xl border-2 border-vkl-bg-card border-solid overflow-y-scroll p-3 mb-6">
            <h2 class="h3-bar">آخرین اطلاعیه‌ها</h2>
            <ul class="[&_li:first-child_a]:pt-0 text-justify">
                <?php foreach ($latestNotices as $notice) : ?>
                    <li>
                        <a href="/post/<?php echo $notice['id']; ?>" class="pt-8 pl-2">
                            <p><?php echo $notice['title']; ?></p>
                        </a>
                    </li>
                <?php endforeach; ?>
            </ul>
        </div>
    <?php endif; ?>

    <?php if ($currentType !== 'faq') : ?>
        <div class="rounded-xl border-2 border-vkl-bg-card border-solid overflow-y-scroll p-3">
            <h2 class="h3-bar">آخرین سوالات</h2>
            <ul class="[&_li:first-child_a]:pt-0 text-justify">
                <?php foreach ($latestFaqs as $faq) : ?>
                    <li>
                        <a href="/post/<?php echo $faq['id']; ?>" class="pt-8 pl-2">
                            <p><?php echo $faq['title']; ?></p>
                        </a>
                    </li>
                <?php endforeach; ?>
            </ul>
        </div>
    <?php endif; ?>
</div>
