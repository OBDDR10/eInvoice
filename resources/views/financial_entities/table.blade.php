@foreach($data as $row)
  <tr class="cursor-pointer" data-bs-toggle="modal" data-bs-target="#DetailModal" data-row-id="{{ $row->id }}">
    <td><p class="text-sm text-black font-weight-md mb-0">{{ $row->name }}</p></td>
    <td><p class="text-sm text-black font-weight-md mb-0">{{ $row->entity_type_text }}</p></td>
    <td>
      <p class="text-sm text-black font-weight-md mb-0">
        @if($row->is_current == 1)
          <span class="badge badge-sm bg-gradient-success">{{ __('messages.true') }}</span>
        @else
          <span class="badge badge-sm bg-gradient-secondary">{{ __('messages.false') }}</span>
        @endif
      </p>
    </td>
    <td>
      <p class="text-sm text-black font-weight-md mb-0">
          <button class="btn btn-info p-sm-btn" data-bs-toggle="modal" data-bs-target="#EditModal">{{ __('messages.edit') }}</button>
          <button class="btn btn-danger p-sm-btn" data-bs-toggle="modal" data-bs-target="#DeleteModal">{{ __('messages.delete') }}</button>
      </p>
    </td>
  </tr>
@endforeach