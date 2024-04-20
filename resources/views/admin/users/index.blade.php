<x-admin-layout>

    <div class="container-fluid">
        <section class="container mx-auto p-6">

            <div class="w-full mb-8 overflow-hidden rounded-lg shadow-sm">

                <div class="w-full overflow-x-auto">
                    <table class="w-full">
                        <thead>
                            <tr
                                class="text-md font-semibold tracking-wide text-left text-gray-900 bg-gray-100 uppercase border-b border-gray-600">
                                <th class="px-4 py-3">ID</th>
                                <th class="px-4 py-3">Users</th>
                                <th class="px-2 py-3">Email</th>
                                <th class="px-2 py-3"></th>
                                <th class="px-2 py-3"></th>
                            </tr>
                        </thead>
                        <tbody class="bg-white">
                            @foreach ($users as $user)
                                <tr class="text-gray-700">
                                    <td class="px-4 py-3 border">
                                        <div class="flex items-center text-sm">
                                            <div>
                                                <p class="font-semibold text-black">{{ $user->id }}</p>
                                            </div>
                                        </div>
                                    </td>

                                    <td class="px-4 py-3 border">{{ $user->name }}</td>
                                    <td class="px-4 py-3 border">{{ $user->email }}</td>
                                    <td class="px-4 py-3 text-sm border">
                                        <a class="btn btn-sm btn-secondary"
                                            href="{{ route('admin.users.roles', $user->id) }}">
                                            <i class="fas fa-fw fa-pen"></i>
                                            Roles
                                        </a>
                                    </td>
                                    <td class="px-4 py-3 text-sm border">

                                        <form method="POST" action="{{ route('admin.users.destroy', $user->id) }}"
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
        </section>
    </div>
    <!-- /.container-fluid -->
    </div>

</x-admin-layout>
