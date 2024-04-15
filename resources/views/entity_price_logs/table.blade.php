@php
    $prev_entity = 0;
@endphp

@foreach($data as $row)
    @if ($row->financial_entity_id != $prev_entity)
      @php
        $prev_entity = $row->financial_entity_id;
      @endphp

      <tr class="cursor-pointer" data-bs-toggle="modal" data-bs-target="#DetailModal" data-row-id="{{ $row->id }}">
        <td><p class="text-sm text-black font-weight-bold mb-0">{{ $row->entity_name }}</p></td>
        <td><p class="text-sm text-black font-weight-bold mb-0">{{ $row->entity_type_text }}</p></td>
        <td></td>
        <td></td>
        <td>
          <p class="text-sm text-black text-right font-weight-md mb-0">
              <button class="btn btn-success p-sm-btn" data-bs-toggle="modal" data-bs-target="#AddModal">{{ __('messages.add') }}</button>
          </p>
        </td>
      </tr>
      <tr class="cursor-pointer" data-bs-toggle="modal" data-bs-target="#RecordDetailModal" data-row-id="{{ $row->id }}">
        <td></td>
        <td></td>
        <td><p class="text-sm text-black font-weight-md mb-0">{{ date('Y-m-d', strtotime($row->date)) }}</p></td>
        <td><p class="text-sm text-black text-right font-weight-md mb-0">{{ number_format($row->price, 2) }}</p></td>
        <td>
          <p class="text-sm text-black text-right font-weight-md mb-0">
              <button class="btn btn-info p-sm-btn" data-bs-toggle="modal" data-bs-target="#EditModal">{{ __('messages.edit') }}</button>
              <button class="btn btn-danger p-sm-btn" data-bs-toggle="modal" data-bs-target="#DeleteModal">Delete</button>
          </p>
        </td>
      </tr>
    @else
      <tr class="cursor-pointer" data-bs-toggle="modal" data-bs-target="#RecordDetailModal" data-row-id="{{ $row->id }}">
        <td></td>
        <td></td>
        <td><p class="text-sm text-black font-weight-md mb-0">{{ date('Y-m-d', strtotime($row->date)) }}</p></td>
        <td><p class="text-sm text-black text-right font-weight-md mb-0">{{ number_format($row->price, 2) }}</p></td>
        <td>
          <p class="text-sm text-black text-right font-weight-md mb-0">
              <button class="btn btn-info p-sm-btn" data-bs-toggle="modal" data-bs-target="#EditModal">{{ __('messages.edit') }}</button>
              <button class="btn btn-danger p-sm-btn" data-bs-toggle="modal" data-bs-target="#DeleteModal">{{ __('messages.delete') }}</button>
          </p>
        </td>
      </tr>
    @endif
@endforeach