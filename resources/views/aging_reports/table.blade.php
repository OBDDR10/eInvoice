@foreach($data as $row)
  <tr>
      <td><p class="text-sm font-weight-bold text-black mb-0">{{ $row->name }}</p></td>
      <td><p class="text-sm text-right font-weight-md text-black mb-0">{{ number_format($row->current, 2) }}</p></td>
      <td><p class="text-sm text-right font-weight-md text-black mb-0">{{ number_format($row->over_one, 2) }}</p></td>
      <td><p class="text-sm text-right font-weight-md text-black mb-0">{{ number_format($row->over_thirty, 2) }}</p></td>
      <td><p class="text-sm text-right font-weight-md text-black mb-0">{{ number_format($row->over_sixty, 2) }}</p></td>
      <td><p class="text-sm text-right font-weight-md text-black mb-0">{{ number_format($row->over_ninety, 2) }}</p></td>
      <td><p class="text-sm text-right font-weight-bold text-black mb-0">{{ number_format($row->total, 2) }}</p></td>
  </tr>
@endforeach