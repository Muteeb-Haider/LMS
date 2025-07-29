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
        <h2 class="text-2xl font-semibold">Task: <?php echo e($task->name); ?></h2>
     <?php $__env->endSlot(); ?>

    <?php if(session('success')): ?>
        <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 3000)"
            class="mb-6 p-4 bg-green-100 text-green-700 rounded-lg shadow">
            <?php echo e(session('success')); ?>

        </div>
    <?php endif; ?>

    <div class="py-10 max-w-5xl mx-auto space-y-8">

        
<div class="bg-white p-6 rounded-lg shadow space-y-3">
    <h3 class="text-xl font-semibold text-gray-800">📝 Task Details</h3>
    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-sm text-gray-700">
        <div><strong>Subject:</strong> <?php echo e($subject->name); ?></div>
        <div><strong>Teacher:</strong> <?php echo e($subject->teacher->name ?? 'Unknown'); ?></div>
        <div><strong>Description:</strong> <?php echo e($task->description); ?></div>
        <div><strong>Points:</strong> <?php echo e($task->points); ?></div>
        <div><strong>Created At:</strong> <?php echo e($task->created_at->format('d M Y')); ?></div>
        <div><strong>Total Submissions:</strong> <?php echo e($task->solutions->count()); ?></div>
        <div><strong>Evaluated Submissions:</strong> <?php echo e($task->solutions->whereNotNull('evaluated_at')->count()); ?></div>
    </div>

    <?php if(auth()->user()->isTeacher()): ?>
        <a href="<?php echo e(route('tasks.edit', [$task->subject_id, $task->id])); ?>"
            class="inline-block mt-5 px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700 text-sm">
            ✏️ Edit Task
        </a>
    <?php endif; ?>
</div>


        
        <?php if(auth()->user()->isTeacher()): ?>
            <div class="bg-white p-6 rounded-lg shadow">
                <h3 class="text-lg font-semibold mb-4">📨 Submitted Solutions</h3>
                <?php
                    $latestSolutions = $task->solutions->sortByDesc('created_at')->unique('user_id');
                ?>

                <?php if($latestSolutions->isEmpty()): ?>
                    <p class="text-gray-600">No solutions submitted yet.</p>
                <?php else: ?>
                    <table class="min-w-full text-sm border rounded shadow">
                        <thead class="bg-gray-100 text-left">
                            <tr>
                                <th class="px-4 py-2">Submitted At</th>
                                <th class="px-4 py-2">Student Name</th>
                                <th class="px-4 py-2">Student Email</th>
                                <th class="px-4 py-2">Points</th>
                                <th class="px-4 py-2">Evaluated At</th>
                                <th class="px-4 py-2">Action</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y">
                            <?php $__currentLoopData = $latestSolutions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $solution): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td class="px-4 py-2"><?php echo e($solution->created_at->format('d M Y H:i')); ?></td>
                                    <td class="px-4 py-2"><?php echo e($solution->user->name ?? 'N/A'); ?></td>
                                    <td class="px-4 py-2"><?php echo e($solution->user->email ?? 'N/A'); ?></td>
                                    <td class="px-4 py-2"><?php echo e($solution->points ?? '—'); ?></td>
                                    <td class="px-4 py-2">
                                        <?php if($solution->evaluated_at): ?>
                                            <?php echo e($solution->evaluated_at->format('d M Y H:i')); ?>

                                        <?php else: ?>
                                            —
                                        <?php endif; ?>
                                    </td>
                                    <td class="px-4 py-2">
                                        <?php if($solution->evaluated_at): ?>
                                            <div class="text-green-700 font-semibold">✓ Evaluated</div>
                                        <?php endif; ?>
                                        <a href="<?php echo e(route('solutions.evaluate', [$subject->id, $task->id, $solution->id])); ?>"
                                            class="text-sm mt-2 px-3 py-1 bg-green-600 text-white rounded hover:bg-green-700 block text-center">
                                            <?php echo e($solution->evaluated_at ? '♻️ Re-Evaluate' : '✅ Evaluate'); ?>

                                        </a>
                                    </td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                    </table>
                <?php endif; ?>
            </div>
        <?php endif; ?>

        
        <?php if(auth()->user()->isStudent()): ?>
            <div class="bg-white p-6 rounded-lg shadow space-y-6">
                <h3 class="text-lg font-semibold text-gray-800">📝 Submit Your Solution</h3>

                <form action="<?php echo e(route('solutions.store', [$subject->id, $task->id])); ?>" method="POST">
                    <?php echo csrf_field(); ?>

                    <div>
                        <label class="block font-medium text-gray-700 mb-2">Solution</label>
                        <textarea name="solution_text" rows="6" class="w-full border-gray-300 rounded-md shadow-sm" ><?php echo e(old('solution_text')); ?></textarea>

                        <?php $__errorArgs = ['solution_text'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <p class="text-red-600 text-sm mt-1"><?php echo e($message); ?></p>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>

                     
                    </div>

                    <div>
                        <button type="submit" class="bg-green-600 hover:bg-green-700 text-white font-semibold py-2 px-4 rounded">
                            📤 <?php echo e($task->solutions->where('user_id', auth()->id())->isEmpty() ? 'Submit' : 'Resubmit'); ?> Solution
                        </button>
                    </div>
                </form>

                <?php
                    $myLatestSolution = $task->solutions->where('user_id', auth()->id())->sortByDesc('created_at')->first();
                ?>

                <?php if($myLatestSolution): ?>
                    <div class="mt-6 text-sm text-gray-600">
                        <p><strong>Last Submitted At:</strong> <?php echo e($myLatestSolution->created_at->format('d M Y H:i')); ?></p>
                        <?php if($myLatestSolution->points !== null): ?>
                            <p><strong>Points Awarded:</strong> <?php echo e($myLatestSolution->points); ?> / <?php echo e($task->points); ?></p>
                            <p><strong>Last Evaluated At:</strong> <?php echo e($myLatestSolution->evaluated_at ? $myLatestSolution->evaluated_at->format('d M Y H:i') : '—'); ?></p>
                        <?php endif; ?>
                    </div>
                <?php endif; ?>

            </div>
        <?php endif; ?>

        <div class="mt-6">
            <a href="<?php echo e(route('subjects.show', $subject->id)); ?>"
                class="inline-block px-5 py-2 bg-blue-600 hover:bg-blue-700 text-white text-sm font-semibold rounded-lg shadow">
                ← Back to Subject Details
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
<?php endif; ?>
<?php /**PATH C:\Users\DELL\Desktop\lms-app\resources\views/tasks/show.blade.php ENDPATH**/ ?>