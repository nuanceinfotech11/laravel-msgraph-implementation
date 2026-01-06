@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4>
                            {{ (isset($pageTitle) && $pageTitle!='') ? $pageTitle : 'Dashboard' }}
                        </h4>
                    </div>
                
                    <div class="card-body">
                        <div class="emails-list-table">
                            <table id="listtable" class="table table-striped table-bordered" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>{{ __('S.No') }}</th>
                                        <th>{{ __('Subject') }}</th>
                                        <th>{{ __('From') }}</th>
                                        <th>{{ __('To') }}</th>
                                        <th>{{ __('Date and Time') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @include('partials.email-list-table')
                                </tbody>
                            </table>
                            <div class="loadmore-btn">
                                @if(isset($emailsResult) && $emailsResult!='' && count($emailsResult)>0)
                                    <a href="javascript:void(0);"  class="btn btn-primary loadmore {{$classhide}}" data-pageno="{{$pageno}}">
                                        {{ __('Read More') }}
                                    </a>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('page-script')
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
<script>
    $(document).ready(function(){
        $('body').on('click','.loadmore',function(){
            let page = $(this).data('pageno');
            console.log('page',page);
            $.ajax({ 
                url:"{{route('app.email-list')}}?page="+page,
                success:function(data){
                    $('.emails-list-table tbody').append(data.html);
                    $('.loadmore-btn').html(data.loadmoreBtn);
                }
            })
        })
    })
</script>
@endsection
