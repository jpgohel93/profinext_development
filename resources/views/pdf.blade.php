<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title></title>
        <style>
            tr,td,table,th{
                border: 1px solid #000;
                padding:.5rem;
                border-collapse: collapse;
            }
            th {
                background-color: #e7e7e7;
                color: #121212;
                font-size: 1.1em;
            }
        </style>
    </head>
    <body>
        <table style="width:700px">
            <thead>
                <tr>
                    <th style="text-align: center">Sr No.</th>
                    <th style="text-align: center">Joining Date</th>
                    <th style="text-align: center">End Date</th>
                    <th style="text-align: center">No. Days</th>
                    <th style="text-align: center">Profit</th>
                    <th style="text-align: center">Fees</th>
                    <th style="text-align: center">Net Profit</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($client_demates as $client_demate)
                    <tr>
                        <td style="text-align: center">{{$client_demate->serial_number}}</td>
                        <td style="text-align: center"> {{date("Y-m-d",strtotime($client_demate->joining_date))}} </td>
                        <td style="text-align: center"> {{($client_demate->end_date)?date("Y-m-d",strtotime($client_demate->end_date)):"-" }} </td>
                        <td style="text-align: center"> {{round((time() - strtotime($client_demate->joining_date)) / (60 * 60 * 24))}} </td>
                        <td style="text-align: center"> {{$client_demate->profit}} </td>
                        <td style="text-align: center"> {{$client_demate->fees}} </td>
                        <td style="text-align: center"> {{$client_demate->net_profit}} </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7">No Details Found</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </body>
</html>