<x-admin.layout title="Mosques">
  <div class="p-4">
    <div class="flex justify-between items-center mb-4">
      <h3>Mosques</h3>
      <a href="{{ route('admin.mosques.create') }}" class="btn btn-primary">Create Mosque</a>
    </div>

    <table class="table">
      <thead>
        <tr>
          <th>#</th>
          <th>Name</th>
          <th>Regional</th>
          <th>Witel</th>
          <th>STO</th>
          <th>Tahun</th>
          <th>BKM</th>
          <th>Capacity</th>
          <th>Actions</th>
        </tr>
      </thead>
      <tbody>
        @foreach($mosques as $m)
          <tr>
            <td>{{ $loop->iteration + ($mosques->currentPage()-1)*$mosques->perPage() }}</td>
            <td>{{ $m->name }}</td>
            <td>{{ $m->regional?->name }}</td>
            <td>{{ $m->witel?->name }}</td>
            <td>{{ $m->sto?->name }}</td>
            <td>{{ $m->tahun_didirikan ?? '-' }}</td>
            <td>{{ $m->jml_bkm ?? 0 }}</td>
            <td>{{ $m->daya_tampung ?? '-' }}</td>
            <td>
              <a href="{{ route('admin.mosques.edit', $m->id) }}" class="btn btn-sm">Edit</a>
              <form action="{{ route('admin.mosques.destroy', $m->id) }}" method="POST" style="display:inline">
                @csrf
                @method('DELETE')
                <button class="btn btn-danger btn-sm" onclick="return confirm('Delete this mosque?')">Delete</button>
              </form>
            </td>
          </tr>
        @endforeach
      </tbody>
    </table>

    {{ $mosques->links() }}
  </div>
</x-admin.layout>
