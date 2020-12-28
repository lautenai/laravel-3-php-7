<?php
Route::get('/verify', function()
{
    // Create a new Permission
    // $permission = new \Verify\Models\Permission;
    // $permission->name = 'delete_user';
    // $permission->save();

    // Create a new Role
    // $role = new Verify\Models\Role;
    // $role->name = 'Moderator';
    // $role->level = 7;
    // $role->save();

    // Assign the Permission to the Role
    // $role->permissions()->sync(array($permission->id));

    // Create a new User
    // $user = new \Verify\Models\User;
    // $user->username = 'Lautenai Jr.';
    // $user->email = 'lautenai@gmail.com';
    // $user->password = 'lautenai'; // This is automatically salted and encrypted
    // $user->save();

    // Assign the Role to the User
    // $user->roles()->sync(array($role->id));

    $users = \Verify\Models\User::all();

    foreach ($users as $user ) {
        
        echo $user->username;
        echo '<br>';
        // Using the public methods available on the User object
        echo "User->is('Diretor')): ";
        var_dump($user->is('Diretor')); // true
        echo '<br>';
        echo "User->is('Professor')): ";
        var_dump($user->is('Professor')); // false
        echo '<br>';
        
        echo "User->can('delete_user')): ";
        var_dump($user->can('delete_user')); // true
        echo '<br>';
        echo "User->can('add_user')): ";
        var_dump($user->can('add_user')); // false
        echo '<br>';
        
        echo "User->level(7)): ";
        var_dump($user->level(7)); // true
        echo '<br>';
        echo "User->level(5, '<=')): ";
        var_dump($user->level(5, '<=')); // false
        echo '<br>';
        echo '<hr>';
    }

});