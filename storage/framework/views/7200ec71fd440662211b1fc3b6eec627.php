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
            <?php echo e(auth()->user()->isTeacher() ? 'Create New Subject' : 'Available Subjects'); ?>

        </h2>
     <?php $__env->endSlot(); ?>

    <div class="py-10 max-w-6xl mx-auto px-4">
        <?php if(session('success')): ?>
            <div class="mb-6 p-4 bg-green-100 text-green-700 rounded-lg shadow">
                <?php echo e(session('success')); ?>

            </div>
        <?php endif; ?>

        
        <?php if(auth()->user()->isTeacher()): ?>
            <div class="overflow-x-auto bg-white rounded-xl shadow p-6">
                <form action="<?php echo e(route('subjects.store')); ?>" method="POST" class="space-y-6">
                    <?php echo csrf_field(); ?>

                    <div>
                        <label class="block font-medium text-gray-700">Subject Name</label>
                        <input type="text" name="name" class="w-full mt-1 border-gray-300 rounded-md shadow-sm"
                            value="<?php echo e(old('name')); ?>">
                        <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <span class="text-red-600 text-sm"><?php echo e($message); ?></span> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>

                    <div>
                        <label class="block font-medium text-gray-700">Description</label>
                        <textarea name="description"
                            class="w-full mt-1 border-gray-300 rounded-md shadow-sm"><?php echo e(old('description')); ?></textarea>
                    </div>

                    <div>
                        <label class="block font-medium text-gray-700">Subject Code (e.g., IK-ABC123)</label>
                        <input type="text" name="subject_code" class="w-full mt-1 border-gray-300 rounded-md shadow-sm"
                            value="<?php echo e(old('subject_code')); ?>">
                        <?php $__errorArgs = ['subject_code'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <span
                        class="text-red-600 text-sm"><?php echo e($errors->first('subject_code')); ?></span> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>

                    <div>
                        <label class="block font-medium text-gray-700">Credit Value</label>
                        <input type="number" name="credit_value" class="w-full mt-1 border-gray-300 rounded-md shadow-sm"
                            value="<?php echo e(old('credit_value')); ?>">
                        <?php $__errorArgs = ['credit_value'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <span
                        class="text-red-600 text-sm"><?php echo e($errors->first('credit_value')); ?></span> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>

                    <div>
                        <button type="submit"
                            class="bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-4 rounded w-full">
                            Create Subject
                        </button>
                    </div>
                </form>
            </div>
        <?php endif; ?>

        
        <?php if(auth()->user()->isStudent()): ?>
            <div class="overflow-x-auto bg-white rounded-xl shadow mt-6">
                <?php if($subjects->isEmpty()): ?>
                    <div class="p-6 text-gray-600">
                        No subjects available to take.
                    </div>
                <?php else: ?>
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase">Name</th>
                                <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase">Description</th>
                                
                                <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase">Code</th>
                                <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase">Credits</th>
                                <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase">Teacher</th>
                                <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase">Action</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200">
                            <?php $__currentLoopData = $subjects; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $subject): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr class="hover:bg-gray-50">
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                        <?php echo e($subject->name); ?>

                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">
                                        <?php echo e($subject->description); ?>

                                    </td> 
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">
                                        <?php echo e($subject->subject_code); ?>

                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">
                                        <?php echo e($subject->credit_value); ?>

                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">
                                        <?php echo e($subject->teacher->name ?? 'N/A'); ?>

                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <form method="POST" action="<?php echo e(route('subjects.enroll', $subject->id)); ?>">
                                            <?php echo csrf_field(); ?>
                                            <button type="submit"
                                                class="bg-green-600 hover:bg-green-700 text-white font-semibold py-2 px-4 rounded text-sm">
                                                Enroll
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                    </table>
                <?php endif; ?>
            </div>
        <?php endif; ?>
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
<?php endif; ?><?php /**PATH C:\Users\DELL\Desktop\lms-app\resources\views/subjects/create.blade.php ENDPATH**/ ?>