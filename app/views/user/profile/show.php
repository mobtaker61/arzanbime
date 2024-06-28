<?php
$description = "صفحه ورود به سایت.";
$keywords = "ورود, سایت";
?>
<!-- views/user/profile/show.php -->
<div class="container mx-auto p-4">
    <div class="grid grid-cols-2 md:grid-cols-2 gap-4">
        <div class="flex flex-col items-center">
            <?php if ($profile['profile_image']): ?>
                <img src="<?php echo $profile['profile_image']; ?>" alt="Profile Image" class="w-32 h-32 rounded-full">
            <?php else: ?>
                <div class="w-32 h-32 rounded-full bg-gray-200 flex items-center justify-center text-gray-500">
                    <i class="ph-user-bold text-4xl"></i>
                </div>
            <?php endif; ?>
            <a href="/user/profile/edit/<?php echo  $profile['id']?>" class="mt-4 bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">ویرایش پروفایل</a>
        </div>
        <div class="flex flex-col">
            <div class="mb-4">
                <label class="block text-gray-700">نام:</label>
                <p class="mt-1 p-2 border rounded"><?php echo $profile['name']; ?></p>
            </div>
            <div class="mb-4">
                <label class="block text-gray-700">نام خانوادگی:</label>
                <p class="mt-1 p-2 border rounded"><?php echo $profile['surname']; ?></p>
            </div>
            <div class="mb-4">
                <label class="block text-gray-700">تاریخ تولد:</label>
                <p class="mt-1 p-2 border rounded"><?php echo $profile['birth_date']; ?></p>
            </div>
            <div class="mb-4">
                <label class="block text-gray-700">ایمیل:</label>
                <p class="mt-1 p-2 border rounded"><?php echo $profile['email']; ?></p>
            </div>
            <div class="mb-4">
                <label class="block text-gray-700">تلفن:</label>
                <p class="mt-1 p-2 border rounded"><?php echo $profile['phone']; ?></p>
            </div>
            <div class="mb-4">
                <label class="block text-gray-700">تایید شده:</label>
                <p class="mt-1 p-2 border rounded"><?php echo $profile['is_verified'] ? 'بله' : 'خیر'; ?></p>
            </div>
        </div>
    </div>
</div>


