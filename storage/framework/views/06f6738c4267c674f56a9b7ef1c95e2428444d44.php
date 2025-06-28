<?php if (isset($component)) { $__componentOriginal8e2ce59650f81721f93fef32250174d77c3531da = $component; } ?>
<?php $component = App\View\Components\AppLayout::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('app-layout'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(App\View\Components\AppLayout::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
     <?php $__env->slot('header', null, []); ?> 
        <h2 class="font-semibold text-xl text-green-700 leading-tight">
            Editar Reserva
        </h2>
     <?php $__env->endSlot(); ?>

    <div class="py-6 max-w-4xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">

            <?php if($errors->any()): ?>
                <div class="bg-red-100 text-red-700 p-3 rounded mb-4">
                    <ul class="list-disc pl-5">
                        <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <li><?php echo e($error); ?></li>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </ul>
                </div>
            <?php endif; ?>

            <form method="POST" action="<?php echo e(route('reservas.update', $reserva)); ?>">
                <?php echo csrf_field(); ?>
                <?php echo method_field('PUT'); ?>

                <div class="mb-4">
                    <label for="servicio" class="block text-sm font-medium text-gray-700">Servicio</label>
                    <input type="text" id="servicio" name="servicio" value="<?php echo e(old('servicio', $reserva->servicio)); ?>"
                           class="mt-1 block w-full rounded border-gray-300 shadow-sm">
                </div>

                <div class="mb-4">
                    <label for="fecha" class="block text-sm font-medium text-gray-700">Fecha</label>
                    <input type="date" id="fecha" name="fecha" value="<?php echo e(old('fecha', $reserva->fecha)); ?>"
                           class="mt-1 block w-full rounded border-gray-300 shadow-sm">
                </div>

                <div class="mb-4">
                    <label for="hora" class="block text-sm font-medium text-gray-700">Hora</label>
                    <input type="time" id="hora" name="hora" value="<?php echo e(old('hora', $reserva->hora)); ?>"
                           class="mt-1 block w-full rounded border-gray-300 shadow-sm">
                </div>

                <?php if(auth()->user()->email === 'marielysilva1389@gmail.com'): ?>
                    <div class="mb-4">
                        <label for="estado" class="block text-sm font-medium text-gray-700">Estado</label>
                        <select id="estado" name="estado" class="mt-1 block w-full rounded border-gray-300 shadow-sm">
                            <option value="pendiente" <?php echo e($reserva->estado == 'pendiente' ? 'selected' : ''); ?>>Pendiente</option>
                            <option value="confirmada" <?php echo e($reserva->estado == 'confirmada' ? 'selected' : ''); ?>>Confirmada</option>
                            <option value="cancelada" <?php echo e($reserva->estado == 'cancelada' ? 'selected' : ''); ?>>Cancelada</option>
                        </select>
                    </div>
                <?php endif; ?>

                <div class="flex justify-between mt-6">
                    <a href="<?php echo e(route('reservas.index')); ?>" class="text-sm text-blue-500 hover:underline">Volver</a>
                    <button type="submit" class="bg-green-600 hover:bg-green-700 text-white font-semibold px-4 py-2 rounded">
                        Guardar cambios
                    </button>
                </div>
            </form>
        </div>
    </div>
 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal8e2ce59650f81721f93fef32250174d77c3531da)): ?>
<?php $component = $__componentOriginal8e2ce59650f81721f93fef32250174d77c3531da; ?>
<?php unset($__componentOriginal8e2ce59650f81721f93fef32250174d77c3531da); ?>
<?php endif; ?><?php /**PATH C:\Users\marie\Desktop\Everything\PHP\reservas-estetica\resources\views/reservas/edit.blade.php ENDPATH**/ ?>