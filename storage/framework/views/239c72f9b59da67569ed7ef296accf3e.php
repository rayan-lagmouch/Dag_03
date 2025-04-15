<?php $__env->startSection('content'); ?>
    <div class="container mx-auto p-8">
        <h1 class="text-4xl font-semibold text-center mb-8 text-gray-800">Edit Package for Reservation #<?php echo e($reservation->id); ?></h1>

        <!-- Succes- en foutmelding -->
        <?php if(session('success')): ?>
            <div class="bg-green-100 text-green-700 p-4 rounded-md shadow-md mb-6">
                <p class="font-medium"><?php echo e(session('success')); ?></p>
            </div>
        <?php elseif($errors->any()): ?>
            <div class="bg-red-100 text-red-700 p-4 rounded-md shadow-md mb-6">
                <ul>
                    <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <li><?php echo e($error); ?></li>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </ul>
            </div>
        <?php endif; ?>

        <form action="<?php echo e(route('reservations.update-package', $reservation->id)); ?>" method="POST" class="bg-white p-8 rounded-lg shadow-xl">
            <?php echo csrf_field(); ?>
            <?php echo method_field('POST'); ?>

            <!-- Package Option Selection -->
            <div class="mb-6">
                <label for="package_option" class="block text-lg font-medium text-gray-700">Select Package Option</label>
                <select id="package_option" name="package_option" class="mt-2 block w-full p-3 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                    <option value="" disabled <?php echo e(!$reservation->package_option ? 'selected' : ''); ?>>Choose a package</option>
                    <?php $__currentLoopData = $packages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $package): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($package->id); ?>" <?php echo e($reservation->package_option_id == $package->id ? 'selected' : ''); ?>>
                            <?php echo e($package->name); ?>

                        </option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
                <?php $__errorArgs = ['package_option'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                <p class="text-red-500 mt-2 text-sm"><?php echo e($message); ?></p>
                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>

            <!-- Submit Button -->
            <div class="flex justify-center mt-6">
                <button type="submit" class="bg-green-500 text-white px-8 py-3 rounded-md shadow-md hover:bg-green-600 focus:outline-none focus:ring-2 focus:ring-green-400 transition duration-200 ease-in-out">
                    Update Package
                </button>
            </div>
        </form>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\dag03\resources\views/reservations/edit-package.blade.php ENDPATH**/ ?>