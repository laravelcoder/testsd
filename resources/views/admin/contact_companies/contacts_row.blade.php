<tr data-index="{{ $index }}">
    <td>{!! Form::text('contacts['.$index.'][first_name]', old('contacts['.$index.'][first_name]', isset($field) ? $field->first_name: ''), ['class' => 'form-control']) !!}</td>
<td>{!! Form::text('contacts['.$index.'][last_name]', old('contacts['.$index.'][last_name]', isset($field) ? $field->last_name: ''), ['class' => 'form-control']) !!}</td>
<td>{!! Form::text('contacts['.$index.'][email]', old('contacts['.$index.'][email]', isset($field) ? $field->email: ''), ['class' => 'form-control']) !!}</td>
<td>{!! Form::text('contacts['.$index.'][skype]', old('contacts['.$index.'][skype]', isset($field) ? $field->skype: ''), ['class' => 'form-control']) !!}</td>
<td>{!! Form::text('contacts['.$index.'][address]', old('contacts['.$index.'][address]', isset($field) ? $field->address: ''), ['class' => 'form-control']) !!}</td>

    <td>
        <a href="#" class="remove btn btn-xs btn-danger">@lang('quickadmin.qa_delete')</a>
    </td>
</tr>