@extends('layouts.app')
@section('content')
<div class="main-content">

    <div class="page-content">
        <div class="container-fluid">
                <p>MLM</p>
            
        </div> 
    </div> 
</div>
<script>
        var formEconomyEdit = {
        'category': {
            'element': document.getElementById('category'),
            'error': document.getElementById('category_error'),
            'validations': [
                {
                    'func': function(value){
                        return checkRequired(value);
                    },
                    'message': generateErrorMessage('E003')
                },
            ]
        },
    }
    function submitForm(event) {
        
         event.preventDefault();
        if (validateAllFields(formEconomyEdit)){
            document.getElementById('categorySearchForm').submit();
        }
    }
</script>
@endsection
