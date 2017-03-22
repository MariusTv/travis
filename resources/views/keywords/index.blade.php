<html>

<body>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="{{ URL::asset('app.js') }}"></script>

    <div class="container">

        <div class="row">

            <h4>Keyword tree</h4>



            <div class="well search-keyword">
                {!! Form::open()  !!}

{!! Form::text('search', null , ['class'=>'form-control', 'placeholder'=>'Search for...']) !!}

{!! Form::select('word_type', [''=>'Field','substantive'=>'substantive', 'verb'=>'verb', "other"=>"other"], null, ['class' => 'form-control word-types']) !!}

{!! Form::select('search_lang', [''=>'Language', 'en'=>'English', 'de'=>'German'], null, ['class'=>'form-control']) !!}

{!! Form::select('sort', [''=>'Sort by...', 'main_form'=>'Main form'], null, ['class'=>'form-control'])!!}

{!! Form::select('sort_asc_dsc', ['asc'=>'ASC', 'desc'=>'DESC'], null, ['class'=>'form-control']) !!}

{!! Form::select('items_per', [''=>'Items per page', '100'=>'100'], null, ['class'=>'form-control']) !!}

{!! Form::submit('Search', ['class'=>'btn btn-default']) !!}

{!! Form::close() !!}

<div class="clearfix"></div>

</div>


{!!  Form::open(['class'=>'new-keyword-form', 'data-id'=>'1','id'=>'2']) !!}
{!!  method_field('PATCH') !!}
<button class="btn btn-primary add-keyword-set" type="button">Create new keywords set</button>

<div class="row well keyword-set">

<div class="col-md-2">
    <div class="keywords">
    <p>ID: <span class="keyword-id"></span></p>
    {!! Form::checkbox('checked', '1') !!}
    </div>
</div>

<div class="col-md-10">

<div class="row">

<div class="col-md-12 col-xs-12">
    {!! Form::select('word_type', ['substantive'=>'substantive', 'verb'=>'verb', "other"=>"other"], null, ['class' => 'form-control word-types']) !!}
{!! Form::text('latin', null, ['class'=>'form-control latin-name', 'placeholder' => 'Latin name']) !!}
{!! Form::text('local_lang', null, ['class'=>'form-control local-lang', 'placeholder' => 'Local language']) !!}
</div>

</div>

<div class="row">
<div class="col-md-12 col-xs-12">

    <div class="en-block">
    <div class="controls">
        <span class="flag-icon flag-icon-gb flag-icon-flat"></span>
        {!!  Form::button('Add Synonym', ['class'=>'btn btn-success add-synonym-en'])  !!}
    </div><!--END controls-->

            {!! Form::text('keyword_en[]', null, ['class'=>'form-control', 'placeholder'=>'Main keyword in english']) !!}

            {!! Form::text('plural_de[]', null, ['class'=>'form-control plural-form', 'placeholder'=>'Plural form']) !!}
            {!! Form::text('continuous_de[]', null, ['class'=>'form-control continuous-form', 'placeholder'=>'Continuous form']) !!}
            {!! Form::text('variant_verb_de[]', null, ['class'=>'form-control verb-variant', 'placeholder'=>'Variant']) !!}
            {!! Form::text('variant_other_de[]', null, ['class'=>'form-control other-variant', 'placeholder'=>'Variant']) !!}

        </div>

</div><!--END en-block-->
</div>

<div class="row">
<div class="col-md-12 col-xs-12">
    <div class="controls">
    <span class="flag-icon flag-icon-de flag-icon-flat"></span>
        {!!  Form::button('Add Synonym', ['class'=>'btn btn-success add-synonym-de']) !!}
    </div>
{!!  Form::text('keyword_de[]', null, ['class'=>'form-control', 'placeholder'=>'Main keyword in german']) !!}

    {!! Form::text('plural_en[]', null, ['class'=>'form-control plural-form', 'placeholder'=>'Plural form']) !!}
    {!! Form::text('continuous_en[]', null, ['class'=>'form-control continuous-form', 'placeholder'=>'Continuous form']) !!}
    {!! Form::text('variant_verb_en[]', null, ['class'=>'form-control verb-variant', 'placeholder'=>'Variant'])!!}
    {!! Form::text('variant_other_en[]', null, ['class'=>'form-control other-variant', 'placeholder'=>'Variant'])!!}
    </div>
</div>

</div>
</div><!--END row-->
{!!   Form::close() !!}


</div><!--END row-->

<div class="row">

<ul class="list-group">




</ul>

</div><!--END row-->

</div><!--END container-->

</body>
</html>