@foreach($data as $row)
  <tr class="cursor-pointer" data-bs-toggle="modal" data-bs-target="#DetailModal" data-row-id="{{ $row->id }}">
    <td><p class="text-sm text-black font-weight-md mb-0">{{ date('Y-m-d', strtotime($row->date)) }}</p></td>
    <td><p class="text-sm text-black font-weight-md mb-0">{{ $row->receiving_company_name }}</p></td>
    <td><p class="text-sm text-black font-weight-md mb-0">{{ $row->paying_company_name }}</p></td>
    <td><p class="text-sm text-black font-weight-md mb-0">{{ $row->product_service_name }}</p></td>
    <td><p class="text-sm text-black text-right font-weight-md mb-0">{{ number_format($row->amount_payable, 2) }}</p></td>
    <td><p class="text-sm text-black text-right font-weight-md mb-0">{{ number_format($row->amount_paid, 2) }}</p></td>
    <td>
      <p class="text-sm text-black font-weight-md mb-0">
          <button class="btn btn-info p-sm-btn" data-bs-toggle="modal" data-bs-target="#EditModal">{{ __('messages.edit') }}</button>
          <button class="btn btn-danger p-sm-btn" data-bs-toggle="modal" data-bs-target="#DeleteModal">{{ __('messages.delete') }}</button>
      </p>
    </td>
  </tr>
@endforeach