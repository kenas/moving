@extends('layouts.app')

@section('content')
	<div class="container">

		@if($errors->any())
			@include('messages.errors')
		@endif
		
		{!! Form::open(['route' => 'articles.store', 'files' => true]) !!}

        <div class="field">
            <div class="control">
				{!! Form::label('title', 'Title:')!!}
				{{ Form::text('title', null, ['class' => 'input']) }}
            </div>
        </div>

        <div class="field">
            {{ Form::label('category_id', 'Category:')}}
            <div class="control">
                <div class="select">
			       {{ Form::select('category_id', $categories, null, ['placeholder' => 'Please select ...']) }}
                </div>
            </div>
        </div>

        <div class="field">
            <div class="control">
                <label>
                    {{ Form::file('coverImage', ['class' => 'file-input'])}}
                        <span class="file-cta">
                            <span class="file-icon">
                                <i class="fas fa-upload"></i>
                            </span>
                            <span class="file-label">
                                Choose a file…
                            </span>
                        </span>
                </label>
            </div>
        </div>

        <div class="filed">
			{{ Form::label('publish', 'Publish:')}}
            <div class="control">
                <div class="select">
			       {{ Form::select('publish', ['0' => 'No', '1' => 'Yes'], null, ['placeholder' => 'Please select ...']) }}
                </div>
            </div>
        </div>

        <div class="field">
			{{ Form::label('tags', 'Tags:') }}
                <div class="control">
                    <div class="select is-multiple">
    					{{-- {{ Form::select('tags[]', $tags, null, ['multiple' => 'multiple', 'class' => 'form-control tagsMultipleSelect'])}} --}}
    					<select multiple="multiple" multiple size="4" name="tags[]" style="width:1250px;">
    						@foreach($tags as $tag)
    							<option value="{{$tag->id}}">{{$tag->name}}</option>
    						@endforeach
    					</select>
                    </div>
                </div>
        </div>

        <div class="field">
            <div class="control">
				{{ Form::label('content', 'Content:') }}
				{{ Form::textarea('content', null, ['class' => 'textarea']) }}
            </div>
        </div>

		{{ Form::hidden('author',  Auth::user()->name) }}
		
        <div class="field">
            <div class="control">
                {{ Form::submit('Save it', ['class' => 'button is-medium is-fullwidth is-primary']) }}
            </div>
		</div>
			
		{!! Form::close() !!}
	</div>


    {{-- <script type="text/javascript">
    	const titleCreateNewArticle = document.getElementsByTagName('h1')[0];
    	const inputTitleGetValue = document.getElementById('title');
    	const getCategoryID = inputTitleGetValue.nextElementSibling.nextElementSibling;
    	    getCategoryID.setAttribute('data-toggle', 'modal');
    		getCategoryID.setAttribute('data-target', 'modal');

    	function builtModal() {

    		const htmlBody = document.getElementsByTagName('body')[0];

    		const modal = document.createElement('div');
    		modal.setAttribute('tabindex', '-1');
    		modal.setAttribute('role', 'dialog');
    		modal.className = 'modal fade';

    		const modalDialog = document.createElement('div');
    		modalDialog.className = 'modal-dialog';
    		modalDialog.setAttribute('role', 'document');

    		const modalContent = document.createElement('div');
    		modalContent.className = 'modal-content';

    		const modalHeader = document.createElement('div');
    		modalHeader.className = 'modal-header';

    		const h5 = document.createElement('h5');
    		h5.className = 'modal-title';
    		h5.textContent = 'Neco nekde';

    		const modalButton = document.createElement('button');
    		modalButton.className = 'close';
    		modalButton.type = 'button';
    		modalButton.setAttribute('data-dismiss', 'modal');
    		modalButton.setAttribute('aria-label', 'close');

    		const modalSpan = document.createElement('span');
    		modalSpan.setAttribute('aria-hidden', 'true');

    		const modalBody = document.createElement('div');
    		modalBody.className = 'modal-body';

    		const p = document.createElement('p');
    		p.textContent = 'hey hey';

    		const footer = document.createElement('div');
    		footer.className = 'modal-footer';

    		const buttonYes = document.createElement('button');
    		buttonYes.type = 'button';
    		buttonYes.className = 'btn btn-primary';

    		const buttonCancel = document.createElement('button');
    		buttonCancel.className = 'btn btn-secondary';
    		buttonCancel.type = 'button';
    		buttonCancel.setAttribute('data-dismiss', 'modal');

    		htmlBody.insertBefore(modal, htmlBody.firstElementChild);
    		modal.appendChild(modalDialog);
    		modalDialog.appendChild(modalContent);
    		modalContent.appendChild(modalHeader);
    		modalHeader.appendChild(h5);
    		modalHeader.appendChild(modalButton);
    		modalButton.appendChild(modalSpan);
    		modalContent.appendChild(modalBody);
    		modalBody.appendChild(p);
    		modalContent.appendChild(footer);
    		footer.appendChild(buttonCancel);
    		footer.appendChild(buttonYes);

    	}

    	getCategoryID.addEventListener('click', () => {
    		if(inputTitleGetValue.value !== '' || inputTitleGetValue.value === null) {
				titleCreateNewArticle.textContent = inputTitleGetValue.value;
    		} else {
    			builtModal();
    			//alert('Titulek k clanku nemuze byt prazdny!');
    		}
    		
    	});
    </script> --}}
@endsection