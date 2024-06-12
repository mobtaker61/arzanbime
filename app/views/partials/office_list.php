<div id="office-list" class="gap-3 justify-center items-center flex flex-wrap">
    <?php foreach ($offices as $office) : ?>
        <div id="office-contacts<?php echo $office['id']; ?>" dir="ltr" class="border-red-700 border-2 pointer-events-auto map-message-box text-neutral-900 w-fit mobile-medium:w-full bg-neutral-50 rounded-2xl z-0 p-6 mobile-large:p-5 relative dashed-br-dark">
            <h3 class="text-vkl-t-sub-header font-bold text-red-700 mb-2">
                <?php echo $office['name']; ?>
            </h3>
            <ul class="grid gap-2 grid-cols-1 mobile-medium:mt-5">
                <li class="flex justify-start items-center gap-2">
                    <span><i class="ph text-red-700 ph-map-pin text-xl"></i></span>
                    <span><?php echo $office['address']; ?></span>
                </li>
                <li class="flex justify-start items-center gap-2">
                    <span><i class="ph text-red-700 ph-phone text-xl"></i></span>
                    <a href="tel:<?php echo $office['telephone']; ?>"><?php echo $office['telephone']; ?></a>
                </li>
                <li class="flex justify-start items-center gap-2">
                    <span><i class="ph text-red-700 ph-envelope-simple text-xl"></i></span>
                    <a href="mailto:<?php echo $office['email']; ?>"><?php echo $office['email']; ?></a>
                </li>
            </ul>
        </div>
    <?php endforeach; ?>
</div>
