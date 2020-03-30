@extends('layouts.app')

@section('content')
<?php $code = explode("user_name=", Request::fullUrl());

    $yeardd = date('Y');
    $monthdd = date('m' );
    $daydd = date('d' );

?>
<div class="wrapper">
        <div class="container-calendar">
            <h3 id="monthAndYear"></h3>
            <form method="get" enctype="multipart/form-data" action="{{url('/user')}}" id="form_user">
                <div class="footer-container-calendar">
                    <input type="text" name="user_code" id="code" style="display: none" value="{{Auth::user()->id}}">
                    <input type="text" name="admin_code" id="code" style="display: none" value="{{Auth::user()->admin}}">
                @if( Auth::user()->admin === 1 || Auth::user()->admin === 2)
                        <label for="month">Աշխատակիցներ </label>
                        <select name="user_name" id="user_name">
                        <option value="0">Բոլորը</option>
                        @foreach($user as $item)
                            @if(count($code) > 1 && $code[1] == $item->id)
                                 <option value="{{$item->id}}" selected>{{$item->name}}</option>
                                @else
                                <option value="{{$item->id}}">{{$item->name}}</option>
                                @endif
                            @endforeach
                    </select>
                    @endif
                    <select id="day" onchange="jump()">
                        <option value=0>1</option>
                        <option value=1>2</option>
                        <option value=2>3</option>
                        <option value=3>4</option>
                        <option value=4>5</option>
                        <option value=5>6</option>
                        <option value=6>7</option>
                        <option value=7>8</option>
                        <option value=8>9</option>
                        <option value=9>10</option>
                        <option value=10>11</option>
                        <option value=11> 12</option>
                        <option value=11> 13</option>
                        <option value=11> 14</option>
                        <option value=11> 15</option>
                        <option value=11> 16</option>
                        <option value=11> 17</option>
                        <option value=11>18 </option>
                        <option value=11> 19</option>
                        <option value=11> 20</option>
                        <option value=11> 21</option>
                        <option value=11>22 </option>
                        <option value=11> 23</option>
                        <option value=11> 24</option>
                        <option value=11>25 </option>
                        <option value=11>26 </option>
                        <option value=11> 27</option>
                        <option value=11> 28</option>
                        <option value=11> 29</option>
                        <option value=11>30 </option>
                        <option value=11>31 </option>
                    </select>
                    <select id="month" onchange="jump()">
                        <option value=0>Jan</option>
                        <option value=1>Feb</option>
                        <option value=2>Mar</option>
                        <option value=3>Apr</option>
                        <option value=4>May</option>
                        <option value=5>Jun</option>
                        <option value=6>Jul</option>
                        <option value=7>Aug</option>
                        <option value=8>Sep</option>
                        <option value=9>Oct</option>
                        <option value=10>Nov</option>
                        <option value=11>Dec</option>
                    </select>
                    <select id="year" onchange="jump()"></select>

                </div>
            </form>
            <div class="button-container-calendar">
                <button id="previous" onclick="previous()">&#8249;</button>
                <button id="next" onclick="next()">&#8250;</button>
            </div>

            <table class="table-calendar" id="calendar" data-lang="en">
                <thead id="thead-month"></thead>
                <tbody id="calendar-body"></tbody>
            </table>

        </div>
        <div class="save">
            <button class="report_save">save</button>
        </div>
    </div>
    <div class="modalForShowingInfo">
        <p class="close">
            <span>&#215;</span>
        </p>
        <div class="tableParent">
            <table id="customers">
                <tr>
                    <th>Anun azganun</th>
                    <th>Amsativ</th>
                    <th>Report</th>
{{--                    <th>incha anum</th>--}}
{{--                    <th>incha anelu</th>--}}

                </tr>

            </table>
        </div>
    </div>

    <script src="https://ajax.aspnetcdn.com/ajax/jQuery/jquery-3.4.1.min.js"></script>
    <script>
        var report = JSON.parse('{!!json_encode($report)!!}');
        var user_id = '{{Auth::user()->admin}}';
        $(document).ready(function () {
            $('td.date-picker').each(function (m) {
                var data_date = $(this).attr('data-date');
                var data_month = $(this).attr('data-month');
                if(data_month.length === 1){data_month = '0'+data_month;}
                var data_year = $(this).attr('data-year');
                var data = data_year+'-'+data_month+'-'+data_date
                Object.keys(report).forEach(function (k) {
                       if(report[k]['date'] == data ) {
                           if(user_id == 1 || user_id == 2){
                               $($('td.date-picker textarea')[m]).val(report[k]['user']['name']);
                           }else {
                               $($('td.date-picker textarea')[m]).val(report[k]['user_report']);
                           }
                       }
               })
            })
         $('.selected').find('textarea').removeAttr('disabled');

    })

</script>
@endsection
