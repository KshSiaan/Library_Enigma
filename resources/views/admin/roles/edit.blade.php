<x-admin-layout>
    <div class="container-fluid">
        <form method="POST" action="{{ route('admin.roles.update', $role) }}">
            @csrf
            @method('PUT')
            <section class="container mx-auto p-6">

                <div
                    class="w-full rounded-lg py-4 px-4 mb-8 overflow-hidden shadow-sm flex flex-row flex-wrap justify-between items-center">

                    <div class="w-4/5"><input class="w-full border-0 ring-1 ring-gray-300 form-control rounded-md"
                            type="text" id="name" name="name" value="{{ $role->name }}">
                    </div>
                    <button class="btn btn-outline-primary" type="submit">
                        Update
                    </button>
                </div>
                @error('name')
                    <span class="text-red-400 text-sm">{{ $message }}</span>
                @enderror

                <div class="w-full mb-8 overflow-hidden rounded-lg shadow-sm">
                    {{-- <div class="w-full overflow-x-auto">
                                <table class="w-full">
                                    <thead>
                                        <tr
                                            class="text-md font-semibold tracking-wide text-left text-gray-900 bg-gray-100 uppercase border-b border-gray-600">
                                            <th class="px-4 py-3">ID</th>
                                            <th class="px-4 py-3">Roles</th>
                                            <th class="px-2 py-3"></th>
                                            <th class="px-2 py-3"></th>
                                        </tr>
                                    </thead>
                                    <tbody class="bg-white">
                                        @foreach ($roles as $role)
                                            <tr class="text-gray-700">
                                                <td class="px-4 py-3 border">
                                                    <div class="flex items-center text-sm">
                                                        <div>
                                                            <p class="font-semibold text-black">{{ $role->id }}</p>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td class="px-4 py-3 border">{{ $role->name }}</td>
                                                <td class="px-4 py-3 text-sm border">
                                                    <button class="btn btn-sm btn-secondary">
                                                        <i class="fas fa-fw fa-pen"></i>
                                                        Edit
                                                    </button>
                                                </td>
                                                <td class="px-4 py-3 text-sm border">
                                                    <button class="btn btn-sm btn-danger">
                                                        <i class="fas fa-fw fa-trash"></i>
                                                        Edit
                                                    </button>
                                                </td>
                                            </tr>
                                        @endforeach



                                    </tbody>
                                </table>
                            </div> --}}
                </div>
            </section>
        </form>
    </div>
    <div class="container-fluid">
        <form method="POST" action="{{ route('admin.roles.permissions', $role->id) }}">
            @csrf

            <div class="w-full flex justify-end items-start py-4"><button class="btn btn-outline-primary"
                    type="submit">Assign
                    Permission</button></div>
            <div class="container flex flex-wrap flex-row justify-between overflow-hidden shadow-sm py-4">

                {{-- @foreach ($permissions as $perm)
                                <div
                                    class="w-[30%] flex flex-row flex-wrap justify-between border-l border-zinc-300 pl-4">
                                    <label for="{{ $perm->name }}">{{ $perm->name }}</label> &nbsp;
                                    <input type="checkbox" name="perm" id="{{ $perm->name }}"
                                        value="{{ $perm->name }}"
                                        @if ($role->permissions->contains('id', $perm->id)) checked="checked" @endif>
                                </div>
                            @endforeach --}}
                @foreach ($permissions as $perm)
                    <div class="w-[30%] flex flex-row flex-wrap justify-between border-l border-zinc-300 pl-4">
                        <label for="{{ $perm->name }}">{{ $perm->name }}</label> &nbsp;
                        <input type="checkbox" name="perm[]" id="{{ $perm->name }}" value="{{ $perm->id }}"
                            @if ($role->permissions->contains('id', $perm->id)) checked="checked" @endif>
                    </div>
                @endforeach




            </div>
        </form>
    </div>
    <div class="">
        @if ($role->permissions)
            @foreach ($role->permissions as $role_perm)
                <span>{{ $role_perm->name }}</span>
            @endforeach
        @endif
        {{-- {{ $role->permissions->first()->name }} --}}
    </div>
    <!-- /.container-fluid -->
    </div>
</x-admin-layout>
