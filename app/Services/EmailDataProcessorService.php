<?php 

use App\Models\Emails;

class EmailDataProcessorService {

    

    /**
     * Insert fetch email data in table
     *
     * @return void
     */
    function insertEmailData($emailsResult){
        $insertData = [];
        if(isset($emailsResult['value']) && $emailsResult['value']!=''){
            foreach($emailsResult['value'] as $val){
                $insertData[] = [
                    'subject' => $val['subject'],
                    'send_from' => $val['from']['emailAddress']['name'],
                    'send_to' => $val['toRecipients'][0]['emailAddress']['name'],
                    'send_datetime' => $val['sentDateTime']
                ];
            }
        }

        if(!empty($insertData)){
            Emails::insert($insertData);
        }
    }

}