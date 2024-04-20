<x-admin-layout>
    <div class="containter-fluid w-1/2 mx-auto shadow-sm bg-white">
        <div class="container text-center">
            Name : {{ $user->name }} <br><br>
            Email : {{ $user->email }} <br><br>
            Current Role : {{ $user->roles->first()->name }} <br><br>
        </div>
    </div>
    <div class="container-fluid">
        <form method="POST" action="{{ route('admin.users.update', $user) }}">
            @csrf
            @method('PUT')
            <section class="container mx-auto p-6">

                <div
                    class="w-full rounded-lg py-4 px-4 mb-8 overflow-hidden shadow-sm flex flex-row flex-wrap justify-between items-center">

                    <div class="w-4/5"><input class="w-full border-0 ring-1 ring-gray-300 form-control rounded-md"
                            type="text" id="name" name="name" value="{{ $user->name }}">
                    </div>

                    <button class="btn btn-outline-primary" type="submit">
                        Change name
                    </button>
                </div>
                @error('name')
                    <span class="text-red-400 text-sm">{{ $message }}</span>
                @enderror
            </section>
        </form>
    </div>
    <div class="container-fluid">
        <form method="POST" action="{{ route('admin.users.assignRole', $user->id) }}">
            @csrf

            <div class="container flex flex-wrap flex-row justify-between overflow-hidden shadow-sm py-4">
                <select class="w-4/5" name="roleSelect" id="roleSelect">
                    @foreach ($roles as $role)
                        <option value="{{ $role->name }}" {{ $user->hasRole($role->name) ? 'selected' : '' }}>
                            {{ $role->name }}</option>
                    @endforeach
                </select>
                <button class="btn btn-outline-primary" type="submit">Assign Role</button>
            </div>
        </form>

    </div>
    {{-- <div class="">
            @if ($user->permissions)
                @foreach ($user->permissions as $user_perm)
                    <span>{{ $user_perm->name }}</span>
                @endforeach
            @endif
            {{ $user->permissions->first()->name }}
        </div> --}}
    <!-- /.container-fluid -->
    </div>
</x-admin-layout>
