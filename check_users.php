<?php

require __DIR__.'/vendor/autoload.php';

$app = require_once __DIR__.'/bootstrap/app.php';
$app->make(\Illuminate\Contracts\Console\Kernel::class)->bootstrap();

echo "=== USUARIOS Y SUS ROLES ===" . PHP_EOL . PHP_EOL;

$users = \App\Models\User::with(['roles', 'permissions'])->get();

foreach ($users as $user) {
    $roles = $user->roles->sortBy('id')->pluck('name')->implode(', ') ?: 'Sin rol';
    $permisos = $user->permissions->pluck('name')->implode(', ') ?: 'Sin permisos';
    echo "ID: {$user->id} | {$user->name}" . PHP_EOL;
    echo "   Roles: {$roles}" . PHP_EOL;
    // echo "   Permisos: {$permisos}" . PHP_EOL . PHP_EOL;
}

echo "=== RESUMEN ===" . PHP_EOL;
echo "Total usuarios: " . $users->count() . PHP_EOL;
echo "Usuarios Admin: " . $users->filter(fn($u) => $u->hasRole('Admin'))->count() . PHP_EOL;
echo "Usuarios SedeR: " . $users->filter(fn($u) => $u->hasRole('SedeR'))->count() . PHP_EOL;
echo "Usuarios Viewer: " . $users->filter(fn($u) => $u->hasRole('Viewer'))->count() . PHP_EOL;
echo "Usuarios CriteriaR: " . $users->filter(fn($u) => $u->hasRole('CriteriaR'))->count() . PHP_EOL;
echo "Usuarios IndicatorR: " . $users->filter(fn($u) => $u->hasRole('IndicatorR'))->count() . PHP_EOL;
