<!-- resources/views/dashboard/student.blade.php -->
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
        <h2 class="text-2xl font-semibold text-gray-800">Dashboard</h2>
     <?php $__env->endSlot(); ?>

    <div class="py-10 max-w-6xl mx-auto space-y-8 px-4">

        <!-- Welcome Message -->
        <div class="bg-white p-6 rounded-lg shadow">
            <h3 class="text-lg font-semibold mb-2">Welcome, <?php echo e(auth()->user()->name); ?> </h3>
            <p class="text-gray-600">Here's a quick overview of your progress.</p>
        </div>

        <!-- Overview Section -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <div class="bg-blue-100 p-6 rounded-lg shadow">
                <h4 class="text-sm font-semibold text-gray-700">Subjects Taken</h4>
                <p class="text-2xl mt-2"><?php echo e($subjectsCount ?? '0'); ?></p>
            </div>

            <div class="bg-yellow-100 p-6 rounded-lg shadow">
                <h4 class="text-sm font-semibold text-gray-700">Pending Tasks</h4>
                <p class="text-2xl mt-2"><?php echo e($pendingTasksCount ?? '0'); ?></p>
            </div>

            <div class="bg-green-100 p-6 rounded-lg shadow">
                <h4 class="text-sm font-semibold text-gray-700">Completed Tasks</h4>
                <p class="text-2xl mt-2"><?php echo e($completedTasksCount ?? '0'); ?></p>
            </div>
        </div>

        <!-- Upcoming Deadlines -->
        <div class="bg-white p-6 rounded-lg shadow space-y-4">
            <h3 class="text-lg font-semibold text-gray-800">Upcoming Deadlines</h3>
            <?php $__empty_1 = true; $__currentLoopData = $upcomingTasks; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $task): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <div class="text-sm text-gray-700">
                    <strong><?php echo e($task->name); ?></strong> - Due
                    <?php echo e($task->due_date ? $task->due_date->diffForHumans() : 'No due date'); ?>

                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <p class="text-gray-600">No upcoming tasks.</p>
            <?php endif; ?>
        </div>

        <!-- Motivation -->
        <div class="bg-purple-100 p-6 rounded-lg shadow text-center">
            <p class="italic font-medium text-purple-700">
                "Success is the sum of small efforts repeated day in and day out."
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
<?php endif; ?><?php /**PATH C:\Users\DELL\Desktop\lms-app\resources\views/dashboard/student.blade.php ENDPATH**/ ?>