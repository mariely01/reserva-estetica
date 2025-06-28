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
            Mis Reservas
        </h2>
     <?php $__env->endSlot(); ?>

    <div class="py-6 max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">

            <a href="<?php echo e(route('reservas.create')); ?>"
               class="mb-4 inline-block bg-green-600 hover:bg-green-700 text-white font-semibold py-2 px-4 rounded transition-colors duration-300 ease-in-out">
                Crear nueva reserva
            </a>

            <?php if(session('success')): ?>
                <div 
                    x-data="{ show: true }" 
                    x-show="show" 
                    x-init="setTimeout(() => show = false, 4000)" 
                    x-transition
                    class="bg-green-200 text-green-800 p-3 rounded mb-4"
                >
                    <?php echo e(session('success')); ?>

                </div>
            <?php endif; ?>

            <form method="GET" action="<?php echo e(route('reservas.index')); ?>" class="mb-4 flex flex-wrap gap-4">
                <input type="date" name="fecha" value="<?php echo e(request('fecha')); ?>" class="rounded border-gray-300" />

                <select name="estado" class="rounded border-gray-300">
                    <option value="">-- Estado --</option>
                    <option value="pendiente" <?php echo e(request('estado') == 'pendiente' ? 'selected' : ''); ?>>Pendiente</option>
                    <option value="confirmada" <?php echo e(request('estado') == 'confirmada' ? 'selected' : ''); ?>>Confirmada</option>
                    <option value="cancelada" <?php echo e(request('estado') == 'cancelada' ? 'selected' : ''); ?>>Cancelada</option>
                </select>

                <button type="submit" class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded transition-colors duration-300 ease-in-out">
                    Filtrar
                </button>

                <a href="<?php echo e(route('reservas.index')); ?>" class="text-sm text-blue-500 hover:underline self-center">Limpiar</a>
            </form>

            <?php if($reservas->count()): ?>
                <table class="min-w-full bg-white shadow-md rounded">
                    <thead>
                        <tr>
                            <th class="py-2 px-4 border-b border-gray-300 text-left">Servicio</th>
                            <th class="py-2 px-4 border-b border-gray-300 text-left">Fecha</th>
                            <th class="py-2 px-4 border-b border-gray-300 text-left">Hora</th>
                            <th class="py-2 px-4 border-b border-gray-300 text-left">Estado</th>
                            <th class="py-2 px-4 border-b border-gray-300 text-left">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__currentLoopData = $reservas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $reserva): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr 
                            x-data="{ show: false }" 
                            x-init="show = true" 
                            x-show="show" 
                            x-transition
                            class="hover:bg-gray-100"
                        >
                            <td class="border-b border-gray-300 py-2 px-4"><?php echo e($reserva->servicio); ?></td>
                            <td class="border-b border-gray-300 py-2 px-4"><?php echo e(\Carbon\Carbon::parse($reserva->fecha)->format('d/m/Y')); ?></td>
                            <td class="border-b border-gray-300 py-2 px-4"><?php echo e($reserva->hora); ?></td>
                            <td class="border-b border-gray-300 py-2 px-4">
                                <?php
                                $color = match($reserva->estado) {
                                    'confirmada' => 'bg-green-400 text-white',
                                    'pendiente' => 'bg-yellow-400 text-gray-900',
                                    'cancelada' => 'bg-red-400 text-white',
                                    default => 'bg-gray-300 text-gray-700',
                                };
                                ?>
                                <span class="px-3 py-1 rounded-full font-semibold <?php echo e($color); ?>">
                                    <?php echo e(ucfirst($reserva->estado)); ?>

                                </span>
                            </td>
                            <td class="border-b border-gray-300 py-2 px-4 whitespace-nowrap">
                                <a href="<?php echo e(route('reservas.edit', $reserva)); ?>" class="text-green-600 hover:underline mr-4 transition-colors duration-300 ease-in-out">Editar</a>

                                <form action="<?php echo e(route('reservas.destroy', $reserva)); ?>" method="POST" class="inline" onsubmit="return confirm('¿Eliminar esta reserva?');">
                                    <?php echo csrf_field(); ?>
                                    <?php echo method_field('DELETE'); ?>
                                    <button type="submit" class="text-red-600 hover:underline transition-colors duration-300 ease-in-out">Eliminar</button>
                                </form>
                            </td>
                        </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
            <?php else: ?>
                <p>No tienes reservas aún.</p>
            <?php endif; ?>

        </div>
    </div>

    <!-- Incluye Alpine.js -->
    <script src="//unpkg.com/alpinejs" defer></script>
 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal8e2ce59650f81721f93fef32250174d77c3531da)): ?>
<?php $component = $__componentOriginal8e2ce59650f81721f93fef32250174d77c3531da; ?>
<?php unset($__componentOriginal8e2ce59650f81721f93fef32250174d77c3531da); ?>
<?php endif; ?><?php /**PATH C:\Users\marie\Desktop\Everything\PHP\reservas-estetica\resources\views/reservas/index.blade.php ENDPATH**/ ?>