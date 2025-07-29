<?php if (isset($component)) { $__componentOriginal9ac128a9029c0e4701924bd2d73d7f54 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54 = $attributes; } ?>
<?php $component = App\View\Components\AppLayout::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('app-layout'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\App\View\Components\AppLayout::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
     <?php $__env->slot('header', null, []); ?> 
        <h2 class="text-2xl font-semibold text-gray-800">Teacher Dashboard</h2>
     <?php $__env->endSlot(); ?>

    <div class="py-10 max-w-6xl mx-auto space-y-8 px-4">

        <!-- Welcome Message -->
        <div class="bg-white p-6 rounded-lg shadow">
            <h3 class="text-lg font-semibold mb-2">Welcome, <?php echo e(auth()->user()->name); ?> (Teacher)</h3>
            <p class="text-gray-600">Here's a snapshot of your activity.</p>
        </div>

        <!-- Overview Section -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <div class="bg-blue-100 p-6 rounded-lg shadow">
                <h4 class="text-sm font-semibold text-gray-700">Subjects Created</h4>
                <p class="text-2xl mt-2"><?php echo e($subjectsCount ?? '0'); ?></p>
            </div>

            <div class="bg-yellow-100 p-6 rounded-lg shadow">
                <h4 class="text-sm font-semibold text-gray-700">Tasks Created</h4>
                <p class="text-2xl mt-2"><?php echo e($tasksCount ?? '0'); ?></p>
            </div>

            <div class="bg-green-100 p-6 rounded-lg shadow">
                <h4 class="text-sm font-semibold text-gray-700">Students Enrolled</h4>
                <p class="text-2xl mt-2"><?php echo e($studentsCount ?? '0'); ?></p>
            </div>
        </div>

        <!-- Motivation -->
        <div class="bg-green-100 p-6 rounded-lg shadow text-center">
            <p class="italic font-medium text-green-700">
                "A good teacher can inspire hope, ignite the imagination, and instill a love of learning."
            </p>
        </div>
    </div>
 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54)): ?>
<?php $attributes = $__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54; ?>
<?php unset($__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal9ac128a9029c0e4701924bd2d73d7f54)): ?>
<?php $component = $__componentOriginal9ac128a9029c0e4701924bd2d73d7f54; ?>
<?php unset($__componentOriginal9ac128a9029c0e4701924bd2d73d7f54); ?>
<?php endif; ?><?php /**PATH C:\Users\DELL\Desktop\lms-app\resources\views/dashboard/teacher.blade.php ENDPATH**/ ?>