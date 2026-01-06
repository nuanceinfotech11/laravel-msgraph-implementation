@if(isset($emailsResult['value']) && $emailsResult['value']!='' && count($emailsResult['value'])>0)
    @foreach($emailsResult['value'] as $k => $value)
        <tr>
            <td> {{ ($k+1)+($counterInc) }} </td>
            <td> {{ (isset($value['subject']) && $value['subject']!='') ? $value['subject'] : '' }}</td>
            <td> {{ (isset($value['from']['emailAddress']['name']) && $value['from']['emailAddress']!='') ? $value['from']['emailAddress']['name'] : '' }} </td>
            <td> {{ (isset($value['toRecipients'][0]) && $value['toRecipients'][0]!='' && isset($value['toRecipients'][0]['emailAddress']['name']) && $value['toRecipients'][0]['emailAddress']['name']!='') ? $value['toRecipients'][0]['emailAddress']['name'] : '' }} </td>
            <td> {{ date('Y-m-d H:i',strtotime($value['sentDateTime'])) }} </td>
        </tr>
    @endforeach
@else
    <tr>
        <td colspan="8" class="text-center"> {{ __('No Record Found') }} </td>
    </tr>
@endif