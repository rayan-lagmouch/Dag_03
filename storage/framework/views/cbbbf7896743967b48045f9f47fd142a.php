<?php $__env->startSection('content'); ?>
    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-md rounded-2xl p-6">
                <h2 class="text-2xl font-bold mb-4">Dashboard</h2>

                <p class="text-gray-600 mb-6">
                    Welcome, <?php echo e(auth()->user()->name); ?> (Role: <?php echo e(auth()->user()->getRoleNames()->first()); ?>)
                </p>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <?php if (\Illuminate\Support\Facades\Blade::check('role', 'customer')): ?>
                    <?php if (isset($component)) { $__componentOriginala853e505b29e21638885ed3fe40fba62 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginala853e505b29e21638885ed3fe40fba62 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.dashboard-link','data' => ['route' => 'reservations.index','label' => 'My Reservations']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('dashboard-link'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['route' => 'reservations.index','label' => 'My Reservations']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginala853e505b29e21638885ed3fe40fba62)): ?>
<?php $attributes = $__attributesOriginala853e505b29e21638885ed3fe40fba62; ?>
<?php unset($__attributesOriginala853e505b29e21638885ed3fe40fba62); ?>
<?php endif; ?>
<?php if (isset($__componentOriginala853e505b29e21638885ed3fe40fba62)): ?>
<?php $component = $__componentOriginala853e505b29e21638885ed3fe40fba62; ?>
<?php unset($__componentOriginala853e505b29e21638885ed3fe40fba62); ?>
<?php endif; ?>
                    <?php if (isset($component)) { $__componentOriginala853e505b29e21638885ed3fe40fba62 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginala853e505b29e21638885ed3fe40fba62 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.dashboard-link','data' => ['route' => 'scores.my','label' => 'View Scores']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('dashboard-link'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['route' => 'scores.my','label' => 'View Scores']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginala853e505b29e21638885ed3fe40fba62)): ?>
<?php $attributes = $__attributesOriginala853e505b29e21638885ed3fe40fba62; ?>
<?php unset($__attributesOriginala853e505b29e21638885ed3fe40fba62); ?>
<?php endif; ?>
<?php if (isset($__componentOriginala853e505b29e21638885ed3fe40fba62)): ?>
<?php $component = $__componentOriginala853e505b29e21638885ed3fe40fba62; ?>
<?php unset($__componentOriginala853e505b29e21638885ed3fe40fba62); ?>
<?php endif; ?>
                    <?php endif; ?>

                    <?php if (\Illuminate\Support\Facades\Blade::check('role', 'employee')): ?>
                    <?php if (isset($component)) { $__componentOriginala853e505b29e21638885ed3fe40fba62 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginala853e505b29e21638885ed3fe40fba62 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.dashboard-link','data' => ['route' => 'reservations.confirmed','label' => 'Confirmed Reservations']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('dashboard-link'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['route' => 'reservations.confirmed','label' => 'Confirmed Reservations']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginala853e505b29e21638885ed3fe40fba62)): ?>
<?php $attributes = $__attributesOriginala853e505b29e21638885ed3fe40fba62; ?>
<?php unset($__attributesOriginala853e505b29e21638885ed3fe40fba62); ?>
<?php endif; ?>
<?php if (isset($__componentOriginala853e505b29e21638885ed3fe40fba62)): ?>
<?php $component = $__componentOriginala853e505b29e21638885ed3fe40fba62; ?>
<?php unset($__componentOriginala853e505b29e21638885ed3fe40fba62); ?>
<?php endif; ?>
                    <?php if (isset($component)) { $__componentOriginala853e505b29e21638885ed3fe40fba62 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginala853e505b29e21638885ed3fe40fba62 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.dashboard-link','data' => ['route' => 'customers.index','label' => 'Customer Overview']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('dashboard-link'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['route' => 'customers.index','label' => 'Customer Overview']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginala853e505b29e21638885ed3fe40fba62)): ?>
<?php $attributes = $__attributesOriginala853e505b29e21638885ed3fe40fba62; ?>
<?php unset($__attributesOriginala853e505b29e21638885ed3fe40fba62); ?>
<?php endif; ?>
<?php if (isset($__componentOriginala853e505b29e21638885ed3fe40fba62)): ?>
<?php $component = $__componentOriginala853e505b29e21638885ed3fe40fba62; ?>
<?php unset($__componentOriginala853e505b29e21638885ed3fe40fba62); ?>
<?php endif; ?>
                    <?php if (isset($component)) { $__componentOriginala853e505b29e21638885ed3fe40fba62 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginala853e505b29e21638885ed3fe40fba62 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.dashboard-link','data' => ['route' => 'scores.editable','label' => 'Edit Scores']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('dashboard-link'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['route' => 'scores.editable','label' => 'Edit Scores']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginala853e505b29e21638885ed3fe40fba62)): ?>
<?php $attributes = $__attributesOriginala853e505b29e21638885ed3fe40fba62; ?>
<?php unset($__attributesOriginala853e505b29e21638885ed3fe40fba62); ?>
<?php endif; ?>
<?php if (isset($__componentOriginala853e505b29e21638885ed3fe40fba62)): ?>
<?php $component = $__componentOriginala853e505b29e21638885ed3fe40fba62; ?>
<?php unset($__componentOriginala853e505b29e21638885ed3fe40fba62); ?>
<?php endif; ?>
                    <?php if (isset($component)) { $__componentOriginala853e505b29e21638885ed3fe40fba62 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginala853e505b29e21638885ed3fe40fba62 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.dashboard-link','data' => ['route' => 'contacts.index','label' => 'Update Contact Info']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('dashboard-link'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['route' => 'contacts.index','label' => 'Update Contact Info']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginala853e505b29e21638885ed3fe40fba62)): ?>
<?php $attributes = $__attributesOriginala853e505b29e21638885ed3fe40fba62; ?>
<?php unset($__attributesOriginala853e505b29e21638885ed3fe40fba62); ?>
<?php endif; ?>
<?php if (isset($__componentOriginala853e505b29e21638885ed3fe40fba62)): ?>
<?php $component = $__componentOriginala853e505b29e21638885ed3fe40fba62; ?>
<?php unset($__componentOriginala853e505b29e21638885ed3fe40fba62); ?>
<?php endif; ?>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\dag_03\resources\views/dashboard.blade.php ENDPATH**/ ?>