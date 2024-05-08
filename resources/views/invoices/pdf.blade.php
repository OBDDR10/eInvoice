<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice</title>
</head>

<body style="font-family: Arial, sans-serif; font-size: 13px;">
    <div style="position: relative; height: 297mm; width: 210mm; padding: 20px; margin: 0 auto; border: 1px solid #ccc;">
        <div style="text-align: center; margin-bottom: 20px;">
            <h1 style="margin-block-end: 0;">鼎峰铝业 & 玻璃工程</h1>
            <h1 style="margin-block-start: 0; margin-block-end: 0;">{{ $company->name }}</h1>
            <h3 style="margin-block-start: .3rem; margin-block-end: 0;">{{ $company->registration_no }}</h3>
            <h4 style="font-weight: 500; margin-block-start: .5rem; margin-block-end: 0;">{{ $company->address_1 }}</h4>
            <h4 style="font-weight: 500; margin-block-start: .2rem; margin-block-end: 0;">{{ $company->address_2 }} {{ $company->address_3 }}</h4>
            <h4 style="font-weight: 500; margin-block-start: .3rem; margin-block-end: 0;">Phone No: 016-3231586 &ensp; 011-10791586</h4>
        </div>

        <div style="margin-top: 50px; margin-bottom: 25px;">
          <table style="width: 100%;">
            <tr style="font-size: 14px; height: 20px;">
              <th style="text-align: left; width: 75%;"><p style="margin: 0;">Billl to: <a style="font-weight: bold;">{{ $data->client_name }}</a></p></th>
              <th style="width: 11%;"></th>
              <th style="width: 2%;"></th>
              <th style="width: 12%; text-align: right;"><p style="margin: 0;font-weight: bold;">Invoice</p></th>
            </tr>
            <tr>
              <td><p style="margin: 0;">{{ $data->client_address_1 }}</p></td>
              <td style="text-align: right;"><p style="margin: 0;">Issued Date</p></td>
              <td style="text-align: right;"><p style="margin: 0;">:</p></td>
              <td style="text-align: right;"><p style="margin: 0;">{{ date('Y-m-d', strtotime($data->issued_date)) }}</p></td>
            </tr>
            <tr>
              <td><p style="margin: 0;">{{ $data->client_address_2 }}</p></td>
              <td style="text-align: right;"><p style="margin: 0;">Invoice No </p></td>
              <td style="text-align: right;"><p style="margin: 0;">:</p></td>
              <td style="text-align: right;"><p style="margin: 0;">{{ $data->invoice_no }}</p></td>
            </tr>
            <tr>
              <td><p style="margin: 0;">{{ $data->client_address_3 }}</p></td>
              <td></td>
              <td></td>
              <td></td>
            </tr>
          </table>
        </div>

        <table class="table statement" style="width: 100%; border-collapse: collapse; margin-bottom: 20px; text-align: left; font-size: 13px;">
            <thead>
                <tr>
                    <th style="width: 2%; padding: 8px; text-align: center; border: 1px solid #ccc; background-color: #f0f0f0;">No.</th>
                    <th style="width: 58%; padding: 8px; border: 1px solid #ccc; background-color: #f0f0f0;">Description</th>
                    <th style="width: 10%; padding: 8px; border: 1px solid #ccc; text-align: center; background-color: #f0f0f0;">Quantity</th>
                    <th style="width: 15%; padding: 8px; border: 1px solid #ccc; text-align: right; background-color: #f0f0f0;">Unit Price</th>
                    <th style="width: 15%; padding: 8px; border: 1px solid #ccc; text-align: right; background-color: #f0f0f0;">Amount</th>
                </tr>
            </thead>
            <tbody>
                @foreach($details as $index => $detail)
                  <tr>
                      <td style="text-align: center; padding: 8px; border: 1px solid #ccc;">{{ $index + 1 }}</td>
                      <td style="padding: 8px; border: 1px solid #ccc;">{{ $detail->description }}</td>
                      <td style="text-align: center; padding: 8px; border: 1px solid #ccc;">{{ $detail->quantity }}</td>
                      <td style="text-align: right; padding: 8px; border: 1px solid #ccc;">{{ number_format($detail->unit_price, 2) }}</td>
                      <td style="text-align: right; padding: 8px; border: 1px solid #ccc;">{{ number_format($detail->amount, 2) }}</td>
                  </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="4" style="text-align: right; font-weight: bold; padding: 8px; border: 1px solid #ccc;">Total</td>
                    <td style="text-align: right; font-weight: bold; padding: 8px; border: 1px solid #ccc;">{{ number_format($data->total_amount, 2) }}</td>
                </tr>
            </tfoot>
        </table>

        <div style="padding-top: 10px; position: absolute; bottom: 30px;">
          <p style="font-weight: bold; margin-bottom: 5px;">Note:</p>
          <p style="padding-top: 4px; margin-block-start: 0rem; margin-block-end: 0rem;">1. A deposit of 30% should be made before starting renovation (RM {{ number_format($data->total_amount*0.3, 2) }}).</p>
          <p style="padding-top: 4px; margin-block-start: 0rem; margin-block-end: 0rem;">2. A deposit of 20% should be made for starting installing (RM {{ number_format($data->total_amount*0.2, 2) }}).</p>
          <p style="padding-top: 4px; margin-block-start: 0rem; margin-block-end: 0rem;">3. The balance 50% payment should be made before project completed (RM {{ number_format($data->total_amount*0.5, 2) }}).</b></p>
          <p style="padding-top: 20px; margin-block-start: 0rem; margin-block-end: 0rem;">(If payment is delayed, the project will be delayed)</b></p>
          <p style="padding-top: 25px; margin-block-start: 0rem; margin-block-end: 0rem;">Thanks and regards.</b></p>
          
          <div style="font-size: 14px;">
            <p style="padding-top: 25px; margin-block-start: 0rem; margin-block-end: 0rem; font-weight: bold;">Bank Details :</b></p>
            <p style="padding-top: 3px; margin-block-start: 0rem; margin-block-end: 0rem; font-weight: bold;">{{ $company->bank }} Acc : {{ $company->bank_account_no }}</b></p>
            <p style="padding-top: 3px; margin-block-start: 0rem; margin-block-end: 0rem; font-weight: bold;">{{ $company->bank_name }}</b></p>
          </div>

          <p style="padding-top: 25px; margin-block-start: 0rem; margin-block-end: 0rem;">Please semd receipt through WhatsApp once bank transfer.</b></p>
        </div>
    </div>
</body>
</html>
