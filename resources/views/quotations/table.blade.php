@foreach($data as $row)
  <tr class="cursor-pointer" data-bs-toggle="modal" data-bs-target="#DetailModal" data-row-id="{{ $row->id }}" data-row-email="{{ $row->client_email }}">
    <td><p class="text-sm text-black font-weight-md mb-0">{{ date('Y-m-d', strtotime($row->issued_date)) }}</p></td>
    <td><p class="text-sm text-black font-weight-md mb-0">{{ $row->quotation_no }}</p></td>
    <td><p class="text-sm text-black font-weight-md mb-0">{{ $row->client_name }}</p></td>
    <td><p class="text-sm text-black text-right font-weight-md mb-0">{{ number_format($row->total_amount, 2) }}</p></td>
    <td>
      <p class="text-sm text-black text-center font-weight-md mb-0">
        @if($row->status == 1)
          <span class="badge badge-sm bg-gradient-success">{{ __('messages.true') }}</span>
        @else
          <span class="badge badge-sm bg-gradient-secondary">{{ __('messages.false') }}</span>
        @endif
      </p>
    </td>
    <td>
      <p class="text-sm text-black font-weight-md mb-0">
          <button class="btn btn-info p-sm-btn" data-row-id="{{ $row->id }}" onclick="exportPDF({{$row->id}});">{{ __('messages.print') }}</button>
          <button class="btn btn-warning p-sm-btn" data-bs-toggle="modal" data-bs-target="#SendModal">{{ __('messages.send') }}</button>
          <button class="btn btn-danger p-sm-btn" data-bs-toggle="modal" data-bs-target="#DeleteModal">{{ __('messages.withdraw') }}</button>
      </p>
    </td>
  </tr>
@endforeach