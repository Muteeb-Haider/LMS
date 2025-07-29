<!DOCTYPE html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>LMSOnly</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />

    <!-- Styles and Scripts -->
    <?php echo app('Illuminate\Foundation\Vite')(['resources/css/app.css', 'resources/js/app.js']); ?>
</head>
<body class="bg-white dark:bg-gray-900 text-gray-800 dark:text-gray-100 flex flex-col items-center justify-center min-h-screen p-6">

    <header class="w-full max-w-4xl mb-6">
        <?php if(Route::has('login')): ?>
            <nav class="flex justify-end gap-4 text-sm">
                <?php if(auth()->guard()->check()): ?>
                    <a href="<?php echo e(url('/dashboard')); ?>" class="px-4 py-2 border border-gray-300 rounded hover:bg-gray-100 dark:border-gray-700 dark:hover:bg-gray-800">
                        Dashboard
                    </a>
                <?php else: ?>
                    <a href="<?php echo e(route('login')); ?>" class="px-4 py-2 text-blue-600 hover:underline">
                        Log in
                    </a>
                    <?php if(Route::has('register')): ?>
                        <a href="<?php echo e(route('register')); ?>" class="px-4 py-2 text-blue-600 hover:underline">
                            Register
                        </a>
                    <?php endif; ?>
                <?php endif; ?>
            </nav>
        <?php endif; ?>
    </header>

    <main class="w-full max-w-4xl bg-gray-50 dark:bg-gray-800 rounded-lg shadow p-8 text-center">
        <h1 class="text-3xl font-bold mb-4">🎓 Welcome to LMSOnly</h1>

        <!-- Static Description -->
        <p class="text-lg text-gray-700 dark:text-gray-300 mb-6">
            LMSOnly is a simple Learning Management System built with Laravel. This platform allows educators to manage subjects, students, and content efficiently. Use the navigation links above to get started.
        </p>

        <a href="<?php echo e(url('/dashboard')); ?>" class="px-6 py-3 bg-blue-600 text-white rounded hover:bg-blue-700 transition">
            Enter Dashboard
        </a>
    </main>

    <footer class="text-center text-sm text-gray-500 mt-6">
        &copy; <?php echo e(date('Y')); ?> LMSOnly. All rights reserved.
    </footer>

</body>
</html>
<?php /**PATH C:\Users\DELL\Desktop\lms-app\resources\views/welcome.blade.php ENDPATH**/ ?>