<?php $__env->startSection('content'); ?>
    <div class="max-w-7xl mx-auto px-4 py-6">
        <div class="bg-white p-6 rounded-xl shadow-md">
            <h1 class="text-2xl font-bold mb-4">Overzicht Klanten</h1>

            
            <?php if(session('error')): ?>
                <div class="bg-red-100 text-red-700 p-4 rounded mb-4">
                    <strong>Fout!</strong> <?php echo e(session('error')); ?>

                </div>
            <?php endif; ?>

            
            <form method="GET" action="<?php echo e(route('customers.index')); ?>" class="mb-6 flex items-center gap-4">
                <label for="date" class="text-sm font-medium text-gray-700">Selecteer datum (Registratiedatum tot):</label>
                <input type="text" id="date" name="date" value="<?php echo e(old('date', request('date'))); ?>" class="border rounded p-2 text-sm w-40" placeholder="YYYY-MM-DD" />
                <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                    Filter
                </button>
            </form>

            
            <div class="overflow-x-auto">
                <?php if($customers->isEmpty()): ?>
                    <div class="text-center py-6">Er is geen informatie beschikbaar voor deze geselecteerde datum.</div>
                <?php else: ?>
                    <table class="min-w-full table-auto border border-gray-200">
                        <thead class="bg-gray-100">
                            <tr>
                                <th class="px-4 py-2 text-left">Naam</th>
                                <th class="px-4 py-2 text-left">Mobiel</th>
                                <th class="px-4 py-2 text-left">Email</th>
                                <th class="px-4 py-2 text-left">Volwassen</th>
                                <th class="px-4 py-2 text-left">Acties</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__currentLoopData = $customers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $customer): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr class="border-t">
                                    <td class="px-4 py-2"><?php echo e($customer->first_name . ' ' . $customer->last_name); ?></td>
                                    <td class="px-4 py-2"><?php echo e(optional($customer->contact)->mobile ?? '—'); ?></td>
                                    <td class="px-4 py-2"><?php echo e(optional($customer->contact)->email ?? '—'); ?></td>
                                    <td class="px-4 py-2"><?php echo e($customer->is_adult ? 'Ja' : 'Nee'); ?></td>
                                    <td class="px-4 py-2">
                                        <a href="<?php echo e(route('customers.edit', $customer->id)); ?>" class="text-blue-600 hover:text-blue-800">Wijzigen</a>
                                    </td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                    </table>
                <?php endif; ?>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\dag_03\resources\views/customers/index.blade.php ENDPATH**/ ?>