@foreach($data as $row)
  <tr class="cursor-pointer" data-bs-toggle="modal" data-bs-target="#DetailModal" data-row-id="{{ $row->id }}">
    <td><p class="text-sm text-black font-weight-md mb-0">{{ $row->name }}</p></td>
    <td><p class="text-sm text-black font-weight-md mb-0">{{ date('Y-m-d', strtotime($row->purchase_date)) }}</p></td>
    <td><p class="text-sm text-black text-right font-weight-md mb-0">{{ number_format($row->purchase_price, 2) }}</p></td>
    <td><p class="text-sm text-black text-right font-weight-md mb-0">{{ number_format($row->depreciation, 2) }}</p></td>
    <td><p class="text-sm text-black text-right font-weight-md mb-0">{{ number_format($row->net_book_value, 2) }}</p></td>
    <td><p class="text-sm text-black text-center font-weight-md mb-0">{{ $row->useful_life }}</p></td>
    <td>
      <p class="text-sm text-black font-weight-md mb-0">
          <button class="btn btn-info p-sm-btn" data-bs-toggle="modal" data-bs-target="#EditModal">{{ __('messages.edit') }}</button>
          <button class="btn btn-danger p-sm-btn" data-bs-toggle="modal" data-bs-target="#DeleteModal">{{ __('messages.delete') }}</button>
      </p>
    </td>
  </tr>
@endforeach