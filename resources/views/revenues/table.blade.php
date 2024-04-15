@foreach($data as $row)
  <tr class="cursor-pointer" data-bs-toggle="modal" data-bs-target="#DetailModal" data-row-id="{{ $row->id }}">
    <td><p class="text-sm text-black font-weight-md mb-0">{{ date('Y-m-d', strtotime($row->date)) }}</p></td>
    <td><p class="text-sm text-black font-weight-md mb-0">{{ $row->sales_type_text }}</p></td>
    <td><p class="text-sm text-black font-weight-md mb-0">{{ $row->sales_name }}</p></td>
    <td><p class="text-sm text-black text-right font-weight-md mb-0">{{ number_format($row->sales_amount, 2) }}</p></td>
    <td><p class="text-sm text-black text-right font-weight-md mb-0">{{ number_format($row->cost_of_sales, 2) }}</p></td>
    <td>
      <p class="text-sm text-black font-weight-md mb-0">
          <button class="btn btn-info p-sm-btn" data-bs-toggle="modal" data-bs-target="#EditModal">{{ __('messages.edit') }}</button>
          <button class="btn btn-danger p-sm-btn" data-bs-toggle="modal" data-bs-target="#DeleteModal">{{ __('messages.delete') }}</button>
      </p>
    </td>
  </tr>
@endforeach