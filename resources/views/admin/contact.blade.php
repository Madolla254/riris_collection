<x-layout>
    <div class="container mt-5 p-4 bg-white shadow-lg rounded">
        <h1 class="text-center fw-bold mb-4">Contact Management</h1>
        <p class="text-muted text-center">Manage all received messages and inquiries.</p>

        <!-- Contacts Table -->
        <div class="border p-4 bg-light rounded table-responsive">
            <h3 class="fw-bold">All Contacts</h3>
            <table class="table table-striped  mt-3">
                <thead class="table-dark">
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Message</th>
                        <th>Received On</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                @foreach($contacts as $contact)
                    <tr>
                        <td>{{ $contact->id }}</td>
                        <td>{{ $contact->name }}</td>
                        <td>{{ $contact->email }}</td>
                        <td>{{ $contact->message }}</td>
                        <td>{{ $contact->created_at->format('Y-m-d') }}</td>
                        <td>
                            <button class="btn btn-primary btn-sm">View</button>
                            <button class="btn btn-danger btn-sm">Delete</button>
                        </td>
                    </tr>
                @endforeach
                 
                </tbody>
            </table>
        </div>

       {{-- Pagination Links --}}
        <div class="d-flex justify-content-center mt-4">
            {{ $contacts->links() }}
        </div>
    </div>
</x-layout>
