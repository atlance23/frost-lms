<?php
/**
 * Title: Frost LMS Admin
 * Slug: frost-lms-admin
 * Inserter: no
 */
?>
<section class="relative">
    <aside class="w-screen md:w-48 h-screen p-4 bg-blue-100 absolute inset-0">
        <h2 class="text-lg font-bold text-white-100 mb-4">Frost LMS Admin</h2>
        <nav>
            <ul class="space-y-2">
                <li><a href="<?php echo esc_url( admin_url( 'admin.php?page=frost_lms_settings' ) ); ?>" class="text-blue-600 hover:underline">Settings</a></li>
                <li><a href="<?php echo esc_url( admin_url( 'admin.php?page=frost_lms_courses' ) ); ?>" class="text-blue-600 hover:underline">Courses</a></li>
                <li><a href="<?php echo esc_url( admin_url( 'admin.php?page=frost_lms_students' ) ); ?>" class="text-blue-600 hover:underline">Students</a></li>
                <li><a href="<?php echo esc_url( admin_url( 'admin.php?page=frost_lms_reports' ) ); ?>" class="text-blue-600 hover:underline">Reports</a></li>
                <li><a href="<?php echo esc_url( admin_url( 'admin.php?page=frost_lms_support' ) ); ?>" class="text-blue-600 hover:underline">Support</a></li>
            </ul>
        </nav>
    </aside>
    <div>

    </div>
</section>