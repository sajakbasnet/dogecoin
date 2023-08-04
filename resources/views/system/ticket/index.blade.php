@extends('system.layouts.listing')
@section('header')
<x-system.search-form :action="url($indexUrl)">
    <x-slot name="inputs">
        <x-system.form.form-inline-group :input="['name' => 'keyword', 'label' => 'Search keyword', 'default' => Request::get('keyword')]" />
        <x-system.form.form-inline-group :input="['name' => 'status', 'label' => 'status']">
            <x-slot name="inputs">
                <x-system.form.input-select :input="['name' => 'status', 'placeholder' => 'Select status', 'options' => $status, 'default' => Request::get('status')]" />
            </x-slot>
        </x-system.form.form-inline-group>
    </x-slot>
</x-system.search-form>
@endsection

@section('table-heading')
<tr>
    <th scope="col">S.N</th>
    <th scope="col">Ticket No</th>
    <th scope="col">Subject</th>
    <th scope="col">Assigned</th>
    <th scope="col">Created Date</th>
    <th scope="col">Status</th>
    <th scope="col">Priority</th>
    <th scope="col">Action</th>
</tr>
@endsection

@section('table-data')
@php $pageIndex = pageIndex($items); @endphp
@foreach($items as $key=>$item)
<tr>
    <td>{{SN($pageIndex, $key)}}</td>
    <td>
        <a href="{{$indexUrl}}/{{$item->id}}/consult">{{$item->ticket_id ?? ''}}</a>
    </td>
    <td>{{ $item->subject }}</td>
    <td>{{$item->user->name ?? ''}}</td>
    <td>{{ \Carbon\Carbon::parse($item->createdDate)->format('Y-m-d') ?? '' }}</td>
    <td>
        <form id="statusForm_{{ $key }}" data-index="{{ $key }}" action="{{ route('updateStatus', ['id' => $item->id]) }}" method="post">
            @csrf
            <div class="dropdown">
                <button class="btn btn-sm dropdown-toggle @if($item->status == 'completed') btn-success @elseif($item->status == 'under-review') btn-primary @elseif($item->status == 'in-process-of-resolution') btn-danger @else btn-warning @endif" type="button" id="statusDropdownMenuButton_{{ $key }}" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    {{ strtoupper(str_replace('-', ' ', $item->status)) }}
                </button>
                <div class="dropdown-menu" aria-labelledby="statusDropdownMenuButton_{{ $key }}">
                    @foreach($status as $keys=>$stat)
                    <a class="dropdown-item" data-status="{{$keys}}">{{$stat}}</a>
                    @endforeach
                </div>
                <input type="hidden" name="status" id="selectedStatus_{{ $key }}" value="{{ $item->status }}">
            </div>
        </form>
    </td>
    <td>
        <span class="badge  @if($item->priority == 'low') badge-success @elseif($item->priority == 'medium') badge-warning @else badge-danger @endif">
            {{ strtoupper($item->priority) }}
        </span>
    </td>
    <td>
        @include('system.partials.editButton')
        @include('system.partials.deleteButton')
    </td>
</tr>
@endforeach
@endsection
@section('scripts')
<script>
    $(document).ready(function() {
        // Handle dropdown item click
        $(".dropdown-item").click(function() {
            var status = $(this).data('status');
            var index = $(this).closest(".dropdown").parent().data("index"); // Extract the index from the parent div's data attribute
            $("#selectedStatus_" + index).val(status); // Update the selectedStatus input value for the specific item
            $("#statusForm_" + index).submit(); // Submit the form when a dropdown item is clicked
        });

        // Handle form submission via AJAX
        $("form[id^='statusForm']").submit(function(event) {
            event.preventDefault();
            var index = $(this).data("index"); // Extract the index from the form's data attribute
            var formData = $(this).serialize();
            var url = $(this).attr("action");

            $.ajax({
                url: url,
                type: "POST",
                data: formData,
                success: function(response) {
                    var badgeButton = $("#statusDropdownMenuButton_" + index);
                    badgeButton.text(response.status).removeClass().addClass("btn btn-sm dropdown-toggle " + response.badgeClass);
                },
                error: function(error) {
                    console.log("Error:", error);
                }
            });
        });
    });
</script>





@endsection