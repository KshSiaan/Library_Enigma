<x-admin-layout>
    <div class="container-fluid">
        <section class="container mx-auto p-6">
            <form method="POST" action="{{ route('admin.permissions.store') }}">
                @csrf
                <div
                    class="w-full rounded-lg py-4 px-4 mb-8 overflow-hidden shadow-sm flex flex-row flex-wrap justify-between items-center">


                    <div class="w-4/5"><input class="w-full border-0 ring-1 ring-gray-300 form-control rounded-md"
                            type="text" id="name" name="name">
                    </div>

                    <button type="submit" class="btn btn-primary">
                        Create Permission
                    </button>
                    @error('name')
                        <span class="text-red-400 text-sm">{{ $message }}</span>
                    @enderror
            </form>
    </div>
    <!-- /.container-fluid -->

    <div class="w-full overflow-x-auto">
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
                @foreach ($permissions as $permission)
                    <tr class="text-gray-700">
                        <td class="px-4 py-3 border">
                            <div class="flex items-center text-sm">
                                <div>
                                    <p class="font-semibold text-black">{{ $permission->id }}</p>
                                </div>
                            </div>
                        </td>
                        <td class="px-4 py-3 border">{{ $permission->name }}</td>
                        <td class="px-4 py-3 text-sm border">
                            <a class="btn btn-sm btn-secondary"
                                href="{{ route('admin.permissions.edit', $permission->id) }}">
                                <i class="fas fa-fw fa-pen"></i>
                                Edit
                            </a>
                        </td>
                        <td class="px-4 py-3 text-sm border">
                            <form method="POST" action="{{ route('admin.permissions.destroy', $permission->id) }}"
                                onsubmit="return confirm('Are you sure?')">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-sm btn-danger" type="submit">
                                    <i class="fas fa-fw fa-trash"></i>
                                    Delete
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach



            </tbody>
        </table>
    </div>
    </div>
    </div>
</x-admin-layout>
