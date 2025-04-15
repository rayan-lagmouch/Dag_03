

<?php $__env->startSection('content'); ?>
    <div class="max-w-7xl mx-auto px-4 py-6">
        <div class="bg-white p-6 rounded-xl shadow-md">
            <h1 class="text-2xl font-bold mb-4">Wijzig Klant Gegevens</h1>

            
            <?php if($errors->any()): ?>
                <div class="bg-red-100 text-red-700 p-4 rounded mb-4">
                    <strong>Fout!</strong> Het e-mailadres is al in gebruik.
                </div>
            <?php endif; ?>

            
            <form action="<?php echo e(route('customers.update', $customer->id)); ?>" method="POST">
                <?php echo csrf_field(); ?>
                <?php echo method_field('PUT'); ?>

                
                <div class="mb-4">
                    <label for="id" class="block text-sm font-medium text-gray-700">Klant ID</label>
                    <input type="text" id="id" name="id" value="<?php echo e(old('id', $customer->id)); ?>" class="border rounded p-2 w-full">
                </div>

                <div class="mb-4">
                    <label for="first_name" class="block text-sm font-medium text-gray-700">Voornaam</label>
                    <input type="text" id="first_name" name="first_name" value="<?php echo e(old('first_name', $customer->first_name)); ?>" class="border rounded p-2 w-full" required>
                </div>

                <div class="mb-4">
                    <label for="middle_name" class="block text-sm font-medium text-gray-700">Tussenvoegsel</label>
                    <input type="text" id="middle_name" name="middle_name" value="<?php echo e(old('middle_name', $customer->middle_name)); ?>" class="border rounded p-2 w-full">
                </div>

                <div class="mb-4">
                    <label for="last_name" class="block text-sm font-medium text-gray-700">Achternaam</label>
                    <input type="text" id="last_name" name="last_name" value="<?php echo e(old('last_name', $customer->last_name)); ?>" class="border rounded p-2 w-full" required>
                </div>

                <div class="mb-4">
                    <label for="nickname" class="block text-sm font-medium text-gray-700">Roepnaam</label>
                    <input type="text" id="nickname" name="nickname" value="<?php echo e(old('nickname', $customer->nickname)); ?>" class="border rounded p-2 w-full">
                </div>

                <div class="mb-4">
                    <label for="mobile" class="block text-sm font-medium text-gray-700">Mobiel</label>
                    <input type="text" id="mobile" name="mobile" value="<?php echo e(old('mobile', optional($customer->contact)->mobile)); ?>" class="border rounded p-2 w-full">
                </div>

                <div class="mb-4">
                    <label for="email" class="block text-sm font-medium text-gray-700">E-mailadres</label>
                    <input type="email" id="email" name="email" value="<?php echo e(old('email', optional($customer->contact)->email)); ?>" class="border rounded p-2 w-full" required>
                </div>

                <div class="mb-4">
                    <label for="is_adult" class="block text-sm font-medium text-gray-700">Volwassen</label>
                    <select id="is_adult" name="is_adult" class="border rounded p-2 w-full">
                        <option value="1" <?php echo e($customer->is_adult ? 'selected' : ''); ?>>Ja</option>
                        <option value="0" <?php echo e(!$customer->is_adult ? 'selected' : ''); ?>>Nee</option>
                    </select>
                </div>

                <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                    Wijzigen
                </button>
            </form>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\dag_03\resources\views/customers/edit.blade.php ENDPATH**/ ?>