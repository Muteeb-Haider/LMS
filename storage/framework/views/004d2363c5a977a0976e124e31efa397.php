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
        <h2 class="text-2xl font-semibold leading-tight text-gray-800">
            📚 <?php echo e(auth()->user()->isTeacher() ? 'Subjects' : 'My Subjects'); ?>

        </h2>
     <?php $__env->endSlot(); ?>

    <div class="py-10 max-w-6xl mx-auto px-4 space-y-8">
        <!-- 
        <?php if(session('success')): ?>
            <div class="mb-6 p-4 bg-green-100 text-green-700 rounded-lg shadow">
                <?php echo e(session('success')); ?>

            </div>
        <?php endif; ?> -->

        
        <?php if(auth()->user()->isStudent()): ?>
            <div class="mb-6 text-right">
                <a href="<?php echo e(route('subjects.create')); ?>"
                    class="inline-block px-5 py-2 bg-blue-600 hover:bg-blue-700 text-white text-sm font-semibold rounded-lg shadow">
                    ➕ Take a New Subject
                </a>
            </div>
        <?php endif; ?>

        <div class="overflow-x-auto bg-white rounded-xl shadow">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase">Name</th>
                        <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase">Code</th>
                        <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase">Credits</th>
                        <?php if(auth()->user()->isStudent()): ?>
                            <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase">Teacher</th>
                        <?php endif; ?>
                        <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    <?php $__empty_1 = true; $__currentLoopData = $subjects; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $subject): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-blue-600">
                                <a href="<?php echo e(route('subjects.show', $subject->id)); ?>" class="hover:underline">
                                    <?php echo e($subject->name); ?>

                                </a>
                            </td>

                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">
                                <?php echo e($subject->subject_code); ?>

                            </td>

                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">
                                <?php echo e($subject->credit_value); ?>

                            </td>

                            <?php if(auth()->user()->isStudent()): ?>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">
                                    <?php echo e($subject->teacher->name ?? 'Unknown'); ?>

                                </td>
                            <?php endif; ?>

                            <td class="px-6 py-4 whitespace-nowrap text-sm">
                                <?php if(auth()->user()->isTeacher()): ?>
                                    <a href="<?php echo e(route('subjects.edit', $subject->id)); ?>"
                                        class="text-blue-600 hover:underline mr-2">
                                        Edit
                                    </a> |
                                    <form action="<?php echo e(route('subjects.destroy', $subject->id)); ?>" method="POST"
                                        class="inline delete-form">
                                        <?php echo csrf_field(); ?>
                                        <?php echo method_field('DELETE'); ?>
                                        <button type="button" class="text-red-600 hover:underline ml-2 delete-button">
                                            Delete
                                        </button>
                                    </form>
                                <?php elseif(auth()->user()->isStudent()): ?>
                                    <form method="POST" action="<?php echo e(route('subjects.leave', $subject->id)); ?>"
                                        class="inline delete-form">
                                        <?php echo csrf_field(); ?>
                                        <?php echo method_field('DELETE'); ?>
                                        <button type="button" class="text-red-600 hover:underline delete-button">
                                            Drop Subject
                                        </button>
                                    </form>
                                <?php endif; ?>
                            </td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <tr>
                            <td colspan="<?php echo e(auth()->user()->isStudent() ? 5 : 4); ?>"
                                class="text-center py-6 text-sm text-gray-500">
                                No subjects found.
                            </td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>

    
    <?php $__env->startPush('scripts'); ?>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script>
            const deleteButtons = document.querySelectorAll('.delete-button');
            deleteButtons.forEach(button => {
                button.addEventListener('click', function () {
                    Swal.fire({
                        title: 'Are you sure?',
                        text: "You won't be able to revert this!",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#d33',
                        cancelButtonColor: '#3085d6',
                        confirmButtonText: 'Yes, confirm it!'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            this.closest('.delete-form').submit();
                        }
                    })
                });
            });
        </script>
    <?php $__env->stopPush(); ?>
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
<script>
    document.querySelectorAll('.leave-form').forEach(form => {
        form.addEventListener('submit', function (e) {
            e.preventDefault();
            Swal.fire({
                title: 'Are you sure?',
                text: "You will leave this subject!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, leave it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit();
                }
            });
        });
    });
</script><?php /**PATH C:\Users\DELL\Desktop\lms-app\resources\views/subjects/index.blade.php ENDPATH**/ ?>