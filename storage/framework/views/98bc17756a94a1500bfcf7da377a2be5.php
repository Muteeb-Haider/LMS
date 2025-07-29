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
        <h2 class="text-2xl font-semibold text-gray-800">📘 Subject Details (Student View)</h2>
     <?php $__env->endSlot(); ?>

    <div class="py-10 max-w-6xl mx-auto px-4 space-y-8">

        
        <div class="bg-white rounded-lg shadow p-6 space-y-2">
            <h3 class="text-lg font-semibold text-gray-800">📄 Overview</h3>
            <div class="grid grid-cols-2 gap-4 text-sm text-gray-700">
                <div><strong>Name:</strong> <?php echo e($subject->name); ?></div>
                <div><strong>Description:</strong> <?php echo e($subject->description); ?></div>
                <div><strong>Code:</strong> <?php echo e($subject->subject_code); ?></div>
                <div><strong>Credits:</strong> <?php echo e($subject->credit_value); ?></div>
                <div><strong>Created At:</strong> <?php echo e($subject->created_at->format('d M Y')); ?></div>
                <div><strong>Last Modified:</strong> <?php echo e($subject->updated_at->format('d M Y')); ?></div>
                <div><strong>Teacher:</strong> <?php echo e($subject->teacher->name); ?> (<?php echo e($subject->teacher->email); ?>)</div>
                <div><strong>Number of Students:</strong> <?php echo e($studentCount); ?></div>
            </div>
        </div>

        
        <div class="bg-white rounded-lg shadow p-6">
            <h3 class="text-lg font-semibold text-gray-800 mb-4">👩‍🎓 Enrolled Students</h3>
            <?php $__empty_1 = true; $__currentLoopData = $students; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $student): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <div class="text-sm text-gray-700 mb-2">
                    <strong><?php echo e($student->name); ?></strong> — <?php echo e($student->email); ?>

                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <p class="text-sm text-gray-600">No students enrolled yet.</p>
            <?php endif; ?>
        </div>

        
        <div class="bg-white rounded-lg shadow p-6">
            <h3 class="text-lg font-semibold text-gray-800 mb-4">📋 Tasks</h3>

            <?php if($subject->tasks->isEmpty()): ?>
                <p class="text-gray-600 text-sm">No tasks available for this subject.</p>
            <?php else: ?>
                <table class="min-w-full bg-white divide-y divide-gray-200 border rounded">
                    <thead class="bg-gray-50 text-xs font-semibold text-gray-500 uppercase">
                        <tr>
                            <th class="px-6 py-3 text-left">Task Name</th>
                            <th class="px-6 py-3 text-left">Points</th>
                            <th class="px-6 py-3 text-left">Status</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200 text-sm text-gray-700">
                        <?php $__currentLoopData = $subject->tasks; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $task): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr class="hover:bg-gray-50">
                                <td class="px-6 py-4">
                                    <a href="<?php echo e(route('tasks.show', [$subject->id, $task->id])); ?>"
                                        class="text-blue-600 hover:underline font-medium">
                                        <?php echo e($task->name); ?>

                                    </a>
                                </td>
                                <td class="px-6 py-4"><?php echo e($task->points); ?></td>
                                <td class="px-6 py-4">
                                    <?php if($task->solutions->where('user_id', auth()->id())->count()): ?>
                                        <span class="text-green-600 font-semibold">✅ Submitted</span>
                                    <?php else: ?>
                                        <span class="text-red-600 font-semibold">❌ Not Submitted</span>
                                    <?php endif; ?>
                                </td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
            <?php endif; ?>
        </div>

        
        <div>
            <a href="<?php echo e(route('subjects.index')); ?>" class="text-blue-600 hover:underline text-sm">
                ← Back to My Subjects
            </a>
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
<?php endif; ?><?php /**PATH C:\Users\DELL\Desktop\lms-app\resources\views/subjects/show_student.blade.php ENDPATH**/ ?>