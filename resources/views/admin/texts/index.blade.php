@extends('admin.layouts.master')

@section('content')

<p>{!! link_to_route('admin.texts.create', 'Add new', null, array('class' => 'btn btn-success')) !!}</p>

@if ($texts->count())
    <div class="portlet box green">
        <div class="portlet-title">
            <div class="caption">List</div>
        </div>
        <div class="portlet-body">
            <table class="table table-striped table-hover table-responsive datatable">
                <thead>
                    <tr>
                        <th>antraste</th>
<th>kalba</th>

                        <th>&nbsp;</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($texts as $row)
                        <tr>
                            <td>{{ $row->key }}</td>
<td>{{ $row->locale }}</td>

                            <td>
                                {!! link_to_route('admin.texts.edit', 'Edit', array($row->id), array('class' => 'btn btn-xs btn-info')) !!}
                                {!! Form::open(array('style' => 'display: inline-block;', 'method' => 'DELETE', 'onsubmit' => 'return confirm(\'Confirm deletion\');',  'route' => array('admin.texts.destroy', $row->id))) !!}
                                    {!! Form::submit('Delete', array('class' => 'btn btn-xs btn-danger')) !!}
                                {!! Form::close() !!}
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
	</div>
@else
    No entries found.
@endif

@endsection
